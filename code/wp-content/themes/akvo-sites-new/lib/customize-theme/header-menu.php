<?php
	
	add_action('customize_register', function($wp_customize){
		
		global $akvo_customize;
		
		/* MAIN MENU */
		$akvo_customize->section( $wp_customize, 'akvo_theme_panel', 'sage_header_scheme', 'Main Menu', '');
		
		
		
		$colors = array(
			'sage_header_options[bg_menu]' => array(
				'default'	=> '#ffffff',
				'label'		=> 'Background Item Menu'
			),
			'sage_header_options[color_menu]' => array(
				'default'	=> '#000000',
				'label' 	=> 'Color Item Menu',	
			),
			'sage_header_options[bg_parent_menu]' => array(
				'default'	=> '#000000',
				'label' 	=> 'Background Active Item Menu Parent',	
			),
			'sage_header_options[color_parent_menu]' => array(
				'default'	=> '#ffffff',
				'label' 	=> 'Color Active Item Menu Parent',	
			),
			'sage_header_options[bg_child_menu]' => array(
				'default'	=> '#000000',
				'label' 	=> 'Background Active Item Menu Children',
			),
			'sage_header_options[color_child_menu]' => array(
				'default'	=> '#ffffff',
				'label' 	=> 'Color Active Item Menu Children',
			),
		);
		
		foreach( $colors as $id => $color ){
			$akvo_customize->color( $wp_customize, 'sage_header_scheme', $id, $color['label'], $color['default'] );
		}
		
	}, 40);
	
	
	add_action( 'akvo_sites_css', function(){
		
		$header_option = get_option('sage_header_options');
		
		$menus = array(
			array(
				'selector'	=> '#menu-main-nav .menu-item .current-menu-item a, #menu-main-nav .menu-item .menu-item a:hover',
				'styles'	=> array(
					'background'	=> 'bg_child_menu',
					'color'			=> 'color_child_menu'
				)
			),
			array(
				'selector'	=> 'nav ul.navbar-nav li a',
				'styles'	=> array(
					'background'	=> 'bg_menu',
					'color'			=> 'color_menu'
				)
			),
			array(
				'selector'	=> 'nav ul.navbar-nav li:hover a,nav ul.navbar-nav li a:focus,nav ul.navbar-nav li.current-menu-item a',
				'styles'	=> array(
					'background'	=> 'bg_parent_menu',
					'color'			=> 'color_parent_menu'
				)
			),
		);
		
		global $akvo;
		$akvo->print_css( $header_option, $menus );
		
	} );
	

  
  