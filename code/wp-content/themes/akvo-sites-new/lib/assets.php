<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/dist/scripts/modernizr.js
 * 2. /theme/dist/scripts/main.js
 */
	
	/*
	class JsonManifest {
		private $manifest;
		
		public function __construct($manifest_path) {
			if (file_exists($manifest_path)) {
				$this->manifest = json_decode(file_get_contents($manifest_path), true);
			} 
			else {
				$this->manifest = [];
			}
		}

		public function get() {
			return $this->manifest;
		}

		public function getPath($key = '', $default = null) {
			$collection = $this->manifest;
			if (is_null($key)) {
    			return $collection;
    		}
			if (isset($collection[$key])) {
				return $collection[$key];
			}
			foreach (explode('.', $key) as $segment) {
				if (!isset($collection[$segment])) {
					return $default;
      			} else {
        			$collection = $collection[$segment];
      			}
    		}
    		return $collection;
  		}
	}
	
	
	
	function asset_path($filename) {
		$dist_path = get_template_directory_uri() . DIST_DIR;
		$directory = dirname($filename) . '/';
		$file = basename($filename);	
		
		static $manifest;

		if (empty($manifest)) {
			$manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
			$manifest = new JsonManifest($manifest_path);
		}

		if (array_key_exists($file, $manifest->get())) {
			return $dist_path . $directory . $manifest->get()[$file];
		} else {
			return $dist_path . $directory . $file;
		}
	}
	*/
	
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