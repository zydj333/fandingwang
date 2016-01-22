<div class="member">
    <div class="userCenter">
        <div class="head">
            <h2 class="yh">个人设置</h2>
        </div>
        <script type="text/javascript" src='<?php echo base_url(); ?>js/My97DatePicker/WdatePicker.js'></script>
        <form action="<?php echo base_url(); ?>mysetting/saveinfo" method="post">
            <div class="body clearfix">
                <div class="tabs">
                    <div class="tab-hd">
                        <ul>
                            <li class="on"><a href="<?php echo base_url() ?>mysetting">基本资料</a></li>
                            <li><a href="<?php echo base_url() ?>mysetting/password">修改密码</a></li>
                            <li><a href="<?php echo base_url() ?>mysetting/address">收货地址</a></li>
                            <!--<li><a href="<?php echo base_url() ?>mysetting/cardbind">帐号绑定</a></li>-->
                        </ul>
                    </div>
                    <div class="tab-bd">
                        <div class="tab-pal">
                            <ul class="form-ul2">
                                <!--<li>
                                    <label for="">UID</label>
                                    <input type="text" class="text" placeholder="" id="" value="15040232" name="" />
                                </li>
                                <li>
                                    <label for="">邮箱</label>
                                    <input type="text" class="text"  id="" value="Fanding@163.vip.com" name="" />
                                </li>
                                <li>
                                    <label for="">手机</label>
                                    <input type="text" class="text" placeholder="" id="" value="18012345678" name="" />
                                </li>
                                <li>
                                    <label for="">昵称</label>
                                    <input type="text" class="text" placeholder="" id="" value="KOYOMYR" name="" />
                                </li>
                                <li>
                                    <label for="">真实姓名</label>
                                    <input type="text" class="text" placeholder="真实姓名不可修改" id="" value="" name="" />
                                </li>-->
                                <li>
                                    <label for="">性别</label>
                                    <span>
                                        <input name="gender" type="radio" value="0"  <?php if ($member->gender == 0): ?>checked="checked"<?php endif; ?> />
                                        男</span> <span>
                                        <input name="gender" type="radio" value="1"<?php if ($member->gender == 1): ?>checked="checked"<?php endif; ?> />
                                        女</span>
                                </li>
                                <li>
                                    <label for="">出生日期</label>
                                    <input type="text" class="text" placeholder="选择你的生日" value="<?php echo $member->birthday; ?>" name="birthday" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'})" />
                                    <!--<select class="select select2">
                                        <option>2015</option>
                                    </select>
                                    <select class="select select2">
                                        <option>01</option>
                                    </select>
                                    <select class="select select2">
                                        <option>02</option>
                                    </select>-->
                                </li>
                                <li>
                                    <label for="">职业</label>
                                    <input type="text" class="text" placeholder="填写你的职业" value="<?php echo $member->job; ?>" name="job" />
                                </li>
                                <li>
                                    <label for="">所在城市</label>
                                    <select class="select" name="province" id="province" onchange="return getCity(this.value)" >
                                        <option value="0">-请选择-</option>
                                        <?php if (!empty($province)): ?>
                                            <?php foreach ($province as $province_value): ?>
                                                <option value="<?php echo $province_value->id; ?>" <?php if ($province_value->id == $member->province_id): ?>selected="selected"<?php endif; ?> ><?php echo $province_value->name; ?></option>
                                            <?php endforeach; ?>    
                                        <?php endif; ?>
                                    </select>
                                    <select class="select" name="city" id="city">
                                        <option value="0">-请选择省份-</option>
                                        <?php if (isset($city) && !empty($city)): ?>
                                            <?php foreach ($city as $city_value): ?>
                                                <option value="<?php echo $city_value->id; ?>" <?php if ($city_value->id == $member->city_id): ?>selected="selected"<?php endif; ?> ><?php echo $city_value->name; ?></option>
                                            <?php endforeach; ?>    
                                        <?php endif; ?>
                                    </select>
                                </li>
                                <li>
                                    <label for="">个性签名</label>
                                    <input type="text" class="text" placeholder="您的签名" value="<?php echo $member->discription; ?>" name="discription" />
                                </li>
                                <li class="btn-li">
                                    <input type="submit" class="btn yh" value="保存" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="avatar-box">
                    <div class="avatar"> <img src="<?php echo base_url() . $member->avatar; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>images/avatar.jpg'" width="181px" />
                        <p class="yh"><a href="<?php echo base_url(); ?>mysetting/avatar">修改头像</a></p>
                    </div>
                    <div class="desc"> 请选择图片文件png，jpg，gif格式，5M以内，建议像素大小为300px*300px </div>
                </div>
            </div>
        </form>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    function getCity(province) {
        if (province > 0) {
            $.ajax({
                type: "POST",
                url: "/common/getCity/" + Math.random(),
                data: {'province': province},
                dataType: "json",
                success: function(data) {
                    var str = '<option value="0">' + '----' + '</option>';
                    if (data.flag == 0) {
                        str = '<option value="0">' + data.error + '</option>';
                    } else {
                        $.each(data.error, function(key, value) {
                            str += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    }
                    $("#city").html(str);
                }
            });
        }
    }
</script>