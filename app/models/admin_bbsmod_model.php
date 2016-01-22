<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbsmod_model
 *
 * @createtime 2014-10-27 13:47:20
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbsmod_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取论坛模块列表
     *
     * @param pid 父级ID
     *
     * @return 返回一个对象结果集
     *
     */
    public function getModListByPid($pid=0){
        $this->db->where(array('pid'=>$pid));
        $query=$this->db->get('bbs_forumtype');
        return $query->result();
    }

    /**
     *
     * @todo 插入论坛模块信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveModData($data){
        $this->db->insert('bbs_forumtype', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取模块信息
     *
     * @param $id 模块ID
     *
     * @return 返回一个对象
     *
     */
    public function getModInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('bbs_forumtype');
        return $query->row();
    }


    /**
     *
     * @todo 根据ID修改模块信息
     *
     * @param $data 要修改成的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editModById($data,$id){
        return $this->db->update('bbs_forumtype', $data, array('id' => $id));
    }


    /**
     *
     * @todo 根据ID删除分类信息
     *
     * @param $id 要删除的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delModById($id){
        return $this->db->delete('bbs_forumtype', array('id' => $id));
    }
}
?>
