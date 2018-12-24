<?php
//	ThinkphpHelper v0.3
//
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace app\tph2\Controller;
use think\Controller;

class ProjectConfig extends Base{

	public function index(){
		if(IS_POST()){
			tphDB('config')->where('name', 'theme')->update(['value'=>I('post.theme')]);
			tphDB('config')->where('name', 'codeLib')->update(['value'=>I('post.codelib')]);
			tphDB('config')->where('name', 'projectName')->update(['value'=>I('post.projectName')]);
			tphDB('config')->where('name', 'projectPath')->update(['value'=>I('post.projectPath')]);
			tphDB('config')->where('name', 'projectPublicPath')->update(['value'=>I('post.projectPublicPath')]);
			tphDB('config')->where('name', 'moduleName')->update(['value'=>I('post.moduleName')]);
			return $this->success('更新成功');
		}else{
			$configList = tphDB('config')->select();
			$this->assign('configList', $configList);
			$this->assign('db_prefix',C('database.prefix'));
			$tableNameList = getTableNameList();
			$this->assign('tableNameList', $tableNameList);
			$moduleNameList = getModuleNameList();
			$this->assign('moduleNameList', $moduleNameList);
			$layoutNameList = getThemeList();
			$this->assign('layoutNameList', $layoutNameList);
			$codelibNameList = getCodelibList();
			$this->assign('codelibNameList', $codelibNameList);
			return $this->fetch('ProjectConfig'.DS.'index');
		}
	}
	
	public function test(){
		echo helpertest();

	}

	public function checkVersion(){	//检查代码版本
		header("Content-type: text/html; charset=utf-8");
		$version = C('VERSION');
		$url = 'http://zhuanqianfish.github.io/ThinkphpHelper/version.txt';
		$newVersion =  (float)file_get_contents($url);
		if($newVersion > $version){
			echo '<font color="red">有新版本，建议更新!</font>';
		}
	}

	//表单项配置
	public function formConfig(){
		if(IS_POST()){
			tphDB('config')->where('name', 'theme')->update(['value'=>I('post.theme')]);
			tphDB('config')->where('name', 'codelib')->update(['value'=>I('post.codelib')]);
			tphDB('config')->where('name', 'projectName')->update(['value'=>I('post.projectName')]);
			tphDB('config')->where('name', 'projectPath')->update(['value'=>I('post.projectPath')]);
			tphDB('config')->where('name', 'projectPublicPath')->update(['value'=>I('post.projectPublicPath')]);
			
			return $this->success('更新成功');
		}else{
			$tableList = getTableNameList();
			$this->assign('tableList', $tableList);			
			return $this->fetch('ProjectConfig'.DS.'formConfig');
		}
	}

	//读取表字段信息
	public function getTableInfo(){
		$tableName = getTableName(I('tableName'));
		$tableinfoArray =  getTableInfoArray($tableName);
		$str = '';
		$findex = 0;
		foreach($tableinfoArray as $tableInfo){
			$record = tphDB('table_field')->where('field_name', $tableInfo['column_name'])
					->where('table_name','tp_'.$tableName)->find();

			$this->assign('fieldName', $tableInfo['column_name']);
			$this->assign('findex', $findex);
			if($record){
				$this->assign('record', $record);
				$str .= $this->fetch('ProjectConfig'.DS.'formFieldEdit')."\r\n";
			}else{
				$str .= $this->fetch('ProjectConfig'.DS.'formField')."\r\n";
			}
			$findex++;
		}
		return $str;
	}

	//保存表配置信息
	public function saveTableConfig(){
		$formConfigData = I('form');
		$tableName = I('table_name');
		foreach($formConfigData as $configData){
			$configData['table_name'] = $tableName;	
			if($record = tphDB('table_field')->connect('tphdb')
						->where('field_name', $configData['field_name'])
						->where('table_name', $tableName)
						->find())
			{
				tphDB('table_field')->where('id',$record['id'])->update($configData);					
			}else{
				tphDB('table_field')->insert($configData);
			}
		}
		$this->success('保存成功', U('formConfig'));
	}
}
