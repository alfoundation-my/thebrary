<?php
add_action('wp_ajax_get_all_fines_sum_collected', 'get_all_fines_sum_collected');
add_action('wp_ajax_nopriv_get_all_fines_sum_collected', 'get_all_fines_sum_collected');
function get_all_fines_sum_collected()
{
    global $wpdb;
    $filter_ext = "";
    $filter = $_REQUEST["filter"];
    if (!empty($filter)) {
        $filter_ext .= "and ";
        if ($filter == "l30") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 30 days')) . "'";
        }
        if ($filter == "l3m") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 90 days')) . "'";
        }
        if ($filter == "l6m") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 180 days')) . "'";
        }
        if ($filter == "l1y") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 364 days')) . "'";
        }
        if ($filter == "tm") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('first day of this month')) . "'";
        }
        if ($filter == "ty") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('first day of January ' . date('Y'))) . "'";
        }
        if ($filter == "all") {
            $filter_ext .= "0=0";
        }
    }
    $sql_fire = "select sum(fine) as total from tblborrowed where 1=1 " . $filter_ext;
    $full_data = $wpdb->get_results($sql_fire);
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}

add_action('wp_ajax_get_all_fines_collected', 'get_all_fines_collected');
add_action('wp_ajax_nopriv_get_all_fines_collected', 'get_all_fines_collected');
function get_all_fines_collected()
{
    global $wpdb;
    $todo = $wpdb->_real_escape($_REQUEST["todo"]);
    if ($todo == null && $todo == "") {
        $todo = 0;
    }
    $query_ext = "and Fine != 0";
    $filter = $wpdb->_real_escape($_REQUEST["filter"]);
    $filter_ext = "";
    if (!empty($filter)) {
        $filter_ext .= "and ";
        if ($filter == "l30") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 30 days')) . "'";
        }
        if ($filter == "l3m") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 90 days')) . "'";
        }
        if ($filter == "l6m") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 180 days')) . "'";
        }
        if ($filter == "l1y") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('today - 364 days')) . "'";
        }
        if ($filter == "tm") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('first day of this month')) . "'";
        }
        if ($filter == "ty") {
            $filter_ext .= "DateReturned >= '" . date('Y-m-d', strtotime('first day of January ' . date('Y'))) . "'";
        }
        if ($filter == "all") {
            $filter_ext .= "0=0";
        }
    }
    $sql_fire = "select * from tblborrowed where 1=1 and ReturnStatus = " . $todo . " " . $query_ext . " " . $filter_ext;
    $full_data = $wpdb->get_results($sql_fire);
    $main_data = array();
//$sub_data = array();
    foreach ($full_data as $obj) {
        $temp_array = array();
        $book_name = $wpdb->get_var($wpdb->prepare("select BookTitle from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array["Id"] = $obj->Id;
        $temp_array["BookName"] = $book_name;
        $book_desc = $wpdb->get_var($wpdb->prepare("select BookDesc from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array = array_merge($temp_array, array("BookDesc" => wp_trim_words($book_desc, 10, '...')));
        $user_name = $wpdb->get_var($wpdb->prepare("select concat(FirstName,' ',LastName)  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserName" => $user_name));
        $user_phone = $wpdb->get_var($wpdb->prepare("select Phone from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPhone" => $user_phone));
        $user_pic = $wpdb->get_var($wpdb->prepare("select UserPic  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPic" => $user_pic));
        $temp_array = array_merge($temp_array, (array)$obj);
        array_push($main_data, $temp_array);
    }
    echo json_encode(array('success' => true, 'data' => $main_data));
    wp_die();
}

add_action('wp_ajax_update_fine_records', 'update_fine_records');
add_action('wp_ajax_nopriv_update_fine_records', 'update_fine_records');
function update_fine_records()
{
    global $wpdb, $current_user;
    $sub_book_id = $wpdb->_real_escape($_REQUEST["book_no"]);
    $user_id = $wpdb->_real_escape($_REQUEST["user_id"]);
    $notes = $wpdb->_real_escape($_REQUEST["notes"]);
    $fine = $wpdb->_real_escape($_REQUEST["fine"]);
    $uid = $wpdb->_real_escape($_REQUEST["uid"]);
    if ($fine == null) {
        $fine = 0;
    }
    if ($notes == null) {
        $notes = "";
    }
    $sql_fire1 = "update tblborrowed set Notes='" . $notes . "',Fine=" . $fine . " where BookId=" . $sub_book_id . " and UserId=" . $user_id . " and Id=" . $uid;
    $wpdb->query($sql_fire1);
    echo json_encode(array('success' => true, 'msg' => __("Information has been updated.", 'library-management-system'), "header" => "OK", 'color' => 'success'));
    wp_die();
}

//add_action('wp_ajax_check_if_fine_paid', 'check_if_fine_paid');
//add_action('wp_ajax_nopriv_check_if_fine_paid', 'check_if_fine_paid');
//function check_if_fine_paid()
//{
//    global $wpdb;
//    $payed_entry_id = $_REQUEST["id"];
//    if ($wpdb->query("select * from tblpayments where PayedForEntry=" . $payed_entry_id) > 0) {
//        return true;
//    } else {
//        return false;
//    }
//}

?>