<?php
	
	class Akvo_Card extends AKVO_CARD_BASE{
		
		function __construct(){
			
			$this->shortcode_str = 'akvo-card';
			$this->shortcode_slug = 'akvo_card';
			$this->template = 'card';
			
			parent::__construct();
		}
		
		function get_default_atts(){
			return array(
				'title' 		=> 'Untitled',
				'content' 		=> '',
				'date' 			=> '',
				'type' 			=> 'project',
				'rsr-id' 		=> 'rsr', 
				'link' 			=> '',
				'img' 			=> '', 
				'type-text' 	=> '',
				'read_more_text'=> 'Read more',
				'posts_per_page' 	=> 1,
				'page'				=> 1
			);
		}
		
		function ajax(){
			
			$instance = wp_parse_args( (array) $_GET, $this->get_default_atts() );	/* init instance arguments */
			
			$data = $this->get_data_based_on_type( $instance );						/* GET DATA BASED IN TYPE OF DATA SELECTED */
			
			/* GET AKVO CARD FROM THE DATA */
			$akvo_card = array();
			if( is_array( $data ) and count( $data ) ){
				$akvo_card = $data[0];
			}
			
			$shortcode = $this->form_shortcode($akvo_card);		/* FORM THE SHORTCODE */
			
			echo do_shortcode($shortcode);						/* PRINT THE SHORTCODE */
			
			wp_die();											/* kill the function after the processing is done */		
		}
		
		
		/* GET AKVO CARD OPTIONS FROM CUSTOMISE */
		function get_akvo_card_options(){
			
			global $akvo;
			
			$akvo_card_options = array();
			
			$akvo_options = $akvo->get_option();				/* GLOBAL AKVO OPTIONS */
			
			if( isset( $akvo_options['card'] ) ){				/* CHECK IF THE CARD OPTIONS EXISTS IN GLOBAL */ 
				$akvo_card_options = $akvo_options['card'];
			}
			else{
				$akvo_card_options = get_option('akvo_card');	/* GET OPTIONS FROM AKVO CARD SETTINGS */
			}
			return $akvo_card_options;
		}
		
		/* main shortcode function that displays the card */
		function shortcode( $atts ){
			ob_start();
			
			$atts = shortcode_atts( $this->get_default_atts(), $atts, $this->shortcode_slug );
			
			$akvo_card_options = $this->get_akvo_card_options();
			
			/* INCASE THE READ MORE TEXT HAS BEEN ADDED BY THE USER */
			if($akvo_card_options && array_key_exists('read_more_text', $akvo_card_options)){
				$atts['read_more_text'] = $akvo_card_options['read_more_text'];
			}
			
			include "templates/".$this->template.".php";
			return ob_get_clean();
		}
		
	}
	
	global $akvo_card;
	$akvo_card = new Akvo_Card;