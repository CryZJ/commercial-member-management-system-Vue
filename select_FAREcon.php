<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>银行账户选择</title>
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
            	账户查询
            	<span class="tools pull-right">
						    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
						    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body" id="SA">
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                      <thead>
                        <tr>
                            <th hidden="hidden" >id</th>
                            <th>开户银行</th>
                            <th>户名</th>
                            <th>银行账号</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
													require("conn.php");
													$num = 0;
													$sql = "SELECT id,开户银行,户名,银行账号 FROM 银行账户 where 状态=0";
													$result = $conn->query($sql);
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
															$num++;
															?>
															<tr onclick="che(this)" >
																<td hidden="hidden" ><?php echo $row['id']; ?></td>
																<td><?php echo $row['开户银行']; ?></td>
																<td><?php echo $row['户名']; ?></td>
																<td><?php echo $row['银行账号']; ?></td>
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
			window.onblur = function(){
				window.close();
			}
			function che(tr_obj){
				var data_str = $(tr_obj).children("td:eq(1)").html()+"|";//
				data_str += $(tr_obj).children("td:eq(2)").html()+"|\n";
				data_str += $(tr_obj).children("td:eq(3)").html();
//				console.log(data_str);
				if(typeof(Storage)!=="undefined"){
						localStorage.return_data = data_str;
						window.close();
				} else {
				    alert("抱歉！你的浏览器不支持web存储。");
				}
			}
		</script>

</body>
</html>
