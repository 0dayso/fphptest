<style type="text/css">
.il{
    display: inline;
}
.modal-header{
    padding: 10px;
}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a data-toggle="tab" href="#main" aria-expanded="true">
						<i class="green ace-icon fa fa-home bigger-120"></i>
						主导航
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<a class="btn btn-default" data-toggle="modal" role-tip="添加一级类目" data-target="#addModal" style="margin-right:10px;float:right;"><i class="fa fa-plus"></i></a>
				<div id="main" class="tab-pane fade active in">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>标识</th>
								<th>导航名称</th>
								<th>链接地址</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($main_menu) && $main_menu){?>
								<?php foreach ($main_menu as $key => $value) { ?>
								<tr data-id="<?php echo $value['id'];?>" depth="1" tree="<?php echo $value['tree'];?>" parent="<?php echo $main_menu_parent->id;?>">
									<td><span><?php echo $value['id'];?></span></td>
									<td><span><?php echo $value['name'];?></span></td>
									<td><span><?php echo $value['url'];?></span></td>
									<td>
									<?php if($value['name'] == '首页'){ 

									}else{ ?>
									<a class="btn btn-sm btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
										<a class="btn btn-sm btn-primary" href="/admin/menu/details/<?php echo $value['id'];?>" title="编辑"><i class="fa fa-edit"></i></a>
										<a class="btn btn-sm btn-warning" title="移动" data-toggle="modal" data-target="#moveModal"><i class="fa fa-arrows"></i></a>
									<?php }?>
									</td>
								</tr>
								<style type="text/css">
								.btn-warning{background-color: #82af6f}
								</style>
								<?php if(isset($value['children'])){?>
									<?php foreach ($value['children'] as $v) { ?>	
										<tr data-id="<?php echo $v['id'];?>" depth="2" tree="<?php echo $v['tree'];?>" parent="<?php echo $value['id'];?>">
										<td><span><?php echo $v['id'];?></span></td>
										<td><span>---&nbsp;&nbsp;<?php echo $v['name'];?></span></td>
										<td><span><?php echo $v['url'];?></span></td>
										<td>
											<a class="btn btn-sm btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
											<a class="btn btn-sm btn-primary" href="/admin/menu/details/<?php echo $v['id'];?>" title="编辑"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-success" title="添加子类目" data-toggle="modal" data-target="#addModal"><i class="ace-icon glyphicon glyphicon-plus"></i></a>
											<a class="btn btn-sm btn-warning" title="移动" data-toggle="modal" data-target="#moveModal"><i class="fa fa-arrows"></i></a>
										</td>
									</tr>
									<?php if(isset($v['children'])){?>
									<?php foreach ($v['children'] as $cat) { ?>	
										<tr data-id="<?php echo $cat['id'];?>" depth="3" tree="<?php echo $cat['tree'];?>" parent="<?php echo $v['id'];?>">
										<td><span><?php echo $cat['id'];?></span></td>
										<td><span>-----&nbsp;&nbsp;<?php echo $cat['name'];?></span></td>
										<td><span><?php echo $cat['url'];?></span></td>
										<td>
											<a class="btn btn-sm btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
											<a class="btn btn-sm btn-primary" href="/admin/menu/details/<?php echo $cat['id'];?>" title="编辑"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-warning" title="移动" data-toggle="modal" data-target="#moveModal"><i class="fa fa-arrows"></i></a>
										</td>
									</tr>
									<?php }?>
								<?php }?>
									<?php }?>
								<?php }?>	
								<?php }?>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.col -->
</div>
<!-- 新树模态框 -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="treeModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="treeModalTitle">添加导航</h4>
            </div>
            <div class="modal-body">
                <form id="addFirstNav" name="addFirstNav" action="/admin/category/create" method="POST" class="form-horizontal" style="border-bottom: 0px;">                    
                    <div class="control-group" style="border-bottom: 0px;">
                        <label class="control-label">导航名称</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="name"/>
                        </div>
                    </div>
                    <div class="control-group" style="border-bottom: 0px;">
                        <label class="control-label">别名</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="alias"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                    	<input type="hidden" value="2" name="parent">
                    	<input type="hidden" value="1" name="depth">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        <button type="button" id="btnAddFirstNav" name="btnAddFirstNav" class="btn btn-primary"> 保存设置 </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- 节点移动模态框 -->
<div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="moveModalTitle">节点移动</h4>
            </div>
            <div class="modal-body">
                <input id="source" type="text" value="" class="form-control il" style="width: 120px;" readonly="readonly" data-id=""/>
                移动至
                <select class="form-control il" style="width: 120px;" id="traget">
                    <option>目标节点</option>
                </select>
                <select class="form-control il" style="width: 120px;" id="method">
                    <option value="previous_sibling">之前</option>
                    <option value="next_sibling">之后</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button id="btnSubmitMove" class="btn btn-primary"> 确认移动 </button>
            </div>
        </div>
    </div>
</div>


<?php echo render('ace/public/alert_message'); ?>
<?php echo render('ace/public/confirm_modal'); ?>
<script type="text/javascript">
//触发删除对象的a标签
var a;
//确认删除后的回调方法
function confirmDelete(result) {
    if(result) {
        var i = $(a).find('i');
        var self = $(a).parents('tr');

        $(a).addClass('disabled');
        $(i).addClass('fa-spinner').addClass('fa-spin').removeClass('fa-trash-o');

        $.get('/admin/category/delete/' + self.attr('data-id'), 
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

<script type="text/javascript" src="/assets/js/tools.js"></script>

<script type="text/javascript">
var ynLock = false;//锁定操作
$(function(){

    $(document).delegate('a[data-target="#moveModal"]', 'click', function(){
        var tr = $(this).parents('tr');

        $('#source').attr('data-id', tr.attr('data-id'));
        $('#source').val(tr.find('td:eq(1)').text());

        $('#traget').empty();
        $('#traget').append("<option value='0'>目标节点</option>");
        tr.parent().find('tr').each(function(){
            if(tr.attr('depth') != $(this).attr('depth')){
                return;
            }else if(tr.attr('data-id') == $(this).attr('data-id')){
                return;
            }

            if(tr.attr('parent') == $(this).attr('parent')){
            	$('#traget').append('<option value="' + $(this).attr('data-id') + '">' + $(this).find('td:eq(1)').text() + '</option>');
            }
            
        });
    });

    //确认移动
    $('#btnSubmitMove').click(function(){
    	if($('#traget').val() == 0){
    		alert('请选择目标节点');
    		return;
    	}

    	if(ynLock){
    		alert('系统繁忙，请稍候再试！');
    		return;
    	}

    	ynLock = true;
        $.post('/admin/category/move/' + $('#source').attr('data-id') + '/' + $('#traget').val() + '/' + $('#method').val(), 
            function(data, status){
            	ynLock = false;
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                window.location.reload();
            }, 'json');
    });

    $('#btnAddFirstNav').click(function(){
    	var url = '/admin/category/create/';
    	
        $.post(url, 
            {
                name: $('#addFirstNav').find('input[name="name"]').val(),
                alias: $('#addFirstNav').find('input[name="alias"]').val(),
                parent: $('#addFirstNav').find('input[name="parent"]').val(),
                depth: $('#addFirstNav').find('input[name="depth"]').val(),
            },
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                }

                window.location.reload();
            }, 'json');
    	
    });
})
</script>