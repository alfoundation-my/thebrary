<?php
// [Add Books Details]
add_action('wp_ajax_add_book_data', 'FuncAddBookData');
add_action('wp_ajax_nopriv_add_book_data', 'FuncAddBookData');
function FuncAddBookData()
{
    global $current_user, $wpdb;
    $book_isbn = trim($wpdb->_real_escape($_REQUEST["book_isbn"]));
    $book_author = $wpdb->_real_escape($_REQUEST["book_author"]);
    $book_title = $wpdb->_real_escape($_REQUEST["book_title"]);
    $book_category = $wpdb->_real_escape($_REQUEST["book_category"]);
    $book_publisher = $wpdb->_real_escape($_REQUEST["book_publisher"]);
    $book_desc = $wpdb->_real_escape($_REQUEST["book_desc"]);
    $book_url = $wpdb->_real_escape($_REQUEST["book_url"]);
    $book_goo_id = $wpdb->_real_escape($_REQUEST["book_goo_id"]);
    $book_src = $wpdb->_real_escape($_REQUEST["book_src"]);
    $book_external_url = $wpdb->_real_escape($_REQUEST["book_external_url"]);
//   if ($book_src == "") {
//        $book_src = $wpdb->_real_escape($_REQUEST["book_tmp_image_link"]);
//    }
    $pic_id = "";
    if (!empty($_FILES['book_upload_img']['name'])) {
        $MainCoverId = upload_image("book_upload_img", 0);
    } else {
        if ($book_src != "") {
            if (strpos($book_src, 'curl') !== false) {
                $book_src = preg_replace("/zoom=(.*?)&/", "zoom=6&", $book_src);
            }
            $MainCoverId = uploadRemoteImageAndAttach($book_src . '.jpg', 0);
        } else {
            $MainCoverUrl = $book_src;
        }
    }
    if (!empty($_FILES['book_upload_pdf']['name'])) {
        $book_url = upload_pdf("book_upload_pdf", 0);
    }
    $book_price = $wpdb->_real_escape($_REQUEST["book_price"]);
    $book_qty = $wpdb->_real_escape($_REQUEST["book_qty"]);

    if ($book_desc == "") {
        $book_desc = "N/A";
    }
    $sql_fire = "insert into tblbooks (Book_Goo_ID,ISBN,BookTitle,Category,BookDesc,Author,BookPublisher,BookUrl,MainCoverId,Price,Qty,AddedOn,AddedBy,MainCoverUrl,ExternalUrl) values('" . $book_goo_id . "','" . $book_isbn . "','" . $book_title . "','" . $book_category . "','" . $book_desc . "','" . $book_author . "','" . $book_publisher . "','" . $book_url . "','" . $MainCoverId . "'," . $book_price . "," . $book_qty . ",CURDATE(),'" . $current_user->ID . "','" . $MainCoverUrl . "','" . $book_external_url . "')";
    $temp_check = $wpdb->get_row("select count(*) as count from tblbooks where ISBN  like '" . $book_isbn . "'");
    if ($temp_check->count == 0) {
        $id_updated = $wpdb->query($sql_fire);
        if ($id_updated != 0) {
            $last_book_id = $wpdb->insert_id;
            //$new_book_id =  $wpdb->get_var($wpdb->prepare("select BookId from tblbooks where Id =".$last_book_id));
            for ($i = 1; $i <= $book_qty; $i++) {
                $wpdb->query("insert into tblsubbooks (BookId,ParentBookID) values(" . generateRandomString(7) . "," . $last_book_id . ");");
            }
            echo json_encode(array('success' => true, "msg" => __('Adding of books is done!', 'library-management-system'), 'color' => 'success', 'header' => "Success"));
            wp_die();
        } else {
            echo json_encode(array('success' => true, "msg" => __("Adding of book failed!", 'library-management-system'), 'color' => 'info', 'header' => "Info"));
            wp_die();
        }
    } else {
        echo json_encode(array('success' => false, "msg" => __("Isbn already exist!", 'library-management-system'), 'color' => 'info', 'header' => "Info"));
        wp_die();
    }
}

function update_books_qty($parent_book_id)
{
    global $wpdb;
    $total_books = $wpdb->get_row("select count(*) as count from tblsubbooks where ParentBookID =" . $parent_book_id . " and Active=1");
    $wpdb->query("update tblbooks set Qty=" . $total_books->count . " where Id =" . $parent_book_id);
}

