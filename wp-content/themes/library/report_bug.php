<?php
/* Template Name: ReportBugs Page */
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
       <?php _e( 'Dashboard', 'library-management-system' );?>
      <small> <?php _e( 'Control panel', 'library-management-system' );?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  <?php _e( 'Home', 'library-management-system' );?></a></li>
      <li class="active"> <?php _e( 'Report Bugs', 'library-management-system' );?></li>
    </ol>
  </section>


  <section class="content" style="min-height: 100%;">
    <div class="">
      <div class="box-header with-border">

      </div>

      <div class="box-body" style="">
        <div class="row">

          <div class="col-md-12" ng-controller="reportBugCtrl">
            <div class="tab-content shadow">
              <div class="tab-pane active">
                <div class=" panel panel-custom">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong><?php _e( 'Report Bugs', 'library-management-system' );?></strong>
                    </div>
                  </div>
                  <div class="panel-body form-horizontal">
                    <form class="form-horizontal" id="frm_reportbug">

                      <input type="hidden" name="action" value="other_settings">
                      <div class="form-group mb0 col-sm-6">
                        <label> <?php _e( 'Name', 'library-management-system' );?></label>
                        <input name="person_name" id="person_name" placeholder=" <?php _e( 'Your Name', 'library-management-system' );?>"
                               class="form-control" ng-model="person_name"
                               type="text" required>

                      </div>

                      <div class="form-group mb0 col-sm-6">
                        <label> <?php _e( 'Choose Type Of Request', 'library-management-system' );?></label>
                        <select class="form-control selectpicker" id="type_to_report">
                          <option value="bugs"> <?php _e( 'Bugs', 'library-management-system' );?></option>
                          <option value="feature"> <?php _e( 'Feature', 'library-management-system' );?></option>
                          <option value="others"> <?php _e( 'Others', 'library-management-system' );?></option>
                        </select>

                      </div>

                      <div class="form-group mb0 col-sm-12">
                        <label> <?php _e( 'Description', 'library-management-system' );?></label>
                        <textarea required rows="9" class="form-control" ng-model="email_desc"
                                  placeholder="Describe in details about the request you are making.Note : If you are doing this from localhost this option will not work.If that is the case you can simply send us an email on lms_dev@outlook.com. "></textarea>
                      </div>
                      <div class="form-group mb0 col-sm-12">


                        <button ng-click="sendInfo()"
                                class="btn btn-primary fix_radius pull-right pmd-ripple-effect"><span
                              class="fa fa-floppy-o"></span>&nbsp; <?php _e( 'Send Email', 'library-management-system' );?>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
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
<!-- Adding Javascript -->
<script type="text/javascript">
  jQuery(document).ready(function ($) {


  });
</script>