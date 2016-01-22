<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comm_model
 *
 * @createtime 2014-10-22 14:02:15
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Comm_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据设置项获取设置 
     * 
     * @param $type 设置项
     * 
     * @return  返回一个一维对象
     * 
     */
    public function getSettingByType($type) {
        $this->db->where(array('select_title' => $type));
        $query = $this->db->get('ai_setting');
        $row = $query->row();
        if (!empty($row)) {
            return $row->select_values;
        } else {
            return '未设置';
        }
    }

    /**
     *
     * @todo 根据名称获取配置信息
     *
     * @param $typename 配置名称
     *
     * @return 返回一个对象
     *
     */
    public function getSetingByName($typename) {
        $sql = "select * from ai_setting where select_title=?";
        $query = $this->db->query($sql, array($typename));
        return $query->row();
    }

    /**
     *
     * @todo 广告分类列表
     *
     */
    public function getBannerType() {
        return array(
            'banner' => "首页BANNER",
            'news_banner' => "咨询广告",
            'activity' => "活动广告",
            'projects' => "项目广告",
            'bbs' => "社区广告",
        );
    }

    /**
     *
     * @todo 根据 父级ID获取当前地区
     *
     * @param $pid 父级ID
     *
     * @return 返回一个结果集
     *
     */
    public function getAreaListByPid($pid = 0) {
        $this->db->where(array('pid' => $pid));
        $query = $this->db->get('ai_area');
        return $query->result();
    }

    /**
     *
     * @todo 根据地区ID获取地区名称
     *
     * @param $id 地区ID
     *
     * @return 返回一个结果
     *
     */
    public function getAreaInfoById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_area');
        return $query->row();
    }

    /**
     *
     * @todo 获取股权项目分类
     * 
     * @param $id 分类ID
     * 
     * @return 返回一个对象
     *
     */
    public function getProjectType($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_projecttype');
        return $query->row();
    }

    /**
     *
     * @todo 根据用户ID获取用户信息
     *
     * @param $uid 用户ID
     *
     * @return 返回结果集
     *
     */
    public function getMemberByUid($uid) {
        $sql = "select * from ai_member where id=?";
        $query = $this->db->query($sql, array($uid));
        return $query->row();
    }

    /**
     *
     * @todo 修改用户信息
     *
     * @param $data 要修改的数据
     *
     * @param  $uid 要修改的数据ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function editMemberByUid($data, $uid) {
        return $row = $this->db->update('ai_member', $data, array('id' => $uid));
    }

    /**
     *
     * @todo 根据用户ID获取用户详情信息
     *
     * @param $uid 用户ID
     *
     * @return 返回结果集
     *
     */
    public function getMemberInfoByUid($uid) {
        $sql = "select * from bbs_memberinfo where id=?";
        $query = $this->db->query($sql, array($uid));
        return $query->row();
    }

    /**
     *
     * @todo 保存用户详情的修改
     *
     * @param $data 要保存的数据
     *
     * @param $uid 要修改的用户ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editMemberInfo($data, $uid) {
        return $row = $this->db->update('bbs_memberinfo', $data, array('uid' => $uid));
    }

    /**
     *
     * @todo 获取论坛模块列表
     *
     * @param pid 父级ID
     *
     * @return 返回一个对象结果集
     *
     */
    public function getModListByPid($pid = 0) {
        $this->db->where(array('pid' => $pid));
        $query = $this->db->get('bbs_forumtype');
        return $query->result();
    }

    /**
     *
     * @todo 根据ID获取模块信息
     *
     * @param $id 模块ID
     *
     * @return 返回一个对象
     *
     */
    public function getModInfoById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('bbs_forumtype');
        return $query->row();
    }

    /**
     *
     * @todo 获取论坛标签信息
     *
     * @return 返回一个对象结果集
     *
     */
    public function getTagList() {
        $this->db->order_by('salt');
        $query = $this->db->get('bbs_tags');
        return $query->result();
    }

    /**
     *
     * @todo 根据ID获取标签信息
     *
     * @param $id 模块ID
     *
     * @return 返回一个对象
     *
     */
    public function getTagInfoById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('bbs_tags');
        return $query->row();
    }

    /**
     *
     * @todo 活动选择的项目获取标签信息
     *
     * @param $id_arr ID集合
     *
     * @return 返回结果集
     *
     */
    public function getTageInfoByArea($id_arr) {
        $sql = 'select * from bbs_tags where id in(' . $id_arr . ')';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 修改模块的话题数
     *
     * @param $id 话题ID
     *
     */
    public function addModTopic($id) {
        $sql = 'update bbs_forumtype set subject=subject+1 where id=' . $id;
        return $this->db->query($sql);
    }

    /**
     *
     * @todo 修改模块信息
     *
     * @param $id 模块ID
     *
     * @return 返回真假类型的结果
     *
     */
    public function editModById($id) {
        $sql = 'update bbs_forumtype set reply=reply+1 where id=' . $id;
        return $this->db->query($sql);
    }

    /**
     *
     * @todo 获取广告列表
     *
     * @param $type 广告分类
     *
     *  'banner' => "首页BANNER",
     *  'news_banner' => "咨询广告",
     *  'activity' => "活动广告",
     *  'projects' => "项目广告",
     *  'bbs' => "社区广告",
     *
     * @param $limit 查询的条数，偏移量
     *
     * @return 返回一个二维结果集
     *
     */
    public function getAdList($type = "banner", $limit = 5) {
        $this->db->where(array('type' => $type));
        $this->db->order_by('sult');
        $this->db->limit($limit);
        $query = $this->db->get('ai_banner');
        return $query->result();
    }

    /**
     *
     * @todo 根据ID修改邮件状态信息
     *
     * @param $data 修改数据信息
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editEmailQueueStatus($data, $id) {
        return $row = $this->db->update('ai_email_queue', $data, array('id' => $id));
    }

    /**
     *
     * @todo 获取未发送邮件列表
     *
     * @return 返回一个二维数组
     *
     */
    public function getWaitingEmailList() {
        $sql = "select * from ai_email_queue where status=0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     *
     * @todo 保存验证邮箱列表
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveEmailQueue($data) {
        $this->db->insert('ai_email_queue', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 保存用户的手机验证码
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function savePhoneCode($data) {
        $this->db->insert('ai_phonecode', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 保存用户的邮箱验证码
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveEmailCode($data) {
        $this->db->insert('ai_mail_adv', $data);
        return $this->db->insert_id();
    }
    /**
     *
     * @todo 获取所有未发送的手机验证码
     *
     * @return 返回一个二维数组
     *
     */
    public function getPhoneCodeList() {
        $sql = "select * from ai_phonecode where status=0";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 修改手机验证码信息
     *
     * @param $data 要修改的数据
     *
     * @param 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function editPhoneCode($data, $id) {
        return $row = $this->db->update('ai_phonecode', $data, array('id' => $id));
    }

    /**
     *
     * @todo 验证码数字，状态获取验证码信息
     *
     * @param $code 验证码
     *
     * @param $status 验证码状态
     *
     * @return 返回一个一维对象
     *
     */
    public function getPhoneCodeBySearch($code, $phone, $status = 1) {
        $sql = "select * from ai_phonecode where  phonecode=? and phonenumber=? and (status=0 or status=1)";
        $query = $this->db->query($sql, array($code, $phone));
        return $query->row();
    }

    /*     * *******************************************产品模块**************************************************************************** */

    /**
     * 
     * @todo 修改产品的评论数
     * 
     * @param $pid  产品ID
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function editProductReplayCount($pid) {
        $sql = 'UPDATE ai_product SET repay=repay+1 WHERE id=?';
        $this->db->query($sql, array($pid));
        return true;
    }

    /**
     * 
     * @todo 查询是否已经收藏过了 
     * 
     * @param $data 要检查的数据
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function checkIsCollect($data) {
        $this->db->where(array('uid' => $data['uid'], 'pid' => $data['pid']));
        $query = $this->db->get('ai_product_collect');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 添加收藏
     * 
     * @param $data 要添加的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveCollect($data) {
        $this->db->insert('ai_product_collect', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据手机号码获取手机号码是否已经在数据库中存在 
     * \
     * @param $cellphone 手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkCellPhoneIsDefind($cellphone) {
        $sql = "select id from ai_member where telphone = '$cellphone' or account = '$cellphone'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 根据邮箱判断是否已经在数据库中存在 
     * 
     * @param $email 邮箱号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkEmailIsDefind($email) {
        $sql = "select id from ai_member where email = '$email' or account = '$email'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return false;
        }
    }
    /**
     * 
     * @todo 购买成功生成邮件邮件
     * 
     * @param $pname 产品名称

     * @param $order_sn 产品订单号
     * 
     * @param $user_id 用户ID
     * 
     * @param $username 购买用户名称
     * 
     * @param $tellphone 联系电话
     * 
     * @param $price 总价格
     * 
     * @param $paytime 支付时间
     * 
     * @retrn 返回一个int类型的整数   
     * 
     */
    public function savePayOrderEmail($pname, $order_sn, $user_id, $username, $tellphone, $price, $paytime) {
        $data = array(
            'user_id' => $user_id,
            'user_name' => $username,
            'email' => 'ywj@fandingwang.com',
            'title' => '已支付订单(' . $order_sn . ')',
            'content' => '最新已支付订单,产品:' . $pname . ',订单号:' . $order_sn . ',用户名称:' . $username . ',联系电话:' . $tellphone . ',订单金额:' . $price . ',支付时间:' . date('Y-m-d H:i:s', $paytime) . ',该款项已经到支付宝,注意核对',
            'status' => 0,
            'creattime' => date('Y-m-d H:i:s', time()),
            'trytimes' => 0,
        );
        //载入数据库
        $this->db->insert('ai_mail_adv', $data);
        return $this->db->insert_id();
    }
    /**
     * 
     * @todo 购买成功生成短信通知信息
     * 
     * @param $pname 产品名称

     * @param $order_sn 产品订单号
     * 
     * @param $user_id 用户ID
     * 
     * @param $username 购买用户名称
     * 
     * @param $tellphone 联系电话
     * 
     * @param $price 总价格
     * 
     * @param $paytime 支付时间
     * 
     * @retrn 返回一个int类型的整数   
     * 
     */
    public function savePayOrderMessage($pname, $order_sn, $user_id, $username, $tellphone, $price, $paytime) {
        $data = array(
            'user_id' => $user_id,
            'user_name' => $username,
            'cellphone' => $tellphone,
            'content' => '您的订单已经完成支付,产品:' . $pname . ',订单号:' . $order_sn . ',用户名称:' . $username . ',联系电话:' . $tellphone . ',订单金额:' . $price . ',支付时间:' . date('Y-m-d H:i:s', $paytime) . ',如有疑问请联系官方客服。',
            'status' => 0,
            'trytimes' => 0,
            'creattime' => date('Y-m-d H:i:s', time()),
        );
        //载入数据库
        $this->db->insert('ai_admessage', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo  保存发起项目邮件通知
     * 
     * @param $user_id 用户ID
     * 
     * @param $user_name 用户名称
     * 
     * @param $tellphone 联系电话
     * 
     * @param $protitle 项目标题
     * 
     * @param $procontent 项目简介
     * 
     * @param $launchtime 申请时间
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveLaunchEmail($user_id, $user_name, $tellphone, $protitle, $procontent, $launchtime) {
        $data = array(
            'user_id' => $user_id,
            'user_name' => $user_name,
            'email' => 'ywj@fandingwang.com',
            'title' => '新项目申请(' . $protitle . ')',
            'content' => '最新项目申请,项目:' . $protitle . ',用户名称:' . $user_name . ',联系电话:' . $tellphone . ',申请时间:' . date('Y-m-d H:i:s', $launchtime) . ',项目描述:' . $procontent . '[请注意查收]',
            'status' => 0,
            'creattime' => date('Y-m-d H:i:s', time()),
            'trytimes' => 0,
        );
        //载入数据库
        $this->db->insert('ai_mail_adv', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据时间和手机号码检查用户提交的短信是否超过最大条数
     * 
     * @param $phone 手机号码，
     * 
     * @param $timer 时间
     * 
     * @return 返回真假类型的结果 
     * 
     */
    public function checkPhoneCodeTotalCount($phone, $timer) {
        $sql = 'SELECT COUNT(id) as totalcount FROM ai_phonecode WHERE phonenumber=? AND creattime>?';
        $query = $this->db->query($sql, array($phone, $timer));
        $count = $query->row();
        if ($count->totalcount >= 5) {
            return true;
        } else {
            return false;
        }
    }
}

?>
