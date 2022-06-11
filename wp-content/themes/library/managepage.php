<?php
/* Template Name: ManagePages Page */
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
        <?php _e('Dashboard', 'library-management-system');?>
        <small><?php _e('Control panel', 'library-management-system');?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system');?></a></li>
        <li class="active"><?php _e('Manage Pages', 'library-management-system');?></li>
      </ol>
    </section>

    <section class="content" style="min-height: 100%;">
      <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body" style="">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped"
                       style="font-size: small; margin-bottom: 0px;">
                  <thead>
                  <tr>
                    <th style="display:none;">?</th>
                    <th class="fin_page_id" style=""><?php _e('Page ID', 'library-management-system');?></th>
                    <th class="fin_page_menu" style="width: 270px;"><?php _e('Page Menu', 'library-management-system');?></th>
                    <th class="fin_page_name" style=""><?php _e('Page Title', 'library-management-system');?></th>
                    <th class="fin_page_description" style=""><?php _e('Page Description', 'library-management-system');?></th>
                    <th class="fin_created_date" style=""><?php _e('Created Dated', 'library-management-system');?></th>
                    <th class="fin_actions" style=""><?php _e('Action', 'library-management-system');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php get_all_custom_page_created(); ?>
                  </tbody>
                </table>
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
