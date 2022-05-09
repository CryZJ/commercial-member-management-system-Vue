<?php 
	require("../../AHeader.php"); 
	require("../../conn.php");
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

  <title>人员信息</title>
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
  <style type="text/css">
  	#tab_ry input{
  		zoom: 150%;
  	}
  	#tab_ry td{
  		font-size: 16px;
  	}
  </style>
</head>

<body class="sticky-header">

    <!-- main content start--主页左上方的标志-->

		<!--body wrapper start :主要内容-->
		<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading" style="font-size: 20px;">
									<label>编号：</label><input type="text" id="xbh" value="<?php echo $_GET['bh'];  ?>" readonly="readonly" style="border: none;" />
									<!--<input type="text" id="error" />-->
									<span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
	                    <a class="fa fa-reply" onclick="window.close()" ></a>
	                </span>
	        			</header>
	        			<form>
	        			<div class="panel-body">
	        				<input type="text" id="ybh" value="<?php echo $_GET['bh']; ?>" hidden="hidden"/>
	        				
	        				<?php 
	        					if($admin == 1){
	        				?>
	        					<label><strong style="font-size: 20px;">账号操作：</strong>&nbsp;&nbsp;</label>
	        					<label>流程操作员：</label><input type="checkbox" id="lcczy" style="zoom: 150%;"/>
	        					&nbsp;
	        					<label>账号停用：</label><input type="checkbox" id="zhty" style="zoom: 150%;" />
	        					&nbsp;
	        					<label>事物管理员：</label><input type="checkbox" id="swgly" style="zoom: 150%;" />
	        				<?php	
	        					}
	        				?>
	        				
	        				<div id="agnet_info">
	        					<strong style="font-size: 20px;">人员信息</strong>			        
								<table  class="display table table-bordered table-striped" id="tab_1">
									<thead>
										<tr>
											<th>姓名</th>
											<th>证件号</th>
											<th>账号</th>
											<th>密码</th>
											<th>入职日期</th>
											<th>离职日期</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" /></td>
											<td><input type="text" /></td>
											<td><input type="text" /></td>
											<td><input type="text" /></td>
											<td><input type="date" /></td>
											<td><input type="date" /></td>
										</tr>
									</tbody>
								</table>
								<table  class="display table table-bordered table-striped" id="tab">
									<thead>
										<tr>
											<th style="width: 12%;">固话</th>
											<th style="width: 12%;">手机</th>
											<th style="width: 12%;">QQ</th>
											<th style="width: 12%;">微信</th>
											<th style="width: 15%;">邮箱</th>
											<th>通信地址</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" style="width: 90%;" /></td>
											<td><input type="text" style="width: 90%;"/></td>
											<td><input type="text" style="width: 90%;"/></td>
											<td><input type="text" style="width: 90%;"/></td>
											<td><input type="text" style="width: 100%;"/></td>
											<td><input type="text" style="width: 100%;" /></td>
										</tr>
									</tbody>
								</table>
							</div>	
								</br>
								<strong style="font-size: 20px;">绑定人员(多文件导入的自动抄送关联人)</strong>
								<br />
								<?php 
		        					if($admin == 1){//管理员模块
		        				?>
		        					<table class="display table table-bordered table-striped" id="tab_2">
										<thead>
											<th>人员</th>
											<th>人员</th>
											<th>人员</th>
											<th>人员</th>
											<th>人员</th>
										</thead>
										<tbody id="tab_ry">
											<?php 
												$sql = "SELECT id,名称 FROM 用户 WHERE 状态='0' AND 账号<>'admin' ORDER BY id";
												$result = $conn->query($sql);
												$get_data = array();
												if($result->num_rows>0){
													$i = 0;
													while($row = $result->fetch_assoc()){
														$get_data[$i]['id'] = $row['id'];
														$get_data[$i]['名称'] = $row['名称'];
														$i++;
													}
												}
												if(count($get_data)>0){
													$num_len = count($get_data);
													if($num_len>6){
														for($i=0,$len=floor($num_len/5);$i<$len;$i++){
															echo "<tr>";
															for($j=5*$i,$col=$j+5;$j<$col;$j++){
																echo "<td><input type='checkbox' class='".$get_data[$j]["id"]."' name='".$get_data[$j]["名称"]."' >".$get_data[$j]["名称"]."</td>";
															}
															echo "</tr>";
														}
														$some_num = $num_len%5;
														if($some_num != 0){
															echo "<tr>";
															switch($some_num){
																case 1:
																	for($i=0;$i<$some_num;$i++){
																		echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																	}
																	echo "<td></td><td></td><td></td><td></td>";
																	break;
																case 2:
																	for($i=0;$i<$some_num;$i++){
																		echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																	}
																	echo "<td></td><td></td><td></td>";
																	break;
																case 3:
																	for($i=0;$i<$some_num;$i++){
																		echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																	}
																	echo "<td></td><td></td>";
																	break;
																case 4:
																	for($i=0;$i<$some_num;$i++){
																		echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																	}
																	echo "<td></td>";
																	break;
															}
															echo "</tr>";
														}
													}else{
														echo "<tr>";
														switch($num_len){
															case 1:
																for($i=0;$i<$num_len;$i++){
																	echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																}
																echo "<td></td><td></td><td></td><td></td>";
																break;
															case 2:
																for($i=0;$i<$num_len;$i++){
																	echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																}
																echo "<td></td><td></td><td></td>";
																break;
															case 3:
																for($i=0;$i<$num_len;$i++){
																	echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																}
																echo "<td></td><td></td>";
																break;
															case 4:
																for($i=0;$i<$num_len;$i++){
																	echo "<td><input type='checkbox' class='".$get_data[$i]["id"]."' name='".$get_data[$i]["名称"]."' >".$get_data[$i]["名称"]."</td>";
																}
																echo "<td></td>";
																break;
														}
														echo "</tr>";
													}
												}
											 ?>
										</tbody>
									</table>
									<div align="center">
										<input class="btn btn-primary" type="button" name="" id="" value="保存" onclick="czySave()" />
									</div>
		        				<?php	
		        					}else{//非管理员模块
		        						$bh = $_GET['bh'];
										$yh_id = "";
										$sql = "SELECT id FROM 用户 WHERE 案源人编号='".$bh."'";
										$result = $conn->query($sql);
										if($result->num_rows>0){
											while($row = $result->fetch_assoc()){
												$yh_id = $row['id'];
											}
											
										}
										$sql = "SELECT 副用户名称 FROM 人员账号绑定 WHERE 主用户id='".$yh_id."'";
										$name_str = "";
										$result = $conn->query($sql);
										if($result->num_rows>0){
											while($row = $result->fetch_assoc()){
												$name_str = $row['副用户名称'];
											}
										}
		        				?>
		        						<table class="display table table-bordered table-striped" id="tab_2">
											<thead>
												<th>人员</th>
												<th>人员</th>
												<th>人员</th>
												<th>人员</th>
												<th>人员</th>
											</thead>
											<tbody>
												<?php 
													if(strlen($name_str) != 0){
														$arr_name =  explode(',', $name_str);
														$num_len = count($arr_name);
														if($num_len>6){
															for($i=0,$len=floor($num_len/5);$i<$len;$i++){
																echo "<tr>";
																for($j=5*$i,$col=$j+5;$j<$col;$j++){
																	echo "<td>".$arr_name[$j]."</td>";
																}
																echo "</tr>";
															}
															$some_num = $num_len%5;
															if($some_num != 0){
																echo "<tr>";
																switch($some_num){
																	case 1:
																		for($i=0;$i<$some_num;$i++){
																			echo "<td>".$arr_name[$i]."</td>";
																		}
																		echo "<td></td><td></td><td></td><td></td>";
																		break;
																	case 2:
																		for($i=0;$i<$some_num;$i++){
																			echo "<td>".$arr_name[$i]."</td>";
																		}
																		echo "<td></td><td></td><td></td>";
																		break;
																	case 3:
																		for($i=0;$i<$some_num;$i++){
																			echo "<td>".$arr_name[$i]."</td>";
																		}
																		echo "<td></td><td></td>";
																		break;
																	case 4:
																		for($i=0;$i<$some_num;$i++){
																			echo "<td>".$arr_name[$i]."</td>";
																		}
																		echo "<td></td>";
																		break;
																}
																echo "</tr>";
															}
														}else{
															echo "<tr>";
															switch($num_len){
																case 1:
																	for($i=0;$i<$num_len;$i++){
																		echo "<td>".$arr_name[$i]."</td>";
																	}
																	echo "<td></td><td></td><td></td><td></td>";
																	break;
																case 2:
																	for($i=0;$i<$num_len;$i++){
																		echo "<td>".$arr_name[$i]."</td>";
																	}
																	echo "<td></td><td></td><td></td>";
																	break;
																case 3:
																	for($i=0;$i<$num_len;$i++){
																		echo "<td>".$arr_name[$i]."</td>";
																	}
																	echo "<td></td><td></td>";
																	break;
																case 4:
																	for($i=0;$i<$num_len;$i++){
																		echo "<td>".$arr_name[$i]."</td>";
																	}
																	echo "<td></td>";
																	break;
															}
															echo "</tr>";
														}
													}
												 ?>
											</tbody>
										</table>
			        					<div align="center">
											<input class="btn btn-primary" type="button" name="" id="" value="保存" onclick="czySave_2()" />
										</div>
		        				<?php		
		        					}
		        				?>
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
<!--<script src="../../js/czySave.js"></script>-->

