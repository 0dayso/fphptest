<div class="row">
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
					<th>公众号名称</th>
					<th>微信粉丝昵称</th>
					<th>关注时间</th>
					<th>当前关注状态</th>
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

					<td><?php echo $value->qrcode->key; ?></td>
					<td><?php echo $value->account->nickname; ?></td>
					<td><?php echo $value->fans->nickname ? "{$value->fans->nickname}({$value->fans->open_id})" : $value->fans->openid; ?></td>
					<td><?php echo date('Y-m-d H:i:s', $value->created_at); ?></td>
					<td><?php echo $value->fans->subscribe == 0 ? '未关注' : '已关注'; ?></td>
					<td>
						<div class="hidden-sm hidden-xs btn-group">
							<button class="btn btn-xs btn-info" title="编辑">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
							</button>

							<button class="btn btn-xs btn-danger" title="删除">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</button>

							<a class="btn btn-xs btn-primary" title="带参数二维码管理" href="/admin/wxaccount/param_qrcode/<?php echo $value->id; ?>">
								<i class="ace-icon fa fa-qrcode bigger-120"></i>
							</a>

							<button class="btn btn-xs btn-success" title="查看推广数据">
								<i class="ace-icon fa fa-bar-chart bigger-120"></i>
							</button>
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
		</table>
		<?php }else{ ?>
		<div style="border: 1px solid #e0e0e0; line-height: 300px; width: 100%; text-align: center;">
			未找到相关数据
		</div>
		<?php } ?>
	</div><!-- /.span -->
</div>