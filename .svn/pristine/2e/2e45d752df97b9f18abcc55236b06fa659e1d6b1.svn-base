<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/cloud.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function(){
                $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
                $(window).resize(function(){
                    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
                })

                $("#backendloginbtn").click(function(){
                    var username=$("#account").val();
                    var userpassword=$("#password").val();
                    $.ajax({
                        type: "POST",
                        url: "/admin_login/dologin/"+Math.random(),
                        data:{"account":username,"password":userpassword},
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_index/index";
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body style="background-color:#1c77ac; background-image:url(<?php echo base_url(); ?>images/backend/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
        <div id="mainBody">
            <div id="cloud1" class="cloud"></div>
            <div id="cloud2" class="cloud"></div>
        </div>


        <div class="logintop">
            <span><?php echo lang('page_title'); ?></span>
            <ul>
                <li><a href="/"><?php echo lang('back_to_index'); ?></a></li>
            </ul>
        </div>
            <div class="loginbody">
                <span class="systemlogo"></span>
                <div class="loginbox">
                    <ul>
                        <li><input name="account" id="account" type="text" class="loginuser" value="<?php echo lang('account'); ?>" onfocus="if(this.value=='<?php echo lang('account'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php echo lang('account'); ?>'}"/></li>
                        <li><input name="password" id="password" type="password" class="loginpwd" value="<?php echo lang('password'); ?>" onfocus="if(this.value=='<?php echo lang('password'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php echo lang('password'); ?>'}"/></li>
                        <li><input name="" type="button" id="backendloginbtn" class="loginbtn" value="<?php echo lang('login'); ?>"/></li>
                    </ul>
                </div>
            </div>
        <div class="loginbm"><?php echo lang('copy_right'); ?></div>
    </body>
</html>
