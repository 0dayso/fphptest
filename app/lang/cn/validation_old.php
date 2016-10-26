<?php

return array(
	'required'      => ':label 不能为空',
	'min_length'    => ':label 长度至少为 :param:1 个字符',
	'max_length'    => ':label 长度不能超过 :param:1 个字符',
	'exact_length'  => ':label 长度应为 :param:1 个字符',
	'match_value'   => ':label 不等于 :param:1',
	'match_pattern' => ':label 模式与 :param:1 不匹配',
	'match_field'   => ':label 与 :param:1 的值不等',
	'valid_email'   => ':label 无效的Email地址',
	'valid_emails'  => ':label 无效的Email地址列表',
	'valid_url'     => ':label 无效的URL地址',
	'valid_ip'      => ':label 无效的IP地址',
	'numeric_min'   => ':label 数值不能小于 :param:1',
	'numeric_max'   => ':label 数值不能大于 :param:1',
	'valid_string'  => ':label 无效的字符规则[:rule(:param:1)]',
	'required_with' => ':param: 不为空时，:label 不能未空',
	'unique'		=> ':label 为 :value 已存在'
);
