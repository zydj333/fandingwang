<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class api extends CI_Controller {

    //定义字符串用来加密
    private $str = 'fandingwang';
    private $user;

    public function __construct() {
        parent::__construct();
        self::check();
        $this->load->model('api_model');
    }

    public function index() {
        $this->load->view('test/forget');
    }

    /*
     * @todo 检测传递参数
     *       
     */

    public function check() {
        //获取传递参数
        //$token = $this->input->get('token');
        $token = $this->uri->segment(3);
        if (empty($token)) {
            //错误提示，参数为空
            echo json_encode('empty');
            exit;
        }
        //加密字符串
        $res = md5($this->str);
        //比较获取的参数和字符串
        if ($token != $res) {
            //错误提示，参数错误
            echo json_encode('parameter');
            exit;
        }
    }

    /**
     * 
     * @todo 注册 
     * 
     */
    public function register() {
        $_data = $this->input->post();
        $account = trim($_data['account']);
        $phonecode = trim($_data['phonecode']);
        $msg = array('flag' => 0, 'error' => '');
        if ($account != '') {
            if ($this->checkPhone($account)) {
                if ($this->api_model->checkPhone($account)) {
                    $msg['error'] = '该手机号码已经被占用!';
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = '手机号码格式不正确!';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '手机号码不可以为空！';
            echo json_encode($msg);
            exit;
        }
        if ($account != '' && $phonecode != '') {
            if ($this->api_model->checkPhoneCode($account, $phonecode)) {
                
            } else {
                $msg['error'] = '手机验证码不正确或者过期!';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '手机验证码不可以为空！';
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'account' => trim($_data['account']),
            'password' => trim($_data['password']),
            'trade_password' => trim($_data['repassword']),
            'addtime' => date('Y-m-d H:i:s', time())
        );
        if ($data['password'] == '') {
            $code['flag'] = 6;
            $code['error'] = '密码不能为空';
            echo json_encode($code);
            exit;
        }
        if (strlen($data['password']) > 15 || strlen($data['password']) < 6) {
            $code['flag'] = 8;
            $code['error'] = '密码长度在6-15字符';
            echo json_encode($code);
            exit;
        }
        if ($data['password'] != $data['trade_password']) {
            $code['flag'] = 7;
            $code['error'] = '两次输入的密码不一致';
            echo json_encode($code);
            exit;
        }
        $data['password'] = md5($data['password']);
        $data['trade_password'] = md5($data['trade_password']);
        $code_status = array(
            'status' => 2
        );
        //修改验证码状态
        if ($this->api_model->editPhoneCodeStatus($code_status, $account, $phonecode)) {
            $data['real_phone'] = 1;
            $data['real_count'] = 1;
            $u_id = $this->api_model->saveMemberAccount($data);
            if ($u_id > 0) {
                //添加本次登录记录
                $data_log = array(
                    'uid' => $u_id,
                    'logintime' => time(),
                    'loginip' => $this->real_ip()
                );
                $this->api_model->addThisLogin($data_log);
                $member = array(
                    'user_id' => $u_id,
                    'account' => $data['account'],
                    'user_name' => $data['account'],
                    'telphone' => $data['account'],
                    'avatar_big' => '',
                    'avatar_middle' => '',
                    'avatar_small' => '',
                    'lastlogin' => $data_log['logintime'],
                    'lastip' => $data_log['loginip'],
                );
                $msg = $member;
            } else {
                $msg['error'] = '未知错误';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '验证码错误或过期';
            echo json_encode($msg);
            exit;
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 登录
     * 
     */
    public function login() {
        $msg = array('flag' => 0, 'error' => '');
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        if ($account != '' && $password != '') {
            $password = md5($password);
            $user = $this->api_model->getUserInfo($account, $password);
            if (!empty($user)) {
                //获取上次登录时间
                $last = $this->api_model->getLastLogin($user->id);
                //添加本次登录记录
                $data = array(
                    'uid' => $user->id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->api_model->addThisLogin($data);
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
                $msg['flag'] = 1;
                //获取头像等信息
                $msg['member'] = $member;
            } else {
                $msg['error'] = "wrong!";
            }
        } else {
            $msg['error'] = "empty!";
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 载入用户中心 
     * 
     */
    public function usercenterIndex() {
        //获取用户信息
        $user = $this->uri->segment(4);
        $data['member'] = $this->api_model->getUserIdByUid($user);
        //收藏
        $product = $this->api_model->getMyCollectList($user);
        if (!empty($product)) {
            foreach ($product as $k => $v) {
                $timer = $this->getTimeString($v->starttime, $v->endtime, $v->days);
                $product[$k]->timer = $timer['str'];
            }
        }
        $data['product'] = $product;
        //获取地址列表
        $data['address'] = $this->api_model->getMyAddressList($user);
        $data['province'] = $this->api_model->getAreaInfoById($data['member']->province_id);
        if ($data['member']->province_id > 0) {
            $data['city'] = $this->api_model->getAreaInfoById($data['member']->city_id);
        }
        //参与
        $join = $this->api_model->getMySupportProjectList($user);
        if (!empty($join)) {
            foreach ($join as $k => $v) {
                $timer = $this->getTimeString($v->starttime, $v->endtime, $v->days);
                $join[$k]->timer = $timer['str'];
            }
        }
        $data['join'] = $join;
        //发起
        $luanch = $this->api_model->getMyLaunchProjectList($user);
        if (!empty($luanch)) {
            foreach ($luanch as $k => $v) {
                $timer = $this->getTimeString($v->starttime, $v->endtime, $v->days);
                $luanch[$k]->timer = $timer['str'];
            }
        }
        $data['luanch'] = $luanch;
        $orderList = $this->api_model->getOrderList($user);
        $data['orderList'] = $orderList;
        echo json_encode($data);
    }

    /*
     *  @todo 获取项目列表
     */

    public function getProjectList() {
        //获取项目列表
        $product = $this->api_model->getProjectList();
        if (!empty($product)) {
            foreach ($product as $k => $v) {
                $timer = $this->getTimeString($v->starttime, $v->endtime, $v->days);
                $product[$k]->timer = $timer['str'];
                $product[$k]->author = $this->api_model->getMemberByUid($v->user_id);
                //获取项目回复信息
                $product[$k]->reply = $this->api_model->getProductRepayList($v->id);
                if (!empty($product[$k]->reply)) {
                    foreach ($product[$k]->reply as $key => $values) {
                        //获取回复人头像
                        $avatar = array();
                        if ($values->avatar != '') {
                            $avatar = explode('_', $values->avatar);
                            if (count($avatar) == 3) {
                                $product[$k]->reply[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                            }
                        }
                    }
                }
            }
        }
        //json化
        $result = json_encode($product);
        //输出
        echo '<pre>';
        echo $result;
    }

    /**
     * 
     * @todo 载入项目详情页面 
     * 
     */
    public function getProjectDetial() {
        $id = $this->uri->segment(4) ? $this->uri->segment(4) : 5;
        if ($id == 0) {
            echo json_encode('wrong');
        } else {
            //获取项目详情.
            $product = $this->api_model->getProductInfoById($id);
            if (empty($product)) {
                echo json_encode('empty');
            } else {
                //修改项目的流量次数
                $this->api_model->editProductViewsById($id);
                $timer = $this->getTimeString($product->starttime, $product->endtime, $product->days);
                $product->timer = $timer['str'];
                //获取项目用户详情
                $author = $this->api_model->getMemberByUid($product->user_id);
                //获取项目投资子项
                $product_items = $this->api_model->getProductItemsList($id);
                //获取项目动态
                //$feed = $this->project_model->getProductFeedList($id);
                //获取项目回复
                //$reply = $this->project_model->getProductRepayList($id);
                //获取项目支持记录列表
                //$support = $this->project_model->getProductSupportList($id);
                $is_process = 0;
                if ($product->starttime < time() && $product->endtime > time()) {
                    $is_process = 1;
                } else if ($product->endtime < time()) {
                    $is_process = 2;
                }
                $product->content = htmlspecialchars($product->content);
                $data = array(
                    'product' => $product,
                    'author' => $author,
                    'product_items' => $product_items,
                    //'feed' => $feed,
                    //'reply' => $reply,
                    //'support' => $support,
                    'is_process' => $is_process
                );
                $data['now_time'] = time();
                //$data['pro_type'] = $this->project_model->getProjectType(3);
            }
        }
        //var_dump($a);die;
        echo json_encode($data);
    }

    /**
     * 
     * @todo 修改我的密码 
     * 
     */
    public function savepassword() {
        $msg = array('flag' => 0, 'error' => '');
        $user = $this->uri->segment(4);
        $pwd = $this->input->post('last_password');
        $new_pwd = $this->input->post('new_password');
        $repwd = $this->input->post('conform_password');
        if (strlen($new_pwd) < 6) {
            $msg['error'] = "新密码长度不能小于6!";
            echo json_encode($msg);
            exit;
        }
        if ($new_pwd != $repwd) {
            $msg['error'] = "确认密码不正确!";
            echo json_encode($msg);
            exit;
        }
        $pwd_md5 = md5($pwd);
        $new_pwd_md5 = md5($new_pwd);
        if (!$this->api_model->checkUserPwdIsRight($user, $pwd_md5)) {
            $msg['error'] = "原密码不正确!";
            echo json_encode($msg);
            exit;
        }
        $data['password'] = $new_pwd_md5;
        if ($this->api_model->saveMemberEdit($data, $user)) {
            $msg['flag'] = 1;
            $msg['error'] = "修改成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "修改失败，未知错误!";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 忘记密码 
     * 
     */
    public function forget() {
        $_data = $this->input->post();
        $account = trim($_data['account']);
        $phonecode = trim($_data['phonecode']);
        $password = trim($_data['password']);
        $repassword = trim($_data['repassword']);
        $msg = array('flag' => 0, 'error' => '');
        if ($account != '') {
            if ($this->checkPhone($account)) {
                if (!$this->api_model->checkPhone($account)) {
                    $msg['error'] = '该手机号码尚未注册!';
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = '手机号码格式不正确!';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '手机号码不可以为空！';
            echo json_encode($msg);
            exit;
        }
        if ($account != '' && $phonecode != '') {
            if ($this->api_model->checkPhoneCode($account, $phonecode)) {
                
            } else {
                $msg['error'] = '手机验证码不正确或者过期!';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '手机验证码不可以为空！';
            echo json_encode($msg);
            exit;
        }
        if (strlen($password) > 5) {
            if ($repassword == $password) {
                
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
        $data['password'] = md5($password);
        $user = $this->api_model->getUserIdByPhone($account);
        $uid = $user->id;
        if ($this->api_model->saveMemberEdit($data, $uid)) {
            $code_status = array(
                'status' => 2
            );
            //修改验证码状态
            if ($this->api_model->editPhoneCodeStatus($code_status, $account, $phonecode)) {
                
            } else {
                $msg['error'] = '验证码错误或过期';
                echo json_encode($msg);
                exit;
            }
            $msg['flag'] = 1;
            $msg['error'] = "密码找回成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "修改失败，未知错误!";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 保存用户头像 
     * 
     */
    public function saveavater() {
        /* 温馨提示：
         * 在flash的参数名upload_url中可自行定义一些参数（请求方式：GET），定义后在服务器端获取即可，比如可以应用到用户验证，文件的保存名等。
         * 本示例未作极致的用户体验与严谨的安全设计（如用户直接访问此页时该如何，万一客户端数据不可信时验证文件的大小、类型等），只保证正常情况下无误，请阁下注意。
         */
        header('Content-Type: text/html; charset=utf-8');
        $user = $this->uri->segment(4);
        $result = array();
        $result['success'] = false;
        $successNum = 0;
        $i = 0;
        $msg = '';
        //上传目录
        $dir = "upload/avatar";
        //echo json_encode($_FILES);exit;
        //遍历所有文件域
        $fileName = date("YmdHis") . "_" . $user;
        while (list($key, $val) = each($_FILES)) {
            if ($_FILES[$key]['error'] > 0) {
                $msg .= $_FILES[$key]['error'];
            } else {
                //上传原图
                if ($key == '__source') {
                    $virtualPath = $dir . "/" . $fileName . ".jpg";
                    $result['sourceUrl'] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $successNum++;
                }
                //大头像
                else if ($key == '__avatar1') {
                    $virtualPath = $dir . "/" . $fileName . "_big.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    //保存用户的头像
                    $userimg = array(
                        'avatar' => $dir . "/" . $fileName . "_big.jpg"
                    );
                    $this->api_model->saveMemberEdit($userimg, $user);
                    $successNum++;
                    $i++;
                    //中头像
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $virtualPath;
                    //$config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['new_image'] = $dir . "/" . $fileName . '_middle.jpg';
                    $config['width'] = 50;
                    $config['height'] = 50;

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                }
//                else if ($key == '__avatar2') {
//                    //中头像
//                    $virtualPath = $dir . "/" . $fileName . "_middle.jpg";
//                    $result['avatarUrls'][$i] = '/' . $virtualPath;
//                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
//                    $user['avatar_middle'] = $virtualPath;
//                    $successNum++;
//                    $i++;
//                } else if ($key == '__avatar3') {
//                    //小头像
//                    $virtualPath = $dir . "/" . $fileName . "_small.jpg";
//                    $result['avatarUrls'][$i] = '/' . $virtualPath;
//                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
//                    $user['avatar_small'] = $virtualPath;
//                    $successNum++;
//                    $i++;
//                }
            }
        }
        $result['msg'] = $msg;
        if ($successNum > 0) {
            $result['success'] = true;
        }
        //返回图片的保存结果（返回内容为json字符串）
        print json_encode($result);
    }

    /**
     * 
     * @todo 执行收藏操作 
     * 
     */
    public function collection() {
        $user = $this->uri->segment(4);
        $pid = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($user)) {
            if ($pid > 0) {
                $data = array(
                    'uid' => $user,
                    'pid' => $pid,
                    'addtime' => time()
                );
                if ($this->api_model->checkIsCollect($data)) {
                    $msg['error'] = '收藏失败，该项目你已经收藏过了!';
                } else {
                    $id = $this->api_model->saveCollect($data);
                    if ($id > 0) {
                        $msg['flag'] = 1;
                        $msg['error'] = '收藏成功!';
                    } else {
                        $msg['error'] = '收藏失败，错误未知!';
                    }
                }
            } else {
                $msg['error'] = '收藏失败，信息传递错误!';
            }
        } else {
            $msg['flag'] = 2;
            $msg['error'] = '收藏前请先登录!';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 取消收藏操作 
     * 
     */
    public function deleteCollection() {
        $user = $this->uri->segment(4);
        $pid = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($user)) {
            if ($pid > 0) {
                $data = array(
                    'uid' => $user,
                    'pid' => $pid
                );
                if ($this->api_model->deleteCollect($data)) {
                    $msg['flag'] = 1;
                    $msg['error'] = '取消收藏成功!';
                } else {
                    $msg['error'] = '取消收藏失败，错误未知!';
                }
            } else {
                $msg['error'] = '取消失败，信息传递错误!';
            }
        } else {
            $msg['flag'] = 2;
            $msg['error'] = '获取用户信息失败!';
        }
        echo json_encode($msg);
    }

    /*
     * @todo 获取资讯列表
     */

    public function getArticleList() {
        $search = '';
        //获取资讯列表
        $list = $this->api_model->getArticleList($search);
        //json化
        $result = json_encode($list);
        //输出
        echo $result;
    }

    /**
     * 
     * @todo 添加地址 
     * 
     */
    public function addressSave() {
        $user = $this->uri->segment(4);
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'uid' => $user,
                'username' => $_data['username'],
                'cellphone' => $_data['celphone'],
                'province' => $_data['province'],
                'province_name' => "",
                'city' => $_data['city'],
                'city_name' => "",
                'area' => $_data['area'],
                'area_name' => "",
                'address' => $_data['address'],
                'is_default' => $this->input->post('is_default') ? $this->input->post('is_default') : 0,
                'addtime' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['username'] != '' && $data['cellphone'] != '' && $data['address'] != '') {
                if ($data['province'] > 0) {
                    $province = $this->api_model->getAreaInfoById($data['province']);
                    $data['province_name'] = $province->name;
                }
                if ($data['city'] > 0) {
                    $city = $this->api_model->getAreaInfoById($data['city']);
                    $data['city_name'] = $city->name;
                }
                if ($data['area'] > 0) {
                    $area = $this->api_model->getAreaInfoById($data['area']);
                    $data['area_name'] = $area->name;
                }
                if ($data['is_default'] == 1) {
                    $this->api_model->editDefaultAddress($data['uid']);
                }
                $id = $this->api_model->saveAddress($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = "保存成功，请点击下方确定关闭窗口";
                    echo json_encode($msg);
                    exit;
                } else {
                    $msg['error'] = "无法保存，发生未知错误";
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = "无法保存，信息没有填写完整";
                echo json_encode($msg);
                exit;
            }
        }
    }

    /**
     * 
     * @todo 修改地址消息 
     * 
     */
    public function addressEdit() {
        $_data = $this->input->post();
        $user = $this->uri->segment(4);
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => "");
            $address_id = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
            if ($address_id == 0) {
                $msg['error'] = "无法保存修改，参数丢失";
                echo json_encode($msg);
                exit;
            }
            $data = array(
                'username' => $_data['username'],
                'cellphone' => $_data['celphone'],
                'province' => $this->input->post('province'),
                'province_name' => "",
                'city' => $this->input->post('city'),
                'city_name' => "",
                'area' => $this->input->post('area'),
                'area_name' => "",
                'address' => $_data['address'],
                'is_default' => $this->input->post('is_default') ? $this->input->post('is_default') : 0
            );

            if ($data['username'] != '' && $data['cellphone'] != '' && $data['address'] != '') {
                if ($data['province'] > 0) {
                    $province = $this->comm_model->getAreaInfoById($data['province']);
                    $data['province_name'] = $province->name;
                }
                if ($data['city'] > 0) {
                    $city = $this->comm_model->getAreaInfoById($data['city']);
                    $data['city_name'] = $city->name;
                }
                if ($data['area'] > 0) {
                    $area = $this->comm_model->getAreaInfoById($data['area']);
                    $data['area_name'] = $area->name;
                }
                if ($data['is_default'] == 1) {
                    $this->api_model->editDefaultAddress($user);
                }
                if ($this->api_model->editAddressInfo($data, $address_id)) {
                    $msg['flag'] = 1;
                    $msg['error'] = "保存成功，请点击下方确定关闭窗口";
                    echo json_encode($msg);
                    exit;
                } else {
                    $msg['error'] = "无法保存，发生未知错误";
                    echo json_encode($msg);
                    exit;
                }
            } else {
                $msg['error'] = "无法保存，信息没有填写完整";
                echo json_encode($msg);
                exit;
            }
        } else {
            $id = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
            if ($id == 0) {
                echo json_encode('参数错误!');
                exit;
            }
            $address = $this->api_model->getAddressInfoById($id);
            if (empty($address)) {
                echo json_encode('初始化数据失败!');
                exit;
            }
            $data['address'] = $address;
            //获取省份列表
            $data['province'] = $this->api_model->getAreaListByPid(0);
            $data['city'] = array();
            $data['area'] = array();
            if ($address->province > 0) {
                $data['city'] = $this->api_model->getAreaListByPid($address->province);
            }
            if ($address->city > 0) {
                $data['area'] = $this->api_model->getAreaListByPid($address->city);
            }
            echo json_encode($data);
        }
    }

    /**
     * 
     * @todo 删除地址 
     * 
     */
    public function deladdress() {
        $user = $this->uri->segment(4);
        $id = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($id == 0) {
            $msg['error'] = "删除地址失败，参数错误";
            echo json_encode($msg);
            exit;
        }
        if ($this->api_model->delAddressInfo($id)) {
            $msg['flag'] = 1;
            $msg['error'] = "删除地址成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "删除地址失败，错误未知";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     *
     * 获取用户的IP地址
     *
     * 根据系统判断获取用户的当前IP地址
     *
     * 返回string类型的IP地址
     *
     */
    function real_ip() {
        static $realip = NULL;
        if ($realip !== NULL) {
            return $realip;
        }
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        $onlineip = array();
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    /**
     *
     * @todo 验证手机号码是否合法
     *
     * @param $mobilephone 手机号号码
     *
     * @return 返回真假类型的结果
     *
     */
    public function checkPhone($mobilephone) {
        if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $mobilephone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @todo 计算开始结束时间
     *
     * @param $start 开始时间
     *
     * @param $endtime 结束时间
     *
     * @param $days 上线天数
     *
     * @return 返回一个string类型的数据
     *
     */
    public function getTimeString($start, $endtime, $days) {
        $data = array(
            'str' => '',
            'statu' => 0
        );
        $nowtime = time();
        $daystime = 24 * 3600;
        if ($nowtime < $start) {//预热
            $difference = $start - $nowtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = $today . "天" . $hour . "小时后开始";
            } else {
                $data['str'] = $hour . "小时" . $min . "分钟后开始";
            }
            $data['statu'] = 0;
        } elseif ($nowtime > $endtime) {//结束
            $difference = $nowtime - $endtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = "已结束" . $today . "天" . $hour . "小时";
            } else {
                $data['str'] = "已结束" . $hour . "小时" . $min . "分钟";
            }
            $data['statu'] = 2;
        } else {//正在热销
            $difference = $endtime - $nowtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = $today . "天" . $hour . "小时后结束";
            } else {
                $data['str'] = $hour . "小时" . $min . "分钟后结束";
            }

            $data['statu'] = 1;
        }
        return $data;
    }

    /**
     *
     * @todo 获取省份
     *
     */
    public function getProvince() {
        $msg = array(
            'error' => lang('no_city_list'),
            'flag' => 0
        );
        $pid = $this->input->post('province') ? $this->input->post('province') : 0;
        $city = $this->api_model->getAreaListByPid($pid);
        if (!empty($city)) {
            $msg['flag'] = 1;
            $msg['error'] = $city;
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 获取城市
     *
     */
    public function getCity() {
        $msg = array(
            'error' => lang('no_city_list'),
            'flag' => 0
        );
        $pid = $this->input->post('province') ? $this->input->post('province') : 0;
        if ($pid > 0) {
            $city = $this->api_model->getAreaListByPid($pid);
            if (!empty($city)) {
                $msg['flag'] = 1;
                $msg['error'] = $city;
            }
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 获取区县
     *
     */
    public function getArea() {
        $msg = array(
            'error' => lang('no_city_list'),
            'flag' => 0
        );
        $pid = $this->input->post('province') ? $this->input->post('province') : 0;
        if ($pid > 0) {
            $city = $this->api_model->getAreaInfoById($pid);
            if (!empty($city)) {
                $msg['flag'] = 1;
                $msg['error'] = $city;
            }
        }
        echo json_encode($msg);
    }

}
