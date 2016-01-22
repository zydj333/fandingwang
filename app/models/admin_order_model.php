<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_order_model
 *
 * @createtime 2015-4-30 10:06:05
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_order_model extends CI_Model {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取订单总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getOrderCount($search) {
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
        if (isset($search['pname'])) {
            $where.=' and pname like "%' . $search['pname'] . '%"';
        }
        if (isset($search['step_status'])) {
            $where.=' and step_status=' . $search['step_status'];
        }
        if (isset($search['type'])) {
            $where.=' and type=' . $search['type'];
        }
        $sql = 'select id from ai_product_order where order_num!=""' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取订单列表
     * 
     * @param int $search 查询条件
     * 
     * @return object  返回一个结果集 
     * 
     */
    public function getOrderList($search) {
        $where = '';
        if (isset($search['order_num'])) {
            $where.=' and a.order_num="' . $search['order_num'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and a.username="' . $search['username'] . '"';
        }
        if (isset($search['cellphone'])) {
            $where.=' and a.cellphone="' . $search['cellphone'] . '"';
        }
        if (isset($search['pname'])) {
            $where.=' and a.pname like "%' . $search['pname'] . '%"';
        }
        if (isset($search['step_status'])) {
            $where.=' and a.step_status=' . $search['step_status'];
        }
        if (isset($search['type'])) {
            $where.=' and a.type=' . $search['type'];
        }
        $sql = 'select a.*,b.email from ai_product_order as a left join ai_member as b on a.uid=b.id where a.order_num!=""' . $where . ' order by a.id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据订单编号获取订单详情
     * 
     * @param int $order_num 订单表编号 
     * 
     * @return 返回一个object 结果集
     * 
     */
    public function getOrderInfoByOrderNum($order_num) {
        $this->db->where(array('order_num' => $order_num));
        $query = $this->db->get('ai_product_order');
        return $query->row();
    }

    /**
     * 
     * @todo 修改订单信息 
     * 
     * @param array $data 要修改的数据
     * 
     * @param int 要修改的订单编号
     * 
     */
    public function editProjectOrder($data, $num) {
        return $this->db->update('ai_product_order', $data, array('order_num' => $num));
    }

    /**
     * 
     * @todo 获取项目列表 
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectList() {
        $time = time();
        $sql = 'select id,title from ai_product where is_effect=1 and is_del=0 and starttime<' . $time . ' and endtime>' . $time . ' order by id desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取项目子项
     * 
     * @param $pid 项目ID
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getProjectItemsList($pid) {
        $sql = 'select * from ai_product_items where pid=' . $pid . ' order by price asc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据项目ID获取项目详情 
     * 
     * @param int $pid 项目ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectInfoByPid($pid) {
        $this->db->where(array('id' => $pid));
        $query = $this->db->get('ai_product');
        return $query->row();
    }

    /**
     * 
     * @todo 根据项目ID和项目子项ID获取项目子项详情
     * 
     * @param int $pid 项目ID
     * 
     * @param int $items_id 项目子项ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectItemsInfoByPid($pid, $items_id) {
        $this->db->where(array('id' => $items_id, 'pid' => $pid));
        $query = $this->db->get('ai_product_items');
        return $query->row();
    }

    /**
     * 
     * @todo 保存订单信息
     * 
     * @param array 要保存的数据信息
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function saveProjectOrder($data) {
        return $this->db->insert('ai_product_order', $data);
    }

    /**
     * 
     * @todo 修改项目子项信息
     * 
     * @param int $items_id 项目子项ID 
     * 
     * @param array $data 要修改的数据
     * 
     * @return blooean 返回一个boolean类型的结果
     * 
     */
    public function editProductItemsById($items_id, $data) {
        return $this->db->update('ai_product_items', $data, array('id' => $items_id));
    }

    /**
     * 
     * @todo 修改项目信息
     * 
     * @param int $pid 项目ID 
     * 
     * @param array $data 要修改的数据信息
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductByPid($pid, $data) {
        return $this->db->update('ai_product', $data, array('id' => $pid));
    }

    /**
     * 
     * @todo 获取用户邮箱 
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getUserEmail($u_id) {
        $sql = 'select email from `ai_member` where id=' . $u_id;
        $query = $this->db->query($sql);
        return $query->row();
    }

}

?>
