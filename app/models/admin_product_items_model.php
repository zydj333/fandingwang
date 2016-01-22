<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_items_model
 *
 * @createtime 2015-3-10 12:58:51
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_items_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据产品ID获取子项
     * 
     * @param $pid 产品ID（product_id）
     * 
     * @return 返回一个二维对象 
     * 
     */
    public function getProductItemsList($pid) {
        $this->db->where(array('pid' => $pid));
        $this->db->order_by('price', 'asc');
        $query = $this->db->get('ai_product_items');
        return $query->result();
    }

    /**
     * 
     * @todo 保存产品子项
     * 
     * @param $data 要保存的数据
     * 
     * @retunrn 返回插入后的ID 
     * 
     */
    public function saveProductItemsData($data) {
        $this->db->insert('ai_product_items', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据ID获取产品子项详情
     * 
     * @param $id 要获取的数据ID
     * 
     * @return 返回一个对象 
     * 
     */
    public function getProductItemsById($pid, $id) {
        $this->db->where(array('pid' => $pid, 'id' => $id));
        $query = $this->db->get('ai_product_items');
        return $query->row();
    }

    /**
     * 
     * @todo 修改产品子项信息
     * 
     * @param $id 要修改的数据ID
     * 
     * @return 返回boolean类型的结果 
     * 
     */
    public function editProductItemsData($data, $id) {
        return $row = $this->db->update('ai_product_items', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 根据产品ID和子项ID删除项目子项。
     * 
     * @param $p_id 产品ID
     * 
     * @param $items_id 子项id
     * 
     * @return 返回boolean类型的结果 
     * 
     */
    public function delProductItemsById($p_id, $items_id) {
        return $this->db->delete('ai_product_items', array('id' => $items_id, 'pid' => $p_id));
    }

}

?>
