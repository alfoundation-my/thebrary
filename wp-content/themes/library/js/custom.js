jQuery(document).ready(function ($) {
    $body = $("body");
    var today_d = new Date();
    var max_date = new Date();
    max_date.setDate(today_d.getDate() + 7);
    var min_date = new Date();
    min_date.setDate(today_d.getDate());
    $.datetimepicker.setLocale('en');
    var bmax_date = new Date();
    bmax_date.setDate(today_d.getDate() + 14);
    jQuery('#book_date_borrowed').datetimepicker({
        timepicker: false,
        todayButton: false,
        format: 'd-m-Y',
        startDate: min_date,
        minDate: 0,
        defaultDate: min_date
    });
    jQuery('#book_date_due').datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        minDate: 0,
        todayButton: false,
        maxDate: bmax_date,
        startDate: max_date,
        defaultDate: max_date
    });

    var AdminLTEOptions = {
        sidebarExpandOnHover: true,
        enableBoxRefresh: true,
        enableBSToppltip: true
    };
    localStorage.setItem("pg_nos", "0");
    $("#loginform").validate({
        rules: {
            log: "required",
            pwd: "required"
        }
    });
    $("#frmUpdateBookDetails").validate({
        rules: {
            selected_book_title: {
                required: true,
                minlength: 2,
                maxlength: 500,
            },
            select_book_price: {
                required: true,
            }
        },
        messages: {
            selected_book_title: {
                minlength: lang_msg.lg1,
                maxlength: lang_msg.lg2
            },
            select_book_price: {
                required: lang_msg.lg3,
            }
        }
    });

    jQuery("#slides").slidesjs({
        width: 1108,
        height: 350,
        navigation: {
            active: false,
            effect: "fade"
        },
        pagination: {
            active: false,
            effect: "slide"
        }
    });

    $('#lib_password_form').validate({
        rules: {
            new_pass: {
                required: true,
                minlength: 8,
                maxlength: 15
            },
            confirm_pass: {
                equalTo: "#new_pass"
            }
        },
        messages: {
            new_pass: {
                required: lang_msg.lg4,
                minlength: lang_msg.lg5,
                maxlength: lang_msg.lg6,
            },
            confirm_pass: {
                equalTo: lang_msg.lg7
            },
        }
    });

    $("#upload_profilePic").on('click', function (e) {
        e.preventDefault();
        $("#upload_hidden_file:hidden").trigger('click');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_profile_pic')
                    .attr('src', e.target.result);

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#book_qty").numeric();
    $("#book_price").numeric();
    $('#book_add_form').validate({
        rules: {
            book_isbn: {
                required: true,
                minlength: 5,
                maxlength: 20,
            },
            book_title: {
                required: true,
                minlength: 2,
                maxlength: 500,
            },
            book_category: {
                required: true,
                maxlength: 50,
            },
            book_price: {
                required: true,
            },
            book_qty: {
                required: true,
            }
        },
        messages: {
            book_isbn: {
                required: lang_msg.lg8,
                minlength: lang_msg.lg9,
                maxlength: lang_msg.lg10,
            },
            book_title: {
                required: lang_msg.lg11,
                minlength: lang_msg.lg1,
                maxlength: lang_msg.lg2,
            },
            book_category: {
                required: lang_msg.lg14,
                maxlength: lang_msg.lg15,
            },
            book_price: {
                required: lang_msg.lg3,
            },
            book_qty: {
                required: lang_msg.lg17,
            }
        }
    });

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
    }, lang_msg.lg18);

    $('#lib_update_profile_form').validate({
        rules: {
            fname: {
                required: true,
                minlength: 3,
                maxlength: 20,
                lettersonly: true
            },
            lname: {
                required: true,
                minlength: 3,
                maxlength: 20,
                lettersonly: true
            },
            email: {
                email: true,
                required: true,
            },
            phone: {
                required: true,
                minlength: 10,
            },
            address: {
                required: true,
                minlength: 10,
                maxlength: 500,
            },
            city: {
                required: true,
            },
            zip: {
                required: true,
                minlength: 5,
            },
            state: {
                required: true,
            }
        },
        messages: {
            fname: {
                required: lang_msg.lg19,
                minlength: lang_msg.lg20,
                maxlength: lang_msg.lg20,
                lettersonly: lang_msg.lg20,
            },
            lname: {
                required: lang_msg.lg23,
                minlength: lang_msg.lg24,
                maxlength: lang_msg.lg24,
                lettersonly: lang_msg.lg24,
            },
            email: {
                email: lang_msg.lg27,
                required: lang_msg.lg28,
            },
            phone: {
                required: lang_msg.lg29,
                minlength: lang_msg.lg30,
            },
            address: {
                required: lang_msg.lg31,
                minlength: lang_msg.lg32,
                maxlength: lang_msg.lg32
            },
            city: {
                required: lang_msg.lg34,
            },
            zip: {
                required: lang_msg.lg35,
            },
            state: {
                required: lang_msg.lg36
            }
        }
    });

    $('#lib_manage_inst_form_profile').validate({
        rules: {
            inst_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            inst_cont_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
                lettersonly: true
            },
            inst_email: {
                email: true,
                required: true
            },
            inst_phone: {
                required: true,
                minlength: 10,
            },
            inst_address: {
                required: true,
                minlength: 10,
                maxlength: 500,
            },
            inst_city: {
                required: true,
            },
            inst_zip: {
                required: true,
                minlength: 5,
            },
            inst_state: {
                required: true,
            },
            inst_website: {
                url: true,
                required: true,
            }
        },
        messages: {
            inst_name: {
                required: lang_msg.lg19,
                minlength: lang_msg.lg38,
                maxlength: lang_msg.lg38
            },
            inst_cont_name: {
                required: lang_msg.lg40,
                minlength: lang_msg.lg41,
                maxlength: lang_msg.lg41,
                lettersonly: lang_msg.lg41,
            },
            inst_email: {
                email: lang_msg.lg27,
                required: lang_msg.lg28
            },
            inst_phone: {
                required: lang_msg.lg29,
                minlength: lang_msg.lg30,
            },
            inst_address: {
                required: lang_msg.lg31,
                minlength: lang_msg.lg32,
                maxlength: lang_msg.lg32
            },
            inst_city: {
                required: lang_msg.lg34,
            },
            inst_zip: {
                required: lang_msg.lg35,
            },
            inst_state: {
                required: lang_msg.lg36
            },
            inst_website: {
                url: lang_msg.lg54,
                required: lang_msg.lg55
            }
        }
    });

    $('#addYearsForm').validate({
        inlineFormYear: {
            required: true,
        },
        messages: {
            inlineFormYear: {
                required: lang_msg.lg56
            }
        }
    });

    $('#addCoursesForm').validate({
        inlineFormCourse: {
            required: true,
        },
        messages: {
            inlineFormCourse: {
                required: lang_msg.lg56
            }
        }
    });

    $('#lib_issue_book_form').validate({
        rules: {
            book_no: {
                required: true,
                minlength: 6
            },
            user_id: {
                required: true,
                minlength: 1
            },
            book_date_borrowed: {
                required: true
            },
            book_date_due: {
                required: true,
            },
        },
        messages: {
            book_no: {
                required: lang_msg.lg57,
                minlength: lang_msg.lg58
            },
            user_id: {
                required: lang_msg.lg59,
                minlength: lang_msg.lg60,
            },
            book_date_borrowed: {
                required: lang_msg.lg61
            },
            book_date_due: {
                required: lang_msg.lg62,
            }
        }
    });

    $('#lib_manage_other_seting').validate({
        rules: {
            number_of_rows: {
                required: true,
            },
            people_to_approve: {
                required: true
            },
        },
        messages: {}
    });

    $('#lib_request_book').validate({
        rules: {
            book_name: {
                required: true,
                minlength: 10
            },
            book_url: {
                url: true
            },
            note_on_book: {
                required: true,
                minlength: 50
            }
        },
        messages: {
            book_name: {
                required: lang_msg.lg63,
                minlength: lang_msg.lg64
            },
            note_on_book: {
                required: lang_msg.lg65,
                minlength: lang_msg.lg66
            }
        }
    });

    $('#lib_edit_user_profile_form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            email: {
                email: true,
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
            },
            address: {
                required: true,
                minlength: 10,
                maxlength: 500,
            },
            course_name: {
                required: true
            },
            year_name: {
                required: true
            },
            city: {
                required: true,
            },
            zip: {
                required: true,
                minlength: 5,
            },
            state: {
                required: true,
            }

        },
        messages: {
            first_name: {
                required: lang_msg.lg19,
                minlength: lang_msg.lg20,
                maxlength: lang_msg.lg20
            },
            last_name: {
                required: lang_msg.lg23,
                minlength: lang_msg.lg24,
                maxlength: lang_msg.lg24
            },
            email: {
                email: lang_msg.lg27,
                required: lang_msg.lg28
            },
            phone: {
                required: lang_msg.lg29,
                minlength: lang_msg.lg30,
            },
            address: {
                required: lang_msg.lg31,
                minlength: lang_msg.lg32,
                maxlength: lang_msg.lg32
            },
            city: {
                required: lang_msg.lg34,
            },
            zip: {
                required: lang_msg.lg35,
            },
            state: {
                required: lang_msg.lg36
            },
            course_name: {
                required: lang_msg.lg73
            },
            year_name: {
                required: lang_msg.lg74
            },

        }
    });

    $('#lib_add_user_profile_form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            email: {
                email: true,
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
            },
            address: {
                required: true,
                minlength: 10,
                maxlength: 500,
            },
            course_name: {
                required: true
            },
            year_name: {
                required: true
            },
            city: {
                required: true,
            },
            zip: {
                required: true,
                minlength: 5,
            },
            state: {
                required: true,
            }

        },
        messages: {
            first_name: {
                required: lang_msg.lg19,
                minlength: lang_msg.lg20,
                maxlength: lang_msg.lg20
            },
            last_name: {
                required: lang_msg.lg23,
                minlength: lang_msg.lg24,
                maxlength: lang_msg.lg24
            },
            email: {
                email: lang_msg.lg27,
                required: lang_msg.lg28
            },
            phone: {
                required: lang_msg.lg29,
                minlength: lang_msg.lg30,
            },
            address: {
                required: lang_msg.lg31,
                minlength: lang_msg.lg32,
                maxlength: lang_msg.lg32
            },
            city: {
                required: lang_msg.lg34
            },
            zip: {
                required: lang_msg.lg37
            },
            state: {
                required: lang_msg.lg36
            },
            course_name: {
                required: lang_msg.lg73
            },
            year_name: {
                required: lang_msg.lg74
            },

        }
    });


    $.fn.pageMe = function (opts) {
        var $this = this,
            defaults = {
                activeColor: 'blue',
                perPage: 10,
                showPrevNext: false,
                nextText: '',
                prevText: '',
                hidePageNumbers: false
            },
            settings = $.extend(defaults, opts);

        var listElement = $this;
        var perPage = settings.perPage;
        var children = listElement.children();
        var pager = $('.pager');

        if (typeof settings.childSelector != "undefined") {
            children = listElement.find(settings.childSelector);
        }

        if (typeof settings.pagerSelector != "undefined") {
            pager = $(settings.pagerSelector);
        }

        var numItems = children.size();
        var numPages = Math.ceil(numItems / perPage);

        $("#total_reg").html(numItems + lang_msg.lg67);

        pager.data("curr", 0);

        if (settings.showPrevNext) {
            $('<li><a href="#" class="prev_link" title="' + settings.prevText + '"><i class="material-icons">chevron_left</i></a></li>').appendTo(pager);
        }

        var curr = 0;
        while (numPages > curr && (settings.hidePageNumbers == false)) {
            $('<li class="waves-effect"><a href="#" class="page_link">' + (curr + 1) + '</a></li>').appendTo(pager);
            curr++;
        }

        if (settings.showPrevNext) {
            $('<li><a href="#" class="next_link"  title="' + settings.nextText + '"><i class="material-icons">chevron_right</i></a></li>').appendTo(pager);
        }

        pager.find('.page_link:first').addClass('active');
        pager.find('.prev_link').hide();
        if (numPages <= 1) {
            pager.find('.next_link').hide();
        }
        pager.children().eq(1).addClass("active " + settings.activeColor);

        children.hide();
        children.slice(0, perPage).show();

        pager.find('li .page_link').click(function () {
            var clickedPage = $(this).html().valueOf() - 1;
            goTo(clickedPage, perPage);
            return false;
        });
        pager.find('li .prev_link').click(function () {
            previous();
            return false;
        });
        pager.find('li .next_link').click(function () {
            next();
            return false;
        });

        function previous() {
            var goToPage = parseInt(pager.data("curr")) - 1;
            goTo(goToPage);
        }

        function next() {
            goToPage = parseInt(pager.data("curr")) + 1;
            goTo(goToPage);
        }

        function goTo(page) {
            var startAt = page * perPage,
                endOn = startAt + perPage;

            children.css('display', 'none').slice(startAt, endOn).show();

            if (page >= 1) {
                pager.find('.prev_link').show();
            } else {
                pager.find('.prev_link').hide();
            }

            if (page < (numPages - 1)) {
                pager.find('.next_link').show();
            } else {
                pager.find('.next_link').hide();
            }

            pager.data("curr", page);
            pager.children().removeClass("active " + settings.activeColor);
            pager.children().eq(page + 1).addClass("active " + settings.activeColor);

        }
    };
    $('.confirmation').on('click', function () {
        return confirm(lang_msg.lg68);
    });
    if ($('#defaultOpen').length) {
        document.getElementById("defaultOpen").click();
    }
});

/* Handling Tab Function */
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
