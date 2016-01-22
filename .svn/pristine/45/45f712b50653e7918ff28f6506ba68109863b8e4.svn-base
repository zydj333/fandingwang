<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">参与众筹</h2>
                <p>你好，<strong><?php echo $user['user_name']; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="cp-box">
                    <div class="thumb"><img src="<?php echo base_url() . $product->image_url; ?>" /></div>
                    <div class="desc">
                        <h3 class="yh"><?php echo $product->title; ?></h3>
                        <p><?php echo $product->discription; ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="shouhuo">
                    <table width="100%">
                        <tr>
                            <th width="10%" scope="row">订单号：</th>
                            <td width="90%"><?php echo $order->order_num; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">收货人：</th>
                            <td><?php echo $order->username; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">手机号码：</th>
                            <td><?php echo $order->cellphone; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">收货地址：</th>
                            <td><?php echo $order->province_name; ?><?php echo $order->city_name; ?><?php echo $order->area_name; ?><?php echo $order->address; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">备注：</th>
                            <td><?php echo $order->suggest; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="project-list">
                <div class="bd">
                    <table width="100%">
                        <tr>
                            <th width="10%" scope="col">项目名称</th>
                            <th width="10%" scope="col">发起人</th>
                            <th width="45%" scope="col">回报</th>
                            <th width="5%" scope="col">单价</th>
                            <th width="5%" scope="col">数量</th>
                            <th width="10%" scope="col">支持金额</th>
                            <th width="5%" scope="col">运费</th>
                            <th width="10%" scope="col">创建时间</th>
                        </tr>
                        <tr>
                            <td><?php echo $order->pname; ?></td>
                            <td><?php echo $product->account; ?></td>
                            <td><?php echo $itemsinfo->replay; ?></td>
                            <td>￥<?php echo $order->price; ?></td>
                            <td><?php echo $order->buy_number; ?></td>
                            <td>￥<?php echo $order->amount; ?></td>
                            <td>￥<?php echo $order->mail_fee; ?></td>
                            <td><?php echo date('Y-m-d H:i;s', $order->addtime); ?></td>
                        </tr>
                        <?php if ($order->step_status == 2): ?>
                            <tr>
                                <td colspan="5" class="tfoot yh">订单已支付 金额:<strong>￥<?php echo $order->total_amount; ?></strong></td>
                            </tr>
                        <?php elseif ($order->step_status == 1 || $order->step_status == 0): ?>
                            <tr>
                                <td colspan="5" class="tfoot yh">应付金额:<strong>￥<?php echo $order->total_amount; ?></strong></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <input type="hidden" id="order_id_to_pay" name="order_id_to_pay" value="<?php echo $order->order_num; ?>" />
                <?php if ($product->endtime > time()): ?>
                    <div class="ft">
                        <?php if ($order->step_status < 2): ?><a href="<?php echo base_url(); ?>pay/payment/<?php echo $order->order_num; ?>" class="btn yh sure-btn" id="pay_order_now" target="_blank">立刻付款</a><?php endif; ?><?php if ($order->step_status == 0): ?><a href="<?php echo base_url(); ?>order/editstepone/<?php echo $order->order_num; ?>" class="btn yh return-btn">返回</a><?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="ft">
                        <a>该项目已经结束众筹，无法继续支付！</a>
                    </div>
                <?php endif; ?>
            </div>
            <!--project-list end-->
        </div>
    </div>
</div>

