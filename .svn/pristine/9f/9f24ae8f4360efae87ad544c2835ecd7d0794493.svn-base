<!--海报START-->
<div class="memberbanner" style="background:url(<?php echo base_url();?>images/member_banner.jpg) no-repeat center top">
    <div class="name"><span><?php echo $member->username;?></span></div>
</div>
<!--END-->

<!--内容详情START-->
<div class="member">
    <div class="box">
        <div class="left">
            <div class="block">
                <form id="add_feed_form" method="post" action="<?php echo base_url();?>usercenter/addmyfeed">
                    <div class="ti">
                        <span class="ico comment">发起状态</span>
                        <span class="ico bbs"><a href="<?php echo base_url();?>bbs/add">发布帖子</a></span>
                        <span class="ico pro"><a href="<?php echo base_url();?>launch">发起项目</a></span>
                    </div>
                    <div class="con">
                        <textarea name="add_feed" id="add_feed_content"></textarea>
                    </div>
                    <div class="but">
                        <input class="inp sub" type="button" value="发表" id="add_feed_sub" />
                        <div class="clear"></div>
                    </div>
                </form>
            </div>

            <div class="block">
                <div class="nav">
                    <ul>
                        <li class="now"><a href="<?php echo base_url();?>usercenter/mylaunch">发起的项目（<?php echo count($luanch);?>）</a></li>
                        <li><a href="<?php echo base_url();?>usercenter/myjoin">参与的项目（<?php echo count($join);?>）</a></li>
                        <li><a href="<?php echo base_url();?>usercenter/index">收藏的项目（<?php echo count($product);?>）</a></li>
                    </ul>
                </div>
                <div class="proti">
                	<span class="fr">操作</span>
                	<span class="fr fr01"></span>
                    项目信息                    
                </div>
                <?php if(!empty($luanch)):?>
                <?php foreach($luanch as $product_key=>$product_values):?>
                <?php if($product_values->starttime == 0):?>
                <div class="item">
                    <div class="pic"><a href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>" target="_blank"><img src="<?php echo base_url().$product_values->image_url;;?>" /></a></div>
                    <div class="state">
                        审核中
                    </div>
                    <div class="fav"></div>
                    <dl>
                        <dt><a href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>" target="_blank"><?php echo $product_values->title;?></a></dt>
                        <dd>
                            <div class="money">
                                <b>￥</b><span><?php echo bcmul($product_values->support_amount,1,0);?></span>目标金额为 ¥<?php echo bcmul($product_values->amount,1,0);?>元
                            </div>
                            <div class="rate">
                                <div class="bar" style="width:<?php echo bcmul(bcdiv($product_values->support_amount,$product_values->amount,5), 100, 2)?>%"></div>
                                <ul>
                                    <li><?php echo bcmul(bcdiv($product_values->support_amount,$product_values->amount,5), 100, 2)?>%</li>
                                    <li><?php echo $product_values->support_times;?>支持</li>
                                </ul>
                            </div>
                        </dd>
                    </dl>
                </div>
                <?php else:?>
                <div class="item">
                    <div class="pic"><a href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>" target="_blank"><img src="<?php echo base_url().$product_values->image_url;;?>" /></a></div>
                    <div class="state">
                        <?php if($now_time<$product_values->starttime):?>
                        预热中
                        <?php elseif($now_time>$product_values->endtime):?>
                        已结束
                        <?php else:?>
                        众筹中
                        <?php endif;?>
                    </div>
                    <div class="fav"></div>
                    <dl>
                        <dt><a href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>" target="_blank"><?php echo $product_values->title;?></a></dt>
                        <dd>
                            <div class="money">
                                <b>￥</b><span><?php echo bcmul($product_values->support_amount,1,0);?></span>目标金额为 ¥<?php echo bcmul($product_values->amount,1,0);?>元
                            </div>
                            <div class="rate">
                                <div class="bar" style="width:<?php echo bcmul(bcdiv($product_values->support_amount,$product_values->amount,5), 100, 2)?>%"></div>
                                <ul>
                                    <li><?php echo bcmul(bcdiv($product_values->support_amount,$product_values->amount,5), 100, 2)?>%</li>
                                    <li><?php echo $product_values->support_times;?>支持</li>
                                    <li><?php echo $product_values->timer;?></li>
                                </ul>
                            </div>
                        </dd>
                    </dl>
                </div>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                <!--分页START-->
                <!--
                <div class="pages">
                    <a class="prev" href="#">&lt;</a>
                    <a href="#">1</a>
                    <a class="now">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">7</a>
                    <a href="#">8</a>
                    <span>...</span>
                    <a href="#">20</a>
                    <a class="next" href="#">&gt;</a>
                </div>
                -->
                <!--END-->       
            </div>
        </div>

        <div class="right">
            <div class="block">
                <div class="head">
                    <img  src="<?php echo base_url().$member->avatar;?>" onerror="this.onerror='';this.src='<?php echo base_url();?>images/two/avatar.jpg'" width="55px" /><br /><?php echo $member->username;?>
                </div>
                <dl>
                    <dt><a href="<?php echo base_url();?>mysetting">编辑</a>个人信息</dt>
                    <dd><?php if($member->province!=''):?><?php echo $member->province.'-'.$member->city.'['.$member->job.']';?><?php else:?>您的信息还未填写完全！<?php endif;?></dd>
                </dl>
                <dl>
                    <dt><a href="#">取消</a>我的标签</dt>
                    <dd>
                        <form method="post">
                            <div class="con">
                                <textarea></textarea>
                            </div>
                            <div class="but">
                                <input class="inp sub" type="submit" value="发表" />
                                <div class="clear"></div>
                            </div>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt><a href="<?php echo base_url();?>mysetting">添加</a>个人简介</dt>
                    <dd><?php echo $member->discription;?></dd>
                </dl>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--END-->