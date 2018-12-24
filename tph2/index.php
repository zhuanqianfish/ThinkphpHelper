<?php

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__.'/application/' );

define('BIND_MODULE','tph2');

//TPH入口文件所在目录
define('BASE_PATH', __DIR__);

//项目部署目录名称
define('APP_NAME', '/tph2');

define('__ROOT__',  dirname(__FILE__));	

//目标发布名称(用于生成后的前端模板，例如项目入口发布到二级目录需要修改此项)
define('TARGET_PUBLIC_NAME', '/');

//代码仓库所在文件夹名,使用代码仓库在common中定义
define('CODE_REPOSITORY', 'codeRepository');

//视图模板路径
define('TEMPLATE_PATH', APP_NAME.'/template/');

//替换标记位
define('REPLACE_FLAG', '//__tph');

// 加载框架引导文件
require __DIR__ . '/../../thinkphp/start.php';

