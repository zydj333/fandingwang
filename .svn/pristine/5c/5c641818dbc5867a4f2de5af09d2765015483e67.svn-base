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
            $(document).ready(function(){
                $(".select3").uedSelect({
                    width : 145
                });
            });

         //搜索
           function searchItemsList(){
               getPageUrl(1);
           }

               //分页
           function getPageUrl(nowpage){
               var product_name=$("#product_name").val();
               var project_type=$("#project_type").val();
               var is_rem=$("#is_rem").val();
               var is_del=0;
               var is_effect=-1;
               $.ajax({
                        type: "POST",
                        url: "/admin_product/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'product_name':product_name,'project_type':project_type,'is_rem':is_rem,'is_del':is_del,'is_effect':is_effect},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td><img src="/'+values.image_url+'" width="50" height="30"  /></td>';
                            str+='<td>'+values.title+'</td>';
                            str+='<td>'+values.user_id+'</td>';
                            str+='<td>'+values.amount+'</td>';
                            str+='<td>'+values.support_amount+'</td>';
                            str+='<td>';
                            if(values.is_effect==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>';
                            if(values.is_rec==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>';
                            if(values.is_success==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>'+values.support_times+'</td>';
                            str+='<td>'+values.views+'</td>';
                            str+='<td>'+values.repay+'</td>';
                            str+='<td>'+values.salt+'</td>';
                            str+='<td>'+values.starttime+'</td>';
                            str+='<td>'+values.endtime+'</td>';
                            str+='<td>';
                                str+='<a href="/admin_product/detial/'+values.id+'" class="tablelink">详情</a> ';
                                str+='<a href="/admin_product_tender/index/'+values.id+'" class="tablelink">项目动态</a> ';
                                str+='<a href="/admin_product_items/index/'+values.id+'" class="tablelink">购买子项</a> ';
                                str+='<a href="/admin_invest/index/'+values.id+'" class="tablelink">购买记录</a> ';
                                str+='<a href="/admin_product_replay/index/'+values.id+'" class="tablelink">评论</a> ';
                                str+='<a href="/admin_product/edit/'+values.id+'" class="tablelink">修改</a> ';
                                str+='<a onclick="return confirm(\'你确定删除吗？\')" href="/admin_product/del/'+values.id+'" class="tablelink">删除</a>';
                            str+='</td>';
                        str+='</tr>';
                                });
                            }
                            $("#datalist").html(str);
                            $("#page_url").html(data.pageurl);
                        }
                    });
           }
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
            
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_product/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('title'); ?></label><input name="product_name" id="product_name" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('product_type'); ?></label>
                        <div class="vocation">
                            <select class="select3" class="project_type" id="project_type" >
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <?php foreach($type as $k=>$v):?>
                                <option value="<?php echo $v->id;?>"><?php echo $v->title;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label><?php echo lang('is_rem'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="is_rem" id="is_rem">
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <option value="0"><?php echo lang('no'); ?></option>
                                <option value="1"><?php echo lang('yes'); ?></option>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?><i class="sort"><img src="<?php echo base_url(); ?>images/backend/px.gif" /></i></th>
                        <th><?php echo lang('image_url'); ?></th>
                        <th><?php echo lang('title'); ?></th>
                        <th><?php echo lang('user_id'); ?></th>
                        <th><?php echo lang('amount'); ?></th>
                        <th><?php echo lang('support_amount'); ?></th>
                        <th><?php echo lang('is_effect'); ?></th>
                        <th><?php echo lang('is_rem'); ?></th>
                        <th><?php echo lang('is_success'); ?></th>
                        <th><?php echo lang('support_times'); ?></th>
                        <th><?php echo lang('views'); ?></th>
                        <th><?php echo lang('repay'); ?></th>
                        <th><?php echo lang('salt'); ?></th>
                        <th><?php echo lang('starttime'); ?></th>
                        <th><?php echo lang('endtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><img src="<?php echo base_url().$values->imageurl_thumb; ?>" width="50" height="30"  /></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $values->user_id; ?></td>
                            <td><?php echo $values->amount; ?></td>
                            <td><?php echo $values->support_amount; ?></td>
                            <td><?php if($values->is_effect==1){echo'是';}else{echo '否';} ?></td>
                            <td><?php if($values->is_rem==1){echo'是';}else{echo '否';} ?></td>
                            <td><?php if($values->is_success==1){echo'是';}else{echo '否';} ?></td>
                            <td><?php echo $values->support_times;?></td>
                            <td><?php echo $values->views;?></td>
                            <td><?php echo $values->repay;?></td>
                            <td><?php echo $values->salt;?></td>
                            <td><?php echo $values->starttime; ?></td>
                            <td><?php echo $values->endtime; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin_product/detial/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('detial'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_product_tender/index/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('tender'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_product_items/index/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('buyitems'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_invest/index/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('invest'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_product_replay/index/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('replay'); ?></a> 
                                <a href="<?php echo base_url(); ?>admin_product/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_product/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
            <div class="pagin" id="page_url"><?php echo $pageurl; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
