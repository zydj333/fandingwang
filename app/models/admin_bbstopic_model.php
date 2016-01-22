<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbstopic_model
 *
 * @createtime 2014-10-28 9:19:58
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbstopic_model  extends CI_Model{
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取话题总条数
     *
     * @param $search 查询条件
     *
     * @return 返回一个int类型的整数
     *
     */
    public function getTopicCount($search){
        $where='';
        $sql='select * from  bbs_topic where 1=1 '.$where;
        $query=$this->db->query($sql);
        return $query->num_rows();
    }


    /**
     *
     * @todo 获取话题列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个结果集
     *
     */
    public function getTopicList($search){
        $where='';
        $sql='select * from  bbs_topic where 1=1 '.$where.' order by id desc limit '.$search['start'].','.$search['pagesize'];
        $query=$this->db->query($sql);
        return $query->result();
    }


    /**
     *
     * @todo 保存话题信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数 
     *
     */
    public function saveTopicData($data){
        $this->db->insert('bbs_topic', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取话题详情
     *
     * @param $id 话题ID
     *
     * @return 返回一个结果集
     *
     */
    public function getTopicInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('bbs_topic');
        return $query->row();
    }

    /**
     *
     * @todo 修改话题信息
     *
     * @param $data 要修改成的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editTopicData($data,$id){
        return $this->db->update('bbs_topic', $data, array('id' => $id));
    }
}
?>
