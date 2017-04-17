<?php
	
	class Akvo_Card{
		
		function get_ajax_url($action, $atts){
			$url = admin_url('admin-ajax.php')."?action=".$action;
			foreach($atts as $key => $val){
				$url .= "&".$key."=".$val;
			}
			return $url;
			//$url .= "?action=akvo_cards&type=".$atts['type']."&posts_per_page=".$atts['posts_per_page']."&rsr-id=".$atts['rsr-id']."&pagination=".$atts['pagination']."&page=".$atts['page']."&type-text=".$atts['type-text'];
		}
		
		function get_base_url(){
			$base_url = 'http://rsr.akvo.org';
			/* from customise theme */
			$akvo_card_options = get_option('akvo_card');
			if($akvo_card_options && array_key_exists('akvoapp', $akvo_card_options)){
				$base_url = $akvo_card_options['akvoapp'];
			}
			return $base_url;
		}
		
		function get_date_format(){
			return get_option('date_format');
		}
		
		function get_json_data($data_feed_id){
			// Dependancy on the Data Feed Plugin
			$data = do_shortcode('[data_feed name="'.$data_feed_id.'"]');
			return json_decode( str_replace('&quot;', '"', $data) );
			
		}
		
		function parse_post($post){
			/* parsing post object */
			$akvo_card = array(
				'title'		=> '',
				'content'	=> '',
				'date'		=> '',
				'img'		=> '',
				'link'		=> ''
			);
			$akvo_card['img'] = akvo_featured_img($post->ID);
			$akvo_card['title'] = get_the_title($post->ID);
			$akvo_card['date'] = get_the_date(self::get_date_format(), $post->ID);
			$akvo_card['link'] = get_the_permalink($post->ID);
			$akvo_card['content'] = wp_trim_words(get_the_excerpt($post->ID));
			return $akvo_card;	
		}
		
		function parse_rsr_project($rsr_obj){
			/* parsing json object of rsr project */
			$akvo_card = array(
				'title'		=> '',
				'content'	=> '',
				'date'		=> '',
				'img'		=> '',
				'link'		=> '',
				'type-text'	=> 'RSR Project'
			);
			
			if(isset($rsr_obj->title)){
				$akvo_card['title'] = $rsr_obj->title;
			}
			
			if(isset($rsr_obj->project_plan_summary)){
				$akvo_card['content'] = truncate($rsr_obj->project_plan_summary, 130);
			}
			
			if(isset($rsr_obj->created_at)){
				$akvo_card['date'] = date(self::get_date_format(), strtotime($rsr_obj->created_at));
			}
			
			if(isset($rsr_obj->absolute_url)){
				$akvo_card['link'] = self::get_base_url().$rsr_obj->absolute_url;	
			}
			
			if(isset($rsr_obj->current_image)){
				$akvo_card['img'] = self::get_base_url().$rsr_obj->current_image;
			}
			
			return $akvo_card;
		}
		
		function parse_rsr_updates($rsr_obj){
			/* parsing json object of rsr updates */
			
			$akvo_card = array(
				'title'		=> '',
				'content'	=> '',
				'date'		=> '',
				'img'		=> '',
				'link'		=> '',
				'type-text'	=> 'RSR Updates'
			);
			
			if($rsr_obj->title){
				$akvo_card['title'] = $rsr_obj->title;
			}
			
			if($rsr_obj->text){
				$akvo_card['content'] = truncate($rsr_obj->text, 130);
			}
			
			
			if($rsr_obj->created_at){
				$akvo_card['date'] = date(self::get_date_format(), strtotime($rsr_obj->created_at));	
			}
			
			if($rsr_obj->photo){
				$akvo_card['img'] = self::get_base_url().$rsr_obj->photo;
			}
			
			
			if($rsr_obj->absolute_url){
				$akvo_card['link'] = self::get_base_url().$rsr_obj->absolute_url;
			}
			
			return $akvo_card;
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
			
			/* get from customise */
			$akvo_card_options = get_option('akvo_card');
			if($akvo_card_options && array_key_exists('read_more_text', $akvo_card_options)){
				$atts['read_more_text'] = $akvo_card_options['read_more_text'];
			}
			
			include "templates/card.php";
		}
		
		function get_types(){
			$post_type_arr = array(
				'news' 			=> 'News',
				'blog' 			=> 'Blog',
				'video' 		=> 'Videos',
				'testimonial' 	=> 'Testimonials',
				'project' 		=> 'RSR Updates',
				'rsr-project'	=> 'RSR Project',
				'map' 			=> 'Maps',
				'flow' 			=> 'Flow',
				'media' 		=> 'Media Library'
			);
			return $post_type_arr;
		}
	}