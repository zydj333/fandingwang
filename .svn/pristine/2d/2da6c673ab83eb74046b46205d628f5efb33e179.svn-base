<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/lang/zh_CN.js'></script>
        <script type="text/javascript" src='<?php echo base_url(); ?>js/My97DatePicker/WdatePicker.js'></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 245
                });
                $(".select2").uedSelect({
                    width : 245
                });
                $(".select3").uedSelect({
                    width : 200
                });

                KindEditor.ready(function(K) {
                    window.editor = K.create('#editor_id');
                });

                $("#add").click(function(){
                    editor.sync();
                    $.ajax({
                        type: "POST",
                        url: "/admin_product/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_product/";
                            }
                        }
                    });
                });
            })


            function ajaxFileUpload(){
                $("#loading")
                .ajaxStart(function(){
                    $(this).show();
                })
                .ajaxComplete(function(){
                    $(this).hide();
                });
                $.ajaxFileUpload
                (
                {
                    url:'/admin_image/upload',
                    secureuri:false,
                    fileElementId:'fileToUpload',
                    dataType: 'json',
                    data:{imagetype:'products'},
                    success: function (data, status)
                    {
                        if(data.flag==0){
                            alert(data.error);
                        }else{
                            var temp = '<img src="/'+data.imgurl_thumb+'" width="50" height="30" />';
                            $('#upload_img').html(temp);
                            $('#coverimage').val(data.imgurl);
                            $('#imgshow').attr('href','/'+data.imgurl);
                        }
                    },
                    error: function (data, status, e)
                    {
                        alert(e);
                    }
                }
            )
                return false;
            }
            
            
            function ajaxFileUpload1(){
                $("#loading1")
                .ajaxStart(function(){
                    $(this).show();
                })
                .ajaxComplete(function(){
                    $(this).hide();
                });
                $.ajaxFileUpload({
                    url:'/admin_image/upload',
                    secureuri:false,
                    fileElementId:'fileToUpload1',
                    dataType: 'json',
                    data:{imagetype:'products'},
                    success: function (data, status)
                    {
                        if(data.flag==0){
                            alert(data.error);
                        }else{
                            var temp = '<img src="/'+data.imgurl_thumb+'" width="50" height="30" />';
                            $('#upload_img_banner').html(temp);
                            $('#coverimage_banner').val(data.imgurl);
                            $('#imgshow_banner').attr('href','/'+data.imgurl);
                        }
                    },
                    error: function (data, status, e)
                    {
                        alert(e);
                    }
                }
            )
                return false;
            }            
            

            function getCity(province){
               if(province>0){
                   $.ajax({
                        type: "POST",
                        url: "/common/getCity/"+Math.random(),
                        data: {'province':province},
                        dataType:"json",
                        success: function(data){
                            var str='<option value="0">'+'----'+'</option>';
                            if(data.flag==0){
                                str='<option value="0">'+data.error+'</option>';
                            }else{
                                $.each(data.error, function(key, value) {
                                    str+='<option value="'+value.id+'">'+value.name+'</option>';
                                });
                            }
                            $("#city").html(str);
                        }
                    });
               }
            }

        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_product/add" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('user_id'); ?></label><input name="user_id" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                    <li><label><?php echo lang('title'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:350px;"/></li>
                    <li><label><?php echo lang('title_salt'); ?></label><input name="title_salt" type="text" class="dfinput" value=""  style="width:550px;"/></li>
                    <li><label><?php echo lang('banner'); ?></label>
                            <div class="vocation">
                                <input name="fileToUpload" id="fileToUpload1" type="file" class="dfinput" value=""  style="width:150px;"/>
                                <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload1();" class="btn" value="<?php echo lang('upload'); ?>"/>
                                <a href="" target="_blank" id="imgshow_banner"><p id="upload_img_banner"></p></a>
                                <img id="loading1" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                                <input type="hidden" name="banner_url" id="coverimage_banner" value="" />
                            </div>
                    </li>
                    <li></li>
                    <li><label><?php echo lang('product_type'); ?></label>
                            <div class="vocation">
                                <select class="select3" name="product_type">
                                    <option value="0"><?php echo lang('no_type'); ?></option>
                                <?php foreach ($type as $k => $v): ?>
                                        <option value="<?php echo $v->id; ?>"><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                </li>
                    <li><label><?php echo lang('province'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="province" onchange="return getCity(this.value)" >
                                <option value="0"><?php echo lang('please_choose_province_first'); ?></option>
                                <?php foreach ($province as $key => $value): ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </li>
                        <li><label><?php echo lang('city'); ?></label>
                            <div class="vocation">
                                <select class="select2" id="city" name="city">
                                    <option value="0"><?php echo lang('please_choose_province_first'); ?></option>
                                </select>
                            </div>
                        </li>
                    <li><label><?php echo lang('starttime'); ?></label><input name="starttime" type="text" class="dfinput" value=""  style="width:150px;" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /></li>
                    <li><label><?php echo lang('days'); ?></label><input name="days" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                    <li><label><?php echo lang('video'); ?></label><input name="video" type="text" class="dfinput" value=""  style="width:450px;"/></li>
                    <li><label><?php echo lang('amount'); ?></label><input name="amount" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                    <li><label><?php echo lang('image_url'); ?></label>
                            <div class="vocation">
                                <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                                <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="<?php echo lang('upload'); ?>"/>
                                <a href="" target="_blank" id="imgshow"><p id="upload_img"></p></a>
                                <img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                                <input type="hidden" name="image_url" id="coverimage" value="" />
                                <input type="hidden" name="imageid" id="coverimageid" value="" />
                            </div>
                    </li>
                    <li></li>
                    <li><label><?php echo lang('discription'); ?></label><textarea name="discription" cols="" rows="" class="textinput"></textarea></li>
                    <li><label><?php echo lang('content'); ?></label><textarea name="content" id="editor_id" cols="" rows="" style="width:700px;height:300px;"></textarea></li>
                    <li><label><?php echo lang('is_effect'); ?></label><cite><input name="is_effect" type="radio" value="0" checked="checked" /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_effect" type="radio" value="1" /><?php echo lang('yes'); ?></cite></li>
                    <li><label><?php echo lang('is_rem'); ?></label><cite><input name="is_rem" type="radio" value="0" checked="checked" /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_rem" type="radio" value="1" /><?php echo lang('yes'); ?></cite></li>
                    <li><label><?php echo lang('is_success'); ?></label><cite><input name="is_success" type="radio" value="0" checked="checked" /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_success" type="radio" value="1" /><?php echo lang('yes'); ?></cite></li>
                    <li><label><?php echo lang('seo_title'); ?></label><input name="seo_title" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                    <li><label><?php echo lang('seo_keyword'); ?></label><input name="seo_keyword" type="text" class="dfinput" value=""  style="width:550px;"/></li>
                    <li><label><?php echo lang('seo_discription'); ?></label><textarea name="seo_discription" cols="" rows="" class="textinput"></textarea></li>
                    <li><label><?php echo lang('salt'); ?></label><input name="salt" type="text" class="dfinput" value="0"  style="width:150px;"/></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
