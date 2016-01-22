<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" >
            $(document).ready(function(e) {
                $("#loading")
                .ajaxStart(function(){
                    $(this).show();
                })
                .ajaxComplete(function(){
                    $(this).hide();
                });
                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_ademail/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                var str="操作完成（成功"+data.success+",失败"+data.failed+"）"
                                alert(str);
                                location.href="/admin_ademail/";
                            }
                        }
                    });
                });
            })
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_ademail"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_ademail/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_ademail/add" method="post" id="system_add_save" enctype="multipart/form-data" >
            <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
            <ul class="forminfo">
                <li><label><?php echo lang('user_name'); ?></label><textarea name="user_name" cols="" rows="" class="textinput"></textarea></li>
                <li><label><?php echo lang('username_no'); ?></label><?php echo lang('username_notice'); ?></li>
                <li><label><?php echo lang('title'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:450px;"/></li>
                <li><label><?php echo lang('content'); ?></label><textarea name="content" cols="" rows="" class="textinput"></textarea></li>
                <li><label><?php echo lang('content_no'); ?></label><?php echo lang('content_notice'); ?></li>
                <li><label><?php echo lang('postwaiting'); ?></label><img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" /></li>
                <li><label>&nbsp;</label><input name="add" id="add" type="button" class="btn" value="<?php echo lang('add'); ?>"/></li>
            </ul>
            </form>
        </div>
    </body>

</html>
