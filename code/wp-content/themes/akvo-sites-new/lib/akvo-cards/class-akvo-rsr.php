<?php

	class AKVO_RSR{
		
		function get_json_data( $data_feed_id ){
			
			$data = do_shortcode('[data_feed name="'.$data_feed_id.'"]'); 		/* Dependancy on the Data Feed Plugin */
			
			return json_decode( str_replace('&quot;', '"', $data) );
			

			//$data = $this->get_feed_api( 'https://rsr.akvo.org/rest/v1/project_update/?format=json&project=6892&image_thumb_name=big' );
			
			//return $this->get_data_feed_response( $data_feed_id );
			
			//print_r( $data );
			
			//return $data;
				
		}
		
		/* GET DATA FEEDS FROM THE DATABASE */
		function get_data_feeds(){
			global $wpdb;
			
			$data_feeds = array();
			
			$rows = $wpdb->get_results( 'SELECT df_name FROM ' . $wpdb->prefix . 'data_feeds' );
			
			foreach( $rows as $row ){
				$data_feeds[ $row->df_name ] = $row->df_name;
			}
			
			return $data_feeds;
			
		}
		
		/* GET DATA FEED URL FROM ID */
		function get_data_feed_url( $data_feed_id ){
			
			global $wpdb;
			
			$rows = $wpdb->get_results( "SELECT df_url FROM " . $wpdb->prefix . "data_feeds WHERE df_name='" . $data_feed_id . "' LIMIT 0,1;" );
			
			foreach( $rows as $row ){

				return $row->df_url;
			}
			
			return false;
		}
		
		function get_data_feed_response( $data_feed_id ){
			
			$json_key = 'df'.$data_feed_id;
			$_json_expiration = 60 * 5; // 5 minutes
			$key = $json_key . md5($json_key );
			
			$data = array();
			
			if ( ! ( $data = get_transient($key) ) ) {
				
				$url = $this->get_data_feed_url( $data_feed_id );
				
				$request = wp_remote_get( $url );
				
				if( ! is_wp_error( $request ) ) {
					$body = wp_remote_retrieve_body( $request );
					
					// MORE OF YOUR CODE HERE
					$data = json_decode( $body );

					// IF IT IS NEW, SET THE TRANSIENT FOR NEXT TIME
					set_transient($key, $data, $_json_expiration);
				}
				
			}
			
			return $data;
			
		}
		
		function get_feed_api( $url ){
			
			$body = false;
			
			//$url = $this->get_data_feed_url( $data_feed_id );
			
			//echo $url;
			
			try{
				$request = wp_remote_get( $url );
				
				//print_r( $request );
					
				if( ! is_wp_error( $request ) ) {
					$body = wp_remote_retrieve_body( $request );
				}
			}catch( Exception $e ){
				print_r( $e );
			}
			return $body;
		}
		
		
		
		function get_base_url( $akvo_card_options ){
			$base_url = 'http://rsr.akvo.org';
			if($akvo_card_options && array_key_exists('akvoapp', $akvo_card_options)){
				$base_url = $akvo_card_options['akvoapp'];
			}
			return $base_url;
		}
		
		function parse_rsr( $rsr_obj, $akvo_card_options, $akvo_date_format, $type ){
			
			$data = array( 'type-text'	=> 'RSR Project' );
			if( $type == 'update' ){
				$data[ 'type-text' ] = 'RSR Updates';
			}
			
			$base_url = self::get_base_url( $akvo_card_options );								// GET BASE URL
			
			/* PARSING JSON OBJECT OF RSR PROJECT */
			
			/* COMMON RSR OBJECTS */
			if( isset( $rsr_obj->title ) ){
				$data['title'] = $rsr_obj->title;												/* rsr object title */
			}
			if( isset( $rsr_obj->created_at ) ){
				$data['date'] = date( $akvo_date_format, strtotime($rsr_obj->created_at) );		/* rsr object date */
			}
			if( isset( $rsr_obj->absolute_url ) ){
				$data['link'] = $base_url.$rsr_obj->absolute_url;								/* rsr absolute url */
			}
			/* COMMON RSR OBJECTS */
			
			/* RSR OBJECT CONTENT */
			if( $type == 'project' && isset( $rsr_obj->project_plan_summary ) ){
				$data['content'] = truncate( $rsr_obj->project_plan_summary, 130 );				/* rsr project summary */
			}
			elseif( $type == 'update' && isset( $rsr_obj->text ) ){
				$data['content'] = truncate( $rsr_obj->text, 130 );								/* rsr updates text */
			}
			/* RSR OBJECT CONTENT */
			
			/* RSR OBJECT IMAGE */
			if( $type == 'project' && isset( $rsr_obj->current_image ) ){
				$data['img'] = $base_url.$rsr_obj->current_image;
			}
			elseif( $type == 'update' && isset( $rsr_obj->photo ) ){
				if( isset( $rsr_obj->photo->original ) ){
					$data['img'] = $base_url.$rsr_obj->photo->original;
				}
				else{
					$data['img'] = $base_url.$rsr_obj->photo;	
				}
			}
			/* RSR OBJECT IMAGE */
			
			return $data;
			
		}
		
		
	}
	
	global $akvo_rsr;
	$akvo_rsr = new AKVO_RSR;