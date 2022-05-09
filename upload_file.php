<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>新建流程</title>

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
			var obj = window.dialogArguments;
			document.getElementById('ajh').value = obj.ajh;
		}
	</script>
  
</head>

<body class="sticky-header" onload="show()">

<section>

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        	<header class="panel-heading">
						新建流程
		    </header>
        	<div class="panel-body">  
	        	<form action="#" method="post" enctype="multipart/form-data">
	        		<table>
	        			<tr>
	        				<td><input type="text" name="ajh" id="ajh" hidden /></td>
	        			</tr>
	        			<tr>
	        				<td><label for="lc">流程：</label></td>
	        				<td><input name="lc" list="namei" />
	        		<datalist id="namei">
						<option value="创建案件"></option>
						<option value="上报文件"></option>
						<option value="上传回执"></option>
						<option value="授权通知"></option>
					</datalist></td>
	        			</tr>
	        			<tr>
	        				<td>&nbsp;</td>
	        			</tr>
	        			<tr>
	        				<td><label for="time">时间：</label></td>
	        				<td><input type="date" name="time" id="time" value="<?php echo date("Y-m-d"); ?>" readonly /></td>
	        			</tr>
	        			<tr>
	        				<td>&nbsp;</td>
	        			</tr>
	        			<tr>
	        				<td><label for="clr">处理人：</label></td>
	        				<td><input type="text" id="chuliren" /> </td>
	        				<!--<td>默认为登录账号，或者代理人</td>-->
	        			</tr>
	        			<tr>
	        				<td>&nbsp;</td>
	        			</tr>
	        			<tr>
	        				<td><label for="myfile" >上传文件：</label></td>
	        				<td><input type="file" name="myfile" id="myfile" value="" /></td>
	        			</tr>
	        			
	        		</table><br />
					<div align="center">
						<input type="reset" value="重置" />
						<input type="submit" value="保存"/>
					</div>
				</form>
			</div>
			<?php 
				//获取POST传过来的数据
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$ajh = $_POST['ajh'];
					//lc,time,clr
					$upload = array($_POST['lc'],$_POST['time'],$_POST['clr']);
				
					/***保存文件并获取文件路径***/
					require('conn.php');
					$sql = "select 文件路径 from 专利信息  where 案卷号='".$ajh."'";
					$result = $conn->query($sql);
					if($result->num_rows >0){
						while($row = $result->fetch_assoc()){
							$path = $row['文件路径'];
							$arr_path = explode("/",$path);
							$new_path = $arr_path[0]."/".$arr_path[1];//格式：filesave/案卷号
						}
					}
					include_once 'upload.func.php';//加载函数
					$fileInfo=$_FILES['myfile'];//获取文件数组第一维名称
					//创建文件储存路径
					$time=date("Y-m-d h-i-sa");
					$dest = $new_path."/".$time;
					
					$allowExt=array('jpeg','jpg','png','gif','html','txt','zip','rar');//设置上传文件类型
					$new_tmp=uploadFile($fileInfo,$dest,false,$allowExt,'10485760');//调用函数并返回新的文件路径
					//echo $new_tmp;//测试
					
					$sql2  = "insert into 案卷流程及文档(案卷号,流程,时间,处理人,文件路径) values(";
					$sql2 .= " '".$ajh."','".$upload[0]."','".$upload[1]."','".$upload[2]."','".$new_tmp."' )";
					//in_array('',array) 判断数组中是否有空的，有为1
					if(in_array('',$upload)!=1){
						//echo $sql2;
						$result2 = $conn->query($sql2);
						if($result2==1){
							echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
						}else{
							echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
						}
					}
					
					$conn->close();
					
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

</body>

</html>









<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		
	</head>
	<body >
		<div align="center">
			
	</body>
</html>
