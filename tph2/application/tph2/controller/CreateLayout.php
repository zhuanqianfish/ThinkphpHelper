<?php
//	ThinkphpHelper v0.3
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller;
use think\Model;

//生成模块
class CreateLayout extends Base {
    public function index(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		$layoutName = getDbConfig('theme') == '' ? 'mac_theme' : getDbConfig('theme');
		$this->assign('layoutName', $layoutName);
		return $this->fetch('CreateLayout'.DS.'index');
    }
	
	
	//在指定目录下创建布局模板文件
	public function creatFiles(){
		$moduleName = I('moduleName');
		$layoutName = I('layoutName');
		$modulePath = BASE_PATH.getDbConfig('projectPath'). $moduleName;
		$layoutPath	= $modulePath. DS.'view'.DS;
		$themePath = __ROOT__ .DS.CODE_REPOSITORY.DS. $layoutName.DS;
		if(!file_exists(BASE_PATH.getDbConfig('projectPath').$moduleName.DS. 'view')){	//先创建view文件夹
			FileUtil::createDir(BASE_PATH.getDbConfig('projectPath').$moduleName.DS. 'view');	
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
		
		FileUtil::copyDir(__ROOT__ .DS.CODE_REPOSITORY.DS. $layoutName.DS. 'public', BASE_PATH.getDbConfig('projectPublicPath'), true);	//复制public到发布目录
		echo $layoutName. '/public/ 公共文件发布目录成功，路径：'. getDbConfig('projectPublicPath') .'<br>';
	}
	
}