/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $("#add_feed_sub").click(function() {
        //var text = $('#add_feed_content').text();
        if ($('#add_feed_content').val() !== '') {
            $("#add_feed_form").submit();
        } else {
            $.dialog.alert('提交的状态不可以是空');
            return false;
        }
    });
});

