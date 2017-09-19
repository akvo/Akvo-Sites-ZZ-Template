<?php
	
	/* EVENTS SECTION */
	
	add_action( 'customize_register', function($wp_customize){
		
		
		
		$wp_customize->add_section( 'events_section' , array(
	    	'title'       	=> __( 'Akvo Theme', 'sage' ),
		    'priority'    	=> 30,
		    'description' 	=> 'Customize templates for events',
		    'panel'			=> 'tribe_customizer'
		) );
		
		$wp_customize->add_setting('akvo_events[title_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[title_font_size]', array(
		    'label'    => __( 'Title: Font size', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[title_font_size]',
		));
		
		$wp_customize->add_setting('akvo_events[title_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[title_color]', array(
          			'label' => 'Title: Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[title_color]',
    	)));
		
		
		
		$wp_customize->add_setting('akvo_events[btn_text]', array(
      		'default' => 'View All Events',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[btn_text]', array(
		    'label'    => __( 'Button Text', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[btn_text]',
		));
		
		$wp_customize->add_setting('akvo_events[btn_bg_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[btn_bg_color]', array(
          			'label' => 'Button: BG Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[btn_bg_color]',
    	)));
		$wp_customize->add_setting('akvo_events[btn_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[btn_color]', array(
          			'label' => 'Button: Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[btn_color]',
    	)));
		
		$wp_customize->add_setting('akvo_events[btn_font_size]', array(
      		'default' => '14px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[btn_font_size]', array(
		    'label'    => __( 'Button: Font size', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[btn_font_size]',
		));
		
		$wp_customize->add_setting('akvo_events[meet_text]', array(
      		'default' => 'Meet:',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[meet_text]', array(
		    'label'    => __( 'Header text for event partners', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[meet_text]',
		));
		
	} );
	
	
	add_action( 'wp_head', function(){
		
		$akvo_events = get_option('akvo_events');
		
		?>
        <style type="text/css">
        	<?php if(isset($akvo_events)):?>
         	.tribe-events-list-widget h3.widget-title{
         		<?php if(isset($akvo_events['title_font_size'])){ _e("font-size:".$akvo_events['title_font_size'].";");}?>
         		<?php if(isset($akvo_events['title_color'])){ _e("color:".$akvo_events['title_color'].";");}?>
         	}
         	.tribe-events-list-widget .btn.btn-default{
         		<?php if(isset($akvo_events['btn_font_size'])){ _e("font-size:".$akvo_events['btn_font_size'].";");}?>
         		<?php if(isset($akvo_events['btn_bg_color'])){ _e("background-color:".$akvo_events['btn_bg_color'].";");}?>
         		<?php if(isset($akvo_events['btn_color'])){ _e("color:".$akvo_events['btn_color'].";");}?>
         	}
         	<?php endif;?> 		
         </style>
        <?php 
	});
	
