<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order_model
 *
 * @createtime 2015-4-10 15:18:36
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class order_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据产品ID和子项ID获取子项信息
     * 
     * @param $pid 产品ID
     * 
     * @param $items_id 子项ID
     * 
     * @return 返回一个结果集  
     * 
     */
    public function getProductItemsById($pid, $items_id) {
        $this->db->where(array('pid' => $pid, 'id' => $items_id));
        $query = $this->db->get('ai_product_items');
        return $query->row();
    }

    /**
     * 
     * @todo 保存订单信息
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回一个int类型的整数
     *  
     */
    public function saveOrderAdd($data) {
        return $this->db->insert('ai_product_order', $data);
    }

    /**
     * 
     * @todo 根据订单ID获取订单信息 
     * 
     * @param $ordernum 订单编号
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getOrderInfoByOrderNum($ordernum, $user_id) {
        $this->db->where(array('order_num' => $ordernum, 'uid' => $user_id));
        $query = $this->db->get('ai_product_order');
        return $query->row();
    }
    
     /**
     * 
     * @todo 根据订单ID获取订单信息 
     * 
     * @param $ordernum 订单编号
     * 
     * @return 返回一个结果集
     * 
     */
    public function getOrderInfoByOrderNumForPay($ordernum) {
        $this->db->where(array('order_num' => $ordernum));
        $query = $this->db->get('ai_product_order');
        return $query->row();
    }

    /**
     * 
     * @todo 保存对订单的修改
     * 
     * @param $data 要修改的数据
     * 
     * @param $param 修改条件 
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function saveOrderEdit($data, $param) {
        return $this->db->update('ai_product_order', $data, array('order_num' => $param['order_num'], 'pid' => $param['pid'], 'items_id' => $param['items_id'], 'uid' => $param['user_id'], 'step_status' => 0));
    }

    /**
     * 
     * @todo 修改订单的状态 
     * 
     * @param $要修改的状态信息
     * 
     * @param 被修改的订单号
     * 
     * @return 返回一个boolean类型的整数
     * 
     */
    public function editOrderStatus($data, $order_num) {
        return $this->db->update('ai_product_order', $data, array('order_num' => $order_num));
    }

    /**
     * 
     * @todo 修改项目子项的售出总数
     * 
     * @param $pid 产品ID
     * 
     * @param $items_id 项目子项ID
     * 
     * @param int $buy_number 购买数量
     * 
     * @return 返回一个真假类型的结果 
     * 
     */
    public function editProduceItemsSellTotal($pid, $items_id,$buy_number=1) {
        $sql = 'update ai_product_items set sell_total=sell_total+'.$buy_number.' where id=' . $items_id . ' and pid=' . $pid;
        return $this->db->query($sql);
    }

    /**
     * 
     * 
     * @todo 修改产品相应信息
     * 
     * @param $pid 项目ID
     * 
     * @param $amount 总金额
     * 
     * @param int $buy_number 购买数量
     * 
     * @return 返回真假类型的结果 
     * 
     */
    public function editProductSupport($pid, $amount,$buy_number=1) {
        $sql = 'update ai_product set support_times=support_times+'.$buy_number.',support_amount=support_amount+' . $amount . ' where id=' . $pid;
        return $this->db->query($sql);
    }
    
       /**
     * 
     * @todo 获取我的地址列表
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMyAddressList($user_id) {
        $this->db->where(array('uid' => $user_id));
        $query = $this->db->get('ai_member_address');
        return $query->result();
    }
    
    /**
     * 
     * @todo 获取一条地址信息 
     * 
     * @param $id 地址ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getAddressInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=  $this->db->get('ai_member_address');
        return $query->row();
    }

}

?>
