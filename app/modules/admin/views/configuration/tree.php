<style type="text/css">
#control-panel select{
    width: 150px;
}
.il{
    display: inline;
}
.modal-header{
    padding: 10px;
}
</style>
<div class="container">
    <div class="row" style="margin-top: 55px;">
        <div class="col-md-12">
            <div id="control-panel">
                <select id="roots" class="form-control il">
                    <?php $json = array(); ?>
                    <?php foreach ($roots as $key => $value) { array_push($json, $value->to_array()); ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?><?php echo $value->alias ? "({$value->alias})" : ""; ?></option>
                    <?php } ?>                
                </select>
                <a class="btn btn-primary" data-toggle="modal" data-target="#treeModal"> <i class="fa fa-plus"></i> 新增树</a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"> <i class="fa fa-trash-o"></i> 删除树</a>
                <a class="btn btn-success" id="btnSubMenu"> <i class="fa fa-plus"></i> 添加节点</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>tree</th>
                        <th>name</th>
                        <th>alias</th>
                        <th>depth</th>
                        <th>left</th>
                        <th>right</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="children">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 新树模态框 -->
<div class="modal fade" id="treeModal" tabindex="-1" role="dialog" aria-labelledby="treeModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="treeModalTitle">新树资料</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/category/create" method="POST" class="form-horizontal" style="border-bottom: 0px;">
                    <input type="hidden" name="depth" value="0">
                    <div class="control-group" style="border-bottom: 0px;">
                        <label class="control-label">树名称</label>
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
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button type="submit" class="btn btn-primary"> 保存设置 </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 删除确认模态框 -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="confirmModalTitle">确定要删除？</h4>
            </div>
            <div class="modal-body">
                确定要删除该分类吗？如果删除该分类，该分类下的所有相关信息将一并删除，且数据不可恢复。
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button type="button" id="btnConfirm" class="btn btn-danger"> 确认删除 </button>
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

<script type="text/javascript" src="/assets/third-party/jquery-tmpl-master/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="/assets/third-party/jquery-tmpl-master/jquery.tmplPlus.min.js"></script>
<script type="text/x-jquery-tmpl" id="tr">
<tr data-id="${id}" depth="${depth}" tree="${tree}" parent="${parent}">
    <td>${id}</td>
    <td>
        ${tree}
    </td>
    <td>
        <span {{if isEdit}}  class="hide"{{/if}}>${name}</span>
        <input type="text" value="${name}" placeholder="名称"{{if isEdit == false}}  class="hide"{{/if}}  style="width: 70px;"/>
    </td>
    <td>
        <span {{if isEdit}}  class="hide"{{/if}}>${alias}</span>
        <input type="text" value="${alias}" placeholder="别名"{{if isEdit == false}}  class="hide"{{/if}}  style="width: 70px;"/>
    </td>
    <td>${depth}级</td>
    <td>${lft}</td>
    <td>${rgt}</td>
    <td>
        <a role="save" class="btn btn-sm btn-success{{if isEdit == false}}  hide{{/if}}"> <i class="fa fa-check"></i> 保存 </a>
        <a role="edit" class="btn btn-sm btn-info{{if isEdit}}  hide{{/if}}"> <i class="fa fa-pencil-square-o"></i> 编辑 </a>
        <a role="del" class="btn btn-sm btn-danger{{if isEdit}}  hide{{/if}}" data-toggle="modal" data-target="#confirmModal"> <i class="fa fa-trash-o"></i> 删除 </a>
        <a role="addSub" class="btn btn-sm btn-success{{if isEdit}}  hide{{/if}}"> <i class="fa fa-plus"></i> 添加子节点 </a>
        <div class="btn-group{{if isEdit}}  hide{{/if}}">
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">移动节点 <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a data-toggle="modal" data-target="#moveModal"> <i class="fa fa-arrow-circle-o-up"></i> 上移</a></li>
                <li><a data-toggle="modal" data-target="#moveModal"> <i class="fa fa-arrow-circle-o-down"></i> 下移</a></li>
            </ul>
        </div>
    </td>
</tr>
</script>

<script type="text/javascript" src="/assets/js/tools.js"></script>
<script type="text/javascript">

var current_tr;
var roots = eval('<?php echo json_encode($json); ?>');

