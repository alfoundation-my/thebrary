<?php
/* Template Name: ManageUsers Page */
if (!is_user_logged_in()) {
    wp_redirect(get_home_url());
}
get_header();
?>

<?php
get_sidebar();
?>


<style>
  .ng-camera-overlay {
    display: none;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
       <?php _e('Dashboard', 'library-management-system');?>
      <small> <?php _e('Control panel', 'library-management-system');?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php _e('Home', 'library-management-system');?></a></li>
      <li class="active"> <?php _e('Manage Users', 'library-management-system');?></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default" ng-controller="UserManagementCtrl">
      <div class="box-header with-border">
      </div>
      <div class="box-body" style="">
        <div class="row">
          <div class="col-md-12">
            <div class="" style="padding-bottom:7px;">
              <form class="form-inline">
                <label class="sr-only" for="inlineFormUserID"> <?php _e('User ID', 'library-management-system');?></label>
                <div class="input-group col-md-2 col-xs-12">
                  <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                          aria-hidden="true"></i>
                  </div>
                  <input type="text" ng-change="onChangeUserId()" ng-model="filter_userId"
                         class="form-control fix_radius" id="inlineFormUserID" placeholder="<?php _e('User ID', 'library-management-system');?>">
                </div>


                <label class="sr-only" for="inlineFormUserName"><?php _e('Persons Name', 'library-management-system');?></label>
                <div class="input-group col-md-3 col-xs-12">
                  <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                          aria-hidden="true"></i>
                  </div>
                  <input type="text" ng-change="onChangeUserName()" class="form-control fix_radius"
                         id="inlineFormUserName" ng-model="filter_userName" placeholder="<?php _e('Persons Name', 'library-management-system');?>">
                </div>


                <label class="sr-only" for="inlineFormEmailAddress"> <?php _e('Email', 'library-management-system');?></label>
                <div class="input-group col-md-3 col-xs-12">
                  <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                          aria-hidden="true"></i>
                  </div>
                  <input type="text" ng-change="onChangeEmail()" ng-model="filter_email"
                         class="form-control fix_radius" id="inlineFormEmailAddress"
                         placeholder=" <?php _e('Email Address', 'library-management-system');?>">
                </div>

                <label class="sr-only" for="inlineFormPhone"> <?php _e('Phone', 'library-management-system');?></label>
                <div class="input-group col-md-3 col-xs-12">
                  <div class="input-group-addon fix_radius fix_filter"><i class="fa fa-filter"
                                                                          aria-hidden="true"></i>
                  </div>
                  <input type="text" ng-change="onChangePhone()" ng-model="filter_phone"
                         class="form-control fix_radius" id="inlineFormPhone" placeholder="Phone">
                </div>
              </form>

            </div>

            <div style="overflow:auto;">
              <div class="table-responsive">
                <table class="table table-bordered table-striped tbluser mng_stud_tbl"
                       >
                  <thead>
                  <tr>
                    <th style="display:none;">?</th>
                    <th style="display:none;">?</th>
                    <th style="width: 46px;">ID</th>
                      <th style="width: 25px"> <?php _e('Photo', 'library-management-system');?></th>
                    <th class=""> <?php _e('Name', 'library-management-system');?></th>
                    <th style="width: 162px;"> <?php _e('Email Address', 'library-management-system');?></th>
                    <th class=""> <?php _e('Phone', 'library-management-system');?></th>
                    <th style="width: 188px;"><?php _e('Street Address', 'library-management-system');?></th>
                    <th class=""> <?php _e('Course', 'library-management-system');?></th>
                    <th class=""> <?php _e('Years', 'library-management-system');?></th>
                    <th class=""><?php _e('D.A ', 'library-management-system');?></th>
                    <th class="" style="width: 160px;"> <?php _e('Action', 'library-management-system');?></th>
                  </tr>
                  </thead>
                  <tbody id="user_container">

                  </tbody>
                </table>
              </div>
            </div>

            <div style="float: right;display: none;">
              <nav>
                <ul class="pagination justify-content-end">
                  <li class="page-item">
                    <button class="btn btn-default fix_radius" tabindex="-1"
                            ng-click="btn_previous()"><i class="fa fa-chevron-left"
                                                         aria-hidden="true"></i>  <?php _e('Previous', 'library-management-system');?>
                    </button>
                  </li>
                  <li class="page-item">
                    <button class="btn btn-default fix_radius" ng-model="next_btn"
                            ng-click="btn_next()"> <?php _e('Next', 'library-management-system');?> <i class="fa fa-chevron-right"
                                                          aria-hidden="true"></i></button>
                  </li>
                </ul>
              </nav>
            </div>


            <div class="modal fade" id="editUserModel" tabindex="-1" role="dialog"
                 aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog lg-modal edit_user_modal" style="width: 70%;">
                <div class="modal-content fix_radius">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                          aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title" id="lineModalLabel"> <?php _e('Edit User', 'library-management-system');?></h3>
                  </div>
                  <div class="modal-body" style="padding-top: 10px;    padding-right: 35px;">
                    <div class="row">
                      <?php
                      /* checking if running online & is not https */
                      /* since google chrome has blocked camera modules for wesbites who don't use ssl on servers.*/
                      if (!check_if_running_local() and (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')) {

                      //if (true) {
                          ?>
                      <div class="col-sm-12">
                      <div class="tab-content shadow">
                      <div class="tab-pane active">
                      <div class=" panel panel-custom">
                      <div class="panel-heading">
                      <div class="panel-title">
                      <strong> <?php _e('Upload a new pic', 'library-management-system'); ?></strong>
                      </div>
                      </div>
                      <div class="panel-body form-horizontal">
                      <div class="form-group mb0 col-sm-4">
                      <form id="upload_user_img_edit_form" action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="action" value="save_img_get_id"/>
                      <input type="file" id="upload_img_edit" accept="image/*" style="margin-top: 5%;" name="upload_img"  class="form-control">
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>

                      <?php
                      } else {
                          ?>
                      <div class="col-sm-12">
                        <div class="tab-content shadow">
                          <div class="tab-pane active">
                            <div class=" panel panel-custom">
                              <div class="panel-heading">
                                <div class="panel-title">
                                  <strong> <?php _e('Take a pic', 'library-management-system'); ?></strong>
                                </div>
                              </div>
                              <div class="panel-body form-horizontal">
                                <div class="form-group mb0 col-sm-4">
                                  <label> <?php _e('Camera', 'library-management-system'); ?></label>
                                  <ng-camera
                                      output-height="263"
                                      output-width="308"
                                      image-format="jpeg"
                                      jpeg-quality="100"
                                      action-message="Capture"
                                      snapshot="vm.picture"
                                      flash-fallback-url="<?php bloginfo('template_directory'); ?>/js/webcam.swf"
                                      overlay-url="<?php bloginfo('template_directory'); ?>/img/overlay.png"
                                      shutter-url="<?php bloginfo('template_directory'); ?>/js/shutter.mp3"

                                  ></ng-camera>
                                </div>

                                <div class="form-group mb0 col-sm-4">
                                  <label> <?php _e('Old Pic', 'library-management-system'); ?></label>
                                  <img style="width: 100%;height: 229px; margin-top: 15px;" ng-if=" vm.oldpicture"
                                       ng-src="{{vm.oldpicture}}" alt="User Pic"
                                       class="img-responsive">
                                </div>

                                <div class="form-group mb0 col-sm-4">
                                  <label><?php _e('New Pic will Appear here', 'library-management-system'); ?></label>
                                  <img ng-if="vm.picture" ng-src="{{vm.picture}}"
                                       ng-model="user_pic" alt="User Pic"
                                       class="img-responsive" style="width: 100%;height: 229px; margin-top: 15px;">
                                  <img
                                      ng-src="<?php echo get_template_directory_uri() . '/img/avatar_new.png'; ?>"
                                      ng-show="vm.picture ==''" class="img-responsive"
                                      style="width: 100%;height: 229px; margin-top: 15px;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                      } ?>
                      <div class="col-sm-12"
                      >
                        <form class="form-horizontal" id="lib_edit_user_profile_form">
                          <div class="tab-content shadow">
                            <div class="tab-pane active">
                              <div class=" panel panel-custom">
                                <div class="panel-heading">
                                  <div class="panel-title">
                                    <strong> <?php _e('Update Details', 'library-management-system');?></strong>
                                  </div>
                                </div>
                                <div class="panel-body form-horizontal">
                                  <input type="hidden" name="action" value="updateUserTodb">
                                  <input type="hidden" name="photo_code" id="photo_code">
                                  <input type="hidden" name="old_pic_id" id="old_pic_id">
                                  <input type="hidden" name="user_id" id="user_id">
                                  <div class="form-group mb0 col-sm-6">
                                    <label> <?php _e('First Name', 'library-management-system');?></label>

                                    <input name="first_name" id="first_name"
                                           ng-model="first_name" placeholder=" <?php _e('First Name', 'library-management-system');?>"
                                           class="form-control" type="text">


                                  </div>


                                  <div class="form-group mb0 col-sm-6">
                                    <label> <?php _e('Last Name', 'library-management-system');?></label>
                                    <input name="last_name" id="last_name"
                                           ng-model="last_name" placeholder=" <?php _e('Last Name', 'library-management-system');?>"
                                           class="form-control" type="text">

                                  </div>


                                  <div class="form-group mb0 col-sm-6">
                                    <label>Email</label>

                                    <input name="email" id="email" ng-model="email"
                                           placeholder="<?php _e('E-Mail Address', 'library-management-system');?>" class="form-control"
                                           type="text" readonly>

                                  </div>


                                  <div class="form-group mb0 col-sm-6">
                                    <label><?php _e('Phone', 'library-management-system');?></label>

                                    <input name="phone" id="phone" ng-model="phone"
                                           placeholder="9876543210" id="phone"
                                           class="form-control" type="text">

                                  </div>


                                  <div class="form-group mb0 col-sm-6">
                                    <label> <?php _e('Course Name', 'library-management-system');?></label>

                                    <select name="course_name" id="course_name"
                                            ng-model="course_name"
                                            class="form-control selectpicker">
                                      <option value=""><?php _e('------------Select Course Name------------', 'library-management-system'); ?>
                                      </option>
                                        <?php
                                        global $wpdb;
                                        $full_data = $wpdb->get_results("select * from tblcourses");
                                        foreach ($full_data as $obj) {
                                            ?>
                                          <option
                                              value="<?php echo $obj->Id; ?>"><?php echo $obj->CourseName; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                  </div>


                                  <div class="form-group mb0 col-sm-6">
                                    <label> <?php _e('Year Name', 'library-management-system');?></label>
                                    <select name="year_name" id="year_name"
                                            ng-model="year_name"
                                            class="form-control selectpicker">
                                      <option value=""><?php _e('------------Select Course Year------------', 'library-management-system'); ?>
                                      </option>
                                        <?php
                                        global $wpdb;
                                        $full_data = $wpdb->get_results("select * from tblyears");
                                        foreach ($full_data as $obj) {
                                            ?>
                                          <option
                                              value="<?php echo $obj->Id; ?>"><?php echo $obj->YearName; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                  </div>

                                  <div class="form-group mb0 col-sm-6">

                                    <label> <?php _e('City', 'library-management-system');?></label>


                                    <input name="city" id="city" ng-model="city"
                                           placeholder="City" class="form-control"
                                           type="text">


                                  </div>

                                  <div class="form-group mb0 col-sm-6">

                                    <label> <?php _e('State', 'library-management-system');?></label>

                                      <?php set_up_states("state", "state_name"); ?>


                                  </div>

                                  <div class="form-group mb0 col-sm-6">
                                    <label> <?php _e('Zip', 'library-management-system');?></label>

                                    <input name="zip" id="zip" ng-model="zip"
                                           placeholder="Zip Code" class="form-control"
                                           type="text">

                                  </div>
                                  <div class="form-group mb0 col-sm-6">
                                    <label>  <?php _e('Role', 'library-management-system');?></label>
                                    <input type="hidden" name="role" id="role" value="Student">
                                    <select class="form-control selectpicker fix_radius" disabled>
                                      <option value="Student" selected><?php _e('Student', 'library-management-system'); ?></option>
                                      <option value="Teacher"><?php _e('Teacher', 'library-management-system'); ?></option>
                                    </select>

                                  </div>
                                  <div class="form-group mb0 col-sm-12">
                                    <label> <?php _e('Address', 'library-management-system');?></label>
                                    <textarea name="address" id="address" ng-model="address"
                                              class="form-control"></textarea>
                                  </div>


                                  <div class="form-group mb0 col-sm-12">
                                    <label> <?php _e('Note', 'library-management-system');?></label>

                                    <textarea class="form-control" id="note_on_user"
                                              rows="2" ng-model="note_on_user"
                                              name="note_on_user"
                                              placeholder=" <?php _e('Note', 'library-management-system');?>"></textarea>

                                  </div>


                                  <div class="form-group mb0 col-sm-12">
                                    <button ng-click="updateUserbtn()"
                                            class="btn btn-danger pull-right fix_radius pmd-ripple-effect">
                                      <span class="fa fa-floppy-o"></span> <?php _e('Save', 'library-management-system');?>
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>

              </div>

            </div>


            <div class="modal fade" id="printUserIdModal" tabindex="-1" role="dialog"
                 aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog lg-modal" style="width:72%;">
                <div class="modal-content fix_radius">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                          aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title" id="lineModalLabel">Identity Card</h3>
                  </div>
                  <div class="modal-body" style="">

                    <div class="row">
                      <div style="padding-left: 14px;">
                        <div class="panel panel-default" style="font-size: 12px;"
                             id="print_Container">
                          <table id="p_tbl1" class="table table-striped"
                                 style="width: 49%;float: left;table-layout: fixed;border: 1px solid black;height: 330px;">
                            <tbody>
                            <tr>
                              <td id="p_img_td" rowspan="8"
                                  style="width: 186px;border-right: 1px solid lightgrey;">
                                <img
                                    ng-src="{{ printScope.srcPic ||'<?php echo get_template_directory_uri() . '/img/avatar.png'; ?>'}}"
                                    class="img-rounded" alt="User Pic"
                                    style="width: 169px;height: 156px;">
                                <div style="margin-top: 7px;">
                                  <span style="font-size: 15px;font-weight: 700;">STAMP :</span>
                                  <div id="p_stamp"
                                       style="height: 128px;border: 1px solid;"></div>
                                </div>
                              </td>
                              <td style="background-color: beige;padding-bottom: 0px;height: 42px;">
                                <h3 style="text-align:center;font-weight: bold;margin: 2px;margin-bottom: -4px;">
                                  Library Card</h3>

                              </td>
                            </tr>
                            <tr style="padding: 0px;height: 25px;padding-top: 6px;padding-left: 8px;">
                              <td style="font-family: -webkit-body;text-align: center;background-color: aliceblue;text-decoration: underline;text-transform: uppercase;font-weight: bold;"><?php echo get_option('inst_name'); ?></td>
                            </tr>
                            <tr style="padding: 0px;height: 25px;padding-top: 6px;padding-left: 8px;">
                              <td><?php echo get_option('inst_address') ?></td>
                            </tr>
                            <tr>
                              <td>ID : <span style="font-weight: 700;">{{printScope.user_id}}</span>
                              </td>
                            </tr>
                            <tr>
                              <td>Name : {{printScope.name}}</td>
                            </tr>
                            <tr>
                              <td>Phone : {{printScope.phone}}</td>
                            </tr>
                            <tr ng-show="printScope.role=='Student'">
                              <td>Course : {{printScope.course_name}} | Year :
                                {{printScope.year_name}}
                              </td>
                            </tr>
                            <tr ng-show="printScope.role=='Teacher'">
                              <td>Designation : {{printScope.role}}
                              </td>
                            </tr>
                            <tr>
                              <td>YEAR :</td>
                            </tr>
                            </tbody>
                          </table>

                          <table id="p_tbl2" class="table table-striped"
                                 style="width: 50%;float:right;margin-right: 6px;table-layout: fixed;border: 1px solid black;height: 330px;">
                            <tbody>
                            <tr>
                              <td>Email : {{printScope.email}}</td>
                            </tr>
                            <tr>
                              <td>Address : {{printScope.address}}</td>
                            </tr>
                            <tr>
                              <td>
                                <span style="text-align:left;font-weight: 700;">Instruction</span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <ul class="list-group" style="margin-bottom: -1px;">
                                    <?php
                                    $instustions_raw = get_option("inst_in_cards", "The holder of this card is register user of Demo University.,By this registeration the holder agreeds to abide by the Rules and Regulation of the Institute.,The Card is for personal use and it is not transfareble., Finder of the lost card are asked to return them to the Program office at the above address.,Only 2 books can be borrowed on this card.,Rs 10 will be be charged if this card is lost.,Book will be issued only on presense of this card.");
                                    $lst_inst = explode(",", $instustions_raw);
                                    for ($i = 0; $i < count($lst_inst); $i++) {
                                        ?>
                                      <li class="list-group-item"
                                          style="padding: 2px 15px !important;"><?php echo($i + 1) . '. ' . $lst_inst[$i]; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                              </td>
                            </tr>
                            </tbody>
                          </table>


                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pmd-ripple-effect"
                            ng-click="printPreview()">Print
                    </button>
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
