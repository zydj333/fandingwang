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
                <li><a href="<?php echo base_url(); ?>admin_power"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_power/edit/<?php echo $power->id;?>"><?php echo lang('page_where_edit'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_power/edit/<?php echo $power->id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('edit'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('powername'); ?></label><input name="powername" type="text" class="dfinput" value="<?php echo $power->powername;?>"  style="width:250px;"/></li>
                    <li>
                        <table id="powertable" class="form" cellpadding=0 cellspacing=0>
                            <?php if (!empty($system)): ?>
                            <?php foreach ($system as $key => $value): ?>
                                    <tr>
                                        <td><input <?php if(in_array($value->id, $power->power)):?>checked="checked"<?php endif;?> class="key" type="checkbox" name="power[]" id="piwer_<?php echo $value->id; ?>" value="<?php echo $value->id; ?>" /><?php echo $value->titel; ?></td>
                                    </tr>
                            <?php if (!empty($value->second)): ?>
                            <?php foreach ($value->second as $k => $v): ?>
                                            <tr>
                                                <td style=" padding-left: 50px; " ><input <?php if(in_array($v->id, $power->power)):?>checked="checked"<?php endif;?> class="key" type="checkbox" name="power[]" id="piwer_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>" /><?php echo $v->titel; ?></td>
                                            </tr>
                            <?php if (!empty($v->third)): ?>
                            <?php foreach ($v->third as $n => $m): ?>
                                                    <tr>
                                                        <td style=" padding-left: 150px; " ><input <?php if(in_array($m->id, $power->power)):?>checked="checked"<?php endif;?> class="key" type="checkbox" name="power[]" id="piwer_<?php echo $m->id; ?>" value="<?php echo $m->id; ?>" /><?php echo $m->titel; ?></td>
                                                    </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                                                    <tr>
                                                        <td colspan="2" class="topTd"></td>
                                                    </tr>

                                                </table>
                                            </li>
                                            <li>
                                                <input type="button" value="<?php echo lang('check_all');?>" id="selectAll" />
                                                <input type="button" value="<?php echo lang('un_check_all');?>" id="unSelect" />
                                                <input type="button" value="<?php echo lang('check_back');?>" id="reverse" />
                                            </li>
                                            <li><label>&nbsp;</label><input name="add" type="submit" class="btn" value="<?php echo lang('edit'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js" ></script>
<script language="javascript" type="text/javascript">
    $(function () {
        $("#selectAll").click(function () {//全选
            $("#powertable :checkbox").attr("checked", true);
        });

        $("#unSelect").click(function () {//全不选
            $("#powertable :checkbox").attr("checked", false);
        });

        $("#reverse").click(function () {//反选
            $("#powertable :checkbox").each(function () {
                $(this).attr("checked", !$(this).attr("checked"));
            });
        });
    });
</script>
