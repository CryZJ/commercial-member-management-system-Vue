<?php
	require("../../../AHeader.php");
?>

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

  <title>商标代理详情</title>

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
				<strong>商标代理</strong>
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
                    </span>
	            </header>
	           <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	           	<input style="height:30px;" type="button" value="导入受理回执" onclick="" />
	           	<input style="height:30px;" type="button" value="导入受理通知书" onclick="" />
	           	<input style="height:30px;" type="button" value="导入初审公告书" onclick="" />
	           	<input style="height:30px;" type="button" value="导入证书" onclick="" />
	           	<input style="height:30px;" type="button" value="导入其他文件" onclick="" />
	                <br />
	                <br />
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <thead>
			                <th colspan="6" >监控情况</th>
		                </thead>
		                <tbody >
		                	<tr>
				        		<th>#</th>
				        		<th>名称</th>
								<th>提醒时间</th>
								<th>截止时间</th>
								<th>状态</th>
								<th>操作</th>
				       		</tr>
		                	<tr>
				        		<td>1</td>
				        		<td><input type="text" /></td>
								<td><input type="date" /></td>
								<td><input type="date" /></td>
								<td><input style="width:100px;" type="text" /></td>
								<td><input type="button" value="停止" /></td>
				       		</tr>
		                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_1">
		                <thead>
			                <tr>
				        		<th>案件类型</th>
				        		<td><input style="background-color:#DDDDDD;" readonly="readonly" type="text" /></td>
								<th>案卷号</th>
								<td><input  style="background-color:#DDDDDD;" readonly="readonly" type="text" /></td>
				       		</tr>
		                </thead>
		                <tbody >
		                	<tr>
				        		<th>案源人</th>
				        		<td><input type="text" style="background-color:#DDDDDD;" readonly="readonly" id="ayr" /></td>
				        		<th>代理人</th>
				        		<td><input type="text" style="background-color:#DDDDDD;width:100px;" id="dlr" readonly="readonly" /></td>
				       		</tr>
				       		<tr>
				        		<th>注册号</th>
				        		<th><input type="text" /></th>
								<th>注册日期</th>
								<th><input type="text" /></th>
				       		</tr>
		                	<tr>
				        		<th>专用权期限【始】</th>
				        		<th><input type="date" /></th>
								<th>专用权期限【末】</th>
								<th><input type="date" /></th>
				       		</tr>
		                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
				       		<tr>
				        		<th>申请人(中文名)</th>
				        		<th><input type="text" style="background-color:#DDDDDD;" readonly="readonly" /></th>
								<th>申请人(英文名)</th>
				        		<th><input type="text" style="background-color:#DDDDDD;" readonly="readonly" /></th>
				       		</tr>
				       		<tr>
				       			<th>身份证号</th>
								<th><input type="text" style="background-color:#DDDDDD;" readonly="readonly" /></th>
				        		<th>营业执照号码</th>
				        		<th><input type="text" style="background-color:#DDDDDD;" readonly="readonly" /></th>
				       		</tr>
				       		<tr>
				       			<th colspan="1" >地址(中文)</th>
								<th colspan="3" ><input style="width:700px;background-color:#DDDDDD;" type="text" readonly="readonly" /></th>
				       		</tr>
				       		<tr>
				       			<th colspan="1" >地址(英文)</th>
								<th colspan="3" ><input style="width:700px;background-color:#DDDDDD;" type="text" readonly="readonly" /></th>
				       		</tr>
				       		<tr>
				       			<th colspan="1" >邮编</th>
								<th colspan="3" ><input style="background-color:#DDDDDD;" readonly="readonly" type="text" /></th>
				       		</tr>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                	<tr>
	                		<th>类别</th>
							<th><input style="background-color:#DDDDDD;" readonly="readonly" type="text" /></th>
							<th>商品名称</th>
							<th><input style="background-color:#DDDDDD;" readonly="readonly" type="text" /></th>
	                	</tr>
	                	<tr>
	                		<th>商标图样(黑白)</th>
							<th><input type="file"style="background-color:#DDDDDD;" readonly="readonly"  /></th>
							<th>商标图样(彩色)</th>
							<th><input type="file"style="background-color:#DDDDDD;" readonly="readonly"  /></th>
	                	</tr>
	                	<tr>
	                		<th colspan="1" >商品/服务</th>
	                		<th colspan="3" ><input type="text"style="background-color:#DDDDDD;" readonly="readonly"  /></th>
	                	</tr>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                	<tr>
	                		<th style="width:25%;" >身份证原件</th>
							<th style="width:25%;" ></th>
							<th style="width:25%;" >身份证翻译件</th>
							<th style="width:25%;" ></th>
	                	</tr>
	                	<tr>
	                		<th>营业执照原件</th>
							<th></th>
							<th>营业执照翻译件</th>
							<th></th>
	                	</tr>
	                	<tr>
	                		<th>委托书</th>
							<th colspan="3" ></th>
	                	</tr>
	                	<tr>
	                		<th>其他文件</th>
							<th colspan="3" ><input type="file" /></th>
	                	</tr>
	                </table>
	                 <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	                <br />
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
		<!--选择案源人，联系人,生成案卷号,保存信息，生成年费等--> <!--数据保存-->
<script src="../../../js/imitation_1/zl_sb.js"></script>
		

</body>
</html>