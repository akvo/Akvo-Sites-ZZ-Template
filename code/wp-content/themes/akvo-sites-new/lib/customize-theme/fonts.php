<?php

	
	add_action( 'customize_register', function($wp_customize){
		
		global $akvo, $akvo_customize;
		
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_font_section', 'Font Family', 'Select site typography');
		
		// Fonts
		
		$google_fonts = $akvo->fonts();
		
		$fonts_arr = array();
		
		foreach( $google_fonts as $google_font ){
			$fonts_arr[$google_font['name']] = $google_font['name'];
		}
		
		
		$font_locations = array(
			'akvo_font_head'	=> 'Header Font',
			'akvo_font_nav'		=> 'Navigation Font',
			'akvo_font'			=> 'Body Font'
		);
		
		
		foreach( $font_locations as $location_id => $label ){
			$akvo_customize->dropdown( $wp_customize, 'akvo_font_section', $location_id, $label, 'Open Sans', $fonts_arr);
		}
		
		
		//$wp_customize->remove_section( 'nav');
		$wp_customize->remove_section( 'static_front_page');
		
		
		
		
	
	} );