// [Creating Sub Books If ISBN Exists]
add_action('wp_ajax_add_sub_book_data', 'FuncAddSubBooks');
add_action('wp_ajax_nopriv_add_sub_book_data', 'FuncAddSubBooks');
function FuncAddSubBooks()
{
    global $wpdb;
    $book_isbn = trim($wpdb->_real_escape($_REQUEST["book_isbn"]));
    $book_qty = $wpdb->_real_escape($_REQUEST["book_qty"]);

    $new_book_id = $wpdb->get_row("select Id from tblbooks where ISBN =" . $book_isbn);
    for ($i = 1; $i <= $book_qty; $i++) {
        $wpdb->query("insert into tblsubbooks (BookId,ParentBookID) values(" . generateRandomString(7) . "," . $new_book_id->Id . ");");
    }
    update_books_qty($new_book_id->Id);
    echo json_encode(array('success' => true, "msg" => __("Adding of books is done!", 'library-management-system'), 'color' => 'success', "header" => "Info"));
    wp_die();
}

function get_parent_book_name_from_sub_book_id($sub_book_id)
{
    global $wpdb;
    $raw_sql = "select * from tblbooks where Id=(select ParentBookId from tblsubbooks where BookId=" . $sub_book_id . ")";
    $book_obj = $wpdb->get_row($raw_sql);
    return $book_obj;
}

// Delete Approval Confirmation Check If Any Book Issued
add_action('wp_ajax_delete_approval_check_book_issued', 'delete_approval_check_book_issued');
add_action('wp_ajax_nopriv_delete_approval_check_book_issued', 'delete_approval_check_book_issued');
function delete_approval_check_book_issued()
{
    global $wpdb;
    if (isset($_REQUEST["user_id"]) && $_REQUEST["user_id"] != "") {
        $full_data = $wpdb->get_results("select * from tblborrowed where UserId=" . $_REQUEST["user_id"] . " and ReturnStatus=0");
        //$book_data["book_info"] = array();
        $book_name = "";
        foreach ($full_data as $obj) {
            $book_name .= get_parent_book_name_from_sub_book_id($obj->BookId)->BookTitle . ' ';
        }
        echo json_encode(array('success' => true, 'data' => $book_name, 'color' => 'success', 'header' => 'Success'));
    } else {
        echo json_encode(array('success' => true, 'msg' => __("User Id coudn't be found.", 'library-management-system'), 'color' => 'info', 'header' => 'Success'));
    }
    wp_die();
}

// [ Updating Specific Book Data ]
add_action('wp_ajax_update_specific_parent_book', 'update_specific_parent_book');
add_action('wp_ajax_nopriv_update_specific_parent_book', 'update_specific_parent_book');
function update_specific_parent_book()
{
    global $wpdb;
    $book_id = $wpdb->_real_escape($_REQUEST["selected_book_id"]);
    $book_publisher = $wpdb->_real_escape($_REQUEST["selected_book_publisher"]);
    $book_title = $wpdb->_real_escape($_REQUEST["selected_book_title"]);
    $book_category = $wpdb->_real_escape($_REQUEST["select_book_category"]);
    $book_author = $wpdb->_real_escape($_REQUEST["select_book_author"]);
    $book_price = $wpdb->_real_escape($_REQUEST["select_book_price"]);
    $book_desc = $wpdb->_real_escape($_REQUEST["selected_book_desc"]);
    $book_img = $wpdb->_real_escape($_REQUEST["select_book_img"]);
    $book_external_url = $wpdb->_real_escape($_REQUEST["select_book_external_url"]);
    $select_book_preview_lnk = $wpdb->_real_escape($_REQUEST["select_book_preview_lnk"]);
    if ($book_publisher == null || $book_publisher == "") {
        $book_publisher = "N/A";
    }
    if ($book_title == null || $book_title == "") {
        $book_title = "N/A";
    }
    if ($book_category == null || $book_category == "") {
        $book_category = "N/A";
    }
    if ($book_author == null || $book_author == "") {
        $book_author = "N/A";
    }
    if ($book_price == null || $book_price == "") {
        $book_price = 0;
    }
    if ($book_desc == null || $book_desc == "") {
        $book_desc = "N/A";
    }
    if (!empty($_FILES['book_img_upload']['name'])) {
        $book_img = upload_image("book_img_upload", 0);
    }
    if (!empty($_FILES['book_pdf_upload']['name'])) {
        $select_book_preview_lnk = upload_pdf("book_pdf_upload", 0);
    }
    if ($book_img == null || $book_img == "") {
        echo json_encode(array('success' => true, "msg" => __("Kindly Specify a image!", 'library-management-system'), "header" => "Issue", 'color' => 'error'));
        exit();
    }
//    if ($select_book_preview_lnk == null || $select_book_preview_lnk == "") {
//        echo json_encode(array('success' => true, "msg" => "Kindly Specify a pdf link!", "header" => "Issue", 'color' => 'error'));
//        exit();
//    }
    $sql_fire = "Update tblbooks set BookTitle='" . $book_title . "',Category='" . $book_category . "',Author='" . $book_author . "',BookPublisher='" . $book_publisher . "',BookDesc='" . $book_desc . "',Price=" . $book_price . ",MainCoverId='" . $book_img . "',BookUrl='" . $select_book_preview_lnk . "',ExternalUrl='" . $book_external_url . "' where Id=" . $book_id;
    $id_updated = $wpdb->query($sql_fire);
    //print_r($sql_fire);
    //exit();
    if ($id_updated >= 0) {
        echo json_encode(array('success' => true, "msg" => __("Updating of book has been done!", 'library-management-system'), "header" => "OK", 'color' => 'success'));
    } else {
        echo json_encode(array('success' => true, "msg" => __("Some error occured!", 'library-management-system'), "header" => "Issue", 'color' => 'info'));
    }
    wp_die();
}

