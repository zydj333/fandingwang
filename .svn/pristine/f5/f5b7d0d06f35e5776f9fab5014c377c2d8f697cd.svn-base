<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbsreply_model
 *
 * @createtime 2014-10-28 15:12:08
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbsreply_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 根据条件获取总条数
     *
     * @param $data 查询条件
     *
     * @return 返回一个int类型的整数
     *
     */
    public function getReplyCount($search) {
        $where='';
        $sql = 'select * from bbs_reply where 1=1 '.$where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 根据条件获取评论的列表
     *
     * @param $data 查询条件
     *
     * @return 返回一个对象结果集
     *
     */
    public function getReplyList($search){
        $where='';
        $sql = 'select * from bbs_reply where 1=1 '.$where.' order by id desc limit '.$search['start'].','.$search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 修改回复信息
     *
     * @param $data 要修改的数据
     *
     * @param $id  要修改的数据id
     *
     * @return 返回真假类型的结果
     *
     */
    public function editReply($data,$id){
        return $this->db->update('bbs_reply', $data, array('id' => $id));
    }

}

?>
