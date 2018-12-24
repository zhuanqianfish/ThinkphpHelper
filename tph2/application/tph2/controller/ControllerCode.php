<?php
//	ThinkphpHelper v0.3
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller;
use think\Model;
use think\Request;

class ControllerCode extends Base {
	public function index(){	//生成CRUD代码
		$this->assign('tableNameList', getTableNameList());
		$this->assign('moduleNameList', getModuleNameList());
		$this->assign('selectTableName', $this->getSessionTableName());
		$this->assign('db_prefix',C('database.prefix'));
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		return $this->fetch('ControllerCode'.DS.'index');
    }


	//生成控制器代码
	public function generateControllerCode(){
		$tableName = getTableName(I('tableName'));
		$moduleName = I('moduleName');
		$this->assign('tableName', $tableName);
		$this->assign('moduleName', $moduleName);
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;
		$template = file_get_contents($codeBasePath.'Controller'.DS.'controller.html');//读取模板.
		return PHP_HEAD . $this->display($template,[],[],['view_path'=>$codeBasePath.'Controller'.DS]);
	}

	//生成控制器文件
	public function generateControllerFile(){
		$moduleName = I('moduleName');		
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'controller'.DS;
		$tableName = getTableName(I('tableName'));
		if(!file_exists($modelPath)){
			FileUtil::createDir($modelPath);
		}
		$code = $this->generateControllerCode();
		$filePath = $modelPath.tableNameToModelName($tableName).".php";
		file_put_contents($filePath, $code);
		return '生成成功，生成路径为：'.$filePath.'<br>';
	}

	//生成所有代码对应的文件，
	public function creatAllFiles(){
		$tableNameList = I('selectTableName');
		$moduleName = I('moduleName');
		$res = '';
		for($i = 0;$i < count($tableNameList); $i++){
			Request::instance()->post(['tableName'=> $tableNameList[$i]]);
			$res .= $this->generateControllerFile();
		}
		return $res;
	}

	///读取session中已选中的table
	public function getSessionTableName(){
		if(session('selectTableName')){
			$selectTableName = implode("','", session('selectTableName'));
			return $selectTableName;
		}
	}
	
	
	//列出所有记录页面代码（片段）
	public function generateAllPageCode(){
		$tableName = I('table');
		$TableName = tableNameToModelName($tableName);
		$tableInfoArray = getTableInfoArray($tableName);
		$columnNameKey = getColumnNameKey();
		
		$this->assign('tableName', $tableName);
		$this->assign('TableName', $TableName);
		$this->assign('tableInfoArray', $tableInfoArray);
		$this->assign('columnNameKey', $columnNameKey);
		$resultCode = $this->makeViewTemplate('getList');
		return $resultCode;
	}
	
	public function allPageCode(){
		echo $this->generateAllPageCode();
	}
	
	
	//列出所有记录页面，读取并填充数据
	public function previewAllPage(){ 
		$tableName = I('table'); 
		$Model = M($tableName);
		$resultCode = "<table class=\"table table-striped table-bordered table-hover\">\r\n<thead>\r\n<tr>\r\n";
		$tableInfoArray = getTableInfoArray($tableName);
		foreach($tableInfoArray as $tableInfo){ //拼接表头
			$name = $tableInfo[getColumnNameKey()];
			$resultCode .= "<th><center>".$name."</center></th>\r\n";
		}
		$resultCode .= "<th>操 作</th>\r\n</tr>\r\n</thead>\r\n";
		for($i = 0; $i < 5; $i++){//填充5个数据
			foreach($tableInfoArray as $tableInfo){ 
				$resultCode .= "<td>" .$tableInfo[getColumnNameKey()]. "</td>\r\n";
			}
			$resultCode .= '<td><a href="'.U(tableNameToModelName($tableName).'/edit?id='.$i).'">编辑</a> | '	
					.'<a href="'.U(tableNameToModelName($tableName).'/delete?id='.$i).'" onclick=\'return confirm("确定删除吗？")\'>删除</a></td></tr>'."\r\n";
		}
		$resultCode .= "</table>\r\n";
		echo $resultCode;
	}
	
