<?php
?>

<div id="noticeItems">
</div>
<audio id="audioNotice" src="http://www.w3school.com.cn/i/song.mp3" controls="controls" style="display:none;">

</audio>

<script type="text/javascript">
    Date.prototype.Format = function (fmt) { //author: meizz
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    }

    $(function () {
        setInterval(refresh(), 1000 * 10);
    });
    
    function refresh() {
        $.get('/admin/api/new_msg.json',
            function (data) {

                if(data.status == 'err'){
                    $('#noticeItems').append('<p>[' + new Date().Format("yyyy-month-dd hh:mm:ss") + ']未获取新消息</p>');
                    return;
                }

                $('#noticeItems').append('<p>[' + new Date().Format("yyyy-month-dd hh:mm:ss") + ']有新消息</p>');
                playBell();
            }, 'json');
    }
    
    function playBell() {
        document.getElementById('audioNotice').play();
    }
</script>

