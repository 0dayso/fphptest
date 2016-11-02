<div class="row">
	<div clsss="col-xs-12">
		<div class="clearfix" style="text-align: right; padding-right: 12px;">
			<div class="col-xs-11"><form id="searchfrm" name="searchfrm" action="/admin/people/index" method="GET" >搜索&nbsp;&nbsp;<input type="search" id="keyword" name="keyword"class="" aria-controls="simple-table" placeholder="输入用户名搜索..."  value="<?php echo \Input::get('keyword',false) ? \Input::get('keyword'): '';?>"></form></div>
			<div class="btn-group" role="group" aria-label="First group">
				<!--<button id="btnSearch" type="button" class="btn btn-default"><i class="fa fa-search"></i></button>-->
				<!--<a type="button" class="btn btn-default" href="/admin/member/save"><i class="fa fa-plus"></i></a>-->
				<!--<button id="btnExport" type="button" class="btn btn-default"><i class="fa fa-file-excel-o"></i></button>
				<button id="btnRefresh" type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>-->
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top: 10px;">	
	<div class="col-xs-12">
		<?php if(isset($items) && $items){ ?>
		<table id="simple-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>登录类型</th>
					<th>登录名</th>
					<th>登录密码</th>
					<th>来源</th>
					<th>请求时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $key => $value) { ?>
				<tr data-id="<?php echo $value->id;?>">
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->logintype; ?></td>						
					<td><?php echo $value->loginuser; ?></td>
					<td><?php echo $value->loginpwd; ?></td>
					<td><?php echo $value->reg_from; ?></td>
					<td><?php echo date('Y-m-d',$value->created_at); ?></td>	
					<td>
						<div class="hidden-sm hidden-xs btn-group">
							<a class="btn btn-xs btn-info btn-cmd" data-type="pass" data-id="<?php echo $value->id; ?>" title="通过">
								<i class="glyphicon glyphicon-ok bigger-120"></i>
							</a>							
							<a class="btn btn-xs btn-warning btn-cmd" data-type="nopass" data-id="<?php echo $value->id; ?>" title="驳回">
								<i class="glyphicon glyphicon-remove bigger-120"></i>
							</a>
							<!--<a role="delete" class="btn btn-xs btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</a>-->
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			<?php if(isset($pagination) && $pagination){ ?>
			<tfoot>
				<tr>
					<td colspan="10" style="text-align: right;">
						<?php echo isset($pagination) && $pagination ? htmlspecialchars_decode($pagination) : ''; ?>
					</td>
				</tr>
			</tfoot>
			<?php } ?>
		</table>
		<?php }else{ ?>
		<div style="border: 1px solid #e0e0e0; line-height: 300px; width: 100%; text-align: center;">
			未找到相关数据
			<?php if(\Input::get('keyword',false)){?>
			<div class="btn-group" role="group" aria-label="First group" >
				<a type="button" style="background-color: #4f99c6 !important;
border-color: #6fb3e0;" class="btn btn-default" href="/admin/people"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回</a>
			</div><?php }?>
		</div>
		<?php } ?>
	</div><!-- /.span -->



<div id="noticeItems" style="display:none;">
</div>
<audio id="audioNotice" src="http://www.w3school.com.cn/i/song.mp3" controls="controls" style="display:none;">
</audio>
</div>
<?php echo render('ace/public/alert_message'); ?>
<?php echo render('ace/public/confirm_modal'); ?>

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
    });
    
    function refresh() {
        $.get('/admin/api/checknews',
            function (data) {
                if(data.status == 'err'){
                    $('#noticeItems').append('<p>[' + new Date().Format("yyyy-month-dd hh:mm:ss") + ']未获取新消息</p>');
                    return;
                }
                showResultMessage('有'+data.rows+'新消息', '', 'success');
                playBell();
            }, 'json');
    }
    
    function playBell() {
        document.getElementById('audioNotice').play();
    }
</script>
<script type="text/javascript">
var oldkeyword = '<?php echo \Input::get("keyword",false) ? \Input::get("keyword"): '';?>';
var lockAjax = false;
$(function(){
	$('#keyword').blur(function(){		
		if($.trim($(this).val()) == ""){
			return;
		}

		if(oldkeyword == $.trim($(this).val())){
			return;
		}

		$('#searchfrm').submit();
	});

	$('#simple-table').delegate(".btn-cmd","click",function(){
		if(lockAjax){
			alert('正在处理。。。');
			console.log("请等候。。。。。。。");
			return;
		}
		var t = $(this).attr('data-type');
		var id = $(this).attr('data-id');
		$.post('/admin/people/notice?type='+t+'&id='+id, 
            function(data, status){
            	if(data.status == 'err'){
            		showResultMessage('操作失败', '', 'danger');
            		return;
            	}

                 location.reload();
            }, 'json');
	});
});
//触发删除对象的a标签
var a;
//确认删除后的回调方法
function confirmDelete(result) {
    if(result) {
        var i = $(a).find('i');
        var self = $(a).parents('tr');

        $(a).addClass('disabled');
        $(i).addClass('fa-spinner').addClass('fa-spin').removeClass('fa-trash-o');

        $.post('/admin/people/delete/' + self.attr('data-id'), 
            function(data, status){
                $(a).removeClass('disabled');
                $(i).removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-trash-o');
                if(data.status == 'err'){
                    showResultMessage('删除失败', '', 'danger');
                    return;
                }
                showResultMessage('删除成功', '', 'success');
                self.remove();
            }, 'json');
    }
}


</script>
