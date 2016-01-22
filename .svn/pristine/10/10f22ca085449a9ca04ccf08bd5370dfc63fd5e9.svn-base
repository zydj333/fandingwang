<!--END--><!--海报START-->
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
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $list_key => $list_values): ?>
                    <div class="item">
                        <div class="ti"><a href="<?php echo base_url(); ?>shequ/detial/<?php echo $list_values->id; ?>" target="_blank"><?php echo $list_values->title; ?></a></div>
                        <div class="con"><a href="<?php echo base_url(); ?>shequ/detial/<?php echo $list_values->id; ?>" target="_blank"><?php echo $list_values->discription; ?></a></div>
                        <div class="pic"><a href="<?php echo base_url(); ?>shequ/detial/<?php echo $list_values->id; ?>" target="_blank"><img src="<?php echo base_url() . $list_values->imageurl; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_02.jpg'" width="348px" height="250px" /></a></div>
                        <div class="count">
                            <span class="ico browse"><?php echo $list_values->views; ?></span>
                            <span class="ico comment"><?php echo $list_values->replay; ?></span>
                            <!--<span class="ico favorite">3</span>-->
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <!--分页START-->
            <div class="pages">
                <?php if (isset($page_link)): ?>
                    <?php echo $page_link; ?>
                <?php endif; ?>
            </div>
            <!--END-->        
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--END-->