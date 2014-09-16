<?php
//	ThinkphpHelper
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月11日
namespace Home\Controller;
use Think\Controller;
use Think\Model;


class ThinkphpHelperController extends Controller {

	const SQLITE_COLUMN_NAME_KEY = 'name';	//sqlite列名键
	const MYSQL_COLUMN_NAME_KEY = 'COLUMN_NAME';	//mysql列名键
	
    public function index(){
		//header("Content-Type: text/html;charset=utf-8");
		$this->showTemplate();
	}
	
	//根据数据库类型获取列名键
	private function getColumnNameKey(){
		$dbType = C('DB_TYPE');
		if($dbType == 'mysql'){
			return self::MYSQL_COLUMN_NAME_KEY;
		}else{
			return self::SQLITE_COLUMN_NAME_KEY;
		}
	}
	
	//列出所有记录页面代码
	public function allPageCode(){
		$tableName = I('table'); 
		$Model = M($tableName);
		$resultCode = "<table class=\"table table-striped\">\r\n<thead>\r\n<tr>\r\n";	
		$tableInfoArray = $this->getTableInfoArray($tableName);
		foreach($tableInfoArray as $tableInfo){ //拼接表头
			$columnName = $tableInfo[$this->getColumnNameKey()];
			$resultCode .= "<th>".$columnName."</th>\r\n";
		}
		
		$resultCode .= "<td>操作</td>\r\n</tr>\r\n</thead>\r\n". '<volist name="' .$tableName. 'List" id="vo">'."\r\n<tr>\r\n";
		foreach($tableInfoArray as $tableInfo){ //拼接循环部分
			$resultCode .= '<td>{$vo.' .$tableInfo[$this->getColumnNameKey()]. "}</td>\r\n";
		}
		$resultCode .= '<td><a href="{:U(\'' .ucfirst($tableName). '/edit\')}?id={$vo.id}">编辑</a> | '	//假定所有表均以id为主键
					.'<a href="{:U(\'' .ucfirst($tableName).'/delete\')}?id={$vo.id}" onclick=\'return confirm("确定删除吗？")\'>删除</a></td>'
					."\r\n<tr>\r\n</volist>\r\n</table>\r\n";
		//dump($resultCode);
		$this->show('<literal>'.$resultCode.'</literal>');//<literal>标签是防止$Think 系统的标签在show中被解析
	}
	
	
	//列出所有记录页面，读取并填充数据
	public function previewAllPage(){ 
		$tableName = I('table'); 
		$Model = M($tableName);
		$resultCode = "<table class=\"table table-striped\">\r\n<thead>\r\n<tr>\r\n";
		$tableInfoArray = $this->getTableInfoArray($tableName);
		foreach($tableInfoArray as $tableInfo){ //拼接表头
			$name = $tableInfo[$this->getColumnNameKey()];
			$resultCode .= "<th>".$name."</th>\r\n";
		}
		$resultCode .= "<th>操 作</th>\r\n</tr>\r\n</thead>\r\n";
		for($i = 0; $i < 5; $i++){//填充5个数据
			foreach($tableInfoArray as $tableInfo){ 
				$resultCode .= "<td>" .$tableInfo[$this->getColumnNameKey()]. "</td>\r\n";
			}
			$resultCode .= '<td><a href="'.U(ucfirst($tableName).'/edit?id='.$i).'">编辑</a> | '	
					.'<a href="'.U(ucfirst($tableName).'/delete?id='.$i).'" onclick=\'return confirm("确定删除吗？")\'>删除</a></td></tr>'."\r\n";
		}
		$resultCode .= "</table>\r\n";
		//return $resultCode;
		$this->show($resultCode);
	}
	
	//生成所有记录代码
	public function allCode(){
		$tableName = I('table'); 
		$resultCode = <<<str
public function all(){
	$@tableNameModel = M('@TableName');
	$@tableNameList = $@tableNameModel ->select();
	\$this->assign('@tableNameList', $@tableNameList);
	\$this->display();
}
str;
		$resultCode = str_replace('@tableName', $tableName, $resultCode);
		$resultCode = str_replace('@TableName', ucfirst($tableName), $resultCode);//修正为驼峰命名，首字母大写
		//return $resultCode;
		$this->show('<literal>' .$resultCode. '</literal>');
	}
	
