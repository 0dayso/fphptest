
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form" action="" method="post">
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="site_web_name"> 网站名称 </label>

				<div class="col-sm-9">
					<input type="text" id="site_web_name" name="site_web_name" value="<?php echo isset($item) && $item ? $item['site_web_name']: '';?>" placeholder="" class="col-xs-10 col-sm-5">
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="site_url"> 网站URL </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="site_url" name="site_url" value="<?php echo isset($item) && $item ? $item['site_url']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="web_logo"> 网站LOGO </label>

				<div class="col-sm-9">
					<div class="input-group col-xs-10 col-sm-5">
						<input type="text" class="form-control btn-upload" id="web_logo" name="web_logo" placeholder="外链地址或上传本地图片" value="<?php echo isset($item) && $item ? $item['web_logo'] : ''; ?>" data-toggle="modal" data-target="#modal-upload">
						<span class="input-group-addon">
							<a class="btn-upload" name="web_logo" data-panel="qrcode" data-toggle="modal" data-target="#modal-upload"><i class="ace-icon fa fa-upload"></i></a>
						</span>
					</div>
				</div>
			</div>
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_map"> 联系我们(地图) </label>
				<div class="col-sm-9">
					<div class="input-group col-xs-10 col-sm-5">
						<input type="text" class="form-control btn-upload" id="contact_map" name="contact_map" placeholder="上传地图标注图片" value="<?php echo isset($item) && $item ? $item['contact_map'] : ''; ?>" data-toggle="modal" data-target="#modal-upload">
						<span class="input-group-addon">
							<a class="btn-upload" name="contact_map" data-panel="contact_map" data-toggle="modal" data-target="#modal-upload"><i class="ace-icon fa fa-upload"></i></a>
						</span>
					</div>
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_fax"> 咨询电话 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="contact_fax" name="contact_fax" value="<?php echo isset($item) && $item ? $item['contact_fax']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_tel"> 电话 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="contact_tel" name="contact_tel" value="<?php echo isset($item) && $item ? $item['contact_tel']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_address"> 地址 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="contact_address" name="contact_address" value="<?php echo isset($item) && $item ? $item['contact_address']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_zip"> 邮编号码 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="contact_zip" name="contact_zip" value="<?php echo isset($item) && $item ? $item['contact_zip']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="contact_mail"> 邮箱地址 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="contact_mail" name="contact_mail" value="<?php echo isset($item) && $item ? $item['contact_mail']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="icp"> ICP备案 </label>

				<div class="col-sm-9">
					<input type="text" class="col-xs-10 col-sm-5" id="icp" name="icp" value="<?php echo isset($item) && $item ? $item['icp']: '';?>">
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="quick_code"> 微信二维码 </label>

				<div class="col-sm-9">
					<div class="input-group col-xs-10 col-sm-5">
						<input type="text" class="form-control btn-upload" id="quick_code" name="quick_code" placeholder="外链地址或上传本地图片" value="<?php echo isset($item) && $item ? $item['quick_code'] : ''; ?>" data-toggle="modal" data-target="#modal-upload">
						<span class="input-group-addon">
							<a name="quick_code" class="btn-upload" data-panel="quick_code" data-toggle="modal" data-target="#modal-upload"><i class="ace-icon fa fa-upload"></i></a>
						</span>
					</div>
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
	$('.btn-upload').click(function(){
		current_image = $(this).attr("name");
	});
})
</script>

<script type="text/javascript">
  var path = 'article';
  var imgpanel = '';
  
  function callback(file, data){
  	debugger;
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