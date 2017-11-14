<?php
	
	add_action( 'customize_register', function( $wp_customize ){
		
		global $akvo_customize;
		
		$akvo_customize->panel( $wp_customize, 'akvo_card_panel', 'Card Widget' );

		
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
	add_action( 'wp_head', function(){
		
		$akvo_card = get_option('akvo_card');
		
		//print_r($akvo_card);
	?>
		<style type="text/css">
				
		<?php if( $akvo_card ):?>
         	.card{
         		<?php if(isset($akvo_card['bg'])):?>background: <?php _e($akvo_card['bg']);?>;<?php endif;?>
         		<?php if(isset($akvo_card['border_radius'])):?>border-radius: <?php _e($akvo_card['border_radius']);?><?php endif;?>
         	}
         	
         	<?php if(isset($akvo_card['bg_img'])):?>
         	.card .card-image{
         		background-image: url("<?php _e($akvo_card['bg_img']);?>");
         	}
			<?php endif;?>
         	
         	.card .card-info{
         		<?php if(isset($akvo_card['infobar_bg'])):?>background: <?php _e($akvo_card['infobar_bg']);?>;<?php endif;?>
         		<?php if(isset($akvo_card['infobar_color'])):?>color: <?php _e($akvo_card['infobar_color']);?>;<?php endif;?>
         		<?php if($akvo_card['hide_infobar']):?>display: none;<?php endif;?>
         		<?php if(isset($akvo_card['infobar_font_size'])):?>font-size: <?php _e($akvo_card['infobar_font_size']);?>;<?php endif;?>
         	}
         	
         	.card .card-content{
         		<?php if($akvo_card['hide_content']):?>display: none;<?php endif;?>
				<?php if(isset($akvo_card['content_color'])):?>color: <?php _e($akvo_card['content_color']);?>;<?php endif;?>
         		<?php if(isset($akvo_card['content_font_size'])):?>font-size: <?php _e($akvo_card['content_font_size']);?>;<?php endif;?>
         	}
			
         	.card .card-title{
         		<?php if($akvo_card['hide_card_title']):?>display: none;<?php endif;?>
         		<?php if(isset($akvo_card['title_font_size'])):?>font-size: <?php _e($akvo_card['title_font_size']);?>;<?php endif;?>
         		<?php if(isset($akvo_card['title_color'])):?>color: <?php _e($akvo_card['title_color']);?>;<?php endif;?>
         	}
         	
         	<?php 
         		$akvo_card_obj = new Akvo_Card;
         		$types = $akvo_card_obj->get_types(); 
         		foreach($types as $type=>$label): $bg_setting = 'bg_'.$type.'_height';if(isset($akvo_card[$bg_setting])):
         	?>
         		.card.<?php _e($type)?> .card-image{
         			height: <?php _e($akvo_card[$bg_setting]);?>
         		}
         	<?php endif;endforeach;?>	
         	
		<?php endif;?>
		</style>
    <?php
		
		
	});

