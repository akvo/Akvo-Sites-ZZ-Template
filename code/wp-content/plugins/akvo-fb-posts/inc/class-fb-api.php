<?php

class FB_API extends SINGLETON{
	
	/*
	var $appID;
	var $appSecret;
	var $fb;
	*/
	
	var $accessToken;
	var $pageID;
	
	function __construct(){
		
		$this->setAccessToken( get_option( 'fbAccessToken' ) );
		$this->setPageID( get_option( 'fbPageID' ) );
		
		//add_action( 'admin_init', array( $this, 'admin_init' ) );
		
		add_action( 'admin_menu', function(){
			
			add_options_page('FB Posts Settings', 'FB Posts Settings', 'manage_options', 'fb_posts', array( $this, 'options_page' ) );
			
		});
		
	}
	
	/* GETTER AND SETTER FUNCTIONS 
	function getAppID(){ return $this->appID; }
	function setAppID( $appID ){ $this->appID = $appID; }
	
	function getAppSecret(){ return $this->appSecret; }
	function setAppSecret( $appSecret ){ $this->appSecret = $appSecret; }
	
	
	function getFB(){ return $this->fb; }
	function setFB(){
		$this->fb = new Facebook( array(
			'app_id' 				=> $this->getAppID(),
			'app_secret' 			=> $this->getAppSecret(),
			'default_graph_version' => 'v3.2'
		) );
	}
	*/
	
	function getPageID(){ return $this->pageID; }
	function setPageID( $pageID ){ $this->pageID = $pageID; }
	
	function setAccessToken( $accessToken ){ $this->accessToken = $accessToken; }
	function getAccessToken(){ return $this->accessToken; }
	/* GETTER AND SETTER FUNCTIONS */
	
	
	
	function getSettingsOptions(){
		return array(
			'fbAccessToken' => 'Access Token',
			//'fbPageID'		=> 'Page ID'
		);
	}
	/*
	function admin_init() {
		
		add_settings_section(  
			'my_settings_section', 						// Section ID 
			'FB Posts Settings', 						// Section Title
			array( $this, 'admin_settings_section' ), 	// Callback
			'general' 									// What Page?  This makes the section show up on the General Settings Page
		);
		
		$settingsOptions = $this->getSettingsOptions();
		
		foreach( $settingsOptions as $option_slug => $option_title ){
			
			add_settings_field( 	
				$option_slug, 							// Option ID
				$option_title, 							// Label
				array( $this, 'my_textbox_callback' ), 	// !important - This is where the args go!
				'general', 								// Page it will be displayed (General Settings)
				'my_settings_section', 					// Name of our section
				array( $option_slug )					// Should match Option ID  
			);
			
			register_setting( 'general', $option_slug, 'esc_attr' );
			
		}
		 
	}
	
	function admin_settings_section() { // Section Callback
		echo '<p>Facebook authentication settings required for pulling the posts and converting them into new custom post types</p>';  
	}

	function my_textbox_callback($args) {  // Textbox Callback
		$option = get_option($args[0]);
		echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
	}
	*/
	
	function options_page(){
		include "templates/settings.php";
	}
	
	function getPagePosts(){
		
		//$userPosts = $this->getFB()->get( "/$pageID/feed", $this->getAccessToken() );
		//return $userPosts->getDecodedBody();
		
		$fields = "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
		$limit = 5;
		
		//$json_link = "https://graph.facebook.com/{$this->getPageID()}/feed?access_token={$this->getAccessToken()}&fields={$fields}&limit={$limit}";
		
		$json_link = "https://graph.facebook.com/v3.2/me/?fields=posts{".$fields."}&access_token=".$this->getAccessToken();
		
		$jsonData = json_decode( file_get_contents( $json_link ), true );
		
		if( isset( $jsonData['posts'] ) ){
			return $jsonData['posts'];
		}
		
		return $jsonData;
		
	}
	
}

FB_API::getInstance();