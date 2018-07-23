<?php
/*
	Widget Name: Akvo Filters
	Description: Akvo Filters for WP Post Types
	Author: Samuel Thomas, Akvo
	Author URI: 
	Widget URI: 
	Video URI: 
*/

class Akvo_Filters_Widget extends SiteOrigin_Widget {
	
	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'akvo-filters',

			// The name of the widget for display purposes.
			__('Akvo Filters', 'siteorigin-widgets'),

			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Akvo Filters - filtering options for WP Post Types', 'siteorigin-widgets'),
				'help'        => '',
			),

			//The $control_options array, which is passed through to WP_Widget
			array(),

			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'template' => array(
					'type' 		=> 'select',
					'label' 	=> __( 'Choose Template', 'siteorigin-widgets' ),
					'default' 	=> 'news',
					'options' 	=> array(
						'card'	=> 'Card',
						'list'	=> 'List'
					)
				),
				'post_type' => array(
					'type' 			=> 'select',
					'label' 		=> __( 'Choose Type', 'siteorigin-widgets' ),
					'default' 		=> 'news',
					'options' 		=> $this->get_types(),
					'description'	=> 'Choose from Wordpress Custom Post Types'
				),
				
				'posts_per_page' => array(
					'type' 			=> 'number',
					'label' 		=> __( 'Number of Items', 'siteorigin-widgets' ),
					'default' 		=> '3',
					'description'	=> 'Items per request to be shown'
				),
			),

			//The $base_folder path string.
			get_template_directory()."/so-widgets/akvo-cards"
		);
	}
	
	
	
	/* Wordpress Custom Post Types and RSR Data including projects and updates */
	function get_types(){
		global $akvo_filters;
		return $akvo_filters->get_types();
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
siteorigin_widget_register('akvo-filters', __FILE__, 'Akvo_Filters_Widget');