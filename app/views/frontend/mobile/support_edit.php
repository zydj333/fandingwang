<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/project">浏览项目</a></li>
        <li class="active"><?php echo $project->title; ?></li>
    </ol>
    <div class="page-header">
        <h3 class="col-lg-12">产品信息</h3>
    </div>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-6">
            <a class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url() . $project->image_url; ?>" alt="<?php echo $project->title; ?>"/>
            </a>
            <h3 class="list-group-item-heading"><?php echo $project->title; ?></h3>
            <p class="list-group-item-text">&nbsp;&nbsp;<?php echo $project->discription; ?></p>
        </div>
    </div>
    <div class="page-header">
        <h3 class="col-lg-12">订单信息</h3>
    </div>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>mobile/supportEdit">
                <div class="form-group">
                    <label>支持单价：<small>¥<?php echo $items->price; ?>元</small></label>
                    <input type="hidden" name="price" id="price" value="<?php echo $items->price; ?>">
                    <input type="hidden" name="total_number" id="total_number" value="<?php echo bcsub($items->total, $items->sell_total, 0); ?>">
                </div>
                <div class="form-group">
                    <label for="description">支持数量</label>
                    <input class="form-control" type="number" id="buy_number" name="buy_number" value="<?php echo $order->buy_number;?>"/>
                </div>
                <div class="form-group">
                    <label>总金额：<small id="amount">¥<?php echo $order->amount; ?>元</small></label>
                </div>
                <div class="form-group">
                    <label>配送邮费：<small>
                            <?php if ($items->free_mail == 0): ?>虚拟物品无需邮寄
                            <?php elseif ($items->free_mail == 2): ?>包邮
                            <?php elseif ($items->free_mail == 1): ?>
                                <?php echo $items->mail_fee; ?>
                            <?php endif; ?>
                        </small></label>
                </div>
                <div class="form-group">
                    <label>回报内容：<small><?php echo str_replace("\n", "<br/>", $items->replay); ?></small></label>
                </div>
                <div class="form-group">
                    <label for="description">备注信息</label>
                    <textarea class="form-control" rows="3" id="description" name="description"><?php echo $order->suggest;?></textarea>
                </div>
                <!--<div class="form-group">
                    <label for="ordernum">订单编号</label>
                    <input type="text" class="form-control" id="ordernum" readonly="readonly" >
                </div>
                <div class="form-group">
                    <label for="username">收货人</label>
                    <input type="text" class="form-control" id="username" >
                </div>
                <div class="form-group">
                    <label for="cellphone">手机号码</label>
                    <input type="text" class="form-control" id="cellphone" >
                </div>-->
                <input type="hidden" id="order_num" name="order_num" value="<?php echo $order->order_num;?>">
                <div class="form-group">
                    <label for="address">邮寄地址</label>
                    <div id="address_list">
                        <?php if (!empty($address)): ?>
                            <?php foreach ($address as $add_key => $add_value): ?>
                                <div class="radio"><label>
                                        <input type="radio" name="address" id="address_<?php echo $add_value->id; ?>" value="<?php echo $add_value->id; ?>" <?php if ($order->address_id == $add_value->id): ?>checked="checked"<?php endif; ?> > 
                                        <?php echo $add_value->username; ?>&nbsp;&nbsp;<?php echo $add_value->cellphone; ?>&nbsp;&nbsp;<?php echo $add_value->province_name; ?><?php echo $add_value->city_name; ?><?php echo $add_value->area_name; ?><?php echo $add_value->address; ?>
                                    </label></div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="radio"><label style="color:red">您还没有添加收货地址。</label></div>
                        <?php endif; ?>
                    </div>
                    <div class="radio"><label><a href="javascript:void(0);" class="btn btn-default" id="add_address" >+新增地址</a></label></div>
                </div>
                <button type="submit" class="btn btn-success btn-block">提交修改</button>
               <a href="<?php echo base_url();?>mobile/orderConform//<?php echo $order->order_num;?>" class="btn btn-default col-lg-6  btn-block">取消修改</a>
            </form>
        </div>
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
                            $.ajax({
                                type: "POST",
                                url: "/mobile/getMemberAllAddress/" + Math.random(),
                                data: {'type': 1},
                                dataType: "json",
                                success: function(data) {
                                    var str = '';
                                    if (data.flag === 1) {
                                        $.each(data.error, function(key, value) {
                                            str += '<div class="radio"><label>';
                                            str += '<input type="radio" name="address" id="address_' + value.id + '" value="' + value.id + '" ';
                                            if (value.is_default == 1) {
                                                str += 'checked="checked"';
                                            }
                                            str += '>';
                                            str += value.username + '&nbsp;&nbsp;' + value.cellphone + '&nbsp;&nbsp;' + value.province_name + value.city_name + value.area_name + value.address;
                                            str += '</label></div>';
                                        });
                                    } else {
                                        str += '<div class="radio"><label style="color:red">' + data.error + '</label></div>';
                                    }
                                    $('#address_list').html(str);
                                }
                            });
                        },
                        cancel: true
                    });
                },
                cache: false
            });
        });
        
        //数量变动，总价格改变
        $('#buy_number').change(function() {
            var buy_number = parseInt($('#buy_number').val());
            var total_number = parseInt($('#total_number').val());
            var price = parseFloat($('#price').val());
            buy_number=/^\d+/.exec(buy_number);
            if (buy_number < 1) {
                buy_number = 1;
            }
            if (buy_number > total_number) {
                buy_number = total_number;
            }
            $('#buy_number').val(buy_number);
            var total_amount = buy_number * price;
            $('#amount').html('¥' + parseFloat(total_amount) + ' 元');
        }); 
    });
</script>