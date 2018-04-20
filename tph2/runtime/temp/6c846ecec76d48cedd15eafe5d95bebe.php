<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:28:"template/FormCode\index.html";i:1515564676;s:28:"template/default_layout.html";i:1515137317;s:22:"template/leftmenu.html";i:1515487886;}*/ ?>
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
      <li><a href="<?php echo APP_NAME; ?>/CreateLayout"><i class="icon-bar-chart"></i>模块布局生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/ControllerCode"><i class="icon-bar-chart"></i>控制器代码生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/ModelCode"><i class="icon-table"></i>模型代码生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/FormCode"><i class="icon-tasks"></i>表单生成</a></li>

      <li><a href="<?php echo APP_NAME; ?>/Config"><i class="icon-bar-chart"></i>配置环境</a></li>

      
      <li><a href="<?php echo APP_NAME; ?>/Index/ui"><i class="icon-magic"></i>UI控件</a></li>
      <li><a href="<?php echo APP_NAME; ?>/Index/help"><i class="icon-calendar"></i>帮助</a></li>
    </ul>
</div>
    <!-- Sidebar ends -->
  	<!-- Main bar -->
		
<script type="text/javascript">
db_prefix = '<?php echo $db_prefix; ?>';

function cleanCode(){
	$('#formPreview').html('');
	$('#formCode').html('');
}

function creatForm(formMethod, formAction){
	$.post("__CONTROLLER__/creatForm", {'formMethod' : formMethod, 'formAction' : formAction},
		function(data){
			$('#formPreview').append(data);
			$('#formCode').html($('#formPreview').html());
		}
	);
}

function addRow(){
	if($('#formPreview').html() == ''){
		alert('尚未创建表单，请填写表单基本信息，点击确定');
		return;
	}
	num = $('#rowType').val().split(" ");
	str = "<div class=\"form-group\">\r\n";
	for(i = 0; i < num.length; i++){
		tempVal = num[i];
		str += '	<div class="col-sm-2 col-md-' + tempVal + "\" ></div>\r\n";
	}
	str += '</div>';
	$('#formPreview > form').prepend(str);
	$('#formCode').html($('#formPreview').html());
}

function bindClick(){	//绑定选择列事件
	$('#formPreview > form > .form-group > .col-sm-2').bind("click", function(){
		$('#formPreview > form > .form-group > .col-sm-2').removeClass('selected');
		$(this).addClass('selected');
	});
}

function loadField(){
	tableName = $('#tableName').val();
	$.post("__CONTROLLER__/loadField",{'tableName': tableName},
	function(data){
		$('#tableField').html(data);
	});
}

