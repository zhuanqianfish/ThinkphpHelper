<?php
//	ThinkphpHelper v0.3
//	
//	生成表单代码
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace TPH\Controller;
use Think\Controller;

class FCodeController extends Controller {

    public function index(){
		$this->assign('db_prefix',C('DB_PREFIX'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$this->display();
    }
	
	
}