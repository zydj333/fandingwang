<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usercenter
 *
 * @createtime 2015-4-7 23:53:52
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @todo 用户中心
 *
 */
class usercenter extends Frontend_Controller {

    protected $userinfo;

    public function __construct() {
        parent::__construct();
        $this->load->model('usercenter_model');
        $this->userinfo = $this->userinfo();
        $this->comm->checkUserlogin();
    }

    /**
     * 
     * @todo 载入用户中心 
     * 
     */
    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_用户中心",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $product=  $this->usercenter_model->getMyCollectList($user['user_id']);
        if(!empty($product)){
            foreach($product as $k=>$v){
                $timer=$this->comm->getTimeString($v->starttime,$v->endtime,$v->days);
                $product[$k]->timer= $timer['str'];
            }
        }
        $data['product']=$product;
        $data['join']=$this->usercenter_model->getMySupportProjectList($user['user_id']);
        $data['luanch']=$this->usercenter_model->getMyLaunchProjectList($user['user_id']);
        $data['now_time']=  time();
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/usercenter/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 发布我的状态 
     * 
     */
    public function addmyfeed() {
        $feed = $this->input->post('add_feed');
        $user = $this->userinfo;
        $data=array(
            'uid'=>$user['user_id'],
            'content'=>$feed,
            'repay'=>0,
            'zan_uid'=>0,
            'cai_uid'=>0,
            'zan'=>0,
            'cai'=>0,
            'addtime'=>  time()
        );
        $id=$this->usercenter_model->saveMyFeed($data);
        if($id>0){
            //发布成功
             redirect('/usercenter');
        }else{
            //发布失败
            redirect('/usercenter');
        }
    }
    
    /**
     * 
     * @todo  参与的项目
     * 
     */
    public function myjoin(){
        //加载头部信息
        $header = array(
            'title' => "泛丁网_用户中心_我参与的项目",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $product=  $this->usercenter_model->getMyCollectList($user['user_id']);
        $data['product']=$product;
        $join=$this->usercenter_model->getMySupportProjectList($user['user_id']);
        if(!empty($join)){
            foreach($join as $k=>$v){
                $timer=$this->comm->getTimeString($v->starttime,$v->endtime,$v->days);
                $join[$k]->timer= $timer['str'];
            }
        }
        $data['join']=$join;
        $data['luanch']=$this->usercenter_model->getMyLaunchProjectList($user['user_id']);
        $data['now_time']=  time();
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/usercenter/myjoin', $data);
        $this->load->view('frontend/public/footer');
    }
    
    /**
     * 
     * @todo 我发起的项目 
     * 
     */
    public function mylaunch(){
        //加载头部信息
        $header = array(
            'title' => "泛丁网_用户中心_我发起的项目",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'usercenter'
        );
        $user = $this->userinfo;
        $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $product=  $this->usercenter_model->getMyCollectList($user['user_id']);
        $data['product']=$product;
        $data['join']=$this->usercenter_model->getMySupportProjectList($user['user_id']);
        $luanch=$this->usercenter_model->getMyLaunchProjectList($user['user_id']);
        if(!empty($luanch)){
            foreach($luanch as $k=>$v){
                $timer=$this->comm->getTimeString($v->starttime,$v->endtime,$v->days);
                $luanch[$k]->timer= $timer['str'];
            }
        }
        $data['luanch']=$luanch;
        $data['now_time']=  time();
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/usercenter/mylaunch', $data);
        $this->load->view('frontend/public/footer');
    }
    
    
    /**
     * 
     * @todo  
     * 
     */
    
    /**
     * 
     * @todo 显示用户的信息 
     * 
     */
    public function userhome(){
        echo 'coming soon!';
    }

}

?>
