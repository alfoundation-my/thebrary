iziToast.settings({
    timeout: 5000,
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX'
});
var table;
var app = angular.module('myApp', ['ngFileUpload', 'camera', 'ui.toggle', '720kb.tooltips']);
var limit_pg_no = 5000;
function resetForm(formName) {

    var validator = jQuery("#" + formName).validate();
    validator.resetForm();
    document.getElementById(formName).reset();
}
jQuery.fn.dataTable.ext.errMode = 'none';
function recreate_finetbl_data() {
    jQuery('.tbl_fine_dt').DataTable({'paging': true, "ordering": false, 'searching': false, 'lengthChange': false});
    jQuery("#DataTables_Table_0_info").parent().parent().prepend(jQuery("#fnd_detail_holder"));
}
function recreate_tblbook_data() {
    jQuery('.mng_book_cls').DataTable({
        'paging': true,
        "ordering": false,
        'searching': false,
        'lengthChange': false
    });
}
function recreate_tblusr_data() {
    jQuery('.mng_stud_tbl').DataTable({'paging': true, "ordering": false, 'searching': false, 'lengthChange': false});
}
function recreate_common_dt() {
    jQuery('.common_dt').DataTable({'paging': true, "ordering": false, 'searching': false, 'lengthChange': false});
}
function recreate_dues_dt() {
    jQuery('.mng_dues_cls').DataTable({'paging': true, "ordering": false, 'searching': false, 'lengthChange': false});
}


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

function refresh_Cnt_Approval_Book($scope) {

    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            "action": "getAllRequestBookNotAppovedCnt"
        },
        success: function (res) {
            if (res.data.length > 0) {
                $scope.cnt_not_approved = res.data[0].cnt;
            } else {
                $scope.cnt_not_approved = 0;
            }
            $scope.$digest();
        }
    });

}
app.controller('sideBarCtrl', function ($scope, $location) {
    refresh_Cnt_Approval_Book($scope);
    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    }
    $scope.isActive = function (viewLocation, ProfileName) {
        var active = (viewLocation === $location.$$absUrl);
        if (active) {

            if (ProfileName != '') {
                if (!jQuery("#" + ProfileName).hasClass("active")) {
                    jQuery("#" + ProfileName).click();
                    jQuery("#" + ProfileName).addClass("active");
                }
            }
        }
        return active;
    }
});

app.controller('changePasswordCtrl', function ($scope) {

    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    }
    $scope.updatePass = function () {
        $scope.frm_ChangePassData = {};
        if (jQuery("#lib_password_form").valid()) {

            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#lib_password_form").serialize(),
                success: function (res) {
                    showMessage(lang_msg.lg80, "OK", "success");

                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });

        }
    };
});

//region UpdateProfile
app.controller('changeProfileDataCtrl', function ($scope) {
    $scope.updateProfile = function () {
        $scope.frm_ChangePassData = {};
        if (jQuery("#lib_update_profile_form").valid()) {
            var form = jQuery("#lib_update_profile_form");
            var formData = new FormData(form[0]);
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res) {
                    if (res != "") {
                        res = jQuery.parseJSON(res);
                        showMessage(res.msg, res.header, res.color);
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        }
    };
});
//end region


function load_user_data_ajax(limit, pg_no, user_name, user_id, user_email, user_phone, compile_obj, scope_obj) {

    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'load_user_data',
            'limit': limit,
            'sname': user_name,
            'sid': user_id,
            'email': user_email,
            'phone': user_phone,
            'pg_no': pg_no,
            'form_name': scope_obj.form_name
        },
        success: function (res) {
            var temp = compile_obj(res.table_html)(scope_obj);
            jQuery("#user_container").html(temp);

        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });
    setTimeout(function () {

        recreate_tblusr_data();
    }, 3000);

}

app.controller('UserApprovalCtrl', function ($scope, $compile, $http) {
    $scope.form_name = "UserApprovalForm";
    load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
    $scope.user_approval_pg_no = limit_pg_no;
    $scope.onChangeUserId = function () {
        if ($scope.filter_userId.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_userId.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangeUserName = function () {
        if ($scope.filter_userName.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_userName.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangeEmail = function () {
        if ($scope.filter_email.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_email.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangePhone = function () {
        if ($scope.filter_phone.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_phone.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.btn_next = function () {
        if (localStorage.getItem("pg_nos") != "") {
            var next_pg = parseInt(localStorage.getItem("pg_nos")) + limit_pg_no;
            load_user_data_ajax(limit_pg_no, next_pg, "", "", "", "", $compile, $scope);
            localStorage.setItem("pg_nos", next_pg);
        }
    }
    $scope.btn_previous = function () {
        if (localStorage.getItem("pg_nos") != "") {
            var prev_pg = parseInt(localStorage.getItem("pg_nos")) - limit_pg_no;
            load_user_data_ajax(limit_pg_no, prev_pg, "", "", "", "", $compile, $scope);
            localStorage.setItem("pg_nos", prev_pg);
        }
    }
    $scope.btn_approve = function (event) {

        bootbox.confirm(lang_msg.lg79, function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        'action': 'admit_approval_user',
                        'approval_id': event.currentTarget.attributes.bind_id.nodeValue,
                    },
                    success: function (res) {
                        if (res.success) {
                            showMessage(lang_msg.lg78, "Success", "success");
                            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
                        }

                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });
            }
        });

    };
    $scope.btn_delete = function (event) {

        bootbox.confirm("Are your sure?", function (result) {
            if (result) {

                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        'action': 'delete_approval_check_book_issued',
                        'user_id': event.currentTarget.attributes.user_id.nodeValue,
                    },
                    success: function (res) {

                        if (res.success) {
                            bootbox.confirm(lang_msg.lg68, function (result) {
                                if (result) {
                                    jQuery.ajax({
                                        type: 'POST',
                                        url: myAjax.ajaxurl,
                                        dataType: 'JSON',
                                        data: {
                                            'action': 'delete_approval_user',
                                            'del_id': event.currentTarget.attributes.bind_id.nodeValue,
                                        },
                                        success: function (res) {
                                            res = JSON.parse(res);
                                            if (res.success) {
                                                showMessage(lang_msg.lg77, "Success", "success");
                                                load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
                                            }

                                        },
                                        error: function (xhr, status, error) {
                                            var err = eval("(" + xhr.responseText + ")");
                                            console.log(err.Message);
                                        }
                                    });
                                }
                            });
                        }

                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });

            }

        });
    };

});

function resetFormElement(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
}
function reseting_Book_DetailsForm($scope) {
    $scope.book_src = "";
    $scope.book_isbn = "";
    $scope.book_author = "";
    $scope.book_title = "";
    //$scope.book_category = "";
    $scope.book_publisher = "";
    $scope.book_desc = "";
    $scope.book_url = "";
    $scope.book_external_url = "";
    //$scope.book_price = "";
    $scope.book_qty = 1;
    $scope.book_tmp_image_link = "";
    $scope.not_img_found = false;
    resetFormElement(jQuery("#book_upload_pdf"));
    resetFormElement(jQuery("#book_upload_img"));
    $scope.$digest();
}

/* Adding Book Controller */
app.controller('AddBookCtrl', function ($scope, $compile, Upload, $http, $window) {
    $scope.not_img_found = false;
    $scope.book_qty = 1;
    $scope.visitUrl = function () {
        $window.open($scope.book_url, "_blank");
    }
    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    }


    $scope.saveBook = function () {
        if (jQuery("#book_add_form").valid()) {
            jQuery.blockUI({
                message: "Please wait...."
            });
            if ($scope.book_category == "") {
                $scope.book_category = "Common";
            }
            var form = jQuery("#book_add_form");
            var formData = new FormData(form[0]);
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    res = jQuery.parseJSON(res);

                    if (res != "") {
                        if (res.success) {
                            showMessage(res.msg, res.header, res.color);
                            reseting_Book_DetailsForm($scope);
                        }
                    }
                    if (res.success == false) {
                        showMessage(res.msg, res.header, "info");
                        if (res.msg.indexOf("Isbn") >= 0) {
                            bootbox.confirm(lang_msg.lg76, function (result) {
                                if (result) {
                                    jQuery.ajax({
                                        type: 'POST',
                                        url: myAjax.ajaxurl,
                                        dataType: 'JSON',
                                        data: {
                                            'action': 'add_sub_book_data',
                                            'book_isbn': $scope.book_isbn,
                                            'book_qty': $scope.book_qty
                                        },
                                        success: function (res) {
                                            if (res.success) {
                                                showMessage(res.msg, res.header, res.color);
                                                reseting_Book_DetailsForm($scope);
                                            }
                                            if (res.success == false) {
                                                showMessage(res.msg, "Failed", "error");
                                            }

                                        }
                                    });
                                }
                            });
                        }
                    }
                    jQuery.unblockUI();
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                    jQuery.unblockUI();
                }
            });
        }
    }

    /*Tracking Change in Custom Image Link*/
    $scope.set_img = function () {
        var url = $scope.book_tmp_image_link;
        if (url.includes('.jpg') || url.includes('.jpeg') || url.includes('.png')) {
            $scope.book_src = $scope.book_tmp_image_link;
        } else {
            $scope.book_src = '';
        }

    }
    /* Getting The ISBN Information*/
    $scope.look_for_book = function () {
        if ($scope.book_isbn !== undefined) {
            if ($scope.book_isbn.length >= 6) {
                jQuery.ajax({
                    type: 'GET',
                    url: "https://www.googleapis.com/books/v1/volumes?q=isbn:" + $scope.book_isbn.replace("-", ""),
                    dataType: 'JSON',
                    beforeSend: function () {
                        showMessage(lang_msg.lg75, "Status", "info");
                    },
                    success: function (res) {
                        if (typeof res.items != "undefined") {

                            $scope.book_url = res.items[0]["volumeInfo"]["previewLink"];
                            //$scope.book_category = res.items[0]["volumeInfo"]["categories"];
                            $scope.book_publisher = res.items[0]["volumeInfo"]["publisher"];
                            jQuery("#book_goo_id").val(res.items[0]["id"]);
                            $scope.book_author = res.items[0]["volumeInfo"]["authors"][0];
                            $scope.book_desc = res.items[0]["volumeInfo"]["description"];
                            $scope.book_title = res.items[0]["volumeInfo"]["title"];
                            $scope.book_src = res.items[0]["volumeInfo"]["imageLinks"]["smallThumbnail"];
                            jQuery("#book_src").val($scope.book_src);
                            $scope.not_img_found = false;
                            $scope.$digest();
                            hide_msg();
                        } else {
                            hide_msg();
                            showMessage(lang_msg.lg72, "Status", "info");
                            $scope.not_img_found = true;
                            $scope.$digest();
                        }
                    }
                });
            }
        }

    }
});

