<?php 
	require'../../AHeader.php'; 
	require'../../conn.php';
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

  	<title>专案-年费替换</title>

  	<!--common-->
  	<link href="../../css/style.css" rel="stylesheet">
  	<link href="../../css/style-responsive.css" rel="stylesheet">

  	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!--[if lt IE 9]>
  	<script src="js/html5shiv.js"></script>
  	<script src="js/respond.min.js"></script>
  	<![endif]-->
  	
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
					<span>替换已有年费记录或修改申请日、首年度、费减比</span>
		    		<p style="color: #B6B6B6;font-size: 10px;">注意仅保存已存在的年费记录（待通知、代收费、待缴费），待收据的不进行保存，如果没有年费记录也不会及进行保存只保存基本信息（申请日等），如果要新建年费记录请在费用明细中新建费用再来这里矫正</p>    	
			  	</header>
			  	<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
			  		<?php
		    			$ajh = isset($_GET['ajh']) ? $_GET['ajh'] : "无";
						$tabflag = isset($_GET["tabflag"]) ? $_GET["tabflag"] : "";
						
						//需要信息
						$datamsg = array(
							"tabflag"=>$tabflag,
							"caseNumber"=>$ajh,
							"caseType"=>"",
							"applicationDate"=>"",
							"reductionRatio"=>"",
							"firstYear"=>""
						);
						switch($tabflag){
							case "zlxx" ://表【专利信息】
								$sql = "SELECT 类型,申请日,年费费减比例,年费首年度 FROM `专利信息` WHERE 案卷号='".$ajh."'";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_row()){
										$datamsg["caseType"] = $row[0];
										$datamsg["applicationDate"] = $row[1];
										$datamsg["reductionRatio"] = $row[2];
										$datamsg["firstYear"] = $row[3];
									}
								}
								break;
							case "zanf" ://表【专案_年费】
								$sql = "SELECT 类型,申请日,费减比例,首年度 FROM `专案_年费` WHERE 案卷号='".$ajh."'";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_row()){
										$datamsg["caseType"] = $row[0];
										$datamsg["applicationDate"] = $row[1];
										$datamsg["reductionRatio"] = $row[2];
										$datamsg["firstYear"] = $row[3];
									}
								}
								break;
							case "zafsd" ://表【专案_复审等】
								$sql = "SELECT 类型,申请日,费减比例 FROM `专案_复审等` WHERE 案卷号='".$ajh."'";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row = $result->fetch_row()){
										$datamsg["caseType"] = $row[0];
										$datamsg["applicationDate"] = $row[1];
										$datamsg["reductionRatio"] = $row[2];
										$datamsg["firstYear"] = "1";
									}
								}
								break;
							default :
								exit("没有对应的信息，无法操作");
						}
						
		    		?>
			  		<!--隐藏的信息-->
			  		<div id="hiddendata">
			  			<!--数据表的标志-->
			  			<input hidden="hidden" type="text" value="<?php echo $datamsg["tabflag"]; ?>" />
			  			<!--案件的类型-->
			  			<input hidden="hidden" type="text" value="<?php echo $datamsg["caseType"]; ?>" />
			  		</div>
			  		
			  		<!--需修改的信息-->
			  		<div class="form-inline" id="changeform">
			  			<div class="form-group">
			  				<label>案卷号：</label>
			  				<!--<input type="text" style="border: none;" readonly="readonly" value="<?php echo $ajh; ?>" />-->
			  				<input type="text" class="form-control no-border disabled" readonly="readonly" value="<?php echo $datamsg["caseNumber"]; ?>" />
			  			</div>
			  			&nbsp;&nbsp;
			  			<div class="form-group">
			  				<label>申请日：</label>
			  				<input class="form-control" type="date" value="<?php echo $datamsg["applicationDate"]; ?>" />
			  			</div>
			  			&nbsp;&nbsp;
			  			<div class="form-group">
			  				<label>年费费减比例：</label>
			  				<select class="form-control">
			  					<option><?php echo $datamsg["reductionRatio"]; ?></option>
			  					<option>100%</option>
			  					<option>85%</option>
			  					<option>70%</option>
			  				</select>
			  			</div>
			  			&nbsp;&nbsp;
			  			<div class="form-group">
			  				<label>年费首年度：</label>
			  				<?php
			  					$zhong_sql="SELECT id,年度,状态 FROM `专案_年费记录` WHERE `案卷号`='{$ajh}' AND (状态='0' OR 状态='8' OR 状态='1' OR 状态='4') ORDER BY `年度`+0 LIMIT 1;";
			  					$query=mysqli_query($conn,$zhong_sql);
			  					$row=(int)mysqli_fetch_assoc($query)['年度']; 
