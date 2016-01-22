<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of launch_model
 *
 * @createtime 2015-4-9 9:24:28
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class launch_model extends CI_Model {
//put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     *
     * @todo 获取项目分类列表
     *
     * @return 返回一个结果集
     *
     */
    public function getProjectTypeList(){
        $this->db->order_by('salt');
        $query=$this->db->get('ai_projecttype');
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 添加产品信息 
     * 
     * @param $data 要添加的数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function addProduct($data){
        $this->db->insert('ai_product_temp', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 检查项目和用户是否符合 
     * 
     * @param $user_id 用户ID
     * 
     * @param $pid 产品ID
     * 
     * @return 返回结果集
     * 
     */
    public function checkUserProduct($user_id,$pid){
        $this->db->where(array('id'=>$pid,'uid'=>$user_id,'is_submit'=>0));
        $query=$this->db->get('ai_product_temp');
        return $query->row();
    }
    
    
    /**
     * 
     * @todo 保存第一步的修改
     * 
     * @param array $data 要保存的数据
     * 
     * @param int $p_id 要修改的数据ID
     * 
     * @return boolean 返回一个真假类型的结果 
     * 
     */
    public function editProduct($data,$p_id){
        return $this->db->update('ai_product_temp', $data, array('id' => $p_id));
    }
    
    /**
     * 
     * @todo 检查用户提交的数据是否已经存在 
     * 
     * @param $data 要检查的数据
     * 
     * @return 返回一个真假类型的结果
     * 
     */
    public function checkProductIsDefind($data){
        $this->db->where(array('uid'=>$data['uid'],'title'=>$data['title']));
        $query=$this->db->get('ai_product_temp');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    
    /**
     * 
     * @todo 获取项目动态 
     * 
     * @param int $p_id 产品ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProductFeedList($p_id){
        $this->db->where(array('pid'=>$p_id));
        $this->db->order_by('addtime','desc');
        $query=$this->db->get('ai_product_temp_feed');
        return $query->result();
    }
    
    
    /**
     *  
     * @todo 保存项目的动态信息
     * 
     * @param array $data 要保存的数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function addProductFeed($data){
        $this->db->insert('ai_product_temp_feed', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 获取项目子项列表
     * 
     * @param int $p_id 产品ID
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getProductItemsList($p_id){
        $this->db->where(array('pid'=>$p_id));
        $this->db->order_by('price','asc');
        $query=$this->db->get('ai_product_temp_items');
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 保存项目子项信息
     * 
     * @param array $data 要保存的数据
     * 
     * @return int 返回一个int类型的整数
     * 
     */
    public function saveProductItemsData($data){
        $this->db->insert('ai_product_temp_items', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 保存产品信息到正式项目列表
     * 
     * @param array $data 要保存的数据  
     * 
     * @return int 返回一个 int类型的整数
     * 
     */
    public function saveMyProjectToSystem($data){
        $this->db->insert('ai_product', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 保存产品的动态信息到正式列表
     * 
     * @param array $data 要保存的数据
     * 
     * @return int 返回一个整数 
     * 
     */
    public function saveMyProjectFeedToSystem($data){
        $this->db->insert('ai_product_feed', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 保存产品的购买子项信息到正式列表
     * 
     * @param array $data 要保存的数据 
     * 
     * @return int 返回一个int类型的整数
     * 
     */
    public function saveMyprojectItemsToSystem($data){
        $this->db->insert('ai_product_items', $data);
        return $this->db->insert_id();
    }
}

?>
