<?php
/*
Plugin Name: Akvo Fb posts
Plugin URI: https://akvo.org
Description:  Allows user to retrieve posts from Facebook page in a list, where they can select a post and post it on their website.
Author: Samuel Thomas
Version: 1.0.0
Author URI: https://akvo.org
*/

$inc_files = array(
	'inc/class-singleton.php',
	'inc/class-fb-db.php',
	'inc/class-fb-api.php',
	'inc/class-fb-posts-list-table.php',
	'inc/class-fb-admin.php',
);

$flag = false;

/*
* ENABLE ONLY FOR FOOTBALL FOR WATER
*/
if ( is_multisite() ) {
	$current_site = get_current_site();
	if( isset($current_site->domain) && $current_site->domain == "footballforwater.org" ) {
		$flag = true;
	}
}
else{
	$flag = true;
}

if( $flag ){
	foreach( $inc_files as $inc_file ){
		require_once( $inc_file );
	}
}


