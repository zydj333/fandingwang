<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_user_model
 *
 * @createtime 2014-10-21 16:29:17
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_user_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取管理用户列表
     *
     * @return 返回一个二维结果集
     *
     */
    public function getUserList() {
        $this->db->order_by('id');
        $query = $this->db->get('ai_adminuser');
        return $query->result();
    }

    /**
     *
     * @todo 根据用户的账户检查重复
     *
     * @param $data 要检查的数据
     *
     * @return 返回真假
     *
     */
    public function checkRepeat($data) {
        $sql = "SELECT * FROM ai_adminuser WHERE account=?";
        $query = $this->db->query($sql, array($data['account']));
        if ($query->num_rows()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *
     * @todo 保存用户信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveAdminUserData($data) {
        return $this->db->insert('ai_adminuser', $data);
    }

    /**
     *
     * @todo 根据ID获取用户信息
     *
     * @param $id 用户ID
     *
     * @return 返回结果集
     *
     */
    public function getUserById($id) {
        $this->db->where(array('id' => $id));
        $result = $this->db->get('ai_adminuser');
        return $result->row();
    }

    /**
     *
     * @todo 根据初始密码查询用户信息
     *
     * @param $id 用户ID
     *
     * @param $pwd 用户密码
     *
     * @return 返回真假
     *
     */
    public function checkUserStartPwd($id,$pwd){
        $this->db->where(array('id' => $id,'password'=>$pwd));
        $result = $this->db->get('ai_adminuser');
        if(count($result->result())==1){
            return true;
        }else{
            return false;
        }
    }

    /**
     *
     * @todo 根据用户ID修改用户信息
     *
     * @param $data 要修改成的信息
     *
     * @param $id 用户ID
     *
     * @return 返回受到影响的行数
     *
     */
    public function editUserByUid($data, $id) {
        return $row = $this->db->update('ai_adminuser', $data, array('id' => $id));
    }

    /**
     *
     * @todo 删除数据
     *
     * @param $id 要删除数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function delUserById($id) {
        return $this->db->delete('ai_adminuser', array('id' => $id));
    }


    /**
     *
     * @todo 获取用户及权限列表
     *
     * @return 返回一个二维数组
     *
     */
    public function getAdminUserPowerList() {
        $sql = "select a.account,a.username,a.id as uid,a.power,b.id as pid,b.powername from ai_adminuser as a left join ai_power as b on a.power=b.id where a.is_del=0";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 根据用户ID获取用户的信息和权限
     *
     * @param $id 用户的ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getUserInfoAndPower($id) {
        $sql = "select a.account,a.username,a.id as uid,a.power,b.id as pid,b.powername from ai_adminuser as a left join ai_power as b on a.power=b.id where a.is_del=? and a.id=?";
        $query = $this->db->query($sql, array(0, $id));
        return $query->row();
    }

}

?>
