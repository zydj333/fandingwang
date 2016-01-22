//载入购买
function joinFounding(product_id, items_id) {
    $.ajax({
        type: "POST",
        url: "/order/index/" + Math.random(),
        data: {'product_id': product_id, 'items_id': items_id},
        dataType: "json",
        success: function(data) {
            if (data.flag === 1) {
                location.href = "/order/stepone/" + product_id + "-" + items_id;
            }else{
                $.dialog.alert(data.error);
            }
        }
    });
}


//回复
function repay(to_uid, to_replay_id) {
    $("#to_replay_id").val(to_replay_id);
    $("#to_uid").val(to_uid);
    $("#content").val('回复:');
    $("html, body").animate({scrollTop: 400}, 500);
    $("#content").focus();
}

$(function() {
    $("#repay_submit").click(function() {
        var pid = $("#product_id").val();
        $.ajax({
            type: "POST",
            url: "/project/saveRepay/" + Math.random(),
            data: $("#repay_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    location.href = '/project/repay/' + pid;
                } else if(data.flag === 2){
                     $.dialog.alert(data.error);
                     location.href = '/login';
                }else {
                    $.dialog.alert(data.error);
                    $('#content').focus();
                }
            }
        });
    });
});