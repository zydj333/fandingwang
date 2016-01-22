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
                var username = $("#username").val();
                var celphone = $("#celphone").val();
                var project_name = $("#project_name").val();
                var status = $("#status").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_launch/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'username': username, 'celphone': celphone, 'project_name': project_name, 'status': status},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.project_name + '</td>';
                                str += '<td>' + values.username + '</td>';
                                str += '<td>';
                                if (values.gander == 0) {
                                    str += '男';
                                } else {
                                    str += '女';
                                }
                                str += '</td>';
                                str += '<td>' + values.celphone + '</td>';
                                str += '<td>'
                                if (values.status == 1) {
                                    str += '<span style="color:blue" >待审核</span>';
                                } else if (values.status == 2) {
                                    str += '<span style="color:red" >审核通过</span>';
                                } else if (values.status == 3) {
                                    str += '<span style="color:gray" >未通过</span>';
                                } else {
                                    str += '未知';
                                }
                                str += '</td>';
                                str += '<td>' + values.addtime + '</td>';
                                str += '<td>';
                                if (values.status == 1) {
                                    str += '<a href="javascript:void(0);" onclick="return pass(\'' + values.id + '\');" class="tablelink">通过</a> | ';
                                    str += '<a href="javascript:void(0);" onclick="return unpass(\'' + values.id + '\');" class="tablelink">不通过</a> | ';
                                }
                                str += '<a href="javascript:void(0);" onclick="return showDetial(\'' + values.id + '\');" class="tablelink">详情</a>';
                                str += '</td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#page_url").html(data.pageurl);
                    }
                });
            }



            function showDetial(id) {
                $.ajax({
                    url: '/admin_launch/detial/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            icon: 'succeed',
                            //cancel: true,
                        });
                    },
                    cache: false
                });
            }

            function pass(id) {
                $.ajax({
                    url: '/admin_launch/pass/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            icon: 'succeed',
                            ok: function() {
                                location.href = '/admin_launch/index';
                            }
                            //cancel: true,
                        });
                    },
                    cache: false
                });
            }

            function unpass(id) {
                $.ajax({
                    url: '/admin_launch/unpass/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            icon: 'succeed',
                            //cancel: true,
                            ok: function() {
                                location.href = '/admin_launch/index';
                            }
                        });
                    },
                    cache: false
                });
            }

        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_launch"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_launch/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>

        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <!--<li class="click"><a href="<?php echo base_url(); ?>admin_launch/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('username'); ?></label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('celphone'); ?></label><input name="celphone" id="celphone" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('project_name'); ?></label><input name="project_name" id="project_name" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('status'); ?></label>
                        <div class="vocation">
                            <select class="select3" name="status" id="status">
                                <option value="1"><?php echo lang('button'); ?></option>
                                <option value="2"><?php echo lang('passed'); ?></option>
                                <option value="3"><?php echo lang('unpassed'); ?></option>
                                <option value="0"><?php echo lang('all'); ?></option>
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
                        <th><?php echo lang('project_name'); ?></th>
                        <th><?php echo lang('username'); ?></th>
                        <th><?php echo lang('gander'); ?></th>
                        <th><?php echo lang('celphone'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('addtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <tbody id="datalist" >
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->project_name; ?></td>
                                <td><?php echo $values->username; ?></td>
                                <td><?php if ($values->gander == 0): ?>男<?php else: ?>女<?php endif; ?></td>
                                <td><?php echo $values->celphone; ?></td>
                                <td><?php if ($values->status == 1): ?><p style="color: blue">待审核</p><?php elseif ($values->status == 2): ?><p style="color: red">审核通过</p><?php elseif ($values->status == 3): ?><p style="color: gray">未通过<?php endif; ?></td>
                                <td><?php echo $values->addtime; ?></td>
                                <td>
                                    <?php if ($values->status == 1): ?>
                                        <a href="javascript:void(0);" onclick="return pass('<?php echo $values->id; ?>');" class="tablelink"><?php echo lang('pass'); ?></a> | 
                                        <a href="javascript:void(0);" onclick="return unpass('<?php echo $values->id; ?>');" class="tablelink"><?php echo lang('unpass'); ?></a> | 
                                    <?php endif; ?>
                                    <a href="javascript:void(0);" onclick="return showDetial('<?php echo $values->id; ?>');" class="tablelink"><?php echo lang('detial'); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $pageurl; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
