<?php

add_action('wp_ajax_manage_slides', 'manage_slides');
add_action('wp_ajax_nopriv_manage_slides', 'manage_slides');
function manage_slides()
{

    global $wpdb;
    $action = $_REQUEST["todo"];
    if ($action == "addslide") {
        $file_id = upload_image("slide","slide");
        if ($file_id != null) {
            $sql = "INSERT INTO `tblslides` (`Id`, `Img_Attach_Id`, `Active`, `CDate`) VALUES (NULL,'" . $file_id . "',1,'" . get_cdate() . "')";
            $wpdb->query($sql);
            echo json_encode(array("status" => true, 'data' => "", "msg" => __("Slide saved" , 'library-management-system' ), "header" => "OK", "color" => "info"));
            wp_die();
        } else {
            echo json_encode(array("status" => true, 'data' => "", "msg" => __("Slide could not be saved" , 'library-management-system' ), "header" => "OK", "color" => "info"));
            wp_die();
        }

    }

    if ($action == "editslide") {
        $id = sanitize_text_field($_REQUEST["id"]);
        $file_id = upload_image("slide","slide");
        if ($file_id != null) {
            $sql = "Update `tblslides` set `Img_Attach_Id`='" . $file_id . "' where Id = " . $id;
            $wpdb->query($sql);
            echo json_encode(array("status" => true, 'data' => "", "msg" => __("Slide updated" , 'library-management-system' ), "header" => "OK", "color" => "info"));
            wp_die();
        } else {
            echo json_encode(array("status" => true, 'data' => "", "msg" => __("Slide could not be saved" , 'library-management-system' ), "header" => "OK", "color" => "info"));
            wp_die();
        }
    }
    if ($action == "getslides") {
        $sql = "select * from tblslides";
        $data = $wpdb->get_results($sql);
        $url_lst = array();
        foreach ($data as $url_data) {
            array_push($url_lst, array("id" => $url_data->Id, "img_url" => wp_get_attachment_url($url_data->Img_Attach_Id)));
            //array_push($url_lst,$url_data->id);
        }
        echo json_encode(array("status" => true, 'data' => $url_lst));
        exit();
    }
    if ($action == "delslide") {
        $id = sanitize_text_field($_POST["id"]);
        $sql = "delete from tblslides where Id = " . $id;
        $wpdb->query($sql);
        echo json_encode(array("status" => true, 'data' => "", "msg" => __("Slide deleted successfully." , 'library-management-system' ), "header" => "OK", "color" => "success"));
        exit();
    }
}

?>