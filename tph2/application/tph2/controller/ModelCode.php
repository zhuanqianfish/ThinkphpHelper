<?php
//	ThinkphpHelper v0.3
//	
//	生成自定义模型
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller; 
use	app\tph2\Controller\FileUtil;
use think\Request;
use think\Model;

class ModelCode extends Base {

	//简易模型代码生成
    public function index(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		return $this->fetch(DS.'ModelCode'.DS.'index'); 
	}
	
	//手动模型代码生成页
	public function index2(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		return $this->fetch(DS.'ModelCode'.DS.'index2'); 
	}

	//生成模型代码源码
	public function generateModelCode(){
		$tableName = getTableName(I('tableName'));
		$moduleName = I('moduleName');
		$this->assign('tableName', $tableName);
		$this->assign('moduleName', $moduleName);
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$codeBasePath = CODE_REPOSITORY.DS. $codelibName .DS;
		$template = file_get_contents($codeBasePath.'Model'.DS.'model.html');//读取模板
		return PHP_HEAD . $this->display($template,[],[],['view_path'=>$codeBasePath.'Model'.DS]);
	}

	//一键生成所有代码对应的文件，
	public function creatAllFiles(){
		$tableNameList = I('selectTableName');
		$moduleName = I('moduleName');
		$res = '';
		for($i = 0; $i < count($tableNameList); $i++){
			Request::instance()->post(['tableName'=> $tableNameList[$i]]);
			$res .= $this->createModelFile()."<br>";
		}
		return $res;
	}

	//生成单个文件
	public function generateModelFile(){
		$moduleName = I('moduleName');		
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'controller'.DS;
		$tableName = getTableName(I('tableName'));
		if(!file_exists($modelPath)){
			FileUtil::createDir($modelPath);
		}
		$code = $this->generateModelCode();
		$filePath = $modelPath.tableNameToModelName($tableName).".php";
		file_put_contents($filePath, $code);
		return '生成成功，生成路径为：'.$filePath.'<br>';
	}

	//生成模型文件
	public function createModelFile(){
		$moduleName = I('moduleName');
		$modelPath = BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'model'.DS;
		$tableName = getTableName(I('tableName'));
		if(!file_exists($modelPath)){
			FileUtil::createDir($modelPath);
		}
		$code = $this->generateModelCode();
		$filePath = $modelPath.tableNameToModelName($tableName).".php";
		file_put_contents($filePath, $code);
		return '生成成功，生成路径为：'.$filePath;
	}


	/////////////////2018-4/////////////////////////////////
	//生成模型增删改查代码
	public function createModelCRUDCode(){
		$tableName = getTableName(I('tableName'));
		$this->assign('tableName', $tableName);
		//$addCode = $this->fetch('\ModelCode\index');

		$temp = tphDB('config')->where('name','tph')->find();
		//return $this->fetch('\ModelCode\index');
	}
	
	public function relationshipModelCode(){
		echo $this->generateRelationshipModelCode();
	}
	
	//获得关联模型手工代码
	public function generateRelationshipModelCode(){ 
		C('LAYOUT_ON', false);
		$moduleName =  I('moduleName');
		$modelName = tableNameToModelName(I('modelName'));
		$mappingName = I('mappingName');
		$foreignKey = I('foreignKey');
		$relationForeignKey = I('relationForeignKey');
		$mappingType = I('mappingType');
		$className = tableNameToModelName(I('className'));
		$relationTable = I('relationTable');

		$this->assign('moduleName', $moduleName);
		$this->assign('modelName', $modelName);
		$this->assign('mappingName', $mappingName);
		$this->assign('foreignKey', $foreignKey);
		$this->assign('relationForeignKey', $relationForeignKey);
		$this->assign('mappingType', $mappingType);
		$this->assign('className', $className);
		$this->assign('relationTable', $relationTable);
		
		return "<?php\r\n". $this->fetch(DS.'ModelCode'.DS.'generateRelationshipModelCode');
	}
	
	//添加关联代码片段
	public function addRelationModelCode(){
		C('LAYOUT_ON', false);
		$mappingName = I('mappingName');
		$foreignKey = I('foreignKey');
		$relationForeignKey = I('relationForeignKey');
		$mappingType = I('mappingType');
		$className = tableNameToModelName(I('className'));
		$relationTable = I('relationTable');

		$this->assign('mappingName', $mappingName);
		$this->assign('foreignKey', $foreignKey);
		$this->assign('relationForeignKey', $relationForeignKey);
		$this->assign('mappingType', $mappingType);
		$this->assign('className', $className);
		$this->assign('relationTable', $relationTable);
		
		return $this->fetch(DS.'ModelCode'.DS.'addRelationModelCode');
	}
	
	//写入关联模型文件
	public function createRelationshipModelFile(){
		$modelName = I('modelName');
		$moduleName = I('moduleName');
		$modelPath = APP_PATH.$moduleName.DS.'Model'.DS;
		$code = htmlspecialchars_decode(I('code'));
		file_put_contents($modelPath.tableNameToModelName($modelName)."Model.class.php", $code);
		echo '生成成功，生成路径为：'.$modelPath;
	}
	
