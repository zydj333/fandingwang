<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_tag_model
 *
 * @createtime 2014-10-27 16:20:08
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbstag_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }


    /**
     *
     * @todo 获取论坛模块列表
     *
     *
     * @return 返回一个对象结果集
     *
     */
    public function getTagList(){
        $query=$this->db->get('bbs_tags');
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
    public function saveTagData($data){
        $this->db->insert('bbs_tags', $data);
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
    public function getTagInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('bbs_tags');
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
    public function editTagById($data,$id){
        return $this->db->update('bbs_tags', $data, array('id' => $id));
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
    public function delTagById($id){
        return $this->db->delete('bbs_tags', array('id' => $id));
    }
}
?>
