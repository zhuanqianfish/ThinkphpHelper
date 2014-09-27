<?php
//	ThinkphpHelper v0.3
//	
//	weiyunstudio.com
//	sjj zhuanqianfish@gmail.com
//	2014年9月18日
namespace TPH\Controller;
use Think\Controller;
use Think\Model;


class CRUDController extends Controller {
	const SQLITE_COLUMN_NAME_KEY = 'name';	//sqlite列名键
	const MYSQL_COLUMN_NAME_KEY = 'COLUMN_NAME';	//mysql列名键

	public function crud(){	//生成CRUD代码
		$this->assign('tableNameArray',$this->getTableNamesArray());
		$this->assign('moduleNameList', $this->getModuleNameList());
		$this->assign('db_prefix',C('DB_PREFIX'));
		$this->display();
    }
	
	
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
	
	//根据数据库类型获取列名键
	private function getColumnNameKey(){
		$dbType = C('DB_TYPE');
		if($dbType == 'mysql'){
			return self::MYSQL_COLUMN_NAME_KEY;
		}else{
			return self::SQLITE_COLUMN_NAME_KEY;
		}
	}
	
	public function test(){
		$str = "aaaaaaaaa";
		echo ($str);
	}
	
	public function getPageCode($tableName){	//	分页代码
		$Model = M($tableName); // 实例化对象
		$count = $Model->where('status=1')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list =	$Model->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);
	}
	
	//列出所有记录页面代码
	public function generateAllPageCode(){
		$tableName = I('table');
		$isPage = I('isPage');
		$Model = M($tableName);
		$resultCode = "<table class=\"table table-striped table-bordered table-hover\">\r\n<thead>\r\n<tr>\r\n";	
		$tableInfoArray = $this->getTableInfoArray($tableName);
		foreach($tableInfoArray as $tableInfo){ //拼接表头
			$columnName = $tableInfo[$this->getColumnNameKey()];
			$resultCode .= "<th><center>".$columnName."</center></th>\r\n";
		}
		
		$resultCode .= "<td>操作</td>\r\n</tr>\r\n</thead>\r\n". '<volist name="' .$tableName. 'List" id="vo">'."\r\n<tr>\r\n";
		foreach($tableInfoArray as $tableInfo){ //拼接循环部分
			$resultCode .= '<td>{$vo.' .$tableInfo[$this->getColumnNameKey()]. "}</td>\r\n";
		}
		$resultCode .= '<td><a href="{:U(\'' .ucfirst($tableName). '/edit\')}?id={$vo.id}">编辑</a> | '	//假定所有表均以id为主键
					.'<a href="{:U(\'' .ucfirst($tableName).'/delete\')}?id={$vo.id}" onclick=\'return confirm("确定删除吗？")\'>删除</a></td>'
					."\r\n<tr>\r\n</volist>\r\n</table>\r\n";
		if($isPage == 'checked'){
			$resultCode .=	'{$page}';// 赋值分页输出
		}
		return $resultCode;
	}
	
	public function allPageCode(){
		echo $this->generateAllPageCode();
	}
	
	
	//列出所有记录页面，读取并填充数据
	public function previewAllPage(){ 

		$tableName = I('table'); 
		$Model = M($tableName);
		$resultCode = "<table class=\"table table-striped table-bordered table-hover\">\r\n<thead>\r\n<tr>\r\n";
		$tableInfoArray = $this->getTableInfoArray($tableName);
		foreach($tableInfoArray as $tableInfo){ //拼接表头
			$name = $tableInfo[$this->getColumnNameKey()];
			$resultCode .= "<th><center>".$name."</center></th>\r\n";
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
		echo $resultCode;
	}
	
	//生成所有记录代码
	public function generateAllCode(){
		$tableName = I('table');
		$isPage = I('isPage');
		$resultCode = "public function all(){\r\n";
		$resultCode .="	\$@tableNameModel = M('@TableName');\r\n";
		if($isPage == 'checked'){
			$resultCode .= "	\$count = \$@tableNameModel->where()->count();\r\n";
			$resultCode .= "	\$Page       = new \Think\Page(\$count,15);//实例化分页类 传入总记录数和每页显示的记录数(25)\r\n";	
			$resultCode .= "	\$show       = \$Page->show();// 分页显示输出\r\n";	
			$resultCode .= "	\$@tableNameList = \$@tableNameModel->where()->limit(\$Page->firstRow.','.\$Page->listRows)->select();//分页查询\r\n";
			$resultCode .= "	\$this->assign('page',$show);// 赋值分页输出\r\n";
		}else{
			$resultCode .= "	\$@tableNameList = \$@tableNameModel->select();\r\n";
		}				
					
		$resultCode	.= "	\$this->assign('@tableNameList', \$@tableNameList);\r\n";
		$resultCode	.= "	\$this->display();\r\n";
		$resultCode	.= "}\r\n";
		$resultCode = str_replace('@tableName', $tableName, $resultCode);
		$resultCode = str_replace('@TableName', ucfirst($tableName), $resultCode);//修正为驼峰命名，首字母大写
		return $resultCode;
	}
	
	public function allCode(){
		echo $this->generateAllCode();
	}
	
	//生成新建页面代码
	public function generateAddPage(){ 
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
				$resultCode .=  '<label  class="col-sm-2 control-label" for="'.$name.'">' .$name;
				$resultCode .= '</label>';
				//这里按说应该区别对待，为了简单就写了个一样的
				$resultCode .=  '<input type="text" class="form-control" placeholder="' 
									.$name. '" name="'.$name.'" id="'.$name.'" />';
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
		return $resultCode;
	}
	
	public function addPage(){
		echo $this->generateAddPage();
	}
	
	//新建操作代码
	public function generateAddCode(){	
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
		return $resultCode;
	}
	
	public function addCode(){
		echo $this->generateAddCode();
	}
	
	//编辑页面
	public function generateEditPage(){	
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
					$resultCode .=  '<input type="text" class="form-control" placeholder="' 
										.$name. '" name="'.$name.'" value="{$'.$tableName.'.'.$name.'}" />';
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
			return $resultCode;
	}

	public function editPage(){	
		echo $this->generateEditPage();
	}
	
	//生成编辑代码
	public function generateEditCode(){ 
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
		return $resultCode;
	}
	
	public function editCode(){
		echo $this-> generateEditCode();
	}
	
	//删除代码
	public function generateDeleteCode(){
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
		return $resultCode;
	}
	
	public function deleteCode(){
		echo $this->generateDeleteCode();
	}
	
	
	//生成所有代码对应的文件，
	public function creatAllFiles(){
		$tableName = I('tableName');
		$moduleName = I('moduleName');
		$controllerPath = APP_PATH. ucfirst($moduleName). "/Controller/";
		$viewPath = APP_PATH. ucfirst($moduleName). "/View/".ucfirst($tableName)."/";
		$_POST['table'] = $tableName;
		
		$controllerStr = "<?php\r\n";
		$controllerStr .= "//由ThinkphpHelper自动生成,请根据需要修改\r\n";
		$controllerStr .= "namespace ".ucfirst($moduleName)."\Controller;\r\n";
		$controllerStr .= "use Think\Controller;\r\n\r\n";
		$controllerStr .= "class ". ucfirst($tableName) ."Controller extends Controller {\r\n";
		$controllerStr .= $this->generateAllCode()."\r\n\r\n";
		$controllerStr .= $this->generateAddCode()."\r\n\r\n";
		$controllerStr .= $this->generateEditCode()."\r\n\r\n";
		$controllerStr .= $this->generateDeleteCode()."\r\n\r\n}";
		
		$originalAllViewStr = $this->generateAllPageCode();
		$allViewStr = $this->makeTemplate("all.html", "管理".$tableName, $originalAllViewStr);
		$originalAddViewStr = $this->generateAddPage();
		$addViewStr = $this->makeTemplate("add.html", "新建".$tableName, $originalAddViewStr);
		$originalEditViewStr = $this->generateEditPage();
		$editViewStr = $this->makeTemplate("edit.html", "编辑".$tableName, $originalEditViewStr);
		
		file_put_contents($controllerPath.ucfirst($tableName)."Controller.class.php", $controllerStr);//生成Controller文件
		FileUtil::createDir($viewPath);
		file_put_contents($viewPath."all.html", $allViewStr);
		file_put_contents($viewPath."add.html", $addViewStr);
		file_put_contents($viewPath."edit.html", $editViewStr);
		echo "生成完成。";
	}
	
	
	//读取项目目录下的文件夹，供用户选择哪个才是模块目录
	public function getModuleNameList(){
		$ignoreList = Array("Common","Home","Runtime","TPH");
		$allFileList = FileUtil::getDirList(APP_PATH);
		return array_diff($allFileList, $ignoreList);
	}
	
	//解析add,edit,all模板
	public function makeTemplate($templateFileName, $operateTitle, $content){
		$templateFilePath = MODULE_PATH. "/Template/" .$templateFileName;
		$fileContent = file_get_contents($templateFilePath);
		$fileContent = str_replace('@operateTitle', $operateTitle, $fileContent);
		$fileContent = str_replace('@content', $content, $fileContent);
		return $fileContent;
	}
}