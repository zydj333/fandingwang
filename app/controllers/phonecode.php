<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phonecode
 *
 * @createtime 2014-11-19 13:17:29
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Phonecode extends Frontend_Controller {

//put your code here
    protected $user = array();

    const WEBPOWER_USERNAME = 'admin';
    const WEBPOWER_PASSWORD = 'eih9ooLiex';
    const WEBPOWER_SMSURL = "http://aidai.webpowerchina.cn/sms/rest/v1/sms";

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('comm_model');
        $this->user = json_decode($this->comm->get_session('member'), true);
    }

    /**
     *
     * 生成手机验证码
     *
     */
    public function createPhoneCode() {
        $msg = array(
            'flag' => 0,
            'error' => ''
        );
        //取一个随机数作为手机验证码
        $code = rand('100000', '999999');
        $type = $this->input->post('codetype');
        $content = '';
        $phone = $this->input->post('phone');
        $timer = strtotime(date('y-m-d'));
        //检查手机格式
        if(!$this->comm->checkPhone($phone)){
            $msg['error'] = '手机格式不正确!';
            echo json_encode($msg);
            exit;
        }
        //根据手机号码检查短信条数是否超过5条
        if ($this->comm_model->checkPhoneCodeTotalCount($phone, $timer)) {
            $msg['error'] = '今天已经超过最大短信条数!';
            echo json_encode($msg);
            exit;
        }
        if ($type == 'real_phone') {
            if ($this->comm_model->checkCellPhoneIsDefind($phone)) {
                $msg['error'] = '该手机号码已经存在，获取短信失败!';
                echo json_encode($msg);
                exit;
            }
            $content = '感谢您申请泛丁众筹，您的验证码为' . $code . '，千万不要告诉别人哦。';
        } elseif ($type == 'forget') {
            if (!$this->comm_model->checkCellPhoneIsDefind($phone)) {
                $msg['error'] = '该手机号码尚未注册,获取短信失败!';
                echo json_encode($msg);
                exit;
            }
            $content = '您正在申请找回密码操作，您的手机验证码为：' . $code . ',任何人索取验证码均为诈骗，如果不是您本人操作，请尽快登录账号修改信息。';
        } elseif ($type == 'cash') {
            $content = '账户提现验证码为' . $code . ',任何人索取验证码均为诈骗，如果不是您本人操作，请尽快更换账户密码。';
        } else if($type=='login'){
            $content = '您此次登录的验证码为' . $code . '，请不要提供给其他人使用。';
        } else if($type=='password'){
            $content = '找回密码成功，您的新密码为' . $code . '，请不要提供给他人使用。';
        } else {
            $msg['error'] = '数据类型错误!';
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'uid' => isset($this->user['u_id']) ? $this->user['u_id'] : 0,
            'phonenumber' => $phone,
            'phonecode' => $code,
            'content' => $content,
            'status' => 0,
            'trytimes' => 0,
            'passtime' => time() + 1800,
            'creattime' => time(),
            'add_ip' => $this->comm->real_ip()
        );
        if ($data['phonenumber'] == '') {
            $msg['error'] = '手机号码不能为空！';
        } else {
            $id = $this->comm_model->savePhoneCode($data);
            if ($id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = '创建验证码成功，等待系统发送验证码';
            } else {
                $msg['error'] = '发送验证码失败，请联系客服处理！';
            }
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 发送验证码，系统自动
     *
     */
    public function sendCode() {
        $list = $this->comm_model->getPhoneCodeList();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $result = self::send($v->phonenumber, $v->content);
                if ($result === true) {
                    $data = array('status' => 1, 'trytimes' => $v->trytimes + 1);
                    $this->comm_model->editPhoneCode($data, $v->id);
                } else {
                    return;
                }
            }
        } else {
            return;
        }
    }

    public function send($cell, $msg) {
        $strSmsParam = array('mobile' => $cell, 'content' => $msg, 'campaignID' => 1);
        $strRes = self::postSend(self::WEBPOWER_SMSURL, $strSmsParam);
        $rs = json_decode($strRes, true); //强制生成PHP关联数组
        if ($rs['status'] == "OK") {
            return true;
        } else {
            return false;
        }
    }

    public function postSend($url, $param) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-HTTP-Method-Override:POST"));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, self::WEBPOWER_USERNAME . ":" . self::WEBPOWER_PASSWORD);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function gbkToUtf8($str) {
        //return rawurlencode(iconv('GB2312','UTF-8',$str));
        return iconv('GB2312', 'UTF-8', $str);
    }

}

?>
