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
				'default'	=> '#ffffff',
				'label' 	=> 'Color Item Menu',	
			),
			'sage_header_options[bg_parent_menu]' => array(
				'default'	=> '#ffffff',
				'label' 	=> 'Background Active Item Menu Parent',	
			),
			'sage_header_options[color_parent_menu]' => array(
				'default'	=> '#ffffff',
				'label' 	=> 'Color Active Item Menu Parent',	
			),
			'sage_header_options[bg_child_menu]' => array(
				'default'	=> '#ffffff',
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
	
	
	add_action( 'wp_head', function(){
		
		$header_option = get_option('sage_header_options');
    
		if($header_option != NULL):?>
    		
    	<style type="text/css">
      
      		#menu-main-nav .menu-item .current-menu-item a, #menu-main-nav .menu-item .menu-item a:hover{
        		<?php if(isset($header_option['bg_child_menu']) && $header_option['bg_child_menu'] != "") echo 'background: '.$header_option['bg_child_menu'].';'?>
        		<?php if(isset($header_option['color_child_menu']) && $header_option['color_child_menu'] != "") echo 'color: '.$header_option['color_child_menu'].';'?>
      		}
      
      		nav ul.navbar-nav li a{
        		<?php if(isset($header_option['bg_menu']) && $header_option['bg_menu'] != "") echo 'background: '.$header_option['bg_menu'].';'?>
        		<?php if(isset($header_option['color_menu']) && $header_option['color_menu'] != "") echo 'color: '.$header_option['color_menu'].';'?>
      		}
      
      		nav ul.navbar-nav li:hover a,nav ul.navbar-nav li a:focus,nav ul.navbar-nav li.current-menu-item a{
        		<?php if(isset($header_option['bg_parent_menu']) && $header_option['bg_parent_menu'] != "") echo 'background: '.$header_option['bg_parent_menu'].' !important;'?>
        		<?php if(isset($header_option['color_parent_menu']) && $header_option['color_parent_menu'] != "") echo 'color: '.$header_option['color_parent_menu'].' !important;'?>
      		}
      
    	</style>
    	<?php endif;
		
		
	} );
	

  
  