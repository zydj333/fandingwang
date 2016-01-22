/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    //点击提交发起众筹
    $("#launch_button").click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/checkLaunch/" + Math.random(),
            data: $("#launch_form").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    $("#launch_form").submit();
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });

    //点击地址修改按钮
    $("#address_edit_button").click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/center_address_edit/" + Math.random(),
            data: $("#address_edit_from").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#address_edit_from").html('<div class="alert alert-info">地址修改成功,点击下方‘确定’关闭窗口!</div>');
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });
    //点击添加地址按钮
    $("#address_button").click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/center_address_add/" + Math.random(),
            data: $("#address_from").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#address_from").html('<div class="alert alert-info">地址添加成功,点击下方‘确定’关闭窗口!</div>');
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });
    //点击登录按钮
    $("#login_button").click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/checkAccount/" + Math.random(),
            data: $("#login_form").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    $("#login_form").submit();
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });
    //提交注册按钮
    $("#do_register").click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/checkRegister/" + Math.random(),
            data: $("#register_form").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    $("#register_form").submit();
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });
    //点击获取验证码按钮
    $("#get_phonecode").click(function () {
        var phone = $("#account").val();
        var midify = $("#varify").val();
        if (midify == '') {
            $("#error_display").removeClass('alert-info');
            $("#error_display").addClass('alert-danger');
            $('#error_display').html('请先输入图形码!');
            return;
        }
        if ((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/phonecode/createPhoneCode/" + Math.random(),
                data: {
                    "phone": phone,
                    "codetype": 'real_phone'
                },
                dataType: "json",
                success: function (data) {
                    if (data.flag === 1) {
                        $("#error_display").removeClass('alert-danger');
                        $("#error_display").addClass('alert-info');
                        $("#error_display").html(data.error);
                        f_timeout();
                    } else {
                        $("#error_display").removeClass('alert-info');
                        $("#error_display").addClass('alert-danger');
                        $('#error_display').html(data.error);
                    }
                }
            });
        } else if ((/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/email/saveRegisterEmail/" + Math.random(),
                data: {
                    "phone": phone
                },
                dataType: "json",
                success: function (data) {
                    if (data.flag === 1) {
                        $("#error_display").removeClass('alert-danger');
                        $("#error_display").addClass('alert-info');
                        $("#error_display").html(data.error);
                        f_timeout();
                    } else {
                        $("#error_display").removeClass('alert-info');
                        $("#error_display").addClass('alert-danger');
                        $('#error_display').html(data.error);
                    }
                }
            });
        } else {
            $("#error_display").removeClass('alert-info');
            $("#error_display").addClass('alert-danger');
            $('#error_display').html('账户名称格式不正确!');
        }
    });

    //重新获取验证码
    $('#varifyCode').click(function () {
        this.src = '/validate/doimg/' + Math.random();
    });


    //登录时获取验证码
    $("#get_phonecode_login").click(function () {
        var phone = $("#phonenumber").val();
        if ((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/phonecode/createPhoneCode/" + Math.random(),
                data: {
                    "phone": phone,
                    "codetype": 'login'
                },
                dataType: "json",
                success: function (data) {
                    if (data.flag === 1) {
                        $("#error_display").removeClass('alert-danger');
                        $("#error_display").addClass('alert-info');
                        $("#error_display").html(data.error);
                        login_timeout();
                    } else {
                        $("#error_display").removeClass('alert-info');
                        $("#error_display").addClass('alert-danger');
                        $('#error_display').html(data.error);
                    }
                }
            });
        } else {
            $("#error_display").removeClass('alert-info');
            $("#error_display").addClass('alert-danger');
            $('#error_display').html('手机格式不正确!');
        }
    });

    //手机登录提交表单
    $('#phone_login_button').click(function () {
        $.ajax({
            type: "POST",
            url: "/mobile/celllogin/" + Math.random(),
            data: $("#phone_login_form").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.flag === 0) {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $("#error_display").html(data.error);
                    return false;
                } else if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    location.href = '/mobile/index';
                } else {
                    alert('错误未知，请更换浏览器进行操作！');
                }
            }
        });
    });

});

