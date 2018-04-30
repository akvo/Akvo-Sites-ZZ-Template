<?php
	
	
	include "customize-theme.php";
	
	global $akvo_filters_sort; 
	$akvo_filters_sort = array('Latest', 'Alphabetically');
	

	function akvo_dropdown_filters($arr){	
		$terms = get_terms(array('taxonomy' => $arr['slug'], 'hide_empty' => false));
		if($terms){
			include "templates/dropdown.php";
		}	
	}
	
	function akvo_filter_form($post_type){
		global $post_type;
		$akvo_filters = get_option('akvo_filter');
		if(isset($akvo_filters[$post_type])){
			$akvo_filters[$post_type] = akvo_search_init($akvo_filters[$post_type]);
			include "templates/form.php";
		}
	}
	
	
	function is_akvo_filter_form($post_type){
		$akvo_filters = get_option('akvo_filter');
		if(isset($akvo_filters[$post_type]) and is_array($akvo_filters[$post_type])){
			foreach($akvo_filters[$post_type] as $slug){
				if($slug)
					return true;
			}
			
		}
		return false;
	}
	
	function akvo_search_init($requests){
		$akvo_filter_label = get_option('akvo_filter_label');
		if($requests){
			foreach($requests as $slug => $arr){
				if(!is_array($arr) && $arr){
					$requests[$slug] = array();
					
					$requests[$slug]['slug'] = $slug;
					
					/* setting the label of the filter */
					if(isset($akvo_filter_label[$slug])){
						$requests[$slug]['label'] = $akvo_filter_label[$slug];
					}
					else{
						$taxonomy = get_taxonomy($slug);
						if($taxonomy){
							$requests[$slug]['label'] = $taxonomy->labels->name;
						}
					}
					
					if(isset($_REQUEST['akvo_'.$slug])){
						$val = $_REQUEST['akvo_'.$slug];
						if($val){
							$requests[$slug]['id'] = $val;
						}
					}
					
				}
				elseif(!$arr){
					unset($requests[$slug]);
				}
			}
		}
		return $requests;
	}
	
	function akvo_search_query($query){
		$akvo_filters = get_option('akvo_filter');
		
		$post_type = '';
		
		/* init the request values into the array */
		if(isset($query->query['post_type']) && isset($akvo_filters[$query->query['post_type']])){
			$post_type = $query->query['post_type'];
			$akvo_filters[$post_type] = akvo_search_init($akvo_filters[$post_type]);
		}
		
		/* DEFAULT SORT BY STICKY POSTS, CAN BE OVERRIDEEN LATER */
		if( $query->is_main_query() && isset( $query->query ) && isset( $query->query['post_type'] ) && ('blog' == $query->query['post_type']) ){
			$query->set('orderby', 'meta_value date');	
			$query->set('meta_key', '_post_extra_boxes_checkbox');	 
			$query->set('order', 'DESC'); 
		}
		
		/* check if filtering is even required */
		if(!$post_type || !isset($akvo_filters[$post_type]) || !isset($_REQUEST['akvo-search'])){
			
			
			
			return $query;
		}
		
		
		$args = array();
		
		foreach($akvo_filters[$post_type] as $slug => $arr){
			if(isset($arr['id'])){
				$temp_args = array(
					'taxonomy' => $slug,
					'field' => 'id',
					'terms' => array($arr['id'])
				);
				array_push($args, $temp_args);	
			}
		}
		
		/* SORT ALPHABETICALLY WHEN ASKED FOR, OTHERWISE DEFAULT IS BY LAST DATE */
		if( isset( $_REQUEST['akvo_sort'] ) && ( $_REQUEST['akvo_sort'] == '1' ) ){
			$query->set('orderby', 'post_title');
			$query->set('order', 'ASC'); 	
		}
		
		$query->set('tax_query', $args);
		return $query;
	}
	add_action('pre_get_posts', 'akvo_search_query', 1 );