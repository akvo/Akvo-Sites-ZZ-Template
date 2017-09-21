<?php

	add_action( 'init', function(){
		
		global $akvo;
		
		$akvo->register_taxonomy('languages', 'Languages', 'Language', array('map', 'media', 'blog', 'news', 'video', 'testimonial'));
		$akvo->register_taxonomy('countries', 'Locations', 'Location', array('map', 'media', 'blog', 'news', 'video', 'testimonial'));
		
		/* TYPES */
		$akvo->register_taxonomy('types', 'Types', 'Type', array('media'));
		$akvo->register_taxonomy('map-types', 'Types', 'Type', array('map'));
		$akvo->register_taxonomy('video-types', 'Types', 'Type', array('video'));
		
		/* CATEGORY */
		$akvo->register_taxonomy('media-category', 'Categories', 'Category', array('media'));
		$akvo->register_taxonomy('map-category', 'Categories', 'Category', array('map'));
		$akvo->register_taxonomy('blog-category', 'Categories', 'Category', array('blog'));
		$akvo->register_taxonomy('news-category', 'Categories', 'Category', array('news'));
		$akvo->register_taxonomy('video-category', 'Categories', 'Category', array('video'));
		$akvo->register_taxonomy('testimonial-category', 'Categories', 'Category', array('testimonial'));
		
		/* REGISTER POST TYPES */
		$akvo->register_post_type('blog', 'Blog posts', 'Blog post', 'dashicons-calendar-alt');
		$akvo->register_post_type('news', 'News', 'News', 'dashicons-format-aside');
		$akvo->register_post_type('video', 'Videos', 'Video', 'dashicons-media-video');
		$akvo->register_post_type('media', 'Media Library', 'Media Item', 'dashicons-book');
		$akvo->register_post_type('testimonial', 'Testimonials', 'Testimonial', 'dashicons-megaphone');
		$akvo->register_post_type('map', 'Maps', 'Map', 'dashicons-location-alt');
		$akvo->register_post_type('carousel', 'Carousel', 'Carousel slide', 'dashicons-images-alt', true);
		$akvo->register_post_type('flow', 'Akvo Flow', 'Flow item', 'dashicons-welcome-widgets-menus');
		
	} );