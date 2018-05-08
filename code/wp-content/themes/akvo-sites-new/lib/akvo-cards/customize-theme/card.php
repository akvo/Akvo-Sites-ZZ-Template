<?php
	
	add_action( 'customize_register', function( $wp_customize ){
		
		global $akvo_customize;
		
		$akvo_customize->panel( $wp_customize, 'akvo_card_panel', 'Akvo Card Widget' );

		
		/* GENERAL THEME SECTION */
		
		$akvo_customize->section( $wp_customize, 'akvo_card_panel', 'akvo_card_section', 'General Theme', 'Customize styles for card widget');
		
		$colors = array(
			'akvo_card[bg]' 			=> array(
				'default' 				=> '#EEEEEE',
				'label'					=> 'Background'
			),
			'akvo_card[title_color]' 	=> array(
				'default' 				=> '#333333',
				'label'					=> 'Title Color'
			),
			'akvo_card[content_color]' 	=> array(
				'default' 				=> '#333333',
				'label'					=> 'Content Color'
			),
			'akvo_card[infobar_bg]' 	=> array(
				'default' 				=> '#54bce8',
				'label'					=> 'Infobar Background'
			),
			'akvo_card[infobar_color]' 	=> array(
				'default' 				=> '#ffffff',
				'label'					=> 'Infobar Font Color'
			)			
		);
		
		
		
		foreach( $colors as $color_id => $color ){
			
			$akvo_customize->color( $wp_customize, 'akvo_card_section', $color_id, $color['label'], $color['default'] );
			
		}
		
		$text_el = array(
			'akvo_card[title_font_size]' => array(
				'default' 	=> '24px',
				'label' 	=> 'Font size of title:',
			),
			'akvo_card[infobar_font_size]' => array(
				'default' 	=> '12px',
				'label' 	=> 'Font size of infobar:',
			),
			'akvo_card[content_font_size]' => array(
				'default' 	=> '14px',
				'label' 	=> 'Font size of content:',
			),	
			'akvo_card[border_radius]' => array(
				'default' 	=> '5px',
				'label' 	=> 'Border radius:',
			),	
		);
		
		foreach( $text_el as $id => $el){
			$akvo_customize->text( $wp_customize, 'akvo_card_section', $id, $el['label'], $el['default']);	
		}
		/* END OF THEME SECTION */
		
		
		/* HIDE ELEMENTS */
		$akvo_customize->section( $wp_customize, 'akvo_card_panel', 'akvo_card_hide_section', 'Hide Elements', '');
    	
    	$hide_el = array(
			'akvo_card[hide_card_title]'	=> 'Hide Widget Title',
			'akvo_card[hide_infobar]'		=> 'Hide Widget Infobar',
			'akvo_card[hide_content]'		=> 'Hide Widget Content'
		);
		
		foreach( $hide_el as $id => $label ){
			
			$akvo_customize->checkbox( $wp_customize, 'akvo_card_hide_section', $id, $label );
			
		}
		/* END OF HIDE ELEMENTS SECTION */
		
		/** EXTRAS SECTION */
		$akvo_customize->section( $wp_customize, 'akvo_card_panel', 'akvo_card_extras_section', 'Extras', '');
		
		$text_el = array(
			'akvo_card[akvoapp]' => array(
				'default' 	=> 'http://rsr.akvo.org',
				'label' 	=> 'Akvoapp URL:',
			),
			'akvo_card[read_more_text]' => array(
				'default' 	=> 'Read more',
				'label' 	=> 'Read More Text:',
			),
			
		);
		
		foreach( $text_el as $id => $el){
			$akvo_customize->text( $wp_customize, 'akvo_card_extras_section', $id, $el['label'], $el['default']);	
		}
		/* END OF EXTRAS SECTION */
		
		
		/* IMAGE SECTION */
		$akvo_customize->section( $wp_customize, 'akvo_card_panel', 'akvo_card_image_section', 'Image Styles', '');
		
		$akvo_customize->image( 													/* DEFAULT IMAGE */
			$wp_customize, 
			'akvo_card_image_section', 												// SECTION
			'akvo_card[bg_img]', 													// SETTINGS
			'Default Image', 														// LABEL
			get_bloginfo('template_url').'/dist/images/placeholder800x400.jpg'		// DEFAULT IMAGE
		);
		
		
		$akvo_card_obj = new Akvo_Card;
        $types = $akvo_card_obj->get_types(); 
        foreach($types as $type=>$label){	
			/* IMAGE HEIGHTS FOR EACH CUSTOM TYPE */
        	$akvo_customize->text( $wp_customize, 'akvo_card_image_section', 'akvo_card[bg_'.$type.'_height]', 'Image Height in '.$label.' :', '150px');	
		}
		/* END OF IMAGE SECTION */
	} );

	
	/** ADD CUSTOMISE CSS */
	add_action( 'akvo_sites_css', function(){
		
		$akvo_card = get_option('akvo_card');
		
		//print_r($akvo_card);
		
		if( isset( $akvo_card['hide_infobar'] ) && $akvo_card['hide_infobar'] ){
			$akvo_card['infobar_display'] = 'none';
		}
		
		if( isset( $akvo_card['hide_content'] ) && $akvo_card['hide_content'] ){
			$akvo_card['content_display'] = 'none';
		}
		
		if( isset( $akvo_card['hide_card_title'] ) && $akvo_card['hide_card_title'] ){
			$akvo_card['title_display'] = 'none';
		}
		
		$items = array(
			array(
				'selector'	=> '.card',
				'styles'	=> array(
					'background'	=> 'bg',
					'border-radius'	=> 'border_radius'
				)
			),
			array(
				'selector'	=> '.card .card-image',
				'styles'	=> array(
					'background-image'	=> 'bg_img',
				)
			),
			array(
				'selector'	=> '.card .card-info',
				'styles'	=> array(
					'background'	=> 'infobar_bg',
					'color'			=> 'infobar_color',
					'display'		=> 'infobar_display',
					'font-size'		=> 'infobar_font_size'
				)
			),
			array(
				'selector'	=> '.card .card-content',
				'styles'	=> array(
					'color'			=> 'content_color',
					'display'		=> 'content_display',
					'font-size'		=> 'content_font_size'
				)
			),
			array(
				'selector'	=> '.card .card-title',
				'styles'	=> array(
					'color'			=> 'title_color',
					'display'		=> 'title_display',
					'font-size'		=> 'title_font_size'
				)
			),
		);
		
		$akvo_card_obj = new Akvo_Card;
		$types = $akvo_card_obj->get_types(); 
		
		foreach($types as $type=>$label){ 
			
			$temp = array(
				'selector'	=> '.card.' . $type . ' .card-image',
				'styles'	=> array(
					'height'	=> 'bg_'.$type.'_height'
				)
			);
			
			array_push( $items, $temp );
			
		}
		
		
		global $akvo;
		$akvo->print_css( $akvo_card, $items );
		
		
		
	});

