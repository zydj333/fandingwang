<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_launch_model
 *
 * @createtime 2015-6-5 16:45:09
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_launch_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_launch_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取项目申请总条数 
     * 
     * @param $search 查询条件
     * 
     * @return int 返回一个整数
     * 
     */
    public function getLaunchCount($search) {
        $where = '';
        if (isset($search['status'])) {
            $where .= ' and status=' . $search['status'];
        }
        if (isset($search['username'])) {
            $where .= ' and username="' . $search['username'] . '"';
        }
        if (isset($search['celphone'])) {
            $where .= ' and celphone="' . $search['celphone'] . '"';
        }
        if (isset($search['project_name'])) {
            $where .= ' and project_name="' . $search['project_name'] . '"';
        }
        $sql = 'select id from ai_product_launch where 1=1 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据ID获取项目申请列表
     * 
     * @param $search 查询条件
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getLaunchList($search) {
        $where = '';
        if (isset($search['status'])) {
            $where .= ' and status=' . $search['status'];
        }
        if (isset($search['username'])) {
            $where .= ' and username="' . $search['username'] . '"';
        }
        if (isset($search['celphone'])) {
            $where .= ' and celphone="' . $search['celphone'] . '"';
        }
        if (isset($search['project_name'])) {
            $where .= ' and project_name="' . $search['project_name'] . '"';
        }
        $sql = 'select * from ai_product_launch where 1=1 ' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取项目详情 
     * 
     * @param $id 项目ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getLaunchDetial($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_product_launch');
        return $query->row();
    }

    /**
     * 
     * @todo 修改项目信息 
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 要修改的数据ID
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function editLaunch($data, $id) {
        return $this->db->update('ai_product_launch', $data, array('id' => $id));
    }

}
