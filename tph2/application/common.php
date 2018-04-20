<?php
// 应用公共文件
use app\tph2\Controller\FileUtil;

///////////////TPH帮助方法/////////////
define('SQLITE_COLUMN_NAME_KEY', 'name');	//sqlite列名键
define('MYSQL_COLUMN_NAME_KEY', 'column_name');	//mysql列名键
define('PHP_HEAD', "<?php\r\n");	//php文件头，放模板中会被解析

//转换带前缀的表名
//tableName:带前缀的表名
//首字母大写
function getTableName($tableName, $ucfirst = false){
	$prefix = C('database.prefix');
	if($prefix != ''){
		if(strpos($tableName, $prefix) === 0){
			$tableName = substr($tableName, strlen($prefix));
		}
	}
	if($ucfirst){
		return ucfirst($tableName); 
	}
	return $tableName ;
}

//操作Tph数据库
//tableName : 表名
//$newConnection : 不采用相同连接
function tphDB($tableName, $newConnection = false){
	return  db($tableName, C('tphdb') , $newConnection);
}

//获取tph数据库配置值
function getDbConfig($configName, $newConnection = false){
	return  db('config', C('tphdb') , $newConnection)->where('name', $configName)->value('value');
}


//获取表名列表
function getTableNameList(){
	$dbType = C('database.type');
	$Model = db(); // 实例化一个model对象 没有对应任何数据表
	if(in_array($dbType, array('mysql', 'mysqli'))){
		$dbName = C('database.database');
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
	return '数据库类型不支持';
}

//读取项目目录下的文件夹，供用户选择哪个才是module目录
function getModuleNameList(){
	$ignoreList = C('tphconfig.ignoreList');
	$allFileList = getDirList(TARGET_PROJECT_PATH);
	return array_diff($allFileList, $ignoreList);
}

//获取列名列表
function getTableInfoArray($tableName){
	$dbType = C('database.type');
	$Model = db(); // 实例化一个model对象 没有对应任何数据表
	if($dbType == 'mysql'){
		$dbName = C('database.database');
		$result = $Model->query("select * from information_schema.columns where table_schema='".$dbName."' and table_name='".C('database.prefix').$tableName."'");
		//$result = $Model->query("select * from information_schema.columns where table_schema='".$dbName."' and table_name='".$tableName."'");
		$result = changeColumCase($result); //修正information_schema大小写问题
		return $result;
	}else{ //sqlite
		$result = $Model->query("pragma table_info (".C('database.prefix').$tableName.")");
		$result = changeColumCase($result); //修正information_schema大小写问题
		return $result;
	} 
	
	return '数据库类型不支持';
}


//根据数据库类型获取列名键
function getColumnNameKey(){
	$dbType = C('database.type');
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

//把带下划线命名转换为驼峰命名（首字母大写）
function tableNameToModelName($tableName){
	$tempArray = explode('_', $tableName);
	$result = "";
	for($i = 0; $i < count($tempArray);$i++){
		$result .= ucfirst($tempArray[$i]);
	}
	return $result;
}

//把带下划线命名转换为驼峰命名（首字母小写）
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
	$res = [];
	foreach($columInfoArray as $columInfo){
		$res[] = array_change_key_case($columInfo, CASE_LOWER);
	}
	return $res;
}


//解析字段中文名
//tableName	表名
//fieldName	字段名
function pressFieldDict($tableName, $fieldName){
	$dbDect = C('dict.DB_FIELD_DICT');
	if(array_key_exists($tableName, $dbDect) && array_key_exists($fieldName, $dbDect[$tableName])){
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
	$dbDect = C('dict.DB_TABLE_DICT');
	if(array_key_exists($tableName, $dbDect)){
		return $dbDect[$tableName];
	}
	return  $tableName;
}


//读取前端风格模板文件夹列表
function getThemeList(){
	$themeNameList0 = FileUtil::getDirList(__ROOT__. DS .CODE_REPOSITORY);
	$themeNameList = array();
	foreach($themeNameList0 as $themeDirName){
		if(substr($themeDirName, -5) == 'theme'){	//判断以layout结尾的才是布局文件夹
			$themeNameList[] = $themeDirName;
		}
	}
	return $themeNameList;
}


//获取以特定字符串结尾的文件列表
//rootDir: 读取的目录
//fileEdn: 文件结尾（不含后缀）
function getFileListEndWith($rootDir, $fileEnd){
	$fileList0 = FileUtil::getFileList($rootDir);
	$endLenth = strlen($fileEnd);
	$fileNameList = array();
	foreach($fileList0 as $fileName){
		if(substr($fileName, -$endLenth) == $fileEnd){	//判断以layout结尾的才是布局文件夹
			$fileNameList[] = $fileName;
		}
	}
	return $fileNameList;
} 