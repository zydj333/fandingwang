<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array();
$config['template_dir'] = APPPATH . 'views/';    //模板目录
$config['cache_dir'] = APPPATH . 'cache/caches/';   //缓存目录
$config['compile_dir'] = APPPATH . 'cache/templates_r/'; //编译目录
$config['caching'] = false;    //是否启用缓存
$config['cache_lifetime'] = 300;  //缓存时间
$config['force_compile'] = 1;
$config['compile_check'] = TRUE; //每次是否检查模板是否改动
$config['left_delimiter'] = '<{';
$config['right_delimiter'] = '}>';
?>
