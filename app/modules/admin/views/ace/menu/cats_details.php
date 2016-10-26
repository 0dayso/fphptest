<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form">
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="name"> 栏目名称 </label>

				<div class="col-sm-9">
					<input type="text" id="name" name="name" value="<?php echo isset($item) && $item ? $item->name: '';?>" placeholder="" class="col-xs-10 col-sm-5">
				</div>
			</div>

			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="name"> 上级栏目 </label>

				<div class="col-sm-9">
					<?php $count = 0;?>
					<select class="col-xs-5 col-sm-2" >
						<?php if(isset($category) && $category){ ?>
							<?php foreach ($category as $key => $value) { ?>
								<?php $count ++;?>
								<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
								<?php break;?>
							<? }?>
						<?php }else{ ?>
							<option value="0">无</option>
						<?php }?>
						
					</select>

					<?php if(isset($category) && $category){ ?>
						<?php if(count($category)>1){ ?>
							<select class="col-xs-5 col-sm-2" >
								<?php if(isset($category) && $category){ ?>
									<?php foreach ($category as $key => $value) { ?>
									<?php $count ++;?>
										<?php if($count > 2){?>
											<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
											<?php break;?>
										<?php }?>
									<? }?>
								<?php }else{ ?>
									<option value="0">无</option>
								<?php }?>
								
							</select>
						<?php }?>
					<?php }?>
					
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
					<button class="btn btn-info" type="button" id="btn_subimt" data-role="<?php isset($item) && $item ? 'edit': 'create';?>">
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
                depth: 1,
                url:$('#url').val()
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
})
</script>