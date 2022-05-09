	<?php require'AHeader.php'; ?>
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

  <title>专案-费用新建</title>

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

</head>
<body class="sticky-header" >
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
			<header class="panel-heading">
				<span>新建费用</span>
				<br /><br />
				<?php 
					$ajh = $_REQUEST['ajh']; 
					require'conn.php';
					$sql = "select 申请人,专利名称,申请日,年费费减比例 from 专利信息 where 案卷号='".$ajh."'";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($rowM = $result->fetch_assoc()){
							$SQR = $rowM['申请人'];
							$ZLMC = $rowM['专利名称'];
							$SQD = $rowM['申请日'];
							$YFCount = $rowM['年费费减比例'];
						}
					}
					switch(strlen($YFCount)){
						case 0:
							$oYFCount = '100';
						break;
						case 5:
							$oYFCount = substr($YFCount,0,2);
						break;
						case 6:
							$oYFCount = '100';
						break;
						default:break;
					}
				?>
				<input type="text" id="ajh" name="ajh" hidden="hidden" value="<?php $ajh = $_GET['ajh'];echo $ajh; ?>" />
				<input type="text" id="oYFCount" name="oYFCount" hidden="hidden" value="<?php echo $oYFCount; ?>" />
				<table>
						<tr>
							<th style="width: 5%;"><sub>案卷号：</sub></th>
							<td style="width: 10%;" ><?php echo $ajh; ?></td>
							<th style="width: 5%;"><sub>申请人：</sub></th>
							<td style="width: 28%;"><?php echo $SQR; ?></td>
							<th style="width: 5%;"><sub>专利名：</sub></th>
							<td style="width: 28%;"><?php echo $ZLMC; ?></td>
							<th style="width: 5%;"><sub>申请日：</sub></th>
							<td style="width: 8%;"><?php echo $SQD; ?></td>
							<th style="width: 5%;"><sub>费减比：</sub></th>
							<td style="width: 10%;"><?php echo $YFCount; ?></td>
						</tr>
				</table>
		  </header>
		  <?php
				require'conn.php';
				$ctype = substr($ajh,7,1);
				if($ctype==1){
					$TypeN = '发明专利';
				}else if($ctype==2){
					$TypeN = '实用新型';
				}else{
					$TypeN = '外观设计';
				}
			?>
			<input id="TypeN" value="<?php echo $TypeN; ?>" hidden="hidden" />
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
				<table class="table table-bordered table-striped table-condensed" id="tab_fare" >
					<tr>
						<th width="25%">费用名</th>
						<th width="25%">金额</th>
						<th width="25%">提醒时间</th>
						<th width="25%">截止时间</th>
					</tr>
					<tr>
						<td>
							<select id="C2" onchange="ShowElseMes(this)">
								<option></option>
							<?php
								switch($ctype){
				          			case'1':
				          				$YCBName="发明专利第";
				          				break;
				          			case'2':
				          				$YCBName="实用新型专利第";
				          				break;
				          			case'3':
				          				$YCBName="外观设计专利第";
				          				break;
				          			default:break;
				          		}
          						//查询费用中的全部费用名
								$sql="select id,专案类型,费用名 from 费用名参看 where 专案类型='".$ctype."' order by convert(费用名 using gbk) asc";
					          		$result = $conn->query($sql);
					          		if($result->num_rows>0){
					          			$ArrMA = array();$x=0;
					          			while($row=$result->fetch_assoc()){
					        ?>
					        	<option><?php echo $row["费用名"]; ?></option>
					        <?php  				
					          			}
					          		}
								$conn->close();
							?>
							</select>
						</td>
						<td><input type="text" name="" id="F2" value="" /></td>
						<td><input style="height: 25px;" type="date" name="" id="" value="" /></td>
						<td><input style="height: 25px;" type="date" name="" id="" value="" /></td>
					</tr>
					<tr>
						<th colspan="2" id="add_fare" ><strong>+</strong></th>
						<th colspan="2" id="del_fare" ><strong>-</strong></th>
					</tr>
				</table>
				
			<div align="center"><input class="btn btn-primary" type="button" value="确定" onclick="tab_save()" /></div>
					
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
		var newRow = tab.insertRow(row_num-1);
		newRow.insertCell(0).innerHTML = tab.rows[1].cells[0].innerHTML;
		newRow.insertCell(1).innerHTML = "<input type='text' id='F"+row_num+"' value='' />";
		newRow.insertCell(2).innerHTML = tab.rows[1].cells[2].innerHTML;
		newRow.insertCell(3).innerHTML = tab.rows[1].cells[3].innerHTML;
		newRow.cells[0].getElementsByTagName('select')[0].id = 'C'+row_num;
	});
	var FAREDEL = document.getElementById("del_fare");
	FAREDEL.addEventListener("click",function(){
		var tab = document.getElementById("tab_fare");
		tab.deleteRow(tab.rows.length-2);
	});
