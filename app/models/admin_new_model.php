<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_new_model
 *
 * @createtime 2014-10-23 8:41:41
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_new_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo  获取新闻总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getNewCount($search) {
        $where = '';
        if (isset($search['title'])) {
            $where.=" and title like '%" . $search['title'] . "%'";
        }
        if (isset($search['search_name'])) {
            $where.=" and search_name= '" . $search['search_name'] . "'";
        }
        if (isset($search['type'])) {
            $where.=" and type= " . $search['type'];
        }
        $sql = "select id from ai_news where 1=1 " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * @todo 获取数据列表
     *
     * @param $search 查询条件
     *
     * @return 返回一个结果集
     *
     */
    public function getNewList($search) {
        $where = '';
        if (isset($search['title'])) {
            $where.=" and a.title like '%" . $search['title'] . "%'";
        }
        if (isset($search['search_name'])) {
            $where.=" and a.search_name= '" . $search['search_name'] . "'";
        }
        if (isset($search['type'])) {
            $where.=" and a.type= " . $search['type'];
        }
        $sql = "select a.*,b.title as typename from ai_news as a left join ai_newtype as b on a.type=b.id where 1=1 " . $where . " order by a.addtime desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 新增新闻信息
     *
     * @param $data 要保存的数据信息
     *
     * @return 返回一个int类型的结果
     *
     */
    public function saveNewData($data) {
        $this->db->insert('ai_news', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取新闻详情
     *
     * @param $id 要获取的数据ID
     *
     * @return 返回一个结果集
     *
     */
    public function getNewInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_news');
        return $query->row();
    }

    /**
     *
     * @todo 修改新闻信息
     *
     * @param $data 要修改成的数据
     *
     * @param $id 要修改的新闻ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function editNewData($data, $id) {
        return $row = $this->db->update('ai_news', $data, array('id' => $id));
    }

    /**
     *
     * @todo 删除新闻信息
     *
     * @param $id 要删除的新闻ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delNewById($id) {
        return $this->db->delete('ai_news', array('id' => $id));
    }

}

?>
