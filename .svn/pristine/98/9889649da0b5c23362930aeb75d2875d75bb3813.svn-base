<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_newtype_model
 *
 * @createtime 2014-10-22 18:15:47
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_newtype_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据父级ID获取咨询分类
     *
     * @param $pid 父级ID
     *
     * @return 返回结果集
     *
     */
    public function getNewTypeByPid($pid){
        $this->db->where(array('pid'=>$pid));
        $this->db->order_by('salt');
        $query=$this->db->get('ai_newtype');
        return $query->result();
    }

    /**
     *
     * @todo 保存新闻分类
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的结果
     *
     */
    public function saveNewType($data){
        $this->db->insert('ai_newtype', $data);
        return $this->db->insert_id();
    }


    /**
     *
     * @todo 根据ID获取新闻分类信息
     *
     * @param $id 新闻分类ID
     *
     * @return 返回一个结果集
     *
     */
    public function getNewTypeInfoById($id){
         $this->db->where(array('id'=>$id));
        $query=$this->db->get('ai_newtype');
        return $query->row();
    }


    /**
     *
     * @todo 根据ID修改分类信息
     *
     * @param $id 要修改的数据
     *
     * @param $data 修改成的数据
     *
     * @return  返回一个真假类型的结果
     *
     */
    public function saveNewTypeEdit($data,$id){
         return $row = $this->db->update('ai_newtype', $data, array('id' => $id));
    }


    /**
     *
     * @todo 根据ID删除分类信息
     *
     * @param $id 要删除的数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function delNewTypeById($id){
        return $this->db->delete('ai_newtype', array('id' => $id));
    }
}
?>
