<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form">
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="name"> 导航名称 </label>

				<div class="col-sm-9">
					<input type="text" id="name" name="name" value="<?php echo isset($item) && $item ? $item->name: '';?>" placeholder="" class="col-xs-10 col-sm-5">
				</div>
			</div>
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="url"> 内容类型 </label>
                <div class="col-sm-9" style="line-height: 38px;">
                    <label>
                        <input name="pagename" type="radio" class="ace btntype" value="details">
                        <span class="lbl"> 默认</span>
                    </label>
                    <label>
                        <input name="pagename" type="radio" class="ace btntype" value="index">
                        <span class="lbl"> 列表页面</span>
                    </label>
                    <label>
                        <input name="pagename" type="radio" class="ace btntype" value="details">
                        <span class="lbl"> 内容单面</span>
                    </label>
                    <label>
                        <input name="pagename" type="radio" class="ace btntype" value="page">
                        <span class="lbl"> 自定义页面</span>
                    </label>
                </div>
            </div>	
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-4">内容来源</label>

				<div class="col-sm-9">
					<select class="col-sm-5" id="entity_id">
						<!--<option value="0">-=请选择=-</option> -->
						<option value="-1">-=默认=-</option>
						<?php if(isset($menus) && $menus){?>
                    		<?php foreach ($menus as $key => $value) { ?>
                    			<option data-module="<?php echo $value->module;?>" data-action="<?php echo $value->action_name;?>" value="<?php echo $value->id;?>" <?php echo $value->id == $item->entity_id ? ' selected': '';?>><?php echo $value->depth >= 1 ? $value->depth == 1 ? '-': '--': '';?><?php echo $value->name;?></option>
                    		<?php }?>
                		<?php }?>
					</select>
				</div>
			</div>	
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="url"> 链接地址 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="url" name="url" value="<?php echo isset($item) && $item ? $item->url: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle" style="color:red;">*
							<span class="lbl" style="font-size:12px;color:#666">系统自动生成</span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>
			<?php if(isset($item) && $item){ ?>

			<?php }else{ ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="parent">上级分类</label>
				<div class="col-sm-9">
					<select class="col-sm-5" id="parent">
						<option value="0">请选择</option>
					</select>
				</div>
			</div>

			<div class="space-4"></div>
			<?php }?>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input type="hidden" id="depth" name="depth" value="<?php echo isset($item) && $item ? $item->depth: 1;?>">					
					<button class="btn btn-info" type="button" id="btn_subimt" data-role="<?php echo isset($item) && $item ? 'edit': 'create';?>">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						重置
					</button>
				</div>
			</div>
		</div><!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div>
<script type="text/javascript">
var itemData = <?php echo isset($item) && $item ? json_encode($item->to_array()): json_encode(array());?>
</script>
<script type="text/javascript">

$(function(){
	var ynLock = false;
	$('#btn_subimt').click(function(){
		//判断操作类型
		var optionType = $(this).attr('data-role');

		var url = '/admin/category/edit/<?php echo isset($item) && $item ? $item->id: 0;?>';
        if(optionType == 'create'){
            var url = '/admin/category/create';
        }

        $.post(url, 
            {
                name: $('#name').val(),
                parent: $('input[name="nav_type"]:checked').val(),
                depth: $('#depth').val(),
                url:$('#url').val(),
                entity_id:$('#entity_id').find('option:selected').val()
            },
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                }
                window.location.reload();
            }, 'json');
	});

	//按树获取
	$('input[name="nav_type"]').click(function(){
		if(ynLock){
			alert('系统繁忙，请稍候再试！');
			return;
		}
		if($(this).val() == undefined || $(this).val() == 0){
            $('#parent').empty();
            $('#parent').append('<option value="0">请选择</option>');
			return;
		}
		ynLock = true;
        $.get('/admin/category/roots/' + $(this).val(),
            function(data, status){                
            	ynLock = false;
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                var items = data.data;
                $('#parent').empty();
                $('#parent').append('<option value="0">请选择</option>');
                for(var i = 0; i<items.children.length;i++){
                	$('#parent').append('<option value="' + items.children[i].id + '">'+items.children[i].name+'</option>');
                }
            }, 'json');
    });

	//初始化---上级分类
	$('input[name="nav_type"]').each(function(){
		if($(this).is(":checked")){
			$(this).click();
			return;
		}
	});

	//选择内容
	$('#entity_id').change(function(){
		setUrl();
		return;
	});

	$(".btntype").click(function(){
		setUrl();
	});


	//初始化选中类型
	if(!(itemData == "" || itemData == undefined)){
		//内容类型选中状态
		$(".btntype").eq(0).attr("checked","checked");
		$(".btntype").each(function(){
			if(itemData.url.indexOf("/"+$(this).val()+"/") >= 0){
				$(".btntype").eq(0).removeAttr("checked");
				$(this).attr("checked","checked");
				return true;
			}
		});

		//扣出cid
		var cid_ = itemData.entity_id == null || itemData.entity_id==undefined || itemData.entity_id=='' ? 0:itemData.entity_id;
		
		//系统内容
		$("#entity_id").append('<option value="-1">默认</option>');
		if(cid_ != 0){
			$("#entity_id").val(cid_);
		}
	}
})

function setUrl(){
	var obj = $('#entity_id').find('option:selected');
	var cid_ = obj.val();
	var m = obj.attr('data-module');
	var a = $("input[name='btntype']:checked").val()=='' || $("input[name='pagename']:checked").val() == undefined ? '' : "/"+$("input[name='pagename']:checked").val();
	if(obj.val() == 0 || obj.val()==-1||obj.val()==undefined){
		$('#url').val('');
		return;
	}
	$('#url').val('/web/'+m+''+a+'?cid='+cid_);
}
</script>