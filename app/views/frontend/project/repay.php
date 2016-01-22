<!--海报START-->
<div class="proDbanner" style="background:url(<?php echo base_url() . $product->banner; ?>) no-repeat center top"></div>
<!--END-->

<!--项目详情START-->
<div class="proDetail">
    <div class="box">
        <div class="left">
            <div class="nav">
                <ul>
                    <li><a href="<?php echo base_url(); ?>project/detial/<?php echo $product->id; ?>">故事</a></li>
                    <li><a href="<?php echo base_url(); ?>project/tender/<?php echo $product->id; ?>">更新(<?php echo $product->product_loading; ?>)</a></li>
                    <li class="now">讨论(<?php echo $product->repay; ?>)</li>
                    <li><a href="<?php echo base_url(); ?>project/invest/<?php echo $product->id; ?>">支持者(<?php echo $product->support_times; ?>)</a></li>
                </ul>
            </div>
            <div class="con">  

                <div class="comment">
                    <form action="/project/saveRepay" method="post" id="repay_form">
                        <div class="ti">
                            <span class="ico comment"><?php echo $product->repay; ?></span>
                            有什么想说的？
                        </div>
                        <div class="con">
                            <input type="hidden" value="<?php echo $product->id;?>" name="product_id" id="product_id" />
                            <input type="hidden" value="" name="to_uid" id="to_uid"/>
                            <input type="hidden" value="" name="to_replay_id" id="to_replay_id"/>
                            <textarea name="content" id="content"></textarea>
                        </div>
                        <div class="but">
                            <input class="inp sub" id="repay_submit" type="button" value="发表"  />
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>

                <div class="commentlist">
                    <?php if (!empty($reply)): ?>
                    <?php foreach($reply as $reply_key=>$reply_values):?>
                        <div class="item">
                            <?php if($reply_values->uid>0):?>
                            <div class="head"><img src="<?php echo base_url().$reply_values->avatar;?>" onerror="this.onerror='';this.src='<?php echo base_url();?>images/share_head.png'"  /></div>
                            <?php else:?>
                            <div class="head"><img src="<?php echo base_url().$reply_values->avatar;?>" onerror="this.onerror='';this.src='<?php echo base_url();?>images/share_head.png'" /></div>
                            <?php endif;?>
                            <div class="reply"><a href="javascript:void(0);" onclick="return repay(<?php echo $reply_values->uid; ?>,<?php echo $reply_values->id; ?>);" >回复</a></div>
                             <?php if($reply_values->uid>0):?>
                            <div class="name"><a href="<?php echo base_url();?>usercenter/userhome/<?php echo $reply_values->uid;?>" target="_blank"><?php echo $reply_values->account; ?></a><span class="time"><?php echo $reply_values->addtime;?></span></div>
                            <?php else:?>
                            <div class="name">匿名用户<span class="time"><?php echo $reply_values->addtime;?></span></div>
                            <?php endif;?>
                            <div class="con"><?php if($reply_values->is_del==0):?><?php echo $reply_values->content;?><?php else:?>该信息违规,已经被删除.<?php endif;?></div>
                            <?php if(!empty($reply_values->son)):?>
                            <?php foreach($reply_values->son as $son_key=>$son_values):?>
                            <div class="Rcon">
                                <?php if($son_values->uid>0):?>
                                <div class="name"><a href="<?php echo base_url();?>usercenter/userhome/<?php echo $son_values->uid;?>" target="_blank"><?php echo $son_values->account; ?></a><span class="time"><?php echo $son_values->addtime;?></span></div>
                                <?php else:?>
                                <div class="name">匿名用户<span class="time"><?php echo $son_values->addtime;?></span></div>
                                <?php endif;?>
                                <div class="con"><?php if($son_values->is_del==0):?><?php echo $son_values->content;?><?php else:?>该信息违规,已经被删除.<?php endif;?></div>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                    <?php endif; ?>

                    <!--<div class="more"><a href="#">更多评论</a></div> -->
                </div>

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
                        <?php if($product->is_success==1):?>
                        项目在<?php echo date('Y-m-d H:i:s',$product->endtime);?>结束,无论是否达到设定筹资目标均为成功，所有已产生的支持金额均为有效订单；发起者将在项目结束后的承诺时间内实施相关回报。
                        <?php else: ?>
                        项目须在 <?php echo date('Y-m-d H:i:s',$product->endtime);?> 前达到 ¥<?php echo intval($product->amount);?> 元目标金额才算成功，否则已支持订单将取消；订单取消时已支持金额将自动退还到您的个人账户。
                        <?php endif;?>
                    </div>
                    <?php if($is_process==1):?>
                    <?php if(empty($login_user)):?><a class="but" href="<?php echo base_url();?>login">参与众筹</a><?php endif;?>
                    <?php elseif($is_process==2):?>
                    <a class="but" href="javascript:void(0);">已结束</a>
                    <?php else:?>
                    <a class="but" href="javascript:void(0);">预热中</a>
                    <?php endif;?>
                </div>
                <?php if (!empty($product_items)): ?>
                    <?php foreach ($product_items as $items_key => $items_value): ?>
                        <div class="item">
                            <div class="ti">￥<span><?php echo $items_value->price; ?></span><div class="info"><?php echo $items_value->title; ?></div></div>
                            <div class="block"><?php echo $items_value->replay; ?></div>
                            <!--<div class="block">项目结束 30 天后发送</div>-->
                            <div class="block">已有<?php echo $items_value->sell_total; ?>人支持 / <?php echo $items_value->total; ?></div>
                            <?php if($is_process==1):?>
                                <?php if(!empty($login_user)):?><a class="but"  href="javascript:void(0);" onclick="return joinFounding(<?php echo $product->id;?>,<?php echo $items_value->id;?>);">支 持</a><?php endif;?>
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