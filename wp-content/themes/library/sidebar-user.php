<div ng-controller="sideBarCtrl">
    <header class="main-header">
        <a href="<?php echo get_url("dashboard"); ?>" class="logo">
            <span class="logo-mini"><b>LMS</b></span>
            <span class="logo-lg"><b><?php _e('User Panel', 'library-management-system'); ?></b></span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?php _e('Toggle navigation', 'library-management-system'); ?></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    <?php
                    global $current_user;
                    $userID = $current_user->ID;
                    $photo_id = get_user_meta($current_user->ID, 'user_pic_id', true);
                    $user_id = get_user_meta($current_user->ID, 'user_id', true);
                    $user_name = get_user_meta($current_user->ID, 'user_name', true);
                    $user_joined = get_user_meta($current_user->ID, 'user_joined', true);
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img
                                    ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id, "full")[0]; ?>' || '<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>'}}"
                                    class="user-image" style="float: inherit;"
                                    alt="<?php _e('User Image', 'library-management-system'); ?>">
                            <span class="hidden-xs"><?php echo $user_name; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img
                                        ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id)[0]; ?>' || '<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>'}}"
                                        class="img-circle"
                                        alt="<?php _e('User Image', 'library-management-system'); ?>">

                                <p>
                                    <?php echo $user_name; ?> - Users
                                    <small><?php _e('Member since', 'library-management-system'); ?><?php echo $user_joined; ?></small>
                                </p>
                            </li>


                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo get_url("users-profile-page"); ?>" style="height: 37px;"
                                       class="btn btn-default btn-flat"><?php _e('Profile', 'library-management-system'); ?></a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo wp_logout_url(get_home_url()); ?>" style="height: 37px;"
                                       class="btn btn-default btn-flat"><?php _e('Sign out', 'library-management-system'); ?></a>
                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">

        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img
                            ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id)[0]; ?>' || '<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>'}}"
                            class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $user_name; ?></p>
                    <a href="#"><i
                                class="fa fa-circle text-success"></i> <?php _e('Online', 'library-management-system'); ?>
                    </a>
                </div>
            </div>


            <ul class="sidebar-menu">

                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("list-book-for-user"); ?>','') }">
                    <a href="<?php echo get_url("list-book-for-user"); ?>">
                        <i class="fa fa-list"></i> <span> <?php _e('Dashboard', 'library-management-system'); ?></span>
                    </a>
                </li>
                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("change-password"); ?>','') }">
                    <a href="<?php echo get_url("change-password"); ?>">
                        <i class="fa fa-graduation-cap "></i>
                        <span><?php _e('Change Password', 'library-management-system'); ?></span>

                    </a>
                </li>


                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("manage-issued-book-for-users"); ?>','') }">
                    <a href="<?php echo get_url("manage-issued-book-for-users"); ?>">
                        <i class="fa fa-list"></i>
                        <span> <?php _e('View Issued Books', 'library-management-system'); ?></span>
                    </a>
                </li>

                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("manage-return-archives-user"); ?>','') }">
                    <a href="<?php echo get_url("manage-return-archives-user"); ?>">
                        <i class="fa fa-list"></i>
                        <span><?php _e(' View All Archive Books', 'library-management-system'); ?></span>
                    </a>
                </li>

                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("request-book"); ?>','') }">
                    <a href="<?php echo get_url("request-book"); ?>">
                        <i class="fa fa-list"></i>
                        <span> <?php _e('Submit Book Request', 'library-management-system'); ?></span>
                    </a>
                </li>

                <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("about-software"); ?>','') }">
                    <a href="<?php echo get_url("about-software"); ?>">
                        <i class="fa fa-clock-o "></i>
                        <span> <?php _e('About Software', 'library-management-system'); ?></span>
                    </a>
                </li>


            </ul>
        </section>

    </aside>
</div>





