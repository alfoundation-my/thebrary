<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 25/05/2018
 * Time: 6:42 PM
 */


add_action('wp_ajax_get_all_online_dues_paid', 'get_all_online_dues_paid');
add_action('wp_ajax_nopriv_get_all_online_dues_paid', 'get_all_online_dues_paid');
function get_all_online_dues_paid()
{
    global $wpdb;
    $sql_fire = "select * from tblpayments order by id desc";
    $full_data = $wpdb->get_results($sql_fire);
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}

add_action('wp_ajax_updatePaymentApproval', 'updatePaymentApproval');
add_action('wp_ajax_nopriv_updatePaymentApproval', 'updatePaymentApproval');
function updatePaymentApproval()
{
    global $wpdb;
    $sql_fire = "update tblpayments set ApprovedStatus = '" . $wpdb->_real_escape($_REQUEST["ApprovedStatus"]) . "' where id=" . $wpdb->_real_escape($_REQUEST["Id"]);
    $wpdb->query($sql_fire);
    $sql_fire = "select * from tblpayments order by id desc";
    $full_data = $wpdb->get_results($sql_fire);
    return_issued_book_hardcode($_REQUEST["BookId"], $_REQUEST["UserId"], $_REQUEST["DateDue"], $_REQUEST["PayedAmount"], $_REQUEST["PayedForDays"]);
    echo json_encode(array('success' => true, 'data' => $full_data, 'msg' => __("Book has been returned to us.", 'library-management-system'), 'header' => 'OK', 'color' => "success"));
    wp_die();
}


