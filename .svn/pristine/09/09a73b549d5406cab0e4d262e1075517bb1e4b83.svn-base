<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_admessage_model
 *
 * @createtime 2015-3-18 10:50:33
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_admessage_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo  获取短信总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数
     * 
     */
    public function getAdmessageCount($search) {
        $where = '';
        if (isset($search['cellphone'])) {
            $where.=' and cellphone="' . $search['cellphone'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select id from ai_admessage where 1=1 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     *  @todo 获取短信广告列表
     * 
     * @param  $search 查询条件
     * 
     * @return  返回一个结果集 
     * 
     */
    public function getAdmessageList($search) {
        $where = '';
        if (isset($search['cellphone'])) {
            $where.=' and cellphone="' . $search['cellphone'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select * from ai_admessage where 1=1 ' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取所有用户的信息
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getAllUserList() {
        $sql = 'select id,account,telphone from ai_member where real_phone=1 order by id';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据用户账户获取用户信息 
     * 
     * @param $account 用户账号
     * 
     * @return  返回一条数据
     * 
     */
    public function getUserInfoByAccount($account) {
        $sql = 'select id,account,telphone from ai_member where account=? and real_phone=?';
        $query = $this->db->query($sql, array($account, '1'));
        return $query->row();
    }
    
    /**
     * 
     * @todo  检查数据是否已经存在
     * 
     * @param $data 要检查的数据
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function checkMessageIsDefind($data){
        $sql='select id from ai_admessage where user_id=? and user_name=? and cellphone=? and content=?';
        $query=$this->db->query($sql,array($data['user_id'],$data['user_name'],$data['cellphone'],$data['content']));
        $rows=$query->num_rows();
        if($rows>0){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * 
     * @todo 执行数据的添加操作
     * 
     * @param $data 要添加的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveMessageData($data){
         $this->db->insert('ai_admessage', $data);
         return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 重置短信信息 
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 要修改的和数据ID
     * 
     * @return 返回一个真假类型的结果
     * 
     */
    public function editMessageById($data,$id){
         return $this->db->update('ai_admessage', $data, array('id' => $id));
    }
    
    
    /**
     * 
     * @todo 删除短信信息
     * 
     * @param $id 要删除的信息ID
     * 
     * @return 返回真假类型的结果 
     * 
     */
    public function delMessageCodeById($id){
        return $this->db->delete('ai_admessage', array('id' => $id));
    }

}

?>