app.controller('institutionSetupCtrl', function ($scope, $compile, $http, $window) {

    $scope.saveInstitution = function () {

        if (jQuery('#lib_manage_inst_form_profile').valid()) {
            var form = jQuery("#lib_manage_inst_form_profile");
            var formData = new FormData(form[0]);
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                contentType: false,
                processData: false,
                data: formData,
                success: function (res) {
                    res = JSON.parse(res);
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                    }
                    if (res.success == false) {
                        showMessage(res.msg, res.header, res.color);
                    }
                }

            });
        }

    };
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }

});

function loadYear(compile_obj, scope_obj) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'loadYearForm'
        },
        success: function (res) {
            var temp = compile_obj(res.dynamic_html)(scope_obj);
            jQuery("#tblBodyYear").html(temp);

        }
    });

}
app.controller('saveYearsCtrl', function ($scope, $compile, $http, $window) {

    loadYear($compile, $scope);

    $scope.addYearsbtn = function () {
        if (jQuery('#addYearsForm').valid()) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#addYearsForm").serialize(),
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        loadYear($compile, $scope);
                        jQuery("#inlineFormYear").val("");
                    }

                }
            });
        }
    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.editformbtn = function (id, data) {
        $scope.current_Id = id;
        $scope.edit_year = data;
        jQuery('#edtModalForm').modal('show');
    }
    $scope.updatebtn = function () {
        if ($scope.edit_year != "") {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'manageYearForm',
                    'id': $scope.current_Id,
                    'inlineFormYear': $scope.edit_year,
                    'todo': 'update'
                },
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        jQuery('#edtModalForm').modal('hide');
                        loadYear($compile, $scope);
                    }

                }
            });
        } else {
            showMessage(lang_msg.lg71, "Information", "info");
        }
    }
    $scope.delbtn = function (id) {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'manageYearForm',
                'id': id,
                'todo': 'delete'
            },
            success: function (res) {
                if (res.success) {
                    showMessage(res.msg, res.header, res.color);
                    loadYear($compile, $scope);
                }

            }
        });
    }
});

function loadCourse(compile_obj, scope_obj) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'loadCourseForm'
        },
        success: function (res) {
            var temp = compile_obj(res.dynamic_html)(scope_obj);
            jQuery("#tblBodyCourse").html(temp);

        }
    });

}
app.controller('saveCourseCtrl', function ($scope, $compile, $http, $window) {

    loadCourse($compile, $scope);

    $scope.addCoursesbtn = function () {
        if (jQuery('#addCoursesForm').valid()) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#addCoursesForm").serialize(),
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        loadCourse($compile, $scope);
                        jQuery("#inlineFormCourse").val("");
                    }

                }
            });
        }
    }
    $scope.editformbtn = function (id, data) {
        $scope.current_Id = id;
        $scope.edit_Course = data;
        jQuery('#edtModalForm').modal('show');
    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.updatebtn = function () {
        if ($scope.edit_Course != "") {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'manageCourseForm',
                    'id': $scope.current_Id,
                    'inlineFormCourse': $scope.edit_Course,
                    'todo': 'update'
                },
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        jQuery('#edtModalForm').modal('hide');
                        loadCourse($compile, $scope);
                    }

                }
            });
        } else {
            showMessage(lang_msg.lg71, "Information", "info");
        }
    }
    $scope.delbtn = function (id) {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'manageCourseForm',
                'id': id,
                'todo': 'delete'
            },
            success: function (res) {
                if (res.success) {
                    showMessage(res.msg, res.header, res.color);
                    loadCourse($compile, $scope);
                }

            }
        });
    }
});


