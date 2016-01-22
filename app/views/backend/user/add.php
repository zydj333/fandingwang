<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_user/add" method="post" id="system_add_save" enctype="multipart/form-data" >
            <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
            <ul class="forminfo">
                <li><label><?php echo lang('account'); ?></label><input name="account" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                <li><label><?php echo lang('password'); ?></label><input name="password" type="text" class="dfinput" value="123456"  style="width:150px;"/></li>
                <li><label><?php echo lang('username'); ?></label><input name="username" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                <li><label><?php echo lang('email'); ?></label><input name="email" type="text" class="dfinput" value=""  style="width:200px;"/></li>
                <li><label><?php echo lang('telphone'); ?></label><input name="telphone" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                <li><label>&nbsp;</label><input name="add" type="submit" class="btn" value="<?php echo lang('add'); ?>"/></li>
            </ul>
            </form>
        </div>
    </body>

</html>
