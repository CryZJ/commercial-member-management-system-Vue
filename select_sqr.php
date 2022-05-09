<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">

  <title>申请人选择</title>
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
            	申请人查询
            	<span class="tools pull-right">
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body">
                    <table class="table table-bordered table-responsive table-hover success" id="sqr_select_table">
				                <thead>
			                    <th>申请人</th>
			                    <th>证件号</th>
			                    <th>地址</th>
			                    <th>邮政编码</th>
			                    <th>费减备案</th>
			                    <th>备注</th>
				                </thead>
				                <tbody>
				                <?php
													require("conn.php");
													$sql = "select * from 申请人  where 删除状态 =0 order by id desc";
													$result = $conn->query($sql);
													if($result->num_rows >0){
														$i = 0;
														while($row = $result->fetch_assoc()){
															$i += 1;
												?>
													<tr id="<?php echo $row["id"]; ?>" onclick="click_down(this)">	
														<td><?php echo $row["申请人"]; ?></td>
														<td><?php echo $row["证件号"]; ?></td>
														<td><?php echo $row["地址"]; ?></td>
														<td><?php echo $row["邮政编码"]; ?></td>
														<td><?php echo $row["费减备案"]; ?></td>
														<td><?php echo $row["备注"]; ?></td>
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
//			window.onblur = function(){
//				window.close();
//			}
			//初始化表格
			var sqr_tab = $('#sqr_select_table').dataTable( {
					"aLengthMenu": [
			            [5],
			            [5] 
			        ],
			        "iDisplayLength": 5,
			        "aaSorting": [],
			        "aoColumnDefs": [{//指定那列不进行排序
			                'bSortable': false,
			                'aTargets': [0,1,2,3,4,5]
			            }
			        ]
			    } );
			function click_down(tr_obj){
				if(typeof(Storage)!=="undefined"){
				    localStorage.sqr_id = $(tr_obj).attr("id");
				    localStorage.sqr_name = $(tr_obj).children("td:eq(0)").html();
				    localStorage.sqr_idnumber = $(tr_obj).children("td:eq(1)").html();
				    localStorage.sqr_address = $(tr_obj).children("td:eq(2)").html();
						window.close();
				} else {
				    alert("抱歉！你的浏览器不支持web存储。");
				}
			}
			    
			
		</script>
</body>
</html>