<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
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