<?php
/* Updating Manager */
$local_path = "http://localhost/updater/udate.txt";
$local_path_json = "http://localhost/updater/updated_files.json";
//-----------------
$server_path = "http://library-management.com/code_v3/udate.txt";
$server_path_json = "http://library-management.com/code_v3/updated_files.json";
//-----------------

$local_path = $server_path;
$local_path_json = $server_path_json;
//-----------------
function write_data($link, $file_name)
{
    $file_content = file_get_contents($link);
    $r_filename = get_template_directory() . '/';
    if (strpos($file_name, '.css') !== false) {
        $r_filename .= "css/";
    }
    if (strpos($file_name, '.js') !== false) {
        $r_filename .= "js/";
    }
    if (strpos($file_name, '.jpg') !== false) {
        $r_filename .= "img/";
    }
    if (strpos($file_name, 'fn_') !== false) {
        $r_filename .= "module/";
    }
    $r_filename .= $file_name;
    $myfile = fopen($r_filename, "w");
    fwrite($myfile, $file_content);
    fclose($myfile);
    return true;
}

function del_file($file_name)
{
    $r_filename = get_template_directory() . '/';
    if (strpos($file_name, '.css') !== false) {
        $r_filename .= "css/";
    }
    if (strpos($file_name, '.js') !== false) {
        $r_filename .= "js/";
    }
    if (strpos($file_name, '.jpg') !== false) {
        $r_filename .= "img/";
    }
    if (strpos($file_name, 'fn_') !== false) {
        $r_filename .= "module/";
    }
    $r_filename .= $file_name;
    if (file_exists($r_filename)) {
        return unlink($r_filename);
    }
}

function copy_file($file_name)
{
    $r_filename = get_template_directory() . '/';
    if (strpos($file_name, '.css') !== false) {
        $r_filename .= "css/";
    }
    if (strpos($file_name, '.js') !== false) {
        $r_filename .= "js/";
    }
    if (strpos($file_name, '.jpg') !== false) {
        $r_filename .= "img/";
    }
    if (strpos($file_name, 'fn_') !== false) {
        $r_filename .= "module/";
    }
    $r_filename .= $file_name;
    $n_bck_file = get_template_directory() . '/bck/' . date('d-m-Y') . '_bck_' . $file_name;
    return copy($r_filename, $n_bck_file);
}

function done_updated()
{
    global $local_path, $server_path;
    $date = date('d-m-Y');
    if (!check_if_running_local()) {
        $updated_date = file_get_contents($server_path);
    } else {
        $updated_date = file_get_contents($local_path);
    }
    $n_bck_file = get_template_directory() . '/bck/' . $updated_date . '.dat';
    file_put_contents($n_bck_file, "done");
}

function if_updated()
{
    global $local_path, $server_path;
    if (!check_if_running_local()) {
        $updated_date = file_get_contents($server_path);
    } else {
        $updated_date = file_get_contents($local_path);
    }
    $n_bck_file = get_template_directory() . '/bck/' . $updated_date . '.dat';
    if (file_exists($n_bck_file)) {
        return true;
    }
    return false;
}

function check_if_exist($file_name, $file_location)
{
    $r_filename = get_template_directory() . '/';
    if (strpos($file_name, '.css') !== false) {
        $r_filename .= "css/";
    }
    if (strpos($file_name, '.js') !== false) {
        $r_filename .= "js/";
    }
    if (strpos($file_name, '.jpg') !== false) {
        $r_filename .= "img/";
    }
    if (strpos($file_name, 'fn_') !== false) {
        $r_filename .= "module/";
    }
    $r_filename .= $file_name;
    if (file_exists($r_filename)) {
        return true;
    } else {
        file_put_contents($r_filename, file_get_contents($file_location));
        return false;
    }
}

add_action('wp_ajax_update_code', 'FuncUpdateCode');
add_action('wp_ajax_nopriv_update_code', 'FuncUpdateCode');
function FuncUpdateCode()
{
    global $local_path_json,$server_path_json;

    if (!file_exists(get_template_directory() . '/bck/lock.dat')) {
        global $wpdb, $current_user;
        if (!check_if_running_local()) {
            $read_m_files = file_get_contents($server_path_json);
        } else {
            $read_m_files = file_get_contents($local_path_json);
        }
        if ($read_m_files == "") {
            echo json_encode(array('success' => true, 'msg' => __('No files found to be updated!' , 'library-management-system' ), "header" => "Success", 'color' => 'success'));
            wp_die();
        }
        $json_a = json_decode($read_m_files, true);
        $count = count($json_a);
        $file_names_found = array();
        $file_links = array();
        if (!if_updated()) {
            foreach ($json_a as $key => $mvalue) {
                if (strpos($mvalue["filename"], ".sql") === false && strpos($mvalue["filename"], ".png") === false && strpos($mvalue["filename"], ".jpg") === false) {
                    if (check_if_exist($mvalue["filename"], $mvalue["file_location"])) {
                        array_push($file_names_found, $mvalue["filename"]);
                        array_push($file_links, $mvalue["file_location"]);
                        copy_file($mvalue["filename"]);
                        if (del_file($mvalue["filename"])) {
                            if (write_data($mvalue["file_location"], $mvalue["filename"])) {
                                done_updated();
                            }
                        }
                    } else {
                        array_push($file_names_found, $mvalue["filename"]);
                    }
                } else {
                    if (strpos($mvalue["filename"], ".sql") !== false) {
                        global $wpdb;
                        $sql = file_get_contents($mvalue["file_location"]);
                        $wpdb->query($sql);
                        array_push($file_names_found, $mvalue["filename"]);
                    }
                    if (strpos($mvalue["filename"], ".png") !== false || strpos($mvalue["filename"], ".jpg") !== false) {
                        array_push($file_names_found, $mvalue["filename"]);
                        file_put_contents(get_template_directory() . '/img/' . $mvalue["filename"], file_get_contents($mvalue["file_location"]));
                    }
                    done_updated();
                }
            }
        } else {
            echo json_encode(array('success' => true, 'msg' => __( 'Files are already upto date.', 'library-management-system' ), "header" => "Success", 'color' => 'success'));
            wp_die();
        }
        echo json_encode(array('success' => true, 'msg' => '', "count" => $count, "filenames" => $file_names_found, "filelinks" => $file_links, "header" => "Success", 'color' => 'success'));
        wp_die();
    } else {
        echo json_encode(array('success' => true, 'msg' => __('Files are locked on server.' , 'library-management-system' ), "header" => "Success", 'color' => 'success'));
        wp_die();
    }
}

?>