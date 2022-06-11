<?php
/* Template Name: ManageCategories Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>

<?php
get_sidebar();
?>

<?php get_template_part('navbar'); ?>

<div class="dash-container">
  <div class="row row_start_tbl">
    <div class="wrapper-profile" style="width: 74%;">
      <div class="" style="padding: 10px;">
        <form class="form-inline">
          <div class="input-group col-md-4">
            <input type="text" class="form-control fix_radius" id="inlineFormCatName"
                   placeholder="Category Name">
          </div>
          <div class="input-group col-md-6">
            <input type="text" class="form-control fix_radius" id="inlineFormCatDesc"
                   placeholder="Category Description">
          </div>
          <button type="submit" class="btn btn-primary fix_radius">Save</button>
        </form>
      </div>
      <table class="table table-bordered table-striped"
             style="font-size: small; margin-bottom: 0px;   padding: 10px;">
        <thead>
        <tr>
          <th style="display:none;">?</th>
          <th class=""><?php _e( 'Category Name', 'library-management-system' );?></th>
          <th class=""><?php _e( 'Category Description', 'library-management-system' );?></th>
          <th class=""><?php _e( 'Action', 'library-management-system' );?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td style="display:none;">1</td>
          <td class="text-align:left;"><?php _e( 'Bsc - IT', 'library-management-system' );?></td>
          <td style="text-align:left;" class=""><?php _e( 'IT Computers', 'library-management-system' );?></td>
          <td style="text-align:left;">
            <button class="btn btn-danger fix_radius" contenteditable="false"><?php _e( 'Edit', 'library-management-system' );?></button>
            <button class="btn btn-danger fix_radius" contenteditable="false"><?php _e( 'Delete', 'library-management-system' );?></button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
get_footer();
?>	