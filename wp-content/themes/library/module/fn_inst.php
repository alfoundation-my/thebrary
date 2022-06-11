<?php


// [Basic Saving OF Institution Data]
function BFuncSaveInstitutionProfile($inst_name, $inst_cont_name, $inst_email, $inst_website, $inst_phone, $inst_fax, $inst_address, $inst_zip, $inst_city, $inst_state, $inst_attach_photo_id, $inst_frnt_desc, $inst_meta_desc, $inst_meta_title, $inst_meta_keyword, $inst_gmap)
{
    if (get_option("inst_name") !== false) {
        update_option('inst_name', $inst_name);
    } else {
        add_option("inst_name", $inst_name);
    }
    if (get_option("inst_cont_name") !== false) {
        update_option('inst_cont_name', $inst_cont_name);
    } else {
        add_option("inst_cont_name", $inst_cont_name);
    }
    if (get_option("inst_email") !== false) {
        update_option('inst_email', $inst_email);
    } else {
        add_option("inst_email", $inst_email);
    }
    if (get_option("inst_website") !== false) {
        update_option('inst_website', $inst_website);
    } else {
        add_option("inst_website", $inst_website);
    }
    if (get_option("inst_phone") !== false) {
        update_option('inst_phone', $inst_phone);
    } else {
        add_option("inst_phone", $inst_phone);
    }
    if (get_option("inst_fax") !== false) {
        update_option('inst_fax', $inst_fax);
    } else {
        add_option("inst_fax", $inst_fax);
    }
    if (get_option("inst_gmap") !== false) {
        update_option('inst_gmap', $inst_gmap);
    } else {
        add_option("inst_gmap", $inst_gmap);
    }
    if (get_option("inst_address") !== false) {
        update_option('inst_address', $inst_address);
    } else {
        add_option("inst_address", $inst_address);
    }
    if (get_option("inst_zip") !== false) {
        update_option('inst_zip', $inst_zip);
    } else {
        add_option("inst_zip", $inst_zip);
    }
    if (get_option("inst_city") !== false) {
        update_option('inst_city', $inst_city);
    } else {
        add_option("inst_city", $inst_city);
    }
    if (get_option("inst_state") !== false) {
        update_option('inst_state', $inst_state);
    } else {
        add_option("inst_state", $inst_state);
    }
    if (get_option("inst_frnt_desc") !== false) {
        update_option('inst_frnt_desc', $inst_frnt_desc);
    } else {
        add_option("inst_frnt_desc", $inst_frnt_desc);
    }
    if (get_option("inst_meta_desc") !== false) {
        update_option('inst_meta_desc', $inst_meta_desc);
    } else {
        add_option("inst_meta_desc", $inst_meta_desc);
    }
    if (get_option("inst_meta_title") !== false) {
        update_option('inst_meta_title', $inst_meta_title);
    } else {
        add_option("inst_meta_title", $inst_meta_title);
    }
    if (get_option("inst_meta_keyword") !== false) {
        update_option('inst_meta_keyword', $inst_meta_keyword);
    } else {
        add_option("inst_meta_keyword", $inst_meta_keyword);
    }
    if (isset($_FILES['upload_image']) && !empty($_FILES['upload_image']['name']) && $_FILES['upload_image']['size'] > 0) {
        $inst_attach_photo_id = upload_image("upload_image", 0);
    }
    if (get_option("inst_attach_photo_id") !== false) {
        update_option('inst_attach_photo_id', $inst_attach_photo_id);
    } else {
        add_option("inst_attach_photo_id", $inst_attach_photo_id);
    }
}

// [Ajax Saving OF Institution Data]
add_action('wp_ajax_saveInstitutionProfile', 'FuncSaveInstitutionProfile');
add_action('wp_ajax_nopriv_saveInstitutionProfile', 'FuncSaveInstitutionProfile');
function FuncSaveInstitutionProfile()
{
    global $wpdb;
    $inst_name = $wpdb->_real_escape($_REQUEST["inst_name"]);
    $inst_cont_name = $wpdb->_real_escape($_REQUEST["inst_cont_name"]);
    $inst_email = $wpdb->_real_escape($_REQUEST["inst_email"]);
    $inst_website = $wpdb->_real_escape($_REQUEST["inst_website"]);
    $inst_phone = $wpdb->_real_escape($_REQUEST["inst_phone"]);
    $inst_fax = $wpdb->_real_escape($_REQUEST["inst_fax"]);
    $inst_address = $wpdb->_real_escape($_REQUEST["inst_address"]);
    $inst_zip = $wpdb->_real_escape($_REQUEST["inst_zip"]);
    $inst_city = $wpdb->_real_escape($_REQUEST["inst_city"]);
    $inst_state = $wpdb->_real_escape($_REQUEST["inst_state"]);
    $inst_gmap = $wpdb->_real_escape($_REQUEST["inst_gmap"]);
    $inst_attach_photo_id = $wpdb->_real_escape($_REQUEST["photo_id"]);
    $inst_frnt_desc = $wpdb->_real_escape($_REQUEST["inst_frnt_desc"]);
    $inst_meta_desc = $wpdb->_real_escape($_REQUEST["inst_meta_desc"]);
    $inst_meta_keyword = $wpdb->_real_escape($_REQUEST["inst_meta_keyword"]);
    $inst_meta_title = $wpdb->_real_escape($_REQUEST["inst_meta_title"]);
    BFuncSaveInstitutionProfile($inst_name, $inst_cont_name, $inst_email, $inst_website, $inst_phone, $inst_fax, $inst_address, $inst_zip, $inst_city, $inst_state, $inst_attach_photo_id, $inst_frnt_desc, $inst_meta_desc, $inst_meta_title, $inst_meta_keyword, $inst_gmap);

    echo json_encode(array('success' => true, "msg" => __("Institution details has been updated.", 'library-management-system'), "header" => "OK", 'color' => 'success'));
    wp_die();
}

add_action('wp_ajax_load_institution_details', 'load_inst_details');
add_action('wp_ajax_nopriv_load_institution_details', 'load_inst_details');
function load_inst_details()
{
    $inst_name = get_option('inst_name');
    $inst_cont_name = get_option('inst_cont_name');
    $inst_email = get_option('inst_email');
    $inst_website = get_option('inst_website');
    $inst_phone = get_option('inst_phone');
    $inst_fax = get_option('inst_fax');
    $inst_address = get_option('inst_address');
    $inst_zip = get_option('inst_zip');
    $inst_city = get_option('inst_city');
    $inst_state = get_option('inst_state');
    $inst_attach_photo_id = get_option('inst_attach_photo_id');
    $full_data = array("Inst_Name" => $inst_name, "Inst_Cont" => $inst_cont_name, "Inst_Email" => $inst_email, "Inst_Web" => $inst_website, "Inst_Phone" => $inst_phone, "Inst_Fax" => $inst_fax, "Inst_Address" => $inst_address, "Inst_Zip" => $inst_zip, "Inst_City" => $inst_city, "Inst_State" => $inst_state);
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}
