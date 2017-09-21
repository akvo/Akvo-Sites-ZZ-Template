<?php
	$sage_includes = [
  		//'lib/utils.php',                 	// Utility functions
  		'lib/akvo/class-akvo.php',			// Akvo Class
  		'lib/init.php',                  	// Initial theme setup and constants
  		'lib/conditional-tag-check.php', 	// ConditionalTagCheck class
  		'lib/config.php',                	// Configuration
  		'lib/assets.php',                	// Scripts and stylesheets
  		'lib/titles.php',                	// Page titles
  		'lib/extras.php',                	// Custom functions
  		'lib/custom-posts.php',          	// Custom posts
  		'lib/custom-widgets.php',        	// Custom widgets G!
  		'lib/bootstrap-nav-walker.php',    	// BS Nav walker
  		'plugins/boxes.php',        		// Custom input fields
  		'plugins/related.php',        		// Related posts
  		'lib/customize-theme.php',        	// Theme customizer
  		'lib/customize-theme/main.php',		// Library of theme customisation
  		//'lib/taxonomies.php',             // Custom categories for eg media library
  		'lib/akvo-cards/main.php',        	// Cards
  		'lib/akvo-carousel/main.php',     	// Carousel
  		'lib/akvo-filters/main.php',      	// Filters for post types
	];
	
	foreach ($sage_includes as $file) {
    	if (!$filepath = locate_template($file)) {
    	  	trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    	}
		require_once $filepath;
	}
	unset($file, $filepath);
	
	
	
	// TO REMOVE MENUS FOR EDITOR
	add_action( 'admin_init', function(){
 		
 		if( ! current_user_can('editor') ) return false;
 		
 		/* MAIN MENU ITEMS TO BE REMOVED */
 		$menu_arr = array(
 			'edit.php',						// Posts section
 			'plugins.php',					// Plugins section
 			'tools.php',					// Tools
 			'edit.php?post_type=acf',		// Custom fields
 			'mailchimp-for-wp',				// Mailchimp
 			'advanced-iframe.php',			// Advanced Iframe
 			'aiowpsec',						// WP SECURITY
 			'wpdatatables-administration'	// WP Data Tables
 		);
 		
 		foreach( $menu_arr as $menu){ remove_menu_page( $menu ); }
 		
 		
 		/* SUB MENU ITEMS TO BE REMOVED */
 		
 		$sub_menu_arr = array(
 			array('themes.php', 'themes.php'	), 					// Themes section from Appearance
 			array('users.php', 'users.php'	),						// List of all users
 			array('users.php', 'user-new.php'),						// New user
 			array('options-general.php', 'options-writing.php'),	// Options for writing
 			array('options-general.php', 'options-media.php'),		// Options for media
 			array('options-general.php', 'options-discussion.php'),	// Options for media
 			array('options-general.php', 'options-permalink.php')	// Options for permalinks
 			
 		);
 		
 		foreach( $sub_menu_arr as $menu){ remove_submenu_page( $menu[0], $menu[1] );}
 		
 		// remove the theme editor option
 		remove_action('admin_menu', '_add_themes_utility_last', 101);
 		

 		
 	} );
 	
	
	
	
	add_filter('show_admin_bar', '__return_false');

  	function akvo_featured_img($post_id){
  		$post_type = get_post_type($post_id);
  		$img = wp_get_attachment_url(get_post_thumbnail_id($post_id));	
        			
		if(!$img && $post_type == 'video'){
    		/* featured image is not selected and the type is video */
        	$img = convertYoutubeImg(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
		}	
		return $img;
  	}
  
	
	add_action( 'admin_head', function(){
		echo '<style>
 			.siteorigin-panels-builder .so-builder-toolbar .so-switch-to-standard[style] { display: none !important; }
 		</style>';
	} ); 
	
	/* remove unnecessary code */
 	// Disable REST API link tag
 	remove_action('wp_head', 'rest_output_link_wp_head', 10);
 
 	// Disable oEmbed Discovery Links
 	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
 
 	// Disable REST API link in HTTP headers
 	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 	
 	// Diable wp emoji
 	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 	remove_action( 'wp_print_styles', 'print_emoji_styles' );
 	
 	
 	
 	
 	
 	
 	
 	
 	
	
	// Allow iframe tags within editor
	add_filter('wp_kses_allowed_html', function($multisite_tags){
		
		$multisite_tags['iframe'] = array(
			'src' => true,
			'width' => true,
			'height' => true,
			'align' => true,
			'class' => true,
			'name' => true,
			'id' => true,
			'frameborder' => true,
			'seamless' => true,
			'srcdoc' => true,
			'sandbox' => true,
			'allowfullscreen' => true
		);
		return $multisite_tags;
	
	}, 1);
	
	
	
	function convertYoutubeImg($string) {
  		return preg_replace(
    		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
    		"http://i1.ytimg.com/vi/$2/mqdefault.jpg",
    		$string
  		);
	}

	function convertYoutube($string) {
  		return preg_replace(
      		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      		"<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
      		$string
    	);
	}
	
	function truncate($string, $length, $stopanywhere=false) {
    	//truncates a string to a certain char length, stopping on a word if not specified otherwise.
    	if (strlen($string) > $length) {
        	//limit hit!
        	$string = substr($string,0,($length -3));
        	if ($stopanywhere) {
            	//stop anywhere
            	$string .= '...';
        	} else{
            	//stop on a word.
            	$string = substr($string,0,strrpos($string,' ')).'...';
        	}
    	}
    	return $string;
	}
	
	function show_flickr($id,$handle) {
  		$output = "<style>.embed-container { position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden; max-width: 100%; height: auto; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>";
  		$output .= "<div class='flickr'><div class='embed-container'><iframe src='https://www.flickr.com/photos/";
  		$output .= $handle;
  		$output .= "/sets/";
  		$output .= $id;
  		$output .= "/player/' frameborder='0' allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe></div></div>";
  		return $output;
	}