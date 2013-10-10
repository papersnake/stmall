<?php
	define('APP_DEBUG', true);

	define('APP_PATH', './Application/');

	define('RUNTIME_PATH', './Runtime/');

	require './Lib/php_error.php';
	use Lib\php_error as phperror;
	\php_error\reportErrors();
	require './ThinkPHP/ThinkPHP.php';
