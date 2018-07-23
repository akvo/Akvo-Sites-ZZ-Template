<?php

	class AKVO_SHORTCODE{
		
		var $shortcode_str;
		var $template;
		
		function __construct(){
			
			/* HANDLE SHORTCODE */
			add_shortcode( $this->shortcode_str, array( $this, 'shortcode' ) );
			
			
			
		}
		
		/* SHORTCODE FUNCTIONALITY */
		function shortcode( $atts ){
			ob_start();																				/* STORE TEMPLATING INTO BUFFER */
			
			$atts = shortcode_atts( $this->get_default_atts(), $atts, $this->shortcode_str );		/* SHORTCODE ATTRIBUTES */
			
			include $this->template;																/* TEMPLATE */
				
			return ob_get_clean();																	/* RETURN BUFFER TEMPLATING */	
		}
		
		/* NEEDS TO BE OVERRIDEN BY CHILD CLASSES */
		function get_default_atts(){
			return array(); 
		}
		
		/* PASS AN ARRAY TO CREATE ATTRIBUTES OF SHORTCODE */
		function form_shortcode( $data ){
			
        	$default_atts = $this->get_default_atts(); 				// GET DEFAULT ATTS OF THE SHORTCODE 
			
			$shortcode = '['.$this->shortcode_str.' ';				// SHORTCODE STRING START 
			
        	foreach( $data as $key => $val ){
        		
				/* ONLY ADD THOSE KEYS THAT ARE PART OF THE SHORTCODE */
				if( array_key_exists( $key, $default_atts ) ){
				
					$val = str_replace("[","&#91;",$val);
					$val = str_replace("]","&#93;",$val);
        			
					$shortcode .= $key.'="'.$val.'" ';				// SHORTCODE STRING ADD ATTRIBUTES 
				}
        	}
        	$shortcode .= ']';										// SHORTCODE STRING END 
        		
			return $shortcode;
		}
		
	}