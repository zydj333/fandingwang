<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="refresh" content="<?php echo $waitSecond;?>;URL=<?php echo base_url().$jumpUrl;?>" />
        <title><?php echo $title;?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script language="javascript">
            $(function(){
                $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
                $(window).resize(function(){
                    $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
                })
            });
        </script>
    </head>
    <body style="background:#edf6fa;">
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="#">首页</a></li>
                <li><a href="#">错误提示</a></li>
            </ul>
        </div>
        <div class="error">
            <h2><?php echo $message;?></h2>
            <p><?php echo $waitSecond;?>秒后跳转，如果您不想等待，请点击 <a href="<?php echo base_url().$jumpUrl;?>" >跳转</a>。</p>
            <div class="reindex"><a href="<?php echo base_url().$jumpUrl;?>">确定</a></div>
        </div>
    </body>
</html>
