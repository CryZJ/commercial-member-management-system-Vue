<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>代理人选择</title>
  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>


  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	底单上传
            </header>
            <div class="panel-body">
            	<?php 
            			$my_flag = $_GET['my_flag'];
									$my_id = $_GET['id'];
									if($my_flag == 'upload'){	
            	?>
            	<div id="SA">
                <form method="post" action="exdelmas_save.php" enctype="multipart/form-data">
                	<input name="flag" type="text" hidden="hidden" value="file_save" />
                	<input type="text" name="self_id" hidden="hidden" value="<?php echo $my_id; ?>" />
                	<table>
										<tr>
											<th><input type="file" id="pic" name="myfile" value="请选择文件" onchange="show_receipt(this)" /></th>
											<th><button type="submit" id="showbtn" hidden="hidden">保存</button></th>
										</tr>
                	</table>
                	<br />
                	<div id="showpic"></div>
                	<br />
                </form>	
              </div>
              <?php
									}else{
										require("../../conn.php");
										$sql = "SELECT 底单地址  FROM 快递信息  WHERE id='".$my_id."'";
										$path = '';
										$result = $conn->query($sql);
										if($result->num_rows>0){
											while($row = $result->fetch_assoc()){
												$path = $row['底单地址'];
											}
										}
              ?>
               		<div id="check">
                		<img src="<?php echo $path; ?>" height="300px" width="400px" />
              		</div>
              <?php
              			$conn->close();
									}
              ?>
                <!-- form end -->
             </div>
       	</section>
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
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<script type="text/javascript" >
//显示底单图片
	function show_receipt(file){
		var prevDiv = document.getElementById('showpic');
		if (file.files && file.files[0]){
			var reader = new FileReader();
			reader.onload = function(evt){
				prevDiv.innerHTML = '<img src="' + evt.target.result + '"  height="300px" width="400px" />';
			}
			reader.readAsDataURL(file.files[0]);
			//显示保存按钮
			document.getElementById('showbtn').hidden = false;
		}
		else{
			prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
		}
	}
	
</script>

</body>
</html>
