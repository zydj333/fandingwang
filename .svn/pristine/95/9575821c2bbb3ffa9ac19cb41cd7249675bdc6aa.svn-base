<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project_model
 *
 * @createtime 2015-3-28 9:17:28
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class project_model extends CI_Model {

    private $now_time = 0;

//put your code here
    /**
     * 
     * @todo  构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->now_time = time();
    }

    /**
     * 
     * @todo 获取项目分类
     * 
     * @return 返回一个结果集
     * 
     */
    public function getProjectType($count = 3) {
        $sql = 'select * from `ai_projecttype` order by `salt` asc limit ?';
        $query = $this->db->query($sql, array($count));
        return $query->result();
    }

    /**
     * 
     * @todo 根据条件获取项目总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function getProjectCount($search) {
        $where = '';
        if (isset($search['status'])) {
            if ($search['status'] == 1) {
                $where = 'and starttime>' . $this->now_time;
            } else if ($search['status'] == 2) {
                $where = 'and endtime<' . $this->now_time;
            } else if ($search['status'] == 3) {
                $where = ' and (starttime<' . $this->now_time . ' and endtime>' . $this->now_time . ')';
            }
        }
        if (isset($search['type'])) {
            $where.=' and product_type=' . $search['type'];
        }
        $sql = 'select `id` from `ai_product` where `is_effect`=1 and `is_del`=0 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取项目列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProjectList($search) {
        $where = '';
        if (isset($search['status'])) {
            if ($search['status'] == 1) {
                $where = 'and a.starttime>' . $this->now_time;
            } else if ($search['status'] == 2) {
                $where = 'and a.endtime<' . $this->now_time;
            } else if ($search['status'] == 3) {
                $where = ' and (a.starttime<' . $this->now_time . ' and a.endtime>' . $this->now_time . ')';
            }
        }
        if (isset($search['type'])) {
            $where.=' and a.product_type=' . $search['type'];
        }
        $sql = 'select a.id,a.title,a.title_salt,a.image_url,a.user_id,a.discription,a.addtime,a.amount,a.support_amount,a.support_times,a.starttime,a.endtime,a.days,b.username,b.account '
                . 'from ai_product as a left join ai_member as b on a.user_id=b.id where a.is_effect=1 and a.is_del=0 ' . $where . ' order by a.starttime desc, a.salt asc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据收藏项目总条数
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function getCollectProjectCount($search) {
        $where = '';
        if (isset($search['type'])) {
            $where = ' and b.product_type=' . $search['type'];
        }
        $sql = 'select a.id from `ai_product_collect` as a left join ai_product as b on a.pid=b.id where a.uid=' . $search['user_id'] . ' and b.is_effect=1 and b.is_del=0 ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据获取收藏项目列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getCollectProjectList($search) {
        $where = '';
        if (isset($search['type'])) {
            $where = ' and a.product_type=' . $search['type'];
        }
        $sql = 'select a.id,a.title,a.title_salt,a.image_url,a.user_id,a.discription,a.addtime,a.amount,a.support_amount,a.support_times,a.starttime,a.endtime,a.days,b.username,b.account '
                . 'from ai_product_collect as c left join ai_product as a on c.pid=a.id left join ai_member as b on a.user_id=b.id where c.uid=' . $search['user_id'] . ' and a.is_effect=1 and a.is_del=0 ' . $where . ' order by a.salt asc limit ' . $search['start'] . ',' . $search['pagesize'];
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
     * @todo 获取项目动态
     * 
     * @param $id 项目ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductFeedList($id) {
        $this->db->where(array('pid' => $id));
        $this->db->order_by('addtime', 'desc');
        $query = $this->db->get('ai_product_feed');
        return $query->result();
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
     * @todo 获取项目的支持记录列表
     * 
     * @param $id 项目ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductSupportList($id) {
        $sql = 'select a.id,a.order_num,a.pid,a.pname,a.amount,a.step_status,a.uid,a.username,a.addtime,b.avatar,b.account from ai_product_order as a left join ai_member as b on a.uid=b.id where a.pid=' . $id . ' and a.step_status>1 order by a.addtime desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 检查评论是否已经存在 
     * 
     * @param $data 要检查的数据
     * 
     * @return 返回真假类型的结果
     * 
     */
    public function checkRepayIsDefind($data) {
        $this->db->where(array('pid' => $data['pid'], 'uid' => $data['uid'], 'to_replay_id' => $data['to_replay_id'], 'content' => $data['content'], 'addip' => $data['addip']));
        $query = $this->db->get('ai_product_replay');
        if ($query->num_rows()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @todo 保存评论
     * 
     * @param @data 要保存的数据 
     * 
     * @return 返回int整数
     * 
     */
    public function saveRepayAdd($data) {
        $this->db->insert('ai_product_replay', $data);
        return $this->db->insert_id();
    }

}

?>
