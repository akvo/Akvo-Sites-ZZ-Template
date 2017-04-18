<?php
	
	function akvo_cards_ajax(){
		$data = array();
		$akvo_card_obj = new Akvo_Card;
		$defaults = array( 
			'type' => 'post', 
			'posts_per_page' => 3,
			'rsr-id' => 'rsr', 
			'type-text' => '',
			'page' => 1,
			'pagination' => 0
		); 
		
		$atts = wp_parse_args( (array) $_GET, $defaults ); 
		
		if(isset($_GET['akvo-paged'])){
			$atts['page'] = $_GET['akvo-paged'];
		}
		
		if ($atts['type'] == 'rsr') {
			/* json data from the data feed plugin */
			$jsondata = $akvo_card_obj->get_json_data($atts['rsr-id']);
			
			$offset = ($atts['page'] - 1) * $atts['posts_per_page'];
			
			for($i = $offset; $i < $offset+$atts['posts_per_page']; $i++){
				$temp = $akvo_card_obj->parse_rsr_updates($jsondata->results[$i]);
				
				/* adding extra params */
				$temp = $akvo_card_obj->add_extra_params($temp, $atts);
				
				array_push($data, $temp);
			}
		}
		else {
			
      		
			$query = new WP_Query(array(
						'post_type' => $atts['type'],
        				'posts_per_page' => $atts['posts_per_page'],
        				'paged' => $atts['page']			
					));
			if ( $query->have_posts() ) { 
				while ( $query->have_posts() ) {
					$query->the_post();
					
          			$temp = $akvo_card_obj->parse_post($query->post);
          			
          			/* adding extra params */
					$temp = $akvo_card_obj->add_extra_params($temp, $atts);
					
					array_push($data, $temp);
          		}
				wp_reset_postdata();
			}
		}
		$url = $akvo_card_obj->get_ajax_url('akvo_cards', $atts);
		include "templates/cards.php";
		
		/* kill the function after ajax processing */
		wp_die();
	}
	add_action("wp_ajax_akvo_cards", "akvo_cards_ajax");
	add_action("wp_ajax_nopriv_akvo_cards", "akvo_cards_ajax");
	
	
	function akvo_cards_shortcode($atts){
		$akvo_card_obj = new Akvo_Card;
		$atts = shortcode_atts(array(
				'type' => 'post',
				'posts_per_page' => 3,
				'rsr-id' => 'rsr',
				'type-text' => '',
				'pagination' => 0,
				'page' => 1
			), $atts, 'akvo_cards');
		
		ob_start();
		$url = $akvo_card_obj->get_ajax_url('akvo_cards', $atts);
		echo "<div data-behaviour='reload-html' data-url='".$url."'></div>";
		return ob_get_clean();
	}
	add_shortcode( 'akvo-cards', 'akvo_cards_shortcode' );
	