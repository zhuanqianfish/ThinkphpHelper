<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:42:"codeRepository\default/Controller/add.html";i:1515486209;s:43:"codeRepository\default/Controller/edit.html";i:1515486675;s:45:"codeRepository\default/Controller/delete.html";i:1515486661;s:46:"codeRepository\default/Controller/delList.html";i:1515486641;s:43:"codeRepository\default/Controller/info.html";i:1515486680;s:43:"codeRepository\default/Controller/list.html";i:1515486737;}*/ ?>

//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\controller;

use think\Controller;

class <?php echo tableNameToModelName($tableName); ?> extends Controller{
	protected $model = new <?php echo tableNameToModelName($tableName); ?>;
	
	//新增
public function add(){
	if($this->$request->type() == 'POST'){
		$flag = $this->$model->add($this->$request);
		if($flag){
			$this->success('添加成功', U('list'));
		}
	}else{
		return $this->fetch();
	}
}
	//修改
public function edit(){
	return $this->model->edit($this->request);
}
	//删除
public function del(){
	return $this->model->del($this->$request);
}
	//批量删除
public function delList(){
    return $this->model->delList($this->$request);
}
	//id单个查询
public function info(){
    return $this->model->info($this->$request);
}
	//列表
public function list(){
	return $this->model->list($this->request, 12);
}
}
