<?php
	
	add_action( 'wp_enqueue_scripts', function(){
		wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', false, '3.0' );
   		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), '2.0.0');	
	
	} );

	add_filter('akvo_fonts', function($fonts){
		
		$fonts[] = array(
			'slug'	=> 'oxfambold',
			'name'	=> 'OxfamBold',
			'url'	=> get_stylesheet_directory_uri().'/fonts/TSTARPRO-Bold.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'oxfamlight',
			'name'	=> 'OxfamLight',
			'url'	=> get_stylesheet_directory_uri().'/fonts/TSTARPRO-Light.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'oxfamregular',
			'name'	=> 'OxfamRegular',
			'url'	=> get_stylesheet_directory_uri().'/fonts/TSTARPRO-Regular.otf'
		);
		
		$fonts[] = array(
			'slug'	=> 'oxfamheadline',
			'name'	=> 'OxfamHeadline',
			'url'	=> get_stylesheet_directory_uri().'/fonts/OxfamGlobalHeadline.ttf'
		);
		
		return $fonts;
		
		
	});