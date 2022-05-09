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

  <title>专案其他-证书登记</title>

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />

<script type="text/javascript">
</script>

</head>
<body class="sticky-header">
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
	        <section class="panel">
				<header class="panel-heading">
					<span class="tools pull-right">
					    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
					</span>
					<span>证书登记</span>
					<?php
		    			$ajh = $_GET['ajh'];
		    			$CaseType = substr($ajh,7,1);
	//			    			echo $CaseType;
						switch($CaseType){
							case 1:
								$Type = "发明专利";
								break;
							case 2:
								$Type = "实用新型";
								break;
							case 3:
								$Type = "外观设计";
								break;
						}
						$sql = "select 申请日";
						$result = $conn->query($sql);
						
		    		?>	
		    		<input id="CaseType" value="<?php echo $Type; ?>" hidden="hidden" />
						<table>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<th>案卷号：</th>
								<th><input type="text" id="ajh" name="ajh" style="border:0px" readonly="readonly" value="<?php echo $ajh; ?>"/></th>
								<th>申请日：</th>
								<th><input id="SQDate" value=""  />
								<th>首年度：</th>
								<th><select id="select_FY">
									<option selected="selected" >1</option>
	            			<option>2</option>
	            			<option>3</option>
	            			<option>4</option>
	            			<option>5</option>
	            			<option>6</option>
	            			<option>7</option>
	            			<option>8</option>
	            			<option>9</option>
	            			<option>10</option>
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<th>费减比：</th>
								<th><select id="select_FCount" >
									<option></option>
									<option>70%</option>
									<option>85%</option>
									<option>100%</option>
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</th>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td><input type="file"  id="upfile" multiple="multiple"/></td>
								<th><input type="button" id="upJQuery" value="证书上传" /></th>
							</tr>
						</table>
			  	</header>
			  	
			  	<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
			  		<input type="button" onclick="CreatFare()" value="测试" />
		  			<table class="table table-bordered table-striped table-condensed" id="tab_Fare" >
						<tr>
							<th>年度</th>
							<th>费用</th>
							<th>截止时间</th>
							<th>提醒时间</th>
							<th>第一期</th>
							<th>第二期</th>
							<th>第三期</th>
							<th>第四期</th>
							<th>第五期</th>
						</tr>
					</table>
				</div>
		 	</section>
	      	</div>
        </div>
        </div>
        <!--body wrapper end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>

<!--页面响应-->
<script type="text/javascript">
	//案件监控
//	var status_type = document.getElementById("select_FCount");
//	status_type.addEventListener("change",function(){
//		var test = document.getElementById("select_FCount").value;
//		alert(test);
//	});
	//证书上传
	fd = new FormData();
	document.getElementById("upfile").addEventListener("change",function(){
		my_files = document.getElementById("upfile").files;
		fd.append('upfile',my_files[0]);
	});
	$('#upJQuery').on("click",function(){
		$.ajax({
			url:"info_zsdj_save.php",
			type:"POST",
			processData:false,
			contentType:false,
			data:fd,
			success:function(data){
				console.log(data);
			}
		});
	});
	//获取首年度,费减比,生成年费
//	function CreatFare(){
//		var CaseType = document.getElementById("CaseType").value;//案件类型
//		var FirstY = document.getElementById("select_FY").value;//首年度
//		var FCount = document.getElementById("select_FCount").value;//费减比
//		var ajh = document.getElementById("ajh").value;//案卷号
////		alert(FCount);
//		switch(CaseType){
//			case '实用新型':fall=10;break;
//			case '外观设计':fall=10;break;
//			case '发明专利':fall=20;break;
//			default:alert('请选择案件类型');exit;break;
//		}
//		var tab = document.getElementById("tab_Fare");
//		var timen =1;
//		while(FirstY<=fall){
//			var numr = tab.rows.length;//计算表格行数
//			var newRow = tab.insertRow(numr);//增行
//			var creayc = creaty(snd,sqr);//计算通知时间和截至时间[首年度，申请日]
//			newRow.insertCell(0).innerHTML = snd+"<input type='text' style='width:25px;height:30px;border:0px;' hidden='hidden' value='"+ snd +"' />";
//			newRow.insertCell(1).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ data[timen]['fare'] +"' />";
//			newRow.insertCell(2).innerHTML = "<input style='height:30px;' type='date' value='"+ creayc[0] +"' />";
//			newRow.insertCell(3).innerHTML = "<input style='height:30px;' type='date' readonly='readonly' value='"+ creayc[1] +"' />";
//			newRow.insertCell(4).innerHTML = "";
//			newRow.insertCell(5).innerHTML = "";
//			newRow.insertCell(6).innerHTML = "";
//			newRow.insertCell(7).innerHTML = "";
//			newRow.insertCell(8).innerHTML = "";
//			FirstY++;timen++;
//		}
//	}
	
</script>

</body>
</html>