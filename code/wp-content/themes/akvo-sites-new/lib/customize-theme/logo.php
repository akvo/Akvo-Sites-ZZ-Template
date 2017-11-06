<?php

	
	add_action( 'customize_register', function($wp_customize){
	
		//logo
		$wp_customize->add_section( 'akvo_logo_section' , array(
	    	'title'       	=> __( 'Logo & Header Type', 'sage' ),
	    	'priority'    	=> 30,
	    	'description' 	=> 'Upload your logo',
	    	'panel'			=> 'akvo_theme_panel'
		) );
		
		/** LOGO IMAGE */ 
		$wp_customize->add_setting( 'akvo_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'akvo_logo', array(
	    	'label'    => __( 'Logo', 'sage' ),
	    	'section'  => 'akvo_logo_section',
	   		'settings' => 'akvo_logo',
		) ) );

		/** LOGO SIZE */ 
      	
      	$wp_customize->add_setting( 'akvo_logo_size' );
		
		$wp_customize->add_control('akvo_logo_size', array(
      		'settings' => 'akvo_logo_size',
      		'label'    => __('Use Original Logo Size'),
      		'section'  => 'akvo_logo_section',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
      	
      	/** LOGO LOCATION */ 
      	
      	$logo_location_arr = array(
      		'left'	=> 'Left',
      		'right'	=> 'Right'
      	);
      	
      	$wp_customize->add_setting( 'akvo_logo_location', array(
      		'default' 		=> 'left',
      		'transport'   	=> 'refresh',
      		'type' 			=> 'option'
      	)  );
		
		$wp_customize->add_control('akvo_logo_location', array(
      		'settings' 	=> 'akvo_logo_location',
      		'label'    	=> __('Logo location'),
      		'section'  	=> 'akvo_logo_section',
      		'type'     	=> 'select',
      		'choices' 	=> $logo_location_arr
      	));
      	
      	/** HEADER TYPE */
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
		    'section'  	=> 'akvo_logo_section',
		    'settings' 	=> 'sage_header_options[header_type]',
		    'choices' 	=> $headers_arr
		));
		
      	
	} );

