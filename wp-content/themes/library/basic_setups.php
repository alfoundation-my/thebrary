<?php
//Add Language Support
load_theme_textdomain('library-management-system', get_template_directory_uri() . '/languages');
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 170, true);
// [ Loading Some Of The Required Plugin ]
add_action('wp_enqueue_scripts', 'library_handler');
function library_handler()
{
    $slug = basename(get_permalink());
    if ($slug != "hello-world" and $slug != "") {
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
        //Localization
        wp_localize_script('e-custom', 'lang_msg',
            array(
                'lg1' => __("Book title seems to be invalid.", 'library-management-system'),
                'lg2' => __("Book title must't consist of more than 150 characters.", 'library-management-system'),
                'lg3' => __("Price is required.", 'library-management-system'),
                'lg4' => __("Password required.", 'library-management-system'),
                'lg5' => __("Your password must consist at least 8 characters", 'library-management-system'),
                'lg6' => __("Your password must consist no more than 15 characters", 'library-management-system'),
                'lg7' => __("Password don't match!", 'library-management-system'),
                'lg8' => __("Isbn is required.", 'library-management-system'),
                'lg9' => __("Isbn should be of min 5 characters.", 'library-management-system'),
                'lg10' => __("Isbn must consist of no more than 20 characters.", 'library-management-system'),
                'lg11' => __("Book title is required.", 'library-management-system'),
                'lg12' => __("Are your sure to approve the request?", 'library-management-system'),
                'lg13' => __("Are your sure to dissapprove the request?", 'library-management-system'),
                'lg14' => __("Book category is required.", 'library-management-system'),
                'lg15' => __("Book consist must't consist of more than 50 characters.", 'library-management-system'),
                'lg16' => __("Are your sure to delete this request?", 'library-management-system'),
                'lg17' => __("Minimum 1 Qty is required.", 'library-management-system'),
                'lg18' => __("Invalid data found.", 'library-management-system'),
                'lg19' => __("First name is required.", 'library-management-system'),
                'lg20' => __("First name seems to be invalid.", 'library-management-system'),
                'lg21' => __("No file selected.Kindly select an Image file to upload", 'library-management-system'),
                'lg22' => __("Are your sure to approve this due?", 'library-management-system'),
                'lg23' => __("Last name is required.", 'library-management-system'),
                'lg24' => __("Last name seems to be invalid.", 'library-management-system'),
                'lg25' => __("Note :This action is isreversible.", 'library-management-system'),
                'lg26' => __("Now you can update by just a single click.", 'library-management-system'),
                'lg27' => __("Email is invalid.", 'library-management-system'),
                'lg28' => __("Email Id is required.", 'library-management-system'),
                'lg29' => __("Phone number is required.", 'library-management-system'),
                'lg30' => __("Phone number seems to be invalid.", 'library-management-system'),
                'lg31' => __("Address is required.", 'library-management-system'),
                'lg32' => __("Address seems to be invalid.", 'library-management-system'),
                'lg33' => __("Note: All the files which are updated is backuped in 'bck' folder.", 'library-management-system'),
                'lg34' => __("City name is required.", 'library-management-system'),
                'lg35' => __("Zip code seems to be invalid.", 'library-management-system'),
                'lg36' => __("State is required.", 'library-management-system'),
                'lg37' => __("Zip code is required.", 'library-management-system'),
                'lg38' => __("Instituion name seems to be invalid.", 'library-management-system'),
                'lg39' => __("START", 'library-management-system'),
                'lg40' => __("Name is required.", 'library-management-system'),
                'lg41' => __("Name seems to be invalid.", 'library-management-system'),
                'lg42' => __("All files are updated.", 'library-management-system'),
                'lg43' => __("files found to be updated.", 'library-management-system'),
                'lg44' => __("Preparing file for update...", 'library-management-system'),
                'lg45' => __("Backing up code in bck/ folder...", 'library-management-system'),
                'lg46' => __("Edit mode set.Now upload the image.", 'library-management-system'),
                'lg47' => __("Library Popular Book Data", 'library-management-system'),
                'lg48' => __("Are your sure to submit the request?", 'library-management-system'),
                'lg49' => __("Book Issued", 'library-management-system'),
                'lg50' => __("to you needs to be return to the library.", 'library-management-system'),
                'lg51' => __("Please wait....", 'library-management-system'),
                'lg52' => __("Book has already been Issued.", 'library-management-system'),
                'lg53' => __("Book has been issued so get it returned before disabling it.", 'library-management-system'),
                'lg54' => __("Url seems to be invalid.", 'library-management-system'),
                'lg55' => __("Url is requried.", 'library-management-system'),
                'lg56' => __("Content is requried.", 'library-management-system'),
                'lg57' => __("Book ID is required.", 'library-management-system'),
                'lg58' => __("Book ID seems to be invalid.", 'library-management-system'),
                'lg59' => __("User ID is required.", 'library-management-system'),
                'lg60' => __("User ID seems to be invalid.", 'library-management-system'),
                'lg61' => __("Date of issue is required.", 'library-management-system'),
                'lg62' => __("Date of return is required.", 'library-management-system'),
                'lg63' => __("Book Name is required.", 'library-management-system'),
                'lg64' => __("Book Name seems to be invalid.Min 10 characters.", 'library-management-system'),
                'lg65' => __("Note is required.", 'library-management-system'),
                'lg66' => __("Notes needs to be more than 50 characters.", 'library-management-system'),
                'lg67' => __(" Entries In Total", 'library-management-system'),
                'lg68' => __('Are you sure?', 'library-management-system'),
                'lg69' => __("Are your sure about to delete this book?", 'library-management-system'),
                'lg70' => __("User has been deactivated!.", 'library-management-system'),
                'lg71' => __("Content data is missing.", 'library-management-system'),
                'lg72' => __("We couldn't find the book you are looking for, so fill it manually ..", 'library-management-system'),
                'lg73' => __("Course name is required.", 'library-management-system'),
                'lg74' => __("Course Year is required.", 'library-management-system'),
                'lg75' => __("We are serching for the book details. Plz Wait..", 'library-management-system'),
                'lg76' => __("Add book to this ISBN?", 'library-management-system'),
                'lg77' => __("User has been deleted!.", 'library-management-system'),
                'lg78' => __("User has been approved!.", 'library-management-system'),
                'lg79' => __("Are your sure to approve this user?", 'library-management-system'),
                'lg80' => __("Password updated successfully", 'library-management-system'),
                'lg81' => __("No file selected.Kindly select an Csv file to upload", 'library-management-system')
//                'lg82' => __("", 'library-management-system'),
//                'lg83' => __("", 'library-management-system'),
//                'lg84' => __("", 'library-management-system'),
//                'lg85' => __("", 'library-management-system'),
//                'lg86' => __("", 'library-management-system'),
//                'lg87' => __("", 'library-management-system'),
//                'lg88' => __("", 'library-management-system'),
//                'lg89' => __("", 'library-management-system'),
//                'lg90' => __("", 'library-management-system'),
//                'lg91' => __("", 'library-management-system'),
//                'lg92' => __("", 'library-management-system'),
//                'lg93' => __("", 'library-management-system'),
//                'lg94' => __("", 'library-management-system'),
//                'lg95' => __("", 'library-management-system'),
//                'lg96' => __("", 'library-management-system'),
//                'lg97' => __("", 'library-management-system'),
//                'lg98' => __("", 'library-management-system'),
//                'lg99' => __("", 'library-management-system'),
//                'lg100' => __("", 'library-management-system')
            ));
        wp_enqueue_style('mainstyle', get_stylesheet_uri());
    }
    if ($slug == "login") {
        wp_dequeue_style("skin");
    }
}

