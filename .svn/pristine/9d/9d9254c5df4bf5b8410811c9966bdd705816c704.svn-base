<!--主体内容START-->
<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">我要发帖</h2>
                <p>记录点滴心情，泛丁时刻相伴</p>
            </div>
            <div class="body body2">
                <div class="project-mod">
                    <form method="post" id="topic_add_form" >
                    <ul class="bbsend">
                        <li><a class="ico ico_y">泛丁论坛</a></li>
                        <li class="textinp"><input type="text" placeholder="在此输入标题" name="title" id="title" /></li>
                        <li class="textar">
                            <input type="file" placeholder="上传一张封面图片" name="fileToUpload" id="fileToUpload" />
                            <input class="fr sub" id="buttonUpload" type="button" value="上传封面"  onclick="return ajaxFileUpload();" />
                        </li>
                        <br/>
                        <li class="textar">
                            <img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" />
                            <a id="imgshow" target="_blank" ></a>
                            <input type="hidden" name="image_url" id="coverimage" value="" />
                        </li>
                         <br/>
                        <!--<li>
                            <span class="title">分类标签：</span>
                            <a class="ico ico_g" href="#">泛丁日记</a>
                            <a class="ico ico_g" href="#">创客日记</a>
                            <a class="ico ico_g" href="#">媒体报道</a>
                            <a class="ico ico_g" href="#">官方活动</a>
                            <a class="ico ico_g" href="#">泛丁论坛</a>
                        </li>-->
                        <li class="textar"><textarea name="content" id="content" width="100%" height="441"></textarea></li>
                        <li class="textar"><input class="fr sub" id="topic_add_button" type="button" value="发布帖子" /></li>
                    </ul>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/backend/ajaxfileupload.js"></script>
<script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
<script type="text/javascript">
    $(function() {
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                resizeType: 1,
                allowPreviewEmoticons: true,
                allowImageUpload: true,
                imageTabIndex:1,
                pasteType : 1,
                items: [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
                width: "100%",
                height: "441px"
            });
        });
        //进行添加
        $("#topic_add_button").click(function() {
        editor.sync();
        $.ajax({
            type: "POST",
            url: "/bbs/saveTopic/" + Math.random(),
            data: $("#topic_add_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $.dialog.alert(data.error);
                    location.href = '/bbs/index';
                } else {
                    $.dialog.alert(data.error);
                }
            }
        });
    });
        
        
        
    });
    
    
    function ajaxFileUpload(){
                $("#loading")
                .ajaxStart(function(){
                    $(this).show();
                })
                .ajaxComplete(function(){
                    $(this).hide();
                });
                $.ajaxFileUpload
                (
                {
                    url:'/admin_image/upload',
                    secureuri:false,
                    fileElementId:'fileToUpload',
                    dataType: 'json',
                    data:{imagetype:'bbsmod'},
                    success: function (data, status)
                    {
                        if(data.flag===0){
                            $.dialog.alert(data.error);
                        }else{
                            var temp = '<img src="/'+data.imgurl_middle+'" width="500" height="300" />';
                            $('#imgshow').html(temp);
                            $('#coverimage').val(data.imgurl);
                            $('#imgshow').attr('href','/'+data.imgurl);
                        }
                    },
                    error: function (data, status, e)
                    {
                       $.dialog.alert(e);
                    }
                }
            )
                return false;
            }
</script>