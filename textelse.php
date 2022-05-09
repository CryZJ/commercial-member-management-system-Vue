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
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>

  <title>专案-流程自定义</title>

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />

<script type="text/javascript">
//		案卷号的获取与显示
		function show_msg(){
			ajh = window.dialogArguments;
			//alert (ajh);
			document.getElementById('ajh').value = ajh;
		}
		
		function showday(endtime){
			startime = document. getElementById('startime').value;
			document.getElementById('day').value=DateDiff(startime,endtime);
		}
		
		//计算天数差的函数，通用 
		function  DateDiff(sDate1,  sDate2){    //sDate1和sDate2是2006-12-18格式  
	       var  aDate,  oDate1,  oDate2,  iDays  
	       aDate  =  sDate1.split("-")  
	       oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])    //转换为12-18-2006格式  
	       aDate  =  sDate2.split("-")  
	       oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])  
	       iDays  =  parseInt(Math.abs(oDate1  -  oDate2)  /  1000  /  60  /  60  /24)    //把相差的毫秒数转换为天数  
	       return  iDays  
	   }  
		
		function changedate(day){
//			firsttime = toLocaleDateString();
//			alert(firsttime);
			firsttime = document.getElementById('startime').value;
			lastdate = getNewDay(firsttime,day);
			document.getElementById('endtime').value = lastdate;
		}
		
		//日期加上天数得到新的日期  
		//dateTemp 需要参加计算的日期，days要添加的天数，返回新的日期，日期格式：YYYY-MM-DD  
		function getNewDay(dateTemp, days) {  
		    var dateTemp = dateTemp.split("-");  
		    var nDate = new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]); //转换为MM-DD-YYYY格式    
		    var millSeconds = Math.abs(nDate) + (days * 24 * 60 * 60 * 1000);  
		    var rDate = new Date(millSeconds);  
		    var year = rDate.getFullYear();  
		    var month = rDate.getMonth() + 1;  
		    if (month < 10) month = "0" + month;  
		    var date = rDate.getDate();  
		    if (date < 10) date = "0" + date;  
		    return (year + "-" + month + "-" + date);  
		}	 

//		改变表格可见
//		function changetable(){
//				var tab_time = document.getElementById('tab_time');
//				var tab_fare = document.getElementById('tab_fare');
//				var time 		 = document.getElementById('time'); 
//				var fare 		 = document.getElementById('fare'); 
//				var che_t 	 = time.checked;								
//				var che_f 	 = fare.checked;								
//
//				//判断时间监控是否选中
//				if(che_t != true){
//						tab_time.style.visibility='collapse';
//				}if(che_t == true){
//						tab_time.style.visibility='visible';
//				}
//				//判断金额监控是否选中
//				if(che_f != true){
//						tab_fare.style.visibility='collapse';
//				}if(che_f == true){
//						tab_fare.style.visibility='visible';
//				}
//			}

</script>

