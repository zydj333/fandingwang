<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/lang/zh_CN.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                 KindEditor.ready(function(K) {
                    window.editor = K.create('#editor_id');
                });
                
                $("#add").click(function(){
                     editor.sync();
                    $.ajax({
                        type: "POST",
                        url: "/admin_product_tender/edit/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag===0){
                                alert(data.error);
                            }else{
                                location.href="/admin_product_tender/index/"+data.error;
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_tender/index/<?php echo $product_id;?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_tender/edit/<?php echo $tender->pid;?>/<?php echo $tender->id;?>"><?php echo lang('page_where_edit'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_product_tender/edit/<?php echo $tender->pid;?>/<?php echo $tender->id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('id'); ?></label><input name="id" type="text" class="dfinput" readonly="readonly" value="<?php echo $tender->id;?>"  style="width:150px;"/></li>
                    <li><label><?php echo lang('pid'); ?></label><input name="pid" type="text" class="dfinput" readonly="readonly" value="<?php echo $tender->pid;?>"  style="width:150px;"/></li>
                    <li><label><?php echo lang('feed'); ?></label><textarea name="feed" id="editor_id" cols="" rows="" style="width:700px;height:300px;"><?php echo $tender->feed;?></textarea></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('edit'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
