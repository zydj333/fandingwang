<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysetting
 *
 * @createtime 2015-4-8 4:18:21
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @todo 个人设置
 * 
 */
class mysetting extends Frontend_Controller {

    protected $userinfo;

    public function __construct() {
        parent::__construct();
        $this->load->model('mysetting_model');
        $this->load->model('usercenter_model');
        $this->userinfo = $this->userinfo();
        $this->comm->checkUserlogin();
    }

    /**
     * 
     * @todo 载入用户中心 
     * 
     */
    public function index() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $header['user'] = $user;
        $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $data['province'] = $this->comm_model->getAreaListByPid(0);
        if ($data['member']->province_id > 0) {
            $data['city'] = $this->comm_model->getAreaListByPid($data['member']->province_id);
        }
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/mysetting/setting', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 保存我的信息 
     * 
     */
    public function saveinfo() {
        $_data = $this->input->post();
        $user = $this->userinfo;
        $data = array(
            'gender' => $_data['gender'],
            'birthday' => $_data['birthday'],
            'job' => $_data['job'],
            'province_id' => $_data['province'],
            'city_id' => $_data['city'],
            'province' => '',
            'city' => '',
            'discription' => $_data['discription']
        );
        if ($data['province_id'] > 0) {
            $province = $this->comm_model->getAreaInfoById($data['province_id']);
            $data['province'] = $province->name;
        }
        if ($data['city_id'] > 0) {
            $city = $this->comm_model->getAreaInfoById($data['city_id']);
            $data['city'] = $city->name;
        }
        if ($this->mysetting_model->saveMemberEdit($data, $user['user_id'])) {
            redirect('/usercenter');
        } else {
            redirect('/mysettimg');
        }
    }

    /**
     * 
     * @todo 修改我的密码 
     * 
     */
    public function password() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $header['user'] = $user;
        //$data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/mysetting/password');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 修改我的密码 
     * 
     */
    public function savepassword() {
        $msg = array('flag' => 0, 'error' => '');
        $user = $this->userinfo;
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
        if (!$this->mysetting_model->checkUserPwdIsRight($user['user_id'], $pwd_md5)) {
            $msg['error'] = "原密码不正确!";
            echo json_encode($msg);
            exit;
        }
        $data['password'] = $new_pwd_md5;
        if ($this->mysetting_model->saveMemberEdit($data, $user['user_id'])) {
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
     * @todo 账号绑定 
     * 
     */
    public function cardbind() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $header['user'] = $user;
        //$data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/mysetting/cardbind');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 上传头像 
     * 
     */
    public function avatar() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $header['user'] = $user;
        //$data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $header['cusor'] = 'avatar';
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/mysetting/avatar');
        $this->load->view('frontend/public/footer');
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
        $user = $this->userinfo;
        $result = array();
        $result['success'] = false;
        $successNum = 0;
        $i = 0;
        $msg = '';
        //上传目录
        $dir = "upload/avatar";
        //echo json_encode($_FILES);exit;
        //遍历所有文件域
        $fileName = date("YmdHis") . "_" . $user['user_id'];
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
                    $this->mysetting_model->saveMemberEdit($userimg, $user['user_id']);
                    $user['avatar_big'] = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar2') {
                    //中头像
                    $virtualPath = $dir . "/" . $fileName . "_middle.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user['avatar_middle'] = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar3') {
                    //小头像
                    $virtualPath = $dir . "/" . $fileName . "_small.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user['avatar_small'] = $virtualPath;
                    $successNum++;
                    $i++;
                }
            }
        }
        $this->comm->set_session('member', json_encode($user));
        $result['msg'] = $msg;
        if ($successNum > 0) {
            $result['success'] = true;
        }
        //返回图片的保存结果（返回内容为json字符串）
        print json_encode($result);
    }

    /**
     * 
     * @todo 地址管理 
     * 
     */
    public function address() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $header['user'] = $user;
        //获取地址列表
        $data['address'] = $this->mysetting_model->getMyAddressList($user['user_id']);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/mysetting/address', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 添加地址 
     * 
     */
    public function addressSave() {
        $user = $this->userinfo;
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'uid' => $user['user_id'],
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
                    $this->mysetting_model->editDefaultAddress($data['uid']);
                }
                $id = $this->mysetting_model->saveAddress($data);
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
        } else {
            //获取省份列表
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $this->load->view('frontend/mysetting/addressadd', $data);
        }
    }

    /**
     * 
     * @todo 设置默认地址 
     * 
     */
    public function defaultset() {
        $user = $this->userinfo;
        $id = $this->input->post('id') ? $this->input->post('id') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($id == 0) {
            $msg['error'] = "默认地址设置失败，参数错误";
            echo json_encode($msg);
            exit;
        }
        $data['is_default'] = 1;
        $this->mysetting_model->editDefaultAddress($user['user_id']);
        if ($this->mysetting_model->editAddressInfo($data, $id)) {
            $msg['flag'] = 1;
            $msg['error'] = "默认地址设置成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "默认地址设置失败，错误未知";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 删除地址 
     * 
     */
    public function deladdress() {
        $user = $this->userinfo;
        $id = $this->input->post('id') ? $this->input->post('id') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($id == 0) {
            $msg['error'] = "删除地址失败，参数错误";
            echo json_encode($msg);
            exit;
        }
        if ($this->mysetting_model->delAddressInfo($id)) {
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
     * @todo 修改地址消息 
     * 
     */
    public function addressEdit() {
        $_data = $this->input->post();
        $user = $this->userinfo;
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => "");
            $address_id = $_data['address_id'] ? $_data['address_id'] : 0;
            if ($address_id == 0) {
                $msg['error'] = "无法保存修改，参数丢失";
                echo json_encode($msg);
                exit;
            }
            $data = array(
                'username' => $_data['username'],
                'cellphone' => $_data['celphone'],
                'province' => $_data['province'],
                'province_name' => "",
                'city' => $_data['city'],
                'city_name' => "",
                'area' => $_data['area'],
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
                    $this->mysetting_model->editDefaultAddress($user['user_id']);
                }
                if ($this->mysetting_model->editAddressInfo($data, $address_id)) {
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
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id == 0) {
                echo '参数错误!';
                exit;
            }
            $address = $this->mysetting_model->getAddressInfoById($id);
            if (empty($address)) {
                echo '初始化数据失败!';
                exit;
            }
            $data['address'] = $address;
            //获取省份列表
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $data['city'] = array();
            $data['area'] = array();
            if ($address->province > 0) {
                $data['city'] = $this->comm_model->getAreaListByPid($address->province);
            }
            if ($address->city > 0) {
                $data['area'] = $this->comm_model->getAreaListByPid($address->city);
            }
            $this->load->view('frontend/mysetting/addressEdit', $data);
        }
    }

}

?>
