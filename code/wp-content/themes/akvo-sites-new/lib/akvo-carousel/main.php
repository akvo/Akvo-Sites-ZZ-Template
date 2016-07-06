<?php
	
	function akvo_carousel(){
		
		$atts = get_option('sage_carousel_options');
		
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
	
	
	function akvo_carousel_customize_register($wp_customize){
		//Carousel
    	$wp_customize->add_section('sage_carousel_scheme', array(
      		'title'    => __('Carousel', 'sage'),
      		'description' => '',
      		'priority' => 40,
     	));

    	// add color picker setting
    	$wp_customize->add_setting( 'sage_carousel_options[bg_carousel]', array(
      		'default' => '',
      		'type'    => 'option',
      	) );

    	// add color picker control
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'bg_carousel', array(
          			'label' => 'Background Carousel',
          			'section' => 'sage_carousel_scheme',
          			'settings' => 'sage_carousel_options[bg_carousel]',
    	)));

    	// add color picker setting
    	$wp_customize->add_setting( 'sage_carousel_options[color_title_carousel]', array(
      		'default' => '',
      		'type'    => 'option',
      	) );

    	// add color picker control
    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'color_title_carousel', array(
          			'label' => 'Color Title Carousel',
          			'section' => 'sage_carousel_scheme',
          			'settings' => 'sage_carousel_options[color_title_carousel]',
    	) ) );

	    // add color picker setting
    	$wp_customize->add_setting( 'sage_carousel_options[color_content_carousel]', array(
      		'default' => '',
      		'type'    => 'option',
      	) );

	    // add color picker control
    	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
		        $wp_customize, 'color_content_carousel', array(
        		  'label' => 'Color Content Carousel',
		          'section' => 'sage_carousel_scheme',
		          'settings' => 'sage_carousel_options[color_content_carousel]',
        	) ) );

   		$wp_customize->add_setting('sage_carousel_options[interval]', array(
       		'default' => '3000',
       		'capability' => 'edit_theme_options',
       		'type'       => 'option',
    	));
 		
		$wp_customize->add_control('sage_carousel_options[interval]', array(
			'settings' => 'sage_carousel_options[interval]',
    		'type' => 'text',
        	'label' => 'Carousel Interval:',
        	'section' => 'sage_carousel_scheme',
        ));
	}

	add_action('customize_register', 'akvo_carousel_customize_register',40);

  	function akvo_carousel_customize_head_styles() {
    	$carousel_option = get_option('sage_carousel_options');
    	
		?>
    	<?php if($carousel_option):?>
    	<style type="text/css">
      		.carousel .text{
        		<?php if($carousel_option['bg_carousel']) echo 'background: '.$carousel_option['bg_carousel'].';'?>
        		<?php if($carousel_option['color_content_carousel']) echo 'color: '.$carousel_option['color_content_carousel'].';'?>
      		}
      		<?php if($carousel_option['color_title_carousel']):?>
      		.carousel .text h1{
        		color: <?php echo $carousel_option['color_title_carousel']?>;
      		}
      		<?php endif; ?>
    	</style>
    	<?php endif;
	}
  	add_action( 'wp_head', 'akvo_carousel_customize_head_styles' );