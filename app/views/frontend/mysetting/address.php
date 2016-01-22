<div class="member">
    <div class="userCenter">
        <div class="head">
            <h2 class="yh">个人设置</h2>
        </div>
        <form action="" method="post">
            <div class="body clearfix">
                <div class="tabs">
                    <div class="tab-hd">
                        <ul>
                            <li><a href="<?php echo base_url() ?>mysetting">基本资料</a></li>
                            <li><a href="<?php echo base_url() ?>mysetting/password">修改密码</a></li>
                            <li class="on"><a href="<?php echo base_url() ?>mysetting/address">收货地址</a></li>
                            <!--<li><a href="<?php echo base_url() ?>mysetting/cardbind">帐号绑定</a></li>-->
                        </ul>
                    </div>
                    <div class="tab-bd">
                        <div class="tab-pal">
                            <table width="800px">
                                <tr style="line-height: 40px">
                                    <th width="15%" scope="col">收货人</th>
                                    <th width="15%" scope="col">联系电话</th>
                                    <th width="50%" scope="col">详细地址</th>
                                    <th width="20%" scope="col">操作</th>
                                </tr>
                                <?php if (!empty($address)): ?>
                                    <?php foreach ($address as $key => $value): ?>
                                        <tr style="line-height: 40px" align="center">
                                            <td><?php echo $value->username; ?></td>
                                            <td><?php echo $value->cellphone; ?></td>
                                            <td><?php echo $value->province_name . $value->city_name . $value->area_name . $value->address; ?></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="return editaddress(<?php echo $value->id; ?>)" style="color:blue;">修改</a> / 
                                                <a href="javascript:void(0)" onclick="return deladdress(<?php echo $value->id; ?>)"  style="color:blue;">删除</a> / 
                                                <?php if ($value->is_default == 0): ?>
                                                    <a href="javascript:void(0)" onclick="return defaultset(<?php echo $value->id; ?>)"  style="color:blue;">设为默认</a>
                                                <?php else: ?>
                                                    默认地址
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">您还没有添加收货地址</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                            <ul class="form-ul2">
                                <li class="btn-li">
                                    <input type="button" id="address_button" class="btn yh" value="+新增地址" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#address_button").click(function() {
            $.ajax({
                url: '/mysetting/addressSave/' + Math.random(),
                success: function(data) {
                    art.dialog({
                        lock: true,
                        background: '#DDD', // 背景色
                        opacity: 0.80, // 透明度
                        content: data,
                        //icon: 'succeed',
                        //cancel: true,
                        ok: function() {
                            location.href = '/mysetting/address';
                        }
                    });
                },
                cache: false
            });
        });
    });
    //设为默认
    function defaultset(id) {
        $.ajax({
            type: "POST",
            url: "/mysetting/defaultset/" + Math.random(),
            data: {'id': id},
            dataType: "json",
            success: function(data) {
                if (data.flag == 1) {
                    $.dialog.alert(data.error);
                    location.href = '/mysetting/address';
                } else {
                    $.dialog.alert(data.error);
                }
            }
        });
    }

    //修改
    function editaddress(id) {
        $.ajax({
            url: '/mysetting/addressEdit/' + id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#DDD', // 背景色
                    opacity: 0.80, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    ok: function() {
                        location.href = '/mysetting/address';
                    }
                });
            },
            cache: false
        });
    }

    //删除
    function deladdress(id) {
        $.ajax({
            type: "POST",
            url: "/mysetting/deladdress/" + Math.random(),
            data: {'id': id},
            dataType: "json",
            success: function(data) {
                if (data.flag == 1) {
                    $.dialog.alert(data.error);
                    location.href = '/mysetting/address';
                } else {
                    $.dialog.alert(data.error);
                }
            }
        });
    }

</script>