<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/backend/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/select-ui.min.js"></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/lang/zh_CN.js'></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width : 145
                });

                KindEditor.ready(function(K) {
                    window.editor = K.create('#editor_id');
                });

                $("#add").click(function(){
                    editor.sync();
                    $.ajax({
                        type: "POST",
                        url: "/admin_bbstopic/edit/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_bbstopic/";
                            }
                        }
                    });
                });
            })


            function getforum_two(mod_one){
               if(mod_one>0){
                   $.ajax({
                        type: "POST",
                        url: "/common/getMod/"+Math.random(),
                        data: {'mod_one':mod_one},
                        dataType:"json",
                        success: function(data){
                            var str='<option value="0">'+'----'+'</option>';
                            if(data.flag==0){
                                str='<option value="0">'+data.error+'</option>';
                            }else{
                                $.each(data.error, function(key, value) {
                                    str+='<option value="'+value.id+'">'+value.title+'</option>';
                                });
                            }
                            $("#forum_two").html(str);
                        }
                    });
               }else{
                var str='<option value="0">'+'----'+'</option>';
                $("#forum_two").html(str);
               }
            }
            
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
                    data:{imagetype:'bbsmod'},
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
                <li><a href="<?php echo base_url(); ?>admin_bbstopic"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_bbstopic/edit/<?php echo $topic->id;?>"><?php echo lang('page_where_edit'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_bbstopic/edit/<?php echo $topic->id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('edit'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('title'); ?></label>
                        <input name="topic_id" type="hidden" value="<?php echo $topic->id;?>"/>
                        <input name="title" type="text" class="dfinput" value="<?php echo $topic->title;?>"  style="width:550px;"/>
                    </li>
                    <li><label><?php echo lang('forum_one'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="forum_one" onchange="return getforum_two(this.value)" >
                                <option value="0"><?php echo lang('choose_forum_one'); ?></option>
                                <?php foreach ($mod as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>" <?php if($v->id==$topic->forum_one){echo 'selected="selected"';}?> ><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </li>
                    <li><label><?php echo lang('forum_two'); ?></label>
                        <div class="vocation">
                            <select class="select1" name="forum_two" id="forum_two">
                                <option value="0"><?php echo lang('choose_forum_one'); ?></option>
                                <?php foreach ($mod_two as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>" <?php if($v->id==$topic->forum_two){echo 'selected="selected"';}?> ><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </li>
                    <li><label><?php echo lang('imageurl'); ?></label>
                            <div class="vocation">
                                <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                                <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="<?php echo lang('upload'); ?>"/>
                                <a href="<?php echo base_url().$topic->imageurl;?>" target="_blank" id="imgshow"><p id="upload_img"><img src="/<?php echo $topic->imageurl;?>" width="50" height="30" /></p></a>
                                <img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                                <input type="hidden" name="imageurl" id="coverimage" value="<?php echo $topic->imageurl;?>" />
                                <input type="hidden" name="imageid" id="coverimageid" value="" />
                            </div>
                    </li>
                    <li></li>
                    
                    <li><label><?php echo lang('content'); ?></label><textarea name="content" id="editor_id" cols="" rows="" style="width:700px;height:300px;"><?php echo $topic->content;?></textarea></li>
                    <li><label><?php echo lang('tags'); ?></label>
                    <?php if(!empty($tag)):?>
                        <?php
                        $tags=  explode(',', $topic->tagid);
                        ?>
                        <?php foreach($tag as $k=>$v):?>
                        <input name="tags[]" type="checkbox" value="<?php echo $v->id; ?>" <?php if(in_array($v->id, $tags)){echo 'checked="checked"';}?> /><?php echo $v->tagname; ?>&nbsp;
                        <?php endforeach;?>
                    <?php endif;?>
                    </li>
                    <li><label><?php echo lang('is_del'); ?></label><cite><input name="is_del" type="radio" value="0" <?php if($topic->is_del==0):?>checked="checked"<?php endif; ?> /><?php echo lang('no'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_del" type="radio" value="1" <?php if($topic->is_del==1):?>checked="checked"<?php endif; ?>  /><?php echo lang('yes'); ?></cite></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('edit'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>
