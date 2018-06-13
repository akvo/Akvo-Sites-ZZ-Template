<?php
/*
	Widget Name: Akvo Cards
	Description: Akvo Cards Multiple Widget to pull RSR updates, projects or WP Post Types
	Author: Samuel Thomas, Akvo
	Author URI: 
	Widget URI: 
	Video URI: 
*/

class Akvo_Cards_Widget extends SiteOrigin_Widget {
	
	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'akvo-cards',

			// The name of the widget for display purposes.
			__('Akvo Cards Multiple', 'siteorigin-widgets'),

			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Akvo Cards Multiple Widget to pull RSR updates, projects or WP Post Types', 'siteorigin-widgets'),
				'help'        => '',
			),

			//The $control_options array, which is passed through to WP_Widget
			array(),

			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'template' => array(
					'type' => 'select',
					'label' => __( 'Choose Template', 'siteorigin-widgets' ),
					'default' => 'news',
					'options' => array(
						'card'	=> 'Card',
						'list'	=> 'List'
					)
				),
				'type' => array(
					'type' => 'select',
					'label' => __( 'Select Type', 'siteorigin-widgets' ),
					'default' => 'news',
					'options' => $this->get_types()
				),
				'pagination' => array(
					'type' 		=> 'checkbox',
					'label' 	=> __( 'Enable Lazy Loading / Pagination', 'siteorigin-widgets' ),
					'default' 	=> false
				),
				'posts_per_page' => array(
					'type' 		=> 'number',
					'label' 	=> __( 'Number of Items to be shown', 'siteorigin-widgets' ),
					'default' 	=> '3'
				),
				'rsr-id' => array(
					'type' => 'text',
					'label' => __( 'RSR ID (from data-feed - only for RSR Updates or Projects)', 'siteorigin-widgets' ),
					'default' => 'rsr'
				),
				'type-text' => array(
					'type' 		=> 'text',
					'label' 	=> __( 'Custom Tag (such as news, blog, etc)', 'siteorigin-widgets' ),
					'default' 	=> ''
				),
				'filter_taxonomy' => array(
					'type' => 'select',
					'label' => __( 'Filter by taxonomy', 'siteorigin-widgets' ),
					'default' => 'none',
					'options' => $this->get_taxonomies()
				),
				'filter_value' => array(
					'type' 		=> 'text',
					'label' 	=> __( 'Filter by value', 'siteorigin-widgets' ),
					'default' 	=> ''
				),
			),

			//The $base_folder path string.
			get_template_directory()."/so-widgets/akvo-cards"
		);
	}
	
	function get_taxonomies(){
		
		global $akvo_card;
		
		$tax_arr = array('none' => 'None');
		
		$taxonomies = $akvo_card->get_taxonomies();
			
		foreach( $taxonomies as $slug => $tax ){
			$tax_arr[ $slug ] = $slug;
		}
		
		return $tax_arr;
		
	}
	
	function get_types(){
		global $akvo_card;
		return $akvo_card->get_types();
	}
	
	function get_template_name($instance) {
		return 'template';
	}

	function get_template_dir($instance) {
		return 'templates';
	}

    function get_style_name($instance) {
        return '';
    }
}
siteorigin_widget_register('akvo-cards', __FILE__, 'Akvo_Cards_Widget');