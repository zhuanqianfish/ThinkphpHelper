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
class WedgitCode extends Base {
	//菜单管理
    public function menu(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		$layoutName = getDbConfig('theme') == '' ? 'mac_theme' : getDbConfig('theme');
		$this->assign('layoutName', $layoutName);
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$this->assign('codelibName', $codelibName);
		$menuList = $this->getMenuFileList();
		$this->assign('menuList', $menuList);
		return $this->fetch('WedgitCode'.DS.'menu');
	}
	
	//权限管理
	public function authManage(){
		$this->assign('db_prefix',C('database.prefix'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleName = getDbConfig('moduleName');
		$this->assign('moduleName', $moduleName);
		$layoutName = getDbConfig('theme') == '' ? 'mac_theme' : getDbConfig('theme');
		$this->assign('layoutName', $layoutName);
		$codelibName = getDbConfig('codeLib') == '' ? 'default' : getDbConfig('codeLib');
		$this->assign('codelibName', $codelibName);
		$menuList = $this->getMenuFileList();
		$this->assign('menuList', $menuList);
		
		return $this->fetch('WedgitCode'.DS.'authManage');
	}
	
	//在指定目录下创建菜单文件
	public function creatFiles(){
		$moduleName = I('moduleName');
		$layoutName = I('layoutName');
		$modulePath = BASE_PATH.getDbConfig('projectPath'). $moduleName;
		$themePath = __ROOT__ .DS.CODE_REPOSITORY.DS. $layoutName.DS;
		if(!file_exists(BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'view')){//先创建view文件夹
			FileUtil::createDir(BASE_PATH.getDbConfig('projectPath').$moduleName.DS.'view');	
		}
		foreach(I('selectTableName') as $selectTableName){
			$tableNameList[] = getTableName($selectTableName);
		}
		$this->assign('menuList', $tableNameList);
		$this->assign('moduleName', $moduleName);
		$theme = I('theme'); //代码风格
		$templateBasePath = CODE_REPOSITORY.DS. $theme .DS."view".DS;
		$codeBasePath = CODE_REPOSITORY.DS. I('codelib') .DS;
		$wedgitName = I('menuName');
		$saveFileName = I('saveFileName').'.html';
		$template = file_get_contents($templateBasePath . $wedgitName);	//读取模板
		$resCode =  $this->display($template,[],[],['view_path'=>$codeBasePath.'View'.DS]);
		$filePath = $modulePath .DS.'view'.DS. $saveFileName;
		file_put_contents($filePath, $resCode);
		echo $wedgitName.' 写入菜单成功，路径：'. $filePath .'<br>';
	}

	//ajax方式读取风格下模板文件列表（以menu.html结尾的文件）
	public function getMenuFileList(){
		$themeName = I('themeName')? I('themeName'): 'mac_theme';
		$themePath = __ROOT__ .DS.CODE_REPOSITORY.DS. $themeName.DS;
		$menuList = getFileListEndWith($themePath.'view', 'menu.html');
		return $menuList;
	}
}