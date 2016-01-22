<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register
 *
 * @createtime 2015-4-7 10:12:55
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * 用户注册
 *
 */
class register extends Frontend_Controller {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    /**
     * 
     * @todo 载入注册页面 
     * 
     */
    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_注册",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'register'
        );
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/register/register');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 检查昵称 
     * 
     */
    public function checkNickName($nickname) {
        $msg = array('flag' => 0, 'error' => '');
        if ($nickname != '') {
            if ($this->register_model->checkNickName($nickname)) {
                $msg['error'] = '该昵称已经被占用!';
            } else {
                $msg['flag'] = 1;
                $msg['error'] = '该昵称可以使用!';
            }
        } else {
            $msg['error'] = '昵称不可以为空！';
        }
        return $msg;
    }

    /**
     * 
     * @todo 检查邮箱
     * 
     */
    public function checkEmail($email) {
        $msg = array('flag' => 0, 'error' => '');
        if ($email != '') {
            if ($this->comm->is_email($email)) {
                if ($this->register_model->checkEmail($email)) {
                    $msg['error'] = '该邮箱已经被占用!';
                } else {
                    $msg['flag'] = 1;
                    $msg['error'] = '该邮箱可以使用!';
                }
            } else {
                $msg['error'] = '邮箱格式不正确!';
            }
        } else {
            $msg['error'] = '邮箱不可以为空！';
        }
        return $msg;
    }

    /**
     * 
     * @todo 检查手机 
     * 
     */
    public function checkPhone($phonenumber) {
        $msg = array('flag' => 0, 'error' => '');
        if ($phonenumber != '') {
            if ($this->comm->checkPhone($phonenumber)) {
                if ($this->register_model->checkPhone($phonenumber)) {
                    $msg['error'] = '该手机号码已经被占用!';
                } else {
                    $msg['flag'] = 1;
                    $msg['error'] = '该手机号码可以使用!';
                }
            } else {
                $msg['error'] = '手机号码格式不正确!';
            }
        } else {
            $msg['error'] = '手机号码不可以为空！';
        }
        return $msg;
    }

    /**
     * 
     * @todo 检查验证码 
     * 
     */
    public function checkPhoneCode($phonenumber, $phonecode) {
        $msg = array('flag' => 0, 'error' => '');
        if ($phonenumber != '' && $phonecode != '') {
            if ($this->register_model->checkPhoneCode($phonenumber, $phonecode)) {
                $msg['flag'] = 1;
                $msg['error'] = '手机验证码可用!';
            } else {
                $msg['error'] = '手机验证码不正确或者过期!';
            }
        } else {
            $msg['error'] = '手机验证码不可以为空！';
        }
        return $msg;
    }

    /**
     * 
     * @todo 检查注册
     * 
     */
    public function checkRegister() {
        $_data = $this->input->post();
        $accounts=trim($_data['account']);
        $data = array(
            'account' => trim($accounts),
            'password' => trim($_data['password']),
            'trade_password' => trim($_data['repassword']),
            'username' => trim($_data['account']),
            'email' => trim($_data['email']),
            'telphone' => trim($_data['cellphone'])
        );
        if(strlen($data['account'])>15){
            $account['flag'] = 8;
            $account['error'] = '账号长度不能超过15';
            echo json_encode($account);
            exit;
        }
        $phonecode = trim($_data['phonecode']);
        $account = $this->checkNickName($data['account']);
        if ($account['flag'] == 0) {
            $account['flag'] = 2;
            echo json_encode($account);
            exit;
        }
        if ($data['password'] == '') {
            $code['flag'] = 6;
            $code['error'] = '密码不能为空';
            echo json_encode($code);
            exit;
        }
        if ($data['password'] != $data['trade_password']) {
            $code['flag'] = 7;
            $code['error'] = '两次输入的密码不一致';
            echo json_encode($code);
            exit;
        }

        $email = $this->checkEmail($data['email']);
        if ($email['flag'] == 0) {
            $email['flag'] = 3;
            echo json_encode($email);
            exit;
        }
        $phone = $this->checkPhone($data['telphone']);
        if ($phone['flag'] == 0) {
            $phone['flag'] = 4;
            echo json_encode($phone);
            exit;
        }
        $code = $this->checkPhoneCode($data['telphone'], $phonecode);
        if ($code['flag'] == 0) {
            $code['flag'] = 5;
            echo json_encode($code);
            exit;
        }
        $msg = array(
            'flag' => 1,
            'error' => "验证通过！等待提交表单！",
        );
        echo json_encode($msg);
        exit;
    }
    

    /**
     * 
     * @todo 执行注册操作 
     * 
     */
    public function doregiter() {
        $_data = $this->input->post();
        $account=trim($_data['account']);
        $data = array(
            'account' => trim($account),
            'password' => trim($_data['password']),
            'trade_password' => trim($_data['repassword']),
            'username' => trim($_data['account']),
            'email' => trim($_data['email']),
            'telphone' => trim($_data['cellphone']),
            'addtime'=>date('Y-m-d H:i:s',time())
        );
        $phonecode = trim($_data['phonecode']);
        $data['password'] = md5($data['password']);
        $data['trade_password'] = md5($data['trade_password']);
        $code_status = array(
            'status' => 2
        );
        //修改验证码状态
        if ($this->register_model->editPhoneCodeStatus($code_status, $data['telphone'], $phonecode)) {
            $data['real_phone'] = 1;
            $data['real_count'] = 1;
            $u_id = $this->register_model->saveMemberAccount($data);
            if ($u_id > 0) {
                //添加本次登录记录
                $data_log = array(
                    'uid' => $u_id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->register_model->addThisLogin($data_log);
                $member = array(
                    'user_id' => $u_id,
                    'account' => $data['account'],
                    'user_name' => $data['account'],
                    'email' => $data['email'],
                    'telphone' => $data['telphone'],
                    'avatar_big' => '',
                    'avatar_middle' => '',
                    'avatar_small' => '',
                    'lastlogin' => $data_log['logintime'],
                    'lastip' => $data_log['loginip'],
                );
                $this->comm->set_session('member', json_encode($member));
                $this->comm->set_session('user', $u_id);
                redirect('/');
            } else {
                redirect('/register');
            }
        } else {
            redirect('/register');
        }
    }

}

?>
