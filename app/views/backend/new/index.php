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
               var title=$("#title").val();
               var search_name=$("#search_name").val();
               var type=$("#type").val();
               $.ajax({
                        type: "POST",
                        url: "/admin_new/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'title':title,'search_name':search_name,'type':type},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td>'+values.title+'</td>';
                            str+='<td>'+values.search_name+'</td>';
                            str+='<td>'+values.typename+'</td>';
                            str+='<td>'+values.views+'</td>';
                            str+='<td>'+values.replay+'</td>';
                            str+='<td>';
                            if(values.is_hot==0){
                                 str+='否';
                            }else{
                                 str+='是';
                            }
                            str+='</td>';
                            str+='<td>';
                            if(values.is_recom==0){
                                 str+='否';
                            }else{
                                 str+='是';
                            }
                            str+='</td>';
                            str+='<td>'+values.salt+'</td>';
                            str+='<td>'+values.adder+'</td>';
                            str+='<td>'+values.addtime+'</td>';
                            str+='<td>';
                                str+='<a href="/admin_new/edit/'+values.id+'" class="tablelink">修改</a>/';
                                str+='<a onclick="return confirm(\'你确定要删除此信息？\')" href="/admin_new/del/'+values.id+'" class="tablelink">删除</a>';
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
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_new"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_new/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_new/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
            </div>
            <ul class="seachform">
                    <li><label><?php echo lang('title'); ?></label><input name="title" id="title" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('search_name'); ?></label><input name="search_name" id="nick_name" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('type'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="type" id="type">
                                <option value="-1"><?php echo lang('all'); ?></option>
                                 <?php foreach ($type as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>"><?php echo $v->title; ?></option>
                                <?php foreach ($v->second as $key => $value): ?>
                                    <option value="<?php echo $value->id; ?>">&nbsp;&nbsp;<?php echo $value->title; ?></option>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('title'); ?></th>
                        <th><?php echo lang('search_name'); ?></th>
                        <th><?php echo lang('type'); ?></th>
                        <th><?php echo lang('views'); ?></th>
                        <th><?php echo lang('replay'); ?></th>
                        <th><?php echo lang('is_hot'); ?></th>
                        <th><?php echo lang('is_recom'); ?></th>
                        <th><?php echo lang('salt'); ?></th>
                        <th><?php echo lang('adder'); ?></th>
                        <th><?php echo lang('addtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                    <?php foreach ($list as $key => $values): ?>
                        <tr align="left">
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->title; ?></td>
                            <td><?php echo $values->search_name; ?></td>
                            <td><?php echo $values->typename; ?></td>
                            <td><?php echo $values->views; ?></td>
                            <td><?php echo $values->replay; ?></td>
                            <td><?php if($values->is_hot==1){echo "是";}else{echo "否";} ?></td>
                            <td><?php if($values->is_recom==1){echo "是";}else{echo "否";} ?></td>
                            <td><?php echo $values->salt; ?></td>
                            <td><?php echo $values->adder; ?></td>
                            <td><?php echo $values->addtime; ?></td>
                            <td> 
                                <a href="<?php echo base_url(); ?>admin_new/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_new/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
             <div class="pagin" id="page_url"><?php echo $url; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
