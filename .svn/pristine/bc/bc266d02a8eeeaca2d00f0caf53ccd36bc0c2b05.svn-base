<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">发起众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="img"> <img src="<?php echo base_url(); ?>images/step4.png" /> </div>
            </div>
            <form action="<?php echo base_url(); ?>launch/saveStepFour" method="post">
                <div class="body body4">
                    <ul class="form-ul">
                        <li>
                            <input type="hidden" id="product_id" name="product_id" value="<?php echo $pro->id; ?>"/>
                            <label for="">支持金额</label>
                            <input type="text" class="text"  id="price" value="" name="price" />
                        </li>
                        <li>
                            <label for="">回报名称</label>
                            <input type="text" class="text" placeholder="输入回报限名称，10字以内"  id="title" value="" name="title" />
                        </li>
                        <li>
                            <label for="">回报描述</label>
                            <textarea placeholder="回报描述限100字以内" class="text textarea" name="discription" id="discription" ></textarea>
                        </li>
                        <li>
                            <label for="">人数上限</label>
                            <input type="text" class="text" placeholder="" id="total" value="" name="total" />
                        </li>

                        <li class="btn-li">
                            <input type="submit" value="+增加回报" class="btn yh" /> 
                        </li>
                    </ul>
                </div>
                <div class="project-mod project-news">
                    <div class="hd">
                        <h3><strong class="ico2 yh">支持项列表</strong></h3>
                    </div>
                    <?php if (!empty($items)): ?>
                        <div class="bd">
                            <table width="100%">
                                <tr>
                                    <th scope="col" width="15%" >时间</th>
                                    <th scope="col" width="10%">金额</th>
                                    <th scope="col" width="10%">限量</th>
                                    <th scope="col" width="15%">标题</th>
                                    <th scope="col" width="50%">描述</th>
                                </tr>
                                <?php foreach ($items as $items_key => $items_values): ?>
                                    <tr align="center" >
                                        <td><?php echo date('m月d H:i', $items_values->addtime); ?></td>
                                        <td><?php echo $items_values->price; ?></td>
                                        <td><?php echo $items_values->total; ?></td>
                                        <td><?php echo $items_values->title; ?></td>
                                        <td><?php echo $items_values->discription; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="foot">
                    <p>
                        <input type="button" class="submit" value="下一步" id="step_to_five" />
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        var p_id = $("#product_id").val();
        $("#step_to_five").click(function() {
            location.href = '/launch/stepfive/' + p_id;
        });
    });
</script>
