<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_items/index/<?php echo $product_id;?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_items/index/<?php echo $product_id;?>"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_product_items/add/<?php echo $product_id;?>"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th width="5%"><?php echo lang('id'); ?></th>
                        <th width="5%"><?php echo lang('image_url'); ?></th>
                        <th width="5%"><?php echo lang('pid'); ?></th>
                        <th width="5%"><?php echo lang('price'); ?></th>
                        <th width="5%"><?php echo lang('total'); ?></th>
                        <th width="5%"><?php echo lang('sell_total'); ?></th>
                        <th width="5%"><?php echo lang('free_mail'); ?></th>
                        <th width="5%"><?php echo lang('mail_fee'); ?></th>
                        <th width="15%"><?php echo lang('title'); ?></th>
                        <th width="35%"><?php echo lang('replay'); ?></th>
                        <th width="5%"><?php echo lang('addtime'); ?></th>
                        <th width="5%"><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><img src="<?php echo base_url().$values->imageurl_thumb; ?>" width="50" height="30"  /></td>
                            <td><?php echo $values->pid; ?></td>
                            <td><?php echo $values->price; ?></td>
                            <td><?php echo $values->total; ?></td>
                            <td><?php echo $values->sell_total; ?></td>
                            <td><?php if($values->free_mail==0){echo "虚拟物品(不需邮寄)";}else if($values->free_mail==1){echo "不包邮";}else{echo "包邮";}?></td>
                            <td><?php echo $values->mail_fee;?></td>
                            <td><?php echo $values->title;?></td>
                            <td><?php echo $values->replay;?></td>
                            <td><?php echo $values->addtime; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin_product_items/edit/<?php echo $product_id;?>/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_product_items/del/<?php echo $product_id;?>/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
            <div class="pagin" id="page_url"></div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
