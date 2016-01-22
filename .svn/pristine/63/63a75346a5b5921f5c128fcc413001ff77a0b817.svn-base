<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register_model
 *
 * @createtime 2015-4-7 10:14:02
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class register_model extends CI_Model {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取根据昵称获取用户信息检查是否存在
     * 
     * @param $nickname 用户昵称
     * 
     * @return 返回一个真假类型的结果 
     * 
     */
    public function checkNickName($nickname) {
        $this->db->where(array('account' => $nickname));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取用户邮箱检查邮箱是否已经存在
     * 
     * @param $email 邮箱地址
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function checkEmail($email) {
        $this->db->where(array('email' => $email));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取用户手机号码检查手机号码是否存在 
     * 
     * @param $phone 用户手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkPhone($phone) {
        $this->db->where(array('telphone' => $phone));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取用户的手机验证码
     * 
     * @param $phone 手机号
     * 
     * @param $phonecode 手机验证码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkPhoneCode($phone, $phonecode) {
        $time = time();
        $sql = 'select id from ai_phonecode where phonenumber=' . $phone . ' and phonecode=' . $phonecode . ' and (status=1 or status=0) and passtime>' . $time;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 执行用户的添加操作
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回插入的ID 
     * 
     */
    public function saveMemberAccount($data) {
        $this->db->insert('ai_member', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 修改手机验证码的状态
     * 
     * @param $data 要修改的数据
     * 
     * @param $phone 条件
     * 
     * @param $phonecode 条件
     * 
     * @return  返回真假类型的结果 
     * 
     */
    public function editPhoneCodeStatus($data, $phone, $phonecode) {
        return $this->db->update('ai_phonecode', $data, array('phonenumber' => $phone, 'phonecode' => $phonecode));
    }

    /**
     * 
     * @todo 检查登录账户是否存在 
     * 
     * @param $account 用户账户
     * 
     * @param $password 账户密码
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function checkAccountIsSet($account, $password) {
        $sql = 'select id from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
        $rows = $query->num_rows();
        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 进行登录操作
     * 
     * @param $account 登录账户
     * 
     * @param $password 登录密码
     * 
     * @return  返回一个对象 
     * 
     */
    public function getUserInfo($account, $password) {
        $sql = 'select id,account,email,telphone,username,addtime,avatar from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
        return $query->row();
    }

    /**
     * 
     * @todo 根据手机号码获取用户信息
     * 
     * @param $phone 手机号码
     * 
     *  @return 返回一个对象 
     * 
     */
    public function getUserByCellPhone($phone) {
        $sql = 'select id,account,email,telphone,username,addtime,avatar from ai_member where telphone=?';
        $query = $this->db->query($sql, array($phone));
        return $query->row();
    }

    /**
     * 
     * @todo 获取上次登录时间
     * 
     * @Param $id 用户ID
     * 
     * @return 返回一个对象  
     * 
     */
    public function getLastLogin($id) {
        $this->db->where(array('uid' => $id));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ai_member_log');
        return $query->row();
    }

    /**
     * 
     * @todo 添加本次登录记录
     * 
     * @param $data 要保存的数据
     * 
     * @return  返回一个自增ID
     *  
     * 
     */
    public function addThisLogin($data) {
        $this->db->insert('ai_member_log', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 修改用户密码、、根据手机号码进行修改 
     * 
     * @param $data 要修改的数据 
     * 
     * @param $phone 手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMemberLoginPassword($data, $phone) {
        return $this->db->update('ai_member', $data, array('telphone' => $phone));
    }

}

?>
