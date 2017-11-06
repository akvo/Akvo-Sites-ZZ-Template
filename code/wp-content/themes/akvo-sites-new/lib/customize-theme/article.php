<?php

	/* ARTICLE SECTION */
	add_action( 'customize_register', function($wp_customize){
	
		// Fonts
		global $akvo_customize;
		
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_article_section', 'Article (Single Posts)', 'Customize styles for Article');
		
		$text_el = array(
			'akvo_article[title_font_size]' => array(	/* font size of the title */
				'default' 	=> '24px',
				'label' 	=> 'Font size of the article title:',
			),
			'akvo_article[meta_font_size]' 	=> array(	/* font-size of the meta */
				'default' 	=> '16px',
				'label' 	=> 'Font size of the article meta (date, etc):',
			),
			'akvo_article[content_font_size]' => array(	/* font-size of the content */
				'default' 	=> '16px',
				'label' 	=> 'Font size of the article content:',
			)		
		);
		
		foreach( $text_el as $id => $el ){
			$akvo_customize->text( $wp_customize, 'akvo_article_section', $id, $el['label'], $el['default']);
		}
		
		
        
        /* END OF ARTICLE SECTION */
		
		
	
	} );

