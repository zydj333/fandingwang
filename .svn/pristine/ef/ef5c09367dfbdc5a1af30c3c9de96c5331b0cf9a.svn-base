$(function() {
    var type = 'getuser';
    $.ajax({
        type: "POST",
        url: "/common/getUserLoginSession/" + Math.random(),
        data: {'type': type},
        dataType: "json",
        success: function(data) {
            str = '';
            if (data.user_id > 0) {
                str = '<li class="info">';
                str += '<img src="/' + data.avatar_middle + '" onerror="this.onerror=\'\';this.src=\'/images/share_head.png\'" />' + data.user_name;
                str += '<dl>';
                str += '<dd><a href="/usercenter">个人中心</a></dd>';
                str += '<dd><a href="/mysetting">账号设置</a></dd>';
                str += '<dd><a href="/usercenter">我的项目</a></dd>';
                str += '<dd><a href="/login/logout">退出</a></dd>';
                str += '</dl>';
                str += '</li>';
            } else {
                var str = '<li class="login"><a href="/login">登录</a><span>|</span><a href="/register">注册</a></li>'
            }
            $('.header .nav ul').append(str);
        }
    });
    /**
     * 警告
     * @param	{String}	消息内容
     */
    artDialog.alert = function(content, callback) {
        return artDialog({
            id: 'Alert',
            icon: 'warning',
            fixed: true,
            lock: true,
            content: content,
            ok: true,
            close: callback
        });
    };
})

//点击收藏
function docollect(id) {
    $.ajax({
        type: "POST",
        url: "/common/collection/" + Math.random(),
        data: {'pid': id},
        dataType: "json",
        success: function(data) {
            if (data.flag === 2) {
                $.dialog.alert(data.error);
                location.href = '/login';
            } else {
                $.dialog.alert(data.error);
            }
        }
    });
}



$(function() {
    /**
     * 警告
     * @param	{String}	消息内容
     */
    artDialog.alert = function(content, callback) {
        return artDialog({
            id: 'Alert',
            icon: 'warning',
            fixed: true,
            lock: true,
            content: content,
            ok: true,
            close: callback
        });
    };


    /**
     * 确认
     * @param	{String}	消息内容
     * @param	{Function}	确定按钮回调函数
     * @param	{Function}	取消按钮回调函数
     */
    artDialog.confirm = function(content, yes, no) {
        return artDialog({
            id: 'Confirm',
            icon: 'question',
            fixed: true,
            lock: true,
            opacity: .1,
            content: content,
            ok: function(here) {
                return yes.call(this, here);
            },
            cancel: function(here) {
                return no && no.call(this, here);
            }
        });
    };


    /**
     * 提问
     * @param	{String}	提问内容
     * @param	{Function}	回调函数. 接收参数：输入值
     * @param	{String}	默认值
     */
    artDialog.prompt = function(content, yes, value) {
        value = value || '';
        var input;

        return artDialog({
            id: 'Prompt',
            icon: 'question',
            fixed: true,
            lock: true,
            opacity: .1,
            content: [
                '<div style="margin-bottom:5px;font-size:12px">',
                content,
                '</div>',
                '<div>',
                '<input value="',
                value,
                '" style="width:18em;padding:6px 4px" />',
                '</div>'
            ].join(''),
            init: function() {
                input = this.DOM.content.find('input')[0];
                input.select();
                input.focus();
            },
            ok: function(here) {
                return yes && yes.call(this, input.value, here);
            },
            cancel: true
        });
    };


    /**
     * 短暂提示
     * @param	{String}	提示内容
     * @param	{Number}	显示时间 (默认1.5秒)
     */
    artDialog.tips = function(content, time) {
        return artDialog({
            id: 'Tips',
            title: false,
            cancel: false,
            fixed: true,
            lock: true
        })
                .content('<div style="padding: 0 1em;">' + content + '</div>')
                .time(time || 1);
    };


    $("#pay_order_now").click(function() {
        //var dialog = $.dialog({id: 'N3690', title: false}); 
        var order_num = $('#order_id_to_pay').val();
        $.ajax({
            url: '/order/pay_status/' + order_num + '/timer',
            success: function(data) {
                $.dialog({
                    lock: true,
                    background: '#DDD', // 背景色
                    opacity: 0.50, // 透明度
                    content: data,
                    icon: 'question'
                            //cancel: true
                });
            },
            cache: false
        });
    });
});


function is_mobile() {
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
    var u = navigator.userAgent;
    if (null === u) {
        return true;
    }
    var result = regex_match.exec(u);
    if (null === result) {
        return false
    } else {
        return true
    }
}
if (is_mobile()) {
    var web_url = window.location.pathname;
    var url_array = [];
    url_array = web_url.split("/");
    var redirect_url = '/mobile/index';
    var url_length = url_array.length;
    if (url_length === 0) {
        redirect_url = '/mobile/index';
    }
    if(url_length >= 2){//有一级目录
        if(url_array[1]==='index'){
            redirect_url = '/mobile/index';
        }else if(url_array[1]==='project'){
            redirect_url = '/mobile/project';
        }else if(url_array[1]==='shequ'){
            redirect_url = '/mobile/article';
        }else if(url_array[1]==='login'){
            redirect_url = '/mobile/login';
        }else if(url_array[1]==='register'){
            redirect_url = '/mobile/register';
        }else if(url_array[1]==='launch'){
            redirect_url = '/mobile/launch';
        }
    }
    
    if(url_length>=4){
        if(url_array[1]==='project' && url_array[2]==='detial'){
             redirect_url = '/mobile/projectDetial/'+url_array[3];
        }else if(url_array[1]==='shequ' && url_array[2]==='detial'){
            redirect_url = '/mobile/articleDetial/'+url_array[3];
        }
    }
    document.location.href = redirect_url;
}

