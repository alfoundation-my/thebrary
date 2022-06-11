<?php
/* Template Name: ManageIssuedBook Page */
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
        <li class="active"><?php _e( 'Manage Issued Books', 'library-management-system' );?></li>
      </ol>
    </section>
    <section class="content" style="min-height: 100%;">
      <div class="box box-default" ng-controller="managementofissuedbooksCtrl">
        <div class="box-header with-border">
        </div>
        <div class="box-body" style="">
          <div class="row">
            <div class="col-md-12">

              <div class="mng_issued_book_filter" style="padding-bottom: 7px;">
                <form class="form-inline">
                  <label class="sr-only"><?php _e( 'ID', 'library-management-system' );?></label>
                  <div class="input-group col-md-4 col-xs-12">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.UserId"
                           id="filter_userId" placeholder="<?php _e( 'Type User ID', 'library-management-system' );?>">
                  </div>

                  <label class="sr-only"><?php _e( 'ID', 'library-management-system' );?></label>
                  <div class="input-group col-md-4 col-xs-12" style="float: right;">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.BookId"
                           id="filter_BookID" placeholder="<?php _e( 'Type Book ID', 'library-management-system' );?>">
                  </div>

                  <label class="sr-only"><?php _e( 'Persons Name', 'library-management-system' );?></label>
                  <div class="input-group col-md-4 col-xs-12" style="float: right;">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.UserName"
                           id="filter_UserName" placeholder="<?php _e( 'Type Persons Name', 'library-management-system' );?>">
                  </div>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table_issued_book common_dt"
                       style="font-size: small; margin-bottom: 0px;">
                  <thead>
                  <tr>
                    <th style="display:none;">?</th>
                    <th class="misb_bid" style=""><?php _e( 'Book ID', 'library-management-system' );?></th>
                    <th class="misb_bname" style="width: 270px;"><?php _e( 'Book Name', 'library-management-system' );?></th>
                    <th class="misb_userid" style=""><?php _e( 'User ID', 'library-management-system' );?></th>
                    <th class="misb_username" style=""><?php _e( 'Person Name', 'library-management-system' );?></th>
                    <th style=""><?php _e( 'Issued Date', 'library-management-system' );?></th>
                    <th style=""><?php _e( 'Date Due', 'library-management-system' );?></th>
                    <th class="misb_userstatus" class="tbl_status" style=""><?php _e( 'Status', 'library-management-system' );?></th>
                    <th style="width: 120px;"><?php _e( 'Action', 'library-management-system' );?></th>
                  </tr>
                  </thead>
                  <tbody id="tb_manage_issue_book_container">
                  <tr ng-show="issue_book_db.length" ng-repeat="x in issue_book_db | filter:search"
                      ng-class="diffDate(x.DateToReturn) < 0 ? 'delayed_book' : ''">
                    <td style="display:none;"></td>
                    <td class="misb_bid">{{x.BookId}}</td>
                    <td class="misb_bname">{{x.BookName}}</td>
                    <td class="misb_userid">{{x.UserId}}</td>
                    <td class="misb_username">{{x.UserName}}</td>
                    <td>{{x.DateBorrowed | cmdate:'dd-MM-yyyy'}}</td>
                    <td>{{x.DateToReturn | cmdate:'dd-MM-yyyy'}}</td>
                    <td class="tbl_status misb_userstatus">{{diffDate(x.DateToReturn)}}
                    <td>
                      <button class="btn btn-warning fix_radius" ng-click="btn_view(x)"><span
                            class="fa fa-television"></span></button>
                      <button type="button" ng-click="viewSmsModal(x)"
                              class="btn btn-danger fix_radius"><span
                            class="fa fa-envelope-o"></span></button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal fade" id="editReturnBookData" tabindex="-1" role="dialog"
                   aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog lg-modal" style="width:40%;">
                  <div class="modal-content fix_radius">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span><span class="sr-only"><?php _e( 'Close', 'library-management-system' );?></span>
                      </button>
                      <h3 class="modal-title" id="lineModalLabel"><?php _e( 'Return Books Management', 'library-management-system' );?></h3>
                    </div>
                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                      <div class="row">
                        <div class="holder_sub_book_lst">
                          <table class="table table-bordered tbl_book_lst">
                            <tbody>
                            <tr>
                              <td>
                                <input type="text" placeholder="<?php _e( 'Select return date', 'library-management-system' );?>"
                                       id="date_of_return" ng-model="date_of_return"
                                       class="form-control fix_radius">
                              </td>
                              <td style="padding: 13px;font-size: large;">
                                  <?php echo get_option("local_currency", "Rs."); ?>
                              </td>
                              <td>
                                <input type="text" id="fine" placeholder="<?php _e( 'Fine if Any.', 'library-management-system' );?>"
                                       ng-model="fine" class="form-control fix_radius">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                                                <textarea rows="2" id="note_on_return"
                                                                          ng-model="note_on_return"
                                                                          class="form-control fix_radius"
                                                                          placeholder="<?php _e( 'Note if any.', 'library-management-system' );?>"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div style="float:right;">
                                  <button class="btn btn-primary fix_radius"
                                          ng-click="btn_returnBook()"><?php _e( 'Return Book', 'library-management-system' );?>
                                  </button>
                                </div>
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
              <div class="modal fade" id="sendSmsModal" tabindex="-1" role="dialog"
                   aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog lg-modal" style="width:40%;">
                  <div class="modal-content fix_radius">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span><span class="sr-only"><?php _e( 'Close', 'library-management-system' );?></span>
                      </button>
                      <h3 class="modal-title" id="lineModalLabel"><?php _e( 'Send', 'library-management-system' );?> {{todo}}</h3>
                    </div>
                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                      <div class="row">
                        <div class="holder_sub_book_lst">
                          <style type="text/css">
                            .toggle.btn {
                              min-width: 121px;
                            }
                          </style>
                          <div
                              style="padding-left: 2%;padding-bottom: 6%;margin-left: 2%;border-bottom: 1px solid lightgrey;margin-bottom: 8px;">

                            <div style="width: 20%;    float: left;">
                              <input type="radio" name="radiotodo" class="rtodo"
                                     value="sms"/><?php _e( 'Send Sms', 'library-management-system' );?> <br/></div>
                            <div style="width: 50%;    float: left;"><input type="radio"
                                                                            name="radiotodo"
                                                                            class="rtodo"
                                                                            value="email"
                                                                            checked="true"/>
                              <?php _e( 'Send Email', 'library-management-system' );?> <br/></div>
                          </div>


                          <table class="table table-bordered tbl_book_lst" id="i_sendemail">
                            <tbody>
                            <tr>
                              <td>
                                <div class="input-group" style="width: 100%;">
                                  <input type="text" id="s_email" ng-model="s_email"
                                         class="form-control fix_radius"
                                         ng-readonly="email_status">
                                  <span class="input-group-addon edt_mob_ret"
                                        ng-click="edit_email()">
				<i class="fa fa-pencil-square-o"></i>
			</span>
                                </div>
                              </td>

                            </tr>
                            <tr>
                              <td>
                                                                <textarea rows="2" id="email_body" ng-model="email_body"
                                                                          class="form-control fix_radius"
                                                                          placeholder="<?php _e( 'Email Body', 'library-management-system' );?>"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div style="float:right;">
                                  <button class="btn btn-primary fix_radius"
                                          ng-click="btn_sendEmail()"><?php _e( 'Send Email', 'library-management-system' );?>
                                  </button>
                                </div>
                              </td>
                            </tr>
                            </tbody>
                          </table>
                          <table class="table table-bordered tbl_book_lst" id="i_sendsms">
                            <tbody>
                            <tr>
                              <td>
                                <div class="input-group">
                                  <input type="text" id="sms_mob" ng-model="sms_mob"
                                         class="form-control fix_radius"
                                         ng-readonly="sms_mob_status">
                                  <span class="input-group-addon edt_mob_ret"
                                        ng-click="reset_sms_mob()">
				<i class="fa fa-pencil-square-o"></i>
			</span>
                                </div>
                              </td>

                            </tr>
                            <tr>
                              <td>
                                                                <textarea rows="2" id="sms_body" ng-model="sms_body"
                                                                          class="form-control fix_radius"
                                                                          placeholder="<?php _e( 'Sms Body', 'library-management-system' );?>"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div style="float:right;">
                                  <button class="btn btn-primary fix_radius"
                                          ng-click="btn_sendSms()"><?php _e( 'Send Sms', 'library-management-system' );?>
                                  </button>
                                </div>
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