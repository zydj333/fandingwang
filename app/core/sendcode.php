<?php
//$start=date('Y-m-d H:i:s',  time());
// 初始化一个 cURL 对象
$curl = curl_init();
// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL, 'http://www.aizhongchou.com/admin_phonecode/sendCode');
// 设置header
curl_setopt($curl, CURLOPT_HEADER, 0);
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 5);
curl_setopt($curl, CURLOPT_POST, 1); //post提交方式
// 运行cURL，请求网页
$data = curl_exec($curl);
curl_close($curl);
//$end=date('Y-m-d H:i:s',  time());
//$fp=fopen("/alidata/script/sendcode.log",'a+');
//$content='start:'.$start.'--------end:'.$end.'\r\n';
//fwrite($fp,$content);
//fclose($fp);
?>
