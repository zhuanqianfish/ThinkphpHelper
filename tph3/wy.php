<?php
	define('BASE_PATH', __DIR__.'/');
	define('CORE_PATH', BASE_PATH.'Core/');
	define('LIB_PATH', CORE_PATH.'Lib/');
	define('COMMON_PATH', BASE_PATH.'Common/');
	define('EXT_PATH', BASE_PATH.'Ext/');
	define('CONTROLLER_PATH', BASE_PATH.'Controller/');
	define('VIEW_PATH', BASE_PATH.'View/');
	define('TEMPLATE_PATH', BASE_PATH.'Template/');//代码模板所在文件夹
	define('VIEW_TEMPLATE_SUFFIX', '.html');	//系统模板文件后缀名
	define('VENDOR_PATH', BASE_PATH.'vendor/');	//composer 自动加载目录
	define('DS', DIRECTORY_SEPARATOR);	//系统分隔符
	define('BASE_URL', $_SERVER['REQUEST_URI']);	//当前脚本url
	define('PUBLIC_DIR', 'public/');

	require CORE_PATH.'fishAutoLoad.php';

	//加载数据库配置
	$dbConfig = include COMMON_PATH.'database.php';

?>