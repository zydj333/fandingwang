<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_replay
 *
 * @createtime 2015-3-12 10:11:37
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_replay extends Frontend_Controller {

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
        $this->load->model('admin_product_replay_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_product_replay');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 回复列表 
     * 
     */
    public function index() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($pid > 0) {
            $data['list'] = $this->admin_product_replay_model->getProductReplayList($pid);
            $data['product_id'] = $pid;
            $this->load->view('backend/product_replay/index', $data);
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 添加产品评论 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array('flag' => 0, 'error' => "");
            $data = array(
                'pid' => $_data['pid'],
                'uid' => $_data['uid'],
                'username' => $_data['username'],
                'to_uid' => $_data['to_uid'],
                'to_user' => $_data['to_user'],
                'to_replay_id' => $_data['to_replay_id'],
                'content' => $_data['content'],
                'is_del' => 0
            );
            if ($data['pid'] > 0) {
                if ($data['content'] != '') {
                    $id = $this->admin_product_replay_model->addProductReplayData($data);
                    if ($id > 0) {
                        $this->comm_model->editProductReplayCount($data['pid']);
                        $msg['flag'] = 1;
                        $msg['error'] = $data['pid'];
                    } else {
                        $msg['error'] = lang('error_unknow');
                    }
                } else {
                    $msg['error'] = lang('error_requer');
                }
            } else {
                $msg['error'] = lang('error_params');
            }
            echo json_encode($msg);
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($pid == 0) {
                $this->messageError(lang('error_params'), 'admin_product');
            }
            $data['product_id'] = $pid;
            $this->load->view('backend/product_replay/add', $data);
        }
    }

    /**
     * 
     * @todo 修改产品评论 
     * 
     */
    public function edit() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array('flag' => 0, 'error' => "");
            $id=$_data['replay_id'];
            $data = array(
                'pid' => $_data['pid'],
                'uid' => $_data['uid'],
                'username' => $_data['username'],
                'to_uid' => $_data['to_uid'],
                'to_user' => $_data['to_user'],
                'to_replay_id' => $_data['to_replay_id'],
                'content' => $_data['content'],
                 'is_del' => $_data['is_del'],
            );
            if ($data['pid'] > 0&&$id>0) {
                if ($data['content'] != '') {
                    if ($this->admin_product_replay_model->editProductReplayData($data,$id)) {
                        $msg['flag'] = 1;
                        $msg['error'] = $data['pid'];
                    } else {
                        $msg['error'] = lang('error_unknow');
                    }
                } else {
                    $msg['error'] = lang('error_requer');
                }
            } else {
                $msg['error'] = lang('error_params');
            }
            echo json_encode($msg);
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $replay_id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
            if ($pid > 0 && $replay_id > 0) {
                $data['product_id'] = $pid;
                $data['replay_id'] = $replay_id;
                $data['replay'] = $this->admin_product_replay_model->getProductReplayById($pid, $replay_id);
                //print_r($data['replay']);exit;
                $this->load->view('backend/product_replay/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
        }
    }
    
    
    /**
     * 
     * @todo 删除产品评论 
     * 
     */
    public function del(){
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $replay_id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
            if ($pid > 0 && $replay_id > 0) {
               $data=array(
                    'is_del' => 1
               );
               if($this->admin_product_replay_model->editProductReplayData($data,$replay_id)){
                   redirect('/admin_product_replay/index/'.$pid);
               }else{
                   $this->messageError(lang('error_unknow'), 'admin_product');
               }
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
    }

}

?>
