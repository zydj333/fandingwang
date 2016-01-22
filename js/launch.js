/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    //新增
    $("#launch_step_one_button").click(function() {
        if ($("#fandingxieyi").is(":checked")) {
            $.ajax({
                type: "POST",
                url: "/launch/checkStepOne/" + Math.random(),
                data: $("#launch_step_one_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        $("#launch_step_one_form").submit();
                    } else {
                        $.dialog.alert(data.error);
                    }
                }
            });
        } else {
            $.dialog.alert('发布前必须同意协议');
        }
    });
    //修改
    $("#launch_step_one_edit_button").click(function() {
        if ($("#fandingxieyi").is(":checked")) {
            $.ajax({
                type: "POST",
                url: "/launch/checkStepOne/" + Math.random(),
                data: $("#launch_step_one_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        $("#launch_step_one_edit_form").submit();
                    } else {
                        $.dialog.alert(data.error);
                    }
                }
            });
        } else {
            $.dialog.alert('发布前必须同意协议');
        }
    });
    //弹出添加动态的页面
    $("#add_feed_content").click(function() {
        var product_id = $('#product_id').val();
        $.ajax({
            url: '/launch/productFeed/' + product_id,
            success: function(data) {
                $.dialog({
                    lock: true,
                    background: '#DDD', // 背景色
                    opacity: 0.80, // 透明度
                    content: data,
                    //icon: 'question'
                    cancel: true
                });
            },
            cache: false
        });
    });

   

    //第五步，提交数据
    $("#submit_myproject_tosystem").click(function() {
        var product_id=$("#product_id").val();
        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "/launch/saveMyProjectToSystem/" + Math.random(),
            data: {'product_id':product_id},
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $("#loading").hide();
                    $.dialog.alert(data.error);
                    location.href='/';
                } else {
                    $("#loading").hide();
                    $.dialog.alert(data.error);
                }
            }
        });
    });
});

function getCity(province) {
    if (province > 0) {
        $.ajax({
            type: "POST",
            url: "/common/getCity/" + Math.random(),
            data: {'province': province},
            dataType: "json",
            success: function(data) {
                var str = '<option value="0">' + '请选择城市' + '</option>';
                if (data.flag === 0) {
                    str = '<option value="0">' + data.error + '</option>';
                } else {
                    $.each(data.error, function(key, value) {
                        str += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                }
                $("#city").html(str);
            }
        });
    }
}
function getArea(city) {
    if (city > 0) {
        $.ajax({
            type: "POST",
            url: "/common/getCity/" + Math.random(),
            data: {'province': city},
            dataType: "json",
            success: function(data) {
                var str = '<option value="0">' + '请选择区域' + '</option>';
                if (data.flag === 0) {
                    str = '<option value="0">' + data.error + '</option>';
                } else {
                    $.each(data.error, function(key, value) {
                        str += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                }
                $("#area").html(str);
            }
        });
    }
}