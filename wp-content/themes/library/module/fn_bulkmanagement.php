<?php
/**
 * User: Andrew
 * Date: 11/18/2018
 * Time: 4:17 PM
 */

//[ Load Book Data ]
add_action('wp_ajax_manage_bulk_details', 'manage_bulk_details');
add_action('wp_ajax_nopriv_manage_bulk_details', 'manage_bulk_details');
function manage_bulk_details()
{
    print tmp_upload_csv_and_return_array("book_csv");
    exit();
}
