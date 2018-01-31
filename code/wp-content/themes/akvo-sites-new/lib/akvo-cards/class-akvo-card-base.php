<?php 
	
	class AKVO_CARD_BASE{
		
		function get_ajax_url($action, $atts, $dont_inc = array()){
			$url = admin_url('admin-ajax.php')."?action=".$action;
			foreach($atts as $key => $val){
				if(!in_array($key, $dont_inc)){
					$url .= "&".$key."=".$val;
				}	
			}
			return $url;
		}
		
		function rsr_updates($atts){
			
			$data = array();
			$jsondata = self::get_json_data($atts['rsr-id']);
			
			$offset = self::get_offset( $atts ); //(((int)$atts['page'] - 1) * (int)$atts['posts_per_page']) + (int)$atts['offset'];
			
			for($i = $offset; $i < $offset+$atts['posts_per_page']; $i++){
				$temp = self::parse_rsr_updates($jsondata->results[$i]);
				
				/* adding extra params */
				$temp = self::add_extra_params($temp, $atts);
				
				array_push($data, $temp);
			}
			return $data;
		}
		
		
		function rsr_project($atts){
			$data = array();
			$jsondata = self::get_json_data($atts['rsr-id']);
			
			// SINGULAR DATA
			if( !isset( $jsondata->results ) ){
				
				$temp = self::parse_rsr_project($jsondata);
				
				/* adding extra parameters to the akvo_card array */
				$temp = self::add_extra_params($temp, $atts);
				
				array_push($data, $temp);
			}
			else{
				// MULTIPLE VALUES
				$offset = self::get_offset( $atts );
				
				for($i = $offset; $i < $offset+$atts['posts_per_page']; $i++){
					$temp = self::parse_rsr_project($jsondata->results[$i]);
					
					/* adding extra params */
					$temp = self::add_extra_params($temp, $atts);
					
					array_push($data, $temp);
				}
				
			}
			
			return $data;
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
		
		function form_shortcode($data){
			$shortcode = '[akvo-card ';
        		
        		foreach($data as $key=>$val){
        		
        			$val = str_replace("[","&#91;",$val);
        			$val = str_replace("]","&#93;",$val);
        			
        			$shortcode .= $key.'="'.$val.'" ';
        		}
        		$shortcode .= ']';
        		

        		
        		return $shortcode;
		}
		
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
		
		/* add extra params from one array to another */
		function add_extra_params($data, $atts, $extras = array('type-text', 'type')){
			foreach($extras as $extra){
				if($atts[$extra]){
					$data[$extra] = $atts[$extra];
				}	
			}
			return $data;
		}	
		
		/* WP QUERY */
		function wp_query($atts){
			$data = array();
			
			$query_atts = array(
				'post_type' 	=> $atts['type'],
        		'posts_per_page' => $atts['posts_per_page'],
        		'offset'	=> self::get_offset( $atts ),
			);
			
			/* TAXONOMY QUERY - CUSTOM TYPES AND TERMS */
			if( isset( $atts['taxonomy'] ) && isset( $atts['filter_by'] ) ){
				$query_atts['tax_query'] = array(
					array(
						'taxonomy' => $atts['taxonomy'],
						'field'    => 'slug',
						'terms'    => $atts['filter_by'],
					)
				);
			}
			
			
			
			$query = new WP_Query( $query_atts );
			
			if ( $query->have_posts() ) { 
				while ( $query->have_posts() ) {
					$query->the_post();
					
          			$temp = self::parse_post($query->post);
          			
          			/* adding extra params */
					$temp = self::add_extra_params($temp, $atts);
					
					array_push($data, $temp);
          		}
				wp_reset_postdata();
			}
			return $data;
		}
		
		/* Iterate through RSR updates */
		function get_offset( $atts ){
			return (((int)$atts['page'] - 1) * (int)$atts['posts_per_page']) + (int)$atts['offset'];
		}
		
	}