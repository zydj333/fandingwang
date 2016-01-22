<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_tender_model
 *
 * @createtime 2015-4-14 15:42:51
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_tender_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取产品动态列表 
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getTenderList($pid) {
        $this->db->where(array('pid' => $pid));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ai_product_feed');
        return $query->result();
    }

    /**
     * 
     * @todo 保存产品的动态信息
     * 
     * @param $data 要保存的数据
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function saveTenderAdd($data) {
        $this->db->insert('ai_product_feed', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 修改产品动态条数
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function plusProductTenderCount($pid) {
        $this->db->where(array('id' => $pid));
        $query = $this->db->get('ai_product');
        $pro = $query->row();
        $num = $pro->product_loading + 1;
        $sql = 'update `ai_product` set `product_loading`=' . $num . ' where `id`=' . $pid;
        return $this->db->query($sql);
    }

    /**
     * 
     * @todo 修改产品动态条数
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function minutProductTenderCount($pid) {
        $this->db->where(array('id' => $pid));
        $query = $this->db->get('ai_product');
        $pro = $query->row();
        $num = $pro->product_loading - 1;
        $sql = 'update `ai_product` set `product_loading`=' . $num . ' where `id`=' . $pid;
        return $this->db->query($sql);
    }

    /**
     * 
     * @todo 删除动态
     * 
     * @param $pid 产品ID
     * 
     * @param $tid 动态ID
     * 
     * @return  返回一个真假类型的结果 
     * 
     */
    public function delTenderByPid($pid, $tid) {
        return $this->db->delete('ai_product_feed', array('id' => $tid, 'pid' => $pid));
    }

    /**
     * 
     * @todo 根据项目ID和动态ID获取动态信息
     * 
     * @param $pid 产品ID
     * 
     * @param $tid 动态ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getTenderInfoByID($pid, $tid) {
        $this->db->where(array('id' => $tid, 'pid' => $pid));
        $query = $this->db->get('ai_product_feed');
        return $query->row();
    }

    /**
     * 
     * @todo 修改项目ID 
     * 
     * @param $data 要保存的数据
     * 
     * @paran $id 要修改的动态ID
     * 
     * @return  返回真假类型的结果
     * 
     */
    public function saveTenderEdit($data, $id) {
        return $row = $this->db->update('ai_product_feed', $data, array('id' => $id));
    }

}

?>
