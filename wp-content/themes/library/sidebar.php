<div ng-controller="sideBarCtrl">
  <header class="main-header">

    <a href="<?php echo get_url('dashboard'); ?>" class="logo">

      <span class="logo-mini"><b>LMS</b></span>

      <span class="logo-lg"><b><?php _e( 'Master Panel', 'library-management-system' );?> </b></span>
    </a>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php _e( 'Toggle navigation', 'library-management-system' );?></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <li class="dropdown notifications-menu">
            <a href="<?php echo get_url('view-request-book-data'); ?>">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{cnt_not_approved}}</span>
            </a>
          </li>
            <?php
            global $current_user;
            $userID = $current_user->ID;
            $photo_id = get_the_author_meta('user_pic_id', $userID);
            $fname = get_the_author_meta('lib_fname', $userID);
            $lname = get_the_author_meta('lib_lname', $userID);
            $udata = get_userdata($userID);
            $user_registerd = date("M Y", strtotime($udata->user_registered));
            ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 51px;">
              <img
                  ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id)[0]; ?>' || '<?php echo get_template_directory_uri() . "/img/avatar.png" ?>'}}"
                  class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $fname . " " . $lname; ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                <img
                    ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id)[0]; ?>' || '<?php echo get_template_directory_uri() . "/img/avatar.png" ?>'}}"
                    class="img-circle" alt="User Image">

                <p>
                    <?php echo $fname . " " . $lname; ?>
                  - <?php if (user_can($current_user, "Subscriber")) {
                        _e( 'User', 'library-management-system' );
                    } else {
                        _e( 'Librarian', 'library-management-system' );
                    } ?>
                  <small><?php _e( 'Member since . ', 'library-management-system' ); ?><?php echo $user_registerd; ?></small>
                </p>
              </li>


              <li class="user-footer">
                <div class="" style="padding-left: 2%;">
                  <div class="pull-left">
                    <a href="<?php echo get_url('update-profile'); ?>"
                       class="btn btn-default btn-flat" style="height: 37px;"><?php _e( 'Profile', 'library-management-system' );?></a>
                  </div>
                  <div class="pull-left">
                    <a target="_blank" href="<?php echo get_site_url(); ?>"
                       class="btn btn-default btn-flat" style="height: 37px;"><?php _e( 'FrondEnd', 'library-management-system' );?></a>
                  </div>
                  <div class="pull-left">
                    <a href="<?php echo wp_logout_url(get_home_url()); ?>"
                       class="btn btn-default btn-flat" style="height: 37px;"><?php _e( 'Sign out', 'library-management-system' );?></a>
                  </div>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="<?php echo get_url('other-settings'); ?>"><i class="fa fa-gears"></i></a>
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
              ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id)[0]; ?>' || '<?php echo get_template_directory_uri() . "/img/avatar.png" ?>'}}"
              class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $fname . " " . $lname; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php _e( 'Online', 'library-management-system' );?></a>
        </div>
      </div>


      <ul class="sidebar-menu">


        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('dashboard'); ?>','') }">
          <a href="<?php echo get_url('dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span><?php _e( 'Dashboard', 'library-management-system' );?></span>

          </a>
        </li>


        <li id="MyPorfileMain" class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span><?php _e( 'My Profile', 'library-management-system' );?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ng-class="{ active: isActive('<?php echo get_url("change-password"); ?>','MyPorfileMain') }">
              <a href="<?php echo get_url("change-password"); ?>"><i class="fa fa-circle-o"></i><?php _e( 'Change Password', 'library-management-system' );?></a></li>
            <li ng-class="{ active: isActive('<?php echo get_url("update-profile"); ?>','MyPorfileMain') }">
              <a href="<?php echo get_url("update-profile"); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'Update Details', 'library-management-system' );?></a></li>
          </ul>
        </li>


        <li id="ManageBookMain" class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span><?php _e( 'Manage Books', 'library-management-system' );?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ng-class="{ active: isActive('<?php echo get_url("add-book"); ?>','ManageBookMain') }"><a
                  href="<?php echo get_url("add-book"); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'Add Books', 'library-management-system' );?></a></li>
            <li ng-class="{ active: isActive('<?php echo get_url("manage-books"); ?>','ManageBookMain') }">
              <a href="<?php echo get_url("manage-books"); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'View Books', 'library-management-system' );?></a></li>
          </ul>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('manage-fines'); ?>','') }">
          <a href="<?php echo get_url('manage-fines'); ?>">
            <i class="fa fa-money"></i> <span><?php _e( 'Manage Fines', 'library-management-system' );?></span>

          </a>
        </li>
        <li ng-show="<?php echo get_option("do_online_payment"); ?>" ng-class="{'treeview':true,active: isActive('<?php echo get_url('manage-online-dues'); ?>','') }">
          <a href="<?php echo get_url('manage-online-dues'); ?>">
            <i class="fa fa-money"></i> <span><?php _e( 'Manage Online Paid Dues', 'library-management-system' );?></span>

          </a>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("issue-books"); ?>','') }">
          <a href="<?php echo get_url('issue-books'); ?>">
            <i class="fa fa-folder-open-o"></i> <span> <?php _e( 'Issue Books', 'library-management-system' );?></span>

          </a>
        </li>


        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("manage-issued-books"); ?>','') }">
          <a href="<?php echo get_url('manage-issued-books'); ?>">
            <i class="fa fa-list"></i> <span> <?php _e( 'View All Issued Books', 'library-management-system' );?></span>

          </a>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url("manage-return-archive"); ?>','') }">
          <a href="<?php echo get_url('manage-return-archive'); ?>">
            <i class="fa fa-clock-o "></i> <span> <?php _e( 'View All Archive Books', 'library-management-system' );?></span>

          </a>
        </li>


        <li id="MainUserMenu" class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span><?php _e( 'Manage Users', 'library-management-system' );?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ng-class="{ active: isActive('<?php echo get_url('add-user'); ?>','MainUserMenu') }"><a
                  href="<?php echo get_url('add-user'); ?>"><i class="fa fa-circle-o"></i><?php _e( 'Add User', 'library-management-system' );?> </a></li>
            <li ng-class="{ active: isActive('<?php echo get_url('manage-users'); ?>','MainUserMenu') }"><a
                  href="<?php echo get_url('manage-users'); ?>"><i class="fa fa-circle-o"></i><?php _e( 'View All Users', 'library-management-system' );?> </a></li>
          </ul>
        </li>


        <li id="SettingMainMenu" class="treeview">
          <a href="#">
            <i class="fa fa-sliders"></i> <span><?php _e( 'Manage Settings', 'library-management-system' );?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ng-class="{ active: isActive('<?php echo get_url('manage-course'); ?>','SettingMainMenu') }">
              <a href="<?php echo get_url('manage-course'); ?>"><i class="fa fa-circle-o"></i><?php _e( 'Manage Courses', 'library-management-system' );?> </a></li>
            <li ng-class="{ active: isActive('<?php echo get_url('manage-years'); ?>','SettingMainMenu') }">
              <a href="<?php echo get_url('manage-years'); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'Manage Years', 'library-management-system' );?></a>
            </li>
          </ul>
        </li>


        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('view-request-book-data'); ?>','') }">
          <a href="<?php echo get_url('view-request-book-data'); ?>">
            <i class="fa fa-heart-o "></i> <span> <?php _e( 'View Request Book Data', 'library-management-system' );?></span>

          </a>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('manage-slides'); ?>','') }">
          <a href="<?php echo get_url('manage-slides'); ?>">
            <i class="fa fa-television"></i> <span> <?php _e( 'Manage Slides', 'library-management-system' );?></span>

          </a>
        </li>


        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('manage-institution'); ?>','') }">
          <a href="<?php echo get_url('manage-institution'); ?>">
            <i class="fa fa-sliders "></i> <span> <?php _e( 'Institution Setup', 'library-management-system' );?></span>

          </a>
        </li>


        <li id="ManagePageMainMenu" class="treeview">
          <a href="#">
            <i class="fa fa-pagelines"></i> <span><?php _e( 'Manage Pages', 'library-management-system' );?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ng-class="{ active: isActive('<?php echo get_url('add-page'); ?>','ManagePageMainMenu') }">
              <a href="<?php echo get_url('add-page'); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'Add Page', 'library-management-system' );?></a></li>
            <li ng-class="{ active: isActive('<?php echo get_url('manage-pages'); ?>','ManagePageMainMenu') }">
              <a href="<?php echo get_url('manage-pages'); ?>"><i class="fa fa-circle-o"></i> <?php _e( 'List All Page', 'library-management-system' );?></a>
            </li>
          </ul>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('other-settings'); ?>','') }">
          <a href="<?php echo get_url('other-settings'); ?>">
            <i class="fa fa-gears"></i> <span><?php _e( 'Other Settings', 'library-management-system' );?></span>

          </a>
        </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('update-control'); ?>','') }">
          <a href="<?php echo get_url('update-control'); ?>">
            <i class="fa fa-wrench "></i> <span><?php _e( 'Update Website', 'library-management-system' );?></span>

          </a>
        </li>

          <li style="display:none;" ng-class="{'treeview':true,active: isActive('<?php echo get_url('bulk-manager'); ?>','') }">
              <a href="<?php echo get_url('bulk-manager'); ?>">
                  <i class="fa fa-wrench "></i> <span><?php _e( 'Bulk Manager', 'library-management-system' );?></span>

              </a>
          </li>

        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('report-bugs'); ?>','') }">
          <a href="<?php echo get_url('report-bugs'); ?>">
            <i class="fa fa-bug"></i> <span><?php _e( 'Report Bugs', 'library-management-system' );?></span>

          </a>
        </li>
        <li ng-class="{'treeview':true,active: isActive('<?php echo get_url('about-software'); ?>','') }">
          <a href="<?php echo get_url('about-software'); ?>">
            <i class="fa fa-clock-o "></i> <span> <?php _e( 'About Software', 'library-management-system' );?></span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
</div>