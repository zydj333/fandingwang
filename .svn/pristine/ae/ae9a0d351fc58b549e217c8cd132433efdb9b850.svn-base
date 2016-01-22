<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_project_introduce
 *
 * @createtime 2014-10-25 10:08:54
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_project_introduce extends Admin_Controller {

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
        $this->load->model('admin_project_introduce_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_project_introduce');
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
        if ($this->input->post()) {
            $_data = $this->input->post();
            $pid = $_data['pid'];
            $data = array(
                'pattern' => $_data['pattern'],
                'team' => $_data['team'],
                'history' => $_data['history'],
                'future_plans' => $_data['future_plans'],
            );
            $msg = array(
                'flag' => 0,
                'error' => '',
            );
            $introduce = $this->admin_project_introduce_model->getProjectIntroduceByPid($pid);
            if (!empty($introduce)) {
                //修改
                if ($this->admin_project_introduce_model->editProjectIntroduce($data, $pid)) {
                    $msg['flag'] = 1;
                    $msg['error'] = lang('edit_sucess');
                } else {
                    $msg['error'] = lang('error_unknow');
                }
            } else {
                //增加
                $data['pid'] = $pid;
                $id = $this->admin_project_introduce_model->saveProjectIntroduce($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = lang('add_sucess');
                } else {
                    $msg['error'] = lang('error_unknow');
                }
            }
            echo json_encode($msg);
        } else {
            $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($pid > 0) {
                $data['introduce'] = $this->admin_project_introduce_model->getProjectIntroduceByPid($pid);
                $data['pid'] = $pid;
                $this->load->view('backend/project_introduce/index', $data);
            } else {
                $this->messageError(lang($line), '/admin_project');
            }
        }
    }

}

?>
