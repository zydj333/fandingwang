<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Api_model  extends CI_Model {
    
    /**
     * 
     * @todo 获取用户手机号码检查手机号码是否存在 
     * 
     * @param $phone 用户手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkPhone($phone) {
        $this->db->where(array('telphone' => $phone));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 获取用户的手机验证码
     * 
     * @param $phone 手机号
     * 
     * @param $phonecode 手机验证码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkPhoneCode($phone, $phonecode) {
        $time = time();
        $sql = 'select id from ai_phonecode where phonenumber=' . $phone . ' and phonecode=' . $phonecode . ' and (status=1 or status=0) and passtime>' . $time;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 修改手机验证码的状态
     * 
     * @param $data 要修改的数据
     * 
     * @param $phone 条件
     * 
     * @param $phonecode 条件
     * 
     * @return  返回真假类型的结果 
     * 
     */
    public function editPhoneCodeStatus($data, $phone, $phonecode) {
        return $this->db->update('ai_phonecode', $data, array('phonenumber' => $phone, 'phonecode' => $phonecode));
    }
    
    /**
     * 
     * @todo 执行用户的添加操作
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回插入的ID 
     * 
     */
    public function saveMemberAccount($data) {
        $this->db->insert('ai_member', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 根据用户ID获取用户详细信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个对象 
     * 
     */
    public function getUserIdByUid($uid) {
        $this->db->where(array('id' => $uid));
        $query = $this->db->get('ai_member');
        return $query->row();
    }
    
    /**
     * 
     * @todo 根据手机获取用户ID
     * 
     * @param $phone 用户手机
     * 
     * @return 返回一个 
     * 
     */
    public function getUserIdByPhone($phone) {
        $sql = 'select id from ai_member where (account=? or telphone=?)';
        $query = $this->db->query($sql,array($phone, $phone));
        return $query->row();
    }
    
    /**
     * 
     * @todo 进行登录操作
     * 
     * @param $account 登录账户
     * 
     * @param $password 登录密码
     * 
     * @return  返回一个对象 
     * 
     */
    public function getUserInfo($account, $password) {
        $sql = 'select id,account,email,telphone,username,addtime,avatar from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
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
     * @todo 检查登录账户是否存在 
     * 
     * @param $account 用户账户
     * 
     * @param $password 账户密码
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function checkAccountIsSet($account, $password) {
        $sql = 'select id from ai_member where (account=? or email=? or telphone=?) and password=?';
        $query = $this->db->query($sql, array($account, $account, $account, $password));
        $rows = $query->num_rows();
        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 获取我收藏的项目 
     * 
     * @param $uid 我的账户iD
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMyCollectList($uid) {
        $sql = 'SELECT a.pid,a.uid,b.id,b.title,b.title_salt,b.image_url,b.user_id,b.discription,b.addtime,b.amount,b.support_amount,b.support_times,b.starttime,b.endtime,b.days FROM `ai_product_collect` AS a LEFT JOIN `ai_product` AS b ON a.pid=b.id WHERE a.uid=' . $uid . '  and b.is_effect=1 and b.is_del=0 ORDER BY a.id DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 获取我参与的项目
     * 
     * @param int $uid 我的账户ID
     * 
     * @return object 返回一个结果集 
     * 
     */
    public function getMySupportProjectList($uid){
        $sql = 'SELECT a.pid,a.uid,a.order_num,a.total_amount,a.step_status,b.id,b.title,b.title_salt,b.image_url,b.user_id,b.discription,b.addtime,b.amount,b.support_amount,b.support_times,b.starttime,b.endtime,b.days FROM `ai_product_order` AS a LEFT JOIN `ai_product` AS b ON a.pid=b.id WHERE a.uid=' . $uid . '  and b.is_effect=1 and b.is_del=0 ORDER BY a.addtime DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 获取我发起的项目列表
     * 
     * @param int $uid 用户ID 
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getMyLaunchProjectList($uid){
        $sql = 'SELECT id,title,title_salt,image_url,user_id,discription,addtime,amount,support_amount,support_times,starttime,endtime,days FROM `ai_product` WHERE user_id=' . $uid . ' GROUP BY id ORDER BY id DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取消费记录 
     * 
     * @param int $user 用户ID 
     * 
     * @return object 返回一个结果集
     * 
     */
    public function getOrderList($user) {
        $this->db->where(array('uid' => $user,'step_status' => 2));
        $query = $this->db->get('ai_product_order');
        return $query->result();
    }
    /**
     * 
     * @todo 获取项目列表
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProjectList() {
        $sql = 'select a.id,a.title,a.title_salt,a.image_url,a.user_id,a.discription,a.addtime,a.amount,a.support_amount,a.support_times,a.starttime,a.endtime,a.days,b.username,b.account '
                . 'from ai_product as a left join ai_member as b on a.user_id=b.id where a.is_effect=1 and a.is_del=0 order by a.starttime desc, a.salt asc';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 根据项目ID获取项目详情
     * 
     * @param $id 项目ID  
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductInfoById($id) {
        //$this->db->where(array('id' => $id));
        //$query = $this->db->get('ai_product');
        $sql = 'select a.*,b.account from ai_product as a left join ai_member as b on a.user_id=b.id where a.id=' . $id.' and a.is_effect=1 and a.is_del=0';
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /**
     * 
     * @todo  获取项目回复列表
     * 
     * @param $id 项目ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getProductRepayList($id) {
        $sql = 'select a.*,b.account,b.avatar from ai_product_replay as a left join ai_member as b on a.uid=b.id where a.pid=? and a.to_replay_id=? order by a.id asc';
        //$this->db->where(array('pid' => $id));
        //$this->db->order_by('id', 'desc');
        $query = $this->db->query($sql, array($id, 0));
        $list = $query->result();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $son = 'select a.*,b.account,b.avatar from ai_product_replay as a left join ai_member as b on a.uid=b.id where a.pid=? and a.to_replay_id=? order by a.id asc';
                $son_query = $this->db->query($son, array($id, $v->id));
                $son_list = $son_query->result();
                if (!empty($son_list)) {
                    $list[$k]->son = $son_list;
                } else {
                    $list[$k]->son = array();
                }
            }
        }
        return $list;
    }
    
    /**
     * 
     * @todo 修改产品 的浏览次数。
     * 
     * @param $pid 产品ID
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function editProductViewsById($pid){
        $sql = 'update ai_product set views=views+1 where id=' . $pid;
        return $this->db->query($sql);
    }
    
    /**
     * 
     * @todo 获取项目的投资项
     * 
     * @param $id 项目ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductItemsList($id) {
        $this->db->where(array('pid' => $id));
        $this->db->order_by('price', 'asc');
        $query = $this->db->get('ai_product_items');
        $result= $query->result();
        if(!empty($result)){
            foreach($result as $k=>$v){
                $result[$k]->replay=  str_replace("\n","<br/>",$v->replay);
            }
        }
        return $result;
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
     * @todo 根据查询条件获取资讯列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getArticleList($search) {
        $where = ' 1=1';
        if (isset($search['type'])) {
            $where = ' type=' . $search['type'];
        }
        $sql = 'select id,title,imageurl,discription,views,replay,salt,addtime from ai_news where' . $where . ' order by addtime desc';
        $query = $this->db->query($sql);
        return $query->result();
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
     * @todo 保存用户的个人信息 
     * 
     * @param $data 要保存的数据
     * 
     * @param $uid 用户ID
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function saveMemberEdit($data, $uid) {
        return $this->db->update('ai_member', $data, array('id' => $uid));
    }

    /**
     * 
     * @todo 根据用户ID和用户密码  检查密码是否正确 
     * 
     * @param $uid 用户ID
     * 
     * @param $pwd 用户密码
     * 
     * @return  返回真假类型的结果
     * 
     */
    public function checkUserPwdIsRight($uid, $pwd) {
        $this->db->where(array('id' => $uid, 'password' => $pwd));
        $query = $this->db->get('ai_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 获取我的地址列表
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMyAddressList($user_id) {
        $this->db->where(array('uid' => $user_id));
        $query = $this->db->get('ai_member_address');
        return $query->result();
    }

    /**
     * 
     * @todo 修改默认地址 
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个boolea类型的结果
     * 
     */
    public function editDefaultAddress($uid) {
        $data = array('is_default' => 0);
        return $this->db->update('ai_member_address', $data, array('uid' => $uid));
    }

    /**
     * 
     * @todo 保存用户地址
     * 
     * @param $data 要保存的数据
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
     *  @todo 修改地址信息
     * 
     * @param $data 要修改的数据
     * 
     * @param  $id 要修改的地址ID
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function editAddressInfo($data, $id) {
        return $this->db->update('ai_member_address', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 删除地址
     * 
     * @param $id 要删除的地址ID
     * 
     * @return 返回一个boolean 类型的结果 
     * 
     */
    public function delAddressInfo($id) {
        return $this->db->delete('ai_member_address', array('id' => $id));
    }
    
    /**
     * 
     * @todo 获取一条地址信息 
     * 
     * @param $id 地址ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getAddressInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=  $this->db->get('ai_member_address');
        return $query->row();
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
     * @todo 取消收藏
     * 
     * @param $data 要取消的数据
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function deleteCollect($data) {
       return $this->db->delete('ai_product_collect', $data);
    }
}