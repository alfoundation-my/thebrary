<?php $is_connected = is_connected(); ?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta charset="ISO-8859-15">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?php echo get_option('inst_meta_keyword'); ?>"/>
    <meta name="description" content="<?php echo get_option('inst_meta_desc'); ?>"/>
    <link rel="icon"
          type="image/png"
          href="<?php echo get_template_directory_uri(); ?>/img/favicon.png">
    <?php wp_head(); ?>
    <meta name="author" content="">
    <title><?php echo get_option('inst_meta_title'); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/fonts/fonts.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/iziToast.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style5.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/front.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- jQuery CDN -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.12.0.min.js"></script>
    <?php if (strpos(get_home_url(), "www.library-management.com") !== false) {
        ?>
        <meta name="google-site-verification" content="X1sa58a8pwdVJzitF46O3l6Rm99TIaTV2qaIuYunImY"/>
        <?php
    } ?>
    <style>
        a.slidesjs-next,
        a.slidesjs-previous,
        a.slidesjs-play,
        a.slidesjs-stop {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/btns-next-prev.png);
            background-repeat: no-repeat;
            display: block;
            width: 12px;
            height: 18px;
            overflow: hidden;
            text-indent: -9999px;
            float: left;
            margin-right: 5px;
        }

        .back_book_holder_img {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/stand.png);
            width: 100%;
            background-size: cover;
        }

        .slidesjs-pagination li a {
            display: block;
            width: 13px;
            height: 0;
            padding-top: 13px;
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/pagination.png);
            background-position: 0 0;
            float: left;
            overflow: hidden;
        }

        .submit {
            color: black;
        }

        .comment-respond {
            width: 70%;
        }

        .comment {
            background-color: aliceblue;
            margin-top: 15px;
            padding: 10px;
        }

        #comments {
            margin-bottom: 3%;
        }

        .comment-reply-link {
            color: blue;
        }

        .reply {
            margin-bottom: 15px;
        }

        .avatar {
            border-radius: 50% !important;
        }

        ol li {
            list-style-type: none;
        }

        .more_style {
            width: 17px;
            padding-top: 15px;
        }

        .more_menu {

            position: absolute;
            top: 100%;
            right: 0%;
            background: #ffffff;
            width: 20%;
            padding: 20px;
            padding-top: 10px;
            z-index: 12;
            border: 1px solid lightgray;
        }

        .show_menu_stl {
            padding: 8px;
            list-style: none;
        }

        .show_menu_stl:hover {
            background-color: #d4d3d140;
        }

        #scrollUp {
            bottom: 0;
            right: 0;
            width: 30px;
            height: 39px;
            margin-bottom: -10px;
            padding: 5px 5px;
            font: 16px/20px sans-serif;
            text-align: center;
            text-decoration: none;
            /* text-shadow: 0 1px 0 #fff; */
            color: #f5f5f5;
            -webkit-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
            background-color: #101010;
            background-image: -moz-linear-gradient(top, #EBEBEB, #DEDEDE);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#EBEBEB), to(#DEDEDE));
            background-image: -webkit-linear-gradient(top, #EBEBEB, #DEDEDE);
            background-image: -o-linear-gradient(top, #EBEBEB, #DEDEDE);
            background-image: linear-gradient(to bottom, #292323, #151111);
            background-repeat: repeat-x;
            -webkit-transition: margin-bottom 150ms linear;
            -moz-transition: margin-bottom 150ms linear;
            -o-transition: margin-bottom 150ms linear;
            transition: margin-bottom 150ms linear;
        }

        #scrollUp:hover {
            margin-bottom: 0;
        }

        #sidebar {
            background: <?php echo get_option("custom_theme_color")?>;
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            background: <?php echo get_option("custom_theme_color")?>;
        }

        #sidebar ul.components {
            border: 0px;
        }

        #sidebar .sidebar-header {
            background: <?php echo get_option("custom_theme_color")?>;
        }

        .book_m_hlder, .slide_h {
            background-image: url("<?php echo get_template_directory_uri(); ?>/img/new_loading.gif");
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }

        <?php
        $find = ["link","script","http","https","eval","$","jQuery","function","javascript"];
        $replace = [""];
        echo str_replace($find, $replace, get_option("custom_css_front_page"));
        $var_img_css = "margin: auto;width: 100%;border: 1px solid;";
        ?>
    </style>

</head>
<body>

