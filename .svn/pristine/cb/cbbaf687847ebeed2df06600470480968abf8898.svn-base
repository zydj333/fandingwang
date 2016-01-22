<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comm
 *
 * @createtime 2014-10-24 9:19:11
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Common extends Frontend_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->lang->load('common');
    }

    /**
     *
     * @todo 获取省份城市
     *
     */
    public function getCity() {
        $msg = array(
            'error' => lang('no_city_list'),
            'flag' => 0
        );
        $pid = $this->input->post('province') ? $this->input->post('province') : 0;
        if ($pid > 0) {
            $city = $this->comm_model->getAreaListByPid($pid);
            if (!empty($city)) {
                $msg['flag'] = 1;
                $msg['error'] = $city;
            }
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 获取二级模块
     *
     */
    public function getMod() {
        $msg = array(
            'error' => lang('no_mod_list'),
            'flag' => 0
        );
        $pid = $this->input->post('mod_one') ? $this->input->post('mod_one') : 0;
        if ($pid > 0) {
            $city = $this->comm_model->getModListByPid($pid);
            if (!empty($city)) {
                $msg['flag'] = 1;
                $msg['error'] = $city;
            }
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 获取用户登录信息 
     * 
     */
    public function getUserLoginSession() {
        $userinfo = $this->userinfo();
        if (empty($userinfo)) {
            $userinfo['user_id'] = 0;
        }
        echo json_encode($userinfo);
    }

    /**
     * 
     * @todo 执行收藏操作 
     * 
     */
    public function collection() {
        $userinfo = $this->userinfo();
        $pid = $this->input->post('pid') ? $this->input->post('pid') : 0;
        $msg = array('flag' => 0, 'error' => '');
        if (!empty($userinfo)) {
            if ($pid > 0) {
                $data = array(
                    'uid' => $userinfo['user_id'],
                    'pid' => $pid,
                    'addtime' => time()
                );
                if ($this->comm_model->checkIsCollect($data)) {
                    $msg['error'] = '收藏失败，该项目你已经收藏过了!';
                } else {
                    $id = $this->comm_model->saveCollect($data);
                    if ($id > 0) {
                        $msg['flag'] = 1;
                        $msg['error'] = '收藏成功!';
                    } else {
                        $msg['error'] = '收藏失败，错误未知!';
                    }
                }
            } else {
                $msg['error'] = '收藏失败，信息传递错误!';
            }
        } else {
            $msg['flag'] = 2;
            $msg['error'] = '收藏前请先登录!';
        }
        echo json_encode($msg);
    }

   

}

?>
