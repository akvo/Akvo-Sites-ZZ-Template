<?php
	
	add_action('customize_register', function($wp_customize){
		
		//Header
	    $wp_customize->add_section('sage_header_scheme', array(
    	  'title'    	=> __('Main Menu', 'sage'),
	      'description' => '',
    	  'priority' 	=> 30,
    	  'panel'		=> 'akvo_theme_panel'
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
    	
    	
    	
		
		
		
	}, 40);
	
	
	add_action( 'wp_head', function(){
		
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
		
		
	} );
	

  
  