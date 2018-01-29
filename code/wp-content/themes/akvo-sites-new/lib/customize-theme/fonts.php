<?php

	/* CUSTOM FONTS */
	add_action( 'customize_register', function($wp_customize){
	
		// Fonts
		global $akvo_customize;
		
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_fonts_section', 'Google Fonts', 'Additional google fonts (max of 3)');
		
		for( $i = 1; $i <= 3; $i++ ){
			//$akvo_customize->text( $wp_customize, 'akvo_fonts_section', 'akvo_fonts[font'.$i.'][slug]', 'Slug for font '.$i, '');
			$akvo_customize->text( $wp_customize, 'akvo_fonts_section', 'akvo_fonts[font'.$i.'][label]', 'Label for font '.$i, '');
			$akvo_customize->text( $wp_customize, 'akvo_fonts_section', 'akvo_fonts[font'.$i.'][url]', 'URL for font '.$i, '');
		}
		
        /* END OF FONTS SECTION */
	
	} );
	
	add_filter( 'akvo_fonts', function( $fonts ){
		
		$akvo_fonts = get_option('akvo_fonts');
		
		foreach( $akvo_fonts as $font ){
			
			if( isset( $font['label'] ) && isset( $font['url'] ) ){
			
				$fonts[] = array(
					'slug'	=> sanitize_title( $font['label'] ),
					'name'	=> $font['label'],
					'url'	=> $font['url']
				);
			}
			
		}
		
		//print_r( $fonts ); wp_die();
		
		return $fonts;
		
	});
	