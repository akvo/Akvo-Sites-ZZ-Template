<?php
	
	class AKVO_LIST extends AKVO_CARD_BASE{
		
		function __construct(){
			
			$this->shortcode_str = 'akvo-list';
			$this->shortcode_slug = 'akvo_list';
			$this->template = 'list';
			
			parent::__construct();
		}
		
		
		/* main shortcode function that displays the card */
		function shortcode( $atts ){
			ob_start();
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
			
			/* get options from customise */
			$akvo_card_options = get_option('akvo_card');
			
			/* INCASE THE READ MORE TEXT HAS BEEN ADDED BY THE USER */
			if($akvo_card_options && array_key_exists('read_more_text', $akvo_card_options)){
				$atts['read_more_text'] = $akvo_card_options['read_more_text'];
			}
			
			include "templates/".$this->template.".php";
			return ob_get_clean();
		}
		
	}
	
	global $akvo_list;
	$akvo_list = new AKVO_LIST;