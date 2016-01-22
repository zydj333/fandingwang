<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_newtype
 *
 * @createtime 2014-10-22 18:15:03
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_newtype extends Admin_Controller {

//put your code here
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
        $this->lang->load('admin_newtype');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 分类列表
     *
     */
    public function index() {
        $data['list'] = $this->admin_newtype_model->getNewTypeByPid(0);
        if (!empty($data['list'])) {
            foreach ($data['list'] as $k => $v) {
                $data['list'][$k]->second = $this->admin_newtype_model->getNewTypeByPid($v->id);
            }
        }
        $this->load->view('backend/newtype/index', $data);
    }

    /**
     *
     * @todo 新增分类
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'pid' => $_data['pid'],
                'salt' => $_data['salt']
            );
            if ($data['title'] != '') {
                if ($this->admin_newtype_model->saveNewType($data)) {
                    redirect('/admin_newtype');
                } else {
                    $this->messageError(lang('error_unknow'), 'admin_newtype/add');
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_newtype/add');
            }
        } else {
            $data['type'] = $this->admin_newtype_model->getNewTypeByPid(0);
            $this->load->view('backend/newtype/add', $data);
        }
    }

    /**
     *
     * @todo 加载修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $_data = $this->input->post();
            if ($id > 0) {
                $data = array(
                    'title' => $_data['title'],
                    'pid' => $_data['pid'],
                    'salt' => $_data['salt']
                );
                if ($data['title'] != '') {
                    if ($this->admin_newtype_model->saveNewTypeEdit($data, $id)) {
                        redirect('/admin_newtype');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_newtype/edit/' . $id);
                    }
                } else {
                    $this->messageError(lang('error_requer'), 'admin_newtype/edit/' . $id);
                }
            } else {
                $this->messageError(lang('error_params'), 'admin_newtype');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['newtype'] = $this->admin_newtype_model->getNewTypeInfoById($id);
                $data['type'] = $this->admin_newtype_model->getNewTypeByPid(0);
                $this->load->view('backend/newtype/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_newtype');
            }
        }
    }

}

?>
