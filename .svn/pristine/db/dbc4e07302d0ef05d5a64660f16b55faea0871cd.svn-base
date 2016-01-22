<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_varifycode
 *
 * @createtime 2015-3-14 9:51:04
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @description 手机验证码管理
 *
 */
class admin_varifycode extends Admin_Controller {

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
        $this->load->model('admin_varifycode_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_varifycode');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 短信列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_varifycode_model->getVarifyCodeCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_varifycode_model->getVarifyCodeList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->passtime = date('Y-m-d H:i;s', $v->passtime);
                $list[$k]->creattime = date('Y-m-d H:i;s', $v->creattime);
            }
            $data['list'] = $list;
        }
        $this->load->view('backend/varifycode/index', $data);
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
        $phonenumber = $this->input->post('phonenumber');
        $status = $this->input->post('status');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($phonenumber != '') {
            $search['phonenumber'] = $phonenumber;
        }
        if ($status > -1) {
            $search['status'] = $status;
        }
        $count = $this->admin_varifycode_model->getVarifyCodeCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_varifycode_model->getVarifyCodeList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->passtime = date('Y-m-d H:i;s', $v->passtime);
                $list[$k]->creattime = date('Y-m-d H:i;s', $v->creattime);
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
     *  @todo 重置
     * 
     */
    public function reset(){
        $code_id=  $this->uri->segment(3)?$this->uri->segment(3):0;
        if($code_id==0){
            $this->messageError(lang('error_params'), 'admin_varifycode');
        }
        $data=array(
            'status'=>0,
            'trytimes'=>0
        );
        if($this->admin_varifycode_model->editVarifyCodeById($data,$code_id)){
            redirect('/admin_varifycode/index');
        }else{
             $this->messageError(lang('error_unknow'), 'admin_varifycode/index');
        }
    }
    
    /**
     * 
     * @todo 删除 
     * 
     */
    public function del(){
        $code_id=  $this->uri->segment(3)?$this->uri->segment(3):0;
        if($code_id==0){
            $this->messageError(lang('error_params'), 'admin_varifycode');
        }
        if($this->admin_varifycode_model->delVarifyCodeById($code_id)){
            redirect('/admin_varifycode/index');
        }else{
             $this->messageError(lang('error_unknow'), 'admin_varifycode/index');
        }
    }

}

?>
