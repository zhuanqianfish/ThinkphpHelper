<?php
///////////////Thinkphp5.x 无痛兼容助手 by zhuanqianfish/////////////
//// 在扩展函数文件中加入即可像TP3中那样使用 C() D() I() M() U() 等方法
//// 'extra_file_list'        => [THINK_PATH . 'helper' . EXT,  APP_PATH . 'helper.php'],
use \think\Model;
use \think\Request;

function helpertest(){
	return 'helpertest';
}

//C方法
function C($config, $value = null){
	if($value){
		return config($config, $value);
	}
	return config($config);
}

//D方法
function D($modelName = '')
{
	return model($modelName);
}

//I方法
function I($attr){
	if($attr && array_key_exists($attr, $_REQUEST)){
		$tempAttr = $_REQUEST[$attr];
		if(is_array($tempAttr)){
			return input($attr.'/a');
		}
	}
	return input($attr);
}

//M方法
function M($modelName = '')
{
    return db($modelName);
}

//U方法
function U($url, $attr = null){
	if($attr){
		return url($url, $attr);
	}
	return url($url);
}

//是否为POST请求
function IS_POST(){
	return Request::instance()->isPost();
}

//是否为GET请求
function IS_GET(){
	return (Request::instance()->isGet());
}



