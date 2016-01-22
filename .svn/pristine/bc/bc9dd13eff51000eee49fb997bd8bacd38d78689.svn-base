<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project
 *
 * @createtime 2015-3-28 9:08:52
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class project extends Frontend_Controller {

    private $pagesize = 6;
    protected $user;

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('index_model');
        $this->load->library('frontpage');
        $this->user = $this->userinfo();
    }

    /**
     * 
     * @todo 项目列表 
     * 
     */
    public function index() {
        $header = array(
            'title' => "泛丁网_项目列表",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $data = array();
        //获取项目列表页的banner
        $data['banner'] = $this->index_model->getBannerList('projects', 1);
        //获取产品列表
        //获取参数
        $data['status'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $data['type'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $nowpage = $this->uri->segment(5) ? $this->uri->segment(5) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($data['status'] > 0) {
            $search['status'] = $data['status'];
        }
        if ($data['type'] > 0) {
            $search['type'] = $data['type'];
        }
        $count = $this->project_model->getProjectCount($search);
        $product = $this->project_model->getProjectList($search);
        $data['base_dir'] = '/project/index/' . $data['status'] . '/' . $data['type'];
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        if (!empty($product)) {
            foreach ($product as $k => $v) {
                $timer = $this->comm->getTimeString($v->starttime, $v->endtime, $v->days);
                $product[$k]->timer = $timer['str'];
            }
        }
        $data['product'] = $product;
        //获取项目分类
        $data['pro_type'] = $this->project_model->getProjectType(4);
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/project/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 收藏的项目 
     * 
     */
    public function collect() {
        $this->comm->checkUserlogin();
        $user = $this->userinfo();
        $header = array(
            'title' => "泛丁网_我收藏的项目列表",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $data = array();
        //获取项目列表页的banner
        $data['banner'] = $this->index_model->getBannerList('projects', 1);
        //获取产品列表
        //获取参数
        $data['type'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $nowpage = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'user_id' => $user['user_id'],
        );
        if ($data['type'] > 0) {
            $search['type'] = $data['type'];
        }
        $count = $this->project_model->getCollectProjectCount($search);
        $product = $this->project_model->getCollectProjectList($search);
        $data['base_dir'] = '/project/collect/' . $data['type'];
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        if (!empty($product)) {
            foreach ($product as $k => $v) {
                $timer = $this->comm->getTimeString($v->starttime, $v->endtime, $v->days);
                $product[$k]->timer = $timer['str'];
            }
        }
        $data['product'] = $product;
        //获取项目分类
        $data['pro_type'] = $this->project_model->getProjectType(3);
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/project/collect', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 载入项目详情页面 
     * 
     */
    public function detial() {
        $header = array(
            'title' => "泛丁网_项目列表",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->showErrorNotFond();
        } else {
            //获取项目详情.
            $product = $this->project_model->getProductInfoById($id);
            if (empty($product)) {
                $this->showErrorNotFond();
            } else {
                //修改项目的流量次数
                $this->project_model->editProductViewsById($id);
                $header['title'] = $product->seo_title;
                $header['keywords'] = $product->seo_keyword;
                $header['description'] = $product->seo_discription;
                $timer = $this->comm->getTimeString($product->starttime, $product->endtime, $product->days);
                $product->timer = $timer['str'];
                //获取项目用户详情
                $author = $this->comm_model->getMemberByUid($product->user_id);
                //获取项目投资子项
                $product_items = $this->project_model->getProductItemsList($id);
                //获取项目动态
                //$feed = $this->project_model->getProductFeedList($id);
                //获取项目回复
                //$reply = $this->project_model->getProductRepayList($id);
                //获取项目支持记录列表
                //$support = $this->project_model->getProductSupportList($id);
                $is_process = 0;
                if ($product->starttime < time() && $product->endtime > time()) {
                    $is_process = 1;
                } else if ($product->endtime < time()) {
                    $is_process = 2;
                }
                $data = array(
                    'product' => $product,
                    'author' => $author,
                    'product_items' => $product_items,
                    //'feed' => $feed,
                    //'reply' => $reply,
                    //'support' => $support,
                    'is_process' => $is_process
                );
                $data['now_time'] = time();
                //$data['pro_type'] = $this->project_model->getProjectType(3);
                $data['login_user'] = $this->user;
                //$this->output->cache(1);
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/project/detial', $data);
                $this->load->view('frontend/public/footer');
            }
        }
    }

    /**
     * 
     * @todo 载入项目动态
     * 
     */
    public function tender() {
        $header = array(
            'title' => "泛丁网_项目详情",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->showErrorNotFond();
        } else {
            //获取项目详情.
            $product = $this->project_model->getProductInfoById($id);
            if (empty($product)) {
                $this->showErrorNotFond();
            } else {
                $header['title'] = $product->seo_title;
                $header['keywords'] = $product->seo_keyword;
                $header['description'] = $product->seo_discription;
                $timer = $this->comm->getTimeString($product->starttime, $product->endtime, $product->days);
                $product->timer = $timer['str'];
                //获取项目用户详情
                $author = $this->comm_model->getMemberByUid($product->user_id);
                //获取项目投资子项
                $product_items = $this->project_model->getProductItemsList($id);
                //获取项目动态
                $feed = $this->project_model->getProductFeedList($id);
                //获取项目回复
                //$reply = $this->project_model->getProductRepayList($id);
                //获取项目支持记录列表
                //$support = $this->project_model->getProductSupportList($id);
                $is_process = 0;
                if ($product->starttime < time() && $product->endtime > time()) {
                    $is_process = 1;
                } else if ($product->endtime < time()) {
                    $is_process = 2;
                }
                $data = array(
                    'product' => $product,
                    'author' => $author,
                    'product_items' => $product_items,
                    'feed' => $feed,
                    //'reply' => $reply,
                    //'support' => $support,
                    'is_process' => $is_process
                );
                $data['now_time'] = time();
                //$data['pro_type'] = $this->project_model->getProjectType(3);
                $data['login_user'] = $this->user;
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/project/tender', $data);
                $this->load->view('frontend/public/footer');
            }
        }
    }

    /**
     * 
     * @todo 载入项目评论 
     * 
     */
    public function repay() {
        $header = array(
            'title' => "泛丁网_项目详情",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->showErrorNotFond();
        } else {
            //获取项目详情.
            $product = $this->project_model->getProductInfoById($id);
            if (empty($product)) {
                $this->showErrorNotFond();
            } else {
                $header['title'] = $product->seo_title;
                $header['keywords'] = $product->seo_keyword;
                $header['description'] = $product->seo_discription;
                $timer = $this->comm->getTimeString($product->starttime, $product->endtime, $product->days);
                $product->timer = $timer['str'];
                //获取项目用户详情
                $author = $this->comm_model->getMemberByUid($product->user_id);
                //获取项目投资子项
                $product_items = $this->project_model->getProductItemsList($id);
                //获取项目动态
                //$feed = $this->project_model->getProductFeedList($id);
                //获取项目回复
                $reply = $this->project_model->getProductRepayList($id);
                if (!empty($reply)) {
                    foreach ($reply as $key => $values) {
                        $avatar = array();
                        if ($values->avatar != '') {
                            $avatar = explode('_', $values->avatar);
                            if (count($avatar) == 3) {
                                $reply[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                            }
                        }
                    }
                }
                //获取项目支持记录列表
                //$support = $this->project_model->getProductSupportList($id);
                $is_process = 0;
                if ($product->starttime < time() && $product->endtime > time()) {
                    $is_process = 1;
                } else if ($product->endtime < time()) {
                    $is_process = 2;
                }
                $data = array(
                    'product' => $product,
                    'author' => $author,
                    'product_items' => $product_items,
                    //'feed' => $feed,
                    'reply' => $reply,
                    //'support' => $support,
                    'is_process' => $is_process
                );
                $data['now_time'] = time();
                //$data['pro_type'] = $this->project_model->getProjectType(3);
                $data['login_user'] = $this->user;
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/project/repay', $data);
                $this->load->view('frontend/public/footer');
            }
        }
    }

    /**
     * 
     * @todo 载入项目支持列表
     * 
     */
    public function invest() {
        $header = array(
            'title' => "泛丁网_项目详情",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'project'
        );
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->showErrorNotFond();
        } else {
            //获取项目详情.
            $product = $this->project_model->getProductInfoById($id);
            if (empty($product)) {
                $this->showErrorNotFond();
            } else {
                $header['title'] = $product->seo_title;
                $header['keywords'] = $product->seo_keyword;
                $header['description'] = $product->seo_discription;
                $timer = $this->comm->getTimeString($product->starttime, $product->endtime, $product->days);
                $product->timer = $timer['str'];
                //获取项目用户详情
                $author = $this->comm_model->getMemberByUid($product->user_id);
                //获取项目投资子项
                $product_items = $this->project_model->getProductItemsList($id);
                //获取项目动态
                //$feed = $this->project_model->getProductFeedList($id);
                //获取项目回复
                //$reply = $this->project_model->getProductRepayList($id);
                //获取项目支持记录列表
                $support = $this->project_model->getProductSupportList($id);
                $is_process = 0;
                if ($product->starttime < time() && $product->endtime > time()) {
                    $is_process = 1;
                } else if ($product->endtime < time()) {
                    $is_process = 2;
                }
                if (!empty($support)) {
                    foreach ($support as $key => $values) {
                        $avatar = array();
                        if ($values->avatar != '') {
                            $avatar = explode('_', $values->avatar);
                            if (count($avatar) == 3) {
                                $support[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                            }
                        }
                    }
                }
                $data = array(
                    'product' => $product,
                    'author' => $author,
                    'product_items' => $product_items,
                    //'feed' => $feed,
                    //'reply' => $reply,
                    'support' => $support,
                    'is_process' => $is_process
                );
                $data['now_time'] = time();
                //$data['pro_type'] = $this->project_model->getProjectType(3);
                $data['login_user'] = $this->user;
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/project/invest', $data);
                $this->load->view('frontend/public/footer');
            }
        }
    }

    /**
     * 
     * @todo 保存讨论信息 
     * 
     */
    public function saveRepay() {
        $_data = $this->input->post();
        $user = $this->user;
        if (!empty($user)) {
            $msg = array('flag' => 0, 'error' => '');
            $data = array(
                'pid' => $_data['product_id'] ? $_data['product_id'] : 0,
                'uid' => $user['user_id'] ? $user['user_id'] : 0,
                'username' => $user['user_id'] ? $user['user_name'] : '匿名用户',
                'to_uid' => $_data['to_uid'] ? $_data['to_uid'] : 0,
                'to_user' => '无需添加',
                'to_replay_id' => $_data['to_replay_id'] ? $_data['to_replay_id'] : 0,
                'content' => $this->comm->cleanhtml($_data['content'], '<a><img>'),
                'is_del' => 0,
                'addip' => $this->comm->real_ip()
            );
            if ($data['pid'] > 0 && $data['content'] != '') {
                if ($this->project_model->checkRepayIsDefind($data)) {
                    $id = $this->project_model->saveRepayAdd($data);
                    if ($id > 0) {
                        $this->comm_model->editProductReplayCount($data['pid']);
                        $msg['flag'] = 1;
                        $msg['error'] = '回复成功!';
                    } else {
                        $msg['error'] = '回复失败，错误未知!';
                    }
                } else {
                    $msg['error'] = '你不能连续回复相同的东西!';
                }
            } else {
                $msg['error'] = '参数错误或者你没有填写信息!';
            }
        } else {
            $msg['flag'] = 2;
            $msg['error'] = '您还没有登录!';
        }
        echo json_encode($msg);
    }

}

?>
