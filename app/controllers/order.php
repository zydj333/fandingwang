<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @createtime 2015-4-10 15:17:56
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class order extends Frontend_Controller {

    protected $user;

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('project_model');
        $this->load->model('usercenter_model');
        $this->user = $this->userinfo();
        $this->comm->checkUserlogin();
    }

    /**
     * 
     * @todo 订单首页 
     * 
     */
    public function index() {
        $msg = array('flag' => 0, 'error' => '');
        $p_id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $items_id = $this->input->post('items_id') ? $this->input->post('items_id') : 0;
        if ($p_id == 0) {
            $msg['error'] = "产品参数错误！";
            echo json_encode($msg);
            exit;
        }
        if ($items_id == 0) {
            $msg['error'] = "订单参数错误！";
            echo json_encode($msg);
            exit;
        }
        $items = $this->order_model->getProductItemsById($p_id, $items_id);
        if (!empty($items)) {
            if ($items->total > $items->sell_total) {
                $msg['flag'] = 1;
                $msg['error'] = "可以购买！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "该项已经达到上限！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = "参数错误！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     *
     * @todo 载入订单第一步 
     * 
     */
    public function stepone() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'project'
        );
        $param = $this->uri->segment(3);
        if ($param != '') {
            $param_array = explode('-', $param);
            if (count($param_array) == 2) {
                //获取项目详情.
                $user = $this->user;
                $product = $this->project_model->getProductInfoById($param_array[0]);
                $items = $this->order_model->getProductItemsById($param_array[0], $param_array[1]);
                if (!empty($product) && !empty($items)) {
                    $header['title'] = $product->seo_title;
                    $header['keywords'] = $product->seo_keyword;
                    $header['description'] = $product->seo_discription;
                    $image = $product->image_url;
                    $imagearry = explode('.', $image);
                    $product->image_url = $imagearry[0] . '_middle.' . $imagearry[1];
                    $header['user'] = $user;
                    $data['product'] = $product;
                    $data['items'] = $items;
                    $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
                    //$data['province'] = $this->comm_model->getAreaListByPid(0);
                    //载入地址列表
                    $data['address'] = $this->order_model->getMyAddressList($user['user_id']);
                    $this->load->view('frontend/public/header', $header);
                    $this->load->view('frontend/order/stepone', $data);
                    $this->load->view('frontend/public/footer');
                } else {
                    $this->showErrorNotFond();
                }
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     * 
     * @todo 获取用户的地址列表 
     * 
     */
    public function getAddressList() {
        $user = $this->user;
        $address = $this->order_model->getMyAddressList($user['user_id']);
        $msg = array('flag' => 0, 'error' => "");
        if (!empty($address)) {
            $msg['flag'] = 1;
            $msg['error'] = $address;
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = '没有获取到用户地址信息!';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 保存第一步 
     * 
     */
    public function saveStepOne() {
        $user = $this->user;
        $_data = $this->input->post();
        $data = array(
            'order_num' => $this->comm->createOrderSn(),
            'pid' => $_data['product_id'],
            'pname' => $_data['product_name'],
            'items_id' => $_data['items_id'],
            'price' => 0.00,
            'buy_number' => $_data['bynumber'],
            'amount' => 0.00,
            'mail_fee' => 0.00,
            'total_amount' => 0.00,
            'step_status' => 0,
            'suggest' => $_data['suggest'],
            'uid' => $user['user_id'],
            'username' => '',
            'cellphone' => '',
            'province' => '',
            'province_name' => '',
            'city' => '',
            'city_name' => '',
            'area' => '',
            'area_name' => '',
            'address' => '',
            'address_id' => $this->input->post('address') ? $this->input->post('address') : 0,
            'type' => 0,
            'addtime' => time()
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['address_id'] > 0) {
            $address = $this->order_model->getAddressInfoById($data['address_id']);
            if (!empty($address)) {
                $data['username'] = $address->username;
                $data['cellphone'] = $address->cellphone;
                $data['province'] = $address->province;
                $data['province_name'] = $address->province_name;
                $data['city'] = $address->city;
                $data['city_name'] = $address->city_name;
                $data['area'] = $address->area;
                $data['area_name'] = $address->area_name;
                $data['address'] = $address->address;
            }
        }
        if ($data['items_id'] > 0 && $data['pid'] > 0) {
            $items = $this->order_model->getProductItemsById($data['pid'], $data['items_id']);
            if (!empty($items)) {
                $data['price'] = $items->price;
                $data['amount'] = bcmul($items->price, $data['buy_number'], 2);
                $data['mail_fee'] = $items->mail_fee;
                $data['total_amount'] = bcadd($data['amount'], $data['mail_fee'], 2);
                $o_id = $this->order_model->saveOrderAdd($data);
                if ($o_id > 0) {
                    redirect('/order/steptwo/' . $data['order_num']);
                } else {
                    $msg['error'] = "提交订单失败，错误未知!";
                }
            } else {
                $msg['error'] = "参数丢失!";
            }
        } else {
            $msg['error'] = "信息没有填写完整!";
        }
    }

    /**
     * 
     * @todo 进行订单第二步 
     * 
     */
    public function steptwo() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'project'
        );
        $number = $this->uri->segment(3);
        if ($number != '') {
            $user = $this->user;
            $order = $this->order_model->getOrderInfoByOrderNum($number, $user['user_id']);
            if (!empty($order)) {
                $product = $this->project_model->getProductInfoById($order->pid);
                $image = $product->image_url;
                $imagearry = explode('.', $image);
                $product->image_url = $imagearry[0] . '_middle.' . $imagearry[1];
                $data['itemsinfo'] = $this->order_model->getProductItemsById($order->pid, $order->items_id);
                $header['user'] = $user;
                $header['title'] = $product->seo_title;
                $header['keywords'] = $product->seo_keyword;
                $header['description'] = $product->seo_discription;
                $data['order'] = $order;
                $data['user'] = $user;
                $data['product'] = $product;
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/order/steptwo', $data);
                $this->load->view('frontend/public/footer');
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     * 
     * @todo 返回订单页面 
     * 
     */
    public function editstepone() {
        $order_num = $this->uri->segment(3);
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'project'
        );
        if ($order_num != '') {
            $user = $this->user;
            $order = $this->order_model->getOrderInfoByOrderNum($order_num, $user['user_id']);
            if (!empty($order)) {
                $product = $this->project_model->getProductInfoById($order->pid);
                $items = $this->order_model->getProductItemsById($order->pid, $order->items_id);
                if (!empty($product) && !empty($items)) {
                    $header['title'] = $product->seo_title;
                    $header['keywords'] = $product->seo_keyword;
                    $header['description'] = $product->seo_discription;
                    $image = $product->image_url;
                    $imagearry = explode('.', $image);
                    $product->image_url = $imagearry[0] . '_middle.' . $imagearry[1];
                    $header['user'] = $user;
                    $data['order'] = $order;
                    $data['product'] = $product;
                    $data['items'] = $items;
                    $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
                    $data['address'] = $this->order_model->getMyAddressList($user['user_id']);
                    $this->load->view('frontend/public/header', $header);
                    $this->load->view('frontend/order/editstepone', $data);
                    $this->load->view('frontend/public/footer');
                } else {
                    $this->showErrorNotFond();
                }
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     *
     * @todo 保存修改 
     * 
     */
    public function saveStepOneEdit() {
        $user = $this->user;
        $_data = $this->input->post();
        $data = array(
            'price' => 0.00,
            'buy_number' => $_data['bynumber'],
            'amount' => 0.00,
            'mail_fee' => 0.00,
            'total_amount' => 0.00,
            'step_status' => 0,
            'suggest' => $_data['suggest'],
            'username' => '',
            'cellphone' => '',
            'province' => 0,
            'province_name' => '',
            'city' => 0,
            'city_name' => '',
            'area' => 0,
            'area_name' => '',
            'address' => '',
            'address_id' => $this->input->post('address') ? $this->input->post('address') : 0
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['address_id'] > 0) {
            $address = $this->order_model->getAddressInfoById($data['address_id']);
            if (!empty($address)) {
                $data['username'] = $address->username;
                $data['cellphone'] = $address->cellphone;
                $data['province'] = $address->province;
                $data['province_name'] = $address->province_name;
                $data['city'] = $address->city;
                $data['city_name'] = $address->city_name;
                $data['area'] = $address->area;
                $data['area_name'] = $address->area_name;
                $data['address'] = $address->address;
            }
        }
        $items_id = $_data['items_id'];
        $pid = $_data['product_id'];
        $order_num = $_data['order_num'];
        if ($items_id > 0 && $pid > 0 && $order_num != '') {
            $items = $this->order_model->getProductItemsById($pid, $items_id);
            if (!empty($items)) {
                $data['price'] = $items->price;
                $data['amount'] = bcmul($items->price, $data['buy_number'], 2);
                $data['mail_fee'] = $items->mail_fee;
                $data['total_amount'] = bcadd($data['amount'], $data['mail_fee'], 2);
                $param = array(
                    'user_id' => $user['user_id'],
                    'pid' => $pid,
                    'items_id' => $items_id,
                    'order_num' => $order_num
                );
                if ($this->order_model->saveOrderEdit($data, $param)) {
                    redirect('/order/steptwo/' . $param['order_num']);
                } else {
                    $msg['error'] = "提交订单失败，错误未知!";
                }
            } else {
                $msg['error'] = "参数丢失!";
            }
        } else {
            $msg['error'] = "信息没有填写完整!";
        }
    }

    /**
     * 
     * @todo 支付遮罩 
     */
    public function pay_status() {
        $order_num = $this->uri->segment(3);
        $data['order_num'] = $order_num;
        $this->load->view('frontend/public/pay_status', $data);
    }

    /**
     * 
     * @todo 支持成功页面 
     * 
     */
    public function stepthree() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'project'
        );
        $user = $this->user;
        $order_num = $this->uri->segment(3);
        $order = $this->order_model->getOrderInfoByOrderNum($order_num, $user['user_id']);
        if (!empty($order)) {
            $data['order'] = $order;
            $header['user'] = $user;
            //$data['flag']=2;
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/order/stepthree', $data);
            $this->load->view('frontend/public/footer');
        } else {
            $this->showErrorNotFond();
        }
    }

}

?>
