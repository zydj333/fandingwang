<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_projecttype_model
 *
 * @createtime 2014-10-23 17:47:18
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_projecttype_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }


    /**
     *
     * @todo 获取项目分类列表
     *
     * @return 返回一个结果集
     *
     */
    public function getProjectTypeList(){
        $this->db->order_by('salt');
        $query=$this->db->get('ai_projecttype');
        return $query->result();
    }

    /**
     *
     * @todo 检查添加的数据是否已经存在
     *
     * @param $title 要检查的数据
     *
     * @return 返回真假类型的结果
     *
     */
    public function checkProjectTypeIsSet($title){
        $this->db->where(array('title'=>$title));
        $query=$this->db->get('ai_projecttype');
        if($query->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }

    /**
     *
     * @todo 保存项目分类信息
     *
     * @param $data 分类信息
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveProjectType($data){
        $this->db->insert('ai_projecttype', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取分类详情
     *
     * @param $id 要获取的分类ID
     *
     * @return 返回一个结果集
     *
     */
    public function getProjectTypeInfo($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('ai_projecttype');
        return $query->row();
    }

    /**
     *
     * @todo 修改项目分类
     *
     * @param $data 要修改的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function saveProjectTypeEdit($data,$id){
         return $row = $this->db->update('ai_projecttype', $data, array('id' => $id));
    }

    /**
     *
     * @todo 根据ID删除分类信息
     *
     * @param $id 要删除的分类ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delProjectTypeById($id){
         return $this->db->delete('ai_projecttype', array('id' => $id));
    }
}
?>
