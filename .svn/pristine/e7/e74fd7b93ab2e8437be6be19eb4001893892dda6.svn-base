<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index_model
 *
 * @createtime 2014-10-30 10:02:57
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Index_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 获取广告列表
     *
     * @param $type 广告分类
     *
     *  'banner' => "首页BANNER",
     *  'news_banner' => "咨询广告",
     *  'activity' => "活动广告",
     *  'projects' => "项目广告",
     *  'bbs' => "社区广告",
     *
     * @param $limit 查询的条数，偏移量
     *
     * @return 返回一个二维结果集
     *
     */
    public function getBannerList($type = "banner", $limit = 4) {
        $this->db->where(array('type' => $type));
        $this->db->order_by('sult');
        $this->db->limit($limit);
        $query = $this->db->get('ai_banner');
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 获取项目列表 
     * 
     */
    public function getProdectList(){
        $sql='select a.id,a.title,a.title_salt,a.image_url,a.user_id,a.discription,a.addtime,a.amount,a.support_amount,a.support_times,a.starttime,a.endtime,a.days,b.username,b.account '
                . 'from ai_product as a left join ai_member as b on a.user_id=b.id where a.is_effect=1 and a.is_del=0 order by a.salt desc,a.id desc limit 5';
        $query=  $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 获取社区最新帖子 
     * 
     * @param int $count 查询条数
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getTopicList($count){
        //$sql = 'select a.id,a.title,a.content,a.views,a.reply,a.imageurl,a.addtime,a.uid,b.account,b.avatar from bbs_topic as a left join ai_member as b on a.uid=b.id where a.is_del=0 order by addtime desc limit '.$count;
        $sql = 'select * from ai_news order by addtime desc limit '.$count;
        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>
