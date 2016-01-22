<!--社区热帖-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/article">泛丁资讯</a></li>
        <li class="active">资讯列表</li>
    </ol>
    <h2 class="list-group-item-heading col-lg-12" style="text-align: center;"><strong>资讯列表</strong></h2>
    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <?php if (!empty($article)): ?>
                    <?php foreach ($article as $art_key => $art_value): ?>
                        <div class="col-lg-4">
                            <a href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>" style="color: #333;"><h4><strong><?php echo $art_value->title; ?></strong></h4></a>
                            <a href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>"><img src="<?php echo base_url() . $art_value->imageurl; ?>" alt="<?php echo $art_value->title; ?>" class="img-responsive"/></a>
                            <p style="padding-top:30px;text-indent: 2em">
                                <?php echo $art_value->discription; ?>
                            </p>
<!--                            <p style='text-align:center'>
                                <a class="btn btn-info btn-block" href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>">浏览详情 &raquo;</a>
                            </p>
                        </div>-->
                <p class='col-lg-4' style='float:right;'>
                                <a href="<?php echo base_url(); ?>mobile/articleDetial/<?php echo $art_value->id; ?>">查看详情 &raquo;</a>
                            </p>
                        </div>
                        <hr width='100%'>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-lg-12">
                        <p>没有资讯信息。</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($count >= $pagestart): ?>
                <div id="pagelist">
                    <p class="col-lg-12">
                        <input type="hidden" name="pagestart" id="pagestart" value="<?php echo $pagestart; ?>" />
                        <button type="button" class="btn btn-default btn-block" id="article_more">浏览更多</button>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--热帖结束-->
<script type="text/javascript">
    $(function() {
        $("#article_more").click(function() {
            var start = $("#pagestart").val();
            $.ajax({
                type: "POST",
                url: "/mobile/getArticleAjaxList/" + Math.random(),
                data: {'start': start},
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        var str = '';
                        $.each(data.list, function(key, values) {
                            str += '<div class="col-lg-4">';
                            str += '<a href="/mobile/articleDetial/' + values.id + '" style="color: #333;"><h4><strong>' + values.title + '</strong></h4></a>';
                            str += '<a href="/mobile/articleDetial/' + values.id + '"><img src="/' + values.imageurl + '" alt="' + values.title + '" class="img-responsive"/></a>';
                            str += '<p style="text-indent: 2em">'+values.discription+'</p>';
                            str += '<p class="col-lg-4 style="float:right;">';
                            str += '<a href="/mobile/articleDetial/' + values.id + '">浏览详情 &raquo;</a>';
                            str += '</p>';
                            str += '</div>';
                        });
                        $(".row").append(str);
                        $("#pagestart").val(data.pagestart);
                        if (data.pagestart >= data.count) {
                            $("#pagelist").hide();
                        }
                    } else {
                        $("#pagelist").hide();
                    }
                }
            });
        });
    });
</script>