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
                <li><a href="<?php echo base_url(); ?>admin_product"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product/detial/<?php echo $product->id;?>"><?php echo lang('page_where_detial'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="formtitle"><span>产品信息</span></div>
            <table class="tablelist">
                    <tbody id="datalist" >
                        <tr align="left">
                            <td width="25%"><?php echo lang('id');?>：<?php echo $product->id;?></td>
                            <td width="25%"><?php echo lang('title');?>：<?php echo $product->title;?></td>
                            <td width="25%"><?php echo lang('title_salt');?>：<?php echo $product->title_salt;?></td>
                            <td width="25%"><?php echo lang('product_type');?>：<?php echo $product->type_name;?></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('province');?>：<?php echo $product->province_name;?></td>
                            <td width="25%"><?php echo lang('city');?>：<?php echo $product->city_name;?></td>
                            <td width="25%"><?php echo lang('video');?>：<?php echo $product->video;?></td>
                            <td width="25%"><?php echo lang('source_video');?>：<?php echo $product->source_video;?></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('banner');?>：<?php if($product->banner!=''){echo base_url().$product->banner;}else{echo '未上传';}?></td>
                            <td width="25%"><?php echo lang('image_url');?>：<?php if($product->image_url!=''){echo base_url().$product->image_url;}else{echo '未上传';}?></td>
                            <td width="25%"><?php echo lang('amount');?>：<?php echo $product->amount;?></td>
                            <td width="25%"><?php echo lang('support_amount');?>：<?php echo $product->support_amount;?></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('support_times');?>：<?php echo $product->support_times;?></td>
                            <td width="25%"><?php echo lang('views');?>：<?php echo $product->views;?></td>
                            <td width="25%"><?php echo lang('starttime');?>：<?php echo date('Y-m-d H:i:s',$product->starttime);?></td>
                            <td width="25%"><?php echo lang('endtime');?>：<?php echo date('Y-m-d H:i:s',$product->endtime);?></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('days');?>：<?php echo $product->days;?></td>
                            <td width="25%"><?php echo lang('user_id');?>：<?php echo $product->user_id;?></td>
                            <td width="50%" colspan="2" ><?php echo lang('discription');?>：<?php echo $product->discription;?></td>
                        </tr>
                        <tr align="left">
                            <td width="50%" colspan="2" ><?php echo lang('content');?>：<?php echo $product->content;?></td>
                            <td width="50%" colspan="2"></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('product_loading');?>：<?php echo $product->product_loading;?></td>
                            <td width="25%"><?php echo lang('repay');?>：<?php echo $product->repay;?></td>
                            <td width="25%"><?php echo lang('seo_title');?>：<?php echo $product->seo_title;?></td>
                            <td width="25%"><?php echo lang('seo_keyword');?>：<?php echo $product->seo_keyword;?></td>
                        </tr>
                        <tr align="left">
                            <td width="75%" colspan="3" ><?php echo lang('seo_discription');?>：<?php echo $product->seo_discription;?></td>
                            <td width="25%"><?php echo lang('addtime');?>：<?php echo $product->addtime;?></td>
                        </tr>
                        <tr align="left">
                            <td width="25%"><?php echo lang('is_effect');?>：<?php echo $product->is_effect;?></td>
                            <td width="25%"><?php echo lang('is_rem');?>：<?php echo $product->is_rem;?></td>
                            <td width="25%"><?php echo lang('salt');?>：<?php echo $product->salt;?></td>
                            <td width="25%"><?php echo lang('is_del');?>：<?php echo $product->is_del;?></td>
                        </tr>
                    </tbody>
            </table>
            <div class="formtitle"><span>购买子项</span></div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>展示图片</th>
                        <th>产品ID</th>
                        <th>标价</th>
                        <th>最大限制数目</th>
                        <th>购买数目</th>
                        <th>是否包邮</th>
                        <th>邮费</th>
                        <th>回报承诺</th>
                        <th>添加时间</th>
                    </tr>
                </thead>
                <?php if (!empty($product_items)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($product_items as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><img src="<?php echo base_url().$values->image_url; ?>" width="50" height="30"  /></td>
                            <td><?php echo $values->pid; ?></td>
                            <td><?php echo $values->price; ?></td>
                            <td><?php echo $values->total; ?></td>
                            <td><?php echo $values->sell_total; ?></td>
                            <td><?php if($values->free_mail==0){echo "虚拟物品(不需邮寄)";}else if($values->free_mail==1){echo "不包邮";}else{echo "包邮";}?></td>
                            <td><?php echo $values->mail_fee;?></td>
                            <td><?php echo $values->replay;?></td>
                            <td><?php echo $values->addtime; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
            <div class="formtitle"><span>产品评论</span></div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>产品ID</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>评论详情</th>
                        <th>是否删除</th>
                        <th>添加时间</th>
                    </tr>
                </thead>
                <?php if (!empty($product_replay)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($product_replay as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->pid; ?></td>
                            <td><?php echo $values->uid; ?></td>
                            <td><?php echo $values->username; ?></td>
                            <td><?php echo $values->content; ?></td>
                            <td><?php if($values->is_del==0){echo "否";}else if($values->is_del==1){echo "<p style='color:red'>是</p>";}?></td>
                            <td><?php echo $values->addtime; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
