<?php


	function akvo_filter_customize_register( $wp_customize ) {
		
		$wp_customize->add_panel('akvo_filter_panel', array(
			'priority' => 30,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Filter Widget', 'sage' ),
			'description' => __( '', 'sage' ),
		) );
		
		/* LABELS SECTION */
		$wp_customize->add_section('akvo_filter_section' , array(
	    	'title'       	=> __( 'Labels', 'sage' ),
		    'priority'    	=> 30,
		    'description' 	=> '',
		    'panel'			=> 'akvo_filter_panel'
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
		/* END OF LABELS SECTION */
		
		
		
		$post_types = array(
			'map' 			=> array('languages', 'countries', 'map-types', 'map-category'), 
			'media'			=> array('languages', 'countries', 'types', 'media-category'), 
			'blog'			=> array('languages', 'countries', 'blog-category'), 
			'news'  		=> array('languages', 'countries', 'news-category'), 
			'testimonial'	=> array('languages', 'countries', 'testimonial-category'), 
			'video'			=> array('languages', 'countries', 'video-types', 'video-category')
		);
		
		foreach($post_types as $post_type => $slugs){
			
			$section_id = 'akvo_filter_'.$post_type.'section';
			
			
			/* EACH SEPERATE SECTION FOR POST TYPE */
			$wp_customize->add_section( $section_id, array(
	    		'title'       	=> __( 'Filters for '.$post_type, 'sage' ),
		    	'priority'    	=> 30,
		    	'description' 	=> '',
		    	'panel'			=> 'akvo_filter_panel'
			) );
			
			
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
      				'section'  => $section_id,
		      		'type'     => 'checkbox',
		      		'std' => 1
      			));
				
			}
		}
		
	}
	add_action( 'customize_register', 'akvo_filter_customize_register' );
	