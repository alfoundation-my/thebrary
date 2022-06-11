<?php /* Template Name: BasicPage Page */ ?>
<?php $is_connected = is_connected(); ?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta charset="ISO-8859-15">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo get_option('inst_meta_title') . " - " . the_title(); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/fonts/fonts.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style5.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/front.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>


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

        hr {
            margin-top: 5px;
            margin-bottom: 5px;
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

        <?php
        $find = ["link","script","http","https","eval","$","jQuery","function","javascript"];
        $replace = [""];
        echo str_replace($find,$replace,get_option("custom_css_front_page"));
        ?>
    </style>

</head>
<body>
<?php if (get_option("quick_notice", '') != '') { ?>
    <div class="alert alert-success"
         style="margin-bottom: 0px;color: #f6fdf7;background-color: #000000;border-color: #000000;"><?php echo get_option("quick_notice", ''); ?></div>
<?php } ?>
<div class="wrapper">

    <?php include_once("front-nav.php") ?>
    <div id="content" class="cnt_front_custom">
        <div class="full_bk_container">
            <div class="cnt_frnt_main_holder">

                <?php
                echo "<h1 style='text-align: center'>" . get_the_title() . "</h1>";
                $query = get_post($post->ID);
                $content = apply_filters('the_content', $query->post_content);
                echo $content;
                ?>
            </div>
        </div>
        <div class="container">
            <?php include_once("contact_us.php"); ?>
        </div>
    </div>
</div>


<!-- jQuery CDN -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollUp.min.js"></script>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
    var site_path = "<?php echo get_template_directory_uri(); ?>";
    $(document).ready(function () {
        //google.books.load();
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });


        if (screen.width >= 1024) {
            $("#sidebarCollapse").hide();
            $(".logo_frnt").css("float", "left");
        }

//
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0;

        $('a').each(function () {
            if ($(this).attr('href') == $(location).attr("href")) {
                $(this).addClass('actv');
                $(".bck_hrf").attr("href", "<?php echo get_home_url();?>");
            }
        });

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

</body>
</html>