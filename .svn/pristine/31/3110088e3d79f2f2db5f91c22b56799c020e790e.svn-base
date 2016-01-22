<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mobile
 *
 * @createtime 2015-5-22 16:42:37
 * 
 * @author ZhangPing'an
 * 
 * @todo mobile
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class mobile extends CI_Controller {

    protected $user_id;
    protected $member;
    protected $pagesize = 10;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('mobile_model');
        $this->user_id = $this->comm->get_session('user');
        $this->member = json_decode($this->comm->get_session('member'));
    }

    public function index() {
        $project = $this->mobile_model->getProjectListByCount(20);
        $article = $this->mobile_model->getArticleListByCount(3);
        $data['project'] = $project;
        $data['article'] = $article;
        $header = array(
            'member' => $this->member,
            'seo_title' => '泛丁首页',
            'cusor' => 'index',
        );
        $this->load->view('frontend/mobile/header', $header);
        $this->load->view('frontend/mobile/index', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 项目列表 
     * 
     */
    public function Project() {
        $status = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'status' => $status,
        );
        $count = $this->mobile_model->getProjectCount($search);
        $list = $this->mobile_model->getProjectList($search);
        $header = array(
            'member' => $this->member,
            'seo_title' => '项目列表',
            'cusor' => 'project',
        );
        $this->load->view('frontend/mobile/header', $header);
        $data['count'] = $count;
        $data['project'] = $list;
        $data['status'] = $status;
        $data['pagesize'] = $this->pagesize;
        $data['start'] = $this->pagesize;
        $this->load->view('frontend/mobile/project', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 异步获取项目列表 
     * 
     */
    public function projectAjaxList() {
        $status = $this->input->post('status') ? $this->input->post('status') : 1;
        $start = $this->input->post('start') ? $this->input->post('start') : 0;
        $search = array(
            'start' => $start,
            'pagesize' => $this->pagesize,
            'status' => $status,
        );
        $count = $this->mobile_model->getProjectCount($search);
        $list = $this->mobile_model->getProjectList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $percent = bcdiv($v->support_amount, $v->amount, 5);
                $list[$k]->percent = bcmul($percent, 100, 2);
            }
            $data = array(
                'flag' => 1,
                'count' => $count,
                'list' => $list,
                'maxsearch' => $start + $this->pagesize,
                'start' => $start
            );
        } else {
            $data['flag'] = 0;
        }
        echo json_encode($data);
    }

    /**
     * 
     * @todo 项目详情 
     * 
     */
    public function projectDetial() {
        $pid = $this->uri->segment(3);
        if ($pid > 0) {
            $project = $this->mobile_model->getProjectDetialById($pid);
            if (!empty($project)) {
                $header = array(
                    'member' => $this->member,
                    'seo_title' => '项目列表',
                    'cusor' => 'project',
                );
                $this->load->view('frontend/mobile/header', $header);
                $data['project'] = $project;
                $items = $this->mobile_model->getProjectItems($pid);
                $data['items'] = $items;
                $data['member'] = $this->member;
                //var_dump($data);die;
                $this->load->view('frontend/mobile/projectDetial', $data);
                $this->load->view('frontend/mobile/footer');
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
            redirect('/mobile/showErrorNotFound');
        }
    }

    /**
     * 
     * @todo 载入注册页面 
     * 
     */
    public function register() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $account = trim($_data['account']);
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            $mobile = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/";
            if (preg_match($pattern, $account)) {
                $data = array(
                    'account' => trim($_data['account']),
                    'password' => '',
                    'trade_password' => '',
                    'username' => trim($_data['account']),
                    'user_type' => 1,
                    'email' => trim($_data['account']),
                    // 'telphone' => trim($_data['cellphone']),
                    'real_phone' => 1,
                    'real_count' => 1,
                    'addtime' => date('Y-m-d H:i:s', time())
                );
                if ($data['account'] != '' && $_data['password'] != '') {
                    $password = trim($_data['password']);
                    $phonecode = trim($_data['phoneCode']);
                    $data['password'] = $data['trade_password'] = md5($password);
                    $u_id = $this->mobile_model->saveMember($data);
                    if ($u_id > 0) {
                        $this->mobile_model->editPhoneCodeStatus($data['telphone'], $phonecode);
                        //添加本次登录记录
                        $data_log = array(
                            'uid' => $u_id,
                            'logintime' => time(),
                            'loginip' => $this->comm->real_ip()
                        );
                        $this->mobile_model->addThisLogin($data_log);
                        $member = array(
                            'user_id' => $u_id,
                            'account' => $data['account'],
                            'user_name' => $data['account'],
                            'email' => $data['email'],
                            //'telphone' => $data['telphone'],
                            'avatar_big' => '',
                            'avatar_middle' => '',
                            'avatar_small' => '',
                            'lastlogin' => $data_log['logintime'],
                            'lastip' => $data_log['loginip'],
                        );
                        $this->comm->set_session('member', json_encode($member));
                        $this->comm->set_session('user', $u_id);
                        redirect('/mobile/index');
                    } else {
                        redirect('/mobile/showErrorNotFound');
                    }
                } else {
                    redirect('/mobile/showErrorNotFound');
                }
            } elseif (preg_match($mobile, $account)) {
                $data = array(
                    'account' => trim($_data['account']),
                    'password' => '',
                    'trade_password' => '',
                    'username' => trim($_data['account']),
                    'user_type' => 1,
                    //'email' => trim($_data['account']),
                    'telphone' => trim($_data['account']),
                    'real_phone' => 1,
                    'real_count' => 1,
                    'addtime' => date('Y-m-d H:i:s', time())
                );
                if ($data['account'] != '' && $_data['password'] != '') {
                    $password = trim($_data['password']);
                    $phonecode = trim($_data['phoneCode']);
                    $data['password'] = $data['trade_password'] = md5($password);
                    $u_id = $this->mobile_model->saveMember($data);
                    if ($u_id > 0) {
                        $this->mobile_model->editPhoneCodeStatus($data['telphone'], $phonecode);
                        //添加本次登录记录
                        $data_log = array(
                            'uid' => $u_id,
                            'logintime' => time(),
                            'loginip' => $this->comm->real_ip()
                        );
                        $this->mobile_model->addThisLogin($data_log);
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
                        redirect('/mobile/index');
                    } else {
                        redirect('/mobile/showErrorNotFound');
                    }
                } else {
                    redirect('/mobile/showErrorNotFound');
                }
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
            $header = array(
                'member' => $this->member,
                'seo_title' => '账户注册',
                'cusor' => 'register',
            );
            $this->load->view('frontend/mobile/header', $header);
            $this->load->view('frontend/mobile/register');
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     * 
     * @todo 检查注册信息是否合法 
     * 
     */
    public function checkRegister() {
        $_data = $this->input->post();
        $msg = array('flag' => 0, 'error' => "");
        if ($_data['account'] == '') {
            $msg['error'] = "账户名称不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($_data['password'] == '') {
            $msg['error'] = "账户密码不能为空！";
            echo json_encode($msg);
            exit;
        }
        if ($_data['repassword'] != $_data['password']) {
            $msg['error'] = "两次输入的密码不一致！";
            echo json_encode($msg);
            exit;
        }
//        if ($_data['email'] == '') {
//            $msg['error'] = "邮箱地址不能为空！";
//            echo json_encode($msg);
//            exit;
//        }
//        if ($_data['cellphone'] == '') {
//            $msg['error'] = "手机号码不能为空！";
//            echo json_encode($msg);
//            exit;
//        }
        if ($_data['cellcode'] == '') {
            $msg['error'] = "验证码不能为空！";
            echo json_encode($msg);
            exit;
        }
        //检查用户是否合法
//        if ($this->mobile_model->checkAccount($_data['account'])) {
//            $msg['error'] = "该昵称已经被占用！";
//            echo json_encode($msg);
//            exit;
//        }
        //邮箱是否合法
//        if ($this->mobile_model->checkEmail($_data['email'])) {
//            $msg['error'] = "邮箱已经存在！";
//            echo json_encode($msg);
//            exit;
//        }
        if ($this->comm->is_email($_data['account'])) {
            if ($this->mobile_model->checkEmail($_data['account'])) {
                $msg['error'] = "邮箱已经存在！";
                echo json_encode($msg);
                exit;
            }
            //验证码是否正确
            if (!$this->mobile_model->checkEmailCode($_data['account'], $_data['cellcode'])) {
                $msg['error'] = "验证码错误！";
                echo json_encode($msg);
                exit;
            }
        } elseif ($this->comm->checkPhone($_data['account'])) {
            if ($this->mobile_model->checkCellphone($_data['account'])) {
                $msg['error'] = "该手机号码已经注册！";
                echo json_encode($msg);
                exit;
            }
            //验证码是否正确
            if (!$this->mobile_model->checkPhoneCode($_data['account'], $_data['cellcode'])) {
                $msg['error'] = "验证码错误！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = "帐户名类型仅限于邮箱和手机号！";
            echo json_encode($msg);
            exit;
        }

        //手机是否合法
//        if (!$this->comm->checkPhone($_data['cellphone'])) {
//            $msg['error'] = "手机格式不正确！";
//            echo json_encode($msg);
//            exit;
//        }
//        if ($this->mobile_model->checkCellphone($_data['cellphone'])) {
//            $msg['error'] = "该手机号码已经注册！";
//            echo json_encode($msg);
//            exit;
//        }
//        //验证码是否正确
//        if (!$this->mobile_model->checkPhoneCode($_data['cellphone'], $_data['phoneCode'])) {
//            $msg['error'] = "短信验证码错误！";
//            echo json_encode($msg);
//            exit;
//        }
        //检查图形验证码是否正确
        if ($_data['varify'] != $this->comm->get_session('varifyCode')) {
            $msg['error'] = "图片验证码错误!";
            echo json_encode($msg);
            exit;
        }
        $msg['flag'] = 1;
        $msg['error'] = "已经验证通过正在提交数据！";
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 载入登录 
     * 
     */
    public function login() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $account = trim($_data['account']);
            $password = trim($_data['password']);
            //$from = $_data['from_url'];
            $user = $this->mobile_model->getAccountByAccount($account, md5($password));
            if (!empty($user)) {
                //获取上次登录时间
                $last = $this->mobile_model->getLastLogin($user->id);
                //添加本次登录记录
                $data = array(
                    'uid' => $user->id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->mobile_model->addThisLogin($data);
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
                redirect('/mobile');
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
//            $from = '/mobile/center';
//            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
//                $from = $_SERVER['HTTP_REFERER'];
//            }
//            if (strrpos($from, 'register') || strrpos($from, 'login')) {
//                $from = '/mobile/center';
//            }
//            $data['from'] = $from;
            if (!empty($this->member)) {
                redirect('mobile/index');
            }
            $header = array(
                'member' => $this->member,
                'seo_title' => '账户登录',
                'cusor' => 'login',
            );
            $this->load->view('frontend/mobile/header', $header);
            $this->load->view('frontend/mobile/login');
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     *
     *  @todo 检查用户的账户密码 
     * 
     */
    public function checkAccount() {
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        $msg = array('flag' => 0, 'error' => "");
        if ($account == '' || $password == '') {
            $msg['error'] = "账号/密码不能为空！";
            echo json_encode($msg);
            exit;
        }
        if ($this->mobile_model->checkAccountInfo($account, md5($password))) {
            $msg['flag'] = 1;
            $msg['error'] = "信息验证中，正在登录！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "账号密码错误！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 手机号码进行登录操作 
     * 
     */
    public function celllogin() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'account' => trim($_data['phonenumber']),
                'password' => md5('未设置'),
                'trade_password' => md5('未设置'),
                'username' => trim($_data['phonenumber']),
                'user_type' => 1,
                'email' => '',
                'telphone' => trim($_data['phonenumber']),
                'real_phone' => 1,
                'real_count' => 1,
                'addtime' => date('Y-m-d H:i:s', time())
            );
            $msg['flag'] = 0;
            $msg['error'] = '';
            if (!$this->comm->checkPhone($data['telphone'])) {
                $msg['error'] = "手机格式错误！";
                echo json_encode($msg);
                exit;
            }
            if (!$this->mobile_model->checkPhoneCode($_data['phonenumber'], $_data['cellcode'])) {
                $msg['error'] = "短信验证码错误！";
                echo json_encode($msg);
                exit;
            }
            if (!$_data['varify'] == $this->comm->get_session('varifyCode')) {
                $msg['error'] = "图片验证码错误！";
                echo json_encode($msg);
                exit;
            }
            if ($this->mobile_model->checkCellphone($data['telphone'])) {
                //已注册
                //获取用户信息
                $user = $this->mobile_model->getAccountByPhoneNumber($data['telphone']);
                if (!empty($user)) {
                    //修改短信状态
                    $this->mobile_model->editPhoneCodeStatus($data['telphone'], $_data['cellcode']);
                    //获取上次登录时间
                    $last = $this->mobile_model->getLastLogin($user->id);
                    //添加本次登录记录
                    $datas = array(
                        'uid' => $user->id,
                        'logintime' => time(),
                        'loginip' => $this->comm->real_ip()
                    );
                    $this->mobile_model->addThisLogin($datas);
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
                    $msg['flag'] = 1;
                    $msg['error'] = "登录成功";
                    echo json_encode($msg);
                    exit;
                }
            } else {
                //未注册
                $u_id = $this->mobile_model->saveMember($data);
                if ($u_id > 0) {
                    //修改短信状态
                    $this->mobile_model->editPhoneCodeStatus($data['telphone'], $_data['cellcode']);
                    //添加本次登录记录
                    $data_log = array(
                        'uid' => $u_id,
                        'logintime' => time(),
                        'loginip' => $this->comm->real_ip()
                    );
                    $this->mobile_model->addThisLogin($data_log);
                    $member = array(
                        'user_id' => $u_id,
                        'account' => $data['telphone'],
                        'user_name' => $data['telphone'],
                        'email' => '',
                        'telphone' => $data['telphone'],
                        'avatar_big' => '',
                        'avatar_middle' => '',
                        'avatar_small' => '',
                        'lastlogin' => $data_log['logintime'],
                        'lastip' => $data_log['loginip'],
                    );
                    $this->comm->set_session('member', json_encode($member));
                    $this->comm->set_session('user', $u_id);
                    $msg['flag'] = 1;
                    $msg['error'] = "登录成功";
                    echo json_encode($msg);
                    exit;
                }
            }
        } else {
            $data['from'] = '/mobile/center';
            $header = array(
                'member' => $this->member,
                'seo_title' => '手机号码登录',
                'cusor' => 'login',
            );
            $this->load->view('frontend/mobile/header', $header);
            $this->load->view('frontend/mobile/celllogin', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     *
     * @todo 登出 
     * 
     */
    public function logout() {
        $this->comm->del_session('member');
        $this->comm->del_session('user');
        redirect('/mobile/index');
    }

    /**
     * 
     * @todo 参与支持
     * 
     */
    public function support() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $items_id = $_data['items_id'] ? $_data['items_id'] : 0;
            $project_id = $_data['project_id'];
            $address_id = $_data['address'] ? $_data['address'] : 0;
            if ($items_id == 0) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取购买子项详情
            $items = $this->mobile_model->getProjectItemsById($items_id);
            if (empty($items)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取项目详情
            $project = $this->mobile_model->getProjectDetialById($items->pid);
            if (empty($project)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取地址详情
            $address = array();
            if ($address_id > 0) {
                $address = $this->mobile_model->getAddressInfo($address_id);
            }
            $data = array(
                'order_num' => $this->comm->createOrderSn(),
                'pid' => $items->pid,
                'pname' => $project->title,
                'items_id' => $items_id,
                'price' => $items->price,
                'buy_number' => $_data['buy_number'] ? $_data['buy_number'] : 1,
                'amount' => 0,
                'mail_fee' => $items->mail_fee,
                'total_amount' => 0,
                'step_status' => 0,
                'suggest' => $_data['description'],
                'uid' => $user->user_id,
                'username' => '',
                'cellphone' => '',
                'province' => 0,
                'province_name' => '',
                'city' => 0,
                'city_name' => '',
                'area' => 0,
                'area_name' => '',
                'address' => '',
                'addtime' => time(),
                'paytime' => 0,
                'repaytime' => 0,
                'address_id' => $address_id,
                'type' => 0
            );
            $data['amount'] = bcmul($data['price'], $data['buy_number'], 2);
            $data['total_amount'] = bcadd($data['amount'], $data['mail_fee'], 2);
            if (!empty($address)) {
                $data['username'] = $address->username;
                $data['cellphone'] = $address->cellphone;
                $data['province'] = $address->province;
                $data['province_name'] = $address->province_name;
                $data['city'] = $address->city;
                $data['city_name'] = $address->city_name;
                $data['area'] = $address->area;
                $data['area_name'] = $address->area_name;
                $data['address'] = $address->address;
            }
            //保存订单信息
            $order_id = $this->mobile_model->saveOrder($data);
            if ($order_id > 0) {
                redirect('/mobile/orderConform/' . $data['order_num']);
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
            $items_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($items_id == 0) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取购买子项详情
            $items = $this->mobile_model->getProjectItemsById($items_id);
            if (empty($items)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取项目详情
            $project = $this->mobile_model->getProjectDetialById($items->pid);
            if (empty($project)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取地址列表
            $address = $this->mobile_model->getUserAddressList($user->user_id);
            $header = array(
                'member' => $this->member,
                'seo_title' => '填写信息！',
                'cusor' => 'project',
            );
            $this->load->view('frontend/mobile/header', $header);
            $data['items'] = $items;
            $data['project'] = $project;
            $data['address'] = $address;
            $this->load->view('frontend/mobile/support', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     * 
     * @todo 获取用户的所有地址 
     * 
     */
    public function getMemberAllAddress() {
        $user = $this->member;
        $address = $this->mobile_model->getUserAddressList($user->user_id);
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($address)) {
            $msg['flag'] = 1;
            $msg['error'] = $address;
        } else {
            $msg['error'] = '检测到您并没有添加收货地址';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 用户收货地址添加
     * 
     */
    public function center_address_add() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => '');
            if ($_data['username'] != '' && $_data['cellphone'] != '' && $_data['province'] != 0 && $_data['city'] != 0 && $_data['area'] != 0 && $_data['address'] != '') {
                $data = array(
                    'uid' => $user->user_id,
                    'username' => trim($_data['username']),
                    'cellphone' => trim($_data['cellphone']),
                    'province' => $_data['province'],
                    'province_name' => '',
                    'city' => $_data['city'],
                    'city_name' => '',
                    'area' => $_data['area'],
                    'area_name' => '',
                    'address' => trim($_data['address']),
                    'is_default' => $this->input->post('is_default') ? $this->input->post('is_default') : 0,
                    'addtime' => time(),
                );
                $province = $this->mobile_model->getProvinceCityAreaById($data['province']);
                $city = $this->mobile_model->getProvinceCityAreaById($data['city']);
                $area = $this->mobile_model->getProvinceCityAreaById($data['area']);
                if (!empty($province)) {
                    $data['province_name'] = $province->name;
                }
                if (!empty($city)) {
                    $data['city_name'] = $city->name;
                }
                if (!empty($area)) {
                    $data['area_name'] = $area->name;
                }
                if ($data['is_default'] == 1) {
                    $this->mobile_model->editDefaultAddress($data['uid']);
                }
                $id = $this->mobile_model->saveAddress($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = "保存成功!";
                    echo json_encode($msg);
                    exit;
                } else {
                    $msg['error'] = "保存失败，未知错误!";
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = "信息请填写/选择完整!";
                echo json_encode($msg);
                exit;
            }
        } else {
            $province = $this->mobile_model->getProvinceCityArea();
            $data['province'] = $province;
            $this->load->view('frontend/mobile/center_address_add', $data);
        }
    }

    /**
     *
     * @todo 用户收货地址修改 
     * 
     */
    public function center_address_edit() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => '');
            if ($_data['username'] != '' && $_data['cellphone'] != '' && $_data['province'] != 0 && $_data['city'] != 0 && $_data['area'] != 0 && $_data['address'] != '') {
                $data = array(
                    'username' => trim($_data['username']),
                    'cellphone' => trim($_data['cellphone']),
                    'province' => $_data['province'],
                    'province_name' => '',
                    'city' => $_data['city'],
                    'city_name' => '',
                    'area' => $_data['area'],
                    'area_name' => '',
                    'address' => trim($_data['address']),
                    'is_default' => $this->input->post('is_default') ? $this->input->post('is_default') : 0,
                );
                $province = $this->mobile_model->getProvinceCityAreaById($data['province']);
                $city = $this->mobile_model->getProvinceCityAreaById($data['city']);
                $area = $this->mobile_model->getProvinceCityAreaById($data['area']);
                if (!empty($province)) {
                    $data['province_name'] = $province->name;
                }
                if (!empty($city)) {
                    $data['city_name'] = $city->name;
                }
                if (!empty($area)) {
                    $data['area_name'] = $area->name;
                }
                if ($data['is_default'] == 1) {
                    $this->mobile_model->editDefaultAddress($user->user_id);
                }
                $add_id = $_data['address_id'] ? $_data['address_id'] : 0;
                if ($add_id == 0) {
                    $msg['error'] = "保存失败，参数丢失!";
                    echo json_encode($msg);
                    exit;
                }
                if ($this->mobile_model->saveAddressEdit($data, $add_id)) {
                    $msg['flag'] = 1;
                    $msg['error'] = "保存成功!";
                    echo json_encode($msg);
                    exit;
                } else {
                    $msg['error'] = "保存失败，未知错误!";
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = "信息请填写/选择完整!";
                echo json_encode($msg);
                exit;
            }
        } else {
            $add_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($add_id == 0) {
                echo '参数错误！';
                exit;
            }
            //获取地址信息
            $address = $this->mobile_model->getAddressInfo($add_id);
            //获取省份列表
            $province = $this->mobile_model->getProvinceCityArea();
            $city = array();
            $area = array();
            if ($address->province > 0) {
                $city = $this->mobile_model->getProvinceCityArea($address->province);
            }
            if ($address->city > 0) {
                $area = $this->mobile_model->getProvinceCityArea($address->city);
            }
            $data['province'] = $province;
            $data['city'] = $city;
            $data['area'] = $area;
            $data['address'] = $address;
            $this->load->view('frontend/mobile/center_address_edit', $data);
        }
    }

    /**
     * 
     * @todo 删除一条地址 
     * 
     */
    public function center_address_del() {
        $user = $this->member;
        $add_id = $this->input->post('add_id') ? $this->input->post('add_id') : 0;
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($user)) {
            if ($add_id == 0) {
                $msg['error'] = "删除失败，参数丢失";
            } else {
                if ($this->mobile_model->delAddressById($add_id)) {
                    $msg['flag'] = 1;
                    $msg['error'] = "修改成功!";
                } else {
                    $msg['error'] = "删除失败，错误未知";
                }
            }
        } else {
            $msg['error'] = "删除失败，登录失效";
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 修改默认地址 
     * 
     */
    public function center_address_default() {
        $user = $this->member;
        $add_id = $this->input->post('add_id') ? $this->input->post('add_id') : 0;
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($user)) {
            if ($add_id == 0) {
                $msg['error'] = "设置失败，参数丢失";
            } else {
                $data['is_default'] = 1;
                $this->mobile_model->editDefaultAddress($user->user_id);
                if ($this->mobile_model->saveAddressEdit($data, $add_id)) {
                    $msg['flag'] = 1;
                    $msg['error'] = "设置成功!";
                } else {
                    $msg['error'] = "设置失败，错误未知";
                }
            }
        } else {
            $msg['error'] = "设置失败，登录失效";
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 获取城市区域 
     * 
     */
    public function getArea() {
        $pid = $this->input->post('pid');
        $msg = array('flag' => 0, 'error' => '');
        $row = $this->mobile_model->getProvinceCityArea($pid);
        if (!empty($row)) {
            $msg['flag'] = 1;
            $msg['error'] = $row;
        } else {
            $msg['error'] = "没有获取到对应信息!";
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 载入订单确认页面 
     * 
     */
    public function orderConform() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $order_sn = $this->uri->segment(3);
        //获取订单详情
        $order = $this->mobile_model->getOrderInfo($order_sn, $user->user_id);
        if (empty($order)) {
            redirect('/mobile/showErrorNotFound');
        }
        //获取购买子项详情
        $items = $this->mobile_model->getProjectItemsById($order->items_id);
        //获取项目详情
        $project = $this->mobile_model->getProjectDetialById($order->pid);
        $header = array(
            'member' => $this->member,
            'seo_title' => '确认订单',
            'cusor' => 'project',
        );
        $this->load->view('frontend/mobile/header', $header);
        $data['order'] = $order;
        $data['items'] = $items;
        $data['project'] = $project;
        $this->load->view('frontend/mobile/support_conform', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 载入订单修改页面 
     * 
     */
    public function supportEdit() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $order_num = $_data['order_num'];
            $address_id = $_data['address'] ? $_data['address'] : 0;
            //获取订单详情
            $order = $this->mobile_model->getOrderInfo($order_num, $user->user_id);
            if (empty($order)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取地址详情
            $address = array();
            if ($address_id > 0) {
                $address = $this->mobile_model->getAddressInfo($address_id);
            }
            //$items = $this->mobile_model->getProjectItemsById($order->items_id);
            $data = array(
                'price' => $order->price,
                'buy_number' => $_data['buy_number'] ? $_data['buy_number'] : 1,
                'amount' => 0,
                'mail_fee' => $order->mail_fee,
                'total_amount' => 0,
                'suggest' => $_data['description'],
                'username' => '',
                'cellphone' => '',
                'province' => 0,
                'province_name' => '',
                'city' => 0,
                'city_name' => '',
                'area' => 0,
                'area_name' => '',
                'address' => '',
                'addtime' => time(),
                'address_id' => $address_id
            );
            $data['amount'] = bcmul($data['price'], $data['buy_number'], 2);
            $data['total_amount'] = bcadd($data['amount'], $data['mail_fee'], 2);
            if (!empty($address)) {
                $data['username'] = $address->username;
                $data['cellphone'] = $address->cellphone;
                $data['province'] = $address->province;
                $data['province_name'] = $address->province_name;
                $data['city'] = $address->city;
                $data['city_name'] = $address->city_name;
                $data['area'] = $address->area;
                $data['area_name'] = $address->area_name;
                $data['address'] = $address->address;
            }
            //保存订单信息修改
            if ($this->mobile_model->saveOrderEdit($data, $order_num)) {
                redirect('/mobile/orderConform/' . $order_num);
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
            $order_sn = $this->uri->segment(3);
            if ($order_sn == '') {
                redirect('/mobile/showErrorNotFound');
            }
            //获取订单详情
            $order = $this->mobile_model->getOrderInfo($order_sn, $user->user_id);
            if (empty($order)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取购买子项详情
            $items = $this->mobile_model->getProjectItemsById($order->items_id);
            //获取项目详情
            $project = $this->mobile_model->getProjectDetialById($order->pid);
            //获取地址列表
            $address = $this->mobile_model->getUserAddressList($user->user_id);
            $header = array(
                'member' => $this->member,
                'seo_title' => '订单修改',
                'cusor' => 'project',
            );
            $this->load->view('frontend/mobile/header', $header);
            $data['order'] = $order;
            $data['items'] = $items;
            $data['project'] = $project;
            $data['address'] = $address;
            $this->load->view('frontend/mobile/support_edit', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     * 
     * @todo 载入订单的支付(PC版)
     * 
     */
    public function orderpay_pc() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $order_sn = $this->uri->segment(3);
        if ($order_sn == '') {
            redirect('/mobile/showErrorNotFound');
        }
        $alipay_params = $this->config->item('alipay_mobile');
        $this->load->helper('alipayfuns');
        //获取订单详情
        $order = $this->mobile_model->getOrderInfo($order_sn, $user->user_id);
        if (empty($order)) {
            redirect('/mobile/showErrorNotFound');
        }
        if ($order->step_status >= 2) {
            redirect('/mobile/showErrorNotFound');
        }
        if ($order->step_status == 0) {
            $status['step_status'] = 1;
            $this->mobile_model->saveOrderEdit($status, $order_sn);
        }
        $data = array();
        $data['order']['number'] = $order->order_num;
        $data['order']['total_fe'] = $order->total_amount;
        $data['order']['subject'] = $order->pname;
        $data['order']['body'] = $order->suggest;
        $alipay_params['show_url'] = base_url() . 'order/orderConform/' . $order->order_num;
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "payment_type" => "1",
            "partner" => trim($alipay_params['partner']),
            "_input_charset" => trim(strtolower($alipay_params['input_charset'])),
            "seller_email" => trim($alipay_params['seller_email']),
            "return_url" => trim($alipay_params['return_url']),
            "notify_url" => trim($alipay_params['notify_url']),
            "out_trade_no" => $data['order']['number'],
            "subject" => $data['order']['subject'],
            "body" => $data['order']['body'],
            "total_fee" => $data['order']['total_fe'],
            "paymethod" => "",
            "defaultbank" => "",
            "anti_phishing_key" => "",
            "exter_invoke_ip" => "",
            "show_url" => trim($alipay_params['show_url']),
            "extra_common_param" => "",
            "royalty_type" => "",
            "royalty_parameters" => ""
        );
        $data['server_url'] = $alipay_params['server_url'];
        $alipayService = new AlipayService($alipay_params);
        $data['para'] = $alipayService->create_direct_pay_by_user($parameter);
        $data['order'] = $order;
        $this->load->view('frontend/mobile/support_pay', $data);
    }

    /**
     * 
     * @todo 支付方法 (手机版)
     * 
     */
    public function orderpay() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $order_sn = $this->uri->segment(3);
        if ($order_sn == '') {
            redirect('/mobile/showErrorNotFound');
        }
        $alipay_params = $this->config->item('alipay_config');
        //print_r($alipay_params);exit;
        $this->load->helper('alipay_mobile');
        //获取订单详情
        $order = $this->mobile_model->getOrderInfo($order_sn, $user->user_id);
        if (empty($order)) {
            redirect('/mobile/showErrorNotFound');
        }
        if ($order->step_status >= 2) {
            redirect('/mobile/showErrorNotFound');
        }
        if ($order->step_status == 0) {
            $status['step_status'] = 1;
            $this->mobile_model->saveOrderEdit($status, $order_sn);
        }
        //商户订单号
        $out_trade_no = $order->order_num;
        //订单名称
        $subject = $order->pname;
        //付款金额
        $total_fee = $order->total_amount;
        //商品展示地址
        $show_url = $alipay_params['show_url'] . '/' . $order->pid;
        //订单描述
        $body = $order->suggest;
        //超时时间
        $it_b_pay = '1c';
        //钱包token
        $extern_token = '';
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "alipay.wap.create.direct.pay.by.user",
            "partner" => trim($alipay_params['partner']),
            "seller_id" => trim($alipay_params['seller_id']),
            "payment_type" => $alipay_params['payment_type'],
            "notify_url" => $alipay_params['notify_url'],
            "return_url" => $alipay_params['return_url'],
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "total_fee" => $total_fee,
            "show_url" => $show_url,
            "body" => $body,
            "it_b_pay" => $it_b_pay,
            "extern_token" => $extern_token,
            "_input_charset" => trim(strtolower($alipay_params['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_params);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "go_to_pay");
        echo $html_text;
    }

    /**
     * 
     * @todo 同步返回地址 
     * 
     */
    public function revals() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        //$this->load->helper('alipay_mobile');
        $inputs = $this->input->get();
        $out_trade_no = $this->input->get('out_trade_no');
        //$trade_no = $this->input->get('trade_no');
        $trade_status = $this->input->get('trade_status');
        if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
            //获取订单信息
            $order = $this->mobile_model->getOrderDetialByOrderSn($out_trade_no);
            if ($order->step_status == 1) {
                $status = array(
                    'step_status' => 2,
                    'paytime' => time()
                );
                //修改订单
                if ($this->mobile_model->saveOrderEdit($status, $out_trade_no)) {
                    //修改项目支持数
                    $this->mobile_model->editProduceItemsSellTotal($order->pid, $order->items_id, $order->buy_number);
                    //修改项目的信息
                    $this->mobile_model->editProductSupport($order->pid, $order->amount, $order->buy_number);
                    //发送通知邮件
                    $email_id = $this->mobile_model->savePayOrderEmail($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    //发送通知短信
                    $phone_quee = $this->mobile_model->savePayOrderMessage($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    $data['flag'] = 1;
                    $data['out'] = "订单支付成功！";
                } else {
                    $data['flag'] = 0;
                    $data['out'] = "通信尚未完成！";
                }
            } else if ($order->step_status == 2) {
                $data['flag'] = 1;
                $data['out'] = "订单支付成功！";
            } else {
                //状态错误
                $data['flag'] = 0;
                $data['out'] = "订单状态错误！";
            }
        } else {
            //数据参数错误。
            $data['flag'] = 0;
            $data['out'] = "数据参数错误！";
        }
        $header = array(
            'member' => $this->member,
            'seo_title' => '支付结果',
            'cusor' => 'project',
        );
        $this->load->view('frontend/mobile/header', $header);
        $data['order'] = $order;
        $this->load->view('frontend/mobile/support_pay_revals', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 异步通知地址
     * 
     */
    public function notify() {
        $order_sn = $this->input->post('out_trade_no');
        $trade_status = $this->input->post('trade_status');
        if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
            $order = $this->mobile_model->getOrderDetialByOrderSn($order_sn);
            if ($order->step_status == 1) {
                $status = array(
                    'step_status' => 2,
                    'paytime' => time()
                );
                //修改订单
                if ($this->mobile_model->saveOrderEdit($status, $order_sn)) {
                    //修改项目支持数
                    $this->mobile_model->editProduceItemsSellTotal($order->pid, $order->items_id, $order->buy_number);
                    //修改项目的信息
                    $this->mobile_model->editProductSupport($order->pid, $order->amount, $order->buy_number);
                    //发送通知邮件
                    $email_id = $this->mobile_model->savePayOrderEmail($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    //发送通知短信
                    $phone_quee = $this->mobile_model->savePayOrderMessage($order->pname, $order->order_num, $order->uid, $order->username, $order->cellphone, $order->amount, $status['paytime']);
                    echo 'success';
                } else {
                    //file_put_contents('/fandingdata/www/aizhongchou/app/logs/'.$order_sn, '订单号:'.$order_sn.'状态:'.$trade_status.'修改订单失败');
                    echo 'fail';
                }
            } else if ($order->step_status == 2) {
                //file_put_contents('/fandingdata/www/aizhongchou/app/logs/'.$order_sn, '订单号:'.$order_sn.'状态:'.$trade_status.'已经是支付成功的订单');
                echo 'success';
            } else {
                //状态错误
                //file_put_contents('/fandingdata/www/aizhongchou/app/logs/'.$order_sn, '订单号:'.$order_sn.'状态:'.$trade_status.'状态错误');
                echo 'fail';
            }
        } else {
            //file_put_contents('/fandingdata/www/aizhongchou/app/logs/'.$order_sn, '订单号:'.$order_sn.'状态:'.$trade_status.'未完成支付');
            echo 'fail';
        }
    }

    /**
     * 
     *
     * @todo 验证消息是否来自支付宝
     *  
     */
    function _verify($inputs) {
        $alipay_params = $this->config->item('alipay_mobile');
        $this->load->helper('alipay_mobile');
        $alipayNotify = new AlipayNotify($alipay_params);
        return $alipayNotify->verifyReturn($inputs);
    }

    /**
     * 
     * @todo 载入个人中心 
     * 
     */
    public function center() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'username' => $_data['username'],
                'gender' => $_data['gander'],
                'birthday' => $_data['birthiday'],
                'job' => $_data['job'],
                'qqnumber' => $_data['qqnumber'],
                'idnumber' => $_data['idnumber'],
                'province_id' => $_data['province'],
                'city_id' => $_data['city'],
                'area_id' => $_data['area'],
                'province' => '',
                'city' => '',
                'area' => '',
                'address' => $_data['address'],
                'discription' => $_data['description'],
            );
            if ($data['province_id'] > 0) {
                $province = $this->mobile_model->getProvinceCityAreaById($data['province_id']);
                if (!empty($province)) {
                    $data['province'] = $province->name;
                }
            }
            if ($data['city_id'] > 0) {
                $city = $this->mobile_model->getProvinceCityAreaById($data['city_id']);
                if (!empty($city)) {
                    $data['city'] = $city->name;
                }
            }
            if ($data['area_id'] > 0) {
                $area = $this->mobile_model->getProvinceCityAreaById($data['area_id']);
                if (!empty($area)) {
                    $data['area'] = $area->name;
                }
            }
            //保存用户个人信息
            $this->mobile_model->editMemberInfo($data, $user->user_id);
            redirect('/mobile/center');
        } else {
            $header = array(
                'member' => $this->member,
                'seo_title' => '用户个人信息',
                'cusor' => 'center',
            );
            $this->load->view('frontend/mobile/header', $header);
            $member = $this->mobile_model->getMemberInfoDetial($user->user_id);
            if (empty($member)) {
                redirect('/mobile/showErrorNotFound');
            }
            //获取省份列表
            $province = $this->mobile_model->getProvinceCityArea();
            $city = array();
            $area = array();
            if ($member->province_id > 0) {
                $city = $this->mobile_model->getProvinceCityArea($member->province_id);
            }
            if ($member->city_id > 0) {
                $area = $this->mobile_model->getProvinceCityArea($member->city_id);
            }
            $data['province'] = $province;
            $data['city'] = $city;
            $data['area'] = $area;
            $data['member'] = $member;
            $this->load->view('frontend/mobile/center_info', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     * 
     * @todo 载入订单列表 
     * 
     */
    public function orderList() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $header = array(
            'member' => $this->member,
            'seo_title' => '用户个人信息',
            'cusor' => 'center',
        );
        $this->load->view('frontend/mobile/header', $header);
        $order = $this->mobile_model->getMyOrderList($user->user_id);
        $data['order'] = $order;
        $this->load->view('frontend/mobile/center_order', $data);
        $this->load->view('frontend/mobile/footer');
    }
    
    /**
     * 
     * @todo 删除订单 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }
        $data = array(
                'isdel' => 1,
            );
        if ($this->mobile_model->delOrderById($data,$id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
    
    /**
     *
     * @todo 地址列表 
     * 
     */
    public function addressList() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $header = array(
            'member' => $this->member,
            'seo_title' => '用户个人信息',
            'cusor' => 'center',
        );
        $this->load->view('frontend/mobile/header', $header);
        $address = $this->mobile_model->getUserAddressList($user->user_id);
        $data['address'] = $address;
        $this->load->view('frontend/mobile/center_address', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 加载发起众筹 
     * 
     */
    public function launch() {
        $user = $this->member;
        if (empty($user)) {
            redirect('/mobile/login');
        }
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'project_name' => $_data['project_name'],
                'username' => $_data['username'],
                'gander' => $_data['gander'],
                'celphone' => $_data['celphone'],
                'wechat' => $_data['wechat'],
                'sina' => $_data['sina'],
                'my_description' => $_data['my_description'],
                'pro_description' => $_data['pro_description'],
                'status' => 1,
                'addtime' => time(),
                'passtime' => time(),
                'uid' => $user->user_id
            );
            if ($data['project_name'] != '' && $data['username'] != '' && $data['celphone'] != '') {
                $id = $this->mobile_model->saveLaunch($data);
                if ($id > 0) {
                    //发送邮件通知
                    $this->mobile_model->saveLaunchEmail($user->user_id, $data['username'], $data['celphone'], $data['project_name'], $data['pro_description'], $data['addtime']);
                    $header = array(
                        'member' => $this->member,
                        'seo_title' => '发起众筹',
                        'cusor' => 'launch',
                    );
                    $this->load->view('frontend/mobile/header', $header);
                    $this->load->view('frontend/mobile/savelaunch');
                    $this->load->view('frontend/mobile/footer');
                } else {
                    redirect('/mobile/showErrorNotFound');
                }
            } else {
                redirect('/mobile/showErrorNotFound');
            }
        } else {
            $header = array(
                'member' => $this->member,
                'seo_title' => '发起众筹',
                'cusor' => 'launch',
            );
            $this->load->view('frontend/mobile/header', $header);
            $member = $this->mobile_model->getMemberInfoDetial($user->user_id);
            $data['member'] = $member;
            $this->load->view('frontend/mobile/launch', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    /**
     * 
     * @todo 检查发起众筹信息 
     * 
     */
    public function checkLaunch() {
        $user = $this->member;
        $msg = array('flag' => 0, 'error' => '');
        if (empty($user)) {
            $msg['error'] = "您的登录已经失效，请重新登录后再操作！";
            echo json_encode($msg);
            exit;
        }
        $_data = $this->input->post();
        if (empty($_data)) {
            $msg['error'] = "没有获取到您提交的数据，保存失败！";
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'project_name' => $_data['project_name'],
            'username' => $_data['username'],
            'gander' => $_data['gander'],
            'celphone' => $_data['celphone'],
            'wechat' => $_data['wechat'],
            'sina' => $_data['sina'],
            'my_description' => $_data['my_description'],
            'pro_description' => $_data['pro_description'],
            'status' => 1,
            'addtime' => time(),
            'passtime' => time(),
            'uid' => $user->user_id
        );
        if ($data['project_name'] == '' || $data['username'] == '' || $data['celphone'] == '' || $data['my_description'] == '' || $data['pro_description'] == '') {
            $msg['error'] = "保存失败,带*号的项没有填写完整！";
            echo json_encode($msg);
            exit;
        }
        if (!$this->comm->checkPhone($data['celphone'])) {
            $msg['error'] = "保存失败,手机号码格式不正确！";
            echo json_encode($msg);
            exit;
        }
        $msg['flag'] = 1;
        $msg['error'] = "数据验证成功，正在提交，请等待！";
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 载入资讯列表
     * 
     */
    public function article() {
        $header = array(
            'member' => $this->member,
            'seo_title' => '资讯列表',
            'cusor' => 'article',
        );
        $this->load->view('frontend/mobile/header', $header);
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->mobile_model->getArticleCount($search);
        $article = $this->mobile_model->getArticleList($search);
        $data = array(
            'count' => $count,
            'article' => $article,
            'pagestart' => $this->pagesize
        );
        $this->load->view('frontend/mobile/article', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 异步获取资讯列表 
     * 
     */
    public function getArticleAjaxList() {
        $start = $this->input->post('start') ? $this->input->post('start') : 0;
        $search = array(
            'start' => $start,
            'pagesize' => $this->pagesize
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($start == 0) {
            $msg['error'] = "没有更多数据了";
            echo json_encode($msg);
            exit;
        }
        $count = $this->mobile_model->getArticleCount($search);
        $article = $this->mobile_model->getArticleList($search);
        $msg['flag'] = 1;
        $msg['count'] = $count;
        $msg['error'] = '获取数据成功!';
        $msg['list'] = $article;
        $msg['pagestart'] = bcadd($start, $this->pagesize, 0);
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 资讯详情 
     * 
     */
    public function articleDetial() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            redirect('/mobile/showErrorNotFound');
        }
        $article = $this->mobile_model->getArticleDetial($id);
        if (empty($article)) {
            redirect('/mobile/showErrorNotFound');
        }
        $data['news'] = $article;
        $header = array(
            'member' => $this->member,
            'seo_title' => $article->title,
            'cusor' => 'article',
        );
        $this->load->view('frontend/mobile/header', $header);
        $this->load->view('frontend/mobile/articleDetial', $data);
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 错误跳转 
     * 
     */
    public function showErrorNotFound() {
        $header = array(
            'member' => $this->member,
            'seo_title' => '页面未找到',
            'cusor' => 'none',
        );
        $this->load->view('frontend/mobile/header', $header);
        $this->load->view('frontend/mobile/error');
        $this->load->view('frontend/mobile/footer');
    }

    /**
     * 
     * @todo 忘记密码 
     * 
     */
    public function forget() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $account = trim($_data['account']);
            $msg = array('flag' => 0, 'error' => "");
            if ($account == '') {
                $msg['error'] = "账户名称不可以为空！";
                echo json_encode($msg);
                exit;
            }
            if ($_data['cellcode'] == '') {
                $msg['error'] = "验证码不能为空！";
                echo json_encode($msg);
                exit;
            }
            if ($_data['varify'] != $this->comm->get_session('varifyCode')) {
                $msg['error'] = "图形码错误!";
                echo json_encode($msg);
                exit;
            }
            if ($this->comm->is_email($account)) {
                if (!$this->mobile_model->checkEmail($_data['account'])) {
                    $msg['error'] = "邮箱尚未注册！";
                    echo json_encode($msg);
                    exit;
                }
                //验证码是否正确
                if (!$this->mobile_model->checkEmailCode($account, $_data['cellcode'])) {
                    $msg['error'] = "验证码错误！";
                    echo json_encode($msg);
                    exit;
                }
                $this->mobile_model->editEmailCodeStatus($account, $_data['cellcode']);
            } elseif ($this->comm->checkPhone($account)) {
                if (!$this->mobile_model->checkCellphone($_data['account'])) {
                    $msg['error'] = "该手机号码尚未注册！";
                    echo json_encode($msg);
                    exit;
                }
                //验证码是否正确
                if (!$this->mobile_model->checkPhoneCode($account, $_data['cellcode'])) {
                    $msg['error'] = "验证码错误！";
                    echo json_encode($msg);
                    exit;
                }
                $this->mobile_model->editPhoneCodeStatus($account, $_data['cellcode']);
            } else {
                $msg['error'] = "帐户名类型仅限于邮箱和手机号！";
                echo json_encode($msg);
                exit;
            }
            $this->comm->set_session('account', $account);
            $msg = array('flag' => 1, 'error' => "");
            echo json_encode($msg);
            exit;
        } else {
            $data['from'] = '/mobile/center';
            $header = array(
                'member' => $this->member,
                'seo_title' => '找回密码',
                'cusor' => 'forget',
            );
            $this->load->view('frontend/mobile/header', $header);
            $this->load->view('frontend/mobile/forget', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

    public function resetPassword() {
        $_data = $this->input->post();
        $account = $this->comm->get_session('account');
        if (empty($account)) {
            $this->forget();
        }
        if (!empty($_data)) {
            $password = $_data['password'];
            $repassword = $_data['repassword'];
            $msg = array('flag' => 0, 'error' => '');
            if (strlen($password) > 5) {
                if ($repassword == $password) {
                        $data = md5($password );
                        if ($this->mobile_model->editMemberPassword($data, $account)) {
                            $this->comm->del_session('account');
                            $msg['flag'] = 1;
                            $msg['error'] = '密码已经成功修改，现在就去登录吧！';
                            echo json_encode($msg);
                            exit;
                        } else {
                            $msg['error'] = '修改失败，错误未知！';
                            echo json_encode($msg);
                            exit;
                        }
                } else {
                    $msg['error'] = '两次密码不一致！';
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = '密码长度不能小于6个字符';
                echo json_encode($msg);
                exit;
            }
        } else {
            $header = array(
                'seo_title' => '泛丁首页',
                'cusor' => 'change',
            );
            $data['from'] = '/mobile/forget';
            $this->load->view('frontend/mobile/header', $header);
            $this->load->view('frontend/mobile/change', $data);
            $this->load->view('frontend/mobile/footer');
        }
    }

}
