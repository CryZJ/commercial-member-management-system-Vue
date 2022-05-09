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
						    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
						    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body">
            	<button  class="btn btn-primary" id="sure" >确定</button>
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                        <tr>
                        		<th>#</th>
                        		<th hidden="hidden">id</th>
                            <th>申请人</th>
                            <th>证件号</th>
                            <th>地址</th>
                            <th>邮政编码</th>
                            <th>费减备案</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
													require("conn.php");
													$sql = "select * from 申请人  where 删除状态 = 0 order by id desc";
													$result = $conn->query($sql);
													if($result->num_rows >0){
														$i = 0;
														while($row = $result->fetch_assoc()){
															$i += 1;
												?>
												<!--<tr onclick="send_msg()">-->
												<tr>	
                        	<th><input type="checkbox" id="<? $i ?>" name="" /></th>
													<td hidden="hidden" id="id[<?php echo $i; ?>]"><?php echo $row["id"]; ?></td>
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
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<!--页数跳转-->
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#dynamic-table').dataTable( {
						"aLengthMenu": [
		            [-1],
		            ["All"] 
		        ],
		        "iDisplayLength": -1,
		        "aaSorting": [],
		        "aoColumnDefs": [{
		                'bSortable': false,
		                'aTargets': [0]
		        }]
		    } );
		    
			});
			
			
			
			window.onblur = function(){
				window.close();
			}
			var chek_sure = document.getElementById("sure");//监控按钮点击事件
			chek_sure.addEventListener("click",function(){
				var tb = document.getElementById("dynamic-table");
				var tb_num = tb.rows.length;//判断表格行数
				var name = new Array();//将联系人名设为数组，方便多数据传输
				var data_str = new String();
				var y = 0;
				for (var i = 1;i < tb_num;i++) {
					var mas = tb.rows[i].cells[0].getElementsByTagName("input")[0].checked;
					if(mas == true){
						for(var j=1;j<8;j++){
							data_str = data_str + tb.rows[i].cells[j].innerHTML+"/";
						}
					}
				}
				
				data_str = data_str.substring(0,data_str.length-1);//去掉最后面的一根“/”	
			
				if(typeof(Storage)!=="undefined"){
					localStorage.return_data = data_str;
					window.close();
				} else {
				    alert("抱歉！你的浏览器不支持web存储。");
				}
			});
			
		</script>
</body>
</html>