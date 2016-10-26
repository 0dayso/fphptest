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
					<th>用户名</th>
					<th>邮箱</th>
					<th>手机号码</th>
					<th>注册日期</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $key => $value) { ?>
				<tr data-id="<?php echo $value->id;?>">
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->real_name; ?></td>						
					<td><?php echo $value->email; ?></td>
					<td><?php echo $value->phone; ?></td>
					<td><?php echo date('Y-m-d',$value->created_at); ?></td>	
					<td>
						<div class="hidden-sm hidden-xs btn-group">
							<!-- <a href="/admin/people/save/<?php //echo $value->id;?>" class="btn btn-xs btn-info" title="编辑">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
							</a>-->
							<a role="delete" class="btn btn-xs btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</a>
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
</div>
<?php echo render('ace/public/alert_message'); ?>
<?php echo render('ace/public/confirm_modal'); ?>

<script type="text/javascript">
var oldkeyword = '<?php echo \Input::get("keyword",false) ? \Input::get("keyword"): '';?>';
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
