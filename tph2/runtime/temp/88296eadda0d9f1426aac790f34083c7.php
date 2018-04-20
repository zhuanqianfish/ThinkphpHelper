<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('app_namespace'); ?>\<?php echo $moduleName; ?>\model;

use think\Model;

class <?php echo tableNameToModelName($tableName); ?> extends Model {
	<?php if($pk): ?>
	// 设置数据库主键字段
	protected $pk = '<?php echo $pk; ?>';
	<?php endif; if($trueTable): ?>
	// 设置当前模型对应的完整数据表名称
	protected $table = '<?php echo $trueTable; ?>';
	<?php endif; ?>
	
	//新增
	public function add(){
		return $this->data($_POST)->allowField(true)->save();
	}

	//修改
	public function edit(){
		return $this->allowField(true)->save($_POST,['<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>' => $_POST['<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>']]);
	}

	//删除
	public function del(){
		return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>',  input('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>')])->delete();
	}

	//批量删除
	public function delList(){
		$condition = input('condition');
		return $this->destroy(json_decode($condition));
	}

	//id单个查询
	public function getOneById(){
		return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>', input('id'))->find();
	}

	//列表
	public function list($itemNum = 12){	//每页显示12条数据
		$condition = input('condition');
		return $this->where(json_decode($condition))->paginate($itemNum);
	}
}	