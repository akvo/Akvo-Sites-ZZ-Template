<?php
	
	
	class AKVO_CUSTOMIZE{
		
		function __construct(){
			
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_control_js' ) );
			
			add_action( 'customize_register', array( $this, 'prefix_customize_register' ) );
		}
		
		function customize_control_js(){
			wp_enqueue_script( 'akvo_customizer_control', get_template_directory_uri() . '/dist/scripts/customizer-control.js', array( 'customize-controls', 'jquery' ), '1.0.2', true );
		}
		
		function prefix_customize_register( $wp_customize ) {
			// Define a custom control class, AKVO_CUSTOMIZE_DROPDOWN_CONTROL.
			// Register the class so that its JS template is available in the Customizer.
			$wp_customize->register_control_type( 'AKVO_CUSTOMIZE_DROPDOWN_CONTROL' );
		}
		
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
			
			$this->add_setting( $wp_customize, $id, $default );
			
    		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
          		'label' => $label,
          		'section' => $section,
          		'settings' => $id,
    		)));
			
			
			
			
		}
		
		function checkbox( $wp_customize, $section, $id, $label ){
			
			$this->add_setting( $wp_customize, $id, $default );
			
		
			$wp_customize->add_control($id, array(
      			'settings' 	=> $id,
      			'label'    	=> __($label),
      			'section'  	=> $section,
      			'type'     	=> 'checkbox',
      			'std' 		=> 1
      		));
			
			
		}
		
		
		function text( $wp_customize, $section, $id, $label, $default){
			
			$this->add_setting( $wp_customize, $id, $default );
			
			$wp_customize->add_control($id, array(
				'settings' 	=> $id,
	    		'type' 		=> 'text',
    	    	'label' 	=> $label,
        		'section' 	=> $section,
	        ));
		
		}
		
		function textarea( $wp_customize, $section, $id, $label, $default){
			
			$this->add_setting( $wp_customize, $id, $default );
			
			$wp_customize->add_control($id, array(
				'settings' 	=> $id,
	    		'type' 		=> 'textarea',
    	    	'label' 	=> $label,
        		'section' 	=> $section,
	        ));
		
		}
		
		function dropdown( $wp_customize, $section, $id, $label, $default, $choices){
			
			$this->add_setting( $wp_customize, $id, $default );
			
			$wp_customize->add_control( $id, array(
				'type' 		=> 'select',	
		    	'label'    	=> $label,
		    	'section'  	=> $section,
		    	'settings' 	=> $id,
		    	'choices' 	=> $choices
			));
		}
		
		function ajax_dropdown( $wp_customize, $section, $id, $label, $default, $choices){
			
			$this->add_setting( $wp_customize, $id, $default );
			
			$wp_customize->add_control( new AKVO_CUSTOMIZE_DROPDOWN_CONTROL(
				$wp_customize,
				$id,
				array(
					'label' 	=> $label,
					'section' 	=> $section,
					'settings' 	=> $id,
					'choices' 	=> array( 'url' => admin_url('admin-ajax.php?action=akvo_fonts') ),
				)
			) );
			
			/*
			$wp_customize->add_control( $id, array(
				'type' 		=> 'select',	
		    	'label'    	=> $label,
		    	'section'  	=> $section,
		    	'settings' 	=> $id,
		    	'choices' 	=> $choices
			));
			*/
		}
		
		function image( $wp_customize, $section, $id, $label, $default){
			
			$this->add_setting( $wp_customize, $id, $default );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
          		'label' 	=> $label,
          		'section' 	=> $section,
          		'settings' 	=> $id,
			)));
		}
		
		function add_setting( $wp_customize, $id, $default ){
			
			$wp_customize->add_setting( $id, array(
				'default' 	=> $default,
				'transport' => 'refresh',
				'type' 		=> 'option'
			) );
			
		}
		
	}
	
	global $akvo_customize;
	
	$akvo_customize = new AKVO_CUSTOMIZE;
	
	