</script>
<script type="text/javascript" >

	ajh = document.getElementById('ajh').value;//创建全局变量
	
//保存新建费用
	function tab_save(){
		var tab = document.getElementById('tab_fare');
		var nrow = tab.rows.length;
		var ncol = tab.rows[0].cells.length;
		var mess = '';
		var YFare='';
		var YearMes = '';
		for(var i=1;i<nrow-1;i++){
			var RemindTime = tab.rows[i].cells[2].getElementsByTagName('input')[0].value;
			var FinalyTime = tab.rows[i].cells[3].getElementsByTagName('input')[0].value;
			if(RemindTime.length==0&&FinalyTime.length!=0){//检查日期是不是正确（即提醒日期小于截止日期）
				alert('请填写截止日期');
				return;
			}else if(RemindTime.length!=0&&FinalyTime.length!=0){
				var d1 = new Date(RemindTime.replace(/\-/g, "\/")); 
				var d2 = new Date(FinalyTime.replace(/\-/g, "\/")); 
				  if(d1>=d2)
				{
				  alert("通知时间不能大于截止时间！"); 
				  return false; 
				}
			}
			//如果费用名为空
			if(tab.rows[i].cells[0].getElementsByTagName('select')[0].value.length==0){
				if(tab.rows[i].cells[1].getElementsByTagName('input')[0].value.length==0){
				//如果金额也为空
				}else{
				//如果金额不为空
					alert('如果不选择费用名，系统将视此条数据为无效数据');
				}
			}
			//如果费用名不为空
			else{
				//如果金额为空
				if(tab.rows[i].cells[1].getElementsByTagName('input')[0].value.length==0||tab.rows[i].cells[3].getElementsByTagName('input')[0].value.length==0){
					alert('请将金额和截止日期填写完整');
					return;
				//如果金额不为空
				}else{
					var StrMes =tab.rows[i].cells[0].getElementsByTagName('select')[0].value;
					if(StrMes.indexOf("年年费")>0&&StrMes.indexOf("第1年年费")<0){
						YFare += tab.rows[i].cells[0].getElementsByTagName('select')[0].value+'/';
						YFare += tab.rows[i].cells[1].getElementsByTagName('input')[0].value+'/';
						YFare += tab.rows[i].cells[2].getElementsByTagName('input')[0].value+'/';
						YFare += tab.rows[i].cells[3].getElementsByTagName('input')[0].value+'/';
						YFare= YFare.substring(0,YFare.length-1);
						YFare+=',';
					}else{
						mess += tab.rows[i].cells[0].getElementsByTagName('select')[0].value+'/';
						mess += tab.rows[i].cells[1].getElementsByTagName('input')[0].value+'/';
						mess += tab.rows[i].cells[2].getElementsByTagName('input')[0].value+'/';
						mess += tab.rows[i].cells[3].getElementsByTagName('input')[0].value+'/';
						mess = mess.substring(0,mess.length-1);
						mess+=',';
					}
				}
			}
		}
		mess = mess.substring(0,mess.length-1);
		YFare = YFare.substring(0,YFare.length-1);
//		alert(StrMes.indexOf("年年费"));
//		alert(YFare);
		
//		数据保存
		$.ajax({
			url:"info_remind_save.php",
			async:true,
			type:"post",
			data:{
				falg:'savedata',
				mess:mess,
				YFare:YFare,
				ajh:ajh
			},
			success:function(data){
//				alert(data);console.log(data);
				if(data==0){
					alert('操作失败，重新确认并联系管理员');
					window.returnValue = "1";
				}else{
					alert('操作成功，成功保存'+data+'条数据');
					window.returnValue = "1";
					window.close();
				}
			}
		});
	}
	//选择费用名，显示其他信息
	function ShowElseMes(obj){
//		TypeN
		var TypeN = document.getElementById("TypeN").value;
		var FareName = obj.value;
		var oYFCount = document.getElementById("oYFCount").value;
		$.ajax({
			type:"get",
			url:"info_remind_save.php",
			async:true,
			data:{
				falg:'CheMes',
				FareName:FareName,
				oYFCount:oYFCount
			},
			success:function(data){
				var td = obj.parentNode;
				var tr = td.parentNode;
				var Input = tr.getElementsByTagName('input');
				Input[0].value = +data;
			},
			error:function(t,e,s){
				alert('error');
			}
		});
	}
	
</script>

</body>
</html>