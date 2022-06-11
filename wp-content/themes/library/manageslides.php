<?php
/* Template Name: ManageSlides Page */
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
                <li><a href="#"><i class="fa fa-dashboard"></i><?php _e('Home', 'library-management-system');?></a></li>
                <li class="active"><?php _e('Manage Slides', 'library-management-system');?></li>
            </ol>
        </section>
        <section class="content" style="min-height: 100%;">

            <div class="box box-default" ng-controller="saveSlidesCtrl">
                <div class="box-header with-border">
                </div>
                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">

                            <div class="col-md-12 pull-left bck_white">
                                <form class="form-inline" id="frm_ManageSlides" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="manage_slides">
                                    <input type="hidden" name="todo" value="addslide">
                                    <table class="table table-condensed" style="margin-bottom: 3px;width: 35%;">
                                        <tbody>
                                        <tr>
                                            <td class="col-md-2">
                                                <input type="file" accept="image/*" class="form-control" id="slide"
                                                       name="slide" ng-model="slide"/>
                                            </td>
                                            <td class="col-md-1">
                                                <button ng-click="addSlide()" style="width:100%;"
                                                        class="btn btn-primary fix_radius">{{btn_text}}
                                                </button>
                                            </td
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered"
                                       style="font-size: small; margin-bottom: 0px;   padding: 10px;">
                                    <thead>
                                    <th class=""><?php _e('Slides', 'library-management-system');?></th>
                                    <th class=""><?php _e('Action', 'library-management-system');?></th>
                                    </thead>
                                    <tbody id="tblBodyCourse">
                                    <tr ng-show="full_slides.length!=0" ng-repeat="slide in full_slides">
                                        <td class="hide">{{slide.id}}</td>
                                        <td class="slide_img_holder" style="width: 80%;">
                                            <div class="brnd_img_holder">
                                                <img src="{{slide.img_url}}" class="img-responsive"></div>
                                        </td>
                                        <td style="width: 20%">
                                            <button class="btn btn-warning" ng-click="editSlide(slide)"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger" ng-click="delSlide(slide)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" ng-show="full_slides.length==0"><?php _e('No slides added yet', 'library-management-system');?></td>
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