<div class="container" style="border: 1px solid lightgray;">

    <?php if (get_option("quick_notice", '') != '') {
        ?>
        <div class="alert alert-success notice_holder"
             style="margin-bottom: 0px;color: #f6fdf7 !important;background-color: #000000 !important;border-color: #000000 !important;"><?php echo get_option("quick_notice", ''); ?>
            .
            <?php if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
                how_to_download();
            } ?>
        </div>
        <?php
    } ?>
    <div id="content" ng-controller="CtrlBookLoadFront">


        <!-- Fixed navbar -->
        <?php include_once("front-nav.php") ?>


        <div class="slide_holder" ng-controller="CtrlSlides">
            <div id="slides" ng-show="full_slides.length>1">
                <img ng-src="{{slide.img_url}}" ng-repeat="slide in full_slides" class="img-responsive">
            </div>
            <img ng-src="{{slide.img_url}}" ng-show="full_slides.length==1" style="height: 480px;width: 100%;"
                 ng-repeat="slide in full_slides" class="img-responsive">
            <img ng-src="<?php echo get_template_directory_uri() . '/img/default_holder.jpg' ?>"
                 class="img-responsive slide_h"
                 style="height: 480px;width: 100%;" ng-show="full_slides.length==0">
        </div>
        <hr/>

        <div class="full_bk_container">

            <div style="height: 134px;background-color: #f5f5f5;padding-top: 21px;">
                <div class="strike"><span
                            style="font-size: 36px;color: #555;-webkit-font-smoothing: antialiased;font-family: 'Raleway';    font-weight: 700;"><?php echo get_option("front_page_s1", "Our Library Books") ?></span>
                </div>
                <hr class="hr_new">
            </div>


            <div id="book_list">
                <?php
                global $wpdb;
                $full_data = $wpdb->get_results("select DISTINCT (category) as Category from tblbooks where Qty>0");
                $mcount = 0;
                foreach ($full_data as $obj) {
                    ?>
                    <div id="<?php $t_val = $obj->Category;
                    $t_val = str_replace(" ", "_", $t_val);
                    $t_val = preg_replace("/[^A-Za-z0-9_]/", '', $t_val);
                    $t_val = preg_replace('/_+/', '_', $t_val);
                    echo $t_val; ?>">

                        <div class="row" style="border-bottom: 1px solid lightgray;margin-bottom: 2%;">
                            <div class="col-xs-12 col-md-6">
                                <h2 class="pull-left"><?php echo $obj->Category; ?></h2></div>
                            <div class="col-xs-12 col-md-6">
                                <div class="pull-right" style="margin-top: 4%;margin-bottom: 3%;">
                                    <button class="btn btn-primary prev_<?php echo $mcount; ?>"><i
                                                class="fa fa-chevron-left"
                                                aria-hidden="true"></i></button>
                                    <button class="btn btn-primary next_<?php echo $mcount; ?>"><i
                                                class="fa fa-chevron-right"
                                                aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="slick_books_<?php echo $mcount; ?>">
                                <?php $sub_data = $wpdb->get_results("select * from tblbooks where Category like '" . $obj->Category . "' and Qty>0 limit " . get_option('nos_of_book_to_show', '20'));
                                //foreach ($sub_data as $chunk) {
                                //echo "<div class=''>";
                                foreach ($sub_data as $obj_sub) {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"

                                        <?php
                                        $todo = "showFullData('" . $obj_sub->ISBN . "','" . $obj_sub->BookUrl . "','basic');";
                                        if (!empty($obj_sub->ExternalUrl)) {
                                            $todo = "redirect('" . $obj_sub->ExternalUrl . "')";
                                        } ?>
                                    >
                                        <?php
                                        $img_url = "";
                                        if ($obj_sub->MainCoverId != "") {
                                            $img_url = wp_get_attachment_image_src($obj_sub->MainCoverId, "full", false)[0];
                                        } else {
                                            $img_url = $obj_sub->MainCoverUrl;
                                        }
                                        //var_dump($obj_sub); ?>
                                        <div id="LI_1">
                                            <div id="DIV_2">
                                                <figure id="FIGURE_4">
                                                    <img width="250"
                                                         data-src='<?php echo $img_url; ?>'
                                                         class="img-responsive lazyMain"
                                                         style="<?php //echo $var_img_css; ?>"
                                                         alt="" id="IMG_6"/>
                                                </figure>


                                                <div id="DIV_7">
                                                    <h2 id="H2_8">
                                                        <?php if (strlen($obj_sub->BookTitle) > 20) { ?>
                                                            <marquee behavior="alternate"
                                                                     scrollamount="1"><?php echo $obj_sub->BookTitle; ?>
                                                            </marquee>
                                                        <?php } else { ?>
                                                            <?php echo $obj_sub->BookTitle;
                                                        } ?>

                                                    </h2>
                                                    <span
                                                            id="SPAN_9">

                                                         <?php echo $obj_sub->Author ? $obj_sub->Author : "None"; ?></span>
                                                    <!--<span id="SPAN_10"><del
                                                                id="DEL_11"><span
                                                                    id="SPAN_12"><span
                                                                        id="SPAN_13">$</span>3.00</span></del> <ins
                                                                id="INS_14"><span
                                                                    id="SPAN_15"><span
                                                                        id="SPAN_16">$</span>2.00</span></ins></span>-->
                                                </div>
                                                <div id="DIV_17">
                                                    <div id="DIV_18">
                                                        <a id="A_19" ng-click="<?php echo $todo; ?>"><img
                                                                    src="<?php echo get_template_directory_uri(); ?>/img/eye.png"
                                                                    class="frnt_det_btn"/><span
                                                                    class="f_detail">Detail</span></a>
                                                        <?php
                                                        $issued_qty = $wpdb->get_var("select count(id) as Cnt from tblsubbooks where Available=1 and Active=1 and ParentBookId=" . $obj_sub->Id); ?>
                                                        <?php if ($issued_qty > 0) {
                                                            ?>
                                                            <a class="A_20" href="" style="background: green;
    color: white;"><span class="f_available"><?php _e('Available', 'library-management-system'); ?></span>
                                                                (<?php echo $issued_qty; ?>)</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a class="A_20" href="#" style="background: red;
    color: white;"><span class="f_available"><?php _e('All Issued', 'library-management-system'); ?></span> (0)</a>
                                                            <?php
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                }
                                //echo "</div>";
                                //} ?>
                            </div>
                        </div>

                        <!-- Left and right controls -->


                    </div>
                <?php
                ?>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery('.slick_books_<?php echo $mcount;?>').slick({
                                dots: false,
                                slidesToShow: 4,
                                infinite: false,
                                slidesToScroll: 4,
                                prevArrow: jQuery(".prev_<?php echo $mcount;?>"),
                                nextArrow: jQuery(".next_<?php echo $mcount;?>"),
                                responsive: [
                                    {
                                        breakpoint: 1440,
                                        settings: {
                                            slidesToShow: 4,
                                            slidesToScroll: 4
                                        }
                                    },
                                    {
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 3,
                                            dots: true
                                        }
                                    },
                                    {
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 425,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 375,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 320,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    }
                                    // You can unslick at a given breakpoint now by adding:
                                    // settings: "unslick"
                                    // instead of a settings object
                                ]
                            });
                        });

                    </script>

                    <?php
                    $mcount++;
                } ?>

                <?php
                if (empty($full_data)) {
                    ?>
                    <div class="no_books"><?php _e('No Books Available Right Now.Come Back Later.', 'library-management-system'); ?></div>
                    <?php
                }
                ?>

            </div>


            <?php include_once("contact_us.php"); ?>

        </div>


    </div>
