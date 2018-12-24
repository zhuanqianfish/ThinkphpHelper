<?php
//	ThinkphpHelper v0.3
//	
//	生成表单代码
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller;

class ViewCode extends Base {

    public function index(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		$themeList = getThemeList();
		$this->assign('themeList', $themeList);
		return $this->fetch('ViewCode/index');
    }
	
	//一键生成表单文件
	public function generateAllView(){
		$defaultActionList = ['add','edit','lists']; //默认生成增，改，查
		$moduleName = I('moduleName');
		$tableNameList = I('selectTableName');
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'view'.DS;
		$res = '';
		foreach($tableNameList as $tableName){
			$tableName = getTableName($tableName);
			if(!file_exists($modelPath)){
				FileUtil::createDir($modelPath);
			}
			if(!file_exists($modelPath.DS. $tableName.DS)){
				FileUtil::createDir($modelPath.DS.$tableName.DS);
			}

			foreach($defaultActionList as $actionName){
				$code = $this->generateViewCode($actionName, $tableName);
				$filePath = $modelPath. $tableName .DS. $actionName.".html";
				file_put_contents($filePath, $code);
				$res .= '生成成功，生成路径为：'.$filePath."<br>";
			}
		}
		return $res;
	}

	//生成前台布局文件
	public function generateViewLayout(){
		$moduleName = I('moduleName');
		$theme = I('theme');//代码风格
		$layoutListStr = I('layoutList');
		$layoutList = explode(',', $layoutListStr);
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'view'.DS;
		if(!file_exists($modelPath)){
			FileUtil::createDir($modelPath);			
		}
		$this->assign('moduleName', $moduleName);
		$templateBasePath = CODE_REPOSITORY.DS. $theme.DS.'view'.DS;
		$res = '';
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;

		foreach($layoutList as $layoutName){
			$template = file_get_contents($templateBasePath . $layoutName. '.html');//读取模板
			$resCode =  $this->display($template,[],[],['view_path'=>$codeBasePath.'View'.DS]);
			$filePath = $modelPath.$layoutName.".html";
			file_put_contents($filePath, $resCode);
			$res .= '生成成功，生成路径为：'.$filePath.'<br>';
		}
		return $res;
	}


	//生成视图代码
	public function generateViewCode($actionName = null, $tableName = null){
		$tableName = $tableName ? $tableName : getTableName(I('tableName'));
		$moduleName = I('moduleName');
		$controllerName = $tableName;
		$columnNameKey = getColumnNameKey();
		$tableInfoArray = getTableInfoArray($tableName);
		//dump($columnNameKey);die;
		$tableInfoArray = $this->fillFormInputList($tableName, $tableInfoArray, $columnNameKey);
		$this->assign('tableName', $tableName);
		$this->assign('controllerName', $controllerName);
		$this->assign('moduleName', $moduleName);
		$this->assign('tableInfoArray', $tableInfoArray);
		$this->assign('columnNameKey', $columnNameKey);
		$theme = I('theme');//代码风格
		$actionName = $actionName ? $actionName : I('actionName');
		$templateBasePath = CODE_REPOSITORY.DS. $theme .DS."view".DS;	//代码所在文件夹
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;
		$template = file_get_contents($templateBasePath . $actionName. '.html');	//读取模板
		$resCode =  $this->display($template,[],[],['view_path'=>$codeBasePath.'View'.DS]);
		
		return $resCode;
	}

	//生成视图文件
	public function createViewFile($actionName = null){
		$moduleName = I('moduleName');
		$tableName = getTableName(I('tableName'));
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'view'.DS;
		if(!file_exists($modelPath)){
			FileUtil::createDir($modelPath);			
		}
		if(!file_exists($modelPath.DS. $tableName.DS)){
			FileUtil::createDir($modelPath.DS.$tableName.DS);
		}
		$actionName = $actionName ? $actionName : I('actionName');		
		$code = $this->generateViewCode($actionName);
		$filePath = $modelPath. $tableName .DS. $actionName.".html";

		file_put_contents($filePath, $code);
		return '生成成功，生成路径为：'.$filePath;
	}

	//加载表字段，返回select选项
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

	//由于{input}标签无法识别变量，需要预先加载输入组件模板
	protected function fillFormInputList($tableName, $tableInfoArray, $columnNameKey){
		$resStr = null;
		for($i = 0; $i < count($tableInfoArray); $i++){
			$this->assign('tableInfo',$tableInfoArray[$i]);
			$this->assign('tableName',$tableName);
			$this->assign('columnNameKey',$columnNameKey);
			$tfile = pressInputTypeTemplate($tableName, $tableInfoArray[$i][$columnNameKey]);
			$tableInfoArray[$i]['input'] = $this->display(file_get_contents($tfile));
		}
		return $tableInfoArray;
	}
}