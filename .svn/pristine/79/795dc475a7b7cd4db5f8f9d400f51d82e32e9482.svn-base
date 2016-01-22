<div class="container">
    <form role="form" method="post" id="address_edit_from" action="">
        <div class="alert alert-info" id="error_display">为了您能尽快收到货物,请真实填写下列信息。</div>
        <div class="form-group">
            <label for="username">收件人</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $address->username; ?>">
            <input type="hidden" id="address_id" name="address_id" value="<?php echo $address->id; ?>">
        </div>
        <div class="form-group">
            <label for="cellphone">联系电话</label>
            <input type="text" class="form-control" id="cellphone" name="cellphone" value="<?php echo $address->cellphone; ?>">
        </div>
        <div class="form-group">
            <label class="control-label">所在省份</label>
            <select class="form-control" id="province" name="province">
                <option value="0">--请选择省份--</option>
                <?php if (!empty($province)): ?>
                    <?php foreach ($province as $pro_key => $pro_value): ?>
                        <option value="<?php echo $pro_value->id; ?>" <?php if ($pro_value->id == $address->province): ?>selected="selected"<?php endif; ?> ><?php echo $pro_value->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">所在城市</label>
            <select class="form-control" id="city" name="city">
                <option value="0">--请选择省份--</option>
                <?php if (!empty($city)): ?>
                    <?php foreach ($city as $city_key => $city_value): ?>
                        <option value="<?php echo $city_value->id; ?>" <?php if ($city_value->id == $address->city): ?>selected="selected"<?php endif; ?> ><?php echo $city_value->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">所在区域</label>
            <select class="form-control" id="area" name="area">
                <option value="0">--请选择省份--</option>
                <?php if (!empty($area)): ?>
                    <?php foreach ($area as $area_key => $area_value): ?>
                        <option value="<?php echo $area_value->id; ?>" <?php if ($area_value->id == $address->area): ?>selected="selected"<?php endif; ?> ><?php echo $area_value->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="address">详细地址</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address->address; ?>">
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" value="1" name="is_default" id="is_default" <?php if ($address->is_default == 1): ?>checked="checked"<?php endif; ?>>设为默认地址
            </label>
        </div>
        <button type="button" class="btn btn-primary btn-block" id="address_edit_button">保存</button>
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/mobile.js"></script>
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