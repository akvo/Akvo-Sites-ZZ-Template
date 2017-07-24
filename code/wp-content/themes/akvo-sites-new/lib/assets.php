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
	
	

	function assets() {
		
		
		
  		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, null);
  		wp_enqueue_style('sage_css', asset_path('styles/main.css'), false, '2.0.7');
  		wp_enqueue_style( 'opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic', false, null);

  		$font_face[] = get_theme_mod('akvo_font');
  		$font_face[] = get_theme_mod('akvo_font_head');
  		$font_face[] = get_theme_mod('akvo_font_nav');

		if (in_array('Roboto', $font_face )) wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic', false, null);
		if (in_array('Lora', $font_face )) wp_enqueue_style( 'lora', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic', false, null);
		if (in_array('Raleway', $font_face )) wp_enqueue_style( 'raleway', '//fonts.googleapis.com/css?family=Raleway:400,700', false, null);
		if (in_array('Merriweather', $font_face )) wp_enqueue_style( 'Merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic', false, null);
		if (in_array('Arvo', $font_face )) wp_enqueue_style( 'Arvo', '//fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic', false, null);
		if (in_array('Muli', $font_face )) wp_enqueue_style( 'Muli', '//fonts.googleapis.com/css?family=Muli:400,400italic', false, null);
		if (in_array('Nunito', $font_face )) wp_enqueue_style( 'Nunito', '//fonts.googleapis.com/css?family=Nunito:400,700', false, null);
		if (in_array('Alegreya', $font_face )) wp_enqueue_style( 'Alegreya', '//fonts.googleapis.com/css?family=Alegreya:400italic,700italic,400,700', false, null);
		if (in_array('Exo 2', $font_face )) wp_enqueue_style( 'Exo2', '//fonts.googleapis.com/css?family=Exo+2:400,400italic,700,700italic', false, null);
		if (in_array('Crimson Text', $font_face )) wp_enqueue_style( 'Crimson', '//fonts.googleapis.com/css?family=Crimson+Text:400,400italic,700,700italic', false, null);
		if (in_array('Lobster Two', $font_face )) wp_enqueue_style( 'Lobster', '//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic', false, null);
		if (in_array('Maven Pro', $font_face )) wp_enqueue_style( 'Maven', '//fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900', false, null);
		
		if (is_single() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
		
		//print_r(asset_path('scripts/bootstrap.min.js'));
		
		//wp_enqueue_script( 'jquery' );
		//wp_enqueue_script('modernizr', asset_path('scripts/modernizr.js'), [], null, true);
		wp_enqueue_script('bootstrap_js', asset_path('scripts/bootstrap.min.js'), ['jquery'], '1.0.1', true);
		
		wp_enqueue_script('akvo_js', asset_path('scripts/main.js'), ['jquery'], "1.0.3", true);
		
		
	}
	add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);