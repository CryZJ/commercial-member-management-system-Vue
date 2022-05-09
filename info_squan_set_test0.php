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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>


  <title>专案-授权导入</title>

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
		function show(){
			ajh = window.dialogArguments;
//			alert (ajh);
			if(ajh != undefined){
				document.getElementById('ajh').value = ajh;
			}
		}
		window.returnValue="success";
</script>
  
</head>

<body class="sticky-header" onload="show()">

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        	<header class="panel-heading custom-tab">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>只添加费用</a></li>
                <li class="#"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>只导入文件</a></li>
                <li class="#"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>导入文件并读取费用</a></li>
              </ul>
   			</header>
   			<div class="panel-body">
   				<div class="tab-content">
   				<!--只提交费用-->
   				<div class="tab-pane active" id="about-1">
   					<section id="unseen">
			        	<div name="form_2" >
			        		<table class="table table-bordered table-striped table-condensed" id="tab_fare" align="center" >
			        			<thead>
				        			<tr>
				        				<th>名称</th>
				        				<th>内容</th>
				        			</tr>
			        			</thead>
			        			<tbody>
			     						<tr>
			     							<td>登记费</td>
			     							<td><input type="text" id="djf" value="200"  /></td>
			     						</tr>
			     						<tr>
			     							<td>印花费</td>
			     							<td><input type="text" id="yhf" value="5"  /></td>
			     						</tr>
			     						<tr>
			     							<td>年费</td>
			     							<td><input type="text" id="nf" /></td>
			     						</tr>
			        		    <tr>
			        					<td>费用金额总计</td>
			        					<td></td>
			        				</tr>
			        				<tr>
			        					<td>发文时间</td>
			        					<td><?php echo date("Y-m-d"); ?></td>
			        				</tr>
			        				<tr>
			        					<td>缴费截止日期</td>
			        					<td><?php echo date('Y-m-d',strtotime('3days',strtotime(date("Y-m-d"))));  ?></td>
			        				</tr>
			        				<tr>
			        					<td>提醒时间</td>
			        					<td><input type="date"  value="<?php echo date('Y-m-d',strtotime('3days',strtotime(date("Y-m-d")))); ?>" /> </td>
			        				</tr>
			        			</tbody>
			        		</table>
			        		<br />
									<div align="center">
										<input type="button" id="button_save" value="保存" onclick="data_save2()"/>
									</div>
								</div>
   					</section>
          </div>
           
          <!--只提交文件--> 
          <div class="tab-pane active" id="about-2">
   					<section id="unseen">
   							<div>
									<form  action="#" method="post" enctype="multipart/form-data">
									<?php
										//为了第一次actioon后能显示<header>中的案卷号
										$ajh='';
							    	if($_SERVER['REQUEST_METHOD']=='POST'){
							    		$ajh = $_POST['ajh'];
										}
						    	?>
										<table>
											<tr>
												<td>案卷号：</td>
												<td><input type="text" id="ajh" name="ajh" style="border:0px" readonly value="<?php echo $ajh; ?>" /></td>
												<td width="5%" ></td>
												<td><input type="file" id="myFile" name="myFile" /></td>
												<td width="5%" ></td>
												<td><input  type="submit" id="submit_1" value="提交文件"/></td>
											</tr>
										</table>
									</form>
						    </div>
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
//												$clr = $row['处理人'];
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
			//								print_r($data_arr);
			//Array ( [发文日期] => 2015-05-25 [办理登记缴费截止日期] => 2015-08-10 [费用] => Array ( [登记费] => 200.0 [年费] => 90.0 [印花费] => 5.0 ) [应缴费用] => 295.0 [缴纳年费年度] => 1 [减缓标记] => 85% [通知书名称] => 办理登记手续通知书 )
										
						    ?>
					        	<div class="panel-body">  
					        	<form name="form_3" action="#" method="post" enctype="multipart/form-data">
					        		<input type="text" id="ajh2" name="ajh" hidden  value="<?php echo $ajh; ?>" />
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
											<div align="center">
												<input type="button" id="button_save" value="保存" onclick="data_save4()"/>
											</div>
										</form>
									</div>
						    <?php
									}else {
								?>
						    	
								<?php 
									}
								?>
   					</section>
          </div>
          
          <!--提交文件并读取费用--> 
          <div class="tab-pane active" id="about-3">
   					<section id="unseen">
				        
						</section>
          </div>
          
          </div>
          </div>
			  </section>
				</div>
        </div>
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
//	document.getElementById('ajh').value = "2013206623702";

	var djf = document.getElementById("djf");
	var yhf = document.getElementById("yhf");
	var nf = document.getElementById("nf");
	var tab_fare = document.getElementById("tab_fare");
	
	var ajh_num = document.getElementById("ajh").value;
	if(ajh_num != undefined){
		flag = ajh_num.substring(4,5);
		if(flag == "1"){
			nf.value = 900;
		}	else {
			nf.value = 600;
		}
		tab_fare.rows[4].cells[1].innerHTML = parseFloat(nf.value) + parseFloat(djf.value) + parseFloat(yhf.value);
	}else{
		alert("获取案卷号失败或不需要保存费用！");
	}
	
	
</script>

</body>
</html>