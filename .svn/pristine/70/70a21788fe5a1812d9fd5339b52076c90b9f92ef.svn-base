<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_image
 *
 * @createtime 2014-10-22 14:25:41
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class Admin_image extends CI_Controller {

    /**
     *
     * @todo 定义属性
     *
     */
    protected $user_name = "";
    protected $user_id = "";
    protected $auth = "";
    protected $pagesize = 10;
    protected $datetime = '';
    /**
     * 图片操作配置文件
     */
    //大图
    protected $config_middle = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'create_thumb' => TRUE,
        'maintain_ratio' => TRUE,
        'thumb_marker' => "_middle",
        'width' => 223,
        'height' => 165
    );
    protected $config_small = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'create_thumb' => TRUE,
        'maintain_ratio' => TRUE,
        'thumb_marker' => "_small",
        'width' => 50,
        'height' => 30
    );
   /* protected $config_marker = array(
        'image_library' => 'GD2',
        'source_image' => '/path/to/image/mypic.jpg',
        'wm_text' => 'Copyright 2014 - Aman安',
        'wm_type' => 'text',
        //'wm_font_path' => '/fonts/fontawesome-webfont.ttf',
        'wm_font_size' => '28',
        'wm_font_color' => 'ffffff',
        'wm_vrt_alignment' => 'bottom',
        'wm_hor_alignment' => 'center',
        'wm_padding' => '20',
    );
*/
//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_image_model');
        $this->load->library('image_lib');
    }

    /**
     *
     * @todo 上传
     *
     */
    public function upload() {
        $ajaxData = array(
            "flag" => 0,
            'error' => '',
            'imageid' => 0,
            'imgurl' => ''
        );
        $fileElementName = 'fileToUpload';
        if (!empty($_FILES[$fileElementName]['error'])) {
            switch ($_FILES[$fileElementName]['error']) {
                case '1':
                    $ajaxData['error'] = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 ';
                    break;
                case '2':
                    $ajaxData['error'] = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ';
                    break;
                case '3':
                    $ajaxData['error'] = '文件只有部分被上传。 ';
                    break;
                case '4':
                    $ajaxData['error'] = '没有文件被上传。';
                    break;

                case '6':
                    $ajaxData['error'] = '找不到临时文件夹。';
                    break;
                case '7':
                    $ajaxData['error'] = '文件写入失败。';
                    break;
                case '8':
                    $ajaxData['error'] = '上传停止';
                    break;
                case '999':
                default:
                    $ajaxData['error'] = '没有获取到具体错误';
            }
        } elseif (empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none') {
            $ajaxData['error'] = '没有上传的文件..';
        } else {
            $imgtype = $this->input->post("imagetype") ? $this->input->post("imagetype") : 'items';
            $path = "upload/" . $imgtype . "/" . date("Ym") . "/";
            $imagename = $_FILES['fileToUpload']['name'];
            $filetmpname = $_FILES['fileToUpload']['tmp_name'];
            $file = explode('.', $imagename);
            $houzui = $file[count($file) - 1];
            $file_size = $_FILES['fileToUpload']['size'];
            $secondname = array(
                0 => 'jpg',
                1 => 'jpeg',
                2 => 'gif',
                3 => 'png',
                4 => 'PNG',
                5 => 'JPG',
                6 => 'JPEG',
                7 => 'GIF',
            );
            if (!in_array($houzui, $secondname)) {
                $ajaxData['error'] = "上传的文件类型只能为:png,jpeg,jpg,gif";
            }
            if (!file_exists($path)) {
                mkdir($path, 0777);
            }
            $filename = explode(".", $imagename); //把上传的文件名以“.”好为准做一个数组
            $filename[0] = time();
            $name = implode(".", $filename); //上传后的文件名
            $filename[0] = time() . "_thumb";
            $thumb = implode(".", $filename);
            $thumburl = $path . $thumb;
            $uploadfile = $path . $name; //上传后的文件名地址
            if (move_uploaded_file($filetmpname, $uploadfile)) {
                $imgid = 0;
                $data = array(
                    'imagetype' => $imgtype,
                    'imageurl' => $uploadfile
                );
                $pic_id = $this->admin_image_model->saveImg($data);
                if ($pic_id > 0) {
                    $this->config_middle['source_image'] = './' . $uploadfile;
                    $this->image_lib->initialize($this->config_middle);
                    $this->image_lib->resize();
                    $this->config_small['source_image'] = './' . $uploadfile;
                    $this->image_lib->initialize($this->config_small);
                    $this->image_lib->resize();
                    /*$this->config_marker['source_image'] = './' . $uploadfile;
                    $this->image_lib->initialize($this->config_marker);
                    $this->image_lib->watermark();*/
                    $img = explode(".", $uploadfile);
                    $ajaxData["flag"] = 1;
                    $ajaxData['error'] = '上传成功';
                    $ajaxData['imageid'] = $pic_id;
                    $ajaxData['imgurl'] = $uploadfile;
                    $ajaxData['imgurl_middle'] =$img[0] . "_middle." . $img[1];
                    $ajaxData['imgurl_thumb'] = $img[0] . "_small." . $img[1];
                } else {
                    $ajaxData['error'] = "上传图片失败，错误未知";
                }
            } else {
                $ajaxData['error'] = "上传图片失败，请重新上传";
            }
        }
        echo json_encode($ajaxData);
    }

}

?>
