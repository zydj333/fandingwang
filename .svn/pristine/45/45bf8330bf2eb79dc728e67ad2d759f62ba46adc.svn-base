<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td><?php echo lang('id'); ?>：<?php echo $order->id; ?></td>
                    <td><?php echo lang('project_name'); ?>：<?php echo $order->project_name; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('username'); ?>：<?php echo $order->username; ?></td>
                    <td><?php echo lang('gander'); ?>：<?php if($order->gander==0):?>男<?php else:?>女<?php endif;?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('celphone'); ?>：<?php echo $order->celphone; ?></td>
                    <td><?php echo lang('wechat'); ?>：<?php echo $order->wechat; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('sina'); ?>：<?php echo $order->sina; ?></td>
                    <td><?php echo lang('status'); ?>：<?php if($order->status==1): ?><nobr style="color: blue">待审核</nobr><?php elseif($order->status==2): ?><nobr style="color: red">已通过</nobr><?php elseif($order->status==3): ?><nobr style="color: blue">未通过</nobr><?php endif;?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('addtime'); ?>：<?php echo $order->addtime; ?></td>
                    <td><?php echo lang('passtime'); ?>：<?php echo $order->passtime; ?></td>
                </tr>
                <tr align="left">
                    <td colspan="2"><?php echo lang('uid'); ?>：<?php echo $order->uid; ?></td>
                </tr>
                <tr align="left">
                    <td colspan="2"><?php echo lang('my_description'); ?>：<?php echo $order->my_description; ?></td>
                </tr>
                <tr align="left">
                    <td colspan="2"><?php echo lang('pro_description'); ?>：<?php echo $order->pro_description;?></td>
            </table>
        </div>
    </body>
</html>
