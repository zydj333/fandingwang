<!--海报START-->
<?php if (!empty($banner)): ?>
    <?php foreach ($banner as $banner_key => $banner_values): ?>
        <div class="sharebanner" style="background:url(<?php echo base_url() . $banner_values->imageurl; ?>) no-repeat center top"></div>
    <?php endforeach; ?>
<?php endif; ?>
<!--END-->

<!--社区START-->
<div class="share">
    <div class="box">
        <div class="left">
            <ul>
                <li <?php if ($son_cusor == 'index'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/index">全部</a></li>  
                <li <?php if ($son_cusor == 'share'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/share">每日快讯</a></li> 
                <li <?php if ($son_cusor == 'media'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/media">政策解读</a></li> 
                <li <?php if ($son_cusor == 'diary'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/diary">经典案例</a></li> 
                <li <?php if ($son_cusor == 'activity'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/activity">投融学堂</a></li> 
                <li <?php if ($son_cusor == 'ativity'): ?> class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ/ativity">励志趣闻</a></li>               
            </ul>
        </div>

        <div class="right">            
            <div class="detail">
                <!--<div class="head"><a href="#"><img src="<?php echo base_url(); ?>images/share_head.png" /></a></div>-->
                <div class="ti">
                    <h2><?php echo $news->title; ?></h2>
                    <a href="#"><?php echo $news->adder; ?></a><span><?php echo $news->addtime; ?></span>
                    <div class="count">
                        <span class="ico browse"><?php echo $news->views; ?></span>
                        <span class="ico comment"><?php echo $news->replay; ?></span>
                    </div>
                </div>
                <div class="con">
                    <?php echo $news->content; ?>
                </div>
            </div>   

            <div class="comment">
                <form method="post" id="news_repay_form">
                    <div class="ti">
                        <span class="ico comment"><?php echo $news->replay; ?></span>
                        有什么想说的？
                    </div>
                    <div class="con">
                        <input type="hidden" name="repay_id" id="repay_id" value="0" />
                        <input type="hidden" name="news_id" id="news_id" value="<?php echo $news->id; ?>" />
                        <textarea id="content" name="content" ></textarea>
                    </div>
                    <div class="but">
                        <input class="inp sub" id="news_repay_submit" type="button" value="发表" />
                        <div class="clear"></div>
                    </div>
                </form>
            </div>

            <div class="commentlist">
                <?php if (!empty($repay)): ?>
                    <?php foreach ($repay as $repay_key => $repay_value): ?>
                        <div class="item">
                            <?php if ($repay_value->uid > 0): ?>
                                <div class="head"><a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $repay_value->uid; ?>" target="_blank"><img src="<?php echo base_url() . $repay_value->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'"  /></a></div>
                            <?php else : ?>
                                <div class="head"><img src="<?php echo base_url(); ?>images/share_head.png"/></div>
                            <?php endif; ?>
                            <div class="reply"><a href="javascript:void(0)" onclick="return news_repay(<?php echo $repay_value->id; ?>)">回复</a></div>
                            <div class="name">
                                <?php if ($repay_value->uid > 0): ?>
                                    <a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $repay_value->uid; ?>" target="_blank"><?php echo $repay_value->account; ?></a>
                                <?php else : ?>
                                    <a><?php echo $repay_value->user_name; ?></a>
                                <?php endif; ?>
                                <span class="time"><?php echo date('Y-m-d H:i:s', $repay_value->addtime); ?></span></div>
                            <div class="con"><?php echo $repay_value->content; ?></div>
                            <?php if (!empty($repay_value->son)): ?>
                                <?php foreach ($repay_value->son as $son_key => $son_vaule): ?>
                                    <div class="Rcon">
                                        <div class="name">
                                            <?php if ($son_vaule->uid > 0): ?>
                                                <a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $son_vaule->uid; ?>" target="_blank"><?php echo $son_vaule->user_name; ?></a>
                                            <?php else : ?>
                                                <a><?php echo $son_vaule->user_name; ?></a>
                                            <?php endif; ?>
                                            <span class="time"><?php echo date('Y-m-d H:i:s', $son_vaule->addtime); ?></span>
                                        </div>
                                        <div class="con"><?php echo $son_vaule->content; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!--<div class="more"><a href="#">更多评论</a></div> -->
            </div>  
        </div>

        <div class="clear"></div>
    </div>
</div>
<!--END-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/news.js" ></script>