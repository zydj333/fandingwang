<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_login_model
 *
 * @createtime 2014-10-22 10:08:39
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_login_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 检查用户的登录数据是否正确
     *
     * @param $data 登录数据
     *
     * @return 返回一个结果集
     *
     */
    public function checkUser($data){
        $sql="select a.*,b.powername,b.power as powervalue from ai_adminuser as a left join ai_power as b on a.power=b.id where a.account=? and a.password=? and a.is_del=0";
        $query=$this->db->query($sql,array($data['account'],$data['password']));
        return $query->row();
    }
}
?>
