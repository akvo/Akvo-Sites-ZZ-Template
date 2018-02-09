<?php
	
	add_action( 'wp_enqueue_scripts', function(){
		wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', false, '3.0' );
   		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), '1.0.0');	
	
	} );

	add_filter('akvo_fonts', function($fonts){
		
		$fonts[] = array(
			'slug'	=> 'klavikabold',
			'name'	=> 'KlavikaBold',
			'url'	=> get_stylesheet_directory_uri().'/fonts/Klavika-Bold.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'klavikalight',
			'name'	=> 'KLavikaLight',
			'url'	=> get_stylesheet_directory_uri().'/fonts/Klavika-Light.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'klavikaregular',
			'name'	=> 'KlavikaRegular',
			'url'	=> get_stylesheet_directory_uri().'/fonts/Klavika-Regular.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'klavikamedium',
			'name'	=> 'KlavikaMedium',
			'url'	=> get_stylesheet_directory_uri().'/fonts/Klavika-Medium.otf'
		);
		
		return $fonts;
		
		
	});