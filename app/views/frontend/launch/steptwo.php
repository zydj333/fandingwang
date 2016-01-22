<script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">发起众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="img"> <img src="<?php echo base_url(); ?>images/step2.png" /> </div>
            </div>
            <div class="body body2">
                <form method="post" action="<?php echo base_url(); ?>launch/saveStepTwo" id="save_step_two_form">
                    <div class="project-mod project-info">
                        <div class="hd">
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $pro->id; ?>" />
                            <h3><strong class="ico1 yh">项目介绍</strong></h3>
                        </div>
                        <div class="bd"><textarea name="content" id="content" width="851" height="441"><?php echo $pro->content; ?></textarea></div>
                    </div>
                </form>
                <div class="project-mod project-news">
                    <div class="hd"><span><a href="javascript:void(0);" class="add-btn" id="add_feed_content">添加</a></span>
                        <h3><strong class="ico2 yh">项目大事记</strong></h3>
                    </div>
                    <?php if (!empty($feed)): ?>
                        <div class="bd">
                            <table width="100%">
                                <tr>
                                    <th scope="col">时间</th>
                                    <th scope="col">内容</th>
                                </tr>
                                <?php foreach ($feed as $feed_key => $feed_values): ?>
                                    <tr>
                                        <td class="time"><?php echo date('Y-m-d H:i:s', $feed_values->addtime); ?></td>
                                        <td class="info"><?php echo $feed_values->content; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                    <div class="ft"> <a href="<?php echo base_url(); ?>launch/editStepOne/<?php echo $pro->id; ?>" class="prev">上一步</a> <a href="javascript:void(0);" class="next"  id="save_step_two_button" >下一步</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/launch.js" ></script>
<script type="text/javascript">
    $(function() {
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                resizeType: 1,
                allowPreviewEmoticons: true,
                allowImageUpload: true,
                imageTabIndex: 1,
                items: [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'multiimage', 'link'],
                width: "800px",
                height: "441px"
            });
        });

        //保存第二步
        $("#save_step_two_button").click(function() {
            editor.sync();
            $('#save_step_two_form').submit();
        });
    });
</script>