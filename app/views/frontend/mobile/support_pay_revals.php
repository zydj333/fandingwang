<div class="container">
    <div class="list-group col-lg-12">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="alert alert-info col-sm-12" style="text-align: center;"><?php echo $out;?></div>
            </div>
            <div class="form-group">
                <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $order->pid; ?>"  class="btn btn-primary col-lg-12  btn-block">浏览项目</a>
                <a href="<?php echo base_url(); ?>mobile/center"  class="btn btn-default col-lg-12  btn-block">个人中心</a>
            </div>
        </form>
    </div>
</div>