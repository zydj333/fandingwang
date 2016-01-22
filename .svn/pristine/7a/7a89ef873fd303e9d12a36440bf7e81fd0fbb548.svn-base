<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">参与众筹</h2>
                <p>你好，<strong><?php echo $user['user_name']; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
            </div>
            <div class="body body5">
                <?php if (isset($flag)): ?>
                    <?php if ($flag == 1): ?>
                        <div class="hd yh">订单支付成功：<?php if (isset($order)): ?><?php echo $order->pname; ?><?php endif; ?></div>
                        <div class="bd">
                            <div class="img"><img src="/images/img_02.png" /></div>
                            <p class="lk"><a href="<?php echo base_url(); ?>project">继续参与众筹</a><span>|</span><a href="<?php echo base_url(); ?>project/detial/<?php if (isset($order)): ?><?php echo $order->pid; ?><?php endif; ?>">查看众筹状态</a></p>
                        </div>
                    <?php else: ?>
                        <div class="hd yh"><?php echo $out; ?></div>
                    <?php endif; ?>
                <?php else: ?>
                        <?php if($order->step_status==2):?>
                    <div class="hd yh">订单支付成功：<?php echo $order->pname; ?></div>
                    <div class="bd">
                        <div class="img"><img src="/images/img_02.png" /></div>
                        <p class="lk"><a href="<?php echo base_url(); ?>project">继续参与众筹</a><span>|</span><a href="<?php echo base_url(); ?>project/detial/<?php if (isset($order)): ?><?php echo $order->pid; ?><?php endif; ?>">查看众筹状态</a></p>
                    </div>
                    <?php elseif($order->step_status==1 || $order->step_status==0):?>
                    <div class="hd yh">该订单还未支付，或者还未获取到支付方回调的数据</div>
                    <?php else:?>
                    <div class="hd yh">此订单已经取消</div>
                    <?php endif;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>