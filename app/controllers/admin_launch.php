<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_launch
 *
 * @createtime 2015-6-5 16:44:47
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_launch
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_launch extends Admin_Controller {

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
        $this->load->model('admin_launch_model');
        $this->lang->load('admin_launch');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 载入列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'status' => 1,
        );
        $count = $this->admin_launch_model->getLaunchCount($search);
        $list = $this->admin_launch_model->getLaunchList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->addtime = date('Y-m-d H:i:s', $v->addtime);
            }
        }
        $data['list'] = $list;
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $this->load->view('backend/launch/list', $data);
    }

    /**
     * 
     * @todo 异步获取列表
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $username = trim($this->input->post('username'));
        $celphone = trim($this->input->post('celphone'));
        $project_name = trim($this->input->post('project_name'));
        $status = $this->input->post('status') ? $this->input->post('status') : 0;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($celphone != '') {
            $search['celphone'] = $celphone;
        }
        if ($project_name != '') {
            $search['project_name'] = $project_name;
        }
        if ($status != 0) {
            $search['status'] = $status;
        }
        $count = $this->admin_launch_model->getLaunchCount($search);
        $list = $this->admin_launch_model->getLaunchList($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
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
     * @todo 载入项目详情 
     * 
     */
    public function detial() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "参数错误！";
            exit;
        }
        $launch = $this->admin_launch_model->getLaunchDetial($id);
        if (empty($launch)) {
            echo '没有获取到数据！';
            exit;
        }
        $data['order'] = $launch;
        $this->load->view('backend/launch/detial', $data);
    }

    /**
     * 
     * @todo 通过 
     * 
     */
    public function pass() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "参数错误！";
            exit;
        }
        $data['status'] = 2;
        if ($this->admin_launch_model->editLaunch($data, $id)) {
            echo "操作成功！";
            exit;
        } else {
            echo "操作失败！";
            exit;
        }
    }

    /**
     * 
     * @todo 不通过 
     * 
     */
    public function unpass() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "参数错误！";
            exit;
        }
        $data['status'] = 3;
        if ($this->admin_launch_model->editLaunch($data, $id)) {
            echo "操作成功！";
            exit;
        } else {
            echo "操作失败！";
            exit;
        }
    }

}
