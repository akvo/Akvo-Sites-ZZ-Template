<?php

	add_action('wp_enqueue_scripts', function(){
		
		global $akvo;
		
  		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, null);
  		wp_enqueue_style( 'sage_css', get_template_directory_uri().'/dist/styles/main.css', false, '2.1.2');
  		

		$font_face = $akvo->selected_fonts();
		
		$google_fonts = $akvo->fonts();
		
		// ENQUEUE FONTS THAT ARE SELECTED
		foreach( $google_fonts as $google_font ){
			if( in_array( $google_font['name'], $font_face ) ){
				wp_enqueue_style( $google_font['slug'], $google_font['url'], false, null);
			}
		}
		
		
		
		if (is_single() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
		
		
		wp_enqueue_script('bootstrap_js', get_template_directory_uri().'/dist/scripts/bootstrap.min.js', ['jquery'], '1.0.1', true);
		
		wp_enqueue_script('akvo_js', get_template_directory_uri().'/dist/scripts/main.js', ['jquery'], "1.0.3", true);
		
	}, 100);