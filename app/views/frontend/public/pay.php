<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>请等待...</title>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
</head>

<body onload="document.form_pay.submit()">
	<p>跳转中...</p>

	<form id="form_pay" name="form_pay" action="<?php echo $server_url; ?>" method="post">
		<?php foreach ($para as $key => $val) { ?>
                    <input type='hidden' name='<?php echo $key; ?>' value='<?php echo $val; ?>'/>
                <?php } ?>
	</form>
</body>
</html>