app.controller('userProfileAddCtrl', function ($scope, $compile, $http, $window, Upload) {

    jQuery("#phone").numeric();
    $scope.vm = {};
    $scope.$watch('vm.picture', function () {
        if ($scope.vm.picture != undefined) {
            jQuery("#photo_code").val($scope.vm.picture);
        }
    });
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    // ** Uploading and getting the image id ** //
    jQuery("#upload_img").change(function () {
        jQuery.ajax({
            url: myAjax.ajaxurl,
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(jQuery("#upload_user_img_form")[0]),
            type: 'post',
            success: function (res) {
                debugger;
                res = JSON.parse(res);
                if (res.success) {
                    jQuery("#photo_code").val(res.attach_id);
                }
            }
        });

    });

    $scope.addUserbtn = function () {

        if (jQuery('#lib_add_user_profile_form').valid()) {
            var form = jQuery("#lib_add_user_profile_form");
            var formData = new FormData(form[0]);

            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res) {
                    res = JSON.parse(res);
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        resetForm('lib_add_user_profile_form');
                    } else {
                        showMessage(res.msg, res.header, res.color);
                        resetForm('lib_add_user_profile_form');
                    }

                }
            });
        }

    }

});

app.controller('UserManagementCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {
    $scope.form_name = "UserManagement";
    load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
    $scope.user_approval_pg_no = limit_pg_no;
    $scope.vm = {};
    $scope.$watch('vm.picture', function () {

        if ($scope.vm.picture != undefined && $scope.vm.picture != "") {
            jQuery("#photo_code").val($scope.vm.picture);
        }
    });
    // ** Uploading and getting the image id ** //
    jQuery("#upload_img_edit").change(function () {
        debugger;
        jQuery.ajax({
            url: myAjax.ajaxurl,
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(jQuery("#upload_user_img_edit_form")[0]),
            type: 'post',
            success: function (res) {
                debugger;
                res = JSON.parse(res);
                if (res.success) {
                    jQuery("#photo_code").val(res.attach_id);
                }
            }
        });
    });
    $scope.onChangeUserId = function () {
        if ($scope.filter_userId.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_userId.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangeUserName = function () {
        if ($scope.filter_userName.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_userName.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangeEmail = function () {
        if ($scope.filter_email.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_email.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.onChangePhone = function () {
        if ($scope.filter_phone.length >= 3) {
            load_user_data_ajax(limit_pg_no, 0, $scope.filter_userName, $scope.filter_userId, $scope.filter_email, $scope.filter_phone, $compile, $scope);
        } else if ($scope.filter_phone.length == 0) {
            load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
        }
    }
    $scope.btn_next = function () {
        if (localStorage.getItem("pg_nos") != "") {
            var next_pg = parseInt(localStorage.getItem("pg_nos")) + limit_pg_no;
            load_user_data_ajax(limit_pg_no, next_pg, "", "", "", "", $compile, $scope);
            localStorage.setItem("pg_nos", next_pg);
        }
    }
    $scope.btn_previous = function () {
        if (localStorage.getItem("pg_nos") != "") {
            var prev_pg = parseInt(localStorage.getItem("pg_nos")) - limit_pg_no;
            load_user_data_ajax(limit_pg_no, prev_pg, "", "", "", "", $compile, $scope);
            localStorage.setItem("pg_nos", prev_pg);
        }
    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.btn_edit = function (event) {

        $scope.vm.picture = "";
        $scope.vm.oldpicture = "";
        jQuery("#attach_photo_id").val("0");
        var zip = jQuery("#zip" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.first_name = jQuery("#fname" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.last_name = jQuery("#lname" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.email = jQuery("#email" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.phone = jQuery("#phone" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.user_id = jQuery("#user_id_" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.user_pic = jQuery("#user_pic" + event.currentTarget.attributes.bind_id.nodeValue).val();

        jQuery("#user_id").val($scope.user_id);
        jQuery("#old_pic_id").val($scope.user_pic);

        $scope.year_name = jQuery("#level_name" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.course_name = jQuery("#course_name" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.state_name = jQuery("#state" + event.currentTarget.attributes.bind_id.nodeValue).val();
        if ($scope.year_name == 0) {
            $scope.year_name = "";
        }
        if ($scope.course_name == 0) {
            $scope.course_name = "";
        }
        if ($scope.state_name == 0) {
            $scope.state_name = "";
        }
        jQuery("#year_name").val($scope.year_name);
        jQuery("#course_name").val($scope.course_name);
        jQuery("#state_name").val($scope.state_name);
        jQuery("#city").val(jQuery("#city" + event.currentTarget.attributes.bind_id.nodeValue).val());
        jQuery("#role").val(jQuery("#role" + event.currentTarget.attributes.bind_id.nodeValue).val());
        $scope.vm.oldpicture = $scope.state_name = jQuery("#user_pic_url" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.address = jQuery("#address" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.note = jQuery("#note" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.zip = jQuery("#zip" + event.currentTarget.attributes.bind_id.nodeValue).val();

        jQuery("#editUserModel").modal("show");

    }
    $scope.btn_delete = function (event) {
        bootbox.confirm("Are your sure?", function (result) {

            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    data: {
                        'action': 'delete_approval_check_book_issued',
                        'user_id': event.currentTarget.attributes.user_id.nodeValue
                    },
                    success: function (res) {
                        res = JSON.parse(res);
                        if (res.success) {

                            if (res.data != "") {

                                showMessage("There are some book like :" + res.data + " .<br/>Kidnly return the books before deactivating the user!.", "Info", "info");

                            } else {

                                jQuery.ajax({
                                    type: 'POST',
                                    url: myAjax.ajaxurl,
                                    data: {
                                        'action': 'delete_approval_user',
                                        'del_id': event.currentTarget.attributes.bind_id.nodeValue,
                                        'user_id': event.currentTarget.attributes.user_id.nodeValue,
                                    },
                                    success: function (res) {
                                        res = JSON.parse(res);
                                        if (res.success) {
                                            showMessage(lang_msg.lg70, "Success", "success");
                                            location.reload();
                                            //load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
                                        }

                                    },
                                    error: function (xhr, status, error) {
                                        var err = eval("(" + xhr.responseText + ")");
                                        console.log(err.Message);
                                    }
                                });

                            }

                        }

                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });
            }

        });
    };

    $scope.updateUserbtn = function () {
        if (jQuery('#lib_edit_user_profile_form').valid()) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#lib_edit_user_profile_form").serialize(),
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, "Success", "success");
                        //jQuery('#lib_edit_user_profile_form').trigger("reset");
                        jQuery("#editUserModel").modal("hide");
                        load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
                    } else {
                        showMessage(res.msg, "Information", "info");
                        //jQuery('#lib_edit_user_profile_form').trigger("reset");;
                        jQuery("#editUserModel").modal("hide");
                        load_user_data_ajax(limit_pg_no, 0, "", "", "", "", $compile, $scope);
                    }

                }
            });
        }
    }

    $scope.printScope = {};
    $scope.btn_viewprint = function (event) {
        jQuery("#printUserIdModal").modal("show");
        $scope.printScope.name = jQuery("#fname" + event.currentTarget.attributes.bind_id.nodeValue).val() + " " + jQuery("#lname" + event.currentTarget.attributes.bind_id.nodeValue).val();
        //$scope.printScope.last_name  		= jQuery("#lname"+event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.printScope.email = jQuery("#email" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.printScope.phone = jQuery("#phone" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.printScope.user_id = jQuery("#user_id_" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.printScope.user_pic_id = jQuery("#user_pic" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.printScope.srcPic = jQuery("#user_pic_url" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.printScope.role = jQuery("#role" + event.currentTarget.attributes.bind_id.nodeValue).val();
        $scope.printScope.year_name = jQuery("#n_level_name" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.printScope.course_name = jQuery("#n_course_name" + event.currentTarget.attributes.bind_id.nodeValue).html();
        $scope.printScope.address = jQuery("#address" + event.currentTarget.attributes.bind_id.nodeValue).html();

    }
    $scope.printPreview = function () {
        var params = [
            'height=' + screen.height,
            'width=' + screen.width,
            'fullscreen=yes' // only works in IE, but here for completeness
        ].join(',');
        var divContents = jQuery("#print_Container").html();
        var printWindow = window.open('', '', params);
        printWindow.document.write('<html><head><title>Identity Card</title><style type="text/css">#p_tbl1,#p_tbl2{width:65% !important;float: none !important;height: 329px !important;border-collapse: inherit !important;}#p_stamp {height: 118px !important;}.list-group-item{padding: 2px 15px !important;}</style><link href="' + myAjax.boostrap_loc + '" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        //printWindow.print();
    }

});

function load_sub_book_data($scope) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'load_specific_book_data',
            'bid': $scope.selected_Book_ID
        },
        success: function (res) {
            $scope.sub_book_data = res.data;
            $scope.$digest();
        }
    });
}
function load_book_data_ajax(limit, pg_no, book_name, book_isbn, book_id, compile_obj, scope_obj) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'load_all_book_data',
            'limit': limit,
            'bname': book_name,
            'bisbn': book_isbn,
            'pg_no': pg_no
        },
        success: function (res) {
            var temp = compile_obj(res.table_html)(scope_obj);
            jQuery("#tb_managebook_container").html(temp);
            recreate_tblbook_data();
        }
    });
}

app.controller('managementofbooksCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {
    load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
    jQuery("#select_book_price").numeric();
    $scope.it_contains = true;
    $scope.demo = {};
    $scope.onISBNChange = function () {
        if ($scope.filter_ISBN.length != undefined && $scope.filter_ISBN.length >= 3) {
            load_book_data_ajax(limit_pg_no, 0, "", $scope.filter_ISBN, "", $compile, $scope);
        } else if ($scope.filter_ISBN.length == 0) {
            load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
        }
    }
    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    }
    $scope.onBookName = function () {
        if ($scope.filter_BookName.length != undefined && $scope.filter_BookName.length >= 3) {
            load_book_data_ajax(limit_pg_no, 0, $scope.filter_BookName, "", "", $compile, $scope);
        } else if ($scope.filter_BookName.length == 0) {
            load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
        }
    }
    $scope.btn_showAll = function (book_id) {
        $scope.selected_Book_Name = jQuery("#book_tit_" + book_id).html();
        $scope.selected_Book_ID = book_id;
        $scope.old_book_img = jQuery("#book_img_" + book_id).html();
        $scope.old_book_pdf = jQuery("#book_pdf_" + book_id).html();
        load_sub_book_data($scope);
        jQuery("#editBookData").modal("show");

    }
    $scope.btn_updateBookInfo = function () {
        jQuery.blockUI({
            message: "Please wait...."
        });
        var form = jQuery("#frmUpdateBookDetails");
        var formData = new FormData(form[0]);
        if (jQuery("#frmUpdateBookDetails").valid()) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res) {
                    if (res != "") {
                        res = JSON.parse(res);
                        if (res.success) {
                            load_sub_book_data($scope);
                            load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
                            showMessage(res.msg, res.header, res.color);
                            resetFormElement(jQuery("#book_img_upload"));
                            resetFormElement(jQuery("#book_pdf_upload"));
                            jQuery.unblockUI();
                        }
                    }
                }
            });
            jQuery("#editSelectedBookData").modal("hide");
        }
    }
    $scope.btn_editBookDetails = function (x) {
        $scope.selected_book_title = jQuery("#book_title_" + x).val();
        $scope.select_book_category = jQuery("#book_category_" + x).val();
        $scope.selected_book_publisher = jQuery("#book_publisher_" + x).val();
        $scope.select_book_author = jQuery("#book_author_" + x).val();
        $scope.select_book_price = jQuery("#book_price_" + x).val();
        $scope.selected_book_desc = jQuery("#book_desc_" + x).val();
        //$scope.select_book_img = jQuery("#book_img_" + x).val();
        $scope.select_book_preview_lnk = jQuery("#book_pdf_" + x).val();
        jQuery("#select_book_img").val(jQuery("#book_img_id_" + x).val());
        jQuery("#select_book_preview_lnk").val(jQuery("#book_pdf_" + x).val());
        jQuery("#select_book_external_url").val(jQuery("#book_eurl_" + x).val());
        jQuery("#selected_book_id").val(x);
        $scope.selected_book_id = x;
        jQuery("#editSelectedBookData").modal("show");
    }
    $scope.btn_delBookDetails = function ($book_id) {
        bootbox.confirm(lang_msg.lg69, function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        'action': 'delete_book_info',
                        'bid': $book_id
                    },
                    success: function (res) {
                        if (res.success) {
                            showMessage(res.msg, res.header, res.color);
                            location.reload();
                        }
                    }
                });
            }
        });
    }
    $scope.onBookchanged = function ($x) {
        $book_id = $x.BookId;
        $available = $x.Available;
        $active = $x.Active;
        if ($available != 0) {

            $scope.toogle_status = 0;
            if ($scope.demo.toggleValue[$book_id]) {
                $scope.toogle_status = 1;
            }
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'update_specific_book_data',
                    'bid': $book_id,
                    'status': $scope.toogle_status,
                    'mbookid': $scope.selected_Book_ID
                },
                success: function (res) {
                    load_sub_book_data($scope);
                    load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
                    if ($scope.filter_BookName !== undefined && $scope.filter_BookName.length >= 3) {
                        load_book_data_ajax(limit_pg_no, 0, $scope.filter_BookName, "", "", $compile, $scope);
                    } else if ($scope.filter_BookName !== undefined && $scope.filter_BookName.length == 0) {
                        load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
                    }
                    if ($scope.filter_ISBN !== undefined && $scope.filter_ISBN.length >= 3) {
                        load_book_data_ajax(limit_pg_no, 0, "", $scope.filter_ISBN, "", $compile, $scope);
                    } else if ($scope.filter_ISBN !== undefined && $scope.filter_ISBN.length == 0) {
                        load_book_data_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
                    }

                }
            });
        } else {
            if ($active == '0') {
                $scope.demo.toggleValue[$book_id] = 'false';
            } else {
                $scope.demo.toggleValue[$book_id] = 'true';
            }
            showMessage(lang_msg.lg53, "Info", "warning");
        }

    }
});

