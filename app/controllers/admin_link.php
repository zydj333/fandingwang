<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_link
 *
 * @createtime 2014-10-22 16:21:06
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_link extends Admin_Controller {

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
        $this->load->model('admin_link_model');
        $this->lang->load('admin_link');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 载入列表
     *
     */
    public function index() {
        $list = $this->admin_link_model->getFriendLinkList();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                if ($v->imageurl != '') {
                    $items = explode(".", $v->imageurl);
                    $name = isset($items[0]) ? $items[0] : '';
                    $profix = isset($items[1]) ? $items[1] : '';
                    $list[$k]->imageurl_thumb = $name . "_small." . $profix;
                } else {
                    $list[$k]->imageurl_thumb = '';
                }
            }
        }
        $data['list'] = $list;
        $this->load->view('backend/link/index', $data);
    }

    /**
     *
     * @todo 新增友链
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_postData = $this->input->post();
            $data = array(
                'title' => $_postData['title'],
                'imageurl' => $_postData['imageurl'],
                'link' => $_postData['link'],
                'salt' => $_postData['salt']
            );
            if ($data['title'] != '') {
                $id = $this->admin_link_model->saveFriendLink($data);
                if ($id > 0) {
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
            $this->load->view('backend/link/add');
        }
    }

    /**
     *
     * @todo 加载修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_postData = $this->input->post();
            $id = $_postData['link_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_postData['title'],
                    'imageurl' => $_postData['imageurl'],
                    'link' => $_postData['link'],
                    'salt' => $_postData['salt']
                );
                if ($data['title'] != '') {
                    if ($this->admin_link_model->editFriendLinkById($data, $id)) {
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
                $data['link'] = $this->admin_link_model->getFriendInfoById($id);
                $img = explode('.', $data['link']->imageurl);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $data['link']->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $data['link']->imageurl_thumb = '';
                }
                $this->load->view('backend/link/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_link');
            }
        }
    }

    /**
     *
     * @todo 删除
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            if ($this->admin_link_model->delFriendLinkById($id)) {
                redirect('/admin_link');
            } else {
                $this->messageError(lang('error_params'), 'error_unknow');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_link');
        }
    }

}

?>
