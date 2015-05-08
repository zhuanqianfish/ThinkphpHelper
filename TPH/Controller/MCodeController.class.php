<?php
//	ThinkphpHelper v0.3
//	
//	生成自定义模型
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace TPH\Controller;
use Think\Controller;

class MCodeController extends Controller {

    public function index(){
		$this->assign('db_prefix',C('DB_PREFIX'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$this->display();
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
		
		return "<?php\r\n". $this->fetch('generateRelationshipModelCode');
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
		
		echo $this->fetch('addRelationModelCode');
	}
	
	//写入关联模型文件
	public function createRelationshipModelFile(){
		$modelName = I('modelName');
		$moduleName = I('moduleName');
		$modelPath = APP_PATH.$moduleName.'/Model/';
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
		echo $this->fetch('getTableInfo');
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
		echo $this->fetch('getViewTableInfo');
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
		echo $this->fetch('getViewTableInfo2');
	}
	
	public function readOnColum(){
		C('LAYOUT_ON', false);
		$selectTableName = I('tableName');
		$columnNameKey = getColumnNameKey();
		$this->assign('columnNameKey', $columnNameKey);
		$tableInfoList = getTableInfoArray($selectTableName);
		$this->assign('tableInfoList', $tableInfoList);
		echo $this->fetch('viewModuleOn');
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
		
		return "<?php\r\n". $this->fetch('generateViewModelCode');
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
		
		echo $this->fetch('addViewModelCode');
	}
	
	//写入视图模型文件
	public function createViewModelFile(){
		$modelName = I('modelName');
		$moduleName = I('moduleName');
		$modelPath = APP_PATH.$moduleName.'/Model/';
		$code = htmlspecialchars_decode(I('code'));
		file_put_contents($modelPath.tableNameToModelName($modelName)."ViewModel.class.php", $code);
		echo '生成成功，生成路径为：'.$modelPath;
	}
}