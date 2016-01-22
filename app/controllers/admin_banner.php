<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_banner
 *
 * @createtime 2014-10-22 12:05:41
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_banner extends Admin_Controller {

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
        $this->load->model('admin_banner_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_banner');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 广告列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $data['count'] = $this->admin_banner_model->getAdCountBySearch($search);
        $list = $this->admin_banner_model->getAdListBySearch($search);
        $data['url'] = $this->pageurl->getPage($data['count'], $this->pagesize, 1);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $img = explode('.', $v->imageurl);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $list[$k]->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $list[$k]->imageurl_thumb = '';
                }
            }
        }
        $data['list']=$list;
        $this->load->view('backend/banner/index', $data);
    }

    /**
     *
     * @todo 添加广告
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
                'color' => $_postData['color'],
                'sult' => $_postData['sult'],
                'type' => $_postData['type']
            );
            if ($data['title'] != '' && $data['imageurl'] != '' && $data['type'] !== 0) {
                $id = $this->admin_banner_model->saveAdData($data);
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
            $data['bannertype'] = $this->comm_model->getBannerType();
            $this->load->view('backend/banner/add', $data);
        }
    }

    /**
     *
     * @todo 修改广告信息
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_postData = $this->input->post();
            $id = $_postData['banner_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_postData['title'],
                    'imageurl' => $_postData['imageurl'],
                    'link' => $_postData['link'],
                    'color' => $_postData['color'],
                    'sult' => $_postData['sult'],
                    'type' => $_postData['type']
                );
                if ($data['title'] != '' && $data['imageurl'] != '' && $data['type'] !== 0) {

                    if ($this->admin_banner_model->saveAdDataEdit($data, $id)) {
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
                $data['banner'] = $this->admin_banner_model->getAdInfoById($id);
                $img = explode('.', $data['banner']->imageurl);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $data['banner']->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $data['banner']->imageurl_thumb = '';
                }
                $data['bannertype'] = $this->comm_model->getBannerType();
                $this->load->view('backend/banner/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_banner');
            }
        }
    }

    /**
     *
     * @todo 删除广告信息
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            if ($this->admin_banner_model->delAdById($id)) {
                redirect('/admin_banner');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_banner');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_banner');
        }
    }

}

?>
