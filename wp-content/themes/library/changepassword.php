<?php
/* Template Name: ChangePassword Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>
<?php
if (current_user_can('administrator')) {
    get_sidebar();
} else {
    get_sidebar("user");
}

?>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <?php _e( 'Dashboard', 'library-management-system' );?>
                <small><?php _e( 'Control panel', 'library-management-system' );?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
                <li class="active"><?php _e( 'Change Password', 'library-management-system' );?></li>
            </ol>
        </section>
        <section class="content" style="min-height: 100%;">
            <div class="box box-default" ng-controller="changePasswordCtrl">
                <div class="box-header with-border">

                </div>
                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" id="lib_password_form" style="width: 94%;">
                                <input type="hidden" name="action" value="change_password"/>
                                <h3><?php _e( 'Change password', 'library-management-system' );?></h3>
                                <p><?php _e( 'Hints on getting your new password right:', 'library-management-system' );?></p>
                                <p><?php _e( 'Your new password must be between 8 and 15 characters in length.', 'library-management-system' );?></p>
                                <hr/>
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label pull-left reset_sm"><?php _e( 'New Password', 'library-management-system' );?></label>
                                    <div class="col-sm-8">
                                        <input name="new_pass" id="new_pass" ng-model="frm_ChangePassData.new_pass"
                                               placeholder="<?php _e( 'New Password', 'library-management-system' );?>" class="form-control fix_radius pull-left"
                                               type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label pull-left reset_sm">
                                        <?php _e( 'Confirm New Password', 'library-management-system' );?></label>
                                    <div class="col-sm-8">
                                        <input name="confirm_pass" id="confirm_pass"
                                               ng-model="frm_ChangePassData.confirm_pass" placeholder="<?php _e( 'Confirm Password', 'library-management-system' );?>"
                                               class="form-control fix_radius pull-left" type="text">
                                    </div>
                                </div>


                                <hr/>


                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button ng-click="updatePass()" id="btn_chg_pass"
                            class="btn btn-primary pull-right fix_radius pmd-ripple-effect btn_change_password"><span
                                class="fa fa-floppy-o"></span>&nbsp;<?php _e( 'Change Password', 'library-management-system' );?>
                    </button>
                </div>
            </div>
    </div>
    </section>
    </div>

<?php
get_footer();
?>