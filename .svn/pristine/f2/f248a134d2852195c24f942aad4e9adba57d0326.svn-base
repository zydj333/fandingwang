$(function() {
    $("#login_sub_form").click(function() {
        $.ajax({
            type: "POST",
            url: "/login/chenckLogin/" + Math.random(),
            data: $("#login_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 0) {
                    $("#login_error").html(data.error);
                } else if (data.flag === 1) {
                    $("#login_form").submit();
                }
            }
        });
    });

    $("#account").focus(function() {
        $("#login_error").html('');
    });

    $("#password").focus(function() {
        $("#login_error").html('');
    });



    //获取手机验证码
    $("#get_phonecode").click(function() {
        var phone = $("#cellphone").val();
        if ((/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/phonecode/createPhoneCode/" + Math.random(),
                data: {
                    "phone": phone,
                    "codetype": 'find_password'
                },
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        f_timeout();
                    } else {
                        //$('#phonecode_error').html(data.error);
                        $.dialog.alert(data.error);
                    }
                }
            });
        } else {
            $.dialog.alert('手机格式不正确');
            //$('#cellphone_error').html('手机格式不正确!');
        }
    });

    //提交验证码
    $('#check_phone_code').click(function() {
        var phone = $("#cellphone").val();
        var code = $("#phonecode").val();
        if (phone !== '' || code !== '') {
            $.ajax({
                type: "POST",
                url: "/forget/checkcode/" + Math.random(),
                data: {
                    "phone": phone,
                    "code": code
                },
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        $("#check_cell_phone_form").submit();
                    } else {
                        //$('#phonecode_error').html(data.error);
                        $.dialog.alert(data.error);
                    }
                }
            });
        } else {
            $.dialog.alert('手机及验证码不可以为空!');
        }
    });

    //检查密码
    $('#reset_password_button').click(function() {
        var phone = $("#phone").val();
        var newpassword = $("#newpassword").val();
        var repassword = $("#repassword").val();
        $.ajax({
            type: "POST",
            url: "/forget/checkNewPassword/" + Math.random(),
            data: {
                "phone": phone,
                "newpassword": newpassword,
                "repassword": repassword
            },
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $.dialog.alert(data.error);
                    location.href = '/login'
                } else {
                    //$('#phonecode_error').html(data.error);
                    $.dialog.alert(data.error);
                }
            }
        });
    });


    //提交手机号码登录操作
    $('#phone_login_sub_form').click(function() {
        $.ajax({
            type: "POST",
            url: "/login/chenckPhoneLogin/" + Math.random(),
            data: $("#phone_login_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 0) {
                    $("#login_error").html(data.error);
                } else if (data.flag === 1) {
                    $("#phone_login_form").submit();
                }
            }
        });
    });

    //获取手机验证码登录时
    $("#get_phonecode_login").click(function() {
        var phone = $("#phonenumber").val();
        if ((/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/phonecode/createPhoneCode/" + Math.random(),
                data: {
                    "phone": phone,
                    "codetype": 'login'
                },
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        login_timeout();
                    } else {
                        //$('#phonecode_error').html(data.error);
                        $.dialog.alert(data.error);
                    }
                }
            });
        } else {
            $.dialog.alert('手机格式不正确');
            //$('#cellphone_error').html('手机格式不正确!');
        }
    });
});
//切换发送按钮
function f_timeout() {
    $('#get_phonecode').hide();
    $('#noget_phonecode').show();
    $('#noget_phonecode').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(addsec, 1000);
}

function addsec() {
    var t = $('#timeb2').html();
    if (t > 0) {
        $('#timeb2').html(t - 1);
    } else {
        window.clearInterval(timer);
        $('#get_phonecode').show();
        $('#noget_phonecode').hide();
        //$('#timeb1').click(function(){phonecode();});
    }
}

//切换发送按钮，登录时启用
function login_timeout() {
    $('#get_phonecode_login').hide();
    $('#noget_phonecode_login').show();
    $('#noget_phonecode_login').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(login_addsec, 1000);
}

function login_addsec() {
    var t = $('#timeb2').html();
    if (t > 0) {
        $('#timeb2').html(t - 1);
    } else {
        window.clearInterval(timer);
        $('#get_phonecode_login').show();
        $('#noget_phonecode_login').hide();
        //$('#timeb1').click(function(){phonecode();});
    }
}