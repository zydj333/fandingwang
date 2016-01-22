<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/center">用户中心</a></li>
        <li class="active">地址管理</li>
    </ol>
    <div class="page-header">
        <h2 class="col-lg-12" style="text-align: center;"><strong>地址管理</strong></h2>
    </div>
    <div class="col-lg-12">
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/center">个人资料</a>
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/orderList">我的订单</a>
        <a class="col-lg-4 btn btn-success" href="<?php echo base_url(); ?>mobile/addressList">收货地址</a>
    </div>
            <?php if (!empty($address)): ?>
                <?php foreach ($address as $key => $value): ?>
            <table class="table table-hover table-bordered col-lg-12">
        <tbody>
                    <tr class="<?php if ($key % 2 == 0): ?>success<?php else: ?>danger<?php endif; ?>" style="height: 30px;" >
                        <th class="col-lg-2" style="text-align: center; vertical-align:middle;">收货人</th>
                        <td style="line-height: 30px;"><?php echo $value->username; ?></td>
<!--                        <td style="line-height: 30px; min-width: 40px"><?php echo $value->cellphone; ?></td>
                        <td style="line-height: 30px;"><?php echo $value->province_name . $value->city_name . $value->area_name . $value->address; ?></td>
                        <td style="line-height: 30px; min-width: 40px">
                            <a href="javascript:void(0);" onclick="return editAddress(<?php echo $value->id; ?>);" ><span>修改</span></a> <br>
                            <a href="javascript:void(0);" onclick="return delAddress(<?php echo $value->id; ?>);"><span>删除</span></a> <br>
                            <?php if ($value->is_default == 0): ?>
                                <a href="javascript:void(0);" onclick="return defaultAddress(<?php echo $value->id; ?>);"><span>默认</span></a>
                            <?php else: ?>
                                <span>默认地址</span>
                            <?php endif; ?>
                        </td>-->
                    </tr>
                    <tr>
                <th class="col-lg-2" style="text-align: center; vertical-align:middle;">联系电话</th>
                <td style="line-height: 30px; min-width: 40px"><?php echo $value->cellphone; ?></td>
            </tr>
            <tr>
                <th class="col-lg-6" style="text-align: center; vertical-align:middle;">地址</th>
                <td style="line-height: 30px;"><?php echo $value->province_name . $value->city_name . $value->area_name . $value->address; ?></td>
            </tr>
            <tr>
                <th class="col-lg-2" style="text-align: center; vertical-align:middle;">操作</th>
                <td style="line-height: 30px; min-width: 40px">
                    <a href="javascript:void(0);" onclick="return editAddress(<?php echo $value->id; ?>);" ><span>修改</span></a>&nbsp;
                            <a href="javascript:void(0);" onclick="return delAddress(<?php echo $value->id; ?>);"><span>删除</span></a>&nbsp;
                            <?php if ($value->is_default == 0): ?>
                                <a href="javascript:void(0);" onclick="return defaultAddress(<?php echo $value->id; ?>);"><span>设为默认</span></a>
                            <?php else: ?>
                                <span>默认地址</span>
                            <?php endif; ?>
                        </td>
            </tr>
                    </tbody>
    </table>
                <?php endforeach; ?>
            <?php endif; ?>
    <div class="col-lg-12">
        <a href="javascript:void(0);" class="btn btn-primary btn-block" id="add_address">+ 新增地址</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.artDialog.js?skin=black"></script>
<script type="text/javascript">
    $(function() {
        $("#add_address").click(function() {
            $.ajax({
                url: '/mobile/center_address_add/' + 'timer',
                success: function(data) {
                    $.dialog({
                        lock: true,
                        background: '#DDD', // 背景色
                        opacity: 0.50, // 透明度
                        content: data,
                        //icon: 'question',
                        ok: function() {
                            location.href = '/mobile/addressList';
                        },
                        cancel: true
                    });
                },
                cache: false
            });
        });

        /**
         * 警告
         * @param	{String}	消息内容
         */
        artDialog.alert = function(content, callback) {
            return artDialog({
                id: 'Alert',
                icon: 'warning',
                fixed: true,
                lock: true,
                content: content,
                ok: true,
                close: callback
            });
        };
    });

    //修改地址
    function editAddress(add_id) {
        $.ajax({
            url: '/mobile/center_address_edit/' + add_id + '/timer',
            success: function(data) {
                $.dialog({
                    lock: true,
                    background: '#DDD', // 背景色
                    opacity: 0.50, // 透明度
                    content: data,
                    //icon: 'question',
                    ok: function() {
                        location.href = '/mobile/addressList';
                    },
                    cancel: true
                });
            },
            cache: false
        });
    }
    //删除地址
    function delAddress(add_id) {
        $.ajax({
            type: "POST",
            url: "/mobile/center_address_del/" + Math.random(),
            data: {'add_id': add_id},
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $.dialog.alert(data.error);
                    location.href = '/mobile/addressList';
                } else {
                    $.dialog.alert(data.error);
                }
            }
        });
    }
    //默认地址
    function defaultAddress(add_id) {
        $.ajax({
            type: "POST",
            url: "/mobile/center_address_default/" + Math.random(),
            data: {'add_id': add_id},
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $.dialog.alert(data.error);
                    location.href = '/mobile/addressList';
                } else {
                    $.dialog.alert(data.error);
                }
            }
        });
    }
</script>