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
		function show_msg(){
			ajh = window.dialogArguments;
			//alert (ajh);
			document.getElementById('ajh').value = ajh;
		}
</script>

<script>
	function remind(){
		alert("是否上传文件？");
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
				<span>回执文件上传</span>
		    </header>

			<form action="#" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td><td>&nbsp;</td>
						<td><label>案卷号：</label></td>
						<td><input type="text" name="ajh" id="ajh"  readonly /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td><td>&nbsp;</td>
						<td><label>文件：</label></td>
						<td><input type="file" name="myfile" id="myfile" value=""/></td>
					</tr>
				</table>
				<div align="center">
					<input type="submit" value="保存" onclick="remind()" />
				</div>
				
				<br />
			</form>
		<?php
		//判断是否有POST传输
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//print_r($_FILES);
				$fileInfo=$_FILES['myfile'];//把文件第一维名赋给$fileInfo，
				$part=$fileInfo['tmp_name'];
				
				$ajh = $_POST['ajh'];//获取案卷号
				require_once "../../readxml-upload-fun.php";//连接函数readxml()
				$arr = readxml($part);//获取函数返回数组[0]申请号,[1]申请日,[2]费减比例
				$sqh = $arr[0];
				$sqr = $arr[1];
				$fjbl = $arr[2];
//				echo $sqh."\n".$sqr."\n".$fjbl;
				
				
				
				require('../../conn.php');
				
				$sql = "update 专利信息 set 申请号='".$sqh."',申请日='".$sqr."',费减比例='".$fjbl."' where 案卷号='".$ajh."'";
				//echo $sql;
				if(in_array('',$arr)!=1){
					$result = $conn->query($sql);
				}else{
					echo "<script type=\"text/javascript\">alert(\"添加失败!\");window.close();self.opener.location.reload();</script>";
				}
				
				$conn->close();
				if($result == 1){
					echo "<script type=\"text/javascript\">alert(\"添加成功!\");window.close();self.opener.location.reload();</script>";
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