add_action('switch_theme', 'deactivated_theme');
function deactivated_theme()
{
    //echo "Fuck off";
    //die();
    delete_option("custom_states");
    delete_option("nos_of_book_to_show");
    delete_option("nos_of_menu_to_show");
    delete_option("quick_notice");
    delete_option("custom_theme_color");
    delete_option("local_currency");
    delete_option("limit_issue_book");
    delete_option("limit_issue_book_teachers");
    delete_option("hide_wordpress_dashboard");
    delete_option("default_password");
    delete_option("width_custom_pages");
    delete_option("fine_rate");
    delete_option("payment_page_notice");
    delete_option("payment_currency_code");
    delete_option("client_id");
    delete_option("client_secret");
    delete_option("sandbox");
    delete_option("do_online_payment");
    delete_option("email_sending_process");
    delete_option("front_page_s1");
    delete_option("enable_scroll_on_top");
    delete_option("waiting_approval_msg");
    delete_option("email_tmp_returned_book");
    delete_option("email_tmp_issued_book");
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
    $tables_lst = array("tblbooks", "tblborrowed", "tblpayments", "tblcourses", "tblrequests", "tblstudents", "tblsubbooks", "tblyears", "tblusers", "tblslides");
    foreach ($tables_lst as $table) {
        $sql = "DROP TABLE IF EXISTS " . $table . ";";
        $wpdb->query($sql);
    }
    foreach ($wpdb->query("select * from wp_posts where post_excerpt='theme_library'") as $obj) {
        delete_post_meta($obj->ID, "_wp_page_template");
    }
    $wpdb->query("delete from wp_posts where post_excerpt='theme_library'");
}

