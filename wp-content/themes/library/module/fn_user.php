<?php
// [Using Wodpress Core Functionality to add User to Its Database.So that Login Works]
//error_reporting(-1);
//ini_set('display_errors', 'On');
function create_User_Func($email_address, $password, $new_id, $name, $pic_id)
{
    if (null == username_exists($email_address)) {
        $user_id = wp_create_user($email_address, $password, $email_address);
        wp_update_user(
            array(
                'ID' => $user_id,
                'nickname' => $name
            )
        );
        // Set the role
        $user = new WP_User($user_id);
        $user->set_role('Subscriber');
        add_user_meta($user_id, 'user_id', $new_id);
        add_user_meta($user_id, 'user_name', $name);
        add_user_meta($user_id, 'user_joined', date('M Y'));
        add_user_meta($user_id, 'user_pic_id', $pic_id);
        add_user_meta($user_id, 'user_active', 0);
    }
}

// [Adding Of Users To DB]
add_action('wp_ajax_addUserTodb', 'FuncAddUser');
add_action('wp_ajax_nopriv_addUserTodb', 'FuncAddUser');
function FuncAddUser()
{
    global $current_user, $wpdb;
    $first_name = $wpdb->_real_escape($_REQUEST["first_name"]);
    $last_name = $wpdb->_real_escape($_REQUEST["last_name"]);
    $email = $wpdb->_real_escape($_REQUEST["email"]);
    $course_name = $wpdb->_real_escape($_REQUEST["course_name"]);
    $year_name = $wpdb->_real_escape($_REQUEST["year_name"]);
    $phone = $wpdb->_real_escape($_REQUEST["phone"]);
    $address = $wpdb->_real_escape($_REQUEST["address"]);
    $notes = $wpdb->_real_escape($_REQUEST["note_on_user"]);
    $zip = $wpdb->_real_escape($_REQUEST["zip"]);
    $city = $wpdb->_real_escape($_REQUEST["city"]);
    $role = $wpdb->_real_escape($_REQUEST["role"]);
    $state = $wpdb->_real_escape($_REQUEST["state"]);
    $photo_code = $_REQUEST["photo_code"];
    $password = $wpdb->_real_escape($_REQUEST["password"]);
    $temp_check = $wpdb->get_var($wpdb->prepare("select count(*) as count from tblusers where Email  like '" . $email . "'"));
    if ($temp_check == "0") {
        $usr_attach_photo_id = 0;
        if (!empty($photo_code) && strlen($photo_code) >= 5) {
            $usr_attach_photo_id = FuncSaveImageNGCamera($photo_code);
            if ($usr_attach_photo_id == null) {
                $usr_attach_photo_id = 0;
                //echo json_encode(array("success" => true, "msg" => "Add of profile image failed.", "header" => "OK", "color" => "info"));
                //die();
            }
        } else {
            $usr_attach_photo_id = $photo_code;
            if ($usr_attach_photo_id == "" || $usr_attach_photo_id == null and is_numeric($usr_attach_photo_id)) {
                echo json_encode(array("success" => true, "msg" => __("Profile img couldn't not be uploaded.", 'library-management-system'), "header" => "OK", "color" => "info"));
                die();
            }
        }
//        } else {
//            echo json_encode(array("success" => true, "msg" => "No profile image found.", "header" => "OK", "color" => "info"));
//            die();
//        }
        if ($role == null) {
            $role = "Student";
        }
        if ($password == null) {
            $password = $phone;
        }
        $active = 0;
        if (current_user_can('administrator')) {
            $active = 1;
        }
        $lst_ID = $wpdb->get_var($wpdb->prepare("select UserId from tblusers order by ID desc limit 1"));
        if ($lst_ID == "") {
            $lst_ID = "1000";
        }
        $new_ID = (int)$lst_ID + 1;
        $sql_fire = "insert into tblusers (UserId,UserPic,FirstName,LastName,Address,Zip,City,State,Phone,Email,Course,LevelIndex,Note,AddedBy,AddedOn,Password,Active,Role) values ('" . $new_ID . "'," . $usr_attach_photo_id . ",'" . $first_name . "','" . $last_name . "','" . $address . "','" . $zip . "','" . $city . "','" . $state . "','" . $phone . "','" . $email . "','" . $course_name . "','" . $year_name . "','" . $notes . "','" . $current_user->ID . "',CURDATE(),'" . $password . "'," . $active . ",'" . $role . "')";
        $id_updated = $wpdb->query($sql_fire);
        if ($id_updated != 0) {
            create_User_Func($email, $password, $new_ID, $first_name . " " . $last_name, $usr_attach_photo_id);
            $user = get_user_by('email', $email);
            $userId = $user->ID;
            update_user_meta($userId, 'user_name', $first_name . ' ' . $last_name);
            update_user_meta($userId, "pic_id", $usr_attach_photo_id);
            echo json_encode(array('success' => true, "msg" => __("Adding of user is done !. His ID :", 'library-management-system') . $new_ID, 'color' => 'success', 'header' => 'Success'));
            wp_die();
        } else {
            echo json_encode(array('success' => false, "msg" => __("Adding of user failed !.", 'library-management-system'), 'color' => 'info', 'header' => 'Info'));
            wp_die();
        }
    } else {
        $exist_ID = $wpdb->get_var($wpdb->prepare("select UserId from tblusers where Email  like '" . $email . "'"));
        echo json_encode(array('success' => false, "msg" => __("Person already exist !.His/Her ID : ", 'library-management-system') . $exist_ID, 'color' => 'info', 'header' => 'Info'));
        wp_die();
    }
}

