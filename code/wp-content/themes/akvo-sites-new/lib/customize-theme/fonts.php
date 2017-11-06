<?php

	
	add_action( 'customize_register', function($wp_customize){
	
		// Fonts
		global $akvo;
		$google_fonts = $akvo->fonts();
		
		$fonts_arr = array();
		
		foreach( $google_fonts as $google_font ){
			$fonts_arr[$google_font['name']] = $google_font['name'];
		}
		
		$wp_customize->add_section( 'akvo_font_section' , array(
	    	'title'       	=> __( 'Font', 'sage' ),
		    'priority'    	=> 30,
		    'description' 	=> 'Select site typography',
		    'panel'			=> 'akvo_theme_panel'
		) );
		$wp_customize->add_setting( 'akvo_font_head', array(
			'default' 	=> 'Open Sans',
		    'transport' => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font_head', array(
			'type' 		=> 'select',
		    'label'    	=> __( 'Header font', 'sage' ),
		    'section'  	=> 'akvo_font_section',
		    'settings' 	=> 'akvo_font_head',
		    'choices' 	=> $fonts_arr
		));
		$wp_customize->add_setting( 'akvo_font_nav', array(
	    	'default' 	=> 'Open Sans',
	     	'transport' => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font_nav', array(
			'type' 		=> 'select',
		    'label'    	=> __( 'Navigation font', 'sage' ),
		    'section'  	=> 'akvo_font_section',
		    'settings' 	=> 'akvo_font_nav',
		    'choices' 	=> $fonts_arr
		));
		$wp_customize->add_setting( 'akvo_font', array(
	    	 'default' 	=> 'Open Sans',
	     	'transport' => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font', array(
			'type' 		=> 'select',
		    'label'    	=> __( 'Body font', 'sage' ),
		    'section'  	=> 'akvo_font_section',
		    'settings' 	=> 'akvo_font',
		    'choices' 	=> $fonts_arr
		));

		//$wp_customize->remove_section( 'nav');
		$wp_customize->remove_section( 'static_front_page');
		
		/* ARTICLE SECTION */
		$wp_customize->add_section( 'article_section' , array(
	    	'title'       	=> __( 'Article (Single Posts)', 'sage' ),
		    'priority'    	=> 30,
		    'description' 	=> 'Select Article styles for single posts, akvopedia, etc',
		    'panel'			=> 'akvo_theme_panel'
		) );
		
		/* font size of the title */
		$wp_customize->add_setting( 'akvo_article[title_font_size]', array(
      		'default' => '24px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[title_font_size]', array(
			'settings' => 'akvo_article[title_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article title:',
        	'section' => 'article_section',
        ));
        
        /* font-size of the meta */
        $wp_customize->add_setting( 'akvo_article[meta_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[meta_font_size]', array(
			'settings' => 'akvo_article[meta_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article meta (date, etc):',
        	'section' => 'article_section',
        ));
        
        /* font-size of the content */
        $wp_customize->add_setting( 'akvo_article[content_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[content_font_size]', array(
			'settings' => 'akvo_article[content_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article content:',
        	'section' => 'article_section',
        ));
        
        /* END OF ARTICLE SECTION */
		
		
	
	} );

