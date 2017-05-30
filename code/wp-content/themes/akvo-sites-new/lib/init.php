<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
 	function setup() {
 		
  		/* Make theme available for translation. Community translations can be found at https://github.com/roots/sage-translations */
		load_theme_textdomain('sage', get_template_directory() . '/lang');
		
		/* Enable plugins to manage the document title. http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag */
		add_theme_support('title-tag');
		
		/* Register wp_nav_menu() menus. http://codex.wordpress.org/Function_Reference/register_nav_menus */
  		
  		register_nav_menus([
    		'primary_navigation' => __('Primary Navigation', 'sage')
  		]);

		/* Add post thumbnails */
		add_theme_support('post-thumbnails');
		
		/* Add post formats */
  		add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

		/* Add HTML5 markup for captions */
		add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);
	}
	add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
 	function widgets_init() {
		register_sidebar([
    		'name'          => __('Footer Col-1', 'sage'),
    		'id'            => 'sidebar-footer-1',
		    'before_widget' => '<section class="widget %1$s %2$s">',
		    'after_widget'  => '</section>',
		    'before_title'  => '<h3>',
		    'after_title'   => '</h3>'
		]);

		register_sidebar([
    		'name'          => __('Footer Col-2', 'sage'),
    		'id'            => 'sidebar-footer-2',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		]);
		
		
		register_sidebar([
    		'name'          => __('Footer Col-3', 'sage'),
    		'id'            => 'sidebar-footer-3',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		]);
		
		register_sidebar([
    		'name'          => __('Footer Last Col', 'sage'),
    		'id'            => 'sidebar-footer-4',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		]);
		
		register_sidebar([
        	'name' => __( 'Sub header', 'theme-slug' ),
          	'id' => 'sub-header',
          	'description' => __( 'Widgets Sidebar.', 'sage' ),
          	'before_widget' => '<div id="%1$s" class="widget %2$s">',
          	'after_widget'  => '</div>',
          	'before_title'  => '<h2 class="widgettitle">',
          	'after_title'   => '</h2>',
    	]);
    	
    	register_sidebar([
        	'name' 			=> __( 'Replace Search Bar', 'theme-slug' ),
          	'id' 			=> 'replace-search',
          	'description' 	=> __( 'Widgets that would replace the search bar in the header', 'sage' ),
          	'before_widget' => '<div id="%1$s" class="widget %2$s">',
          	'after_widget'  => '</div>',
          	'before_title'  => '<h2 class="widgettitle">',
          	'after_title'   => '</h2>',
    	]);
		
		/*
		register_sidebar([
			'name'          => __('Homepage row 1', 'sage'),
			'id'            => 'sidebar-homepage1'
		]);
		register_sidebar([
			'name'          => __('Homepage row 2', 'sage'),
			'id'            => 'sidebar-homepage2'
		]);
		*/
	}
	add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
