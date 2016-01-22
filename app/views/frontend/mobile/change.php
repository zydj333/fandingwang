<div class="container">
    <ol class="breadcrumb">
        <li><a href="">泛丁首页</a></li>
        <li class="active">找回密码</li>
    </ol>
    <!--<h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>账户密码找回</strong></h2>-->
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>mobile/forget" id="repassword_form" >
                <div class="form-group">
                    <input type="hidden" name="from_url" value="<?php echo $from; ?>" />
                    <div class="alert alert-info col-sm-12" style="text-align: center;" id="error_display">请输入您的新密码。</div>
                </div>
                <div class="form-group">
                    <!--<label for="phonenumber" class="col-sm-2 control-label">手机号码</label>-->
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="新密码" maxlength="20">
                    </div>
                </div>
                <div class="form-group">
                    <!--<label for="phonenumber" class="col-sm-2 control-label">手机号码</label>-->
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="确认新密码" maxlength="20">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success  btn-block" id="repassword_button">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/mobile.js"></script>
<script type="text/javascript">
                            //提交表单
                            $("#repassword_button").click(function() {
                                $.ajax({
                                    type: "POST",
                                    url: "/mobile/resetPassword/" + Math.random(),
                                    data: $("#repassword_form").serialize(),
                                    dataType: "json",
                                    success: function(data) {
                                        if (data.flag === 1) {
                                            $("#error_display").removeClass('alert-info');
                                            $("#error_display").addClass('alert-danger');
                                            $('#error_display').html(data.error);
                                            location.href = "/mobile/index";
                                        } else if (data.flag === 0) {
                                            $("#error_display").removeClass('alert-info');
                                            $("#error_display").addClass('alert-danger');
                                            $('#error_display').html(data.error);
                                            return;
                                        } else {
                                            $("#error_display").removeClass('alert-info');
                                            $("#error_display").addClass('alert-danger');
                                            $('#error_display').html(data.error);
                                            return;
                                        }
                                    }
                                });
                            });
                        </script>