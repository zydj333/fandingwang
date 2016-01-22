<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of forget
 *
 * @createtime 2015-4-7 17:03:55
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * 忘记密码
 *
 */
class forget extends Frontend_Controller {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_找回密码",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'login'
        );
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/forget/index');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 检查验证码是否正常 
     * 
     */
    public function checkcode() {
        $phone = $this->input->post('phone');
        $code = $this->input->post('code');
        $msg = array('flag' => 0, 'error' => '');
        if ($this->register_model->checkPhoneCode($phone, $code)) {
            $msg['flag'] = 1;
            $msg['error'] = '验证码正确！';
        } else {
            $msg['error'] = '验证码错误！';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 验证验证码 
     * 
     */
    public function checkcellphonecode() {
        $phone = $this->input->post('cellphone');
        $code = $this->input->post('phonecode');
        if ($this->register_model->checkPhoneCode($phone, $code)) {
            $data = array('status' => 2);
            if ($this->register_model->editPhoneCodeStatus($data, $phone, $code)) {
                $this->comm->set_session('phone_num', $phone);
                //加载头部信息
                $header = array(
                    'title' => "泛丁网_找回密码",
                    'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
                    'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
                    . "注册资金1000万，办公地点位于杭州市拱墅区。",
                    'cusor' => 'login'
                );
                $data['phone'] = $phone;
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/forget/setpassword', $data);
                $this->load->view('frontend/public/footer');
            } else {
                redirect('/forget/index');
            }
        } else {
            redirect('/forget/index');
        }
    }

    /**
     * 
     * @todo 检查新密码 
     * 
     */
    public function checkNewPassword() {
        $password = $this->input->post('newpassword');
        $repassword = $this->input->post('repassword');
        $phone = $this->input->post('phone');
        $msg = array('flag' => 0, 'error' => '');
        if (strlen($password) > 5) {
            if ($repassword == $password) {
                if ($phone == $this->comm->get_session('phone_num')) {
                    $data = array('password' => md5($password));
                    if ($this->register_model->editMemberLoginPassword($data, $phone)) {
                        $this->comm->del_session('phone_num');
                        $msg['flag'] = 1;
                        $msg['error'] = '密码已经成功修改，现在就去登录吧！';
                    } else {
                        $msg['error'] = '修改失败，错误未知！';
                    }
                } else {
                    $msg['error'] = '数据丢失，修改失败！';
                }
            } else {
                $msg['error'] = '确认密码错误！';
            }
        } else {
            $msg['error'] = '密码长度不能小于6个字符';
        }
        echo json_encode($msg);
    }

}

?>
