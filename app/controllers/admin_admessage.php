<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_admessage
 *
 * @createtime 2015-3-18 10:43:39
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_admessage extends Admin_Controller {

    private $user_id = 0;
    private $user_name = "AMAN";
    private $now_time = 0;
    private $pagesize = 10;
    private $now_date = '';

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_admessage_model');
        $this->load->model('comm_model');
        $this->lang->load('admin_admessage');
        $this->load->library('pageurl');
        $this->user_id = $this->comm->get_session('user_id');
        $this->user_name = $this->comm->get_session('username');
        $this->now_time = time();
        $this->now_date = date('Y-m-d H:i:s', time());
    }

    /**
     * 
     * @todo 载入广告短信列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_admessage_model->getAdmessageCount($search);
        $data['pageurl'] = $this->pageurl->getPage($count, $this->pagesize, 1);
        $list = $this->admin_admessage_model->getAdmessageList($search);
        if (!empty($list)) {
            $data['list'] = $list;
        }
        $this->load->view('backend/admessage/index', $data);
    }

    /**
     * 
     * @todo 异步列表 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $cellphone = $this->input->post('cellphone');
        $status = $this->input->post('status');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($cellphone != '') {
            $search['cellphone'] = $cellphone;
        }
        if ($status > -1) {
            $search['status'] = $status;
        }
        $count = $this->admin_admessage_model->getAdmessageCount($search);
        $page_url = $this->pageurl->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_admessage_model->getAdmessageList($search);
        if (!empty($list)) {
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
     * @todo 添加系统广告邮件 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $msg = array('flag' => 0, 'error' => '');
            if ($_data['user_name'] != '' && $_data['content'] != '') {
                if ($_data['user_name'] != 'all') {
                    $msg['flag'] = 1;
                    $msg['success'] = 0;
                    $msg['failed'] = 0;
                    $user = explode(',', $_data['user_name']);
                    $member = new stdClass();
                    foreach ($user as $key => $value) {
                        if ($this->comm->checkPhone($value)) {
                            $member->id = 0;
                            $member->account = $value;
                            $member->telphone = $value;
                            if ($this->addNewMessage($member, $_data['content'])) {
                                $msg['success'] ++;
                            } else {
                                $msg['failed'] ++;
                            }
                        } else {
                            $msg['failed'] ++;
                        }
                    }
                    //echo json_encode($user);exit;
                } else {
                    $member = $this->admin_admessage_model->getAllUserList();
                    if (!empty($member)) {
                        $result = $this->foreachMemberObject($member, $_data['content']);
                        $msg['flag'] = 1;
                        $msg['success'] = $result['success'];
                        $msg['failed'] = $result['failed'];
                    } else {
                        $msg['error'] = lang('get_start_array_filed');
                    }
                }
            } else {
                $msg['error'] = lang('error_requer');
            }
            echo json_encode($msg);
        } else {
            $this->load->view('backend/admessage/add');
        }
    }

    /**
     * 
     * @todo 循环用户数组信息
     * 
     */
    public function foreachMemberObject($obj, $content) {
        $row = array('success' => 0, 'failed' => 0);
        foreach ($obj as $key => $value) {
            if ($this->addNewMessage($value, $content)) {
                $row['success'] ++;
            } else {
                $row['failed'] ++;
            }
        }
        return $row;
    }

    /**
     * 
     * @todo 新增短信记录 
     * 
     */
    public function addNewMessage($obj, $content) {
        $data = array(
            'user_id' => $obj->id,
            'user_name' => $obj->account,
            'cellphone' => $obj->telphone,
            'content' => $content,
            'status' => 0,
            'trytimes' => 0,
            'creattime' => $this->now_date,
            'sendtime' => "0000-00-00 00:00:00"
        );
        if ($this->admin_admessage_model->checkMessageIsDefind($data)) {
            $id = $this->admin_admessage_model->saveMessageData($data);
            if ($id > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 重置短信 
     * 
     */
    public function reset() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->messageError(lang('error_params'), 'admin_admessage');
        }
        $data = array(
            'status' => 0,
            'trytimes' => 0
        );
        if ($this->admin_admessage_model->editMessageById($data, $id)) {
            redirect('/admin_admessage/index');
        } else {
            $this->messageError(lang('error_unknow'), 'admin_admessage/index');
        }
    }

    /**
     * 
     *  @todo 删除短信信息
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            $this->messageError(lang('error_params'), 'admin_admessage');
        }
        if ($this->admin_admessage_model->delMessageCodeById($id)) {
            redirect('/admin_admessage/index');
        } else {
            $this->messageError(lang('error_unknow'), 'admin_admessage/index');
        }
    }

}

?>
