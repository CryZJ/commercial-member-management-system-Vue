<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>流程员所属代理人/案源人</title>
  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
</head>
<body class="sticky-header">
<section>
	<div class="wrapper" >
    <div class="row" >
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading custom-tab">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>流程员所属代理人/案源人</a></li>
              </ul>
   			</header>
           	<div class="panel-body">
			    		<div class="tab-content">                             
									<div class="tab-pane active" id="about-1">
                    <section id="unseen">
                    	<table class="display table table-bordered table-striped" id="dynamic-table">
								       	<thead>
													<tr>
														<th>名字</th>
														<th>手机号码</th>
														<th>证件号码</th>
														<th>通信地址</th>
														<th>备注</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$id = $_GET['id'];
														require('../../conn.php');
														$sql = "select c.`名称`,c.`手机`,c.`证件号码`,c.`通信地址`,c.备注  from 用户 a,操作员下表 b,代理人信息 c WHERE a.id = b.czyid and c.编号 = b.编号 and a.id='$id'";
														$result = $conn->query($sql);
														if($result->num_rows > 0){
															while($row = $result->fetch_assoc()){
													?>			
																<tr>
																	<td><?php echo $row['名称'] ;?></td>
																	<td><?php echo $row['手机'] ;?></td>
																	<td><?php echo $row['证件号码'] ;?></td>
																	<td><?php echo $row['通信地址'] ;?></td>
																	<td><?php echo $row['备注'] ;?></td>
																</tr>
													<?php			
															}
														}
														$conn->close();	
													?>
												</tbody>
											</table>
                		</section>
            		</div>
           		</div>
           	</div>		
   		</section>	
	</div>
	</div>
	</div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

</body>
</html>