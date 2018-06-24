<?php
	
	add_action( 'wp_enqueue_scripts', function(){
		wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', false, '3.0.1' );
   		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), '2.0.0');	
	
	} );

    function oxfam_scripts(){
        wp_enqueue_script(
            'oxfam-script',
            get_stylesheet_directory_uri() . '/js/oxfam.js',
            array('jquery')
        );
    }
    add_action( 'wp_enqueue_scripts', 'oxfam_scripts');

    function flickr_photo(){
        wp_enqueue_script(
            'flickr-photo',
            get_stylesheet_directory_uri() . '/js/flickr.js',
            array('jquery')
        );
    }

    if ($_SERVER['REQUEST_URI'] === '/photo-gallery/')
    {
        add_action( 'wp_enqueue_scripts', 'flickr_photo');
    }

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
