<?php

// [DashBoard Stats Collection ]
add_action('wp_ajax_stats_record', 'record_data');
add_action('wp_ajax_nopriv_stats_record', 'record_data');
function record_data()
{
    global $wpdb;
    $sql_fire1 = "select count(*) from tblborrowed where ReturnStatus = 0 limit 10";
    $temp_array = array();
    $issued_books = $wpdb->get_var($wpdb->prepare($sql_fire1));
    if ($issued_books == "") {
        $issued_books = "0";
    }
    $temp_array["issued_books"] = $issued_books;

    $total_users = $wpdb->get_var($wpdb->prepare("select count(*) from tblusers where Active = 1"));
    if ($total_users == "") {
        $total_users = "0";
    }
    $temp_array = array_merge($temp_array, array("total_users" => $total_users));


    $total_books = $wpdb->get_var($wpdb->prepare("select sum(cnt) from (select count(*) as cnt from tblsubbooks where Active=1 group by ParentBookID) as x"));
    if ($total_books == "") {
        $total_books = "0";
    }
    $temp_array = array_merge($temp_array, array("total_books" => $total_books));
    $total_books_type = $wpdb->get_var($wpdb->prepare("select count(cnt) from (select count(*) as cnt from tblsubbooks where Active=1 group by ParentBookID) as x"));
    if ($total_books_type == "") {
        $total_books_type = "0";
    }
    $temp_array = array_merge($temp_array, array("total_books_type" => $total_books_type));


    $total_approval_users = $wpdb->get_var($wpdb->prepare("select count(*) from tblusers where Active = 0"));
    if ($total_approval_users == "") {
        $total_approval_users = "0";
    }
    $temp_array = array_merge($temp_array, array("total_approval_users" => $total_approval_users));
    $total_fine_collected = $wpdb->get_var($wpdb->prepare("select sum(Fine) from tblborrowed"));
    if ($total_fine_collected == "") {
        $total_fine_collected = "0";
    }
    $temp_array = array_merge($temp_array, array("total_fine_collected" => $total_fine_collected));
    $arrData["data_chart"] = array();
    $temp_book_data["red"] = array();
    //$temp_book_data["red"]
    $full_data = $wpdb->get_results("select BookId FROM tblborrowed");
    foreach ($full_data as $obj) {
        array_push($temp_book_data["red"], $wpdb->get_var($wpdb->prepare("select Id from tblbooks where Id=(select ParentBookId from tblsubbooks where BookId=" . $obj->BookId . ")")));
    }
    $occurences = array_count_values($temp_book_data["red"]);
    foreach ($occurences as $key => $value) {
        array_push($arrData["data_chart"], array('label' => wp_trim_words($wpdb->get_var($wpdb->prepare("select BookTitle from tblbooks where Id=" . $key . "")), 5, '..'), 'y' => $value));
    }
    $temp_array = array_merge($temp_array, $arrData);
    //array_push($temp_array, $full_chart_data);
    echo json_encode(array('success' => true, 'data' => $temp_array), JSON_NUMERIC_CHECK);
    wp_die();
}


?>