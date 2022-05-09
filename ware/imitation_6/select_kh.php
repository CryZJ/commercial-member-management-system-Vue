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
            	代理人查询
            </header>
            <div class="panel-body">
            	<div id="SA">
                    <table class="display table table-bordered table-striped" id="tab">
                        <thead>
	                        <tr>
	                            <th>代理人</th>
	                            <th>代理人</th>
	                            <th>代理人</th>
	                        </tr>
                        </thead>
                        <tbody>
	                        <?php
														require("../../conn.php");
														$sql = "select id,申请人 from 申请人";
														$result = $conn->query($sql);
														if($result->num_rows >0){
															$num = 3;
															$n = $result->num_rows;
															$row_n = ceil($n /$num);
													?>
													<?php
	//														行循环
															for($i = 0;$i < $row_n; $i++){
													?>
														<tr>
													<?php
	//														列循环
																for($y = 0; $y < $num;$y++){
																		$row = $result->fetch_assoc();
													?>
																<td onclick="send_msg('<?php echo $row["id"];?>')"><?php echo $row["申请人"]; ?></td>
																<!--<td hidden="hidden"><?php echo $row["id"]; ?></td>-->
													<?php
																	}
													?>
														</tr>
													<?php
	//															}
															}
														}
														$conn->close();
													?>
							          </tbody>
                    </table>
                    </div>
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

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

		<script type="text/javascript">
			var tab = document.getElementById("tab");
			//获取选中行的姓名再传回父页
			function send_msg(id){
//				alert(id);
				var name;
				var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td 
//				var nrow = td.rowIndex;
				name = td.innerHTML;
//				alert(name);
				return_data = id+'/'+name;
//				return_data = 'ok';
				window.returnValue = return_data;
				window.close();
				
			}
		</script>

</body>
</html>
