<?php
/* Template Name: BulkManager Page */
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
                <li class="active"><?php _e('Bulk Manager', 'library-management-system');?></li>
            </ol>
        </section>
        <section class="content">

            <div class="box box-default" ng-controller="managebulkupdatesofbooks">
                <div class="box-header with-border">
                    Bulk Update Books
                </div>
                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-primary">Download Sample Book Csv File</a>
                            <form class="form-inline" id="frm_UploadBulkBooks" enctype="multipart/form-data">

                                <input type="hidden" name="action" value="upload_bulk_file_and_manage">
                                <input type="hidden" name="todo" value="uploadbookcsv">
                                <table class="table table-condensed" style="margin-bottom: 3px;width: 35%;margin-top: 1%;">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <input type="file" class="form-control" id="book_csv"
                                                   name="book_csv" ng-model="book_csv"/>
                                        </td>
                                        <td class="col-md-1">
                                            <button ng-click="UploadBookCsv()" style="width:100%;"
                                                    class="btn btn-primary fix_radius"><?php _e('Upload CSV File', 'library-management-system');?>
                                            </button>
                                        </td
                                    </tr>
                                    </tbody>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                </div>
            </div>

            <div class="box box-default" ng-controller="managebulkupdatesofusers">
                <div class="box-header with-border">
                    Bulk Update Users
                </div>
                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-12">
                          <a href="" class="btn btn-primary">Download Sample User Csv File</a>
                          <form class="form-inline" id="frm_UploadBulkUsers" enctype="multipart/form-data">

                              <input type="hidden" name="action" value="upload_bulk_file_and_manage">
                              <input type="hidden" name="todo" value="uploadusercsv">
                              <table class="table table-condensed" style="margin-bottom: 3px;width: 35%;margin-top: 1%;">
                                  <tbody>
                                  <tr>
                                      <td class="col-md-2">
                                          <input type="file" class="form-control" id="book_csv"
                                                 name="book_csv" ng-model="book_csv"/>
                                      </td>
                                      <td class="col-md-1">
                                          <button ng-click="UploadUserCsv()" style="width:100%;"
                                                  class="btn btn-primary fix_radius"><?php _e('Upload CSV File', 'library-management-system');?>
                                          </button>
                                      </td
                                  </tr>
                                  </tbody>
                              </table>

                          </form>
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
