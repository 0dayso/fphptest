<?php

return array(
	'error_'.\Upload::UPLOAD_ERR_OK						=> '文件上传成功',
	'error_'.\Upload::UPLOAD_ERR_INI_SIZE				=> '文件大小超出 upload_max_filesize 设置（在php.ini中）',
	'error_'.\Upload::UPLOAD_ERR_FORM_SIZE				=> '文件大小超出 表单中的 MAX_FILE_SIZE 设置',
	'error_'.\Upload::UPLOAD_ERR_PARTIAL				=> '文件仅部分上传',
	'error_'.\Upload::UPLOAD_ERR_NO_FILE				=> '没有上传文件',
	'error_'.\Upload::UPLOAD_ERR_NO_TMP_DIR				=> '上传文件的临时目录不存在',
	'error_'.\Upload::UPLOAD_ERR_CANT_WRITE				=> '写上传文件到目录失败',
	'error_'.\Upload::UPLOAD_ERR_EXTENSION				=> '文件上传被 PHP 扩展中断',
	'error_'.\Upload::UPLOAD_ERR_MAX_SIZE				=> '文件大小超出定义的最大尺寸',
	'error_'.\Upload::UPLOAD_ERR_EXT_BLACKLISTED		=> '上传文件的扩展名被禁止',
	'error_'.\Upload::UPLOAD_ERR_EXT_NOT_WHITELISTED	=> '上传文件的扩展名被禁止',
	'error_'.\Upload::UPLOAD_ERR_TYPE_BLACKLISTED		=> '上传文件的类型被禁止',
	'error_'.\Upload::UPLOAD_ERR_TYPE_NOT_WHITELISTED	=> '上传文件的类型被禁止',
	'error_'.\Upload::UPLOAD_ERR_MIME_BLACKLISTED		=> '上传文件的 MIME 类型被禁止',
	'error_'.\Upload::UPLOAD_ERR_MIME_NOT_WHITELISTED	=> '上传文件的 MIME 类型被禁止',
	'error_'.\Upload::UPLOAD_ERR_MAX_FILENAME_LENGTH	=> '上传文件的文件名超出长度',
	'error_'.\Upload::UPLOAD_ERR_MOVE_FAILED			=> '移动上传文件到目标目录失败',
	'error_'.\Upload::UPLOAD_ERR_DUPLICATE_FILE 		=> '上传文件的文件名已存在',
	'error_'.\Upload::UPLOAD_ERR_MKDIR_FAILED			=> '创建目标目录失败',
);