	//生成新建页面代码
	public function addPage(){ 
		$tableName = I('table'); 
		$Model = new Model();
		$resultCode = '<form class="form-horizontal" method="post">'."\r\n";
		$tableInfoArray = $this->getTableInfoArray($tableName);
		
		foreach($tableInfoArray as $tableInfo){
			$name = $tableInfo[$this->getColumnNameKey()];
			// $cid  = $tableInfo['cid'];	//这里本来是给sqlite数据库的，为了兼容mysql暂时取消
			// $type = $tableInfo['type'];
			// $notnull = $tableInfo['notnull'];
			// $dflt_value = $tableInfo['dflt_value'];
			// $pk = $tableInfo['pk'];
			//dump($tableInfo);
			if($name != 'id'){
				$resultCode .=  '<label  class="col-sm-2 control-label">' .$name;
				$resultCode .= '</label>';
				//这里按说应该区别对待，为了简单就写了个一样的
				$resultCode .=  '<p class="col-sm-10">'
									.'<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" />'
									.'</p>';
				/* 如sqlite就可以分成4种
				switch ($type){ 
				case 'INTEGER':
					$resultCode .=  '<p class="col-sm-10">'
									.'<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
									.'</p>';
					break;
				case 'TEXT':
					$resultCode .=  '<p class="col-sm-10">'
									.'<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
									.'</p>';
					break;
				case 'REAL':
					$resultCode .=  '<p class="col-sm-10">'
									.'<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
									.'</p>';
					break;
				case 'BOLB':
					$resultCode .=  '<p class="col-sm-10">'
									.'<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
									.'</p>';
					break;
				}*/
			}

			//if(!is_null($dflt_value)){
			//	$resultCode .= '默认值:'.$dflt_value;
			//}
			$resultCode .= "\r\n";
		}
		$resultCode .='<input  type="submit"  value="提交" class="btn btn-default" />' 
					."</form>";
		//return $resultCode;
		$this->show('<literal>'.$resultCode.'</literal>');
	}
	
	//新建操作代码
	public function addCode(){	
		$tableName = I('table'); 
		$resultCode = <<<str
public function add(){
	if(IS_POST){
		$@tableNameModel = M('@TableName');
		$@tableNameModel ->create();
		\$flag = $@tableNameModel ->add();
		if(\$flag){
			\$this->success('新建成功',U('@TableName/all')); 
		}else{
			\$this->error('新建失败',U('@TableName/all')); 
		}
	}else{
		\$this->display(); 
	}
}
str;
		$resultCode = str_replace('@tableName', $tableName, $resultCode);
		$resultCode = str_replace('@TableName', ucfirst($tableName), $resultCode);//修正为驼峰命名，首字母大写
		//return $resultCode;
		$this->show($resultCode);
	}
	
	//编辑页面
	public function editPage(){	
		$tableName = I('table'); 
		$Model = new Model();
		$resultCode = '<form class="form-horizontal" method="post">'."\r\n";
		$tableInfoArray = $this->getTableInfoArray($tableName);
			foreach($tableInfoArray as $tableInfo){
				$name = $tableInfo[$this->getColumnNameKey()];
				if($name != 'id'){
					$resultCode .=  '<label  class="col-sm-2 control-label">' .$name;
					$resultCode .= '</label>';
					//这里按说应该区别对待，为了简单就写了个一样的
					$resultCode .=  '<p class="col-sm-10">'
										.'<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
										.'</p>';
					/*
					switch ($type){ 
					case 'INTEGER':
						$resultCode .=  '<p class="col-sm-10">'
										.'<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
										.'</p>';
						break;
					case 'TEXT':
						$resultCode .=  '<p class="col-sm-10">'
										.'<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
										.'</p>';
						break;
					case 'REAL':
						$resultCode .=  '<p class="col-sm-10">'
										.'<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
										.'</p>';
						break;
					case 'BOLB':
						$resultCode .=  '<p class="col-sm-10">'
										.'<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />'
										.'</p>';
						break;
					}*/
				}else{
					$resultCode .= '<input type="hidden" name="id" value="{$'.$tableName.'.'.$name.'}" />';
				}
				if($dflt_value != ''){
					$resultCode .= '默认值:'.$dflt_value;
				}
				$resultCode .= "<br>\r\n";
			}
			$resultCode .='<input  type="submit"  value="提交" class="btn btn-default">' 
						."</form>";
			$this->show('<literal>'.$resultCode.'</literal>');
	}

