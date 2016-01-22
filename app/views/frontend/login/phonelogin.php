<!--登录START-->
<div class="LRform log">
    <h1>使用手机号码进行登录</h1>
    <!-- <div class="sns">
        <a class="weibo" title="微博账号" href="#" target="_blank"></a>
        <a class="douban" title="豆瓣账号" href="#" target="_blank"></a>
         <a class="qq" title="QQ账号" href="#" target="_blank"></a>
        <div class="note">可用以上社交帐号登录</div>
    </div>-->

    <form method="post" id="phone_login_form" action="<?php echo base_url() . "login/phonelogin"; ?>">
        <ul class="form">
            <input name="from_url" id="from_url" type="hidden" value="<?php echo $from; ?>"/>
            <li><input name="phonenumber" id="phonenumber" style="background-color: #fff;border: 1px solid #e6e6e6;border-radius: 5px;height: 36px;padding: 0 12px;width: 262px;" type="text" placeholder="手机号码"/></li>
            <li>
                <input  name="phonecode" id="phonecode" style="background-color: #fff;border: 1px solid #e6e6e6;border-radius: 5px;height: 36px;padding: 0 12px;width: 130px;" type="text" placeholder="手机验证码" maxlength="6" />
                <a style="background-color: #fff;border: 1px solid #e6e6e6;border-radius: 5px;height: 36px;line-height: 36px;float: right;width:120px;text-align: center;" href="javascript:void(0);" id="get_phonecode_login">获取验证码</a>
                <a style="background-color: #fff;border: 1px solid #e6e6e6;border-radius: 5px;height: 36px;line-height: 36px;float: right;width:120px;display: none;text-align: center;" id="noget_phonecode_login" ><span id="timeb2">60</span>秒后重新获取</a>
            </li>
            <li>
                <input name="varify" id="varify" style="background-color: #fff;border: 1px solid #e6e6e6;border-radius: 5px;height: 36px;padding: 0 12px;width: 130px;" type="text" placeholder="图形验证码" maxlength="4"  />
                <img id="varifycode" src="<?php echo base_url() . "validate/doimg"; ?>" title="点击图片刷新" alt="在前面的方框填入图片中的数字" style="border: 1px solid #e6e6e6;height: 36px;width: 120px;float: right;"/>
                <span style="color: red" id="login_error"></span>
            </li>
            <li><input class="inp sub" type="button" value="登录" id="phone_login_sub_form" /></li>
        </ul>
    </form>

    <div class="bot">
        <p>还是使用账号密码登录<a class="cor_blue" href="<?php echo base_url() . "login"; ?>">登录</a></p>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $("#varifycode").click(function(){
       this.src='/validate/doimg/'+ Math.random(); 
    });
});
</script>