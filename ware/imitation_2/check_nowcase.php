<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>案卷号选择</title>
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

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--提醒弹窗-->
<!--<script language="JavaScript">
	function ShowEdit_01(s_name){
		//var name=
		//var r = window.open("applicant.php?n=" + s_name,null,"");
		alert(s_name);
	}
</script>-->

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	案卷号查询
            </header>
            <div class="panel-body" id="SA">
                    <table class="display table table-bordered table-striped" id="dynamic-table" >
		                  <thead>
		                      <tr>
			                    <th class="numeric">案卷号</th>
			                    <th class="numeric">类型</th>
			                    <th class="numeric">专利名称</th>
			                    <th class="numeric">案源人</th>
			                    <th class="numeric">代理人</th>
			                    <th class="numeric">提交时间</th>
			                    <th class="numeric">状态</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                            <?php
                    			require("../../conn.php");
                				$sql = "SELECT 案卷号,类型,专利名称,案源人,代理人,提交时间,状态 FROM 专利信息 WHERE  提交时间=DATE(NOW()) AND 冻结状态='0'";
                				$result = $conn->query($sql);
                        		if($result->num_rows > 0){
                        			while($row = $result->fetch_assoc()){
                        	?>
                        				<tr>
                        					<td class="numeric"><?php echo $row["案卷号"];?></td>
                        					<td class="numeric"><?php echo $row["类型"];?></td>
                        					<td class="numeric"><?php echo $row["专利名称"];?></td>
                        					<td class="numeric"><?php echo $row["案源人"];?></td>
                        					<td class="numeric"><?php echo $row["代理人"];?></td>
                        					<td class="numeric"><?php echo $row["提交时间"];?></td>
                        					<td class="numeric"><?php echo $row["状态"];?></td>
                        				</tr>
	                        <?php
	                        		}
	                        	}
								$conn->close();
		                    ?>
		                  </tbody>
	                </table>
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

</body>
</html>
