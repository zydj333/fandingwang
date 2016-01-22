/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function is_mobile() {
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
    var u = navigator.userAgent;
    if (null === u) {
        return true;
    }
    var result = regex_match.exec(u);
    if (null === result) {
        return false;
    } else {
        return true;
    }
}
if (!is_mobile()) {
    var web_url = window.location.pathname;
    var url_array = [];
    url_array = web_url.split("/");
    var redirect_url = '/';
    var url_length = url_array.length;
    if (url_length <= 4) {
        //当有一级目录时
        if (url_length >= 2) {
            if (url_array[1] === 'mobile') {
                redirect_url = '/';
            }
        }
        //当含有二级目录时
        if (url_length >= 3) {
            if (url_array[2] === 'project') { //项目列表
                redirect_url = '/project';
            }else if (url_array[2] === 'projectDetial') {//项目详情
                redirect_url = '/project/detial/'+url_array[3];
            } else if (url_array[2] === 'register') { //注册
                redirect_url = '/register';
            }else if (url_array[2] === 'login') { //登录
                redirect_url = '/login';
            }else if (url_array[2] === 'launch') { //发起众筹
                redirect_url = '/launch';
            }else if (url_array[2] === 'article') { //资讯
                redirect_url = '/shequ';
            }else if (url_array[2] === 'articleDetial') { //资讯详情
                redirect_url = '/shequ/detial/'+url_array[3];
            }else if (url_array[2] === 'sina') { //新浪
                redirect_url = '/sina/getSinaInfo/'+url_array[3];
            }else if (url_array[2] === 'tencent') { //QQ
                redirect_url = '/wechatlogin/index/'+url_array[3];;
            }
        }
        document.location.href = redirect_url;
    }    
}