// [ Function Will Run Only Once And Create All The Necessary Tables Required ]
add_action('after_switch_theme', 'create_table_for_LMS');
function create_table_for_LMS()
{
    global $wpdb;
    #require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblbooks` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Book_Goo_ID` varchar(191) NOT NULL,
    `ISBN` varchar(30) NOT NULL,
    `BookTitle` varchar(191) DEFAULT NULL,
    `BookDesc` varchar(191) DEFAULT NULL,
    `Category` varchar(191) DEFAULT NULL,
    `Author` varchar(50) DEFAULT NULL,
    `BookPublisher` varchar(191) DEFAULT NULL,
    `BookUrl` varchar(191) DEFAULT NULL,
    `MainCoverId` varchar(10) DEFAULT NULL,
    `MainCoverUrl` varchar(191) DEFAULT NULL,
    `ExternalUrl` varchar(191) NULL,
    `Price` int(11) NOT NULL DEFAULT '1',
    `Qty` int(11) NOT NULL DEFAULT '1',
    `Borrowed` int(11) NOT NULL DEFAULT '0',
    `AddedOn` date NOT NULL,
    `AddedBy` varchar(10) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblborrowed` (
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
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblpayments` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,    
    `InvoiceNo` varchar(20) DEFAULT NULL,
    `Currency` varchar(20) DEFAULT NULL,    
    `PayerId` varchar(20) DEFAULT NULL,
    `PayerEmail` varchar(20) DEFAULT NULL,
    `RefundUrl` varchar(191) DEFAULT NULL,
    `PayerPhone` varchar(20) DEFAULT NULL,
    `PayerName` varchar(30) DEFAULT NULL,
    `PaymentId` varchar(30) DEFAULT NULL,
    `PerDayFine` decimal(7,0) NOT NULL,
    `PayedAmount` decimal(7,0) NOT NULL,
    `PaymentStatus` varchar(25) NOT NULL,
    `ApprovedStatus` varchar(25) NOT NULL DEFAULT 'NotApproved',
    `BookId` int(11) NOT NULL,
    `UserId` int(11) NOT NULL,
    `DateDue` date NOT NULL,
    `IssuedDate` date NOT NULL,
    `PayedForDays` int(11) NOT NULL,
    `PaymentMode` varchar(60) NOT NULL,
    `PayedForEntry` int(11) NOT NULL,
    `CreatedTime` datetime NOT NULL,
     PRIMARY KEY (`Id`),
     UNIQUE KEY `InvoiceNo` (`InvoiceNo`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblrequests` (
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
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblcourses` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `CourseName` varchar(191) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblusers` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `UserId` int(11) NOT NULL,
    `UserPic` int(11) NOT NULL DEFAULT '0',
    `FirstName` varchar(191) NOT NULL,
    `LastName` varchar(191) NOT NULL,
    `Address` varchar(191) NOT NULL,
    `Zip` varchar(10) NOT NULL,
    `State` varchar(191) NOT NULL,
    `City` varchar(191) NOT NULL,
    `Phone` varchar(15) NOT NULL,
    `Email` varchar(100) NOT NULL,
    `Course` int(11) NOT NULL DEFAULT '0',
    `LevelIndex` int(11) NOT NULL DEFAULT '0',
    `Note` varchar(191) NOT NULL,
    `AddedBy` varchar(50) NOT NULL,
    `AddedOn` date NOT NULL,
    `Password` varchar(191) NOT NULL,
    `Role` varchar(191) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblsubbooks` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `BookId` int(11) NOT NULL,
    `Available` int(11) NOT NULL DEFAULT '1',
    `ParentBookID` int(11) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '1',
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblyears` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `YearName` varchar(25) NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    $sql_raw = "CREATE TABLE IF NOT EXISTS `tblslides` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Img_Attach_Id` varchar(191) NOT NULL,
    `Active` int(11) NOT NULL DEFAULT '1',
    `CDate` datetime NOT NULL,
    PRIMARY KEY (`Id`)
    );";
    $wpdb->query($sql_raw);
    /* Adding some demo data to begin with */
    $sql_raw = "INSERT IGNORE INTO `wp_options` (`option_name`, `option_value`, `autoload`) VALUES
    ('people_to_approve', '30', 'yes'),
    ('inst_name', 'Demo University', 'yes'),
    ('inst_cont_name', 'John Dsouza', 'yes'),
    ('inst_email', 'lms_dev@outlook.com', 'yes'),
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
    $wpdb->query($sql_raw);
    $sql_raw = "INSERT IGNORE INTO `tblcourses` (`Id`, `CourseName`) VALUES
    (1, 'B-Com'),
    (2, 'MCA'),
    (3, 'BE-IT'),
    (4, 'BA');";
    $wpdb->query($sql_raw);
    $sql_raw = "INSERT IGNORE INTO `tblyears` (`Id`, `YearName`) VALUES
    (1, '1st Year'),
    (2, '2nd Year'),
    (3, '3rd Year'),
    (4, '4th Year'),
    (5, '5th Year');";
    $wpdb->query($sql_raw);
    //echo $sql_raw;
    //die();
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
    add_option("width_custom_pages", '100%');
    add_option("fine_rate", '1');
    add_option("payment_page_notice", 'Need to submit this book within a day or two after the payment is done.');
    add_option("payment_currency_code", 'USD');
    add_option("client_id", 'AVkb30RB_VzGD3hDzc6-8pr01KbZWRNQgnxZcaPyW933mMNJ7f0lczvJEwN6Q6UDmCzLKhcKNx_eXhzN');
    add_option("client_secret", 'EG15zmnIckrkTjnplb-EmONldoM2TwpGbSK13eyeDOUXt3S-4yOZFGBxJkj1y6ML7XW3uUVAzo6a_B1Q');
    add_option("sandbox", 'true');
    add_option("do_online_payment", 'true');
    add_option("email_sending_process", 'false');
    add_option("front_page_s1", 'Our Library Books');
    add_option("enable_scroll_on_top", 'true');
    add_option("waiting_approval_msg", "You have not submitted the book.After the submission the admin will approved the payment.Make sure to submit within 2 days.");
    add_option("email_tmp_returned_book", 'Hii , {username} <br/>Book Name : {bookname} <br/>Book Id : {bookid} <br/>Has been returned to us successfully.<br/>Thank You');
    add_option("email_tmp_issued_book", 'Hii , {username} <br/>Book Name : {bookname} <br/>Book Id : {bookid} <br/>Has been issued to you successfully.<br/>Thank You');
    add_option("logo_css", "width: 53px;float: left;margin-left: 5px;margin-top: 3px;");
    add_option("custom_sms_template", "Book Issued {Java Web Development Illuminated} to you needs to be return to the library.");
    add_option("inst_in_cards", 'The holder of this card is register person of Demo University.,By this registeration the holder agreeds to abide by the Rules and Regulation of the Institute.,The Card is for personal use and it is not transfareble., Finder of the lost card are asked to return them to the Program office at the above address.,Only 2 books can be borrowed on this card.,Rs 10 will be be charged if this card is lost.,Book will be issued only on presense of this card.');
    //$wpdb->query($sql_raw);
    add_pages_to_library();
    basic_setups_for_Library();
}

