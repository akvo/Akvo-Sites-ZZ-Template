<?php


	function akvo_filter_customize_register( $wp_customize ) {
		
		/* CARD SECTION */
		$wp_customize->add_section('akvo_filter_section' , array(
	    	'title'       => __( 'Filter Widget', 'akvo' ),
		    'priority'    => 30,
		    'description' => 'Select filter options',
		) );
		
		$wp_customize->add_setting('akvo_filter_btn_text', array(
			'default'	 => 'Apply Filters',
       		'capability' => 'edit_theme_options',
    	   	'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_filter_btn_text', array(
			'settings' => 'akvo_filter_btn_text',
    		'type' => 'text',
        	'label' => 'Text for apply filters button:',
	        'section' => 'akvo_filter_section',
    	));
    	
    	$wp_customize->add_setting('akvo_filter_default_text', array(
			'default'	 => 'Not Selected',
       		'capability' => 'edit_theme_options',
    	   	'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_filter_default_text', array(
			'settings' => 'akvo_filter_default_text',
    		'type' => 'text',
        	'label' => 'Text for filter - Not Selected:',
	        'section' => 'akvo_filter_section',
    	)); 
    	    
    	    
		/* LABEL FOR SLUGS */
		$slugs = array('languages', 'countries', 'map-types', 'map-category', 'types', 'media-category', 'blog-category', 'news-category', 'testimonial-category', 'video-types', 'video-category');
		
		foreach($slugs as $slug){
			$wp_customize->add_setting('akvo_filter_label['.$slug.']', array(
       			'capability' => 'edit_theme_options',
    	   		'type'       => 'option',
    		));
 		
			$wp_customize->add_control('akvo_filter_label['.$slug.']', array(
				'settings' => 'akvo_filter_label['.$slug.']',
    			'type' => 'text',
        		'label' => 'Label for '.$slug,
	        	'section' => 'akvo_filter_section',
    	    ));
		}
		
		
		
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
	