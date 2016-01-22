<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_member_model
 *
 * @createtime 2015-4-16 9:21:16
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_member_model extends CI_Model {

//put your code here
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
     * @todo 根据条件获取前台用户总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数
     * 
     */
    public function getMemberCount($search) {
        $where = '';
        if (isset($search['account'])) {
            $where.=' and account like "%' . $search['account'] . '%"';
        }
        if (isset($search['username'])) {
            $where.=' and username like "%' . $search['username'] . '%"';
        }
        if (isset($search['email'])) {
            $where.=' and email like "%' . $search['email'] . '%"';
        }
        if (isset($search['telphone'])) {
            $where.=' and telphone =' . $search['telphone'];
        }
        $sql = 'select * from ai_member where 1=1' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
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
        $sql = "SELECT * FROM ai_member WHERE (account = ? or email = ? or telphone = ?)";
        $query = $this->db->query($sql, array($data['account'],$data['account'],$data['account']));
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
        return $this->db->insert('ai_member', $data);
    }

    /**
     * 
     * @todo  根据条件获取前台用户列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMemberList($search) {
        $where = '';
        if (isset($search['account'])) {
            $where.=' and account like "%' . $search['account'] . '%"';
        }
        if (isset($search['username'])) {
            $where.=' and username like "%' . $search['username'] . '%"';
        }
        if (isset($search['email'])) {
            $where.=' and email like "%' . $search['email'] . '%"';
        }
        if (isset($search['telphone'])) {
            $where.=' and telphone =' . $search['telphone'];
        }
        $sql = 'select id,account,username,avatar,email,telphone,birthday,gender,addtime from ai_member where 1=1 ' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据用户ID获取用户详情 
     * 
     * @param $mid 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMemberInfoById($mid) {
        $this->db->where(array('id' => $mid));
        $query = $this->db->get('ai_member');
        return $query->row();
    }

}

?>