</head>
<body class="sticky-header" onload="show_msg()">
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				<span>新建费用</span>
				<br />
				<br />
				
				<table>
					<tr>
						<th>案卷号：</th>
						<th><input type="text" id="ajh" name="ajh" style="border:0px" readonly /></th>
						<th><input type="file" id="" name="" /></th>
						<th><input type="button" id="" name="" value="提交文件" onclick="compare_file()" /></th>
					</tr>
				</table>
				<!--<sub>注：数据以新建优先</sub>-->
		  </header>
	    <div class="panel-body">
				<!--<form action="#" method="post">-->
						<table class="table table-bordered table-striped table-condensed" id="tab_base" align="center" >
							<?php $nowtime = date('Y-m-d');?>
							<tr>
								<th width="30%" align="center" >操作新建</th>
								<td align="center" colspan="2" ><input id="actnew" class="no-border" name=""  placeholder="操作新建[数据以新建优先]" /></td>
							</tr>
							<tr>
								<th > 操作选择</th>
								<td colspan="3" align="center" width="200">
									<select name="lx" id="lx" onchange="showmas(this.value)">
										<option ></option>
									<?php
										require('conn.php');
										$sql ='select * from 专案_自定义查询 group by 流程名 ';
										$result = $conn->query($sql);
										if($result -> num_rows > 0){
											while($row = $result->fetch_assoc()){
									?>
									 	<option ><?php echo $row["流程名"]; ?></option>
									<?php 
											}
										}
										else{
											?>
											 	<option >未有保存操作</option>
											<?php
										}
										$conn->close();
									?>
									</select>
								</td>
								<!--<td >
									<center>
										<input type="text" id="new_name" value="" />
										<input type="button" id="new_play" value="新建" />
									</center>
									
								</td>-->
							</tr>
							<!--<tr>
								<th width="30%" align="center" >导入的通知书类型</th>
								<td align="center" colspan="2" ><input id="file_n" class="no-border" name="" readonly="readonly" value="文件名" /></td>
								<td align="center" hidden="hidden" ><input id="file_id" name="" readonly="readonly" value="文件id" /></td>
							</tr>-->
							
						</table>
						<table class="table table-bordered table-striped table-condensed" id="tab_time" align="center" >
							<tr>
								<th>提醒时间</th>
								<td align="center" colspan="2" ><input type="date" name="startime" id="startime" value="<?php echo $nowtime ; ?>" /></td>
							</tr>
							<tr>
								<th>缴费期限</th>
								<td align="center"  colspan="2" ><input type="date" name="endtime" id="endtime" value="" onchange="showday(this.value)" /></td>
							</tr>
							<tr>
								<th>监控天数</th>
								<td align="center" colspan="2" ><input type="text" name="day" id="last_date" value="" onkeyup="changedate(this.value)" /></td>
							</tr>
						</table>
						<table class="table table-bordered table-striped table-condensed" id="tab_fare" >
							<tr>
								<th rowspan="3" id="fare_ba" >费用</th>
								<th>费用名</th>
								<th>金额</th>
							</tr>
							<tr>
								<td>
									<select name="fy" id="fy" >
										<option></option>
										<option>公布印刷费</option>
										<option>译文改正费</option>
										<option>优先权恢复费</option>
										<option>单一性恢复费</option>
										<option>发明专利复审费</option>
										<option>发明专利公告印刷费</option>
										<option>权利要求附加费</option>
										<option>说明书附加费</option>
									</select>
								</td>
								<td><input type="text" name="" id="" value="" /></td>
							</tr>
							<tr>
								<th id="add_fare" ><strong>+</strong></th>
								<th id="del_fare" ><strong>-</strong></th>
							</tr>
						</table>
						<table  class="table table-bordered table-striped table-condensed" id="">
							<tr>
								<th>文件抄送(接收人选择)</th>
							</tr>
							<tr>
								<td><input type="text" id="" /></td>
							</tr>
						</table>
					<br />
					<div align="center"><input type="submit" value="确定" onclick="tab_save()" /></div>
					
				<!--</form>-->
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<!--	费用增减行	-->
<script type="text/javascript" >
	var FARE = document.getElementById("add_fare");
	FARE.addEventListener("click",function(){
		var tab = document.getElementById("tab_fare");
		var row_num = tab.rows.length;

		var FE = document.getElementById("fare_ba");
		FE.rowSpan += 1;

		var newRow = tab.insertRow(row_num-1);
		newRow.insertCell(0).innerHTML = tab.rows[1].cells[0].innerHTML;
		newRow.insertCell(1).innerHTML = tab.rows[1].cells[1].innerHTML;
		
	});
	var DERE = document.getElementById("del_fare");
	DERE.addEventListener("click",function(){
		var tab = document.getElementById("tab_fare");
		var row_num = tab.rows.length;

		FE = document.getElementById("fare_ba");
		FE.rowSpan -= 1;
		tab.deleteRow(1);
		
	});
</script>
<script type="text/javascript">
	var tab = document.getElementById('tab_fare');
	var last_date = document.getElementById('last_date');
	function showmas(mas){
//		alert(mas);
			var rnum = tab_fare.length;
			$.ajax({
				type:"post",
				url:"info_remind_show.php",
				async:true,
				data:{
					mas:mas
				},
				datatype:'string',
				success:function(data){
//					alert(data);
					var str = data.split(',');
					var len = str.length;
//					alert(len);
//					alert(typeof(str));
//					alert(str[0]);
					var fare_name = new Array();
					var fare_value = new Array();
					
					for(var i = 0;i<len;i++){
						var arr = str[i].split('/');
//($row['流程名'].'/'.$row['文件名'].'/'.$row['监控'].'/'.$row['处理人'].'/'.$row['其他'].'/'.$row['剩余天数'].'/'.$row['费用名'].'/'.$row['金额']);
						
						last_date.value = parseInt(arr[5]);
						fare_name[i] = arr[6];
						fare_value[i] = arr[7];
					}
					changedate(last_date.value);
					
					var fare_num = fare_name.length;
//					alert(fare_num);
					
//					DE = document.getElementById("fare_ba");
//					DE.rowSpan -= 1;
//					tab.deleteRow(1);
					for (var y=0;y < fare_num;y++) {
//						alert('ok');
						var nrow = tab.rows.length;
						var newRow = tab.insertRow(nrow-2);
						newRow.insertCell(0).innerHTML = "<input type='text' name='' id='' value='"+fare_name[y]+"' />";
						newRow.insertCell(1).innerHTML = "<input type='text' name='' id='' value='"+fare_value[y]+"' />";
						FE = document.getElementById("fare_ba");
						FE.rowSpan += 1;
//						newRow++;
					}
				}
			});
	}
</script>
<script type="text/javascript" src="js/info_remind.js" ></script>

</body>
</html>