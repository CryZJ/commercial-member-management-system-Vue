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
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>


  <title>专案-受理导入</title>

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

<body class="sticky-header">

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
	        <header class="panel-heading">
	        	<span class="tools pull-right">
				    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
				    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
				    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
				</span>
						受理通知书导入
						<br /><br />
						<form  action="#" method="post" enctype="multipart/form-data">
						<?php
							//为了第一次actioon后能显示<header>中的案卷号
							$ajh='';
				    	if($_SERVER['REQUEST_METHOD']=='POST'){
				    		$ajh = $_POST['ajh'];
							}else{
								$ajh = $_GET['ajh'];
							}
							$flag_hid = "block";
							if($_SERVER['REQUEST_METHOD']=='POST'){
				    		$flag_hid = "none";
							}
			    	?>
							<table>
								<tr>
									<td>案卷号：</td>
									<td><input type="text" id="ajh" name="ajh" style="border:0px" readonly value="<?php echo $ajh; ?>" /></td>
									<td width="5%" ></td>
									<td><input type="file" style="display: <?php echo $flag_hid; ?>;" id="myFile" name="myFile" /></td>
									<td width="5%" ></td>
									<td><input  type="submit" id="submit_1" hidden="hidden" value="提交文件"/></td>
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
							
//							echo $sql2;
							
//							if($result2){
								/*获取zip文件里的xml文件的信息*/
								require_once "readxml_upload_fun_00.php";
								$data_arr = acceptor_readxml($path);
								
								/*把文件路径保存到数据库中*/
							$now_time = date("Y-m-d H:i:s");//时间，处理人暂用上面$clr代替
							$sql2 = "insert into 案卷流程及文档 (案卷号,流程,处理人,时间,文件路径,通知书名称) values( ";
							$sql2 .= "'$ajh','受理导入','$name','$now_time','$path','".$data_arr['通知书名称']."')";
							$result2 = $conn->query($sql2);
							//插入记录
							$sql_jl = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','上传受理文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($path,PATHINFO_BASENAME)."”文件')";
							$conn->query($sql_jl);
