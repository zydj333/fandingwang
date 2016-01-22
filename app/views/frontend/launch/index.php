<!---header end-->
<div class="main">
    <div class="box">
        <div class="step-mod">
            <div class="head">
                <h2 class="yh">发起众筹</h2>
                <p>你好，<strong><?php echo $member->username; ?></strong>，泛丁与你一起寻找志同道合的朋友</p>
                <div class="img"> <img src="<?php echo base_url(); ?>images/step1.png" /> </div>
            </div>
            <form id="launch_step_one_form" action="/launch/saveStepOne" method="post">
                <div class="body">
                    <ul class="form-ul">
                        <li>
                            <input type="hidden" value="0" name="product_id" id="product_id">
                            <label for="">项目名称</label>
                            <input type="text" class="text" placeholder="项目标题，文字限制在20字以内" id="title" value="" name="title" />
                        </li>
                        <li>
                            <label for="">筹款金额</label>
                            <input type="text" class="text" placeholder="填写金额，限数字如50万填写（500000）"  id="amount" value="" name="amount" />
                        </li>
                        <li>
                            <label for="">众筹期限</label>
                            <select class="select" name="days" id="days" >
                                <option value="0">-请选择-</option>
                                <option value="20">20天</option>
                                <option value="30">30天</option>
                                <option value="35">35天</option>
                                <option value="40">40天</option>
                                <option value="45">45天</option>
                                <option value="50">50天</option>
                                <option value="55">55天</option>
                                <option value="60">60天</option>
                                <option value="90">90天</option>
                                <option value="180">180天</option>
                                <option value="360">360天</option>
                            </select>
                            <select class="select" name="type" id="type">
                                <option value="0">--请选择分类--</option>
                                <?php if (!empty($type)): ?>
                                    <?php foreach ($type as $type_key => $type_values): ?>
                                        <option value="<?php echo $type_values->id; ?>"><?php echo $type_values->title; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </li>
                        <li>
                            <label for="">项目口号</label>
                            <input type="text" class="text" placeholder="填写项目的slogan" id="slogan" value="" name="slogan" />
                        </li>
                        <li>
                            <label for="">真实姓名</label>
                            <input type="text" class="text" placeholder="发起人姓名" id="user_name" value="<?php echo $member->username; ?>" name="username" />
                        </li>
                        <li>
                            <label for="">手机号码</label>
                            <input type="text" class="text" placeholder="填写您的联系电话" id="cellphone" value="<?php echo $member->telphone; ?>" name="cellphone" />
                        </li>
                        <li>
                            <label for="">身份证号</label>
                            <input type="text" class="text" placeholder="身份证号码" id="idnumber" value="<?php echo $member->idnumber; ?>" name="idnumber" />
                        </li>
                        <li>
                            <label for="">地区</label>
                            <select class="select select2" name="province" id="province" onchange="return getCity(this.value);">
                                <option value="0">-请选择省份-</option>
                                <?php if (!empty($province)): ?>
                                    <?php foreach ($province as $province_key => $province_values): ?>
                                        <option value="<?php echo $province_values->id; ?>"><?php echo $province_values->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <select class="select select2" name="city" id="city">
                                <option value="0">-请选择省份-</option>
                            </select>
                            <!--<select class="select select2" name="area" id="area">
                                <option value="0">-请选择城市-</option>
                            </select>-->
                        </li>
                        <li>
                            <label for="">详细地址</label>
                            <input type="text" class="text" placeholder="填写您的工作地址" id="address" value="<?php echo $member->address; ?>" name="address" />
                        </li>
                    </ul>
                </div>
                <div class="foot">
                    <p>
                        <input id="fandingxieyi" type="checkbox" checked="checked" value="1" />
                        我已阅读并同意<a href="<?php echo base_url();?>help/agreement" target="_blank">《泛丁众筹协议》</a></p>
                    <input type="button" id="launch_step_one_button" class="submit" value="下一步" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/launch.js" ></script>