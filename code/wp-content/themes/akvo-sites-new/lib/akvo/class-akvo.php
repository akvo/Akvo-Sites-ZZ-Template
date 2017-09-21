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
			
			/* CUSTOM IMAGE SIZES */
			add_action( 'after_setup_theme', function(){
		
				add_image_size( 'thumb-small', 224, 126, true ); // Hard crop to exact dimensions (crops sides or top and bottom)
    			add_image_size( 'thumb-medium', 320, 180, true ); 
    			add_image_size( 'thumb-large', 640, 360, true );
    			add_image_size( 'thumb-xlarge', 960, 540, true );
		
			} );
			
			/* SUPPORT LINK */
			add_action( 'admin_notices', function(){
				include "templates/support.php";
			} );
	
			/* REMOVE SUPPORT LINK */
			add_filter( 'contextual_help', function($old_help, $screen_id, $screen){
				$screen->remove_help_tabs();
    			return $old_help;
			}, 999, 3 );
	
	
			// REMOVE LINKS FROM TOP ADMIN BAR
			add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
				// REMOVE LOGO
				$wp_admin_bar->remove_node( 'wp-logo' );
				$wp_admin_bar->remove_node( 'new-post' );
		
				$wp_admin_bar->add_node(  array(
					'id'    => 'akvo-sites-support',
					'title' => 'Support',
					'href'  => 'http://sitessupport.akvo.org',
					'meta'  => array( 'class' => 'my-toolbar-page' )
				) );
			}, 999 );
			
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
		
		function register_taxonomy($slug, $plural_label, $singular_label, $post_types){
	
			$args = array(
				'labels' => array(
					'name'                       => _x( $plural_label, 'Taxonomy General Name', 'text_domain' ),
					'singular_name'              => _x( $singular_label, 'Taxonomy Singular Name', 'text_domain' ),
					'menu_name'                  => __( $plural_label, 'text_domain' ),
					'all_items'                  => __( 'All Items', 'text_domain' ),
					'parent_item'                => __( 'Parent Item', 'text_domain' ),
					'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
					'new_item_name'              => __( 'New Item Name', 'text_domain' ),
					'add_new_item'               => __( 'Add New Item', 'text_domain' ),
					'edit_item'                  => __( 'Edit Item', 'text_domain' ),
					'update_item'                => __( 'Update Item', 'text_domain' ),
					'view_item'                  => __( 'View Item', 'text_domain' ),
					'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
					'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
					'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
					'popular_items'              => __( 'Popular Items', 'text_domain' ),
					'search_items'               => __( 'Search Items', 'text_domain' ),
					'not_found'                  => __( 'Not Found', 'text_domain' ),
				),
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
			);
			register_taxonomy($slug, $post_types, $args );
		}
		
		function register_post_type($slug, $plural_label, $singular_label, $menu_icon, $exclude_from_search = false){
			
			register_post_type($slug, array(
      			'labels' => array('name' => __( $plural_label ), 'singular_name' => __( $singular_label )),
      			'public' 				=> true,
      			'has_archive' 			=> true,
      			'menu_position' 		=> 20,
      			'menu_icon' 			=> $menu_icon,
      			'exclude_from_search' 	=> $exclude_from_search,
      			'supports' 				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    		));
		}
		
	}
	
	
	global $akvo;
	
	$akvo = new Akvo;