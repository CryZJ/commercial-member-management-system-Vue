<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>案源人选择</title>
  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>


  <!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

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
            	案源人查询
            	<span class="tools pull-right">
						    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
						    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body" id="SA">
              		<table class="table table-bordered table-responsive table-hover-td" id="dynamic-table">
		                <thead>
	                    <th>案源人名称</th>
	                    <th>案源人名称</th>
	                    <th>案源人名称</th>
		                </thead>
		                <tbody>
		                <?php
											require("conn.php");
											$sql = "select id,名称 from 案源人信息  where 状态 = 0 order by id desc";
											$result = $conn->query($sql);
											$ayr_name_data = array();
											if($result->num_rows >0){
												$i = 0;
												while($row = $result->fetch_assoc()){
													$ayr_name_data[$i]["id"] = $row["id"];
													$ayr_name_data[$i]["名称"] = $row["名称"];
													$i++;
												}
											}
											$conn->close();
											$data_counter = count($ayr_name_data);
											$row_num = floor($data_counter/3);
											$over_num = $data_counter%3;
											for($i=0;$i<$row_num;$i++){//行数
										?>
												<tr>
													<td id="<?php echo $ayr_name_data[$i*3+0]["id"]; ?>"><?php echo $ayr_name_data[$i*3+0]["名称"]; ?></td>
													<td id="<?php echo $ayr_name_data[$i*3+1]["id"]; ?>"><?php echo $ayr_name_data[$i*3+1]["名称"]; ?></td>
													<td id="<?php echo $ayr_name_data[$i*3+2]["id"]; ?>"><?php echo $ayr_name_data[$i*3+2]["名称"]; ?></td>
												</tr>
										<?php			
											}
											switch($over_num){
												case 1:
										?>
												<tr>
													<td id="<?php echo $ayr_name_data[$data_counter-1]["id"]; ?>"><?php echo $ayr_name_data[$data_counter-1]["名称"]; ?></td>
													<td></td>
													<td></td>
												</tr>
										<?php			
													break;
												case 2:
										?>
												<tr>
													<td id="<?php echo $ayr_name_data[$data_counter-2]["id"]; ?>"><?php echo $ayr_name_data[$data_counter-2]["名称"]; ?></td>
													<td id="<?php echo $ayr_name_data[$data_counter-1]["id"]; ?>"><?php echo $ayr_name_data[$data_counter-1]["名称"]; ?></td>
													<td></td>
												</tr>
										<?php	
													break;
												default:
													break;
											}
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

		<script type="text/javascript">
			//焦点离开窗口后会关闭
			window.onblur = function(){
				window.close();
			}
			$("#dynamic-table td").click(function(){
					if(typeof(Storage)!=="undefined"){
					    localStorage.ayr_id = $(this).attr("id");
					    localStorage.ayr_name = $(this).html();
							window.close();
					} else {
					    alert("抱歉！你的浏览器不支持web存储。");
					}
			});
			
		</script>

</body>
</html>
