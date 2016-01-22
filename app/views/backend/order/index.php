<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select3").uedSelect({
                    width: 145
                });
            });

            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var order_num = $("#order_num").val();
                var username = $("#username").val();
                var cellphone = $("#cellphone").val();
                var pname = $("#pname").val();
                var step_status = $("#step_status").val();
                var types=$("#types").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_order/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'order_num': order_num, 'username': username, 'cellphone': cellphone, 'pname': pname, 'step_status': step_status,'types':types},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.order_num + '</td>';
                                str += '<td>' + values.pname + '</td>';
                                str += '<td>' + values.username + '</td>';
                                str += '<td>' + values.cellphone + '</td>';
                                str += '<td>' + values.total_amount + '</td>';
                                str += '<td>'
                                if(values.step_status==0){
                                         str += '<span style="color:gray" >待确认</span>';
                                    }else if(values.step_status==1){
                                         str += '<span style="color:blue" >等待支付</span>';
                                    }else if (values.step_status==2) {
                                         str += '<span style="color:red" >已支付</span>';   
                                    }else{
                                         str += '取消';   
                                    }
                                str += '</td>';
                                str += '<td>' + values.addtime + '</td>';
                                str += '<td>';
                                if(values.type==0){
                                    str += '用户购买'; 
                                } else{
                                    str += '系统生成';
                                }
                                str += '</td>';
                                str += '<td>';
                                str += '<a href="javascript:void(0);" onclick="return showDetial(\'' + values.order_num + '\');" class="tablelink">详情</a>';
                                if(values.step_status==10){
                                str +=' | <a href="javascript:void(0);" onclick="return changePayed(\'' + values.order_num + '\');" class="tablelink">改为已支付(慎点)</a>';
                                 }
                                str += '</td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#page_url").html(data.pageurl);
                    }
                });
            }
            
            function changePayed(ordernum){
            $.ajax({
                 type: "POST",
                    url: "/admin_order/payByAdmin/" + Math.random(),
                    data: {'orderNum': ordernum},
                    dataType: "json",
                    success: function(data) {
                        if(data.flag==0){
                            alert(data.error);
                        }else{
                             alert(data.error);
                             location.href="/admin_order/index";
                        }
                    }
                });
            }


            function showDetial(ordernum) {
                 $.ajax({
                        url: '/admin_order/detial/' + ordernum+'/'+ Math.random(),
                        success: function(data) {
                            art.dialog({
                                lock: true,
                                background: '#DDD', // 背景色
                                opacity: 0.50, // 透明度
                                content: data,
                                icon: 'succeed',
                                cancel: true,
                            });
                        },
                        cache: false
                    });
            }
            
            //获取excel报表
            function getExcel(){
                var order_num = $("#order_num").val();
                var username = $("#username").val();
                var cellphone = $("#cellphone").val();
                var pname = $("#pname").val();
                var step_status = $("#step_status").val();
                var types=$("#types").val();
                window.open('/admin_order/createExcel/'+ Math.random()+'?order_num='+ order_num+ '&username='+username+'&cellphone='+ cellphone+ '&pname='+pname+'&step_status='+step_status+'&types='+types);
            }
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_order"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_order/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>

        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_order/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('order_num'); ?></label><input name="order_num" id="order_num" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('cellphone'); ?></label><input name="cellphone" id="cellphone" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('pname'); ?></label><input name="pname" id="pname" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('step_status'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="step_status" id="step_status">
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <option value="0"><?php echo lang('no'); ?></option>
                                <option value="1"><?php echo lang('waiting'); ?></option>
                                <option value="2"><?php echo lang('payde'); ?></option>
                            </select>
                        </div>
                    </li>
                    <li><label><?php echo lang('type'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="types" id="types">
                                <option value="-1"><?php echo lang('all'); ?></option>
                                <option value="0">用户购买</option>
                                <option value="1">系统生成</option>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                    <li><label>&nbsp;</label><input name="" onclick="return getExcel()" type="button" class="scbtn" value="<?php echo lang('excel'); ?>"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('order_num'); ?></th>
                        <th><?php echo lang('pname'); ?></th>
                        <th><?php echo lang('username'); ?></th>
                        <th><?php echo lang('cellphone'); ?></th>
                        <th><?php echo lang('total_amount'); ?></th>
                        <th><?php echo lang('step_status'); ?></th>
                        <th><?php echo lang('addtime'); ?></th>
                        <th><?php echo lang('type'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                        <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->order_num; ?></td>
                                <td><?php echo $values->pname; ?></td>
                                <td><?php echo $values->username; ?></td>
                                <td><?php echo $values->cellphone; ?></td>
                                <td><?php echo $values->total_amount; ?></td>
                                <td>
                                    <?php 
                                    if($values->step_status==0){
                                         echo '<span style="color:gray" >待确认</span>';
                                    }elseif($values->step_status==1){
                                         echo '<span style="color:blue" >等待支付</span>';
                                    }elseif ($values->step_status==2) {
                                         echo '<span style="color:red" >已支付</span>';   
                                    }else{
                                        echo '取消';   
                                    }
                                    ?></td>
                                <td><?php echo $values->addtime; ?></td>
                                <td><?php if($values->type==0){echo '用户购买';}else{echo '系统生成';} ?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="return showDetial('<?php echo $values->order_num; ?>');" class="tablelink"><?php echo lang('detial'); ?></a>
                                    <?php if($values->step_status==10):?> | <a href="javascript:void(0);" onclick="return changePayed('<?php echo $values->order_num; ?>');" class="tablelink">改为已支付(慎点)</a><?php endif;?>
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
