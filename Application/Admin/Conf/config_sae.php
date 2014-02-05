<?php
$st = 	new SaeStorage();
return array(
	'TMPL_PARSE_STRING'=>array(
		'__STATIC__'  => __ROOT__ . '/Public/static',
		'__ADDONS__'  => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
		'__IMG__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
		'__CSS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
		'__JS__'      => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
		'__PLUGINS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/plugins',
		'__FONTS__'   => __ROOT__ . '/Public/' . MODULE_NAME . '/fonts',
		'/Uploads/Picture' =>	$st->getUrl('uploads','picture'),
		)
	);