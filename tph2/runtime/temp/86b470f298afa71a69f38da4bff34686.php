<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
	//删除
	public function delete(){
		$flag = $this->model->del($this->request);
		if($flag){
			$this->success('删除成功', url('getList'));
		}else{
			$this->error('删除失败');
		}
	}