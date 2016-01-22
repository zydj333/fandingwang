<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>css/style.css"  rel="stylesheet" type="text/css"  />
        <style type="text/css" >
            .yesbtn{
                background: none repeat scroll 0 0 #ffcc00;
                border: medium none;
                border-radius: 5px;
                color: #fff;
                cursor: pointer;
                display: inline-block;
                font-size: 16px;
                height: 45px;
                line-height: 45px;
                text-align: center;
                width: 175px;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <form method="post" action="<?php echo base_url(); ?>launch/saveFeed" id="feed_save_form">
            <div class="body">
                <ul class="form-ul">
                    <li><textarea name="content" id="content" cols="80" rows="5" ></textarea></li>
                    <li><input type="hidden" name="product_id" id="product_id" value="<?php echo $p_id; ?>" /></li>
                    <li><input type="button" id="save_feed"  class="yesbtn" value="保存"/></li>
                </ul>
            </div>
        </form>
    </body>
    <script type="text/javascript" >
        $(function() {
            $('#save_feed').click(function() {
                var pid=$('#product_id').val();
                $.ajax({
                    type: "POST",
                    url: "/launch/saveFeed/" + Math.random(),
                    data: $("#feed_save_form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.flag === 1) {
                            location.href='/launch/steptwo/'+pid;
                        } else {
                            alert(data.error);
                        }
                    }
                });
            });
        });
    </script>
</html>