<?php
// [ Login Checking & Fail Handling | Reset Will Be Handled By Framework ]
add_action('wp_login_failed', 'my_front_end_login_fail');
function my_front_end_login_fail($username)
{
    $referrer = $_SERVER['HTTP_REFERER'];
    $referrer = str_replace("?login=failed", "", $referrer);
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect($referrer . '?login=failed');
        exit;
    }
}

// [Not allowing disable account to login]
add_action('wp_login', 'login_checking', 10, 2);
function login_checking($user_login, $user)
{
    $disabled = get_user_meta($user->ID, 'user_active', true);
    if ($disabled == '1') {
        wp_clear_auth_cookie();
        wp_redirect(get_home_url() . '/login/?login=disabled');
        exit;
    }
}

// [ Password Updating Form Module ]
add_action('wp_ajax_change_password', 'FuncChangePassword');
add_action('wp_ajax_nopriv_change_password', 'FuncChangePassword');
function FuncChangePassword()
{
    global $wpdb, $current_user;
    $password = $wpdb->_real_escape($_REQUEST["new_pass"]);
    $user_id = get_user_meta($current_user->ID, 'user_id', true);
    $wpdb->query("Update tblusers set Password='" . $password . "' where 	UserId=" . $user_id);
    wp_set_password($password, $current_user->ID);
    echo json_encode(array('success' => true, 'msg' => __('Password Changed Successfully' , 'library-management-system' ), "header" => "Success", 'color' => 'success'));
    wp_die();
}

// Send Password Information
add_action('wp_ajax_get_Password', 'getPassword');
add_action('wp_ajax_nopriv_get_Password', 'getPassword');
function getPassword()
{
    global $wpdb;
    $user_email = $wpdb->_real_escape($_REQUEST["user_email"]);
    $password = $wpdb->get_var($wpdb->prepare("select Password from tblusers where Email ='" . $user_email . "'"));
    $user = get_user_by('email', $user_email);
    if (in_array('administrator', (array)$user->roles)) {
        wp_set_password(get_option("default_password", '123456'), $user->ID);
        echo json_encode(array('success' => true, "msg" => __( "Password has been reseted to the default password.", 'library-management-system' ), "header" => "OK", 'color' => 'success'));
        wp_die();
    }
    if ($password != "") {
        send_email_c($user_email, "Your Password For Library Management System is : " . $password);
    } else {
        echo json_encode(array('success' => true, "msg" => __("Username / Email-Id doesn't match in our system." , 'library-management-system' ), "header" => "Info", 'color' => 'info'));
        wp_die();
    }
}

?>