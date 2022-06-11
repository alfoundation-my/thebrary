<?php
/* Template Name: ManageReturnArchive Page */

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
            <li class="active"><?php _e('View All Archive Books', 'library-management-system');?></li>
        </ol>
    </section>


    <section class="content" style="min-height: 100%;">

        <div class="box box-default" ng-controller="archiveReturnCtrl">
            <div class="box-header with-border">
            </div>
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-12">


                        <div class="" style="padding-bottom: 7px;">
                            <form class="form-inline">
                                <label class="sr-only"><?php _e('User ID', 'library-management-system');?></label>
                                <div class="input-group col-md-3 col-xs-12">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-model="search.UserId"
                                           id="filter_userId" placeholder="<?php _e('Type User ID', 'library-management-system');?>">
                                </div>

                                <label class="sr-only"><?php _e('Book ID', 'library-management-system');?></label>
                                <div class="input-group col-md-3 col-xs-12">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-model="search.BookId"
                                           id="filter_BookID" placeholder="<?php _e('Type Book ID', 'library-management-system');?>">
                                </div>

                                <label class="sr-only"><?php _e('Persons Name', 'library-management-system');?></label>
                                <div class="input-group col-md-5 col-xs-12">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-model="search.UserName"
                                           id="filter_UserName" placeholder="<?php _e('Type Persons Name', 'library-management-system');?>">
                                </div>


                            </form>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped common_dt"
                                   style="font-size: small; margin-bottom: 0px;">
                                <thead>
                                <tr>
                                    <th style="display:none;">?</th>
                                    <th class="mr_bid" style=""><?php _e('Book ID', 'library-management-system');?></th>
                                    <th class="mr_bname" style=""><?php _e('Book Name', 'library-management-system');?></th>
                                    <th class="mr_sid" style=""><?php _e('User ID', 'library-management-system');?></th>
                                    <th class="mr_sname" style=""><?php _e('Person Name', 'library-management-system');?></th>
                                    <th class="mr_idate" style=""><?php _e('Issued Date', 'library-management-system');?></th>
                                    <th class="mr_dd" style=""><?php _e('Date Due', 'library-management-system');?></th>
                                    <th class="mr_rd" style=""><?php _e('Date Returned', 'library-management-system');?></th>
                                    <th class="mr_status" style=""><?php _e('Status', 'library-management-system');?></th>
                                    <th class="" style="display:none;"></th>
                                    <th class="mr_fine" style=""><?php _e('Fine', 'library-management-system');?></th>
                                    <th class="mr_note" style=""><?php _e('Note', 'library-management-system');?></th>
                                </tr>
                                </thead>
                                <tbody id="tb_manage_issue_book_container">
                                <tr ng-show="issue_book_db.length"
                                    ng-repeat="x in issue_book_db | filter:search | filter:{BookName:''}"
                                    ng-class="x.DelayedDay < 0 ? 'delayed_book' : ''">
                                    <td style="display:none;"></td>
                                    <td class="mr_bid">{{x.BookId}}</td>
                                    <td class="mr_bname">{{x.BookName}}</td>
                                    <td class="mr_sid">{{x.UserId}}</td>
                                    <td class="mr_sname">{{x.UserName}}</td>
                                    <td class="mr_idate">{{x.DateBorrowed | cmdate:'dd-MM-yyyy'}}</td>
                                    <td class="mr_dd">{{x.DateToReturn | cmdate:'dd-MM-yyyy'}}</td>
                                    <td class="mr_rd">{{x.DateReturned | cmdate:'dd-MM-yyyy'}}</td>
                                    <td class="mr_status">{{x.DelayedDay}}</td>
                                    <td style="display:none;">{{x.DateToReturn}}</td>
                                    <td class="mr_fine">{{x.Fine}}</td>
                                    <td class="mr_note">{{x.Notes || '-'}}</td>
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
