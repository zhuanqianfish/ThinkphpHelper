<?php
// 应用公共文件
use app\tph2\Controller\FileUtil;

///////////////TPH帮助方法/////////////
define('SQLITE_COLUMN_NAME_KEY', 'name');	//sqlite列名键
define('MYSQL_COLUMN_NAME_KEY', 'column_name');	//mysql列名键
define('PHP_HEAD', "<?php\r\n");	//php文件头，放模板中会被解析

//设置TPH的数据库定义
$tphDbConfig = include_once(APP_PATH.'tphdbconfig.php');
\think\Config::set('tphdb', $tphDbConfig);

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
	$allFileList = getDirList(BASE_PATH.getDbConfig('projectPath'));
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


//解析字段中文名 注意：仅为了兼容，以后不再试用
//tableName	表名
//fieldName	字段名
function pressFieldDict($tableName, $fieldName){
	return getFieldTitle($tableName, $fieldName);
}


//解析表中文名  注意：仅为了兼容，以后不再使用
function pressTableDict($tableName){
	return getTableTitle($tableName);
}

//从数据库解析中文表名
function getTableTitle($tableName){
	$tableName = C('database.prefix').$tableName;
	$tableinfo = tphDB('table_info')->where('name',$tableName)->find();
	if(isset($tableinfo['title'])){
		return $tableinfo['title'];
	}
	return $tableName;
}

//从数据库解析中文字段名
function getFieldTitle($tableName, $fieldName){
	$tableName = C('database.prefix').$tableName;
	$fieldinfo = tphDB('table_field')->where('table_name',$tableName)
									->where('field_name',$fieldName)
									->find();
	if(isset($fieldinfo['title'])){
		return $fieldinfo['title'];
	}
	return $fieldName;
}

//根据定义的字段输入类型选择
//$tableName:表名
//$fieldName字段名
//$theme 风格库名称
//$folder 代码片段所在文件夹
//值（编辑时页面使用）
function pressInputTypeTemplate($tableName, $fieldName, $value=null, $codeLib=null, $folder="Form/"){
	$tableName = C('database.prefix').$tableName;
	if($codeLib == null){
		$codeLib = getDbConfig('codeLib');
	}
	$templateBasePath = BASE_PATH.DS.CODE_REPOSITORY.DS. $codeLib .DS."view".DS;	//代码所在文件夹
	$fieldinfo = tphDB('table_field')->where('table_name',$tableName)
									->where('field_name',$fieldName)
									->find();
	if(isset($fieldinfo['input_type'])){
		if(file_exists($templateBasePath.$folder.$fieldinfo['input_type'].".html")){
			return $templateBasePath.$folder.$fieldinfo['input_type'].".html";
		}else{
			return $templateBasePath.$folder."text.html";//默认返回文本
		}
	}
	return  $templateBasePath.$folder."text.html";
}


if (!function_exists('testView')) {
    /**
     * 渲染模板输出
     * @param string    $template 模板文件
     * @param array     $vars 模板变量
     * @param integer   $code 状态码
     * @param callable  $filter 内容过滤
     * @return \think\response\View
     */
    function testView($template = '', $vars = [], $code = 200)
    {
        return \think\Response::create($template, 'view', $code)->assign($vars);
    }
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


//读取后端风格模板文件夹列表
function getCodelibList(){
	$codelibNameList0 = FileUtil::getDirList(__ROOT__. DS .CODE_REPOSITORY);
	$codelibDirNameList = array();
	foreach($codelibNameList0 as $codelibDirName){
		if(substr($codelibDirName, -5) != 'theme'){	//判断以layout结尾的才是布局文件夹
			$codelibDirNameList[] = $codelibDirName;
		}
	}
	return $codelibDirNameList;
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

//获取表单输入选项列表
//$tableName 表名
//$fieldName 字段名
//是否为列表类型 是则返回以‘#’分隔的数组
function getInputOption($tableName, $fieldName, $isList=false){
	$resStr = tphDB('table_field')->where('table_name', C('database.prefix').$tableName)
				->where('field_name', $fieldName)->value('input_value');
	if($isList){
		return  explode('#', $resStr);
	}
	return $resStr;
}

function tph2test(){
	return  dump(getInputOption('admin_node','name', true));
}