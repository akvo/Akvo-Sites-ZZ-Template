<?php

//include("color.php");
	use Mexitek\PHPColors\Color;

	
	add_action( 'customize_register', function($wp_customize){
		
		global $akvo_customize;
		
		/** MAIN AKVO PANEL */
		$akvo_customize->panel( $wp_customize, 'akvo_theme_panel', 'Theme Options' );
		
		/* All our sections, settings, and controls will be added here */
   		
   		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'akvo_color', 'Adjust Colors', '');
		
		$colors = array(
			'main_color' 		=> array(
				'default'		=> '#00a99d',
				'label'			=> 'Main Color'
			),
			'background'		=> array(
				'default'		=> '#ffffff',
				'label'			=> 'Background'
			),
			'grijs'				=> array(
				'default'		=> '#e6e6e6',
				'label'			=> 'Shades of grey'
			),
			'info_bar_blog'		=> array(
				'default'		=> '#a3d165',
				'label'			=> 'Blog Post'
			),
			'info_bar_news'		=> array(
				'default'		=> '#f9ba41',
				'label'			=> 'News Post'
			),
			'info_bar_video'	=> array(
				'default'		=> '#f47b50',
				'label'			=> 'Video Post'
			),
			'info_bar_update'	=> array(
				'default'		=> '#54bce8',
				'label'			=> 'Post Update'
			),
			'info_bar_page'		=> array(
				'default'		=> '#6d3a7d',
				'label'			=> 'Page Color'
			),
			'info_bar_project'	=> array(
				'default'		=> '#7381fa',
				'label'			=> 'Project Update'
			),
			'info_bar_map'		=> array(
				'default'		=> '#ad1c3c',
				'label'			=> 'Map'
			),
			'info_bar_testimonial'	=> array(
				'default'			=> '#007ba8',
				'label'				=> 'Testimonial'
			),
			'info_bar_flow'	=> array(
				'default'		=> '#54bce8',
				'label'			=> 'Flow'
			),
			'info_bar_media'		=> array(
				'default'		=> '#9d897b',
				'label'			=> 'Media Item'
			),
		);
		
		foreach( $colors as $color_id => $color ){
		
			$akvo_customize->color( $wp_customize, 'akvo_color', $color_id, $color['label'], $color['default'] );
			
				
		}
		
	} );




	add_action( 'wp_head', function(){
		
		
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
            body { background: <?php echo $background; ?>;}
            
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
         	
         	
         	
         	.nav>li>a:focus, .nav>li>a:hover {background:<?php echo $licht;?>; }
         	blockquote {border-color: <?php echo $donkergrijs;?>;}
         	@media (min-width: 768px) {
         		nav  {background: <?php echo $lichtgrijs;?>;}
         		nav ul.navbar-nav li a:hover, nav ul.navbar-nav li:hover a { background: <?php echo $licht;?>;}
         		nav ul.navbar-nav .dropdown-menu li a:hover {background: <?php echo $main;?>; }
         		nav ul.navbar-nav .dropdown-menu li.current-menu-item a{background: <?php echo $main;?>;}
         	}
		</style>
    <?php
		
		
	});
