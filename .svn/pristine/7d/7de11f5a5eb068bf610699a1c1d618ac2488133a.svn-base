<!--登录START-->
<div class="LRform log">
    <h1>绑定本站帐号</h1>
    <div class="sns">
        <img style="width: 40px;border-radius: 50%; clear: right;" src="<?php echo $wechat['headimgurl'];?>"></br>
        <span style="clear: left;"><?php echo $wechat['nickname'];?></span>
    </div>

    <form method="post" id="bindform" action="">
        <ul class="form">
            <li><input name="account" id="account" class="inp inpname" type="text" placeholder="请输入手机号码或者邮箱"/></li>
            <li><input name="password" id="password" class="inp inppw" type="password" placeholder="请输入密码" /><span style="color: red" id="login_error"></span></li>
            <li><input class="inp sub" type="button" value="确认绑定" id="bindform_button" /></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#bindform_button').click(function(){
            $.ajax({
                type: "POST",
                url: "/wechatlogin/processing/" + Math.random(),
                data: $("#bindform").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 0) {
                        $("#login_error").html(data.error);
                    } else if (data.flag === 1) {
                        location.href="/index";
                    }
                },
                error:function(data){
                    alert('出错啦！');
                }
            });
        });
    });
</script>