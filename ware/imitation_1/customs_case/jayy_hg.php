<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>
  <title>结案备注</title>
  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>


  <!--dynamic table-->
  <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

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
            	结案
            </header>
            <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
            	
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                        <tr>
                            <th>案卷号</th>
                            <th>申请号</th>
                            <th>名称</th>
                            <th>申请人</th>
                            <th>备案日期</th>
                            <th>结案原因</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
		                        	$ajh = $_REQUEST['ajh'];
		                        	$ajh_zz   = explode("|", $ajh);
		                        	$len = count($ajh_zz);
		                        	$time 		= date("Y-m-d");
															require("../../../conn.php");
															$i=0;
															while($i<$len){
															$sql = "select * from 海关_案件 where 案卷号 = '".$ajh_zz[$i]."'";
//															echo $sql;
															$result = $conn->query($sql);
															if($result->num_rows >0){
																while($row = $result->fetch_assoc()){
															?>
											<tr>	
													<td><?php echo $ajh_zz[$i]; ?></td>
													<td><?php echo $row["申请号"]; ?></td>
													<td><?php echo $row["名称"]; ?></td>
													<td><?php echo $row["登记人"]; ?></td>
													<td><?php echo $row["备案日期"]; ?></td>
													<td><input type="text" name="input" value="<?php echo $row["结案原因"]; ?>"></td>
												</tr>
												<?php
															}
														$i++;
													}
													}
													$conn->close();
												?>
                    </table>
                   </tbody>
                    <div align="center"><button  id="sure" onclick="jasave()">提交</button></div>
                    
                   
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
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<!--<script type="text/javascript" src="../../../js/data-tables/DT_bootstrap.js"></script>-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>

		<!--<script type="text/javascript">
				var chek_sure = document.getElementById("sure");//监控按钮点击事件
				window.returnValue=data_str;
				window.close();
				});
		
		</script>-->
<!--结案-->
<script src="../../../js/customes_action.js"></script>
</body>
</html>