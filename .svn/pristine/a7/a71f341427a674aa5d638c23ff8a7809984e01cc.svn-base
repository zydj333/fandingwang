
<!--END-->

<?php if(!empty($banner)):?>
<!--海报START-->
<!--
<?php foreach($banner as $banner_key=>$banner_values):?>
<div class="probanner" style="background-image:url(<?php echo base_url().$banner_values->imageurl;?>)">
<?php endforeach;?>
    <div class="box">
        <ul>
        	<li class="li01">
            	<dl>
                	<dt>飞翔</dt>
                    <dd>人类最初的梦想</dd>
                </dl>
            </li>
        	<li class="li02">
            	<dl>
                	<dt>创造</dt>
                    <dd>只要你想，只要你能</dd>
                </dl>
            </li>
        	<li class="li03">
            	<dl>
                	<dt>实践</dt>
                    <dd>Just do it</dd>
                </dl>
            </li>
        	<li class="li04">
            	<dl>
                	<dt>共鸣</dt>
                    <dd>大不自多，海纳江河</dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
-->
<!--END-->

<!--海报START-->
<div id="ban" class="probanner" style="background:url(<?php echo base_url(); ?>images/projects_banner.jpg) no-repeat center top">
    <div class="box">
            <ul>
                <li class="li01" onmouseover="starshow1();"></li>
                <li class="li02" onmouseover="starshow2();"></li>
                <li class="li03" onmouseover="starshow3();"></li>
                <li class="li04" onmouseover="starshow4();"></li>
            </ul>
    </div>
</div>
<!--END-->

<?php endif;?>
<!--发起众筹START-->
<div class="prolaunch">
    <div class="box">
        为了梦想追逐？立刻发起众筹，寻找与你志同道合的朋友！
        <a class="but" href="<?php echo base_url();?>do">发起众筹</a>
    </div>
</div>
<!--END-->

<!--项目列表START-->
<div class="project">
    <div class="box">
        <div class="title">
            <h1>项目集市<span>Market</span></h1>
            从今天开始，你将有更多时间和精力研发产品、招聘人才和拓展商务合作
        </div>
        <div class="nav">
            <ul class="left">
                <li><a href="<?php echo base_url().'project/index/0/'.$type;?>">最新</a></li>
                <li><a href="<?php echo base_url().'project/index/1/'.$type;?>">预热</a></li>
                <li><a href="<?php echo base_url().'project/index/2/'.$type;?>">已成功</a></li>
                <li class="now"><a href="<?php echo base_url().'project/collect'?>">收藏</a></li>
            </ul>
            <ul class="right">
                <li class="hot">热门标签</li>
                <li <?php if($type==0):?>class="now"<?php endif;?>><a href="<?php echo base_url().'project/collect';?>">全部</a></li>
                <?php if(!empty($pro_type)):?>
                <?php foreach($pro_type as $pro_type_key=>$pro_type_values):?>
                <li <?php if($pro_type_values->id==$type):?>class="now"<?php endif;?>><a href="<?php echo base_url().'project/collect'.'/'.$pro_type_values->id;?>"><?php echo $pro_type_values->title; ?></a></li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
            <div class="clear"></div>
        </div>
        <?php if(!empty($product)):?>
        <?php foreach($product as $product_key=>$product_values):?>
        <div class="item">
        	<div class="left" style="background-image:url(<?php echo base_url().$product_values->image_url;?>)">
            	<a title="<?php echo $product_values->title;?>" target="_blank" href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>"></a>
                <div class="bg"></div>
            </div>
            <div class="right">
            	<div class="ti">
                	<h2><?php echo $product_values->title;?></h2>
                    <?php if($product_values->account!=''):?><?php echo $product_values->account;?><?php else:?>官方发布<?php endif;?><span><?php echo $product_values->addtime;?></span>
                </div>
                <div class="con">
                	<?php echo $product_values->discription;?>
                </div>
                <div class="more">
                    <a class="cor_fc0" title="<?php echo $product_values->title;?>" target="_blank" href="<?php echo base_url();?>project/detial/<?php echo $product_values->id;?>">&gt;&gt;更多内容</a>
                </div>
                <div class="rate">
                    <ul>
                        <li>已达<?php echo bcmul(bcdiv($product_values->support_amount,$product_values->amount,5), 100, 0)?>%</li>
                        <li>已筹集<?php echo $product_values->support_amount;?>元</li>
                        <li>支持者<?php echo $product_values->support_times;?>人</li>
                        <li><?php echo  $product_values->timer?></li>
                    </ul>
                </div>
                <div class="bar" style="width:
                    <?php 
                    $percent=bcdiv($product_values->support_amount,$product_values->amount,5);
                    if($percent>1){
                        $percent=1;
                    }
                echo bcmul($percent, 100, 0)
                    ?>%">
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        
        <div class="clear"></div>
    </div>
</div>
<!--END-->
<!--分页START-->
<div class="pages">
    <?php if(isset($page_link)):?>
    <?php echo $page_link;?>
    <?php endif;?>
    <!--<a class="prev" href="#">&lt;</a>
    <a href="#">1</a>
    <a class="now">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">7</a>
    <a href="#">8</a>
    <span>...</span>
    <a href="#">20</a>
    <a class="next" href="#">&gt;</a>-->
</div>
<!--END-->
<script>
    function starshow1()
    {
        document.getElementById("ban").style.backgroundImage = 'url(http://www.fandingwang.com/images/1.jpg)';
    }

    function starshow2()
    {
        document.getElementById("ban").style.backgroundImage = 'url(http://www.fandingwang.com/images/2.jpg)';
    }

    function starshow3()
    {
        document.getElementById("ban").style.backgroundImage = 'url(http://www.fandingwang.com/images/3.jpg)';
    }

    function starshow4()
    {
        document.getElementById("ban").style.backgroundImage = 'url(http://www.fandingwang.com/images/4.jpg)';
    }
</script>