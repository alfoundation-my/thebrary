<?php
/* Template Name: UpdateControl Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
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
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a>
                </li>
                <li class="active"><?php _e('Update Control', 'library-management-system'); ?></li>
            </ol>
        </section>


        <section class="content">
            <div class="box box-default" ng-controller="managementofFinesCtrl">
                <div class="box-header with-border">

                </div>

                <div class="box-body" style="" ng-controller="CtrlUpdateManager">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="shell-wrap">
                                <p class="shell-top-bar"><?php _e('Upgrading your website..$root-mode', 'library-management-system'); ?></p>
                                <ul class="shell-body" id="shell-body">
                                </ul>
                            </div>

                            <div>
                                <button class="btn btn-primary" style="float: left;margin-right: 1%;margin-bottom: 1%;"
                                        ng-click="check_update()"><?php _e('Check For Update', 'library-management-system'); ?></button>
                                <form id="rm_theme_data" style="float: left;margin-right: 1%;margin-bottom: 1%;" method="post"
                                      action="<?php echo home_url() . "/clear-theme-data"; ?>">
                                    <input type="hidden" name="todo" value="DELETE">
                                    <button class="btn btn-primary"
                                            type="submit"><?php _e('Remove Theme\'s Data', 'library-management-system'); ?></button>
                                </form>
                                <form id="bck_theme_data" method="post" action="<?php echo home_url() . "/backup-theme-data"; ?>">
                                    <input type="hidden" name="todo" value="BACKUP">
                                    <button class="btn btn-primary"
                                            type="submit"><?php _e('BackUp DB', 'library-management-system'); ?></button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-footer">
                </div>
            </div>
        </section>
    </div>


<?php
get_footer();
?>