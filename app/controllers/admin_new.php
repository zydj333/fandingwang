<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_new
 *
 * @createtime 2014-10-23 8:40:56
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_new extends Admin_Controller {

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
        $this->load->model('admin_newtype_model');
        $this->load->model('admin_new_model');
        $this->lang->load('admin_new');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 载入新闻列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_new_model->getNewCount($search);
        $data['url'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_new_model->getNewList($search);
        if (!empty($data['list'])) {
            foreach ($data['list'] as $k => $v) {
                if ($v->imageurl != '') {
                    $items = explode(".", $v->imageurl);
                    $name = isset($items[0]) ? $items[0] : '';
                    $profix = isset($items[1]) ? $items[1] : '';
                    $data['list'][$k]->imageurl_thumb = $name . "_small." . $profix;
                } else {
                    $data['list'][$k]->imageurl_thumb = '';
                }
            }
        }
        $data['type'] = $this->admin_newtype_model->getNewTypeByPid(0);
        if (!empty($data['type'])) {
            foreach ($data['type'] as $k => $v) {
                $data['type'][$k]->second = $this->admin_newtype_model->getNewTypeByPid($v->id);
            }
        }
        $this->load->view('backend/new/index', $data);
    }

    /**
     * 
     * 
     * @todo 载入异步分页 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $title = $this->input->post('title');
        $search_name = $this->input->post('search_name');
        $type = $this->input->post('type');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($title != '') {
            $search['title'] = $title;
        }
        if ($type > -1) {
            $search['type'] = $type;
        }
        if ($search_name != '') {
            $search['search_name'] = $search_name;
        }
        $count = $this->admin_new_model->getNewCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_new_model->getNewList($search);
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
     * @todo 添加资讯
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $data = array(
                'title' => $_data['title'],
                'search_name' => $_data['search_name'],
                'type' => $_data['type'],
                'imageurl' => $_data['imageurl'],
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'is_hot' => $_data['is_hot'],
                'is_recom' => $_data['is_recom'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription'],
                'salt' => $_data['salt'],
                'adder' => $this->user_name,
                'addtime' => date("Y-m-d H:i:s", time())
            );
            if ($data['title'] !== '' && $data['discription'] !== '' && $data['content'] !== '') {
                $id = $this->admin_new_model->saveNewData($data);
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
            $data['type'] = $this->admin_newtype_model->getNewTypeByPid(0);
            if (!empty($data['type'])) {
                foreach ($data['type'] as $k => $v) {
                    $data['type'][$k]->second = $this->admin_newtype_model->getNewTypeByPid($v->id);
                }
            }
            $this->load->view('backend/new/add', $data);
        }
    }

    /**
     *
     * @todo 载入资讯修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $id = $_data['new_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_data['title'],
                    'search_name' => $_data['search_name'],
                    'type' => $_data['type'],
                    'imageurl' => $_data['imageurl'],
                    'discription' => $_data['discription'],
                    'content' => $_data['content'],
                    'is_hot' => $_data['is_hot'],
                    'is_recom' => $_data['is_recom'],
                    'seo_title' => $_data['seo_title'],
                    'seo_keyword' => $_data['seo_keyword'],
                    'seo_discription' => $_data['seo_discription'],
                    'salt' => $_data['salt'],
                );
                if ($data['title'] !== '' && $data['discription'] !== '' && $data['content'] !== '') {
                    if ($this->admin_new_model->editNewData($data, $id)) {
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
                $data['type'] = $this->admin_newtype_model->getNewTypeByPid(0);
                if (!empty($data['type'])) {
                    foreach ($data['type'] as $k => $v) {
                        $data['type'][$k]->second = $this->admin_newtype_model->getNewTypeByPid($v->id);
                    }
                }
                $data['news'] = $this->admin_new_model->getNewInfo($id);
                if ($data['news']->imageurl != '') {
                    $items = explode(".", $data['news']->imageurl);
                    $name = isset($items[0]) ? $items[0] : '';
                    $profix = isset($items[1]) ? $items[1] : '';
                    $data['news']->imageurl_thumb = $name . "_small." . $profix;
                } else {
                    $data['news']->imageurl_thumb = '';
                }
                $this->load->view('backend/new/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_new');
            }
        }
    }

    /**
     *
     * @todo 删除新闻资讯
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            if ($this->admin_new_model->delNewById($id)) {
                redirect('/admin_new');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_new');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_new');
        }
    }

}

?>
