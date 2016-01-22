<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_project_introduce_model
 *
 * @createtime 2014-10-25 10:10:16
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_project_introduce_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 根据项目ID获取信息
     *
     * @param $pid 项目ID
     *
     * @return 返回一个结果集
     *
     */
    public function getProjectIntroduceByPid($pid) {
        $this->db->where(array('pid' => $pid));
        $query = $this->db->get('ai_project_introduce');
        return $query->row();
    }

    /**
     *
     * @todo 保存项目介绍
     *
     * @param $data 要保存的数据
     *
     * @return 返回int类型的整数
     *
     */
    public function saveProjectIntroduce($data) {
        $this->db->insert('ai_project_introduce', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据项目ID修改项目介绍信息
     *
     * @param $data 要修改成的数据
     *
     * @param $pid 被修改的项目ID
     *
     * @return 返回布尔类型的结果
     *
     */
    public function editProjectIntroduce($data,$id){
         return $this->db->update('ai_project_introduce', $data, array('pid' => $id));
    }

}

?>
