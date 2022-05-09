<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>工作人员新建</title>
  <!--dynamic table-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />-->
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <!--<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">


    <!-- main content start--主页左上方的标志-->

		<!--body wrapper start :主要内容-->
		<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
									新建工作人员
	        			</header>
	        			&nbsp;&nbsp;&nbsp;
	        			<strong>工作人员</strong>
	        			<div class="panel-body">						        
									<table  class="display table table-bordered table-striped" id="tab_1">
									<thead>
										<tr>
											<th>姓名</th>
											<th>编号</th>
											<th>证件号</th>
											<th>地址</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" maxlength="2" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
										</tr>
									</tbody>
									<thead>
										<tr>
											<th>QQ</th>
											<th>微信</th>
											<th>手机</th>
											<th>固话</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
										</tr>
									</tbody>
								</table>
								<p>-------------------------------------------------------------------------------------------------------------</p>
								<strong>账号信息</strong>
								<div class="panel-body">						        
									<table  class="display table table-bordered table-striped" id="tab_2">
									<thead>
										<tr>
											<th>编号</th>
											<th>账号</th>
											<th>密码</th>
											<th>入职日期</th>
											<th>离职日期</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="password" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
										</tr>
									</tbody>
									</table>
								
								<p>-------------------------------------------------------------------------------------------------------------</p>
								<strong>权限分配</strong>
								<br /><br />
								<table class="display table table-bordered table-striped" id="tab_3">
										<tr>
											<td>hao</td><td align="center"><input type="checkbox" id="" name="" /></td>
											<td>hao</td><td align="center"><input type="checkbox" id="" name=""   /></td>
											<td>hao</td><td align="center"><input type="text" id="" name=""   /></td>
										</tr>
									</tbody>
								</table>
								<p>-------------------------------------------------------------------------------------------------------------</p>

								<p>-------------------------------------------------------------------------------------------------------------</p>
								<strong>备注</strong>
									<p><textarea cols="65" id="sqr_bz" rows="2" name="bz" value="未获取"></textarea></p>
								<br />
								<div align="center">
									<!--<input type="reset" value="重置" />&nbsp;&nbsp;&nbsp;-->
									<input type="button" value="保存" onclick=""/>
								</div>
						</div>
	        		</section>
	        	</div>
        	</div>
        </div>
        
				<!--body wrapper end-->
				
    <!-- main content end-->


<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>



<!--dynamic table-->

<!--<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>-->

<!--页数跳转--><!--表格插件-->
<!--
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<!--<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>-->

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--保存数据的函数-->

<!--增行减行的函数-->
<script src="../../js/person_add.js"></script>

</body>
</html>