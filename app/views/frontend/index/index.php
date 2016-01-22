
<!--END-->

<!--海报START-->
<?php if (!empty($banner)): ?>
    <div class="banner">
        <ul id="slider">
            <?php foreach ($banner as $banner_key => $banner_values): ?>
                <li style="background-image:url(<?php echo base_url() . $banner_values->imageurl; ?>)"><a href="<?php echo $banner_values->link ?>" target="_blank"></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<!--END-->

<!--项目列表START-->
<div class="project">
    <div class="box">
        <div class="title">
            <h1>泛丁推荐</h1>
        </div>
        <div class="nav">
            <ul class="left">
                <li class="now">最新</li>
                <li><a href="<?php echo base_url() . 'project/index/1'; ?>">预热</a></li>
                <li><a href="<?php echo base_url() . 'project/index/2'; ?>">已成功</a></li>
                <li><a href="<?php echo base_url() . 'project/collect'; ?>">收藏</a></li>
            </ul>
            <ul class="right">
                <li class="more"><a href="<?php echo base_url(); ?>project">&lt;&lt; 更多项目</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <?php if (!empty($product)): ?>
            <?php foreach ($product as $product_key => $product_values): ?>
                <div class="item">
                    <div class="left" style="background-image:url(<?php echo base_url() . $product_values->image_url; ?>)">
                        <a class="<?php if($product_values->starttime<=time()&&$product_values->endtime>= time()):?>process<?php elseif($product_values->starttime>=  time()):?>waitingstart<?php else:?>overed<?php endif;?>" title="<?php echo $product_values->title;?>" target="_blank" href="<?php echo base_url(); ?>project/detial/<?php echo $product_values->id; ?>"></a>
                        <div class="bg"></div>
                    </div>
                    <div class="right">
                        <div class="ti">
                            <h2><?php echo $product_values->title; ?></h2>
                            <?php if ($product_values->account != ''): ?><?php echo $product_values->account; ?><?php else: ?>官方发布<?php endif; ?><span><?php echo $product_values->addtime; ?></span>
                            <a class="fav" title="点击收藏" href="javascript:void(0);" onclick="return docollect(<?php echo $product_values->id; ?>);"></a>
                        </div>
                        <div class="con">
                            <?php echo $product_values->discription; ?>
                        </div>
                        <div class="more">
                            <a class="cor_fc0" title="<?php echo $product_values->title;?>" target="_blank" href="<?php echo base_url(); ?>project/detial/<?php echo $product_values->id; ?>">&gt;&gt;更多内容</a>
                        </div>
                        <div class="rate">
                            <ul>
                                <li>已达<?php echo bcmul(bcdiv($product_values->support_amount, $product_values->amount, 5), 100, 0) ?>%</li>
                                <li>已筹集<?php echo $product_values->support_amount; ?>元</li>
                                <li>支持者<?php echo $product_values->support_times; ?>人</li>
                                <li><?php echo $product_values->timer ?></li>
                            </ul>
                        </div>
                        <?php 
                        $persent=bcdiv($product_values->support_amount, $product_values->amount, 5);
                        if($persent>=1){
                            $persent=1;
                        }
                        ?>
                        <div class="bar" style="width:<?php echo bcmul($persent, 100, 0) ?>%"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="clear"></div>
    </div>
</div>
<!--END-->

<!--社区热帖START-->
<div id="share" class="share">
    <div class="box">
        <div class="title">
            <h1>资讯分享</h1>
            在这里发起你对践行泛丁式生活的倡议，在这里，证明互联网也可以有温暖
            <div class="more">
                <a class="cor_fc0" href="<?php echo base_url(); ?>shequ/index">&gt;&gt; 了解更多</a>
            </div>
        </div>

        <?php if(!empty($topic)):?>
        <?php foreach($topic as $top_key=>$top_value):?>
        <div class="block" <?php if(($top_key+1)%3==0):?>style="margin-right:0<?php endif;?>"><!--images/share_0<?php echo $top_key+1;?>.jpg-->
            <div class="pic" style="background-image:url(<?php echo base_url().$top_value->imageurl; ?>)">
                <a href="<?php echo base_url(); ?>shequ/detial/<?php echo $top_value->id;?>">
                    <div class="ti"><?php echo $top_value->title; ?></div>
                </a>
            </div>
            <div class="info">
                <div class="head"><img src="<?php echo base_url(); ?>images/footlogo.png" /></div>
                <div class="name"><a href="javascript:void(0);">最新资讯</a><span class="time"><?php echo date('Y-m-d',  strtotime($top_value->addtime)); ?></span></div>
                <div class="count">
                    <span class="ico browse"><?php echo $top_value->views;?></span>
                    <span class="ico comment"><?php echo $top_value->replay;?></span>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>

        <div class="clear"></div>
    </div>
