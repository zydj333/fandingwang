<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $("#add").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/admin_bbstag/edit/"+Math.random(),
                        data: $("#system_add_save").serialize(),
                        dataType:"json",
                        success: function(data){
                            if(data.flag==0){
                                alert(data.error);
                            }else{
                                alert(data.error);
                                location.href="/admin_bbstag/";
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
                <li><a href="<?php echo base_url(); ?>admin_bbstag"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_bbstag/edit/<?php echo $tag->id;?>"><?php echo lang('page_where_edit'); ?></a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_add_save" action="<?php echo base_url(); ?>admin_bbstag/edit/<?php echo $tag->id;?>" method="post" id="system_add_save" enctype="multipart/form-data" >
                <div class="formtitle"><span><?php echo lang('edit'); ?></span></div>
                <ul class="forminfo">
                    <li><label><?php echo lang('tagname'); ?></label>
                        <input name="tagname" type="text" class="dfinput" value="<?php echo $tag->tagname;?>"  style="width:550px;"/>
                        <input name="tag_id" type="hidden" value="<?php echo $tag->id;?>"/>
                    </li>
                    <li><label><?php echo lang('salt'); ?></label><input name="salt" type="text" class="dfinput" value="<?php echo $tag->salt;?>"  style="width:150px;"/></li>
                    <li><label>&nbsp;</label><input name="add" type="button" id="add" class="btn" value="<?php echo lang('edit'); ?>"/></li>
                </ul>
            </form>
        </div>
    </body>

</html>