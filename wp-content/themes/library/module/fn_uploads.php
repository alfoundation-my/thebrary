<?php
// [ Save Profile Image Auto Upload Handler ]
add_action('wp_ajax_save_img_get_id', 'FuncSaveImageAndReturnID');
add_action('wp_ajax_nopriv_save_img_get_id', 'FuncSaveImageAndReturnID');
function FuncSaveImageAndReturnID()
{
   require_once(ABSPATH . 'wp-admin/includes/image.php');
   require_once(ABSPATH . 'wp-admin/includes/file.php');
   require_once(ABSPATH . 'wp-admin/includes/media.php');
   $allowed = array('jpg', 'jpeg', 'png');
   $filename = $_FILES['upload_img']['name'];
   $filename = strtolower($filename);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);   
   if (!in_array($ext, $allowed)) {
       echo json_encode(array('success' => true, "msg" => "Only images should be uploaded!", 'color' => 'info', 'header' => "Info"));
       wp_die();
   }
   $attachment_id = media_handle_upload('upload_img', 0);
   echo json_encode(array('success' => true, 'attach_id' => $attachment_id, 'msg' => 'Success.', 'color' => 'info', 'header' => "Info"));
   wp_die();
}

// [Upload From Remote Location]
function uploadRemoteImageAndAttach($image_url, $parent_id)
{
    safety();
    $image = $image_url;
    $get = wp_remote_get($image);
    $type = wp_remote_retrieve_header($get, 'content-type');
    if (!$type)
        return false;
    $mirror = wp_upload_bits(basename($image), '', wp_remote_retrieve_body($get));
    $attachment = array(
        'post_title' => generateRandomString(7),
        'post_mime_type' => $type,
    );
    $attach_id = wp_insert_attachment($attachment, $mirror['file'], $parent_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $mirror['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    return $attach_id;
}

// [Save Profile Img Base64]
function FuncSaveImageNGCamera($image_code)
{
    safety();
    $image = $image_code;
    $directory = "/" . date(Y) . "/" . date(m) . "/";
    $wp_upload_dir = wp_upload_dir();
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);
    $filename = "IMG_" . time() . ".jpeg";
    //$fileurl = $wp_upload_dir['url'] . '/' . basename( $filename );
    $fileurl = "../wp-content/uploads" . $directory . $filename;
    file_put_contents($fileurl, $data);
    $filetype = wp_check_filetype(basename($fileurl), null);
    //require_once(ABSPATH.'/wp-admin/includes/image.php' );
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename($fileurl),
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl)),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $fileurl, 0);
    require_once('../wp-admin/includes/image.php');
    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata($attach_id, $fileurl);
    wp_update_attachment_metadata($attach_id, $attach_data);
    if (!is_wp_error($attach_id)) {
        return $attach_id;
    }
    return null;
}

/**
 * @param $file_name Give the file name of the upload file
 * @return gives the attachment_id
 */
function upload_image($file_name, $unique_id)
{
    safety();
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    $allowed = array('jpg', 'jpeg', 'png');
    $filename = $_FILES[$file_name]['name'];
    $filename = strtolower($filename);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        echo json_encode(array('success' => true, "msg" => __("Only images should be uploaded!" , 'library-management-system' ), 'color' => 'info', 'header' => "Info"));
        wp_die();
    }
    $attachment_id = media_handle_upload($file_name, $unique_id);
    return $attachment_id;
}

/**
 * @param $file_name Give the file name of the upload file
 * @return gives the attachment_id
 */
function upload_pdf($file_name, $unique_id)
{
    safety();
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    $allowed = array('pdf');
    $filename = $_FILES[$file_name]['name'];
    $filename = strtolower($filename);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        echo json_encode(array('success' => true, "msg" => __("Only pdf should be uploaded!" , 'library-management-system' ), 'color' => 'info', 'header' => "Info"));
        wp_die();
    }
    $attachment_id = media_handle_upload($file_name, $unique_id);
    if (is_wp_error($attachment_id)) {
        echo json_encode(array('success' => true, "msg" => $attachment_id->get_error_message(), 'color' => 'info', 'header' => "Info"));
        wp_die();
    } else {
        return wp_get_attachment_url($attachment_id);
    }
}
//[ Getting Src From ID ]
add_action('wp_ajax_getSrcFromID', 'get_src_from_id');
add_action('wp_ajax_nopriv_getSrcFromID', 'get_src_from_id');
function get_src_from_id()
{
    global $wpdb;
    $attach_id = $wpdb->_real_escape($_REQUEST["img_id"]);
    $image_attributes = wp_get_attachment_image_src($attach_id, "full");
    echo json_encode(array('success' => true, "src" => $image_attributes[0]));
    wp_die();
}

/**
 * @param $file_name Give the file name of the upload file
 * @return gives in php array format
 */
function tmp_upload_csv_and_return_array($file_name)
{
    safety();
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    $allowed = array('csv');
    $filename = $_FILES[$file_name]['name'];
    $filename = strtolower($filename);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        echo json_encode(array('success' => true, "msg" => __("Only csv should be uploaded!" , 'library-management-system' ), 'color' => 'info', 'header' => "Info"));
        wp_die();
    }
    return array_map('str_getcsv', file($filename));
}

?>
