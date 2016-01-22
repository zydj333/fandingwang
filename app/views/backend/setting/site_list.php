<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){

            });
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_setting"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_setting/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_setting/add/site"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('title'); ?></th>
                        <th><?php echo lang('select_title'); ?></th>
                        <th><?php echo lang('select_values'); ?></th>
                        <th><?php echo lang('select_group'); ?></th>
                        <th><?php echo lang('discription'); ?></th>
                        <th><?php echo lang('updatetime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody>
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $values->select_title; ?></td>
                            <td><?php echo $values->select_values; ?></td>
                            <td><?php echo $values->select_group; ?></td>
                            <td><?php echo $values->discription; ?></td>
                            <td><?php echo $values->updatetime; ?></td>
                            <td> <a href="<?php echo base_url(); ?>admin_setting/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
            <div class="pagin"> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
