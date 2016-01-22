<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_charging_model
 *
 * @createtime 2014-11-10 10:47:07
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_charging_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 根据条件获取充值信息的总条数
     *
     * @param $search 查询条件
     *
     * @return 返回一个int类型的整数
     *
     */
    public function getChargingCount($search) {
        $where = '';
        if (isset($search['pay_type'])) {
            $where.=' and pay_type="' . $search['pay_type'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        if (isset($search['uid'])) {
            $where.=' and uid=' . $search['uid'];
        }
        if (isset($search['uname'])) {
            $where.=' and uname="' . $search['uname'] . '"';
        }
        if (isset($search['charging_ns'])) {
            $where.=' and charging_ns="' . $search['charging_ns'] . '"';
        }
        $sql = 'select id from ai_charging where 1=1 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 根据条件获取充值信息列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个结果集
     *
     */
    public function getChargingList($search) {
        $where = '';
        if (isset($search['pay_type'])) {
            $where.=' and pay_type="' . $search['pay_type'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        if (isset($search['uid'])) {
            $where.=' and uid=' . $search['uid'];
        }
        if (isset($search['uname'])) {
            $where.=' and uname="' . $search['uname'] . '"';
        }
        if (isset($search['charging_ns'])) {
            $where.=' and charging_ns="' . $search['charging_ns'] . '"';
        }
        $sql = 'select * from ai_charging where 1=1 ' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 根据ID获取充值详情
     *
     * @param $id 根据ID获取充值信息详情
     *
     * @return 翻译一个对象
     * 
     */
    public function getChargingInfoById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_charging');
        return $query->row();
    }

    /**
     *
     * @todo 修改充值状态信息
     *
     * @param $data 要变动信息
     *
     * @param $id 要操作的记录ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editChargingById($data, $id) {
        return $this->db->update('ai_charging', $data, array('id' => $id));
    }

}

?>
