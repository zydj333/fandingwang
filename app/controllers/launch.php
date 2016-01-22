<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of launch
 *
 * @createtime 2015-4-9 9:22:55
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 * @description 发起众筹
 *
 */
class launch extends Frontend_Controller {

//put your code here
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->load->model('launch_model');
        $this->load->model('usercenter_model');
        $this->user = $this->userinfo();
        $this->comm->checkUserlogin();
    }

    /**
     * 
     * @todo 载入发起众筹 
     * 
     */
    public function index() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $header['user'] = $user;
        $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
        $data['type'] = $this->launch_model->getProjectTypeList();
        $data['province'] = $this->comm_model->getAreaListByPid(0);
        $this->load->view('frontend/public/header', $header);
        $this->load->view('frontend/launch/index', $data);
        $this->load->view('frontend/public/footer');
    }

    /**
     * 
     * @todo 保存第一步信息 
     * 
     */
    public function saveStepOne() {
        $user = $this->user;
        $_data = $this->input->post();
        $data = array(
            'uid' => $user['user_id'],
            'title' => $_data['title'],
            'amount' => $_data['amount'],
            'days' => $_data['days'],
            'type' => $_data['type'],
            'type_name' => '',
            'slogan' => $_data['slogan'],
            'user_name' => $_data['username'],
            'cellphone' => $_data['cellphone'],
            'idnumber' => $_data['idnumber'],
            'province' => $_data['province'],
            'province_name' => '',
            'city' => $_data['city'],
            'city_name' => "",
            'address' => $_data['address'],
            'addtime' => time()
        );
        if ($data['type'] > 0) {
            $type = $this->comm_model->getProjectType($data['type']);
            $data['type_name'] = $type->title;
        }
        if ($data['province'] > 0) {
            $province = $this->comm_model->getAreaInfoById($data['province']);
            $data['province_name'] = $province->name;
        }
        if ($data['city'] > 0) {
            $city = $this->comm_model->getAreaInfoById($data['city']);
            $data['city_name'] = $city->name;
        }
        $id = $this->launch_model->addProduct($data);
        if ($id > 0) {
            redirect('/launch/steptwo/' . $id);
        } else {
            redirect('/launch');
        }
    }

    /**
     * 
     * @todo 检查添加的信息是否合法 
     * 
     */
    public function checkStepOne() {
        $user = $this->user;
        $_data = $this->input->post();
        $data = array(
            'uid' => $user['user_id'],
            'title' => $_data['title'],
            'amount' => $_data['amount'],
            'days' => $_data['days'],
            'type' => $_data['type'],
            'type_name' => '',
            'slogan' => $_data['slogan'],
            'user_name' => $_data['username'],
            'cellphone' => $_data['cellphone'],
            'idnumber' => $_data['idnumber'],
            'province' => $_data['province'],
            'province_name' => '',
            'city' => $_data['city'],
            'city_name' => "",
            'address' => $_data['address'],
            'addtime' => time()
        );
        $p_id = $_data['product_id'] ? $_data['product_id'] : 0;
        $msg = array('flag' => 0, 'error' => '');
        if ($data['title'] != '' && $data['amount'] != '' && $data['cellphone'] != '' && $data['user_name'] != '' && $data['address'] != '') {
            if ($p_id == 0) {
                if ($this->comm->checkPhone($data['cellphone'])) {
                    if ($this->launch_model->checkProductIsDefind($data)) {
                        $msg['error'] = "数据已经存在,请到您的个人后台进行更改!";
                    } else {
                        $msg['flag'] = 1;
                        $msg['error'] = '数据可以添加！';
                    }
                } else {
                    $msg['error'] = "手机号码不合法!";
                }
            } else {
                $msg['flag'] = 1;
                $msg['error'] = '可以保存！';
            }
        } else {
            $msg['error'] = "信息没有填写完整!";
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 载入第一步修改 
     * 
     */
    public function editStepOne() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
        if (empty($pro)) {
            $this->showErrorNotFond();
        } else {
            $header['user'] = $user;
            $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
            $data['type'] = $this->launch_model->getProjectTypeList();
            $data['province'] = $this->comm_model->getAreaListByPid(0);
            if ($pro->province > 0) {
                $data['city'] = $this->comm_model->getAreaListByPid($pro->province);
            }
            $data['pro'] = $pro;
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/launch/indexEdit', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 保存修改第一步 
     * 
     */
    public function saveEditStepOne() {
        $user = $this->user;
        $_data = $this->input->post();
        $p_id = $_data['product_id'] ? $_data['product_id'] : 0;
        if ($p_id > 0) {
            $data = array(
                'uid' => $user['user_id'],
                'title' => $_data['title'],
                'amount' => $_data['amount'],
                'days' => $_data['days'],
                'type' => $_data['type'],
                'type_name' => '',
                'slogan' => $_data['slogan'],
                'user_name' => $_data['username'],
                'cellphone' => $_data['cellphone'],
                'idnumber' => $_data['idnumber'],
                'province' => $_data['province'],
                'province_name' => '',
                'city' => $_data['city'],
                'city_name' => "",
                'address' => $_data['address']
            );
            if ($data['type'] > 0) {
                $type = $this->comm_model->getProjectType($data['type']);
                $data['type_name'] = $type->title;
            }
            if ($data['province'] > 0) {
                $province = $this->comm_model->getAreaInfoById($data['province']);
                $data['province_name'] = $province->name;
            }
            if ($data['city'] > 0) {
                $city = $this->comm_model->getAreaInfoById($data['city']);
                $data['city_name'] = $city->name;
            }
            if ($this->launch_model->editProduct($data, $p_id)) {
                redirect('/launch/steptwo/' . $p_id);
            } else {
                redirect('/launch');
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     * 
     * @todo  载入发起众筹第二步
     * 
     */
    public function steptwo() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
        if (empty($pro)) {
            $this->showErrorNotFond();
        } else {
            $data['feed'] = $this->launch_model->getProductFeedList($pid);
            $header['user'] = $user;
            $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
            $data['pro'] = $pro;
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/launch/steptwo', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 进行第二步保存操作 
     * 
     */
    public function saveStepTwo() {
        $p_id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $content = $this->input->post('content');
        if ($p_id == 0) {
            $this->showErrorNotFond();
        } else {
            $data = array(
                'content' => $content
            );
            if ($this->launch_model->editProduct($data, $p_id)) {
                redirect('/launch/stepthree/' . $p_id);
            } else {
                redirect('/launch');
            }
        }
    }

    /**
     * 
     * @todo 载入项目动态添加 
     * 
     */
    public function productFeed() {
        $p_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($p_id == 0) {
            echo '参数丢失，加载失败！';
            exit;
        }
        $data['p_id'] = $p_id;
        $this->load->view('frontend/launch/feed', $data);
    }

    /**
     * 
     * @todo 保存动态 
     * 
     */
    public function saveFeed() {
        $pid = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $content = $this->input->post('content');
        $msg = array('flag' => 0, 'error' => '');
        if ($pid == 0) {
            $msg['error'] = "参数丢失，保存失败！";
            echo json_encode($msg);
            exit;
        }
        if ($content == '') {
            $msg['error'] = "保存失败，内容不可以为空！";
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'pid' => $pid,
            'content' => $content,
            'addtime' => time()
        );
        $f_id = $this->launch_model->addProductFeed($data);
        if ($f_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "保存成功！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存失败，错误未知！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 发起众筹第三步 
     * 
     */
    public function stepthree() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $header['user'] = $user;
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
        if (empty($pro)) {
            $this->showErrorNotFond();
        } else {
            $data['pro'] = $pro;
            $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/launch/stepthree', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 保存第三步 
     * 
     */
    public function saveStepThree() {
        $this->load->library('get_vedio');
        $p_id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $banner = $this->input->post('image_url');
        $source_video = $this->input->post('source_video');
        if ($p_id == 0) {
            $this->showErrorNotFond();
        } else {
            $data = array(
                'banner' => trim($banner),
                'source_video' => trim($source_video),
                'video_url' => trim($source_video) ? $this->get_vedio->fetch_vedio_url(trim($source_video)) : '',
            );
            if ($this->launch_model->editProduct($data, $p_id)) {
                redirect('/launch/stepfour/' . $p_id);
            } else {
                redirect('/launch');
            }
        }
    }

    /**
     * 
     * @todo 发起众筹第四步 
     * 
     */
    public function stepfour() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $header['user'] = $user;
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
        if (empty($pro)) {
            $this->showErrorNotFond();
        } else {
            // 获取项目子项列表
            $data['items'] = $this->launch_model->getProductItemsList($pid);
            $data['pro'] = $pro;
            $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/launch/stepfour', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 保存第四步 
     * 
     */
    public function saveStepFour() {
        $_data = $this->input->post();
        $data = array(
            'pid' => $_data['product_id'],
            'price' => $_data['price'],
            'title' => $_data['title'],
            'discription' => $_data['discription'],
            'total' => $_data['total'],
            'addtime' => time()
        );
        if ($data['pid'] > 0) {
            $items_id = $this->launch_model->saveProductItemsData($data);
            if ($items_id > 0) {
                redirect('/launch/stepfour/' . $data['pid']);
            } else {
                $this->showErrorNotFond();
            }
        } else {
            $this->showErrorNotFond();
        }
    }

    /**
     * 
     * @todo 发起众筹第五步 
     * 
     */
    public function stepfive() {
        $header = array(
            'title' => "泛丁网",
            'keywords' => "",
            'description' => "",
            'cusor' => 'launch'
        );
        $user = $this->user;
        $header['user'] = $user;
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
        if (empty($pro)) {
            $this->showErrorNotFond();
        } else {
            // 获取项目子项列表
            $data['items'] = $this->launch_model->getProductItemsList($pid);
            $data['pro'] = $pro;
            $data['member'] = $this->usercenter_model->getUserIdByUid($user['user_id']);
            $this->load->view('frontend/public/header', $header);
            $this->load->view('frontend/launch/stepfive', $data);
            $this->load->view('frontend/public/footer');
        }
    }

    /**
     * 
     * @todo 确认提交信息 
     * 
     */
    public function saveMyProjectToSystem() {
        
        $pid = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $user = $this->user;
        $msg = array('flag' => 0, 'error' => '');
        if ($pid == 0) {
            $msg['error'] = '参数丢失，提交审核失败!请稍后重试';
        } else {
            $this->db->trans_begin();
            //获取产品信息
            $pro = $this->launch_model->checkUserProduct($user['user_id'], $pid);
            //获取项目动态
            $feed = $this->launch_model->getProductFeedList($pid);
            //获取项目子项
            $items = $this->launch_model->getProductItemsList($pid);
            if (!empty($pro)) {
                $project_id = $this->saveProjectToSystem($pro,$feed,$items);
                if ($project_id > 0) {
                    //修改临时数据状态
                    $step = array(
                        'is_submit' => 1
                    );
                    $this->launch_model->editProduct($step, $pid);
                    //保存动态
                    if (!empty($feed)) {
                        foreach ($feed as $feed_key => $feed_value) {
                            $this->saveProjectFeedToSystem($feed_value, $project_id);
                        }
                    }
                    //保存项目子项
                    if (!empty($items)) {
                        foreach ($items as $items_key => $items_value) {
                            $this->saveProjectItemsToSystem($items_value, $project_id);
                        }
                    }
                    //发送邮件通知
                    $this->comm_model->saveLaunchEmail($pro->uid,$pro->user_name,$pro->cellphone,$pro->title,$pro->content,$pro->addtime);
                    $this->db->trans_commit();
                    $msg['flag'] = 1;
                    $msg['error'] = '您的信息已经提交成功，请等待我们后台审核!';
                } else {
                    $this->db->trans_rollback();
                    $msg['error'] = '提交失败!';
                }
            } else {
                $this->db->trans_rollback();
                $msg['error'] = '获取初始数据失败！';
            }
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 保存临时数据到正式项目列表 
     * 
     * @param object $pro 产品临时信息
     * 
     * @return int 返回一个int类型的整数
     * 
     */
    public function saveProjectToSystem($pro,$feed,$items) {
        $data = array(
            'title' => $pro->title,
            'title_salt' => $pro->slogan,
            'product_type' => $pro->type,
            'province' => $pro->province,
            'city' => $pro->city,
            'type_name' => $pro->type_name,
            'province_name' => $pro->province_name,
            'city_name' => $pro->city_name,
            'banner' => $pro->banner,
            'image_url' => '',
            'video' => $pro->source_video,
            'source_video' => $pro->video_url,
            'amount' => $pro->amount,
            'support_amount' => 0,
            'support_times' => 0,
            'views' => 0,
            'starttime' => 0,
            'endtime' => 0,
            'days' => $pro->days,
            'user_id' => $pro->uid,
            'discription' => $pro->slogan,
            'content' => $pro->content,
            'product_loading' => count($feed),
            'repay' => 0,
            'seo_title' => $pro->title,
            'seo_keyword' => $pro->title,
            'seo_discription' => $pro->title,
            'addtime' => date('Y-m-d H:i:s', $pro->addtime),
            'is_effect' => 0,
            'is_rem' => 0,
            'salt' => 0,
            'temp_id' => $pro->id,
            'is_del' => 0
        );

        //保存提交信息
        $project_id = $this->launch_model->saveMyProjectToSystem($data);
        if ($project_id > 0) {
            return $project_id;
        } else {
            return 0;
        }
    }

    /**
     * 
     * 
     * @todo 保存项目动态
     * 
     * @param object $feed 项目动态信息
     * 
     * @param int $project_id 项目ID
     * 
     * @return boolean 返回一个真假类型的结果 
     * 
     */
    public function saveProjectFeedToSystem($feed, $project_id) {
        $data = array(
            'pid' => $project_id,
            'feed' => $feed->content,
            'addtime' => $feed->addtime,
        );
        $feed_id = $this->launch_model->saveMyProjectFeedToSystem($data, $project_id);
        if ($feed_id > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 保存项目子项
     * 
     * @param object $items 项目子项信息
     * 
     * @param int $project_id 项目子项ID
     * 
     * @return boolean 返回一个布林 
     * 
     */
    public function saveProjectItemsToSystem($items, $project_id) {
        $data = array(
            'pid' => $project_id,
            'price' => $items->price,
            'total' => $items->total,
            'sell_total' => 0,
            'image_url' => '',
            'free_mail' => 2,
            'mail_fee' => 0.00,
            'title' => $items->title,
            'replay' => $items->discription
        );
        $items_id = $this->launch_model->saveMyprojectItemsToSystem($data);
        if ($items_id > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
