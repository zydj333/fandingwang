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
                <li><a href="<?php echo base_url(); ?>admin_invest/index/<?php echo $invest->pid; ?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_invest/detial/<?php echo $invest->id; ?>"><?php echo lang('page_where_detial'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td><?php echo lang('order_num'); ?>：<?php echo $invest->order_num; ?></td>
                    <td><?php echo lang('pid'); ?>：<?php echo $invest->pid; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('pname'); ?>：<?php echo $invest->pname; ?></td>
                    <td><?php echo lang('items_id'); ?>：<?php echo $invest->items_id; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('price'); ?>：<?php echo $invest->price; ?></td>
                    <td><?php echo lang('buy_number'); ?>：<?php echo $invest->buy_number; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('amount'); ?>：<?php echo $invest->amount; ?></td>
                    <td><?php echo lang('mail_fee'); ?>：<?php echo $invest->mail_fee; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('total_amount'); ?>：<?php echo $invest->total_amount; ?></td>
                    <td><?php echo lang('step_status'); ?>：<?php echo $invest->step_status; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('suggest'); ?>：<?php echo $invest->suggest; ?></td>
                    <td><?php echo lang('uid'); ?>：<?php echo $invest->uid; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('username'); ?>：<?php echo $invest->username; ?></td>
                    <td><?php echo lang('cellphone'); ?>：<?php echo $invest->cellphone; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('province_name'); ?>：<?php echo $invest->province_name; ?></td>
                    <td><?php echo lang('city_name'); ?>：<?php echo $invest->city_name; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('area_name'); ?>：<?php echo $invest->area_name; ?></td>
                    <td><?php echo lang('address'); ?>：<?php echo $invest->address; ?></td>
                </tr>
                 <tr align="left">
                    <td><?php echo lang('addtime'); ?>：</label><?php echo date("Y-m-d H:i:s",$invest->addtime); ?></td>
                    <td><?php echo lang('paytime'); ?>：</label><?php echo date("Y-m-d H:i:s",$invest->paytime); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
