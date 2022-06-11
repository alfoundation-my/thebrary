<?php
/* Template Name: ManagedIssuedBookUsers Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
if (is_admin()) {
    wp_redirect(get_url('dashboard'));
}
get_header();
?>

<?php
get_sidebar("user");
?>


<div class="content-wrapper" ng-controller="managementofissuedbooksUserCtrl">

    <section class="content-header">
        <h1>
            <?php _e('Dashboard', 'library-management-system'); ?>
            <small><?php _e('Control panel', 'library-management-system'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a></li>
            <li class="active"><?php _e('My Issued Books List', 'library-management-system'); ?></li>
        </ol>
    </section>


    <section class="content" style="min-height: 100%;">

        <div class="box box-default">
            <div class="box-header with-border">

            </div>

            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        global $current_user;
                        $user_id = get_user_meta($current_user->ID, 'user_id', true);
                        if ($user_id == null || $user_id == "") {
                            wp_redirect(get_home_url());
                        }
                        ?>
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">

                        <table class="table table-bordered table-striped"
                               style="font-size: small; margin-bottom: 0px;   padding: 10px;">
                            <thead>
                            <tr>
                                <th style="display:none;">?</th>
                                <th ng-show="<?php echo get_option("do_online_payment"); ?>"><?php _e('Action', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Book ID', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Book Name', 'library-management-system'); ?></th>
                                <th style="width: 187px;"><?php _e('Book Desc', 'library-management-system'); ?></th>
                                <th style=""><?php _e('User ID', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Person Name', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Issued Date', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Date Due', 'library-management-system'); ?></th>
                                <th style=""><?php _e('Days To Go', 'library-management-system'); ?></th>

                            </tr>
                            </thead>
                            <tbody id="tb_manage_issue_book_container">
                            <tr ng-show="issue_book_db.length"
                                ng-repeat="x in issue_book_db | filter:{UserId : AjUserId} | filter:query as results"
                                ng-class="{delayed_book: classMng(x.DateToReturn)}">
                                <td style="display:none;"></td>
                                <td ng-show="<?php echo get_option("do_online_payment"); ?>">
                                    <button ng-show="diffDate(x.DateToReturn) < 0 && x.ApprovedStatus==null && x.PaymentStatus==null && x.CustPaymentStatus=='NotPaid'"
                                            ng-click="openPaymentPage(x)" class="btn btn-primary">
                                        Pay Due
                                    </button>
                                    <span style="color: green;font-size: 13px;font-family: monospace;font-style: italic;"
                                          ng-show="x.CustPaymentStatus=='Paid'"
                                    >
                                        Paid | Kindly submit the book to the library asap.
                                    </span>
                                    <span ng-show="diffDate(x.DateToReturn) >= 0"><?php _e('None', 'library-management-system'); ?></span>
                                    <span ng-show="x.PaymentStatus=='Success'"><?php _e('Due Paid', 'library-management-system'); ?>
                                        <br/><span
                                                style="font-size: 11px;color: green;font-weight: bold;"
                                                ng-show="x.ApprovedStatus=='NotApproved'"><?php _e('Waiting Approval', 'library-management-system'); ?>
                                            <br/>
                    <i ng-show="x.ApprovedStatus=='NotApproved'" class="fa fa-info-circle" aria-hidden="true" tooltips
                       tooltip-template="<?php echo get_option('waiting_approval_msg'); ?>"
                       tooltip-side="bottom"></i>
                    </span></span>

                                    <span ng-show="x.PaymentStatus!='Success' && x.PaymentStatus!=null"><?php _e('Payment failed', 'library-management-system'); ?>
                                        <br/>
                  <i class="fa fa-info-circle" aria-hidden="true" tooltips
                     tooltip-template="<?php _e('Something is not right.If you have made the payment you can contact the admin for further queries.', 'library-management-system'); ?>"
                     tooltip-side="bottom"></i>
                  </span>


                                </td>
                                <td>{{x.BookId}}</td>
                                <td>{{x.BookName}}</td>
                                <td>{{x.BookDesc}}</td>
                                <td>{{x.UserId}}</td>
                                <td>{{x.UserName}}</td>
                                <td>{{x.DateBorrowed | cmdate:'dd-MM-yyyy'}}</td>
                                <td>{{x.DateToReturn | cmdate:'dd-MM-yyyy'}}</td>
                                <td>{{diffDate(x.DateToReturn)}}</td>


                            </tr>

                            <tr ng-show="!results.length">
                                <td colspan="9"
                                    style="text-align:center;"><?php _e('No books has been issued yet!.', 'library-management-system'); ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box-footer">
            </div>
        </div>
    </section>


    <div class="modal fade" id="paymentStep1" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog lg-modal" style="width:40%;">
            <div class="modal-content fix_radius">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">×</span><span
                                class="sr-only"><?php _e('Close', 'library-management-system'); ?></span>
                    </button>
                    <h3 class="modal-title"
                        id="lineModalLabel"><?php _e('Payment Details', 'library-management-system'); ?></h3>
                </div>
                <div class="modal-body" style="padding-top: 10px;padding-right: 35px;">
                    <div class="row">
                        <table class="table table-bordered" style="margin: 0 auto; margin-left: 2%;">

                            <!--          <form method="post" action="http://www.ricomart.com/test_lib/resubmitter.php"-->
                            <!--                    target="_blank">-->
                            <form method="post" target="_blank" action="<?php echo home_url() . "/payment-handler" ?>">

                                <input type="hidden" name="currency_code" value="<?php echo get_option("payment_currency_code");?>">
                                <input type="hidden" name="date_due" value="{{date_to_return}}">
                                <input type="hidden" name="issued_date" value="{{date_borrowed}}">
                                <input type="hidden" name="paying_for_days" value="{{delayed_in_days}}">
                                <input type="hidden" name="book_id" value="{{book_id}}">
                                <input type="hidden" name="user_id" value="{{user_id}}">
                                <input type="hidden" name="per_day_fine" value="{{per_day_fine}}">
                                <input type="hidden" name="paid_for_entry" value="{{paid_for_entry}}">
                                <input type="hidden" id="order_id" name="order_id"
                                       value="<?php echo uniqid(); ?>"
                                / >
                                <input type="hidden" id="amount" name="amount" value="{{due_to_pay}}" / >
                                <input type="hidden" name="item_name"
                                       value="Fine UID({{user_id}}) BID({{book_id}})"/>

                                <tbody>
                                <tr>
                                    <td><?php _e('Due to pay', 'library-management-system'); ?></td>
                                    <td><?php echo get_option("local_currency", "Rs"); ?>{{due_to_pay}}</td>
                                </tr>
                                <tr>
                                    <td><?php _e('Mode', 'library-management-system'); ?></td>
                                    <td><?php _e('Online', 'library-management-system'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Delayed Days', 'library-management-system'); ?></td>
                                    <td>{{delayed_in_days}}</td>
                                </tr>
                                <tr>
                                    <td><?php _e('Per Day Fine', 'library-management-system'); ?></td>
                                    <td><?php echo get_option("local_currency", "Rs"); ?>{{per_day_fine}}</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <?php //echo do_shortcode('[wp_paypal button="buynow" name="My product" amount="1.00"]'); ?>
                                        <button class="btn btn-primary btn_pay_due"
                                                type="submit"><?php _e('Pay Now', 'library-management-system'); ?></button>

                                    </td>
                                </tr>
                                </tbody>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php
get_footer();
?>	