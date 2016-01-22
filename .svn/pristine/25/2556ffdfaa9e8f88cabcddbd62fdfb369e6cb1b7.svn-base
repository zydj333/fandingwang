<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_banner_model
 *
 * @createtime 2014-10-22 12:06:05
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_banner_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }


   /**
     *
     * @todo 根据条件获取广告总条数
     *
     * @param $search 查询条件
     *
     * @return  返回一个int类型的整数
     *
     */
    public function getAdCountBySearch($search) {
        $where = ' where 1=1';
        if (isset($search['type'])) {
            $where.=' AND type="' . $search['type'] . '"';
        }
        if (isset($search['title'])) {
            $where.=' AND title like "%' . $search['title'] . '%"';
        }
        $sql = 'SELECT id FROM ai_banner ' . $where . ' ORDER BY sult ASC';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 根据条件获取广告列表
     *
     * @param search 查询条件
     *
     * @return array() 返回一个二维数组
     *
     */
    public function getAdListBySearch($search) {
        $where = ' where 1=1';
        if (isset($search['type'])) {
            $where.=' AND type="' . $search['type'] . '"';
        }
        if (isset($search['title'])) {
            $where.=' AND title like "%' . $search['title'] . '%"';
        }
        $sql = 'SELECT * FROM ai_banner ' . $where . ' ORDER BY sult ASC LIMIT ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存广告信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveAdData($data) {
        $this->db->insert('ai_banner', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取广告信息
     *
     * @param $id 要获取的广告信息ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getAdInfoById($id) {
        $sql = 'select * from ai_banner where id=?';
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    /**
     *
     * @todo 保存对广告信息的修改
     *
     * @param $data 要保存的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function saveAdDataEdit($data, $id) {
        return $row = $this->db->update('ai_banner', $data, array('id' => $id));
    }

    /**
     *
     * @todo 根据广告ID删除广告信息
     *
     * @param $id 要删除的广告ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delAdById($id){
         return $this->db->delete('ai_banner', array('id' => $id));
    }
}
?>
