/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $("#news_repay_submit").click(function(){
        var news_id = $("#news_id").val();
        $.ajax({
            type: "POST",
            url: "/shequ/saveRepay/" + Math.random(),
            data: $("#news_repay_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $("#repay_id").val(0);
                    $("#content").val('');
                    location.href = '/shequ/detial/' + news_id;
                } else {
                    $.dialog.alert(data.error);
                    $('#content').focus();
                }
            }
        });
    });
});

function news_repay(news_id){
    $("#repay_id").val(news_id);
    $("#content").val('回复：');
    $(".comment").animate({scrollTop: 400}, 500);
    $("#content").focus();
}