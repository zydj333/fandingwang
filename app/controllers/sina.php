<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
require_once APPPATH . 'third_party/sinaApi.php';

class sina extends Frontend_Controller {

    protected $sina_params;
    protected $sinaAuth;
    protected $sinaClient;
    protected $token;
    protected $sina_token;
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
        $this->sina_params = $this->config->item('sina');
        $this->sinaAuth = new SaeTOAuthV2($this->sina_params['wb_akey'], $this->sina_params['wb_skey']);
        $this->sina_token = md5('sina_token');
        $this->load->library('image_lib');
        $this->load->model('register_model');
        $this->load->model('sina_model');
    }

    /**
     * 
     * @todo 接收新浪返回的数据 
     * 
     */
    public function index() {
        $code = $this->input->get('code');
        $keys = array();
        if ($code != '') {
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = $this->sina_params['wb_callback_url'];
        }
        try {
            $this->token = $this->sinaAuth->getAccessToken('code', $keys);
        } catch (OAuthException $e) {
            
        }
        if (!empty($this->token)) {
            $this->comm->set_session($this->sina_token, json_encode($this->token));
            $this->comm->set_session('weibojs_' . $this->sinaAuth->client_id, http_build_query($this->token));
            redirect('/sina/getSinaInfo');
        } else {
            show_error('授权失败');
        }
    }

    /**
     * 
     * @todo 获取用户信息 
     * 
     */
    public function getSinaInfo() {
        $this->token = json_decode($this->comm->get_session($this->sina_token));
        $this->sinaClient = new SaeTClientV2($this->sina_params['wb_akey'], $this->sina_params['wb_skey'], $this->token->access_token);
        //$ms = $this->sinaClient->home_timeline(); // done
        $uid_get = $this->sinaClient->get_uid();
        $uid = 0;
        if (!empty($uid_get)) {
            $uid = $uid_get['uid'];
            $sina_user = $this->sinaClient->show_user_by_id($uid);
            if (!empty($sina_user)) {
                $data = array(
                    'id' => $sina_user['id'],
                    'name' => $sina_user['name'],
                    'description' => $sina_user['description'],
                    'avatar_hd' => $sina_user['avatar_hd']
                );
            }
            $this->comm->set_session('sina_user', json_encode($data));

            //检查用户的OPEN_ID本地是否已经存在
            $user = $this->sina_model->getMemberByOpenid($uid);
            if (!empty($user)) {
                //存在则直接登录
                //获取上次登录时间
                $last = $this->register_model->getLastLogin($user->id);
                //添加本次登录记录
                $data_log = array(
                    'uid' => $user->id,
                    'logintime' => time(),
                    'loginip' => $this->comm->real_ip()
                );
                $this->register_model->addThisLogin($data_log);
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
                redirect("/");
            } else {
                //不存在则进行绑定
                //加载头部信息
                $header = array(
                    'title' => "泛丁网_QQ帐号绑定",
                    'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
                    'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
                    . "注册资金1000万，办公地点位于杭州市拱墅区。",
                    'cusor' => 'login'
                );
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/api/sina');
                $this->load->view('frontend/public/footer');
            }
        } else {
            show_error('注册失败，没有获取到您的微博信息');
        }
    }

    /**
     *
     * @todo 进行绑定操作
     *
     */
    public function processing() {
        //获取用户的微博信息
        $user_message = json_decode($this->comm->get_session('sina_user'), true);
        $msg = array('flag' => 0, 'error' => '');
        $_data = $this->input->post();
        //print_r($user_message);exit;
        if (!empty($_data)) {
            //检查微博api的数据是否获取到了
            if (!empty($user_message)) {
                //检查用户提交的账户类型
                if ($this->comm->checkPhone($_data['account'])) {
                    //是手机号码（检查数据库中是否已经存在该用户）
                    if ($this->sina_model->checkPhoneRegister($_data['account'])) {
                        //已经存在(进行绑定)；
                        if ($this->bindMember($_data, $user_message)) {
                            $msg['flag'] = 1;
                            $msg['error'] = "绑定成功！";
                        } else {
                            $msg['error'] = "手机号或者密码不正确！";
                        }
                    } else {
                        //不存在，进行注册入库
                        $_data['type'] = "phone";
                        if ($this->addNewUser($_data, $user_message)) {
                            $msg['flag'] = 1;
                            $msg['error'] = "绑定成功！";
                        } else {
                            $msg['error'] = "绑定失败！";
                        }
                    }
                } elseif ($this->comm->is_email($_data['account'])) {
                    //echo $_data['account'];exit;
                    //是邮箱(检查邮箱是否已经存在)
                    if ($this->sina_model->checkEmailRegister($_data['account'])) {
                        //已经存在(进行绑定)；
                        //echo $_data['account'];exit;
                        if ($this->bindMember($_data, $user_message)) {
                            $msg['flag'] = 1;
                            $msg['error'] = "绑定成功！";
                        } else {
                            $msg['error'] = "邮箱或者密码不正确！";
                        }
                    } else {
                        //不存在，进行注册入库
                        $_data['type'] = "email";
                        if ($this->addNewUser($_data, $user_message)) {
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
                $msg['error'] = "未获取到您的微博信息,绑定失败！";
            }
        } else {
            $msg['error'] = "您输入的信息不可以为空！";
        }
        //$this->comm->del_seesion('sina_user');
        echo json_encode($msg);
        exit;
    }

    /**
     *
     * @todo 绑定账号
     *
     * @param $user array  用户的账号密码
     *
     * @param $sina array  新浪接口返回的数据
     *
     * @return 返回真假类型的结果
     *
     */
    protected function bindMember($user, $sina) {
        //查询用户信息
        $userinfo = $this->sina_model->getUserInfo($user['account'], md5($user['password']));
        if (empty($userinfo)) {
            return false;
        }
        $data = array('sina_openid' => $sina['id']);
        //用户没有头像
        if ($userinfo->avatar == '' && $sina['avatar_hd'] != '') {
            $dir = "upload/avatar";
            $fileName = "sina_" . $sina['id'];
            $virtualPath = $dir . "/" . $fileName . ".jpg";
            $data['avatar'] = $dir . "/" . $fileName . "_big.jpg";
            $this->comm->downloadFileWithCurl($sina['avatar_hd'], $virtualPath);
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
        //保存用户信息
        if ($this->sina_model->editMemberInfo($data, $userinfo->id)) {
            //绑定成功
            //获取上次登录时间
            $last = $this->register_model->getLastLogin($userinfo->id);
            //添加本次登录记录
            $data_log = array(
                'uid' => $userinfo->id,
                'logintime' => time(),
                'loginip' => $this->comm->real_ip()
            );
            $this->register_model->addThisLogin($data_log);
            $avatar = array('middle' => '', 'small' => '');
            if ($user->avatar != '') {
                $avatar = explode('_', $userinfo->avatar);
                if (count($avatar) == 3) {
                    $avatar['middle'] = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                    $avatar['small'] = $avatar[0] . '_' . $avatar[1] . '_small.jpg';
                }
            }
            $member = array(
                'user_id' => $userinfo->id,
                'account' => $userinfo->account,
                'user_name' => $userinfo->username,
                'email' => $userinfo->email,
                'telphone' => $userinfo->telphone,
                'avatar_big' => $userinfo->avatar,
                'avatar_middle' => $avatar['middle'],
                'avatar_small' => $avatar['small'],
                'lastlogin' => $last->logintime,
                'lastip' => $last->loginip
            );
            $this->comm->set_session('member', json_encode($member));
            $this->comm->set_session('user', $userinfo->id);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @todo 新增用户信息
     *
     * @param $user array  用户的账号密码
     *
     * @param $sina array  新浪接口返回的数据
     *
     * @return 返回真假类型的结果
     *
     */
    protected function addNewUser($user, $sina) {
        $data = array();
        //基本信息组合
        if ($user['type'] == "phone") {
            $data = array(
                'account' => $user['account'],
                'password' => md5($user['password']),
                'trade_password' => md5($user['password']),
                'sina_openid' => $sina['id'],
                'username' => $sina['name'],
                'email' => '',
                'telphone' => $user['account'],
                'user_type' => '2',
                'avatar' => "",
                'discription' => $sina['description'],
                'addtime' => date('Y-m-d H:i:s')
            );
        } elseif ($user['type'] == "email") {
            $data = array(
                'account' => $user['account'],
                'password' => md5($user['password']),
                'trade_password' => md5($user['password']),
                'sina_openid' => $sina['id'],
                'username' => $sina['name'],
                'email' => $user['account'],
                'telphone' => '',
                'user_type' => '2',
                'avatar' => "",
                'discription' => $sina['description'],
                'addtime' => date('Y-m-d H:i:s')
            );
        } else {
            return false;
        }
        //头像信息
        if ($sina['avatar_hd '] != '') {
            $dir = "upload/avatar";
            $fileName = "sina_" . $sina['id'];
            $virtualPath = $dir . "/" . $fileName . ".jpg";
            $data['avatar'] = $dir . "/" . $fileName . "_big.jpg";
            $this->comm->downloadFileWithCurl($sina['avatar_hd '], $virtualPath);
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
        //print_r($sina);exit;
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
     * @todo 生成微博链接
     * 
     */
    public function sinaLogin() {
        $code_url = $this->sinaAuth->getAuthorizeURL($this->sina_params['wb_callback_url']);
        $msg = array('error' => $code_url);
        echo json_encode($msg);
    }

}
