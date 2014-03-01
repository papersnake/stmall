<?php
return array(
	'TMPL_PARSE_STRING'	=> array(
			'__STATIC__'  => __ROOT__ . '/Public/static',
			'__ADDONS__'  => __ROOT__ . '/Public/Admin/Addons',
			'__IMG__'     => __ROOT__ . '/Public/Admin/images',
			'__CSS__'     => __ROOT__ . '/Public/Admin/css',
			'__JS__'      => __ROOT__ . '/Public/Admin/js',
			'__PLUGINS__' => __ROOT__ . '/Public/Admin/plugins',
			'__FONTS__'   => __ROOT__ . '/Public/Admin/fonts',
		),

	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES' => array(
		'Good/search/:key' => array('Good/search','',array()),
		'Good/:show' => array('Good/barcode','',array()),
		),
);