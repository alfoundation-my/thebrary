<?php
/* Template Name: RequestBook Page */

if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>


<?php

global $current_user;
$userID = $current_user->ID;
$user_login = $current_user->user_login;
$user_id = get_option('user_id');


?>
<?php


if (current_user_can('administrator')) {
    get_sidebar();
} else {
    get_sidebar("user");
}


?>



<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?php _e( 'Dashboard', 'library-management-system' );?>
            <small> <?php _e( 'Control panel', 'library-management-system' );?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>  <?php _e( 'Home', 'library-management-system' );?></a></li>
            <li class="active"><?php _e( 'Request Books', 'library-management-system' );?></li>
        </ol>
    </section>


    <section class="content" style="min-height: 100%;">


        <div class="box box-default">
            <div class="box-header with-border">

            </div>

            <div class="box-body" style="" ng-controller="viewUserRequestBookCtrl">
                <div class="row">

                    <div class="col-md-9">
                        <form class="form-horizontal" id="lib_request_book">


                            <input type="hidden" name="action" value="request_book">

                            <div class="form-group">
                                <label for="book_name" class="col-sm-3 control-label pull-left reset_sm"><?php _e( 'Book Name *', 'library-management-system' );?></label>
                                <div class="col-sm-9">
                                    <input name="book_name" id="book_name"
                                           placeholder=""
                                           class="form-control <?php _e( 'Full Book Name .Check Below To See If Same Book Has Already Been Requested', 'library-management-system' );?>" type="text">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="book_url" class="col-sm-3 control-label pull-left reset_sm"> <?php _e( 'Google/Amazon
                                    Book Url', 'library-management-system' );?></label>
                                <div class="col-sm-9">
                                    <input name="book_url" id="book_url" placeholder="<?php _e( 'Book Url If Any', 'library-management-system' );?>"
                                           class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note_on_book" class="col-sm-3 control-label pull-left reset_sm"><?php _e( 'Note *', 'library-management-system' );?></label>
                                <div class="col-sm-9">
                                    <textarea rows="5" class="form-control fix_radius" id="note_on_book"
                                              name="note_on_book"
                                              placeholder="<?php _e( 'Why you required this book ? A Small note is required. ', 'library-management-system' );?>"></textarea>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button ng-click="sendRequest()"
                                            class="btn btn-primary fix_radius pull-right pmd-ripple-effect"><span
                                                class="fa fa-floppy-o"></span>&nbsp; <?php _e( 'Submit Request', 'library-management-system' );?>
                                    </button>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbluser"
                                   style="font-size: small;margin-bottom: 0px;overflow-x: scroll;">
                                <thead>
                                <tr>
                                    <th style="display:none;">?</th>
                                    <th class="" style="width: 15%;"> <?php _e( 'Book Name', 'library-management-system' );?></th>
                                    <th class=""> <?php _e( 'Url', 'library-management-system' );?></th>
                                    <th class="" style="width: 45%;"> <?php _e( 'BookDesc', 'library-management-system' );?></th>
                                    <th style="display:none;"> <?php _e( 'User ID', 'library-management-system' );?></th>
                                    <th class="" style="WIDTH: 11%;"> <?php _e( 'Person Name', 'library-management-system' );?></th>
                                    <th class="">Likes (<?php echo get_option('people_to_approve'); ?>)</th>
                                    <th class="" style="width: 9%;"> <?php _e( 'Added On', 'library-management-system' );?></th>
                                    <th class="" style="width: 80px;"> <?php _e( 'Action', 'library-management-system' );?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="9">
                                        <input type="text" ng-model="search.BookName"
                                               placeholder="Type Book Name To Search For Before Placing Request.."
                                               class="form-control">
                                    </td>
                                </tr>
                                <tr ng-repeat="x in request_dataset | filter:search"
                                    ng-class="{'approved_book': x.Approved==1}">
                                    <td style="display:none;">{{x.Id}}</td>
                                    <td>{{x.BookName}}</td>
                                    <td><a target="_blank" href="{{x.BookUrl}}"><?php _e( 'Visit', 'library-management-system' );?></a></td>
                                    <td>{{x.Notes}}</td>
                                    <td style="display:none;">{{x.UserId}}</td>
                                    <td>{{x.UserName}}</td>
                                    <td>{{x.Likes}}</td>
                                    <td>{{x.DateAdded}}</td>
                                    <td>
                                        <button class="btn btn-success" ng-click="like(x)"><i class="fa fa-thumbs-o-up"
                                                                                              aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
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


    });
</script>	