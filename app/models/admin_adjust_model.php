<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_adjust_model
 *
 * @createtime 2014-11-27 14:08:19
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_adjust_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 根据条件获取资金调整记录总条数
     *
     * @param $search 查询条件
     *
     * @return 返回一个int类型的整数
     * 
     */
    public function getAdjustCount($search) {
        $where = 'type="adjust"';
        if (isset($search['account'])) {
            $where.=' and uname="' . $search['account'] . '"';
        }
        $sql = 'select id from ai_account_log where ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 根据条件获取资金调整列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个对象列表
     *
     */
    public function getAdjustList($search) {
        $where = 'type="adjust"';
        if (isset($search['account'])) {
            $where.=' and uname="' . $search['account'] . '"';
        }
        $sql = 'select * from ai_account_log where ' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 根据用户名称获取用户信息
     *
     * @param $account 用户账户
     *
     * @return 返回一个对象
     *
     */
    public function getMemberInfoByAccount($account) {
        $sql = 'select id,account,username,usable_money,freeze_money,invest_amount from ai_member where account=?';
        $query = $this->db->query($sql, array($account));
        return $query->row();
    }

}

?>