	//生成编辑代码
	public function editCode(){ 
		$tableName = I('table'); 
		$resultCode = <<<str
public function edit(){
	$@tableNameModel = M('@TableName');
	if(IS_POST){
		$@tableNameModel ->create();
		\$flag = $@tableNameModel ->save();
		if(\$flag){
			\$this->success('编辑成功',U('@TableName/all')); 
		}else{
			\$this->error('编辑失败',U('@TableName/all')); 
		}
	}else{
		\$id = I('id'); 
		$@tableName = $@tableNameModel->find(\$id);
		\$this->assign('@tableName', $@tableName);
		\$this->display();
	}
}

str;
		$resultCode = str_replace('@tableName', $tableName, $resultCode);
		$resultCode = str_replace('@TableName', ucfirst($tableName), $resultCode);//修正为驼峰命名，首字母大写
		//return $resultCode;
		$this->show($resultCode);
	}
	
	//删除代码
	public function deleteCode(){
		$tableName = I('table'); 
		$resultCode = <<<str
public function delete(){
	$@tableNameModel = M('@tableName');
	\$id = I('id'); 
	\$flag = $@tableNameModel->where('id='.\$id)->delete();
	if(\$flag){
		\$this->success('删除成功', U('@TableName/all'));
	}else{
		\$this->error('删除失败', U('@TableName/all'));
	}
}
str;
		$resultCode = str_replace('@tableName', $tableName, $resultCode);
		$resultCode = str_replace('@TableName', ucfirst($tableName), $resultCode);//修正为驼峰命名，首字母大写
		//return $resultCode;
		$this->show($resultCode);
	}
	
	/*
	public function getOneItemById($ModelName, $id){ // 根据模型名称返回一个模型
		$itemModel = M($ModelName);
		return $item = $itemModel->find(\$id);
	}
	*/
	
	//获取表名列表
	public function getTableNamesArray(){
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
	
	//获取列名列表
	public function getTableInfoArray($tableName){
		$dbType = C('DB_TYPE');
		$Model = new Model(); // 实例化一个model对象 没有对应任何数据表
		if($dbType == 'mysql'){
			$dbName = C('DB_NAME');
			$result = $Model->query("select * from information_schema.columns where table_schema='".$dbName."' and table_name='".C('DB_PREFIX').$tableName."'");
			return $result;
		}else{ //sqlite
			$result = $Model->query("pragma table_info (".C('DB_PREFIX').$tableName.")");
			return $result;
		} 
		$this->error('数据库类型不支持');
	}
	
	//每个数据表的结构
	private function getStructure(){ 	
		$Model = new Model(); 
		$tableNamesArray = $this->getTableNamesArray();
		foreach($tableNamesArray as $tableNameArray){
			show( $Model->query("pragma table_info (".$tableNameArray['name'].")"));
		}
	}
	
	
	//自带模板 
	private function getTemplateStr(){ 
	
		$templateStr = <<<tpl
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>ThinkPHP Helper - weiyunstudio.com</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	@URLS;
	DB_PREFIX = '@DB_PREFIX';
	jQuery(document).ready(function($) {
		$('#gogogo').bind("click", function(){
			table = $('#tables option:selected').val();
			if(DB_PREFIX != ''){
				table = table.substr(DB_PREFIX.length);
			}
			gogogo(table);
		}); 
	});
	
	function gogogo(table){
		$.post(allPageUrl, {"table":table}, function(data){
		  $('#allPage').html(data);
		});
		$.post(allPageCodeUrl, {"table":table}, function(data){
		  $('#allPageCode').html(data);
		});
		$.post(allCodeUrl, {"table":table}, function(data){
		  $('#allCode').html(data);
		});

		$.post(addPageUrl, {"table":table}, function(data){
		  $('#addPage').html(data);
		  $('#addPageCode').html(data);
		});
		$.post(addCodeUrl, {"table":table}, function(data){
		  $('#addCode').html(data);
		});
		$.post(editPageUrl, {"table":table}, function(data){
		  $('#editPage').html(data);
		  $('#editPageCode').html(data);
		});
		$.post(editCodeUrl, {"table":table}, function(data){
		  $('#editCode').html(data);
		});
		$.post(deleteCodeUrl, {"table":table} , function(data){
		  $('#deleteCode').html(data);
		});
	}
	</script>
	<style>
html, div, map, dt, isindex, form, header, aside, section, section, article, footer {  
    display: block;  
} 
html, body {
height: 100%;
margin: 0;
padding: 0;
background: #F8F8F8;
}
.clear {
clear: both;
}
.spacer {
height: 20px;
}
a:link, a:visited {
color: #77BACE;
text-decoration: none;
}
a:hover {
text-decoration: underline;
}


/* Header */

header#header {
height: 55px;
width: 100%;
background: #222222;
}

header#header h1.site_title, header#header h2.section_title {
float: left;
margin: 0;
font-size: 22px;
display: block;
width: 23%;
height: 55px;
font-weight: normal;
text-align: left;
text-indent: 1.8%;
line-height: 55px;
color: #fff;
text-shadow: 0 -1px 0 #000;
}

header#header h1.site_title a {
color: #fff;
text-decoration: none;
}

