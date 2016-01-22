<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

            });


            //搜索
           function searchItemsList(){
               getPageUrl(1);
           }

               //分页
           function getPageUrl(nowpage){
               var website_name=$("#website_name").val();
               var loan_title=$("#loan_title").val();
               var loan_type=$("#loan_type").val();
               $.ajax({
                        type: "POST",
                        url: "/admin_tender/ajaxList/"+Math.random(),
                        data: {'nowpage':nowpage,'website_name':website_name,'loan_title':loan_title,'loan_type':loan_type},
                        dataType:"json",
                        success: function(data){
                            var str='';
                            if(data.flag==0){
                                str='<tr align="left"><td colspan="15">'+data.error+'</td></tr>';
                            }else{
                                 $.each(data.error, function(key, values) {
                            str+='<tr align="left">';
                            str+='<td>'+values.id+'</td>';
                            str+='<td>'+values.website_id+'</td>';
                            str+='<td>'+values.website_name+'</td>';
                            str+='<td>'+values.loan_title+'</td>';
                            str+='<td>'+values.loan_type+'</td>';
                            str+='<td>'+values.yields+'</td>';
                            str+='<td>'+values.amount+'</td>';
                            str+='<td>'+values.loan_time;
                            if(values.loan_time_type==0){
                                str+='(天)';
                            }else if(values.loan_time_type==1){
                                str+='(个月)';
                            }else{
                                str+='(年)';
                            }
                            str+='</td>';
                            str+='<td>'+values.loan_day+'</td>';
                            str+='<td>'+values.addtime+'</td>';
                            str+='<td>'+values.adder+'</td>';
                            str+='<td>';
                                str+='<a href="admin_tender/edit/'+values.id+'" class="tablelink">修改</a> | ';
                                str+='<a onclick="return confirm(\'你确定删除吗？\')" href="/admin_tender/del/'+values.id+'" class="tablelink">删除</a>';
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
                <li><a href="<?php echo base_url(); ?>admin_charging"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_charging/offline"><?php echo lang('charging_offline'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div id="usual1" class="usual">
                <div class="itab">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>admin_charging/index"><?php echo lang('page_where_list');?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin_charging/online"><?php echo lang('charging_online');?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin_charging/offline"  class="selected"><?php echo lang('charging_offline');?></a></li>
                        <li><a href="<?php echo base_url(); ?>admin_charging/cancel"><?php echo lang('charging_cancel');?></a></li>
                    </ul>
                </div>
            </div>
                <table class="tablelist">
                    <thead>
                        <tr>
                            <th><?php echo lang('id'); ?></th>
                            <th><?php echo lang('charging_ns'); ?></th>
                            <th><?php echo lang('uid'); ?></th>
                            <th><?php echo lang('uname'); ?></th>
                            <th><?php echo lang('amount'); ?></th>
                            <th><?php echo lang('pay_type'); ?></th>
                            <th><?php echo lang('status'); ?></th>
                            <th><?php echo lang('discription'); ?></th>
                            <th><?php echo lang('create_time'); ?></th>
                            <th><?php echo lang('update_time'); ?></th>
                            <th><?php echo lang('do_uid'); ?></th>
                            <th><?php echo lang('todo'); ?></th>
                        </tr>
                    </thead>
                    <?php if (!empty($list)): ?>
                        <tbody id="datalist">
                        <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->charging_ns; ?></td>
                                <td><?php echo $values->uid; ?></td>
                                <td><?php echo $values->uname; ?></td>
                                <td><?php echo $values->amount; ?></td>
                                <td><?php echo $values->pay_type; ?></td>
                                <td><?php echo $values->status; ?></td>
                                <td><?php echo $values->discription; ?></td>
                                <td><?php echo $values->create_time; ?></td>
                                <td><?php echo $values->update_time; ?></td>
                                <td><?php echo $values->do_uid; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin_charging/detial/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('detial'); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
                 <div class="pagin" id="page_url"><?php echo $page_url; ?></div>
            </div>
            <script type="text/javascript">
                $('.tablelist tbody tr:odd').addClass('odd');
            </script>
    </body>
</html>
