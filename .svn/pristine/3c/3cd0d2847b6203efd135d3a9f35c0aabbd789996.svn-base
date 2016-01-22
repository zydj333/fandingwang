<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_mail_model
 *
 * @createtime 2015-3-17 11:38:07
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_mail_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *  
     * @todo 获取邮件的总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数
     * 
     */
    public function getMailCount($search) {
        $where = '';
        if(isset($search['email'])){
            $where.=' and email="'.$search['email'].'"';
        }
        if(isset($search['status'])){
            $where.=' and status='.$search['status'];
        }
        $sql = 'select id from ai_email_queue where 1=1 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取邮件列表
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个对象 
     * 
     */
    public function getMailList($search) {
        $where = '';
        if(isset($search['email'])){
            $where.=' and email="'.$search['email'].'"';
        }
        if(isset($search['status'])){
            $where.=' and status='.$search['status'];
        }
        $sql = 'select * from ai_email_queue where 1=1 ' . $where .' order by id desc limit '.$search['start'].','.$search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 重置邮件信息
     * 
     * @param $data 要修改数据
     * 
     * @param $id 邮件ID
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function resetMailById($data,$id){
        return $this->db->update('ai_email_queue', $data, array('id' => $id));
    }
    
    
    /**
     * 
     * @todo 删除邮件信息
     * 
     * @param $id 要删除的邮件ID
     * 
     * @return 返回真假类型的结果 
     * 
     */
    public function delMailCodeById($id){
         return $this->db->delete('ai_email_queue', array('id' => $id));
    }

}

?>
