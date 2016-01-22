<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Sms {
	function Sms() {
		log_message ( 'debug', "error_report Class Initialized" );
		$this->CI = &get_instance ();
		$this->CI->load->library('session');
		$this->CI->load->helper('cookie');
	}
	
	function sendSms($mobile,$content){
		$this->CI->load->library('nusoap_lib');
		
		$webService_url = "http://jiekou.ruan56.com/WebServiceInterface.asmx";
		$comid = "158"; //企业ID
		$username = "liangan"; //用户名
		$userpwd = "nagnail168dl"; //密码
		$smsnumber = "1061"; //所用平台
		
	
		$handtel = $mobile; //手机号
		$sendcontent = $content ;
		$sendtime = ""; //定时时间
		
		$proxyhost = isset ( $_POST ['proxyhost'] ) ? $_POST ['proxyhost'] : '';
		$proxyport = isset ( $_POST ['proxyport'] ) ? $_POST ['proxyport'] : '';
		$proxyusername = isset ( $_POST ['proxyusername'] ) ? $_POST ['proxyusername'] : '';
		$proxypassword = isset ( $_POST ['proxypassword'] ) ? $_POST ['proxypassword'] : '';
		$this->CI->nusoap_client = new nusoap_client ( $webService_url . '?wsdl', 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword );
		$this->CI->nusoap_client->soap_defencoding = 'utf-8';
		$this->CI->nusoap_client->decode_utf8 = false;
		$result = $this->CI->nusoap_client->call ( "SendNote", array ("handtels" => $handtel, "_content" => $sendcontent, "userName" => $username, "password" => $userpwd, "cid" => $comid, "_sendtime" => "", "_smsnumber" => $smsnumber ) );
		if ($this->CI->nusoap_client->fault) {
			$back = $result ['SendNoteResult'];
		} else {
			$err = $this->CI->nusoap_client->getError ();
			if ($err) {
				$back = 'error';
			} else {
				$back = $result ['SendNoteResult'];
			}
		}
		return $back ;
	}
}

?>