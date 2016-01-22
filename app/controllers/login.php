<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @createtime 2015-4-7 16:38:19
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class login extends Frontend_Controller {

    private $user;

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
        $this->user = $this->comm->get_session('user');
    }

    /**
     * 
     * @todo  载入登录界面
     * 
     */
    public function index() {
        if($this->user>0){
            redirect("/");
        }
        //加载头部信息
        $header = array(
            'title' => "泛丁网_登录",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'login'
        );
        $from = '/';
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
            $from = $_SERVER['HTTP_REFERER'];
        }
        if (strrpos($from, 'register') || strrpos($from, 'forget') || strrpos($from, 'phonelogin')) {
            $from = '/';
        }
        $data['from'] = $from;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/login/login', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 检查登录信息 
     * 
     */
    public function chenckLogin() {
        $msg = array('flag' => 0, 'error' => '');
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        if ($account != '' && $password != '') {
            $password = md5($password);
            if ($this->register_model->checkAccountIsSet($account, $password)) {
                $msg['flag'] = 1;
                $msg['error'] = "可登录成功!";
            } else {
                $msg['error'] = '账户/密码有误';
            }
        } else {
            $msg['error'] = "账号/密码不可以为空!";
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 进行登录操作 
     * 
     */
    public function dologin() {
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        $from = $this->input->post('from_url');
        if ($account != '' && $password != '') {
            $password = md5($password);
            $user = $this->register_model->getUserInfo($account, $password);
            if (!empty($user)) {
                //获取上次登录时间
                $last = $this->register_model->getLastLogin($user->id);
                //添加本次登录记录
                $data = array(
                    'uid' => $user->id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->register_model->addThisLogin($data);
                $avatar = array('middle' => '', 'small' => '');
                if ($user->avatar != '') {
                    $avatar = explode('_', $user->avatar);
                    if (count($avatar) == 3) {
                        $avatar['middle'] = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                        $avatar['small'] = $avatar[0] . '_' . $avatar[1] . '_small.jpg';
                    }
                }
                $member = array(
                    'user_id' => $user->id,
                    'account' => $user->account,
                    'user_name' => $user->username,
                    'email' => $user->email,
                    'telphone' => $user->telphone,
                    'avatar_big' => $user->avatar,
                    'avatar_middle' => $avatar['middle'],
                    'avatar_small' => $avatar['small'],
                    'lastlogin' => $last->logintime,
                    'lastip' => $last->loginip
                );
                $this->comm->set_session('member', json_encode($member));
                $this->comm->set_session('user', $user->id);
                redirect($from);
            } else {
                redirect('/login');
            }
        } else {
            redirect('/login');
        }
    }

    /**
     * 
     * @todo 手机号码进行登录操作 
     * 
     */
    public function phonelogin() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $tellphone = $_data['phonenumber'] ? $_data['phonenumber'] : 0;
            $varifycode = $_data['varify'] ? $_data['varify'] : 0;
            $phonecode = $_data['phonecode'] ? $_data['phonecode'] : 0;
            //检查手机号码是否合法
            if (!$this->comm->checkPhone($tellphone)) {
                redirect('/login/phonelogin');
            }
            //检查图形验证码是否正确
            if ($varifycode != $this->comm->get_session('varifyCode')) {
                redirect('/login/phonelogin');
            }
            //检查手机验证码
            if (!$this->register_model->checkPhoneCode($tellphone, $phonecode)) {
                redirect('/login/phonelogin');
            }
            $data = array(
                'account' => trim($tellphone),
                'password' => md5('未设置'),
                'trade_password' => md5('未设置'),
                'username' => trim($tellphone),
                'email' => '',
                'telphone' => trim($tellphone),
                'addtime' => date('Y-m-d H:i:s', time())
            );
            //检查手机号码是否已经注册
            if ($this->register_model->checkPhone($tellphone)) {
                //已经注册
                //获取用户信息
                $user = $this->register_model->getUserByCellPhone($tellphone);
                if (empty($user)) {
                    redirect('/login/phonelogin');
                }
                //修改验证码状态
                $code_status=array(
                    'status' => 2
                );
                $this->register_model->editPhoneCodeStatus($code_status, $tellphone, $phonecode);
                //获取上次登录时间
                $last = $this->register_model->getLastLogin($user->id);
                //添加本次登录记录
                $datas = array(
                    'uid' => $user->id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->register_model->addThisLogin($datas);
                $avatar = array('middle' => '', 'small' => '');
                if ($user->avatar != '') {
                    $avatar = explode('_', $user->avatar);
                    if (count($avatar) == 3) {
                        $avatar['middle'] = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                        $avatar['small'] = $avatar[0] . '_' . $avatar[1] . '_small.jpg';
                    }
                }
                $member = array(
                    'user_id' => $user->id,
                    'account' => $user->account,
                    'user_name' => $user->username,
                    'email' => $user->email,
                    'telphone' => $user->telphone,
                    'avatar_big' => $user->avatar,
                    'avatar_middle' => $avatar['middle'],
                    'avatar_small' => $avatar['small'],
                    'lastlogin' => $last->logintime,
                    'lastip' => $last->loginip
                );
                $this->comm->set_session('member', json_encode($member));
                $this->comm->set_session('user', $user->id);
                redirect('/');
            } else {
                //未注册
                $code_status = array(
                    'status' => 2
                );
                //修改验证码状态
                if ($this->register_model->editPhoneCodeStatus($code_status, $tellphone, $phonecode)) {
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
                        redirect('/login/phonelogin');
                    }
                } else {
                    redirect('/login/phonelogin');
                }
            }
        } else {
            $this->comm->del_session('member');
            $this->comm->del_session('user');
            //加载头部信息
            $header = array(
                'title' => "泛丁网_登录",
                'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
                'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
                . "注册资金1000万，办公地点位于杭州市拱墅区。",
                'cusor' => 'login'
            );
            $from = '/';
            $data['from'] = $from;
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/login/phonelogin', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * 检查手机登录信息的准确性 
     * 
     */
    public function chenckPhoneLogin() {
        $_data = $this->input->post();
        $tellphone = $_data['phonenumber'] ? $_data['phonenumber'] : 0;
        $varifycode = $_data['varify'] ? $_data['varify'] : 0;
        $phonecode = $_data['phonecode'] ? $_data['phonecode'] : 0;
        $msg = array(
            'flag' => 0,
            'error' => ""
        );
        //检查手机号码是否合法
        if (!$this->comm->checkPhone($tellphone)) {
            $msg['error'] = "手机号码不合法!";
            echo json_encode($msg);
            exit;
        }
        //检查图形验证码是否正确
        if ($varifycode != $this->comm->get_session('varifyCode')) {
            $msg['error'] = "图片验证码错误!";
            echo json_encode($msg);
            exit;
        }
        //检查手机验证码
        if (!$this->register_model->checkPhoneCode($tellphone, $phonecode)) {
            $msg['error'] = '手机验证码不正确或者过期!';
            echo json_encode($msg);
            exit;
        }
        $msg['flag'] = 1;
        $msg['error'] = '验证通过';
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 登出
     * 
     */
    public function logout() {
        $this->comm->del_session('member');
        $this->comm->del_session('user');
        redirect('/');
    }

}

?>