function load_book_data_user_ajax(limit, pg_no, book_name, book_isbn, book_id, compile_obj, scope_obj) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'load_all_book_user_data',
            'limit': limit,
            'bname': book_name,
            'bisbn': book_isbn,
            'pg_no': pg_no
        },
        success: function (res) {

            var temp = compile_obj(res.table_html)(scope_obj);
            jQuery("#tb_managebook_container").html(temp);


        }
    });
}

app.controller('ListofbooksUserCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    load_book_data_user_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
    $scope.onISBNChange = function () {
        if ($scope.filter_ISBN.length != undefined && $scope.filter_ISBN.length >= 3) {
            load_book_data_user_ajax(limit_pg_no, 0, "", $scope.filter_ISBN, "", $compile, $scope);
        } else if ($scope.filter_ISBN.length == 0) {
            load_book_data_user_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
        }
    }
    $scope.onBookName = function () {
        if ($scope.filter_BookName.length != undefined && $scope.filter_BookName.length >= 3) {
            load_book_data_user_ajax(limit_pg_no, 0, $scope.filter_BookName, "", "", $compile, $scope);
        } else if ($scope.filter_BookName.length == 0) {
            load_book_data_user_ajax(limit_pg_no, 0, "", "", "", $compile, $scope);
        }
    }

});

