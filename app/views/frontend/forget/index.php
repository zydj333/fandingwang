<!--注册START-->
<div class="LRform reg">
    <h1>找回密码</h1>
    <form method="post" action="<?php echo base_url(); ?>forget/checkcellphonecode" id="check_cell_phone_form" >
        <ul class="form">
            <li>
                <input class="inp" type="text" name="cellphone" id="cellphone" placeholder="手机" />
            </li>
            <li>
                <a class="inp inp02" style="line-height: 36px" id="get_phonecode">获取验证码</a>
                <a class="inp inp02" style="line-height: 36px;display: none" id="noget_phonecode"><span id="timeb2">60</span>秒后重新获取</a>
                <input class="inp inp01" type="text" id="phonecode" name="phonecode" placeholder="手机验证码" />
            </li>
            <li>
                <input class="inp sub" type="button" value="确认验证码" id="check_phone_code" />
            </li>
        </ul>
    </form>
    <div class="bot">已有帐号？<a class="cor_blue" href="<?php echo base_url()."login";?>">登录</a></div>
</div>
<!--END-->