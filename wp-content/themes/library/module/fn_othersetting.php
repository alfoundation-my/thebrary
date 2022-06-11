<?php
// Function For Saving Other Settings
add_action('wp_ajax_other_settings', 'saveOtherSetting');
add_action('wp_ajax_nopriv_other_settings', 'saveOtherSetting');
function saveOtherSetting()
{
    global  $wpdb;
    $limit_issue_book_teachers = $wpdb->_real_escape($_REQUEST["limit_issue_book_teachers"]);
    $message_api_key = $wpdb->_real_escape($_REQUEST["message_api_key"]);
    $people_to_approve = $wpdb->_real_escape($_REQUEST["people_to_approve"]);
    $custom_states = $wpdb->_real_escape($_REQUEST["custom_states"]);
    $custom_css_front_page = sanitize_textarea_field($_REQUEST["custom_css_front_page"]);
    $custom_theme_color = $wpdb->_real_escape($_REQUEST["custom_theme_color"]);
    $nos_of_book_to_show = $wpdb->_real_escape($_REQUEST["nos_of_book_to_show"]);
    $nos_of_menu_to_show = $wpdb->_real_escape($_REQUEST["nos_of_menu_to_show"]);
    $quick_notice = $wpdb->_real_escape($_REQUEST["quick_notice"]);
    $local_currency = $wpdb->_real_escape($_REQUEST["local_currency"]);
    $limit_issue_book = $wpdb->_real_escape($_REQUEST["limit_issue_book"]);
    $hide_wordpress_dashboard = $wpdb->_real_escape($_REQUEST["hide_wordpress_dashboard"]);
    $default_password = $wpdb->_real_escape($_REQUEST["default_password"]);
    $inst_in_cards = sanitize_textarea_field($_REQUEST["inst_in_cards"]);
    $logo_css = $wpdb->_real_escape($_REQUEST["logo_css"]);
    $width_custom_pages = $wpdb->_real_escape($_REQUEST["width_custom_pages"]);
    $payment_page_notice = $wpdb->_real_escape($_REQUEST["payment_page_notice"]);
    $client_id = $wpdb->_real_escape($_REQUEST["client_id"]);
    $client_secret = $wpdb->_real_escape($_REQUEST["client_secret"]);
    $sandbox = $wpdb->_real_escape($_REQUEST["sandbox"]);
    $payment_currency_code = $wpdb->_real_escape($_REQUEST["payment_currency_code"]);
    $fine_rate = $wpdb->_real_escape($_REQUEST["fine_rate"]);
    $email_tmp_issued_book = sanitize_textarea_field($_REQUEST["email_tmp_issued_book"]);
    $email_tmp_returned_book = sanitize_textarea_field($_REQUEST["email_tmp_returned_book"]);
    $do_online_payment = sanitize_textarea_field($_REQUEST["do_online_payment"]);
    $email_sending_process = sanitize_textarea_field($_REQUEST["email_sending_process"]);
    $waiting_approval_msg = sanitize_textarea_field($_REQUEST["waiting_approval_msg"]);
    $front_page_s1 = sanitize_textarea_field($_REQUEST["front_page_s1"]);
    $enable_scroll_on_top = sanitize_textarea_field($_REQUEST["enable_scroll_on_top"]);
    if (get_option("front_page_s1") !== false) {
        update_option('front_page_s1', $front_page_s1);
    } else {
        add_option("front_page_s1", $front_page_s1);
    }
    if (get_option("waiting_approval_msg") !== false) {
        update_option('waiting_approval_msg', $waiting_approval_msg);
    } else {
        add_option("waiting_approval_msg", $waiting_approval_msg);
    }
    if (get_option("do_online_payment") !== false) {
        update_option('do_online_payment', $do_online_payment);
    } else {
        add_option("do_online_payment", $do_online_payment);
    }
    if (get_option("email_sending_process") !== false) {
        update_option('email_sending_process', $email_sending_process);
    } else {
        add_option("email_sending_process", $email_sending_process);
    }
    if (get_option("email_tmp_issued_book") !== false) {
        update_option('email_tmp_issued_book', $email_tmp_issued_book);
    } else {
        add_option("email_tmp_issued_book", $email_tmp_issued_book);
    }
    if (get_option("email_tmp_returned_book") !== false) {
        update_option('email_tmp_returned_book', $email_tmp_returned_book);
    } else {
        add_option("email_tmp_returned_book", $email_tmp_returned_book);
    }
    if (get_option("client_id") !== false) {
        update_option('client_id', $client_id);
    } else {
        add_option("client_id", $client_id);
    }
    if (get_option("client_secret") !== false) {
        update_option('client_secret', $client_secret);
    } else {
        add_option("client_secret", $client_secret);
    }
    if (get_option("sandbox") !== false) {
        update_option('sandbox', $sandbox);
    } else {
        add_option("sandbox", $sandbox);
    }
    if (get_option("payment_currency_code") !== false) {
        update_option('payment_currency_code', $payment_currency_code);
    } else {
        add_option("payment_currency_code", $payment_currency_code);
    }
    if (get_option("payment_page_notice") !== false) {
        update_option('payment_page_notice', $payment_page_notice);
    } else {
        add_option("payment_page_notice", $payment_page_notice);
    }
    if (get_option("fine_rate") !== false) {
        update_option('fine_rate', $fine_rate);
    } else {
        add_option("fine_rate", $fine_rate);
    }
    if (get_option("width_custom_pages") !== false) {
        update_option('width_custom_pages', $width_custom_pages);
    } else {
        add_option("width_custom_pages", $width_custom_pages);
    }
    if (get_option("logo_css") !== false) {
        update_option('logo_css', $logo_css);
    } else {
        add_option("logo_css", $logo_css);
    }
    if (get_option("message_api_key") !== false) {
        update_option('message_api_key', $message_api_key);
    } else {
        add_option("message_api_key", $message_api_key);
    }
    if (get_option("limit_issue_book_teachers") !== false) {
        update_option('limit_issue_book_teachers', $limit_issue_book_teachers);
    } else {
        add_option("limit_issue_book_teachers", $limit_issue_book_teachers);
    }
    if (get_option("people_to_approve") !== false) {
        update_option('people_to_approve', $people_to_approve);
    } else {
        add_option("people_to_approve", $people_to_approve);
    }
    if (get_option("custom_states") !== false) {
        update_option('custom_states', $custom_states);
    } else {
        add_option("custom_states", $custom_states);
    }
    if (get_option("custom_css_front_page") !== false) {
        update_option('custom_css_front_page', $custom_css_front_page);
    } else {
        add_option("custom_css_front_page", $custom_css_front_page);
    }
    if (get_option("custom_theme_color") !== false) {
        update_option('custom_theme_color', $custom_theme_color);
    } else {
        add_option("custom_theme_color", $custom_theme_color);
    }
    if (get_option("nos_of_book_to_show") !== false) {
        update_option('nos_of_book_to_show', $nos_of_book_to_show);
    } else {
        add_option("nos_of_book_to_show", $nos_of_book_to_show);
    }
    if (get_option("nos_of_menu_to_show") !== false) {
        update_option('nos_of_menu_to_show', $nos_of_menu_to_show);
    } else {
        add_option("nos_of_menu_to_show", $nos_of_menu_to_show);
    }
    if (get_option("quick_notice") !== false) {
        update_option('quick_notice', $quick_notice);
    } else {
        add_option("quick_notice", $quick_notice);
    }
    if (get_option("local_currency") !== false) {
        update_option('local_currency', $local_currency);
    } else {
        add_option("local_currency", $local_currency);
    }
    if (get_option("limit_issue_book") !== false) {
        update_option('limit_issue_book', $limit_issue_book);
    } else {
        add_option("limit_issue_book", $limit_issue_book);
    }
    if (get_option("hide_wordpress_dashboard") !== false) {
        update_option('hide_wordpress_dashboard', $hide_wordpress_dashboard);
    } else {
        add_option("hide_wordpress_dashboard", $hide_wordpress_dashboard);
    }
    if (get_option("default_password") !== false) {
        update_option('default_password', $default_password);
    } else {
        add_option("default_password", $default_password);
    }
    if (get_option("inst_in_cards") !== false) {
        update_option('inst_in_cards', $inst_in_cards);
    } else {
        add_option("inst_in_cards", $inst_in_cards);
    }
    if (get_option("enable_scroll_on_top") !== false) {
        update_option('enable_scroll_on_top', $enable_scroll_on_top);
    } else {
        add_option("enable_scroll_on_top", $enable_scroll_on_top);
    }
    echo json_encode(array('success' => true, "msg" => __( "Setting have been saved.", 'library-management-system' ), "header" => "OK", 'color' => 'success'));
    wp_die();
}

?>