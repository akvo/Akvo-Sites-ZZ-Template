<?php

	function getCustomFonts(){

		return $markFonts = array(
			'MarkForMCExtraLt',
			//'MarkForMCExtraLtIt',
			'MarkForMCLt',
			//'MarkForMCLtIt',
			//'MarkForMCBookIt',
			//'MarkForMCBookIt',
			'MarkForMCMed',
			//'MarkForMCMedIt.ttf',
			//'MarkForMCBold.ttf',
			//'MarkForMCBoldIt'
		);
	}

	function getFontURL( $font ){
		return get_stylesheet_directory_uri().'/fonts/'.$font.'.ttf';
	}

	add_action( 'akvo_sites_css', function(){
		$fonts = getCustomFonts();
		foreach( $fonts as $font ){
			_e("@font-face {	font-family: '".$font."'; src: url('".getFontURL( $font )."');}");
			echo "\r\n";
		}

	} );

	add_action( 'wp_enqueue_scripts', function(){
		//wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', false, '3.0.1' );
   	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('sage_css'), '1.0.8');

		wp_enqueue_script( 'mastercard', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0.0');

		$fonts = getCustomFonts();
		foreach( $fonts as $font ){
			wp_enqueue_style( $font, getFontURL( $font ), false, null );
		}

	} );

	/*
	add_filter('akvo_fonts', function($fonts){

		$markFonts = array(
			'MarkForMCExtraLt',
			//'MarkForMCExtraLtIt',
			//'MarkForMCLt',
			//'MarkForMCLtIt',
			//'MarkForMCBook',
			//'MarkForMCBookIt',
			'MarkForMCMed',
			//'MarkForMCMedIt.ttf',
			//'MarkForMCBold.ttf',
			//'MarkForMCBoldIt'
		);

		foreach( $markFonts as $markFont ){
			$fonts[] = array(
				'slug'	=> $markFont,
				'name'	=> $markFont,
				'url'	=> get_stylesheet_directory_uri().'/fonts/'.$markFont.'.ttf'
			);
		}

		return $fonts;
	});
	*/

	add_shortcode( 'akvo_rsr_project_field', function( $atts ){
		global $akvo_rsr;
		$atts = shortcode_atts( array(
			'feed'	=> 'Sample',
			'field'	=> 'project_plan'
		), $atts, 'akvo_rsr_project_field' );

		$json_data = $akvo_rsr->get_data_feed_response( $atts['feed'] );

		$field = $atts['field'];

		if( isset( $json_data->$field ) ){
			return $json_data->$field;
		}
	} );

	add_shortcode( 'akvo_rsr_project_updates', function( $atts ){
		global $akvo_rsr;
		$atts = shortcode_atts( array(
			'feed'	=> 'Sample',
			'limit'	=> 3
		), $atts, 'akvo_rsr_project_updates' );

		$api_key = "a6a0e042562bdb3c293d8df3874f84f9f55f9c7f";

		$json_data = $akvo_rsr->get_data_feed_response( $atts['feed'], $api_key );



		ob_start();

		$base_url = "https://mcf.akvoapp.org"; //https://rsr.akvo.org



		if( isset( $json_data->results ) ){
			echo "<ul class='list-unstyled list-rsr-updates'>";
			for( $i = 0; $i < $atts['limit']; $i++ ){
				if( isset( $json_data->results[ $i ] ) ){

					$akvo_date = date( "d M Y", strtotime( $json_data->results[$i]->created_at ) );

					$link = $base_url.$json_data->results[$i]->absolute_url;

					$photo_url = "";
					if( isset( $json_data->results[ $i]->photo->original ) ){
						$photo_url = $base_url.$json_data->results[ $i]->photo->original;
					}
					else{
						$photo_url = $base_url.$json_data->results[ $i]->photo;
					}

					?>

					<li class='rsr-update'>
						<a href='<?php _e( $link );?>'>
							<div class="bg-image" style="background-image:url('<?php _e( $photo_url );?>');"></div>
							<h4><?php _e( $json_data->results[ $i ]->title );?></h4>
							<div class='date'><?php _e( "Published on ". $akvo_date );?></div>
						</a>
					</li>

					<?php

				}
			}
			echo "</ul>";
		}

		return ob_get_clean();

	} );
