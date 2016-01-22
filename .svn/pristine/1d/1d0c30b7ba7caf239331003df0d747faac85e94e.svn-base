<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_user
 *
 * @createtime 2014-10-21 16:23:51
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_user extends Admin_Controller {

//put your code here
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
        $this->load->model('admin_user_model');
        $this->lang->load('admin_user');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
    }

    /**
     *
     * @todo 后台用户列表
     *
     */
    public function index() {
        $data['user'] = $this->admin_user_model->getUserList();
        $this->load->view('backend/user/index', $data);
    }

    /**
     *
     * @todo 添加用户
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'account' => $_data['account'],
                'password' => $_data['password'],
                'username' => $_data['username'],
                'email' => $_data['email'],
                'telphone' => $_data['telphone'],
                'adder' => $this->user_name,
                'power' => 0,
                'is_del' => 0,
            );
            if ($data['account'] != "" && $data['password'] != "") {
                //检查重复
                if ($this->admin_user_model->checkRepeat($data)) {
                    $data['password'] = md5(sha1($data['password']) . $data['account']);
                    if ($this->admin_user_model->saveAdminUserData($data)) {
                        redirect('admin_user');
                    } else {
                        $this->messageError(lang('error_unknow'), 'admin_user/add');
                    }
                } else {
                    $this->messageError(lang('error_unique'), 'admin_user/add');
                }
            } else {
                $this->messageError(lang('error_requer'), 'admin_user/add');
            }
        } else {
            $this->load->view('backend/user/add');
        }
    }

    /**
     *
     * @todo 修改用户
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $_data = $this->input->post();
                $data = array(
                    'username' => $_data['username'],
                    'email' => $_data['email'],
                    'telphone' => $_data['telphone'],
                );
                if ($this->admin_user_model->editUserByUid($data, $id)) {
                    redirect('admin_user');
                } else {
                    $this->messageError(lang('error_unknow'), 'admin_user/edit/' . $id);
                }
            } else {
                $this->messageError(lang('error_params'), 'admin_user');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['user'] = $this->admin_user_model->getUserById($id);
                $this->load->view('backend/user/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_user');
            }
        }
    }

    /**
     *
     * @todo 删除用户信息
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            if ($this->admin_user_model->delUserById($id)) {
                redirect('admin_user');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_user');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_user');
        }
    }

    /**
     *
     * @todo 用户权限
     *
     */
    public function power() {
        $data['power'] = $this->admin_user_model->getAdminUserPowerList();
        $this->load->view('backend/user/power', $data);
    }

    /**
     *
     * @todo 修改用户权限
     *
     */
    public function editpower() {
        if ($this->input->post()) {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data = array(
                    'power' => $this->input->post('power')
                );
                if ($this->admin_user_model->editUserByUid($data, $id)) {
                    redirect('admin_user/power');
                } else {
                    $this->messageError(lang('error_unknow'), 'admin_user/editpower/' . $id);
                }
            } else {
                $this->messageError(lang('error_params'), 'power');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $this->load->model('admin_power_model');
                $data['power'] = $this->admin_power_model->getPowerList();
                $data['userpower'] = $this->admin_user_model->getUserInfoAndPower($id);
                $this->load->view('backend/user/editpower', $data);
            } else {
                $this->messageError(lang('error_params'), 'power');
            }
        }
    }

    /**
     *
     * @todo 修改用户密码
     *
     */
    public function pwd() {
        if ($this->input->post()) {
            $account = $this->input->post('account');
            $pwd = md5(sha1($this->input->post('start_password')) . $account);
            $new_pwd = $this->input->post('new_password');
            $re_pwd = $this->input->post('repassword');
            if ($new_pwd !== '') {
                if ($new_pwd === $re_pwd) {
                    $password = md5(sha1($new_pwd) . $account);
                    if ($this->admin_user_model->checkUserStartPwd($this->user_id, $pwd)) {
                        $data = array(
                            'password' => $password
                        );
                        if ($this->admin_user_model->editUserByUid($data, $this->user_id)) {
                            redirect('/admin_index/defaultpage');
                        } else {
                            $this->messageError(lang('error_unknow'), 'admin_user/edit/' . $id);
                        }
                    } else {
                        $this->messageError(lang('start_password_error'), 'admin_user/pwd');
                    }
                } else {
                    $this->messageError(lang('new and re password not same'), 'admin_user/pwd');
                }
            } else {
                $this->messageError(lang('new password cant be null'), 'admin_user/pwd');
            }
        } else {
            $data['user'] = $this->admin_user_model->getUserById($this->user_id);
            $this->load->view('backend/user/pwd', $data);
        }
    }

}

?>
