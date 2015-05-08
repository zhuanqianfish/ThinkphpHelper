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
		$this->display();
    }
	
	public function generateCreatFormCode(){
		$templateFilePath = MODULE_PATH. "Template/View/formCode.html";
		$formMethod = I('formMethod');
		$formAction = I('formAction');
		$this->assign('formMethod', $formMethod);
		$this->assign('formAction', $formAction);
		$resultCode = $this->fetch($templateFilePath);
		return $resultCode;
	}
	
	public function creatForm(){
		echo $this->generateCreatFormCode(); 
	}
	
	public function loadField(){
		$tableName = I('tableName');
		$tableInfoArray = getTableInfoArray($tableName);
		$columnNameKey = getColumnNameKey();
		$str = '';
		foreach($tableInfoArray as $tableInfo){
			$str .= '<option value="'.$tableInfo[$columnNameKey].'" >'.$tableInfo[$columnNameKey]."</option>\r\n";
		}
		echo $str;
	}
}