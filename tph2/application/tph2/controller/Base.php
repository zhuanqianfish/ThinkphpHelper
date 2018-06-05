<?php
//	ThinkphpHelper v0.3
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use \think\Controller;
use \think\Request;

class Base extends Controller{
	public function _initialize()
   	{
        $request = Request::instance();
		
		define('MODULE_NAME', $request->module());	//模块名称
		define('CONTROLLER_NAME', $request->controller());	//控制器名称
		define('ACTION_NAME', $request->action());	//操作名称
		define('MODULE_PATH', __ROOT__);	//模块路径
		
		//动态读取目标项目配置
		$targetConfig =  include_once(BASE_PATH.getDbConfig('projectPath').'config.php');		
		$dbConfig = include_once(BASE_PATH.getDbConfig('projectPath').'database.php');
		config('targetConfig', $targetConfig);
		config('database', $dbConfig);

		//向代码模板注册一些默认的变量
		$this->assign('pk', null);	//modelCode 主键
		$this->assign('trueTable', null);	//modelCode 真实表名称

	   }
	   
	   // 渲染文件保存至中间蓝图
	   // 
	   public function bluemap(){

	   }
}