function add_pages_to_library()
{
    $new_pages = array("Manage Return Archives User" => "managereturnarchiveuser.php", "Dashboard" => "dashboard.php", "Manage Online Dues" => "listofduepaid.php", "Payment Handler" => "paypal/payment.php", "Receipt" => "paypal/receipt.php", "About Software" => "about.php", "Add Book" => "addbook.php", "Add User" => "adduser.php", "Change Password" => "changepassword.php", "Forgot Password" => "forgotpassword.php", "Issue Books" => "issuebook.php", "List Book For User" => "booklistforuser.php", "Manage Books" => "managebooks.php", "Manage Categories" => "managecategories.php", "Manage Course" => "managecourses.php", "Manage Institution" => "institution.php", "Manage Issued Book For Users" => "bookissuedforusers.php", "Manage Return Archive" => "managereturnarchive.php", "Manage Users" => "manageusers.php", "Manage Years" => "manageyears.php", "Other Settings" => "othersettings.php", "Request Book" => "requestbook.php", "Users Profile Page" => "userprofile.php", "View Request Book Data" => "viewrequestbook.php", "Update Profile" => "updateprofile.php", "Manage Issued Books" => "manageissuedbooks.php", "Manage Fines" => "managefines.php", "Login" => "login.php", "Manage Slides" => "manageslides.php", "Update Control" => "updatecontrol.php", "Report Bugs" => "report_bug.php", "Add Page" => "addpage.php", "Manage Pages" => "managepage.php", "Function Handler" => "get_handler.php", "Bulk Manager" => "get_handler.php", "Clear Theme Data" => "cleartheme.php", "Backup Theme Data" => "backup_tables.php", "Export Books" => "export_books.php", "Import Books" => "import_books.php");
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
            'post_excerpt' => 'theme_library',
        );
        if (!isset($page_check_id)) {
            wp_insert_post($new_page);
            $new_page_data = get_page_by_title($pg_title);
            $new_page_id = $new_page_data->ID;
            update_post_meta($new_page_id, '_wp_page_template', $pg_template);
        }
    }
}

