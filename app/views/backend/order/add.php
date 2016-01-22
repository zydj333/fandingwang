<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 255
                });
                
                $(".select2").uedSelect({
                    width : 200
                });
                
                //选择项目子项
                $("#pname").change(function(){
                    var pid=$("#pname").val();
                    $.ajax({
                        type: "POST",
                        url: "/admin_order/getProjectItems/"+Math.random(),
                        data: {'pid':pid},
                        dataType:"json",
                        success: function(data){
                             var str='<option value="0">'+'----'+'</option>';
                            if(data.flag===0){
                                str='<option value="0">'+data.error+'</option>';
                            }else{
                                $.each(data.error, function(key, value) {
                                    str+='<option value="'+value.id+'">'+value.price+'—'+value.sell_total+'/'+value.total+'</option>';
                                });
                            }
                            $("#items_name").html(str);
                        }
                     });
                });
                
                //保存数据
                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_order/saveAdd/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag===0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_order/";
                            }
                        }
                    });
                });
            })
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_order"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_order/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_order/add" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('pname'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="pname" id="pname">
                                <option value="0">--请选择项目--</option>
                                <?php foreach ($pro as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>"><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </li>
                    <li><label><?php echo lang('items_name'); ?></label>
                        <div class="vocation">
                            <select class="select2" name="items_name" id="items_name">
                                <option value="0">--请先选择项目--</option>
                            </select>
                        </div>
                    </li>
                    <li><label><?php echo lang('username'); ?></label><input name="username" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                    <li><label><?php echo lang('suggest'); ?></label><input name="suggest" type="text" class="dfinput" value="系统购买"  style="width:450px;"/></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>
