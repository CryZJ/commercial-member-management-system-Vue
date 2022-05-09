<?php
require("../../AHeader.php");
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico" />

  <title>OA办公-案件登记</title>

  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  	
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>
<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper">
	<div class="row">
	    <div  class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<?php
	            		$self_id = $_GET['self_id'];
	            	?>
	            	案件登记查看
	            	<input type="text" id="my_id" value="<?php echo $self_id; ?>" hidden="hidden" />
	                    <span class="tools pull-right">
		                    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
		                    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
		                    <a class="btn fa fa-reply" onclick="window.close();">返回</a>
		                </span>
	            </header>
	           <div class="panel-body" style="width:98%; height:auto; solid #000000;">
	                <input hidden="hidden" type="text" id="czy" value="<?php echo $name; ?>" />
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
	                <thead>
	                	<tr> 
				            <th>案源人 </th>
				            <th>代理人 </th>
				            <th>接单日期 </th>
				            <th>预计完成时间</th>
				        </tr>
	                </thead>
	                <tbody>
	                	<?php
							$ret_data = '';
							require("../../conn.php");
							$sql = "SELECT id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,收费情况,备注 FROM 办公_案件基本登记   WHERE id='".$self_id."'";
							$result = $conn->query($sql);
							if($result->num_rows >0){
								while($row = $result->fetch_assoc()){
									$casebz = $row['案源人'];
									?>
									<tr>
			            				<td style="height: 40px;" ><?php echo $row['案源人']; ?></td>
			            				<td><?php echo $row['代理人']; ?></td>
			            				<td><?php echo $row['接单日期']; ?></td>
			            				<td><?php echo $row['预计完成时间']; ?></td>
									</tr>
									<?php
								}
							}
							$json = json_encode($ret_data);
							$conn->close();
	                	?>
	                </tbody>
	                </table>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
		                <thead>
		                	<tr>
					            <th>客户姓名</th>
					            <th>接单内容</th>
					            <th>处理情况</th>
					            <th>收费情况</th>
					        </tr>
		                </thead>
		                <tbody >
		                	<?php
								$ret_data = '';
								require("../../conn.php");
								$sql = "SELECT id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,收费情况,备注 FROM 办公_案件基本登记   WHERE id='".$self_id."'";
								$result = $conn->query($sql);
								if($result->num_rows >0){
									while($row = $result->fetch_assoc()){
										$bz = $row['备注'];
										?>
										<tr>
				            				<td style="height: 40px;" ><?php echo $row['客户姓名']; ?></td>
				            				<td><?php echo $row['接单内容']; ?></td>
				            				<td><?php echo $row['处理情况']; ?></td>
				            				<td><?php echo $row['收费情况']; ?></td>
										</tr>
										<?php
									}
								}
								$json = json_encode($ret_data);
								$conn->close();
		                	?>
		                </tbody>
	                </table>
	                <strong>相关文件</strong>
						<br  />
						<br  />
							<p>文件列表：</p>
							<div>
								<table class="display table table-bordered table-striped" id="tab_3">
									<thead>
										<th>文件名称</th>
										<th>文件描述</th>
										<th>操作</th>
									</thead>
									<tbody id="file_list">
										<?php
										require("../../conn.php");
											$sql_file = "SELECT 文件路径,描述 FROM 办公_案件基本登记文件 WHERE 基本登记id='".$self_id."'";
											$result_file = $conn->query($sql_file);
											if($result_file->num_rows>0){
												while($row3 = $result_file->fetch_assoc()){
										?>
													<tr>
														<td width="25%"><?php echo basename($row3['文件路径']); ?></td>
														<td><?php echo $row3['描述']; ?></td>
														<td>
															<a target="_blank" href="Downloadfile.php?filename=<?php echo $row3['文件路径']; ?>"><button class="btn btn-compose">下载</button></a>
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
	               <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ><?php echo $bz; ?></textarea></p>
	                <br />
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
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<script src="../../js/scripts.js"></script>

<!--页面响应-->
<!--<script src="../../js/imitation_2/casemark.js"></script>-->
<script type="text/javascript">
	var self_id = document.getElementById("my_id").value;
	//获取数据并填写
	$.ajax({
		url:"casemark_save.php",
		type:"post",
		async:true,
		data:{
			self_id:self_id,
			flag:'getdata'
		},
		dataType:"json",
		success:function(data){
//			alert(data.length);
			if(data.length != 0){
				var one_inp = document.getElementById("tabUserInfo").getElementsByTagName("input");
//				alert(one_inp.length);
				one_inp[3].value = data[3];
				for(i=0;i<one_inp.length;i++){
					one_inp[i].value = data[i];
				}
				var tow_inp = document.getElementById("tabUserInfo_2").getElementsByTagName("input");
//				alert(tow_inp.length);
				for(i=0;i<tow_inp.length;i++){
					tow_inp[i].value = data[i+4];
				}
				var case_bz = document.getElementById("case_bz");
				case_bz.value = data[8];
				
			}
		}
	});

</script>

</body>
</html>