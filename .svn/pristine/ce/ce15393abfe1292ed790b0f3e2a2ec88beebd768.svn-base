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
                <li><a href="<?php echo base_url(); ?>admin_system"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_system/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_system/add" method="post" id="system_add_save" enctype="multipart/form-data" >
            <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
            <ul class="forminfo">
                <li><label><?php echo lang('parent_name') ?></label>
                <?php if (!empty($parent)) { echo $parent->titel . '--' . $parent->controller . '--' . $parent->actionname;} else {  echo lang('no_parents');}?>
                <input name="parent_id" type="hidden" value="<?php  if (!empty($parent)){echo $parent->id;}else{ echo 0;}?>"  />
                </li>
                <li><label><?php echo lang('titel'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:208px;"/></li>
                <li><label><?php echo lang('controller'); ?></label><input name="controllorname" type="text" class="dfinput" value=""  style="width:128px;"/></li>
                <li><label><?php echo lang('actionname'); ?></label><input name="actionname" type="text" class="dfinput" value=""  style="width:128px;"/></li>
                <li><label><?php echo lang('sult'); ?></label><input name="sult" type="text" class="dfinput" value="0"  style="width:88px;"/></li>
                <li><label><?php echo lang('is_del'); ?></label><cite><input name="is_del" type="radio" value="0" checked="checked" /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_del" type="radio" value="1"/><?php echo lang('yes'); ?></cite></li>
                <li><label>&nbsp;</label><input name="add" type="submit" class="btn" value="<?php echo lang('add'); ?>"/></li>
            </ul>
            </form>
        </div>
    </body>

</html>
