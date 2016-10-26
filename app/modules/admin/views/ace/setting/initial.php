
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form" action="" method="post">
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="main_category"> 主导航ID </label>

				<div class="col-sm-9">
					<input type="text" id="main_category" name="main_category" value="<?php echo isset($item) && $item ? $item['main_category']: '';?>" placeholder="" class="col-xs-10 col-sm-5">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 主导航</span>
						</label>
					</span>
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="article_category"> 文章分类ID </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="article_category" name="article_category" value="<?php echo isset($item) && $item ? $item['article_category']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 文章</span>
						</label>
					</span>
				</div>
			</div>

			<!--<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="web_logo"> 网站LOGO </label>

				<div class="col-sm-9">
					<div class="input-group col-xs-10 col-sm-5">
						<input type="text" class="form-control" id="web_logo" name="web_logo" placeholder="外链地址或上传本地图片" value="<?php //echo isset($item) && $item ? $item['web_logo'] : ''; ?>" data-toggle="modal" data-target="#modal-upload">
						<span class="input-group-addon">
							<a name="web_logo" data-panel="qrcode" data-toggle="modal" data-target="#modal-upload"><i class="ace-icon fa fa-upload"></i></a>
						</span>
					</div>
				</div>
			</div>
			-->
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="case_category"> 案例分类ID </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="case_category" name="case_category" value="<?php echo isset($item) && $item ? $item['case_category']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 案例</span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="ad_category"> 广告分类ID </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="ad_category" name="ad_category" value="<?php echo isset($item) && $item ? $item['ad_category']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 广告</span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="page_category"> 自定义页分类ID </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="page_category" name="page_category" value="<?php echo isset($item) && $item ? $item['page_category']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 自定义页</span>
						</label>
					</span>
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="index_lunbo"> 首页轮播id </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="index_lunbo" name="index_lunbo" value="<?php echo isset($item) && $item ? $item['index_lunbo']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 首页图片轮播</span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="index_newsBulletin"> 新闻动态ID </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="index_newsBulletin" name="index_newsBulletin" value="<?php echo isset($item) && $item ? $item['index_newsBulletin']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 首页显示</span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="index_companyInfo"> 企业简介 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="index_companyInfo" name="index_companyInfo" value="<?php echo isset($item) && $item ? $item['index_companyInfo']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl" style="font-size:12px;color:#999"> <b style="color:red;"> * </b> 首页显示</span>
						</label>
					</span>
				</div>
			</div>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit" id="btnSubmit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" id="btnReset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						重填
					</button>
				</div>
			</div>
		</form>
	</div><!-- /.col -->
</div>


<script type="text/javascript">
var current_image = "web_logo";
$(function(){
/*
	$('input[type="text" ]').blur(function(){
		var obj = $(this);
		if(obj.attr('name') == 'web_logo' || obj.attr('name')  =='quick_code'){
			return;
		}
		if(obj.val() == undefined || obj.val() == null || obj.val() == ''){
			return;
		}
		
		$.post('/admin/index/create',
			{'key':obj.attr('name'),'value':obj.val()},
			function(data,status){
				if(data.status != 'succ'){
					alert(data.msg);
					return;
				}
			}
			,'josn');
	});

	$('#web_logo,#quick_code').change(function(){
		var obj = $(this);
		if(obj.val() == undefined || obj.val() == null || obj.val() == ''){
			return;
		}

		$.post('/admin/index/create',
			{'key':obj.attr('name'),'value':obj.val()},
			function(data,status){
				if(data.status != 'succ'){
					alert(data.msg);
					return;
				}
			}
			,'josn');
	});

	$('a[name="web_logo"],a[name="quick_code"]').click(function(){
		current_image = $(this).attr('name');
	});*/
})
</script>

<script type="text/javascript">
  var path = 'article';
  var imgpanel = '';
  
  function callback(file, data){
      var json = eval('(' + data + ')');
      if(json.status == 'succ'){
          $("#"+current_image).val(json.data);

          $.post('/admin/index/create',
			{'key':$("#"+current_image).attr('name'),'value':$("#"+current_image).val()},
			function(data,status){
				if(data.status != 'succ'){
					alert(data.msg);
					return;
				}
			}
			,'josn');
      }else{
          alert(json.msg);
      }
  }
</script>
<?php echo render('tools/upload'); ?>
<?php echo render('ace/public/alert_message'); ?>