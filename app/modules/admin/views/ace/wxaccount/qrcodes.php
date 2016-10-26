<form>
	<input type="hidden" name="start" value="<?php echo \Input::get('start', 1); ?>">
	<div class="row">
		<div class="col-xs-2" style="padding-right: 0px;">
			<input type="text" class="form-control" name="key" value="" placeholder="二维码参数" style="height: 34px; font-size: 15px;" value="<?php echo \Input::get('key', ''); ?>"/>
		</div>
		<div class="col-xs-2" style="padding: 0px 2px;">
			<select class="form-control" name="status">
				<option value=""<?php echo \Input::get('status', '') == '' ? ' selected="selected"' : '';?>>显示全部二维码</option>
				<option value="valid"<?php echo \Input::get('status') == 'valid' ? ' selected="selected"' : '';?>>有效的二维码</option>
				<option value="temp"<?php echo \Input::get('status') == 'temp' ? ' selected="selected"' : '';?>>临时二维码</option>
				<option value="limit"<?php echo \Input::get('status') == 'limit' ? ' selected="selected"' : '';?>>永久二维码</option>
			</select>
		</div>
		<div class="col-xs-5" style="padding-left: 0px;">
			<button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
		</div>
		<div class="col-xs-3" style="padding-left: 0px;">
			<div class="clearfix" style="text-align: right; padding-right: 12px;">
				<div class="btn-group" role="group" aria-label="First group">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-file-excel-o"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="row" style="margin-top: 20px;">
	<div class="col-xs-12">
		<?php if(isset($items) && $items){ ?>
		<table id="simple-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="center">
						<label class="pos-rel">
							<input type="checkbox" class="ace">
							<span class="lbl"></span>
						</label>
					</th>
					<th>二维码参数</th>
					<th class="hidden-480">二维码</th>
					<th>二维码类型</th>
					<th>有效期限</th>
					<th>当前状态</th>
					<th>扫码关注人数</th>
					<th>操作</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($items as $key => $value) { ?>
				<tr>
					<td class="center">
						<label class="pos-rel">
							<input type="checkbox" class="ace">
							<span class="lbl"></span>
						</label>
					</td>

					<td><?php echo $value->key; ?></td>
					<td>
						<a href="<?php echo $value->qrcode ? $value->qrcode : 'http://www.evxin.com/template/travel_linzi/style/appstore.png'; ?>" target="_blank">
							<img src="<?php echo $value->qrcode ? $value->qrcode : 'http://www.evxin.com/template/travel_linzi/style/appstore.png'; ?>" alt="" style="height: 32px;"/>
						</a>
					</td>
					<td class="hidden-480"><?php echo $value->type == 'TEMP' ? '临时二维码' : '永久二维码'; ?></td>
					<td><?php echo $value->valid_date ? date('Y-m-d H:i:s', $value->valid_date) : '-'; ?></td>
					<td class="hidden-480">
						<span class="label label-sm label-<?php echo ($value->type == 'TEMP' && $value->valid_date > time()) || ($value->type == 'LIMIT') ? 'success' : 'danger'; ?>">
							<?php 
								if($value->type == 'TEMP'){
									echo $value->valid_date > time() ? '有效' : '已过期';
								}else{
									echo '永久有效';
								}
							?>
						</span>
					</td>
					<td><?php echo count($value->records); ?></td>
					<td>
						<div class="hidden-sm hidden-xs btn-group">
							<a class="btn btn-xs btn-success" title="查看推广数据" href="/admin/wxaccount/records/<?php echo $value->id;?>">
								<i class="ace-icon fa fa-bar-chart bigger-120"></i>
							</a>
						</div>

						<div class="hidden-md hidden-lg">
							<div class="inline pos-rel">
								<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
									<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
								</button>

								<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
									<li>
										<a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
											<span class="blue">
												<i class="ace-icon fa fa-qrcode bigger-120"></i>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
											<span class="green">
												<i class="ace-icon fa fa-bar-chart bigger-120"></i>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
											<span class="red">
												<i class="ace-icon fa fa-pencil bigger-120"></i>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
											<span class="red">
												<i class="ace-icon fa fa-trash-o bigger-120"></i>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			<?php if(isset($pagination) && $pagination){ ?>
			<tfoot>
				<tr>
					<td colspan="8" style="text-align: right;">
						<?php echo isset($pagination) && $pagination ? htmlspecialchars_decode($pagination) : ''; ?>
					</td>
				</tr>
			</tfoot>
			<?php } ?>
		</table>
		<?php }else{ ?>
		<div class="alert alert-danger" style="line-height: 100px; text-align: center; margin: 10px 0px;">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>
			<strong>
				<i class="ace-icon fa fa-times"></i>
				抱歉！
			</strong>
			未符合条件的数据。
			<br>
		</div>
		<?php } ?>
	</div><!-- /.span -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    生成带参数的二维码
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                	<div class="form-group">
                		<label for="account_id" class="col-sm-3 control-label">公众帐号</label>
                		<div class="col-sm-7">
                			<select id="account_id" name="account_id" class="form-control">
                				<option value="<?php echo \Session::get('WXAccount')->id; ?>"><?php echo \Session::get('WXAccount')->nickname; ?></option>
                			</select>
                		</div>
                	</div>
                	<div class="form-group">
				    	<label for="type" class="col-sm-3 control-label">二维码类型</label>
				    	<div class="col-sm-7">
				    		<select id="type" name="type" class="form-control">
                				<option value="TEMP">临时二维码</option>
                				<option value="LIMIT">永久二维码</option>
                			</select>
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="key" class="col-sm-3 control-label">二维码的参数</label>
				    	<div class="col-sm-7">
				    		<input type="text" id="key" name="key" value="" class="form-control" />
				    	</div>
				    	<p class="col-xs-12 col-md-offset-3 help-block"></p>
				  	</div>
				  	<div class="form-group">
				    	<label for="qrcode" class="col-sm-3 control-label">二维码图片</label>
				    	<div class="col-sm-7">
				    		<img id="imgQrcode" src="/assets/distribution/imgs/none.png" alt="" />
				    	</div>
				  	</div>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    关闭
                </button>
                <button type="button" id="btnGenerateQrcode" class="btn btn-primary">
                    生成二维码
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
		$('#btnGenerateQrcode').click(function(){
			var msg = '';
			if($('#key').val().length < 1){
				msg = '该项为必填项';
				$('#key').parents('.form-group').addClass('has-error');
			}else if($('#type').val() == 'TEMP' && isNaN($('#key').val())){
				msg = '临时二维码的参数，必须为数字';
			}

			if(msg != ''){
				$('#key').parents('.form-group').addClass('has-error').find('.help-block').text(msg);
				return;
			}

			$.post('/admin/wxaccount/param_qrcode',
				{
					account_id : $('#account_id').val(),
					type : $('#type').val(),
					key : $('#key').val()
				}, 
				function(data, status){
					if(data.data != 'undfined'){
						$('#imgQrcode').attr('src', data.data);
					}
					if(data.status == 'err'){
						alert(data.msg);
						return;
					}
					
				}, 'json');
		});

		$('#key').keydown(function(){
			$('#key').parents('.form-group').removeClass('has-error');
		});
	});
</script>