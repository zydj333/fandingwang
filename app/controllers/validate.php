<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of varify
 * 验证码生成文件
 * @author zhangping'an
 * @creatTime 2012-4-2 19:44:27
 *
 */
//class Validate extends CI_Controller {

/**
 *
 * 构造方法
 *
 */
// function __construct() {
//     parent::__construct();
// }

/**
 *
 * 生成验证码
 *
 */
/* public function login() {
  $w = 120; //设置图片宽和高
  $h = 50;
  $str = Array(); //用来存储随机码�����
  //$string = "123456789"; //随机挑选其中4个字符，也可以选择更多，注意循环的时候加上，宽度适当调整
  $str[0] = rand(1, 9);
  $str[1] = rand(1, 9);
  $str[2] = rand(1, 9);
  $str[3] = rand(1, 9);
  $str[4] = rand(1, 9);
  $vcode = $str[0] . $str[1] . $str[2] . $str[3] . $str[4];
  //echo $vcode;exit;
  $im = imagecreatetruecolor($w, $h);
  $white = imagecolorallocate($im, 255, 255, 255); //第一次调用设置背景色
  $black = imagecolorallocate($im, 220, 220, 220); //边框颜色
  imagefilledrectangle($im, 0, 0, $w, $h, $white); //画一矩形填充
  imagerectangle($im, 0, 0, $w - 1, $h - 1, $black); //画一矩形框
  for ($i = 1; $i < 200; $i++) {
  $x = mt_rand(1, $w - 5);
  $y = mt_rand(1, $h - 10);
  $color = imagecolorallocate($im, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255));
  imagechar($im, 2, $x, $y, "*", $color);
  }
  for ($i = 0; $i < count($str) + 1; $i++) {
  $x = 10 + $i * ($w) / 5;
  $y = mt_rand(15,30);
  $color = imagecolorallocate($im, 225, 0, 0);
  imagechar($im,12, $x, $y, $str[$i], $color);
  }
  $this->comm->set_session('loginCode', $vcode);
  ob_clean();
  header("Content-type:image/jpeg");
  imagejpeg($im);
  imagedestroy($im);
  }

  } */

//验证码类
class Validate extends CI_Controller {

    private $charset = '123456789';    //随机因子
    private $code;                            //验证码
    private $codelen = 4;                    //验证码长度
    private $width = 200;                    //宽度
    private $height = 34;                    //高度
    private $img;                                //图形资源句柄
    private $font;                                //指定的字体
    private $fontsize = 20;                //指定字体大小
    private $fontcolor;                        //指定字体颜色

    //构造方法初始化

    public function __construct() {
        parent::__construct();
        $this->font = FCPATH.'/fonts/elephant.ttf';
    }

    //生成随机码
    private function createCode() {
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $_len)];
        }
        $this->comm->set_session('varifyCode',  $this->code);
    }

    //生成背景
    private function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //生成文字
    private function createFont() {
        $_x = $this->width / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5), $this->height / 1.4, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }

    //生成线条、雪花
    private function createLine() {
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    //输出
    private function outPut() {
        ob_clean();
        header('Content-type:image/jpeg');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    //对外生成
    public function doimg() {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    //获取验证码
    public function getCode() {
        return strtolower($this->code);
    }

}

?>
