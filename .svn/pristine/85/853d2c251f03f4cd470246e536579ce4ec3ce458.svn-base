<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>

        <script type="text/javascript">
            //搜索
            function searchItemsList(){
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage){
                var account=$("#uname").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_adjust/ajaxList/"+Math.random(),
                    data: {'nowpage':nowpage,'account':account},
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
                                str+='<td>'+values.uname+'</td>';
                                str+='<td>'+values.start_money+'</td>';
                                str+='<td>'+values.amount_money+'</td>';
                                str+='<td>'+values.fee+'</td>';
                                str+='<td>'+values.real_amount+'</td>';
                                str+='<td>'+values.frozen_money+'</td>';
                                str+='<td>'+values.totle_money+'</td>';
                                str+='<td>';
                                if(values.type=='adjust'){
                                    str+='调整';
                                }else{
                                   str+=values.type;
                                }
                                str+='</td>';
                                str+='<td>'+values.create_time+'</td>';
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
                <li><a href="<?php echo base_url(); ?>admin_adjust"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_adjust/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_adjust/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('uname'); ?></label><input name="uname" id="uname" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('uid'); ?></th>
                        <th><?php echo lang('uname'); ?></th>
                        <th><?php echo lang('start_money'); ?></th>
                        <th><?php echo lang('amount_money'); ?></th>
                        <th><?php echo lang('fee'); ?></th>
                        <th><?php echo lang('real_amount'); ?></th>
                        <th><?php echo lang('frozen_money'); ?></th>
                        <th><?php echo lang('totle_money'); ?></th>
                        <th><?php echo lang('type'); ?></th>
                        <th><?php echo lang('create_time'); ?></th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                    <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->uid; ?></td>
                                <td><?php echo $values->uname; ?></td>
                                <td><?php echo $values->start_money; ?></td>
                                <td><?php echo $values->amount_money; ?></td>
                                <td><?php echo $values->fee; ?></td>
                                <td><?php echo $values->real_amount; ?></td>
                                <td><?php echo $values->frozen_money; ?></td>
                                <td><?php echo $values->totle_money; ?></td>
                                <td><?php if ($values->type == 'adjust') {
                                echo '调整';
                            } else {
                                echo $values->type;
                            } ?></td>
                                <td><?php echo $values->create_time; ?></td>
                            </tr>
<?php endforeach; ?>
<?php endif; ?>
                        </tbody>
                    </table>
                    <div class="pagin" id="page_url"><?php echo $url; ?></div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
