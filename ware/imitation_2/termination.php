<?php 
	require("../../AHeader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>终止监控</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  
	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
	

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
 
</head>

<body>
	<div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel" style="height: auto;">
                    <header class="panel-heading">
                    	<h3>监控信息填写</h3>     
                    </header>
                    <div class="panel-body">
                        <table class="display table table-bordered table-striped" id="dynamic-table">
                        	<thead>
                        		<th>案卷号</th>
                        		<th>创建时间</th>
                        		<th>提醒时间</th>
                        		<th>截止时间</th>
                        		<th>监控描述</th>
                        		<th>剩余天数</th>
                        		<th>操作</th>
                        	</thead>
                        	<tbody>
                        		<?php
                        			require("../../conn.php");
									$sql2 = "SELECT id,案卷号,创建时间,提醒时间,截止时间,监控描述,DATEDIFF(截止时间,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数 FROM 事件监控  WHERE 状态='0' ";
									$result2 = $conn->query($sql2);
									if($result2->num_rows>0){
										while($row2 = $result2->fetch_assoc()){
								?>
											<tr>
												<td><?php echo $row2['案卷号']; ?></td>
												<td><?php echo $row2['创建时间']; ?></td>
												<td><?php echo $row2['提醒时间']; ?></td>
												<td><?php echo $row2['截止时间']; ?></td>
												<td><?php echo $row2['监控描述']; ?></td>
												<td><?php echo $row2['剩余天数']; ?></td>
												<td>
													<button class="btn btn-danger" onclick="termination(<?php echo $row2['id']; ?>)" >终止监控</button>
												</td>
											</tr>
								<?php			
										}
									}
									$conn->close();
                        		?>
                        	</tbody>
                        </table>
                    </div>
                    <br /><br /><br /><br /><br /><br /><br />
                </section>
            </div>
        </div>
   </div>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
	
<script type="text/javascript">	
function termination(id){
	$.ajax({
		url:"termination_ajax.php",
		type:"POST",
		data:{
			my_flag:"update",
			id:id
		},
		dataType:"json",
		success:function(data){
			alert(data.result);
			location.reload();
		},
		error:function(){
			alert("ajax error!");
		}
	});
}
</script> 

</body>
</html>
