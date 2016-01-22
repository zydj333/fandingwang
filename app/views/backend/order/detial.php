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
                    <td><?php echo lang('order_num'); ?>：<?php echo $order->order_num; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('pid'); ?>：<?php echo $order->pid; ?></td>
                    <td><?php echo lang('pname'); ?>：<?php echo $order->pname; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('items_id'); ?>：<?php echo $order->items_id; ?></td>
                    <td><?php echo lang('price'); ?>：<?php echo $order->price; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('buy_number'); ?>：<?php echo $order->buy_number; ?></td>
                    <td><?php echo lang('amount'); ?>：<?php echo $order->amount; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('mail_fee'); ?>：<?php echo $order->mail_fee; ?></td>
                    <td><?php echo lang('total_amount'); ?>：<?php echo $order->total_amount; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('step_status'); ?>：<?php 
                                    if($order->step_status==0){
                                         echo '<nobr style="color:gray" >待确认</nobr>';
                                    }elseif($order->step_status==1){
                                         echo '<nobr style="color:blue" >等待支付</nobr>';
                                    }elseif ($order->step_status==2) {
                                         echo '<nobr style="color:red" >已支付</nobr>';   
                                    }else{
                                        echo '取消';   
                                    }
                                    ?></td>
                    <td><?php echo lang('suggest'); ?>：<?php echo $order->suggest; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('uid'); ?>：<?php echo $order->uid; ?></td>
                    <td><?php echo lang('username'); ?>：<?php echo $order->username; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('cellphone'); ?>：<?php echo $order->cellphone; ?></td>
                    <td><?php echo lang('province_name'); ?>：<?php echo $order->province_name; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('city_name'); ?>：<?php echo $order->city_name;?></td>
                    <td><?php echo lang('area_name'); ?>：<?php echo $order->area_name;?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('address'); ?>：<?php echo $order->address;?></td>
                    <td><?php echo lang('addtime'); ?>：<?php echo date('Y-m-d H:i;s',$order->addtime);?></td>
                </tr>
                 <tr align="left">
                    <td><?php echo lang('paytime'); ?>：</label><?php echo date('Y-m-d H:i;s',$order->paytime); ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </body>
</html>
