<?php
/* Template Name: Export Books Data */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/8/2020
 * Time: 1:44 PM
 */
global $wpdb;
$result = $wpdb->get_results("select * from tblbooks");
$column_name = array("Id", "Book_Goo_ID", "ISBN", "BookTitle", "BookDesc", "Category", "Author", "BookPublisher", "BookUrl", "MainCoverId", "MainCoverUrl", "ExternalUrl", "Price", "Qty", "Borrowed", "AddedOn", "AddedBy");
$sql_main_query = "No row exist in tables";
if (count($result) > 0) {
    $sql_data = "insert into tblbooks (";
    foreach ($column_name as $col) {
        $sql_data .= $col . ",";
    }
    $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
    $sql_data .= ") values ";
    foreach ($result as $obj) {
        #print_r($obj->Id);
        #break;
        $sql_data .= "(";
        foreach ($column_name as $col) {
            if (!is_numeric($obj->$col) && !empty($obj->$col)) {
                $sql_data .= "'";
            }
            if ($col == "MainCoverId") {
                $sql_data .= "null";
            } else {
                if ($col == "MainCoverUrl") {
                    if (!empty($obj->MainCoverId)) {
                        if (!endsWith($sql_data, "'")) {
                            $sql_data .= "'";
                        }
                        $sql_data .= $wpdb->_real_escape(wp_get_attachment_image_src($obj->MainCoverId, "full", false)[0]);
                        if (!endsWith($sql_data, "'")) {
                            $sql_data .= "'";
                        }
                    } else {
                        if (!empty($obj->$col)) {
                            if (!endsWith($sql_data, "'")) {
                                $sql_data .= "'";
                            }
                            $sql_data .= $wpdb->_real_escape($obj->$col);
                            if (!endsWith($sql_data, "'")) {
                                $sql_data .= "'";
                            }
                        } else {
                            $sql_data .= "null";
                        }
                    }
                } else {
                    if ($col == "Borrowed") {
                        // A clean record exporting
                        $sql_data .= '0';
                    } elseif ($col == "ExternalUrl") {
                        $sql_data .= "null";
                    } else {
                        $sql_data .= $wpdb->_real_escape($obj->$col);
                    }
                }
            }
            if (!is_numeric($obj->$col) && !empty($obj->$col)) {
                $sql_data .= "'";
            }
            $sql_data .= ",";
        }
        $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
        $sql_data .= "),";
#break;
    }
    $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
    $sql_data .= ";";
    $tmp = str_replace(",,", ",null,", $sql_data);
    $sql_main_query = str_replace("'',", "',", $tmp);
}
// Lets get the sub_books
$column_name = array("Id", "BookId", "Available", "ParentBookID", "Active");
$result = $wpdb->get_results("select * from tblsubbooks");
if (count($result) > 0) {
    $sql_data = "insert into tblsubbooks (";
    foreach ($column_name as $col) {
        $sql_data .= $col . ",";
    }
    $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
    $sql_data .= ") values ";
    foreach ($result as $obj) {
        #print_r($obj->Id);
        #break;
        $sql_data .= "(";
        foreach ($column_name as $col) {
            $sql_data .= $wpdb->_real_escape($obj->$col);
            $sql_data .= ",";
        }
        $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
        $sql_data .= "),";
    }
    $sql_data = substr($sql_data, 0, strlen($sql_data) - (strlen(",")));
    $sql_data .= ";";
    $sql_main_query .= $sql_data;
}
header('Content-Disposition: attachment; filename="books_backup.sql"');
header('Content-Type: text/plain'); # Don't use application/force-download - it's not a real MIME type, and the Content-Disposition header is sufficient
header('Content-Length: ' . strlen($sql_main_query));
header('Connection: close');
#echo $str;
echo $sql_main_query;
?>