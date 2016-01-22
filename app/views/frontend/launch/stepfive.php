<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">发起众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="img"> <img src="<?php echo base_url(); ?>images/step5.png" /> </div>
            </div>
            <div class="body body5">
                <div class="hd yh">项目：<?php echo $pro->title;?></div>
                <div class="bd"><input type="hidden" value="<?php echo $pro->id;?>" name="product_id" id="product_id" />
                    <div class="img"><img src="<?php echo base_url(); ?>images/img_01.png" /></div>
                    <p>您的项目信息填写完成！是否立刻申请上线审核？</p>
                    <p><img id="loading" src="<?php echo base_url(); ?>images/backend/loading.gif" style="display:none;" /></p>
                    <input type="text" value="确认提交审核" class="btn yh" type="button" id="submit_myproject_tosystem"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/launch.js" ></script>