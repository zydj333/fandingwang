<?php

/**
 * Description of sina
 *
 * @createtime 2015-5-21 14:37:51
 * 
 * @author ZhangPing'an
 * 
 * @todo sina
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
require_once APPPATH . 'third_party/API/qqConnectAPI.php';

class tencent extends Frontend_Controller {

    protected $tencent_params;
    protected $object;
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

    public function __construct() {
        parent::__construct();
        $this->tencent_params = $this->config->item('tencent');
        $this->load->library('image_lib');
        $this->load->model('register_model');
        $this->load->model('tencent_model');
        $this->object = new QC();
    }

    /**
     *
     * @todo 处理腾讯返回的数据
     *
     */
    public function index() {
        //授权成功
        $token = $this->object->qq_callback();
        $openid = $this->object->get_openid();
        //检查腾讯的openid是否存在
        if ($this->tencent_model->checkOpenidIsSet($openid)) {
            //已经在本库存在了（直接进行登录操作）
            //根据openid获取用户信息
            $user = $this->tencent_model->getMemberByTencentOpenid($openid);
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
        } else {
            //加载到绑定本站帐号
            //加载头部信息
            $header = array(
                'title' => "泛丁网_QQ帐号绑定",
                'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
                'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
                . "注册资金1000万，办公地点位于杭州市拱墅区。",
                'cusor' => 'login'
            );
            $this->object = new QC($token, $openid);
            $userinfo = $this->object->get_user_info();
            //print_r($userinfo);exit;
            if ($userinfo['nickname'] == '') {
                echo 'try again';
                exit;
            }
            $userinfo['openid'] = $openid;
            $data['tencent']=$userinfo;
            //暂时session保存userinfo信息
            $this->comm->set_session('tencent', json_encode($userinfo));
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/api/tencent',$data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     *
     * @todo 执行绑定并登录的操作
     *
     */
    public function processing() {
        $msg = array('flag' => 0, 'error' => '');
        $_data = $this->input->post();
        if (!empty($_data)) {
            //检查手机号码是否合法
            if ($this->comm->checkPhone($_data['account'])) {
                //是手机号码（检查数据库中是否已经存在该用户）
                if ($this->tencent_model->checkPhoneRegister($_data['account'])) {
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
                if ($this->tencent_model->checkEmailRegister($_data['account'])) {
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
        $this->comm->del_session('tencent');
        echo json_encode($msg);
    }

    /**
     *
     * @todo 绑定帐号信息
     *
     */
    public function bindMember($user) {
        $user_info = json_decode($this->comm->get_session('tencent'),true);
        //echo 11111;exit;
        //获取用户信息
        $user = $this->tencent_model->getUserInfo($user['account'], md5($user['password']));
        //echo $user->id;exit;
        if (!empty($user)) {
            //echo 123;exit;
            //print_r($user_info);exit;
            $data['tencent_openid'] = $user_info['openid'];
            //echo $data['tencent_openid'];exit;
            if ($user->avatar == '') {
                $user_header = $user_info['figureurl_qq_1'];
                if ($user_info['figureurl_qq_2'] != '') {
                    $user_header = $user_info['figureurl_qq_2'];
                }
                $dir = "upload/avatar";
                $fileName = "tencent_" . $user_info['openid'];
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
            if ($this->tencent_model->editMemberInfo($data, $user->id)) {
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
    public function addNewUser($user) {
        $user_message = json_decode($this->comm->get_session('tencent'),true);
        if ($user['type'] == "phone") {
            $data = array(
                'account' => $user['account'],
                'password' => md5($user['password']),
                'trade_password' => md5($user['password']),
                'tencent_openid' => $user_message['openid'],
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
                'tencent_openid' => $user_message['openid'],
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
        if ($user_message['figureurl_qq_1'] != '') {
            $user_header = $user_message['figureurl_qq_1'];
            if ($user_message['figureurl_qq_2'] != '') {
                $user_header = $user_message['figureurl_qq_2'];
            }
            $dir = "upload/avatar";
            $fileName = "tencent_" . $user_message['openid'];
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

    /**
     *
     * @todo 生成登录链接
     *
     */
    public function createUrl() {
        return $this->object->qq_login();
    }

}

?>