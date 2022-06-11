<?php
// [ Loading Some Of The Required Plugin ]
add_action('wp_enqueue_scripts', 'library_handler');
function library_handler()
{
    $slug = basename(get_permalink());
        if($slug != "hello-world" and $slug!="") {
            wp_enqueue_style('font_awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
            wp_enqueue_script("jquery");
            wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
            wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
            wp_enqueue_script('jqueryUI', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'));
            wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css');
            wp_enqueue_style('slick_theme', get_template_directory_uri() . '/css/slick-theme.css');
            wp_enqueue_script('slick_js', get_template_directory_uri() . '/js/slick.min.js');
            wp_enqueue_style('button', get_template_directory_uri() . '/css/button.css');
            wp_enqueue_script('buttonjs', get_template_directory_uri() . '/js/ripple-effect.js', array('jquery'));
            wp_enqueue_style('adminLTE', get_template_directory_uri() . '/css/AdminLTE.min.css');
            wp_enqueue_style('skin', get_template_directory_uri() . '/css/_all-skins.min.css');
            wp_enqueue_script('validatejs', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery'));
            wp_enqueue_script('angular', get_template_directory_uri() . '/js/angular.min.js', array('jquery'));
            wp_enqueue_script('angular-animate', get_template_directory_uri() . '/js/angular-animate.js');
            wp_enqueue_script('numeric_d', get_template_directory_uri() . '/js/jquery.numeric.min.js');
            wp_enqueue_style('iziToastCss', get_template_directory_uri() . '/css/iziToast.min.css');
            wp_enqueue_script('iziToastJs', get_template_directory_uri() . '/js/iziToast.min.js');
            wp_enqueue_style('tooltipcss', get_template_directory_uri() . '/css/angular-tooltips.css');
            wp_enqueue_script('tooltipjs', get_template_directory_uri() . '/js/angular-tooltips.min.js');
            wp_enqueue_style('datetimepickerCss', get_template_directory_uri() . '/css/jquery.datetimepicker.min.css');
            wp_enqueue_script('datetimepickerFullJs', get_template_directory_uri() . '/js/jquery.datetimepicker.full.js', array('jquery'));
            wp_enqueue_script('datetimepickerJs', get_template_directory_uri() . '/js/jquery.datetimepicker.min.js', array('jquery'));
            wp_enqueue_script('AdminLTEJS', get_template_directory_uri() . '/js/app.min.js');
            wp_enqueue_script('slider_js', get_template_directory_uri() . '/js/jquery.slides.min.js', array('jquery'));
            wp_enqueue_script('webcamjs', get_template_directory_uri() . '/js/webcam.min.js');
            wp_enqueue_script('ng-camera', get_template_directory_uri() . '/js/ng-camera.js');
            wp_enqueue_script('chart', get_template_directory_uri() . '/js/canvasjs.min.js');
            wp_enqueue_style('angular_bootstrap_toggle_css', get_template_directory_uri() . '/css/angular-bootstrap-toggle.min.css');
            wp_enqueue_script('angular_bootstrap_toogle_js', get_template_directory_uri() . '/js/angular-bootstrap-toggle.min.js', array('jquery', 'angular'));
            wp_enqueue_script('bootbox', get_template_directory_uri() . '/js/bootbox.min.js', array('jquery'));
            wp_enqueue_script('blockui', get_template_directory_uri() . '/js/jquery.blockUI.js', array('jquery'));
            wp_enqueue_script('datatable_main_js', get_template_directory_uri() . '/js/jquery.dataTables.min.js', array('jquery'));
            wp_enqueue_script('datatable_js', get_template_directory_uri() . '/js/dataTables.bootstrap.min.js', array('datatable_main_js'));
            wp_enqueue_style('datatable_css', get_template_directory_uri() . '/css/dataTables.bootstrap.min.css');
            wp_enqueue_script('tinymce', get_template_directory_uri() . '/js/tinymce/tinymce.min.js');
            wp_enqueue_script('e-custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'validatejs', 'bootbox', 'iziToastJs', 'numeric_d', 'angular_bootstrap_toogle_js', 'datetimepickerFullJs', 'datetimepickerJs', 'AdminLTEJS', 'slick_js', 'slider_js', 'blockui'));
            wp_enqueue_script('e-custom_angular', get_template_directory_uri() . '/js/custom_ang.js', array('jquery', 'validatejs', 'angular', 'angular-animate', 'e-custom_angular_module_upload2', 'bootbox', 'iziToastJs', 'numeric_d', 'webcamjs', 'ng-camera', 'angular_bootstrap_toogle_js', 'datetimepickerFullJs', 'datetimepickerJs', 'chart', 'tooltipjs', 'blockui', 'datatable_main_js'));
            wp_enqueue_script('e-custom_angular_module_upload1', get_template_directory_uri() . '/js/ng-file-upload-shim.js', array('jquery', 'angular'));
            wp_enqueue_script('e-custom_angular_module_upload2', get_template_directory_uri() . '/js/ng-file-upload.js', array('jquery', 'e-custom_angular_module_upload1'));
            wp_localize_script('e-custom', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'loader_path' => get_template_directory_uri(), "boostrap_loc" => get_template_directory_uri() . '/css/bootstrap.min.css', "number_of_row" => get_option("number_of_rows", "0"), "defined_fine" => get_option("fine_rate")));
            wp_enqueue_style('mainstyle', get_stylesheet_uri());
        }

        if ($slug == "login") {
            wp_dequeue_style("skin");
        }

}

add_action('switch_theme', 'deactivated_theme');
function deactivated_theme()
{
    delete_option("nos_of_book_to_show");
    delete_option("nos_of_menu_to_show");
    delete_option("quick_notice");
    delete_option("custom_theme_color");
    delete_option("local_currency");
    delete_option("limit_issue_book");
    delete_option("limit_issue_book_teachers");
    delete_option("hide_wordpress_dashboard");
    delete_option("default_password");
    delete_option("logo_css");
    delete_option("custom_sms_template");
    delete_option("inst_in_cards");
    delete_option("inst_meta_title");
    delete_option("inst_meta_desc");
    delete_option("inst_frnt_desc");
    delete_option("inst_cont_name");
    delete_option("inst_website");
    delete_option("inst_phone");
    delete_option("inst_fax");
    delete_option("inst_address");
    delete_option("inst_zip");
    delete_option("inst_city");
    delete_option("people_to_approve");
    delete_option("inst_email");
    delete_option("inst_name");
    delete_option("inst_state");
    delete_option("inst_gmap");
    global $wpdb;
    $tables_lst = array("tblbooks", "tblborrowed","tblpayments", "tblcourses", "tblrequests", "tblstudents", "tblsubbooks", "tblyears", "tblusers", "tblslides");
    foreach ($tables_lst as $table) {
        $sql = "DROP TABLE IF EXISTS " . $table . ";";
        $wpdb->query($sql);
    }
}

// [ Function Will Run Only Once And Create All The Necessary Tables Required ]
add_action('after_switch_theme', 'create_table_for_LMS');
function create_table_for_LMS()
{
    $sql_raw = "CREATE TABLE `tblbooks` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Book_Goo_ID` varchar(450) NOT NULL,
    `ISBN` varchar(30) NOT NULL,
    `BookTitle` varchar(500) NOT NULL,
    `BookDesc` varchar(15000) NOT NULL,
    `Category` varchar(200) NOT NULL,
    `Author` varchar(50) NOT NULL,
    `BookPublisher` varchar(250) NOT NULL,
    `BookUrl` varchar(2500) NOT NULL,
    `MainCoverId` varchar(10) NOT NULL,
    `MainCoverUrl` text,
    `ExternalUrl` varchar(2500) NULL,
    `Price` int(11) NOT NULL,
    `Qty` int(11) NOT NULL DEFAULT '1',
    `Borrowed` int(11) NOT NULL DEFAULT '0',
    `AddedOn` date NOT NULL,
    `AddedBy` varchar(10) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblborrowed` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `BookId` int(11) NOT NULL,
    `UserId` int(11) NOT NULL,
    `Notes` text,
    `DateBorrowed` date NOT NULL,
    `DateToReturn` date NOT NULL,
    `DateReturned` date DEFAULT NULL,
    `DelayedDay` int(11) DEFAULT NULL,
    `ReturnStatus` int(11) NOT NULL DEFAULT '0',
    `Fine` int(11) NOT NULL DEFAULT '0',
    `AddedOn` date NOT NULL,
    `AddedBy` int(11) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblpayments` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Oid` int(11) NOT NULL,
    `TxnId` varchar(20) NOT NULL,
    `BankRefNo` varchar(50) NOT NULL,
    `PayedAmount` decimal(7,0) NOT NULL,
    `PaymentStatus` varchar(25) NOT NULL,
    `ApprovedStatus` varchar(25) NOT NULL DEFAULT 'NotApproved',
    `BookId` int(11) NOT NULL,
    `Tbi` int(11) NOT NULL,
    `UserId` int(11) NOT NULL,
    `DateDue` date NOT NULL,
    `IssuedDate` date NOT NULL,
    `PayedForDays` int(11) NOT NULL,
    `PaymentMode` varchar(60) NOT NULL,
    `CreatedTime` datetime NOT NULL,
     PRIMARY KEY (`Id`),
     UNIQUE KEY `Oid` (`Oid`)
    );";
    $sql_raw .= "CREATE TABLE `tblrequests` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `BookName` varchar(450) NOT NULL,
    `BookUrl` text,
    `Notes` text,
    `UserId` int(11) NOT NULL,
    `UserName` varchar(450) NOT NULL,
    `Likes` int(11) NOT NULL,
    `Approved` int(11) NOT NULL DEFAULT '0',
    `LikedBy` text NOT NULL,
    `DateAdded` date NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblcourses` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `CourseName` varchar(500) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblusers` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `UserId` int(11) NOT NULL,
    `UserPic` int(11) NOT NULL DEFAULT '0',
    `FirstName` varchar(500) NOT NULL,
    `LastName` varchar(500) NOT NULL,
    `Address` varchar(1500) NOT NULL,
    `Zip` varchar(10) NOT NULL,
    `State` varchar(500) NOT NULL,
    `City` varchar(500) NOT NULL,
    `Phone` varchar(15) NOT NULL,
    `Email` varchar(100) NOT NULL,
    `Course` int(11) NOT NULL DEFAULT '0',
    `LevelIndex` int(11) NOT NULL DEFAULT '0',
    `Note` varchar(5000) NOT NULL,
    `AddedBy` varchar(50) NOT NULL,
    `AddedOn` date NOT NULL,
    `Password` varchar(100) NOT NULL,
    `Role` varchar(200) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblsubbooks` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `BookId` int(11) NOT NULL,
    `Available` int(11) NOT NULL DEFAULT '1',
    `ParentBookID` int(11) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '1',
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblyears` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `YearName` varchar(250) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $sql_raw .= "CREATE TABLE `tblslides` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Img_Attach_Id` varchar(500) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '1',
    `CDate` datetime NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    /* Adding some demo data to begin with */
    $sql_raw .= "INSERT INTO `wp_options` (`option_name`, `option_value`, `autoload`) VALUES
    ('people_to_approve', '30', 'yes'),
    ('inst_name', 'Demo University', 'yes'),
    ('inst_cont_name', 'John Dsouza', 'yes'),
    ('inst_email', 'andprogrammer007@gmail.com', 'yes'),
    ('inst_website', 'http://mu.ac.in', 'yes'),
    ('inst_phone', '022-6500706', 'yes'),
    ('inst_fax', '12457890', 'yes'),
    ('inst_address', 'Registrar University of Mumbai M.G. Road Fort Mumbai-400032', 'yes'),
    ('inst_zip', '100540', 'yes'),
    ('inst_city', 'Mumbai', 'yes'),
    ('inst_gmap', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30166.656054254217!2d72.8384864!3d19.0711224!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8e35b9b563b%3A0x840ba7d97d4c0bd6!2sMumbai+University+(MU)!5e0!3m2!1sen!2sin!4v1518682510294', 'yes'),
    ('inst_state', 'Maharashtra', 'yes'),
    ('inst_frnt_desc', 'Library Management System is carefully developed for easy management of any type of library. It’s actually a virtual version of a real library. It?s a web based system where you can manage books of different categories, manage users & manage issue/return of books easily.Issuing a book to a member is just a matter of a click.LMS will be an efficient and intelligent companion for managing your library.', 'yes'),
    ('inst_meta_desc', 'Library Management Software LMS which is a project that is build on Angular Js & PHP using wordpress basic functions.Grab the offer now @ $10 & Download the source code.This project can be used as college project as well as can be put to live use.One click install for newbie users.', 'yes'),
    ('inst_meta_title', 'Library Management Software Download MCA|BCA|BSCIT|BE|COMPUTERS|BTECH Documentations', 'yes');";
    $sql_raw .= "INSERT INTO `tblcourses` (`Id`, `CourseName`) VALUES	
    (1, 'B-Com'),
    (2, 'MCA'),
    (3, 'BE-IT'),		
    (4, 'BA');";
    $sql_raw .= "INSERT INTO `tblyears` (`Id`, `YearName`) VALUES
    (1, '1st Year'),
    (2, '2nd Year'),
    (3, '3rd Year'),
    (4, '4th Year'),
    (5, '5th Year');";
    add_option("custom_states", "Andaman and Nicobar Islands,Andhra Pradesh,Assam,Bihar,Chandigarh,Dadra and Nagar Haveli,Jammu and Kashmir,Nagaland,Pondicherry");
    add_option('nos_of_book_to_show', '20');
    add_option('nos_of_menu_to_show', '5');
    add_option('quick_notice', '');
    add_option('custom_theme_color', '#009688');
    add_option('local_currency', 'Rs.');
    add_option('limit_issue_book', '2');
    add_option('limit_issue_book_teachers', '5');
    add_option("hide_wordpress_dashboard", 'no');
    add_option("default_password", '123456');
    add_option("width_custom_pages", '80%');
    add_option("fine_rate", '0');
    add_option("payment_page_notice", 'Need to submit this book within a day or two after the payment is done.');
    add_option("payment_currency_code", 'INR');
    add_option("access_code", '0');
    add_option("merchant_code", '0');
    add_option("working_key", '0');
    add_option("do_online_payment", 'false');
    add_option("email_sending_process", 'false');
    add_option("front_page_s1", 'Our Library Books');
    add_option("waiting_approval_msg", "You have not submitted the book.After the submission the admin will approved the payment.Make sure to submit within 2 days.");
    add_option("email_tmp_returned_book", 'Hii , {username} <br/>Book Name : {bookname} <br/>Book Id : {bookid} <br/>Has been returned to us successfully.<br/>Thank You');
    add_option("email_tmp_issued_book", 'Hii , {username} <br/>Book Name : {bookname} <br/>Book Id : {bookid} <br/>Has been issued to you successfully.<br/>Thank You');
    add_option("logo_css", "width: 53px;float: left;margin-left: 5px;margin-top: 3px;");
    add_option("custom_sms_template", "Book Issued {Java Web Development Illuminated} to you needs to be return to the library.");
    add_option("inst_in_cards", 'The holder of this card is register person of Demo University.,By this registeration the holder agreeds to abide by the Rules and Regulation of the Institute.,The Card is for personal use and it is not transfareble., Finder of the lost card are asked to return them to the Program office at the above address.,Only 2 books can be borrowed on this card.,Rs 10 will be be charged if this card is lost.,Book will be issued only on presense of this card.');
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_raw);
}

add_action("after_switch_theme", "add_pages_to_library");
function add_pages_to_library()
{
    $new_pages = array("Manage Return Archives User" => "managereturnarchiveuser.php", "Dashboard" => "dashboard.php", "Manage Online Dues" => "listofduepaid.php", "Payment Response Handler" => "ccavenue/ccavResponseHandler.php", "Preview Due" => "ccavenue/previewDue.php", "About Software" => "about.php", "Add Book" => "addbook.php", "Add User" => "adduser.php", "Change Password" => "changepassword.php", "Forgot Password" => "forgotpassword.php", "Issue Books" => "issuebook.php", "List Book For User" => "booklistforuser.php", "Manage Books" => "managebooks.php", "Manage Categories" => "managecategories.php", "Manage Course" => "managecourses.php", "Manage Institution" => "institution.php", "Manage Issued Book For Users" => "bookissuedforusers.php", "Manage Return Archive" => "managereturnarchive.php", "Manage Users" => "manageusers.php", "Manage Years" => "manageyears.php", "Other Settings" => "othersettings.php", "Request Book" => "requestbook.php", "Users Profile Page" => "userprofile.php", "View Request Book Data" => "viewrequestbook.php", "Update Profile" => "updateprofile.php", "Manage Issued Books" => "manageissuedbooks.php", "Manage Fines" => "managefines.php", "Login" => "login.php", "Manage Slides" => "manageslides.php", "Update Control" => "updatecontrol.php", "Report Bugs" => "report_bug.php", "Add Page" => "addpage.php", "Manage Pages" => "managepage.php", "Function Handler" => "get_handler.php");
    foreach ($new_pages as $key => $value) {
        $pg_title = $key;
        $pg_template = $value;
        $page_check = get_page_by_title($pg_title);
        $page_check_id = null;
        if (is_object($page_check)) {
            $page_check_id = $page_check->ID;
        }
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $pg_title,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if (!isset($page_check_id)) {
            wp_insert_post($new_page);
            $new_page_data = get_page_by_title($pg_title);
            $new_page_id = $new_page_data->ID;
            update_post_meta($new_page_id, '_wp_page_template', $pg_template);
        }
    }
}

add_action("after_switch_theme", "basic_setups_for_Library");
function basic_setups_for_Library()
{
    global $current_user;
    update_user_meta($current_user->ID, 'lib_fname', "John");
    update_user_meta($current_user->ID, 'lib_lname', "Dsouza");
    update_option('number_of_rows', "25");
    update_option('people_to_approve', "30");
}

// [ Just A Wordpress CleanUp Code ]
add_filter('show_admin_bar', 'hide_admin_bar_from_front_end');
function hide_admin_bar_from_front_end()
{
    return false;
}

// [ Just A Wordpress CleanUp Code ]
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter('body_class', 'my_plugin_body_class');
function my_plugin_body_class($classes)
{
    $classes[] = 'hold-transition skin-blue sidebar-mini';
    return $classes;
}

//[ Uncomment this code if you don't want WordPress dashboard]
add_action('admin_menu', 'disable_dashboard');
function disable_dashboard()
{
    if (is_admin() && get_option("hide_wordpress_dashboard") == "yes") {
        wp_redirect(get_url('dashboard'));
    }
}

// [ Removing Custom Css that is added by Wordpress in Script Head ]
add_action('wp_enqueue_scripts', 'my_deregister_styles', 100);
function my_deregister_styles()
{
    wp_deregister_style('dashicons');
    wp_deregister_style('admin-bar-css');
    wp_deregister_style('tabulate-timepicker-css');
    wp_deregister_style('tabulate-leaflet-css');
    wp_deregister_style('tabulate-jquery-ui-css');
    wp_deregister_style('tabulate-jquery-ui-theme-css');
    wp_deregister_style('tabulate-styles-css');
}

// [ Just A Function For Generating Random Strings ]
function generateRandomString($length = 10)
{
    $returnString = mt_rand(1, 9);
    while (strlen($returnString) < $length) {
        $returnString .= mt_rand(0, 9);
    }
    return $returnString;
}

add_action('after_setup_theme', 'theme_functions');
function theme_functions()
{
    add_theme_support('title-tag');
}

function set_up_states($name, $id)
{
    ?>
  <select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="form-control selectpicker fix_radius">
    <option value="">------------Select State------------</option>
      <?php
      $state_raw = get_option("custom_states");
      $state_raw = explode(",", $state_raw);
      foreach ($state_raw as $val) {
          echo "<option value='$val'>$val</option>";
      }
      ?>
  </select>


    <?php
}

?>