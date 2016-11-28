<?php


	function akvo_filter_customize_register( $wp_customize ) {
		
		/* CARD SECTION */
		$wp_customize->add_section('akvo_filter_section' , array(
	    	'title'       => __( 'Filter Widget', 'akvo' ),
		    'priority'    => 30,
		    'description' => 'Select filter options',
		) );
		
		
		$post_types = array(
			'map' 			=> array('languages', 'countries', 'map-types', 'map-category'), 
			'media'			=> array('languages', 'countries', 'types', 'media-category'), 
			'blog'			=> array('languages', 'countries', 'blog-category'), 
			'news'  		=> array('languages', 'countries', 'news-category'), 
			'testimonial'	=> array('languages', 'countries', 'testimonial-category'), 
			'video'			=> array('languages', 'countries', 'video-types', 'video-category')
		);
		
		foreach($post_types as $post_type => $slugs){
			foreach($slugs as $slug){
				
				$wp_customize->add_setting('akvo_filter['.$post_type.']['.$slug.']', array(
					'default' => 0,
		      		'capability' => 'edit_theme_options',
      				'type'       => 'option',
		      	));
				
				
				$label = "Enable ".$slug." for ".$post_type;
				
				$wp_customize->add_control('akvo_filter['.$post_type.']['.$slug.']', array(
      				'settings' => 'akvo_filter['.$post_type.']['.$slug.']',
		      		'label'    => $label,
      				'section'  => 'akvo_filter_section',
		      		'type'     => 'checkbox',
		      		'std' => 1
      			));
				
			}
		}
		
	}
	add_action( 'customize_register', 'akvo_filter_customize_register' );
	