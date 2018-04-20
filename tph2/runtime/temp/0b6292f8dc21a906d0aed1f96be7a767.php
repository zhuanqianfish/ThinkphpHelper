<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:31:"template/\ModelCode\index2.html";i:1524210189;s:28:"template/default_layout.html";i:1524102749;s:22:"template/leftmenu.html";i:1524102846;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>ThinkphpHelper V2.01 for Thinkphp5</title>
  <meta name="keywords" content="ThinkphpHelper,Thinkphp代码自动生成,Thinkphp脚手架,快速原型工具" />
  <meta name="description" content="ThinkphpHelper,Thinkphp代码自动生成工具,Thinkphp脚手架,快速原型工具" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="sjj">
  <script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.js"></script> <!-- jQuery -->
  <!-- Stylesheets -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/font-awesome.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/jquery-ui.css">
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/prettyPhoto.css">
  <!-- Star rating -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/jquery.cleditor.css">
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/widgets.css" rel="stylesheet">

  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="<?php echo TEMPLATE_PATH; ?>asset/js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo MODULE_PATH; ?>/img/favicon/favicon.png">
  <script>
	$(document).ready(function(){
		$.post('<?php echo U(MODULE_NAME."/Index/checkVersion"); ?>',
			function(data){
				$('#version').html(data);
			}
		);
	});
  </script>
</head>

<body>
<!-- Header starts -->
  <header>
    <div class="container">
      <div class="row">

        <!-- Logo section -->
        <div class="col-md-4">
          <!-- Logo. <!-- Logo ends -->
          <div class="logo">
            <h1><a href="#">ThinkphpHelper V2.01<span class="bold"></span></a></h1>
            <p class="meta">代码生成工具　　　　<a href="https://github.com/zhuanqianfish/ThinkphpHelper" id="version"></a>
			如果觉得好用，请记得分享给你的好基友们！</p>
          </div>
          
        </div>

        <!-- Button section -->
        <div class="col-md-4">

        </div>

        <!-- Data section -->

        <div class="col-md-4">
          <div class="header-data">

            <!-- Traffic data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with red background -->
                <i class="icon-signal bred"></i>
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="https://github.com/zhuanqianfish/ThinkphpHelper">项目</a> <em>GitHub</em></p>
              </div>
              <div class="clearfix"></div>
            </div>

            <!-- Members data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with blue background -->
                <i class="icon-user bblue"></i>
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="http://weibo.com/0371fish">微博</a> <em>WeiBo</em></p>
              </div>
              <div class="clearfix"></div>
            </div>
      <!-- revenue data
        <div class="hdata">
          <div class="mcol-left">
            <i class="icon-money bgreen"></i>
          </div>
          <div class="mcol-right">
            <p><a href="#">赞助</a><em>support</em></p>
          </div>
          <div class="clearfix"></div>
        </div>
			-->
          </div>
        </div>

      </div>
    </div>
  </header>

<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">导航</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
      <!-- Main menu with font awesome icon -->
      <!-- 暂不使用项目配置
      <li class="has_sub "><a href="#" class="subdrop"><i class="icon-bar-chart"></i>项目配置</a>
        <ul style="display: block;">
          <li><a href="<?php echo APP_NAME; ?>/ProjectConfig/index">项目配置</a></li>
          <li><a href="<?php echo APP_NAME; ?>/ProjectConfig/formConfig">表单配置</a></li>
        </ul>
      </li>
-->
      <li><a href="<?php echo APP_NAME; ?>/CreateLayout"><i class="icon-bar-chart"></i>公共文件生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/WedgitCode/menu"><i class="icon-bar-chart"></i>菜单生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/ViewCode"><i class="icon-tasks"></i>前台界面生成</a></li>      
      <li><a href="<?php echo APP_NAME; ?>/ControllerCode"><i class="icon-bar-chart"></i>控制器代码生成</a></li>
      <li class="has_sub "><a href="#"><i class="icon-table"></i>模型代码生成</a>
        <ul>
          <li><a href="<?php echo APP_NAME; ?>/ModelCode/index">简易模型代码生成</a></li>
          <li><a href="<?php echo APP_NAME; ?>/ModelCode/index2">手动模型代码生成</a></li>
        </ul>
      </li>
      <li><a href="<?php echo APP_NAME; ?>/Index/ui"><i class="icon-magic"></i>UI控件</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Index/help"><i class="icon-calendar"></i>帮助</a></li>
    </ul>
</div>
    <!-- Sidebar ends -->
  	<!-- Main bar -->
		
<script type="text/javascript">
db_prefix = '<?php echo $db_prefix; ?>';

//读取数据表对应列
function readTableColume(){
	var tableName = $('#tableNameList').val();
}

