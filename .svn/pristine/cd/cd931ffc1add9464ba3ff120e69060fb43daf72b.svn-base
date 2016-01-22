<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_invest_model
 *
 * @createtime 2015-4-16 15:05:35
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_invest_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取产品的购买总条数
     * 
     * @param  $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getProductInvestCount($search) {
        $where = '';
        if (isset($search['order_num'])) {
            $where.=' and order_num="' . $search['order_num'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['cellphone'])) {
            $where.=' and cellphone="' . $search['cellphone'] . '"';
        }
        if (isset($search['step_status'])) {
            $where.=' and step_status=' . $search['step_status'];
        }
        $sql = 'select id from ai_product_order where pid=' . $search['pid'] . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据查询条件获取产品的购买记录列表
     *  
     * @param $search 查询条件
     * 
     * @return 返回一个结果集
     * 
     */
    public function getProductInvestList($search) {
        $where = '';
        if (isset($search['order_num'])) {
            $where.=' and order_num="' . $search['order_num'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['cellphone'])) {
            $where.=' and cellphone="' . $search['cellphone'] . '"';
        }
        if (isset($search['step_status'])) {
            $where.=' and step_status=' . $search['step_status'];
        }
        $sql = 'select id,order_num,pid,pname,total_amount,step_status,username,cellphone,addtime from ai_product_order where pid=' . $search['pid'] . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 根据ID获取产品订单详情
     * 
     * @param $id 订单自增ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getOrderDetial($id){
        $this->db->where(array('id'=>$id));
        $query=  $this->db->get('ai_product_order');
        return $query->row();
    }

}

?>
