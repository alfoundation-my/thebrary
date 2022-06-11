<?php


add_action('wp_ajax_manageYearForm', 'FuncSaveYearForm');
add_action('wp_ajax_nopriv_manageYearForm', 'FuncSaveYearForm');
function FuncSaveYearForm()
{
    global $wpdb;
    $inlineFormYear = sanitize_text_field($_REQUEST["inlineFormYear"]);
    $todo = sanitize_text_field($_REQUEST["todo"]);
    $id = sanitize_text_field($_REQUEST["id"]);
    if ($todo == "add") {
        $wpdb->query("insert into tblyears (YearName) values('" . $inlineFormYear . "');");
        echo json_encode(array('success' => true, 'msg' => __( " Entry has been added!", 'library-management-system' ), "header" => "Success", 'color' => 'success'));
        wp_die();
    }
    if ($todo == "delete") {
        $wpdb->query("delete from tblyears where Id=" . $id);
        echo json_encode(array('success' => true, 'msg' => __(" Entry has been deleted!" , 'library-management-system' ), "header" => "Success", 'color' => 'success'));
        wp_die();
    }
    if ($todo == "update") {
        $wpdb->query("update tblyears set YearName = '" . $inlineFormYear . "' where Id=" . $id);
        echo json_encode(array('success' => true, 'msg' => __(" Entry has been updated!" , 'library-management-system' ), "header" => "Success", 'color' => 'success'));
        wp_die();
    }
}

add_action('wp_ajax_loadYearForm', 'FuncLoadYearForm');
add_action('wp_ajax_nopriv_loadYearForm', 'FuncLoadYearForm');
function FuncLoadYearForm()
{
    global $wpdb;
    $full_data = $wpdb->get_results("select * from tblyears");
    $dynamic_html = "";
    foreach ($full_data as $obj) {
        $dynamic_html .= "<tr>";
        $dynamic_html .= '<td class="text-align:left;">' . $obj->YearName . '</td>';
        $dynamic_html .= '<td style="text-align:left;">';
        $dynamic_html .= '<button class="btn btn-danger fix_radius pmd-ripple-effect" ng-click="editformbtn(' . $obj->Id . ',\'' . $obj->YearName . '\')" >Edit</button>&nbsp;';
        $dynamic_html .= '<button class="btn btn-danger fix_radius pmd-ripple-effect" ng-click="delbtn(' . $obj->Id . ')" >Delete</button>';
        $dynamic_html .= '</td>';
        $dynamic_html .= '</tr>';
    }
    echo json_encode(array('success' => true, 'dynamic_html' => $dynamic_html, 'data' => $full_data));
    wp_die();
}

function getLevelName($levelid)
{
    global $wpdb;
    $id = $levelid;
    $temp_data = $wpdb->get_var($wpdb->prepare("select YearName from tblyears where Id=" . $id . ";"));
    if ($temp_data != "") {
        return $temp_data;
    }
    return "None";
}

?>