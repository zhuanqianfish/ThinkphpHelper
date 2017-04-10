<?php
//	ThinkphpHelper v0.3
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace TPH\Controller;
use Think\Controller;
use Think\Model;

//生成模块
class CreateMController extends Controller {
    public function index(){
		$this->assign('db_prefix',C('DB_PREFIX'));
		$tableNameList = getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$layoutNameList = $this->getLayoutTemplateNameList();
		$this->assign('layoutNameList', $layoutNameList);
		$this->assign('selectTableName', $this->getSessionTableName());
		$this->display();
    }
	
	public function getSessionTableName(){
		$selectTableName = implode("','", session('selectTableName'));
		return "['".$selectTableName."']";
	}
	
	//在指定目录下创建布局模板文件
	public function creatFiles(){
		$moduleName = I('moduleName');
		$selectTableName = I('selectTableName');
		$layoutName = I('layoutName');
		$modulePath = APP_PATH. $moduleName. '/';
		$layoutPath	= $modulePath. 'View/';
		$configPath	= $modulePath. 'Conf/';
		FileUtil::copyDir(MODULE_PATH .'Template/'. $layoutName, $layoutPath, true);//先复制文件结构
		
		//把选择的数据表存入Session供其他步骤调用
		session('selectTableName',$selectTableName);
		//这里设定所有模板都使用layout.html作为文件名   
		$layoutStr = $this->makeLayoutTemplateFile(MODULE_PATH .'Template/'. $layoutName. '/layout.html', $selectTableName);
		FileUtil::unlinkFile($layoutPath."layout.html");//删除原模板文件
		file_put_contents($layoutPath."layout.html", $layoutStr);//写入解析后的模板
		
		file_put_contents($configPath.'config.php', $this->newConfigFileStr());//修改配置文件
		echo $layoutName. '写入布局模板成功，路径：'. $layoutPath;
	}
	
	//解析布局模板文件,newStr是替换后的字符串
	public function makeLayoutTemplateFile($filePath, $selectTableName){
		$fileContent = file_get_contents($filePath);
		//$fileContent = mb_convert_encoding($fileContent, 'UTF-8');
		$menu = "";
		$selectTableNameArray = $selectTableName;
		for($i = 0; $i < count($selectTableNameArray) ;$i++){
				$menu .='<li class="has_sub"><a href="#"><i class="icon-list-alt"></i> '
				.tableNameToModelName($selectTableNameArray[$i])
				.'<span class="pull-right"><i class="icon-chevron-right"></i></span></a>';
			$menu .="\r\n<ul>\r\n";
			$menu .='<li><a href="__MODULE__/'. tableNameToModelName($selectTableNameArray[$i])."/all\">管理</a></li>\r\n"; 
			$menu .='<li><a href="__MODULE__/'. tableNameToModelName($selectTableNameArray[$i])."/add\">新建</a></li>\r\n</ul>\r\n</li>\r\n";
		}
		$fileContent = str_replace('@menu', $menu, $fileContent);
		return $fileContent;
	}
	
	//配置文件内容
	public function newConfigFileStr(){
		return <<<newConfigFileStr
<?php
return array(
	//'配置项'=>'配置值'
	'LAYOUT_ON'			=>	true,		//开启布局
	'LAYOUT_NAME'		=>	'layout',	//布局名称layout
);
newConfigFileStr;
	}
	

	public function getLayoutTemplateNameList(){
		$layoutTemplateNameList0 = FileUtil::getDirList(MODULE_PATH."/Template");
		$layoutTemplateNameList = array();
		foreach($layoutTemplateNameList0 as $layoutDirName){
			if(substr($layoutDirName, -6) == 'layout'){	//判断以layout结尾的才是布局文件夹
				$layoutTemplateNameList[] = $layoutDirName;
			}
		}
		return $layoutTemplateNameList;
	}
}