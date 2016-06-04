<?php

include("color.php");
use Mexitek\PHPColors\Color;

function akvo_customize_register( $wp_customize ) {

   //All our sections, settings, and controls will be added here
	//kleuren
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

	//filter ID
	$wp_customize->add_section( 'filter_section' , array(
	    'title'       => __( 'Result filters', 'sage' ),
	    'priority'    => 30,
	    'description' => 'Enter and enable result filters by entering the appropriate WPQSF form IDs',
	) );
	$wp_customize->add_setting( 'filter_news' );
	$wp_customize->add_control( 'filter_news', array(
	    'label'    => __( 'News', 'sage' ),
	    'section'  => 'filter_section',
	    'settings' => 'filter_news',
	));
	$wp_customize->add_setting( 'filter_blog' );
	$wp_customize->add_control( 'filter_blog', array(
	    'label'    => __( 'Blog', 'sage' ),
	    'section'  => 'filter_section',
	    'settings' => 'filter_blog',
	));
	$wp_customize->add_setting( 'filter_media' );
	$wp_customize->add_control( 'filter_media', array(
	    'label'    => __( 'Media', 'sage' ),
	    'section'  => 'filter_section',
	    'settings' => 'filter_media',
	));

	//fonts

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
		    'choices' => array(
	            'Open Sans' => 'Open Sans',
	            'Roboto' => 'Roboto',
	            'Lora' => 'Lora',
	            'Raleway' => 'Raleway',
	            'Merriweather' => 'Merriweather',
	            'Arvo' => 'Arvo',
	            'Muli' => 'Muli',
	            'Alegreya' => 'Alegreya',
	            'Exo 2' => 'Exo 2',
	            'Crimson Text' => 'Crimson Text',
	            'Lobster Two' => 'Lobster Two',
	)));
	$wp_customize->add_setting( 'akvo_font_nav', array(
	     'default' => 'Open Sans',
	     'transport'   => 'refresh',
	));
	$wp_customize->add_control( 'akvo_font_nav', array(
			'type' 		=> 'select',
		    'label'    => __( 'Navigation font', 'sage' ),
		    'section'  => 'akvo_font_section',
		    'settings' => 'akvo_font_nav',
		    'choices' => array(
	            'Open Sans' => 'Open Sans',
	            'Roboto' => 'Roboto',
	            'Lora' => 'Lora',
	            'Raleway' => 'Raleway',
	            'Merriweather' => 'Merriweather',
	            'Arvo' => 'Arvo',
	            'Muli' => 'Muli',
	            'Alegreya' => 'Alegreya',
	            'Exo 2' => 'Exo 2',
	            'Crimson Text' => 'Crimson Text',
	            'Lobster Two' => 'Lobster Two',
	)));
	$wp_customize->add_setting( 'akvo_font', array(
	     'default' => 'Open Sans',
	     'transport'   => 'refresh',
	));
	$wp_customize->add_control( 'akvo_font', array(
			'type' 		=> 'select',
		    'label'    => __( 'Body font', 'sage' ),
		    'section'  => 'akvo_font_section',
		    'settings' => 'akvo_font',
		    'choices' => array(
	            'Open Sans' => 'Open Sans',
	            'Roboto' => 'Roboto',
	            'Lora' => 'Lora',
	            'Raleway' => 'Raleway',
	            'Merriweather' => 'Merriweather',
	            'Arvo' => 'Arvo',
	            'Muli' => 'Muli',
	            'Alegreya' => 'Alegreya',
	            'Exo 2' => 'Exo 2',
	            'Crimson Text' => 'Crimson Text',
	            'Lobster Two' => 'Lobster Two',
	)));

	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');


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

