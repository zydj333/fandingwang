<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_member
 *
 * @createtime 2015-4-16 9:18:56
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_member extends Admin_Controller {

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
        $this->load->model('admin_member_model');
        $this->lang->load('admin_member');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->load->library('pageurl');
    }

    /**
     * 
     * @todo  载入用户列表
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_member_model->getMemberCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_member_model->getMemberList($search);
        if (!empty($list)) {
            foreach ($list as $key => $values) {
                if ($values->avatar != '') {
                    $avatar = array();
                    if ($values->avatar != '') {
                        $avatar = explode('_', $values->avatar);
                        if (count($avatar) == 3) {
                            $list[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_small.jpg';
                        }
                    }
                }
            }
        }
        $data['list'] = $list;
        $this->load->view('backend/member/index', $data);
    }

    /**
     *
     * @todo 添加用户
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'account' => trim($_data['account']),
                'password' => trim($_data['password']),
                'trade_password' => trim($_data['password']),
                'username' => trim($_data['username']),
                'email' => trim($_data['email']),
                'telphone' => trim($_data['telphone']),
                'addtime' => date('Y-m-d H:i:s', time())
            );
            if ($data['account'] != "" && $data['password'] != "") {
                //检查重复
                if ($this->admin_member_model->checkRepeat($data)) {
                    $data['password'] = md5($data['password']);
                    if ($this->admin_member_model->saveAdminUserData($data)) {
                        redirect('admin_member');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_member/add');
                    }
                } else {
                    $this->messageError(lang('error_unique'), 'admin_member/add');
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_member/add');
            }
        } else {
            $this->load->view('backend/member/add');
        }
    }

    /**
     * 
     * @todo 异步获取前台用户列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $account = $this->input->post('account');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $telphone = $this->input->post('telphone');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        if ($account != '') {
            $search['account'] = $account;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($email != '') {
            $search['email'] = $email;
        }
        if ($telphone != '') {
            $search['telphone'] = $telphone;
        }
        $count = $this->admin_member_model->getMemberCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_member_model->getMemberList($search);
        if (!empty($list)) {
            foreach ($list as $key => $values) {
                if ($values->avatar != '') {
                    $avatar = array();
                    if ($values->avatar != '') {
                        $avatar = explode('_', $values->avatar);
                        if (count($avatar) == 3) {
                            $list[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_small.jpg';
                        }
                    }
                }
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
     * @todo 载入用户详情页面 
     * 
     */
    public function detial() {
        $mid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($mid > 0) {
            $member = $this->admin_member_model->getMemberInfoById($mid);
            if (!empty($member)) {
                $data['member'] = $member;
                $this->load->view('backend/member/detial', $data);
            } else {
                $this->messageError(lang('error_init'), 'admin_member/index');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_member/index');
        }
    }

}

?>
