<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"codeRepository\default/View/list.html";i:1515635090;}*/ ?>
{extend name="layout" /}

<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-head">
			  <div class="pull-left" height="80">
			  管理<?php echo $tableName; ?>
			  </div>
			  <div class="widget-icons pull-right">
				<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
				<a href="#" class="wclose"><i class="icon-remove"></i></a>
			  </div>  
			  <div class="clearfix"></div>
			</div>  
			<div class="widget-content" >
			<div class="padd">
				<div class="form quick-post">
				  <div class="form-horizontal">                        
					  <div class="form-group">
						<table class="table table-striped table-bordered table-hover">
<thead>
<tr>	
<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;?>
	<th><center><?php echo $tableInfo[$columnNameKey]; ?></center></th>
	
<?php endforeach; endif; else: echo "" ;endif; ?>
<td>操作</td>
</tr>
</thead>
{volist name="<?php echo $tableName; ?>List" id="vo">
<tr>
<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;?>
<td>{$vo.<?php echo $tableInfo[$columnNameKey]; ?>}</td>

<?php endforeach; endif; else: echo "" ;endif; ?>
<td><a href="{:U(MODULE_NAME.'/<?php echo $tableName; ?>/edit/id/'.$vo[id])}">编辑</a> |
<a href="{:U(MODULE_NAME.'/<?php echo $tableName; ?>/delete/id/'.$vo[id])}" onclick='return confirm("确定删除吗？")'>删除</a>
</td>
<tr>
{/volist}
</table>
{$page}
					  </div>       
				  </div>
				</div><!--end  paddad-->
			</div>
		</div>	
		</div>	
	</div>
</div>
</div>
