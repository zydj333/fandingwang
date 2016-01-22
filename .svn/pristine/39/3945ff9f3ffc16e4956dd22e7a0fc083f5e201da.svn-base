<!DOCTYPE html>
<html lang="en-US">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>支付确认页面</title>
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/site.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
</head>

<body>
    <div class="container">
        <div class="list-group col-lg-12">
            <form class="form-horizontal" role="form"  id="form_pay" name="form_pay" action="<?php echo $server_url; ?>" method="get">
                <div class="form-group">
                    <div class="alert alert-danger col-sm-12" style="text-align: center;" id="error_display">页面即将跳转到支付宝，如果您已经确认要付款，请直接点击下面的‘去付款’到支付宝完成支付。</div>
                </div>
                <?php foreach ($para as $key => $val): ?>
                    <input type='hidden' name='<?php echo $key; ?>' value='<?php echo $val; ?>'/>
                <?php endforeach; ?>
                <div class="form-group">
                    <button type="submit"  class="btn btn-primary col-lg-12  btn-block">去付款</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>