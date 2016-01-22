<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_mail
 *
 * @createtime 2015-3-17 9:39:12
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_mail extends Admin_Controller {

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
        $this->load->model('admin_mail_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_mail');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
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
        $count = $this->admin_mail_model->getMailCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_mail_model->getMailList($search);
        if (!empty($list)) {
            $data['list'] = $list;
        }
        $this->load->view('backend/mail/index', $data);
    }

    /**
     * 
     * @todo 异步列表 
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
        $count = $this->admin_mail_model->getMailCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_mail_model->getMailList($search);
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
     * @todo 重置邮件发送信息  
     * 
     */
    public function reset() {
        $mail_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($mail_id == 0) {
            $this->messageError(lang('error_params'), 'admin_mail');
        }
        $data = array(
            'status' => 0
        );
        if ($this->admin_mail_model->resetMailById($data, $mail_id)) {
            redirect('/admin_mail/index');
        } else {
            $this->messageError(lang('error_unknow'), 'admin_mail/index');
        }
    }

    /**
     *
     * @todo 删除邮件 
     * 
     */
    public function del() {
        $mail_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($mail_id == 0) {
            $this->messageError(lang('error_params'), 'admin_mail');
        }
        if($this->admin_mail_model->delMailCodeById($code_id)){
            redirect('/admin_mail/index');
        }else{
             $this->messageError(lang('error_unknow'), 'admin_mail/index');
        }
    }

}

?>
