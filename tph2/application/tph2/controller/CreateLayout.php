<?php
//	ThinkphpHelper v0.3
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use Think\Controller;
use Think\Model;

//生成模块
class CreateLayout extends Base {
    public function index(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$layoutNameList = getThemeList();
		$this->assign('layoutNameList', $layoutNameList);
		return $this->fetch('CreateLayout/index');
    }
	
	
	//在指定目录下创建布局模板文件
	public function creatFiles(){
		$moduleName = I('moduleName');
		$selectTableName = I('selectTableName');
		$layoutName = I('layoutName');
		$modulePath = TARGET_PROJECT_PATH. $moduleName;
		$layoutPath	= $modulePath. '/view/';
		$themePath = __ROOT__ .DS.CODE_REPOSITORY.DS. $layoutName.DS;
		if(!file_exists(TARGET_PROJECT_PATH.$moduleName.'/view')){	//先创建view文件夹
			FileUtil::createDir(TARGET_PROJECT_PATH.$moduleName.'/view');	
		}
		
		$publicViewFileList = getFileListEndWith($themePath.'view', 'view.html');
		foreach($publicViewFileList as $publicViewFile){
			$fileStr = file_get_contents($themePath.DS.'view'.DS.$publicViewFile);
			$fileStr = $this->display($fileStr);//渲染模板内容
			$publicViewFileName = str_replace('.view.html','.html', $publicViewFile);
			FileUtil::unlinkFile($layoutPath.$publicViewFileName);	//删除公共文件
			file_put_contents($layoutPath.$publicViewFileName, $fileStr);	//写入解析后的文件
			echo $publicViewFile.' 视图公共文件写入成功，路径：'. $layoutPath .'<br>';
		}
		
		FileUtil::copyDir(__ROOT__ .DS.CODE_REPOSITORY.DS. $layoutName.'/public', TARGET_PUBLIC_PATH, true);	//复制public到发布目录
		echo $layoutName. '/public/ 公共文件发布目录成功，路径：'. TARGET_PUBLIC_PATH .'<br>';
	}
	
}