function fillCode(){	//填充项目代码片段
	labelName = $('#labelName').val();
	fieldType = $('#fieldType').val();
	tableField = $('#tableField').val();
	tableName = $('#tableName').val();
	str = '<label for="' + tableField + '">' + labelName + '</label>';
	if($('#formType').val() == 'edit'){
		switch(fieldType){
		case 'text':
			str += '<input type="text" class="form-control" id="' + tableField + '" name="' + tableField + '" value="{$' + tableName + "['" + tableField + "']}\" />";
			break;
		case 'textarea':
			str += '<textarea class="form-control" row="12" id="' + tableField + '" name="' + tableField + '" >{$' + tableName + "['" + tableField + "']}\"</textarea>";
			break;
		case 'select':
			str += '<select class="form-control" id="' + tableField + '">'+"\r\n"
				+ '{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+ '	<option value="' + tableField + '">' + tableField + '</option>'+"\r\n"
				+ '{/volist}' + "\r\n"
				+ '</select>' + "\r\n"
				+ '<script>$("#' + tableField + '").val({$' + tableName + "['" + tableField + "']})<\/script>";
			break;
		case 'radio':
			str += '{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+ '	<input type="radio" name="' + tableField + '" value="' + tableField + '">' + "\r\n"
				+ '{/volist}' +  "\r\n"
				+ '<script>$(":radio[name='+ tableField + "][value=\'{$"+ tableName + '.'+ tableField + "}\'])" + '.attr("checked","true")'+"<\/script>";
			break;
		case 'checkbox':
			str += '{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+ '	<input type="checkbox" name="' + tableField + '" value="' + tableField + '">' + "\r\n"
				+ '{/volist}' +  "\r\n"
				+ '<script>$(":checkbox[name='+ tableField + "][value=\'{$"+ tableName + '.'+ tableField + "}\'])" + '.attr("checked","true")'+"<\/script>";
			break;
		case 'radio2':
			str += '<input type="radio" name="' + tableField + '" value="' + labelName + '">' + "\r\n";
			break;
		case 'checkbox2':
			str += '<input type="checkbox" name="' + tableField + '" value="' + labelName + '">' + "\r\n";
			break;
		case 'hidden':
			str = '<input type="hidden" name="' + tableField + '" value="' + tableField + '">' + "\r\n";
			break;
		default:
			break;
		}
	}else{
		switch(fieldType){
		case 'text':
			str += '<input type="text" class="form-control" id="' + tableField + '" name="' + tableField + '"  />';
			break;
		case 'textarea':
			str += '<textarea class="form-control" row="12" id="' + tableField + '" name="' + tableField + '" ></textarea>';
			break;
		case 'select':
			str += '<select class="form-control" id="moduleName">'+"\r\n"
				+'{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+'	<option value="' + tableField + '">' + tableField + '</option>'+"\r\n"
				+'{/volist}'+"\r\n"
				+ '</select>';
			break;
		case 'radio':
			str += '{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+'	<input type="radio" name="' + tableField + '" value="' + tableField + '">' + "\r\n"
				+'{/volist}';
			break;
		case 'checkbox':
			str += '{volist name="' + tableField + 'List" id="' + tableField + '" }'+"\r\n"
				+'	<input type="checkbox" name="' + tableField + '" value="' + tableField + '">' + "\r\n"
				+'{/volist}';
			break;
		case 'radio2':
			str += '<input type="radio" name="' + tableField + '" value="' + labelName + '">' + "\r\n";
			break;
		case 'checkbox2':
			str += '<input type="checkbox" name="' + tableField + '" value="' + labelName + '">' + "\r\n";
			break;
		case 'hidden':
			str = '<input type="hidden" name="' + tableField + '" value="' + tableField + '">' + "\r\n";
			break;
		default:
			break;
		}
	}
	$('.selected').append(str);
}


function delCode(){		//删除代码片段
	$('.selected').html('');
}


function createFormCode(){	//生成编辑表单代码
	str = $('#formPreview').html();
	str = str.replace(' selected', '');	//删除selected样式类
	$('#formCode').html(str);
}

jQuery(document).ready(function($) {
		$('#cleanCodeBtn').bind("click", function(){
			cleanCode();
		});

		$('#creatFormBtn').bind("click", function(){
			if($('#formPreview').html() != ''){
				alert('表单已经创建了');
				return;
			}
			formMethod = $('#formMethod').val();
			formAction = $('#moduleName').val() + '/' + $('#formController').val() + '/' + $('#formAction').val();
			creatForm(formMethod, formAction);
		});

		$('#addRowBtn').bind("click", function(){
			addRow();
			bindClick();
		});

		$('#fillCodeBtn').bind("click", function(){
			fillCode();
		});

		loadField();
	});

