<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_email
 *
 * @createtime 2014-10-8 17:35:54
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Email extends CI_Controller {

//put your code here
    protected $user = array();
    private $_config;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('comm_model');
        $this->user = json_decode($this->comm->get_session('member'), true);
        $this->_ini();
    }

    /**
     *
     * @todo 邮件发送列表
     *
     */
    public function createmail() {
        $msg = array(
            'flag' => 0,
            'error' => ''
        );
        $type = ($this->input->post('email_type') != '') ? $this->input->post('email_type') : 'real_email';
        $email = $this->input->post('email');
        if ($email == '') {
            $email = $this->user['email'];
        }
        if ($this->comm->is_email($email)) {
            $randnum = rand(100000000, 99999999999);
            if ($type == 'real_email') {
                $title = '投友网邮箱验证';
                $url = base_url() . 'login/stepthree/' . $this->user['uid'] . '/' . $type . '/' . $randnum;
                $content = '亲爱的用户（' . $this->user['username'] . '）您好，感谢您对投友网的关注和支持，您的邮箱认证链接为<a href="http://' . $url . '" target="_blank">' . $url . '</a></br>
                 如果没有连接请复制打开！<br/><br/>链接：' . $url;
            } else if ($type == 'find_pwd') {
                $title = '爱众筹密码找回';
            } else {
                $title = '爱众筹';
            }
            $data = array(
                'uid' => $this->user['uid'],
                'email' => $email,
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'randnum' => $randnum
            );
            $id = $this->comm_model->saveEmailQueue($data);
            if ($id > 0) {
                //self::sendEmail();
                $msg['flag'] = 1;
                $msg['error'] = '创建邮件成功,去您的邮箱查看吧！';
            } else {
                $msg['error'] = '创建邮件失败！';
            }
        } else {
            $msg['error'] = '邮箱错误！';
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 发送邮件入口
     *
     */
    public function sendEmail() {
        $list = $this->comm_model->getWaitingEmailList();
        if (!empty($list)) {
            foreach ($list as $ket => $value) {
                if (self::send($value['email'], $value['title'], $value['content'])) {
                    $data = array(
                        'status' => 1
                    );
                    $this->comm_model->editEmailQueueStatus($data, $value['id']);
                }
            }
        } else {
            return;
        }
    }

    /**
     *
     * @todo 执行发送操作
     *
     */
    public function send($email, $title, $content) {
        return $this->comm->sendMail($email, $title, $content, $this->_config);
    }

    private function _ini() {
        $host = $this->comm_model->getSetingByName('email_smtp');
        $username = $this->comm_model->getSetingByName('email_account');
        $password = $this->comm_model->getSetingByName('smtp_password');
        $port = $this->comm_model->getSetingByName('smtp_port');
        $from = $this->comm_model->getSetingByName('smtp_from_email');
        $fromName = $this->comm_model->getSetingByName('smtp_from_name');
        $this->_config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $host->select_values,
            'smtp_port' => $port->select_values,
            'smtp_user' => $username->select_values,
            'smtp_pass' => $password->select_values,
            'wordwrap' => TRUE,
            'smtp_fromName' => $fromName->select_values,
            'smtp_from' => $from->select_values
        );
    }

    /**
     * 
     * @todo 注册生成邮件邮件
     * 
     * @retrn 返回一个int类型的整数   
     * 
     */
    public function saveRegisterEmail() {
        $email = $this->input->post('phone');
        if ($this->comm_model->checkEmailIsDefind($email)) {
            $msg['error'] = '邮箱已经存在,获取验证码失败!';
            echo json_encode($msg);
            exit;
        }
        //取一个随机数作为验证码
        $code = rand('100000', '999999');
        $data = array(
            'user_id' => 0,
            'user_name' => $code,
            'email' => $email,
            'title' => '泛丁众筹邮件验证',
            'content' => '感谢您注册泛丁众筹，您的验证码为:' . $code . ',请注意核对！',
            'status' => 0,
            'creattime' => date('Y-m-d H:i:s', time()),
            'trytimes' => 0,
        );
        //载入数据库
        $id = $this->comm_model->saveEmailCode($data);
        if ($id > 0) {
            //self::sendEmail();
            $msg['flag'] = 1;
            $msg['error'] = '创建邮件成功,去您的邮箱查看吧！';
        } else {
            $msg['error'] = '创建邮件失败！';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 找回密码邮件邮件
     * 
     * @retrn 返回一个int类型的整数   
     * 
     */
    public function saveForgetEmail() {
        $email = $this->input->post('phone');
        if (!$this->comm_model->checkEmailIsDefind($email)) {
            $msg['error'] = '邮箱尚未注册,获取验证码失败!';
            echo json_encode($msg);
            exit;
        }
        //取一个随机数作为新密码
        $code = rand('100000', '999999');
        $data = array(
            'user_id' => 0,
            'user_name' => $code,
            'email' => $email,
            'title' => '泛丁众筹密码找回',
            'content' => '您正在申请泛丁众筹密码找回，您的验证码为:' . $code . ',请注意核对！',
            'status' => 0,
            'creattime' => date('Y-m-d H:i:s', time()),
            'trytimes' => 0,
        );
        //载入数据库
        $id = $this->comm_model->saveEmailCode($data);
        if ($id > 0) {
            //self::sendEmail();
            $msg['flag'] = 1;
            $msg['error'] = '创建邮件成功,去您的邮箱查看吧！';
        } else {
            $msg['error'] = '创建邮件失败！';
        }
        echo json_encode($msg);
    }

}

?>
