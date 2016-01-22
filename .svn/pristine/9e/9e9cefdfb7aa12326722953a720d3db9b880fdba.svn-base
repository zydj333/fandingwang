<!--社区热帖-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/article">泛丁资讯</a></li>
        <li class="active"><?php echo $news->title ?></li>
    </ol>
    <h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>资讯内容</strong></h2>
    <div class="site-index">
        <div class="body-content">
            <div class="col-lg-12">
                <p class="thumbnail">
                    <?php echo preg_replace('/<img[^>]*src=[\'"]?([^>\'"\s]*)[\'"]?[^>]*>/ie', "wap_img('$1')", $news->content); ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php

function wap_img($url) {
    return '<img src="' . $url . '" class="img-responsive">';
}
?>