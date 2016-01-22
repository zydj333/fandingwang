<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form method="post" id="login_form" action="<?php echo base_url() . "api/forget/125d09ddc64827dc72c74669f1380aba"; ?>">
        <ul class="form">
            <li><input name="account" id="account" class="inp inpname" type="text" placeholder="手机"/></li>
            <li><input name="phonecode" id="phonecode" class="inp inppw" type="text" placeholder="验证码" /><span style="color: red" id="login_error"></span></li>
            <li><input name="password" id="password" class="inp inppw" type="password" placeholder="密码" />
                <li><input name="repassword" id="repassword" class="inp inppw" type="password" placeholder="确认密码" />
            <li><input class="inp sub" type="submit" value="确认" id="login_sub_form" /></li>
        </ul>
    </form>
<script>
</script>