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
		$instance = wp_parse_args( (array) $_GET, array( 'type' => 'post', 'rsr-id' => 'rsr', 'type-text' => '', 'offset' => 0) ); 
		
		$akvo_card = array();
		
		/* For any RSR related card */
		if($instance['type'] == 'project' || $instance['type'] == 'rsr-project') {
			// pull data from json feed
			$data = $akvo_card_obj->get_json_data($instance['rsr-id']);
			
			if($instance['type'] == 'project' && isset($data->results)){
				// RSR Updates Card
				$akvo_card = $akvo_card_obj->parse_rsr_updates($data->results[$instance['offset']]);
			}
			else if ($instance['type'] == 'rsr-project'){
				// RSR Project Card
				$akvo_card = $akvo_card_obj->parse_rsr_project($data);
			}
		}
    	else {
    		/* WP Query for post, testimonials, video, etc */
      		$query = new WP_Query(array(
      					'post_type' 		=> $instance['type'],
      					'posts_per_page'	=> 1,
      					'offset'			=> $instance['offset'],
      				));
      				
      		if ( $query->have_posts() ) {
      			/* Query execution */ 
        		while ( $query->have_posts() ) {
					$query->the_post();
					
					/* Parse query data into akvo_card array */
					$akvo_card = $akvo_card_obj->parse_post($query->post);
				}
        		wp_reset_postdata();
      		}
    	}
		
		/* adding extra parameters to the akvo_card array */
		$akvo_card = $akvo_card_obj->add_extra_params($akvo_card, $instance);
		
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
	
	