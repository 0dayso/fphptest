<?php
/**
 * The development database settings. These get merged with the global settings.
 *
 */

return array(
	'default' => array(
		'type'           => 'mysqli',
		'connection'     => array(
			'hostname'   => 'localhost',
			'port'       => '3306',
			'database'   => 'wechat_copy',
			'username'   => 'root',
			'password'   => 'pensee608',
			'persistent' => false,
			'compress'   => false,
		),
		'identifier'     => '`',
		'table_prefix'   => '',
		'charset'        => 'utf8',
		'enable_cache'   => true,
		'profiling'      => false,
	),
);
