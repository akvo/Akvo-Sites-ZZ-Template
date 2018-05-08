<?php
	
	add_action( 'customize_register', function( $wp_customize ){
		
		global $akvo_customize;
		
		$panel = 'akvo_list_panel';
		
		
		
		$akvo_customize->panel( $wp_customize, $panel, 'Akvo List Widget' );

		
		/* GENERAL THEME SECTION */
		
		$akvo_customize->section( $wp_customize, $panel, 'akvo_list_section', 'General Theme', 'Customize background and foreground color for list widget');
		
		$colors = array(
			'akvo_list[bg]' 			=> array(
				'default' 				=> '#EEEEEE',
				'label'					=> 'Background'
			),
			'akvo_list[title_color]' 	=> array(
				'default' 				=> '#333333',
				'label'					=> 'Title Color'
			),
			'akvo_list[content_color]' 	=> array(
				'default' 				=> '#333333',
				'label'					=> 'Content Color'
			),
			'akvo_list[border_color]' 	=> array(
				'default' 				=> '#CCCCCC',
				'label'					=> 'Border Color'
			),
			'akvo_list[badge_bg]' 		=> array(
				'default' 				=> '#CCCCCC',
				'label'					=> 'Background of Badge'
			),
			'akvo_list[badge_color]' 	=> array(
				'default' 				=> '#FFF',
				'label'					=> 'Color of Badge'
			),
		);
		
		foreach( $colors as $color_id => $color ){
			$akvo_customize->color( $wp_customize, 'akvo_list_section', $color_id, $color['label'], $color['default'] );
		}
		
		/* END OF THEME SECTION */
		
		/* FONT SIZES */
		$akvo_customize->section( $wp_customize, $panel, 'akvo_list_font_section', 'Font Sizes', 'Customize font sizes for list widget');
		
		$text_el = array(
			'akvo_list[title_font_size]' => array(
				'default' 	=> '24px',
				'label' 	=> 'Font size of title:',
			),
			'akvo_list[content_font_size]' => array(
				'default' 	=> '14px',
				'label' 	=> 'Font size of content:',
			),
			'akvo_list[meta_font_size]' => array(
				'default' 	=> '10px',
				'label' 	=> 'Font size of meta:',
			),	
		);
		
		foreach( $text_el as $id => $el){
			$akvo_customize->text( $wp_customize, 'akvo_list_font_section', $id, $el['label'], $el['default']);	
		}
		/* END OF FONT SIZES */
		
		/* EXTRAS */
		$akvo_customize->section( $wp_customize, $panel, 'akvo_list_extras_section', 'Extras', '');
		
		$text_el = array(
			'akvo_list[margin_bottom]' => array(
				'default' 	=> '0px',
				'label' 	=> 'Margin Bottom:',
			),
			'akvo_list[border_radius]' => array(
				'default' 	=> '0px',
				'label' 	=> 'Border radius of list:',
			),
			'akvo_list[padding]' => array(
				'default' 	=> '20px',
				'label' 	=> 'Padding of list:',
			),
			'akvo_list[border_radius_badge]' => array(
				'default' 	=> '10px',
				'label' 	=> 'Border radius of badge:',
			),			
		);
		
		foreach( $text_el as $id => $el){
			$akvo_customize->text( $wp_customize, 'akvo_list_extras_section', $id, $el['label'], $el['default']);	
		}
		
		/* EXTRAS */
		
		
	} );

	
	/** ADD CUSTOMISE CSS */
	add_action( 'akvo_sites_css', function(){
		
		$akvo_list = get_option( 'akvo_list' );
		
		//print_r( $akvo_list );
		
		
		
		$items = array(
			array(
				'selector'	=> '.list-widget',
				'styles'	=> array(
					'background'	=> 'bg',
					'border-radius'	=> 'border_radius',
					'color'			=> 'content_color',
					'border-color'	=> 'border_color',
					'font-size'		=> 'content_font_size',
					'margin-bottom'	=> 'margin_bottom',
					'padding'		=> 'padding'
				)
			),
			array(
				'selector'	=> '.list-widget .small',
				'styles'	=> array(
					'font-size'		=> 'meta_font_size'
				)
			),
			array(
				'selector'	=> '.list-widget .badge',
				'styles'	=> array(
					'background'	=> 'badge_bg',
					'color'			=> 'badge_color',
					'border-radius'	=> 'border_radius_badge'
				)
			),
			array(
				'selector'	=> '.list-widget .list-title a[href]',
				'styles'	=> array(
					'color'			=> 'title_color',
					'font-size'		=> 'title_font_size'
				)
			),
		);
		
		global $akvo;
		$akvo->print_css( $akvo_list, $items );
		
	});

