<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/project">浏览项目</a></li>
        <li class="active"><?php echo $project->title; ?></li>
    </ol>
    <div class="page-header">
        <h3 class="col-lg-12">产品信息</h3>
    </div>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-6">
            <a class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url() . $project->image_url; ?>" alt="<?php echo $project->title; ?>"/>
            </a>
            <h3 class="list-group-item-heading"><?php echo $project->title; ?></h3>
            <p class="list-group-item-text">&nbsp;&nbsp;<?php echo $project->discription; ?></p>
        </div>
    </div>
    <div class="page-header">
        <h3 class="col-lg-12">订单信息</h3>
    </div>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <div class="col-lg-12" style="padding-bottom: 10px;" ><h4>订单编号：<strong><?php echo $order->order_num; ?></strong></h4></div>
            <div class="col-lg-12" style="padding-bottom: 10px;" ><h4>收货人：<strong><?php echo $order->username; ?></strong></h4></div>
            <div class="col-lg-12" style="padding-bottom: 10px;" ><h4>手机号码：<strong><?php echo $order->cellphone; ?></strong></h4></div>
            <div class="col-lg-12" style="padding-bottom: 10px;" ><h4>收货地址：<strong><?php echo $order->province_name . $order->city_name . $order->area_name . $order->address; ?></strong></h4></div>
            <div class="col-lg-12" style="padding-bottom: 10px;" ><h4>备注：<strong><?php echo $order->suggest; ?></strong></h4></div>
        </div>
    </div>
</div>
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr class="active">
                <th style="text-align: center;">项目名称</th>
                <td><?php echo $project->title; ?></td>
<!--                <th>回报</th>
                <th>支持单价</th>
                <th>数量</th>
                <th>运费</th>
                <th>合计</th>
                <th>创建时间</th>-->
            </tr>
            <tr class="active">
                <th style="text-align: center;">发起人</th>
                <td><?php if ($project->account != ''): ?><?php echo $project->account; ?><?php else: ?>官方发布<?php endif; ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center; vertical-align:middle;">回报</th>
                <td><?php echo str_replace("\n", "<br/>", $items->replay); ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center;">支持</th>
                <td>¥<?php echo $order->price; ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center;">数量</th>
                <td><?php echo $order->buy_number; ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center;">运费</th>
                <td>¥<?php echo $order->mail_fee; ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center;">合计</th>
                <td>¥<?php echo $order->total_amount; ?></td>
            </tr>
            <tr class="active">
                <th style="text-align: center;">创建时间</th>
                <td><?php echo date('Y-m-d H:i:s', $order->addtime); ?></td>
            </tr>
        </thead>
    </table>
    <div class="list-group col-lg-12">
        <div class="list-group-item col-lg-12">
            <h3 class="list-group-item-heading">共计<?php if ($order->step_status < 2): ?>需要<?php elseif ($order->step_status == 2): ?>已经<?php endif; ?>支付<span style="color: red">&nbsp;&nbsp;¥&nbsp;<?php echo $order->total_amount; ?></span></h3>
        </div>
    </div>
</div>
<?php if ($order->step_status < 2): ?>
    <div class="container">
        <div class="list-group col-lg-12">
            <div class="list-group-item col-lg-12">
                <h3 class="list-group-item-heading">支付方式</h3>
                <p class="list-group-item-text">目前仅支持支付宝支付</p>
            </div>
        </div>
        <p>
            <a href="<?php echo base_url();?>mobile/orderpay/<?php echo $order->order_num;?>" class="btn btn-primary col-lg-6  btn-block">立即付款</a>
            <?php if ($order->step_status == 0): ?><a href="<?php echo base_url();?>mobile/supportEdit/<?php echo $order->order_num;?>" class="btn btn-default col-lg-6  btn-block">修改订单</a><?php endif; ?>
        </p>
    </div>
<?php endif; ?>