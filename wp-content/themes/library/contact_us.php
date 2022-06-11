<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/8/2020
 * Time: 11:25 PM
 */
?>
<div id="contact_us" class="contact_us row">


    <div class="section-content">
        <h1 class="section-header">Get in <span class="content-header wow fadeIn " data-wow-delay="0.2s"
                                                data-wow-duration="2s"> <?php _e('Touch with us', 'library-management-system'); ?></span>
        </h1>
    </div>

    <div class="row contact-section" style="margin: 0px;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php if ($is_connected) {
                ?>
                <iframe width="100%" height="350" src="<?php echo get_option('inst_gmap'); ?>"
                        frameborder="0"
                        scrolling="no" marginheight="0" marginwidth="0"><a
                        href="https://www.maps.ie/create-google-map/"><?php _e('Google Maps iframe generator', 'library-management-system'); ?></a>
                </iframe>
                <?php
            } else {
                ?>
                <img
                    src="<?php echo strpos(get_option('inst_gmap'), "google") !== false ? get_template_directory_uri() . '/img/map.png' : get_option('inst_gmap'); ?>"
                    class="img-responsive">
                <?php
            } ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3 style="margin-top: 5px;"><?php _e('About us', 'library-management-system'); ?></h3>
            <address>
                <?php echo get_option('inst_frnt_desc'); ?>
            </address>
            <p class="white_p"><?php _e('Address', 'library-management-system'); ?>
                : <?php echo get_option('inst_address'); ?></p>
            <p class="white_p"><?php _e('Phone', 'library-management-system'); ?> : <a
                    href="tel:<?php echo get_option('inst_phone'); ?>"><?php echo get_option('inst_phone'); ?></a><span
                    ng-init="fax='<?php echo get_option('inst_fax'); ?>'"
                    ng-show="fax!=''"> | <?php _e('Fax', 'library-management-system'); ?>
                    : <?php echo get_option('inst_fax'); ?></span></p>
            <p class="white_p"><?php _e('E-mail', 'library-management-system'); ?> : <a
                    href="mailto:<?php echo get_option('inst_email'); ?>"><?php echo get_option('inst_email'); ?></a>
            </p>
        </div>
        <div class="col-md-12 col-sm-12">
            <form id="sendContactsForm">
                <input type="hidden" name="action" value="frnt_contact"/>
                <div class="col-md-6 form-line" style="padding-top: 2%;padding-bottom: 4%;">
                    <div class="form-group">
                        <label for="exampleInputUsername"><?php _e('Your name', 'library-management-system'); ?></label>
                        <input type="text" class="form-control" ng-model="c_name" name="c_name"
                               placeholder="<?php _e('Enter Name', 'library-management-system'); ?>"
                               autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail"><?php _e('Email Address', 'library-management-system'); ?></label>
                        <input type="email" class="form-control" name="c_email" ng-model="c_email"
                               placeholder="<?php _e('Enter Email id', 'library-management-system'); ?>"
                               autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="telephone"><?php _e('Mobile No', 'library-management-system'); ?>
                            .</label>
                        <input type="tel" class="form-control" name="c_phone" ng-model="c_phone"
                               placeholder="<?php _e('Enter 10-digit mobile no.', 'library-management-system'); ?>"
                               autocomplete="tel-national">
                    </div>
                </div>
                <div class="col-md-6" style="padding-top: 2%;">
                    <div class="form-group">
                        <label for="description"> <?php _e('Message', 'library-management-system'); ?></label>
                        <textarea class="form-control" id="c_desc" name="c_desc" ng-model="c_desc"
                                  placeholder="<?php _e('Enter Your Message', 'library-management-system'); ?>"></textarea>
                    </div>
                    <div style="padding-bottom: 45px;">
                        <button ng-click="sendContactDetails()" class="btn btn-default submit"><i
                                class="fa fa-paper-plane"
                                aria-hidden="true"></i> <?php _e('Send Message', 'library-management-system'); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="margin: 0px;padding: 15px;background-color: white;color: black;">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?php echo $version; ?>
        </div>
        <strong>Copyright © 2017-<?php echo date("Y"); ?> <a
                href="<?php echo get_site_url(); ?>">LMS</a>.</strong>
        <?php _e('All rights reserved.', 'library-management-system'); ?>
    </div>

    <?php if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
        ?>
        <div class="row"
             style="margin: 0px;padding: 15px;background-color: white;color: black;padding-top: 0px;">
            <?php include_once("waste.php"); ?>
        </div>
        <?php
    } ?>
</div>
