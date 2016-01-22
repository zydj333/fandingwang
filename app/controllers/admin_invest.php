<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_invest
 *
 * @createtime 2015-4-16 15:04:59
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_invest extends Admin_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;
    private $pagesize = 10;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_invest_model');
        $this->lang->load('admin_invest');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->load->library('pageurl');
    }

    /**
     * 
     * @todo 加载投资列表 
     * 
     */
    public function index() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($pid > 0) {
            $search = array(
                'start' => 0,
                'pagesize' => $this->pagesize,
                'pid' => $pid
            );
            $count = $this->admin_invest_model->getProductInvestCount($search);
            $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
            $list = $this->admin_invest_model->getProductInvestList($search);
            if (!empty($list)) {
                foreach ($list as $key => $values) {
                    $list[$key]->addtime = date('Y-m-d H:i:s', $values->addtime);
                    $status = '';
                    if ($values->step_status == 0) {
                        $status = '待确认';
                    } elseif ($values->step_status == 1) {
                        $status = '<a style="color:blue" >等待支付</a>';
                    } elseif ($values->step_status == 2) {
                        $status = '<a style="color:red" >已支付</a>';
                    } else {
                        $status = '<a style="color:yellow" >其他</a>';
                    }
                    $list[$key]->step_status = $status;
                }
            }
            $data['product_id'] = $pid;
            $data['list'] = $list;
            $this->load->view('backend/invest/index', $data);
        } else {
            $this->messageError(lang('error_params'), 'admin_product/index');
        }
    }

    /**
     * 
     * @todo 异步获取产品支持列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $product_id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        if ($product_id > 0) {
            $order_num = $this->input->post('order_num');
            $username = $this->input->post('username');
            $cellphone = $this->input->post('cellphone');
            $step_status = $this->input->post('step_status');
            $search = array(
                'start' => 0,
                'pagesize' => $this->pagesize,
                'pid' => $product_id
            );
            if ($order_num != '') {
                $search['order_num'] = $order_num;
            }
            if ($username != '') {
                $search['username'] = $username;
            }
            if ($cellphone != '') {
                $search['cellphone'] = $cellphone;
            }
            if ($step_status > -1) {
                $search['step_status'] = $step_status;
            }
            $count = $this->admin_invest_model->getProductInvestCount($search);
            $page_url = $this->pageurl->getPage($count, $this->pagesize, 1);
            $list = $this->admin_invest_model->getProductInvestList($search);
            if (!empty($list)) {
                foreach ($list as $key => $values) {
                    $list[$key]->addtime = date('Y-m-d H:i:s', $values->addtime);
                    $status = '';
                    if ($values->step_status == 0) {
                        $status = '待确认';
                    } elseif ($values->step_status == 1) {
                        $status = '<a style="color:blue" >等待支付</a>';
                    } elseif ($values->step_status == 2) {
                        $status = '<a style="color:red" >已支付</a>';
                    } else {
                        $status = '<a style="color:yellow" >其他</a>';
                    }
                    $list[$key]->step_status = $status;
                }
                $msg['flag'] = 1;
                $msg['error'] = $list;
                $msg['pageurl'] = $page_url;
            } else {
                $msg['flag'] = 0;
                $msg['error'] = '没有相应数据';
                $msg['pageurl'] = '';
            }
        } else {
            $msg['flag'] = 0;
            $msg['error'] = lang('error_params');
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 获取订单详情 
     * 
     */
    public function detial() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if($id>0){
            $invest=  $this->admin_invest_model->getOrderDetial($id);
            if(!empty($invest)){
                   $status = '';
                    if ($invest->step_status == 0) {
                        $status = '待确认';
                    } elseif ($invest->step_status == 1) {
                        $status = '<a style="color:blue" >等待支付</a>';
                    } elseif ($invest->step_status == 2) {
                        $status = '<a style="color:red" >已支付</a>';
                    } else {
                        $status = '<a style="color:yellow" >其他</a>';
                    }
                    $invest->step_status = $status;
                $data['invest']=$invest;
                $this->load->view('backend/invest/detial', $data);
            }else{
                $this->messageError(lang('error_init'), 'admin_product/index');
            }
        }else{
            $this->messageError(lang('error_params'), 'admin_product/index');
        }
    }

}

?>
