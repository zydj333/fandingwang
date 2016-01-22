<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shequ
 *
 * @createtime 2015-4-8 17:11:35
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class shequ extends Frontend_Controller {

//put your code here
    private $pagesize = 4;
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->load->model('index_model');
        $this->load->model('shequ_model');
        $this->load->library('frontpage');
        $this->user = $this->userinfo();
    }

    /**
     * 
     * @todo 载入社区首页 
     * 
     */
    public function index() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_社区首页",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        //获取banner
        $data['son_cusor'] = 'index';
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/index';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 泛丁分享 
     * 
     */
    public function share() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_泛丁分享",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        //获取banner
        $data['son_cusor'] = 'share';
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'type' => 2
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/share';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     *
     * @todo 媒体报道 
     * 
     */
    public function media() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_泛丁分享",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        //获取banner
        $data['son_cusor'] = 'media';
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'type' => 3
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/media';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo  载入社区详情页面
     * 
     */
    public function detial() {
        //加载头部信息
        $news_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        //var_dump($news_id);die;
        if ($news_id > 0) {
            $header = array(
                'title' => "",
                'keywords' => "",
                'description' => "",
                'cusor' => 'shequ'
            );
            $data['son_cusor'] = '0';
            //获取banner
            $data['banner'] = $this->index_model->getBannerList('bbs', 1);
            //获取资讯详情
            $data['news'] = $this->shequ_model->getArticleDetial($news_id);
            if (!empty($data['news'])) {
                $header['title'] = $data['news']->seo_title;
                $header['keywords'] = $data['news']->seo_keyword;
                $header['description'] = $data['news']->seo_discription;
                //获取新闻评论列表
                $repay = $this->shequ_model->getArticleRepayList($news_id);
                if (!empty($repay)) {
                    foreach ($repay as $key => $values) {
                        $avatar = array();
                        if ($values->avatar != '') {
                            $avatar = explode('_', $values->avatar);
                            if (count($avatar) == 3) {
                                $repay[$key]->avatar = $avatar[0] . '_' . $avatar[1] . '_middle.jpg';
                            }
                        }
                    }
                }
                $data['repay'] = $repay;
                //修改新闻的查看次数
                $this->shequ_model->editArticleViews($news_id);
                //$this->output->cache(1);
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/shequ/detial', $data);
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
        $news_id = $this->input->post('news_id') ? $this->input->post('news_id') : 0;
        $repay_id = $this->input->post('repay_id') ? $this->input->post('repay_id') : 0;
        $content = $this->comm->cleanhtml($this->input->post('content'), "<a><img>");
        $msg = array('flag' => 0, 'error' => '');
        if ($news_id == 0) {
            $msg['error'] = "参数错误!";
            echo json_encode($msg);
            exit;
        }
        if ($content == '' || $content == '回复：' || $content == '回复' || $content == '回复:') {
            $msg['error'] = "回复的内容不能为空!";
            echo json_encode($msg);
            exit;
        }
        $user = $this->user;
        $data = array(
            'news_id' => $news_id,
            'uid' => $user['user_id'] ? $user['user_id'] : 0,
            'user_name' => $user['user_id'] ? $user['user_name'] : '匿名用户',
            'to_id' => $repay_id,
            'content' => $content,
            'addip' => $this->comm->real_ip(),
            'addtime' => time(),
            'is_del' => 0
        );
        //检查是否重复
        if ($this->shequ_model->checkArticleRepayDefind($data)) {
            $msg['error'] = "你不能连续的回复相同的信息!";
            echo json_encode($msg);
            exit;
        }
        $r_id = $this->shequ_model->saveArticleRepay($data);
        if ($r_id > 0) {
            $this->shequ_model->editArticleRepayCount($news_id);
            $msg['flag'] = 1;
            $msg['error'] = "回复成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存回复失败!";
            echo json_encode($msg);
            exit;
        }
    }

    /*     * ***************************活动**************************************** */

    /**
     * 
     * 
     * @todo 载入泛丁活动列表 
     * 
     */
    public function activity() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_泛丁活动",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        //获取banner
        $data['son_cusor'] = 'activity';
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'type' => 9
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/activity';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/activity', $data);
        $this->load->view('frontend/public/footer');
    }
    /**
     * 
     * 
     * @todo 载入泛丁活动列表 
     * 
     */
    public function ativity() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_泛丁活动",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
        //获取banner
        $data['son_cusor'] = 'ativity';
        $data['banner'] = $this->index_model->getBannerList('bbs', 1);
        $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'type' => 10
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/activity';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/ativity', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 载入活动详情 
     * 
     */
    public function actdetial() {
        //加载头部信息
        $a_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($a_id > 0) {
            $header = array(
                'title' => "",
                'keywords' => "",
                'description' => "",
                'cusor' => 'shequ'
            );
            $data['son_cusor'] = 'activity';
            //获取banner
            $data['banner'] = $this->index_model->getBannerList('bbs', 1);
            //获取活动详情
            $data['act'] = $this->shequ_model->getActivityDetial($a_id);
            if (!empty($data['act'])) {
                $header['title'] = $data['act']->seo_title;
                $header['keywords'] = $data['act']->seo_keyword;
                $header['description'] = $data['act']->seo_discription;
                //修改活动的查看次数
                $this->shequ_model->editActivityViews($a_id);
                //$this->output->cache(1);
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/shequ/actdetial', $data);
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
     * @todo 载入活动详情 
     * 
     */
    public function ndsdetial() {
        //加载头部信息
        $a_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($a_id > 0) {
            $header = array(
                'title' => "",
                'keywords' => "",
                'description' => "",
                'cusor' => 'shequ'
            );
            $data['son_cusor'] = 'activity';
            //获取banner
            $data['banner'] = $this->index_model->getBannerList('bbs', 1);
            //获取活动详情
            $data['news'] = $this->shequ_model->getnewsDetial($a_id);
            if (!empty($data['news'])) {
                $header['title'] = $data['news']->seo_title;
                $header['keywords'] = $data['news']->seo_keyword;
                $header['description'] = $data['news']->seo_discription;
                //修改活动的查看次数
                $this->shequ_model->editActivityViews($a_id);
                //$this->output->cache(1);
                $this->load->view('frontend/public/header', $header);
                $this->load->view('frontend/shequ/detial', $data);
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
     * @todo 报名操作 
     * 
     */
    public function enlist() {
        //预留项目
    }

    /*     * ******************************创客日记********************************* */

    public function diary() {
        //加载头部信息
        $header = array(
            'title' => "泛丁网_泛丁分享",
            'keywords' => "泛丁众筹，泛丁网，消费众筹，杭州众筹，杭州科技众筹，TMT众筹，最具发展前景的众筹，高科技众筹，最安全的众筹平台",
            'description' => "泛丁起源于众筹Crowdfunding一词。由浙江爱投科技有限公司独立运营。浙江爱投科技有限公司成立于2014年，2015年初正式运营。"
            . "注册资金1000万，办公地点位于杭州市拱墅区。",
            'cusor' => 'shequ'
        );
            $data['son_cusor'] = 'diary';
            //获取banner
            $data['banner'] = $this->index_model->getBannerList('bbs', 1);
            $nowpage = $this->uri->segment(3) ? $this->uri->segment(3) : 1;
            $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'type' => 8
        );
        $count = $this->shequ_model->getArticleCount($search);
        $list = $this->shequ_model->getArticleList($search);
        $data['base_dir'] = '/shequ/share';
        if ($count > 0) {
            $data['page_link'] = $this->frontpage->getPage($count, $this->pagesize, $nowpage, $data['base_dir']);
        }
        $data['list'] = $list;
        $this->output->cache(1);
//        var_dump($data);die;
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/shequ/diary', $data);
        $this->load->view('frontend/public/footer');
    }

}
