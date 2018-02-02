<?php
	
	/* EVENTS SECTION */
	
	add_action( 'customize_register', function($wp_customize){
		
		global $akvo_customize;
		
		$akvo_customize->section( $wp_customize, 'tribe_customizer', 'akvo_events_section', 'Akvo Sites Theme', 'Customize templates for events');
		
		/** TEXT ELEMENTS */
		$text_el = array(
			'akvo_events[title_font_size]'	=> array(
				'default' => '16px',
				'label'    => 'Title: Font size'
			),
			'akvo_events[btn_text]'	=> array(
				'default' => 'View All Events',
				'label'   => 'Button Text',	
			),
			'akvo_events[btn_font_size]' => array(
				'default' => '14px',
				'label'   => 'Button: Font size',
			),
			'akvo_events[meet_text]' => array(
				'default' => 'Meet:',
				'label'   => 'Text for event partners',
			),
		);
		
		foreach( $text_el as $id => $el ){
			$akvo_customize->text( $wp_customize, 'akvo_events_section', $id, $el['label'], $el['default']);
		}
		
		
		$colors = array(
			'akvo_events[title_color]'	=> array(
				'default'	=> '#000000',
				'label'		=> 'Color of Title:'
			),
			'akvo_events[btn_bg_color]'	=> array(
				'default' 	=> '#000000',
				'label'		=> 'Button: BG Color',
			),
			'akvo_events[btn_color]'	=> array(
				'default' 	=> '#000000',
				'label' 	=> 'Button: Color',
			)
		);
		
		foreach( $colors as $color_id => $color ){
			$akvo_customize->color( $wp_customize, 'akvo_events_section', $color_id, $color['label'], $color['default'] );
		}
		
		
		
		
		
	} );
	
	
	add_action( 'wp_head', function(){
		
		$akvo_events = get_option('akvo_events');
		
		if($akvo_events != NULL):
		
		?>
        <style type="text/css">
        	.tribe-events-list-widget h3.widget-title{
         		<?php if(isset($akvo_events['title_font_size'])){ _e("font-size:".$akvo_events['title_font_size'].";");}?>
         		<?php if(isset($akvo_events['title_color'])){ _e("color:".$akvo_events['title_color'].";");}?>
         	}
         	.tribe-events-list-widget .btn.btn-default{
         		<?php if(isset($akvo_events['btn_font_size'])){ _e("font-size:".$akvo_events['btn_font_size'].";");}?>
         		<?php if(isset($akvo_events['btn_bg_color'])){ _e("background-color:".$akvo_events['btn_bg_color'].";");}?>
         		<?php if(isset($akvo_events['btn_color'])){ _e("color:".$akvo_events['btn_color'].";");}?>
         	}
		</style>
        <?php 
		
		endif;
	});
	
