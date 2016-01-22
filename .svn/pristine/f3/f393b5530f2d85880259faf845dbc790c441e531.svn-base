<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_project
 *
 * @createtime 2014-10-24 14:15:36
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_project extends Admin_Controller {

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
        $this->load->model('admin_project_model');
        $this->load->model('admin_projecttype_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_project');
        $this->load->library('pageurl');
        $this->load->library('get_vedio');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
    }

    /**
     *
     * @todo 载入项目列表
     *
     */
    public function index() {
        $search = array(
            'is_del' => 0,
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_project_model->getProjectCount($search);
        $list = $this->admin_project_model->getProjectList($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $img = explode('.', $v->project_image);
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
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/project/index', $data);
    }

    /**
     *
     * @todo 异步获取项目列表
     *
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $project_name = $this->input->post('project_name');
        $project_type = $this->input->post('project_type');
        $is_success = $this->input->post('is_success');
        $is_effect = $this->input->post('is_effect');
        $is_del = $this->input->post('is_del') ? $this->input->post('is_del') : 0;
        $search = array(
            'is_del' => $is_del,
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        if ($project_name != '') {
            $search['project_name'] = $project_name;
        }
        if ($project_type != -1) {
            $search['project_type'] = $project_type;
        }
        if ($is_success != -1) {
            $search['is_success'] = $is_success;
        }
        if ($is_effect === 0) {
            $search['is_effect'] = $is_effect;
        }
        $count = $this->admin_project_model->getProjectCount($search);
        $list = $this->admin_project_model->getProjectList($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $img = explode('.', $v->project_image);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $list[$k]->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $list[$k]->imageurl_thumb = '';
                }
            }
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $page_url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }

    /**
     *
     * @todo 添加项目
     *
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'uid' => '',
                'username' => '',
                'usertype' => '',
                'project_name' => $_data['project_name'],
                'project_type' => $_data['project_type'],
                'province' => $_data['province'],
                'province_name' => '',
                'city' => $_data['city'],
                'city_name' => '',
                'founding_time' => $_data['founding_time'],
                'scale' => $_data['scale'],
                'project_tag' => $_data['project_tag'],
                'project_stage' => $_data['project_stage'],
                'project_other' => $_data['project_other'],
                'company_name' => $_data['company_name'],
                'company_address' => $_data['company_address'],
                'project_image' => $_data['project_image'],
                'project_videosource' => $_data['project_videosource'],
                'project_video' => $_data['project_videosource'] ? $this->get_vedio->fetch_vedio_url($_data['project_videosource']) : '',
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'amount' => $_data['amount'],
                'share'=> $_data['share'],
                'is_effect' => $_data['is_effect'],
                'is_recomment' => $_data['is_recomment'],
                'is_classic' => $_data['is_classic'],
                'days' => $_data['days'],
                'start_time' => $_data['start_time'],
                'end_time' => $_data['end_time'],
                'salt' => $_data['salt'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription']
            );
            if ($data['project_name'] != '') {
                //检查用户
                if ($_data['uid'] > 0) {
                    $user = $this->comm_model->getMemberByUid($_data['uid']);
                    if (!empty($user)) {
                        $data['uid'] = $_data['uid'];
                        $data['username'] = $user->username ? $user->username : $user->account;
                        $data['usertype'] = 'site';
                    } else {
                        $data['uid'] = $this->user_id;
                        $data['username'] = $this->user_name;
                        $data['usertype'] = 'admin';
                    }
                } else {
                    $data['uid'] = $this->user_id;
                    $data['username'] = $this->user_name;
                    $data['usertype'] = 'admin';
                }
                //结束时间
                $data['end_time'] = date("Y-m-d H:i:s", strtotime($data['start_time']) + intval($data['days']) * 24 * 3600);
                //省份名称
                if ($data['province'] > 0) {
                    $pro = $this->comm_model->getAreaInfoById($data['province']);
                    $data['province_name'] = $pro->name;
                }
                //城市名称
                if ($data['city'] > 0) {
                    $pro = $this->comm_model->getAreaInfoById($data['city']);
                    $data['city_name'] = $pro->name;
                }
                if ($this->admin_project_model->saveProjectData($data)) {
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
            $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            $this->load->view('backend/project/add', $data);
        }
    }

    /**
     *
     * @todo 载入修改
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $id = $_data['project_id'];
            if ($id > 0) {
                $data = array(
                    'uid' => '',
                    'username' => '',
                    'usertype' => '',
                    'project_name' => $_data['project_name'],
                    'project_type' => $_data['project_type'],
                    'province' => $_data['province'],
                    'province_name' => '',
                    'city' => $_data['city'],
                    'city_name' => '',
                    'founding_time' => $_data['founding_time'],
                    'scale' => $_data['scale'],
                    'project_tag' => $_data['project_tag'],
                    'project_stage' => $_data['project_stage'],
                    'project_other' => $_data['project_other'],
                    'company_name' => $_data['company_name'],
                    'company_address' => $_data['company_address'],
                    'project_image' => $_data['project_image'],
                    'project_videosource' => $_data['project_videosource'],
                    'project_video' => $_data['project_videosource'] ? $this->get_vedio->fetch_vedio_url($_data['project_videosource']) : '',
                    'discription' => $_data['discription'],
                    'content' => $_data['content'],
                    'amount' => $_data['amount'],
                    'share'=> $_data['share'],
                    'is_effect' => $_data['is_effect'],
                    'is_recomment' => $_data['is_recomment'],
                    'is_classic' => $_data['is_classic'],
                    'days' => $_data['days'],
                    'start_time' => $_data['start_time'],
                    'end_time' => $_data['end_time'],
                    'salt' => $_data['salt'],
                    'seo_title' => $_data['seo_title'],
                    'seo_keyword' => $_data['seo_keyword'],
                    'seo_discription' => $_data['seo_discription']
                );
                if ($data['project_name'] != '') {
                    //检查用户
                    if ($_data['uid'] > 0) {
                        $user = $this->comm_model->getMemberByUid($_data['uid']);
                        if (!empty($user)) {
                            $data['uid'] = $_data['uid'];
                            $data['username'] = $user->username ? $user->username : $user->account;
                            $data['usertype'] = 'site';
                        } else {
                            $data['uid'] = $this->user_id;
                            $data['username'] = $this->user_name;
                            $data['usertype'] = 'admin';
                        }
                    } else {
                        $data['uid'] = $this->user_id;
                        $data['username'] = $this->user_name;
                        $data['usertype'] = 'admin';
                    }
                    //结束时间
                    $data['end_time'] = date("Y-m-d H:i:s", strtotime($data['start_time']) + intval($data['days']) * 24 * 3600);
                    //省份名称
                    if ($data['province'] > 0) {
                        $pro = $this->comm_model->getAreaInfoById($data['province']);
                        $data['province_name'] = $pro->name;
                    }
                    //城市名称
                    if ($data['city'] > 0) {
                        $pro = $this->comm_model->getAreaInfoById($data['city']);
                        $data['city_name'] = $pro->name;
                    }
                    if ($this->admin_project_model->saveProjectEdit($id, $data)) {
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
                $project = $this->admin_project_model->getProjectInfoById($id);
                $img = explode('.', $project->project_image);
                $name = isset($img[0]) ? $img[0] : '';
                $suffix = isset($img[1]) ? $img[1] : '';
                if ($name != '' && $suffix != '') {
                    $project->imageurl_thumb = $name . '_small.' . $suffix;
                } else {
                    $project->imageurl_thumb = '';
                }
                $data['project'] = $project;
                $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
                $data['province'] = $this->comm_model->getAreaListByPid(0);
                $data['city'] = $this->comm_model->getAreaListByPid($project->province);
                $this->load->view('backend/project/edit', $data);
            } else {
                $this->messageError(lang('error_params'), 'admin_project');
            }
        }
    }

    /**
     *
     * @todo 删除操作
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_del' => 1
            );
            if ($this->admin_project_model->saveProjectEdit($id, $data)) {
                redirect('/admin_project');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_project');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_project');
        }
    }

    /**
     *
     * @todo 待审核
     *
     */
    public function waiting() {
        $search = array(
            'is_del' => 0,
            'start' => 0,
            'pagesize' => $this->pagesize,
            'is_effect' => 0
        );
        $count = $this->admin_project_model->getProjectCount($search);
        $list = $this->admin_project_model->getProjectList($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $img = explode('.', $v->project_image);
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
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/project/waiting', $data);
    }

    /**
     *
     * @todo 通过项目
     *
     */
    public function passWaiting() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_effect' => 1
            );
            if ($this->admin_project_model->saveProjectEdit($id, $data)) {
                redirect('/admin_project/waiting');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_project/waiting');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_project/waiting');
        }
    }

    /**
     *
     * @todo 回收站
     *
     */
    public function recycle() {
        $search = array(
            'is_del' => 1,
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_project_model->getProjectCount($search);
        $list = $this->admin_project_model->getProjectList($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $img = explode('.', $v->project_image);
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
        $data['type'] = $this->admin_projecttype_model->getProjectTypeList();
        $this->load->view('backend/project/recycle', $data);
    }

    /**
     *
     * @todo 进行恢复操作
     *
     */
    public function recover() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $data = array(
                'is_del' => 0
            );
            if ($this->admin_project_model->saveProjectEdit($id, $data)) {
                redirect('/admin_project/recycle');
            } else {
                $this->messageError(lang('error_unknow'), 'admin_project/recycle');
            }
        } else {
            $this->messageError(lang('error_params'), 'admin_project/recycle');
        }
    }

}

?>
