<?php
/* Template Name: ManageBook Page */
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
            <form method="post" target="_blank" action="<?php echo home_url() . "/export-books" ?>">
                <button type="submit"
                        class="btn btn-primary btn-sm btn_sm_export"><?php _e('Export Books', 'library-management-system'); ?></button>
            </form>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a></li>
            <li class="active"><?php _e('Manage Books', 'library-management-system'); ?></li>
        </ol>
    </section>


    <section class="content" style="min-height: 100%;">


        <div class="box box-default" ng-controller="managementofbooksCtrl">
            <div class="box-header with-border">

            </div>

            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-12">

                        <div class="" style="padding-bottom: 7px;">
                            <form class="form-inline">

                                <label class="sr-only"
                                       for="inlineFormBookId"><?php _e('Book Name', 'library-management-system'); ?></label>
                                <div class="input-group col-md-6 col-xs-12" style="float: left;">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-change="onBookName()"
                                           ng-model="filter_BookName" id="inlineFormBookName"
                                           placeholder="<?php _e('Type Book Name', 'library-management-system'); ?>">
                                </div>


                                <label class="sr-only"
                                       for="inlineFormUserID"><?php _e('ISBN', 'library-management-system'); ?></label>
                                <div class="input-group col-md-6 col-xs-12">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-change="onISBNChange()"
                                           ng-model="filter_ISBN" id="inlineFormISBN"
                                           placeholder="<?php _e('Type ISBN', 'library-management-system'); ?>">
                                </div>


                            </form>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mng_book_cls"
                            >
                                <thead>
                                <tr>
                                    <th style="display:none;">?</th>
                                    <th class=""><?php _e('ISBN', 'library-management-system'); ?></th>
                                    <th class=""><?php _e('Cover Image', 'library-management-system'); ?></th>
                                    <th class=""><?php _e('Book Name', 'library-management-system'); ?></th>

                                    <th class="book_desc_mng"><?php _e('Book Desc', 'library-management-system'); ?></th>
                                    <th class="book_cat_mng"><?php _e('Category', 'library-management-system'); ?></th>
                                    <th class="book_price_mng"><?php _e('Price', 'library-management-system'); ?></th>
                                    <th class="book_qty_mng"><?php _e('Qty', 'library-management-system'); ?></th>
                                    <th class="book_borr_mng"><?php _e('Borrowed', 'library-management-system'); ?></th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tb_managebook_container">

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="editBookData" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog lg-modal" style="width:40%;">
                                <div class="modal-content fix_radius">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span><span
                                                    class="sr-only"><?php _e('Close', 'library-management-system'); ?></span>
                                        </button>
                                        <h3 class="modal-title"
                                            id="lineModalLabel"><?php _e('Manage Books', 'library-management-system'); ?></h3>
                                    </div>
                                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                                        <div class="row">
                                            <div class="holder_sub_book_lst">
                                                <table class="table table-bordered tbl_book_lst"
                                                       style="margin-left: 2%;">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="3">Note : These are all the unique book ids of this
                                                            book called <b>{{selected_Book_Name}}</b> you can write them
                                                            behind the books so as to identify them.These ids will be
                                                            needed when you are issuing the book to users.If any books
                                                            is lost you can deactivate it.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <input type="text" ng-model="search.BookId"
                                                                   placeholder="Enter Book Id"
                                                                   class="form-control fix_radius"
                                                                   style="width: 100%;float: left;">
                                                            <div style="float:right;width:23%;">

                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr ng-repeat="x in sub_book_data | filter:search">
                                                        <td style="text-align:center;padding: 14px;">{{x.BookId}}</td>
                                                        <td style="text-align: center;padding: 12px;">
                                                            {{selected_Book_Name}}
                                                        </td>
                                                        <td style="text-align: center;padding: 7px;">
                                                            <toggle ng-model="demo.toggleValue[x.BookId]"
                                                                    ng-init="demo.toggleValue[x.BookId] = (x.Active=='0') ? false : true"
                                                                    ng-change="onBookchanged(x)" on="Active"
                                                                    off="Deactive"></toggle>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="editSelectedBookData" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog lg-modal" style="width:40%;">
                                <div class="modal-content fix_radius">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span><span
                                                    class="sr-only"><?php _e('Close', 'library-management-system'); ?></span>
                                        </button>
                                        <h3 class="modal-title"
                                            id="lineModalLabel"><?php _e('Edit Books', 'library-management-system'); ?></h3>
                                    </div>
                                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                                        <div class="row">
                                            <div class="holder_sub_book_lst">
                                                <form id="frmUpdateBookDetails">
                                                    <input type="hidden" name="action"
                                                           value="update_specific_parent_book">
                                                    <input type="hidden" name="selected_book_id" id="selected_book_id">


                                                    <table class="table table-bordered tbl_book_lst"
                                                           style="margin-left: 2%;">
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="2"><input type="text"
                                                                                   placeholder="<?php _e('Enter Book Title', 'library-management-system'); ?>"
                                                                                   name="selected_book_title"
                                                                                   id="selected_book_title"
                                                                                   ng-model="selected_book_title"
                                                                                   class="form-control fix_radius"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" placeholder="Enter Publisher"
                                                                       name="selected_book_publisher"
                                                                       id="selected_book_publisher"
                                                                       ng-model="selected_book_publisher"
                                                                       class="form-control fix_radius">
                                                            </td>

                                                            <td>
                                                                <input type="text" name="select_book_category"
                                                                       id="select_book_category"
                                                                       placeholder="<?php _e('Enter Book Category', 'library-management-system'); ?>"
                                                                       tooltips
                                                                       tooltip-template="<?php _e('This can be used to group books.', 'library-management-system'); ?>"
                                                                       tooltip-side="bottom"
                                                                       ng-model="select_book_category"
                                                                       class="form-control fix_radius">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" id="select_book_author"
                                                                       name="select_book_author"
                                                                       placeholder="<?php _e('Enter Author', 'library-management-system'); ?>"
                                                                       ng-model="select_book_author"
                                                                       class="form-control fix_radius">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="select_book_price"
                                                                       id="select_book_price"
                                                                       placeholder="<?php _e('Enter Price', 'library-management-system'); ?>"
                                                                       ng-model="select_book_price"
                                                                       class="form-control fix_radius">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--                                                                <input type="text" name="select_book_img"-->
                                                                <!--                                                                       id="select_book_img" tooltips-->
                                                                <!--                                                                       tooltip-template="Enter Image Url."-->
                                                                <!--                                                                       tooltip-side="bottom"-->
                                                                <!--                                                                       placeholder="Enter Image Url"-->
                                                                <!--                                                                       ng-model="select_book_img"-->
                                                                <!--                                                                       class="form-control fix_radius">-->
                                                                <input type="hidden" name="select_book_img"
                                                                       id="select_book_img" value=""/>
                                                                <input type="file" accept="image/*" tooltips
                                                                       tooltip-template="<?php _e('Upload Book Cover', 'library-management-system'); ?>"
                                                                       tooltip-side="bottom" name="book_img_upload"
                                                                       class="form-control"
                                                                       id="book_img_upload">
                                                            </td>

                                                            <td>
                                                                <!--                                                                <input type="text" name="select_book_preview_lnk"-->
                                                                <!--                                                                       id="select_book_preview_lnk"-->
                                                                <!--                                                                       placeholder="Enter Book Pdf Url Or Attach any Document File from Google Drive"-->
                                                                <!--                                                                       tooltips-->
                                                                <!--                                                                       tooltip-template="Enter Book Pdf Url Or Attach any Document File from Google Drive."-->
                                                                <!--                                                                       tooltip-side="bottom"-->
                                                                <!--                                                                       ng-model="select_book_preview_lnk"-->
                                                                <!--                                                                       class="form-control fix_radius">-->
                                                                <input type="hidden" name="select_book_preview_lnk"
                                                                       value=""
                                                                       id="select_book_preview_lnk"/>
                                                                <input type="file" tooltips
                                                                       tooltip-template="<?php _e('Upload Book Preview pdf file', 'library-management-system'); ?>"
                                                                       tooltip-side="bottom" class="form-control"
                                                                       name="book_pdf_upload"
                                                                       id="book_pdf_upload">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <input type="text" name="select_book_external_url"
                                                                       id="select_book_external_url"
                                                                       placeholder="<?php _e('Enter any external url if you want user to redirect to it when book is clicked on front page', 'library-management-system'); ?>"
                                                                       tooltips
                                                                       tooltip-template="<?php _e('Enter any external url if you want user to redirect to it when book is clicked on front page', 'library-management-system'); ?>"
                                                                       tooltip-side="bottom"
                                                                       ng-model="select_book_external_url"
                                                                       class="form-control fix_radius">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <textarea rows="5" name="selected_book_desc"
                                                                          id="selected_book_desc"
                                                                          ng-model="selected_book_desc"
                                                                          class="form-control fix_radius"
                                                                          placeholder="<?php _e('Note if any', 'library-management-system'); ?>"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div style="float:right;">
                                                                    <button class="btn btn-primary fix_radius pmd-ripple-effect"
                                                                            ng-click="btn_updateBookInfo()"><?php _e('Update Book Details', 'library-management-system'); ?>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>

                                                    </table>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