</div>
<!--END-->

<!--泛丁服务START-->
<div id="service" class="service">
    <div class="box">
        <div class="title">
            <h1>泛丁服务</h1>
            泛丁针对中小微企业提供系统全面的媒体公关，项目或产品的资金众筹等服务。为创业家、<br />产品家节省更多的时间和精力。
            <div class="more">
                <a class="cor_fc0" href="#">&gt;&gt; 了解更多</a>
            </div>
        </div>

        <div class="block ico01">
            <dl>
                <dt>创新的PR服务</dt>
                <dd>深度挖掘每一个项目和产品爆点，以独特的视角和思维策划文案及事件，并通过多方面的新媒体及传统媒体渠道进行传播推广。</dd>
            </dl>    
        </div>
        <div class="block ico02">
            <dl>
                <dt>高效的资金众筹</dt>
                <dd>以最高效、最低成本的方法帮助每一位创业者解决当前阶段所需资金，为企业下一步发展甚至下一轮融资做好铺垫。</dd>
            </dl>    
        </div>
        <div class="block ico03">
            <dl>
                <dt>优秀的创投人脉</dt>
                <dd>聚集最特立独行，最具创新思维，最"孤独"也是最优秀的创业者和投资人，实现智慧的碰撞，资源的整合。</dd>
            </dl>    
        </div>

        <div class="clear"></div>
    </div>
</div>
<!--END-->

<!--浮动登录START-->
<script type="text/javascript">
    $(function() {
        var type = 'getuser';
        $.ajax({
            type: "POST",
            url: "/common/getUserLoginSession/" + Math.random(),
            data: {'type': type},
            dataType: "json",
            success: function(data) {
                if (data.user_id > 0) {
                    $('.floatlogin').hide();
                } else {
                    if (readCookie("floatloginCookie") != 1) {
                        $(".floatlogin").delay(1000).fadeIn(600);
                    }

                    $(".floatlogin .close").click(function() {
                        writeCookie("floatloginCookie", 1, 24); //有效期1天
                        $(this).parent().fadeOut(600);
                    });
                }
            }
        });
        
         $.ajax({
            type: "GET",
            url: "/sina/sinaLogin/" + Math.random(),
            dataType: "json",
            success: function(data) {
                $('.weibo').attr('href',data.error);
            }
        });
        
        $(".douban").attr('href','https://open.weixin.qq.com/connect/qrconnect?appid=wxe584a7820fd54074&redirect_uri=http%3A%2F%2Fwww.fandingwang.com%2Fwechatlogin%2Findex&response_type=code&scope=snsapi_login&state=wechat_logon#wechat_redirect');
   
    });

//     var childWindow;
//    function toQzoneLogin(){
//        childWindow = window.open("tencent/createUrl","TencentLogin","width=1024,height=500,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
//    }

//    function closeChildWindow(){
//        childWindow.close();
//    }
</script>
<div class="floatlogin">
    <div class="bg"></div>
    <div class="box">
        <a class="text"></a>
        <a class="douban" href="#" target="_blank"></a>
        <a class="qq" href="<?php echo base_url('tencent/createUrl');?>"></a>
        <a class="weibo" href="#"></a>
        <a class="mail" href="<?php echo base_url();?>register"></a>
    </div>
    <a href="javascript:;" class="close"></a>
</div>
<!--END-->