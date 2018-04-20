<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\model;

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
	public function add($request){
		return $this->data($request->request())->allowField(true)->save();
	}

	//修改
	public function edit($request){
		return $this->allowField(true)->save($request->request());
	}

	//删除
	public function del($request){
		$id = $request->request('id');
		return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>',  $id)->delete();
	}

	//批量删除
	public function delList($request){
		$condition = $request->request('condition');
		return $this->destroy(json_decode($condition));
	}

	//id单个查询
	public function getOneById($request){
		$id = $request->request('id');		
		return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>', $id)->find();
	}

	//列表
	public function list($request, $itemNum = 12){	//每页显示12条数据
		$condition = $request->request('condition');
		return $this->where(json_decode($condition))->paginate($itemNum);
	}
}	