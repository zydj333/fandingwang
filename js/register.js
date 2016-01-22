$(function() {
    $("#register_sub_form").click(function() {
        $.ajax({
            type: "POST",
            url: "/register/checkRegister/" + Math.random(),
            data: $("#register_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 0) {
                    alert(data.error);
                    return;
                } else if (data.flag === 2) {
                    $('#account_error').html(data.error);
                    return;
                } else if (data.flag === 3) {
                    $('#email_error').html(data.error);
                    return;
                } else if (data.flag === 4) {
                    $('#cellphone_error').html(data.error);
                    return;
                } else if (data.flag === 5) {
                    $('#phonecode_error').html(data.error);
                    return;
                } else if (data.flag === 6) {
                    $('#password_error').html(data.error);
                    return;
                } else if (data.flag === 7) {
                    $('#repassword_error').html(data.error);
                    return;
                }else if(data.flag === 8){
                    $('#account_error').html(data.error);
                } else if (data.flag === 1) {
                    $("#register_form").submit();
                }
            }
        });
    });
    
    
     //获取手机验证码
    $("#get_phonecode").click(function(){
        var phone=$("#cellphone").val();
        if((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))){
            $.ajax({
                type: "POST",
                url: "/phonecode/createPhoneCode/"+Math.random(),
                data: {
                    "phone":phone,
                    "codetype":'real_phone'
                },
                dataType:"json",
                success: function(data){
                    if(data.flag===1){
                        f_timeout();
                        $('#phonecode_error').html();
                    }else{
                         $('#phonecode_error').html(data.error);
                    }
                }
            });
        }else{
            $('#cellphone_error').html('手机格式不正确!');
        }
    });

    $('#account').focus(function() {
        $('#account_error').html('');
    });

    $('#password').focus(function() {
        $('#password_error').html('');
    });
    $('#repassword').focus(function() {
        $('#repassword_error').html('');
    });
    $('#email').focus(function() {
        $('#email_error').html('');
    });
    $('#cellphone').focus(function() {
        $('#cellphone_error').html('');
    });

    $('#phonecode').focus(function() {
        $('#phonecode_error').html('');
    });
    
    
/*if(!placeholderSupport()){   // 判断浏览器是否支持 placeholder
    $('[placeholder]').focus(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function() {
        var input = $(this);
        if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
        }
    }).blur();
};*/
   
});
/*function placeholderSupport() {
    return 'placeholder' in document.createElement('input');
}*/

//切换发送按钮
function f_timeout(){
    $('#get_phonecode').hide();
    $('#noget_phonecode').show();
    $('#noget_phonecode').html('<span id="timeb2">60</span>秒后重新获取');
    timer = self.setInterval(addsec,1000);
}

function addsec(){
    var t = $('#timeb2').html();
    if(t > 0){
        $('#timeb2').html(t-1);
    }else{
        window.clearInterval(timer);
        $('#get_phonecode').show();
        $('#noget_phonecode').hide();
    //$('#timeb1').click(function(){phonecode();});
    }
}