<div class="container">
    <ol class="breadcrumb">
        <li><a href="">泛丁首页</a></li>
        <li class="active">用户登录</li>
    </ol>
    <h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>用户手机登录</strong></h2>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>mobile/celllogin" id="phone_login_form" >
                <div class="form-group">
                    <input type="hidden" name="from_url" value="<?php echo $from; ?>" />
                    <div class="alert alert-info col-sm-12" style="text-align: center;" id="error_display">请填写您的手机号码及验证码。</div>
                </div>
                <div class="form-group">
                    <label for="phonenumber" class="col-sm-2 control-label">手机号码</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="请输入您的手机号" maxlength="11">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cellcode" class="col-sm-2 control-label">手机验证码</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 40%; float: left;" id="cellcode" name="cellcode" placeholder="手机验证码" maxlength="6">
                            <button type="button" class="btn btn-info btn-block" style="width: 55%; float: right;"  id="get_phonecode_login">获取验证码</button>
                            <button type="button" class="btn btn-default btn-block hidden" style="width: 55%; float: right;"  id="noget_phonecode_login"><span id="timeb2">60</span>秒后重新获取</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="varify" class="col-sm-2 control-label">图形验证码</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 40%; float: left;" id="varify" name="varify" placeholder="请输入右侧图片中的数字"  maxlength="4">
                        <div style="width: 55%; float: right;"><img src="<?php echo base_url(); ?>validate/doimg"   alt="请在前面输入图片中的数字" id="varifyCode" title="点击刷新验证码" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success  btn-block" id="phone_login_button">登入</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <p>使用帐号密码<a href="<?php echo base_url(); ?>mobile/login"><strong>登录</strong></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/mobile.js"></script>