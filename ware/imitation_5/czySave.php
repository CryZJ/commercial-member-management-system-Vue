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

  <title>流程操作员设置</title>
  <!--dynamic table-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />-->
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <!--<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header" onload="ShowSysSet()" >

    <!-- main content start--主页左上方的标志-->

		<!--body wrapper start :主要内容-->
		<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
									流程操作员
									<!--<input type="text" id="error" />-->
									<span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <a class="fa fa-reply" onclick="javascript:window.close();" ></a>
	                </span>
	        			</header>
	        			<form>
	        			<div class="panel-body">				        
									<table  class="display table table-bordered table-striped" id="tab_1">
									<thead>
										<tr>
											<th>姓名</th>
											<th>手机号码</th>
											<th>地址</th>
											<th>邮箱</th>
											<th>备注</th>
										</tr>
									</thead>
									<tbody>
										<tr>
									<?php  
										$id = $_REQUEST["id"];
										require("../../conn.php");
										$sql = "SELECT a.id,a.名称,手机,通信地址,邮箱,备注 from 用户 a,代理人信息 b where a.id='$id' and a.id=b.sonid ";
										$result = $conn->query($sql);
										if($result->num_rows>=0){
											while($row = $result->fetch_assoc()){
									?>
											<input type="text" id="czyid" name="" readonly="readonly" hidden="hidden" value="<?php echo $row["id"]; ?>"  />
											<td align="center"><?php echo $row["名称"]; ?></td>
											<td align="center"><?php echo $row["手机"]; ?></td>
											<td align="center"><?php echo $row["通信地址"]; ?></td>
											<td align="center"><?php echo $row["邮箱"]; ?></td>
											<td align="center"><?php echo $row["备注"]; ?></td>
									<?php
										 }
										}
									?>
										</tr>
									</tbody>
								</table>
								</br>
								<strong>相应权限</strong>
								<br>
								<table  class="display table table-bordered table-striped" id="tab">
									<thead>
										<tr>
											<th style="width:50px;" >#</th>
											<th>功能名称</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><input id="SysSet" type="checkbox" /></th>
											<th>系统设置【年费设置/银行账户设置/专案费用名设置】<input type="text" value="permis_sys" hidden="hidden" /></th>
										</tr>
										<tr>
											<th><input id="FcoSet" type="checkbox" /></th>
											<th>财务管理<input type="text" value="permis_fct" hidden="hidden" /></th>
										</tr>
									</tbody>
								</table>
								</br>
								<strong>对应案源/代理人</strong>
								<br>
								<input  class="btn btn-primary" type="button" onclick="selectAnti()" value="反选" >
								<br /><br />
								<table class="display table table-bordered table-striped" id="tab_2">
									<thead>
										<th>代理人</th>
										<th>代理人</th>
										<th>代理人</th>
										<th>代理人</th>
									</thead>
									<tbody>
								<?php
									$sql2 = "select 名称,id  from 代理人信息 ";
									$result2 = $conn->query($sql2);
									if($result2->num_rows>=0){
										$num = 4;
										$n = $result2->num_rows;
										$x= ceil($n/$num);
										$num = 0;
											for($i=0;$i<$x;$i++){
												echo"<tr>";
												for($y=0;$y<4;$y++){
												$row2 = $result2->fetch_assoc();
//												$len = count($row2);
												$num++;
//												echo $len;
												if($row2['id']<>null){//如果id存在
//													echo 1;
													?>
													<!--显示所有代理人信息-->
														<!--<td><input hidden="hidden" id="dlid[<?php echo $num; ?>]" value="<?php echo $row2["id"] ;?>" /><input id="che[<?php echo $num; ?>]" type="checkbox" name="selected" value="<?php echo $row2["id"] ;?>" ><?php echo $row2["名称"] ;?></td>-->
														<td><input hidden="hidden" id="dlid[<?php echo $num; ?>]" value="<?php echo $row2["id"] ;?>" /><input id="che[<?php echo $num; ?>]" type="checkbox" name="selected" ><?php echo $row2["名称"] ;?></td>
													<?php			
														$sql3="select czyid,代理人id  from 操作员下表 where 代理人id='".$row2["id"]."' and czyid='".$id."'";
														$result3 = $conn->query($sql3);
														if($result3->num_rows>0){
															//判断是否选中，已选中的为0，未选中的状态为1
															$chestu = '0';
																echo "<script>
																	var che = document.getElementById('che[".$num."]').checked=true;
																</script>";
														}else{
//															echo "<script>
//																	var che = document.getElementById('che[".$num."]').checked=false;
//															</script>";
													}
												}else{//如果没有
												?>
														<!--<td></td>-->
														<td><input hidden="hidden" id="dlid[<?php echo $num; ?>]" value="<?php echo $row2["id"] ;?>" /><input hidden="hidden" id="che[<?php echo $num; ?>]" type="checkbox" name="selected"  value="<?php echo $row2["id"] ;?>" ><?php echo $row2["名称"];?></td>
												<?php
													}
												}
												echo"</tr>";
											}
									}
									$conn->close();
								?>
									</tbody>
								</table>
								<div align="center">
									<!--<input type="reset" value="重置" />&nbsp;&nbsp;&nbsp;-->
									<input class="btn btn-primary" type="button" name="" id="" value="保存" onclick="czySave()" />
								</div>
						</div>
	        		</section>
	        	</div>
        	</div>
        </div>
        
				<!--body wrapper end-->
				
    <!-- main content end-->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<!--<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>-->

<!--页数跳转--><!--表格插件-->
<!--
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<!--<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>-->

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--保存数据的函数-->
<script src="../../js/czySave.js"></script>

<script type="text/javascript" >
//	var selzer = document.getElementById("sz");
//	selzer.style.visibility = "hidden";
</script>

</body>
</html>
