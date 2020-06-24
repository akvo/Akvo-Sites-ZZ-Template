<?php

class MC_API{

	function __construct(){
		add_shortcode( 'mc_akvo_updates', array( $this, 'updates_shortcode' ) );

		add_shortcode( 'akvo_rsr_project_updates', array( $this, 'home_updates_shortcode' ) );


	}

	function home_updates_shortcode( $atts ){
		$atts = shortcode_atts( array(
			'feed'					=> 'Sample',
			'limit'					=> 3,
			'rsr_link_flag'	=> 0
		), $atts, 'akvo_rsr_project_updates' );

		ob_start();
		$json_data = mf_rsr_api( $atts['feed'] );
		$this->list_updates( $json_data, $atts['limit'], $atts['rsr_link_flag'] );
		return ob_get_clean();
	}

	function updates_shortcode( $atts ){

		$atts = shortcode_atts( array(
			'page'	=> 1,
			'limit'	=> 9
		), $atts, 'mc_akvo_updates' );

		ob_start();

		global $mc_api;

		$update_id = isset( $_GET['id'] ) && $_GET['id'] ? $_GET['id'] : 0;

		$atts['page'] = isset( $_GET['card-page'] ) && $_GET['card-page'] ? $_GET['card-page'] : $atts['page'];

		$url = 'https://rsr.akvo.org/rest/v1/project_update/?format=json';

		if( $update_id ){
			$url .= "&image_thumb_name=big&id=" . $update_id;
		}
		else{
			$url .= "&filter={'project__partners__in':[4239]}&image_thumb_name=big";

			// ADD PAGINATION PARAMETERS TO THE URL
			$url .= "&limit=" . $atts['limit']."&page=" . $atts['page'];
		}

		$response = $mc_api->response( $url );

		if( $update_id ){
			$project_update = isset( $response->results ) && count( $response->results ) ? $response->results[0] : array();
			if( !is_array( $project_update ) ){
				include( 'templates/mc_akvo_single_update.php' );
			}
		}
		else{
			$total_items = 0;
			if( isset( $response->count ) ){
				$total_items = $response->count;
			}

			include( 'templates/mc_akvo_updates.php' );
		}

		return ob_get_clean();
	}

	function request( $url ){
		$args['headers'] = array(
			'Authorization' => 'Token a6a0e042562bdb3c293d8df3874f84f9f55f9c7f',
		);
		return wp_remote_get( $url, $args );
	}

	function response( $url ){
		$_json_expiration = 60 * 15; // 15 minutes
		$key = md5( $url );
		$data = array();
		if ( ! ( $data = get_transient($key) ) ) {
			$request = $this->request( $url );

			if( ! is_wp_error( $request ) ) {

				$body = wp_remote_retrieve_body( $request );

				$data = json_decode( $body );		// MORE OF YOUR CODE HERE

				set_transient($key, $data, $_json_expiration); // IF IT IS NEW, SET THE TRANSIENT FOR NEXT TIME
			}
		}
		return $data;
	}

	function get_photo_url( $update ){
		$photo_url = "";
		if( isset( $update->photo->original ) ){
			$photo_url = $update->photo->original;
		}
		elseif( isset( $update->photo ) ){
			$photo_url = $update->photo;
		}
		return $photo_url;
	}

	function get_templink( $update, $rsr_link_flag = 0 ){
		if( !$rsr_link_flag || $rsr_link_flag == '0' ){
			return get_bloginfo('url') . "/updates/?id=" . $update->id;
		}
		return "https://mcf.akvoapp.org" . $update->absolute_url;
	}

	function get_published_date( $update ){
		return date( "d M Y", strtotime( $update->created_at ) );
	}

	function list_updates( $json_data, $limit = 9, $rsr_link_flag = 0 ){
		if( isset( $json_data->results ) ){
			echo "<ul class='list-unstyled list-rsr-updates'>";
			for( $i = 0; $i < $limit; $i++ ):if( isset( $json_data->results[ $i ] ) ):?>
				<li class='rsr-update'>
					<a href='<?php _e( $this->get_templink( $json_data->results[ $i ], $rsr_link_flag ) );?>'>
						<div class="bg-image" style="background-image:url('<?php _e( $this->get_photo_url( $json_data->results[ $i] ) );?>');"></div>
						<h4><?php _e( $json_data->results[ $i ]->title );?></h4>
						<div class='date'><?php _e( "Published on ". $this->get_published_date( $json_data->results[$i] ) );?></div>
					</a>
				</li>
			<?php endif; endfor;
			echo "</ul>";
		}
	}

	function pagination( $total, $items_per_page, $current_page ){
		$num_pages = ceil( $total / $items_per_page );
		if( $num_pages > 1 ){
			include( "templates/pagination.php" );
		}
	}

	function page_num( $num, $current_page = 1 ){
		$link = "?card-page=".$num;
		if( $current_page == $num ){
			echo '<span aria-current="page" class="page-numbers current">' . $num . '</span>';
		}
		else{
			echo '<a class="page-numbers" data-page="' . $num . '" href="' . $link . '">' . $num . '</a>';
		}
	}

	function url( $flag ){
		switch( $flag ){
			case 'home':
				return site_url( 'mastercard' );
				//return get_bloginfo( 'url' );

			case 'updates':
				return site_url('updates');
		}
	}



}

global $mc_api;
$mc_api = new MC_API;
