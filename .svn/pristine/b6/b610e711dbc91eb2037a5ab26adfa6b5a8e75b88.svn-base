<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wechatlogin_model
 *
 * @author aman
 */
class wechatlogin_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     *
     * @todo 获取当前微信的openid是否已经在本库存在
     *
     * @param $openid 腾讯openid
     *
     * @return 返回一个Boolean类型的结果
     *
     */
    public function checkOpenidIsSet($openid) {
        $this->db->where(array('wechat_openid' => $openid));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @todo 根据用户的openid获取用户信息
     *
     * @param $openid  微信的openid
     *
     * @return 返回一个结果集
     *
     */
    public function getMemberBywechatOpenid($openid) {
        $this->db->where(array('wechat_openid' => $openid));
        $query = $this->db->get('ai_member');
        return $query->row();
    }

    /**
     *
     * @todo 检查用户的手机号码是否已经注册
     *
     * @param $phone 手机号码
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function checkPhoneRegister($phone) {
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
     * @todo 检查用户的邮箱是否已经注册
     *
     * @param $email 邮箱
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function checkEmailRegister($email) {
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
     * @todo 根据用户提供的数据获取用户信息
     *
     * @param $account 用户帐号
     *
     * @param $password 用户密码
     *
     * @return 返回一个结果对象
     *
     */
    public function getUserInfo($account, $password) {
        $sql = 'select * from ai_member where (email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $password));
        return $query->row();
    }

    /**
     *
     * @todo 修改用户信息
     *
     * @param $data 要修改的数据
     *
     * @param $uid 要修改的用户ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function editMemberInfo($data, $uid) {
        return $this->db->update('ai_member', $data, array('id' => $uid));
    }

}
