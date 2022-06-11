<?php
/* Template Name: UpdateProfile Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>


<?php
global $current_user;
$userID = $current_user->ID;
$user_login = $current_user->user_login;
$fname = get_the_author_meta('lib_fname', $userID);
$lname = get_the_author_meta('lib_lname', $userID);
$phone = get_the_author_meta('phone', $userID);
$email = get_the_author_meta('email', $userID);
$address = get_the_author_meta('address', $userID);
$city = get_the_author_meta('city', $userID);
$state = get_the_author_meta('states', $userID);
$zip = get_the_author_meta('zip', $userID);
$photo_id = get_the_author_meta('user_pic_id', $userID);
$blood_group = get_the_author_meta('blood_group', $userID);
?>
<?php
get_sidebar();
?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php _e( 'Dashboard', 'library-management-system' );?>
      <small><?php _e( 'Control panel', 'library-management-system' );?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
      <li class="active"><?php _e( 'Update My Profile', 'library-management-system' );?></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <form id="lib_update_profile_form" enctype="multipart/form-data" method="post">
        <div class="col-sm-3">
          <img id="img_profile_pic_temp"
               ng-src="{{'<?php echo wp_get_attachment_image_src($photo_id, "full")[0]; ?>' || '<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>'}}"
               class="img-responsive" width="100%" style="background-color: white;" alt="Admin Profile"
               width="100%">
          <div style="padding-top: 10px;">
            <input type="file" accept="image/*" name="upload_image" id="upload_image" class="form-control">
          </div>
        </div>
        <div class="col-sm-9 changeProfileDataCtrl" ng-controller="changeProfileDataCtrl">
          <div class="tab-content shadow" style="border: 0;padding:0;">
            <div class="tab-pane active">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <div class="panel-title">
                    <strong><?php _e( 'Update Details', 'library-management-system' );?></strong>
                  </div>
                </div>
                <div class="panel-body form-horizontal">
                  <input type="hidden" name="action" value="update_lib_profile">
                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'First Name', 'library-management-system' );?></label>
                    <input name="fname" id="fname" placeholder="<?php _e( 'First Name', 'library-management-system' );?>" class="form-control"
                           value="<?php echo $fname; ?>" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Last Name', 'library-management-system' );?></label>
                    <input name="lname" id="lname" placeholder="<?php _e( 'Last Name', 'library-management-system' );?>" class="form-control"
                           value="<?php echo $lname; ?>" type="text">
                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Email', 'library-management-system' );?></label>
                    <input name="email" id="email" placeholder="<?php _e( 'E-Mail Address', 'library-management-system' );?>"
                           value="<?php echo $email; ?>" class="form-control" type="text"
                           readonly="readonly">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Phone', 'library-management-system' );?></label>
                    <input name="phone" id="phone" placeholder="9876543210" value="<?php echo $phone; ?>"
                           class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'City', 'library-management-system' );?></label>
                    <input name="city" id="city" placeholder="<?php _e( 'City', 'library-management-system' );?>" class="form-control"
                           value="<?php echo $city; ?>" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'State', 'library-management-system' );?></label>
                      <?php set_up_states("state", "state"); ?>
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Zip', 'library-management-system' );?></label>
                    <input name="zip" id="zip" placeholder="<?php _e( 'Zip Code', 'library-management-system' );?>" value="<?php echo $zip; ?>"
                           class="form-control" type="text">
                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Blood Group', 'library-management-system' );?></label>
                    <input name="blood_group" id="blood_group" placeholder="<?php _e( 'Blood Group', 'library-management-system' );?>"
                           value="<?php echo $blood_group; ?>"
                           class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-12">
                    <label><?php _e( 'Address', 'library-management-system' );?></label>
                    <textarea name="address" id="address" row="3" placeholder="<?php _e( 'Address', 'library-management-system' );?>"
                              class="form-control"><?php echo $address; ?></textarea>
                  </div>

                  <div class="form-group mb0 col-sm-12">
                    <button ng-click="updateProfile()"
                            class="btn btn-primary fix_radius pull-right pmd-ripple-effect"><span
                          class="fa fa-floppy-o"></span>&nbsp<?php _e( 'Save', 'library-management-system' );?>
                    </button>

                  </div>


                </div>
              </div>
            </div>

          </div>

        </div>
      </form>
    </div>
  </section>
</div>


<?php
get_footer();
?>
<!-- Adding Javascript -->
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $("#state").val("<?php echo $state; ?>");
  });
</script>
