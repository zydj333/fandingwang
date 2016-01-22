<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select3").uedSelect({
                    width: 145
                });
            });
            
            function dialogalert(value){
                $.ajax({
                        url: '/admin_invest/detial/' + value+'/'+ Math.random(),
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

            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var product_id=$("#product_id").val();
                var order_num = $("#order_num").val();
                var username = $("#username").val();
                var cellphone = $("#cellphone").val();
                var step_status = $("#step_status").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_invest/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'product_id':product_id,'order_num': order_num, 'username': username, 'cellphone': cellphone,'step_status':step_status},
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
                                str += '<td>' + values.total_amount + '</td>';
                                str += '<td>' + values.step_status + '</td>';
                                str += '<td>' + values.username + '</td>';
                                str += '<td>' + values.cellphone + '</td>';
                                str += '<td>' + values.addtime + '</td>';
                                str += '<td>';
                                str += '<a href="javascript:void(0);" onclick="return dialogalert('+values.id+');" class="tablelink">详情</a>'
                                str += '</td>';
                                str += '</tr>';
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
                <li><a href="<?php echo base_url(); ?>admin_invest/index/<?php echo $product_id;?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_invest/index/<?php echo $product_id;?>"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <input name="product_id" id="product_id" type="hidden" value="<?php echo $product_id;?>" class="scinput" />
                    <li><label><?php echo lang('order_num'); ?></label><input name="order_num" id="order_num" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('cellphone'); ?></label><input name="cellphone" id="cellphone" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('step_status'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="step_status" id="step_status">
                                <option value="-1">全部</option>
                                <option value="0">待确认</option>
                                <option value="1">待支付</option>
                                <option value="2">已支付</option>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th width="10%"><?php echo lang('id'); ?></th>
                        <th width="15%"><?php echo lang('order_num'); ?></th>
                        <th width="15%"><?php echo lang('pname'); ?></th>
                        <th width="10%"><?php echo lang('total_amount'); ?></th>
                        <th width="10%"><?php echo lang('step_status'); ?></th>
                        <th width="10%"><?php echo lang('username'); ?></th>
                        <th width="10%"><?php echo lang('cellphone'); ?></th>
                        <th width="10%"><?php echo lang('addtime'); ?></th>
                        <th width="10%"><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                        <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->order_num; ?></td>
                                <td><?php echo $values->pname; ?></td>
                                <td><?php echo $values->total_amount; ?></td>
                                <td><?php echo $values->step_status; ?></td>
                                <td><?php echo $values->username; ?></td>
                                <td><?php echo $values->cellphone; ?></td>
                                <td><?php echo $values->addtime; ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $values->id; ?>)"><?php echo lang('detial'); ?></a>
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
