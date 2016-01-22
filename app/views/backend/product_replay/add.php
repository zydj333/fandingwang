<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                
                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_product_replay/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                location.href="/admin_product_replay/index/"+data.error;
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
                <li><a href="<?php echo base_url(); ?>admin_product_replay/index/<?php echo $product_id;?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_replay/add/<?php echo $product_id;?>"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_product_replay/add/<?php echo $product_id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('pid'); ?></label><input name="pid" type="text" class="dfinput" readonly="readonly" value="<?php echo $product_id;?>"  style="width:150px;"/></li>
                    <li><label><?php echo lang('uid'); ?></label><input name="uid" type="text" class="dfinput" readonly="readonly" value="0"  style="width:150px;"/></li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" type="text" readonly="readonly" class="dfinput" value="匿名用户"  style="width:250px;"/></li>
                    <li><label><?php echo lang('to_uid'); ?></label><input name="to_uid" type="text" readonly="readonly" class="dfinput" value="0"  style="width:150px;"/></li>
                    <li><label><?php echo lang('to_user'); ?></label><input name="to_user" type="text" readonly="readonly" class="dfinput" value="匿名用户"  style="width:250px;"/></li>
                    <li><label><?php echo lang('to_replay_id'); ?></label><input name="to_replay_id" type="text" readonly="readonly" class="dfinput" value="0"  style="width:150px;"/></li>
                    <li><label><?php echo lang('content'); ?></label><textarea name="content" cols="" rows="" class="textinput"></textarea></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
