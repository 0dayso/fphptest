
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form" name="frmEditPassword" action="#" method="POST">
			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="old_password"> 原密码 </label>

				<div class="col-sm-9">
					<input type="password" id="old_password" name="old_password" placeholder="请输入原密码" class="col-xs-10 col-sm-5">
				</div>
			</div>
			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="new_password"> 新密码 </label>

				<div class="col-sm-9">
					<input type="password" class="col-xs-10 col-sm-5" id="new_password" placeholder="请输入新密码" name="new_password" />
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="confirm_password"> 确认密码 </label>

				<div class="col-sm-9">
					<input type="password" class="col-xs-10 col-sm-5" id="confirm_password" name="new_passconf" placeholder="请重新输入新密码" />
					<span class="help-inline col-xs-12 col-sm-7">
						<label class="middle">
							<span class="lbl"></span>
						</label>
					</span>
				</div>
			</div>
			<!-- 操作按钮 -->
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
		</div><!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div>
<?php echo render('ace/public/alert_message'); ?>
<script type="text/javascript">
	$(function(){
		$('#btnSubmit').click(function(){

			if($('#old_password').val() == '' || $('#old_password').val() == null){
				alert('输入的密码不匹配。请重新输入密码。');
				$('#old_password').focus();
				return false;
			}

			if($('#new_password').val() == '' || $('#new_password').val() == null){
				alert('输入的密码不匹配。请重新输入密码。');
				$('#new_password').focus();
				return false;
			}

			if($('#confirm_password').val() == '' || $('#confirm_password').val() == null){
				alert('输入的密码不匹配。请重新输入密码。');
				$('#confirm_password').focus();
				return false;
			}

			if($('#new_password').val() != $('#confirm_password').val()){
				alert('您的新密码和确认密码不相符，请重新输入密码。');
				$('#confirm_password').focus();
				return false;
			}
		});

	})
</script>