<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ci_marty
 *
 * @author zhangping'an
 * @Create Time    2012-3-12 9:50:05
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH.'libraries/smarty/Smarty.class.php';

class ci_smarty extends smarty {
    private $config;
    function __construct() {
        parent::__construct();
        require_once(APPPATH . 'config/cismarty.php');
        $this->config = $config;
        if (count($this->config) > 0) {
            $this->initialize($this->config);
        }
        //设置时区
        if (phpversion() >= '5.1.0') {
            date_default_timezone_set('Asia/Shanghai');
        }
        $this->assign("baseUrl",$_SERVER ['SERVER_NAME']);
        $this->assign("cur_date",date("Y-m-d"));
    }
    /**
     * Initialize preferences
     */
    function initialize($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                //这里是根据自己需要扩展一些set方法
                $method = 'set_' . $key;
                if (method_exists($this, $method)) {
                    $this->$method($val);
                } else {
                    //修改smarty源文件默认变量，这里是自定义cismarty数组值
                    $this->$key = $val;
                }
            }
        }
    }

    function view($html){
        if($html){
            $html=$html.'.html';
           // echo $html;exit;
            $this->display($html);
        }else{
            return '模板不存在!';
        }
    }

}

?>
