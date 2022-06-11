<?php
/* Template Name: ManageInstitution Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>

<?php
get_sidebar();
?>

<?php
$inst_name = get_option('inst_name');
$inst_cont_name = get_option('inst_cont_name');
$inst_email = get_option('inst_email');
$inst_website = get_option('inst_website');
$inst_phone = get_option('inst_phone');
$inst_fax = get_option('inst_fax');
$inst_address = get_option('inst_address');
$inst_zip = get_option('inst_zip');
$inst_city = get_option('inst_city');
$inst_state = get_option('inst_state');
$inst_attach_photo_id = get_option('inst_attach_photo_id');
$inst_frnt_desc = get_option('inst_frnt_desc');
$inst_gmap = get_option('inst_gmap');
$inst_meta_desc = get_option('inst_meta_desc');
$inst_meta_title = get_option('inst_meta_title');
$inst_meta_keyword = get_option('inst_meta_keyword');
?>

<?php //get_template_part('navbar'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php _e( 'Dashboard', 'library-management-system' );?>
      <small><?php _e( 'Control panel', 'library-management-system' );?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
      <li class="active"><?php _e( 'Update Institution Details', 'library-management-system' );?></li>
    </ol>
  </section>


  <section class="content" style="min-height: 100%;">
    <div class="row" ng-controller="institutionSetupCtrl">
      <form class="form-horizontal" method="post" id="lib_manage_inst_form_profile">
        <div class="col-sm-3" style="background-color: white;padding-bottom: 15px;">
          <img id="img_profile_pic_temp"
               ng-src="{{'<?php echo wp_get_attachment_image_src($inst_attach_photo_id, "full")[0]; ?>' || '<?php echo get_template_directory_uri() . '/img/default_university.png'; ?>'}}"
               class="img-responsive" alt="<?php _e( 'Institution Logo', 'library-management-system' );?>" style="    margin: 0 auto;">

          <div style="padding-top: 10px;">
            <input type="file" accept="image/*" name="upload_image" id="upload_image" class="form-control">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content shadow" style="border: 0;padding:0;">
            <div class="tab-pane active">
              <div class="panel panel-custom">
                <div class="panel-heading">
                  <div class="panel-title">
                    <strong><?php _e( 'Update Institution Profile', 'library-management-system' );?></strong>
                  </div>
                </div>
                <div class="panel-body form-horizontal">

                  <input type="hidden" name="action" value="saveInstitutionProfile">
                  <input type="hidden" name="photo_id" id="attach_photo_id"
                         value="<?php echo $inst_attach_photo_id; ?>">
                  <div class="form-group mb0 col-sm-12">

                    <label><?php _e( 'Institution Name', 'library-management-system' );?></label>

                    <input name="inst_name" id="inst_name" value="<?php echo $inst_name; ?>"
                           placeholder="<?php _e( 'Institution Name', 'library-management-system' );?>" class="form-control" type="text">

                  </div>

                  <div class="form-group mb0 col-sm-12">
                    <label><?php _e( 'Institution Desc', 'library-management-system' );?> </label>
                    <textarea name="inst_frnt_desc" id="inst_frnt_desc"
                              placeholder="<?php _e( 'Institution Desc', 'library-management-system' );?>" class="form-control"
                              rows="4"><?php echo $inst_frnt_desc; ?></textarea>

                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Contact Person', 'library-management-system' );?></label>
                    <input name="inst_cont_name" id="inst_cont_name"
                           value="<?php echo $inst_cont_name; ?>" placeholder="<?php _e( 'Contact Name', 'library-management-system' );?>"
                           class="form-control" type="text">


                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'E-Mail', 'library-management-system' );?></label>
                    <input name="inst_email" id="inst_email" value="<?php echo $inst_email; ?>"
                           placeholder="<?php _e( 'E-Mail Address', 'library-management-system' );?>" class="form-control" type="text">


                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Website', 'library-management-system' );?></label>
                    <input name="inst_website" id="inst_website"
                           value="<?php echo $inst_website; ?>" placeholder="<?php _e( 'Website or domain name', 'library-management-system' );?>"
                           class="form-control" type="text">


                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Phone', 'library-management-system' );?> </label>
                    <input name="inst_phone" id="inst_phone" value="<?php echo $inst_phone; ?>"
                           placeholder="9876543210" class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Fax', 'library-management-system' );?></label>
                    <input name="inst_fax" id="inst_fax" placeholder="<?php _e( 'Fax Number', 'library-management-system' );?>"
                           value="<?php echo $inst_fax; ?>" class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Address', 'library-management-system' );?></label>
                    <input name="inst_address" id="inst_address" placeholder="Address"
                           class="form-control" value="<?php echo $inst_address; ?>" type="text">

                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Gmap Link', 'library-management-system' );?>&nbsp;<a href="https://www.youtube.com/watch?v=Xyj3gHyRAZI" target="_blank"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                    <input name="inst_gmap" id="inst_gmap" placeholder="<?php _e( 'GMap Link', 'library-management-system' );?>"
                           class="form-control" value="<?php echo $inst_gmap; ?>" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Zip', 'library-management-system' );?></label>
                    <input name="inst_zip" id="inst_zip" value="<?php echo $inst_zip; ?>"
                           placeholder="<?php _e( 'Zip Code', 'library-management-system' );?>" class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label>City </label>
                    <input name="inst_city" id="inst_city" value="<?php echo $inst_city; ?>"
                           placeholder="<?php _e( 'City', 'library-management-system' );?>" class="form-control" type="text">
                  </div>


                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'State', 'library-management-system' );?></label>
                      <?php set_up_states("inst_state", "inst_state"); ?>
                  </div>


                  <div class="form-group mb0 col-sm-12">

                    <label><?php _e( 'Google Title', 'library-management-system' );?></label>
                    <input name="inst_meta_title" id="inst_meta_title"
                           value="<?php echo $inst_meta_title; ?>" placeholder="<?php _e( 'Meta Title', 'library-management-system' );?>"
                           class="form-control" type="text">

                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label><?php _e( 'Google Desc', 'library-management-system' );?></label>
                    <textarea name="inst_meta_desc" id="inst_meta_desc" placeholder="<?php _e( 'Meta Desc', 'library-management-system' );?>"
                              class="form-control"
                              rows="5"><?php echo $inst_meta_desc; ?></textarea>

                  </div>

                  <div class="form-group mb0 col-sm-6">
                    <label> <?php _e( 'Google Keywords', 'library-management-system' );?></label>

                    <textarea name="inst_meta_keyword" id="inst_meta_keyword"
                              placeholder="<?php _e( 'Meta Keywords Seperate it by comma', 'library-management-system' );?>"
                              class="form-control"
                              rows="5"><?php echo $inst_meta_keyword; ?></textarea>
                  </div>


                  <div class="form-group mb0 col-sm-12">

                    <button ng-click="saveInstitution()"
                            class="btn btn-warning pull-right fix_radius pmd-ripple-effect">
                      <span class="fa fa-floppy-o"></span><?php _e( 'Save', 'library-management-system' );?>
                    </button>

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

<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $("#inst_state").val("<?php echo $inst_state; ?>");
  });
</script>
