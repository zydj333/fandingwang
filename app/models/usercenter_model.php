<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usercenter_model
 *
 * @createtime 2015-4-7 23:54:57
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class usercenter_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据用户ID获取用户详细信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个对象 
     * 
     */
    public function getUserIdByUid($uid) {
        $this->db->where(array('id' => $uid));
        $query = $this->db->get('ai_member');
        return $query->row();
    }

    /**
     * 
     * @todo 获取我收藏的项目 
     * 
     * @param $uid 我的账户iD
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMyCollectList($uid) {
        $sql = 'SELECT a.pid,a.uid,b.id,b.title,b.title_salt,b.image_url,b.user_id,b.discription,b.addtime,b.amount,b.support_amount,b.support_times,b.starttime,b.endtime,b.days FROM `ai_product_collect` AS a LEFT JOIN `ai_product` AS b ON a.pid=b.id WHERE a.uid=' . $uid . '  and b.is_effect=1 and b.is_del=0 ORDER BY a.id DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 获取我参与的项目
     * 
     * @param int $uid 我的账户ID
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getMySupportProjectList($uid){
        $sql = 'SELECT a.pid,a.uid,a.order_num,a.total_amount,a.step_status,b.id,b.title,b.title_salt,b.image_url,b.user_id,b.discription,b.addtime,b.amount,b.support_amount,b.support_times,b.starttime,b.endtime,b.days FROM `ai_product_order` AS a LEFT JOIN `ai_product` AS b ON a.pid=b.id WHERE a.uid=' . $uid . '  and b.is_effect=1 and b.is_del=0 ORDER BY a.addtime DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 获取我发起的项目列表
     * 
     * @param int $uid 用户ID 
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getMyLaunchProjectList($uid){
        $sql = 'SELECT id,title,title_salt,image_url,user_id,discription,addtime,amount,support_amount,support_times,starttime,endtime,days FROM `ai_product` WHERE user_id=' . $uid . ' GROUP BY id ORDER BY id DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 发布我的状态 
     * 
     * @param $data 要保存的信息
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveMyFeed($data) {
        $this->db->insert('ai_member_feed', $data);
        return $this->db->insert_id();
    }

}

?>
