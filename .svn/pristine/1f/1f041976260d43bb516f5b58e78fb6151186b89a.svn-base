<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_setting_model
 *
 * @createtime 2014-11-7 14:31:58
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_setting_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取设置列表
     *
     * @param $type 查询分类
     *
     * @return  返回一个二维对象
     *
     */
    public function getSettingList($type){
        $this->db->where(array('select_group'=>$type));
        $query=$this->db->get('ai_setting');
        return $query->result();
    }

    /**
     *
     * @todo 检查是否存在
     *
     * @param $select_title
     *
     * @param $group
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function checkRepeat($select_title,$group){
        $this->db->where(array('select_title'=>$select_title,'select_group'=>$group));
        $query=$this->db->get('ai_setting');
        $count=$query->num_rows();
        if($count>0) return false;
        return true;
    }

    /**
     *
     * @todo 保存设置信息
     *
     * @param $data 要保存的数据
     *
     * @return  返回int类型的整数
     *
     */
    public function saveSettingData($data){
        $this->db->insert('ai_setting', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取设置信息
     *
     * @param $id 设置信息ID
     *
     * @return 返回一个对象
     *
     */
    public function getSettingInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('ai_setting');
        return $query->row();
    }


    /**
     *
     * @todo 修改设置信息
     *
     * @param $data 要修改的数据
     *
     * @param  $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editSettingData($data,$id){
        return $this->db->update('ai_setting', $data, array('id' => $id));
    }
}
?>
