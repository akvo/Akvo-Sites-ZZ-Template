<?php
	
	add_shortcode( 'akvo-carousel', function(){
		
		$atts = get_option('sage_carousel_options');
		
		$args = array(
			'post_type' => 'carousel'
		);		
		
		$query_carousel = new WP_Query( $args);
		
		ob_start();
		if ( $query_carousel->have_posts() ){
			include "templates/carousel.php";
		}
		return ob_get_clean();
		
	} );
	
	
	add_action('customize_register',  function($wp_customize){
	
		global $akvo_customize;
		
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_carousel_section', 'Carousel', '');
		
		/** COLORS */
		$colors = array(
			'sage_carousel_options[bg_carousel]' => array(
				'default' 	=> '',
				'label' 	=> 'Background Carousel',
			),
			'sage_carousel_options[color_title_carousel]' => array(
				'default' 	=> '',
				'label' 	=> 'Color Title Carousel',
			),
			'sage_carousel_options[color_content_carousel]' => array(
				'default' 	=> '',
				'label' 	=> 'Color Content Carousel',
			)
		);
		
		foreach( $colors as $id => $color ){
			$akvo_customize->color( $wp_customize, 'akvo_carousel_section', $id, $color['label'], $color['default'] );
		}
		/** END OF COLORS */

		/* CAROUSEL INTERVAL */
		$akvo_customize->text( $wp_customize, 'akvo_carousel_section', 'sage_carousel_options[interval]', 'Carousel Interval:', '3000');
		
		
	}, 40);

  	
  	add_action( 'wp_head', function(){
  		
  		$carousel_option = get_option('sage_carousel_options');
    	
		?>
    	<?php if($carousel_option):?>
    	<style type="text/css">
      		.carousel .text{
        		<?php if(isset($carousel_option['bg_carousel'])) echo 'background: '.$carousel_option['bg_carousel'].';'?>
        		<?php if(isset($carousel_option['color_content_carousel'])) echo 'color: '.$carousel_option['color_content_carousel'].';'?>
      		}
      		<?php if(isset($carousel_option['color_title_carousel'])):?>
      		.carousel .text h1{
        		color: <?php echo $carousel_option['color_title_carousel']?>;
      		}
      		<?php endif; ?>
    	</style>
    	<?php endif;
  		
  		
  	} );