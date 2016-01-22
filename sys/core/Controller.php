<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

    private static $instance;

    /**
     * Constructor
     */
    public function __construct() {
        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded () as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');

        $this->load->initialize();

        log_message('debug', "Controller Class Initialized");
    }

    public static function &get_instance() {
        return self::$instance;
    }

}

// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
class Admin_Controller extends CI_Controller {

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->comm->checkLogin();
    }

    /**
     *
     * @todo 加载操作成功的提示页面
     *
     * @param  $message 提示信息
     *
     * @param $jumpUrl 跳转路径
     *
     * @param $waitSecond 跳转等待时间
     *
     */
    public function messageSuccess($message, $jumpUrl="/", $waitSecond=2) {
        $this->ci_smarty->assign('title', "操作成功");
        $this->ci_smarty->assign('message', $message);
        $this->ci_smarty->assign('jumpUrl', $jumpUrl);
        $this->ci_smarty->assign('waitSecond', $waitSecond);
        $this->ci_smarty->view('backend/public/success');
    }

    /**
     *
     * @todo 加载操作失败提示信息页面
     *
     * @param  $message 提示信息
     *
     * @param $jumpUrl 跳转路径
     *
     * @param $waitSecond 跳转等待时间
     *
     */
    public function messageError($message, $jumpUrl="/", $waitSecond=3) {
        $data = array(
            'title' => "操作失败",
            'message' => $message,
            'jumpUrl' => $jumpUrl,
            'waitSecond' => $waitSecond,
        );
        $this->load->view('backend/public/error', $data);
    }

}

/**
 *
 * @todo 前台基类
 *
 */
class Frontend_Controller extends CI_Controller {
    protected $footer;
    public function __construct() {
        parent::__construct();
        $this->load->model("comm_model");
    }

    public function showErrorNotFond(){
        $this->load->view('frontend/public/error');
    }
    
    
    public function getFooter(){
        $this->footer=new stdClass();
        $this->footer->copy_right=  $this->comm_model->getSettingByType('copy_right');
        $this->footer->work_time=  $this->comm_model->getSettingByType('work_time');
        $this->footer->tel=  $this->comm_model->getSettingByType('tel');
        $this->footer->lower_men=  $this->comm_model->getSettingByType('lower_men');
        $this->footer->site_email=  $this->comm_model->getSettingByType('site_email');
        return $this->footer;
    }
    
    public function userinfo(){
        return json_decode($this->comm->get_session('member'),TRUE);
    }
}