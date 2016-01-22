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
<!--                <li><a href="<?php echo base_url(); ?>shequ/index">全部</a></li>  
                <li><a href="<?php echo base_url(); ?>shequ/share">每日快讯</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/media">政策解读</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/diary">经典案例</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/activity">投融学堂</a></li> -->
                <li class="now"><a href="<?php echo base_url(); ?>bbs/add">添加话题</a></li>               
            </ul>
        </div>

        <div class="right">            
            <div class="detail">
                <div class="head"><img src="<?php echo base_url() . $topic->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'" /></div>
                <div class="ti">
                    <!--<a class="fav" title="点击收藏" href="#"></a>-->
                    <h2><?php echo $topic->title;?></h2>
                    <a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $topic->uid; ?>"><?php echo $topic->account;?></a><span><?php echo $topic->addtime;?></span>
                    <div class="count">
                        <span class="ico browse"><?php echo $topic->views; ?></span>
                        <span class="ico comment"><?php echo $topic->reply; ?></span>
                    </div>
                </div>
                <div class="con">
                    <?php echo $topic->content;?>
                </div>
            </div>   

            <div class="comment">
                <form method="post" id="topic_repay_form">
                    <div class="ti">
                        <span class="ico comment"><?php echo $topic->reply; ?></span>
                        有什么想说的？
                    </div>
                    <div class="con">
                        <input type="hidden" name="repay_id" id="repay_id" value="0" />
                        <input type="hidden" name="topic_id" id="topic_id" value="<?php echo $topic->id; ?>" />
                        <textarea id="content" name="content" ></textarea>
                    </div>
                    <div class="but">
                        <input class="inp sub" type="button" id="topic_repay_button" value="发表" />
                        <div class="clear"></div>
                    </div>
                </form>
            </div>

            <div class="commentlist">
                <?php if(!empty($repay)):?>
                <?php foreach ($repay as $repay_key=>$repay_value):?>
                <div class="item">
                    <div class="head">
                        <?php if($repay_value->uid>0):?>
                            <?php else:?>
                            <?php endif;?>
                            <img src="<?php echo base_url() . $repay_value->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'"/>
                    </div>
                    <div class="reply"><a href="javascript:void(0);" onclick="return topic_repay(<?php echo $repay_value->id;?>);" >回复</a></div>
                    
                    <div class="name">
                           <?php if($repay_value->uid>0):?>
                            <?php else:?>
                            <?php endif;?>
                            <?php if($repay_value->uid>0):?><?php echo $repay_value->account;?><?php else:?>匿名用户<?php endif;?>
                        </a>
                        <span class="time"><?php echo $repay_value->addtime;?></span></div>
                    <div class="con"><?php echo $repay_value->content;?></div>
                    <?php if(!empty($repay_value->son)):?>
                    <?php foreach($repay_value->son as $key=>$value):?>
                    <div class="Rcon">
                        <div class="name">
                            <?php if($value->uid>0):?>
                            <a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $value->uid; ?>" target="_blank"><?php echo $value->account;?></a>
                            <?php else:?>
                            <a href="#">匿名用户</a>
                            <?php endif;?>
                            <span class="time"><?php echo $value->addtime;?></span></div>
                        <div class="con"><?php echo $value->content;?></div>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
                <?php endforeach;?>
                <?php endif;?>

                <!--<div class="more"><a href="#">更多评论</a></div> -->
            </div>  
        </div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bbs.js" ></script>
        <div class="clear"></div>
    </div>
</div>
<!--END-->

