<?php

include("color.php");
use Mexitek\PHPColors\Color;

	function akvo_customize_register( $wp_customize ) {

   		/* All our sections, settings, and controls will be added here */
		
		$wp_customize->add_section( 'akvo_color' , array(
	    	'title'      => __( 'Adjust colours', 'sage' ),
	    	'priority'   => 30,
	    	//'active_callback' => 'create_scss'
		) );
		
		//main
		$wp_customize->add_setting( 'main_color' , array(
	    	'default'     => '#00a99d',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
			'label'        => __( 'Main Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'main_color',
		) ) );
	
		//background
		$wp_customize->add_setting( 'background' , array(
	    	'default'     => '#ffffff',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background', array(
			'label'        => __( 'Background', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'background',
		) ) );
	
		//grijskleur
		$wp_customize->add_setting( 'grijs' , array(
	   		'default'     => '#e6e6e6',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grijs', array(
			'label'        => __( 'Shades of grey', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'grijs',
		) ) );
	
		//bar
		$wp_customize->add_setting( 'info_bar_blog' , array(
	    	'default'     => '#a3d165',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_blog', array(
			'label'        => __( 'Blog Post Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_blog',
		) ) );

		//bar
		$wp_customize->add_setting( 'info_bar_news' , array(
	    	'default'     => '#f9ba41',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_news', array(
			'label'        => __( 'News Post Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_news',
		) ) );

		//bar
		$wp_customize->add_setting( 'info_bar_video' , array(
	    	'default'     => '#f47b50',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_video', array(
			'label'        => __( 'Video Post Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_video',
		) ) );
		
		//bar
		$wp_customize->add_setting( 'info_bar_update' , array(
	    	'default'     => '#54bce8',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_update', array(
			'label'        => __( 'Update Post Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_update',
		) ) );

		//bar
		$wp_customize->add_setting( 'info_bar_page' , array(
	    	'default'     => '#6d3a7d',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_page', array(
			'label'        => __( 'Page Post Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_page',
		) ) );
		//bar
		$wp_customize->add_setting( 'info_bar_project' , array(
	    	'default'     => '#7381fa',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_project', array(
			'label'        => __( 'Project Update Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_project',
		) ) );
		//bar
		$wp_customize->add_setting( 'info_bar_map' , array(
		    'default'     => '#ad1c3c',
	    	'transport'   => 'refresh',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_map', array(
			'label'        => __( 'Map Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_map',
		) ) );
		//bar
		$wp_customize->add_setting( 'info_bar_testimonial' , array(
		    'default'     => '#007ba8',
	    	'transport'   => 'refresh',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_testimonial', array(
			'label'        => __( 'Testimonial Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_testimonial',
		) ) );
	
		//bar
		$wp_customize->add_setting( 'info_bar_flow' , array(
	    	'default'     => '#54bce8',
	    	'transport'   => 'refresh',
	    	'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_flow', array(
			'label'        => __( 'Flow Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_flow',
		) ) );
	
		//bar
		$wp_customize->add_setting( 'info_bar_media' , array(
		    'default'     => '#9d897b',
	    	'transport'   => 'refresh',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_media', array(
			'label'        => __( 'Media item Color', 'sage' ),
			'section'    => 'akvo_color',
			'settings'   => 'info_bar_media',
		) ) );
	

		//logo
		$wp_customize->add_section( 'akvo_logo_section' , array(
	    	'title'       => __( 'Logo', 'sage' ),
	    	'priority'    => 30,
	    	'description' => 'Upload your logo',
		) );

		$wp_customize->add_setting( 'akvo_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'akvo_logo', array(
	    	'label'    => __( 'Logo', 'sage' ),
	    	'section'  => 'akvo_logo_section',
	   		'settings' => 'akvo_logo',
		) ) );

		
      	
      	$wp_customize->add_setting( 'akvo_logo_size' );
		
		$wp_customize->add_control('akvo_logo_size', array(
      		'settings' => 'akvo_logo_size',
      		'label'    => __('Use Original Logo Size'),
      		'section'  => 'akvo_logo_section',
      		'type'     => 'checkbox',
      		'std' => 1
      	));
      	
      	
      	$logo_location_arr = array(
      		'left'	=> 'Left',
      		'right'	=> 'Right'
      	);
      	
      	$wp_customize->add_setting( 'akvo_logo_location', array(
      		'default' 		=> 'left',
      		'transport'   	=> 'refresh',
      		'type' 			=> 'option'
      	)  );
		
		$wp_customize->add_control('akvo_logo_location', array(
      		'settings' 	=> 'akvo_logo_location',
      		'label'    	=> __('Logo location'),
      		'section'  	=> 'akvo_logo_section',
      		'type'     	=> 'select',
      		'choices' 	=> $logo_location_arr
      	));
      	
		//fonts
		
		$fonts_arr = array(
			'Open Sans' 	=> 'Open Sans',
	        'Roboto' 		=> 'Roboto',
	        'Lora' 			=> 'Lora',
	        'Raleway' 		=> 'Raleway',
	        'Merriweather'	=> 'Merriweather',
	        'Arvo' 			=> 'Arvo',
	        'Muli' 			=> 'Muli',
	        'Alegreya' 		=> 'Alegreya',
	        'Exo 2' 		=> 'Exo 2',
	        'Crimson Text' 	=> 'Crimson Text',
	        'Lobster Two' 	=> 'Lobster Two',
	        'Maven Pro' 	=> 'Maven Pro',
	        'Arial'			=> 'Arial'
		);
		
		$fonts_arr = apply_filters('akvo_fonts', $fonts_arr);
		
		$wp_customize->add_section( 'akvo_font_section' , array(
	    	'title'       => __( 'Font', 'sage' ),
		    'priority'    => 30,
		    'description' => 'Select site typography',
		) );
		$wp_customize->add_setting( 'akvo_font_head', array(
			'default' => 'Open Sans',
		    'transport'   => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font_head', array(
			'type' 		=> 'select',
		    'label'    => __( 'Header font', 'sage' ),
		    'section'  => 'akvo_font_section',
		    'settings' => 'akvo_font_head',
		    'choices' => $fonts_arr
		));
		$wp_customize->add_setting( 'akvo_font_nav', array(
	    	'default' => 'Open Sans',
	     	'transport'   => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font_nav', array(
			'type' 		=> 'select',
		    'label'    => __( 'Navigation font', 'sage' ),
		    'section'  => 'akvo_font_section',
		    'settings' => 'akvo_font_nav',
		    'choices' => $fonts_arr
		));
		$wp_customize->add_setting( 'akvo_font', array(
	    	 'default' => 'Open Sans',
	     	'transport'   => 'refresh',
		));
		$wp_customize->add_control( 'akvo_font', array(
			'type' 		=> 'select',
		    'label'    => __( 'Body font', 'sage' ),
		    'section'  => 'akvo_font_section',
		    'settings' => 'akvo_font',
		    'choices' => $fonts_arr
		));

		$wp_customize->remove_section( 'nav');
		$wp_customize->remove_section( 'static_front_page');
		
		/* ARTICLE SECTION */
		$wp_customize->add_section( 'article_section' , array(
	    	'title'       => __( 'Article (Single Posts)', 'sage' ),
		    'priority'    => 30,
		    'description' => 'Select Article styles for single posts, akvopedia, etc',
		) );
		
		/* font size of the title */
		$wp_customize->add_setting( 'akvo_article[title_font_size]', array(
      		'default' => '24px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[title_font_size]', array(
			'settings' => 'akvo_article[title_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article title:',
        	'section' => 'article_section',
        ));
        
        /* font-size of the meta */
        $wp_customize->add_setting( 'akvo_article[meta_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[meta_font_size]', array(
			'settings' => 'akvo_article[meta_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article meta (date, etc):',
        	'section' => 'article_section',
        ));
        
        /* font-size of the content */
        $wp_customize->add_setting( 'akvo_article[content_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control('akvo_article[content_font_size]', array(
			'settings' => 'akvo_article[content_font_size]',
    		'type' => 'text',
        	'label' => 'Font size of the article content:',
        	'section' => 'article_section',
        ));
        
        /* END OF ARTICLE SECTION */
        
        
        /* EVENTS SECTION */
		
		$wp_customize->add_section( 'events_section' , array(
	    	'title'       => __( 'Events', 'sage' ),
		    'priority'    => 30,
		    'description' => 'Customize templates for events',
		) );
		
		$wp_customize->add_setting('akvo_events[title_font_size]', array(
      		'default' => '16px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[title_font_size]', array(
		    'label'    => __( 'Title: Font size', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[title_font_size]',
		));
		
		$wp_customize->add_setting('akvo_events[title_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );

    	$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[title_color]', array(
          			'label' => 'Title: Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[title_color]',
    	)));
		
		
		
		$wp_customize->add_setting('akvo_events[btn_text]', array(
      		'default' => 'View All Events',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[btn_text]', array(
		    'label'    => __( 'Button Text', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[btn_text]',
		));
		
		$wp_customize->add_setting('akvo_events[btn_bg_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[btn_bg_color]', array(
          			'label' => 'Button: BG Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[btn_bg_color]',
    	)));
		$wp_customize->add_setting('akvo_events[btn_color]', array(
      		'default' => '#000000',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control( 
      		new WP_Customize_Color_Control( 
        		$wp_customize, 'akvo_events[btn_color]', array(
          			'label' => 'Button: Color',
          			'section' => 'events_section',
          			'settings' => 'akvo_events[btn_color]',
    	)));
		
		$wp_customize->add_setting('akvo_events[btn_font_size]', array(
      		'default' => '14px',
      		'transport'   => 'refresh',
      		'type' => 'option'
      	) );
		$wp_customize->add_control('akvo_events[btn_font_size]', array(
		    'label'    => __( 'Button: Font size', 'akvo' ),
	    	'section'  => 'events_section',
		    'settings' => 'akvo_events[btn_font_size]',
		));
		
	}
	add_action( 'customize_register', 'akvo_customize_register' );

// retrieves the attachment ID from the file URL
function pn_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

function mytheme_customize_css(){

	$main = get_theme_mod('main_color');
	
	if (empty( $main )) $main = '#00a99d';
	$main2 = new Color("$main"); 
	$licht = '#'.$main2->mix('ffffff', 10);
	$donker = '#'.$main2->darken();

	$grijs = get_theme_mod('grijs');
	if (empty( $grijs )) $grijs = '#e6e6e6';
	$grijs2 = new Color("$grijs");
	$lichtgrijs = '#'.$grijs2->lighten(5);
	$donkergrijs = '#'.$grijs2->darken(10);
	if($grijs == "#ffffff") $hovergrijs = "#e6e6e6";
	else $hovergrijs = $grijs;

	$font = get_theme_mod('akvo_font');
	if (empty( $font )) $font = 'Open Sans';

	$font_head = get_theme_mod('akvo_font_head');
	if (empty( $font_head )) $font_head = 'Open Sans';

	$font_nav = get_theme_mod('akvo_font_nav');
	if (empty( $font_nav )) $font_nav = 'Open Sans';

	$background = get_theme_mod('background');
	if (empty( $background )) $background = '#ffffff';

	$info_bar_blog = get_theme_mod('info_bar_blog');
	if (empty( $info_bar_blog )) $info_bar_blog = '#a3d165';

	$info_bar_news = get_theme_mod('info_bar_news');
	if (empty( $info_bar_news ))  $info_bar_news = '#f9ba41';

	$info_bar_video = get_theme_mod('info_bar_video');
	if (empty( $info_bar_video )) $info_bar_video = '#f47b50';

	$info_bar_update = get_theme_mod('info_bar_update');
	if (empty( $info_bar_update )) $info_bar_update = '#54bce8';

	$info_bar_flow = get_theme_mod('info_bar_flow');
	if (empty( $info_bar_flow )) $info_bar_flow = '#54bce8';

	$info_bar_page = get_theme_mod('info_bar_page');
	if (empty( $info_bar_page )) $info_bar_page = '#6d3a7d';

	$info_bar_media = get_theme_mod('info_bar_media');
	if (empty( $info_bar_media )) $info_bar_media = '#9d897b';

	$info_bar_project = get_theme_mod('info_bar_project');
	if (empty( $info_bar_project )) $info_bar_project = '#7381fa';

	$info_bar_map = get_theme_mod('info_bar_map');
	if (empty( $info_bar_map )) $info_bar_map = '#ad1c3c';

	$info_bar_testimonial = get_theme_mod('info_bar_testimonial');
	if (empty( $info_bar_testimonial )) $info_bar_testimonial = '#007ba8';
	
	$akvo_article = get_option('akvo_article');
	
	$akvo_events = get_option('akvo_events');
	
    ?>
         <style type="text/css">
         	html {background:<?php echo $donker;?>; }
            body { font-family: '<?php echo $font; ?>'; background: <?php echo $background; ?>;}
            h1,h2,h3,h4,h5,h6 { font-family: '<?php echo $font_head; ?>';  }
            nav { font-family: '<?php echo $font_nav; ?>'; }
            .carousel .text, footer .twitter, nav ul.navbar-nav li.current-menu-item a, .carousel .carousel-indicators li.active { background: <?php echo $licht;?> !important; }
            nav .lang .fa-circle, nav ul.navbar-nav li i { color: <?php echo $main;?>; }
            .btn-default, .filters #uwpqsf_id #uwpqsf_btn input, footer .custom { background: <?php echo $main;?>; }
            nav ul.navbar-nav li .fa-circle, a { color: <?php echo $main;?>; }
            a:hover {color:<?php echo $donker;?>;}
            .btn-default:focus, .btn-default:hover, .filters #uwpqsf_id #uwpqsf_btn input:focus, .filters #uwpqsf_id #uwpqsf_btn input:hover, footer .fixed, .comment-form footer .custom input[type=submit], .filters #uwpqsf_id #uwpqsf_btn footer .custom input, footer .custom .btn, footer .custom .comment-form input[type=submit], footer .custom .filters #uwpqsf_id #uwpqsf_btn input { background: <?php echo $donker;?>; }
         	.card, .article .bg, article .bg, .filters, .breadcrumbs, .search-wrap { background: <?php echo $lichtgrijs;?>;}
         	
         	
         	.card .card-info.blog{ background: <?php echo $info_bar_blog; ?>; }
         	.card .card-info.post{ background: <?php echo $info_bar_news;?>; }
         	.card .card-info.video{ background: <?php echo $info_bar_video;?>; }
         	.card .card-info.rsr-update{ background: <?php echo $info_bar_update;?>; }
         	.card .card-info.page{ background: <?php echo $info_bar_page;?>; }
         	.card .card-info.media{ background: <?php echo $info_bar_media;?>; }
         	.card .card-info.map{ background: <?php echo $info_bar_map;?>; }
         	.card .card-info.project{ background: <?php echo $info_bar_project;?>; }
         	.card .card-info.testimonial{ background: <?php echo $info_bar_testimonial;?>; }
         	.card .card-info.flow{ background: <?php echo $info_bar_flow;?>; }
         	.card .card-info.news{ background: <?php echo $info_bar_news;?>; }
         	
         	nav ul.navbar-nav li {background: <?php echo $grijs;?>;}
         	nav ul.navbar-nav .dropdown-menu li a {background: <?php echo $grijs;?>; }
         	.clickable:hover .text {background: <?php echo $main;?>;}
         	.box-wrap:hover {background: <?php echo $hovergrijs;?>;}
         	.search-wrap .input-group-btn .btn {color:<?php echo $donkergrijs;?>;}
         	
         	/*
         	nav ul.navbar-nav .dropdown-menu li { background: <?php echo $licht;?>;}
         	*/
         	
         	.nav>li>a:focus, .nav>li>a:hover {background:<?php echo $licht;?>; }
         	blockquote {border-color: $donkergrijs;}
         	@media (min-width: 768px) {
         		nav  {background: <?php echo $lichtgrijs;?>;}
         		nav ul.navbar-nav li a:hover, nav ul.navbar-nav li:hover a { background: <?php echo $licht;?>;}
         		nav ul.navbar-nav .dropdown-menu li a:hover {background: <?php echo $main;?>; }
         		
         		nav ul.navbar-nav .dropdown-menu li.current-menu-item a{background: <?php echo $main;?>;}
         	}
         	
         	
         	<?php if($akvo_article):?>
         	article header h3{
         		<?php if(isset($akvo_article['title_font_size'])):?>
         		font-size: <?php _e($akvo_article['title_font_size'])?>;
         		<?php endif;?>
         	}
         	
         	article .meta{
         		<?php if(isset($akvo_article['meta_font_size'])):?>
         		font-size: <?php _e($akvo_article['meta_font_size'])?>;
         		<?php endif;?>
         	}
         	
         	article .content{
         		<?php if(isset($akvo_article['content_font_size'])):?>
         		font-size: <?php _e($akvo_article['content_font_size'])?>;
         		<?php endif;?>
         	}
         	<?php endif;?>
         	
         	<?php if(isset($akvo_events)):?>
         	.tribe-events-list-widget h3.widget-title{
         		<?php if(isset($akvo_events['title_font_size'])){ _e("font-size:".$akvo_events['title_font_size'].";");}?>
         		<?php if(isset($akvo_events['title_color'])){ _e("color:".$akvo_events['title_color'].";");}?>
         	}
         	.tribe-events-list-widget .btn.btn-default{
         		<?php if(isset($akvo_events['btn_font_size'])){ _e("font-size:".$akvo_events['btn_font_size'].";");}?>
         		<?php if(isset($akvo_events['btn_bg_color'])){ _e("background-color:".$akvo_events['btn_bg_color'].";");}?>
         		<?php if(isset($akvo_events['btn_color'])){ _e("color:".$akvo_events['btn_color'].";");}?>
         	}
         	<?php endif;?>
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');
