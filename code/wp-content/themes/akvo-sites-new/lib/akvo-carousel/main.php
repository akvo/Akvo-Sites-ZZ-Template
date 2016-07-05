<?php
	
	function akvo_carousel($atts){
		
		$atts = shortcode_atts(
			array(
				'interval' => 3000
			), $atts, 'akvo_carousel' 
		);
		
		
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
	
	
	