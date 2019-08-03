<?php
//加载文件夹下所有类库
defined("BASE_PATH") or exit('Access Denied');

//仅获取文件列表
function _getFileList($directory){
	$files = [];        
	try {        
		$dir = new \DirectoryIterator($directory);        
	} catch (Exception $e) {        
		throw new Exception($directory . ' is not readable');        
	}        
	foreach($dir as $file) {        
		if($file->isDot()) continue;        
		if($file->isDir()) continue;
		if($file->getBasename() == 'fishAutoLoad.php')  continue;      
		$files[] = $file->getFileName();
	}        
	return $files; 
}

//目录下全部加载
function  autoLoadAllInFolder($baseDir){
	$ignoreFileList = ['index.html','index.htm'];	//忽略加载文件列表
	$fileArray = _getFileList($baseDir);
	foreach($fileArray as $file){
		if(!array_search($file, $ignoreFileList)){
			require_once $baseDir.$file;
		}
	}
}

//自动加载类库
function fishAutoLoad($className, $fileSuffix='.php'){
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $className).$fileSuffix;
	if (file_exists($file))
	{
		require_once $file;
		return true;
	}
	return false;
}

spl_autoload_register("fishAutoLoad", true);

require_once(VENDOR_PATH.'autoload.php');	//composer 自动加载

autoLoadAllInFolder(CORE_PATH);
require_once(COMMON_PATH.'function.php');	//加载助手函数
?>