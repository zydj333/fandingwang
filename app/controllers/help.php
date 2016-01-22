<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of help
 *
 * @createtime 2015-4-13 12:34:00
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class help extends Frontend_Controller {

//put your code here
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->user = $this->userinfo();
    }
    
    
    public function index(){
        redirect('/help/about_us');
    }

    /**
     * 
     * @todo 关于我们
     * 
     */
    public function about_us() {
        $header['title'] = '关于我们';
        $header['cusor'] = 'about_us';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_about',$header);
        $this->load->view('frontend/about/about_us');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 加入泛丁 
     * 
     */
    public function join_us() {
        $header['title'] = '加入泛丁';
        $header['cusor'] = 'join_us';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_about',$header);
        $this->load->view('frontend/about/join_us');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 联系我们 
     * 
     */
    public function contact_us() {
        $header['title'] = '联系我们';
        $header['cusor'] = 'contact_us';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_about',$header);
        $this->load->view('frontend/about/contact_us');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo media 媒体报道  
     * 
     */
    public function media() {
        redirect('/help/contact_us');
        $header['title'] = '媒体报道';
        $header['cusor'] = 'media';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_about',$header);
        $this->load->view('frontend/about/media');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 商业合作 
     * 
     */
    public function cooperation() {
        redirect('/help/contact_us');
        $header['title'] = '商业合作';
        $header['cusor'] = 'cooperation';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_about',$header);
        $this->load->view('frontend/about/cooperation');
        $this->load->view('frontend/public/footer');
    }

    /*     * *************************************帮助中心************************************************** */

    /**
     * 
     * @todo  常见问题
     * 
     */
    public function problem() {
        $header['title'] = '常见问题';
        $header['cusor'] = 'problem';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_help',$header);
        $this->load->view('frontend/help/problem');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 新手指导 
     * 
     */
    public function guide() {
        $header['title'] = '新手指导';
        $header['cusor'] = 'guide';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_help',$header);
        $this->load->view('frontend/help/guide');
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 意见反馈 
     * 
     */
    public function feedback() {
        $header['title'] = '意见反馈';
        $header['cusor'] = 'feedback';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_help',$header);
        $this->load->view('frontend/help/feedback');
        $this->load->view('frontend/public/footer');
    }
    
    
    /**
     * 
     * @todo 用户协议 
     * 
     */
    public function agreement(){
        //echo 'waiting!';exit;
        $header['title'] = '用户协议';
        $header['cusor'] = 'agreement';
        $header['user'] = $this->user;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/public/header_help',$header);
        $this->load->view('frontend/help/agreement');
        $this->load->view('frontend/public/footer');
    }

}

?>