app.controller('issueBookCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    //jQuery('#book_date_borrowed').datetimepicker({inline:true});
    $scope.vm = {};
    $scope.user_idChange = function () {
        if ($scope.user_id.length >= 4) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'get_user_details',
                    'user_id': $scope.user_id
                },
                success: function (res) {
                    if (res.data.length > 0) {
                        jQuery.ajax({
                            type: 'POST',
                            url: myAjax.ajaxurl,
                            dataType: 'JSON',
                            data: {
                                "action": "getSrcFromID",
                                "img_id": res.data[0].UserPic
                            },
                            success: function (res) {
                                if (res.success) {
                                    if (res.src != null)
                                        $scope.vm.studpic = decodeURIComponent(res.src);
                                    else
                                        $scope.vm.studpic = "";

                                    $scope.$digest();
                                }
                            }
                        });

                        $scope.user_name = res.data[0].FirstName + " " + res.data[0].LastName;
                        $scope.address = res.data[0].Address;
                        $scope.phone = res.data[0].Phone;
                        $scope.email = res.data[0].Email;
                        if ($scope.book_no != undefined && $scope.book_no != "" && $scope.book_title != "") {
                            $scope.btn_issue_status = false;
                        }

                        $scope.$digest();
                    } else {
                        $scope.vm.studpic = null;
                        $scope.user_name = null;
                        $scope.address = null;
                        $scope.phone = null;
                        $scope.email = null;
                        $scope.btn_issue_status = true;
                        $scope.$digest();

                    }
                }
            });
        } else {
            $scope.vm.studpic = null;
            $scope.user_name = null;
            $scope.address = null;
            $scope.phone = null;
            $scope.email = null;
            $scope.btn_issue_status = true;
        }
    }
    $scope.issueBookBtn = function () {
        if (jQuery("#lib_issue_book_form").valid()) {
            jQuery.blockUI({
                message: "Please wait...."
            });
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#lib_issue_book_form").serialize(),
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        $scope.btn_issue_status = true;
                        $scope.vm.picture = null;
                        $scope.book_title = null;
                        $scope.qty = null;
                        $scope.price = null;
                        $scope.borrowed = null;
                        $scope.isbn = null;
                        $scope.vm.studpic = null;
                        $scope.user_name = null;
                        $scope.address = null;
                        $scope.phone = null;
                        $scope.email = null;
                        $scope.book_no = null;
                        $scope.user_id = null;
                        $scope.btn_issue_status = true;
                        $scope.book_date_borrowed = null;
                        $scope.book_date_due = null;
                        $scope.$digest();
                        jQuery.unblockUI();
                        //jQuery("#lib_issue_book_form").find("input[type=text], textarea").val("");
                    }
                }
            });
        }
    }

    $scope.onBookNoChange = function () {
        if ($scope.book_no.length > 6) {
            jQuery.blockUI({
                message: "Please wait...."
            });
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'get_book_details',
                    'book_id': $scope.book_no
                },
                success: function (res) {
                    jQuery.unblockUI();
                    if (res.data.length == 1) {
                        $scope.pic_id = res.data[0].MainCoverId;
                        $scope.pic_url = res.data[0].MainCoverUrl;
                        jQuery.ajax({
                            type: 'POST',
                            url: myAjax.ajaxurl,
                            dataType: 'JSON',
                            data: {
                                "action": "getSrcFromID",
                                "img_id": $scope.pic_id
                            },
                            success: function (res) {
                                if (res.success) {
                                    if (res.src != null)
                                        $scope.vm.picture = decodeURIComponent(res.src);
                                    else
                                        $scope.vm.picture = "";
                                    $scope.$digest();
                                }
                            }
                        });

                        $scope.book_title = res.data[0].BookTitle;
                        $scope.qty = res.data[0].Qty;
                        $scope.price = res.data[0].Price;
                        $scope.borrowed = res.data[0].Borrowed;
                        $scope.isbn = res.data[0].ISBN;
                        if ($scope.user_id != undefined && $scope.user_id != "" && $scope.book_no != undefined && $scope.book_no != "" && $scope.book_title != "") {
                            $scope.btn_issue_status = false;
                        }
                        $scope.$digest();
                    } else {

                        $scope.vm.picture = "";
                        $scope.book_title = "";
                        if (res.msg != null) {
                            showMessage(res.msg, "Info", "success");
                        } else {
                            showMessage(lang_msg.lg52, "Info", "info");
                            $scope.btn_issue_status = true;
                        }
                        $scope.qty = "N/A";
                        $scope.price = "N/A";
                        $scope.borrowed = "N/A";
                        $scope.isbn = "N/A";
                        $scope.btn_issue_status = true;
                        $scope.$digest();
                    }
                }
            });
        } else {
            $scope.btn_issue_status = true;
            $scope.vm.picture = null;
            $scope.book_title = null;
            $scope.qty = null;
            $scope.price = null;
            $scope.borrowed = null;
            $scope.isbn = null;
        }
    }
});

function load_all_issued_books_ajax(limit, pg_no, user_id, book_id, compile_obj, scope_obj, todo) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_all_issued_book',
            'limit': limit,
            'book_id': book_id,
            'user_id': user_id,
            'pg_no': pg_no,
            'todo': todo
        },
        success: function (res) {
            scope_obj.issue_book_db = res.data;
            scope_obj.$digest();
            recreate_common_dt();
        }
    });

}

function load_specific_issued_books_ajax(limit, pg_no, user_id, book_id, compile_obj, scope_obj, todo) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_specific_issued_book',
            'limit': limit,
            'book_id': book_id,
            'user_id': user_id,
            'pg_no': pg_no,
            'todo': todo
        },
        success: function (res) {
            scope_obj.issue_book_db = res.data;
            scope_obj.$digest();

        }
    });
}

