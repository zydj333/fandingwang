<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbsmod
 *
 * @createtime 2014-10-27 13:43:57
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbsmod extends Admin_Controller {

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
        $this->load->model('admin_bbsmod_model');
        $this->lang->load('admin_bbsmod');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 载入论坛分块列表
     *
     */
    public function index() {
        $mod = $this->admin_bbsmod_model->getModListByPid();
        if (!empty($mod)) {
            foreach ($mod as $key => $value) {
                $mod[$key]->second = $this->admin_bbsmod_model->getModListByPid($value->id);
            }
        }
        $data['mod'] = $mod;
        $this->load->view('backend/bbsmod/index', $data);
    }

    /**
     *
     *
     * @todo 添加模块
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => "",
            );
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'pid' => $_data['pid'],
                'imageurl' => $_data['imageurl'],
                'discription' => $_data['discription'],
                'salt' => $_data['salt'],
            );
            if ($data['title'] != '') {
                $id = $this->admin_bbsmod_model->saveModData($data);
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
            $data['father'] = $this->admin_bbsmod_model->getModListByPid(0);
            $this->load->view('backend/bbsmod/add', $data);
        }
    }

    /**
     *
     * @todo 修改模块
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => "",
            );
            $_data = $this->input->post();
            $id = $_data['mod_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_data['title'],
                    'pid' => $_data['pid'],
                    'imageurl' => $_data['imageurl'],
                    'discription' => $_data['discription'],
                    'salt' => $_data['salt'],
                );
                if ($data['title'] != '') {
                    if ($this->admin_bbsmod_model->editModById($data,$id)) {
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
                $data['mod'] = $this->admin_bbsmod_model->getModInfoById($id);
                $data['father'] = $this->admin_bbsmod_model->getModListByPid(0);
                $this->load->view('backend/bbsmod/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_bbsmod');
            }
        }
    }

    /**
     *
     * @todo 删除模块
     *
     */
    public function del() {
        
    }

}

?>
