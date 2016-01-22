<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_index
 *
 * @createtime 2014-10-21 8:59:44
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_index extends Admin_Controller {

    public $powerValue = '';
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
        $this->load->model('admin_index_model');
        $this->load->model('admin_system_model');
        $this->lang->load('admin_index');
        $this->powerValue = $this->comm->get_session('power');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
    }

    /**
     *
     * @todo 后台首页
     *
     */
    public function index() {
        $this->load->view('backend/public/index');
    }

    /**
     *
     * @todo 载入顶部
     *
     */
    public function top() {
        $data['user'] = json_decode($this->comm->get_session('user'), true);
        $data['top'] = $this->admin_system_model->getSystemListByParentId(0, true, $this->powerValue);
        $this->load->view('backend/public/top', $data);
    }

    /**
     *
     * @todo 载入左侧
     *
     */
    public function left() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 41;
        $data = array();
        $data['system'] = $this->admin_system_model->getSystemListByParentId($pid, true, $this->powerValue);
        if (!empty($data['system'])) {
            foreach ($data['system'] as $k => $v) {
                $data['system'][$k]->second = $this->admin_system_model->getSystemListByParentId($v->id, true, $this->powerValue);
            }
        }
        $this->load->view('backend/public/left', $data);
    }

    /**
     *
     * @todo 载入正文
     *
     */
    public function main() {
        $this->load->view('backend/public/main');
    }

    /**
     *
     * @todo 加载默认页面
     *
     */
    public function defaultpage() {
        $this->load->view('backend/public/default');
    }

}

?>
