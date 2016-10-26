
<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4>文件上传</h4>
      		</div>
		    <div class="modal-body">
		    <form id="frmSubmit" class="form-horizontal" method="POST" action="/file/upload">
		        <div class="form-group">
					<div class="col-xs-12">
						<!-- #section:custom/file-input -->
						<input type="file" id="upload-file" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input multiple="" type="file" name="files" id="upload-files" />
						<!-- /section:custom/file-input -->
					</div>
				</div>
			</form>
		    </div>
		    <div class="modal-footer">
                <button class="btn btn-sm btn-pirmary" onclick="javascript:$('frmSubmit').submit();">上传</button>
		        <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">关闭</button>
		    </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
	$('#upload-file').ace_file_input({
        no_file:'请选择要上传的文件 ...',
        btn_choose:'选择',
        btn_change:'重新选择',
        droppable:false,
        onchange:null,
        thumbnail:false //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
    });
    //pre-show a file name, for example a previously selected file
    //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


    $('#upload-files').ace_file_input({
        style:'well',
        btn_choose:'拖放文件至此或单击选择文件',
        btn_change:null,
        no_icon:'ace-icon fa fa-cloud-upload',
        droppable:true,
        thumbnail:'small'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
        }*/
        /**,before_remove : function() {
            return true;
        }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
            alert(error_code);
        }

    }).on('change', function(){
        console.log($(this).data('ace_input_files'));
        console.log($(this).data('ace_input_method'));
    });
</script>