//[ Load Book Data ]
add_action('wp_ajax_load_all_book_data', 'get_all_book_data');
add_action('wp_ajax_nopriv_load_all_book_data', 'get_all_book_data');
function get_all_book_data()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    if (isset($_REQUEST["bname"]) && !empty($_REQUEST["bname"])) {
        $query_ext .= ' and BookTitle like "%' . $_REQUEST["bname"] . '%" ';
    }
    if (isset($_REQUEST["bisbn"]) && !empty($_REQUEST["bisbn"])) {
        $query_ext .= ' and ISBN like "%' . $_REQUEST["bisbn"] . '%" ';
    }
    //$query_ext .= ' order by Qty';
    $sql_fire = "SELECT * FROM tblbooks where 1=1 " . $query_ext;
    $sql_fire .= "order by ID desc limit 500";
    $full_data = $wpdb->get_results($sql_fire);
    if (!empty($full_data)) {
        foreach ($full_data as $book_obj) {
            $dynamic_html .= "<tr style='" . ($book_obj->Qty == 0 ? 'background-color:#d3d3d36b' : '') . "'>";
            $dynamic_html .= '<td style="display:none;">' . $book_obj->Id . '</td>';
            $dynamic_html .= '<td style="text-align:left;">' . $book_obj->ISBN . '</td>';
            $m_url = !empty($book_obj->MainCoverId) ? wp_get_attachment_image_src($book_obj->MainCoverId, "thumbnail", false)[0] : $book_obj->MainCoverUrl;
            $dynamic_html .= '<td style="text-align:left;"><img style="width: 150px;border: 2px solid lightgray;" src="' . $m_url . '"/></td>';
            #echo $dynamic_html;
            #die();
            $dynamic_html .= '<td style="text-align:left;" class="wrap_book_title" id="book_tit_' . $book_obj->Id . '">' . $book_obj->BookTitle . '</td>';
            if ($book_obj->BookDesc != "") {
                $dynamic_html .= '<td style="text-align:left;" class="wrap_book_desc book_desc_mng">' . wp_trim_words($book_obj->BookDesc, 30, '...') . '</td>';
            } else {
                $dynamic_html .= '<td style="text-align:left;" class="wrap_book_desc book_desc_mng">None</td>';
            }
            if ($book_obj->Category != "") {
                $dynamic_html .= '<td style="text-align:left;" class="book_cat_mng">' . $book_obj->Category . '</td>';
            } else {
                $dynamic_html .= '<td style="text-align:left;" class="book_cat_mng">None</td>';
            }
            $dynamic_html .= '<td style="text-align:left;" class="book_price_mng">' . $book_obj->Price . '</td>';
            $dynamic_html .= '<td style="text-align:left;" class="book_qty_mng">' . $book_obj->Qty . '</td>';
            $dynamic_html .= '<td style="text-align:left;" class="book_borr_mng">' . $book_obj->Borrowed . '</td>';
            $dynamic_html .= '<input type="hidden" id="ISBN_' . $book_obj->Id . '" value="' . $book_obj->ISBN . '">
				<input type="hidden" id="book_title_' . $book_obj->Id . '" value="' . $book_obj->BookTitle . '">
				<input type="hidden"  id="book_desc_' . $book_obj->Id . '" value="' . $book_obj->BookDesc . '">
				<input type="hidden" id="book_category_' . $book_obj->Id . '" value="' . $book_obj->Category . '">
				<input type="hidden" id="book_price_' . $book_obj->Id . '" value="' . $book_obj->Price . '">
				<input type="hidden" id="book_publisher_' . $book_obj->Id . '" value="' . $book_obj->BookPublisher . '">
				<input type="hidden" id="book_author_' . $book_obj->Id . '" value="' . $book_obj->Author . '">';
            $dynamic_html .= '<input type="hidden" id="book_img_' . $book_obj->Id . '" value="' . $book_obj->MainCoverUrl . '">';
            $dynamic_html .= '<input type="hidden" id="book_eurl_' . $book_obj->Id . '" value="' . $book_obj->ExternalUrl . '">';
            $dynamic_html .= '<input type="hidden" id="book_img_id_' . $book_obj->Id . '" value="' . $book_obj->MainCoverId . '">            			
				<input type="hidden" id="book_pdf_' . $book_obj->Id . '" value="' . $book_obj->BookUrl . '">';
            $dynamic_html .= '<td>';
            $dynamic_html .= '<button class="btn btn-success fix_radius pmd-ripple-effect" ng-click="btn_showAll(' . $book_obj->Id . ');"><span class="fa fa-list"></span>&nbsp;</button>';
            $dynamic_html .= '<button class="btn btn-warning fix_radius pmd-ripple-effect" ng-click="btn_editBookDetails(' . $book_obj->Id . ');"><span class="fa fa-pencil-square-o"></span>&nbsp;</button>';
            $dynamic_html .= '<button class="btn btn-danger fix_radius pmd-ripple-effect"  ng-click="btn_delBookDetails(' . $book_obj->Id . ');"><span class="fa fa-trash-o"></span>&nbsp;</button>';
            $dynamic_html .= '</td>';
            $dynamic_html .= '</tr>';
        }
    } else {
        $dynamic_html .= '<tr>';
        $dynamic_html .= '<td style="text-align:center;" colspan="9">No data exist.</td>';
        $dynamic_html .= '</tr>';
    }
    echo json_encode(array('success' => true, 'table_html' => $dynamic_html));
    wp_die();
}

