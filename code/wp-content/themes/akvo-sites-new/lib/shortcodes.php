<?php


	function akvo_carousel(){
	
		$args = array(
			'post_type' => 'carousel'
		);		
		
		$query_carousel = new WP_Query( $args);
		
		ob_start();
		if ( $query_carousel->have_posts() ) : 
			include "templates/carousel.php";
		endif;
		return ob_get_clean();
	}

	add_shortcode( 'akvo-carousel', 'akvo_carousel' );
	
	
	function akvo_cards($atts){
		$data = array();
		$atts = shortcode_atts(
			array(
				'type' => 'post',
				'posts_per_page' => 3,
			), $atts, 'akvo_cards' 
		);
		
		if ($atts['type'] == 'rsr') {
			$date_format = get_option( 'date_format' );
			$jsondata = do_shortcode('[data_feed name="rsr"]');
      		$jsondata = json_decode( str_replace('&quot;', '"', $jsondata) );
			
			for($i=0; $i<$atts['posts_per_page']; $i++){
				$temp = array();
				
				$temp['title'] = $jsondata->objects[$i]->title;
				
				
				$temp['content'] = $jsondata->objects[$i]->text;
      			$temp['date'] = date($date_format, strtotime($jsondata->objects[$i]->time));
				
				$temp['type'] = 'RSR Update';
				
				
				if($jsondata->objects[$i]->photo){
					$temp['img'] = 'http://rsr.akvo.org'.$jsondata->objects[$i]->photo;
				}
					
      			$temp['link'] = 'http://rsr.akvo.org'.$jsondata->objects[$i]->absolute_url;
				
				array_push($data, $temp);
			}
		}
		else {
			
      		$qargs = array(
        		'post_type' => $atts['type'],
        		'posts_per_page' => $atts['posts_per_page']
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
				'img' => get_bloginfo('template_url').'/dist/images/placeholder800x400.jpg'
			), $atts, 'akvo_card' 
		);
		ob_start();
		include "templates/card.php";
		return ob_get_clean();
	}
	add_shortcode( 'akvo-card', 'akvo_card' );