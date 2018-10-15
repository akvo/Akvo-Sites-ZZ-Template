
<?php
/**
 * Created by PhpStorm.
 * User: Preeti Ambekar
 * Date: 15/10/2018
 * Time: 9:45 AM
 */
/**
 * Redirect the user to policy page,
 * if the user has not signed the policy terms.
 * And if signed direct the use to dashboard*/
add_action('wp_login', 'check_meta_fields');
function check_meta_fields($current_user)
{
    $privacy_policy = array(
        'key' => 'privacy_policy',
        'value' => date('y-m-d'),
        'compare' => '='
    );
    $current_user = get_current_user_id();
    $privacy_policy = get_user_meta($current_user, 'privacy_policy', true);
    if (isset($privacy_policy) && !empty($privacy_policy)) {
        // this field was not set or was empty
        wp_redirect(admin_url('admin.php?page=options_page_slug'));  // or whatever success page
    }
}
/** Submenu and Landing page for PP & terms */
class options_page
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
    function admin_menu()
    {
        add_options_page(
            'Privacy policy',
            'Privacy policy',
            'manage_options',
            'options_page_slug',
            array($this, 'settings_page')
        );
    }
    Public function settings_page()
    {
        ?>
                <div class="container">
                    <div class="container" style="background-color:	#e0e5e5">
                    <h3 >Privacy policy and terms</h3>
                    <div class="container" style="background-color:white">
                <p > We’re committed to ensuring that your privacy is protected and strictly follow the General Data
                    Protection Regulation (GDPR) rules.</p>
                <div class="panel-body">
                    <form id="postform" name="postform" method="POST" action="#">
                        <div class="container" style="background-color:white">
                            <fieldset>
                                <label><input type="checkbox" required name="privacy_policy"
                                              id="privacy_policy" class="form-radio" value="<?php echo $_POST['privacy_policy']; ?>"/>Check
                                    here
                                    to indicate that you
                                    have read and agree to the<a
                                        href="<?php echo site_url('/akvo-general-privacy-policy') ?>">
                                        privacy-policy and
                                        terms</a>
                                    of Akvo foundation.</label>
                            </fieldset>

                            <br>
                            <div class="form-group">
                                <button type="submit" id="submit" name="submit"
                                        class="button button-primary button-large">Accept
                                </button>
                            </div>
                    </form>
                </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <?php
        /**Hide the radio button and the submit once clicked*/
        $current_user = get_current_user_id();
        $privacy_policy = get_user_meta($current_user, 'privacy_policy', true);
        if ($privacy_policy) {
            ?>
            <style type="text/css" media="screen">
                #privacy_policy{
                    display: none;
                }
                #submit {
                    display: none;
                }
            </style>
            <?php
        }
    }
}
/** Update user meta table
 * @return datetime to database table
 */
$user_id = get_current_user_id();
$current_date = date("Y-m-d H:i:s");
if(isset($_POST['privacy_policy'])){
    update_user_meta($user_id,'privacy_policy',$current_date);
    wp_redirect(admin_url('index.php'));  // or whatever success page
    exit;
}
/**Hide the admin menu and top bar*/
add_action( 'admin_head', 'cn_admin_customize' );
function cn_admin_customize($current_user){
    $privacy_policy = array(
        'key' => 'privacy_policy',
        'value' => date('Y-m-d H:i:s'),
        'compare' => '='
    );
    $current_user = get_current_user_id();
    $privacy_policy = get_user_meta($current_user, 'privacy_policy', true);
    if (!$privacy_policy) {
        ?>
        <style type="text/css" media="screen">
            #wp-toolbar {
                display: none;
            }
            #adminmenuwrap {
                display: none;
            }
        </style>
        <?php
    }
}
/** CSS to the form */
function admin_css() { ?>
    <style type="text/css">
        body {font-family: Arial, Helvetica, sans-serif;}
        .container {
            padding: 5px;
            background-color: #f1f1f1;
        }
        h3{
            color:#656d6d;
        }
        label{
            font-weight: 700;
        }

    </style>
<?php }
add_action('admin_head', 'admin_css');

// Function that outputs the contents of the dashboard widget
function dashboard_widget_function( $post, $callback_args )
{ ?><label> Here you can read the <a href = "<?php echo site_url('/akvo-general-privacy-policy') ?>">privacy policy and terms </a>of Akvo Foundation.</label >
    <?php
}
// Function used in the action hook
function add_dashboard_widgets() {
    wp_add_dashboard_widget('dashboard_widget', 'Privacy policy and terms', 'dashboard_widget_function');
}
// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
new options_page;
?>
