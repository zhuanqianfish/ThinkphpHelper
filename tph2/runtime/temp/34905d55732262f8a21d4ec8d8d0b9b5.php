<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>

//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo C('targetConfig.app_namespace'); ?>\<?php echo $moduleName; ?>\controller;

use think\Controller;

class <?php echo tableNameToModelName($tableName); ?> extends Controller{
	protected $model = new <?php echo tableNameToModelName($tableName); ?>;
	
	{include file=C('codeLib')."add" /}
	{include file=C('codeLib')."edit" /}
	{include file=C('codeLib')."delete" /}
	{include file=C('codeLib')."delList" /}
	{include file=C('codeLib')."info" /}
	{include file=C('codeLib')."list" /}
}
