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
               var phonenumber=$("#phonenumber").val();
               var status=$("#status").val();
               $.ajax({
                        type: "POST",
                        url: "/admin_varifycode/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'phonenumber':phonenumber,'status':status},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td>'+values.uid+'</td>';
                            str+='<td>'+values.phonenumber+'</td>';
                            str+='<td>'+values.phonecode+'</td>';
                            str+='<td>'+values.content+'</td>';
                            str+='<td>';
                            if(values.status==0){
                                 str+='<span style="color:gray;">未发送</span>';
                            }else if(values.status==1){
                                 str+='<span style="color:blue;">已发送</span>';
                            }else if(values.status==2){
                                 str+='<span style="color:red;">已使用</span>';
                            }
                            str+='</td>';
                            str+='<td>'+values.trytimes+'</td>';
                            str+='<td>'+values.passtime+'</td>';
                            str+='<td>'+values.creattime+'</td>';
                            str+='<td>';
                                str+='<a onclick="return confirm(\'你确定要重置并重新发送此信息？\')" href="/admin_varifycode/reset/'+values.id+'" class="tablelink">重置</a>/';
                                str+='<a onclick="return confirm(\'你确定要删除此信息？\')" href="/admin_varifycode/del/'+values.id+'" class="tablelink">删除</a>';
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
                <li><a href="<?php echo base_url(); ?>admin_varifycode"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_varifycode/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
            
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <!--<li class="click"><a href="<?php echo base_url(); ?>admin_varifycode/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('phonenumber'); ?></label><input name="phonenumber" id="phonenumber" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('status'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="status" id="status">
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <option value="0"><?php echo lang('no'); ?></option>
                                <option value="1"><?php echo lang('yes'); ?></option>
                                <option value="2"><?php echo lang('used'); ?></option>
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
                        <th><?php echo lang('uid'); ?></th>
                        <th><?php echo lang('phonenumber'); ?></th>
                        <th><?php echo lang('phonecode'); ?></th>
                        <th><?php echo lang('content'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('trytimes'); ?></th>
                        <th><?php echo lang('passtime'); ?></th>
                        <th><?php echo lang('creattime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->uid; ?></td>
                            <td><?php echo $values->phonenumber; ?></td>
                            <td><?php echo $values->phonecode; ?></td>
                            <td><?php echo $values->content; ?></td>
                            <td><?php if($values->status==0){echo '<span style="color:gray;">未发送</span>';}else if($values->status==1){echo '<span style="color:blue;">已发送</span>';}else if($values->status==2){echo '<span style="color:red;">已使用</span>';}?></td>
                            <td><?php echo $values->trytimes;?></td>
                            <td><?php echo $values->passtime;?></td>
                            <td><?php echo $values->creattime; ?></td>
                            <td>
                                <a onclick="return confirm('<?php echo lang('reset_conform'); ?>')" href="<?php echo base_url(); ?>admin_varifycode/reset/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('reset'); ?></a>/
                                <a onclick="return confirm('<?php echo lang('del_conform'); ?>')" href="<?php echo base_url(); ?>admin_varifycode/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
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
