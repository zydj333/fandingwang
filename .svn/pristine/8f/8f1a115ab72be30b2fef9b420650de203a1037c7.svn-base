<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_replay_model
 *
 * @createtime 2015-3-12 10:15:37
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_replay_model extends CI_Model {
//put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @todo 获取产品评论列表 
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个二维对象
     * 
     */
    public function getProductReplayList($pid){
        $this->db->where(array('pid'=>$pid));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('ai_product_replay');
        return $query->result();
    }
    
    /**
     * 
     * @todo  插入产品信息
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回一个int类型的整数
     * 
     */
    public function addProductReplayData($data){
        $this->db->insert('ai_product_replay', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 根据ID产品id和评论iD获取评论详情
     * 
     * @param $pid 产品ID
     * 
     * @param $id 评论ID
     * 
     * @return 返回一个对象
     * 
     */
    public function getProductReplayById($pid,$id){
        $this->db->where(array('pid'=>$pid,'id'=>$id));
        $query=$this->db->get('ai_product_replay');
        return $query->row();
    }
    
    
    /**
     * 
     * @todo 修改产品评论信息
     * 
     * @param $id 评论ID
     * 
     * @param $data  要修改的数据
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function editProductReplayData($data,$id){
        return $this->db->update('ai_product_replay', $data, array('id' => $id));
    }
}

?>
