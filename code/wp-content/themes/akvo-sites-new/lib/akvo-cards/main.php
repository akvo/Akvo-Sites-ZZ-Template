<?php
	
	$files_inc = array(
		'customize-theme.php',		
		'single-widget.php',
		'pin-widget.php',
		'akvo-card.class.php',
		'akvo-cards.php'
	);
	
	foreach($files_inc as $file){
		include $file;
	}
	
	
	function akvo_card_ajax(){
		$akvo_card_obj = new Akvo_Card;
		
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
				$akvo_card = $akvo_card_obj->rsr_project($instance);
				break;
			case 'project': 
				// RSR Updates Card
				$data = $akvo_card_obj->rsr_updates($instance);
				break;
			default:
				$data = $akvo_card_obj->wp_query($instance);		
		}
		
		if(is_array($data) and count($data)){
			$akvo_card = $data[0];
		}
		
		/* FORM THE SHORTCODE */
		$shortcode = $akvo_card_obj->form_shortcode($akvo_card);
		
		/* PRINT THE SHORTCODE */			
        echo do_shortcode($shortcode);
		
		/* kill the function after the processing is done */
		wp_die();
	}
	
	add_action("wp_ajax_akvo_card", "akvo_card_ajax");
	add_action("wp_ajax_nopriv_akvo_card", "akvo_card_ajax");
	
	
	function akvo_card_shortcode($atts){
		ob_start();
		$akvo_card_obj = new Akvo_Card;
		$akvo_card_obj->display($atts);
		return ob_get_clean();
	}
	add_shortcode( 'akvo-card', 'akvo_card_shortcode' );
	
	