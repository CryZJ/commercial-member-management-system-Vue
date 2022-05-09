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
							require'../../../conn.php';
							$sql = "select 申请日 from 专案_年费 where 案卷号='".$ajh."'";
							$result = $conn->query($sql);
							$SQRDate = '';
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQRDate = $row['申请日'];
								}
							}
		    		?>	
		    		<input id="CaseType" value="<?php echo $CaseType; ?>" hidden="hidden" />
						<table>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;</td>
								<th>案卷号：</th>
								<th><input type="text" id="ajh" name="ajh" style="border:0px" readonly="readonly" hidden="hidden" value="<?php echo $ajh; ?>"/>
									<?php echo $ajh; ?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>申请日：</th>
								<th><input id="SQDate" value="<?php echo $SQRDate; ?>" hidden="hidden" /><?php echo $SQRDate; ?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>费减比：</th>
								<th><select id="select_FCount" >
									<option >70%</option>
									<option>85%</option>
									<option selected="selected">100%</option>
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td><input type="file"  id="upfile" multiple="multiple"/></td>
								<th><input type="button" id="upJQuery" value="证书上传" /></th>
							</tr>
						</table>
			  	</header>
			  	<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
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
					<div id="btn" align="center"></div>
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
	//证书上传
	fd = new FormData();
	document.getElementById("upfile").addEventListener("change",function(){
		my_files = document.getElementById("upfile").files;
		fd.append('upfile',my_files[0]);
		var ajh = document.getElementById("ajh").value;
		fd.append('ajh',ajh);
		fd.append('flag','savefile');
		fd.append('upfile',my_files[0]);
	});
	$('#upJQuery').on("click",function(){
		$.ajax({
			url:"CaseSave.php",
			type:"POST",
			processData:false,
			contentType:false,
			data:fd,
			success:function(data){
//				console.log(data);
				if (data==1) {
					CreatFare();//证书保存成功后生成年费
				}else{
					alert('请先上传证书后');
//					console.log(data);
				}
			}
		});
	});
	
	//获取首年度,费减比,生成年费
	function CreatFare(){
		var tab = document.getElementById("tab_Fare");
		var btn = document.getElementById("btn");
		//删除初始数据
		var numr = tab.rows.length;
		while(numr>1){
			var numr = tab.rows.length;
			numr--;
			tab.deleteRow(numr);
		}
		//删去保存按钮
		btn.innerHTML='';
		//获取对象
		var CaseType = document.getElementById("CaseType").value;//案件类型
		var FirstY = document.getElementById("select_FY").value;//首年度
		FirstY++;
		var FCount = document.getElementById("select_FCount").value;//费减比
		var ajh = document.getElementById("ajh").value;//案卷号
		var SQDate = document.getElementById("SQDate").value;//申请日
//		alert(FCount);
		switch(CaseType){
			case '3':fall=10;CaseType ='外观设计'; break;
			case '2':fall=10;CaseType ='实用新型';break;
			case '1':fall=20;CaseType ='发明专利';break;
			default:alert('未知案件类型');break;
		}
		var timen =1;
		$.ajax({
			url:"CaseSave.php",
			type:"post",
			async:true,
			dataType:'json',
			data:{
				year:FirstY,
				count:FCount,
				type:CaseType,
				flag:'yearfare'
			},
			success:function(data){
//				console.log(data);
						//生成年费滞纳金等费用
						while(FirstY<=fall){
							var numr = tab.rows.length;//计算表格行数
							var newRow = tab.insertRow(numr);//增行
							var creayc = creaty(FirstY,SQDate);//计算通知时间和截至时间[首年度，申请日]
							var Fare = parseFloat(data[timen]['fare']);
		//					newRow.insertCell(0).innerHTML = FirstY+"<input type='text' style='width:25px;height:30px;border:0px;' hidden='hidden' value='"+ FirstY +"' />";
		//					newRow.insertCell(1).innerHTML = "<input type='text' style='width:60px;height:30px;' value='"+ Fare +"' />";
		//					newRow.insertCell(2).innerHTML = "<input style='height:30px;' type='date' value='"+ creayc[0] +"' />";
		//					newRow.insertCell(3).innerHTML = "<input style='height:30px;' type='date' readonly='readonly' value='"+ creayc[1] +"' />";
							newRow.insertCell(0).innerHTML = FirstY;
							newRow.insertCell(1).innerHTML = Fare;
							newRow.insertCell(2).innerHTML = creayc[0];
							newRow.insertCell(3).innerHTML = creayc[1];
							var FareOutDateL1 = Fare+Fare*0.05;
							var FareOutDateL2 = Fare+Fare*0.10;
							var FareOutDateL3 = Fare+Fare*0.15;
							var FareOutDateL4 = Fare+Fare*0.20;
							var FareOutDateL5 = Fare+Fare*0.25;
		//					newRow.insertCell(4).innerHTML = "<input style='width:60px;' type='text' readonly='readonly' value='"+ FareOutDateL1 +"' />";
		//					newRow.insertCell(5).innerHTML = "<input style='width:60px;' type='text' readonly='readonly' value='"+ FareOutDateL2 +"' />";
		//					newRow.insertCell(6).innerHTML = "<input style='width:60px;' type='text' readonly='readonly' value='"+ FareOutDateL3 +"' />";
		//					newRow.insertCell(7).innerHTML = "<input style='width:60px;' type='text' readonly='readonly' value='"+ FareOutDateL4 +"' />";
		//					newRow.insertCell(8).innerHTML = "<input style='width:60px;' type='text' readonly='readonly' value='"+ FareOutDateL5 +"' />";
							newRow.insertCell(4).innerHTML =  FareOutDateL1;
							newRow.insertCell(5).innerHTML =  FareOutDateL2;
							newRow.insertCell(6).innerHTML =  FareOutDateL3;
							newRow.insertCell(7).innerHTML =  FareOutDateL4;
							newRow.insertCell(8).innerHTML =  FareOutDateL5;
							FirstY++;timen++;
						}
						btn.innerHTML = "<input type='button' class='btn btn-primary' readonly='readonly' value='保存' onclick='saveMes()' />";
			}
		});
	}
	
	//计算截止日期和通知日期[参数：首年度，申请日]
	function creaty(dline,year){
		//计算截止日期
		dline = parseInt(dline);
		var dateTemp = year.split("-");
		dateTemp[0] = parseInt(dateTemp[0])-1;
		dateTemp[0] = dateTemp[0] + dline;
		//判断加了一个月之后是不是新一年
		dateTemp[1] = parseInt(dateTemp[1]);
		if (dateTemp[1] == 12) {
			dateTemp[0] = dateTemp[0] + 1;
			dateTemp[1] = parseInt(dateTemp[1])+1;
		} else{
			dateTemp[1] = parseInt(dateTemp[1])+1;
		}
		if (dateTemp[1] < 10) dateTemp[1] = "0" + dateTemp[1];
		var ydate = dateTemp[0] + '-' + dateTemp[1] + '-' + dateTemp[2];
		//计算通知日期
		var dateTemp = ydate.split("-");
		var nDate = new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]); //转换为MM-DD-YYYY格式    
		var year = nDate.getFullYear();
		var month = nDate.getMonth();
		month = month-1;
		if(month==0){
			month = 12;
			year = year-1;
		}
		if (month < 10) month = "0" + month;
		var date = nDate.getDate();  
		if (date < 10) date = "0" + date;  
		var ydate2 = year + "-" + month + "-" + date;
		var dateall = new Array(ydate2,ydate);//通知时间，截止日期
		return dateall;
	}
	
	//保存费用
	function saveMes(){
		var tab = document.getElementById("tab_Fare");
		var ArrFare = new Object();
		var RowNum  = tab.rows.length;
		var CellNum = tab.rows[0].cells.length;
		var DataLen = 0;
		var ajh = document.getElementById("ajh").value;
		for (var i=1;i<RowNum;i++) {
			ArrFare[DataLen] = new Object();
			ArrFare[DataLen]['Year'] =tab.rows[i].cells[0].innerHTML;
			ArrFare[DataLen]['Fare'] =tab.rows[i].cells[1].innerHTML;
			ArrFare[DataLen]['DateB']=tab.rows[i].cells[2].innerHTML;
			ArrFare[DataLen]['DateE']=tab.rows[i].cells[3].innerHTML;
			ArrFare[DataLen]['ODL0'] =tab.rows[i].cells[4].innerHTML;
			ArrFare[DataLen]['ODL1'] =tab.rows[i].cells[5].innerHTML;
			ArrFare[DataLen]['ODL2'] =tab.rows[i].cells[6].innerHTML;
			ArrFare[DataLen]['ODL3'] =tab.rows[i].cells[7].innerHTML;
			ArrFare[DataLen]['ODL4'] =tab.rows[i].cells[8].innerHTML;
//			alert(tab.rows[i].cells[0].innerHTML);
			DataLen++;
		}
		$.ajax({
			type:"post",
			url:"CaseSave.php",
			async:true,
			data:{
				flag:'SaveFare',
				ArrFare:ArrFare,
				DataLen:DataLen,
				ajh:ajh
			},
			success:function(data){
//				console.log(data);
				if(data){
					alert('证书及年费保存成功');
					window.close();
				}else{
					alert('操作失败，请联系管理员');
				}
			},
			error:function(e,t,s){
//				console.log(e);
				alert(e);
			}
		});
	}
</script>

</body>
</html>