<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/center">用户中心</a></li>
        <li class="active">个人资料</li>
    </ol>
    <div class="page-header">
        <h2 class="col-lg-12" style="text-align: center;"><strong>个人资料</strong></h2>
    </div>
    <div class="col-lg-12">
        <a class="col-lg-4 btn btn-success" href="<?php echo base_url(); ?>mobile/center">个人资料</a>
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/orderList">我的订单</a>
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/addressList">收货地址</a>
    </div>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>mobile/center">
                <div class="form-group">
                    <label class="control-label">用户昵称：<small><?php echo $member->account; ?></small></label>
                </div>
                <div class="form-group">
                    <label class="control-label">手机号码：<small><?php echo $member->telphone; ?></small></label>
                </div>
                <div class="form-group">
                    <label class="control-label">邮箱地址：<small><?php echo $member->email; ?></small></label>
                </div>
                <div class="form-group">
                    <label for="username">用户姓名</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="您的姓名"  maxlength="15" value="<?php echo $member->username; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label">性别</label>
                    <div class="radio">
                        <label class="col-sm-3">
                            <input type="radio" name="gander" id="gander1" value="0" <?php if ($member->gender == 0): ?>checked="checked"<?php endif; ?> >男
                        </label>
                        <label class="col-sm-7">
                            <input type="radio" name="gander" id="gander2" value="1" <?php if ($member->gender == 1): ?>checked="checked"<?php endif; ?> >女
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="qqnumber">QQ号码</label>
                    <input type="text" class="form-control" id="qqnumber" placeholder="您的QQ" name="qqnumber" value="<?php echo $member->qqnumber; ?>">
                </div>
                <div class="form-group">
                    <label for="job">身份证号</label>
                    <input type="text" class="form-control" id="idnumber" placeholder="身份证号码" name="idnumber" value="<?php echo $member->idnumber; ?>">
                </div>
                <div class="form-group">
                    <label for="job">工作职位</label>
                    <input type="text" class="form-control" id="job" placeholder="您的职位" name="job" value="<?php echo $member->job; ?>">
                </div>
                <div class="form-group">
                    <label for="birthiday">出生日期</label>
                    <input type="text" class="form-control" id="birthiday" name="birthiday"  value="<?php echo $member->birthday; ?>"  onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'})">
                </div>
                <div class="form-group">
                    <label class="control-label">所在省份</label>
                    <select class="form-control" id="province" name="province">
                        <option value="0">--请选择省份--</option>
                        <?php if (!empty($province)): ?>
                            <?php foreach ($province as $pro_key => $pro_value): ?>
                                <option value="<?php echo $pro_value->id; ?>" <?php if ($pro_value->id == $member->province_id): ?>selected="selected"<?php endif; ?> ><?php echo $pro_value->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">所在城市</label>
                    <select class="form-control" id="city" name="city">
                        <option value="0">--请选择城市--</option>
                        <?php if (!empty($city)): ?>
                            <?php foreach ($city as $city_key => $city_value): ?>
                                <option value="<?php echo $city_value->id; ?>" <?php if ($city_value->id == $member->city_id): ?>selected="selected"<?php endif; ?> ><?php echo $city_value->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">所在地区</label>
                    <select class="form-control" id="area" name="area">
                        <option value="0">--请选择地区--</option>
                        <?php if (!empty($area)): ?>
                            <?php foreach ($area as $area_key => $area_value): ?>
                                <option value="<?php echo $area_value->id; ?>" <?php if ($area_value->id == $member->area_id): ?>selected="selected"<?php endif; ?> ><?php echo $area_value->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">居住地址</label>
                    <input type="text" class="form-control" id="address" name="address"  value="<?php echo $member->address; ?>">
                </div>
                <div class="form-group">
                    <label for="description">个人签名</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="我的签名"><?php echo $member->discription; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">保存修改</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src='<?php echo base_url(); ?>js/My97DatePicker/WdatePicker.js'></script>
<script type="text/javascript">
    $(function() {
        //获取城市
        $("#province").change(function() {
            var pid = $('#province').val();
            $.ajax({
                type: "POST",
                url: "/mobile/getArea/" + Math.random(),
                data: {'pid': pid},
                dataType: "json",
                success: function(data) {
                    var str = '<option value="0">' + '--请选择城市--' + '</option>';
                    if (data.flag === 0) {
                        str = '<option value="0">' + data.error + '</option>';
                    } else {
                        $.each(data.error, function(key, value) {
                            str += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    }
                    $("#city").html(str);
                }
            });
        });
        //获取区域
        $("#city").change(function() {
            var pid = $('#city').val();
            $.ajax({
                type: "POST",
                url: "/mobile/getArea/" + Math.random(),
                data: {'pid': pid},
                dataType: "json",
                success: function(data) {
                    var str = '<option value="0">' + '--请选择区域--' + '</option>';
                    if (data.flag === 0) {
                        str = '<option value="0">' + data.error + '</option>';
                    } else {
                        $.each(data.error, function(key, value) {
                            str += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    }
                    $("#area").html(str);
                }
            });
        });
    });
</script>