<!--注册START-->
<div class="LRform reg">
    <h1>用户注册</h1>
    <form id="register_form" method="post" action="<?php echo base_url() . "register/doregiter"; ?>">
        <ul class="form">
            <li><input name="account" id="account" class="inp" type="text" placeholder="用户昵称" maxlength="15" /><span style="color: red" id="account_error"></span></li>
            <li><input name="password" id="password" class="inp" type="password" placeholder="密码"/><span style="color: red" id="password_error"></span></li>
            <li><input name="repassword" id="repassword" class="inp" type="password" placeholder="确认密码"/><span style="color: red" id="repassword_error"></span></li>
            <li><input name="email" id="email" class="inp" type="text" placeholder="邮箱" /><span style="color: red" id="email_error"></span></li>
            <li><input name="cellphone" id="cellphone" class="inp" type="text" placeholder="手机" maxlength="11" /><span style="color: red" id="cellphone_error"></span></li>
            <li><a class="inp inp02" style="line-height: 36px" id="get_phonecode">获取验证码</a>
                <a class="inp inp02" style="line-height: 36px;display: none" id="noget_phonecode" ><span id="timeb2">60</span>秒后重新获取</a>
                <input  name="phonecode" id="phonecode" class="inp inp01" type="text" placeholder="手机验证码" maxlength="6" /><span style="color: red" id="phonecode_error"></span></li>
            <li><input class="inp sub" type="button" value="注册" id="register_sub_form"/></li>
        </ul>
        <div class="agree">注册表示同意<a class="cor_blue" href="<?php echo base_url(); ?>help/agreement" target="_blank">《用户协议条款》</a></div>
    </form>

    <div class="sns">        
        <div class="note">或使用社交账号快速注册</div>
        <a class="douban" title="豆瓣账号" href="#" target="_blank"></a>
        <a class="weibo" title="微博账号" href="#" target="_blank"></a>
        <a class="qq" title="QQ账号" href="<?php echo base_url('tencent/createUrl');?>" target="_blank"></a>
    </div>

    <div class="bot">
        <p>已有帐号？<a class="cor_blue" href="<?php echo base_url() . "login"; ?>">登录</a></p>
        <p>嫌注册太麻烦？直接手机号码<a class="cor_blue" href="<?php echo base_url() . "login/phonelogin"; ?>">登录</a></p>
    </div>
</div>
<!--END-->
<script type="text/javascript">
    /*
    var childWindow;
    function toQzoneLogin(){
        childWindow = window.open("tencent/createUrl","TencentLogin","width=550,height=300,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
    }

    function closeChildWindow(){
        childWindow.close();
    }
    */
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
</script>