// [Update Users Information]
add_action('wp_ajax_updateUserTodb', 'FuncUpdatePerson');
add_action('wp_ajax_nopriv_updateUserTodb', 'FuncUpdatePerson');
function FuncUpdatePerson()
{
    global $wpdb;
    $user_id = $wpdb->_real_escape($_REQUEST["user_id"]);
    $first_name = $wpdb->_real_escape($_REQUEST["first_name"]);
    $last_name = $wpdb->_real_escape($_REQUEST["last_name"]);
    $email = $wpdb->_real_escape($_REQUEST["email"]);
    $course_id = $wpdb->_real_escape($_REQUEST["course_name"]);
    $year_id = $wpdb->_real_escape($_REQUEST["year_name"]);
    $phone = $wpdb->_real_escape($_REQUEST["phone"]);
    $address = $wpdb->_real_escape($_REQUEST["address"]);
    $note_on_user = $wpdb->_real_escape($_REQUEST["note_on_user"]);
    $zip = $wpdb->_real_escape($_REQUEST["zip"]);
    $city = $wpdb->_real_escape($_REQUEST["city"]);
    $state = $wpdb->_real_escape($_REQUEST["state"]);
    $attach_photo_id = $wpdb->_real_escape($_REQUEST["old_pic_id"]);
    $role = $wpdb->_real_escape($_REQUEST["role"]);
    $photo_code = $_REQUEST["photo_code"];
    //$active = 0;
    global $current_user, $wpdb;
//    if (current_user_can('administrator')) {
//        $active = 1;
//    }
    if (!empty($photo_code) and strlen($photo_code) >= 5) {
        $attach_photo_id = FuncSaveImageNGCamera($photo_code);
        if ($attach_photo_id == null) {
            echo json_encode(array("success" => true, "msg" => __("No profile image found.", 'library-management-system'), "header" => "OK", "color" => "info"));
            die();
        }
    } else {
        //$attach_photo_id = $photo_code;
        // Checking if old photo id exist.
        if ($attach_photo_id == "" || $attach_photo_id == null and is_numeric($attach_photo_id)) {
            echo json_encode(array("success" => true, "msg" => __("No profile image found.", 'library-management-system'), "header" => "OK", "color" => "info"));
            die();
        }
    }
    $lst_ID = $wpdb->get_var($wpdb->prepare("select UserId from tblusers order by ID desc limit 1"));
    //$new_User_ID = (int)$lst_ID + 1;
    $sql_fire = "update tblusers set FirstName='" . $first_name . "',LastName='" . $last_name . "',Address='" . $address . "',Zip='" . $zip . "',Phone='" . $phone . "',Email='" . $email . "',Course=" . $course_id . ",LevelIndex=" . $year_id . ",Note='" . $note_on_user . "',AddedBy=" . $current_user->ID . ",UserPic=" . $attach_photo_id . ",City='" . $city . "',Role='" . $role . "',State='" . $state . "' where Userid=" . $user_id;
    //echo $sql_fire;
    //die();

    $id_updated = $wpdb->query($sql_fire);
    $user = get_user_by('email', $email);
    $userId = $user->ID;
    update_user_meta($userId, 'user_name', $first_name . ' ' . $last_name);
    update_user_meta($userId, "user_pic_id", $attach_photo_id);
    if ($id_updated != 0) {
        echo json_encode(array('success' => true, "msg" => __("Updating of Information is done !", 'library-management-system'), 'color' => 'success', 'header' => 'Success'));
        wp_die();
    }
    if ($id_updated == "") {
        echo json_encode(array('success' => false, "msg" => __("Updating of Information failed !.", 'library-management-system'), 'color' => 'info', 'header' => 'Info'));
        wp_die();
    }
}

