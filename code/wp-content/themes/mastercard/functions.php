<?php

	add_action( 'wp_enqueue_scripts', function(){
		//wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', false, '3.0.1' );
   	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('sage_css'), '1.0.0');

	} );

	add_filter('akvo_fonts', function($fonts){

		$markFonts = array(
			'MarkForMCExtraLt',
			//'MarkForMCExtraLtIt',
			//'MarkForMCLt',
			//'MarkForMCLtIt',
			//'MarkForMCBook',
			//'MarkForMCBookIt',
			'MarkForMCMed',
			//'MarkForMCMedIt.ttf',
			//'MarkForMCBold.ttf',
			//'MarkForMCBoldIt'
		);

		foreach( $markFonts as $markFont ){
			$fonts[] = array(
				'slug'	=> $markFont,
				'name'	=> $markFont,
				'url'	=> get_stylesheet_directory_uri().'/fonts/'.$markFont.'.ttf'
			);
		}

		return $fonts;
});
