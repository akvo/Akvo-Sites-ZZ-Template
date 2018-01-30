<?php
	
	class AKVO_ADMIN{
		
		var $menu;
		
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
			
			/* SHOW EXTRA FIELDS */
			add_action( 'show_user_profile', array( $this, 'extra_user_profile_fields' ) );
			add_action( 'edit_user_profile', array( $this, 'extra_user_profile_fields' ) );
			
			/* SAVE EXTRA FIELDS */
			add_action( 'personal_options_update', array( $this, 'save_extra_user_profile_fields' ) );
			add_action( 'edit_user_profile_update', array( $this, 'save_extra_user_profile_fields' ) );
			
			
			/* HIDE MENU ITEMS */
			add_action( 'admin_init', array( $this, 'hide_menu_items' ) );
			
		}
		
		function hide_menu_items(){
			global $menu;
				
			/* SAVING THE OLD MENU FOR REUE IN THE USER FIELDS */
			$this->menu = $menu;
				
			$current_user = wp_get_current_user();
				
			/* IF NOT LOGGED IN THEN RETURN */
			if( !isset( $current_user->ID ) ) return false;
				
			/* SELECTED MENU ITEMS FOR HIDING */
			$menu_arr = is_array( get_user_meta( $current_user->ID, 'user_menu', true ) ) ? get_user_meta( $current_user->ID, 'user_menu', true ) : array();
				
			/* FINALLY HIDE */
			foreach( $menu_arr as $menu_item ){ remove_menu_page( $menu_item ); }
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
		
		function extra_user_profile_fields( $user ) { 
			$exclude_menu = array( 'index.php', 'users.php' );
			
			$selected_menu = is_array( get_user_meta( $user->ID, 'user_menu', true ) ) ? get_user_meta( $user->ID, 'user_menu', true ) : array();
			
			global $submenu;
			
			foreach( $exclude_menu as $menu_slug ){
				// echo "<pre>";print_r( $submenu[ $menu_slug ] );echo "</pre>";
			}
		?>
			<h3><?php _e("Hide Menu Items"); ?></h3>

			<table class="form-table">
			<tr>
				<td>
					<ul>
					<?php foreach( $this->menu as $menu_item ): ?>
						<?php if( isset( $menu_item[0] ) && $menu_item[0] && isset( $menu_item[2] ) && $menu_item[2] && !in_array( $menu_item[2], $exclude_menu ) ):?>
						<li style="display:inline-block;min-width: 200px;">
							<label>
								<input <?php if( in_array( $menu_item[2], $selected_menu ) )_e("checked='checked'");?> type="checkbox" name="user_menu[]" id="user-menu" value="<?php echo $menu_item[2]; ?>" />
								<?php _e( $menu_item[0] );?>
							</label>
						</li>
						&nbsp;&nbsp;
						<?php endif;?>
					<?php endforeach;?>
					
					<?php foreach( $exclude_menu as $menu_slug ):?>
						
					<?php endforeach; ?>
					</ul>
				</td>
			</tr>
			</table>
		<?php }
		
		function save_extra_user_profile_fields( $user_id ) {
			if ( !current_user_can( 'edit_user', $user_id ) ) { 
				return false; 
			}
			update_user_meta( $user_id, 'user_menu', $_POST['user_menu'] );
			
		}
		
		
	}
	
	global $akvo_admin;
	
	$akvo_admin = new AKVO_ADMIN;