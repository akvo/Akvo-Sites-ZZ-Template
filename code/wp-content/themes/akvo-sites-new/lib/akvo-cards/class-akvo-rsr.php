<?php

	class AKVO_RSR{
		
		function get_json_data( $data_feed_id ){
			
			$data = do_shortcode('[data_feed name="'.$data_feed_id.'"]'); 		/* Dependancy on the Data Feed Plugin */
			
			return json_decode( str_replace('&quot;', '"', $data) );
		}
		
		/* GET DATA FEEDS FROM THE DATABASE */
		function get_data_feeds(){
			global $wpdb;
			
			$data_feeds = array();
			
			$rows = $wpdb->get_results( 'SELECT df_name FROM ' . $wpdb->prefix . 'data_feeds' );
			
			foreach( $rows as $row ){
				$data_feeds[ $row->df_name ] = $row->df_name;
			}
			
			return $data_feeds;
			
		}
		
		
		
	}
	
	global $akvo_rsr;
	$akvo_rsr = new AKVO_RSR;