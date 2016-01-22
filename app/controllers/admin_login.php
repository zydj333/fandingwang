<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_login
 *
 * @createtime 2014-10-22 10:08:19
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_login extends CI_Controller {

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_login_model');
        $this->lang->load('admin_login');
    }

    /**
     *
     * @todo 默认方法
     *
     */
    public function index() {
        redirect('/admin_login/login');
    }

    /**
     *
     * @todo 载入登录
     *
     */
    public function login() {
        $this->load->view('backend/login/login');
    }

    /**
     *
     * @todo 登录操作
     *
     */
    public function dologin() {
        $msg = array(
            'flag' => 0,
            'error' => '',
        );
        $data['account'] = $this->input->post('account');
        $data['password'] = md5(sha1($this->input->post('password')) . $data['account']);
        $user = $this->admin_login_model->checkUser($data);
        if (!empty($user)) {
            $this->comm->set_session('user_id', $user->id);
            $this->comm->set_session('username', $user->username);
            $userarr = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'account' => $user->account,
                'email' => $user->email,
                'telphone' => $user->telphone,
                'power' => $user->power,
                'powervalue' => $user->powervalue,
                'powername' => $user->powername
            );
            $this->comm->set_session('user', json_encode($userarr));
            $this->comm->set_session('power', $user->powervalue);
            $msg['flag'] = 1;
            $msg['error'] = lang('login_success');
        } else {
            $msg['error'] = lang('login_error');
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 登出
     *
     */
    public function logout() {
        $this->comm->del_session('user_id');
        $this->comm->del_session('username');
        $this->comm->del_session('user');
        $this->comm->del_session('power');
        $this->index();
    }

}

?>
