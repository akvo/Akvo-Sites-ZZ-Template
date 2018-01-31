<?php
	
	class Akvo_Card extends AKVO_CARD_BASE{
		
		function __construct(){
			
			/* HANDLE AJAX */
			add_action("wp_ajax_akvo_card", array( $this, "ajax" ) );
			add_action("wp_ajax_nopriv_akvo_card", array( $this, "ajax" ) );
			
			/* HANDLE SHORTCODE */
			add_shortcode( 'akvo-card', array( $this, 'shortcode' ) );
		}
		
		function ajax(){
			
			/* init instance arguments */
			$instance = wp_parse_args( (array) $_GET, array( 
				'type' 				=> 'post', 
				'rsr-id' 			=> 'rsr', 
				'type-text' 		=> '', 
				'offset' 			=> 0, 
				'posts_per_page' 	=> 1,
				'page'				=> 1
			)); 
			
			
			
			$akvo_card = array();
			$data = array();
			
			switch($instance['type']){
				case 'rsr-project': 
					// RSR Project Card
					$data = $this->rsr_project($instance);
					break;
				case 'project': 
					// RSR Updates Card
					$data = $this->rsr_updates($instance);
					break;
				default:
					$data = $this->wp_query($instance);		
			}
			
			if(is_array($data) and count($data)){
				$akvo_card = $data[0];
			}
			
			/* FORM THE SHORTCODE */
			$shortcode = $this->form_shortcode($akvo_card);
			
			/* PRINT THE SHORTCODE */			
			echo do_shortcode($shortcode);
			
			/* kill the function after the processing is done */
			wp_die();
		}
		
		
		/* main shortcode function that displays the card */
		function display($atts){
			$atts = shortcode_atts(array(
					'title' 		=> 'Untitled',
					'content' 		=> '',
					'date' 			=> '',
					'type' 			=> 'Blog',
					'link' 			=> '',
					'img' 			=> '', 
					'type-text' 	=> '',
					'read_more_text'=> 'Read more'
				), $atts, 'akvo_card');
			
			//print_r($atts);
			
			/* get options from customise */
			$akvo_card_options = get_option('akvo_card');
			
			/* INCASE THE READ MORE TEXT HAS BEEN ADDED BY THE USER */
			if($akvo_card_options && array_key_exists('read_more_text', $akvo_card_options)){
				$atts['read_more_text'] = $akvo_card_options['read_more_text'];
			}
			
			include "templates/card.php";
		}
		
		function shortcode( $atts ){
			ob_start();
			$this->display( $atts );
			return ob_get_clean();
		}
		
	}
	
	new Akvo_Card;