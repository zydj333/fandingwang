<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_varifycode_model
 *
 * @createtime 2015-3-14 9:53:37
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_varifycode_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取短信总条数
     * 
     * @param $search 查询条件 
     * 
     * @return  返回一个INT类型的整数
     * 
     */
    public function getVarifyCodeCount($search) {
        $where = '';
        if (isset($search['phonenumber'])) {
            $where.=' and phonenumber="' . $search['phonenumber'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select id from ai_phonecode where 1=1' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取短信列表
     * 
     * @param  $search 查询条件
     * 
     * @return  返回一个结果集
     *  
     * 
     */
    public function getVarifyCodeList($search) {
        $where = '';
        if (isset($search['phonenumber'])) {
            $where.=' and phonenumber="' . $search['phonenumber'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select * from ai_phonecode where 1=1' . $where . ' order by creattime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 修改验证码信息
     * 
     * @param $id 验证码ID
     * 
     * @param $data 要修改的信息
     * 
     * @return  返回一个真假类型的结果 
     * 
     */
    public function editVarifyCodeById($data,$id){
        return $this->db->update('ai_phonecode', $data, array('id' => $id));
    }
    
    
    /**
     * 
     * @todo 删除验证码信息
     * 
     * @param  $id 要删除的数据ID
     * 
     * @return 返回一个int类型的结果 
     * 
     */
    public function delVarifyCodeById($id){
        return $this->db->delete('ai_phonecode', array('id' => $id));
    }

}

?>
