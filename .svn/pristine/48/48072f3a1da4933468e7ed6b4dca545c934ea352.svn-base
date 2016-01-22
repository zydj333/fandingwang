<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_ademail
 *
 * @createtime 2015-3-20 10:47:15
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_ademail extends Admin_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;
    private $pagesize = 10;
    private $now_date = '';

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_ademail_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_ademail');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
        $this->now_date = date('Y-m-d H:i:s', time());
    }

    /**
     * 
     * @todo 邮件列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_ademail_model->getAdemailCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_ademail_model->getAdemailList($search);
        if (!empty($list)) {
            $data['list'] = $list;
        }
        $this->load->view('backend/ademail/index', $data);
    }

    /**
     * 
     * @todo 异步获取邮件列表 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $email = $this->input->post('email');
        $status = $this->input->post('status');
        $title = $this->input->post('title');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($email != '') {
            $search['email'] = $email;
        }
        if ($status > -1) {
            $search['status'] = $status;
        }
        if ($title != '') {
            $search['title'] = $title;
        }
        $count = $this->admin_ademail_model->getAdemailCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_ademail_model->getAdemailList($search);
        if (!empty($list)) {
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
     * @todo 进行数据添加 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array('flag' => 0, 'error' => '', 'success' => 0, 'failed' => 0);
            if ($_data['user_name'] != '' && $_data['title']!='' && $_data['content'] != '') {
                if ($_data['user_name'] == 'all') {
                    $user = $this->admin_ademail_model->getAllUserList();
                    if (!empty($user)) {
                        $result = $this->getUserInfoByForeach($user,$_data['title'],$_data['content']);
                        $msg['success'] = $result['success'];
                        $msg['failed'] = $result['failed'];
                    } else {
                        $msg['error'] = lang('get_start_array_filed');
                    }
                } else {
                    $arr_user = explode(',', $_data['user_name']);
                    foreach ($arr_user as $key => $value) {
                        $user = $this->admin_ademail_model->getUserInfoByAccount($value);
                        if (!empty($user)) {
                            if($this->saveAdEmail($user,$_data['title'],$_data['content'])){
                                $msg['success']++;
                            }else{
                              $msg['failed']++;  
                            }
                        } else {
                            $msg['failed']++;
                        }
                    }
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $this->load->view('backend/ademail/add');
        }
    }

    /**
     * 
     * @todo 遍历用户信息 
     * 
     */
    public function getUserInfoByForeach($obj, $title, $content) {
        $rows = array('success' => 0, 'failed' => 0);
        foreach ($obj as $key => $value) {
            if ($this->saveAdEmail($value, $title, $content)) {
                $rows['success'] ++;
            } else {
                $rows['failed'] ++;
            }
        }
        return $rows;
    }

    /**
     * 
     * @todo 保存要添加的数据 
     * 
     */
    public function saveAdEmail($obj, $title, $content) {
        $data = array(
            'user_id' => $obj->id,
            'user_name' => $obj->account,
            'email' => $obj->email,
            'title' => $title,
            'content' => $content,
            'status' => 0,
            'creattime' => $this->now_date,
            'sendtime' => "00-00-00 00:00:00",
            'trytimes' => 0
        );
        if ($this->admin_ademail_model->checkAdEmailIsDefind($data)) {
            $id = $this->admin_ademail_model->saveAdEmailData($data);
            if ($id > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    
     /**
     * 
     * @todo 重置邮件信息
     * 
     */
    public function reset(){
        $id=  $this->uri->segment(3)?$this->uri->segment(3):0;
        if($id==0){
            $this->messageError(lang('error_params'), 'admin_ademail');
        }
        $data=array(
            'status'=>0,
            'trytimes'=>0
        );
        if($this->admin_ademail_model->editEmailById($data,$id)){
            redirect('/admin_ademail/index');
        }else{
             $this->messageError(lang('error_unknow'), 'admin_ademail/index');
        }
    }
    
     /**
     * 
     *  @todo 删除邮件信息
     * 
     */
    public function del(){
        $id=  $this->uri->segment(3)?$this->uri->segment(3):0;
        if($id==0){
            $this->messageError(lang('error_params'), 'admin_ademail');
        }
        if($this->admin_ademail_model->delEmailCodeById($id)){
            redirect('/admin_ademail/index');
        }else{
             $this->messageError(lang('error_unknow'), 'admin_ademail/index');
        }
    }   

}

?>