header#header h2.section_title {
text-align: center;
text-indent: 4.5%;
width: 68%;
}

.right_title {
float: left;
width: 9%;
}

.right_title h2 {
display: block;
margin-top: 12px;
font-size:14px;
width: 120px;
height: 27px;
text-align: center;
line-height: 29px;
color: #fff;
text-decoration: none;
text-shadow: 0 -1px 0 #000;}


/* Secondary Header Bar */

section#secondary_bar {
height: 38px;
width: 100%;
background: #F1F1F4;
}

section#secondary_bar .user {
float: left;
width: 23%;
height: 38px;
}

.user p {
margin: 0;
padding: 0;
color: #666666;
font-weight: bold;
display: block;
float: left;
width: 85%;
height: 35px;
line-height: 35px;
text-indent: 25px;
text-shadow: 0 1px 0 #fff;
margin-left: 6%;
}

.user a {
text-decoration: none;
color: #666666}

.user a:hover {
color: #77BACE;
}

.user a.logout_user {
float: left;
display: block;
width: 16px;
height: 35px;
text-indent: -5000px;
}

/* Breadcrumbs */

section#secondary_bar .breadcrumbs_container {
float: left;
width: 77%;
height: 38px;
}

article.breadcrumbs {
float: left;
padding: 0 10px;
border: 1px solid #ccc;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: 0 1px 0 #fff;
-moz-box-shadow: 0 1px 0 #fff;
box-shadow: 0 1px 0 #fff;
height: 23px;
margin: 4px 3%;
}

.breadcrumbs a {
display: inline-block;
float: left;
height: 24px;
line-height: 23px;
}

.breadcrumbs a.current, .breadcrumbs a.current:hover {
color: #9E9E9E;
font-weight: bold;
text-shadow: 0 1px 0 #fff;
text-decoration: none;
}

.breadcrumbs a:link, .breadcrumbs a:visited {
color: #44474F;
text-decoration: none;
text-shadow: 0 1px 0 #fff;
font-weight: bold;}

.breadcrumbs a:hover {
color: #222222;
}

.breadcrumb_divider {
display: inline-block;
width: 12px;
height: 24px;
float: left;
margin: 0 5px;
}

/* Sidebar */

aside#sidebar {
width: 23%;
background: #E0E0E3;
float: left;
min-height: 500px;
}

#sidebar h3,h4{
	padding-left:6%;
}

#sidebar p {
color: #666666;
padding-left: 6%;
text-shadow: 0 1px 0 #fff;
margin: 10px 0 0 0;}

#sidebar a {
color: #666666;
text-decoration: none;
}

#sidebar a:hover {
text-decoration: underline;
}

#sidebar footer {
margin-top: 20%;
}


