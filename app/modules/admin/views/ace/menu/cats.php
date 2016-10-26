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
			<div class="tab-content">
				<a class="btn btn-default" name="addCategory" data-toggle="modal" role-tip="添加类目" data-target="#addModal" style="margin-right:10px;float:right;"><i class="fa fa-plus"></i></a>
				<div id="main" class="tab-pane fade active in">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>标识</th>
								<th>栏目名称</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($main_menu) && $main_menu){?>
								<?php foreach ($main_menu as $key => $value) { ?>
								<tr data-id="<?php echo $value['id'];?>" data-depth="1" data-tree="<?php echo $value['tree'];?>" data-parent="1" data-module="<?php echo $value['module'];?>">
									<td><span><?php echo $value['id'];?></span></td>
									<td><span><?php echo $value['name'];?></span></td>
									<td>
                                        <a class="btn btn-sm btn-danger <?php echo $value['depth'] == 1 ? 'hide': '';?>" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
                                        <a class="btn btn-sm btn-primary" name="editCategory" title="编辑" data-toggle="modal" role-tip="编辑类目" data-target="#addModal"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-warning" title="移动" data-toggle="modal" data-target="#moveModal"><i class="fa fa-arrows"></i></a>
                                    </td>
								</tr>
								<?php if(isset($value['children'])){?>
									<?php foreach ($value['children'] as $v) { ?>	
										<tr data-id="<?php echo $v['id'];?>" data-depth="2" data-tree="<?php echo $v['tree'];?>" data-parent="<?php echo $value['id'];?>" data-module="<?php echo $v['module'];?>">
    										<td><span><?php echo $v['id'];?></span></td>
    										<td><span>---&nbsp;&nbsp;<?php echo $v['name'];?></span></td>										
    										<td>
    											<a class="btn btn-sm btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
    											<a class="btn btn-sm btn-primary" name="editCategory" title="编辑" data-toggle="modal" role-tip="编辑类目" data-target="#addModal"><i class="fa fa-edit"></i></a>
    											<a class="btn btn-sm btn-warning" title="移动" data-toggle="modal" data-target="#moveModal"><i class="fa fa-arrows"></i></a>
    										</td>
    									</tr>
									<?php if(isset($v['children'])){?>
									<?php foreach ($v['children'] as $cat) { ?>	
										<tr data-id="<?php echo $cat['id'];?>" data-depth="3" data-tree="<?php echo $cat['tree'];?>" data-parent="<?php echo $v['id'];?>" data-module="<?php echo $cat['module'];?>">
    										<td><span><?php echo $cat['id'];?></span></td>
    										<td><span>-----&nbsp;&nbsp;<?php echo $cat['name'];?></span></td>
    										<td>
    											<a class="btn btn-sm btn-danger" title="删除" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash-o"></i></a>
    											<a class="btn btn-sm btn-primary" name="editCategory" title="编辑" data-toggle="modal" role-tip="编辑类目" data-target="#addModal"><i class="fa fa-edit"></i></a>
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
                <h4 class="modal-title" id="treeModalTitle">添加栏目</h4>
            </div>
            <div class="modal-body">
                <form id="addFirstNav" name="addFirstNav" class="form-horizontal" style="border-bottom: 0px;">                    
                    <div class="control-group">
                        <label class="control-label">栏目名称</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="name"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">上级类目</label>
                        <div class="controls">
                        	<select name="parent" class="form-control">
                                <option value="0">-=上级类目=-</option>
                        		<?php if(isset($menu_contents) && $menu_contents){?>
	                        		<?php foreach ($menu_contents as $key => $value) { ?>
	                        			<option value="<?php echo $value->id;?>" data-depth="<?php echo $value->depth;?>">
                                            <?php if($value->depth == 2){echo '--';}else if($value->depth == 3){echo '----';}?>
                                            <?php echo $value->name;?></option>
	                        		<?php }?>
                        		<?php }?>
                        	</select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">模块类别</label>
                        <div class="controls">
                            <label>
                                <input name="module" type="radio" class="ace" value="">
                                <span class="lbl"> 无</span>
                            </label>
                            <label>
                                <input name="module" type="radio" class="ace" value="article">
                                <span class="lbl"> 图文形式</span>
                            </label>
                            <label>
                                <input name="module" type="radio" class="ace" value="case">
                                <span class="lbl"> 产品形式</span>
                            </label>
                            <label>
                                <input name="module" type="radio" class="ace" value="page">
                                <span class="lbl"> 自定义单页</span>
                            </label>
                            <!--
                            <label>
                                <input name="module" type="radio" class="ace" value="case/details">
                                <span class="lbl"> 产品详情</span>
                            </label>
                            <label>
                                <input name="module" type="radio" class="ace" value="case/lunbo">
                                <span class="lbl"> 产品轮播</span>
                            </label>-->
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top:10px;">
                    	<input type="hidden" value="" name="alias">
                    	<input type="hidden" value="1" name="depth">
                        <input type="hidden" value="1" name="tree">
                        <input type="hidden" value="0" name="entity_id">
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

    //触发添加编辑栏目时
    $(document).delegate('a[data-target="#addModal"]', 'click', function(){
        var name = ''
        var alias = '';
        var parent = 0;
        var depth = 0;
        var module = '';
        var entity_id = 0;
        var tree = 1;

        $('#treeModalTitle').text($(this).attr('role-tip'));//更换 对话框标题

        if($(this).attr('name') == 'editCategory'){
            reAll=new RegExp("-","g");
            name = $(this).parent().parent().find('td').eq(1).text();
            name = name.replace(reAll,"");
            alias = $(this).parent().parent().attr('data-alias');
            depth = $(this).parent().parent().attr('data-depth');
            module = $(this).parent().parent().attr('data-module');
            entity_id = $(this).parent().parent().attr('data-id');
            parent = $(this).parent().parent().attr('data-parent');
            tree = $(this).parent().parent().attr('data-tree');

            $("select[name='parent']").find("option[value='"+parent+"']").attr("selected",true);
            //选中
        }else{
            //是否选择了上级
            parent = $('select[name="parent"]').find('option:selected').val();
            if(parent == 0 || parent == undefined){
                parent = 1;//网站类目
            }
        }

        $('#addModal').find('input[name="name"]').val(name);
        $('#addModal').find('input[name="alias"]').val(alias);
        $('#addModal').find('input[name="depth"]').val(depth);
        $('#addModal').find('input[name="parent"]').val(parent);
        $('#addModal').find('input[name="entity_id"]').val(entity_id);
        $('#addModal').find('input[name="tree"]').val(tree);
        $('input[name="module"][value="'+module+'"]').attr("checked",true);
    });

    //确认添加或编辑栏目
    $('#btnAddFirstNav').click(function(){
        var optionEle = $('select[name="parent"]').find('option:selected');        
        if(optionEle.val() == 0 || optionEle.val() == undefined){
            $('select[name="parent"]').parent().prev().append("<label class='control-label' style='color:red;font-size:12px;padding-left:20px;''>*请选择上级分类</label>");
            return;
        }

        var data = {
            name: $.trim($('#addFirstNav').find('input[name="name"]').val()),
            alias: $('#addFirstNav').find('input[name="alias"]').val(),
            parent: optionEle.val(),
            depth: parseInt(optionEle.attr('data-depth'))+1,
            module: $('input[name="module"]:checked').val(),
            tree:$('#addFirstNav').find('input[name="tree"]').val(),
        };

    	var url = '/admin/category/create/';

        if($('#treeModalTitle').text() == '编辑类目'){
            url = '/admin/category/edit/'+$('input[name="entity_id"]').val();
        }
    	
        $.post(url, data,
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                }

                window.location.reload();
            }, 'json');
    	
    });
})
</script>