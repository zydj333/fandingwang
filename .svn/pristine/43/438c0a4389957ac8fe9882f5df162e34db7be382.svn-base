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
            $(document).ready(function(e) {
                KindEditor.ready(function(K) {
                    window.editor = K.create('#pattern');
                    window.editor1 = K.create('#team');
                    window.editor2 = K.create('#history');
                    window.editor3 = K.create('#future_plans');
                });

                $("#add").click(function(){
                    editor.sync();
                    editor1.sync();
                    editor2.sync();
                    editor3.sync();
                    $.ajax({
                        type: "POST",
                        url: "/admin_project_introduce/index/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_project";
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
                <li><a href="<?php echo base_url(); ?>admin_project"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_project_introduce/index/<?php echo $pid; ?>"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_project_introduce/index" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('page_where_list'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('pid'); ?></label><input name="pid" readonly="readonly" type="text" class="dfinput" value="<?php echo $pid; ?>"  style="width:50px;"/></li>
                    <li><label><?php echo lang('pattern'); ?></label><textarea name="pattern" id="pattern" cols="" rows="" style="width:700px;height:300px;"><?php if(isset($introduce->pattern)){echo $introduce->pattern;} ?></textarea></li>
                    <li><label><?php echo lang('team'); ?></label><textarea name="team" id="team" cols="" rows="" style="width:700px;height:300px;"><?php if(isset($introduce->team)){echo $introduce->team;} ?></textarea></li>
                    <li><label><?php echo lang('history'); ?></label><textarea name="history" id="history" cols="" rows="" style="width:700px;height:300px;"><?php if(isset($introduce->history)){echo $introduce->history;} ?></textarea></li>
                    <li><label><?php echo lang('future_plans'); ?></label><textarea name="future_plans" id="future_plans" cols="" rows="" style="width:700px;height:300px;"><?php if(isset($introduce->future_plans)){echo $introduce->future_plans;} ?></textarea></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('save'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