	//生成所有记录代码
	public function generateAllCode(){
		$tableName = I('table');
		$isPage = I('isPage');
		$this->assign('tableName', $tableName);
		$this->assign('TableName', tableNameToModelName($tableName));//修正为驼峰命名，首字母大写
		$resultCode = $this->makeControllerTemplate("getList");
		return $resultCode;
	}
	
	public function allCode(){
		echo $this->generateAllCode();
	}
	
	//生成新建页面代码（片段）
	public function generateAddPage(){ 
		$actionName = "add";
		$tableName = I('table'); 
		$TableName = tableNameToModelName($tableName);
		$tableInfoArray = getTableInfoArray($tableName);
		$columnNameKey = getColumnNameKey();
		
		$this->assign('tableName', $tableName);
		$this->assign('TableName', $TableName);
		$this->assign('tableInfoArray', $tableInfoArray);
		$this->assign('columnNameKey', $columnNameKey);
		$resultCode = $this->makeViewTemplate($actionName);
		return $resultCode;
	}
	
	//生成新建前台页面代码
	public function addPage(){
		echo $this->generateAddPage();
	}
	
	//新建操作代码
	public function generateAddCode(){	
		$tableName = I('table'); 
		$this->assign('tableName', $tableName);
		$this->assign('TableName', tableNameToModelName($tableName));//修正为驼峰命名，首字母大写
		$resultCode = $this->makeControllerTemplate("add");
		return $resultCode;
	}
	
	public function addCode(){
		echo $this->generateAddCode();
	}
	
	//编辑页面
	public function generateEditPage(){	
		$tableName = I('table'); 
		$TableName = tableNameToModelName($tableName);
		$tableInfoArray = getTableInfoArray($tableName);
		$columnNameKey = getColumnNameKey();
		
		$this->assign('tableName', $tableName);
		$this->assign('TableName', $TableName);
		$this->assign('tableInfoArray', $tableInfoArray);
		$this->assign('columnNameKey', $columnNameKey);
		$resultCode = $this->makeViewTemplate('edit');
		return $resultCode;
	}

	public function editPage(){	
		echo $this->generateEditPage();
	}
	
	//生成编辑代码
	public function generateEditCode(){ 
		$tableName = I('table'); 
		$this->assign('tableName', $tableName);
		$this->assign('TableName', tableNameToModelName($tableName));//修正为驼峰命名，首字母大写
		$resultCode = $this->makeControllerTemplate("edit");
		return $resultCode;
	}
	
	public function editCode(){
		echo $this-> generateEditCode();
	}
	
	//删除代码
	public function generateDeleteCode(){
		$tableName = I('table'); 
		$this->assign('tableName', $tableName);
		$this->assign('TableName', tableNameToModelName($tableName));//修正为驼峰命名，首字母大写
		$resultCode = $this->makeControllerTemplate("delete");
		return $resultCode;
	}
	
	public function deleteCode(){
		echo $this->generateDeleteCode();
	}
	
	
	
	
	//解析前台View模板
	public function makeViewTemplate($actionName = null, $moduleName=null, $theme='default'){
		$actionName = $actionName ? $actionName : I('actionName');
		$moduleName = $moduleName ? $moduleName :I('moduleName');
		$templateBasePath = CODE_REPOSITORY.DS. $theme .DS. "view".DS;	//代码所在文件夹
		$template = file_get_contents($templateBasePath . $actionName.".html");	//读取模板
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;
		$resCode =  $this->display($template,[],[],['view_path'=>$codeBasePath. 'View'.DS ]);
		return $resCode;
	}
	

	//解析后台Controller模板
	public function makeControllerTemplate($actionName = null, $moduleName=null, $theme='default'){
		$actionName = $actionName ? $actionName : I('actionName');
		$moduleName = $moduleName ? $moduleName :I('moduleName');
		$templateBasePath = CODE_REPOSITORY.DS. $theme .DS. "Controller".DS;	//代码所在文件夹
		$template = file_get_contents($templateBasePath . $actionName.".html");	//读取模板
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;
		$resCode =  $this->display($template,[],[],['view_path'=>$codeBasePath. 'View'.DS]);
		return $resCode;
	}
	
	
}