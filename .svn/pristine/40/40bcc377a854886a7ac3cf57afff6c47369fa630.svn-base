<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_power_model
 *
 * @createtime 2014-10-21 17:52:21
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_power_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取权限列表
     *
     */
    public function getPowerList() {
        $sql = "SELECT * FROM ai_power ORDER BY addtime DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存权限分组信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回int类型的整数 插入ID
     *
     */
    public function savePowerGroup($data) {
        return $this->db->insert('ai_power', $data);
    }

    /**
     *
     * @todo 根据ID获取权限详情
     *
     * @param $id 权限ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getPowerById($id) {
        $sql = "SELECT * FROM ai_power WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    /**
     *
     * @todo 保存权限修改
     *
     * @param $data 要修改的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function savePowerEdit($data, $id) {
        return $row = $this->db->update('ai_power', $data, array('id' => $id));
    }
}
?>
