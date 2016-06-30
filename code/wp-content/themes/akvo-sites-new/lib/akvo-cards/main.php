<?php
	
	include "customize-theme.php";
	
	include "single-widget.php";
	
	include "pin-widget.php";
	
	
	function akvo_cards_main(){
		$data = array();
		
		$defaults = array( 
			'type' => 'post', 
			'posts_per_page' => 3,
			'rsr-id' => 'rsr', 
			'page' => 1,
			'pagination' => 0
		); 
		
		$atts = wp_parse_args( (array) $_GET, $defaults ); 
		
		if(isset($_GET['akvo-paged'])){
			$atts['page'] = $_GET['akvo-paged'];
		}	
		
		if ($atts['type'] == 'rsr') {
			/* get date format from settings */
			$date_format = get_option( 'date_format' );
			
			/* json data from the data feed plugin */
			$jsondata = do_shortcode('[data_feed name="'.$atts['rsr-id'].'"]');
			$jsondata = json_decode( str_replace('&quot;', '"', $jsondata) );
			
			
			$offset = ($atts['page'] - 1) * $atts['posts_per_page'];
			
			
			for($i = $offset; $i < $offset+$atts['posts_per_page']; $i++){
				$temp = array();
				
				
				$json_obj = $jsondata->results[$i];
				
				
				
				$temp['title'] = $json_obj->title;
				
				
				$temp['content'] = $json_obj->text;
      			$temp['date'] = date($date_format, strtotime($json_obj->created_at));
				
				$temp['type'] = 'RSR Update';
				
				
				if($json_obj->photo){
					$temp['img'] = 'http://rsr.akvo.org'.$json_obj->photo;
				}
					
      			$temp['link'] = 'http://rsr.akvo.org'.$json_obj->absolute_url;
				
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
					
					global $post_id;
          			
          			$temp = array();
          			
          			$temp['title'] = get_the_title();
          			$temp['content'] = get_the_excerpt();
          			$temp['link'] = get_the_permalink();
          			
          			
					$temp['type'] = $atts['type'];
					if($temp['type'] == 'post'){
						$temp['type'] = 'Blog';
					}
          			
          			$temp['date'] = get_the_date();
          			
          			$temp['img'] = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
          			
          			array_push($data, $temp);
          		}
				wp_reset_postdata();
			}
		}
		
		
		$url = admin_url('admin-ajax.php')."?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id'];
		
		include "templates/cards.php";
		
		/* kill the function after ajax processing */
		wp_die();
	}
	
	
	add_action("wp_ajax_akvo_cards", "akvo_cards_main");
	add_action("wp_ajax_nopriv_akvo_cards", "akvo_cards_main");
	
	
	function akvo_cards($atts){
		$data = array();
		$atts = shortcode_atts(
			array(
				'type' => 'post',
				'posts_per_page' => 3,
				'rsr-id' => 'rsr',
				'pagination' => 0,
				'page' => 1
			), $atts, 'akvo_cards' 
		);
		
		
		
			
		
		
		/*
		if ($atts['type'] == 'rsr') {
			$date_format = get_option( 'date_format' );
			$jsondata = do_shortcode('[data_feed name="'.$atts['rsr'].'"]');
			
			
			
      		$jsondata = json_decode( str_replace('&quot;', '"', $jsondata) );
			
			
			$offset = ($page - 1) * $atts['posts_per_page'];
			
			
			for($i=$offset; $i<$offset+$atts['posts_per_page']; $i++){
				$temp = array();
				
				
				$json_obj = $jsondata->results[$i];
				
				
				
				$temp['title'] = $json_obj->title;
				
				
				$temp['content'] = $json_obj->text;
      			$temp['date'] = date($date_format, strtotime($json_obj->created_at));
				
				$temp['type'] = 'RSR Update';
				
				
				if($json_obj->photo){
					$temp['img'] = 'http://rsr.akvo.org'.$json_obj->photo;
				}
					
      			$temp['link'] = 'http://rsr.akvo.org'.$json_obj->absolute_url;
				
				array_push($data, $temp);
			}
		}
		else {
			
      		$qargs = array(
        		'post_type' => $atts['type'],
        		'posts_per_page' => $atts['posts_per_page'],
        		'paged' => $page
			);
			$query = new WP_Query( $qargs );
			
			if ( $query->have_posts() ) { 
				while ( $query->have_posts() ) {
						
					$query->the_post();
					
					global $post_id;
          			
          			$temp = array();
          			
          			$temp['title'] = get_the_title();
          			$temp['content'] = get_the_excerpt();
          			$temp['link'] = get_the_permalink();
          			
          			
					$temp['type'] = $atts['type'];
					if($temp['type'] == 'post'){
						$temp['type'] = 'Blog';
					}
          			
          			$temp['date'] = get_the_date();
          			
          			$temp['img'] = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
          			
          			array_push($data, $temp);
          		}
				wp_reset_postdata();
			}
		}
		*/
		ob_start();
		
		$url = admin_url('admin-ajax.php')."?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id']."&pagination=".$atts['pagination']."&page=".$atts['page'];
		echo "<div data-behaviour='reload-html' data-url='".$url."'></div>";
		
		//include "templates/cards.php";
		return ob_get_clean();
	}
	add_shortcode( 'akvo-cards', 'akvo_cards' );
	
	
	function akvo_card_main(){
		
		$defaults = array( 'type' => 'post', 'rsr-id' => 'rsr', 'offset' => 0); 
		$instance = wp_parse_args( (array) $_GET, $defaults ); 
		
		
		if ($instance['type'] == 'project') {
			$c = $instance['offset'];
			$date_format = get_option( 'date_format' );
			$data = do_shortcode('[data_feed name="'.$instance['rsr-id'].'"]');
			$data = json_decode( str_replace('&quot;', '"', $data) );
			$objects = $data->results;
			$title = $objects[$c]->title;
			$text = $objects[$c]->text;
			$date = date($date_format,strtotime($objects[$c]->created_at));
			$thumb = 'http://rsr.akvo.org'.$objects[$c]->photo;
			$link = 'http://rsr.akvo.org'.$objects[$c]->absolute_url;
			$type = 'RSR update';

      		echo do_shortcode('[akvo-card title="'.$title.'" type="RSR Update" link="'.$link.'" img="'.$thumb.'" content="'.$text.'" date="'.$date.'"]');	
    	}
		else {
      		$qargs = array(
        		'post_type' => $instance['type'],
        		'posts_per_page' => 1,
        		'offset' => $instance['offset'],
      		);
      		$query = new WP_Query( $qargs );
      			
      		if ( $query->have_posts() ) { 
        		while ( $query->have_posts() ) {
					$query->the_post();
          			get_template_part( 'partials/post', 'card' );
        		}
        		wp_reset_postdata();
      		}
    	}
		
		/* kill the function after the processing is done */
		wp_die();
	}
	
	add_action("wp_ajax_akvo_card", "akvo_card_main");
	add_action("wp_ajax_nopriv_akvo_card", "akvo_card_main");
	
	
	function akvo_card($atts){
		$atts = shortcode_atts(
			array(
				'title' => 'Untitled',
				'content' => '',
				'date' => '',
				'type' => 'Blog',
				'link' => '',
				'img' => '', //get_bloginfo('template_url').'/dist/images/placeholder800x400.jpg'
			), $atts, 'akvo_card' 
		);
		ob_start();
		include "templates/card.php";
		return ob_get_clean();
	}
	add_shortcode( 'akvo-card', 'akvo_card' );
	
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