<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_power
 *
 * @createtime 2014-10-21 17:52:06
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_power extends Admin_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_power_model');
        $this->lang->load('admin_power');
        $this->user_id=$this->comm->get_session('user_id');
        $this->user_name=$this->comm->get_session('username');
    }

    /**
     *
     * @todo 权限列表
     *
     */
    public function index() {
        $data['power'] = $this->admin_power_model->getPowerList();
        $this->load->view("backend/power/index", $data);
    }

    /**
     *
     * @todo 添加权限
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'powername' => $_data['powername'],
                'power' => implode(',', $_data['power'])
            );
            if ($data['powername'] != '') {
                if ($this->admin_power_model->savePowerGroup($data)) {
                    redirect('admin_power');
                } else {
                    $this->messageError(lang('error_unknow'), '/admin_power/add');
                }
            } else {
                $this->messageError(lang('error_requer'), '/admin_power/add');
            }
        } else {
            $this->load->model("admin_system_model");
            $data = array();
            $data['system'] = $this->admin_system_model->getAdminSetingList(0);
            if (!empty($data['system'])) {
                foreach ($data['system'] as $k => $v) {
                    $data['system'][$k]->second = $this->admin_system_model->getAdminSetingList($v->id);
                    if (!empty($data['system'][$k]->second)) {
                        foreach ($data['system'][$k]->second as $key => $value) {
                            $data['system'][$k]->second[$key]->third = $this->admin_system_model->getAdminSetingList($value->id);
                        }
                    }
                }
            }
            $this->load->view("backend/power/add", $data);
        }
    }

    /**
     *
     * @todo 载入修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $_data = $this->input->post();
                $data = array(
                    'powername' => $_data['powername'],
                    'power' => implode(',', $_data['power'])
                );
                if ($data['powername'] != '') {
                    if ($this->admin_power_model->savePowerEdit($data, $id)) {
                        redirect('admin_power');
                    } else {
                         $this->messageError(lang('error_unknow'), '/admin_power/edit/'.$id);
                    }
                } else {
                    $this->messageError(lang('error_requer'), '/admin_power/edit/'.$id);
                }
            } else {
                 $this->messageError(lang('error_params'), 'admin_power');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $this->load->model("admin_system_model");
                $data = array();
                $data['system'] = $this->admin_system_model->getAdminSetingList(0);
                if (!empty($data['system'])) {
                    foreach ($data['system'] as $k => $v) {
                        $data['system'][$k]->second = $this->admin_system_model->getAdminSetingList($v->id);
                        if (!empty($data['system'][$k]->second)) {
                            foreach ($data['system'][$k]->second as $key => $value) {
                                $data['system'][$k]->second[$key]->third = $this->admin_system_model->getAdminSetingList($value->id);
                            }
                        }
                    }
                }
                $data['power'] = $this->admin_power_model->getPowerById($id);
                $data['power']->power = explode(",", $data['power']->power);
                $this->load->view("backend/power/edit", $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_power');
            }
        }
    }

}

?>
