<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_items
 * 
 * @todo 购买项设置
 * 
 * @createtime 2015-3-10 12:58:27
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_items extends Admin_Controller {

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
        $this->load->model('admin_product_items_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_product_items');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 购买项设置列表 
     * 
     */
    public function index() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($pid > 0) {
            $list = $this->admin_product_items_model->getProductItemsList($pid);
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    $img = explode('.', $v->image_url);
                    $name = isset($img[0]) ? $img[0] : '';
                    $suffix = isset($img[1]) ? $img[1] : '';
                    if ($name != '' && $suffix != '') {
                        $list[$k]->imageurl_thumb = $name . '_small.' . $suffix;
                    } else {
                        $list[$k]->imageurl_thumb = '';
                    }
                }
            }
            $data['product_id'] = $pid;
            $data['list'] = $list;
            $this->load->view('backend/product_items/index', $data);
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     *
     *  @todo  添加产品子项
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ""
            );
            $_data = $this->input->post();
            $p_id = $_data['pid'];
            if ($p_id > 0) {
                $data = array(
                    'pid' => $p_id,
                    'price' => $_data['price'],
                    'total' => $_data['total'],
                    'sell_total' => 0,
                    'title'=>$_data['title'],
                    'image_url' => $_data['image_url'],
                    'free_mail' => $_data['free_mail'],
                    'mail_fee' => $_data['mail_fee'],
                    'replay' => $_data['replay']
                );
                $id = $this->admin_product_items_model->saveProductItemsData($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = $p_id;
                } else {
                    $msg['error'] = lang('error_unknow');
                }
            } else {
                $msg['error'] = lang('error_product_params');
            }
            echo json_encode($msg);
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($pid == 0) {
                $this->messageError(lang('error_params'), 'admin_product');
            }
            $data['product_id'] = $pid;
            $this->load->view('backend/product_items/add', $data);
        }
    }

    /**
     * 
     * @todo  修改产品子项
     *  
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ""
            );
            $_data = $this->input->post();
            $p_id = $_data['product_id'];
            $id = $_data['items_id'];
            if ($p_id > 0 && $id > 0) {
                $data = array(
                    'pid' => $p_id,
                    'price' => $_data['price'],
                    'total' => $_data['total'],
                    'title'=>$_data['title'],
                    'image_url' => $_data['image_url'],
                    'free_mail' => $_data['free_mail'],
                    'mail_fee' => $_data['mail_fee'],
                    'replay' => $_data['replay']
                );
                if ($this->admin_product_items_model->editProductItemsData($data, $id)) {
                    $msg['flag'] = 1;
                    $msg['error'] = $p_id;
                } else {
                    $msg['error'] = lang('edit_sucess');
                }
            } else {
                $msg['error'] = lang('error_product_params');
            }
            echo json_encode($msg);
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
            if ($pid > 0 && $id > 0) {
                $data['product_id'] = $pid;
                $data['items_id'] = $id;
                $data['item'] = $this->admin_product_items_model->getProductItemsById($pid, $id);
                $this->load->view('backend/product_items/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
        }
    }

    /**
     * 
     *  @todo 删除项目子项
     * 
     */
    public function del() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        if ($pid > 0 && $id > 0) {
            if($this->admin_product_items_model->delProductItemsById($pid,$id)){
                redirect('/admin_product_items/index/'.$pid);
            }  else {
                $this->messageError(lang('error_unknow'), 'admin_product_items/index/'.$pid);
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

}

?>
