<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pay
 *
 * @createtime 2015-4-11 18:28:40
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class pay extends Frontend_Controller {

//put your code here
    protected $user;
    protected $alipay_params = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('project_model');
        $this->load->model('usercenter_model');
        $this->alipay_params = $this->config->item('alipay');
        $this->load->helper('alipayfuns');
        $this->user = $this->userinfo();
        //$this->comm->checkUserlogin();
    }

    /**
     * 
     * @todo 进行支付操作 
     * 
     */
    public function payment() {
        //echo 'coming soon';exit;
        $number = $this->uri->segment(3);
        if ($number != '') {
            $user = $this->user;
            $order = $this->order_model->getOrderInfoByOrderNum($number, $user['user_id']);
            if (!empty($order)) {
                //修改订单状态在未支付
                if ($order->step_status == 0) {
                    $status = array(
                        'step_status' => '1'
                    );
                    //修改订单
                    $this->order_model->editOrderStatus($status, $order->order_num);
                } elseif ($order->step_status == 2) {
                    redirect('/order/showErrorNotFond');
                }
                $alipay_params = $this->alipay_params;
                //订单号码
                $data['order']['number'] = $order->order_num;
                //订单中金额
                $data['order']['total_fe'] = $order->total_amount;
                //订单主题
                $data['order']['subject'] = $order->pname;
                //订单备注信息
                $data['order']['body'] = $order->suggest;
                //显示订单详细信息页面
                //$data['alipay']['show_url'] = base_url() . 'order/stepthree';
                $alipay_params['show_url'] = base_url() . 'order/stepthree/' . $order->order_num;
                //$alipay_params['show_url'] = 'http://www.baidu.com/s?wd=CKEDITOR.replace+name&rsv_bp=0&rsv_spt=3&rsv_n=2&inputT=3096';
                //构造要请求的参数数组
                $parameter = array(
                    "service" => "create_direct_pay_by_user",
                    "payment_type" => "1",
                    "partner" => trim($alipay_params['partner']),
                    "_input_charset" => trim(strtolower($alipay_params['input_charset'])),
                    "seller_email" => trim($alipay_params['seller_email']),
                    "return_url" => trim($alipay_params['return_url']),
                    "notify_url" => trim($alipay_params['notify_url']),
                    "out_trade_no" => $data['order']['number'],
                    "subject" => $data['order']['subject'],
                    "body" => $data['order']['body'],
                    "total_fee" => $data['order']['total_fe'],
                    "paymethod" => "",
                    "defaultbank" => "",
                    "anti_phishing_key" => "",
                    "exter_invoke_ip" => "",
                    "show_url" => trim($alipay_params['show_url']),
                    "extra_common_param" => "",
                    "royalty_type" => "",
                    "royalty_parameters" => ""
                );
                $data['server_url'] = $alipay_params['server_url'];
                $alipayService = new AlipayService($alipay_params);
                $data['para'] = $alipayService->create_direct_pay_by_user($parameter);
                $data['order'] = $order;
                $this->load->view('frontend/public/pay', $data);
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /*
     * 支付宝同步回调通知接口
     */

    function revals() {
        $user = $this->user;
        $inputs = $this->input->get();
        //商户订单号
        $out_trade_no = $this->input->get('out_trade_no');
        //支付宝交易号
        $trade_no = $this->input->get('trade_no');
        //交易状态
        $trade_status = $this->input->get('trade_status');
        // if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') 
        //判断该笔订单是否在商户网站中已经做过处理
        //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        //如果有做过处理，不执行商户的业务程序
        $header['user'] = $user;
        //验证是不是支付宝的数据
        if ($this->_verify($inputs) && ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS')) {
            //获取订单信息
            $order = $this->order_model->getOrderInfoByOrderNumForPay($out_trade_no);
            if ($order->step_status == 1) {
                $status = array(
                    'step_status' => '2',
                    'paytime' => time()
                );
                //修改订单
                if ($this->order_model->editOrderStatus($status, $out_trade_no)) {
                    //修改项目支持数
                    $this->order_model->editProduceItemsSellTotal($order->pid, $order->items_id, $order->buy_number);
                    //修改项目的信息
                    $this->order_model->editProductSupport($order->pid, $order->amount, $order->buy_number);
                    //邮件通知
                    $email_id = $this->comm_model->savePayOrderEmail($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    //短信通知
                    $phone_quee = $this->comm_model->savePayOrderMessage($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    $data['flag'] = 1;
                    $data['out'] = "订单支付成功！";
                } else {
                    $data['flag'] = 0;
                    $data['out'] = "通信尚未完成！";
                }
            } else if ($order->step_status == 2) {
                $data['flag'] = 1;
                $data['out'] = "订单支付成功！";
            } else {
                //状态错误
                $data['flag'] = 0;
                $data['out'] = "订单状态错误！";
            }
        } else {
            //数据参数错误。
            $data['flag'] = 0;
            $data['out'] = "数据参数错误！";
        }
        $data['order'] = $order;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/order/stepthree', $data);
        $this->load->view('frontend/public/footer');
    }

    /*
     * 支付宝异步通知接口
     */

    function notify() {
        $inputs = $this->input->post();
        //交易状态
        $trade_status = $this->input->post('trade_status');
        //验证是不是支付宝的数据
        if ($this->_verify($inputs) && ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS')) {
            //获取订单信息
            $order = $this->order_model->getOrderInfoByOrderNumForPay($inputs['out_trade_no']);
            if ($order->step_status == 1) {
                $status = array(
                    'step_status' => '2',
                    'paytime' => time()
                );
                //修改订单
                if ($this->order_model->editOrderStatus($status, $inputs['out_trade_no'])) {
                    //修改项目支持数
                    $this->order_model->editProduceItemsSellTotal($order->pid, $order->items_id, $order->buy_number);
                    //修改项目的信息
                    $this->order_model->editProductSupport($order->pid, $order->amount, $order->buy_number);
                    //邮件通知
                    $email_id = $this->comm_model->savePayOrderEmail($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    //短信通知
                    $phone_quee = $this->comm_model->savePayOrderMessage($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    echo 'success';
                } else {
                    echo 'fail';
                }
            } else if ($order->step_status == 2) {
                echo 'success';
            } else {
                //状态错误
                echo 'fail';
            }
        } else {
            //不是支付宝的消息
            echo 'fail';
        }
    }

    /*
     * 验证消息来源
     */

    function _verify($inputs) {
        $alipay_params = $this->alipay_params;
        $alipayNotify = new AlipayNotify($alipay_params);
        return $alipayNotify->verifyReturn($inputs);
    }

}

?>
