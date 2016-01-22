<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_seting_model
 *
 * @createtime 2014-10-21 10:05:21
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_system_model extends CI_Model {
//put your code here
    //put your code here
    public function  __construct() {
        parent::__construct();
    }


      /**
     *
     * @todo 根据父级获取所有开发栏目列表
     *
     * @param $parent_id 父级栏目ID
     *
     * @param $is_del  真假类型  真为需要状态参数
     *
     * @param $nums 查询条件
     *
     * @return 返回一个二维数组
     *
     */
    public function getSystemListByParentId($parent_id, $is_del=false, $nums='') {
        $where = '';
        if ($is_del) {
            $where.=' and is_del=0';
        }
        if ($nums != '') {
            $where.=' and id in(' . $nums . ')';
        }
        $sql = "select * from ai_system where parent_id=" . $parent_id .$where. " order by sult asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    

    /**
     *
     * @todo 获取分类列表
     *
     * @param $pid 父级ID
     *
     * @return 返回一个二维结果集
     *
     */
    public function getAdminSetingList($pid=0){
        $this->db->where(array('parent_id'=>$pid));
        $this->db->order_by('sult');
        $result=$this->db->get('ai_system');
        return $result->result();
    }

    /**
     *
     * @todo 根据ID获取分类信息
     *
     * @param $id 分类ID
     *
     * @return 返回一个一维结果
     *
     */
    public function getAdminSetingInfoById($id){
        $this->db->where(array('id'=>$id));
        $result=$this->db->get('ai_system');
        return $result->row();
    }

     /**
     *
     * @todo 保存添加数据
     *
     * @param $data 要添加的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveSystemData($data) {
        return $this->db->insert('ai_system', $data);
    }

    /**
     *
     * @todo 保存修改操作
     *
     * @param $data 要修改的数据
     *
     * @param $id 要修改的条目ID
     *
     * @return 返回受到影响的行数
     *
     */
    public function editSystemData($data, $id) {
        return $row = $this->db->update('ai_system', $data, array('id' => $id));
    }

    /**
     *
     * @todo 删除数据
     *
     * @param $id 要删除数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function delSystemById($id){
         return $this->db->delete('ai_system', array('id' => $id));
    }


    /**
     *
     * @todo 执行sql语句
     *
     * @param $sql 要执行sql语句
     *
     * @return 返回对象
     *
     */
    public function excuteSql($sql){
        return $this->db->query($sql);
    }
}
?>
