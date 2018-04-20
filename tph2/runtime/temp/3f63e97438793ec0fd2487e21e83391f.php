<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"template/codeRepository\default\Controller\controller.html";i:1515490887;}*/ ?>

//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\controller;

use think\Controller;

class <?php echo tableNameToModelName($tableName); ?> extends Controller{
	protected $model = new <?php echo tableNameToModelName($tableName); ?>;
	
	{include file=C('codeLib')."\Controller\add" /}

}
