<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_order
 *
 * @createtime 2015-4-30 10:05:26
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_order extends Frontend_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;
    private $pagesize = 20;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_order_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_order');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * 
     * @todo 载入订单列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_order_model->getOrderCount($search);
        $list = $this->admin_order_model->getOrderList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->addtime = date('Y-m-d H:i:s', $v->addtime);
            }
        }
        $data['list'] = $list;
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $this->load->view('backend/order/index', $data);
    }

    /**
     * 
     * @todo 异步获取订单列表 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $order_num = $this->input->post('order_num');
        $username = $this->input->post('username');
        $cellphone = $this->input->post('cellphone');
        $pname = $this->input->post('pname');
        $step_status = $this->input->post('step_status');
        $types = $this->input->post('types');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
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
        if ($pname != '') {
            $search['pname'] = $pname;
        }
        if ($step_status > -1) {
            $search['step_status'] = $step_status;
        }
        if ($types > -1) {
            $search['type'] = $types;
        }
        $count = $this->admin_order_model->getOrderCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_order_model->getOrderList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->addtime = date('Y-m-d H:i:s', $v->addtime);
            }
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $page_url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 订单详情 
     * 
     */
    public function detial() {
        $order_num = $this->uri->segment(3);
        if ($order_num == '') {
            $this->showErrorNotFond();
        } else {
            $order = $this->admin_order_model->getOrderInfoByOrderNum($order_num);
            if (!empty($order)) {
                $data['order'] = $order;
                $this->load->view('backend/order/detial', $data);
            } else {
                $this->showErrorNotFond();
            }
        }
    }

    /**
     * 
     * @todo 后台直接支付订单信息 
     * 
     */
    public function payByAdmin() {
        $order_num = $this->input->post('orderNum');
        //获取订单详情
        $order = $this->admin_order_model->getOrderInfoByOrderNum($order_num);
        $msg = array('flag' => 0, 'error' => "");
        if (empty($order)) {
            $msg['error'] = "没有获取到初始数据";
            echo json_encode($msg);
            exit;
        }
        //获取项目详情
        $product = $this->admin_order_model->getProjectInfoByPid($order->pid);
        if (empty($product)) {
            $msg['error'] = "获取项目详情失败";
            echo json_encode($msg);
            exit;
        }
        //获取项目子项
        $items = $this->admin_order_model->getProjectItemsInfoByPid($order->pid, $order->items_id);
        if (empty($items)) {
            $msg['error'] = "获取项目子项信息失败";
            echo json_encode($msg);
            exit;
        }

        //开启事务
        $this->db->trans_begin();
        $data = array(
            'step_status' => 2,
            'paytime' => time()
        );
        if ($this->admin_order_model->editProjectOrder($data, $order_num)) {
            //保存成功,修改项目子项的售出项
            $edit_items = array(
                'sell_total' => bcadd($items->sell_total, 1, 0)
            );
            //保存修改
            if (!$this->admin_order_model->editProductItemsById($items->id, $edit_items)) {
                //保存失败
                $this->db->trans_rollback();
                $msg['error'] = "修改项目子项售出项失败";
                echo json_encode($msg);
                exit;
            }
            //保存项目变动信息
            $edit_pro = array(
                'support_amount' => bcadd($product->support_amount, $order->amount, 2),
                'support_times' => bcadd($product->support_times, 1, 0)
            );
            if ($this->admin_order_model->editProductByPid($product->id, $edit_pro)) {
                $this->db->trans_commit();
                $msg['flag'] = 1;
                $msg['error'] = "操作成功";
                echo json_encode($msg);
                exit;
            } else {
                //保存失败
                $this->db->trans_rollback();
                $msg['error'] = "修改项目支持数目失败";
                echo json_encode($msg);
                exit;
            }
        } else {
            //保存失败
            $this->db->trans_rollback();
            $msg['error'] = "保存订单信息失败，数据未能入库";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 载入订单添加页面
     * 
     */
    public function add() {
        $project = $this->admin_order_model->getProjectList();
        $data['pro'] = $project;
        $this->load->view('backend/order/add', $data);
    }

    /**
     * 
     * @todo 根据产品ID获取产品子项
     * 
     */
    public function getProjectItems() {
        $pid = $this->input->post('pid') ? $this->input->post('pid') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($pid == 0) {
            $msg['error'] = "参数丢失";
            echo json_encode($msg);
            exit;
        }
        $items = $this->admin_order_model->getProjectItemsList($pid);
        if (empty($items)) {
            $msg['error'] = "该项目还没有项目子项";
            echo json_encode($msg);
            exit;
        }
        $msg['flag'] = 1;
        $msg['error'] = $items;
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 保存股买订单 
     * 
     */
    public function saveAdd() {
        $_data = $this->input->post();
        $msg = array('flag' => 0, 'error' => "");
        if ($_data['pname'] == 0) {
            $msg['error'] = "必须选择项目";
            echo json_encode($msg);
            exit;
        }
        if ($_data['items_name'] == 0) {
            $msg['error'] = "必须选择项目子项";
            echo json_encode($msg);
            exit;
        }
        //获取项目详情
        $product = $this->admin_order_model->getProjectInfoByPid($_data['pname']);
        if (empty($product)) {
            $msg['error'] = "获取项目详情失败";
            echo json_encode($msg);
            exit;
        }
        //获取项目子项
        $items = $this->admin_order_model->getProjectItemsInfoByPid($_data['pname'], $_data['items_name']);
        if (empty($items)) {
            $msg['error'] = "获取项目子项信息失败";
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'order_num' => $this->comm->createOrderSn(),
            'pid' => $_data['pname'],
            'pname' => $product->title,
            'items_id' => $_data['items_name'],
            'price' => $items->price,
            'buy_number' => 1,
            'amount' => bcmul($items->price, 1, 2),
            'mail_fee' => $items->mail_fee,
            'total_amount' => bcadd($items->price, $items->mail_fee, 2),
            'step_status' => 2,
            'suggest' => $_data['suggest'],
            'uid' => 0,
            'username' => $_data['username'],
            'cellphone' => '13400000000',
            'province' => 1057,
            'province_name' => '浙江省',
            'city' => 1058,
            'city_name' => '杭州',
            'area' => 1063,
            'area_name' => '拱墅区',
            'address' => '湖州街168号美好国际大厦168号',
            'addtime' => time(),
            'paytime' => time(),
            'type' => 1
        );

        //开启事务
        $this->db->trans_begin();
        $order_id = $this->admin_order_model->saveProjectOrder($data);
        if ($order_id > 0) {
            //保存成功,修改项目子项的售出项
            $edit_items = array(
                'sell_total' => bcadd($items->sell_total, 1, 0)
            );
            //保存修改
            if (!$this->admin_order_model->editProductItemsById($items->id, $edit_items)) {
                //保存失败
                $this->db->trans_rollback();
                $msg['error'] = "修改项目子项售出项失败";
                echo json_encode($msg);
                exit;
            }
            //保存项目变动信息
            $edit_pro = array(
                'support_amount' => bcadd($product->support_amount, $data['amount'], 2),
                'support_times' => bcadd($product->support_times, 1, 0)
            );
            if ($this->admin_order_model->editProductByPid($product->id, $edit_pro)) {
                $this->db->trans_commit();
                $msg['flag'] = 1;
                $msg['error'] = "添加购买成功";
                echo json_encode($msg);
                exit;
            } else {
                //保存失败
                $this->db->trans_rollback();
                $msg['error'] = "修改项目支持数目失败";
                echo json_encode($msg);
                exit;
            }
        } else {
            //保存失败
            $this->db->trans_rollback();
            $msg['error'] = "保存订单信息失败，数据未能入库";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 导出excel报表 
     * 
     */
    public function createExcel() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $order_num = $this->input->get('order_num');
        $username = $this->input->get('username');
        $cellphone = $this->input->get('cellphone');
        $pname = $this->input->get('pname');
        $step_status = $this->input->get('step_status');
        $types = $this->input->get('types');
        $search = array(
            'start' => 0,
            'pagesize' => 10000
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
        if ($pname != '') {
            $search['pname'] = $pname;
        }
        if ($step_status > -1) {
            $search['step_status'] = $step_status;
        }
        if ($types > -1) {
            $search['type'] = $types;
        }
        //print_r($search);exit;
        $list = $this->admin_order_model->getOrderList($search);
        if (!empty($list)) {
            $array_name = array(
                '订单编号',
                '产品名称',
                '用户名称',
                '用户邮箱',
                '联系电话',
                '总金额',
                '订单状态',
                '生成时间',
                '支付时间',
                '订单分类',
                '用户地址',
                '备注'
            );
            $array = array();
            foreach ($list as $k => $v) {
               // $user = $this->admin_order_model->getUserEmail($v->uid);
                $array[$k][] = $v->order_num;
                $array[$k][] = $v->pname;
                $array[$k][] = $v->username;
                $array[$k][] = $v->email;
                $array[$k][] = $v->cellphone;
                $array[$k][] = $v->total_amount;
                if ($v->step_status == 0) {
                    $array[$k][] = '待确认订单';
                } elseif ($v->step_status == 1) {
                    $array[$k][] = '待支付';
                } elseif ($v->step_status == 2) {
                    $array[$k][] = '已支付';
                }
                $array[$k][] = date('Y-m-d H:i:s', $v->addtime);
                $array[$k][] = date('Y-m-d H:i:s', $v->paytime);
                if ($v->type == 0) {
                    $array[$k][] = '用户购买';
                } else {
                    $array[$k][] = '系统生成';
                }
                $array[$k][] = $v->province_name . $v->city_name . $v->area_name . $v->address;
                $array[$k][] = $v->suggest;
            }
            $time = date("YmdHis");
            $this->comm->array_to_excel($array_name, $array, $time);
        }
    }

}

?>
