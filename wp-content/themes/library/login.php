<?php
/* Template Name: Login Page */
//echo is_user_logged_in();
if (is_user_logged_in()) {
    wp_redirect(get_permalink(get_page_by_path('dashboard')));
    exit;
}
?>
<?php get_header(); ?>

<div class="container-fluid" style="height: 100%;">

    <div class="loginmodal-container pmd-z-depth-4" style="height: 578px;">
        <div style="width: 100%;text-align: -webkit-right;"><a
                    style="color: blue;font-size: 15px;text-decoration: underline;"
                    href="<?php echo get_site_url(); ?>"><?php _e('Back', 'library-management-system'); ?></a></div>
        <?php
        if (isset($_GET["login"])) {
            $status = $_GET['login'];
            if ($status == 'failed') {
                ?>
                <div style="margin: -13px;
        padding: 11px;
        background-color: #616060;
        color: white;
        font-weight: bold;
        margin-top: 8px;
        margin-bottom: 5px;">
                    <?php _e('Login Failed.', 'library-management-system'); ?>
                </div>
                <?php
            }
        }
        ?>


        <?php
        if (isset($_GET["login"])) {
            $status = $_GET['login'];
            if ($status == 'disabled') {
                ?>
                <div style="margin: -18px;
          padding: 11px;
          background-color: #616060;
          color: white;
          font-weight: bold;
          margin-top: -5px;
          margin-bottom: 5px;">
                    <?php _e('Login Disabled', 'library-management-system'); ?>
                </div>
                <?php
            }
        }
        ?>


        <h1>Library Management</h1><br>

        <?php $args = array(
            'redirect' => get_permalink(get_page_by_path('dashboard')));
        wp_login_form($args);
        ?>

        <div class="login-help">
            <a href="<?php echo get_permalink(get_page_by_path('forgot-password')); ?>"><?php _e('Forgot Password', 'library-management-system'); ?>
                ?</a>
        </div>
        <div>
            <?php if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
                ?>
                <table class="table table-bordered">
                    <caption
                            style="font-size: 17px;text-align: -webkit-center;"><?php _e('Login Details', 'library-management-system'); ?></caption>
                    <tr>
                        <td><b><?php _e('Admin Login', 'library-management-system'); ?> : </b></td>
                        <td style="display:none;"></td>
                        <td style="display:none;"></td>
                        <td><a href="#" onclick="return AdminDet();"
                               style="color: red;font-size: 15px;"><?php _e('Try Admin', 'library-management-system'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><b><?php _e('Student Login', 'library-management-system'); ?> : </b></td>
                        <td style="display:none;"></td>
                        <td style="display:none;"></td>
                        <td><a href="#" onclick="return StudentDet();"
                               style="color: red;font-size: 15px;"><?php _e('Try Student', 'library-management-system'); ?></a>
                        </td>
                    </tr>
                </table>
                <?php
            } ?>
        </div>
    </div>


</div>
<?php get_footer(); ?>
<?php if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
    ?>
    <script>
        function AdminDet() {
            document.getElementById("user_login").value = "admin";
            document.getElementById("user_pass").value = "1234567890";
            document.getElementById("wp-submit").click();
            return false;
        }
        function StudentDet() {
            document.getElementById("user_login").value = "tash@gmail.com";
            document.getElementById("user_pass").value = "704-673-6700";
            document.getElementById("wp-submit").click();
            return false;
        }

    </script>
    <?php
} ?>
<style>
    .content-wrapper, .main-footer, .right-side {
        margin: 0px;
    }

    body {
        font-family: Poppins, sans-serif !important;
        height: 100% !important;
    }
    html{
        height: 100% !important;
    }

    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
        background-color: #fff;
    }

    .main-footer {
        bottom: 0;
        width:100%;
    }
</style>