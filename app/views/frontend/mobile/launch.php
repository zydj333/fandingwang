<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/launch">发起众筹</a></li>
        <li class="active">提交资料</li>
    </ol>
    <h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>发起众筹</strong></h2>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="" id="launch_form">
                <div class="form-group">
                    <div class="alert alert-info col-sm-12" style="text-align: center;" id="error_display">请仔细填写下列信息。</div>
                </div>
                <div class="form-group">
                    <label for="project_name" class="col-sm-2 control-label">项目名称*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="请输入项目名称" maxlength="15">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">姓名*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="您的姓名" value="<?php echo $member->username;?>"  maxlength="15">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">性别*</label>
                    <div class="radio col-sm-10">
                        <label class="col-sm-5">
                            <input type="radio" name="gander" id="gander1" value="0" <?php if($member->gender==0):?>checked="checked"<?php endif;?>>男
                        </label>
                        <label class="col-sm-5">
                            <input type="radio" name="gander" id="gander2" value="1" <?php if($member->gender==1):?>checked="checked"<?php endif;?>>女
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="celphone" class="col-sm-2 control-label">联系电话*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="celphone" name="celphone" placeholder="联系电话" value="<?php echo $member->telphone;?>" maxlength="11">
                    </div>
                </div>
                <div class="form-group">
                    <label for="wechat" class="col-sm-2 control-label">微信号码</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="wechat" name="wechat" placeholder="微信号码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sina" class="col-sm-2 control-label">新浪微博</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sina" name="sina" placeholder="新浪微博号">
                    </div>
                </div>
                <div class="form-group">
                    <label for="my_description" class="col-sm-2 control-label">个人简介*</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" id="my_description" name="my_description" placeholder="个人简介"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pro_description" class="col-sm-2 control-label">项目介绍*</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" id="pro_description" name="pro_description"  placeholder="项目介绍"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success  btn-block" id="launch_button">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/mobile.js"></script>