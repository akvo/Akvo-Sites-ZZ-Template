<?php

class FB_API extends SINGLETON{
	
	var $accessToken;
	
	function __construct(){
		
		$this->setAccessToken( get_option( 'fbAccessToken' ) );
		
		add_action( 'wp_ajax_fb_posts_import', array( $this, 'ajaxImport' ) );
		add_action( 'wp_ajax_nopriv_fb_posts_import', array( $this, 'ajaxImport' ) );
		
	}
	
	/* GETTER AND SETTER FUNCTIONS */
	function setAccessToken( $accessToken ){ $this->accessToken = $accessToken; }
	function getAccessToken(){ return $this->accessToken; }
	/* GETTER AND SETTER FUNCTIONS */
	
	
	/*
	* CREATE FEATURED IMAGE FROM A URL
	* POST_ID
	* IMAGE_URL
	* IMAGE_NAME
	*/
	function addFeaturedImage( $post_id, $image_url ){
		
		// Add Featured Image to Post
		$upload_dir       = wp_upload_dir(); 														// Set upload folder
		$image_data       = file_get_contents( $image_url ); 										// Get image data
		$unique_file_name = wp_unique_filename( $upload_dir['path'], 'fb'.$post_id.'.jpg' ); 		// Generate unique name
		$filename         = basename( $unique_file_name ); 											// Create image file name

		// Check folder permission and define file location
		if( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}

		// Create the image  file on the server
		file_put_contents( $file, $image_data );

		// Check image file type
		$wp_filetype = wp_check_filetype( $filename, null );

		// Set attachment data
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		// Create the attachment
		$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

		// Include image.php
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		// Define attachment metadata
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

		// Assign metadata to attachment
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// And finally assign featured image to post
		set_post_thumbnail( $post_id, $attach_id );
		
		
	}
	
	function ajaxImport(){
		
		
		
		if( isset( $_GET['post_id'] ) ){
			$post_id = $_GET['post_id'];
			
			$fbPost = $this->fbPost( $post_id );
			
			$args = array(
				'post_title'	=> isset( $fbPost['name'] ) ? $fbPost['name'] : '',
				'post_content'	=> isset( $fbPost['description'] ) ? $fbPost['description'] : ( isset( $fbPost['name'] ) ? $fbPost['name'] : '' ),
				'post_status'   => 'publish',
				'post_type'    	=> 'Fb_post',
			);
			
			if( !$args['post_title'] && $args['post_content'] ){
				$args['post_title'] = substr( $args['post_content'], 0, 20 );
			}
			
			if( $args['post_title'] && $args['post_content'] ){
				echo "<pre>";
				print_r( $fbPost );
				print_r( $args );
				echo "</pre>";
				
				// Insert the post into the database
				$post_id = wp_insert_post( $args );
				
				if( isset( $fbPost['full_picture'] ) && $fbPost['full_picture'] ){
					$this->addFeaturedImage( $post_id, $fbPost['full_picture'] );
				}
				
				
			}
			
		}
		
		wp_die();
		
	}
	
	
	
	function fbFields(){
		return "id,message,full_picture,picture,link,name,description,type,icon,created_time,from,object_id";
	}
	
	function graphAPI(){
		return "https://graph.facebook.com/v3.2/";
	}
	
	function fbPost( $post_id ){
		
		return $this->callAPI( $post_id."?fields=".$this->fbFields() );
		
	}
	
	function fbPagePosts(){
		
		$jsonData = $this->callAPI( "me/?fields=posts{".$this->fbFields()."}" );
		
		if( isset( $jsonData['posts'] ) ){
			return $jsonData['posts'];
		}
		
		return $jsonData;
		
	}
	
	function callAPI( $partialURL ){
		
		$transient = get_transient( $partialURL );
		
		if( ! empty( $transient ) ) {
    
			// The function will return here every time after the first time it is run, until the transient expires.
			return $transient;

			// Nope!  We gotta make a call.
		} else {
			
			// APPEND GRAPH API AND ACCESS TOKEN
			$apiLink = $this->graphAPI().$partialURL."&access_token=".$this->getAccessToken();
			
			$data = json_decode( file_get_contents( $apiLink ), true );
			
			// Save the API response so we don't have to call again until tomorrow.
			set_transient( $partialURL, $data, DAY_IN_SECONDS );
			
			return $data;
			
		}
		
	}
}

FB_API::getInstance();