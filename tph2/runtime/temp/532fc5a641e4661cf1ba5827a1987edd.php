<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
	//列表
	public function getList(){
		$<?php echo $tableName; ?>List = $this->model->getList($this->request, 12);	
		$this->assign('<?php echo $tableName; ?>List', $<?php echo $tableName; ?>List);
		return $this->fetch();
	}