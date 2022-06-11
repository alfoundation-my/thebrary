<?php
session_start();
global $wpdb;
// Not letting sql error out since this is build using normal sql queries which isn't a good standard. Since this code was written long
// ago we only improvised it, instead of rewriting it.
$wpdb->suppress_errors = true;
$version = "3.0";
include_once 'vendor/autoload.php';
include_once("basic_setups.php");
include_once("module/fn_uploads.php");
include_once("module/fn_login.php");
include_once("module/fn_profile.php");
include_once("module/fn_books.php");
include_once("module/fn_issuebook.php");
include_once("module/fn_inst.php");
include_once("module/fn_year.php");
include_once("module/fn_course.php");
include_once("module/fn_user.php");
include_once("module/fn_dashboard.php");
include_once("module/fn_othersetting.php");
include_once("module/fn_requestbook.php");
include_once("module/fn_fines.php");
include_once("module/fn_slides.php");
include_once("module/fn_common.php");
include_once("module/class_backup_SQL.php");
// Paypal
//echo "hello_".get_option("client_id");
//$_SESSION["client_id"] = get_option("client_id");
//$_SESSION["client_secret"] = get_option("client_secret");
//SandBox Paypal Code
//$_SESSION["client_id"] = "AS-SyAoygplNGQLk511-D_y0pmtYD5qXwavxIk8SB-d_gLlfJohoVkrBBiSmrIQIIS4f9MeRYHvkK25H";
//$_SESSION["client_secret"] = "EHOXvy8zxaHk0Bae3Ciy-1EQRMcFeNXjK3YQopoP_9-cH4NYPxs7HAzbq2Hw4zIdqnW4hHuxlVjEh9QT";
//End SandBox Paypal Code
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        get_option("client_id"),     // ClientID
        get_option("client_secret")      // ClientSecret
    )
);
if (get_option("sandbox") == "false") {
    $apiContext->setConfig(
        array(
            'mode' => 'live'
        )
    );
}
include_once("module/fn_onlinedues.php");
include_once("module/fn_updatemanager.php");
if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
    include_once("server_function.php");
}
add_action('admin_notices', 'my_theme_dependencies');
function my_theme_dependencies()
{
    if (!function_exists('plugin_function'))
        echo '<div class="error"><p>' . __('Hint : The theme supports translation & This can be easily achieved with plugin called as "Loco Translate"', 'library-management') . '</p></div>';
}

?>