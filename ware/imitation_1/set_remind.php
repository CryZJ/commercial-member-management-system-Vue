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

  <title>个案管理页面</title>


  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />

<script type="text/javascript">
		
		ajh = window.dialogArguments;
			//alert (ajh);
		document.getElementById('ajh').value = ajh;
		
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
			firsttime = document.getElementById('startime').value
			//lasttime = document.getElementById('endtime').value
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
		

</script>

<script type="text/javascript">
	function remind(){
		alert("提交后无法修改，是否提交？");
	}
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
				<span>监控时间自定义</span>
		    </header>
	        <div class="panel-body">
	        
				<form action="#" method="post">
					<table><?php $nowtime = date('Y-m-d'); ?>
						<tr>
							<td>案卷号：</td>
							<td><input type="text" name="ajh" id="ajh"  readonly /></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>开始时间：</td>
							<td><input type="date" name="startime" id="startime" value="<?php echo $nowtime ; ?>" /></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>截止时间：</td>
							<td><input type="date" name="endtime" id="endtime" value="" onchange="showday(this.value)" /></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>监控天数：</td>
							<td><input type="text" name="day" id="day" value="" onkeyup="changedate(this.value)" list="timeus" /></td>
							<datalist id="timeus">
								<option value="30"></option>
								<option value="60"></option>
								<option value="90"></option>
								<option value="120"></option>
							</datalist>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>监控原因：</td>
							<td><input type="text" name="zt" id="" value="" list="reason" />
								<datalist id="reason">
									<option value="提交">提交</option>
									<option value="受理">受理</option>
									<option value="初审">初审</option>
									<option value="实审">实审</option>
									<option value="授权">授权</option>
								</datalist>
							</td>
						</tr>
					</table>
					<br />
					<div align="center"><input type="submit" value="确定" onclick="remind()" /></div>
					
				</form>
				<?php
					if($_SERVER['REQUEST_METHOD']=='POST'){
						$ajh = $_POST['ajh'];
						$startime = $_POST['startime'];
						$endtime = $_POST['endtime'];
						$day = $_POST['day'];
						$zt = $_POST['zt'];
						//echo $ajh.$startime.$endtime.$day;
						require('../../conn.php');
						$sql=" update 专利信息  set 开始时间='".$startime."', 截止时间='".$endtime."' , 剩余天数='".$day."' where 案卷号='".$ajh."'";
						if($zt != ''){
							$sql=" update 专利信息  set 开始时间='".$startime."', 截止时间='".$endtime."' , 剩余天数='".$day."', 状态='".$zt."'  where 案卷号='".$ajh."'";
						}
						
						$result = $conn->query($sql);
						$conn->close();
						if($result == 1){
							echo "<script type=\"text/javascript\"> alert(\"设置成功！\");window.close(); </script>";
						}
					}	
				?>
	            
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
<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

</body>
</html>

