/**
 * Created by Andrew on 12/11/2017.
 */
iziToast.settings({
    timeout: 1000,
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    theme: 'dark', // dark
    position: 'bottomCenter',

});

function showMessage(msg, title, type) {

    if (type == "success") {
        iziToast.success({
            title: title,
            message: msg,
        });
    }
    if (type == "warning") {
        iziToast.warning({
            title: title,
            message: msg,
        });
    }
    if (type == "error") {
        iziToast.error({
            title: title,
            message: msg,
        });
    }

    if (type == "info") {
        iziToast.info({
            title: title,
            message: msg,
        });
    }
}

function hide_msg() {
    iziToast.destroy();
}
var app = angular.module('myApp', []);

function get_slides($scope) {
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        async: true,
        dataType: 'JSON',
        data: {
            'action': 'manage_slides',
            'todo': 'getslides'
        },
        success: function (res) {
            $scope.full_slides = res.data;
            $scope.$digest();

            if ($scope.full_slides.length != 0) {
                jQuery('#slides').slidesjs({
                    height: 480,
                    play: {
                        active: true,
                        auto: true,
                        interval: 5000,
                        swap: true
                    }
                });
            }
        }
    });
}
app.controller('CtrlSlides', function ($scope) {
    $scope.full_slides = [];
    get_slides($scope);
});

app.controller('CtrlBookLoadFront', function ($scope, $window) {
    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    };
    $scope.showFullData = function ($isbn, $book_url, called_frm) {
        if (called_frm == "adv_search") {
            jQuery('#showBookFromGoogle').css("z-index", "10000");
            jQuery('#showBookFromGoogle').css("background-color", "#00000094");

        }
        if ($book_url.includes("books.google") && is_connected) {
            var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
            viewer.load('ISBN:' + $isbn, null, null);
            jQuery('#showBookFromGoogle').modal('show');
            showMessage("Trying to find the preiview of this book", "Info", "info");
            setTimeout(
                function () {
                    if (jQuery("#viewerCanvas :first-child").length < 5) {
                        var no_preiview = site_path + "/img/no_preview.png";
                        jQuery("#viewerCanvas :first-child").remove();
                        jQuery("#viewerCanvas").prepend($('<div style="background: #c7c7c7;"><img class="img-responsive" style="display: block;margin: auto;" src="' + no_preiview + '"/></div>'));
                    }

                }, 8000);
        } else {

            if ($book_url != "" && $book_url.includes("drive.google.com") && is_connected) {
                var book_id_drive = $book_url.replace("https://drive.google.com/open?id=", "");
                jQuery('#showBookFromGoogle').modal('show');
                var prv_url = "https://docs.google.com/viewer?srcid=" + book_id_drive + "&pid=explorer&efh=false&a=v&chrome=false&embedded=true";
                document.getElementById('viewerCanvas').innerHTML = "<iframe src='" + prv_url + "' style='width:100%;height:100%;'></iframe>";
            } else {
                if ($book_url.includes(".pdf")) {
                    document.getElementById('viewerCanvas').innerHTML = "<iframe src='" + $book_url + "' style='width:100%;height:100%;'></iframe>";
                    jQuery('#showBookFromGoogle').modal('show');
                } else {
                    showMessage("No preview available.", "OK", "warning");
                }

            }

        }

    }
    $scope.sendContactDetails = function () {
        jQuery.blockUI({
            message: null
        });
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: jQuery("#sendContactsForm").serialize(),
            success: function (res) {
                showMessage(res.msg, res.header, res.color);
                jQuery("input[name='c_name']").val("");
                jQuery("input[name='c_email']").val("");
                jQuery("input[name='c_phone']").val("");
                jQuery("#c_desc").val("");
                jQuery.unblockUI();
            }
        });
    }


    jQuery(".more_menu").hide();
    jQuery(".more_style_li").hover(function () {
        jQuery(".more_menu").show();
        jQuery(".navbar").css("overflow", "visible");
    }, function () {
        setTimeout(function () {
            jQuery(".more_menu").hide();
            jQuery(".navbar").css("overflow", "hidden");
        }, 8000);
    });


    if (jQuery(window).width() < 1300 & jQuery(window).width() > 960) {
        jQuery(".more_menu").append(jQuery(".menu_nav_5"));
        jQuery(".menu_nav_5").addClass("show_menu_stl");

    }

    if (jQuery(window).width() < 960 & jQuery(window).width() > 700) {
        jQuery(".more_menu").append(jQuery(".menu_nav_4"));
        jQuery(".menu_nav_4").addClass("show_menu_stl");
        jQuery(".more_menu").append(jQuery(".menu_nav_5"));
        jQuery(".menu_nav_5").addClass("show_menu_stl");

    }


    var qsRegex
    var $grid = jQuery('.grid').isotope({

        itemSelector: '.grid-item',
        filter: function () {

            return qsRegex ? jQuery(this).text().match(qsRegex) : true;
        }
    });


    var $quicksearch = jQuery('#adv_search_text').keyup(debounce(function () {
        qsRegex = new RegExp($quicksearch.val(), 'gi');
        $grid.isotope();
    }, 200));


    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }

            function delayed() {
                fn();
                timeout = null;
            }

            timeout = setTimeout(delayed, threshold || 100);
        }
    }


    // $('.slick_d').slick({
    //     dots: false,
    //     prevArrow: $(".prev"),
    //     nextArrow: $(".next"),
    // });


});