app.controller('managementofissuedbooksUserCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {

    load_all_issued_books_ajax(limit_pg_no, 0, jQuery("#user_id").val(), "", $compile, $scope, "");
    $scope.AjUserId = jQuery("#user_id").val();
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.diffDate = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            diffDays = diffDays * -1;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
        }
        return diffDays;
    };
    $scope.openPaymentPage = function (x) {
        var delayed_days = $scope.diffDate(x.DateToReturn);
        var per_day_fine = myAjax.defined_fine;
        var fine_cust = 0;
        if (delayed_days < 0) {
            fine_cust = -1 * delayed_days * per_day_fine;
        }
        $scope.delayed_in_days = delayed_days * -1;
        $scope.per_day_fine = per_day_fine;
        $scope.due_to_pay = fine_cust;
        $scope.user_id = x.UserId;
        $scope.date_to_return = x.DateToReturn;
        $scope.date_borrowed = x.DateBorrowed;
        $scope.user_id = x.UserId;
        $scope.book_id = x.BookId;
        $scope.paid_for_entry = x.Id;
        //jQuery("#merchant_param1").val("Late fine for Book Name : " + x.BookName);
        //jQuery("#billing_name").val(x.UserName);
        jQuery("#amount").val(fine_cust);
        jQuery("#user_id").val(x.UserId);
        jQuery("#book_id").val(x.BookId);
        //jQuery("#merchant_param4").val(x.Id);
        jQuery("#paymentStep1").modal("show");
        $scope.v1 = x.DateBorrowed;
        $scope.v2 = x.DateToReturn;
        $scope.v3 = delayed_days * -1;
        //$scope.$digest();
    }
    // $scope.btn_pay_due = function (x) {
    //     jQuery.ajax({
    //         type: 'POST',
    //         url: myAjax.ajaxurl,
    //         dataType: 'JSON',
    //         data: {
    //             'action': 'get_paypal_request_url',
    //             'user_id': jQuery("#user_id").val(),
    //             'delayed_days': $scope.v3,
    //             'amount': $scope.due_to_pay
    //         },
    //         success: function (res) {
    //             if (res.success) {
    //                 debugger;
    //                 //showMessage(res.msg, res.header, res.color);
    //                 window.location = res["url"];
    //                 //location.reload();
    //             }
    //
    //         }
    //     });
    // }

});

app.filter('cmdate', [
    '$filter', function ($filter) {
        return function (input, format) {
            return $filter('date')(new Date(input), format);
        };
    }
]);

app.controller('managementofissuedbooksCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {

    load_all_issued_books_ajax(limit_pg_no, 0, "", "", $compile, $scope, "");
    jQuery("#fine").numeric();
    $scope.selected_data = {};
    $scope.obj = {};
    var today_d = new Date();
    var min_date = new Date();
    min_date.setDate(today_d.getDate());

    $scope.now = new Date().getTime();

    jQuery('#date_of_return').datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        startDate: min_date,
        defaultDate: min_date
    });

    jQuery("#i_sendsms").hide();
    $scope.todo = "Email";
    jQuery('.rtodo').on('change', function () {
        var sel = jQuery('input[name=radiotodo]:checked').val();
        if (sel == "email") {
            jQuery("#i_sendemail").show();
            jQuery("#i_sendsms").hide();
            $scope.todo = "Email";
        } else {
            jQuery("#i_sendemail").hide();
            jQuery("#i_sendsms").show();
            $scope.todo = "Sms";
        }
        $scope.$digest();
    });


    $scope.btn_returnBook = function () {
        if ($scope.date_of_return != undefined && $scope.date_of_return != "") {
            jQuery.blockUI({
                message: lang_msg.lg51,
                baseZ: 10000,
            });
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'return_issued_book',
                    'book_no': $scope.selected_data.bookno,
                    'user_id': $scope.selected_data.user_id,
                    'notes': $scope.notes,
                    'fine': $scope.fine,
                    'book_return_date': $scope.date_of_return,
                    'delay_day': $scope.selected_data.delay_day,
                    'uid': $scope.selected_data.uid,
                },
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                        load_all_issued_books_ajax(limit_pg_no, 0, "", "", $compile, $scope, "");
                        jQuery("#editReturnBookData").modal("hide");
                        jQuery.unblockUI();
                        //location.reload();
                    }

                }
            });
        }

    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.formDate = function (date) {
        return new Date(date).getTime();
    }
    $scope.btn_view = function (x) {
        $scope.selected_data.bookno = x.BookId;
        $scope.selected_data.user_id = x.UserId;
        $scope.selected_data.delay_day = $scope.diffDate(x.DateToReturn);
        $scope.selected_data.uid = x.Id;
        var fine_cust = 0;
        if ($scope.selected_data.delay_day < 0) {
            fine_cust = -1 * $scope.selected_data.delay_day * myAjax.defined_fine;
        }
        jQuery("#fine").val(fine_cust);
        jQuery("#editReturnBookData").modal("show");
    }

    $scope.diffDate = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            diffDays = diffDays * -1;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
        }
        return diffDays;
    };
    $scope.classMng = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            if (diffDays == 0) {
                return false;
            }
            return true;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
            return false;
        }
    };

    $scope.viewSmsModal = function (x) {
        $scope.sms_mob_status = true;
        $scope.email_status = true;
        $scope.sms_mob = x.UserPhone;
        $scope.s_email = x.UserEmail;
        $scope.email_body = lang_msg.lg49 + " {" + x.BookName + "} " + lang_msg.lg50;
        $scope.sms_body = lang_msg.lg49 + " {" + x.BookName + "} " + lang_msg.lg50;
        jQuery("#sendSmsModal").modal("show");

        //$scope.s_email = x.User
    }
    $scope.btn_sendEmail = function () {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'send_email_ajx',
                'email': $scope.s_email,
                'body': $scope.email_body
            },
            success: function (res) {
                if (res.success) {
                    showMessage(res.msg, res.header, res.color);
                    jQuery("#sendSmsModal").modal("hide");
                }

            }
        });

    }
    $scope.btn_sendSms = function () {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'send_sms',
                'phone': $scope.sms_mob,
                'message': $scope.sms_body
            },
            success: function (res) {
                if (res.success) {
                    showMessage(res.msg, "OK", "success");
                    jQuery("#sendSmsModal").modal("hide");
                } else {
                    showMessage(res.msg, "OK", "info");
                    jQuery("#sendSmsModal").modal("hide");
                }

            }
        });
    }
    $scope.reset_sms_mob = function () {
        if ($scope.sms_mob_status) {
            $scope.sms_mob_status = false;
        } else {
            $scope.sms_mob_status = true;
        }
    }
    $scope.edit_email = function () {
        if ($scope.email_status) {
            $scope.email_status = false;
        } else {
            $scope.email_status = true;
        }

    }

});

function parseDate(input) {
    var parts = input.split('-');
    // Note: months are 0-based
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

app.controller('archiveReturnCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $filter) {
    load_all_issued_books_ajax(limit_pg_no, 0, "", "", $compile, $scope, "1");

    var today_d = new Date();
    var min_date = new Date();
    min_date.setDate(today_d.getDate());

    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }

    $scope.now = new Date().getTime();

    $scope.do_class = function (data) {
        if (data > 0) {
            return true;
        } else {
            return false;
        }
    }
    $scope.diffDate = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            diffDays = diffDays * -1;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
        }
        return diffDays;
    };

});


app.controller('archiveUserBookReturnCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $filter) {
    load_all_issued_books_ajax(limit_pg_no, 0, jQuery("#user_id").val(), "", $compile, $scope, "1");

    var today_d = new Date();
    var min_date = new Date();
    min_date.setDate(today_d.getDate());

    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }

    $scope.now = new Date().getTime();

    $scope.do_class = function (data) {
        if (data > 0) {
            return true;
        } else {
            return false;
        }
    }
    $scope.diffDate = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            diffDays = diffDays * -1;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
        }
        return diffDays;
    };

});


app.controller('forgotPasswordCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

    $scope.btn_GetPassword = function () {
        if ($scope.user_name != "") {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    "action": "get_Password",
                    "user_email": $scope.user_email
                },
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, res.header, res.color);
                    }
                }
            });
        }
    }
    $scope.redirect = function (path) {
        $window.open(path, "_blank");
    }

});

