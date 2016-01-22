<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_setting
 *
 * @createtime 2014-11-7 14:31:05
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @todo 网站设置
 *
 */
class Admin_setting extends Admin_Controller {

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
        $this->load->model('admin_setting_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_setting');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 邮件设置
     *
     */
    public function email() {
        $data['list'] = $this->admin_setting_model->getSettingList('email');
        $this->load->view('backend/setting/email_list', $data);
    }

    /**
     *
     * @todo 添加设置
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array('flag' => 0, 'error' => '');
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'select_title' => $_data['select_title'],
                'select_values' => $_data['select_values'],
                'select_group' => $_data['select_group'],
                'discription' => $_data['discription']
            );
            if ($data['title'] != '' && $data['select_title'] != '' && $data['select_values'] != '') {
                if ($this->admin_setting_model->checkRepeat($data['select_title'], $data['select_group'])) {
                    if ($this->admin_setting_model->saveSettingData($data)) {
                        $msg['flag'] = 1;
                        $msg['error'] = lang('save success');
                    } else {
                        $msg['error'] = lang('error_unknow');
                    }
                } else {
                    $msg['error'] = lang('error_uniqu');
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $type = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 'site';
            $data['nowtype'] = $type;
            $data['type'] = $this->settingType();
            $this->load->view('backend/setting/add', $data);
        }
    }

    /**
     *
     * @todo 站点设置
     *
     */
    public function site() {
        $data['list'] = $this->admin_setting_model->getSettingList('site');
        $this->load->view('backend/setting/site_list', $data);
    }

    /**
     *
     * @todo 载入设置修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array('flag' => 0, 'error' => '');
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'select_title' => $_data['select_title'],
                'select_values' => $_data['select_values'],
                'select_group' => $_data['select_group'],
                'discription' => $_data['discription']
            );
            $id = $_data['setting_id'];
            if ($id > 0) {
                if ($data['title'] != '' && $data['select_title'] != '' && $data['select_values'] != '') {
                    if ($this->admin_setting_model->editSettingData($data,$id)) {
                        $msg['flag'] = 1;
                        $msg['error'] = lang('save success');
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
                $info = $this->admin_setting_model->getSettingInfoById($id);
                if (!empty($info)) {
                    $data['info'] = $info;
                    $data['type'] = $this->settingType();
                    $this->load->view('backend/setting/edit', $data);
                } else {
                    $this->messageError(lang('error_defalut_info'), '/admin_setting/email');
                }
            } else {
                $this->messageError(lang('error_params'), '/admin_setting/email');
            }
        }
    }

    /**
     *
     * @todo 设置分类
     *
     */
    public function settingType() {
        return array(
            'site' => "站点设置",
            'email' => "邮件设置",
        );
    }

}

?>
