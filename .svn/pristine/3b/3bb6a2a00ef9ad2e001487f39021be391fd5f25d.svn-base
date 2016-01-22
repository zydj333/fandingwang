<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_project_model
 *
 * @createtime 2014-10-24 14:16:03
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_project_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取项目总条数
     *
     * @param $search 查询条件
     *
     * @return 返回一个整数
     *
     */
    public function getProjectCount($search) {
        $where = '';
        if(isset ($search['is_del'])){
            $where.=' AND is_del='.$search['is_del'];
        }
        if(isset ($search['project_name'])){
            $where.=' AND project_name like "%'.$search['project_name'].'%"';
        }
        if(isset ($search['project_type'])){
             $where.=' AND project_type='.$search['project_type'];
        }
        if(isset ($search['is_success'])){
            $where.=' AND is_success='.$search['is_success'];
        }
        if(isset ($search['is_effect'])){
            $where.=' AND is_effect='.$search['is_effect'];
        }
        $sql = 'select * from ai_project where 1=1 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 获取项目列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个结果集
     *
     */
    public function getProjectList($search) {
        $where = '';
        if(isset ($search['is_del'])){
            $where.=' AND is_del='.$search['is_del'];
        }
        if(isset ($search['project_name'])){
            $where.=' AND project_name like "%'.$search['project_name'].'%"';
        }
        if(isset ($search['project_type'])){
             $where.=' AND project_type='.$search['project_type'];
        }
        if(isset ($search['is_success'])){
            $where.=' AND is_success='.$search['is_success'];
        }
        if(isset ($search['is_effect'])){
            $where.=' AND is_effect='.$search['is_effect'];
        }
        $sql = 'select * from ai_project where 1=1 '.$where.' order by salt asc Limit '.$search['start'].','.$search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存数据
     *
     * @param $data 要保存的数据
     *
     * @return  返回一个整数ID
     *
     */
    public function saveProjectData($data) {
        $this->db->insert('ai_project', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取项目信息
     *
     * @param $id 要获取的项目ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getProjectInfoById($id) {
        $sql = "SELECT * FROM ai_project WHERE id=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    /**
     *
     * @todo 根据ID保存修改
     *
     * @param $id 项目ID
     *
     * @param $data 要保存的数据
     *
     * @return  返回一个真假类型的结果
     *
     *
     */
    public function saveProjectEdit($id, $data) {
        return $row = $this->db->update('ai_project', $data, array('id' => $id));
    }

}

?>
