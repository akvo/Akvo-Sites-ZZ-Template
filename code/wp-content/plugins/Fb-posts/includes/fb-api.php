<?php

/*
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once dirname( __FILE__ ) . './../facebook/src/Facebook/autoload.php';
require_once dirname( __FILE__ ) . './../facebook/src/Facebook/Exceptions/FacebookResponseException.php';
require_once dirname( __FILE__ ) . './../facebook/src/Facebook/Exceptions/FacebookSDKException.php';
require_once dirname( __FILE__ ) . './../facebook/src/Facebook/Helpers/FacebookRedirectLoginHelper.php';
*/

class FB_API{
	
	var $appID;
	var $appSecret;
	var $fb;
	var $accessToken;
	var $pageID;
	
	function __construct(){
		
		//$this->setAppID( "439925743203152" );
		//$this->setAppSecret( "dcf810d4eaabe81a26fbd60f510c69ee" );
		$this->setAccessToken( "EAAGQHDGms1ABAAFsvVI4jHPEIgYwl05XUAOqV41ZCYGSZChGkx3kbxZBtcEF1kaJfZBV5yoeZCO7fIzDTZBpyIce0pH05jIZB1zIZAUwL4QcZAchcV6SwDdlF0iOUrs7gx0u3h0bk93LbQkJZBp4GBToO1ZBNfqw079IgCwOJUjTyWtrwZDZD" );
		$this->setPageID( "1048509591976007" );
		//$this->setFB();
		
	}
	
	/* GETTER AND SETTER FUNCTIONS */
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
	
	function getPageID(){ return $this->pageID; }
	function setPageID( $pageID ){ $this->pageID = $pageID; }
	
	function setAccessToken( $accessToken ){ $this->accessToken = $accessToken; }
	function getAccessToken(){ return $this->accessToken; }
	/* GETTER AND SETTER FUNCTIONS */
	
	function getPagePosts(){
		
		//$userPosts = $this->getFB()->get( "/$pageID/feed", $this->getAccessToken() );
		//return $userPosts->getDecodedBody();
		
		$fields = "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
		$limit = 5;
	
		$json_link = "https://graph.facebook.com/{$this->getPageID()}/feed?access_token={$this->getAccessToken()}&fields={$fields}&limit={$limit}";
		$jsonData = json_decode( file_get_contents( $json_link ), true );
		return $jsonData;
	}
}


try {
	/*
	$fb_api = new FB_API;
	
	$data = $fb_api->getPagePosts( "1048509591976007" );
	
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
	
	wp_die();
	*/
	
}catch( Exception $e ){
    
} 


/*

//function Fb_insert_post( $postData ){
//Insert data in Fb-posts and Db
    if (count($postData) > 0) {
        foreach ($postData as $Fb_posts) {
            $args = array(
                'ID'                    => $Fb_posts ['id'],
                'post_title'            => $Fb_posts ['message'],
                'post_content'          => $Fb_posts ['message'],
                'post_type'             => 'Fb_post',
                //'post_status'           => 'publish',
                //'tax_input'             => array('post_format' => 'post-format-quote')
                //'post_image'          => $Fb_posts ['picture'],
            );
            // Insert the post into the database
            wp_insert_post($args);

            //var_dump($args);
        }

        //wp_die();
}
*/





