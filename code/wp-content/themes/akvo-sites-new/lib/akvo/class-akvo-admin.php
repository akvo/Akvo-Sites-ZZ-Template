<?php
	
	class AKVO_ADMIN{
		
		function __construct(){
			
			/* SUPPORT LINK */
			add_action( 'admin_notices', function(){
				include "templates/support.php";
			} );
			
			/* REMOVE HELP FROM DASHBOARD */
			add_filter( 'contextual_help', array( $this, 'contextual_help' ), 999, 3 );
			
			// REMOVE LINKS FROM TOP ADMIN BAR
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 999 );
			
			add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_items' ) );
			
		}
		
		function contextual_help($old_help, $screen_id, $screen){
			$screen->remove_help_tabs();
    		return $old_help;
		}
		
		function admin_bar_menu( $wp_admin_bar ){
			// REMOVE LOGO
			$wp_admin_bar->remove_node( 'wp-logo' );
			$wp_admin_bar->remove_node( 'new-post' );
		
			$wp_admin_bar->add_node(  array(
				'id'    => 'akvo-sites-support',
				'title' => 'Support',
				'href'  => 'http://sitessupport.akvo.org',
				'meta'  => array( 'class' => 'my-toolbar-page' )
			) );
		}
		
		function remove_dashboard_items(){
			global $wp_meta_boxes;
 
	    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    		unset($wp_meta_boxes['dashboard']['normal']['core']['tribe_dashboard_widget']);
		}
		
	}
	
	global $akvo_admin;
	
	$akvo_admin = new AKVO_ADMIN;