	//关联数据表列信息，返回radio形式
	public function getTableInfo(){	
		C('LAYOUT_ON', false);
		$this->assign('label', I('label'));
		$selectTableName = I('selectTableName');
		$columnNameKey = getColumnNameKey();
		$this->assign('columnNameKey', $columnNameKey);
		$tableInfoList = getTableInfoArray($selectTableName);
		$this->assign('tableInfoList', $tableInfoList);
		return $this->fetch(DS.'ModelCode'.DS.'getTableInfo');
		
	}
	
	//视图数据表列信息，返回checkbox形式
	public function getViewTableInfo(){	
		C('LAYOUT_ON', false);
		$this->assign('label', I('label'));
		$selectTableName = I('selectTableName');
		$columnNameKey = getColumnNameKey();
		$this->assign('columnNameKey', $columnNameKey);
		$tableInfoList = getTableInfoArray($selectTableName);
		$this->assign('tableInfoList', $tableInfoList);
		return $this->fetch(DS.'ModelCode'.DS.'getViewTableInfo');
		
		
	}
	
	//关联视图数据表列信息，返回checkbox形式
	public function getViewTableInfo2(){	
		C('LAYOUT_ON', false);
		$this->assign('label', I('label'));
		$selectTableName = I('selectTableName');
		$columnNameKey = getColumnNameKey();
		$this->assign('columnNameKey', $columnNameKey);
		$tableInfoList = getTableInfoArray($selectTableName);
		$this->assign('tableInfoList', $tableInfoList);
		return $this->fetch(DS.'ModelCode'.DS.'getViewTableInfo2');
		
	}
	
	public function readOnColum(){
		C('LAYOUT_ON', false);
		$selectTableName = I('tableName');
		$columnNameKey = getColumnNameKey();
		$this->assign('columnNameKey', $columnNameKey);
		$tableInfoList = getTableInfoArray($selectTableName);
		$this->assign('tableInfoList', $tableInfoList);
		return $this->fetch(DS.'ModelCode'.DS.'viewModuleOn');
		
	}
	
	//生成视图模型代码
	public function generateViewModelCode(){
		C('LAYOUT_ON', false);
		$moduleName =  I('moduleName');
		$modelName = tableNameToModelName(I('modelName'));
		$tableName = tableNameToModelName(I('tableName'));
		$viewModuleOn1 = I('viewModuleOn1');//表1关联字段
		$viewModuleOn2 = I('viewModuleOn2');//表2关联字段
		$table1FieldArray = I('table1Field');
		$joinType = I('joinType');
		$table1Field = "";
		for($i = 0; $i < count($table1FieldArray);$i++){
			$table1Field .= "'".$table1FieldArray[$i]."',";
		}
		$table1Field = substr($table1Field,0,-1);
		$selectColumName = I('selectColumName');
		$asColumName = I('asColumName');
		$table2Field = ""; // as代码
		for($i = 0; $i < count($selectColumName);$i++){
			$table2Field .= "'".$selectColumName[$i]."'";
			if($asColumName[$i] != ''){
				$table2Field .= '=>'."'".$asColumName[$i]."'";
			}
			$table2Field .= ",";
		}
		$table2Field = substr($table2Field,0,-1);
		
		$this->assign('moduleName', $moduleName);
		$this->assign('modelName', $modelName);
		$this->assign('tableName', $tableName);
		$this->assign('table1Field', $table1Field);
		$this->assign('table2Field', $table2Field);
		$this->assign('viewModuleOn1', $viewModuleOn1);
		$this->assign('viewModuleOn2', $viewModuleOn2);
		$this->assign('joinType', $joinType);
		
		return "<?php\r\n". $this->fetch(DS.'ModelCode'.DS.'generateViewModelCode');
	}
	
	public function viewModelCode(){
		echo $this->generateViewModelCode();
	}
	
	//添加视图模型代码片段
	public function addViewModelCode(){
		C('LAYOUT_ON', false);
		$modelName =  tableNameToModelName(I('modelName'));
		$tableName = tableNameToModelName(I('tableName'));
		$viewModuleOn1 = I('viewModuleOn1');//表1关联字段
		$viewModuleOn2 = I('viewModuleOn2');//表2关联字段
		$selectColumName = I('selectColumName');
		$asColumName = I('asColumName');
		$joinType = I('joinType');
		$table2Field = ""; // as代码
		for($i = 0; $i < count($selectColumName);$i++){
			$table2Field .= "'".$selectColumName[$i]."'";
			if($asColumName[$i] != ''){
				$table2Field .= '=>'."'".$asColumName[$i]."'";
			}
			$table2Field .= ",";
		}
		$table2Field = substr($table2Field,0,-1);
		
		$this->assign('modelName', $modelName);
		$this->assign('tableName', $tableName);
		$this->assign('table2Field', $table2Field);
		$this->assign('viewModuleOn1', $viewModuleOn1);
		$this->assign('viewModuleOn2', $viewModuleOn2);
		$this->assign('joinType', $joinType);
		
		$this->fetch(DS.'ModelCode'.DS.'addViewModelCode');
	}
	
	//写入视图模型文件
	public function createViewModelFile(){
		$modelName = I('modelName');
		$moduleName = I('moduleName');
		$modelPath = APP_PATH.$moduleName.DS.'Model'.DS;
		$code = htmlspecialchars_decode(I('code'));
		file_put_contents($modelPath.tableNameToModelName($modelName)."ViewModel.class.php", $code);
		echo '生成成功，生成路径为：'.$modelPath;
	}
}