function basic_setups_for_Library()
{
    global $current_user;
    update_user_meta($current_user->ID, 'lib_fname', "John");
    update_user_meta($current_user->ID, 'lib_lname', "Dsouza");
    update_option('number_of_rows', "25");
    update_option('people_to_approve', "30");
    // Setting up post type permalink
    if (is_admin()) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
    }
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

//[ This code basically is used to toggle restriction to WordPress dashboard]
if (get_option("hide_wordpress_dashboard") == "true") {
    add_action('admin_menu', 'disable_dashboards');
    function disable_dashboards()
    {
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
        <option value=""> <?php _e('------------Select State------------', 'library-management-system'); ?></option>

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

function check_about_php_version()
{
    if (version_compare(PHP_VERSION, '7.0.30') >= 0) { ?>
        <div style="padding: 13px;background-color: #00a65a;color: white;">
            <span>
                <?php _e('Tested And Best Supported On PHP version  <=7.0.30', 'library-management-system'); ?>
            </span>
        </div>
    <?php } else { ?>
        <div style="padding: 13px;background-color: #9df79b;">
            <?php _e("You are running PHP version " . PHP_VERSION, 'library-management-system'); ?>
        </div>
    <?php }
}

function security_function($complete_dir)
{
    $file_name = $complete_dir . ".htaccess";
    if (file_exists($file_name)) {
        unlink($file_name);
        if (!file_exists($file_name)) {
            $file_handle = fopen($file_name, 'a') or die("From Safety Function");
            $content_string = '<FilesMatch "\.(php|php1|php2|php3|php4|php5|php6|php7|php8|phtml|cgi|asp)$">' . PHP_EOL;
            fwrite($file_handle, $content_string);
            $content_string = "deny from all" . PHP_EOL;
            fwrite($file_handle, $content_string);
            $content_string = "</FilesMatch>" . PHP_EOL;
            fwrite($file_handle, $content_string);
            fclose($file_handle);
        }
    }
}

?>
