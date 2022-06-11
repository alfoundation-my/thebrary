<?php
/* Template Name: ManageOnlineDues Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 25/05/2018
 * Time: 6:17 PM
 */
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
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system'); ?></a>
                </li>
                <li class="active"><?php _e('List Of Dues Paid Books', 'library-management-system'); ?></li>
            </ol>
        </section>


        <section class="content" style="min-height: 100%;">


            <div class="box box-default" ng-controller="duepaidCtrl">
                <div class="box-header with-border">

                </div>

                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-12">
                            <span><b><?php _e('Note', 'library-management-system'); ?>
                                    : </b><?php _e('This page is used to approve the due payment which the user makes online & only approve the payment if he return the book/s to you.After you approve his/her payment the book gets added back to the system. Note this action is irreversible.', 'library-management-system'); ?></span>
                            <div class="table-responsive">
                                <table class="table table-bordered mng_dues_cls"
                                >
                                    <thead>
                                    <tr>
                                        <th style="display: none;">?</th>
                                        <th class=""><?php _e('Inv Id', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Currency', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PaymentId', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PayerId', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PayerEmail', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PayerPhone', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Payed Amount', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Payment Status', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('BookId', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('UserId', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Issued Date', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Due Date', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PayedForDays', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('PerDayFine', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Mode', 'library-management-system'); ?></th>
                                        <th class=""><?php _e('Time', 'library-management-system'); ?></th>
                                        <th><?php _e('Action', 'library-management-system'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tb_managedue_container">
                                    <tr ng-repeat="x in due_lst">
                                        <td style="display: none;">{{x.Id}}</td>
                                        <td>{{x.InvoiceNo}}</td>
                                        <td>{{x.Currency}}</td>
                                        <td>{{x.PaymentId}}</td>
                                        <td>{{x.PayerId}}</td>
                                        <td>{{x.PayerEmail}}</td>
                                        <td>{{x.PayerPhone}}</td>
                                        <td>{{x.PayedAmount}}</td>
                                        <td>{{x.PaymentStatus}}</td>
                                        <td>{{x.BookId}}</td>
                                        <td>{{x.UserId}}</td>
                                        <td>{{x.IssuedDate}}</td>
                                        <td>{{x.DateDue}}</td>
                                        <td>{{x.PayedForDays}}</td>
                                        <td>{{x.PerDayFine}}</td>
                                        <td>{{x.PaymentMode}}</td>
                                        <td>{{x.CreatedTime}}</td>
                                        <td>
                                            <button ng-disabled="x.ApprovedStatus=='Approved'"
                                                    ng-click="updateStatus(x)"
                                                    class="btn btn-primary"><i class="fa fa-check"
                                                                               aria-hidden="true"></i></button>

                                        </td>
                                    </tr>
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