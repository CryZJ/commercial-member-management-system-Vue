<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>客户管理新建</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />
  
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
							<strong>客户信息新建</strong>
							<br />
							<sub>注：</sub>
							<sub>客户名为单位名，如若为个人则填写第一联系人姓名</sub>
	        			</header>
	        			<div class="panel-body">						        
							
								<table  class="display table table-bordered table-striped" id="tab">
									<thead>
										<tr>
											<th>客户名/单位</th>
											<th><input type="text" /> </th>
											<th>客户类型</th>
											<th colspan="3">
												<select>
													<option>意向客户</option>
													<option>成交客户</option>
													<option>放弃客户</option>
												</select>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>客户地址</td>
											<td><input type="text" /></td>
											<td>客户固话</td>
											<td><input type="text" /></td>
											<td>客户备注</td> 
											<td><input type="text" /></td>
										</tr>
										<tr>
											<td>第一联系人</td>
											<td><input type="text" /></td>
											<td>证件号</td>
											<td><input type="text" /></td>
											<td>收件地址</td> 
											<td><input type="text" /></td>
										</tr>
										<tr>
											<td>手机</td>
											<td><input type="text" /></td>
											<td>固话</td>
											<td><input type="text" /></td>
											<td>电子邮箱</td> 
											<td><input type="text"  /></td>
										</tr>
										<tr>
											<td>QQ</td>
											<td><input type="text"  /></td>
											<td>微信</td>
											<td><input type="text"  /></td>
											<td>联系人备注</td> 
											<td><input type="text"  /></td>
										</tr>
										
									</tbody>
								</table>
								<br />
								<div align="center">
									<!--<input type="reset" value="重置" />&nbsp;&nbsp;&nbsp;-->
									<input type="button" value="保存" onclick="Save_client()"/>
								</div>
							    
						</div>
	        		</section>
	        	</div>
        	</div>
        </div>
        
			
				<!--body wrapper end-->
				
				
        <!--footer section start-->
        <!--
        <footer>
            
        </footer>
        -->
        <!--footer section end-->



    <!-- main content end-->


<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>



<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>


<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>
<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>
<!--保存数据的函数-->
<script src="../../js/client.js"></script>

</body>
</html>
