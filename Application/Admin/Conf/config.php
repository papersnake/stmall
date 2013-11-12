<?php

return array(

	'TMPL_PARSE_STRING'	=> array(
			'__STATIC__'  => __ROOT__ . '/Public/static',
			'__ADDONS__'  => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
			'__IMG__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
			'__CSS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
			'__JS__'      => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
			'__PLUGINS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/plugins',
			'__FONTS__'   => __ROOT__ . '/Public/' . MODULE_NAME . '/fonts',
		),

	'SESSION_PREFIX' => 'stmall_admin',
	'COOKIE_PREFIX'  => 'stmall_admin_',
	'LIST_ROWS'      => 15,

	 /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'thumb'    => true,
		'autoSub'  => false, //自动子目录保存文件
		//'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './Uploads/Picture', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）
);