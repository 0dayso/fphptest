<link rel="stylesheet" href="/assets/css/uploadifive.css" />
<script src="/assets/js/jquery.uploadifive.min.js" type="text/javascript"></script>
<style type="text/css">
	.uploadifive-button {
		float: left;
		margin-right: 10px;
	}
	#queue {
		border: 1px solid #E5E5E5;
		height: 177px;
		overflow: auto;
		margin-bottom: 10px;
		padding: 0 3px 3px;
		width: 520px;
	}
</style>
<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4>文件上传</h4>
      		</div>
		    <div class="modal-body">
		        <form>
		        	<div id="queue"></div>
		        	<input id="file_upload" name="file_upload" type="file" multiple="true">
		        	<a class="btn btn-primary btn-sm" href="javascript:$('#file_upload').uploadifive('upload')">上传</a>
		        </form>
		        <script type="text/javascript">
					<?php $timestamp = time();?>
					$(function() {
						$('#file_upload').uploadifive({
							'auto'             : false,
							'buttonText'       : '选择文件',
							'checkScript'      : '/file/check',
							'formData'         : {
												   'timestamp' : '<?php echo $timestamp;?>',
												   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
												   'path'      : path,
												   'node_id'   : (typeof(node_id)==='undefined') ? 0 : node_id
							                     },
							'queueID'          : 'queue',
							'uploadScript'     : '/file/upload',
							'onUploadComplete' : callback
						});
					});

					/*function callback(file, data){
						var json = eval('(' + data + ')');
						if(json.status == 'succ'){
							alert(json.data);
						}
					}*/
				</script>
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">关闭</button>
		    </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
