<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"codeRepository\default/View/add.html";i:1515571632;}*/ ?>
<div class="container ">
<div class="row">
	<div class="col-md-6">
		<div class="widget">
			<div class="widget-head">
			  <div class="pull-left" height="80">
			 	新建<?php echo pressTableDict($tableName); ?>
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
	<?php if(is_array($tableInfoArray) || $tableInfoArray instanceof \think\Collection || $tableInfoArray instanceof \think\Paginator): $i = 0; $__LIST__ = $tableInfoArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableInfo): $mod = ($i % 2 );++$i;?>
	<if condition="$tableInfo[$columnNameKey] neq 'id'">
	<div class="form-group">
		<label class="col-md-2 control-label" for="<?php echo $tableInfo[$columnNameKey]; ?>"><?php echo pressFieldDict($tableName, $tableInfo[$columnNameKey]); ?></label>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="<?php echo pressFieldDict($tableName, $tableInfo[$columnNameKey]); ?>"
				 name="<?php echo $tableInfo[$columnNameKey]; ?>" id="<?php echo $tableInfo[$columnNameKey]; ?>" />
		</div>
	</div>
	
	</if>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	
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