// [ Load Book Data For User ]
add_action('wp_ajax_load_all_book_user_data', 'get_all_book_data_user');
add_action('wp_ajax_nopriv_load_all_book_user_data', 'get_all_book_data_user');
function get_all_book_data_user()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    if (isset($_REQUEST["bname"]) && !empty($_REQUEST["bname"])) {
        $query_ext .= 'and BookTitle like "%' . $_REQUEST["bname"] . '%"';
    }
    if (isset($_REQUEST["bisbn"]) && !empty($_REQUEST["bisbn"])) {
        $query_ext .= 'and ISBN like "%' . $_REQUEST["bisbn"] . '%"';
    }
    $sql_fire = "SELECT * FROM tblbooks where 1=1 " . $query_ext;
    $sql_fire .= "order by ID desc limit 50 ";
    $full_data = $wpdb->get_results($sql_fire);
    if (!empty($full_data)) {
        foreach ($full_data as $book_obj) {
            $dynamic_html .= "<tr>";
            $dynamic_html .= '<td style="display:none;">' . $book_obj->Id . '</td>';
            $dynamic_html .= '<td style="text-align:left;">' . $book_obj->ISBN . '</td>';
            $dynamic_html .= '<td style="text-align:left;" class="wrap_book_title" id="book_tit_' . $book_obj->Id . '">' . $book_obj->BookTitle . '</td>';
            if ($book_obj->BookDesc != "") {
                $dynamic_html .= '<td style="text-align:left;" class="wrap_book_desc">' . wp_trim_words($book_obj->BookDesc, 10, '...') . '</td>';
            } else {
                $dynamic_html .= '<td style="text-align:left;">None</td>';
            }
            if ($book_obj->Category != "") {
                $dynamic_html .= '<td style="text-align:left;">' . $book_obj->Category . '</td>';
            } else {
                $dynamic_html .= '<td style="text-align:left;">None</td>';
            }
            $dynamic_html .= '<td style="text-align:left;width: 60px;">' . $book_obj->Price . '</td>';
            $dynamic_html .= '<td style="text-align:left;width: 60px;">' . $book_obj->Qty . '</td>';
            $dynamic_html .= '<td style="text-align:left;width: 76px;">' . $book_obj->Borrowed . '</td>';
            $dynamic_html .= '</tr>';
        }
    } else {
        $dynamic_html .= '<tr>';
        $dynamic_html .= '<td style="text-align:center;" colspan="9">No data exist.</td>';
        $dynamic_html .= '</tr>';
    }
    echo json_encode(array('success' => true, 'table_html' => $dynamic_html, 'sql' => $sql_fire));
    wp_die();
}

