<?php
	$sage_includes = [
  		'lib/utils.php',                 // Utility functions
  		'lib/init.php',                  // Initial theme setup and constants
  		'lib/conditional-tag-check.php', // ConditionalTagCheck class
  		'lib/config.php',                // Configuration
  		'lib/assets.php',                // Scripts and stylesheets
  		'lib/titles.php',                // Page titles
  		'lib/extras.php',                // Custom functions
  		'lib/custom-posts.php',          // Custom posts
  		'lib/custom-widgets.php',        // Custom widgets G!
  		'lib/bootstrap-nav-walker.php',        // BS Nav walker
  		'plugins/boxes.php',        // Custom input fields
  		'plugins/related.php',        // Related posts
  		'lib/customize-theme.php',        // Theme customizer
  		//'lib/taxonomies.php',             // Custom categories for eg media library
  		'lib/akvo-cards/main.php',        // Cards
  		'lib/akvo-carousel/main.php',     // Carousel
  		'lib/akvo-filters/main.php',      // Filters for post types
	];
	
	foreach ($sage_includes as $file) {
    	if (!$filepath = locate_template($file)) {
    	  	trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    	}
		require_once $filepath;
	}
	unset($file, $filepath);
	
	
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
	}

	add_action('customize_register', 'sage_customize_footer_register',40);

  function bwpy_customizer_head_styles() {
    $header_option = get_option('sage_header_options');
    $menu_bg_child = $header_option['bg_child_menu'];
    $menu_cl_child = $header_option['color_child_menu'];
    $menu_bg = $header_option['bg_menu'];
    $menu_cl = $header_option['color_menu'];
    $menu_bg_parent = $header_option['bg_parent_menu'];
    $menu_cl_parent = $header_option['color_parent_menu'];

    
    if($header_option != NULL){ ?>
    <style type="text/css">
      <?php if($menu_bg_child != "" || $menu_cl_child != ""){?>
      #menu-main-nav .menu-item .current-menu-item a,
      #menu-main-nav .menu-item .menu-item a:hover{
        <?php if($menu_bg_child != "") echo 'background: '.$menu_bg_child.';'?>
        <?php if($menu_cl_child != "") echo 'color: '.$menu_cl_child.';'?>
      }
      <?php } ?>
      <?php if($menu_bg != "" || $menu_cl != ""){?>
      nav ul.navbar-nav li a{
        <?php if($menu_bg != "") echo 'background: '.$menu_bg.';'?>
        <?php if($menu_cl != "") echo 'color: '.$menu_cl.';'?>
      }
      <?php } ?>
      <?php if($menu_bg_parent != "" || $menu_cl_parent != ""){?>
      nav ul.navbar-nav li:hover a,
      nav ul.navbar-nav li a:focus,
      nav ul.navbar-nav li.current-menu-item a{
        <?php if($menu_bg_parent != "") echo 'background: '.$menu_bg_parent.' !important;'?>
        <?php if($menu_cl_parent != "") echo 'color: '.$menu_cl_parent.' !important;'?>
      }
      <?php } ?>
    </style>
    <?php }

    
  }
  add_action( 'wp_head', 'bwpy_customizer_head_styles' );

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