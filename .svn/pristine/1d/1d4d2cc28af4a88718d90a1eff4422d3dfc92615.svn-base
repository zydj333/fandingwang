<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wechat
 *
 * @createtime 2015-5-7 10:57:04
 * 
 * @author ZhangPing'an
 * 
 * @todo wechat
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class wechat extends CI_Controller {

    //put your code here
    const TOKEN = "fandingwang20150608";
    const APP_ID = "wx43d39d6134dff5a7";
    const APP_SECRET = "ce58a7790920191ac5f91e341c871f8f";
    const GRANT_TYPE = "client_credential";
    const GET_ACCESS_TOKEN_URL = "https://api.weixin.qq.com/cgi-bin/token?";
    const ACCESS_TOKEN_KEY = 'b3b35a2dc0d3b0d546c698d38b8e0d9a';

    private $access_token;
    private $fromUsername;
    private $toUsername;
    private $times;
    private $msgType;
    private $event;
    private $eventKey;

    public function __construct() {
        parent::__construct();
        $this->load->model('wechat_model');
        $this->load->driver('cache');
        $this->access_token = $this->cache->file->get(self::ACCESS_TOKEN_KEY);
        //echo $this->access_token;exit;
        if ($this->access_token == '') {
            $this->getAccessToken();
        }
    }

    /**
     * 
     * @todo 检查通信 
     * 
     */
    private function checkConnect() {
        $echoStr = $this->input->get('echostr');
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    /**
     * 
     * @todo 微信事件操作总方法
     * 
     */
    public function app_run() {
        //验证url有效性  该方法是用一次后及注释，下次通信不成功再次使用
        //$this->checkConnect();
        //调用微信发送的数据
        $this->getWechatPostData();
        //本地数据
        $localmessage = array(
            'about' => "泛丁众筹由浙江爱投网络科技有限公司独立运营，于2015年1月1日正式运作。\n 短期内主打实物回报类+体验式众筹。简言之，产品/消费众筹。\n 众筹的产品有哪些？\n 三个字，不设限。\n我们目前众筹的主要有三类：\n 1、实物，比如一些智能硬件、原创作品或者一块布；\n 2、体验，比如一听我说完每个人都激动不已的泳池趴，比如一部青春偶像剧；\n 3、大招，这里指一些不常见的、不符合普通众筹逻辑的奇形怪状的东西。\n\n",
            'join' => "团队里平均年龄不超过26岁。年纪最长的出生于1988年。\n 我们日渐壮大，但壮大的速度永远跟不上发展的速度。\n 我们跟每个创业团队一样，缺技术宅男CTO、只负责貌美如花的CMO、脑洞大开的UI射击湿，以及种种运营岗位。\n 或者，我们也可以因人设岗。只要气质相符，只要兴趣点一致。\n 反正聊聊又不要钱。约吗？",
            'contact' => "地址：杭州市拱墅区湖州街168号美好国际大厦12楼1205室泛丁众筹\n 工作时间：周一至周五 9:00-17:30（国家法定假日除外）\n 客服邮箱：service@fandingwang.com\n 客服电话：0571-8831 5066\n 客服 Q Q：326 417 6470",
            'guanzhu'=>"",
            'exit'=>""
            );
        //进行发送
        $this->sendEvent($localmessage);
    }

    /**
     * 
     * @todo 获取微信发送的数据
     * 
     */
    private function getWechatPostData() {
        $post_value = $GLOBALS['HTTP_RAW_POST_DATA'];
        //file_put_contents('/fandingdata/www/aizhongchou/app/logs/wechat.txt', $post_value);
        if (!empty($post_value)) {
            $postObj = simplexml_load_string($post_value, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->fromUsername = $postObj->FromUserName;
            $this->toUsername = $postObj->ToUserName;
            $this->msgType = $postObj->MsgType;
            $this->event = $postObj->Event;
            $this->eventKey = $postObj->EventKey;
            $this->times = time();
        } else {
            echo "The Api For Wechat!";
            exit;
        }
    }

    /**
     * 
     * @todo 检查通信是否正确 
     * 
     * 
     */
    private function checkSignature() {
        $signature = $this->input->get('signature');
        $timestamp = $this->input->get('timestamp');
        $nonce = $this->input->get('nonce');
        $token = self::TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStrSha = sha1($tmpStr);
        if ($tmpStrSha == $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo jssdk载入 
     * 
     */
    public function index() {
        $this->load->view('frontend/wechat/index');
    }

    /**
     * 
     * @todo 获取access_token 
     * 
     */
    private function getAccessToken() {
        $parmes = array(
            'grant_type' => self::GRANT_TYPE,
            'appid' => self::APP_ID,
            'secret' => self::APP_SECRET
        );
        $parmes_str = http_build_query($parmes);
        $content = file_get_contents(self::GET_ACCESS_TOKEN_URL . $parmes_str);
        $access_token = json_decode($content);
        $this->access_token = $access_token->access_token;
        $this->cache->file->save(self::ACCESS_TOKEN_KEY, $access_token->access_token, 6000);
        //$this->comm->set_session(self::ACCESS_TOKEN_KEY, $access_token->access_token);
    }

    /**
     * 
     * @todo 创建自定义菜单 
     * 
     */
    public function creatMenu() {
        $data = '{
		     "button":[
		     {	
		         "name":"泛丁众筹",
		         "sub_button":[
		            {
		               "type":"view",
		               "name":"泛丁首页",
		               "url":"http://www.fandingwang.com/mobile/index"
		            },
		            {
		               "type":"view",
		               "name":"项目市场",
		               "url":"http://www.fandingwang.com/mobile/project"
		            },
		            {
		               "type":"view",
		               "name":"泛丁资讯",
		               "url":"http://www.fandingwang.com/mobile/article"
		            },
                            {
		               "type":"view",
		               "name":"个人中心",
		               "url":"http://www.fandingwang.com/mobile/center"
		            }
                          ]
		      },
		      {
                        "type":"view",
                        "name":"发起众筹",
                        "url":"http://www.fandingwang.com/mobile/launch"
		           
		      },
		      {
		           "name":"了解泛丁",
		           "sub_button":[
		            {
		               "type":"click",
		               "name":"关于泛丁",
		               "key":"about"
		            },
		            {
		               "type":"click",
		               "name":"加入我们",
		               "key":"join"
		            },
		            {
		               "type":"click",
		               "name":"联系我们",
		               "key":"contact"
		            }]
		       }]
		 	}';
        //echo $this->access_token;exit;
        $ch = curl_init('https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->access_token);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
        $result = curl_exec($ch);
        echo $result;
    }

    /**
     * 
     * @todo 获取菜单 
     * 
     */
    public function getMenu() {
        $content = file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $this->access_token);
        print_r($content);
    }

    /**
     * 
     * @todo 删除菜单 
     * 
     */
    public function delMenu() {
        $content = file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $this->access_token);
        print_r($content);
    }

    /**
     * 
     * @todo 获取服务器IP 
     * https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=ACCESS_TOKEN
     */
    public function getServerIp() {
        $content = file_get_contents('https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=' . $this->access_token);
        print_r($content);
    }

    /**
     * 
     *  @todo 事件推送 
     * 
     * 
     */
    private function sendEvent($data) {
        //=================xml header============
        $content = "<xml>
                    <ToUserName><![CDATA[" . $this->fromUsername . "]]></ToUserName>
                    <FromUserName><![CDATA[" . $this->toUsername . "]]></FromUserName>
                    <CreateTime>" . $this->times . "</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>";

        //=================type content============
        switch ($this->eventKey) {
            case "about":
                $content.="<Content><![CDATA[" . $data['about'] . "]]></Content>";
                break;
            case "join":
                $content.="<Content><![CDATA[" . $data['join'] . "]]></Content>";
                break;
            case "contact":
                $content.="<Content><![CDATA[" . $data['contact'] . "]]></Content>";
                break;
        }
        $content.="</xml>";
        echo $content;
    }

}
