<?php
/* Template Name: AddPages Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>

<?php
$page_title="";
$page_menu ="";
$page_content ="";
$page_id="";
$mode = "Add";
if (isset($_GET["id"])) {
    if (is_numeric($_GET["id"])) {
        $mode = "Edit";
        $page_content = get_post_field('post_content', $_GET["id"]);
        $page_title = get_post_field('post_title', $_GET["id"]);
        $page_menu = get_post_meta($_GET["id"], "menu_name")[0];
        $page_id = $_GET["id"];
    } else {
        die();
    }
}
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
      <li class="active"><?php _e( 'Add Pages', 'library-management-system' );?></li>
    </ol>
  </section>


  <section class="content" style="min-height: 100%;">


    <div class="">
      <div class="box-header with-border">

      </div>

      <div class="box-body" style="">
        <div class="row">

          <div class="col-md-12" ng-controller="createPageCtrl">
            <div class="tab-content shadow">
              <div class="tab-pane active">
                <div class=" panel panel-custom">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong><?php _e( 'Add Pages', 'library-management-system' );?></strong>
                    </div>
                  </div>
                  <div class="panel-body form-horizontal">
                    <form class="form-horizontal" id="frm_addPage">

                      <input type="hidden" name="action" value="other_settings">
                      <div class="form-group mb0 col-sm-8">
                        <input type="hidden" name="action" value="create_page">
                        <label><?php _e( 'Page Title', 'library-management-system' );?></label>
                        <input name="page_title" id="page_title" placeholder="Enter a page tile"
                               class="form-control" <?php if ($mode == "Edit") { ?>
                          tooltips
                          tooltip-template="If you want to edit the title then copy the below content delete this page and create a new one."
                          tooltip-side="bottom"
                        <?php } ?>
                               type="text" value="<?php echo $page_title; ?>" <?php if ($mode == "Edit") {
                            echo "readonly";
                        } else {
                            echo "required";
                        } ?>>

                      </div>

                      <div class="form-group mb0 col-sm-4">
                        <label><?php _e( 'Page Menu Name', 'library-management-system' );?></label>
                        <input name="page_menu" id="page_menu" placeholder="<?php _e( 'Enter a page tile', 'library-management-system' );?>"
                               class="form-control" value="<?php echo $page_menu; ?>"
                               type="text" required>
                      </div>

                      <div class="form-group mb0 col-sm-12">
                        <label><?php _e( 'Description', 'library-management-system' );?></label>
                        <textarea required rows="30" class="form-control"
                        >
                          <?php echo $page_content; ?>
                        </textarea>
                      </div>
                      <input type="hidden" name="page_content" id="page_content">

                      <input type="hidden" name="id" id="id" value="<?php echo $page_id; ?>">
                      <div class="form-group mb0 col-sm-12">
                        <button ng-click="createPage()"
                                class="btn btn-primary fix_radius pull-right pmd-ripple-effect"><span
                              class="fa fa-floppy-o"></span>&nbsp;<?php echo $mode == "Add" ? "Create " : " Modify "; ?>
                          Page
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
    tinymce.init({
      selector: 'textarea',
      mode: "exact",
      elements: "message,notes",
      plugins: "advlist autolink lists link image charmap hr anchor pagebreak code fullscreen table ",
      toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table code fullscreen",
      menubar: false,
      statusbar: false
    });
    var ed = tinymce.activeEditor;
  });
</script>
<style>
  .mce-widget.mce-tooltip {
    display: none !important;
  }
</style>