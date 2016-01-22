<div class="member">
    <div class="userCenter">
        <div class="head">
            <h2 class="yh">收货地址</h2>
        </div>
        <form action="#" method="post" id="address_form_edit">
            <div class="body clearfix">
                <div class="tabs">
                    <div class="tab-bd">
                        <div class="tab-pal" id="success_warning">
                            <ul class="form-ul2">
                                <li>
                                    <label for="">收货人</label>
                                    <input type="hidden" id="address_id" name="address_id" value="<?php echo $address->id;?>">
                                    <input type="text" class="text" placeholder="收货人名称" id="username" value="<?php echo $address->username; ?>" name="username" maxlength="15" />
                                </li>
                                <li>
                                    <label for="">联系电话</label>
                                    <input type="text" class="text" placeholder="手机号码" id="celphone" value="<?php echo $address->cellphone; ?>" name="celphone"  maxlength="15" />
                                </li>
                                <li>
                                    <label for="province">所在省份</label>
                                    <select class="select" name="province" id="province" onchange="return getCity(this.value)" >
                                        <option value="0">-请选择-</option>
                                        <?php if (!empty($province)): ?>
                                            <?php foreach ($province as $province_value): ?>
                                                <option value="<?php echo $province_value->id; ?>" <?php if ($province_value->id == $address->province): ?> selected="selected"<?php endif; ?> ><?php echo $province_value->name; ?></option>
                                            <?php endforeach; ?>    
                                        <?php endif; ?>
                                    </select>
                                </li>
                                <li>
                                    <label for="city">所在城市</label>
                                    <select class="select" name="city" id="city"  onchange="return getArea(this.value)" >
                                        <option value="0">-请选择省份-</option>
                                        <?php if (!empty($city)): ?>
                                            <?php foreach ($city as $city_value): ?>
                                                <option value="<?php echo $city_value->id; ?>"  <?php if ($city_value->id == $address->city): ?> selected="selected"<?php endif; ?> ><?php echo $city_value->name; ?></option>
                                            <?php endforeach; ?>    
                                        <?php endif; ?>
                                    </select>
                                </li>
                                <li>
                                    <label for="area">区域</label>
                                    <select class="select" name="area" id="area">
                                        <option value="0">-请选择省份-</option>
                                        <?php if (!empty($area)): ?>
                                            <?php foreach ($area as $area_value): ?>
                                                <option value="<?php echo $area_value->id; ?>" <?php if ($area_value->id == $address->area): ?> selected="selected"<?php endif; ?> ><?php echo $area_value->name; ?></option>
                                            <?php endforeach; ?>    
                                        <?php endif; ?>
                                    </select>
                                </li>
                                <li>
                                    <label for="address">详细地址</label>
                                    <input type="text" class="text" placeholder="详细地址，不要填写省份城市区域" value="<?php echo $address->address; ?>" name="address" id="address" />
                                </li>
                                <li style="line-height: 40px;" >
                                    <label for="is_default">默认地址</label>
                                    <input type="checkbox" value="1" name="is_default" id="is_default" <?php if ($address->is_default == 1): ?> checked="checked"<?php endif; ?> />设为默认地址
                                </li>

                            </ul>
                            <ul class="form-ul2">
                                <li class="btn-li">
                                    <input type="button" id="address_button_edit" class="btn yh" value="保存" />
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
    function getCity(province) {
        if (province > 0) {
            $.ajax({
                type: "POST",
                url: "/common/getCity/" + Math.random(),
                data: {'province': province},
                dataType: "json",
                success: function(data) {
                    var str = '<option value="0">' + '--请选择市--' + '</option>';
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

    function getArea(province) {
        if (province > 0) {
            $.ajax({
                type: "POST",
                url: "/common/getCity/" + Math.random(),
                data: {'province': province},
                dataType: "json",
                success: function(data) {
                    var str = '<option value="0">' + '--请选择区--' + '</option>';
                    if (data.flag == 0) {
                        str = '<option value="0">' + data.error + '</option>';
                    } else {
                        $.each(data.error, function(key, value) {
                            str += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    }
                    $("#area").html(str);
                }
            });
        }
    }


    $(function() {
        $("#address_button_edit").click(function() {
            $.ajax({
                type: "POST",
                url: '/mysetting/addressEdit/' + Math.random(),
                data: $("#address_form_edit").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 0) {
                        $.dialog.alert(data.error);
                    } else {
                        var htmls = '<span>' + data.error + '</span>';
                        $("#success_warning").html(htmls);
                    }
                }
            });
        });
    });
</script>