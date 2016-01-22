<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>mobile/index">泛丁首页</a></li>
        <li class="active">账户注册</li>
    </ol>
    <!--<h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>用户注册</strong></h2>-->
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" action="<?php echo base_url('/mobile/register')?>" method="post" id="register_form" >
                <div class="form-group">
                    <div class="alert alert-info col-sm-12" style="text-align: center;" id="error_display">请仔细填写下列信息。</div>
                </div>
                <div class="LRform log">
                    <div class="sns">
                        <a class="weibo" title="微博账号" href="#" target="_blank" style="display: inline-block; "></a>
                        <!-- <a class="douban" title="豆瓣账号" href="#" target="_blank"></a>
                         <a class="qq" title="QQ账号" href="#" target="_blank"></a>-->
                        <div class="note">可用以上社交帐号登录</div>
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="account" class="col-sm-2 control-label"></label>-->
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="account" name="account" placeholder="手机号/邮箱号" maxlength="17">
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="password" class="col-sm-2 control-label"></label>-->
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="请设置登录密码">
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="repassword" class="col-sm-2 control-label"></label>-->
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="请再次输入密码">
                    </div>
                </div>
<!--                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">邮箱地址</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email地址" maxlength="64">
                    </div>
                </div>-->
                <div class="form-group">
                    <!--<label for="varify" class="col-sm-2 control-label"></label>-->
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 40%; float: left;" id="varify" name="varify" placeholder="请输入右侧数字"  maxlength="4">
                        <div style="width: 55%; float: right;"><img style="width:100%;" src="<?php echo base_url(); ?>validate/doimg"   alt="请在前面输入图片中的数字" id="varifyCode" title="点击刷新验证码" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="cellcode" class="col-sm-2 control-label"></label>-->
                    <div class="col-sm-12">
                        <input type="text" class="form-control" style="width: 40%; float: left;" id="cellcode" name="cellcode" placeholder="验证码" maxlength="6">
                            <button type="button" class="btn btn-info btn-block" style="width: 55%; float: right;"  id="get_phonecode">获取验证码</button>
                            <button type="button" class="btn btn-default btn-block hidden" style="width: 55%; float: right;"  id="noget_phonecode"><span id="timeb2">60</span>秒后重新获取</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success  btn-block" id="do_register">提交注册</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <p>已有帐号？去<a href="<?php echo base_url('/mobile/login')?>"><strong>登录</strong></a></p>
<!--                        <p>嫌注册太麻烦？直接用手机号<a href="<?php echo base_url('/mobile/celllogin')?>"><strong>登录</strong></a></p>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/mobile.js"></script>
<script type="text/javascript">
        $(function () {
            $.ajax({
                type: "GET",
                url: "/sina/sinaLogin/" + Math.random(),
                dataType: "json",
                success: function (data) {
                    $('.weibo').attr('href', data.error);
                }
            });
        });
    </script>