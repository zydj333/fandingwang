<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_model
 *
 * @createtime 2015-2-25 15:01:29
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_product_model extends CI_Model {
//put your code here
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * 
     * @todo 根据条件查询产品总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getProductCount($search){
        $where='';
        if(isset($search['is_del'])){
            $where.=' and is_del='.$search['is_del'];
        }
        if(isset($search['product_name'])){
            $where.=' and title like "%'.$search['product_name'].'%"';
        }
        if(isset($search['project_type'])){
            $where.=' and product_type='.$search['project_type'];
        }
        if(isset($search['is_rem'])){
            $where.=' and is_rem='.$search['is_rem'];
        }
        if(isset($search['is_effect'])){
            $where.=' and is_effect='.$search['is_effect'];
        }
        $sql='select id from ai_product where 1=1 '.$where;
        $query=  $this->db->query($sql);
        return $query->num_rows();
    }
    
    
    /**
     * 
     * @todo 根据条件查询产品列表
     * 
     * @param $saerch 查询条件
     * 
     * @return 返回一个二维对象 
     * 
     */
    public function getProductList($search){
        $where='';
        if(isset($search['is_del'])){
            $where.=' and is_del='.$search['is_del'];
        }
        if(isset($search['product_name'])){
            $where.=' and title like "%'.$search['product_name'].'%"';
        }
        if(isset($search['project_type'])){
            $where.=' and product_type='.$search['project_type'];
        }
        if(isset($search['is_rem'])){
            $where.=' and is_rem='.$search['is_rem'];
        }
        if(isset($search['is_effect'])){
            $where.=' and is_effect='.$search['is_effect'];
        }
        $sql='select * from ai_product where 1=1 '.$where.' order by addtime desc limit '.$search['start'].','.$search['pagesize'];
        $query=  $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 添加产品信息 
     * 
     */
    public function addProductData($data){
        $this->db->insert('ai_product', $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * 
     * @todo 根据ID获取产品信息
     * 
     * @param $id 产品ID
     * 
     * @return 返回一个对象 
     * 
     */
    public function getProductById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('ai_product');
        return $query->row();
    }
    
    /**
     * 
     * @todo 根据ID修改产品信息
     * 
     * @param $id 产品ID
     * 
     * @param $data 要修改的数据
     * 
     * @return  返回一个boolean类型的结果 
     * 
     */
    public function editProductData($data,$id){
        return $row = $this->db->update('ai_product', $data, array('id' => $id));
    }
    
    
}

?>
