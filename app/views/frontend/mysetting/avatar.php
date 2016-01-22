<div class="member">
    <div class="userCenter">
        <div class="head">
            <h2 class="yh">头像上传</h2>
        </div>
        <script type="text/javascript" src="/js/swfobject.js"></script>
        <script type="text/javascript" src="/js/fullAvatarEditor.js"></script>
        <div>
            <p id="swfContainer"> </p>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    swfobject.addDomLoadEvent(function() {
        var swf = new fullAvatarEditor("swfContainer", {
            id: 'swf',
            upload_url: '/mysetting/saveavater/' + Math.random(),
            src_upload: 2
        }, function(msg) {
            switch (msg.code)
            {

                //case 1 : alert("页面成功加载了组件！");break;
                //case 2 : alert("已成功加载默认指定的图片到编辑面板。");break;
                case 3 :
                    if (msg.type == 0)
                    {
                        $.dialog.alert('摄像头已准备就绪且用户已允许使用');
                    }
                    else if (msg.type == 1)
                    {
                        $.dialog.alert('摄像头已准备就绪但用户未允许使用');
                    }
                    else
                    {
                        $.dialog.alert('摄像头被占用');
                    }
                    break;
                case 5 :
                    if (msg.type == 0)
                    {
                        $.dialog.alert('头像已经上传!');
                        location.href = '/mysetting';
                    }
                    break;
            }
        }
        );

    });
</script>