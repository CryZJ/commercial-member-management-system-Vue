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

  <title>案件缴费页面</title>

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

<!--<script type="text/javascript">
		function show_msg(){
			ajh = window.dialogArguments;
			//alert (ajh);
			document.getElementById('ajh').value = ajh;
		}
</script>-->

</head>
<body class="sticky-header" >
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
						<?php
							$ajh = $_GET['ajh'];
						?>
				<span>案件缴费操作</span>
				<br />
				<br />
				&nbsp;&nbsp;&nbsp;
				<strong>案卷号:</strong>&nbsp;&nbsp;<? echo $ajh; ?>
		  </header>
	        <div class="panel-body">
				<form action="#" method="post">
					<table class="table table-bordered table-striped table-condensed" id="tab" >
						<tr>
							<th>费用名称</th>
							<th>金额</th>
							<th>缴费期限</th>
							<th>上缴日期</th>
							<th>收据编号</th>
						</tr>
						<tr>
							<td><input type="text" name="startime" id="startime"  /></td>
							<td><input type="text" name="startime" id="startime"  /></td>
							<td><input type="date" name="startime" id="startime"  /></td>
							<td><input type="date" name="startime" id="startime"  /></td>
							<td><input type="text" name="startime" id="startime"  /></td>
						</tr>
					</table>
					<br />
					<div align="center"><input type="submit" value="确定" /></div>
				</form>
				
	        </div>
	        </section>
	        </div>

        </div>
        </div>
        </div>
        <!--body wrapper end-->

    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

</body>
</html>

