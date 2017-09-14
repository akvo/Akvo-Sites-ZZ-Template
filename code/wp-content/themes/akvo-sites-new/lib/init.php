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