//			  					var_dump($row);
//								$row=5;
//								echo $datamsg['firstYear'];
								echo '（最小首年度'.($row-1).')';
			  					?>
			  				<?php if(isset($datamsg['firstYear'])): ?>
			  				
			  					<input type="hidden"  id="data" value="<?php echo $row; ?>" />		
			  				<input class="form-control" type="number" value="<?php echo $datamsg["firstYear"]; ?>" />
			  				<!--<input class="form-control" type="number" value="<?php echo $datamsg["firstYear"] <= $row ?  $row : $datamsg['firstYear'] ; ?>" />-->
			  				<?php endif ?>

			  			</div>
			  			&nbsp;&nbsp;&nbsp;&nbsp;
			  			<button class="btn btn-primary" onclick="CreateAnnualFee(this)">生成年费</button>
			  		</div>
			  		<br /><br />
			  		
			  		<!--生成的年费列表-->
		  			<table class="table table-bordered table-striped table-condensed">
		  				<thead>
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
								<th>操作</th>
							</tr>
		  				</thead>
		  				<tbody id="tab_Fare">
		  					
		  				</tbody>
					</table>
					<div id="save_btn" align="center"></div>
				</div>
		 	</section>
	      	</div>
        </div>
        </div>
        <!--body wrapper end-->
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

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--页面响应-->
<script type="text/javascript">
	//删除行
	function DeleteRow(btn){
		$(btn).parent().parent().remove();
	}
	//生成年费
	function CreateAnnualFee(e){
		//获取生成年费的要素：类型、申请日、费减比、首年度
		var senddata = {
			flag : "CreateAnnualFeeList",
			caseType : $("#hiddendata input:eq(1)").val(),
			applicationDate : $("#changeform input[type='date']").val(),
			reductionRatio : $("#changeform select:eq(0)").val(),
			firstYear : $("#changeform input[type='number']").val()
		}
		var mess=$("#data").val();
		mess = parseInt(mess);
		if((mess-2)>=parseInt(senddata.firstYear)){
			alert('所选择的年度已经未在未过期的年费服务,请重新选择');
			return false;
		}
//		console.log(typeof mess)
//			console.dir(parseInt(mess-1));
//		console.log(senddata);
		//异步返回年费信息并显示
		$.ajax({
			type:"POST",
			url:"resetannualfee_ajax.php",
			data:senddata,
			dataType:"json",
			success:function(data){
				if(data.state){
					var temphtml = "";
					for($index in data.data){
						temphtml += '<tr>';
						temphtml += '<td>'+data.data[$index]["年度"]+'</td>';//年度
						temphtml += '<td>'+data.data[$index]["金额"]+'</td>';//金额
						temphtml += '<td>'+data.data[$index]["截止日期"]+'</td>';//截止时间
						temphtml += '<td>'+data.data[$index]["提醒日期"]+'</td>';//提醒时间
						temphtml += '<td>'+data.data[$index]["滞纳金"][0]+'</td>';//1
						temphtml += '<td>'+data.data[$index]["滞纳金"][1]+'</td>';//2
						temphtml += '<td>'+data.data[$index]["滞纳金"][2]+'</td>';//3
						temphtml += '<td>'+data.data[$index]["滞纳金"][3]+'</td>';//4
						temphtml += '<td>'+data.data[$index]["滞纳金"][4]+'</td>';//5
						temphtml += '<td><button class="btn-danger" onclick="DeleteRow(this)">删除</button></td>';
						temphtml += '</tr>';
					}
//					$("#tab_Fare").html("");
					$("#tab_Fare").html(temphtml);
					$("#save_btn").html('<button class="btn btn-success" onclick="SaveData(this)">保存</button>');
				}
			},
			error:function(x,s,t){
				alert("生成年费失败");
				console.log("ajax error!"+s+": "+t);
			}
		});
	}
	
	//保存信息
	function SaveData(btn){
		//按钮只能点击一次
		$(btn).attr("onclick","");
		$(btn).html("处理中......");
		$("#changeform button").addClass("disabled");
		
		//发送数据
		var senddata = {
			flag : "SaveData",
			caseNumber : $("#changeform input[type='text']").val(),
			tabflag : $("#hiddendata input:eq(0)").val(),
			applicationDate : $("#changeform input[type='date']").val(),
			reductionRatio : $("#changeform select:eq(0)").val(),
			firstYear : $("#changeform input[type='number']").val(),
			annualfee : new Array()
		};
		//循环获取年费信息
		$("#tab_Fare tr").each(function(){
			var tempdata = {
				"年度" : $(this).children("td:eq(0)").html(),
				"金额" : $(this).children("td:eq(1)").html(),
				"截止日期" : $(this).children("td:eq(2)").html(),
				"提醒日期" : $(this).children("td:eq(3)").html(),
				"滞纳金" : [
					$(this).children("td:eq(4)").html(),
					$(this).children("td:eq(5)").html(),
					$(this).children("td:eq(6)").html(),
					$(this).children("td:eq(7)").html(),
					$(this).children("td:eq(8)").html()
				],
			};
			senddata.annualfee.push(tempdata);
		});
		$.ajax({
			type:"POST",
			url:"resetannualfee_ajax.php",
			data:senddata,
			dataType:"json",
			success:function(data){
//				console.log(data);
				alert(data.message);
				//处理完毕
				$(btn).attr("onclick","window.close()");
				$(btn).html("关闭");
			},
			error:function(x,s,t){
				alert("生成年费失败");
				console.log("ajax error!"+s+": "+t);
			}
		});
	}
	
</script>

</body>
</html>