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
<!--                <li><a href="<?php echo base_url(); ?>shequ/index">全部</a></li>  
                <li><a href="<?php echo base_url(); ?>shequ/share">每日快讯</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/media">政策解读</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/diary">经典案例</a></li> 
                <li><a href="<?php echo base_url(); ?>shequ/activity">投融学堂</a></li> -->
                <li class="now"><a href="<?php echo base_url(); ?>bbs/add">添加话题</a></li>               
            </ul>
        </div>

        <div class="right">
<!--            <div class="nav">
                <ul>
                    <li <?php if($son_cusor=='index'):?>class="now"<?php endif;?>><a href="<?php echo base_url();?>bbs/index">最新</a></li>
                    <li <?php if($son_cusor=='hot'):?>class="now"<?php endif;?>><a href="<?php echo base_url();?>bbs/hot">热门</a></li>
                    <li <?php if($son_cusor=='cream'):?>class="now"<?php endif;?>><a href="<?php echo base_url();?>bbs/cream">精华</a></li>
                </ul>
            </div>-->

            <?php if(!empty($top)):?>
            <?php foreach ($top as $top_key=>$top_value):?>
            <div class="item">
                <div class="Sico top">置顶</div>
                <div class="head"><a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $top_value->uid; ?>" target="_blank"><img src="<?php echo base_url() . $top_value->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'" /></a></div>
                <div class="ti"><a href="<?php echo base_url();?>bbs/detial/<?php echo $top_value->id; ?>" target="_blank"><?php echo $top_value->title; ?></a></div>
                <div class="name"><a href="<?php echo base_url(); ?>usercenter/userhome/<?php echo $top_value->uid; ?>" target="_blank"><?php echo $top_value->account; ?></a><span class="time"><?php echo $top_value->addtime; ?></span></div>
                <div class="con"><a href="<?php echo base_url();?>bbs/detial/<?php echo $top_value->id; ?>" target="_blank"><?php echo $top_value->content; ?></a></div>
                <div class="pic"><a href="<?php echo base_url();?>bbs/detial/<?php echo $top_value->id; ?>" target="_blank"><img src="<?php echo base_url().$top_value->imageurl; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_01.jpg'" width="350px" height="250px"  /></a></div>
                <div class="count">
                    <span class="ico browse"><?php echo $top_value->views; ?></span>
                    <span class="ico comment"><?php echo $top_value->reply; ?></span>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
            
            <?php if(!empty($list)):?>
            <?php foreach ($list as $list_key=>$list_value):?>
            <div class="item">
                <div class="head"><img src="<?php echo base_url() . $list_value->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_head.png'" /></div>
                <div class="ti"><a href="<?php echo base_url();?>bbs/detial/<?php echo $list_value->id; ?>" target="_blank"><?php echo $list_value->title; ?></a></div>
                <div class="name"><?php echo $list_value->account; ?><span class="time"><?php echo $list_value->addtime; ?></span></div>
                <div class="con"><a href="<?php echo base_url();?>bbs/detial/<?php echo $list_value->id; ?>" target="_blank"><?php echo $list_value->content; ?></a></div>
                <div class="pic"><a href="<?php echo base_url();?>bbs/detial/<?php echo $list_value->id; ?>" target="_blank"><img src="<?php echo base_url().$list_value->imageurl; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/share_01.jpg'" width="350px" height="250px"  /></a></div>
                <div class="count">
                    <span class="ico browse"><?php echo $list_value->views; ?></span>
                    <span class="ico comment"><?php echo $list_value->reply; ?></span>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>   
            

            <!--分页START-->
            <div class="pages">
                <?php if(isset($page_link)):?>
                <?php echo $page_link;?>
                <?php endif;?>
            </div>
            <!--END-->        
        </div>

        <div class="clear"></div>
    </div>
</div>
<!--END-->