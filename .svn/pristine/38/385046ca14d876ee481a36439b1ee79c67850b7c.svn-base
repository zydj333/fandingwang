<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_adjust
 *
 * @createtime 2014-11-27 14:07:44
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_adjust extends Frontend_Controller {

//put your code here
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
        $this->load->model('admin_adjust_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_adjust');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     *
     * @todo 载入资金调整列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_adjust_model->getAdjustCount($search);
        $list = $this->admin_adjust_model->getAdjustList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $data['url'] = $url;
        $this->load->view('backend/adjust/index', $data);
    }

    /**
     *
     * @todo 异步获取列表
     *
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        $useraccount = $this->input->post('account');
        if ($useraccount != '') {
            $search['account'] = $useraccount;
        }
        $msg=array();
        $count = $this->admin_adjust_model->getAdjustCount($search);
        $list = $this->admin_adjust_model->getAdjustList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        if (!empty($list)) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 进行用户余额资金的调整
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            if ($_data['uname'] != '' && $_data['amount_money']) {
                $user = $this->admin_adjust_model->getMemberInfoByAccount($_data['uname']);
                if (!empty($user)) {
                    $data = array(
                        'uid' => $user->id,
                        'uname' => $user->account,
                        'start_money' => $user->usable_money,
                        'amount_money' => $_data['amount_money'],
                        'fee' => 0,
                        'real_amount' => $_data['amount_money'],
                        'frozen_money' => $user->freeze_money,
                        'totle_money' => bcadd($user->usable_money, $_data['amount_money'], 2),
                        'type' => 'adjust',
                        'data' => json_encode($_data)
                    );
                    $mem = array(
                        'usable_money' => $data['totle_money']
                    );
                    if ($this->comm_model->saveMemberAccountLog($data)) {
                        $this->comm_model->editMemberByUid($mem, $user->id);
                        $msg['flag'] = 1;
                        $msg['error'] = lang('save success');
                    } else {
                        $msg['error'] = lang('save faild');
                    }
                } else {
                    $msg['error'] = lang('username_not_set');
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $this->load->view('backend/adjust/add');
        }
    }

}

?>
