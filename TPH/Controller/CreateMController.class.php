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
		$tableNameList = $this->getTableNameList();
		$this->assign('tableNameList', $tableNameList);
		$moduleNameList = $this->getModuleNameList();
		$this->assign('moduleNameList', $moduleNameList);
		$layoutNameList = $this->getLayoutTemplateNameList();
		$this->assign('layoutNameList', $layoutNameList);
		$this->display();
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
		
		//这里设定所有模板都使用layout.html作为文件名   
		$layoutStr = $this->makeLayoutTemplateFile(MODULE_PATH .'Template/'. $layoutName. '/layout.html', $selectTableName);
		FileUtil::unlinkFile($layoutPath."layout.html");//删除原模板文件
		file_put_contents($layoutPath."layout.html", $layoutStr);//写入解析后的模板
		$configStr = $this->newConfigFileStr();
		file_put_contents($configPath."config.php", $configStr);//改写配置文件为使用框架
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
				.$selectTableNameArray[$i]
				.'<span class="pull-right"><i class="icon-chevron-right"></i></span></a>';
			$menu .="\r\n<ul>\r\n";
			$menu .='<li><a href="__MODULE__/'. $selectTableNameArray[$i]."/all\">管理</a></li>\r\n"; 
			$menu .='<li><a href="__MODULE__/'. $selectTableNameArray[$i]."/add\">新建</a></li>\r\n</ul>\r\n</li>\r\n";
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
	
	//读取项目目录下的文件夹，供用户选择哪个才是module目录
	public function getModuleNameList(){
		$ignoreList = Array("Common","Home","Runtime","TPH");
		$allFileList = FileUtil::getDirList(APP_PATH);
		return array_diff($allFileList, $ignoreList);
	}
	
	public function getLayoutTemplateNameList(){
		$layoutTemplateNameList = FileUtil::getDirList(MODULE_PATH."/Template");
		return $layoutTemplateNameList;
	}
	
	//获取表名列表
	public function  getTableNameList(){
		$dbType = C('DB_TYPE');
		$Model = new Model(); // 实例化一个model对象 没有对应任何数据表
		if($dbType == 'mysql'){
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
	
	//获取需要生成的表名
	public function getSelectTableName(){
		$this->show();
	}
}