//								print_r($data_arr);
//									Array ( [专利名称] => 一种LED吸顶灯 [申请号] => 2013206623702 [申请日] => 2013-10-25 [通知书名称] => 专利申请受理通知书,费用减缓审批通知书 [发文日期] => 2013-10-26 [缴费截止日期] => 2013-12-25 [费用] => Array ( [优先权要求费] => 0 [申请费] => 75 [说明书附加费] => 0 ) [费用金额总计] => 75 [年费费减比例] => 85％ [复审费减比例] => 80％ )
			    ?>
			    				<!--点击“提交文件”后显示的html页面-->	
	        	<div class="panel-body">  
		        	<form name="form_2" action="#" method="post" enctype="multipart/form-data">
		        		<input type="text" id="ajh" name="ajh" hidden  value="<?php echo $ajh; ?>" />
		        		<h1 align="center"><?php echo $data_arr['通知书名称']; ?></h1>
		        		<table class="table table-bordered table-striped table-condensed" id="tab_base" >
		        			<tr>
		        				<th colspan="2" >费减比例</th>
		        				<th rowspan="2" >申请日</th>
		        				<th rowspan="2" >申请号</th>
		        			</tr>
		        			<tr>
		        				<th style="word-break: break-all;width: 250px;">申请费&年费</th>
		        				<th>复审费</th>
		        			</tr>
		        			<tr align="center" >
		        				<td>
		        					<input type="text" id="nfj"  value="<?php echo $data_arr['年费费减比例']; ?>"/>
		        					<br />
		        					<strong style="font-size: 10px;">
		        					<?php
		        						$sql = "SELECT 申请人id FROM 专利信息 WHERE 案卷号='".$ajh."'";
												$result = $conn->query($sql);
												$sqrid_str = "";
												if($result->num_rows>0){
													while($row = $result->fetch_assoc()){
														$sqrid_str = $row['申请人id'];
													}
												}
												if($sqrid_str != ""){
													$sqrid_arr = "";
													if(strpos($sqrid_str, ",")){
														$sqrid_arr = explode(",", $sqrid_str);
													}else{
														$sqrid_arr[0] = $sqrid_str;
													}
													$msg = "与以下的申请人的费减比不同：\n";
													foreach($sqrid_arr as $ky => $sqrid){
														$sql = "SELECT 申请人,费减比例 FROM 申请人 WHERE id='".$sqrid."'";
														$result=$conn->query($sql);
														if($result->num_rows>0){
															while($row = $result->fetch_assoc()){
																if($row['费减比例'] != $data_arr['年费费减比例']){
																	$msg .= $row['申请人']."：".$row['费减比例'].";";
																}
															}
														}
													}
													echo $msg;
												}
		        					?>
		        					</strong> 
		        				</td>
		        				<td><input type="text" id="ffj"  value="<?php echo $data_arr['复审费减比例']; ?>"/> </td>
		        				<td><input type="text" id="sqr"  value="<?php echo $data_arr['申请日']; ?>"/> </td>
		        				<td><input type="text" id="sqh"  value="<?php echo $data_arr['申请号']; ?>"/> </td>
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
		        			foreach($data_arr['费用'] as $key => $value){
		        		?>
			        			<tr>
			        				<td><?php echo $key; ?></td>
			        				<td>
			        					<input type="text" value="<?php echo $value; ?>" />
			        					<?php
			        						$sql = "SELECT id,费用名称,金额 FROM 专案需交费用 WHERE 案卷号='".$ajh."' AND 费用名称='".$key."' ";
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
		        					<td>xml的费用金额总计</td>
		        					<td><?php echo $data_arr['费用金额总计'] ?></td>
		        				</tr>
		        				<tr>
		        					<td>发文时间</td>
		        					<td><?php echo $data_arr['发文日期'] ?></td>
		        				</tr>
		        				<tr>
		        					<td>缴费截止日期</td>
		        					<td><?php echo $data_arr['缴费截止日期']; ?></td>
		        				</tr>
		        				<tr>
		        					<td>提醒时间</td>
		        					<td><input type="date"  value="<?php echo date('Y-m-d',strtotime('-1months',strtotime($data_arr['缴费截止日期']))); ?>"/> </td>
		        				</tr>
		        			</tbody>
		        		</table>
		        		<br /><br />
								<div align="center">
									<input type="button" id="button_save" value="保存" onclick="data_save()"/>
								</div>
							</form>
						</div>
					<?php
						}else{
					?>
							<!--未点击“提交文件”时显示的页面-->
						<div class="panel-body">
		        		<table class="table table-bordered table-striped table-condensed" id="tab_base" >
		        			<tr>
		        				<th colspan="2" >费减比例</th>
		        				<th rowspan="2" >申请日</th>
		        				<th rowspan="2" >申请号</th>
		        			</tr>
		        			<tr>
		        				<th>申请费&年费</th>
		        				<th>复审费</th>
		        			</tr>
		        			<tr align="center" >
		        				<td><input type="text" id="" name="" /> </td>
		        				<td><input type="text" id="" name="" /> </td>
		        				<td><input type="date" id="" name="" /> </td>
		        				<td><input type="text" id="" name="" /> </td>
		        			</tr>
		        		</table>
		        		<br /><br />
		        		<table class="table table-bordered table-striped table-condensed" id="tab_fare" align="center" >
		        			<tr>
		        				<th width="50%" >名称</th>
		        				<th>内容</th>
		        			</tr>
		        			<tr>
		        				<th>申请费</th>
		        				<td> </td>
		        			</tr>
		        			<tr>
		        				<th>费用金额</th>
		        				<td> </td>
		        			</tr>
		        			<tr>
		        				<th>发文时间</th>
		        				<td> </td>
		        			</tr>
		        			<tr>
		        				<th>缴费截止时间</th>
		        				<td> </td>
		        			</tr>
		        		</table>
		        		<br /><br />
								<div align="center">
									<input type="reset" value="重置" />
									<input type="submit" value="保存"/>
								</div>
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
