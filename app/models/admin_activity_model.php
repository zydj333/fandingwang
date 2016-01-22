<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_activity_model
 *
 * @createtime 2014-10-23 19:05:02
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_activity_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 根据条件获取活动列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个结果集
     *
     */
    public function getActivityList($search) {
        $sql = 'select * from ai_activity where 1=1';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存活动
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveActivityData($data) {
        $this->db->insert('ai_activity', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取活动信息
     *
     * @param $id 活动ID
     *
     * @return 返回一个结果集
     *
     */
    public function getActivityInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_activity');
        return $query->row();
    }

    /**
     *
     * @todo 根据ID修改活动信息
     *
     * @param $data 要修改的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editActivityData($data, $id) {
        return $row = $this->db->update('ai_activity', $data, array('id' => $id));
    }


    /**
     *
     * @todo 删除活动信息
     *
     * @param $id 要删除的数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function delActivity($id){
        return $this->db->delete('ai_activity', array('id' => $id));
    }

}

?>