app.controller('otherSettingsCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

    jQuery("#people_to_approve").numeric();
    $scope.saveSettings = function () {
        if (jQuery("#lib_manage_other_seting").valid()) {
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: jQuery("#lib_manage_other_seting").serialize(),
                success: function (res) {
                    showMessage(res.msg, res.header, res.color);
                }
            });

        }
    }

});

app.controller('viewUserRequestBookCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {
    load_all_request($scope);
    $scope.sendRequest = function () {
        if (jQuery("#lib_request_book").valid()) {
            bootbox.confirm(lang_msg.lg48, function (result) {
                if (result) {
                    jQuery.ajax({
                        type: 'POST',
                        url: myAjax.ajaxurl,
                        dataType: 'JSON',
                        data: jQuery("#lib_request_book").serialize(),
                        success: function (res) {
                            showMessage(res.msg, res.header, res.color);
                            jQuery("#book_name").val("");
                            jQuery("#book_url").val("");
                            jQuery("#note_on_book").val("");
                            load_all_request($scope);
                        }
                    });
                }
            });
        }
    }
    $scope.like = function (x) {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                "action": "electRequestBook",
                "id": x.Id
            },
            success: function (res) {
                showMessage(res.msg, res.header, res.color);
                load_all_request($scope);
            }
        });

    }

});

app.controller('UserProfileCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            "action": "get_user_details",
            "user_id": jQuery("#myId").val()
        },
        success: function (res) {

            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    "action": "getSrcFromID",
                    "img_id": res.data[0]["UserPic"]
                },
                success: function (res) {
                    if (res.success) {

                        if (res.src != null) {
                            $scope.mySrc = decodeURIComponent(res.src);
                            $scope.$digest();
                        }
                    }
                }
            });

            //$scope.request_dataset = res.data;
            $scope.userid = jQuery("#myId").val();
            $scope.fname = res.data[0]["FirstName"];
            $scope.lname = res.data[0]["LastName"];
            $scope.email = res.data[0]["Email"];
            $scope.phone = res.data[0]["Phone"];
            $scope.address = res.data[0]["Address"];
            $scope.city = res.data[0]["City"];
            $scope.zip = res.data[0]["Zip"];
            // mySrc =
            jQuery("#state").val(res.data[0]["State"]);
            jQuery("#year_name").val(res.data[0]["LevelIndex"]);
            jQuery("#course_name").val(res.data[0]["Course"]);
            $scope.$digest();
        }
    });

});

function load_all_request($scope) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            "action": "getAllRequestBook"
        },
        success: function (res) {
            $scope.request_dataset = res.data;
            refresh_Cnt_Approval_Book($scope);
            //$scope.$digest();
        }
    });
    recreate_common_dt();

}

app.controller('viewrequestBookCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {
    load_all_request($scope);
    $scope.approve = function (x) {
        bootbox.confirm(lang_msg.lg12, function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        "action": "manageRequestBook",
                        "todo": "approve",
                        "id": x.Id
                    },
                    success: function (res) {
                        load_all_request($scope);

                        showMessage(res.msg, res.header, res.color);
                    }
                });
            }
        });
    }
    $scope.dissapprove = function (x) {
        bootbox.confirm(lang_msg.lg13, function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        "action": "manageRequestBook",
                        "todo": "dissapprove",
                        "id": x.Id
                    },
                    success: function (res) {
                        load_all_request($scope);

                        showMessage(res.msg, res.header, res.color);
                    }
                });
            }
        });
    }

    $scope.delete = function (x) {
        bootbox.confirm(lang_msg.lg16, function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        "action": "manageRequestBook",
                        "todo": "delete",
                        "id": x.Id
                    },
                    success: function (res) {
                        load_all_request($scope);

                        showMessage(res.msg, res.header, res.color);
                    }
                });
            }
        });
    }

});

app.controller('DashBoardCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            "action": "stats_record"
        },
        success: function (res) {
            if (res.success) {
                $scope.book_issued = res.data.issued_books;
                $scope.total_users = res.data.total_users;
                $scope.total_books = res.data.total_books;
                $scope.approval_pending = res.data.total_pending_approval;
                $scope.total_books_type = res.data.total_books_type;

                if (res.data.total_fine_collected != "") {
                    $scope.total_fine_collected = res.data.total_fine_collected;
                } else {
                    $scope.total_fine_collected = 0;
                }

                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme1", //theme1
                    title: {
                        text: lang_msg.lg47
                    },
                    animationEnabled: true, // change to true
                    data: [{

                        type: "bar",
                        dataPoints: res.data.data_chart
                    }
                    ]
                });
                chart.render();
                $scope.db_bro = res.data.data_chart;
                $scope.$digest();
            }
        }
    });

    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }

});

function load_all_fines_ajax(limit, pg_no, user_id, book_id, compile_obj, scope_obj, todo, filter) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_all_fines_collected',
            'limit': limit,
            'book_id': book_id,
            'user_id': user_id,
            'pg_no': pg_no,
            'todo': todo,
            'filter': filter
        },
        success: function (res) {
            scope_obj.issue_book_db = res.data;
            scope_obj.$digest();
        }
    });

    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_all_fines_sum_collected',
            'filter': jQuery('#filter_m_y').val(),
        },
        success: function (res) {
            scope_obj.total = res.data[0]['total'];
            scope_obj.$digest();
        }
    });
    setTimeout(function () {
        recreate_finetbl_data();
    }, 3000);

}

app.controller('managementofFinesCtrl', function ($scope, $compile, $http, $window, $parse, Upload) {
    //jQuery('.selectpicker').selectpicker('refresh');
    load_all_fines_ajax(limit_pg_no, 0, "", "", $compile, $scope, "1", "");
    jQuery("#fine").numeric();
    $scope.selected_data = {};
    $scope.obj = {};
    var today_d = new Date();
    var min_date = new Date();
    min_date.setDate(today_d.getDate());


    $scope.now = new Date().getTime();

    jQuery('#date_of_return').datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        startDate: min_date,
        defaultDate: min_date
    });
    jQuery('#filter_m_y').on('change', function () {
        load_all_fines_ajax(limit_pg_no, 0, "", "", $compile, $scope, "1", this.value);
    });
    $scope.btn_UpdateRecord = function () {
        if ($scope.fine != undefined && $scope.fine != "") {

            // $scope.issue_book_db.Id;
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                dataType: 'JSON',
                data: {
                    'action': 'update_fine_records',
                    'book_no': $scope.selected_data.bookno,
                    'user_id': $scope.selected_data.user_id,
                    'notes': jQuery("#notes").val(),
                    'fine': jQuery("#fine").val(),
                    'uid': $scope.selected_data.uid,

                },
                success: function (res) {
                    if (res.success) {
                        showMessage(res.msg, "OK", "success");
                    } else {
                        showMessage(res.msg, "OK", "info");
                    }
                    load_all_fines_ajax(limit_pg_no, 0, "", "", $compile, $scope, "1", "");
                    jQuery("#editReturnBookData").modal("hide");
                    //location.reload();

                }
            });
        }

    }
    $scope.redirect = function (path) {

        $window.open(path, "_blank");

    }
    $scope.formDate = function (date) {
        return new Date(date).getTime();
    }
    $scope.btn_view = function (x, index) {
        $scope.selected_data.uid = $scope.issue_book_db[index]["Id"];
        $scope.selected_data.bookno = x.BookId;
        $scope.selected_data.user_id = x.UserId;
        $scope.selected_data.fine = $scope.fine = $scope.issue_book_db[index]["Fine"];
        jQuery("#fine").val($scope.fine);
        jQuery("#notes").val($scope.issue_book_db[index]["Notes"]);
        jQuery("#editReturnBookData").modal("show");

    }

    $scope.diffDate = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
        }
        return diffDays;
    };
    $scope.classMng = function (t_date_due) {

        var today_date = new Date();
        var date_due = new Date(t_date_due);
        var timeDiff = 0;
        var diffDays = 0;
        if (today_date > date_due) {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.floor((timeDiff) / (24 * 3600 * 1000));
            if (diffDays == 0) {
                return false;
            }
            return true;
        } else {
            timeDiff = Math.abs(today_date.getTime() - date_due.getTime());
            diffDays = Math.ceil((timeDiff) / (24 * 3600 * 1000));
            return false;
        }
    };

});