/* Main Content */


section#main {
width: 77%;
min-height: 500px;
background: repeat-y left top;
float: left;
margin-top: -2px;
}

#main h3 {
color: #1F1F20;
text-transform: uppercase;
text-shadow: 0 1px 0 #fff;
font-size: 13px;
margin: 8px 20px;
}

/* Modules */

.module {
border: 1px solid #9BA0AF;
width: 100%;
margin: 20px 3% 0 3%;
margin-top: 20px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: #ffffff;
}

#main .module header h3 {
display: block;
width: 90%;
float: left;
}

.module header {
height: 38px;
width: 100%;
background: #F1F1F4 repeat-x;
-webkit-border-top-left-radius: 5px; -webkit-border-top-right-radius: 5px;
-moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;
border-top-left-radius: 5px; border-top-right-radius: 5px;
}

.module footer {
height: 32px;
width: 100%;
border-top: 1px solid #9CA1B0;
background: #F1F1F4 repeat-x;
-webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px;
-moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px;
-webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px;
}

.module_content {
margin: 10px 20px;
color: #666;}


/* Module Widths */

.width_full {
width: 95%;
}

.width_half {
width: 46%;
margin-right: 0;
float: left;
}

.width_quarter {
width: 26%;
margin-right: 0;
float: left;
}

.width_3_quarter {
width: 66%;
margin-right: 0;
float: left;
}

/* Stats Module */

.stats_graph {
width: 64%;
float: left;
}

/* Content Manager */

#main .module header h3.tabs_involved {
display: block;
width: 60%;
float: left;
}

/* Messages */
.message_list {
height: 250px;
width:96%;
overflow-x:hidden;
overflow-y: scroll;
}

/* New/Edit Article Module */
fieldset {
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: #F6F6F6;
border: 1px solid #ccc;
padding: 1% 0%;
margin: 10px 0;
}

fieldset label {
display: block;
float: left;
height: 25px;
line-height: 25px;
text-shadow: 0 1px 0 #fff;
font-weight: bold;
padding-left: 10px;
margin: -5px 0 5px 0;

}

fieldset textarea {
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
border: 1px solid #BBBBBB;
color: #666666;
-webkit-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
-moz-box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
box-shadow: inset 0 2px 2px #ccc, 0 1px 0 #fff;
padding-left: 10px;
background-position: 10px 6px;
margin: 0 0.5%;
display: block;
float: left;
width: 96%;
margin: 0 10px;
}

fieldset textarea:focus {
outline: none;
border: 1px solid #77BACE;
-webkit-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
-moz-box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
box-shadow: inset 0 2px 2px #ccc, 0 0 10px #ADDCE6;
}

/* Alerts */

#main h4#alert_info {
display: block;
width: 95%;
margin: 20px 3% 0 3%;
margin-top: 20px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: #B5E5EF url(../images/icn_alert_info.png) no-repeat;
background-position: 10px 10px;
border: 1px solid #77BACE;
color: #082B33;
padding: 10px 0;
text-indent: 40px;
font-size: 14px;}

.tab_container{
padding:5px;
}
	</style>
	
	
</head>


