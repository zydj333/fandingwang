<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if (isset($title)): ?><?php echo $title; ?><?php endif; ?>_泛丁众筹</title>
        <meta name="keywords" content="<?php if (isset($keywords)): ?><?php echo $keywords; ?><?php endif; ?>" />
        <meta name="description" content="<?php if (isset($description)): ?><?php echo $description; ?><?php endif; ?>" />
        <meta name="author" content="Aman" />
        <meta property="qc:admins" content="52775234776616416771676375" />
        <meta name="baidu-site-verification" content="tGBLsbuVy0" />
        <meta name="applicable-device"content="pc,mobile">
        <meta name="MobileOptimized" content="width"/>
        <meta name="HandheldFriendly" content="true"/>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" mce_href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" mce_href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <link href="<?php echo base_url(); ?>css/css.css" rel="stylesheet" type="text/css" />
        <?php
        if (!isset($cusor)) {
            $cusor = '';
        }
        ?>
<?php if ($cusor == 'index'): ?>
            <style type="text/css">
                .header{position:absolute; z-index:100}
                .header .bg{opacity:0.3; filter:progid:DXImageTransform.Microsoft.Alpha(opacity=30)}
            </style>
<?php endif; ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.artDialog.js?skin=black"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/public.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.Slide.2.1.1.js"></script>
<?php if ($cusor == 'index'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/velocity.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/velocity.ui.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/joen.js"></script>
            <script type="text/javascript">
                $(function() {
                    $("#slider").responsiveSlides({
                        auto: true,
                        pager: false,
                        nav: true,
                        speed: 3000,
                        namespace: "slide"
                    });
                });
            </script> 
        <?php elseif ($cusor == 'project'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/joen.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/buy.js"></script>
        <?php elseif ($cusor == 'register'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/register.js"></script>
        <?php elseif ($cusor == 'login'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/login.js"></script>
        <?php elseif ($cusor == 'usercenter'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/usercenter.js"></script>
        <?php elseif ($cusor == 'shequ'): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>js/joen.js"></script>
<?php endif; ?>


    </head>
    <body>
        <!--头部START-->
        <div class="header">
            <div class="bg"></div>
            <div class="box">
                <div class="logo"><a href="<?php echo base_url(); ?>"><img title="泛丁众筹" src="<?php echo base_url(); ?>images/logo.png" /></a></div>
                <div class="nav">
                    <ul>
                        <li <?php if ($cusor == 'index'): ?>class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>">泛丁首页</a></li>
                        <li <?php if ($cusor == 'project'): ?>class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>project">项目集市</a></li>
                        <li <?php if ($cusor == 'shequ'): ?>class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>shequ">泛丁资讯</a></li>
                        <li <?php if ($cusor == 'luntan'): ?>class="now"<?php endif; ?>><a href="<?php echo base_url(); ?>bbs">泛丁社区</a></li>
                        <li><a href="<?php echo base_url(); ?>launch">发起众筹</a></li>
                        <li><a>任意门</a><div class="chat"><img src="<?php echo base_url(); ?>images/chat.png" /></div></li>

                        <!--
<?php if (isset($login_user) && $login_user > 0): ?>
                                  <li class="info">
                                      <img src="<?php echo base_url(); ?>images/avt.png" /><?php if (isset($member)): ?><?php echo $member['user_name']; ?><?php endif; ?>
                                     <dl>
                                         <dd><a href="<?php echo base_url() . 'usercenter'; ?>">个人中心</a></dd>
                                         <dd><a href="<?php echo base_url() . 'mysetting'; ?>">账号设置</a></dd>
                                         <dd><a href="<?php echo base_url() . 'myproject'; ?>">我的项目</a></dd>
                                         <dd><a href="<?php echo base_url() . 'login/logout'; ?>">退出</a></dd>
                                     </dl>
                                 </li>
                        <?php else: ?>
                                <li class="login"><a href="<?php echo base_url(); ?>login">登录</a><span>|</span><a href="<?php echo base_url(); ?>register">注册</a></li>
<?php endif; ?>
                        -->
                    </ul>
                </div>
            </div>
        </div>
        <!--END-->

        <!--回到顶部START-->
        <script type="text/javascript">
<?php if ($cusor != 'index'): ?>
                $(function() {
                    $(".backTop").click(function() {
                        $("html, body").animate({scrollTop: 0}, 500);
                    });
                    $(window).scroll(function() {
                        var st = $(document).scrollTop();
                        (st > 1000) ? $(".backTop").fadeIn(600) : $(".backTop").fadeOut(600);
                    });
                });
<?php else: ?>
                $(function() {
                    $(".backTop").click(function() {
                        $("html, body").animate({scrollTop: 0}, 500);
                    });
                    $(window).scroll(function() {
                        var st = $(document).scrollTop();
                        var scrollPos = $(window).scrollTop() + $(window).height() - 300;

                        (st > 1000) ? $(".backTop").fadeIn(600) : $(".backTop").fadeOut(600);

                        if (!$("#service").hasClass('animated') && scrollPos > $("#service").offset().top) {
                            $("#service").addClass('animated');
                            $("#service .block").velocity("transition.bounceIn", {delay: 200, duration: 800});
                        }
                        if (!$("#share").hasClass('animated') && scrollPos > $("#share").offset().top) {
                            $("#share").addClass('animated');
                            $("#share .block").velocity("transition.flipBounceXIn", {delay: 200, duration: 1000});
                        }
                    });
                });
<?php endif; ?>
        </script>
        <div class="backTop"></div>