//切换发送按钮
function f_timeout() {
    $('#get_phonecode').addClass('hidden');
    $('#noget_phonecode').removeClass('hidden');
    $('#noget_phonecode').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(addsec, 1000);
}
//切换发送按钮
function d_timeout() {
    $('#get_phonecode_forget').addClass('hidden');
    $('#noget_phonecode_forget').removeClass('hidden');
    $('#noget_phonecode_forget').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(addsecs, 1000);
}

function addsecs() {
    var t = $('#timeb2').html();
    if (t > 0) {
        $('#timeb2').html(t - 1);
    } else {
        window.clearInterval(timer);
        $('#get_phonecode_forget').removeClass('hidden');
        $('#noget_phonecode_forget').addClass('hidden');
        //$('#timeb1').click(function(){phonecode();});
    }
}

function addsec() {
    var t = $('#timeb2').html();
    if (t > 0) {
        $('#timeb2').html(t - 1);
    } else {
        window.clearInterval(timer);
        $('#get_phonecode').removeClass('hidden');
        $('#noget_phonecode').addClass('hidden');
        //$('#timeb1').click(function(){phonecode();});
    }
}

//登录切换发送按钮
function login_timeout() {
    $('#get_phonecode_login').addClass('hidden');
    $('#noget_phonecode_login').removeClass('hidden');
    $('#noget_phonecode_login').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(login_addsec, 1000);
}

function login_addsec() {
    var t = $('#timeb2').html();
    if (t > 0) {
        $('#timeb2').html(t - 1);
    } else {
        window.clearInterval(timer);
        $('#get_phonecode_login').removeClass('hidden');
        $('#noget_phonecode_login').addClass('hidden');
        //$('#timeb1').click(function(){phonecode();});
    }
}

//点击忘记密码按钮
$("#forget_button").click(function () {
    $.ajax({
        type: "POST",
        url: "/mobile/forget/" + Math.random(),
        data: $("#forget_form").serialize(),
        dataType: "json",
        success: function (data) {
            if (data.flag === 0) {
                $("#error_display").removeClass('alert-info');
                $("#error_display").addClass('alert-danger');
                $("#error_display").html(data.error);
                return false;
            } else if (data.flag === 1) {
                location.href = "/mobile/resetPassword";
            } else {
                alert('错误未知，请更换浏览器进行操作！');
            }
        }
    });
});

//找回密码时获取验证码
$("#get_phonecode_forget").click(function () {
    var phone = $("#account").val();
    var midify = $("#varify").val();
    if (midify == "") {
        $("#error_display").removeClass('alert-info');
        $("#error_display").addClass('alert-danger');
        $('#error_display').html('请先填写图形码!');
        return;
    }
    if ((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
        $.ajax({
            type: "POST",
            url: "/phonecode/createPhoneCode/" + Math.random(),
            data: {
                "phone": phone,
                "codetype": 'forget'
            },
            dataType: "json",
            success: function (data) {
                if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    d_timeout();
                } else {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $('#error_display').html(data.error);
                }
            }
        });
    } else if ((/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(phone))) {
        $.ajax({
            type: "POST",
            url: "/email/saveForgetEmail/" + Math.random(),
            data: {
                "phone": phone
            },
            dataType: "json",
            success: function (data) {
                if (data.flag === 1) {
                    $("#error_display").removeClass('alert-danger');
                    $("#error_display").addClass('alert-info');
                    $("#error_display").html(data.error);
                    d_timeout();
                } else {
                    $("#error_display").removeClass('alert-info');
                    $("#error_display").addClass('alert-danger');
                    $('#error_display').html(data.error);
                }
            }
        });
    } else {
        $("#error_display").removeClass('alert-info');
        $("#error_display").addClass('alert-danger');
        $('#error_display').html('账户名称格式不正确!');
    }
});