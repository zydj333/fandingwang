<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_tag
 *
 * @createtime 2014-10-27 16:19:35
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbstag extends Admin_Controller {

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
        $this->load->model('admin_bbstag_model');
        $this->lang->load('admin_bbstag');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 载入标签列表
     *
     */
    public function index() {
        $data['tag'] = $this->admin_bbstag_model->getTagList();
        $this->load->view('backend/bbstag/index', $data);
    }

    /**
     * 
     * @todo 载入添加
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ""
            );
            $_data = $this->input->post();
            $data = array(
                'tagname' => $_data['tagname'],
                'salt' => $_data['salt']
            );
            if ($data['tagname'] != '') {
                $id = $this->admin_bbstag_model->saveTagData($data);
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
            $this->load->view('backend/bbstag/add');
        }
    }

    /**
     *
     * @todo 进行修改操作
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ""
            );
            $_data = $this->input->post();
            $id = $_data['tag_id'];
            if ($id > 0) {
                $data = array(
                    'tagname' => $_data['tagname'],
                    'salt' => $_data['salt']
                );
                if ($data['tagname'] != '') {
                    if ($this->admin_bbstag_model->editTagById($data, $id)) {
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
                $data['tag'] = $this->admin_bbstag_model->getTagInfoById($id);
                $this->load->view('backend/bbstag/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_bbstag');
            }
        }
    }

    /**
     *
     * @todo 删除标签
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            if ($this->admin_bbstag_model->delTagById($id)) {
                redirect('/admin_bbstag');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_bbstag');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_bbstag');
        }
    }

}

?>
