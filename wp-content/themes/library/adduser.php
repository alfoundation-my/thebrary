<?php
/* Template Name: AddUser Page */
if (!is_user_logged_in()) {
wp_redirect(get_home_url());
}
get_header();
?>
<?php
get_sidebar();
?>
<div class="content-wrapper">
<style>
.ng-camera-overlay {
display: none;
}
</style>
<section class="content-header">
<h1>
<?php _e('Dashboard', 'library-management-system'); ?>
<small><?php _e('Control panel', 'library-management-system'); ?></small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a></li>
<li class="active"><?php _e('Add User', 'library-management-system'); ?></li>
</ol>
<div class="panel p_notice">
<b>Usage : </b> This page is used to create users login details.<br/>
<b>Note :</b> The webcam module on this page requires https to work if using via Chrome | Firefox users
don't
have a
problem.
</div>
</section>

<section class="content" ng-controller="userProfileAddCtrl">
<div class="row">
<div class="col-sm-3 addStudCamera">
<?php
/* checking if running online & is not https */
/* since google chrome has blocked camera modules for wesbites who don't use ssl on servers.*/
if (!check_if_running_local() and (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')) {
//if(true){?>
<img width="250px" height="250px"
src="<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>"/>
<form id="upload_user_img_form" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="save_img_get_id"/>
<input type="file" id="upload_img" accept="image/*" style="margin-top: 5%;" name="upload_img"
class="form-control">
</form>
<?php } else { ?>
<ng-camera
output-height="250"
output-width="250"
image-format="jpeg"
jpeg-quality="100"
action-message="Take Picture"
snapshot="vm.picture"
flash-fallback-url="<?php bloginfo('template_directory'); ?>/js/webcam.swf"
overlay-url="<?php bloginfo('template_directory'); ?>/img/overlay.png"
shutter-url="<?php bloginfo('template_directory'); ?>/js/shutter.mp3"
></ng-camera>
<img ng-if="vm.picture" ng-src="{{vm.picture}}"
alt="<?php _e('User Pic', 'library-management-system'); ?>" style="margin-top: 10%;"
class="img-responsive"
>
<?php } ?>
<style>
.ng-binding {
border: 1px solid #dd4b39;
background-color: #dd4b39;
color: white;
padding: 8px;
}
</style>
</div>
<div class="col-sm-9">
<div class="tab-content shadow userProfileAddCtrl" style="border: 0;padding:0;">
<div class="tab-pane active">
<div class="panel panel-custom">
<div class="panel-heading">
<div class="panel-title">
    <strong><?php _e('Add User', 'library-management-system'); ?></strong>
</div>
</div>
<form class="form-horizontal" id="lib_add_user_profile_form" method="post">
<div class="panel-body form-horizontal">
    <input type="hidden" name="action" value="addUserTodb">
    <input type="hidden" name="addingBy" value="admin">
    <input type="hidden" name="photo_code" id="photo_code">
    <div class="form-group mb0 col-sm-6">

        <label><?php _e('First Name', 'library-management-system'); ?></label>

        <input name="first_name" id="first_name"
               placeholder="<?php _e('First Name', 'library-management-system'); ?>"
               class="form-control fix_radius" type="text">


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('Last Name', 'library-management-system'); ?></label>

        <input name="last_name" id="last_name"
               placeholder="<?php _e('Last Name', 'library-management-system'); ?>"
               class="form-control fix_radius" type="text">


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('Email', 'library-management-system'); ?></label>

        <input name="email" id="email" tooltips
               tooltip-template="<?php _e('Make sure you put a proper email as this will be the username of this person & cannot be changed later.', 'library-management-system'); ?>"
               placeholder="<?php _e('E-Mail Address', 'library-management-system'); ?>"
               class="form-control fix_radius" type="text">


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('Course Name', 'library-management-system'); ?></label>


        <select id="course_name" name="course_name"
                class="form-control selectpicker fix_radius">
            <option value=""><?php _e('------------Select Course Name------------', 'library-management-system'); ?></option>
            <?php
            global $wpdb;
            $full_data = $wpdb->get_results("select * from tblcourses");
            foreach ($full_data as $obj) {
                ?>
                <option value="<?php echo $obj->Id; ?>"><?php echo $obj->CourseName; ?></option>
                <?php
            }
            ?>
        </select>


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('Year', 'library-management-system'); ?></label>

        <select id="year_name" name="year_name"
                class="form-control selectpicker fix_radius">
            <option value=""><?php _e('------------Select Course Year------------', 'library-management-system'); ?></option>
            <?php
            global $wpdb;
            $full_data = $wpdb->get_results("select * from tblyears");
            foreach ($full_data as $obj) {
                ?>
                <option value="<?php echo $obj->Id; ?>"><?php echo $obj->YearName; ?></option>
                <?php
            }
            ?>
        </select>


    </div>


    <div class="form-group mb0 col-sm-6">

        <label><?php _e('Phone', 'library-management-system'); ?></label>

        <input name="phone" tooltips
               tooltip-template="<?php _e('This will be his default password for login', 'library-management-system'); ?>."
               id="phone" placeholder="9876543210" id="phone"
               class="form-control fix_radius" type="text">


    </div>

    <div class="form-group mb0 col-sm-12">

        <label><?php _e('Address', 'library-management-system'); ?></label>

        <textarea class="form-control" name="address" id="address" row="2"></textarea>


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('City', 'library-management-system'); ?></label>


        <input name="city" id="city"
               placeholder="<?php _e('City', 'library-management-system'); ?>"
               class="form-control fix_radius"
               type="text">


    </div>

    <div class="form-group mb0 col-sm-6">

        <label><?php _e('State', 'library-management-system'); ?></label>

        <?php set_up_states("state", "state"); ?>


    </div>


    <div class="form-group mb0 col-sm-6">
        <label><?php _e('Zip', 'library-management-system'); ?> </label>

        <input name="zip" id="zip"
               placeholder="<?php _e('Zip Code', 'library-management-system'); ?>"
               class="form-control fix_radius" type="text">

    </div>

    <!-- Future Scope -->
    <div class="form-group mb0 col-sm-6">
        <label tooltips
               tooltip-template="<?php _e('Will be availabe in future update.', 'library-management-system'); ?>"><?php _e('Role', 'library-management-system'); ?></label>
        <input name="role" id="role" value="Student" type="hidden">
        <select class="form-control" disabled>
            <option value="Student"
                    selected><?php _e('Student', 'library-management-system'); ?></option>
            <option value="Teacher"><?php _e('Teacher', 'library-management-system'); ?></option>
        </select>

    </div>

    <div class="form-group mb0 col-sm-12">
        <label><?php _e('Notes', 'library-management-system'); ?></label>

        <textarea class="form-control fix_radius" id="note_on_user" name="note_on_user"
                  placeholder="<?php _e('Note', 'library-management-system'); ?>"></textarea>

    </div>
    <div class="form-group mb0 col-sm-12">
        <button ng-click="addUserbtn()"
                class="btn btn-danger pull-right  add_btn_user pmd-ripple-effect"><span
                    class="fa fa-floppy-o"></span><?php _e('Save', 'library-management-system'); ?>
        </button>
    </div>
</div>
</form>
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
