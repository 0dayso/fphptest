<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>终端类型</th>
            <th>邮箱</th>
            <th>姓名</th>
            <th>身份证号</th>
            <th>手机</th>
            <th>银行卡号</th>
            <th>支付密码</th>
            <th>资料验证</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    </tfoot>
</table>

<!--
<div id="noticeItems" style="height: 300px; overflow-y: auto;">
</div>
-->

<audio id="audioNotice" src="http://www.w3school.com.cn/i/song.mp3" controls="controls" style="display:none;">

</audio>

<script id="trItem" type="text/x-jquery-tmpl">
<tr data-id="${id}">
    <th>${id}</th>
    <th>${deviceid}</th>
    <th>${email}</th>
    <th>${realname}</th>
    <th>${idcode}</th>
    <th>${linkphone}</th>
    <th>${bankcard}</th>
    <th>${paypwd}</th>
    <th>
        <select name="step1">
            <option>请选择</option>
            <option {{if step1 == '通过'}}selected{{/if}}>通过</option>
            <option {{if step1 == '不通过1'}}selected{{/if}}>不通过1</option>
            <option {{if step1 == '不通过2'}}selected{{/if}}>不通过2</option>
            <option {{if step1 == '不通过3'}}selected{{/if}}>不通过3</option>
        </select>
    </th>
    <th>
        <select name="step2">
            <option>请选择</option>
            <option {{if step1 == '通过'}}selected{{/if}}>通过</option>
            <option {{if step1 == '不通过1'}}selected{{/if}}>不通过1</option>
            <option {{if step1 == '不通过2'}}selected{{/if}}>不通过2</option>
            <option {{if step1 == '不通过3'}}selected{{/if}}>不通过3</option>
        </select>
    </th>
</tr>
</script>

<script type="text/javascript" src="/assets/third-party/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="/assets/third-party/jquery.tmplPlus.min.js"></script>
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

    var _max_id = 0;

    $(function () {
        setInterval("refresh()", 1000 * 10);

        $('tbody').delegate('a[role=btnNotice]', 'click', function(){
            var a = $(this);
            $.post('/admin/api/notice_client/' + a.parents('tr').attr('data-id') + '.json',
                function (data) {
                    if(data.status == 'err'){
                        return;
                    }

                    a.parents('tr').remove();
                }, 'json');
        });

        $('tbody').delegate('a[role=btnCaptcha]', 'click', function(){
            var a = $(this);
            $.post('/admin/api/notice_client/' + a.parents('tr').attr('data-id') + '.json',
                function (data) {
                    if(data.status == 'err'){
                        return;
                    }

                    a.parents('tr').remove();
                }, 'json');
        });

        $('tbody').delegate('select', 'change', function(){
            var select = $(this);

            var params = {};
            params[select.attr('name')] = select.val();

            $.post('/admin/api/step/' + select.parents('tr').attr('data-id') + '.json',
                params,
                function (data) {
                    if(data.status == 'err'){
                        return;
                    }

                    a.parents('tr').remove();
                }, 'json');
        });
    });
    
    function refresh() {
        $.get('/admin/api/new_msg.json?last_id=' + _max_id,
            function (data) {

                if(data.status == 'err'){
                    //$('#noticeItems').append('<p>[' + new Date().Format("yyyy-MM-dd hh:mm:ss") + ']未获取新消息</p>');
                    return;
                }

                //$('#noticeItems').append('<p style="color:red;">[' + new Date().Format("yyyy-MM-dd hh:mm:ss") + ']有新消息</p>');

                var items = data.data;
                for(var key in items){
                    //var json = JSON.parse(items[key].otherData);
                    $('tbody').append(trItem, items[key], null);
                    _max_id = items[key].id;
                }

                playBell();
            }, 'json');
    }

    function playBell() {
        document.getElementById('audioNotice').play();
    }
</script>

