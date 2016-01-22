<!--海报START-->
<div class="proDbanner" style="background:url(<?php echo base_url() . $product->banner; ?>) no-repeat center top"></div>
<!--END-->
<!--项目详情START-->
<div class="proDetail">
    <div class="box">
        <div class="left">
            <div class="nav">
                <ul>
                    <li class="now">故事</li>
                    <li><a href="<?php echo base_url(); ?>project/tender/<?php echo $product->id; ?>">更新(<?php echo $product->product_loading; ?>)</a></li>
                    <li><a href="<?php echo base_url(); ?>project/repay/<?php echo $product->id; ?>">讨论(<?php echo $product->repay; ?>)</a></li>
                    <li><a href="<?php echo base_url(); ?>project/invest/<?php echo $product->id; ?>">支持者(<?php echo $product->support_times; ?>)</a></li>
                </ul>
            </div>
            <div class="con">
                <?php if ($product->source_video != ''): ?>
                    <embed src="<?php echo $product->source_video; ?>" allowFullScreen="true" quality="high" width="680" height="460" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
                <?php endif; ?>
                <p><?php echo $product->content; ?></p>
            </div>
        </div>

        <div class="right">
            <div class="nav">
                <?php if ($product->starttime < $now_time && $product->endtime > $now_time): ?>众筹中
                <?php elseif ($product->starttime > $now_time): ?>即将开始
                <?php elseif ($product->endtime < $now_time): ?>已经结束
                <?php endif; ?>
            </div>
            <div class="con">
                <div class="head">
                    <div class="money">
                        <div class="ti">￥<span><?php echo intval($product->support_amount); ?></span></div>
                        目标金额为 ¥<?php echo intval($product->amount); ?>元
                    </div>
                    <div class="rate">
                        <div class="bar" style="width:<?php
                        $percent = bcdiv($product->support_amount, $product->amount, 5);
                        if ($percent > 1) {
                            $percent = 1;
                        }
                        echo bcmul($percent, 100, 0)
                        ?>%"></div>
                        <ul>
                            <li>已达<?php echo bcmul(bcdiv($product->support_amount, $product->amount, 5), 100, 0) ?>%</li>
                            <li>支持者<?php echo $product->support_times; ?>人</li>
                            <li><?php echo $product->timer ?></li>
                        </ul>
                    </div>
                    <div class="description">
                        <?php if ($product->is_success == 1): ?>
                            项目在<?php echo date('Y-m-d H:i:s', $product->endtime); ?>结束,无论是否达到设定筹资目标均为成功，所有已产生的支持金额均为有效订单；发起者将在项目结束后的承诺时间内实施相关回报。
                        <?php else: ?>
                            项目须在 <?php echo date('Y-m-d H:i:s', $product->endtime); ?> 前达到 ¥<?php echo intval($product->amount); ?> 元目标金额才算成功，否则已支持订单将取消；订单取消时已支持金额将自动退还到您的个人账户。
                        <?php endif; ?>
                    </div>
                    <?php if ($is_process == 1): ?>
                        <?php if (empty($login_user)): ?><a class="but" href="<?php echo base_url(); ?>login">参与众筹</a><?php endif; ?>
                    <?php elseif ($is_process == 2): ?>
                        <a class="but" href="javascript:void(0);">已结束</a>
                    <?php else: ?>
                        <a class="but" href="javascript:void(0);">预热中</a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($product_items)): ?>
                    <?php foreach ($product_items as $items_key => $items_value): ?>
                        <div class="item">
                            <div class="ti">￥<span><?php echo $items_value->price; ?></span><div class="info"><?php echo $items_value->title; ?></div></div>
                            <div class="block"><?php echo $items_value->replay; ?></div>
                            <!--<div class="block">项目结束 30 天后发送</div>-->
                            <div class="block">已有<?php echo $items_value->sell_total; ?>人支持 / <?php echo $items_value->total; ?></div>
                            <?php if ($is_process == 1): ?>
                                <?php if (!empty($login_user)): ?><a class="but"  href="javascript:void(0);" onclick="return joinFounding(<?php echo $product->id; ?>,<?php echo $items_value->id; ?>);">支 持</a><?php endif; ?>
                            <?php endif; ?> 
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>
<!--END-->
<!-- 百度分享开始 -->
<script>window._bd_share_config = {"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": ["qzone", "tsina", "weixin", "renren", "tqq", "tqf", "douban", "sqq", "copy"], "bdPic": "", "bdStyle": "0", "bdSize": "16"}, "slide": {"type": "slide", "bdImg": "1", "bdPos": "right", "bdTop": "250"}, "image": {"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16"}, "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}};
    with (document)
        0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
<!-- 百度分享结束 -->