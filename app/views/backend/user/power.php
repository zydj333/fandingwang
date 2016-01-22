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
                <li><a href="<?php echo base_url(); ?>admin_user"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user/power"><?php echo lang('page_where_powerlist'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><input name="checkall" type="checkbox" value="1"/></th>
                        <th><?php echo lang('id'); ?><i class="sort"><img src="<?php echo base_url(); ?>images/backend/px.gif" /></i></th>
                        <th><?php echo lang('account'); ?></th>
                        <th><?php echo lang('username'); ?></th>
                        <th><?php echo lang('power'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($power)): ?>
                    <tbody>
                    <?php foreach ($power as $key => $values): ?>
                        <tr align="left">
                            <td><input name="sys_id" type="checkbox" value="<?php echo $values->uid; ?>" /></td>
                            <td><?php echo $values->uid; ?></td>
                            <td><?php echo $values->account; ?></td>
                            <td><?php echo $values->username; ?></td>
                            <td><?php if($values->powername){echo $values->powername;}else{echo '<p style="color:red;" >未分配</p>';} ?></td>
                            <td> <a href="<?php echo base_url(); ?>admin_user/editpower/<?php echo $values->uid; ?>" class="tablelink"><?php echo lang('poweradd'); ?></a>
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
