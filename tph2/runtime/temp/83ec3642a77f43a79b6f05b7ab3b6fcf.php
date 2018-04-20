<?php if (!defined('THINK_PATH')) exit(); /*a:0:{}*/ ?>
<?php if(is_array($menuList) || $menuList instanceof \think\Collection || $menuList instanceof \think\Paginator): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuItem): $mod = ($i % 2 );++$i;?>
	<li class="has_sub"><a href="#"><i class="icon-list-alt"></i>
		<?php echo tableNameToModelName($menuItem); ?>
	<span class="pull-right"><i class="icon-chevron-right"></i></span></a>	
	<ul>
		<li><a href="{:Request::instance()->module()}/<?php echo tableNameToModelName($menuItem); ?>/all">管理</a></li>
		<li><a href="{:Request::instance()->module()}/<?php echo tableNameToModelName($menuItem); ?>/add">新建</a></li>
	</ul>	
<?php endforeach; endif; else: echo "" ;endif; ?>
