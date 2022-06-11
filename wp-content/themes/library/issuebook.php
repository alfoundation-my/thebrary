<?php
/* Template Name: IssueBookUsers Page */
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
      <small><?php _e( 'Control panel', 'library-management-system' );?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
      <li class="active"><?php _e( 'Issue Books', 'library-management-system' );?></li>
    </ol>
  </section>
  <section class="content" style="min-height: 100%;">
    <div class="" ng-controller="issueBookCtrl">
      <div class="box-header with-border">
      </div>
      <div class="box-body" style="">
        <div class="row">
          <div class="col-sm-3">
            <img ng-src="{{vm.picture || '<?php echo get_template_directory_uri() . '/img/270x358.png'; ?>'}}"
                 style="width: 227px;margin: 0 auto;border: 1px solid;" class="img-responsive"
                 alt="Book Cover">
          </div>
          <div class="col-sm-9">
            <form class="form-horizontal" id="lib_issue_book_form">
              <div class="tab-content shadow">
                <div class="tab-pane active">
                  <div class=" panel panel-custom">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <strong><?php _e( 'Issue Books', 'library-management-system' );?></strong>
                      </div>
                    </div>
                    <div class="panel-body form-horizontal">
                      <input type="hidden" name="action" value="issue_book">

                      <div class="form-group mb0 col-sm-12">

                        <label>Book No <a class="book_sht"
                                          style="position: absolute;margin-top: -18px;right: -15px;"
                                          target="_blank" tooltips
                                          tooltip-template="<?php _e( 'Shortcut Manage Books.', 'library-management-system' );?>"
                                          tooltip-side="bottom"
                                          href="<?php echo get_url("manage-books"); ?>"><i
                                class="fa fa-link" aria-hidden="true"></i></a></label>

                        <input name="book_no" tooltips
                               tooltip-template="<?php _e( 'You can find the book no in the Manage Book section.In real life scenerio those book nos needs to be written behind the book to uniquely identify each books.', 'library-management-system' );?>"
                               tooltip-side="bottom" id="book_no" ng-model="book_no"
                               ng-change="onBookNoChange()" placeholder="<?php _e( 'Type Book NO . Eg:4321603', 'library-management-system' );?>"
                               class="form-control" type="text">

                      </div>


                      <div class="form-group mb0 col-sm-12">

                        <label>Book
                          Title</label>

                        <input name="book_title" id="book_title" ng-model="book_title"
                               placeholder="<?php _e( 'Book Title', 'library-management-system' );?>" class="form-control" type="text" disabled>


                      </div>

                      <div class="form-group mb0 col-sm-12">
                        <table class="table table-bordered" ng-show="qty !=null"
                               style="border: 1px solid lightgrey;">
                          <tbody>
                          <tr>
                            <td style="background: beige;"><?php _e( 'Total Oty', 'library-management-system' );?></td>
                            <td>{{qty}}</td>
                            <td style="background: beige;"><?php _e( 'Current Available', 'library-management-system' );?></td>
                            <td>{{$eval(qty)-$eval(borrowed)}}</td>
                            <td style="background: beige;"><?php _e( 'Borrowed', 'library-management-system' );?></td>
                            <td>{{borrowed}}</td>
                          </tr>
                          <tr>
                            <td style="background: beige;"><?php _e( 'Price', 'library-management-system' );?></td>
                            <td><?php echo get_option("local_currency", "Rs."); ?> {{price}}</td>
                            <td style="background: beige;"><?php _e( 'ISBN', 'library-management-system' );?></td>
                            <td colspan="3">{{isbn}}</td>
                          </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="form-group mb0 col-sm-12">
                        <label><?php _e( 'User Id', 'library-management-system' );?></label>
                        <input name="user_id" id="user_id" ng-model="user_id"
                               ng-change="user_idChange()" placeholder="<?php _e( 'Type User ID. Eg : 1001', 'library-management-system' );?>"
                               class="form-control" type="text">
                      </div>


                      <div class="form-group mb0 col-sm-12">

                        <label><?php _e( 'Name', 'library-management-system' );?></label>

                        <input name="user_name" id="user_name" ng-model="user_name"
                               placeholder="<?php _e( 'Persons Name', 'library-management-system' );?>" class="form-control" type="text" disabled>


                      </div>

                      <div class="form-group mb0 col-sm-12">
                        <table class="table table-bordered" ng-show="phone !=null"
                               style="border: 1px solid lightgrey;">
                          <tbody>
                          <tr>
                            <td style="width: 23%;" rowspan="2"><img
                                  ng-src="{{vm.studpic || '<?php echo get_template_directory_uri() . '/img/146x146.png' ?>'}}"
                                  class="img-thumbnail" alt="User PIc"></td>
                            <td style="background: beige;"><?php _e( 'Phone', 'library-management-system' );?></td>
                            <td>{{phone}}</td>
                            <td style="background: beige;"><?php _e( 'Email', 'library-management-system' );?></td>
                            <td>{{email}}</td>
                          </tr>
                          <tr>
                            <td style="background: beige;"><?php _e( 'Address', 'library-management-system' );?></td>
                            <td colspan="4">{{address}}</td>
                          </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="form-group mb0 col-sm-6">
                        <label><?php _e( 'Date Issued', 'library-management-system' );?></label>

                        <input name="book_date_borrowed" ng-model="book_date_borrowed"
                               id="book_date_borrowed" class="form-control fix_radius" type="text">


                      </div>


                      <div class="form-group mb0 col-sm-6">
                        <label><?php _e( 'By when to Return', 'library-management-system' );?></label>

                        <input name="book_date_due" ng-model="book_date_due" id="book_date_due"
                               class="form-control fix_radius" type="text">

                      </div>


                      <div class="form-group mb0 col-sm-12">
                        <button type="button" ng-disabled="btn_issue_status"
                                ng-init="btn_issue_status=true" ng-click="issueBookBtn()"
                                class="btn btn-danger pmd-ripple-effect pull-right">
                          <span class="fa fa-floppy-o"></span><?php _e( 'Issue Book', 'library-management-system' );?>
                        </button>

                      </div>

                    </div>
                  </div>
                </div>

            </form>

          </div>
        </div>
      </div>


    </div>
  </section>
</div>


<?php
get_footer();
?>	