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
            
            function dialogalert(value){
                $.ajax({
                        url: '/admin_member/detial/' + value+'/'+ Math.random(),
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
                var account = $("#account").val();
                var username = $("#username").val();
                var email = $("#email").val();
                var telphone = $("#telphone").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_member/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'account': account, 'username': username, 'email': email, 'telphone': telphone},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td><img width="32px" height="32px" src="/' + values.avatar + '"  onerror="this.onerror=\'\';this.src=\'/images/share_head.png\'"  /></td>';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.account + '</td>';
                                str += '<td>' + values.username + '</td>';
                                str += '<td>' + values.email + '</td>';
                                str += '<td>' + values.telphone + '</td>';
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
                <li><a href="<?php echo base_url(); ?>admin_member"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_member/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_member/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <!--<li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
                <ul class="seachform">
                    <li><label><?php echo lang('account'); ?></label><input name="account" id="account" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('email'); ?></label><input name="email" id="email" type="text" class="scinput" /></li>
                    <li><label><?php echo lang('telphone'); ?></label><input name="telphone" id="telphone" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="<?php echo lang('search'); ?>"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th width="10%"><?php echo lang('avatar'); ?></th>
                        <th width="10%"><?php echo lang('id'); ?></th>
                        <th width="15%"><?php echo lang('account'); ?></th>
                        <th width="15%"><?php echo lang('username'); ?></th>
                        <th width="20%"><?php echo lang('email'); ?></th>
                        <th width="10%"><?php echo lang('telphone'); ?></th>
                        <th width="10%"><?php echo lang('addtime'); ?></th>
                        <th width="10%"><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($list)): ?>
                    <tbody id="datalist" >
                        <?php foreach ($list as $key => $values): ?>
                            <tr align="left">
                                <td><img width="32px" height="32px" src="<?php echo base_url() . $values->avatar; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'"  /></td>
                                <td><?php echo $values->id; ?></td>
                                <td><?php echo $values->account; ?></td>
                                <td><?php echo $values->username; ?></td>
                                <td><?php echo $values->email; ?></td>
                                <td><?php echo $values->telphone; ?></td>
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
