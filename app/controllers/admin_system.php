<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_seting
 *
 * @createtime 2014-10-21 10:05:01
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_system extends Admin_Controller {

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
        $this->load->model('admin_system_model');
        $this->lang->load('admin_system');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
    }

    /**
     *
     * @todo 系统设置
     *
     */
    public function index() {
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
        $this->load->view('backend/system/index', $data);
    }

    /**
     *
     * @todo  根据父级ID添加子分类
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_date = $this->input->post();
            $data = array(
                'titel' => $_date['title'],
                'actionname' => $_date['actionname'],
                'controller' => $_date['controllorname'],
                'parent_id' => $_date['parent_id'],
                'sult' => $_date['sult'],
                'adder' => $this->user_name,
                'is_del' => $_date['is_del']
            );
            if ($data['titel'] != '' && $data['actionname'] != '' && $data['parent_id'] != '') {
                if ($this->admin_system_model->saveSystemData($data)) {
                    redirect('admin_system');
                } else {
                    $this->messageError(lang('error_unknow'), 'admin_system/add', 3);
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_system/add', 3);
            }
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $data['parent'] = $this->admin_system_model->getAdminSetingInfoById($pid);
            $this->load->view('backend/system/add', $data);
        }
    }

    /**
     *
     * @todo 修改操作
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $_date = $this->input->post();
            if ($id > 0) {
                $data = array(
                    'titel' => $_date['title'],
                    'actionname' => $_date['actionname'],
                    'controller' => $_date['controllorname'],
                    'sult' => $_date['sult'],
                    'adder' => $this->user_name,
                    'is_del' => $_date['is_del']
                );
                if ($data['titel'] != '' && $data['actionname'] != '') {
                    if ($this->admin_system_model->editSystemData($data, $id)) {
                        redirect('admin_system');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_system/edit' . $id, 3);
                    }
                } else {
                    $this->messageError(lang('error_requer'), 'admin_system/edit/' . $id, 3);
                }
            } else {
                $this->messageError(lang('error_params'), 'admin_system');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['info'] = $this->admin_system_model->getAdminSetingInfoById($id);
                if (!empty($data['info'])) {
                    $data['parent'] = $this->admin_system_model->getAdminSetingInfoById($data['info']->parent_id);
                } else {
                    $data['parent'] = array();
                }
                $this->load->view('backend/system/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_system');
            }
        }
    }

    /**
     *
     * @todo 删除操作
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = $this->admin_system_model->getAdminSetingList($id);
            if (empty($data)) {
                if ($this->admin_system_model->delSystemById($id)) {
                    redirect('admin_system');
                } else {
                    $this->messageError(lang('error_unknow'), 'admin_system');
                }
            } else {
                $this->messageError(lang('delete_has_son'), 'admin_system');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_system');
        }
    }

    /**
     *
     * @todo sql语句操作
     *
     */
    public function querys() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $sql = $_data['sql_query'];
            if ($sql == '') {
                $msg['error'] = "要执行的sql语句不能为空！";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_system_model->excuteSql($sql)) {
                $msg['flag'] = 1;
                $msg['error'] = "执行成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "执行失败，错误未知！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $this->load->view('backend/system/querys');
        }
    }

}

?>
