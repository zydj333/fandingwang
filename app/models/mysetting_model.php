<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysetting_model
 *
 * @createtime 2015-4-8 4:27:01
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class mysetting_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 保存用户的个人信息 
     * 
     * @param $data 要保存的数据
     * 
     * @param $uid 用户ID
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function saveMemberEdit($data, $uid) {
        return $this->db->update('ai_member', $data, array('id' => $uid));
    }

    /**
     * 
     * @todo 根据用户ID和用户密码  检查密码是否正确 
     * 
     * @param $uid 用户ID
     * 
     * @param $pwd 用户密码
     * 
     * @return  返回真假类型的结果
     * 
     */
    public function checkUserPwdIsRight($uid, $pwd) {
        $this->db->where(array('id' => $uid, 'password' => $pwd));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取我的地址列表
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMyAddressList($user_id) {
        $this->db->where(array('uid' => $user_id));
        $query = $this->db->get('ai_member_address');
        return $query->result();
    }

    /**
     * 
     * @todo 修改默认地址 
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个boolea类型的结果
     * 
     */
    public function editDefaultAddress($uid) {
        $data = array('is_default' => 0);
        return $this->db->update('ai_member_address', $data, array('uid' => $uid));
    }

    /**
     * 
     * @todo 保存用户地址
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveAddress($data) {
        $this->db->insert('ai_member_address', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     *  @todo 修改地址信息
     * 
     * @param $data 要修改的数据
     * 
     * @param  $id 要修改的地址ID
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function editAddressInfo($data, $id) {
        return $this->db->update('ai_member_address', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 删除地址
     * 
     * @param $id 要删除的地址ID
     * 
     * @return 返回一个boolean 类型的结果 
     * 
     */
    public function delAddressInfo($id) {
        return $this->db->delete('ai_member_address', array('id' => $id));
    }
    
    /**
     * 
     * @todo 获取一条地址信息 
     * 
     * @param $id 地址ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getAddressInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=  $this->db->get('ai_member_address');
        return $query->row();
    }

}

?>
