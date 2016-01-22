<!--登录START-->
<div class="LRform log">
    <h1>账户登录</h1>
    <div class="sns">
        <a class="weibo" title="微博账号" href="#" target="_blank"></a>
        <a class="douban" title="微信登录" href="" target="_blank"></a>
        <a class="qq" title="QQ账号" href="<?php echo base_url('tencent/createUrl'); ?>" target="_blank"></a>
        <div class="note">可用以上社交帐号登录</div>
    </div>

    <form method="post" id="login_form" action="<?php echo base_url() . "login/dologin"; ?>">
        <ul class="form">
            <input name="from_url" id="from_url" type="hidden" value="<?php echo $from; ?>"/>
            <li><input name="account" id="account" class="inp inpname" type="text" placeholder="邮箱或手机"/></li>
            <li><input name="password" id="password" class="inp inppw" type="password" placeholder="密码" /><span style="color: red" id="login_error"></span></li>
            <li><input class="inp sub" type="button" value="登录" id="login_sub_form" /></li>
            <li><a class="forget" href="<?php echo base_url() . "forget"; ?>">忘记密码？</a><input type="checkbox" checked /> 记住密码</li>
        </ul>
    </form>

    <div class="bot">
        <p>还没有账号？<a class="cor_blue" href="<?php echo base_url() . "register"; ?>">注册</a></p>
        <p>直接手机号<a class="cor_blue" href="<?php echo base_url() . "login/phonelogin"; ?>">登录</a></p>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $.ajax({
            type: "GET",
            url: "/sina/sinaLogin/" + Math.random(),
            dataType: "json",
            success: function(data) {
                $('.weibo').attr('href', data.error);
            }
        });
        
        $(".douban").attr('href','https://open.weixin.qq.com/connect/qrconnect?appid=wxe584a7820fd54074&redirect_uri=http%3A%2F%2Fwww.fandingwang.com%2Fwechatlogin%2Findex&response_type=code&scope=snsapi_login&state=wechat_logon#wechat_redirect');
    });

    /* var childWindow;
     function toQzoneLogin(){
     childWindow = window.open("tencent/createUrl","TencentLogin","width=550,height=300,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
     }
     
     function closeChildWindow(){
     childWindow.close();
     }*/
</script>