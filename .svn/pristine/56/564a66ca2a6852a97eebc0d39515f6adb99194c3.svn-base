<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('left_title');?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>

        <script type="text/javascript">
            $(function(){
                //导航切换
                $(".menuson li").click(function(){
                    $(".menuson li.active").removeClass("active")
                    $(this).addClass("active");
                });
	
                $('.title').click(function(){
                    var $ul = $(this).next('ul');
                    $('dd').find('ul').slideUp();
                    if($ul.is(':visible')){
                        $(this).next('ul').slideUp();
                    }else{
                        $(this).next('ul').slideDown();
                    }
                });
            })
        </script>
    </head>
    <body style="background:#f0f9fd;">
        <div class="lefttop"></div>
        <dl class="leftmenu">
            <?php if(!empty($system)):?>
            <?php foreach($system as $key=>$value):?>
            <dd>
                <div class="title">
                    <span><img src="<?php echo base_url(); ?>images/backend/leftico01.png" /></span><?php echo $value->titel;?>
                </div>
                <ul class="menuson">
                    <?php if(!empty($value->second)):?>
                    <?php foreach($value->second as $k=>$v):?>
                    <li><cite></cite><a href="<?php echo base_url().$v->controller.'/'.$v->actionname;?>" target="rightFrame"><?php echo $v->titel;?></a><i></i></li>
                    <?php endforeach;?>
                   <?php endif;?>
                </ul>
            </dd>
            <?php endforeach;?>
            <?php endif;?>
        </dl>

    </body>
</html>
