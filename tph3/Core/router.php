<?php
defined("BASE_PATH") or exit('Access Denied');

function getRouter(){
	$controller = empty($_GET['c']) ? 'Index' : $_GET['c'];
	$action = empty($_GET['a']) ? 'index' : $_GET['a'];
	// $controllerPath = CONTROLLER_PATH.$controller.'.php';
	// include_once($controllerPath);
	$controllerName = '\Controller\\'.$controller;
	$controllerObj = new $controllerName();	
	$controllerObj->$action();
}

function run(){
	getRouter();
}
?>