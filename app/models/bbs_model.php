<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bbs_model
 *
 * @createtime 2015-4-18 14:57:08
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class bbs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取帖子总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getBbsCount($search) {
        $where = '';
        if (isset($search['cream'])) {
            $where = ' and cream=1';
        }
        if (isset($search['hot'])) {
            $where = ' and hot=1';
        }
        $sql = 'select id from `bbs_topic` where is_del=0 and is_top=0 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取帖子列表
     * 
     * @param array $search 查询条件
     * 
     * @return object 返回一个结果集对象 
     * 
     */
    public function getBbsList($search) {
        $where = '';
        if (isset($search['cream'])) {
            $where = ' and a.cream=1';
        }
        if (isset($search['hot'])) {
            $where = ' and a.hot=1';
        }
        $sql = 'select a.id,a.title,a.content,a.views,a.reply,a.imageurl,a.addtime,a.uid,b.account,b.avatar from bbs_topic as a left join ai_member as b on a.uid=b.id where a.is_del=0 and is_top=0 ' . $where . ' order by addtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取各类型的置顶帖
     * 
     * @param array $search 查询条件 
     * 
     * @return 返回一个结果集
     * 
     */
    public function getBbsTopList($search) {
        $where = '';
        if (isset($search['cream'])) {
            $where = ' and a.cream=1';
        }
        if (isset($search['hot'])) {
            $where = ' and a.hot=1';
        }
        $sql = 'select a.id,a.title,a.content,a.views,a.reply,a.imageurl,a.addtime,a.uid,b.account,b.avatar from bbs_topic as a left join ai_member as b on a.uid=b.id where a.is_del=0  and is_top=1 ' . $where . ' order by addtime desc limit 3';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取话题详情
     * 
     * @param $t_id 话题ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getTopicDetial($t_id) {
        //$this->db->where(array('id' => $t_id, 'is_del' => 0));
        $sql = 'select a.*,b.account,b.avatar from bbs_topic as a left join ai_member as b on a.uid=b.id where a.is_del=0 and a.id=' . $t_id;
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 
     * @todo 获取话题回复 
     * 
     * @param int $t_id 话题ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getTopicRepay($t_id) {
        $sql = 'select a.*,b.account,b.avatar from bbs_reply as a left join ai_member as b on a.uid=b.id where a.tid=' . $t_id . ' and a.tofloor=0 order by a.id asc';
        $query = $this->db->query($sql);
        $repay = $query->result();
        if (!empty($repay)) {
            foreach ($repay as $k => $v) {
                $sql_son = 'select a.*,b.account,b.avatar from bbs_reply  as a left join ai_member as b on a.uid=b.id where a.tid=' . $t_id . ' and a.tofloor=' . $v->id . ' order by a.id asc';
                $query_son = $this->db->query($sql_son);
                $repay[$k]->son = $query_son->result();
            }
        }
        return $repay;
    }

    /**
     * 
     * @todo 检查回复是否已经存在 
     * 
     * @param  array $data 查询条件
     * 
     * @return boolean 返回真假类型的结果
     * 
     */
    public function checkRepayRepeat($data) {
        $this->db->where(array('tid' => $data['tid'], 'uid' => $data['uid'], 'tofloor' => $data['tofloor'], 'content' => $data['content'], 'addip' => $data['addip']));
        $query = $this->db->get('bbs_reply');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取话题的楼层数目
     * 
     * @param int $t_id 话题ID
     * 
     * @return int 返回一个int类型的整数 
     * 
     */
    public function getFoolerCount($t_id) {
        $sql = 'select * from bbs_reply where tid=' . $t_id . ' and is_del=0 and tofloor=0';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     *  @todo 保存回复信息
     * 
     * @param array $data 要保存的数据
     * 
     * @return int 返回一个插入的ID
     * 
     */
    public function saveRepayData($data) {
        $this->db->insert('bbs_reply', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 修改话题的浏览次数 
     * 
     * @param int $t_id 话题ID
     * 
     * @return boolean 返回一个真假类型的结果
     * 
     */
    public function editTopicViews($t_id){
        $sql = 'update bbs_topic set views=views+1 where id=' . $t_id;
        return $this->db->query($sql);
    }
    
    /**
     * 
     * @todo 修改话题的回复数 
     * 
     * @param int $t_id 话题ID
     * 
     * @return boolean 返回一个真假类型的结果
     * 
     */
    public function editTopicRepays($t_id){
        $sql = 'update bbs_topic set reply=reply+1 where id=' . $t_id;
        return $this->db->query($sql);
    }
    
    
    /**
     * 
     * @todo 检查发的帖子是否已经存在
     * 
     * @param array $data 要检查的数据
     * 
     * @return boolean 返回一个真假类型的结果 
     * 
     */
    public function checkTopicHasDefind($data){
        $this->db->where(array('title'=>$data['title'],'uid'=>$data['title']));
        $query=  $this->db->get('bbs_topic');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    
    /**
     * 
     * @todo 保存帖子信息
     * 
     * @param array $data 要保存的数据
     * 
     * @return boolean 返回真假类型的结果 
     * 
     */
    public function saveTopicData($data){
        $this->db->insert('bbs_topic', $data);
        return $this->db->insert_id();
    }

}

?>
