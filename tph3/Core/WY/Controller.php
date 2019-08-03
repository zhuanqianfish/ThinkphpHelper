<?php
namespace Core\WY;
use \Medoo\medoo;
//控制器基类

class Controller {
	public $varables = [];
	protected	$db;
	protected	$view;
	
	function __construct(){
		$this->db = new medoo(wyconfig());	//数据库操作medoo对象
		$this->view = new \Core\WY\Template(['view_base'=>VIEW_PATH]);	//模板引擎对象
	}

	protected function display($viewPath){
		echo $this->view->fetch($viewPath);
	}
	
	////start 废弃不用
	//渲染模板
	protected function display_($viewPath){
		$viewPathArray = explode( '/',$viewPath);
		$viewName = $viewPathArray[0];
		$fullViewPath = VIEW_PATH.$viewName.'/'.$viewPathArray[1].VIEW_TEMPLATE_SUFFIX;
		include $fullViewPath;
	}
	
	//注册变量
	protected function assign($name, $value){
		$this->varables[$name] = $value;
	}

	//读取变量
	public function val($name){
		return $this->varables[$name];
	}
	////////end 废弃不用////////////
}
?>