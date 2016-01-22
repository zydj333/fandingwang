<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_link_model
 *
 * @createtime 2014-10-22 16:21:40
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_link_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }


    /**
     *
     * @todo 获取友链的列表
     *
     * @param $title 标题名称
     *
     * @return 返回一个二维数组
     *
     */
    public function getFriendLinkList($title='') {
        $where=' where 1=1';
        if ($title != '') {
            $where = " and title like '%" . $title . "%'";
        }
        $sql = "select * from ai_friendlink " . $where . " order by salt asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存友情链接添加
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数 自增插入ID
     *
     */
    public function saveFriendLink($data) {
        $this->db->insert('ai_friendlink', $data);
        return $this->db->insert_id();
    }


    /**
     *
     * @todo 根据ID获取友情链接详情
     *
     * @param $id 要获取的数据ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getFriendInfoById($id){
        $sql="select * from ai_friendlink where id=?";
        $query=$this->db->query($sql,array($id));
        return $query->row();
    }

    /**
     *
     * @todo 保存友情链接的修改
     *
     * @param $data 要修改的数据
     *
     * @param $id 要修改友链的ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editFriendLinkById($data,$id){
        return $row = $this->db->update('ai_friendlink', $data, array('id' => $id));
    }

    /**
     *
     * @todo 根据友链ID删除友链信息
     *
     * @param $id 要删除的友链ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delFriendLinkById($id){
         return $this->db->delete('ai_friendlink', array('id' => $id));
    }
}
?>
