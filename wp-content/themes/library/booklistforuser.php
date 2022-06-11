<?php
/* Template Name: BookListForUsers Page */

if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>

<?php
get_sidebar("user");
?>


<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?php _e( 'Dashboard', 'library-management-system' );?>
            <small><?php _e( 'Control panel', 'library-management-system' );?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e( 'Home', 'library-management-system' );?></a></li>
            <li class="active"><?php _e( 'Book List For User', 'library-management-system' );?></li>
        </ol>
    </section>


    <section class="content">


        <div class="box box-default" ng-controller="ListofbooksUserCtrl">
            <div class="box-header with-border">


            </div>

            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-12">


                        <div class="" style="padding: 10px;">
                            <form class="form-inline">

                                <label class="sr-only" for="inlineFormBookId"><?php _e( 'Book Name', 'library-management-system' );?></label>
                                <div class="input-group col-md-6" style="float: left;">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-change="onBookName()"
                                           ng-model="filter_BookName" id="inlineFormBookName"
                                           placeholder="<?php _e( 'Type Book Name', 'library-management-system' );?>">
                                </div>


                                <label class="sr-only" for="inlineFormUserID"><?php _e( 'ISBN', 'library-management-system' );?></label>
                                <div class="input-group col-md-6">
                                    <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                                            aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control fix_radius" ng-change="onISBNChange()"
                                           ng-model="filter_ISBN" id="inlineFormISBN" placeholder="<?php _e( 'Type ISBN', 'library-management-system' );?>">
                                </div>


                            </form>

                        </div>


                        <table class="table table-bordered table-striped"
                               style="font-size: small; margin-bottom: 0px;   padding: 10px;">
                            <thead>
                            <tr>
                                <th style="display:none;">?</th>
                                <th class="" style="width: 120px;"><?php _e( 'ISBN', 'library-management-system' );?></th>
                                <th class="" style="width: 155px;"><?php _e( 'Book Name', 'library-management-system' );?></th>
                                <th class="" style="width: 270px;"><?php _e( 'Book Desc', 'library-management-system' );?></th>
                                <th class=""><?php _e( 'Category', 'library-management-system' );?></th>
                                <th class=""><?php _e( 'Price', 'library-management-system' );?></th>
                                <th class=""><?php _e( 'Qty', 'library-management-system' );?></th>
                                <th class=""><?php _e( 'Borrowed', 'library-management-system' );?></th>

                            </tr>
                            </thead>
                            <tbody id="tb_managebook_container">

                            </tbody>
                        </table>


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