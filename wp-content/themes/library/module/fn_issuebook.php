<?php
add_action('wp_ajax_issue_book', 'issue_book_to_user');
add_action('wp_ajax_nopriv_issue_book', 'issue_book_to_user');
function issue_book_to_user()
{
    global $wpdb, $current_user;
    $sub_book_id = $wpdb->_real_escape($_REQUEST["book_no"]);
    $user_id = $wpdb->_real_escape($_REQUEST["user_id"]);
    $notes = $wpdb->_real_escape($_REQUEST["notes"]);
    $book_date_borrowed = $wpdb->_real_escape($_REQUEST["book_date_borrowed"]);
    $book_date_due = $wpdb->_real_escape($_REQUEST["book_date_due"]);
    $obj_book_date_borrowed = give_mysql_date_format($book_date_borrowed);
    $obj_book_date_due = give_mysql_date_format($book_date_due);
    $new_sql = "select count(*) from tblborrowed where UserId = '" . $user_id . "' and ReturnStatus = 0";
    $temp_data = $wpdb->get_var($wpdb->prepare($new_sql));
    if ($temp_data == "") {
        $temp_data = 0;
    }
    $limit = get_option("limit_issue_book", "2");
//    if(get_role_custom($user_id)=="Teacher"){
//      $limit = get_option("limit_issue_book_teachers","2");
//    };
    if ($temp_data < $limit) {
        $sql_fire1 = "insert into tblborrowed(BookId,UserId,Notes,DateBorrowed,DateToReturn,AddedOn,AddedBy) values(" . $sub_book_id . "," . $user_id . ",'" . $notes . "','" . $obj_book_date_borrowed . "','" . $obj_book_date_due . "',CURDATE()," . $current_user->ID . ")";
        $sql_fire2 = "update tblsubbooks set Available = 0 where BookId=" . $sub_book_id . "";
        $sql_fire3 = "update tblbooks set Borrowed=Borrowed+1 where Id = (select ParentBookID from tblsubbooks where BookId=" . $sub_book_id . ")";
        $wpdb->query($sql_fire1);
        $wpdb->query($sql_fire2);
        $wpdb->query($sql_fire3);
        custom_send_email($user_id, $sub_book_id, "BOOKISSUEDTEMPLATE");
        echo json_encode(array('success' => true, 'msg' => "Book has been issued!", "header" => "OK", 'color' => 'success'));
        //echo json_encode(array('success' =>true , 'msg'=> "Book has been issued!","header"=>"OK",'color'=>'success',"demo"=>$sql_fire1." ".$sql_fire2." ".$sql_fire3));
        wp_die();
    } else {
        echo json_encode(array('success' => true, 'msg' => __("User Limit Has reached!" , 'library-management-system' ), "header" => "OK", 'color' => 'info'));
        wp_die();
    }
}

