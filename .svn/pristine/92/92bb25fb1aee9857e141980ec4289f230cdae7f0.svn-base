<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_system"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_system/querys">SQL语句执行</a></li>
            </ul>
        </div>
        <div class="formbody">
            <form name="system_excute_query" action="<?php echo base_url(); ?>admin_system/querys" method="post" id="system_excute_query" enctype="multipart/form-data" >
                <div class="formtitle"><span>执行sql语句（慎用---[不需要添加""、'']）</span></div>
                <ul class="forminfo">
                    <li><label>SQL语句</label><textarea name="sql_query" type="text" rows="" cols="" class="textinput"></textarea></li>
                    <li><label>&nbsp;</label><input name="excute" type="button" class="btn" value="执行" id="excute_button"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(function(){
        $('#excute_button').click(function(){
            $.ajax({
                type: "POST",
                url: "/admin_system/querys/"+Math.random(),
                data: $("#system_excute_query").serialize(),
                dataType:"json",
                success: function(data){
                    if(data.flag==0){
                        alert(data.error);
                    }else{
                        alert(data.error);
                        location.href="/admin_system/querys";
                    }
                }
            });
        });
    })
</script>