<?php
	
	include "customize-theme.php";
	
	include "single-widget.php";
	
	include "pin-widget.php";
	
	function akvo_cards($atts){
		$data = array();
		$atts = shortcode_atts(
			array(
				'type' => 'post',
				'posts_per_page' => 3,
				'rsr' => 'rsr',
				'pagination' => false
			), $atts, 'akvo_cards' 
		);
		
		
		$page = 1;
			
		if(isset($_GET['akvo-paged'])){
			$page = $_GET['akvo-paged'];
		}	
		
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
		
		ob_start();
		include "templates/cards.php";
		return ob_get_clean();
	}
	add_shortcode( 'akvo-cards', 'akvo_cards' );
	
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