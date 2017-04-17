<?php
	
	include "customize-theme.php";
	
	include "single-widget.php";
	
	include "pin-widget.php";
	
	include "akvo-card.class.php";
	
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
				
				$temp['type'] = $atts['type'];
				
				if($atts['type-text']){
					$temp['type-text'] = $atts['type-text'];
				}
				array_push($data, $temp);
			}
		}
		else {
			
      		$qargs = array(
        		'post_type' => $atts['type'],
        		'posts_per_page' => $atts['posts_per_page'],
        		'paged' => $atts['page']
			);
			$query = new WP_Query( $qargs );
			
			if ( $query->have_posts() ) { 
				while ( $query->have_posts() ) {
					$query->the_post();
					
          			$temp = $akvo_card_obj->parse_post($query->post);
          			
          			$temp['type'] = $atts['type'];
					if($temp['type'] == 'post'){
						$temp['type'] = 'Blog';
					}
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
	
	
	function akvo_card_ajax(){
		
		$akvo_card_obj = new Akvo_Card;
		
		$defaults = array( 'type' => 'post', 'rsr-id' => 'rsr', 'type-text' => '', 'offset' => 0); 
		$instance = wp_parse_args( (array) $_GET, $defaults ); 
		
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
    		// WP Query
      		$query = new WP_Query(array(
      					'post_type' 		=> $instance['type'],
      					'posts_per_page'	=> 1,
      					'offset'			=> $instance['offset'],
      		));
      		if ( $query->have_posts() ) { 
        		while ( $query->have_posts() ) {
					$query->the_post();
					$akvo_card = $akvo_card_obj->parse_post($query->post);
				}
        		wp_reset_postdata();
      		}
    	}
		
		if($instance['type-text']){
			$akvo_card['type-text'] = $instance['type-text'];
		}
		
		/* FORM THE SHORTCODE */
		$shortcode = '[akvo-card ';
        foreach($akvo_card as $key=>$val){
        	$shortcode .= $key.'="'.$val.'" ';
        }
        $shortcode .= 'type="'.$instance['type'].'"]';
        
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
	
	
	function slugify($text){
		// replace non letter or digits by -
  		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
  		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {return 'n-a';}
		return $text;
	}