</div>
<div class="modal fade" id="showBookFromGoogle" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fix_radius">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only"><?php _e('Close', 'library-management-system'); ?></span></button>
                <h3 class="modal-title"
                    id="lineModalLabel"><?php _e('Books Preview', 'library-management-system'); ?></h3>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px;margin: auto;">
                    <div id="viewerCanvas" style="width: 100%; height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="animatedModal">
    <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
    <div class="close-animatedModal">
        <img class="closebt pull-right show_pointer" src="<?php echo get_template_directory_uri(); ?>/img/closebtn.png"
             style="    width: 30px;margin-right: 3%;margin-top: 3%;">
    </div>

    <div class="modal-contents">
        <input type="text" class="form-control" placeholder="Search for books in our library.." style="width: 80%;margin-top: 7%;height: 60px;
                  margin-left: 11%;padding: 20px;font-size: 20px;" id="adv_search_text">
        <br/>
        <div class="grid pop_holder_book" ng-controller="CtrlBookLoadFront">
            <div class="row reset_margin" style="margin-top: 3%;">
                <?php
                global $wpdb;
                $full_data = $wpdb->get_results("select DISTINCT (category) as Category from tblbooks where Qty>0");
                foreach ($full_data as $obj) {
                    ?>

                    <?php $sub_data = $wpdb->get_results("select * from tblbooks where Category like '" . $obj->Category . "' and Qty>0");
                    foreach ($sub_data as $obj_sub) {
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 book_f grid-item"
                            <?php
                            $todo = "showFullData('" . $obj_sub->ISBN . "','" . $obj_sub->BookUrl . "','adv_search');";
                            if (!empty($obj_sub->ExternalUrl)) {
                                $todo = "redirect('" . $obj_sub->ExternalUrl . "')";
                            } ?>
                             ng-click="<?php echo $todo; ?>">
                            <p class="b_name" style="display: none;"><?php echo $obj_sub->BookTitle; ?></p>
                            <?php
                            $img_url = "";
                            if ($obj_sub->MainCoverId != "") {
                                $img_url = wp_get_attachment_image_src($obj_sub->MainCoverId, "full", false)[0];
                            } else {
                                $img_url = $obj_sub->MainCoverUrl;
                            } ?>
                            <div>
                                <div class="book_m_hlder">
                                    <img data-src='<?php echo $img_url; ?>'
                                         class="img-responsive img-book-frnt lazyPopup"
                                         style="<?php echo $var_img_css; ?>"/>
                                    <?php
                                    $issued_qty = $wpdb->get_var("select count(id) as Cnt from tblsubbooks where Available=1 and Active=1 and ParentBookId=" . $obj_sub->Id); ?>
                                    <?php if ($issued_qty > 0) {
                                        ?>
                                        <div class=" ribbon-green">
                                            <span><?php _e('Available', 'library-management-system'); ?></span></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="ribbon-red">
                                            <span><?php _e('All Issued', 'library-management-system'); ?></span></div>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <?php
                    } ?>


                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<a id="btnSearch" href="#animatedModal" style="font-size: 12px!important;color: #fff!important;background-color: #0c0c0c !important;border-radius: 50%;    border: none;display: inline-block;outline: 0;padding: 8px 16px;vertical-align: middle;overflow: hidden;text-decoration: none;color: inherit;background-color: inherit;text-align: center;cursor: pointer;white-space: nowrap;bottom: 7%;
            left: 2%;position: fixed;border-radius: 50px !important;"><i class="fa fa-search"
                                                                         aria-hidden="true"></i></a>


<!-- Bootstrap Js CDN -->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/iziToast.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/offline.min.js"></script>
<?php if ($is_connected) {
    ?>
    <script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
    <?php
} ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.slides.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/animatedmodal.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lazy.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lazy.plugins.min.js"></script>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
    var site_path = "<?php echo get_template_directory_uri(); ?>";
    var is_connected = "<?php echo $is_connected;?>";
    $(document).ready(function () {
        <?php if ($is_connected) {
        ?>
        google.books.load();
        <?php
        } ?>
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });

        $('.lazyMain').Lazy();
        if (screen.width >= 1024) {
            $("#sidebarCollapse").hide();
            $(".logo_frnt").css("float", "left");
        }

        $("#btnSearch").animatedModal({
            "color": "rgb(255, 255, 255)",
            "animatedIn": "lightSpeedIn",
            "animateOut": "bounceOutDown",
            "beforeOpen": function () {
                $('.lazyPopup').Lazy({appendScroll: "#animatedModal"});
            },
            "afterClose": function () {
                $("#adv_search_text").val("");
            }
        });
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0;
    });
    <?php
    if (get_option("enable_scroll_on_top", "true") == "true") {
    ?>
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp',
            topDistance: '300',
            topSpeed: 300,
            animation: 'fade', // Fade, slide, none
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '<i class="fa fa-chevron-up" aria-hidden="true"></i>', // Text for element
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
    });

    <?php
    } ?>
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/animatescroll.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.datetimepicker.full.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.blockUI.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/front_custom.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
</body>
<?php wp_footer(); ?>
</html>
<?php if (strpos(get_home_url(), "www.library-management.com") !== false) {
    ?>
    <a id="btnTry" href="https://www.library-management.com/login/" target="_blank"
       style="font-size: 12px!important;color: #fff !important;background-color: #f31a1a  !important;border-radius: 50%;border: none;display: inline-block;outline: 0;padding: 8px 16px;vertical-align: middle;overflow: hidden;text-decoration: none;color: inherit;background-color: inherit;text-align: center;cursor: pointer;white-space: nowrap;bottom: 50%;right: 0%;position: fixed !important;border-radius: 0px !important;">+
        Try Me</a>
    <?php
} ?>
