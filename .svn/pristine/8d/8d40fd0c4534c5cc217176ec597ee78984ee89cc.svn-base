<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bbs
 *
 * @createtime 2015-4-18 14:56:51
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class bbs extends Frontend_Controller {

    private $pagesize = 5;
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->load->model('index_model');
        $this->load->model('bbs_model');
        $this->load->library('frontpage');
        $this->user = $this->userinfo();
    }

    /**
     * 
     * @todo 载入bbs首页 
     * 
     * @discription 最新帖子
     * 
     */
    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_最新话题",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'luntan'
        );
        $data['son_cusor'] = 'index';
        //获取banner
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);

        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        $count = $this->bbs_model->getBbsCount($search);
        $list = $this->bbs_model->getBbsList($search);
        $data['base_dir'] = '/bbs/index';
        if ($count > 0) {
            foreach ($list as $key => $value) {
                $content = $value->content;
                $noimg = $this->comm->cleanhtml($content);
                $list[$key]->content = $this->comm->cut_str($noimg, 180);
                $avatar = array();
                if ($value->avatar != '') {
                    $avatar = explode('_', $value->avatar);
                    if (count($avatar) == 3) {
                        $list[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                    }
                }
            }
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        //获取置顶帖
        $data['top'] = $this->bbs_model->getBbsTopList($search);
        //$this->output->cache(1);
        //var_dump($data);die;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/bbs/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     *
     * @todo 热门帖子
     * 
     */
    public function hot() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_热门话题",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        $data['son_cusor'] = 'hot';
        //获取banner
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'hot' => 1
        );
        $count = $this->bbs_model->getBbsCount($search);
        $list = $this->bbs_model->getBbsList($search);
        $data['base_dir'] = '/bbs/index';
        if ($count > 0) {
            foreach ($list as $key => $value) {
                $content = $value->content;
                $noimg = preg_replace('|\<img(.*?)\>|i', ' ', $content);
                $list[$key]->content = $this->comm->cut_str($noimg, 180);
                $avatar = array();
                if ($value->avatar != '') {
                    $avatar = explode('_', $value->avatar);
                    if (count($avatar) == 3) {
                        $list[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                    }
                }
            }
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/bbs/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 精华帖子
     * 
     * 
     */
    public function cream() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_精华话题",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        $data['son_cusor'] = 'cream';
        //获取banner
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'cream' => 1
        );
        $count = $this->bbs_model->getBbsCount($search);
        $list = $this->bbs_model->getBbsList($search);
        $data['base_dir'] = '/bbs/index';
        if ($count > 0) {
            foreach ($list as $key => $value) {
                $content = $value->content;
                $noimg = preg_replace('|\<img(.*?)\>|i', ' ', $content);
                $list[$key]->content = $this->comm->cut_str($noimg, 180);
                $avatar = array();
                if ($value->avatar != '') {
                    $avatar = explode('_', $value->avatar);
                    if (count($avatar) == 3) {
                        $list[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                    }
                }
            }
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/bbs/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 话题详情 
     * 
     */
    public function detial() {
        $t_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($t_id > 0) {
            //获取banner
            $data['banner'] = $this->index_model->getBannerList('bbs', 1);
            //话题列表
            $topic = $this->bbs_model->getTopicDetial($t_id);
            if (!empty($topic)) {
                $header = array(
                    'title' => $topic->title,
                    'keywords' => $topic->title,
                    'description' => $topic->title,
                    'cusor' => 'luntan'
                );
                //获取话题评论
                $repay = $this->bbs_model->getTopicRepay($t_id);
                foreach ($repay as $key => $value) {
                    $avatar = array();
                    if ($value->avatar != '') {
                        $avatar = explode('_', $value->avatar);
                        if (count($avatar) == 3) {
                            $repay[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                        }
                    }
                }
                $data['repay'] = $repay;
                $data['topic'] = $topic;
                //修改浏览次数
                $this->bbs_model->editTopicViews($t_id);
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/bbs/detial', $data);
                $this->load->view('frontend/public/footer');
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     * 
     * @todo 保存回复 
     * 
     */
    public function saveRepay() {
        $user = $this->user;
        $topic_id = $this->input->post('topic_id') ? $this->input->post('topic_id') : 0;
        $repay_id = $this->input->post('repay_id') ? $this->input->post('repay_id') : 0;
        $content = $this->comm->cleanhtml($this->input->post('content'),'<a><img>');
        $msg = array('flag' => 0, 'error' => '');
        if(empty($user)){
            $msg['error'] = '发布评论前，请先进行登录';
            echo json_encode($msg);
            exit;
        }
        if ($topic_id == 0) {
            $msg['error'] = '参数错误';
            echo json_encode($msg);
            exit;
        }
        if ($content == '' || $content == '回复：' || $content == '回复:' || $content == '回复') {
            $msg['error'] = '回复的内容不能为空!';
            echo json_encode($msg);
            exit;
        }
        $floor = $this->bbs_model->getFoolerCount($topic_id);
        $data = array(
            'tid' => $topic_id,
            'uid' => $user['user_id'] ? $user['user_id'] : 0,
            'tofloor' => $repay_id,
            'floor_content' => '',
            'content' => $content,
            'floos' => $repay_id ? 0 : $floor + 1,
            'is_del' => 0,
            'addip' => $this->comm->real_ip()
        );
        if ($this->bbs_model->checkRepayRepeat($data)) {
            $msg['error'] = '不能重复回复相同的信息!';
            echo json_encode($msg);
            exit;
        }
        $in_id = $this->bbs_model->saveRepayData($data);
        if ($in_id > 0) {
            $this->bbs_model->editTopicRepays($topic_id);
            $msg['flag'] = 1;
            $msg['error'] = '回复成功!';
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = '回复失败，错误未知!';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 载入发起话题 
     * 
     */
    public function add() {
        $this->comm->checkUserlogin();
        $user = $this->user;
        //加载头部信息
        $header = array(
            'title' => "泛丁网_发起话题",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'luntan'
        );
        $data['list'] = '';
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/bbs/add', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 保存新帖 
     * 
     */
    public function saveTopic() {
        $_data = $this->input->post();
        $user = $this->user;
        $data = array(
            'title' => $_data['title'],
            'imageurl' => $_data['image_url'],
            'forum_one' => 0,
            'forum_onename' => '',
            'forum_two' => 0,
            'forum_twoname' => '',
            'content' => $_data['content'],
            'views' => 0,
            'reply' => 0,
            'uid' => $user['user_id'],
            'tagid' => 0,
            'tags' => '',
            'addtime' => date('Y-m-d H:i:s', time()),
            'is_del' => 0,
            'cream' => 0,
            'hot' => 0,
            'is_top' => 0
        );
        $msg = array('flag' => 0, 'error' => '');
        if ($data['title'] == '' || $data['content'] == '') {
            $msg['error'] = '信息请填写完整!';
            echo json_encode($msg);
            exit;
        }
        if ($this->bbs_model->checkTopicHasDefind($data)) {
            $msg['error'] = '您不能发重复的帖子!';
            echo json_encode($msg);
            exit;
        }

        $t_id = $this->bbs_model->saveTopicData($data);
        if ($t_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = '发布成功!';
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = '发布失败，未知错误!';
            echo json_encode($msg);
            exit;
        }
    }

}

?>