// Delete Approval User Details
add_action('wp_ajax_delete_approval_user', 'FuncDeleteUserApproval');
add_action('wp_ajax_nopriv_delete_approval_user', 'FuncDeleteUserApproval');
function FuncDeleteUserApproval()
{
    global $wpdb;
    $wpdb->query("Update tblusers set Active=2 where Id=" . $wpdb->_real_escape($_REQUEST["del_id"]));
    $sql = "select distinct(user_id) from wp_usermeta where meta_key='user_id' and meta_value='" . $wpdb->_real_escape($_REQUEST["user_id"]) . "'";
    $user_id = $wpdb->get_var($sql);
    update_user_meta($user_id, 'user_active', '1');
    echo json_encode(array('success' => true, 'msg' => __("User has been deactivated!.", 'library-management-system'), 'color' => 'success', 'header' => 'Success'));
    wp_die();
}

add_action('wp_ajax_get_user_details', 'get_specific_user_details');
add_action('wp_ajax_nopriv_get_user_details', 'get_specific_user_details');
function get_specific_user_details()
{
    global $wpdb;
    $query_ext = "";
    $sql_fire = "SELECT * FROM tblusers where UserId=" . $wpdb->_real_escape($_REQUEST["user_id"]) . " and Active=1";
    $full_data = $wpdb->get_results($sql_fire);
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}

