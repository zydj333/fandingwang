<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_projecttype
 *
 * @createtime 2014-10-23 17:46:31
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_projecttype extends Admin_Controller {

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
        $this->load->model('admin_projecttype_model');
        $this->lang->load('admin_projecttype');
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
        $data['list'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/projecttype/index', $data);
    }

    /**
     *
     * @todo 添加项目分类
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'salt' => $_data['salt'],
            );
            if ($data['title'] != '') {
                if ($this->admin_projecttype_model->checkProjectTypeIsSet($data['title'])) {
                    $id = $this->admin_projecttype_model->saveProjectType($data);
                    if ($id > 0) {
                        redirect('/admin_projecttype');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_projecttype/add');
                    }
                } else {
                    $this->messageError(lang('error_unique'), 'admin_projecttype/add');
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_projecttype/add');
            }
        } else {
            $this->load->view('backend/projecttype/add');
        }
    }

    /**
     *
     * @todo 修改项目分类信息
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $_data = $this->input->post();
                $data = array(
                    'title' => $_data['title'],
                    'salt' => $_data['salt'],
                );
                if ($data['title'] != '') {
                    if ($this->admin_projecttype_model->saveProjectTypeEdit($data,$id)) {
                        redirect('/admin_projecttype');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_projecttype/edit/' . $id);
                    }
                } else {
                    $this->messageError(lang('error_requer'), 'admin_projecttype/edit/' . $id);
                }
            } else {
                $this->messageError(lang('error_params'), 'admin_projecttype');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['type'] = $this->admin_projecttype_model->getProjectTypeInfo($id);
                $this->load->view('backend/projecttype/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_projecttype');
            }
        }
    }

}

?>