function refesh_slides($scope) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'manage_slides',
            'todo': 'getslides'
        },
        success: function (res) {
            $scope.full_slides = res.data;
            $scope.$digest();
        }
    });
}
app.controller('saveSlidesCtrl', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

    $scope.full_slides = [];
    $scope.btn_text = "Save";
    refesh_slides($scope);
    $scope.delSlide = function (slide) {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'manage_slides',
                'todo': 'delslide',
                'id': slide.id
            },
            success: function (res) {
                refesh_slides($scope);
                showMessage(res.msg, res.header, res.color);
            }
        });

    }

    $scope.editSlide = function (slide) {
        $scope.btn_text = "Update";
        $scope.selected_id = slide.id;
        showMessage(lang_msg.lg46, "OK", "info");
    }
    $scope.addSlide = function () {
        var formdata = new FormData();
        var files = document.getElementById('slide').files[0];
        if (files != null) {
            formdata.append('slide', files);
            formdata.append('action', "manage_slides");
            var mode = "add";
            if ($scope.btn_text == "Save") {
                formdata.append('todo', "addslide");
            } else {
                formdata.append('todo', "editslide");
                formdata.append('id', $scope.selected_id);
                mode = "edit";
            }
            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                async: false,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                data: formdata,
                success: function (res) {
                    refesh_slides($scope);
                    showMessage(res.msg, res.header, res.color);
                    if (mode == "edit") {
                        $scope.btn_text = "Save";
                    }
                    jQuery("#slide").val('');

                }
            });
        } else {
            showMessage(lang_msg.lg21, "OK", "info");
        }

    };


});
app.controller('managebulkupdatesofusers', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {

});
app.controller('managebulkupdatesofbooks', function ($scope, $compile, $http, $window, $parse, Upload, $rootScope) {
    $scope.UploadBookCsv = function () {

        var formdata = new FormData();
        var files = document.getElementById('book_csv').files[0];
        if (files != null) {
            formdata.append('book_csv', files);
            formdata.append('action', "manage_bulk_details");
            formdata.append('todo', "uploadbookcsv");

            jQuery.ajax({
                type: 'POST',
                url: myAjax.ajaxurl,
                async: false,
                dataType: 'JSON',
                contentType: false,          // The content type used when sending data to the server.
                cache: false,                // To unable request pages to be cached

                data: formdata,
                success: function (res) {
                    showMessage(res.msg, res.header, res.color);
                    jQuery("#book_csv").val('');

                }
            });
        } else {
            showMessage(lang_msg.lg81, "OK", "info");
        }


    }
});

app.controller('reportBugCtrl', function ($scope) {
    $scope.sendInfo = function () {
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                "action": "send_email_ajx",
                "email": "andprogrammer007@gmail.com",
                "body": "Hii,<br/>Name :" + $scope.person_name + ",<br/>Type : " + jQuery("#type_to_report").val() + "<br/>Description :<br/> " + $scope.email_desc
            },
            success: function (res) {
                showMessage(res.msg, res.header, res.color);
                location.reload();
            }
        });
    }
});

app.controller('createPageCtrl', function ($scope) {
    $scope.createPage = function () {
        jQuery("#page_content").val(tinyMCE.activeEditor.getContent());
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: jQuery("#frm_addPage").serialize(),
            success: function (res) {
                showMessage(res.msg, res.header, res.color);
                location.reload();
            }
        });

    }
});
app.controller('duepaidCtrl', function ($scope) {
    jQuery.ajax({
        type: 'POST',
        url: myAjax.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_all_online_dues_paid'
        },
        success: function (res) {
            $scope.due_lst = res.data;
            $scope.$digest();
            recreate_dues_dt();
        }
    });
    $scope.updateStatus = function (x) {
        bootbox.confirm(lang_msg.lg22 + " <br/><b>" + lang_msg.lg25 + "</b>", function (result) {
            if (result) {
                jQuery.ajax({
                    type: 'POST',
                    url: myAjax.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        'action': 'updatePaymentApproval',
                        'Id': x.Id,
                        'BookId': x.BookId,
                        'UserId': x.UserId,
                        'PayedAmount': x.PayedAmount,
                        'PayedForDays': x.PayedForDays,
                        'ApprovedStatus': 'Approved'
                    },
                    success: function (res) {
                        $scope.due_lst = res.data;
                        $scope.$digest();
                        showMessage(res.msg, res.header, res.color);
                        recreate_dues_dt();
                    }
                });
            }

        });
    }
});

app.controller('CtrlUpdateManager', function ($scope) {
    jQuery("#shell-body").append("<li>*****************************************************************</li>");
    jQuery("#shell-body").append("<li>" + lang_msg.lg26 + "</li>");
    jQuery("#shell-body").append("<li>" + lang_msg.lg33 + "</li>");
    jQuery("#shell-body").append("<li>*****************************************************************</li>");
    jQuery("#shell-body").append("<li>---------" + lang_msg.lg39 + "--------</li>");
    $scope.check_update = function () {
        jQuery("#shell-body").append("<li>Connecting to LMS server....</li>");
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'JSON',
            data: {
                'action': 'update_code',
            },
            success: function (res) {
                if (res !== undefined && res["msg"] == "") {
                    setTimeout(function () {
                        jQuery("#shell-body").append("<li>Connected to LMS server...</li>");
                    }, 1000);
                    setTimeout(function () {
                        jQuery("#shell-body").append("<li>Reading update files...</li><li>" + res["count"] + " " + lang_msg.lg42 + "</li> <li>" + lang_msg.lg44 + "</li><li>" + lang_msg.lg45 + "</li>");
                    }, 3000);
                    setTimeout(function () {
                        var file_list = res["filenames"];
                        for (var i = 0; i < file_list.length; i++) {
                            jQuery("#shell-body").append("<li>Updating file...{" + file_list[i] + "}</li>");
                        }
                    }, 4000);
                    setTimeout(function () {
                        jQuery("#shell-body").append("<li>Updated " + res["count"] + " files.</li><li>" + lang_msg.lg42 + "</li><li>---------END--------</li>");
                    }, 5000);
                }
                else {
                    setTimeout(function () {
                        jQuery("#shell-body").append("<li>" + res["msg"] + "</li>");
                    }, 1000);
                }
            }
        });
    }
});