<script type="text/javascript" >
	var ybh = document.getElementById("ybh");
	//获取信息填充
	$.ajax({
		type:"get",
		url:"agent_info_ajax.php",
		async:true,
		dataType:"json",
		data:{
			flag:"Getdata_info",
			bh:ybh.value
		},
		success:function(data){
//			console.log(data['状态']);
			if(data['流程操作员'] == '1'){
				document.getElementById("lcczy").checked = true;
			}
			if(data['状态'] == '1'){
				document.getElementById("zhty").checked = true;
			}
			if(data['事务管理员'] == '1'){
				document.getElementById("swgly").checked = true;
			}
			$("#agnet_info input").each(function(i){
				$(this).attr("value",data[i+1]);
			});
			if(data['idstr'].length){
				var idstr = data['idstr'].split(",");
				var len = idstr.length;
				var j = 0;
				$("#tab_ry input").each(function(){
					if(j<len){
						if($(this).attr("class") == idstr[j]){
							$(this).attr("checked",true);
							j++; 
						}
					}
				});
			}
		},
		error:function(x,s,t){
			console.log("ajax error！"+s+t);
		}
	});
	
	//管理员模式保存数据
	function czySave(){
		ybh_v = document.getElementById("ybh").value;//原编号（隐藏）
		xbh_v = document.getElementById("xbh").value;//可修改编号
		//流程操作员
		var lcczy_flag =0;
		if( document.getElementById("lcczy").checked){
			lcczy_flag = 1;
		}
		//账号停用
		var zhty_flag = 0;
		if( document.getElementById("zhty").checked){
			zhty_flag = 1;
		}
		//事务管理员
		var swgly_flag = 0;
		if(document.getElementById("swgly").checked){
			swgly_flag = 1;
		}
		//表格信息
		var data_str = "";
		$("#agnet_info input").each(function(i){
			if($(this).attr("value")){
				data_str += "#$#"+$(this).attr("value");
			}else{
				data_str += "#$#"+"无";
			}
		});
		data_str = data_str.substr(3);
		//绑定人员
		var id_str = "";
		var name_str = "";
		$("#tab_ry input").each(function(){
			if($(this).attr("checked")){
				id_str += ","+$(this).attr("class");
				name_str += ","+$(this).attr("name");
			}
		});
		id_str = id_str.substr(1);
		name_str = name_str.substr(1);
		
//		console.log(ybh_v+"\n"+xbh_v+"\n"+data_str+"\n"+id_str+"\n"+name_str);
		$.ajax({
			type:"get",
			url:"agent_info_ajax.php",
			async:true,
			data:{
				flag:"Save_admin",
				ybh:ybh_v,
				xbh:xbh_v,
				lcczy_flag:lcczy_flag,
				zhty_flag:zhty_flag,
				swgly_flag:swgly_flag,
				data_str:data_str,
				id_str:id_str,
				name_str:name_str
			},
			success:function(data){
				alert("保存成功");
				console.log(data);
			},
			error:function(x,s,t){
				console.log("ajax error!"+s+t);
			}
		});
	} 
	
	//非管理员模块的保存
	function czySave_2(){
		ybh_v = document.getElementById("ybh").value;//原编号（隐藏）
		xbh_v = document.getElementById("xbh").value;//可修改编号
		
		//表格信息
		var data_str = "";
		$("#agnet_info input").each(function(i){
			if($(this).attr("value")){
				data_str += "#$#"+$(this).attr("value");
			}else{
				data_str += "#$#"+"无";
			}
		});
		data_str = data_str.substr(3);
		
		$.ajax({
			type:"get",
			url:"agent_info_ajax.php",
			async:true,
			data:{
				flag:"Save_general",
				ybh:ybh_v,
				xbh:xbh_v,
				data_str:data_str
			},
			success:function(data){
				alert("保存成功");
				console.log(data);
			},
			error:function(x,s,t){
				console.log("ajax error!"+s+t);
			}
		});
	}
	
</script>

</body>
</html>
