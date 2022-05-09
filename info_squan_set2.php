<?php
	require("AHeader.php");
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

  <title>专案-授权一步导入</title>

  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">


  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
<script type="text/javascript">
//		function show(){
//			ajh = window.dialogArguments;
////			alert (ajh);
//			if(ajh != undefined){
//				document.getElementById('ajh').value = ajh;
//			}
//		}
//		window.returnValue="success";
</script>
  
</head>

<body class="sticky-header" >

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
	        <header class="panel-heading">
						授权公告
						<br /><br />
						<form  action="#" method="post" enctype="multipart/form-data">
						<?php
							//为了第一次actioon后能显示<header>中的案卷号
							$ajh='';
							$dis_flag = "block";
				    	if($_SERVER['REQUEST_METHOD']=='POST'){
				    		$ajh = $_POST['ajh'];
								$dis_flag = "none";
							}else{
								$ajh = $_GET['ajh'];
							}
			    	?>
							<table>
								<tr>
									<td>案卷号：</td>
									<td><input type="text" id="ajh" name="ajh" style="border:0px" readonly value="<?php echo $ajh; ?>" /></td>
									<td width="5%" ></td>
									<td><input type="file" style="display: <?php echo $dis_flag; ?>;" id="myFile" name="myFile" /></td>
									<td width="5%" ></td>
									<td><input  type="submit" hidden="hidden" id="submit_1" value="提交文件"/></td>
								</tr>
							</table>
						</form>
			    </header>
			    <?php
			    	if($_SERVER['REQUEST_METHOD']=='POST'){
			    		$ajh = $_POST['ajh'];//为了下次action时能把下面的表单中的案卷号传过去
			    		//获取在次案卷号以保存的文件数，避免文件名重复
			    		$id_num='';
			    		require('conn.php');
							$sql = "select count(id) as 数量 ,处理人 from 案卷流程及文档 where 案卷号='$ajh'";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row = $result->fetch_assoc()){
									$id_num = $row['数量']+1;
//									$clr = $row['处理人'];
								}
							}
			    		
			    		/*保存form_1传来的受理书文件*/
			    		/*获取传过来的文件保存后的路径*/
							require_once 'upload_func.php';//保存文件的函数
							$fileInfo=$_FILES['myFile'];
							$upload_path = "filesave/".$ajh;
							$path = uploadFile($fileInfo,$upload_path,'209715200',$id_num);//保存文件到服务器
							$path = iconv('gb2312', 'utf-8', $path);//改变编码为：utf-8
//						echo $path;
							
								/*获取zip文件里的xml文件的信息*/
								require_once "readxml_upload_fun_00.php";
								$data_arr = impower($path);
								
								/*把文件路径保存到数据库中*/
							$now_time = date("Y-m-d H:i:s");//时间，处理人暂用上面$clr代替
							$sql2 = "insert into 案卷流程及文档 (案卷号,流程,处理人,时间,文件路径,通知书名称) values( ";
							$sql2 .= "'$ajh','授权通知','$name','$now_time','$path','".$data_arr['通知书名称']."')";
//							echo $sql2;
							$result2 = $conn->query($sql2);
							$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','上传授权文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($path,PATHINFO_BASENAME)."”文件')";
							$conn->query($sql);
