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
               var project_name=$("#project_name").val();
               var project_type=$("#project_type").val();
               var is_success=$("#is_success").val();
               $.ajax({
                        type: "POST",
                        url: "/admin_project/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'project_name':project_name,'project_type':project_type,'is_success':is_success},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td><img src="/'+values.imageurl_thumb+'" width="50" height="30"  /></td>';
                            str+='<td>'+values.project_name+'</td>';
                            str+='<td>'+values.usertype+'</td>';
                            str+='<td>'+values.amount+'</td>';
                            str+='<td>'+values.support_amount+'</td>';
                            str+='<td>';
                            if(values.is_effect==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>';
                            if(values.is_success==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>';
                            if(values.is_classic==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>';
                            if(values.is_recomment==1){str+='是';}else{str+='否';}str+='</td>';
                            str+='<td>'+values.salt+'</td>';
                            str+='<td>'+values.creat_time+'</td>';
                            str+='<td>';
                                str+='<a href="/admin_project/detial/'+values.id+'" class="tablelink">详情</a> ';
                                str+='<a href="/admin_project/tender/'+values.id+'" class="tablelink">项目动态</a> ';
                                str+='<a href="/Admin_project_introduce/index/'+values.id+'" class="tablelink">项目介绍</a> ';
                                str+='<a href="/admin_project/invest/'+values.id+'" class="tablelink">投资记录</a> ';
                                str+='<a href="/admin_project/edit/'+values.id+'" class="tablelink">修改</a> ';
                                str+='<a onclick="return confirm(\'你确定删除吗？\')" href="/admin_project/del/'+values.id+'" class="tablelink">删除</a>';
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
                <li><a href="<?php echo base_url(); ?>admin_project"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_project/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
            
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_project/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <!--<li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('project_name'); ?></label><input name="project_name" id="project_name" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('project_type'); ?></label>
                        <div class="vocation">
                            <select class="select3" class="project_type" id="project_type" >
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <?php foreach($type as $k=>$v):?>
                                <option value="<?php echo $v->id;?>"><?php echo $v->title;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label><?php echo lang('is_success'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="is_success" id="is_success">
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
                        <th><?php echo lang('project_image'); ?></th>
                        <th><?php echo lang('project_name'); ?></th>
                        <th><?php echo lang('usertype'); ?></th>
                        <th><?php echo lang('amount'); ?></th>
                        <th><?php echo lang('support_amount'); ?></th>
                        <th><?php echo lang('is_effect'); ?></th>
                        <th><?php echo lang('is_success'); ?></th>
                        <th><?php echo lang('is_classic'); ?></th>
                        <th><?php echo lang('is_recomment'); ?></th>
                        <th><?php echo lang('salt'); ?></th>
                        <th><?php echo lang('creat_time'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><img src="<?php echo base_url().$values->imageurl_thumb; ?>" width="50" height="30"  /></td>
                            <td><?php echo $values->project_name; ?></td>
                            <td><?php echo $values->usertype; ?></td>
                            <td><?php echo $values->amount; ?></td>
                            <td><?php echo $values->support_amount; ?></td>
                            <td><?php if($values->is_effect==1){echo'是';}else{echo '否';} ?></td>
                            <td><?php if($values->is_success==1){echo'是';}else{echo '否';}?></td>
                            <td><?php if($values->is_classic==1){echo'是';}else{echo '否';}?></td>
                            <td><?php if($values->is_recomment==1){echo'是';}else{echo '否';}?></td>
                            <td><?php echo $values->salt; ?></td>
                            <td><?php echo $values->creat_time; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin_project/detial/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('detial'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_project/tender/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('tender'); ?></a>
                                <a href="<?php echo base_url(); ?>Admin_project_introduce/index/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('introduce'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_project/invest/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('invest'); ?></a>  
                                <a href="<?php echo base_url(); ?>admin_project/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_project/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
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