//生成模型代码
function generateModelCode(){
	var url = "<?php echo APP_NAME; ?>/ModelCode/generateModelCode";
	//var url = "<?php echo url("","",true,false);?>"
	var moduleName = $('#moduleName2').val();
	var tableName = $('#tableNameList2').val();
	var code = $.post(url, {'moduleName':moduleName, 'tableName':tableName}, function(resCode){
		$('#resultCode').html(resCode);
	})
}

//一键生成模型代码文件
function createModelFile(){
	var url = "<?php echo APP_NAME; ?>/ModelCode/createModelFile";
	var moduleName = $('#moduleName2').val();
	var tableName = $('#tableNameList2').val();
	var code = $.post(url, {'moduleName':moduleName, 'tableName':tableName}, function(resCode){
		$('#resultCode').html(resCode);
	})
}

//一键生成Controller代码文件
function createControllerFile(){
	var url = "<?php echo APP_NAME; ?>/ModelCode/createModelFile";
	var moduleName = $('#moduleName2').val();
	var tableName = $('#tableNameList2').val();
	var code = $.post(url, {'moduleName':moduleName, 'tableName':tableName}, function(resCode){
		$('#resultCode').html(resCode);
	})
}


</script>
<div class="mainbar">
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i>手动生成自定义模型代码(尚未完善，不要使用)</h2>
		<div class="clearfix"></div>
	</div>
	<!-- Page heading ends -->


	<!-- Matter -->
	<div class="matter">
		<div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						选择目标模块
					  </div>
					  <div class="widget-icons pull-right">
						<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
						<a href="#" class="wclose"><i class="icon-remove"></i></a>
					  </div>  
					  <div class="clearfix"></div>
					</div>  
					<div class="widget-content" >
					<div class="padd">
					<!--<p>一些注释</p>-->
                      <div class="form quick-post">
						  <!-- Edit profile form (not working)-->
						  <div class="form-horizontal">  
								<div class="form-group">
									<label class="control-label col-lg-3"  style="width:120px">目标模块:</label>
									<div class="col-lg-9">                               
										<select class="form-control" id="moduleName">
										  <?php if(is_array($moduleNameList) || $moduleNameList instanceof \think\Collection || $moduleNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $moduleNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moduleName): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $moduleName; ?>"><?php echo $moduleName; ?></option>
										  <?php endforeach; endif; else: echo "" ;endif; ?>
										</select> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-3"  style="width:120px">选择表:</label>
									<div class="col-lg-9">                               
										<select class="form-control" id="tableNameList">
										  <?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableName): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $tableName; ?>"><?php echo $tableName; ?></option>
										  <?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<p>
											<button onclick="readTableColume()" type="button" class="btn btn-success">确定</button>
										</p> 
									</div>
								</div>
							</div>	
						</div>
					</div>
					</div>
				</div>
			</div>
			<!--end col6-->

			<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						一键生成
					  </div>
					  <div class="widget-icons pull-right">
						<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
						<a href="#" class="wclose"><i class="icon-remove"></i></a>
					  </div>  
					  <div class="clearfix"></div>
					</div>  
					<div class="widget-content" >
					<div class="padd">
					<!--<p>生成</p>-->
             <div class="form quick-post">
						  <!-- Edit profile form (not working)-->
						  <div class="form-horizontal">  
								<div class="form-group">
									<label class="control-label col-lg-3"  style="width:120px">目标模块:</label>
									<div class="col-lg-9">                               
										<select class="form-control" id="moduleName2">
										  <?php if(is_array($moduleNameList) || $moduleNameList instanceof \think\Collection || $moduleNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $moduleNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moduleName): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $moduleName; ?>"><?php echo $moduleName; ?></option>
										  <?php endforeach; endif; else: echo "" ;endif; ?>
										</select> 
									</div>
								</div>
							
							<div class="form-group">
								<label class="control-label col-lg-3"  style="width:120px">选择表:</label>
								<div class="col-lg-9">                               
									<select class="form-control" id="tableNameList2">
										<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tableName): $mod = ($i % 2 );++$i;?>
										<option value="<?php echo $tableName; ?>"><?php echo $tableName; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<p>
											<button onclick="generateModelCode()" type="button" class="btn btn-success">生成代码</button>
											<button onclick="createModelFile()" type="button" class="btn btn-primary">生成文件</button>
									</p> 
								</div>
							</div>
						</div>

						</div>
					</div>
					</div>
				</div>
			</div>	<!--end col6-->
		</div>
			<div class="row">
			
			<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						配置模型信息
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
							<b>关联模型</b>	 
								<div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">模型数据表:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="tableName1">
											<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
												<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select> 
									</div>	
								</div> 
							 
								<div class="form-group">
									<label class="control-label col-lg-3"  style="width:120px">关联种类:</label>
									<div class="col-lg-9">                               
										<select class="form-control" id="mapping_type">
											<option value="HAS_ONE">一对一(HAS_ONE)</option>
											<option value="HAS_MANY">一对多(HAS_MANY)</option>
											<option value="BELONGS_TO">从属于(BELONGS_TO)</option>
											<option value="MANY_TO_MANY">多对多(MANY_TO_MANY)</option>
										</select> 
									</div>
								</div>							
								<hr>
								<div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">对应数据表:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="tableName2">
											<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
												<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select> 
									</div>
								</div> 
								<div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">关系数据表:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="tableName3" disabled='disabled'>
											{volist name="tableNameList" id="table" }
												<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
											{volist} 
										</select> 
									</div>
								</div>

							  <hr>
							  <div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">关联名称：</label>
									<div class="col-lg-9"> 
										<input type="text" id="mapping_name"  /> (mapping_name,注意不要和当前模型的字段有重复)
									</div>
								</div>
							  <hr>
							  <div class="form-group">
								<div id="foreignerKeyTableInfo"></div>
								<div id="relationshipTableInfo"></div>
							  </div>
							  <hr>
							  <div class="form-group">
								<textarea class="form-control" id="resultCode" rows="12"></textarea>
							  </div>
							  
							  <!-- Buttons -->
							  <div class="form-group" id="relationshipButton" >
								 <!-- Buttons -->
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-success" id="relationCodeBtn">生成关联模型手工代码</button>
								 </div>
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-info" id="addRelationCodeBtn">添加关联代码片段</button>
								 </div>
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-primary" id="creatRelationFileBtn">直接生成关联模型文件</button>
								 </div>
							  </div>
								<div class="col-lg-offset-1" id="relationResult"></div>
						  </div>
						</div><!--end  paddad-->
					</div>
				</div>	
				</div>	
			</div>
			
		
		<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						视图模型
					  </div>
					  <div class="widget-icons pull-right">
						<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
						<a href="#" class="wclose"><i class="icon-remove"></i></a>
					  </div>  
					  <div class="clearfix"></div>
					</div>  
					<div class="widget-content" >
						<div class="padd">
						<!--<p>一些注释</p>-->
							<div class="form quick-post">
								<div class="form-horizontal">
								 <div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">视图数据表:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="viewTable1">
											{volist name="tableNameList" id="table" }
												<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
											{volist} 
										</select> 
									</div>
								<div id="viewTable1Info"></div>
								</div>
							  <hr>
							  <div class="form-group">
									<label class="control-label col-lg-4" style="width:120px">关联数据表:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="viewTable2">
											<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
												<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?> 
										</select> 
									</div>
								<div id="viewTable2Info"></div>
								</div>
							  <hr>
							  <!-- Buttons -->
							  <div class="form-group">
								<label class="control-label col-lg-4" style="width:120px">视图表字段:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="viewModuleOn1">
										</select> 
									</div>
								</div>
								<div class="form-group">
								<label class="control-label col-lg-4" style="width:120px">关联表字段:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="viewModuleOn2">
										</select> 
									</div>
								</div>
								<div class="form-group">
									 <!-- Buttons -->
									 <div class="col-lg-offset-2 col-lg-9">
										<button class="btn btn-success" id="readOnColum">读取关联条件字段</button>
									 </div>
								</div>
								
								<div class="form-group">
									 <label class="control-label col-lg-4" style="width:120px">JOIN类型:</label>
									<div class="col-lg-9"> 
										<select class="form-control" id="joinType">
											<option value="JOIN">(JOIN)</option>
											<option value="INNER">INNER</option>
											<option value="LEFT">LEFT</option>
											<option value="RIGHT">RIGHT</option>
											<option value="FULL">FULL</option>
										</select> 
									</div>
								</div>
							   <hr>
							  <div class="form-group">
								<textarea class="form-control" id="viewCode" rows="12"></textarea>
							  </div>
							  
							  <!-- Buttons -->
							  <div class="form-group" id="relationshipButton" >
								 <!-- Buttons -->
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-success" id="viewCodeBtn">生成视图模型手工代码</button>
								 </div>
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-info" id="addViewCodeBtn">添加关联代码片段</button>
								 </div>
								 <div class="col-lg-offset-1 col-lg-2">
									<button class="btn btn-primary" id="createViewFileBtn">直接生成关联模型文件</button>
								 </div>
							  </div>
								<div class="col-lg-offset-1" id="viewResult"></div>
								</div> 
							</div>	
						</div><!--end  paddad-->
					</div>	
				</div>	
			</div>
		</div>
		  
		 <div id="msg"></div> 
		</div><!-- container Graph end -->
	</div>
</div>

  	
</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2014-2018 | <a href="http://weiyunstudio.com">WeiYunStudio.com</a> </p>
      </div>
    </div>
  </div>
</footer>

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

<!-- JS -->

<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Notification - Noty -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="<?php echo TEMPLATE_PATH; ?>asset/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/custom.js"></script> <!-- Custom codes -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/charts.js"></script> <!-- Charts & Graphs -->


</body>
</html>
