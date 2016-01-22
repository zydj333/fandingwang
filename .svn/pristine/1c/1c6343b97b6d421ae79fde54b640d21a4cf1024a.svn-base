<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_activitytype
 *
 * @createtime 2014-10-23 18:45:05
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_activitytype extends Admin_Controller {

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
        $this->load->model('admin_activitytype_model');
        $this->lang->load('admin_activitytype');
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
        $data['list'] = $this->admin_activitytype_model->getActivityTypeList();
        $this->load->view('backend/activitytype/index', $data);
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
                if ($this->admin_activitytype_model->checkActivityTypeIsSet($data['title'])) {
                    $id = $this->admin_activitytype_model->saveActivityType($data);
                    if ($id > 0) {
                        redirect('/admin_activitytype');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_activitytype/add');
                    }
                } else {
                    $this->messageError(lang('error_unique'), 'admin_activitytype/add');
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_activitytype/add');
            }
        } else {
            $this->load->view('backend/activitytype/add');
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
                    if ($this->admin_activitytype_model->saveActivityTypeEdit($data, $id)) {
                        redirect('/admin_activitytype');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_activitytype/edit/' . $id);
                    }
                } else {
                    $this->messageError(lang('error_requer'), 'admin_activitytype/edit/' . $id);
                }
            } else {
                $this->messageError(lang('error_params'), 'admin_activitytype');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['type'] = $this->admin_activitytype_model->getActivityTypeInfo($id);
                $this->load->view('backend/activitytype/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_activitytype');
            }
        }
    }

}

?>
