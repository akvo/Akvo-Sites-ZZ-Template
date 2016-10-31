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
			'type-text' => '',
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
				
				$temp['type'] = $atts['type'];
				
				$temp['type-text'] = $atts['type-text'];
				if(!$temp['type-text']){
					$temp['type-text'] = 'RSR Updates';
				}
				
				if($json_obj->photo){
					$temp['img'] = 'http://rsr.akvo.org'.$json_obj->photo;
				}
				
				
				/* from customize theme */
				$base_url = 'http://rsr.akvo.org';
				$akvo_card_options = get_option('akvo_card');
				if($akvo_card_options && array_key_exists('akvoapp', $akvo_card_options)){
					$base_url = $akvo_card_options['akvoapp'];
				}
					
      			$temp['link'] = $base_url.$json_obj->absolute_url;
				
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
		
		
		//$url = admin_url('admin-ajax.php')."?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id'];
		
		$url = admin_url('admin-ajax.php')."?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id']."&pagination=".$atts['pagination']."&page=".$atts['page']."&type-text=".$atts['type-text'];
		
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
				'type-text' => '',
				'pagination' => 0,
				'page' => 1
			), $atts, 'akvo_cards' 
		);
		
		ob_start();
		
		$url = admin_url('admin-ajax.php')."?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id']."&pagination=".$atts['pagination']."&page=".$atts['page']."&type-text=".$atts['type-text'];
		
		echo "<div data-behaviour='reload-html' data-url='".$url."'></div>";
		
		return ob_get_clean();
	}
	add_shortcode( 'akvo-cards', 'akvo_cards' );
	
	
	function akvo_card_main(){
		
		$defaults = array( 'type' => 'post', 'rsr-id' => 'rsr', 'type-text' => '', 'offset' => 0); 
		$instance = wp_parse_args( (array) $_GET, $defaults ); 
		
		$akvo_card = array();
		
		$date_format = get_option( 'date_format' );
		
		/* from customize theme */
		$base_url = 'http://rsr.akvo.org';
		$akvo_card_options = get_option('akvo_card');
		if($akvo_card_options && array_key_exists('akvoapp', $akvo_card_options)){
			$base_url = $akvo_card_options['akvoapp'];
		}
		
		if ($instance['type'] == 'project') {
			$c = $instance['offset'];
			
			$data = do_shortcode('[data_feed name="'.$instance['rsr-id'].'"]');
			
			$data = json_decode( str_replace('&quot;', '"', $data) );
			
			
			
			$akvo_card['title'] = '';
			$akvo_card['content'] = '';
			$akvo_card['date'] = '';
			$akvo_card['img'] = '';
			$akvo_card['link'] = '';
			
			if(isset($data->results)){
				$objects = $data->results;
				
				if($objects[$c]->title){
					$akvo_card['title'] = $objects[$c]->title;
				}
				
				if($objects[$c]->text){
					$akvo_card['content'] = truncate($objects[$c]->text, 130);
				}
				
				if($objects[$c]->created_at){
					$akvo_card['date'] = date($date_format,strtotime($objects[$c]->created_at));	
				}
				
				
				if($objects[$c]->photo){
					$akvo_card['img'] = $base_url.$objects[$c]->photo;
				}
				
				if($objects[$c]->absolute_url){
					$akvo_card['link'] = $base_url.$objects[$c]->absolute_url;
				}
			}
			
			
			//$type = 'RSR update';

      		//echo do_shortcode('[akvo-card title="'.$title.'" type="RSR Update" link="'.$link.'" img="'.$thumb.'" content="'.$text.'" date="'.$date.'"]');	
    	}
    	else if ($instance['type'] == 'rsr-project') {
			$data = do_shortcode('[data_feed name="'.$instance['rsr-id'].'"]');
			$data = json_decode( str_replace('&quot;', '"', $data) );
			
			if(isset($data->title)){
				$akvo_card['title'] = $data->title;
			}
			
			if(isset($data->subtitle)){
				$akvo_card['content'] = truncate($data->subtitle, 130);
			}
			
			if(isset($data->created_at)){
				$akvo_card['date'] = date($date_format,strtotime($data->created_at));
			}
			
			if(isset($data->absolute_url)){
				$akvo_card['link'] = $base_url.$data->absolute_url;	
			}
			
			if(isset($data->current_image)){
				$akvo_card['img'] = $base_url.$data->current_image;
			}
			
			if(!$instance['type-text']){
				$instance['type-text'] = 'RSR Project';
			}
			
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
					
					
					global $post_id;
        			$post_type = $instance['type'];
        			
      				$img = wp_get_attachment_url(get_post_thumbnail_id($post_id));	
        			
					if(!$img && $post_type == 'video'){
        				/* featured image is not selected and the type is video */
        				$img = convertYoutubeImg(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
        			}			
					$akvo_card['img'] = $img;
					
					$akvo_card['title'] = get_the_title();
					
					$akvo_card['date'] = get_the_date();
					
					$akvo_card['link'] = get_the_permalink();
					
					$akvo_card['content'] = wp_trim_words(get_the_excerpt());
        		}
        		wp_reset_postdata();
      		}
    	}
		
		
		/* FORM THE SHORTCODE */
		
		$shortcode = '[akvo-card ';
        
        if(isset($akvo_card['img'])){
        	$shortcode .= 'img="'.$akvo_card['img'].'" ';
        }
        			
        if(isset($instance['type-text'])){
        	$shortcode .= 'type-text="'.$instance['type-text'].'" ';
        }
        
        if(isset($akvo_card['title'])){
        	$shortcode .= 'title="'.$akvo_card['title'].'" ';
        }
        
        if(isset($akvo_card['date'])){
        	$shortcode .= 'date="'.$akvo_card['date'].'" ';
        }	
        
        if(isset($akvo_card['content'])){
        	$shortcode .= 'content="'.$akvo_card['content'].'" ';
        }
        
        if(isset($akvo_card['link'])){
        	$shortcode .= 'link="'.$akvo_card['link'].'" ';
        }
        
        
        
        
        
        $shortcode .= 'type="'.$instance['type'].'"]';
        			
        echo do_shortcode($shortcode);
		
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
				'img' => '', 
				'type-text' => ''
			), $atts, 'akvo_card' 
		);
		
		$akvo_card_options = get_option('akvo_card');
		if($akvo_card_options && array_key_exists('read_more_text', $akvo_card_options)){
			$atts['read_more_text'] = $akvo_card_options['read_more_text'];
			if(!$atts['read_more_text']){
				$atts['read_more_text'] = 'Read more';
			}
		}
		
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