function mytheme_customize_css()
{
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

    ?>
         <style type="text/css">
         	html {background:<?php echo $donker;?>; }
            body { font-family: '<?php echo $font; ?>'; background: <?php echo $background; ?>;}
            h1,h2,h3,h4,h5,h6 { font-family: '<?php echo $font_head; ?>';  }
            nav { font-family: '<?php echo $font_nav; ?>'; }
            .carousel .text, footer .twitter, nav ul.navbar-nav li.current-menu-item a { background: <?php echo $licht;?>; }
            nav .lang .fa-circle, nav ul.navbar-nav li i { color: <?php echo $licht;?>; }
            .btn-default, .filters #uwpqsf_id #uwpqsf_btn input, .carousel .carousel-indicators li.active, footer .custom { background: <?php echo $main;?>; }
            nav ul.navbar-nav li .fa-circle, a { color: <?php echo $main;?>; }
            a:hover {color:<?php echo $donker;?>;}
            .btn-default:focus, .btn-default:hover, .filters #uwpqsf_id #uwpqsf_btn input:focus, .filters #uwpqsf_id #uwpqsf_btn input:hover, footer .fixed, .comment-form footer .custom input[type=submit], .filters #uwpqsf_id #uwpqsf_btn footer .custom input, footer .custom .btn, footer .custom .comment-form input[type=submit], footer .custom .filters #uwpqsf_id #uwpqsf_btn input { background: <?php echo $donker;?>; }
         	.box-wrap, .article .bg, article .bg, .filters, .breadcrumbs, .search-wrap { background: <?php echo $lichtgrijs;?>;}
         	.box-wrap .infobar.blog, .box-wrap .infobar.type-blog { background: <?php echo $info_bar_blog; ?>; }
         	.box-wrap .infobar.post, .box-wrap .infobar.type-post { background: <?php echo $info_bar_news;?>; }
         	.box-wrap .infobar.video, .box-wrap .infobar.type-video { background: <?php echo $info_bar_video;?>; }
         	.box-wrap .infobar.update, .box-wrap .infobar.type-update { background: <?php echo $info_bar_update;?>; }
         	.box-wrap .infobar.page, .box-wrap .infobar.type-page { background: <?php echo $info_bar_page;?>; }
         	.box-wrap .infobar.media, .box-wrap .infobar.type-media { background: <?php echo $info_bar_media;?>; }
         	.box-wrap .infobar.map, .box-wrap .infobar.type-map { background: <?php echo $info_bar_map;?>; }
         	.box-wrap .infobar.project, .box-wrap .infobar.type-project { background: <?php echo $info_bar_project;?>; }
         	.box-wrap .infobar.testimonial, .box-wrap .infobar.type-testimonial { background: <?php echo $info_bar_testimonial;?>; }
         	.box-wrap .infobar.flow, .box-wrap .infobar.type-flow { background: <?php echo $info_bar_flow;?>; }
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
         	}
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');

// function create_scss() {
// 	//global $wpdb;
// 	$file = WP_CONTENT_DIR."/themes/akvo-sites/assets/styles/common/_overrides.scss";
// 	$main_color = get_theme_mod('main_color');
// 	if (empty( $main_color )) $main_color = '#00a99d';

// 	$grijs = get_theme_mod('grijs');
// 	if (empty( $grijs )) $grijs = '#e6e6e6';

// 	$info_bar_blog = get_theme_mod('info_bar_blog');
// 	if (empty( $info_bar_blog )) $info_bar_blog = '#a3d165';

// 	$info_bar_news = get_theme_mod('info_bar_news');
// 	if (empty( $info_bar_news ))  $info_bar_news = '#f9ba41';

// 	$info_bar_video = get_theme_mod('info_bar_video');
// 	if (empty( $info_bar_video )) $info_bar_video = '#f47b50';

// 	$info_bar_update = get_theme_mod('info_bar_update');
// 	if (empty( $info_bar_update )) $info_bar_update = '#54bce8';

// 	$info_bar_page = get_theme_mod('info_bar_page');
// 	if (empty( $info_bar_page )) $info_bar_page = '#6d3a7d';

// 	$info_bar_media = get_theme_mod('info_bar_media');
// 	if (empty( $info_bar_media )) $info_bar_media = '#9d897b';

// 	$info_bar_project = get_theme_mod('info_bar_project');
// 	if (empty( $info_bar_project )) $info_bar_project = '#7381fa';

// 	$info_bar_map = get_theme_mod('info_bar_map');
// 	if (empty( $info_bar_map )) $info_bar_map = '#ad1c3c';

// 	$info_bar_testimonial = get_theme_mod('info_bar_testimonial');
// 	if (empty( $info_bar_testimonial )) $info_bar_testimonial = '#007ba8';

// 	$current = "\$brand-primary: $main_color;\n"
// 	."\$grijs: $grijs;\n"
// 	."\$infobar-map: $info_bar_map;\n"
// 	."\$infobar-blog: $info_bar_blog;\n"
// 	."\$infobar-news: $info_bar_news;\n"
// 	."\$infobar-video: $info_bar_video;\n"
// 	."\$infobar-update: $info_bar_update;\n"
// 	."\$infobar-page: $info_bar_page;\n"
// 	."\$infobar-media: $info_bar_media;\n"
// 	."\$infobar-project: $info_bar_project;\n"
// 	."\$infobar-map: $info_bar_map;\n"
// 	."\$infobar-testimonial: $info_bar_testimonial;\n";
// 	// Write the contents back to the file
// 	file_put_contents($file, $current);
// 	return false;
// }

// // add_action( 'customize_save', 'create_scss' ); 

// add_action( 'customize_save_after', 'create_scss' ); 

?>