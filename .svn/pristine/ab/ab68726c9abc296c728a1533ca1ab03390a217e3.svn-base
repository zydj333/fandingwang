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
                <li><a href="<?php echo base_url(); ?>admin_newtype"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_newtype/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_newtype/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <!--<li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('title'); ?></th>
                        <th><?php echo lang('pid'); ?></th>
                        <th><?php echo lang('salt'); ?></th>
                        <th><?php echo lang('addtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody>
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $values->pid; ?></td>
                            <td><?php echo $values->salt; ?></td>
                            <td><?php echo $values->addtime; ?></td>
                            <td> <a href="<?php echo base_url(); ?>admin_newtype/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                            </td>
                        </tr>
                        <?php if (!empty($values->second)): ?>
                         <?php foreach ($values->second as $k => $v): ?>
                        <tr align="center">
                            <td><?php echo $v->id; ?></td>
                            <td><?php echo $v->title; ?></td>
                            <td><?php echo $v->pid; ?></td>
                            <td><?php echo $v->salt; ?></td>
                            <td><?php echo $v->addtime; ?></td>
                            <td> <a href="<?php echo base_url(); ?>admin_newtype/edit/<?php echo $v->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                         <?php endif; ?>
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
