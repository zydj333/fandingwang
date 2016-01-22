<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_tender
 *
 * @createtime 2015-4-14 15:42:29
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_tender extends Admin_Controller {

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
        $this->load->model('admin_product_tender_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_product_tender');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 载入产品动态列表 
     * 
     */
    public function index() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($pid > 0) {
            $list = $this->admin_product_tender_model->getTenderList($pid);
            $data['product_id'] = $pid;
            $data['list'] = $list;
            $this->load->view('backend/product_tender/index', $data);
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 添加项目动态 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $data = array(
                'pid' => $this->input->post('pid') ? $this->input->post('pid') : 0,
                'feed' => $this->input->post('feed'),
                'addtime' => time()
            );
            $msg = array('flag' => 0, 'error' => '');
            if ($data['pid'] > 0) {
                if ($data['feed'] != '') {
                    $id = $this->admin_product_tender_model->saveTenderAdd($data);
                    if ($id > 0) {
                        //修改产品动态条数
                        $this->admin_product_tender_model->plusProductTenderCount($data['pid']);
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
            exit;
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($pid > 0) {
                $data['product_id'] = $pid;
                $this->load->view('backend/product_tender/add', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
        }
    }

    /**
     * 
     * 
     * @todo 删除项目动态
     *  
     * 
     */
    public function del() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $tid = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        if ($pid > 0 && $tid > 0) {
            if ($this->admin_product_tender_model->delTenderByPid($pid, $tid)) {
                $this->admin_product_tender_model->minutProductTenderCount($pid);
                redirect('/admin_product_tender/index/' . $pid);
            } else {
                $this->messageError(lang('error_unknow'), 'admin_product_tender/index/' . $pid);
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 载入修改界面 
     * 
     */
    public function edit() {
        if ($this->input->post()) {
            $id=$this->input->post('id') ? $this->input->post('id') : 0;
            $data = array(
                'pid' => $this->input->post('pid') ? $this->input->post('pid') : 0,
                'feed' => $this->input->post('feed'),
                'addtime' => time()
            );
            $msg = array('flag' => 0, 'error' => '');
            if ($data['pid'] > 0 && $id>0) {
                if ($data['feed'] != '') {
                    if ($this->admin_product_tender_model->saveTenderEdit($data,$id)) {
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
            exit;
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $tid = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
            if ($pid > 0) {
                $data['product_id'] = $pid;
                $data['tender']=  $this->admin_product_tender_model->getTenderInfoByID($pid,$tid);
                $this->load->view('backend/product_tender/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
        }
    }

}

?>
