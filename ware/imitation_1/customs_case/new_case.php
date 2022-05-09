<?php require'../../../AHeader.php'; ?>

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
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>海关备案新建</title>

  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->
  
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
				<!--用于输出测试-->
				<!--<input type="text" id="error" value="" />-->
				<!--处理人-->
				<input hidden="hidden" type="text" id="clrnow" value="<?php echo $name; ?>" />
				<strong>海关备案新建</strong>
                <span class="tools pull-right">
                    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
                </span>
	            </header>
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	            <input hidden="hidden" type="text" id="czy" value="<?php echo $name; ?>" />
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <thead>
			                <tr>
				        		<th>案源人</th>
				        		<th>代理人</th>
								<th>案卷号</th>
								<th>案件类型</th>
								<th>申请号</th>
								<th>申请日</th>
								<th>专案名称</th>
				       		</tr>
		                </thead>
		                <tbody>
		                	<tr>
		                		<td><input style="height:30px;" hidden="hidden" type="text" value="" id="ayrid" /><input type="text" style="width:100px;height:30px;" id="ayr" value="" readonly="readonly" onclick="select_ayr(this.id)" /></td>
		                		<td><input style="height:30px;" hidden="hidden" type="text" value="" id="dlrid" /><input type="text" style="width:100px;height:30px;" id="dlr" value="" readonly="readonly" onclick="select_dlr(this.id)" /></td>
		                		<td><input style="height:30px;" type="text" value="" id="ajh" /></td>
		                		<td><select style="height:30px;width:80px;" id="tyna" ><option selected="selected" ></option><option>专利</option><option>商标</option></select></td>
		                		<td><input style="height:30px;" type="text" value="" id="" /></td>
		                		<td><input style="height:30px;" type="date" value="" id="" /></td>
		                		<td><input style="height:30px;width: 300px;" type="text" value="" id="" /></td>
		                	</tr>
		                </tbody>
	                </table>
	                <button class="btn btn-primary" type="button" onclick="select_sqr()" >选择申请人</button><br /><br />
	            <table class="table table-bordered table-striped table-condensed" id="tab_sqr1">
	            	<tr>
	            		<th hidden="hidden" >id</th>
	            		<th>申请人</th>
	    				<th>证件号</th>
	            		<th>地址</th>
	            	</tr>
	            	<tr>
	            		<td hidden="hidden" ></td>
	            		<td style="height: 40px;" ></td>
	            		<td></td>
	            		<td></td>
	            	</tr>
	            </table>
                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                <thead>
		                <tr>
			        		<th>备案日期</th>
	                		<th>备案监控</th>
	                		<th>监控天数</th>
			       		</tr>
	                </thead>
	                <tbody >
	                	<tr>
	                		<td><input type="date" style="height:30px;" id="startime" value="<?php $now_date =date('Y-m-d');  echo $now_date; ?>" onchange="showdaym(this.value)" /></td>
	                		<td><input type="date" style="height:30px;" id="endtime" value="<?php $now_date =date('Y-m-d',strtotime('+20 day'));  echo $now_date; ?>" onchange="showday(this.value)" /></td>
	                		<td><input type="text" style="height:30px;" id="last_date" value="20" onkeyup="changedate(this.value)" /></td>
	                	</tr>
	                </tbody>
                </table>
                 <label>案件备注：</label>
            		<p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
                <br />
                <div align="center" ><button class="btn btn-primary" type="button" onclick="savemes()" >保存信息</button></div>
		</section>
		</div>
		</div>
		</div>
	<!--body wrapper end-->

	</div>
	<!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<script src="../../../js/scripts.js"></script>
		<!--选择代理人，案源人，申请人，生成案卷号，监控日期，保存信息-->
<script src="../../../js/imitation_1/zl_cu.js"></script>

</body>
</html>