<?php
	$sage_includes = [
  		//'lib/utils.php',                 	// Utility functions
  		'lib/akvo.class.php',				// Akvo Class
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
	
	
	add_action( 'admin_notices', function(){
	?>
		<div id="akvo-support-link" class="">
			<a target="_blank" href="http://sitessupport.akvo.org">Help</a>
		</div>
		<style>
			#akvo-support-link{
				font-size: 16px;
				background-color: #009900;
				color: #fff;
				position: fixed;
				right: -10px;
				padding: 8px 10px 10px;
				z-index:230;
				transform: rotate(270deg);
				top: 200px;
				border-top-left-radius: 5px;
				border-top-right-radius: 5px;
			}
			#akvo-support-link a[href]{
				color: inherit;
				text-decoration: none;
			}
		</style>
	<?php
	} );
	
	add_filter( 'contextual_help', function($old_help, $screen_id, $screen){
		$screen->remove_help_tabs();
    	return $old_help;
	}, 999, 3 );
	
	
	// REMOVE LINKS FROM TOP ADMIN BAR
	add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
		// REMOVE LOGO
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'new-post' );
		
		$wp_admin_bar->add_node(  array(
			'id'    => 'akvo-sites-support',
			'title' => 'Support',
			'href'  => 'http://sitessupport.akvo.org',
			'meta'  => array( 'class' => 'my-toolbar-page' )
		) );
	}, 999 );

	
	
	
	// TO REMOVE MENUS FOR EDITOR
	add_action( 'admin_init', function(){
 		
 		if( ! current_user_can('editor') ) return false;
 		
 		/* MAIN MENU ITEMS TO BE REMOVED */
 		$menu_arr = array(
 			'edit.php',					// Posts section
 			'plugins.php',				// Plugins section
 			'tools.php',				// Tools
 			'edit.php?post_type=acf',	// Custom fields
 			'mailchimp-for-wp',			// Mailchimp
 			'advanced-iframe.php',		// Advanced Iframe
 			'aiowpsec',					// WP SECURITY
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
  
	function custom_admin_css() {
 		echo '<style>
 			.siteorigin-panels-builder .so-builder-toolbar .so-switch-to-standard[style] { display: none !important; }
 		</style>';
	}
	add_action( 'admin_head', 'custom_admin_css' ); 
	
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
	function akvo_allow_multisite_tags( $multisite_tags ){
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
	}
	add_filter('wp_kses_allowed_html','akvo_allow_multisite_tags', 1);