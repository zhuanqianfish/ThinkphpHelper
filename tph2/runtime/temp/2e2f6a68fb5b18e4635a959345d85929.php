<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"codeRepository\default/View/edit.html";i:1515635052;}*/ ?>
{extend name="layout" /}

<div class="container">
<div class="row">
	<div class="col-md-6">
		<div class="widget">
			<div class="widget-head">
			  <div class="pull-left" height="80">
			  编辑<?php echo $tableName; ?>
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
									<form class="form-horizontal" method="post">
	<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;if($tableInfo[$columnNameKey] != 'id'): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="<?php echo $tableInfo[$columnNameKey]; ?>"><?php echo $tableInfo[$columnNameKey]; ?></label>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="<?php echo $tableInfo[$columnNameKey]; ?>" name="<?php echo $tableInfo[$columnNameKey]; ?>" id="<?php echo $tableInfo[$columnNameKey]; ?>"  value="<literal>{$</literal><?php echo $tableName; ?>.<?php echo $tableInfo[$columnNameKey]; ?>}" />
		</div>
	</div>
	<else /> <input type="hidden" name="id" value="<literal>{$</literal><?php echo $tableName; ?>.<?php echo $tableInfo[$columnNameKey]; ?>}" />
	
	<?php endif; endforeach; endif; else: echo "" ;endif; ?>
	<div class="form-group">
		<div class="col-md-2 col-md-offset-2">
			<input type="submit" value="提交" class="btn btn-default" />
		</div>
	</div>
</form>
						  </div>              
					  </div>
				</div><!--end  paddad-->
			</div>
		</div>	
		</div>	
	</div>
</div>
</div>
