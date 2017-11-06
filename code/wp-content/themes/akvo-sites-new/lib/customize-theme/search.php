<?php
	
	add_action('customize_register', function($wp_customize){
		
		global $akvo_customize;
		
		// ADD NEW SECTION
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_search_section', 'Search Options', '');
		
		// OPTION TO HIDE SEARCH BAR
		$akvo_customize->checkbox( $wp_customize, 'akvo_search_section', 'sage_header_options[hide_search]', 'Hide Search Bar' );
		
		// OPTION TO CHANGE PLACEHOLDER TEXT
		$akvo_customize->text( $wp_customize, 'akvo_search_section', 'sage_header_options[search_text]', 'Text for Search Placeholder:', 'Search ' . get_bloginfo('name'));	
		      	
      	
    }, 40);
	
	

  
  