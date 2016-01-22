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
               var cellphone=$("#cellphone").val();
               var status=$("#status").val();
               $.ajax({
                        type: "POST",
                        url: "/admin_admessage/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'cellphone':cellphone,'status':status},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td>'+values.user_id+'</td>';
                            str+='<td>'+values.user_name+'</td>';
                            str+='<td>'+values.cellphone+'</td>';
                            str+='<td>'+values.content+'</td>';
                            str+='<td>';
                            if(values.status==0){
                                 str+='未发送';
                            }else if(values.status==1){
                                 str+='已发送';
                            }else if(values.status==2){
                                 str+='已使用';
                            }
                            str+='</td>';
                            str+='<td>'+values.trytimes+'</td>';
                            str+='<td>'+values.creattime+'</td>';
                            str+='<td>'+values.sendtime+'</td>';
                            str+='<td>';
                                str+='<a onclick="return confirm(\'你确定要重置并重新发送此信息？\')" href="/admin_admessage/reset/'+values.id+'" class="tablelink">重置</a>/';
                                str+='<a onclick="return confirm(\'你确定要删除此信息？\')" href="/admin_admessage/del/'+values.id+'" class="tablelink">删除</a>';
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
                <li><a href="<?php echo base_url(); ?>admin_admessage"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_admessage/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
            
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_admessage/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('cellphone'); ?></label><input name="cellphone" id="cellphone" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('status'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="status" id="status">
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
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('user_id'); ?></th>
                        <th><?php echo lang('user_name'); ?></th>
                        <th><?php echo lang('cellphone'); ?></th>
                        <th><?php echo lang('content'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('trytimes'); ?></th>
                        <th><?php echo lang('creattime'); ?></th>
                        <th><?php echo lang('sendtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->user_id; ?></td>
                            <td><?php echo $values->user_name; ?></td>
                            <td><?php echo $values->cellphone; ?></td>
                            <td><?php echo $values->content; ?></td>
                            <td><?php if($values->status==0){echo '未发送';}else if($values->status==1){echo '已发送';}?></td>
                            <td><?php echo $values->trytimes;?></td>
                            <td><?php echo $values->creattime;?></td>
                            <td><?php echo $values->sendtime; ?></td>
                            <td>
                                <a onclick="return confirm('<?php echo lang('reset_conform'); ?>')" href="<?php echo base_url(); ?>admin_admessage/reset/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('reset'); ?></a>/
                                <a onclick="return confirm('<?php echo lang('del_conform'); ?>')" href="<?php echo base_url(); ?>admin_admessage/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
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
