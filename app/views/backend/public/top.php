<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('top_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript">
            $(function(){
                //顶部导航切换
                $(".nav li a").click(function(){
                    $(".nav li a.selected").removeClass("selected")
                    $(this).addClass("selected");
                })
            })
        </script>


    </head>

    <body style="background:url(<?php echo base_url(); ?>images/backend/topbg.gif) repeat-x;">

        <div class="topleft">
            <a href="<?php echo base_url(); ?>/admin" target="_parent"><img src="<?php echo base_url(); ?>/images/backend/logo.png" title="系统首页" /></a>
        </div>
        <ul class="nav">
            <?php if(!empty($top)):?>
            <?php foreach($top as $k=>$v):?>
            <li><a href="<?php echo base_url(); ?>admin_index/left/<?php echo $v->id;?>" target="leftFrame"><img src="<?php echo base_url(); ?>images/backend/icon0<?php echo $k+1; ?>.png" title="<?php echo $v->titel; ?>" /><h2><?php echo $v->titel; ?></h2></a></li>
           <?php endforeach; ?>
            <?php endif;?>
        </ul>
        <div class="topright">
            <ul>
                <li><span><img src="<?php echo base_url(); ?>images/backend/help.png" title="<?php echo lang('top_help'); ?>"  class="helpimg"/></span><a href="#"><?php echo lang('top_help'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_user/pwd" target="rightFrame"><?php echo lang('changePwd'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_login/logout" target="_parent"><?php echo lang('top_exit'); ?></a></li>
            </ul>
            <div class="user">
                <span><?php echo $user['username'];?></span>
            </div>
        </div>
    </body>
</html>
