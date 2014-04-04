<?php
return array(
	'SHOW_PAGE_TRACE' => true,
	'DATA_AUTH_KEY'   => 'Y,y8Je9Exs/Wb_~RtmaA=dMV%|IOQD!g:;q?(20u',
	'LOG_RECORD'      => true,
	'URL_MODEL'       => '2',
	'DEFAULT_FILTER'  => 'htmlspecialchars',
	/* 数据库配置 */
	'DB_TYPE'         => 'mysql', // 数据库类型
	'DB_HOST'         => '127.0.0.1', // 服务器地址
	'DB_NAME'         => 'stmall', // 数据库名
	'DB_USER'         => 'root', // 用户名
	'DB_PWD'          => '',  // 密码
	'DB_PORT'         => '3306', // 端口
	'DB_PREFIX'       => 'stmall_', // 数据库表前缀
	
	'SESSION_OPTIONS' =>array(
						'name'   =>'session_id',
						'expire' =>'3600',
						'type' =>'Db'), 
);


