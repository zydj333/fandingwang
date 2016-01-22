/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $("#topic_repay_button").click(function() {
        var topic_id = $("#topic_id").val();
        $.ajax({
            type: "POST",
            url: "/bbs/saveRepay/" + Math.random(),
            data: $("#topic_repay_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $("#repay_id").val(0);
                    $("#content").val('');
                    location.href = '/bbs/detial/' + topic_id;
                } else {
                    $.dialog.alert(data.error);
                    $('#content').focus();
                }
            }
        });
    });
});

function topic_repay(topic_id) {
    $("#repay_id").val(topic_id);
    $("#content").val('回复：');
    $(".comment").animate({scrollTop: 400}, 500);
    $("#content").focus();
}