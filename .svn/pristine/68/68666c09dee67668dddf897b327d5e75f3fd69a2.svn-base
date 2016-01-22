<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mobile_model
 *
 * @createtime 2015-5-30 15:59:31
 * 
 * @author ZhangPing'an
 * 
 * @todo mobile_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class mobile_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * ******************************************************************************项目操作***********************************
     * 
     */

    /**
     * 
     * @todo 获取首页项目列表
     * 
     * @param int $count 要获取总条数
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getProjectListByCount($count) {
        $sql = 'select id,title,image_url,amount,support_amount,starttime,endtime,user_id,discription,addtime,is_effect,is_rem,salt,is_del from ai_product where is_effect=1 and is_del=0 order by salt desc,addtime desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取项目总条数
     * 
     * @param  array $search 查询条件
     * 
     * @return int 返回一个整数
     * 
     */
    public function getProjectCount($search) {
        $where = '';
        $now_time = time();
        if ($search['status'] == 1) {
            //众筹中
            $where = ' and (starttime<' . $now_time . ' and endtime>' . $now_time . ')';
        } elseif ($search['status'] == 2) {
            //预热中
            $where = ' and starttime>' . $now_time;
        } elseif ($search['status'] == 3) {
            //已经结束
            $where = ' and endtime<' . $now_time;
        } else {
            $where = '';
        }
        $sql = 'select id from ai_product where is_effect=1 and is_del=0 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取项目列表
     * 
     * @param array $search 查询条件
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectList($search) {
        $where = '';
        $now_time = time();
//        if ($search['status'] == 1) {
//            //众筹中
//            $where = ' and (starttime<' . $now_time . ' and endtime>' . $now_time . ')';
//        } elseif ($search['status'] == 2) {
//            //预热中
//            $where = ' and starttime>' . $now_time;
//        } elseif ($search['status'] == 3) {
//            //已经结束
//            $where = ' and endtime<' . $now_time;
//        } else {
//            $where = '';
//        }
        $sql = 'select id,title,image_url,amount,support_amount,starttime,endtime,user_id,discription,addtime,is_effect,is_rem,salt,is_del from ai_product where is_effect=1 and is_del = 0 order by salt desc,addtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取项目详情 
     * 
     * @param int id 查询条件，产品ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectDetialById($id) {
        $sql = 'select a.*,b.account from ai_product as a left join ai_member as b on a.user_id=b.id where a.is_effect=? and a.is_del=? and a.id=?';
        //$this->db->where(array('id' => $id, 'is_effect' => 1, 'is_del' => 0));
        $query = $this->db->query($sql, array(1, 0, $id));
        return $query->row();
    }

    /**
     * 
     * @todo 获取项目子项列表 
     * 
     * @param $pid 项目ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProjectItems($pid) {
        $this->db->where(array('pid' => $pid));
        $this->db->order_by('price', 'asc');
        $query = $this->db->get('ai_product_items');
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $k => $v) {
                $result[$k]->replay = str_replace("\n", "<br/>", $v->replay);
            }
        }
        return $result;
    }

    /**
     * 
     * @todo 根据项目子项ID获取子项详情
     * 
     * @param $items_id 子项ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProjectItemsById($items_id) {
        $this->db->where(array('id' => $items_id));
        $query = $this->db->get('ai_product_items');
        return $query->row();
    }

    /**
     * 
     * @todo 修改项目子项的售出总数
     * 
     * @param $pid 产品ID
     * 
     * @param $items_id 项目子项ID
     * 
     * @param $buy_number 购买数量
     * 
     * @return 返回一个真假类型的结果 
     * 
     */
    public function editProduceItemsSellTotal($pid, $items_id, $buy_number = 1) {
        $sql = 'update ai_product_items set sell_total=sell_total+' . $buy_number . ' where id=' . $items_id . ' and pid=' . $pid;
        return $this->db->query($sql);
    }

    /**
     * 
     * 
     * @todo 修改产品相应信息
     * 
     * @param $pid 项目ID
     * 
     * @param $price 价格
     * 
     * @param $buy_number 购买数量
     * 
     * @return 返回真假类型的结果 
     * 
     */
    public function editProductSupport($pid, $price, $buy_number = 1) {
        $sql = 'update ai_product set support_times=support_times+' . $buy_number . ',support_amount=support_amount+' . $price . ' where id=' . $pid;
        return $this->db->query($sql);
    }

    /**
     * 
     *  *****************************************************************************资讯操作********************************** 
     * 
     */

    /**
     * 
     * @todo 获取首页资讯列表
     * 
     * @param int $count 要获取总条数
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getArticleListByCount($count) {
        $sql = 'select id,title,imageurl,discription,salt,addtime from ai_news order by salt asc,addtime desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*     * **********************************************************************************用户操作*********************************** */

    /**
     * 
     * @todo 检查用户名称是否存在
     * 
     * @param string $account 账户名称
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function checkAccount($account) {
        $this->db->where(array('account' => $account));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 检查邮箱是否存在
     * 
     * @param string $email 邮箱地址
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function checkEmail($email) {
        $sql = "select id from ai_member where email = '$email' or account = '$email'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 检查手机号码是否存在
     * 
     * @param string $phone 手机号码
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function checkCellphone($phone) {
        $sql = "select id from ai_member where telphone = '$phone' or account = '$phone'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 检查手机验证码是否存在 
     * 
     * @param string $phone 手机号码
     * 
     * @param number $code 手机验证码
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function checkPhoneCode($phone, $code) {
//        $this->db->where(array('phonenumber' => $phone, 'phonecode' => $code));
//        $this->db->or_where_in('status', '0,1');
//        $query = $this->db->get('ai_phonecode');
        $sql='SELECT * FROM `ai_phonecode` WHERE `phonenumber`=? AND `phonecode`=? AND (`status`=? OR `status`=?)';
        $query=  $this->db->query($sql,array($phone,$code,0,1));
        //echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
        /**
     * 
     * @todo 检查邮箱验证码是否存在 
     * 
     * @param string $phone 手机号码
     * 
     * @param number $code 手机验证码
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function checkEmailCode($email, $code) {
//        $this->db->where(array('phonenumber' => $phone, 'phonecode' => $code));
//        $this->db->or_where_in('status', '0,1');
//        $query = $this->db->get('ai_phonecode');
        $sql='SELECT * FROM `ai_mail_adv` WHERE `email`=? AND `user_name`=? AND (`status`=? OR `status`=?)';
        $query=  $this->db->query($sql,array($email,$code,0,1));
        //echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 修改手机验证码状态
     * 
     * @param string $phone 手机号
     * 
     * @param string $code 短信验证码 
     * 
     * @return boolean 返回一个Boolean类型的结果
     *  
     */
    public function editPhoneCodeStatus($phone, $code) {
        return $this->db->update('ai_phonecode', array('status' => 2), array('phonenumber' => $phone, 'phonecode' => $code));
    }
    
    /**
     * 
     * @todo 修改邮箱验证码状态
     * 
     * @param string $email 邮箱
     * 
     * @param string $code 验证码 
     * 
     * @return boolean 返回一个Boolean类型的结果
     *  
     */
    public function editEmailCodeStatus($email, $code) {
        return $this->db->update('ai_mail_adv', array('status' => 2), array('email' => $email, 'user_name' => $code));
    }

    /**
     * 
     * @todo 保存用户信息
     * 
     * @param array $data 要保存的数据 
     * 
     * @return int 返回一个int类型的整数
     * 
     */
    public function saveMember($data) {
        $this->db->insert('ai_member', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 添加本次登录记录
     * 
     * @param $data 要保存的数据
     * 
     * @return  返回一个自增ID
     *  
     * 
     */
    public function addThisLogin($data) {
        $this->db->insert('ai_member_log', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 检查用户登录信息
     * 
     * @param $account 账号
     * 
     * @param $password 账户密码
     * 
     * @return boolean 返回一个Boolean类型的结果布尔
     * 
     */
    public function checkAccountInfo($account, $password) {
        $sql = 'select id from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @todo 获取用户的信息
     * 
     * @param string $account 用户帐户
     * 
     * @param string $password 用户密码
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getAccountByAccount($account, $password) {
        $sql = 'select id,account,email,telphone,username,addtime,avatar from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
        return $query->row();
    }
    
    /**
     * 
     * @todo 手机短信登录
     * 
     * @param $string $phone 手机号码
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getAccountByPhoneNumber($phone){
        $sql = 'select id,account,email,telphone,username,addtime,avatar from ai_member where telphone=?';
        $query = $this->db->query($sql, array($phone));
        return $query->row();
    }

    /**
     * 
     * @todo 获取上次登录时间
     * 
     * @Param $id 用户ID
     * 
     * @return 返回一个对象  
     * 
     */
    public function getLastLogin($id) {
        $this->db->where(array('uid' => $id));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ai_member_log');
        return $query->row();
    }

    /**
     * 
     * @todo 获取当前用户地址列表
     * 
     * @param int $uid 用户ID
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getUserAddressList($uid) {
        $this->db->where(array('uid' => $uid));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ai_member_address');
        return $query->result();
    }

    /**
     *
     * @todo 省份城市区域
     * 
     * @param int $parent_id 父级ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProvinceCityArea($prient_id = 0) {
        $this->db->where(array('pid' => $prient_id));
        $this->db->order_by('order');
        $query = $this->db->get('ai_area');
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取地区详情 
     * 
     * @param int $id ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getProvinceCityAreaById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_area');
        return $query->row();
    }

    /**
     * 
     * @todo 修改用户的默认地址
     * 
     * @param int $uid 用户ID 
     * 
     * @return 返回一个真假类型的结果
     * 
     */
    public function editDefaultAddress($uid) {
        return $this->db->update('ai_member_address', array('is_default' => 0), array('uid' => $uid));
    }

    /**
     * 
     * @todo 保存地址信息
     * 
     * @param array $data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveAddress($data) {
        $this->db->insert('ai_member_address', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 保存地址信息的修改
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 要修改的数据ID
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function saveAddressEdit($data, $id) {
        return $this->db->update('ai_member_address', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 删除用户地址 
     * 
     * @param $id 要删除的地址信息ID
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function delAddressById($add_id) {
        return $this->db->delete('ai_member_address', array('id' => $add_id));
    }

    /**
     * 
     * @todo 根据地址ID获取地址详情
     * 
     * @param int $id  地址ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getAddressInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_member_address');
        return $query->row();
    }

    /**
     * 
     * @todo 获取用户信息 
     * 
     * @param $uid 用户ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getMemberInfoDetial($uid) {
        $this->db->where(array('id' => $uid));
        $query = $this->db->get('ai_member');
        return $query->row();
    }

    /**
     * 
     * @todo 修改用户信息
     * 
     * @param $data 要保存的信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function editMemberInfo($data, $uid) {
        return $this->db->update('ai_member', $data, array('id' => $uid));
    }

    /*     * *******************************************************************订单操作********************************************* */

    /**
     * 
     * @todo 保存订单信息 
     * 
     * @param array $data 要保存的数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveOrder($data) {
        $this->db->insert('ai_product_order', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取订单详情 
     * 
     * @param $order_sn 订单编号
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getOrderInfo($order_sn, $uid) {
        $this->db->where(array('order_num' => $order_sn, 'uid' => $uid));
        $query = $this->db->get('ai_product_order');
        return $query->row();
    }

    /**
     * 
     * @todo 根据订单编号获取订单详情
     * 
     * @param string $order_sn 订单编号
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getOrderDetialByOrderSn($order_sn) {
        $this->db->where(array('order_num' => $order_sn));
        $query = $this->db->get('ai_product_order');
        return $query->row();
    }

    /**
     * 
     * @todo 保存订单修改
     * 
     * @param $data  要修改的内容
     * 
     * @param $order_sn 订单编号
     * 
     * @return 返回一个Boolean类型的结果 
     * 
     */
    public function saveOrderEdit($data, $order_sn) {
        return $this->db->update('ai_product_order', $data, array('order_num' => $order_sn));
    }

    /**
     * 
     * @todo 获取用户的订单列表 
     * 
     * @param $uid 用户ID
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getMyOrderList($uid) {
        $this->db->where(array('uid' => $uid,'isdel' => 0));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ai_product_order');
        return $query->result();
    }

    /*     * **************************************************************************发起众筹操作*********************************************************** */

    /**
     * 
     * @todo 保存发起众筹
     * 
     * @param $data 要添加的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveLaunch($data) {
        $this->db->insert('ai_product_launch', $data);
        return $this->db->insert_id();
    }

    /*     * ************************************************************************资讯操作**************************************************** */

    /**
     * 
     * @todo 获取资讯总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getArticleCount($search) {
        $this->db->order_by('addtime', 'desc');
        $query = $this->db->get('ai_news');
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取资讯列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getArticleList($search) {
        $sql = 'select * from ai_news order by addtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取资讯详情 
     * 
     * @param $id 资讯ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getArticleDetial($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('ai_news');
        return $query->row();
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
     * @todo 修改用户密码,根据账户名称进行修改 
     * 
     * @param $data 要修改的数据 
     * 
     * @param $account 账户名称
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMemberPassword($data, $account) {
        $sql = "UPDATE ai_member SET password = '$data' WHERE email = '$account' or account = '$account' or telphone = '$account'";
        return $query = $this->db->query($sql);
    }

    /**
     * 
     * 删除订单
     * 
     * $id 订单ID
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function delOrderById($data,$id) {
        return $row = $this->db->update('ai_product_order', $data, array('id' => $id));
    }
}
