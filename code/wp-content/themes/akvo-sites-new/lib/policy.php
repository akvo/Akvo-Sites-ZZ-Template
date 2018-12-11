<?php
/*
* POLICY PAGE
*/

class PRIVACY_POLICY_PAGE{
	
    public function __construct(){
		
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		
		add_action( 'admin_init', array( $this, 'admin_init' ) );
    }
	
	/* GETTER AND SETTER FUNCTIONS */
	function get_privacy_policy(){
		$current_user = get_current_user_id();
        return get_user_meta( $current_user, 'privacy_policy', true );
	}
	
	function set_privacy_policy( $value ){
		update_user_meta( get_current_user_id(), 'privacy_policy', $value );
	}
	/* GETTER AND SETTER FUNCTIONS */
	
	
	function admin_init(){
		/*
		* Redirects the user to the policy page,
		* if the user has not signed the policy terms.
		* And if signed direct the use to dashboard
		*/
		$privacy_policy = $this->get_privacy_policy();
		$page = isset( $_GET['page'] ) ? $_GET['page'] : '';
		if( !$privacy_policy && $page != 'options_page_slug' ) {
			// this field was not set or was empty
			wp_redirect(admin_url('admin.php?page=options_page_slug'));  // or whatever success page
			exit;
		}
		
		/* 	Update user meta table
		* 	@return datetime to database table
		*/
		if(	isset(	$_POST['privacy_policy']	)	){
			$current_date = date("Y-m-d H:i:s");
			$this->set_privacy_policy( $current_date );
			wp_redirect( admin_url( 'index.php' ) );  // or whatever success page
			exit;
		}
	}
	
    function admin_menu(){
        
        $privacy_policy = $this->get_privacy_policy();
		
        if (!$privacy_policy) {
            add_options_page(
                'Privacy_policy',
                'Privacy policy',
				'level_0',
				'options_page_slug',
                array($this, 'settings_page')
            );
        }
    }

    function settings_page(){
	?>
	<div class="container">
		<div class="container" style="background-color:	#e0e5e5">
			<h3>Akvo SaaS Terms of Service and Privacy Policy</h3>
			<div class="container2" style="background-color:white">
				<p> We’re committed to ensuring that your privacy is protected and strictly follow the General Data Protection Regulation (GDPR) rules.</p>
				<div class="panel-body">
					<form id="postform" name="postform" method="POST" action="">
						<div class="container3" style="background-color:#fff">
							<fieldset>
								<label>
									<input type="checkbox" required name="privacy_policy" id="privacy_policy" class="form-radio" value="<?php echo $_POST['privacy_policy']; ?>"/>
									I have read and understood the updated <a href="https://akvo.org/help/akvo-policies-and-terms-2/akvo-saas-terms-of-service/">Akvo SaaS Terms of Service and Akvo Sites Privacy Policy</a>.
								</label>
							</fieldset>
							<br>
							<div class="form-group">
								<button type="submit" id="submit" name="submit" class="button button-primary button-large">Accept</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php
		
		/**Hide the radio button and the submit once clicked*/
		$privacy_policy = $this->get_privacy_policy();
		if( $privacy_policy ):
	?>
		<style type="text/css" media="screen">
			#privacy_policy { display: none; }
			#submit { display: none; }
		</style>
	<?php
		endif;

	}
	
	
	function admin_head() {
		/** Hide the admin menu and top bar */
		$privacy_policy = $this->get_privacy_policy();
		if( !$privacy_policy ) {
        ?>
        <style type="text/css" media="screen">
            #wp-toolbar {
                display: none;
            }
            #adminmenuwrap {
                display: none;
            }
            #menu-settings {
                display: none;
            }

        </style>
        <?php
		}
		/** CSS to the form */
	?>
		<style type="text/css">
			body {font-family: Arial, Helvetica, sans-serif;}
			.container { padding: 8px; width: 933px;}
			.container2 { padding: 5px; width: 920px;}
			.container3 { padding: 5px; width: 900px; }
			h3{ color:#656d6d; padding: 8px;}
			label{ font-weight: 700;}

		</style>
	<?php 
	}
	
}


new PRIVACY_POLICY_PAGE;

// Function that outputs the contents of the dashboard widget
function dashboard_widget_function( $post, $callback_args ){ 
?>
	<label> Here you can read the <a href="https://akvo.org/help/akvo-policies-and-terms-2/akvo-saas-terms-of-service/">privacy policy and terms </a>of Akvo Foundation.</label >
<?php
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', function(){
	wp_add_dashboard_widget('dashboard_widget', 'Privacy policy and terms', 'dashboard_widget_function');
} );

