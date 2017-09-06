<?php
	$sage_includes = [
  		//'lib/utils.php',                 	// Utility functions
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
 	
	
	
	class Akvo{
		
		public $header_options;
		public $search_flag = true;
		
		
		function __construct(){
		
			// get header options
			$this->header_options = get_option('sage_header_options');
			
			if( ! is_array( $this->header_options ) ){
				
				$this->header_options = array();
				
			}
			
			// get search is enabled/disabled
			if($this->header_options && isset($this->header_options['hide_search']) && $this->header_options['hide_search']){
				$this->search_flag = false;
			}
			
			if($this->header_options && !isset($this->header_options['search_text'])){
				
				$this->header_options['search_text'] = "Search " . get_bloginfo("name");
				
			}
			
		}
		
		
	}
	
	global $akvo;
	
	$akvo = new Akvo;
	
	function sage_customize_footer_register($wp_customize){

		//Header
	    $wp_customize->add_section('sage_header_scheme', array(
    	  'title'    => __('Header', 'sage'),
	      'description' => '',
    	  'priority' => 30,
      	));

	    // add color picker setting
    	$wp_customize->add_setting( 'sage_header_options[bg_menu]', array(
	      'default' => '',
    	  'type'    => 'option',
	      ) );

    	// add color picker control
	    $wp_customize->add_control( 
			new WP_Customize_Color_Control( 
				$wp_customize, 'menu_color_bg', array(
		    		'label' => 'Background Item Menu',
					'section' => 'sage_header_scheme',
          			'settings' => 'sage_header_options[bg_menu]',
          ) ) );

	    // add color picker setting
    	$wp_customize->add_setting( 'sage_header_options[color_menu]', array(
      		'default' => '',
		      'type'    => 'option',
      	) );

	    // add color picker control
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'menu_color', array(
		          'label' => 'Color Item Menu',
        		  'section' => 'sage_header_scheme',
		          'settings' => 'sage_header_options[color_menu]',
    	) ) );

	    // add color picker setting
    	$wp_customize->add_setting( 'sage_header_options[bg_parent_menu]', array(
      		'default' => '',
		      'type'    => 'option',
      	) );

    	// add color picker control
	    $wp_customize->add_control( 
    		new WP_Customize_Color_Control( 
		        $wp_customize, 'menu_parent_color_bg', array(
        		  'label' => 'Background Active Item Menu Parent',
		          'section' => 'sage_header_scheme',
		          'settings' => 'sage_header_options[bg_parent_menu]',
          ) ) );

	    // add color picker setting
    	$wp_customize->add_setting( 'sage_header_options[color_parent_menu]', array(
	      'default' => '',
    	  'type'    => 'option',
      	) );

	    // add color picker control
    	$wp_customize->add_control( 
	      new WP_Customize_Color_Control( 
    	    $wp_customize, 'menu_parent_color', array(
        	  'label' => 'Color Active Item Menu Parent',
	          'section' => 'sage_header_scheme',
    	      'settings' => 'sage_header_options[color_parent_menu]',
          ) ) );

			// add color picker setting
		$wp_customize->add_setting( 'sage_header_options[bg_child_menu]', array(
			'default' => '',
			'type'    => 'option',
		) );

		// add color picker control
		$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'menu_child_color_bg', array(
          			'label' => 'Background Active Item Menu Children',
          			'section' => 'sage_header_scheme',
          			'settings' => 'sage_header_options[bg_child_menu]',
    	) ) );

		// add color picker setting
		$wp_customize->add_setting( 'sage_header_options[color_child_menu]', array(
    		'default' => '',
    		'type'    => 'option',
    	) );

		// add color picker control
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
				$wp_customize, 'menu_child_color', array(
    				'label' => 'Color Active Item Menu Children',
    				'section' => 'sage_header_scheme',
    				'settings' => 'sage_header_options[color_child_menu]',
    	) ) );
    	
    	
    	$wp_customize->add_setting('sage_header_options[hide_search]', array(
			'default' => 0,
      		'capability' => 'edit_theme_options',
      		'type'       => 'option',
      	));
		
		$wp_customize->add_control('sage_header_options[hide_search]', array(
      		'settings' => 'sage_header_options[hide_search]',
      		'label'    => __('Hide Search Bar'),
      		'section'  => 'sage_header_scheme',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
      	
      	$wp_customize->add_setting('sage_header_options[search_text]', array(
			'default'	 => 'Search ' . get_bloginfo('name'),
       		'capability' => 'edit_theme_options',
    	   	'type'       => 'option',
    	   	'transport'	 => 'refresh',
    	));
 		
		$wp_customize->add_control('sage_header_options[search_text]', array(
			'settings' => 'sage_header_options[search_text]',
    		'type' => 'text',
        	'label' => 'Text for Search Placeholder:',
	        'section' => 'sage_header_scheme',
    	)); 
      	
      	$headers_arr = array(
			'header1' => 'Default',
			'header2' => 'Sticky',
			'header3' => 'Narrow Single Row'
	    );
    	
    	$wp_customize->add_setting( 'sage_header_options[header_type]', array(
	    	'default' 	=> 'header1',
	    	'type'		=> 'option',
			'transport' => 'refresh',
		));
		$wp_customize->add_control( 'sage_header_options[header_type]', array(
			'type' 		=> 'select',
		    'label'    	=> __( 'Header Type', 'sage' ),
		    'section'  	=> 'sage_header_scheme',
		    'settings' 	=> 'sage_header_options[header_type]',
		    'choices' 	=> $headers_arr
		));
	}

	add_action('customize_register', 'sage_customize_footer_register',40);

  function bwpy_customizer_head_styles() {
    $header_option = get_option('sage_header_options');
    
	if($header_option != NULL):?>
    <style type="text/css">
      
      #menu-main-nav .menu-item .current-menu-item a, #menu-main-nav .menu-item .menu-item a:hover{
        <?php if(isset($header_option['bg_child_menu']) && $header_option['bg_child_menu'] != "") echo 'background: '.$header_option['bg_child_menu'].';'?>
        <?php if(isset($header_option['color_child_menu']) && $header_option['color_child_menu'] != "") echo 'color: '.$header_option['color_child_menu'].';'?>
      }
      
      nav ul.navbar-nav li a{
        <?php if(isset($header_option['bg_menu']) && $header_option['bg_menu'] != "") echo 'background: '.$header_option['bg_menu'].';'?>
        <?php if(isset($header_option['color_menu']) && $header_option['color_menu'] != "") echo 'color: '.$header_option['color_menu'].';'?>
      }
      
      nav ul.navbar-nav li:hover a,nav ul.navbar-nav li a:focus,nav ul.navbar-nav li.current-menu-item a{
        <?php if(isset($header_option['bg_parent_menu']) && $header_option['bg_parent_menu'] != "") echo 'background: '.$header_option['bg_parent_menu'].' !important;'?>
        <?php if(isset($header_option['color_parent_menu']) && $header_option['color_parent_menu'] != "") echo 'color: '.$header_option['color_parent_menu'].' !important;'?>
      }
      
    </style>
    <?php endif;

    
  }
  add_action( 'wp_head', 'bwpy_customizer_head_styles' );
  
  
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