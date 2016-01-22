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
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 145
                });

                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_banner/add/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_banner/";
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
                    data:{imagetype:'banner'},
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
                <li><a href="<?php echo base_url(); ?>admin_banner"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_banner/add"><?php echo lang('page_where_add'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_banner/add" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('add'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('title'); ?></label><input name="title" type="text" class="dfinput" value=""  style="width:550px;"/></li>
                    <li><label><?php echo lang('imageurl'); ?></label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="<?php echo lang('upload'); ?>"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                            <input type="hidden" name="imageurl" id="coverimage" value="" />
                            <input type="hidden" name="imageid" id="coverimageid" value="" />
                        </div>
                    </li>
                    <li><label><?php echo lang('link'); ?></label><input name="link" type="text" class="dfinput" value=""  style="width:450px;"/></li>
                    <li><label><?php echo lang('color'); ?></label><input name="color" type="text" class="dfinput" value=""  style="width:200px;"/></li>
                    <li><label><?php echo lang('sult'); ?></label><input name="sult" type="text" class="dfinput" value=""  style="width:150px;"/></li>
                    <li><label><?php echo lang('type'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="type">
                                <?php foreach ($bannertype as $k => $v): ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </li>
                        <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('add'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>
