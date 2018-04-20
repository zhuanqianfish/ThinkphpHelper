<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:27:"template/createm\index.html";i:1514959536;s:28:"template/default_layout.html";i:1515137317;s:22:"template/leftmenu.html";i:1515137433;}*/ ?>
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
          <!-- Logo. -->
          <div class="logo">
            <h1><a href="#">ThinkphpHelper V2.01<span class="bold"></span></a></h1>
            <p class="meta">代码生成工具　　　　<a href="https://github.com/zhuanqianfish/ThinkphpHelper" id="version"></a>
			如果觉得好用，请记得分享给你的好基友们！</p>
          </div>
          <!-- Logo ends -->
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
      <li><a href="<?php echo APP_NAME; ?>/Config"><i class="icon-bar-chart"></i>配置环境</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Createm"><i class="icon-bar-chart"></i>生成模块布局</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Crud/crud"><i class="icon-bar-chart"></i>生成CRUD代码</a></li>

      <li><a href="<?php echo APP_NAME; ?>/ModelCode"><i class="icon-table"></i>模型代码生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Fcode"><i class="icon-tasks"></i>表单生成</a></li>

      <li><a href="<?php echo APP_NAME; ?>/Index/ui"><i class="icon-magic"></i>UI控件</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Index/help"><i class="icon-calendar"></i>帮助</a></li>
    </ul>
</div>
    <!-- Sidebar ends -->
  	<!-- Main bar -->
		
<script type="text/javascript">
var db_prefix = '<?php echo $db_prefix; ?>';
var selectTableName = <?php echo $selectTableName; ?>;

function gogogo(moduleName, selectTableName, layoutName){
	$.post("<?php echo CONTROLLER_NAME; ?>/creatFiles", {'moduleName' : moduleName, 'selectTableName' : selectTableName, 'layoutName' : layoutName},
		function(data){
			$('#msg').html(data);
		}
	);
}


$(function(){
	$('#gogogo').bind("click", function(){
			var moduleName = $('#moduleName').val();
			var checkedBox = $('input:checked');
			var selectTableName = [];
			if(db_prefix != ''){
				checkedBox.each(function(){
				selectTableName.push($(this).val().replace(db_prefix,''));
				});
			}else{
				checkedBox.each(function(){
				selectTableName.push($(this).val());
				});
			}
			layoutName = $('#layoutName').val();
			gogogo(moduleName, selectTableName, layoutName);
		});	
		
		if(selectTableName){
			$.each(selectTableName, function(i, n){
				$('input[value=' + n + ']').attr("checked",true);
			})
		}
});
</script>
<div class="mainbar">
	<!-- Page heading -->
	<div class="page-head">
	  <h2 class="pull-left"><i class="icon-home"></i>生成模块布局</h2>

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
					  生成模块
					  </div>
					  <div class="widget-icons pull-right">
						<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
						<a href="#" class="wclose"><i class="icon-remove"></i></a>
					  </div>  
					  <div class="clearfix"></div>
					</div>  
					<div class="widget-content" >
					<div class="padd">
					<p>注：此步骤主要是为了生成模块目录以及布局文件需要有哪些菜单项</p>
                      <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <div class="form-horizontal">  
										<div class="form-group">
											<div class="form-group">
												<label class="control-label col-lg-3">目标模块:</label>
												<div class="col-lg-9">                               
													<select class="form-control" id="moduleName">
														<?php if(is_array($moduleNameList) || $moduleNameList instanceof \think\Collection || $moduleNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $moduleNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moduleName): $mod = ($i % 2 );++$i;?>
															<option value="<?php echo $moduleName; ?>"><?php echo $moduleName; ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													</select> 
												</div>
											  </div>   
											 <!-- Table -->
											<div class="form-group">
												<label class="control-label col-lg-3">数据表:</label>
												<div class="col-lg-9">                               
													<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
														<input type="checkbox" name="table" value="<?php echo $table; ?>" ><?php echo $table; ?></input><br>
													<?php endforeach; endif; else: echo "" ;endif; ?> 
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-3">布局模板:</label>
												<div class="col-lg-9">                               
													<select class="form-control" id="layoutName">
														<?php if(is_array($layoutNameList) || $layoutNameList instanceof \think\Collection || $layoutNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $layoutNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$layoutName): $mod = ($i % 2 );++$i;?>
															<option value="<?php echo $layoutName; ?>"><?php echo $layoutName; ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													</select>  
												</div>
											</div>
									    </div>    
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-lg-offset-2 col-lg-9">
												<button class="btn btn-success" id="gogogo">生成</button>
											 </div>
                                          </div>
                                      </div>
                                    </div><!--end  paddad-->
					</div>
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
            <p class="copy">Copyright &copy; 2014 | <a href="http://weiyunstudio.com">WeiYunStudio.com</a> </p>
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

<!-- jQuery Flot 绘图工具
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/excanvas.min.js"></script>
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.flot.js"></script>
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.flot.resize.js"></script>
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.flot.pie.js"></script>
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.flot.stack.js"></script>
-->

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
