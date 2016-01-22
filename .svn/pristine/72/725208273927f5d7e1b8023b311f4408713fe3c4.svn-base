<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/center">用户中心</a></li>
        <li class="active">我的订单</li>
    </ol>
    <div class="page-header">
        <h2 class="col-lg-12" style="text-align: center;"><strong>订单列表</strong></h2>
    </div>
    <div class="col-lg-12">
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/center">个人资料</a>
        <a class="col-lg-4 btn btn-success" href="<?php echo base_url(); ?>mobile/orderList">我的订单</a>
        <a class="col-lg-4 btn btn-default" href="<?php echo base_url(); ?>mobile/addressList">收货地址</a>
    </div>
    <div class="col-lg-12">

        <?php if (!empty($order)): ?>
            <?php foreach ($order as $key => $value): ?>
                <table class="table table-hover table-bordered col-lg-12">
                    <tbody>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <!--<td><img src="" alt="项目图片"/></td>-->
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">订单号</th>
                            <td><a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>"><?php echo $value->order_num; ?></a></td>
                        </tr>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">项目名称</th>
                            <td><a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>"><?php echo $value->pname; ?></a></td>
                        </tr>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">订单总金额</th>
                            <td>¥<?php echo $value->total_amount; ?></td>
                        </tr>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">订单状态</th>
                            <td><?php if ($value->step_status == 2): ?><span style="color:red;">已支付</span><?php elseif ($value->step_status == 1): ?><a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>"><span style="color:blue;">待支付</span></a><?php else: ?><a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>"><span style="color:gray;">待确认</span><?php endif; ?></a></td>
                        </tr>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">生成时间</th>
                            <td><?php echo date('Y-m-d H:i:s', $value->addtime); ?></td>
                        </tr>
                        <tr class="<?php if ($value->step_status == 2): ?>success<?php elseif ($value->step_status == 1): ?>danger<?php else: ?>active<?php endif; ?>">
                            <th class="col-lg-2" style="text-align: center; vertical-align:middle;">操作</th>
                            <td><a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>">查看</a> <?php if ($value->step_status == 0 || $value->step_status == 1): ?> / <a href="<?php echo base_url(); ?>mobile/orderConform/<?php echo $value->order_num; ?>">去支付</a><?php endif; ?><a href="javascript:void(0);" class="tablelink"  onclick="return del(<?php echo $value->id; ?>);">&nbsp;&nbsp;删除订单</a></td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
<script type="text/javascript">
    function del(id) {
                $.ajax({
                    url: '/mobile/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/mobile/orderList";
                    },
                    cache: false
                });
            }
</script>