</script>
<div class="mainbar">
	<!-- Page heading -->
	<div class="page-head">
	  <h2 class="pull-left"><i class="icon-home"></i>生成表单代码</h2>

	<div class="clearfix"></div>
	</div>
	<!-- Page heading ends -->


	<!-- Matter -->

	<div class="matter">
		<div class="container">
			<div class="row">
			<div class="col-md-6">
				<div class="col-md-12">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						表单基本信息
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
                                      <!-- Edit profile form (not working)-->
                                      <div class="form-horizontal">
										<div class="form-group">
											<div class="form-group">
												<label class="control-label col-lg-4"  style="width:120px">表单类型:</label>
												<div class="col-lg-4">
													<select class="form-control" id="formType">
															<option value="add">新建记录表单</option>
															<option value="edit">编辑记录表单</option>
													</select>
												</div>

												<label class="control-label col-lg-4" style="width:120px">提交方式:</label>
												<div class="col-lg-4">
													<select class="form-control" id="formMethod">
															<option value="post" >post</option>
															<option value="post" >get</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-lg-4" style="width:120px">所属控制器:</label>
												<div class="col-lg-4">
													<input type="text" class="form-control" id="formController" />
												</div>

												<label class="control-label col-lg-4" style="width:120px">处理方法:</label>
												<div class="col-lg-4">
													<input type="text" class="form-control" id="formAction" />
												</div>
											</div>

									    </div>

                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-lg-offset-2 col-lg-3">
												<button class="btn btn-success" id="creatFormBtn">确定</button>

											 </div>
											 <div class="col-lg-3">
												<button class="btn btn-danger" id="cleanCodeBtn">重置代码</button>
											 </div>

                                          </div>
                                      </div>
                                    </div><!--end  paddad-->

					</div>
				</div>
				</div>
				</div>

				<div class="col-md-12">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						生成表单项目代码
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
                                      <!-- Edit profile form (not working)-->
                                      <div class="form-horizontal">
										<div class="form-group">
											<div class="form-group">
												<label class="control-label col-lg-3"  style="width:120px">项目标签:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" id="labelName" />
												</div>
											  </div>

											<div class="form-group">
												<label class="control-label col-lg-4" style="width:120px">表单项目类型:</label>
												<div class="col-lg-9">
													<select class="form-control" id="fieldType">
														<option value="text" >文本域(text)</option>
														<option value="select" >单选下拉框(select)</option>
														<option value="radio" >单选按钮(radio)</option>
														<option value="checkbox" >复选框(checkbox)</option>
														<option value="radio2" >与标签同值单选按钮</option>
														<option value="checkbox2" >与标签同值复选框</option>
														<option value="textarea" >多行文本(textarea)</option>
														<option value="hidden" >隐藏域(hidden)</option>
													</select>
												</div>
											</div>

											<!-- 数据源表 -->
											<div class="form-group">
												<label class="control-label col-lg-4" style="width:120px">数据源:</label>
												<div class="col-lg-4">
													<select class="form-control" id="tableName" onchange="loadField()">
														<?php if(is_array($tableNameList) || $tableNameList instanceof \think\Collection || $tableNameList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
															<option value="<?php echo $table; ?>" ><?php echo $table; ?></option>
														<?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
												</div>

												<label class="control-label col-lg-4" style="width:120px">字段:</label>
												<div class="col-lg-4">
													<select class="form-control" id="tableField">

													</select>
												</div>
											</div>
									    </div>

                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-lg-offset-2 col-lg-3">
												<button class="btn btn-success" id="fillCodeBtn">填充代码片段</button>
											 </div>
											 <div class="col-lg-3">
												<button class="btn btn-danger" id="delCodeBtn" onclick="delCode()">删除代码片段</button>
											 </div>
                                          </div>
                                      </div>
                                    </div><!--end  paddad-->

					</div>
				</div>
				</div>
			</div>
			</div>


			<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						生成表单预览
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
								<div class="form-group">
									<label class="control-label col-lg-3"  style="width:120px">布局方式:</label>
									<div class="col-lg-3">
										<select class="form-control" id="rowType">
											<option value="12" >12</option>
											<option value="6 6" >6 6</option>
											<option value="8 4" >8 4</option>
											<option value="4 4 4" >4 4 4</option>
											<option value="2 6 4" >2 6 4</option>
										</select>
									</div>

									<div class="col-lg-3">
										<button class="btn btn-success" id="addRowBtn">添加一行</button>
									</div>

									<div class="col-lg-3">
										<button class="btn btn-primary" id="createFormCodeBtn" onclick="createFormCode()">生成表单代码</button>
									</div>

								</div>
							</div>
						</div>
					</div>
					<hr>
					<style>
						#formPreview form{
						  border-style: solid;
						  border-width: 1px;
						  border-color: #ccc;
						}

						#formPreview form .col-sm-2{
							min-height:40px;
							border-style: solid;
							border-width: 1px;
							border-color: #ccc;
						}

						.selected{
							border-width: 2px !important;
							border-color: red !important;
						}
					</style>
						<div id="formPreview"></div>
					</div>
					</div>
				</div>
			</div>


			</div>

			<div class="row">
			<div class="col-md-6">
				<div class="widget">
					<div class="widget-head">
					  <div class="pull-left" height="80">
						生成表单代码片段
					  </div>
					  <div class="widget-icons pull-right">
						<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
						<a href="#" class="wclose"><i class="icon-remove"></i></a>
					  </div>
					  <div class="clearfix"></div>
					</div>
					<div class="widget-content" >
					<div class="padd">
						<textArea rows="12" class="form-control" id="formCode"></textArea>
					</div>
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
