<div class="container">
    <ol class="breadcrumb">
        <li><a href="">泛丁首页</a></li>
        <li class="active">账户登录</li>
    </ol>
<!--    <h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>账户登录</strong></h2>-->
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>mobile/login" id="login_form" >
                <div class="form-group">
                    <!--<input type="hidden" name="from_url" value="<?php echo $from; ?>" />-->
                    <div class="alert alert-info col-sm-12" style="text-align: center;" id="error_display">泛丁，梦想开始的地方</div>
                </div>
                <div class="LRform log">
                    <div class="sns">
                        <a class="weibo" title="微博账号" href="#" target="_blank" style="display: inline-block; "></a>
                        <!--<a class="douban" title="豆瓣账号" href="#" target="_blank"></a>-->
                        <a class="qq" title="QQ账号" href="<?php echo base_url('tencent/createUrl'); ?>" target="_blank"></a>
                        <div class="note">可用以上社交帐号登录</div>
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="account" class="col-sm-2 control-label">账户名称</label>-->
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="account" name="account" placeholder="手机号/邮箱号" maxlength="32">
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="password" class="col-sm-2 control-label">账户密码</label>-->
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="请输入登录密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success  btn-block" id="login_button">登录</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <p>没有帐号？去<a href="<?php echo base_url(); ?>mobile/register"><strong>注册</strong></a></p>
                        <p><a href="<?php echo base_url(); ?>mobile/forget"><strong>忘记密码？</strong></a></p>
<!--                        <p>或者？直接使用手机号码<a href="<?php echo base_url(); ?>mobile/celllogin"><strong>登录</strong></a></p>-->
                    </div>
                </div>
            </form>        
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/mobile.js"></script>
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