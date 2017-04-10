<?php
use Think\Model;

define(SQLITE_COLUMN_NAME_KEY, 'name');	//sqlite列名键
define(MYSQL_COLUMN_NAME_KEY, 'column_name');	//mysql列名键

function func1(){
	echo 'this is func1';
}

//获取表名列表
function getTableNameList(){
	$dbType = C('DB_TYPE');
	$Model = new Model(); // 实例化一个model对象 没有对应任何数据表
	if(in_array($dbType, array('mysql', 'mysqli'))){
		$dbName = C('DB_NAME');
		$result = Array();
		$tempArray = $Model->query("select table_name from information_schema.tables where table_schema='".$dbName."' and table_type='base table'");
		foreach($tempArray as $temp){
			$result[] = $temp['table_name'];
		}
		return $result;
	}else{ //sqlite
		$result = Array();
		$tempArray = $Model->query("select * from sqlite_master where type='table' order by name");
		foreach($tempArray as $temp){
			$result[] = $temp['name'];
		}
		return $result;
	} 
	$this->error('数据库类型不支持');
}

//读取项目目录下的文件夹，供用户选择哪个才是module目录
function getModuleNameList(){
	$ignoreList = Array("Common","Runtime","TPH");
	$allFileList = getDirList(APP_PATH);
	return array_diff($allFileList, $ignoreList);
}

//获取列名列表
function getTableInfoArray($tableName){
	$dbType = C('DB_TYPE');
	$Model = new Model(); // 实例化一个model对象 没有对应任何数据表
	if($dbType == 'mysql'){
		$dbName = C('DB_NAME');
		$result = $Model->query("select * from information_schema.columns where table_schema='".$dbName."' and table_name='".C('DB_PREFIX').$tableName."'");
		$result = changeColumCase($result); //修正information_schema大小写问题
		return $result;
	}else{ //sqlite
		$result = $Model->query("pragma table_info (".C('DB_PREFIX').$tableName.")");
		$result = changeColumCase($result); //修正information_schema大小写问题
		return $result;
	} 
	
	
	$this->error('数据库类型不支持');
}


//根据数据库类型获取列名键
function getColumnNameKey(){
	$dbType = C('DB_TYPE');
	if($dbType == 'mysql'){
		return MYSQL_COLUMN_NAME_KEY;
	}else{
		return SQLITE_COLUMN_NAME_KEY;
	}
}

//仅获取目录列表
function getDirList($directory){
	$files = array();        
	try {        
		$dir = new \DirectoryIterator($directory);        
	} catch (Exception $e) {        
		throw new Exception($directory . ' is not readable');        
	}        
	foreach($dir as $file) {        
		if($file->isDot()) continue;        
		if($file->isFile()) continue;        
		$files[] = $file->getFileName();        
	}        
	return $files;  
}

//把带下划线的表名转换为驼峰命名（首字母大写）
function tableNameToModelName($tableName){
	$tempArray = explode('_', $tableName);
	$result = "";
	for($i = 0; $i < count($tempArray);$i++){
		$result .= ucfirst($tempArray[$i]);
	}
	return $result;
}

//把带下划线的列名转换为驼峰命名（首字母小写）
function columNameToVarName($columName){
	$tempArray = explode('_', $columName);
	$result = "";
	for($i = 0; $i < count($tempArray);$i++){
		$result .= ucfirst($tempArray[$i]);
	}
	return lcfirst($result);
}

// 转化键名为小写-用于修正mysql information_schema返回键名在不同环境下大小写不同的问题
//$columInfoArray 返回的表信息
function changeColumCase($columInfoArray){
	foreach($columInfoArray as $columInfo){
		$res[] = array_change_key_case($columInfo, CASE_LOWER);
	}
	return $res;
}


//解析字段中文名
//tableName	表名
//fieldName	字段名
function pressFieldDict($tableName, $fieldName){
	$dbDect = C('DB_FIELD_DICT');
	if($dbDect[$tableName][$fieldName]){
		if(is_array($dbDect[$tableName][$fieldName])){
			return $dbDect[$tableName][$fieldName]['asName'];
		}else{
			return $dbDect[$tableName][$fieldName];
		}
	}else{
		return $fieldName;
	}
}


//解析表中文名
function pressTableDict($tableName){
	$dbDect = C('DB_TABLE_DICT');
	return $dbDect[$tableName] ? $dbDect[$tableName] : $tableName;
}