//								print_r($data_arr);
//Array ( [发文日期] => 2015-05-25 [办理登记缴费截止日期] => 2015-08-10 [费用] => Array ( [登记费] => 200.0 [年费] => 90.0 [印花费] => 5.0 ) [应缴费用] => 295.0 [缴纳年费年度] => 1 [减缓标记] => 85% [通知书名称] => 办理登记手续通知书 )
			    ?>
			    
			    				<!--点击“提交文件”后显示的html页面-->	
	        	<div class="panel-body">  
		        	<form name="form_2" action="#" method="post" enctype="multipart/form-data">
		        		<input type="text" id="ajh" name="ajh" hidden  value="<?php echo $ajh; ?>" />
		        		<h1 align="center"><?php echo $data_arr['通知书名称']; ?></h1>
		        		<table class="table table-bordered table-striped table-condensed" id="tab_base" >
		        			<tr>
		        				<th>年费首年度</th>
		        				<th>费减比例</th>
				   					<th>授权公告日</th>
		        			</tr>
		        			<tr align="center" >
		        				<td><input type="text" id="nfsnd"  value="<?php echo $data_arr['缴纳年费年度']; ?>"/> </td>
		        				<td><input type="text" id="fjb"  value="<?php echo $data_arr['减缓标记']; ?>"/> </td>
		        				<td><input type="text" id="sqggr"  value="<?php echo $data_arr['发文日期']; ?>"/> </td>
		        			</tr>
		        		</table>
		        		<br /><br />
		        		<!--费用表-->
		        		<table class="table table-bordered table-striped table-condensed" id="tab_fare" align="center" >
		        			<thead>
			        			<tr>
			        				<th>名称</th>
			        				<th>内容</th>
			        			</tr>
		        			</thead>
		        			<tbody>
		      <?php 
		      				$flag_free = "";
		        			foreach($data_arr['费用'] as $key => $value){
		        				$flag_free .= $key;
		      ?>
			        			<tr>
			        				<td><?php echo $key; ?></td>
			        				<td>
			        					<input type="text" value="<?php echo $value; ?>" />
			        					<?php
			        						$sql = "SELECT 金额 FROM 专案需交费用 WHERE 案卷号='".$ajh."' AND 费用名称='".$key."' AND 状态<>9 ";
													$result = $conn->query($sql);
													$remand_msg = "";
													if($result->num_rows>0){
														while($row=$result->fetch_assoc()){
															$fee_last = $row['金额'];
															$remand_msg .= "已存在费用，金额为：".$fee_last; 
														}
													}
													echo $remand_msg;
			        					?>
			        				</td>
			        			</tr>
		      <?php		
		        			}
					?>
										<tr>
		        					<td>费用金额总计</td>
		        					<td><input type="text" value="<?php echo $data_arr['应缴费用']; ?>" /></td>
		        				</tr>
		        				<tr>
		        					<td>发文时间</td>
		        					<td id="fwr"><?php echo $data_arr['发文日期']; ?></td>
		        				</tr>
		        				<tr>
		        					<td>缴费截止日期</td>
		        					<td id="jfjzrq"><?php echo $data_arr['办理登记缴费截止日期']; ?></td>
		        				</tr>
		        				<tr>
		        					<td>提醒时间</td>
		        					<td><input id="txsj" type="date" style="height: 25px;"  value="<?php echo date('Y-m-d',strtotime('-1months',strtotime($data_arr['办理登记缴费截止日期']))); ?>" /> </td>
		        				</tr>
		        			</tbody>
		        		</table>
		        		<br /><br />
								<div align="center">
									<input type="button" id="button_save" value="保存" onclick="data_save5()"/>
								</div>
							</form>
						</div>
					<?php
						} 
					?>

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

<!--easy pie chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<script src="js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<script src="js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="js/iCheck/jquery.icheck.js"></script>
<script src="js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="js/flot-chart/jquery.flot.selection.js"></script>
<script src="js/flot-chart/jquery.flot.stack.js"></script>
<script src="js/flot-chart/jquery.flot.time.js"></script>
<script src="js/main-chart.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script src="js/info_sqing_set.js"></script>

<script type="text/javascript">
	//检测上传文件的案卷号是否与案件的一致
	var myFile = document.getElementById("myFile");
	var submit_1 = document.getElementById("submit_1");
	myFile.addEventListener("change",function(){
//		alert(myFile.value);
		var ajh_info = document.getElementById('ajh').value;
		var file_name = getFileName(myFile.value);
		var file_ajh = file_name.substr(0,10);
//			alert(file_ajh + "///" + ajh_info);
		if(file_ajh == ajh_info){
			submit_1.hidden = false;
		}else{
			alert("上传文件名称中的案卷号与此案件的案卷号不一致！请检查是否上传错文件或修改正确的 案卷号！");
			submit_1.hidden = "hidden";
		}
	});	
	function getFileName(path){
		var pos1 = path.lastIndexOf('/');
		var pos2 = path.lastIndexOf('\\');
		var pos  = Math.max(pos1, pos2)
		if( pos<0 )
		return path;
		else
		return path.substring(pos+1);
	}
	
</script>

</body>
</html>