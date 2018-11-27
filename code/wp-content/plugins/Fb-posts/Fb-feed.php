<?php
/*
Plugin Name : Fb posts
Plugin URI	:
Description	: Allows user to retrieve posts from Facebook page in a list, where they can select a post and post it on their website.
Version		:
Author		: Akvo
Author URI	:
Text Domain	:
Domain Path	:
*/

$inc_files = array(
	'includes/class-singleton.php',
	'includes/class-fb-api.php',
	'includes/class-fb-posts-list-table.php',
);

foreach( $inc_files as $inc_file ){
	require_once( $inc_file );
}