//[ Load Specific Book Data ]
add_action('wp_ajax_load_specific_book_data', 'load_specific_book_detail');
add_action('wp_ajax_nopriv_load_specific_book_data', 'load_specific_book_detail');
function load_specific_book_detail()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    if (isset($_REQUEST["bid"]) && !empty($_REQUEST["bid"])) {
        $query_ext .= 'and ParentBookId =' . $_REQUEST["bid"];
    }
    $sql_fire = "SELECT * FROM tblsubbooks where 1=1 " . $query_ext;
    $full_data = $wpdb->get_results($sql_fire);
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}

// [Update Specific Book Data]
add_action('wp_ajax_update_specific_book_data', 'update_specific_book_detail');
add_action('wp_ajax_nopriv_update_specific_book_data', 'update_specific_book_detail');
function update_specific_book_detail()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    $sql_fire = "Update tblsubbooks set Active = " . $_REQUEST["status"] . " where BookId=" . $_REQUEST["bid"] . "";
    $id_updated = $wpdb->query($sql_fire);
    $total_books = $wpdb->get_var($wpdb->prepare("select count(*) from tblsubbooks where ParentBookID =" . $_REQUEST["mbookid"] . " and Active=1"));
    $lion_sql = "update tblbooks set Qty=" . $total_books . " where Id =" . $_REQUEST["mbookid"];
    $wpdb->query($lion_sql);
    //update_books_qty($_REQUEST["mbookid"]);
    echo json_encode(array('success' => true, "msg" => __("Book Data has been updated !", 'library-management-system'), "header" => "OK", 'color' => 'success'));
    wp_die();
}

// [Delete All Books Data]
add_action('wp_ajax_delete_book_info', 'delete_book_info');
add_action('wp_ajax_nopriv_delete_book_info', 'delete_book_info');
function delete_book_info()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    $parent_id = $wpdb->_real_escape($_REQUEST["bid"]);
    $books_pid = $wpdb->get_results("select BookId from tblsubbooks where ParentBookID =" . $parent_id . "");
    $sub_book_lst = array();
    foreach ($books_pid as $obj) {
        array_push($sub_book_lst, $obj->BookId);
    }
    $books_not_available_pid_raw = $wpdb->get_results("select BookId from tblsubbooks where ParentBookID =" . $parent_id . " and Available=0");
    $books_not_available_pid = array();
    foreach ($books_not_available_pid_raw as $obj) {
        array_push($books_not_available_pid, $obj->BookId);
    }
    $books_available_pid = $wpdb->get_results("select BookId from tblsubbooks where ParentBookID =" . $parent_id . " and Available=1");
    if (count($sub_book_lst) != count($books_available_pid)) {
        $all_issued_books = implode(',', $books_not_available_pid);
        echo json_encode(array('success' => true, "header" => "OK", 'msg' => 'There are books issued to users kindly return it before deleting. Some of them are [' . $all_issued_books . ']', 'color' => 'info'));
        wp_die();
    } else {
        foreach ($sub_book_lst as $book_id) {
            //Deleteing Book By id if no issued found
            $wpdb->query("delete from tblsubbooks where BookId=" . $book_id);
            $wpdb->query("delete from tblborrowed where BookId=" . $book_id);
        }
        // Deleting  the parent book
        $wpdb->query("delete from tblbooks where Id=" . $parent_id);
    }
    echo json_encode(array('success' => true, "header" => "OK", 'msg' => __('Book has been deleted successfully.', 'library-management-system'), 'color' => 'success'));
    wp_die();
}

add_action('wp_ajax_get_book_details', 'get_specific_book_details');
add_action('wp_ajax_nopriv_get_book_details', 'get_specific_book_details');
function get_specific_book_details()
{
    global $wpdb;
    $query_ext = "";
    $sql_fire = "SELECT * FROM tblbooks tbl1 where tbl1.Id = (select ParentBookId from tblsubbooks where BookId = " . $_REQUEST["book_id"] . " and Active = 1 and Available = 1 limit 1);";
    $full_data = $wpdb->get_results($sql_fire);
    $new_sql = "select count(*) from tblsubbooks where BookId = " . $_REQUEST["book_id"] . " and Active = 0";
    $temp_data = $wpdb->get_var($wpdb->prepare($new_sql));
    if ($temp_data != "0") {
        $msg = __("Book has been deactivated/not found", 'library-management-system');
    }
    echo json_encode(array('success' => true, 'data' => $full_data, "header" => "OK", 'msg' => $msg, 'color' => 'info'));
    wp_die();
}

?>