add_action('wp_ajax_get_all_issued_book', 'get_all_issued_book');
add_action('wp_ajax_nopriv_get_all_issued_book', 'get_all_issued_book');
function get_all_issued_book()
{
    global $wpdb, $current_user;
    $todo = $wpdb->_real_escape($_REQUEST["todo"]);
    if ($todo == null && $todo == "") {
        $todo = 0;
    }

    $query_ext ="";
    if($_REQUEST["user_id"]!="" && $_REQUEST["user_id"]!=null)
    {
        $query_ext.="and UserId=".$wpdb->_real_escape($_REQUEST["user_id"]);
    }
    $sql_fire = "select * from tblborrowed where 1=1 and ReturnStatus = " . $todo . " " . $query_ext." order by id desc";
    $full_data = $wpdb->get_results($sql_fire);
    $main_data = array();
    //$sub_data = array();
    foreach ($full_data as $obj) {
        $temp_array = array();
        $book_name = $wpdb->get_var($wpdb->prepare("select BookTitle from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array["BookName"] = $book_name;
        if (count($wpdb->get_results("select * from tblpayments where PayedForEntry=" . $obj->Id)) > 0) {
            $temp_array["CustPaymentStatus"] = "Paid";
        } else {
            $temp_array["CustPaymentStatus"] = "NotPaid";
        }
        $book_desc = $wpdb->get_var($wpdb->prepare("select BookDesc from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array = array_merge($temp_array, array("BookDesc" => wp_trim_words($book_desc, 10, '...')));
        $user_name = $wpdb->get_var($wpdb->prepare("select concat(FirstName,' ',LastName)  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserName" => $user_name));
        $user_phone = $wpdb->get_var($wpdb->prepare("select Phone from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPhone" => $user_phone));
        $user_email = $wpdb->get_var($wpdb->prepare("select Email from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserEmail" => $user_email));
        $user_pic = $wpdb->get_var($wpdb->prepare("select UserPic  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPic" => $user_pic));
        $payment_status = $wpdb->get_var($wpdb->prepare("select PaymentStatus  from tblpayments where BookId=" . $obj->BookId . " and Tbi=" . $obj->Id));
        $temp_array = array_merge($temp_array, array("PaymentStatus" => $payment_status));
        $approved_status = $wpdb->get_var($wpdb->prepare("select ApprovedStatus  from tblpayments where BookId=" . $obj->BookId . " and Tbi=" . $obj->Id));
        $temp_array = array_merge($temp_array, array("ApprovedStatus" => $approved_status));
        $temp_array = array_merge($temp_array, (array)$obj);
        array_push($main_data, $temp_array);
    }
    echo json_encode(array('success' => true, 'data' => $main_data));
    wp_die();
}

add_action('wp_ajax_get_specific_issued_book', 'get_specific_issued_book');
add_action('wp_ajax_nopriv_get_specific_issued_book', 'get_specific_issued_book');
function get_specific_issued_book()
{
    global $wpdb, $current_user;
    $todo = $wpdb->_real_escape($_REQUEST["todo"]);
    if ($todo == null && $todo == "") {
        $todo = 0;
    }
    $query_ext ="";
    if($_REQUEST["user_id"]!="" && $_REQUEST["user_id"]!=null)
    {
        $query_ext.="and UserId=".$wpdb->_real_escape($_REQUEST["user_id"]);
    }
    $sql_fire = "select * from tblborrowed where 1=1 and ReturnStatus = " . $todo . " " . $query_ext;
    $full_data = $wpdb->get_results($sql_fire);
    $main_data = array();
    foreach ($full_data as $obj) {
        $temp_array = array();
        $book_name = $wpdb->get_var($wpdb->prepare("select BookTitle from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array["BookName"] = $book_name;
        $book_desc = $wpdb->get_var($wpdb->prepare("select BookDesc from tblbooks where Id=(select ParentBookID from tblsubbooks where BookId=" . $obj->BookId . ")"));
        $temp_array = array_merge($temp_array, array("BookDesc" => wp_trim_words($book_desc, 10, '...')));
        $user_name = $wpdb->get_var($wpdb->prepare("select concat(FirstName,' ',LastName)  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserName" => $user_name));
        $user_phone = $wpdb->get_var($wpdb->prepare("select Phone from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPhone" => $user_phone));
        $user_email = $wpdb->get_var($wpdb->prepare("select Email from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserEmail" => $user_email));
        $user_pic = $wpdb->get_var($wpdb->prepare("select UserPic  from tblusers where UserId=" . $obj->UserId . ""));
        $temp_array = array_merge($temp_array, array("UserPic" => $user_pic));
        $payment_status = $wpdb->get_var($wpdb->prepare("select PaymentStatus  from tblpayments where BookId=" . $obj->BookId . " and Tbi=" . $obj->Id));
        $temp_array = array_merge($temp_array, array("PaymentStatus" => $payment_status));
        $approved_status = $wpdb->get_var($wpdb->prepare("select ApprovedStatus  from tblpayments where BookId=" . $obj->BookId . " and Tbi=" . $obj->Id));
        $temp_array = array_merge($temp_array, array("ApprovedStatus" => $approved_status));
        $temp_array = array_merge($temp_array, (array)$obj);
        array_push($main_data, $temp_array);
    }
    echo json_encode(array('success' => true, 'data' => $main_data));
    wp_die();
}

add_action('wp_ajax_return_issued_book', 'return_issued_book');
add_action('wp_ajax_nopriv_return_issued_book', 'return_issued_book');
function return_issued_book()
{
    global $wpdb, $current_user;
    $sub_book_id = $wpdb->_real_escape($_REQUEST["book_no"]);
    $user_id = $wpdb->_real_escape($_REQUEST["user_id"]);
    $notes = $wpdb->_real_escape($_REQUEST["notes"]);
    $fine = $wpdb->_real_escape($_REQUEST["fine"]);
    $book_return_date = $wpdb->_real_escape($_REQUEST["book_return_date"]);
    $delay_day = $wpdb->_real_escape($_REQUEST["delay_day"]);
    $obj_book_return_date = give_mysql_date_format($book_return_date);
    $uid = $wpdb->_real_escape($_REQUEST["uid"]);
    if ($fine == null) {
        $fine = 0;
    }
    if ($notes == null) {
        $notes = "";
    }
    if ($delay_day == null) {
        $delay_day = 0;
    }
    $sql_fire1 = "update tblborrowed set DateReturned='" . $obj_book_return_date . "',Notes='" . $notes . "',DelayedDay=" . $delay_day . ",ReturnStatus=1,Fine=" . $fine . " where BookId=" . $sub_book_id . " and UserId=" . $user_id . " and Id=" . $uid;
    $sql_fire2 = "update tblsubbooks set Available = 1 where BookId=" . $sub_book_id . "";
    $sql_fire3 = "update tblbooks set Borrowed=Borrowed-1 where Id = (select ParentBookID from tblsubbooks where BookId=" . $sub_book_id . ")";
    $wpdb->query($sql_fire1);
    $wpdb->query($sql_fire2);
    $wpdb->query($sql_fire3);
    if (get_option("email_sending_process","false")) {
        custom_send_email($user_id, $sub_book_id, "BOOKRETURNEDTEMPLATE");
    }
    echo json_encode(array('success' => true, 'msg' => __("Book has been returned!" , 'library-management-system' ), "header" => "OK", 'color' => 'success'));
    wp_die();
}

function return_issued_book_hardcode($bookno, $userid, $book_return_date, $fine_amount, $delay_day)
{
    global $wpdb;
    $sub_book_id = $wpdb->_real_escape($bookno);
    $user_id = $wpdb->_real_escape($userid);
    $notes = 'Online Mode Payment';
    $fine = $wpdb->_real_escape($fine_amount);
    //$book_return_date = $wpdb->_real_escape($book_return_date);
    $delay_day = $wpdb->_real_escape($delay_day);
    //$uid = $wpdb->_real_escape($uid);
    if ($fine == null) {
        $fine = 0;
    }
    if ($notes == null) {
        $notes = "";
    }
    if ($delay_day == null) {
        $delay_day = 0;
    }
    $sql_fire1 = "update tblborrowed set DateReturned='" . date("Y-m-d") . "',Notes='" . $notes . "',DelayedDay=" . $delay_day . ",ReturnStatus=1,Fine=" . $fine . " where BookId=" . $sub_book_id . " and UserId=" . $user_id ;
    $sql_fire2 = "update tblsubbooks set Available = 1 where BookId=" . $sub_book_id . "";
    $sql_fire3 = "update tblbooks set Borrowed=Borrowed-1 where Id = (select ParentBookID from tblsubbooks where BookId=" . $sub_book_id . ")";
    $wpdb->query($sql_fire1);
    $wpdb->query($sql_fire2);
    $wpdb->query($sql_fire3);
    if (get_option("email_sending_process","false")) {
        custom_send_email($user_id, $sub_book_id, "BOOKRETURNEDTEMPLATE");
    }
}

?>