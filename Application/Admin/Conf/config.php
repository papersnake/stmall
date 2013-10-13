<?php

return array(

	'TMPL_PARSE_STRING'	=> array(
			'__STATIC__' => __ROOT__ . '/Public/static',
			'__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
			'__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
			'__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
			'__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
		),

	'SESSION_PREFIX' => 'stmall_admin',
	'COOKIE_PREFIX'  => 'stmall_admin_',
	'LIST_ROWS'      => 15,
);