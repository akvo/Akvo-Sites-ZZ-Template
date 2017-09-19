<?php

	class Akvo{
		
		public $header_options;
		public $search_flag = true;
		
		
		function __construct(){
		
			// get header options
			$this->header_options = get_option('sage_header_options');
			
			if( ! is_array( $this->header_options ) ){
				
				$this->header_options = array();
				
			}
			
			// get search is enabled/disabled
			if($this->header_options && isset($this->header_options['hide_search']) && $this->header_options['hide_search']){
				$this->search_flag = false;
			}
			
			if($this->header_options && !isset($this->header_options['search_text'])){
				
				$this->header_options['search_text'] = "Search " . get_bloginfo("name");
				
			}
			
		}
		
		function selected_fonts(){
			
			// GET FONTS SELECTED THROUGH CUSTOMIZE
			$custom_akvo_fonts = array(
				'body'	=>  get_theme_mod('akvo_font'),
				'nav'	=> 	get_theme_mod('akvo_font_nav'),
				'head'	=> 	get_theme_mod('akvo_font_head')
			);
		
			$font_face = array();
		
			foreach( $custom_akvo_fonts as $font ){
				// CHECK IF FONT IS EMPTY
				if( count($font) ){
					$font_face[] = $font;
				}
			
			}
		
			// DEFAULT FONT IF NONE IS SELECTED THROUGH CUSTOMIZE
			if( ! count( $font_face ) ){
				$font_face[] = "Open Sans";
			}
			
			return $font_face;
		}
		
		function fonts(){
			
			$fonts_arr = array(
  				array(
  					'slug'	=> 'opensans',
	  				'name'	=> 'Open Sans',
  					'url'	=> '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic'
  				),
  				array(
  					'slug'	=> 'roboto',
	  				'name'	=> 'Roboto',
  					'url'	=> '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic'
  				),
  				array(
  					'slug'	=> 'lora',
	  				'name'	=> 'Lora',
  					'url'	=> '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic'
  				),
  				array(
  					'slug'	=> 'raleway',
	  				'name'	=> 'Raleway',
  					'url'	=> '//fonts.googleapis.com/css?family=Raleway:400,700'
  				),
	  			array(
  					'slug'	=> 'merriweather',
  					'name'	=> 'Merriweather',
  					'url'	=> '//fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic'
	  			),
  				array(
  					'slug'	=> 'arvo',
  					'name'	=> 'Arvo',
  					'url'	=> '//fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic'
	  			),
  				array(
  					'slug'	=> 'muli',
  					'name'	=> 'Muli',
  					'url'	=> '//fonts.googleapis.com/css?family=Muli:400,400italic'
	  			),
  				array(
  					'slug'	=> 'nunito',
  					'name'	=> 'Nunito',
  					'url'	=> '//fonts.googleapis.com/css?family=Nunito:400,700'
  				),
	  			array(
  					'slug'	=> 'alegreya',
  					'name'	=> 'Alegreya',
  					'url'	=> '//fonts.googleapis.com/css?family=Alegreya:400italic,700italic,400,700'
  				),
	  			array(
  					'slug'	=> 'exo2',
  					'name'	=> 'Exo 2',
  					'url'	=> '//fonts.googleapis.com/css?family=Exo+2:400,400italic,700,700italic'
	  			),
  				array(
  					'slug'	=> 'crimson',
  					'name'	=> 'Crimson Text',
  					'url'	=> '//fonts.googleapis.com/css?family=Crimson+Text:400,400italic,700,700italic'
	  			),
  				array(
  					'slug'	=> 'lobster',
  					'name'	=> 'Lobster Two',
  					'url'	=> '//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic'
  				),
	  			array(
  					'slug'	=> 'maven',
  					'name'	=> 'Maven Pro',
  					'url'	=> '//fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900'
  				),
	  		);
	  		
	  		$fonts_arr = apply_filters('akvo_fonts', $fonts_arr);
	  		
	  		return $fonts_arr;
	  		
		}
		
	}
	
	
	global $akvo;
	
	$akvo = new Akvo;