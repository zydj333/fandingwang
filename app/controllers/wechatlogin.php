<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wechatlogin
 *
 * @author aman
 */
class wechatlogin extends CI_Controller {

    protected $config_big = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'create_thumb' => TRUE,
        'maintain_ratio' => TRUE,
        'thumb_marker' => "_big",
        'width' => 181,
        'height' => 181
    );
    protected $config_middle = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'create_thumb' => TRUE,
        'maintain_ratio' => TRUE,
        'thumb_marker' => "_middle",
        'width' => 100,
        'height' => 100
    );
    protected $config_small = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'create_thumb' => TRUE,
        'maintain_ratio' => TRUE,
        'thumb_marker' => "_small",
        'width' => 55,
        'height' => 55
    );
    
    //put your code here
    //定义常量
    const APP_ID = "wxe584a7820fd54074";
    const APP_SECRET = "d4624c36b6795d1d99dcf0547af5443d";
    const APP_STATE = "wechat_logon";

    private $wechat_code = '';
    private $access_token = '';
    private $open_id = 0;

    public function __construct() {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('register_model');
        $this->load->model('wechatlogin_model');
    }

    /**
     * 
     * @todo 载入登录首页 
     * 
     */
    public function index() {
        //获取微信返回的code
        $wechat_code = $_GET['code'];
        if ($wechat_code != '') {
            $this->wechat_code = $wechat_code;
        }else{
            die('data error');
        }
        //请求获取token
        $this->getAccessToken();
        //获取用户信息
        $userinfo=$this->getUserInfo();
        //检查用户的unionid是否在本平台存在
        if($this->wechatlogin_model->checkOpenidIsSet($userinfo['unionid'])){
            //进行登录
            $user = $this->wechatlogin_model->getMemberBywechatOpenid($userinfo['unionid']);
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
                redirect('/');
            } else {
                redirect("/");
            }
        }else{
             //加载头部信息
            $header = array(
                'title' => "泛丁网_微信帐号绑定",
                'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
                'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
                . "注册资金1000万，办公地点位于杭州市拱墅区。",
                'cusor' => 'login'
            );
            $this->comm->set_session('wechat_user', json_encode($userinfo));
            //进行绑定
            $data['wechat']=$userinfo;
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/api/wechat',$data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 获取token 
     * 
     */
    protected function getAccessToken() {
        $params = array(
            'appid' => self::APP_ID,
            'secret' => self::APP_SECRET,
            'code' => $this->wechat_code,
            'grant_type' => "authorization_code"
        );
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token";
        $result = file_get_contents($url . '?' . http_build_query($params));
        $back = json_decode($result,true);
        if (isset($back['access_token']) && $back['access_token'] != '') {
            $this->access_token = $back['access_token'];
            $this->open_id = $back['openid'];
            return true;
        } else if (isset($back['errcode'])) {
            die($back['errcode'] . ':' . $back['errmsg']);
        } else {
            die('try agin');
        }
    }

    /**
     * 
     * @todo 获取用户个人信息 
     * 
     */
    public function getUserInfo() {
        $pames = array(
            'access_token' => $this->access_token,
            'openid' => $this->open_id
        );
        $url = "https://api.weixin.qq.com/sns/userinfo";
        $result = file_get_contents($url . '?' . http_build_query($pames));
        $back = json_decode($result,true);
        if (isset($back['unionid']) && $back['unionid'] != '') {
            return $back;
        } else if (isset($back['errcode'])) {
            die($back['errcode'] . ':' . $back['errmsg']);
        } else {
            die('try agin');
        }
    }
    
    /**
     * 
     * @todo 进行用户帐号数据绑定 
     * 
     */
    public function processing(){
        $msg = array('flag' => 0, 'error' => '');
        $_data = $this->input->post();
        if (!empty($_data)) {
            //检查手机号码是否合法
            if ($this->comm->checkPhone($_data['account'])) {
                //是手机号码（检查数据库中是否已经存在该用户）
                if ($this->wechatlogin_model->checkPhoneRegister($_data['account'])) {
                    //已经存在(进行绑定)；
                    if ($this->bindMember($_data)) {
                        $msg['flag'] = 1;
                        $msg['error'] = "绑定成功！";
                    } else {
                        $msg['error'] = "手机号或者密码不正确！";
                    }
                } else {
                    //不存在，进行注册入库
                    $_data['type'] = "phone";
                    if ($this->addNewUser($_data)) {
                        $msg['flag'] = 1;
                        $msg['error'] = "绑定成功！";
                    } else {
                        $msg['error'] = "绑定失败！";
                    }
                }
            } elseif ($this->comm->is_email($_data['account'])) {
                //echo $_data['account'];exit;
                //是邮箱(检查邮箱是否已经存在)
                if ($this->wechatlogin_model->checkEmailRegister($_data['account'])) {
                    //已经存在(进行绑定)；
                    //echo $_data['account'];exit;
                    if ($this->bindMember($_data)) {
                        $msg['flag'] = 1;
                        $msg['error'] = "绑定成功！";
                    } else {
                        $msg['error'] = "邮箱或者密码不正确！";
                    }
                } else {
                    //不存在，进行注册入库
                    $_data['type'] = "email";
                    if ($this->addNewUser($_data)) {
                        $msg['flag'] = 1;
                        $msg['error'] = "绑定成功！";
                    } else {
                        $msg['error'] = "绑定失败！";
                    }
                }
            } else {
                $msg['error'] = "输入的帐号格式不正确！";
            }
        } else {
            $msg['error'] = "信息不可以为空！";
        }
        $this->comm->del_session('wechat_user');
        echo json_encode($msg);
    }
    
    
    /**
     * 
     * @todo 绑定用户 
     * 
     */
    public function bindMember($user){
         $user_info = json_decode($this->comm->get_session('wechat_user'),true);
        //echo 11111;exit;
        //获取用户信息
        $user = $this->wechatlogin_model->getUserInfo($user['account'], md5($user['password']));
        //echo $user->id;exit;
        if (!empty($user)) {
            //echo 123;exit;
            //print_r($user_info);exit;
            $data['wechat_openid'] = $user_info['unionid'];
            //echo $data['tencent_openid'];exit;
            if ($user->avatar == '') {
                $user_header = $user_info['headimgurl'];
                $dir = "upload/avatar";
                $fileName = "wechat_" . $user_info['unionid'];
                $virtualPath = $dir . "/" . $fileName . ".jpg";
                $data['avatar'] = $dir . "/" . $fileName . "_big.jpg";
                $this->comm->downloadFileWithCurl($user_header, $virtualPath);
                $this->config_big['source_image'] = './' . $virtualPath;
                $this->image_lib->initialize($this->config_big);
                $this->image_lib->resize();
                $this->config_middle['source_image'] = './' . $virtualPath;
                $this->image_lib->initialize($this->config_middle);
                $this->image_lib->resize();
                $this->config_small['source_image'] = './' . $virtualPath;
                $this->image_lib->initialize($this->config_small);
                $this->image_lib->resize();
            }
            //echo 0000;
            if ($this->wechatlogin_model->editMemberInfo($data, $user->id)) {
                //echo 1111;
                //绑定成功
                //本地session
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
                //echo 3333;
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
                return true;
            } else {
                //echo 55555;
                return false;
            }
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 新增用户 
     * 
     */
    public function addNewUser($user){
        $user_message = json_decode($this->comm->get_session('wechat_user'),true);
        if ($user['type'] == "phone") {
            $data = array(
                'account' => $user['account'],
                'password' => md5($user['password']),
                'trade_password' => md5($user['password']),
                'tencent_openid' => $user_message['unionid'],
                'username' => $user_message['nickname'],
                'email' => '',
                'telphone' => $user['account'],
                'user_type' => '3',
                'avatar' => "",
                'discription' => '',
                'addtime' => date('Y-m-d H:i:s')
            );
        } elseif ($user['type'] == "email") {
            $data = array(
                'account' => $user['account'],
                'password' => md5($user['password']),
                'trade_password' => md5($user['password']),
                'tencent_openid' => $user_message['unionid'],
                'username' => $user_message['nickname'],
                'email' => $user['account'],
                'telphone' => '',
                'user_type' => '3',
                'avatar' => "",
                'discription' => '',
                'addtime' => date('Y-m-d H:i:s')
            );
        } else {
            return false;
        }
        //头像
        if ($user_message['headimgurl'] != '') {
            $user_header = $user_message['headimgurl'];
            $dir = "upload/avatar";
            $fileName = "tencent_" . $user_message['unionid'];
            $virtualPath = $dir . "/" . $fileName . ".jpg";
            $data['avatar'] = $dir . "/" . $fileName . "_big.jpg";
            $this->comm->downloadFileWithCurl($user_header, $virtualPath);
            $this->config_big['source_image'] = './' . $virtualPath;
            $this->image_lib->initialize($this->config_big);
            $this->image_lib->resize();
            $this->config_middle['source_image'] = './' . $virtualPath;
            $this->image_lib->initialize($this->config_middle);
            $this->image_lib->resize();
            $this->config_small['source_image'] = './' . $virtualPath;
            $this->image_lib->initialize($this->config_small);
            $this->image_lib->resize();
        }
        //入库
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
                'user_name' => $data['username'],
                'email' => $data['email'],
                'telphone' => $data['telphone'],
                'avatar_big' => $data['avatar'],
                'avatar_middle' => '',
                'avatar_small' => '',
                'lastlogin' => $data_log['logintime'],
                'lastip' => $data_log['loginip'],
            );
            $this->comm->set_session('member', json_encode($member));
            $this->comm->set_session('user', $u_id);
            return true;
        } else {
            return false;
        }
    }

}
