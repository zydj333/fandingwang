<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_charging
 *
 * @createtime 2014-11-10 10:46:23
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @todo 充值管理
 *
 */
class Admin_charging extends Admin_Controller {

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
        $this->load->model('admin_charging_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_charging');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 充值列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'status' => 2
        );
        $count = $this->admin_charging_model->getChargingCount($search);
        $list = $this->admin_charging_model->getChargingList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data = array(
            'page_url' => $url,
            'list' => $list
        );
        $this->load->view('backend/charging/index', $data);
    }

    /**
     *
     * @todo 异步获取充值列表
     *
     */
    public function ajaxList() {
        $nowpage = $this->input->post(3) ? $this->input->post(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
    }

    /**
     *
     * @todo 获取在线充值列表
     *
     */
    public function online() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'pay_type' => "online_recharge",
            'status'=>2,
        );
        $count = $this->admin_charging_model->getChargingCount($search);
        $list = $this->admin_charging_model->getChargingList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data = array(
            'page_url' => $url,
            'list' => $list
        );
        $this->load->view('backend/charging/online', $data);
    }

    /**
     *
     * @todo 线下充值列表
     *
     */
    public function offline() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'pay_type' => "offline_recharge",
            'status'=>2,
        );
        $count = $this->admin_charging_model->getChargingCount($search);
        $list = $this->admin_charging_model->getChargingList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data = array(
            'page_url' => $url,
            'list' => $list
        );
        $this->load->view('backend/charging/offline', $data);
    }

    /**
     *
     * @todo 取消的充值记录
     *
     */
    public function cancel() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'status'=>4,
        );
        $count = $this->admin_charging_model->getChargingCount($search);
        $list = $this->admin_charging_model->getChargingList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data = array(
            'page_url' => $url,
            'list' => $list
        );
        $this->load->view('backend/charging/cancel', $data);
    }

}

?>
