<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ci_session
 * 本类封装一些较常见的常用函数
 * @author zhangping'an
 * @Create Time    2012-3-23 9:20:04
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class comm {

    //put your code here
    function __construct() {
        log_message('debug', "error_report Class Initialized");
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('cookie');
    }

    function sendMail($to, $subject, $message, $config) {
        if ($to != '' && $subject != '' && $message != "") {
            //抽空补上，$to邮箱验证
            $_config = Array(
                'protocol' => $config['protocol'],
                'smtp_host' => $config['smtp_host'],
                'smtp_port' => $config['smtp_port'],
                'smtp_user' => $config['smtp_user'],
                'smtp_pass' => $config['smtp_pass'],
                'wordwrap' => $config['wordwrap'],
                'charset' => "utf-8",
                'mailtype' => 'html'
            );
            $this->CI->load->library('email', $_config);
            $this->CI->email->set_newline("/r/n");
            $this->CI->email->from($config['smtp_from'], $config['smtp_fromName']);
            $this->CI->email->to($to);
            $this->CI->email->subject($subject);
            $this->CI->email->message($message);
            if ($this->CI->email->send()) {
                return true;
            } else {
                return false;
                //show_error($this->CI->email->print_debugger());
            }
        } else {
            return false;
        }
    }

    /**
     *
     * 设置session
     * @param $str 为session名称 $value为相对于的值
     *
     */
    function set_session($str, $value) {
        //$value=serialize($value);
        if ($this->is_ie()) {
            //delete_cookie($str);
            $time = time() + 7200;
            $this->setCookie($str, $value, $time);
        } else {
            header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
            $_SESSION [$str] = "";
            $this->CI->session->unset_userdata($str);
            $this->CI->session->set_userdata($str, $value);
            $_SESSION [$str] = $value;
        }
    }

    /**
     *
     * 获取session的值
     *
     * @param string $str为session的名称
     *
     * 返回string类型的值
     *
     */
    function get_session($str) {
        $value = "";
        if ($this->is_ie()) {
            $value = get_cookie($str);
            //print_r($value);exit;
        } else {
            $value = $this->CI->session->userdata($str);
        }
        return $value;
    }

    /**
     *
     * 删除名为$str的session
     *
     * @param string $str为session的名称
     *
     * 返回布尔类型的结果   是否删除成功
     *
     */
    function del_session($str) {
        if ($this->is_ie()) {
            if (delete_cookie($str)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($this->CI->session->unset_userdata($str)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     *
     * 创建Cookie
     *
     * @param $str cookie的名称
     *
     * @param $value cookie的值
     *
     * @param $time cookie 的过期时间
     *
     */
    function setCookie($str, $value, $time) {
        $expire = $time;
        $domain = $_SERVER["SERVER_NAME"];
        $path = "/";
        $prefix = "";
        delete_cookie($str);
        set_cookie($str, $value, $expire, $domain, $path, $prefix);
    }

    /**
     *
     * 检查当前浏览器及版本
     *
     * 返回布尔类型及是否为IE
     */
    function is_ie() {
        $is_ie = 0;
        $agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) {
            $is_ie = 1;
        } else {
            $is_ie = 0;
        }
        return $is_ie;
    }

    /**
     *
     * 检查是否为有效邮箱格式
     *
     * @param string $str 为邮箱地址
     *
     * 返回布尔类型的结果
     *
     */
    function is_email($user_email) {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false) {
            if (preg_match($chars, $user_email)) {
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
     * 获取utf-8字符串的长度
     *
     * @param string $str为字符串
     *
     * 返回int型数字
     *
     */
    function strlen_utf8($str) {
        $i = 0;
        $count = 0;
        $len = strlen($str);
        while ($i < $len) {
            $chr = ord($str [$i]);
            $count++;
            $i++;
            if ($i >= $len)
                break;
            if ($chr & 0x80) {
                $chr <<= 1;
                while ($chr & 0x80) {
                    $i++;
                    $chr <<= 1;
                }
            }
        }
        return $count;
    }

    /**
     *
     * 判断浏览器版本
     *
     * 获取当前访问者的浏览器内核
     *
     * 返回浏览器名称及核心名称
     *
     */
    function browinfo() {
        if (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 8.0")) {
            $visitor_browser = "Internet Explorer 8.0";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 7.0")) {
            $visitor_browser = "Internet Explorer 7.0";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 6.0")) {
            $visitor_browser = "Internet Explorer 6.0";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 5.5")) {
            $visitor_browser = "Internet Explorer 5.5";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 5.0")) {
            $visitor_browser = "Internet Explorer 5.0";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "MSIE 4.01")) {
            $visitor_browser = "Internet Explorer 4.01";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "NetCaptor")) {
            $visitor_browser = "NetCaptor";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "Netscape")) {
            $visitor_browser = "Netscape";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "Lynx")) {
            $visitor_browser = "Lynx";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "Opera")) {
            $visitor_browser = "Opera";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "Konqueror")) {
            $visitor_browser = "Konqueror";
        } elseif (strpos($_SERVER ["HTTP_USER_AGENT"], "Mozilla/5.0")) {
            $visitor_browser = "Mozilla";
        } else {
            $visitor_browser = "others";
        }
        return visitor_browser;
    }

    /**
     *
     * 截取字符串
     * @param string $string要截取的字符串
     * $sublen 要截取的长度
     * $start  从第几个字符开始截取默认为0
     * $code   字符串的编码格式  默认为UTF-8。
     * 返回 string类型的结果 及截取后的字符串
     * 
     */
    function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen)
                return join('', array_slice($t_string[0], $start, $sublen)) . "...";
            return join('', array_slice($t_string[0], $start, $sublen));
        }else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr.= substr($string, $i, 2);
                    } else {
                        $tmpstr.= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129)
                    $i++;
            }
            if (strlen($tmpstr) < $strlen)
                $tmpstr.= "...";
            return $tmpstr;
        }
    }

    /**
     * 获取字符串的长度
     * @param string $str要计算的字符串
     * 返回一个int整数  即为本字符串的长度
     *
     */
    function getStrLen($str) {
        $i = 0;
        $count = 0;
        $len = strlen($str);
        while ($i < $len) {
            $chr = ord($str[$i]);
            $count++;
            $i++;
            if ($i >= $len)
                break;
            if ($chr & 0x80) {
                $chr <<= 1;
                while ($chr & 0x80) {
                    $i++;
                    $chr <<= 1;
                }
            }
        }
        return $count;
    }

    /**
     *
     * 获取用户的ID地址
     *
     * 根据系统判断获取用户的当前IP地址
     *
     * 返回string类型的IP地址
     *
     */
    function real_ip() {
        static $realip = NULL;
        if ($realip !== NULL) {
            return $realip;
        }
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        $onlineip = array();
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    /**
     *
     * 检查后台登录
     *
     * 检查当前用户是否已经登录
     *
     */
    function checkLogin() {
        $url = "/admin_login/index";
        $m_id = $this->get_session('user_id');
        $m_name = $this->get_session('username');
        if ($m_id == "" and $m_name == "") {
            redirect($url);
        }
    }

    /**
     * 
     * @todo 检查前台用户登录
     *
     */
    function checkUserlogin() {
        $url = "/login";
        $user = json_decode($this->get_session('member'), true);
        if (empty($user) || $user['user_id'] == '') {
            redirect($url);
        }
    }

    /**
     *
     * 替换编辑器不支持的字符
     *
     * 返回替换后的字符串
     */
    function doStr_replace($str) {
        $content = str_replace("'", "\"", $str);
        $content = str_replace("\r\n", "", $content);
        $content = str_replace("\n", "", $content);
        return $content;
    }

    /**
     *
     * 生成Excel表格文件
     *
     * @param $array_name 表头参数（一维数组）
     *
     * @param $array 要导出的数据（二维数组）
     *
     * @param $filename 导出的excel文件的文件名称
     *
     */
    function array_to_excel($array_name, $array, $filename = 'exceloutput') {
        $filename = iconv("UTF-8", "gbk", $filename);
        $headers = '';
        $data = '';
        $obj = & get_instance();
        if (count($array) == 0) {
            echo '<p>The table appears to have no data.</p>';
        } else {
            foreach ($array_name as $field) {
                $headers .= iconv("utf-8", "GBK", $field) . "\t";
            }
            foreach ($array as $row) {
                $line = '';
                foreach ($row as $value) {
                    if ((!isset($value)) OR ( $value == "")) {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }
            $data = str_replace("\r", "", iconv("utf-8", "GBK", $data));
            header("Content-type: application/x-msdownload");
            header("Content-type:charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename.xls");
            echo "$headers\n$data";
        }
    }

    /**
     *
     * @todo 计算开始结束时间
     *
     * @param $start 开始时间
     *
     * @param $endtime 结束时间
     *
     * @param $days 上线天数
     *
     * @return 返回一个string类型的数据
     *
     */
    public function getTimeString($start, $endtime, $days) {
        $data = array(
            'str' => '',
            'statu' => 0
        );
        $nowtime = time();
        $daystime = 24 * 3600;
        if ($nowtime < $start) {//预热
            $difference = $start - $nowtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = $today . "天" . $hour . "小时后开始";
            } else {
                $data['str'] = $hour . "小时" . $min . "分钟后开始";
            }
            $data['statu'] = 0;
        } elseif ($nowtime > $endtime) {//结束
            $difference = $nowtime - $endtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = "已结束" . $today . "天" . $hour . "小时";
            } else {
                $data['str'] = "已结束" . $hour . "小时" . $min . "分钟";
            }
            $data['statu'] = 2;
        } else {//正在热销
            $difference = $endtime - $nowtime;
            $today = floor($difference / $daystime);
            $mod = $difference % $daystime;
            $hour = floor($mod / 3600);
            $mod2 = $mod % 3600;
            $min = ceil($mod2 / 60);
            if ($today > 0) {
                $data['str'] = $today . "天" . $hour . "小时后结束";
            } else {
                $data['str'] = $hour . "小时" . $min . "分钟后结束";
            }

            $data['statu'] = 1;
        }
        return $data;
    }

    /**
     *
     * @todo 订单号生成
     *
     */
    public function createOrderSn() {
        $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $order_sn = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $order_sn;
    }

    /**
     *
     * @todo 验证手机号码是否合法
     *
     * @param $mobilephone 手机号号码
     *
     * @return 返回真假类型的结果
     *
     */
    public function checkPhone($mobilephone) {
        if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $mobilephone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @todo 邮箱服务查找
     *
     * @param $mail 注册邮箱
     *
     * @return 返回邮箱服务器商网站
     *
     */
    public function gotomail($mail) {
        $temp = explode('@', $mail);
        $t = strtolower($temp[1]);
        $web = array(
            '163.com' => 'mail.163.com',
            'vip.163.com' => 'vip.163.com',
            '126.com' => 'mail.126.com',
            'qq.com' => 'mail.qq.com',
            'vip.qq.com' => 'mail.qq.com',
            'foxmail.com' => 'mail.qq.com',
            'gmail.com' => 'mail.google.com',
            'sohu.com' => 'mail.sohu.com',
            'tom.com' => 'mail.tom.com',
            'vip.sina.com' => 'vip.sina.com',
            'sina.com.cn' => 'mail.sina.com.cn',
            'sina.com' => 'mail.sina.com.cn',
            'yahoo.com.cn' => 'mail.cn.yahoo.com',
            'yahoo.cn' => 'mail.cn.yahoo.com',
            'yeah.net' => 'www.yeah.net',
            '21cn.com' => 'mail.21cn.com',
            'hotmail.com' => 'www.hotmail.com',
            'sogou.com' => 'mail.sogou.com',
            '188.com' => 'www.188.com',
            '139.com' => 'mail.10086.cn',
            '189.cn' => 'webmail15.189.cn/webmail',
            'wo.com.cn' => 'mail.wo.com.cn/smsmail',
            '139.com' => 'mail.10086.cn'
        );
        if (isset($web[$t])) {
            return $web[$t];
        } else {
            return 'www.baidu.com';
        }
    }

    /**
     * 
     * @todo 过滤script标签
     *  
     * @param $str 要过滤的字符串
     * 
     * @return 返回一个字符串
     * 
     */
    public function cleanhtml($str, $tags = '') {//过滤时默认保留html中的<a><img>标签
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            /* '@<[\/\!]*?[^<>]*?>@si',        // Strip out HTML tags */
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly 
            '@<![\s\S]*?--[ \t\n\r]*>@'      // Strip multi-line comments including CDATA 
        );
        $str = preg_replace($search, '', $str);
        $str = strip_tags($str, $tags);
        return $str;
    }

    /**
     * 
     * @todo 远程图片下载 
     * 
     */
    public function downloadFileWithCurl($file_url, $save_to) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $file_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $file_content = curl_exec($ch);
        curl_close($ch);
        $downloaded_file = fopen($save_to, 'w');
        fwrite($downloaded_file, $file_content);
        fclose($downloaded_file);
        return true;
        
    }

}

?>
