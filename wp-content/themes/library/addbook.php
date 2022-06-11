<?php
/* Template Name: AddBook Page */
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
            <?php _e('Dashboard', 'library-management-system'); ?>
            <small><?php _e('Control panel', 'library-management-system'); ?></small>
        </h1>
        <form style="margin-top: 7px;" action="<?php echo home_url() . '/import-books'; ?>" method="post"
              enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload" style="font-size: 12px;float:left;border: 1px solid lightgray;">
            <input type="hidden" name="todo" value="import_from_file">
            <button type="submit" class="btn btn-primary btn-sm btn_sm_export">Import Books</button>
        </form>
        <form id="frm_impt_demo" style="margin-top: 7px;" action="<?php echo home_url() . '/import-books'; ?>" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="todo" value="import_demo">
            <button type="submit" class="btn btn-danger btn-sm btn_sm_export">Import Demo</button>
        </form>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a></li>
            <li class="active"><?php _e('Add Book', 'library-management-system'); ?></li>
        </ol>
    </section>

    <section class="content" style="min-height: 100%;" ng-controller="AddBookCtrl">
        <form class="form-horizontal" id="book_add_form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <img ng-src="{{book_src || '<?php echo get_template_directory_uri() . '/img/259x340.png' ?>'}}"
                         class="img-responsive" alt="Book Cover" width="100%">
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="tab-content shadow AddBookCtrl" style="border: 0;padding:0;">
                        <div class="tab-pane active">
                            <div class="panel panel-custom">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><?php _e('Add Book', 'library-management-system'); ?></strong>
                                    </div>
                                </div>
                                <div class="panel-body form-horizontal">
                                    <input type="hidden" name="action" value="add_book_data">
                                    <input type="hidden" name="book_src" id="book_src">
                                    <!--            <input type="hidden" name="attach_bill_id" id="attach_bill_id">-->
                                    <input type="hidden" name="book_goo_id" id="book_goo_id">
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('ISBN', 'library-management-system'); ?> *<a
                                                    class="book_sht_add"
                                                    style="        position: absolute;margin-top: -18px;right: -15px;"
                                                    target="_blank"
                                                    tooltips
                                                    tooltip-template="Open Amazon books | Copy & Paste ISBN-10 Code For Fetching Book Details"
                                                    tooltip-side="right"
                                                    href="https://www.amazon.com/SQL-Complete-Reference-James-Groff/dp/1259003884/ref=sr_1_2?keywords=sql&qid=1583495868&s=books&sr=1-2"><i
                                                        class="fa fa-link" aria-hidden="true"></i></a></label>

                                        <input name="book_isbn" placeholder="Enter ISBN and Press TAB"
                                               ng-model="book_isbn" ng-blur="look_for_book()"
                                               class="form-control isbn_txt" type="text">

                                    </div>
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Author Name', 'library-management-system'); ?></label>

                                        <input name="book_author" id="book_author" ng-model="book_author"
                                               placeholder="<?php _e('Enter Author Name', 'library-management-system'); ?>"
                                               class="form-control" type="text">

                                    </div>
                                    <div class="form-group mb0 col-sm-12">
                                        <label><?php _e('Book Title', 'library-management-system'); ?> *</label>

                                        <input name="book_title" id="book_title" ng-model="book_title"
                                               placeholder="<?php _e('Enter Book Title', 'library-management-system'); ?>"
                                               class="form-control" type="text">

                                    </div>

                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Category', 'library-management-system'); ?> *</label>

                                        <input name="book_category" tooltips
                                               tooltip-template="<?php _e('Categories books as per your need.Since it will become the menu in the front end.Make it short and simple.', 'library-management-system'); ?>"
                                               tooltip-side="bottom" id="book_category" ng-model="book_category"
                                               placeholder="<?php _e('Enter Category', 'library-management-system'); ?>"
                                               class="form-control" type="text">

                                    </div>
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Publisher', 'library-management-system'); ?></label>

                                        <input name="book_publisher" id="book_publisher" ng-model="book_publisher"
                                               placeholder="<?php _e('Enter Publisher Name', 'library-management-system'); ?>"
                                               class="form-control" type="text">

                                    </div>

                                    <div class="form-group mb0 col-sm-12">
                                        <label><?php _e('Google Book Url', 'library-management-system'); ?></label>
                                        <input name="book_url" id="book_url" ng-model="book_url"
                                               placeholder="<?php _e('Google Book Preview Will Auto Populate here', 'library-management-system'); ?>"
                                               tooltips
                                               tooltip-template="<?php _e('Google Book Preview Will Auto Populate here if there are no preview available then you can upload pdf book below.', 'library-management-system'); ?>"
                                               tooltip-side="top" class="form-control fix_radius pull-left"
                                               style="width: 94%;height: 37px;" type="text" readonly>
                                        <button class="btn btn-primary fix_radius pull-right" ng-click="visitUrl()"
                                                style="width: 5%;"><i
                                                    class="fa fa-external-link" aria-hidden="true"></i></button>
                                    </div>


                                    <!-- <div class="form-group">
                                        <label for="book_url" class="col-sm-2 control-label">Book Url</label>
                                        <div class="col-sm-8">
                                            <input name="book_url" id="book_url" ng-model="book_url" placeholder="Eg : https://drive.google.com/open?id=0BwiX2HTj2EuFaURvUWcxTERjblU" tooltips tooltip-template="Google Book Preview Will Auto Populate here if there are no preview available then you can upload book in your Gdrive & paste the link here."  tooltip-side="top" class="form-control fix_radius pull-left" style="width: 91%;height: 37px;" type="text">
                                            <button class="btn btn-primary fix_radius pull-right" ng-click="visitUrl()"><i class="fa fa-external-link" aria-hidden="true"></i></button>
                                        </div>
                                    </div> -->

                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Upload Book Img', 'library-management-system'); ?></label>

                                        <input type="file" class="form-control" accept="image/*" id="book_upload_img"
                                               name="book_upload_img" tooltips
                                               tooltip-template="<?php _e('Upload image if no google image preview available.', 'library-management-system'); ?>">

                                    </div>
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Upload Pdf', 'library-management-system'); ?></label>

                                        <input type="file" class="form-control" id="book_upload_pdf"
                                               name="book_upload_pdf" tooltips
                                               tooltip-template="<?php _e('Upload pdf if no preview available.', 'library-management-system'); ?>"
                                               tooltip-side="bottom">

                                    </div>
                                    <div class="form-group mb0 col-sm-12">
                                        <label><?php _e('External Url', 'library-management-system'); ?></label>

                                        <input name="book_external_url" id="book_external_url"
                                               ng-model="book_external_url"
                                               placeholder="<?php _e('Enter exteral url', 'library-management-system'); ?>"
                                               class="form-control fix_radius" type="text" tooltips
                                               tooltip-template="<?php _e('When you enter the external url the user will be redirected to this link instead of a preview.', 'library-management-system'); ?>"
                                               tooltip-side="bottom">

                                    </div>
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Price', 'library-management-system'); ?> *</label>

                                        <input name="book_price" id="book_price" ng-model="book_price"
                                               placeholder="<?php _e('Enter Price', 'library-management-system'); ?>"
                                               class="form-control fix_radius" type="text">

                                    </div>
                                    <div class="form-group mb0 col-sm-6">
                                        <label><?php _e('Quantity', 'library-management-system'); ?> *</label>

                                        <input type="text" id="book_qty" name="book_qty" ng-model="book_qty"
                                               placeholder="<?php _e('Enter Book Quantity', 'library-management-system'); ?>"
                                               class="form-control fix_radius">

                                    </div>
                                    <div class="form-group mb0 col-sm-12">
                                        <label><?php _e('Book Desc', 'library-management-system'); ?></label>

                                        <textarea rows="4" id="book_desc" class="form-control" ng-model="book_desc"
                                                  name="book_desc"
                                                  placeholder="<?php _e('Enter Book Description', 'library-management-system'); ?>"></textarea>

                                    </div>
                                    <div class="form-group md0 col-sm-12" style="    padding-right: 0px;">
                                        <button type="button" ng-click="saveBook()"
                                                class="btn btn-primary fix_radius pmd-ripple-effect pull-right add_btn_book"><span
                                                    class="fa fa-floppy-o"
                                                    style="margin-right: 6px;"></span><?php _e('Add Book', 'library-management-system'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<!-- </div> -->
<?php
get_footer();
?>
<script>
    jQuery(document).ready(function ($) {
        if (wp.media) {
            wp.media.view.Modal.prototype.on('open', function () {
                console.log('media modal open');
            });
        }
    });
</script>