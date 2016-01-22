<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbsreply
 *
 * @createtime 2014-10-28 15:11:15
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbsreply extends Admin_Controller {

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
        $this->load->model('admin_bbsreply_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_bbsreply');
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
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_bbsreply_model->getReplyCount($search);
        $list = $this->admin_bbsreply_model->getReplyList($search);
        $data['url'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $this->load->view('backend/bbsreply/index', $data);
    }

    /**
     *
     * @todo 异步获取列表
     *
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => ''
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
       $count = $this->admin_bbsreply_model->getReplyCount($search);
        $list = $this->admin_bbsreply_model->getReplyList($search);
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
     * @todo 删除回复
     *
     */
    public function del(){
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $data=array(
                'is_del'=>1
            );
            if($this->admin_bbsreply_model->editReply($data,$id)){
                redirect('/admin_bbsreply');
            }else{
               $this->messageError(lang('error_unknow'), 'admin_bbsreply');
            }
        }else{
            $this->messageError(lang('error_params'), 'admin_bbsreply');
        }
    }

}

?>
