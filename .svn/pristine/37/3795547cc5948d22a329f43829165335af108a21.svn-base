<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>mobile/index">泛丁首页</a></li>
        <li><a href="<?php echo base_url(); ?>mobile/project">浏览项目</a></li>
        <li class="active">项目列表</li>
    </ol>
<!--    <div class="col-lg-12">
        <a class="col-lg-4 btn btn-<?php if($status==1):?>success<?php else:?>default<?php endif;?>" href="<?php echo base_url(); ?>mobile/project/1">正在众筹</a>
        <a class="col-lg-4 btn btn-<?php if($status==2):?>success<?php else:?>default<?php endif;?>" href="<?php echo base_url(); ?>mobile/project/2">预热项目</a>
        <a class="col-lg-4 btn btn-<?php if($status==3):?>success<?php else:?>default<?php endif;?>" href="<?php echo base_url(); ?>mobile/project/3">已经结束</a>
    </div>-->
    <div class="row">
        <?php if (!empty($project)): ?>
            <?php foreach ($project as $key => $value): ?>
                      <?php
                        $percent = bcdiv($value->support_amount, $value->amount, 5);
                        $percent_hand = bcmul($percent, 100, 2);
                        ?>
                <div class="col-lg-4">
                    <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $value->id; ?>" style="color: #333;"><h4><strong><?php echo $value->title;?></strong></h4></a>
                    <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $value->id; ?>"><img src="<?php echo base_url().$value->image_url;?>" alt="<?php echo $value->title;?>" class="img-responsive"/></a>
                    <p style="padding-top:30px;text-indent: 2em">
                        <?php echo $value->discription; ?>
                    </p>
<!--                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" 
                             aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent_hand; ?>%;">
                            <span style="color: #337ab7;font-size: 12px;line-height: 20px;text-align: center;"><?php echo $percent_hand; ?>% 完成</span>
                        </div>
                    </div>-->
<!--                    <p style="text-align:center">
                        <a class="btn btn-success" href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $value->id; ?>">浏览详情 &raquo;</a>
                    </p>-->
<p class='col-lg-4' style='float:right;'>
                                <a href="<?php echo base_url(); ?>mobile/projectDetial/<?php echo $value->id; ?>">查看详情 &raquo;</a>
                            </p>
                </div>
        <hr width='100%'>
            <?php endforeach; ?>
        <?php else:?>
        <div class="col-lg-4"><p style="text-align:center">没有相应项目！</p></div>
        <?php endif;?>
    </div>
    <?php if($count>$pagesize):?>
    <div class="col-lg-12" id="pagelist">
        <p style='text-align:center'>
            <input type="hidden" name="project_status" id="project_status" value="<?php echo $status;?>" />
            <input type="hidden" name="project_start" id="project_start" value="<?php echo $start;?>" />
            <a class="btn btn-default btn-lg btn-block" href="javascript:void(0)" id="viewMore">查看更多 &raquo;</a>
        </p>
    </div>
    <?php endif;?>
</div>
<script type="text/javascript">
    $(function(){
       $("#viewMore").click(function(){
           var start=$("#project_start").val();
           var status=$("#project_status").val();
          $.ajax({
            type: "POST",
            url: "/mobile/projectAjaxList/" + Math.random(),
            data: {'start':start,'status':status},
            dataType: "json",
            success: function(data) {
                if(data.flag===1){
                    var str='';
                    $.each(data.list, function(key, values) {
                    str+='<div class="col-lg-4">';
                    str+='<a href="/mobile/projectDetial/'+values.id+'" style="color: #333;"><h4><strong>'+values.title+'</strong></h4></a>';
                    str+='<a href="/mobile/projectDetial/'+values.id+'"><img src="/'+values.image_url+'" alt="'+values.title+'" class="img-responsive"/></a>';
                    str+='<p style="text-indent: 2em">'+values.discription+'</p>';
                    str+='<div class="progress progress-striped active">';
                    str+='<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" ';
                    str+='aria-valuemin="0" aria-valuemax="100" style="width: '+values.percent+'%;">';
                    str+='<span style="color: #337ab7;font-size: 12px;line-height: 20px;text-align: center;">'+values.percent+'% 完成</span>';
                    str+='</div>';
                    str+='</div>';
                    str+='<p style="text-align:center">';
                    str+='<a class="btn btn-success" href="/mobile/projectDetial/'+values.id+'">浏览详情 &raquo;</a>';
                    str+='</p>';
                    str+='</div>';
                    });
                    $(".row").append(str);
                    $("#project_start").val(data.start);
                    if(data.maxsearch>=data.count){
                        $("#pagelist").hide();
                    }
                }else{
                    $("#pagelist").hide();
                }
            }
        });
       });
    });
</script>