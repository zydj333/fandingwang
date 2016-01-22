<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 145
                });
            });
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user/editpower/<?php echo $userpower->uid ?>"><?php echo lang('page_where_addpower'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_user/editpower/<?php echo $userpower->uid ?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('poweradd'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('account'); ?></label><input name="account" readonly="readonly" type="text" class="dfinput" value="<?php echo $userpower->account; ?>"  style="width:250px;"/></li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" readonly="readonly"  type="text" class="dfinput" value="<?php echo $userpower->username; ?>"  style="width:250px;"/></li>
                    <li><label><?php echo lang('power'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="power">
                                <option value="0">--选择权限--</option>
                                <?php foreach($power as $k=>$v):?>
                                <option value="<?php echo $v->id;?>" <?php if($v->id==$userpower->power){echo 'selected="selected"';}?>><?php echo $v->powername;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="add" type="submit" class="btn" value="<?php echo lang('poweradd'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>
