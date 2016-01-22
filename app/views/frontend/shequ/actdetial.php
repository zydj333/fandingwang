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
                <div class="head"><a href="#"><img src="<?php echo base_url(); ?>images/share_head.png" /></a></div>
                <div class="ti">
                    <h2><?php echo $act->title; ?></h2>
                    <a href="#"><?php echo $act->adder; ?></a><span><?php echo $act->addtime; ?></span>
                    <div class="count">
                        <span class="ico browse"><?php echo $act->views; ?></span>
                        <span class="ico comment"><?php echo $act->enlists; ?></span>
                    </div>
                </div>
                <div class="con">
                    <?php echo $act->content; ?>
                </div>
            </div>     
        </div>
        <div class="clear"></div>
        <div class="comment">
                    <div class="but">
                        <input class="inp sub" id="act_repay_submit" type="button" value="我要报名" />
                        <div class="clear"></div>
                    </div>
         </div>
    </div>
</div>
<!--END-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/news.js" ></script>