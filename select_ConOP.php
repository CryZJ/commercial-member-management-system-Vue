<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>商标代理组织及代理人选择</title>
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

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	商标代理组织及代理人选择
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
                            <th>代理组织</th>
                            <th>联系人</th>
                            <th>电话</th>
                            <th>邮编</th>
                            <th>传真</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
													require("conn.php");
													$num = 0;
													$sql = "SELECT id,代理人名,联系人,电话,邮编,传真  FROM 商标_代理设置 where 状态=0";
													$result = $conn->query($sql);
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
															$num++;
															?>
															<tr onclick="che(<?php echo $num; ?>)" >
																<td hidden="hidden"><?php echo $row['id']; ?></td>
																<td><?php echo $row['代理人名']; ?></td>
																<td><?php echo $row['联系人']; ?></td>
																<td><?php echo $row['电话']; ?></td>
																<td><?php echo $row['邮编']; ?></td>
																<td><?php echo $row['传真']; ?></td>
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
<!--<script src="js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

		<script type="text/javascript">
		    $('#dynamic-table').dataTable( {
        "aaSorting": [],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
        }]
    } );
			window.onblur = function(){
				window.close();
			}
			function che(num){
				var tab = document.getElementById('dynamic-table');
				var data_str = tab.rows[num].cells[0].innerHTML+'|';
				data_str += tab.rows[num].cells[1].innerHTML+'|';
				data_str += tab.rows[num].cells[2].innerHTML+'|';
				data_str += tab.rows[num].cells[3].innerHTML+'|';
				data_str += tab.rows[num].cells[4].innerHTML+'|';
				data_str += tab.rows[num].cells[5].innerHTML;
//				alert(data_str);
				if(typeof(Storage)!=="undefined"){
						localStorage.return_data = data_str;
//						console.log(localStorage.return_data);
//						console.log(num);
						window.close();
					} else {
					    alert("抱歉！你的浏览器不支持web存储。");
					}
			}
		</script>

</body>
</html>
