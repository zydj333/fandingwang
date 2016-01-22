<div class="member">
    <div class="userCenter">
        <div class="head">
            <h2 class="yh">个人设置</h2>
        </div>
        <form action="/mysetting/savepassword" method="post" id="password_form">
            <div class="body clearfix">
                <div class="tabs">
                    <div class="tab-hd">
                        <ul>
                            <li><a href="<?php echo base_url() ?>mysetting">基本资料</a></li>
                            <li  class="on"><a href="<?php echo base_url() ?>mysetting/password">修改密码</a></li>
                            <li><a href="<?php echo base_url() ?>mysetting/address">收货地址</a></li>
                            <!--<li><a href="<?php echo base_url() ?>mysetting/cardbind">帐号绑定</a></li>-->
                        </ul>
                    </div>
                    <div class="tab-bd">
                        <div class="tab-pal">
                            <ul class="form-ul2">
                                <li>
                                    <label for="">原密码</label>
                                    <input type="password" class="text" placeholder="请输入初始密码" id="last_password" value="" name="last_password" />
                                </li>
                                <li>
                                    <label for="">新密码</label>
                                    <input type="password" class="text" placeholder="6-15位字符（字母、数字、符号），区分大小写" id="new_password" value="" name="new_password" />
                                </li>
                                <li>
                                    <label for="">确认密码</label>
                                    <input type="password" class="text" id="conform_password" value="" name="conform_password" />
                                </li>
                                <li class="btn-li">
                                    <input type="button" id="password_button" class="btn yh" value="保存" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#password_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/mysetting/savepassword/" + Math.random(),
                data: $("#password_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        alert(data.error);
                        location.reload();
                    } else {
                        alert(data.error);
                    }
                }
            });
        });
    });
</script>