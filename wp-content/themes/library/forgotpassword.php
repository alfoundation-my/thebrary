<?php
/* Template Name: ForgotPassword Page */
get_header(); ?>

<?php
if (is_user_logged_in()) {
    wp_redirect(get_permalink(2));
}
?>
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<div class="container-fluid" style="height: 100%;">

    <div class="loginmodal-container" ng-controller="forgotPasswordCtrl" style="height: 578px;">

        <h1><?php _e('Library Management', 'library-management-system'); ?></h1><br>
        <div>
            <span style="font-size: 17px;font-weight: bold;"><?php _e('Change Password', 'library-management-system'); ?></span>
        </div>
        <hr style="border-top: 2px solid #eee;"/>

        <form id="frmForgotPassword">

            <p class="login-username">
                <label for="user_login"><?php _e('Username or Email Address', 'library-management-system'); ?></label>
                <input type="text" name="log" id="user_email" class="form-control fix_radius" value="" size="20"
                       ng-model="user_email">
            </p>


            <p class="login-submit">
                <button type="button" ng-click="btn_GetPassword()"
                        class="btn btn-primary form-control fix_radius pmd-ripple-effect"><span
                            class="fa fa-floppy-o"></span>&nbsp;<?php _e('Send Password', 'library-management-system'); ?>
                </button>
            </p>


            <div class="login-help">
                <a href="<?php echo get_home_url(); ?>/login"><?php _e('Login', 'library-management-system'); ?></a>
            </div>

    </div>
</div>

<?php get_footer(); ?>
<style>
    .content-wrapper, .main-footer, .right-side {
        margin: 0px;
    }

    body {
        font-family: Poppins, sans-serif !important;
    }

    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
        background-color: #fff;
    }

    .main-footer {
        bottom: 0;
        width:100%;
    }
</style>
