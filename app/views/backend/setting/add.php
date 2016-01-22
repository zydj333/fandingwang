<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 145
                });

                $("#add").click(function(){
                    var type=$("#select_group").val();
                    $.ajax({
                        type: "POST",
                        url: "/admin_setting/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_setting/"+type;
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
                <li><a href="<?php echo base_url(); ?>admin_setting"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_setting/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_setting/add" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('select_group'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="select_group" id="select_group">
                                <?php foreach ($type as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($nowtype==$k):?>selected="selected"<?php endif;?> ><?php echo $v; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </li>  
                        <li><label><?php echo lang('title'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                        <li><label><?php echo lang('select_title'); ?></label><input name="select_title" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                        <li><label><?php echo lang('select_values'); ?></label><input name="select_values" type="text" class="dfinput" value=""  style="width:300px;"/></li>
                        <li><label><?php echo lang('discription'); ?></label><input name="discription" type="text" class="dfinput" value=""  style="width:550px;"/></li>
                        <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>
