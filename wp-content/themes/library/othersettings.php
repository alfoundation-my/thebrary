<?php
/* Template Name: OtherSettings Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?php
global $current_user;
$userID = $current_user->ID;
$user_login = $current_user->user_login;
$limit_issue_book_teachers = get_option('limit_issue_book_teachers');
$message_api_key = get_option('message_api_key');
$people_to_approve = get_option('people_to_approve');
$states_custom = get_option('custom_states');
$custom_css_front_page = get_option('custom_css_front_page');
$custom_theme_color = get_option('custom_theme_color');
$nos_of_book_to_show = get_option('nos_of_book_to_show');
$nos_of_menu_to_show = get_option('nos_of_menu_to_show');
$quick_notice = get_option('quick_notice');
$local_currency = get_option('local_currency');
$limit_issue_book = get_option("limit_issue_book");
$hide_wordpress_dashboard = get_option("hide_wordpress_dashboard");
$default_password = get_option("default_password");
$inst_in_cards = get_option("inst_in_cards");
$logo_css = get_option("logo_css");
$width_custom_pages = get_option("width_custom_pages");
$payment_page_notice = get_option("payment_page_notice");
$fine_rate = get_option("fine_rate");
$client_id = get_option("client_id");
$client_secret = get_option("client_secret");
$sandbox = get_option("sandbox");
$payment_currency_code = get_option("payment_currency_code");
$email_tmp_issued_book = get_option("email_tmp_issued_book");
$email_tmp_returned_book = get_option("email_tmp_returned_book");
$do_online_payment = get_option("do_online_payment");
$email_sending_process = get_option("email_sending_process");
$waiting_approval_msg = get_option("waiting_approval_msg");
$front_page_s1 = get_option("front_page_s1");
$enable_scroll_on_top = get_option("enable_scroll_on_top");
?>
<?php
get_sidebar();
?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?php _e('Dashboard', 'library-management-system'); ?>
            <small><?php _e('Control panel', 'library-management-system'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a></li>
            <li class="active"><?php _e('Other Settings', 'library-management-system'); ?></li>
        </ol>
    </section>


    <section class="content" style="min-height: 100%;">
        <div class="">
            <div class="box-header with-border">

            </div>

            <div class="box-body" style="">
                <div class="row">

                    <div class="col-md-12" ng-controller="otherSettingsCtrl">
                        <div class="tab-content shadow">
                            <div class="tab-pane active">
                                <div class=" panel panel-custom">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <strong><?php _e('Update Details', 'library-management-system'); ?></strong>
                                        </div>
                                    </div>
                                    <div class="panel-body form-horizontal">
                                        <form class="form-horizontal" id="lib_manage_other_seting">


                                            <input type="hidden" name="action" value="other_settings">


                                            <div class="tab">
                                                <button class="tablinks" onclick="openCity(event, 'msg')"
                                                        id="defaultOpen">Api Settings
                                                </button>
                                                <button class="tablinks" onclick="openCity(event, 'theme')">
                                                    Functionality Settings
                                                </button>
                                                <button class="tablinks" onclick="openCity(event, 'wsettings')">
                                                    Wordpress Settings
                                                </button>
                                                <button class="tablinks" onclick="openCity(event, 'stylesettings')">
                                                    Styles Settings
                                                </button>
                                                <button class="tablinks" onclick="openCity(event, 'noticessettings')">
                                                    Notice Settings
                                                </button>
                                            </div>

                                            <div id="msg" class="tabcontent">
                                                <div class="form-group mb0 col-sm-12">
                                                    <label><?php _e('[MSG91.com]Message Api Key', 'library-management-system'); ?></label>
                                                    <input name="message_api_key" id="message_api_key"
                                                           placeholder="<?php _e('Message Api key [https://msg91.com/]', 'library-management-system'); ?>"
                                                           class="form-control"
                                                           value="<?php echo $message_api_key; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('PayPal Client ID', 'library-management-system'); ?>
                                                    </label>
                                                    <input tooltips
                                                           tooltip-template="<?php _e('Can be found in https://developer.paypal.com', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" name="client_id" id="client_id"
                                                           class="form-control"
                                                           value="<?php echo $client_id; ?>" type="text">

                                                </div>

                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('PayPal Secret', 'library-management-system'); ?>
                                                    </label>
                                                    <input tooltips
                                                           tooltip-template="<?php _e('Can be found in https://developer.paypal.com', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" name="client_secret" id="client_secret"
                                                           class="form-control"
                                                           value="<?php echo $client_secret; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('Currency', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="payment_currency_code" id="payment_currency_code"
                                                           class="form-control"
                                                           value="<?php echo $payment_currency_code; ?>"
                                                           placeholder="INR | USD | SGD | GBP | EUR" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('Sandbox', 'library-management-system'); ?>
                                                    </label>
                                                    <input tooltips
                                                           tooltip-template="<?php _e('If you set it to on all payment will be done using test environment.', 'library-management-system'); ?>"
                                                           tooltip-side="left" class="check_handler"
                                                           type="checkbox" <?php echo ($sandbox == "true") ? "checked" : ""; ?>
                                                           data-toggle="toggle">
                                                    <input name="sandbox" id="sandbox"
                                                           value="<?php echo $sandbox; ?>" type="hidden">


                                                </div>
                                            </div>

                                            <div id="theme" class="tabcontent">
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('[ NewBook ]People To Approve', 'library-management-system'); ?></label>

                                                    <input name="people_to_approve" id="people_to_approve"
                                                           placeholder="25"
                                                           class="form-control"
                                                           value="<?php echo $people_to_approve; ?>"
                                                           type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e('Enable Scroll On Top', 'library-management-system'); ?>
                                                    </label>


                                                    <input tooltips
                                                           tooltip-template="<?php _e('If you set it on then scroll to top button will be visible on homepage.', 'library-management-system'); ?>"
                                                           tooltip-side="left" class="check_handler"
                                                           type="checkbox" <?php echo ($enable_scroll_on_top == "true") ? "checked" : ""; ?>
                                                           data-toggle="toggle">

                                                    <input name="enable_scroll_on_top" id="enable_scroll_on_top"
                                                           value="<?php echo $enable_scroll_on_top; ?>"
                                                           type="hidden">


                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label><?php _e('Instructions for users id card {seperate by comma}', 'library-management-system'); ?></label>

                                                    <textarea name="inst_in_cards" id="inst_in_cards"
                                                              placeholder="<?php _e('Enter the instruction seperated by commas.Only 7 instruction are supported.', 'library-management-system'); ?>"
                                                              class="form-control"
                                                              rows="5"><?php echo $inst_in_cards; ?></textarea>

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e(' Waiting Approval Msg', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="waiting_approval_msg" id="waiting_approval_msg"
                                                           class="form-control"
                                                           value="<?php echo $waiting_approval_msg; ?>" type="text"
                                                           placeholder=""
                                                           tooltips
                                                           tooltip-template="<?php _e('This will be a help notification which the users sees when he completes the payment.Here you could mention any instructions that he needs to follow after the payment process.', 'library-management-system'); ?>"
                                                           tooltip-side="bottom">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('Front Page Statement', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="front_page_s1" id="front_page_s1" class="form-control"
                                                           value="<?php echo $front_page_s1; ?>" type="text"
                                                           placeholder="Our Library Books"
                                                    >

                                                </div>
                                                <div class="form-group mb0 col-sm-6">

                                                    <label><?php _e('Add You States {Seperated By Comma}', 'library-management-system'); ?></label>

                                                    <textarea name="custom_states" id="custom_states"
                                                              placeholder="<?php _e('Paris,Washington', 'library-management-system'); ?>"
                                                              class="form-control"
                                                              rows="5"><?php echo $states_custom; ?></textarea>

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Nos of books to show', 'library-management-system'); ?></label>

                                                    <input name="nos_of_book_to_show" id="nos_of_book_to_show" tooltips
                                                           tooltip-template="<?php _e('Nos of books to show for each category in front page', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" placeholder="" class="form-control"
                                                           value="<?php echo $nos_of_book_to_show; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Limit Issue Books for students', 'library-management-system'); ?></label>

                                                    <input name="limit_issue_book" id="limit_issue_book" tooltips
                                                           tooltip-template="<?php _e('Limit the nos of books to issed for students.', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" placeholder="" class="form-control"
                                                           value="<?php echo $limit_issue_book; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Limit Issue Books for Teachers', 'library-management-system'); ?></label>
                                                    <input name="limit_issue_book_teachers"
                                                           id="limit_issue_book_teachers"
                                                           tooltips
                                                           tooltip-template="<?php _e('Limit the nos of books to issed for teachers. - For future versions', 'library-management-system'); ?>"
                                                           class="form-control"
                                                           value="<?php echo "5"; ?>" type="text" readonly>

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Currency', 'library-management-system'); ?></label>

                                                    <input name="local_currency" id="local_currency"
                                                           placeholder="<?php _e('Enter your local currency', 'library-management-system'); ?>"
                                                           class="form-control"
                                                           value="<?php echo $local_currency; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Nos of menu to show', 'library-management-system'); ?></label>

                                                    <input name="nos_of_menu_to_show" id="nos_of_menu_to_show" tooltips
                                                           tooltip-template="<?php _e('Nos of menu to show in the front page before wrapping.', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" placeholder="" class="form-control"
                                                           value="<?php echo $nos_of_menu_to_show; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e('Define Fine Rate', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="fine_rate" id="fine_rate" class="form-control"
                                                           value="<?php echo $fine_rate; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e('Enable Online Due Payment', 'library-management-system'); ?>
                                                    </label>
                                                    <input tooltips
                                                           tooltip-template="<?php _e('If you set it to on online due system will start working but make sure you enter your payment gateway details.', 'library-management-system'); ?>"
                                                           tooltip-side="left" class="check_handler"
                                                           type="checkbox" <?php echo ($do_online_payment == "true") ? "checked" : ""; ?>
                                                           data-toggle="toggle">
                                                    <input name="do_online_payment" id="do_online_payment"
                                                           value="<?php echo $do_online_payment; ?>" type="hidden">


                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e(' Enable Email Sending', 'library-management-system'); ?>
                                                    </label>
                                                    <input tooltips
                                                           tooltip-template="<?php _e('If you set it to on email will be send when you issue or return the book.', 'library-management-system'); ?>"
                                                           tooltip-side="left" class="check_handler"
                                                           type="checkbox" <?php echo ($email_sending_process == "true") ? "checked" : ""; ?>
                                                           data-toggle="toggle">

                                                    <input name="email_sending_process" id="email_sending_process"
                                                           value="<?php echo $email_sending_process; ?>" type="hidden">

                                                </div>
                                            </div>

                                            <div id="wsettings" class="tabcontent">
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Disable Wordpress DashBoard', 'library-management-system'); ?></label>

                                                    <input tooltips
                                                           tooltip-template="<?php _e('If you set it on the wp-admin dashboard will be disabled.', 'library-management-system'); ?>"
                                                           tooltip-side="left" class="check_handler"
                                                           type="checkbox" <?php echo ($hide_wordpress_dashboard == "true") ? "checked" : ""; ?>
                                                           data-toggle="toggle">

                                                    <input name="hide_wordpress_dashboard" id="hide_wordpress_dashboard"
                                                           value="<?php echo $hide_wordpress_dashboard; ?>"
                                                           type="hidden">


                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Set a fallback password', 'library-management-system'); ?></label>

                                                    <input name="default_password" id="default_password"
                                                           placeholder="123456" tooltips
                                                           tooltip-template="<?php _e('Set a default password.This password will be used if you are reseting the password.If nothing is set the default password would be \'123456\'', 'library-management-system'); ?>"
                                                           tooltip-side="bottom" placeholder="" class="form-control"
                                                           value="<?php echo $default_password; ?>" type="text">

                                                </div>

                                            </div>

                                            <div id="stylesettings" class="tabcontent">
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e('Theme Color', 'library-management-system'); ?>
                                                    </label>

                                                    <input name="custom_theme_color" id="custom_theme_color"
                                                           class="form-control"
                                                           value="<?php echo $custom_theme_color; ?>" type="color">

                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label>
                                                        <?php _e('Width For Custom Pages', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="width_custom_pages" id="width_custom_pages"
                                                           class="form-control"
                                                           value="<?php echo $width_custom_pages; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label><?php _e('Add Css Style Front Page', 'library-management-system'); ?></label>
                                                    <textarea name="custom_css_front_page" id="custom_css_front_page"
                                                              placeholder=""
                                                              class="form-control"
                                                              rows="5"><?php echo $custom_css_front_page; ?></textarea>

                                                </div>

                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('Logo Css', 'library-management-system'); ?>
                                                    </label>

                                                    <input name="logo_css" id="logo_css" class="form-control"
                                                           value="<?php echo $logo_css; ?>" type="text">

                                                </div>


                                            </div>

                                            <div id="noticessettings" class="tabcontent">
                                                <div class="form-group mb0 col-sm-12">
                                                    <label>
                                                        <?php _e('Payment Page Notice', 'library-management-system'); ?>
                                                    </label>
                                                    <input name="payment_page_notice" id="payment_page_notice"
                                                           class="form-control"
                                                           value="<?php echo $payment_page_notice; ?>" type="text">

                                                </div>
                                                <div class="form-group mb0 col-sm-12">
                                                    <label><?php _e('Add Main Notice', 'library-management-system'); ?></label>


                                                    <textarea name="quick_notice" id="quick_notice"
                                                              placeholder="<?php _e('Enter your notice to show in the front page.', 'library-management-system'); ?>"
                                                              class="form-control"
                                                              rows="5"><?php echo $quick_notice; ?></textarea>


                                                </div>
                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Email Template For Issued Books', 'library-management-system'); ?></label>

                                                    <textarea name="email_tmp_issued_book" id="email_tmp_issued_book"
                                                              placeholder="Hii , {username} &#10;Book Name : {bookname} &#10;Book Id : {bookid} &#10;Has been issued to you successfully.&#10;Thank You"
                                                              class="form-control"
                                                              rows="5"><?php echo $email_tmp_issued_book; ?></textarea>

                                                </div>


                                                <div class="form-group mb0 col-sm-6">
                                                    <label><?php _e('Email Template For Returned Books', 'library-management-system'); ?></label>

                                                    <textarea name="email_tmp_returned_book"
                                                              id="email_tmp_returned_book"
                                                              placeholder="Hii , {username} &#10;Book Name : {bookname} &#10;Book Id : {bookid} &#10;Has been returned to us successfully.&#10;Thank You"
                                                              class="form-control"
                                                              rows="5"><?php echo $email_tmp_returned_book; ?></textarea>

                                                </div>
                                            </div>


                                            <div class="form-group mb0 col-sm-12" style="padding-right: 0px;">


                                                <button ng-click="saveSettings()"
                                                        class="btn btn-primary fix_radius pull-right pmd-ripple-effect"><span
                                                            class="fa fa-floppy-o"></span>&nbsp;<?php _e('Save', 'library-management-system'); ?>
                                                </button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>


<?php
get_footer();
?>
<!-- Adding Javascript -->
<script type="text/javascript">
    jQuery(function () {
        jQuery('.check_handler').change(function () {
            debugger;
            if (jQuery(this).prop('checked')) {
                debugger;
                jQuery(this).parent().parent().parent().next().val("true");
                //jQuery('#sandbox').val("true");
            } else {
                jQuery(this).parent().parent().parent().next().val("false");
            }
        })
    })
</script>