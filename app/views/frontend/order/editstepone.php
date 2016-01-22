<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head" style="border-bottom:none;">
                <h2 class="yh">参与众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="cp-box">
                    <div class="thumb"><img src="<?php echo base_url() . $product->image_url; ?>"/></div>
                    <div class="desc">
                        <h3 class="yh"><?php echo $product->title; ?></h3>
                        <p><?php echo $product->discription; ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <form action="<?php echo base_url(); ?>order/saveStepOneEdit" method="post">
                <div class="body body6">
                    <ul class="form-ul">
                        <li>
                            <label for="">众筹单价</label>
                            <div class="txt">￥：<?php echo $items->price; ?></div>
                            <input type="hidden" id="price" value="<?php echo $items->price; ?>" name="price" />
                            <input type="hidden" id="totle_left" value="<?php echo bcsub($items->total, $items->sell_total, 0); ?>" name="totle_left" />
                            <input type="hidden" id="items_id" value="<?php echo $order->items_id; ?>" name="items_id" />
                            <input type="hidden" id="product_id" value="<?php echo $order->pid; ?>" name="product_id" />
                            <input type="hidden" id="order_num" value="<?php echo $order->order_num; ?>" name="order_num" />
                        </li>
                        <li>
                            <label for="">配送运费</label>
                            <div class="txt">
                                <?php if ($items->free_mail == 0): ?>
                                    虚拟产品无需邮寄！
                                <?php elseif ($items->free_mail == 1): ?>
                                    不包邮，邮费（￥:<?php echo $items->mail_fee; ?>）;
                                <?php else: ?>
                                    包邮
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <label for="">回报内容</label>
                            <div class="txt" style="line-height:28px; padding-top:6px;"><?php echo $items->replay; ?></div>
                        </li>
                        <li>
                            <label for="">购买数量</label>
                            <div class="txt" style="line-height:28px; padding-top:6px;">
                                <input type="number" class="text" id="bynumber" value="<?php echo $order->buy_number; ?>" name="bynumber" style="width: 80px;" />总金额￥:<nobr style="color: red;" id="total_amount"><?php echo $order->amount; ?>元</nobr>
                            </div>
                        </li>
                        <li>
                            <label for="">备注</label>
                            <textarea name="suggest" class="text textarea" style="height:60px;" placeholder="你想对项目发起者说的话"><?php echo $order->suggest; ?></textarea>
                        </li>
                    </ul>
                    <div class="line"></div>
                    <ul class="form-ul">
                        <li>
                            <label>收货地址</label>
                            <p></p>
                        </li>
                        <div id="addres_list">
                            <?php if (!empty($address)): ?>
                                <?php foreach ($address as $key => $add): ?>
                                    <li>
                                        <label></label>
                                        <input type="radio"  id="address_<?php echo $add->id; ?>" value="<?php echo $add->id; ?>" name="address" <?php if ($add->id == $order->address_id): ?>checked="checked"<?php endif; ?> />
                                        <?php echo $add->username . '&nbsp;&nbsp;' . $add->cellphone . '&nbsp;&nbsp;' . $add->province_name . $add->city_name . $add->area_name . $add->address; ?>                     
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>
                                    <label></label>
                                    您还没有添加收货地址!
                                </li>
                            <?php endif; ?>
                        </div>
                        <li>
                            <label for=""></label>
                            <p><a href="javascript:void(0);" style="color:blue;" id="add_address" >+添加地址</a></p>
                        </li>
                    </ul>
                    <div class="line" style="margin-bottom:20px;"></div>
                </div>
                <div class="foot">
                    <p>
                        <input type="checkbox" checked="checked" />
                        我已阅读并同意<a href="#">《泛丁众筹协议》</a></p>
                    <input type="submit" class="submit" value="下一步" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#bynumber").change(function() {
            var byNumber = parseInt($('#bynumber').val());
            var price = parseFloat($('#price').val());
            var maxNumber = parseInt($('#totle_left').val());
            byNumber=/^\d+/.exec(byNumber);
            if (byNumber < 1) {
                byNumber = 1;
            }
            if (byNumber > maxNumber) {
                byNumber = maxNumber;
            }
            $('#bynumber').val(byNumber);
            $('#total_amount').html(byNumber * price + ' 元');
        });

        //添加地址
        $("#add_address").click(function() {
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
                            var id = 0;
                            $.ajax({
                                type: "POST",
                                url: "/order/getAddressList/" + Math.random(),
                                data: {'id': id},
                                dataType: "json",
                                success: function(data) {
                                    var str = '';
                                    if (data.flag == 1) {
                                        $.each(data.error, function(key, value) {
                                            str += '<li><label></label>';
                                            str += '<input type="radio"  id="address_' + value.id + '" value="' + value.id + '" name="address" ';
                                            if (value.is_default == 1) {
                                                str += 'checked="checked"';
                                            }
                                            str += '/>';
                                            str += value.username + '&nbsp;&nbsp;' + value.cellphone + '&nbsp;&nbsp;' + value.province_name + value.city_name + value.area_name + value.address;
                                            str += '</li>';
                                        });
                                        $("#addres_list").html('');
                                        $("#addres_list").html(str);
                                    } else {
                                        $.dialog.alert(data.error);
                                    }
                                }
                            });
                        }
                    });
                },
                cache: false
            });
        });

    });
</script>