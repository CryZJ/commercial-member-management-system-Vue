<?php
	require("../../AHeader.php");
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>OA办公-快递接收登记</title>

  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper">
	<div class="row">
	    <div  class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<input hidden="hidden" type="text" id="conid" value="<?php echo $userid; ?>" />
	            	<input hidden="hidden" type="text" id="id" value="<?php echo $userid; ?>" />
	            	<input type="button" value="增行" onclick="tab_add(document.all.tabUserInfo)" /> 
					<input type="button" value="删除" onclick="tab_del(document.all.tabUserInfo)" />
					<input id="button_save" type="button" value="保存信息" onclick="save_arri(document.all.tabUserInfo)" />
	                    <span class="tools pull-right">
		                    <a href="javascript:;" class="fa fa-chevron-down"></a>
		                    <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
		                </span>
	            </header>
	           <div class="panel-body" style="width:98%; height:580px;  overflow:auto; solid #000000;">
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
	                <thead>
	                	<tr>
	                		<td rowspan="2" ><input type="checkbox" id="chea" name="" value="" /></td>
	                		<th rowspan="2" >收件人</th>
	                		<th colspan="9" >寄件人信息</th>
	                	</tr>
		                <tr>
	                		<th>姓名</th>
	                		<th>手机</th>
		                    <th>单位</th>
		                    <th>地址</th>
		                    <th>内件品名</th>
		                    <th>快递单号</th>
		                    <th>发件时间</th>
		                    <th>备注</th>
		                    <th>底单上传</th>
		                </tr>
	                </thead>
	                <tbody >
	                	<tr hidden="hidden" >
            				<td><input type="checkbox" id="" value="" name="" /></td>
            				<td><input style="width:100px;" type="text" id="" value="" name="" /></td>
            				<td><input style="width:100px;" type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="date" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="file" id="" value="" name="" /></td>
						</tr>
            			<tr>
            				<td><input type="checkbox" id="" value="" name="" /></td>
            				<td><input style="width:100px;" type="text" id="" value="" name="" /></td>
            				<td><input style="width:100px;" type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="date" id="" value="" name="" /></td>
            				<td><input type="text" id="" value="" name="" /></td>
            				<td><input type="file" id="" value="" name="" /></td>
						</tr>
	                </tbody>
	                </table>
	                <br />
	        	</form>
			</section>
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

<script src="../../js/scripts.js"></script>

<!--页面响应-->
<script src="../../js/imitation_2/exdelmas.js"></script>

<script text="text/javascript">
	var tab = document.getElementById("tabUserInfo");
	var CT = document.getElementById("chea");
	CT.addEventListener("click",function(){
		var nrow = tab.rows.length;
//		alert('ok');
		if(CT.checked == true){
			var nrow = tab.rows.length;
			for(i=3;i<nrow;i++){
				tab.rows[i].getElementsByTagName("input")[0].checked = true;
			}
		}else{
			var nrow = tab.rows.length;
			for(i=3;i<nrow;i++){
				tab.rows[i].getElementsByTagName("input")[0].checked = false;
			}
		}
	});
</script>
	
</body>
</html>