<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @createtime 2014-10-21 8:49:49
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin extends Admin_Controller {

    /**
     *
     * @todo 构造方法
     *
     */
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * @todo 跳转到后台首页
     *
     */
    public function index(){
        redirect('/admin_index/');
    }
}
?>
