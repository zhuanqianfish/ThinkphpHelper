<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:37:"codeRepository\default/Model/add.html";i:1515648841;s:38:"codeRepository\default/Model/edit.html";i:1515650500;s:37:"codeRepository\default/Model/del.html";i:1515648836;s:41:"codeRepository\default/Model/delList.html";i:1515486518;s:38:"codeRepository\default/Model/info.html";i:1515648856;s:38:"codeRepository\default/Model/list.html";i:1515648849;}*/ ?>
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
    return $this->data($request->param())->allowField(true)->save();
}
	//修改
public function edit($request){
    return $this->allowField(true)->save($request->param(),['id' => $request->param('id')]);
}
	//删除
public function del($request){
    $id = $request->param('id');
    return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>',  $id)->delete();
}
	//批量删除
public function delList($request){
    $condition = $request->request('condition');
    return $this->destroy(json_decode($condition));
}
	//id单个查询
public function info($request){
    $id = $request->param('id');		
    return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>', $id)->find();
}
	//列表
public function list($request, $itemNum = 12){	//每页显示12条数据
    $condition = $request->param('condition');
    return $this->where(json_decode($condition))->paginate($itemNum);
}

}	