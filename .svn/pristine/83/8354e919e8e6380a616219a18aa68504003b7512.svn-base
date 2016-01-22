<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product
 *
 * @createtime 2015-2-25 14:39:05
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product extends Admin_Controller {

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
        $this->load->model('admin_product_model');
        $this->load->model('admin_projecttype_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_product');
        $this->load->library('pageurl');
        $this->load->library('get_vedio');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 预售产品列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'is_del' => 0
        );
        $count = $this->admin_product_model->getProductCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_product_model->getProductList($search);
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
                $list[$k]->starttime = date("Y-m-d H:i:s", $v->starttime);
                $list[$k]->endtime = date("Y-m-d H:i:s", $v->endtime);
            }
            $data['list'] = $list;
        }
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/product/index', $data);
    }

    /**
     * 
     * @todo 异步获取产品列表信息 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $product_name = $this->input->post('product_name');
        $project_type = $this->input->post('project_type');
        $is_rem = $this->input->post('is_rem');
        $is_del = $this->input->post('is_del') ? $this->input->post('is_del') : 0;
        $is_effect = $this->input->post('is_effect');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'is_del' => $is_del,
        );
        if ($product_name != '') {
            $search['product_name'] = $product_name;
        }
        if ($project_type > -1) {
            $search['project_type'] = $project_type;
        }
        if ($is_rem > -1) {
            $search['is_rem'] = $is_rem;
        }
        if ($is_effect > -1) {
            $search['is_effect'] = $is_effect;
        }
        $count = $this->admin_product_model->getProductCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_product_model->getProductList($search);
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
                $list[$k]->starttime = date("Y-m-d H:i:s", $v->starttime);
                $list[$k]->endtime = date("Y-m-d H:i:s", $v->endtime);
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
     * @todo 添加产品信息 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'title_salt' => $_data['title_salt'],
                'product_type' => $_data['product_type'],
                'province' => $_data['province'],
                'city' => $_data['city'],
                'banner' => $_data['banner_url'],
                'image_url' => $_data['image_url'],
                'video' => $_data['video'],
                'source_video' => $_data['video'] ? $this->get_vedio->fetch_vedio_url($_data['video']) : '',
                'amount' => $_data['amount'],
                'support_amount' => '0.00',
                'support_times' => 0,
                'views' => 0,
                'starttime' => $_data['starttime'],
                'endtime' => 0,
                'days' => $_data['days'],
                'user_id' => $_data['user_id'],
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'product_loading' => 0,
                'repay' => 0,
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription'],
                'is_effect' => $_data['is_effect'],
                'is_rem' => $_data['is_rem'],
                'salt' => $_data['salt'],
                'is_del' => 0,
                'is_success' => $_data['is_success'],
                'addtime' => date('Y-m-d H:i:s', $this->now_time)
            );
            $msg = array('flag' => 0, 'error' => '');
            if ($data['title'] != '') {
                $data['starttime'] = strtotime($data['starttime']);
                $data['endtime'] = $data['starttime'] + ($data['days'] * 24 * 3600);
                if ($data['product_type'] > 0) {
                    $type = $this->comm_model->getProjectType($data['product_type']);
                    $data['type_name'] = $type->title;
                }
                if ($data['province'] > 0) {
                    $pro = $this->comm_model->getAreaInfoById($data['province']);
                    $data['province_name'] = $pro->name;
                }
                if ($data['city'] > 0) {
                    $pro = $this->comm_model->getAreaInfoById($data['city']);
                    $data['city_name'] = $pro->name;
                }
                $id = $this->admin_product_model->addProductData($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = lang('add_sucess');
                } else {
                    $msg['error'] = lang('error_unknow');
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $this->load->view('backend/product/add', $data);
        }
    }

    /**
     * 
     * @todo 产品修改
     * 
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
            if ($id > 0) {
                $_data = $this->input->post();
                $data = array(
                    'title' => $_data['title'],
                    'title_salt' => $_data['title_salt'],
                    'product_type' => $_data['product_type'],
                    'province' => $_data['province'],
                    'city' => $_data['city'],
                    'banner' => $_data['banner_url'],
                    'image_url' => $_data['image_url'],
                    'video' => $_data['video'],
                    'source_video' => $_data['video'] ? $this->get_vedio->fetch_vedio_url($_data['video']) : '',
                    'amount' => $_data['amount'],
                    'starttime' => $_data['starttime'],
                    'endtime' => 0,
                    'days' => $_data['days'],
                    'user_id' => $_data['user_id'],
                    'discription' => $_data['discription'],
                    'content' => $_data['content'],
                    'seo_title' => $_data['seo_title'],
                    'seo_keyword' => $_data['seo_keyword'],
                    'seo_discription' => $_data['seo_discription'],
                    'is_effect' => $_data['is_effect'],
                    'is_rem' => $_data['is_rem'],
                    'salt' => $_data['salt'],
                    'is_success' => $_data['is_success'],
                );
                $msg = array('flag' => 0, 'error' => '');
                if ($data['title'] != '') {
                    $data['starttime'] = strtotime($data['starttime']);
                    $data['endtime'] = $data['starttime'] + ($data['days'] * 24 * 3600);
                    if ($data['product_type'] > 0) {
                        $type = $this->comm_model->getProjectType($data['product_type']);
                        $data['type_name'] = $type->title;
                    }
                    if ($data['province'] > 0) {
                        $pro = $this->comm_model->getAreaInfoById($data['province']);
                        $data['province_name'] = $pro->name;
                    }
                    if ($data['city'] > 0) {
                        $pro = $this->comm_model->getAreaInfoById($data['city']);
                        $data['city_name'] = $pro->name;
                    }
                    if ($this->admin_product_model->editProductData($data, $id)) {
                        $msg['flag'] = 1;
                        $msg['error'] = lang('edit_sucess');
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
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['product'] = $this->admin_product_model->getProductById($id);
                $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
                $data['province'] = $this->comm_model->getAreaListByPid(0);
                $data['city'] = $this->comm_model->getAreaListByPid($data['product']->province);
                $this->load->view('backend/product/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_product');
            }
        }
    }

    /**
     * 
     * @todo 根据id删除项目 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_del' => 1
            );
            if ($this->admin_product_model->editProductData($data, $id)) {
                redirect('/admin_product');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_product');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 获取删除信息列表 
     * 
     */
    public function recycle() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'is_del' => 1
        );
        $count = $this->admin_product_model->getProductCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_product_model->getProductList($search);
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
            $data['list'] = $list;
        }
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/product/recycle', $data);
    }

    /**
     * 
     * @todo 恢复删除的信息 
     * 
     */
    public function recover() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_del' => 0
            );
            if ($this->admin_product_model->editProductData($data, $id)) {
                redirect('/admin_product/recycle');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_product');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 产品详情 
     * 
     */
    public function detial() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $this->load->model('admin_product_items_model');
            $this->load->model('admin_product_replay_model');
            $data['product'] = $this->admin_product_model->getProductById($id);
            $data['product_items'] = $this->admin_product_items_model->getProductItemsList($id);
            $data['product_replay'] = $this->admin_product_replay_model->getProductReplayList($id);
            $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $data['city'] = $this->comm_model->getAreaListByPid($data['product']->province);
            $this->load->view('backend/product/detial', $data);
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

    /**
     * 
     * @todo 未通过列表 
     * 
     */
    public function waiting() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'is_del' => 0,
            'is_effect' => 0
        );
        $count = $this->admin_product_model->getProductCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_product_model->getProductList($search);
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
            $data['list'] = $list;
        }
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/product/waiting', $data);
    }

    /**
     *
     * @todo 通过 
     * 
     */
    public function pass() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_effect' => 1
            );
            if ($this->admin_product_model->editProductData($data, $id)) {
                redirect('/admin_product/waiting');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_product');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_product');
        }
    }

}

?>