<body>

	<header id="header">
		<hgroup>
			<!--<h1 class="site_title"><a href="#">weiyunstudio</a></h1>-->
			<h2 class="section_title">ThinkPHP 代码生成 V0.2</h2>
			<div class="right_title">
				<h2>for ThinkPHP3.2.2</h2>
			</div>
		</hgroup>
	</header> <!-- end of header bar -->

	
	<aside id="sidebar" class="column">
		<h4>选择表格</h4>
		<p>
			<select class="form-control tableSelect" id="tables">
				@tableNames
			</select>
		</p>
		
		<p><button class="btn btn-primary" id="gogogo"> 生 成 </button></p>
		

		<hr />
		<h4>说明</h4>
		<p>	
		 仅支持MySQL 和 sqlite数据库，<br>
		 使用前请检查config文件中的数据库配置<br>
		 </p>
		 <p>	
		 生成代码命名规则为：<br>
		 列出所有数据操作名：all<br>
		 新建页面名：add<br>
		 编辑页面名：edit<br>
		 删除操作名：delete<br>
		</p>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 weiyunstudio.com</strong></p>
			<p>Email:zhuanqianfish@gmail.com</p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 id="alert_info">欢迎使用</h4>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">预览：所有记录列表 (填充示例数据)</h3>
		</header>
		<div class="tab_container">
			<div id="allPage" class="tab_content">
			</div>
		</div>
		</article>
		
		<article class="module width_quarter">
			<header><h3>代码</h3></header>
			<textarea class="message_list" id="allPageCode" rows="12">
				
			</textarea>
			<footer></footer>
		</article>
		<div class="clear"></div>
		<div class="module_content">
						<fieldset>
							<label>列出所有记录代码</label>
							<textarea rows="12" id="allCode"></textarea>
						</fieldset>
		</div>
		<div class="clear"></div>
		<footer></footer>
		</article><!-- end of  新建 -->
		<!-- end of 列出所有记录 -->
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">预览：新建</h3></header>
		<div class="tab_container">
			<fieldset id="addPage"></fieldset>
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		
		<article class="module width_quarter">
			<header><h3>代码</h3></header>
			<textarea class="message_list" id="addPageCode">
					
				
			</textarea>
			<footer>
					
			</footer>
		</article><!-- end of messages article -->
		<div class="clear"></div>
		<div class="module_content">
						<fieldset>
							<label>新建操作处理代码</label>
							<textarea rows="12" id="addCode"></textarea>
						</fieldset>
		</div>
		<div class="clear"></div>
		<footer></footer>
		</article><!-- end of  新建 -->
		
		<article class="module width_3_quarter">
			<header><h3 class="tabs_involved">预览：编辑</h3></header>
				<div class="tab_container">
					<fieldset id="editPage"></fieldset>
				</div>
		</article>
		
		<article class="module width_quarter">
			<header><h3>代码</h3></header>

				<textarea class="message_list" id="editPageCode">
					
				</textarea>

			<footer>
					
			</footer>
		</article><!-- end of messages article -->
		<div class="clear"></div>
		<div class="module_content">
						<fieldset>
							<label>编辑操作处理代码</label>
							<textarea rows="12" id="editCode"></textarea>
						</fieldset>
		</div>
		<div class="clear"></div>
		<footer></footer>
		</article><!-- end of 编辑 -->
		
		<div class="module_content">
						<fieldset>
							<label>删除操作处理代码</label>
							<textarea rows="12" id="deleteCode"></textarea>
						</fieldset>
		</div>
		<div class="clear"></div>
		<footer></footer>
		</article><!-- end of 删除-->
		<div class="spacer"></div>
	</section>


</body>

</html>
tpl;
	return $templateStr;
	}

	//处理模板,主要js的参数
	public function showTemplate(){
		$templateStr = $this->getTemplateStr();
		$optionStr = '';
		$tables = $this->getTableNamesArray();
		foreach($tables as $table){
			$optionStr .='<option value="'. $table .'">'. $table .'</option>';
		}
		
		$templateStr = str_replace('@tableNames', $optionStr, $templateStr);
		
		$urlStr  = 'allPageUrl = \''		.__CONTROLLER__."/previewAllPage/';\r\n";
		$urlStr .= 'allPageCodeUrl = \''	.__CONTROLLER__."/allPageCode/';\r\n";
		$urlStr .= 'allCodeUrl = \''		.__CONTROLLER__."/allCode/';\r\n";
		$urlStr .= 'addPageUrl = \''		.__CONTROLLER__."/addPage/';\r\n";
		$urlStr .= 'addCodeUrl = \''		.__CONTROLLER__."/addCode/';\r\n";
		$urlStr .= 'editPageUrl = \''	.__CONTROLLER__."/editPage/';\r\n";
		$urlStr .= 'editCodeUrl = \''	.__CONTROLLER__."/editCode/';\r\n";
		$urlStr .= 'deleteCodeUrl = \''	.__CONTROLLER__."/deleteCode/';\r\n";

		$templateStr = str_replace('@URLS', $urlStr, $templateStr);
		$templateStr = str_replace('@DB_PREFIX', C('DB_PREFIX'), $templateStr);
		$this->show($templateStr);
	}
	
}