<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbstopic
 *
 * @createtime 2014-10-28 9:18:04
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_bbstopic extends Admin_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;
    private $pagesize = 10;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_bbstopic_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_bbstopic');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 话题列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_bbstopic_model->getTopicCount($search);
        $list = $this->admin_bbstopic_model->getTopicList($search);
        $data['url'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $this->load->view('backend/bbstopic/index', $data);
    }

    /**
     * 
     * @todo 异步获取分页
     *
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => ''
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_bbstopic_model->getTopicCount($search);
        $list = $this->admin_bbstopic_model->getTopicList($search);
        $url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        if (!empty($list)) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 添加话题
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'imageurl' => $_data['imageurl'],
                'forum_one' => $_data['forum_one'],
                'forum_onename' => '',
                'forum_two' => $_data['forum_two'],
                'forum_twoname' => '',
                'content' => $_data['content'],
                'uid' => 0,
                'addtime' => date('Y-m-d H:i:s', time()),
                'tagid' => $_data['tags'],
                'is_del' => 0
            );
            if ($data['forum_one'] > 0) {
                $forum_one = $this->comm_model->getModInfoById($data['forum_one']);
                if (!empty($forum_one)) {
                    $data['forum_onename'] = $forum_one->title;
                }
            }
            if ($data['forum_two'] > 0) {
                $forum_two = $this->comm_model->getModInfoById($data['forum_two']);
                if (!empty($forum_two)) {
                    $data['forum_twoname'] = $forum_two->title;
                }
            }
            if (count($data['tagid']) > 0) {
                $data['tagid'] = implode(',', $data['tagid']);
                $tags = $this->comm_model->getTageInfoByArea($data['tagid']);
                if (!empty($tags)) {
                    $data['tags'] = '';
                    $spile = '';
                    foreach ($tags as $k => $v) {
                        $data['tags'].=$spile . $v->tagname;
                        $spile = ',';
                    }
                }
            }
            if ($data['title'] != '' && $data['content'] != '') {
                $id = $this->admin_bbstopic_model->saveTopicData($data);
                if ($id > 0) {
                    $this->comm_model->addModTopic($data['forum_two']);
                    $msg['flag'] = 1;
                    $msg['error'] = lang('add_sucess');
                } else {
                    $msg['error'] = lang('error_unknow');
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $data['mod'] = $this->comm_model->getModListByPid(0);
            $data['tag'] = $this->comm_model->getTagList();
            $this->load->view('backend/bbstopic/add', $data);
        }
    }

    /**
     *
     * @todo 载入修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            $id = $_data['topic_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_data['title'],
                    'imageurl' => $_data['imageurl'],
                    'forum_one' => $_data['forum_one'],
                    'forum_onename' => '',
                    'forum_two' => $_data['forum_two'],
                    'forum_twoname' => '',
                    'content' => $_data['content'],
                    'tagid' => $_data['tags'],
                    'is_del' => $_data['is_del'],
                );
                if ($data['forum_one'] > 0) {
                    $forum_one = $this->comm_model->getModInfoById($data['forum_one']);
                    if (!empty($forum_one)) {
                        $data['forum_onename'] = $forum_one->title;
                    }
                }
                if ($data['forum_two'] > 0) {
                    $forum_two = $this->comm_model->getModInfoById($data['forum_two']);
                    if (!empty($forum_two)) {
                        $data['forum_twoname'] = $forum_two->title;
                    }
                }
                if (count($data['tagid']) > 0) {
                    $data['tagid'] = implode(',', $data['tagid']);
                    $tags = $this->comm_model->getTageInfoByArea($data['tagid']);
                    if (!empty($tags)) {
                        $data['tags'] = '';
                        $spile = '';
                        foreach ($tags as $k => $v) {
                            $data['tags'].=$spile . $v->tagname;
                            $spile = ',';
                        }
                    }
                }
                if ($data['title'] != '' && $data['content'] != '') {
                    if ($this->admin_bbstopic_model->editTopicData($data, $id)) {
                        $msg['flag'] = 1;
                        $msg['error'] = lang('edit_sucess');
                    } else {
                        $msg['error'] = lang('error_unknow');
                    }
                } else {
                    $msg['error'] = lang('error_requer');
                }
            } else {
                $msg['error'] = lang('error_params');
            }
            echo json_encode($msg);
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['topic'] = $this->admin_bbstopic_model->getTopicInfoById($id);
                $data['mod'] = $this->comm_model->getModListByPid(0);
                $data['mod_two'] = $this->comm_model->getModListByPid($data['topic']->forum_one);
                $data['tag'] = $this->comm_model->getTagList();
                $this->load->view('backend/bbstopic/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_bbstopic');
            }
        }
    }

    /**
     *
     * @todo 删除话题
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_del' => 1
            );
            if ($this->admin_bbstopic_model->editTopicData($data, $id)) {
                redirect('/admin_bbstopic');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_bbstopic');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_bbstopic');
        }
    }

}

?>