$(function(){

    $('#roots').change(function(){
        $('#children').empty();
        $.get('/admin/category/roots/' + $(this).val(),
            function(data, status){                
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                var items = data.data;
                recursion(items, $('#roots').val());
            }, 'json');
    });

    $('#children').delegate('a[role="save"]', 'click', function(){
        var obj = $(this);
        var tr = obj.parents('tr');
        
        tr.find('td').each(function(){
            if($(this).find('span').text().indexOf('-') > -1){
                $(this).find('span').text(repeat('-', parseInt(tr.attr('depth'))) + $(this).find('input').val());
            }else{
                $(this).find('span').text($(this).find('input').val());
            }            
        });

        var url = '/admin/category/edit/' + tr.attr('data-id');
        if(tr.attr('data-id') == '-' || tr.attr('data-id') == '0'){
            var url = '/admin/category/create';
        }

        $.post(url, 
            {
                name: tr.find('input:eq(0)').val(),
                alias: tr.find('input:eq(1)').val(),
                parent: tr.attr('parent'),
                depth: tr.attr('depth')
            },
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                }
                //按钮替换
                obj.parent().find('.btn-group').removeClass('hide');
                obj.parent().find('a').removeClass('hide');
                obj.parent().find('a[role="save"]').addClass('hide');

                tr.find('input').addClass('hide');
                tr.find('span').removeClass('hide');
            }, 'json');
    });

    $('#children').delegate('a[role="edit"]', 'click', function(){
        var obj = $(this);
        var tr = obj.parents('tr');
        //按钮替换
        obj.parent().find('.btn-group').addClass('hide');
        obj.parent().find('a').addClass('hide');
        obj.parent().find('a[role="save"]').removeClass('hide');

        tr.find('input').removeClass('hide');
        tr.find('span').addClass('hide');

        tr.find('td').each(function(){
            if($(this).find('span').text().indexOf('-') > -1){
                $(this).find('input').val($(this).find('span').text().substring(tr.attr('depth')));
            }else{
                $(this).find('input').val($(this).find('span').text());
            }
        });
    });

    $('#children').delegate('a[role="addSub"]', 'click', function(){
        var obj = $(this).parents('tr');
        var data = {
            id: '-',
            isEdit: true, 
            tree: obj.find('td:eq(1)').text(), 
            depth: parseInt(obj.attr('depth')) + 1,
            lft: '-',
            rgt: '-',
            parent: obj.attr('data-id')
        };
        $(tr).tmpl(data).insertAfter($(this).parents('tr'));
    });

    $('#btnSubMenu').click(function(){
        var tree_id = 0;
        for (var i = 0; i < roots.length; i++) {
            if(roots[i].id == $('#roots').val()){
                tree_id = parseInt(roots[i].tree.trim());
                break;
            }
        }

        var data = {
            id: '-',
            isEdit: true, 
            tree: tree_id, 
            depth: 1,
            lft: '-',
            rgt: '-',
            parent: $('#roots').val()
        };
        if($('#children').find('tr').length > 0){
            $(tr).tmpl(data).insertBefore($('#children').find('tr:eq(0)'));
        }else{
            $(tr).tmpl(data).appendTo($('#children'));
        }
        
    });

    $('#btnSubmitMove').click(function(){
        $.post('/admin/category/move/' + $('#source').attr('data-id') + '/' + $('#traget').val() + '/' + $('#method').val(), 
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                window.location.reload();
            }, 'json');
    });

    $('#children').delegate('a[data-target="#moveModal"]', 'click', function(){
        var tr = $(this).parents('tr');

        $('#source').attr('data-id', tr.attr('data-id'));
        $('#source').val(tr.find('input:eq(0)').val());

        $('#traget').empty();
        $('#traget').append("<option>目标节点</option>");
        $('#children').find('tr').each(function(){
            if(tr.attr('depth') != $(this).attr('depth')){
                return;
            }else if(tr.attr('data-id') == $(this).attr('data-id')){
                return;
            }

            if(tr.attr('parent') == $(this).attr('parent')){
               $('#traget').append('<option value="' + $(this).attr('data-id') + '">' + $(this).find('input:eq(0)').val() + '</option>');
            }
            
        });
    });

    $('#children').delegate('a[data-target="#confirmModal"]', 'click', function(){
        current_tr = $(this).parents('tr');
    });

    $('#btnConfirm').click(function(){
        $.get('/admin/category/delete/' + current_tr.attr('data-id'), 
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                $('#confirmModal').modal('hide');
                current_tr.remove();
            }, 'json');
    });

    $('a[role="down"]').click(function(){});

    init();

});

function recursion(items, pid){
    var children = items.children;
    for (var i = 0; i < children.length; i++) {
        children[i].isEdit = false;
        children[i].parent = pid;
        $('#children').append(tr, children[i], null);
        if(children[i].children){
            recursion(children[i], children[i].id);
        }
    }
}

function init(){
    $('#roots').change();
}

function repeat(str, num){ 
    return new Array( num + 1 ).join( str ); 
} 
</script>