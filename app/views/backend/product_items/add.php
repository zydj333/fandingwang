<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                
                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_product_items/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                location.href="/admin_product_items/index/"+data.error;
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
                    data:{imagetype:'product_items'},
                    success: function (data, status)
                    {
                        if(data.flag==0){
                            alert(data.error);
                        }else{
                            var temp = '<img src="/'+data.imgurl_thumb+'" width="50" height="30" />';
                            $('#upload_img').html(temp);
                            $('#coverimage').val(data.imgurl);
                            $('#coverimageid').val(data.imageid);
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
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_items/index/<?php echo $product_id;?>"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_product_items/add/<?php echo $product_id;?>"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_product_items/add/<?php echo $product_id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('pid'); ?></label><input name="pid" type="text" class="dfinput" readonly="readonly" value="<?php echo $product_id;?>"  style="width:150px;"/></li>
                    <li><label><?php echo lang('price'); ?></label><input name="price" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                    <li><label><?php echo lang('total'); ?></label><input name="total" type="text" class="dfinput" value=""  style="width:250px;"/></li>
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
                    <li><label><?php echo lang('title'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:250px;"/></li>
                    <li><label><?php echo lang('replay'); ?></label><textarea name="replay" cols="" rows="" class="textinput"></textarea></li>
                    <li><label><?php echo lang('free_mail'); ?></label><cite>
                            <input name="free_mail" type="radio" value="0" /><?php echo lang('nomail'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="free_mail" type="radio" value="1" /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="free_mail" type="radio" value="2" checked="checked" /><?php echo lang('yes'); ?></cite></li>
                    <li><label><?php echo lang('mail_fee'); ?></label><input name="mail_fee" type="text" class="dfinput" value="0" style="width:150px;"/></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
