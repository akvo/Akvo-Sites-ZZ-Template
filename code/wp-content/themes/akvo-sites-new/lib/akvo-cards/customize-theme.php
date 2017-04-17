<?php


	function akvo_card_customize_register( $wp_customize ) {
		
		/* CARD SECTION */
		$wp_customize->add_section( 'akvo_card_section' , array(
	    	'title'       => __( 'Card Widget', 'sage' ),
		    'priority'    => 30,
		    'description' => 'Select card styles',
		) );
		
		
		$wp_customize->add_setting( 'akvo_card[bg_img]', array(
      		'default' => get_bloginfo('template_url').'/dist/images/placeholder800x400.jpg',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control( 
      		new WP_Customize_Image_Control( 
        		$wp_customize, 'akvo_card[bg_img]', array(
          			'label' => 'Default Image',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[bg_img]',
    	)));
		
		/* CARD BG */
		$wp_customize->add_setting( 'akvo_card[bg]', array(
      		'default' => '#EEEEEE',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	
    	
    	
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_card[bg]', array(
          			'label' => 'Background',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[bg]',
    	)));
    	
    	/* CARD FONT COLOR */
		$wp_customize->add_setting('akvo_card[title_color]', array(
      		'default' => '#333333',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_card[title_color]', array(
          			'label' => 'Title Color',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[title_color]',
    	)));
    	
    	$wp_customize->add_setting('akvo_card[content_color]', array(
      		'default' => '#333333',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_card[content_color]', array(
          			'label' => 'Content Color',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[content_color]',
    	)));
    	
    	/* CARD INFOBAR */
		$wp_customize->add_setting('akvo_card[infobar_bg]', array(
      		'default' => '#54bce8',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_card[infobar_bg]', array(
          			'label' => 'Infobar Background',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[infobar_bg]',
    	)));
    	
    	$wp_customize->add_setting('akvo_card[infobar_color]', array(
      		'default' => '#ffffff',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_card[infobar_color]', array(
          			'label' => 'Infobar Font Color',
          			'section' => 'akvo_card_section',
          			'settings' => 'akvo_card[infobar_color]',
    	)));
		
		
		/* HIDE ELEMENTS */
		$wp_customize->add_setting('akvo_card[hide_card_title]', array(
			'default' => 0,
      		'capability' => 'edit_theme_options',
      		'type'       => 'option',
      	));
		
		$wp_customize->add_control('akvo_card[hide_card_title]', array(
      		'settings' => 'akvo_card[hide_card_title]',
      		'label'    => __('Hide Widget Title'),
      		'section'  => 'akvo_card_section',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
      	
      	$wp_customize->add_setting('akvo_card[hide_infobar]', array(
			'default' => 0,
      		'capability' => 'edit_theme_options',
      		'type'       => 'option',
      	));
		
		$wp_customize->add_control('akvo_card[hide_infobar]', array(
      		'settings' => 'akvo_card[hide_infobar]',
      		'label'    => __('Hide Widget Infobar'),
      		'section'  => 'akvo_card_section',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
      	
      	$wp_customize->add_setting('akvo_card[hide_content]', array(
			'default' => 0,
      		'capability' => 'edit_theme_options',
      		'type'       => 'option',
      	));
		
		$wp_customize->add_control('akvo_card[hide_content]', array(
      		'settings' => 'akvo_card[hide_content]',
      		'label'    => __('Hide Widget Content'),
      		'section'  => 'akvo_card_section',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
		
		$wp_customize->add_setting('akvo_card[title_font_size]', array(
       		'default' => '24px',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[title_font_size]', array(
			'settings' => 'akvo_card[title_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the card title:',
        	'section' => 'akvo_card_section',
        ));
        
        $wp_customize->add_setting('akvo_card[infobar_font_size]', array(
       		'default' => '12px',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[infobar_font_size]', array(
			'settings' => 'akvo_card[infobar_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the card infobar:',
        	'section' => 'akvo_card_section',
        ));
        
        $wp_customize->add_setting('akvo_card[content_font_size]', array(
       		'default' => '14px',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[content_font_size]', array(
			'settings' => 'akvo_card[content_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the card infobar:',
        	'section' => 'akvo_card_section',
        ));
        
        $wp_customize->add_setting('akvo_card[border_radius]', array(
       		'default' => '5px',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[border_radius]', array(
			'settings' => 'akvo_card[border_radius]',
    		'type' => 'text',
        	'label' => 'Border radius of the card:',
        	'section' => 'akvo_card_section',
        ));
        
        $wp_customize->add_setting('akvo_card[akvoapp]', array(
       		'default' => 'http://rsr.akvo.org',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[akvoapp]', array(
			'settings' => 'akvo_card[akvoapp]',
    		'type' => 'text',
        	'label' => 'Akvoapp URL:',
        	'section' => 'akvo_card_section',
        ));
        
        $wp_customize->add_setting('akvo_card[read_more_text]', array(
       		'default' => 'Read more',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('akvo_card[read_more_text]', array(
			'settings' => 'akvo_card[read_more_text]',
    		'type' => 'text',
        	'label' => 'Read More Text:',
        	'section' => 'akvo_card_section',
        ));
		/* END OF CARD SECTION */
		
		$types = akvo_get_card_types(); 
		foreach($types as $type=>$label){
		
			$bg_setting = 'akvo_card[bg_'.$type.'_height]';
		
			$wp_customize->add_setting($bg_setting, array(
       			'default' => '150px',
       			'capability' => 'edit_theme_options',
       			'type'       => 'option',
    		));	
    		$wp_customize->add_control($bg_setting, array(
				'settings' => $bg_setting,
    			'type' => 'text',
        		'label' => 'BG Image Height of '.$label.' :',
        		'section' => 'akvo_card_section',
        	));
		}
		
	}
	add_action( 'customize_register', 'akvo_card_customize_register' );

	

	function akvo_card_css(){
		$akvo_card = get_option('akvo_card');
		
		//print_r($akvo_card);
	?>
         <style type="text/css">
         	
         	
         	<?php if($akvo_card):?>
         	.card{
         		<?php if(isset($akvo_card['bg'])):?>
         		background: <?php _e($akvo_card['bg']);?>;
         		<?php endif;?>
         		<?php if(isset($akvo_card['border_radius'])):?>
         		border-radius: <?php _e($akvo_card['border_radius']);?>
         		<?php endif;?>
         	}
         	
         	
         	.card .card-image{
         		<?php if(isset($akvo_card['bg_img'])):?>
         		background-image: url("<?php _e($akvo_card['bg_img']);?>");
         		<?php endif;?>
         	}
         	
         	.card .card-info{
         		<?php if(isset($akvo_card['infobar_bg'])):?>
         		background: <?php _e($akvo_card['infobar_bg']);?>;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['infobar_color'])):?>
         		color: <?php _e($akvo_card['infobar_color']);?>;
         		<?php endif;?>
         		
         		<?php if($akvo_card['hide_infobar']):?>
         		display: none;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['infobar_font_size'])):?>
         		font-size: <?php _e($akvo_card['infobar_font_size']);?>;
         		<?php endif;?>
         	}
         	
         	.card .card-content{
         		<?php if($akvo_card['hide_content']):?>
         		display: none;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['content_color'])):?>
         		color: <?php _e($akvo_card['content_color']);?>;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['content_font_size'])):?>
         		font-size: <?php _e($akvo_card['content_font_size']);?>;
         		<?php endif;?>
         	}
         	.card .card-title{
         		<?php if($akvo_card['hide_card_title']):?>
         		display: none;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['title_font_size'])):?>
         		font-size: <?php _e($akvo_card['title_font_size']);?>;
         		<?php endif;?>
         		
         		<?php if(isset($akvo_card['title_color'])):?>
         		color: <?php _e($akvo_card['title_color']);?>;
         		<?php endif;?>
         	}
         	
         	<?php 
         		$types = akvo_get_card_types(); 
         		foreach($types as $type=>$label): $bg_setting = 'bg_'.$type.'_height';
         			if(isset($akvo_card[$bg_setting])):
         	?>
         		.card.<?php _e($type)?> .card-image{
         			height: <?php _e($akvo_card[$bg_setting]);?>
         		}
         	<?php endif;endforeach;?>	
         	
         	<?php endif;?>
         </style>
    <?php
	}
	add_action( 'wp_head', 'akvo_card_css');


?>