<?php
	
	
	class AKVO_CUSTOMIZE{
		
		function panel( $wp_customize, $id, $label){
			
			$wp_customize->add_panel($id, array(
				'priority' 		=> 30,
				'capability' 	=> 'edit_theme_options',
				'theme_supports'=> '',
				'title' 		=> $label,
				'description' 	=> '',
			) );
		
		}
		
		function section( $wp_customize, $panel, $id, $label, $desc){
		
			
			$wp_customize->add_section( $id , array(
	    		'title'       	=> __( $label, 'akvo' ),
		    	'priority'    	=> 30,
		    	'description' 	=> $desc,
		    	'panel'			=> $panel	
			) );
		
		}
		
		
		
		function color( $wp_customize, $section, $id, $label, $default ){
			
			
			
			$wp_customize->add_setting( $id, array(
      			'default' => $default,
      			'transport'   => 'refresh',
      			'type' => 'option'
      		) );

    		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
          		'label' => $label,
          		'section' => $section,
          		'settings' => $id,
    		)));
			
			
			
			
		}
		
		function checkbox( $wp_customize, $section, $id, $label ){
			
			$wp_customize->add_setting($id, array(
				'default' => 0,
      			'capability' => 'edit_theme_options',
      			'type'       => 'option',
      		));
		
			$wp_customize->add_control($id, array(
      			'settings' 	=> $id,
      			'label'    	=> __($label),
      			'section'  	=> $section,
      			'type'     	=> 'checkbox',
      			'std' 		=> 1
      		));
			
			
		}
		
		
		function text( $wp_customize, $section, $id, $label, $default){
			
			$wp_customize->add_setting($id, array(
       			'default' 	=> $default,
       			'capability'=> 'edit_theme_options',
       			'type'      => 'option',
    		));
 		
			$wp_customize->add_control($id, array(
				'settings' 	=> $id,
	    		'type' 		=> 'text',
    	    	'label' 	=> $label,
        		'section' 	=> $section,
	        ));
		
		}
		
		function dropdown( $wp_customize, $section, $id, $label, $default, $choices){
			
			$wp_customize->add_setting( $id, array(
	    		'default' 	=> $default,
	    		'type'		=> 'option',
				'transport' => 'refresh',
			));
			$wp_customize->add_control( $id, array(
				'type' 		=> 'select',	
		    	'label'    	=> $label,
		    	'section'  	=> $section,
		    	'settings' 	=> $id,
		    	'choices' 	=> $choices
			));
		}
		
	}
	
	global $akvo_customize;
	
	$akvo_customize = new AKVO_CUSTOMIZE;
	
	
	include('colors.php');
	include('events.php');
	include('header-menu.php');
	include('logo.php');
	include('fonts.php');
	include('article.php');
	include('search.php');