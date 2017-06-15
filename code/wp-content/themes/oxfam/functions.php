<?php
	
	add_action( 'wp_enqueue_scripts', function(){
		wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), '2.0.0');	
	
	} );

	add_filter('akvo_fonts', function($fonts){
		
		$oxfam_fonts = array('OxfamBold', 'OxfamLight', 'OxfamRegular', 'OxfamHeadline');
		
		foreach($oxfam_fonts as $font){
			$fonts[$font] = $font;
		}
		
		return $fonts;
		
		
	});