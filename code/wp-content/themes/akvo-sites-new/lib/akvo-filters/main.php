<?php
	
	
	include "customize-theme.php";
	
	
	

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
		if($requests){
			foreach($requests as $slug => $arr){
				if(!is_array($arr) && $arr){
					$requests[$slug] = array();
					
					$requests[$slug]['slug'] = $slug;
					
					$taxonomy = get_taxonomy($slug);
					if($taxonomy){
						$requests[$slug]['label'] = $taxonomy->labels->name;
					
						if(isset($_REQUEST['akvo_'.$slug])){
							$val = $_REQUEST['akvo_'.$slug];
					
							if($val){
								$requests[$slug]['id'] = $val;
							}
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
		
		$query->set('tax_query', $args);
		return $query;
	}
	add_action('pre_get_posts', 'akvo_search_query', 1 );