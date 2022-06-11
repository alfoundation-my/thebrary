<?php
/* Template Name: ManageFines Page */
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
        <li class="active"><?php _e( 'Manage Fines', 'library-management-system' );?></li>
      </ol>
    </section>


    <section class="content">

      <div class="box box-default" ng-controller="managementofFinesCtrl">
        <div class="box-header with-border">
        </div>
        <div class="box-body" style="">
          <div class="row">
            <div class="col-md-12">
              <div class="mng_fine_filter" style="padding-bottom: 7px;">
                <form class="form-inline">
                  <label class="sr-only"><?php _e( 'ID', 'library-management-system' );?></label>
                  <div class="input-group col-md-3 col-xs-12">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.UserId"
                           id="filter_userId" placeholder="<?php _e( 'Type Persons ID', 'library-management-system' );?>">
                  </div>

                  <label class="sr-only"><?php _e( 'ID', 'library-management-system' );?></label>
                  <div class="input-group col-md-3 col-xs-12" style="float: right;">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.BookId"
                           id="filter_BookID" placeholder="<?php _e( 'Type Book ID', 'library-management-system' );?>">
                  </div>

                  <label class="sr-only"><?php _e( 'Persons Name', 'library-management-system' );?></label>
                  <div class="input-group col-md-3 col-xs-12" style="float: right;">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <input type="text" class="form-control fix_radius" ng-model="search.UserName"
                           id="filter_UserName" placeholder="<?php _e( 'Type Name', 'library-management-system' );?>">
                  </div>


                  <label class="sr-only"><?php _e( 'Month', 'library-management-system' );?></label>
                  <div class="input-group col-md-3 col-xs-12" style="float: right;">
                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                            aria-hidden="true"></i>
                    </div>
                    <select name="filter_m_y" id="filter_m_y" class="form-control selectpicker">
                      <option value="" selected><?php _e( 'All', 'library-management-system' );?></option>
                      <option value="l30"><?php _e( 'Last 30 Days', 'library-management-system' );?></option>
                      <option value="l3m"><?php _e( 'Last 3 Months', 'library-management-system' );?></option>
                      <option value="l6m"><?php _e( 'Last 6 Months', 'library-management-system' );?></option>
                      <option value="l1y"><?php _e( 'Last 1 Years', 'library-management-system' );?></option>
                      <option value="tm"><?php _e( 'This Month', 'library-management-system' );?></option>
                      <option value="ty"><?php _e( 'This Years', 'library-management-system' );?></option>
                    </select>
                  </div>


                </form>

              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped tbl_fine_dt"
                       style="font-size: small; margin-bottom: 0px;">
                  <thead>
                  <tr>
                    <th style="display:none;">?</th>
                    <th class="fin_bid" style="">Book ID</th>
                    <th class="fin_bookname" style="width: 270px;">Book Name</th>
                    <th class="fin_Stid" style="">User ID</th>
                    <th class="fin_sname" style="">Name</th>
                    <th class="fin_iss_date" style="">Issued Date</th>
                    <th class="fin_date_due" style="">Date Due</th>
                    <th class="fin_delayed_by" style="">Delayed By</th>
                    <th class="fin_fine" style="">Fine</th>
                    <th class="fin_notes" style="">Notes</th>
                    <th class="fin_Actions" style="">Action</th>
                  </tr>
                  </thead>
                  <tbody id="tb_manage_issue_book_container">
                  <tr ng-show="issue_book_db.length" ng-repeat="x in issue_book_db | filter:search">
                    <td style="display:none;"></td>
                    <td class="fin_bid">{{x.BookId}}</td>
                    <td class="fin_bookname">{{x.BookName}}</td>
                    <td class="fin_Stid">{{x.UserId}}</td>
                    <td class="fin_sname">{{x.UserName}}</td>
                    <td class="fin_iss_date">{{x.DateBorrowed | cmdate:'dd-MM-yyyy'}}</td>
                    <td class="fin_date_due">{{x.DateToReturn | cmdate:'dd-MM-yyyy'}}</td>
                    <td class="fin_delayed_by">{{x.DelayedDay}}</td>
                    <td class="fin_fine">{{x.Fine}}</td>
                    <td class="fin_notes">{{x.Notes}}</td>
                    <td class="fin_Actions">
                      <button class="btn btn-warning fix_radius" ng-click="btn_view(x,$index)"><span
                            class="fa fa-television"></span></button>
                    </td>
                  </tr>

                  </tbody>

                </table>

                <div id="fnd_detail_holder" class="col-sm-12"
                     style="border: 1px solid lightgray;margin-bottom: 9px;">
                  <div ng-show="issue_book_db.length" class="col-sm-12">
                    <div style="font-size: 20px;text-align: right;border-right: 1px solid lightgray;"
                         class="col-sm-10">Total
                    </div>
                    <div style="text-align:left;color: #099033;font-size: 20px;" class="col-sm-2">
                      {{total}}
                    </div>
                  </div>
                </div>


              </div>


              <div class="modal fade" id="editReturnBookData" tabindex="-1" role="dialog"
                   aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog lg-modal" style="width:40%;">
                  <div class="modal-content fix_radius">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span><span class="sr-only">Close</span>
                      </button>
                      <h3 class="modal-title" id="lineModalLabel">Return Books Fines
                        Mangement</h3>
                    </div>
                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                      <div class="row">
                        <div class="holder_sub_book_lst">
                          <table class="table table-bordered tbl_book_lst">
                            <tbody>
                            <tr>

                              <td style="padding: 13px;font-size: large;">
                                  <?php echo get_option("local_currency", "Rs."); ?>
                              </td>
                              <td>
                                <input type="text" id="fine" placeholder="Fine if Any.."
                                       ng-model="fine" class="form-control fix_radius">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                                                <textarea rows="2" id="notes" ng-model="notes"
                                                                          class="form-control fix_radius"
                                                                          placeholder="Note if any"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div style="float:right;">
                                  <button class="btn btn-primary fix_radius"
                                          ng-click="btn_UpdateRecord()">Update Record
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
                            aria-hidden="true">×</span><span class="sr-only">Close</span>
                      </button>
                      <h3 class="modal-title" id="lineModalLabel">Send Sms</h3>
                    </div>
                    <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                      <div class="row">
                        <div class="holder_sub_book_lst">
                          <div class="table-responsive">
                            <table class="table table-bordered tbl_book_lst">
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
                                                                          placeholder="Sms Body"></textarea>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <div style="float:right;">
                                    <button class="btn btn-primary fix_radius"
                                            ng-click="btn_sendSms()">Send Sms
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
        </div>

        <div class="box-footer">
        </div>
      </div>
    </section>
  </div>


<?php
get_footer();
?>