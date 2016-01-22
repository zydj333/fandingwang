<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @createtime 2015-3-27 14:20:56
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class index extends Frontend_Controller {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('index_model');
    }

    /**
     * 
     * @todo 首页 
     * 
     */
    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_首页",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'index'
        );
        //获取banner
        $data['banner'] = $this->index_model->getBannerList('banner', 4);
        //获取产品列表
        $product = $this->index_model->getProdectList();
        if (!empty($product)) {
            foreach ($product as $k => $v) {
                $timer = $this->comm->getTimeString($v->starttime, $v->endtime, $v->days);
                $product[$k]->timer = $timer['str'];
            }
        }
        $data['product'] = $product;
        //获取最新话题列表
        $topic= $this->index_model->getTopicList(3);
//        if(!empty($topic)){
//            foreach ($topic as $key=>$value){
//               $avatar = array();
//                if ($value->avatar != '') {
//                    $avatar = explode('_', $value->avatar);
//                    if (count($avatar) == 3) {
//                        $topic[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
//                    }
//                } 
//            }
//        }
        $data['topic'] = $topic;
        //$this->output->cache(1);
        //var_dump($data);die;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/index/index', $data);
        $this->load->view('frontend/public/footer');
    }

}