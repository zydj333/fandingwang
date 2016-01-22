<!--<div class="banner">
    <img src="<?php echo base_url(); ?>upload/banner/201504/1430357234.jpg" alt="banner" />
</div>-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li class="active">首页</li>
    </ol>
    <div class="site-index">
        <div class="jumbotron">
            <h2>最新项目</h2>
        </div>
        <div class="body-content">
            <div class="row">
                <?php if (!empty($project)): ?>
                    <?php foreach ($project as $pro_key => $pro_value): ?>
                        <?php
                        $percent = bcdiv($pro_value->support_amount, $pro_value->amount, 5);
                        $percent_hand = bcmul($percent, 100, 2);
                        ?>
                        <div class="col-lg-4">
                            <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $pro_value->id; ?>" style="color: #333;"><h4><strong><?php echo $pro_value->title; ?></strong></h4></a>
                            <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $pro_value->id; ?>"><img src="<?php echo base_url() . $pro_value->image_url; ?>" alt="<?php echo $pro_value->title; ?>" class="img-responsive"/></a>
                            <p style="padding-top:30px;text-indent: 2em">
                                <?php echo $pro_value->discription; ?>
                            </p>
                            <!--                            <div class="progress progress-striped active">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" 
                                                                 aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent_hand; ?>%;">
                                                                <span style="color: #337ab7;font-size: 12px;line-height: 20px;text-align: center;"><?php echo $percent_hand; ?>% 完成</span>
                                                            </div>
                                                        </div>-->
                            <p class='col-lg-4' style='float:right;'>
                                <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $pro_value->id; ?>">查看详情 &raquo;</a>
                            </p>
                        </div>
                        <hr width='100%'>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--社区热帖-->
<!--<div class="container">
    <div class="site-index">
        <div class="jumbotron">
            <h2>最新资讯</h2>
        </div>
        <div class="body-content">
            <div class="row">
<?php if (!empty($article)): ?>
    <?php foreach ($article as $art_key => $art_value): ?>
                                        <div class="col-lg-4">
                                            <a href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>" style="color: #333;"><h4><strong><?php echo $art_value->title; ?></strong></h4></a>
                                            <a href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>"><img src="<?php echo base_url() . $art_value->imageurl; ?>" alt="<?php echo $art_value->title; ?>" class="img-responsive"/></a>
                                            <p style="text-indent: 2em">
        <?php echo $art_value->discription; ?>
                                            </p>
                                            <p style='text-align:center'>
                                                <a class="btn btn-default" href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>">浏览详情 &raquo;</a>
                                            </p>
                                        </div>
    <?php endforeach; ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div>-->
<!--热帖结束-->

