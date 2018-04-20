<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;?>
	<th><center><?php echo $tableInfo[$columnNameKey]; ?></center></th>
<?php endforeach; endif; else: echo "" ;endif; ?>
<td>操作</td>
</tr>
</thead>
{volist name="<?php echo $tableName; ?>List" id="vo"}
<tr>
<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;?>
<td>{$vo.<?php echo $tableInfo[$columnNameKey]; ?>}</td>

<?php endforeach; endif; else: echo "" ;endif; ?>
<td><a href="{:url('<?php echo $tableName; ?>/edit', ['id'=>$vo['id']])}">编辑</a> |
<a href="{:url('<?php echo $tableName; ?>/delete', ['id'=>$vo['id']])}" onclick='return confirm("确定删除吗？")'>删除</a>
</td>
<tr>
{/volist}
</table>
{$<?php echo $tableName; ?>List->render()}