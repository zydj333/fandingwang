<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shequ_model
 *
 * @createtime 2015-4-8 17:22:33
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class shequ_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据查询条件获取分享总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getArticleCount($search) {
        $where = ' 1=1';
        if (isset($search['type'])) {
            $where = ' type=' . $search['type'];
        }
        $sql = 'select id from ai_news where' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据查询条件获取分享列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getArticleList($search) {
        $where = ' 1=1';
        if (isset($search['type'])) {
            $where = ' type=' . $search['type'];
        }
        $sql = 'select id,title,imageurl,discription,views,replay,salt,addtime from ai_news where' . $where . ' order by addtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取资讯详情
     * 
     * @param $news_id 资讯ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getArticleDetial($news_id) {
        $this->db->where(array('id' => $news_id));
        $query = $this->db->get('ai_news');
        return $query->row();
    }

    /**
     * 
     * 
     * @todo 根据ID获取新闻的查看次数
     * 
     * @param $news_id 新闻ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editArticleViews($news_id) {
        $sql = 'update ai_news set views=views+1 where id=' . $news_id;
        return $this->db->query($sql);
    }

    /**
     * 
     * @todo 根据新闻ID获取新闻的评论列表
     * 
     * @param $news_id 资讯ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getArticleRepayList($news_id) {
        $sql = 'select a.*,b.account,b.avatar from ai_news_repay as a left join ai_member as b on a.uid=b.id where a.news_id=' . $news_id.' and a.to_id=0';
        $query = $this->db->query($sql);
        $list = $query->result();
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $sql_son = 'select a.*,b.account,b.avatar from ai_news_repay as a left join ai_member as b on a.uid=b.id where a.to_id=' . $value->id;
                $query_son = $this->db->query($sql_son);
                $list[$key]->son = $query_son->result();
            }
        }
        return $list;
    }

    
    /**
     * 
     * @todo 检查新闻回复是否重复 
     * 
     * @param $data 查询数据
     * 
     * @return 返回真假类型
     * 
     */
    public function checkArticleRepayDefind($data){
        $this->db->where(array('news_id'=>$data['news_id'],'uid'=>$data['uid'],'content'=>$data['content'],'addip'=>$data['addip'],'to_id'=>$data['to_id']));
        $query=$this->db->get('ai_news_repay');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    
    /**
     * 
     * @todo 保存新闻回复信息 
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的参数
     * 
     */
    public function saveArticleRepay($data){
        $this->db->insert('ai_news_repay', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 根据新闻ID修改新闻的回复数目
     * 
     * @param $news_id 新闻ID
     * 
     * @return 返回一个boolean类型的整数 
     * 
     */
    public function editArticleRepayCount($news_id){
        $sql = 'update ai_news set replay=replay+1 where id=' . $news_id;
        return $this->db->query($sql);
    }
    
    
    /*********************活动*******************/
    
    
    /**
     * 
     * @todo 根据条件获取活动总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function getActivityCount($search){
        $where='';
        $sql='select id from ai_activity where is_del=0'.$where;
        $query=  $this->db->query($sql);
        return $query->num_rows();
    }
    
    
    
    /**
     * 
     * @todo 根据条件获取活动列表
     * 
     * @param $search 查询条件
     * 
     * @return 放回一个结果集
     * 
     */
    public function getActivityList($search){
        $where='';
        $sql='select id,title,addtime,imageurl,discription,views,enlists,salt from ai_activity where is_del=0'.$where.' order by addtime desc limit '.$search['start'].','.$search['pagesize'];
        $query=  $this->db->query($sql);
        return $query->result();
    }
    
    
    
    /**
     * 
     * @todo 根据活动ID获取活动详情
     * 
     * @param int $a_id 活动ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getActivityDetial($a_id){
        $this->db->where(array('id'=>$a_id,'is_del'=>0));
        $query=  $this->db->get('ai_activity');
        return $query->row();
    }
    
    /**
     * 
     * @todo 根据活动ID获取活动详情
     * 
     * @param int $a_id 活动ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getNewsDetial($a_id){
        $this->db->where(array('id'=>$a_id));
        $query=  $this->db->get('ai_news');
        return $query->row();
    }
    
    
    /**
     * 
     * @todo 修改活动浏览次数
     * 
     * @param int $a_id 活动ID 
     * 
     * @return boolean 返回真假类的结果
     * 
     */
    public function editActivityViews($a_id){
        $sql = 'update ai_activity set views=views+1 where id=' . $a_id;
        return $this->db->query($sql);
    }
}

?>
