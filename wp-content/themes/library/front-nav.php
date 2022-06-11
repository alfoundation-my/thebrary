<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/6/2020
 * Time: 6:17 PM
 */
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo get_site_url(); ?>">

                <img
                        src="<?php $src = wp_get_attachment_image_src(get_option('inst_attach_photo_id'), "full")[0];
                        if (!empty($src)) {
                            echo $src;
                        } else {
                            echo get_template_directory_uri() . '/img/default_university.png';
                        } ?>"
                        class="univ_img"
                >
                <h3 class="univ_name"><?php echo ucwords(get_option('inst_name')); ?></h3>


            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?php echo get_site_url(); ?>">Home</a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Books </a>
                    <ul class="dropdown-menu">

                        <?php
                        global $wpdb;
                        $full_data = $wpdb->get_results("select DISTINCT (category) as Category from tblbooks where Qty>0");
                        $count = 0;
                        foreach ($full_data as $obj) {
                            ?>
                            <li class="show_pointer show_menu_stl"><a
                                        onclick="$('#<?php $t_val = $obj->Category;
                                        $t_val = str_replace(" ", "_", $t_val);
                                        $t_val = preg_replace("/[^A-Za-z0-9_]/", '', $t_val);
                                        $t_val= preg_replace('/_+/', '_', $t_val);
                                        echo $t_val; ?>').animatescroll();"><?php echo strtoupper($obj->Category); ?></a>
                            </li>
                            <?php
                        }
                        ?>

                        <!--                                -->
                        <!--                                <li><a href="#">Computers</a></li>-->
                        <!--                                <li><a href="#">Something else here</a></li>-->
                        <!--                                <li role="separator" class="divider"></li>-->
                        <!--                                <li class="dropdown-header">Nav header</li>-->
                        <!--                                <li><a href="#">One more separated link</a></li>-->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Other </a>
                    <ul class="dropdown-menu">

                        <li class="dropdown-header">Pages</li>

                        <?php
                        global $wpdb;
                        $fulldata = $wpdb->get_results("select * from " . $wpdb->prefix . "postmeta where meta_key='_wp_page_template' and meta_value='basic_template.php'");
                        foreach ($fulldata as $obj) {
                            if (get_post_status($obj->post_id) == "publish") {
                                ?>
                                <li class="show_pointer">
                                    <a class="show_pointer"
                                       href="<?php echo get_permalink($obj->post_id); ?>"><?php echo get_post_meta($obj->post_id, "menu_name")[0]; ?></a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">How to get in Touch ?</li>
                        <li><a onclick="$('#contact_us').animatescroll();">About us</a></li>
                        <li><a onclick="$('#contact_us').animatescroll();">Contact Us</a></li>
                    </ul>
                </li>
                <?php if (is_user_logged_in()) { ?>
                    <li><a class="btn btn-primary btn_dash" href="<?php echo get_site_url(); ?>/dashboard">
                            Dashboard</a></li>
                <?php } else { ?>
                    <li class="show_pointer">
                        <a class="btn btn-primary btn_login"
                           href="<?php echo get_site_url() . '/login/'; ?>"><?php _e('Login', 'library-management-system'); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
