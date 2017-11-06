<?php
	
	add_action('customize_register', function($wp_customize){
		
		//Header
	    $wp_customize->add_section('akvo_search', array(
    	  'title'    	=> __('Search Options', 'sage'),
	      'description' => '',
    	  'priority' 	=> 30,
    	  'panel'		=> 'akvo_theme_panel'
      	));

	    $wp_customize->add_setting('sage_header_options[hide_search]', array(
			'default' => 0,
      		'capability' => 'edit_theme_options',
      		'type'       => 'option',
      	));
		
		$wp_customize->add_control('sage_header_options[hide_search]', array(
      		'settings' => 'sage_header_options[hide_search]',
      		'label'    => __('Hide Search Bar'),
      		'section'  => 'akvo_search',
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
	        'section' => 'akvo_search',
    	)); 
      	
    }, 40);
	
	

  
  