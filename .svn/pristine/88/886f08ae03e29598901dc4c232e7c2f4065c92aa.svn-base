<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/project">浏览项目</a></li>
        <li class="active"><?php echo $project->title; ?></li>
    </ol>
    <div class="row">
        <div class="col-lg-12" style="padding-bottom: 20px;" ><h4>项目详情</h4></div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="float: none;">
            <!--<?php if ($project->source_video != ''): ?>
                <embed src="<?php echo $project->source_video; ?>" allowFullScreen="true" quality="high" width="350px" height="250px" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
            <?php endif; ?>-->
            <?php
            echo preg_replace('/<img[^>]*src=[\'"]?([^>\'"\s]*)[\'"]?[^>]*>/ie', "wap_img('$1')", $project->content);

            function wap_img($url) {
                return '<img src="' . $url . '" class="img-responsive">';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"><h4>立即参与</h4></div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="float: none;">
            <?php if ($project->is_success == 1): ?>
                项目在<?php echo date('Y-m-d H:i:s', $project->endtime); ?>结束,无论是否达到设定筹资目标均为成功，所有已产生的支持金额均为有效订单；发起者将在项目结束后的承诺时间内实施相关回报。
            <?php else: ?>
                项目须在 <?php echo date('Y-m-d H:i:s', $project->endtime); ?> 前达到 ¥<?php echo $project->amount; ?> 元目标金额才算成功，否则已支持订单将取消；订单取消时已支持金额将自动退还到您的个人账户。 
            <?php endif; ?>
        </div>
        <!--        <div class="rate">
                                <ul>
                                    <li>已达<?php echo bcmul(bcdiv($project->support_amount, $project->amount, 5), 100, 0) ?>%</li>
                                    <li>支持者<?php echo $project->support_times; ?>人</li>
                                    <li><?php echo $project->addtime ?></li>
                                </ul>
                            </div>-->
    </div>
    <!--<div class="row">
        <div class="col-lg-12"><h4>已达<?php echo bcmul(bcdiv($project->support_amount, $project->amount, 5), 100, 0) ?>%</h4></div>
        <div class="col-lg-12"><hr align="left" style="border:none;border-top:2px solid #7AA9D0;width:<?php
    $percent = bcdiv($project->support_amount, $project->amount, 5);
    if ($percent > 1) {
        $percent = 1;
    }
    echo bcmul($percent, 100, 0);
    ?>%;"></div>
    </div>-->
    <div class="row">
        <div class="col-lg-12" style="padding-bottom: 10px; padding-top: 10px">
            <a class="col-lg-12 btn btn-primary disabled">目标金额：¥ <?php echo $project->amount; ?></a>
        </div>
        <div class="col-lg-12" style="padding-bottom: 10px; padding-top: 10px">
            <a class="col-lg-12 btn btn-success disabled">支持人数：<?php echo $project->support_times; ?>人次</a>
        </div>
        <div class="col-lg-12" style="padding-bottom: 10px; padding-top: 10px">
            <a class="col-lg-12 btn btn-warning disabled">已完成：¥ <?php echo $project->support_amount; ?></a>
        </div>
        <div class="col-lg-12" style="padding-bottom: 20px; padding-top: 20px">
            <?php $now = time(); ?>
            <?php if ($project->starttime <= $now && $project->endtime > $now): ?>
                <?php if (empty($member)): ?>
                    <p><a class="col-lg-12 btn btn-primary btn-lg btn-block" role="button" href="<?php echo base_url(); ?>mobile/login" >登录后支持</a></p>
                <?php endif; ?>
            <?php elseif ($project->starttime > $now): ?>
                <p><button type="button" class="col-lg-12 btn btn-warning btn-lg btn-block" role="button">预热中</button></p>
            <?php else: ?>
                <p><button type="button" class="col-lg-12 btn btn-danger btn-lg btn-block" role="button">已结束</button></p>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($items)): ?>
        <?php foreach ($items as $items_key => $items_value): ?>
            <div class="row">
                <div class="col-lg-12" style="float: none;">
                    <div class="list-group col-lg-12">
                        <div class="list-group-item col-lg-12">
                            <h3 class="list-group-item-heading">支持¥<?php echo $items_value->price; ?></h3>
                            <p class="list-group-item-text"><?php echo $items_value->replay; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="float: none;">
                    <div class="list-group col-lg-12">
                        <span  class="col-lg-6 label label-success">已支持：<?php echo $items_value->sell_total; ?>人/<?php echo $items_value->total; ?></span>
                        <!--<span  style=" float: right"><a class="col-lg-6 label btn-primary btn-block">支&nbsp;持</a></span>-->
                        <?php if (!empty($member)): ?>
                            <?php if ($project->starttime <= $now && $project->endtime > $now): ?>
                        <p style=" float: right"><a class="col-lg-6 btn btn-primary btn-block <?php if ($items_value->sell_total >= $items_value->total): ?>disabled<?php endif; ?>" role="button" <?php if ($items_value->sell_total < $items_value->total): ?>href="/mobile/support/<?php echo $items_value->id; ?>"<?php endif; ?>>支&nbsp;持</a></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
<script src="http://qzonestyle.gtimg.cn/open/qcloud/video/h5/fixifmheight.js" charset="utf-8"></script>