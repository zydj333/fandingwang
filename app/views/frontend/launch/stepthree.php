<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">发起众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="img"> <img src="<?php echo base_url(); ?>images/step3.png" /> </div>
            </div>
            <div class="body body2">
                <form method="post" action="<?php echo base_url(); ?>launch/saveStepThree">
                <div class="project-mod project-upload">
                    <div class="item"> 
                        <div class="hd">
                            <h3><strong class="ico3 yh">宣传图片</strong></h3>
                        </div>
                        <div class="bd">
                            <input type="file" name="fileToUpload" id="fileToUpload" value="" />
                            <input type="button" value="上传" class="button btn yh"  id="buttonUpload"  onclick="return ajaxFileUpload();"  />
                        </div>
                    </div>
                    <div class="item"> 
                        <div class="hd">
                            <h3><strong class="yh">图片效果</strong></h3>
                        </div>
                        <div class="bd">
                            <img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                            <a id="imgshow" target="_blank" href="<?php echo base_url().$pro->banner;?>" ><?php if($pro->banner==''):?>等待上传<?php else: ?><img src="<?php echo base_url().$pro->banner;?>" width="100" height="30" /><?php endif;?></a>
                            <input type="hidden" name="image_url" id="coverimage" value="<?php echo $pro->banner;?>" />
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $pro->id;?>" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="hd">
                            <h3><strong class="ico4 yh">上传视频</strong></h3>
                        </div>
                        <div class="bd"><input type="text" name="source_video" id="source_video" class="text" value="<?php echo $pro->source_video;?>" placeholder="粘贴视频地址视频，仅支持优酷、土豆视频" /></div>
                    </div>
                    <div class="btns"><input type="submit" class="submit" value="下一步" /></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
<script type="text/javascript">
    function ajaxFileUpload() {
        $("#loading").show();
        $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'fileToUpload',
                dataType: 'json',
                data: {imagetype: 'products'},
                success: function(data, status)
                {
                    $("#loading").hide();
                    if (data.flag === 0) {
                        $.dialog.alert(data.error);
                    } else {
                        var temp = '<img src="/' + data.imgurl_thumb + '" width="100" height="30" />';
                        $('#imgshow').html(temp);
                        $('#coverimage').val(data.imgurl);
                        $('#imgshow').attr('href', '/' + data.imgurl);
                    }
                },
                error: function(data, status, e)
                {
                    $.dialog.alert(e);
                }
               });
        return false;
    }
</script>