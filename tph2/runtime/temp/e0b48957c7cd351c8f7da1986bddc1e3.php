<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:43:"codeRepository\default/Controller/test.html";i:1524037803;s:42:"codeRepository\default/Controller/add.html";i:1524043764;s:43:"codeRepository\default/Controller/edit.html";i:1524043743;s:45:"codeRepository\default/Controller/delete.html";i:1524044686;s:46:"codeRepository\default/Controller/delList.html";i:1524044849;s:43:"codeRepository\default/Controller/info.html";i:1524037794;s:46:"codeRepository\default/Controller/getList.html";i:1524043327;}*/ ?>

//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\controller;

use think\Controller;

class <?php echo tableNameToModelName($tableName); ?> extends Controller{
	protected $model = null;

	public function _initialize(){	//初始化
		$this->model = new \<?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\model\<?php echo tableNameToModelName($tableName); ?>;
	}
		//测试
	public function test(){
		return 'test 111';
	}
	
		//新增
	public function add(){
		if($this->request->isPost()){
			$flag = $this->model->add($this->request);
			if($flag){
				$this->success('添加成功', url('getList'));
			}else{
				$this->error('添加失败');
			}
		}else{
			return $this->fetch();
		}
	}
		//修改
	public function edit(){
		if($this->request->isPost()){
			$flag = $this->model->edit($this->request);
			if($flag){
				$this->success('编辑成功', url('getList'));
			}else{
				$this->error('编辑失败');
			}
		}else{
			$<?php echo $tableName; ?> = $this->model->info($this->request);
			$this->assign('<?php echo $tableName; ?>', $<?php echo $tableName; ?>);
			return $this->fetch();
		}
	}
		//删除
	public function delete(){
		$flag = $this->model->del($this->request);
		if($flag){
			$this->success('删除成功', url('getList'));
		}else{
			$this->error('删除失败');
		}
	}
	    //批量删除
    public function delList(){
        $flag = $this->model->delList($this->request);
        if($flag){
			$this->success('删除成功', url('getList'));
		}else{
			$this->error('删除失败');
		}
    }
	    //id单个查询
    public function info(){
        $<?php echo $tableName; ?> = $this->model->info($this->request);
        $this->assign('<?php echo $tableName; ?>', $<?php echo $tableName; ?>);
        return $this->fetch();
    }
		//列表
	public function getList(){
		$<?php echo $tableName; ?>List = $this->model->getList($this->request, 12);	
		$this->assign('<?php echo $tableName; ?>List', $<?php echo $tableName; ?>List);
		return $this->fetch();
	}
}
