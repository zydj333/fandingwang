<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_activity
 *
 * @createtime 2014-10-23 19:04:35
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_activity extends Admin_Controller {

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
        $this->load->model('admin_activity_model');
        $this->load->model('admin_activitytype_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_activity');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 获取活动列表
     *
     */
    public function index() {
        $search = array();
        $list = $this->admin_activity_model->getActivityList($search);
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
        $data['list'] = $list;
        $data['type'] = $this->admin_activitytype_model->getActivityTypeList();
        $this->load->view('backend/activity/index', $data);
    }

    /**
     *
     * @todo 添加活动
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
                'dealtime' => $_data['dealtime'],
                'province' => $_data['province'],
                'city' => $_data['city'],
                'type' => $_data['type'],
                'address' => $_data['address'],
                'imageurl' => $_data['imageurl'],
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription'],
                'salt' => $_data['salt'],
                'adder' => $this->user_name,
                'status'=>$_data['status']
            );
            if ($data['title'] != '' && $data['dealtime'] != '' && $data['content'] != '') {
                $id = $this->admin_activity_model->saveActivityData($data);
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
            $data['type'] = $this->admin_activitytype_model->getActivityTypeList();
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $this->load->view('backend/activity/add', $data);
        }
    }

    /**
     *
     * @todo 修改活动
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            $id = $_data['activity_id'];
            if ($id > 0) {
                $data = array(
                    'title' => $_data['title'],
                    'dealtime' => $_data['dealtime'],
                    'province' => $_data['province'],
                    'city' => $_data['city'],
                    'type' => $_data['type'],
                    'address' => $_data['address'],
                    'imageurl' => $_data['imageurl'],
                    'discription' => $_data['discription'],
                    'content' => $_data['content'],
                    'seo_title' => $_data['seo_title'],
                    'seo_keyword' => $_data['seo_keyword'],
                    'seo_discription' => $_data['seo_discription'],
                    'salt' => $_data['salt'],
                    'adder' => $this->user_name,
                    'status'=>$_data['status']
                );
                if ($data['title'] != '' && $data['dealtime'] != '' && $data['content'] != '') {
                    if ($this->admin_activity_model->editActivityData($data, $id)) {
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
                $info = $this->admin_activity_model->getActivityInfo($id);
                $img = explode('.', $info->imageurl);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $info->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $info->imageurl_thumb = '';
                }
                $data['info'] = $info;
                $data['type'] = $this->admin_activitytype_model->getActivityTypeList();
                $data['province'] = $this->comm_model->getAreaListByPid(0);
                $data['city'] = $this->comm_model->getAreaListByPid($info->province);
                $this->load->view('backend/activity/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_activity');
            }
        }
    }

    /**
     *
     * @todo 删除活动信息
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data=array('is_del'=>1);
            if ($this->admin_activity_model->editActivityData($data, $id)) {
                redirect('/admin_activity');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_activity');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_activity');
        }
    }

}

?>