// [ Load User Details	]
add_action('wp_ajax_load_user_data', 'FuncGetUserApprovalTables');
add_action('wp_ajax_nopriv_load_user_data', 'FuncGetUserApprovalTables');
function FuncGetUserApprovalTables()
{
    global $wpdb;
    $dynamic_html = "";
    $query_ext = "";
    if (isset($_REQUEST["sname"]) && !empty($_REQUEST["sname"])) {
        $query_ext .= 'and (FirstName like "%' . $_REQUEST["sname"] . '%" or LastName like "%' . $_REQUEST["sname"] . '%")';
    }
    if (isset($_REQUEST["sid"]) && !empty($_REQUEST["sid"])) {
        $query_ext .= 'and UserID like "%' . $_REQUEST["sid"] . '%"';
    }
    if (isset($_REQUEST["phone"]) && !empty($_REQUEST["phone"])) {
        $query_ext .= 'and Phone like "%' . $_REQUEST["phone"] . '%"';
    }
    if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
        $query_ext .= 'and Email like "%' . $_REQUEST["email"] . '%"';
    }
    //if(isset($_REQUEST["limit"]) && !empty($_REQUEST["limit"]) && isset($_REQUEST["pg_no"]) && !empty($_REQUEST["pg_no"]))
    //{
    $query_ext .= "limit " . $_REQUEST["pg_no"] . ',' . $_REQUEST["limit"];
    //}
    if (isset($_REQUEST["form_name"]) && $_REQUEST["form_name"] == "UserApprovalForm") {
        $sql_fire = "SELECT * FROM tblusers where Active='0' " . $query_ext;
    } else {
        $sql_fire = "SELECT * FROM tblusers where Active='1' " . $query_ext;
    }
    $full_data = $wpdb->get_results($sql_fire);
    if (!empty($full_data)) {
        foreach ($full_data as $user_obj) {
            $cs_code = "";
            if ($user_obj->Role == "Teacher") {
                $cs_code = "style='background-color: beige;'";
            }
            $dynamic_html .= "<tr " . $cs_code . ">";
            $dynamic_html .= '<td style="display:none;">' . $user_obj->Id . '</td>';
            $dynamic_html .= '<td style="display:none;">
				<input type="hidden" id="zip' . $user_obj->Id . '" value="' . $user_obj->Zip . '">
				<input type="hidden" id="user_pic' . $user_obj->Id . '" value="' . $user_obj->UserPic . '">
				<input type="hidden" id="fname' . $user_obj->Id . '" value="' . $user_obj->FirstName . '">
				<input type="hidden" id="lname' . $user_obj->Id . '" value="' . $user_obj->LastName . '">
				<input type="hidden" id="level_name' . $user_obj->Id . '" value="' . $user_obj->LevelIndex . '">
				<input type="hidden" id="course_name' . $user_obj->Id . '" value="' . $user_obj->Course . '">
				<input type="hidden" id="note' . $user_obj->Id . '" value="' . $user_obj->Note . '">
				<input type="hidden" id="password' . $user_obj->Id . '" value="' . $user_obj->Password . '">
				<input type="hidden" id="state' . $user_obj->Id . '" value="' . $user_obj->State . '">
				<input type="hidden" id="city' . $user_obj->Id . '" value="' . $user_obj->City . '">
				<input type="hidden" id="role' . $user_obj->Id . '" value="' . $user_obj->Role . '">
				<input type="hidden" id="user_pic_url' . $user_obj->Id . '" value="' . wp_get_attachment_image_src($user_obj->UserPic, "full")[0] . '">
				</td>';
            $dynamic_html .= '<td style="text-align:left;" id="user_id_' . $user_obj->Id . '">' . $user_obj->UserId . '</td>';
            $dynamic_html .= '<td style="text-align:left;" ><img style="width:100%;" src="' . wp_get_attachment_image_src($user_obj->UserPic, "full")[0] . '"/></td>';
            $dynamic_html .= '<td style="text-align:left;" >' . $user_obj->FirstName . ' ' . $user_obj->LastName . '</td>';
            $dynamic_html .= '<td style="text-align:left;" id="email' . $user_obj->Id . '" class="wrap_td">' . $user_obj->Email . '</td>';
            $dynamic_html .= '<td style="text-align:left;" id="phone' . $user_obj->Id . '">' . $user_obj->Phone . '</td>';
            $dynamic_html .= '<td style="text-align:left;" id="address' . $user_obj->Id . '" class="wrap_td">' . $user_obj->Address . '</td>';
            $dynamic_html .= '<td style="text-align:left;" id="n_course_name' . $user_obj->Id . '">' . getCourseName($user_obj->Course) . '</td>';
            $dynamic_html .= '<td style="text-align:left;" id="n_level_name' . $user_obj->Id . '">' . getLevelName($user_obj->LevelIndex) . '</td>';
            $dynamic_html .= '<td style="text-align:left;">' . date_format(date_create($user_obj->AddedOn), "d-m-Y") . '</td>';
            $dynamic_html .= '<td style="text-align:left;">';
            if (isset($_REQUEST["form_name"]) && $_REQUEST["form_name"] == "UserApprovalForm") {
                $dynamic_html .= '<button class="btn btn-warning fix_radius" ng-click="btn_approve($event)" user_id="' . $user_obj->UserId . '" bind_id="' . $user_obj->Id . '" contenteditable="false"> <span class="fa fa-check"></span></button>';
            } else {
                $dynamic_html .= '<button class="btn btn-warning fix_radius" ng-click="btn_edit($event)" user_id="' . $user_obj->UserId . '" bind_id="' . $user_obj->Id . '" > <span class="fa fa-pencil-square-o"></span></button>';
                $dynamic_html .= '<button class="btn btn-info fix_radius" ng-click="btn_viewprint($event)" user_id="' . $user_obj->UserId . '"  bind_id="' . $user_obj->Id . '"><span class="fa fa-print"></span></button>';
            }
            $dynamic_html .= '<button ng-click="btn_delete($event)" class="btn btn-danger fix_radius" user_id="' . $user_obj->UserId . '" bind_id="' . $user_obj->Id . '"> <span class="fa fa-times"></span></button>';
            $dynamic_html .= '</td>';
            $dynamic_html .= '</tr>';
        }
    }
    // }else{
    // 	$dynamic_html .='<tr>';
    // 	$dynamic_html .='<td style="text-align:center;" colspan="9">No data exist.</td>';
    // 	$dynamic_html .='</tr>';
    // }
    echo json_encode(array('success' => true, 'table_html' => $dynamic_html));
    wp_die();
}

add_action('wp_ajax_check_user_login', 'CheckUserLogin');
add_action('wp_ajax_nopriv_check_user_login', 'CheckUserLogin');
function CheckUserLogin()
{
    global $wpdb;
    $username = $wpdb->_real_escape($_REQUEST["email"]);
    $password = $wpdb->_real_escape($_REQUEST["password"]);
    $full_data = $wpdb->get_results("select * from tblusers where Email='" . $username . "' and Password='" . $password . "'");
    echo json_encode(array('success' => true, 'data' => $full_data));
    wp_die();
}
