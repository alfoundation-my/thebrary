<?php
/* Template Name: UserProfile Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
global $current_user;
$userID = $current_user->ID;
$user_login = $current_user->user_login;
$user_id = get_the_author_meta('user_id', $userID);
get_sidebar("user");
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      <?php _e( 'Dashboard', 'library-management-system' );?>
      <small><?php _e( 'Control panel', 'library-management-system' );?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
      <li class="active"><?php _e( 'My Profile', 'library-management-system' );?></li>
    </ol>
  </section>


  <section class="content">

    <div class="row">
      <div class="">
        <div class="box-header with-border">


        </div>

        <div class="box-body" style="" ng-controller="UserProfileCtrl">
          <div class="row">
            <div class="col-sm-3">

              <img ng-src="{{mySrc || '<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>' }}"
                   class="img-responsive" style="margin: 0 auto;    background-color: white;" width="100%">
              <input type="file" accept="image/*" name="upload_image" id="upload_image" class="form-control" disabled>

            </div>
            <div class="col-sm-9">
              <form class="form-horizontal" id="">
                <div class="tab-content shadow">
                  <div class="tab-pane active">
                    <div class=" panel panel-custom">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong><?php _e( 'My Profile', 'library-management-system' );?></strong>
                        </div>
                      </div>
                      <div class="panel-body form-horizontal">

                        <input type="hidden" name="myId" id="myId" value="<?php echo $user_id; ?>">


                        <div class="form-group mb0 col-sm-6">

                          <label><?php _e( 'User ID', 'library-management-system' );?></label>

                          <input name="userid" id="userid" ng-model="userid" class="form-control"
                                 type="text" readonly="readonly" value="<?php echo $user_id; ?>">

                        </div>


                        <div class="form-group mb0 col-sm-6">

                          <label><?php _e( 'First Name', 'library-management-system' );?>
                            </label>

                          <input name="fname" id="fname" ng-model="fname" placeholder="N/A"
                                 class="form-control" type="text"
                                 readonly="readonly">

                        </div>


                        <div class="form-group mb0 col-sm-6">

                          <label><?php _e( 'Last Name', 'library-management-system' );?></label>

                          <input name="lname" id="lname" ng-model="lname" placeholder="N/A"
                                 class="form-control" type="text"
                                 readonly="readonly">


                        </div>


                        <div class="form-group mb0 col-sm-6">

                          <label><?php _e( 'Email', 'library-management-system' );?></label>

                          <input name="email" id="email" ng-model="email" placeholder="N/A"
                                 class="form-control" type="text"
                                 readonly="readonly">


                        </div>


                        <div class="form-group mb0 col-sm-6">
                          <label><?php _e( 'Phone', 'library-management-system' );?></label>
                          <input name="phone" id="phone" ng-model="phone" placeholder="N/A"
                                 class="form-control" type="text"
                                 readonly="readonly">


                        </div>


                        <div class="form-group mb0 col-sm-6">

                          <label><?php _e( 'City', 'library-management-system' );?></label>


                          <input name="city" id="city" ng-model="city" placeholder="N/A"
                                 class="form-control" type="text"
                                 readonly="readonly">


                        </div>


                        <div class="form-group mb0 col-sm-6">
                          <label><?php _e( 'State', 'library-management-system' );?></label>
                            <?php set_up_states("state", "state"); ?>
                        </div>


                        <div class="form-group mb0 col-sm-6">
                          <label><?php _e( 'Course Name', 'library-management-system' );?></label>
                          <select id="course_name" name="course_name"
                                  class="form-control selectpicker fix_radius" disabled>
                            <option value="">------------Select Course Name------------</option>
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
                          <label><?php _e( 'Year', 'library-management-system' );?></label>
                          <select id="year_name" name="year_name"
                                  class="form-control selectpicker fix_radius" disabled>
                            <option value="">------------Select Course Year------------</option>
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
                          <label><?php _e( 'Zip', 'library-management-system' );?></label>
                          <input name="zip" id="zip" placeholder="N/A" ng-model="zip" class="form-control"
                                 type="text" readonly="readonly">


                        </div>
                        <div class="form-group mb0 col-sm-12">
                          <label><?php _e( 'Address', 'library-management-system' );?></label>
                          <textarea name="address" id="address" ng-model="address"
                                    class="form-control" readonly="readonly"></textarea>
                        </div>
                      </div>
                    </div>
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
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $("#state").attr("readonly", "readonly");
  });
</script>
