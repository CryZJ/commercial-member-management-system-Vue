<?php require'../../AHeader.php'; ?>

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
		<link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

		<title>OA办公-邮件收发</title>
		<!--dynamic table-->
		<link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
		<link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
		<link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

		<!--pickers css-->
		<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

		<link href="../../css/style.css" rel="stylesheet">
		<link href="../../css/style-responsive.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../js/html5shiv.js"></script>
		<script src="../../js/respond.min.js"></script>
		<![endif]-->

		<!--jQuery库文件-->
		<script src="../../js/jquery-1.10.2.min.js"></script>
			
	</head>

	<body class="sticky-header">

		<section>
			<!-- left side start-->
			<div class="left-side sticky-left-side">
				<?php
					//创建左边菜单栏 
					require("../../menu_tree.php"); 
					Create_leftlist(1,0);
				?>				
			</div>
			<!-- left side end-->

			<!-- main content start--主页左上方的标志-->
			<div class="main-content" >

				<!-- header section start-->
				<div class="header-section">

					<!--toggle button start-->
					<a class="toggle-btn">
						<i class="fa fa-bars"></i>
					</a>
					<!--toggle button end-->

					<!--search start-->
					<!--<form class="searchform" action="http://view.jqueryfuns.com/2014/4/10/7_df25ceea231ba5f44f0fc060c943cdae/index.html" method="post">
					<input type="text" class="form-control" name="keyword" placeholder="Search here..." />
					</form>-->
					<!--search end-->

					<!--notification menu start -->
					<?php require'../../MenuMin-2.php';  ?>
					<!--notification menu end -->
				</div>
				<!-- header section end-->

				<!--body wrapper start :主要内容-->
				<div class="wrapper">
        	<div class="row">
				<div class="col-sm-12">
					<section class="panel">
						<header class="panel-heading custom-tab">
							<ul class="nav nav-tabs">
								<?php
									if($lcczy){
								?>
								<li class="about-3"><a href="#about-3" data-toggle="tab">未下载申请文件</a></li>
								<li class="about-2"><a href="#about-2" data-toggle="tab">已下载申请文件</a></li>
								<?php
									}	
								?>
								<li class="about-1"><a href="#about-1" data-toggle="tab">发送文件</a></li>
								<li class="about-4"><a href="#about-4" data-toggle="tab">接收文件</a></li>
								<li class="about-5"><a href="#about-5" data-toggle="tab">共享文件</a></li>
								<li class="about-6"><a href="#about-6" data-toggle="tab">个人文件</a></li>
								<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
								<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
							</ul>
						</header>
						<div class="panel-body">
							<div class="tab-content">
								<!-- 未下载申请文件 star-->
								<div class="tab-pane" id="about-3">
									<section id="unseen">
										<div class="panel-body">
											<div class="adv-table">
												<button style="display: none;" class="btn btn-primary" data-toggle="modal" id="download">
													下载全部文件
												</button>
												<button class="btn btn-primary" data-toggle="modal" id="dow_sel_file" title="只能选中本页的文件下载，可选择显示行数去下载更多的文件" >
													下载选择中文件
												</button>
												<?php
													require("../../conn.php");
													$sql = "SELECT count(id) AS 数量 FROM 专利信息 WHERE  提交时间=DATE(NOW()) AND 冻结状态='0'";
													$result = $conn->query($sql);
													$count_num = 0;
													
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
															$count_num = $row['数量'];
														}
													}
													$conn->close();
												?>
												<button class="btn btn-primary" data-toggle="modal" id="check_newcase" onclick="Check_newcase()" >
													查看今天新建的案件 <em>( <?php echo $count_num; ?> )</em>
												</button>
											<!-- /btn-group -->
							            	<div class="btn-group" style="float: right;" >
						                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
						                        	<?php 
						                        		require'../../conn.php';
						                        		//查询
						                        		$sqlO1 = "select OA文件1 from 表格顺序 where 用户id = '".$userid."'";
						                        		$resultO1 = $conn->query($sqlO1);
						                        		if($resultO1->num_rows>0){
						                        			while($rowO1 = $resultO1->fetch_assoc()){
						                        				$order = $rowO1['OA文件1'];
						                        			}
						                        		}
						                        		if(strlen($order)<1){
						                        			$order = '1/asc/案卷号';
						                        		}
						                        		//显示
						                        		$order = explode('/',$order);
						                        		echo $order[2];
						                        	?>
						                        	<span class="caret"></span>
						                        	<span class="dynamic-table" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
						                        </button>
						                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" ><!--OrderZL()--> 
						                            <li><a href="#">案卷号</a></li>
						                            <li><a href="#">专利名称</a></li>
						                            <li><a href="#">类型</a></li>
						                            <li><a href="#">案源人</a></li>
						                            <li><a href="#">代理人</a></li>
						                            <li><a href="#">文件名称</a></li>
						                            <li><a href="#">上传时间【正】</a></li>
						                            <li><a href="#">上传时间【倒】</a></li>
						                        </ul>
						                    </div>
						                    <!-- /btn-group -->
												<table  class="display table table-bordered table-striped" id="dynamic-table">
													<thead>
														<tr>
															<th style="width: 50px;" class="numeric sorting_desc_disabled"><input type="checkbox" id="select_all_wxzsqwj"/></th>
															<th style="width: 100px;">案卷号</th>
															<th>专利名称</th>
															<th style="width: 100px;">类型</th>
															<th style="width: 100px;">案源人</th>
															<th style="width: 100px;">代理人</th>
															<th>文件名称</th>
															<th style="width: 100px;">上传时间</th>
															<th style="width: 200px;">操作</th>
														</tr>
													</thead>
													<tbody id="tab_info_0">
														<?php
															require("../../conn.php");
															$sql="SELECT b.id,a.案卷号,a.专利名称,a.类型,a.案源人,a.代理人,b.文件路径,b.时间 AS 上传时间 FROM 专利信息 a, 案卷流程及文档 b WHERE a.案卷号=b.案卷号 AND a.状态='待提交' AND a.冻结状态='0' AND b.流程='待提交' AND b.删除状态='0'  AND (SELECT SUBSTRING_INDEX(b.文件路径,'.',-1))='zip'";
															$result = $conn->query($sql);
															if($result->num_rows > 0){
																while($row = $result->fetch_assoc()){
														?>
																<tr>
																	<th><input type="checkbox" id="<?php echo $row['id']; ?>" /></th>
																	<td><?php echo $row['案卷号']; ?></td>
																	<td><?php echo $row['专利名称']; ?></td>
																	<td><?php echo $row['类型']; ?></td>
																	<td><?php echo $row['案源人']; ?></td>
																	<td><?php echo $row['代理人']; ?></td>
																	<!--<td><?php echo basename($row['文件路径']); ?></td>-->
																	<td><?php $tmppath_arr=explode("/",$row['文件路径']);echo array_pop($tmppath_arr); ?></td>
																	<td><?php echo $row['上传时间']; ?></td>
																	<td>
																		<a class="btn btn-default" target="_blank" href="dow_file_one.php?flag=wxsqwj&id=<?php echo $row['id']; ?>&ajh=<?php echo $row['案卷号']; ?>&filename=../../<?php echo $row['文件路径']; ?>" title="单个文件下载" onclick="location.reload()">
																			下载
																		</a>
																		<button id="<?php echo $row['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
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
										</div>
									</section>
								</div>
								<!-- 未下载申请文件 end-->

								<!--已下载页面 stra-->
								<div class="tab-pane" id="about-2">
									<section id="unseen">
												<div class="panel-body">
													<div class="adv-table">
														<button class="btn btn-primary" data-toggle="modal" id="del_sel_file" title="只能选中本页的文件下载，可选择显示行数去下载更多的文件" >
															删除选择中文件
														</button>
														
														<!-- /btn-group -->
										            	<div class="btn-group" style="float: right;" >
									                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">
									                        	<?php 
									                        		require'../../conn.php';
									                        		//查询
									                        		$sqlO1 = "select OA文件2 from 表格顺序 where 用户id = '".$userid."'";
									                        		$resultO1 = $conn->query($sqlO1);
									                        		if($resultO1->num_rows>0){
									                        			while($rowO1 = $resultO1->fetch_assoc()){
									                        				$order = $rowO1['OA文件2'];
									                        			}
									                        		}
									                        		if(strlen($order)<1){
									                        			$order = '0/asc/案卷号';
									                        		}
									                        		//显示
									                        		$order = explode('/',$order);
									                        		echo $order[2];  
									                        	?>
									                        	<span class="caret"></span>
									                        	<span class="dynamic-table_2" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
									                        </button>
									                        <ul role="menu" class="dropdown-menu checilck" id="MenuT" ><!--OrderZL()--> 
									                            <li><a href="#">案卷号</a></li>
									                            <li><a href="#">专利名称</a></li>
									                            <li><a href="#">类型</a></li>
									                            <li><a href="#">案源人</a></li>
									                            <li><a href="#">代理人</a></li>
									                            <li><a href="#">文件名称</a></li>
									                            <li><a href="#">上传时间【正】</a></li>
									                            <li><a href="#">上传时间【倒】</a></li>
									                        </ul>
									                    </div>
									                    <!-- /btn-group -->
														<table  class="display table table-bordered table-striped" id="dynamic-table_2">
															<thead>
																<tr>
																	<th class="numeric sorting_desc_disabled" style="width: 50px;"> <input type="checkbox" id="select_all_1"/></th>
																	<th style="width: 100px;">案卷号</th>
																	<th>专利名称</th>
																	<th style="width: 100px;">类型</th>
																	<th style="width: 100px;">案源人</th>
																	<th style="width: 100px;">代理人</th>
																	<th>文件名称</th>
																	<th style="width: 160px;">上传时间</th>
																	<th style="width: 160px;">下载时间</th>
																	<th style="width: 100px;">下载人</th>
																	<th>操作</th>
																</tr>
															</thead>
															<tbody id="tab_info_f1">
																<?php
																	require("../../conn.php");
																	
																	$sql="SELECT b.id,a.案卷号,a.专利名称,a.类型,a.案源人,a.代理人,b.文件路径,b.时间 AS 上传时间,b.下载时间,b.下载人 FROM 专利信息 a, 案卷流程及文档 b WHERE a.案卷号=b.案卷号  AND a.状态<>'待提交' AND b.流程='待提交' AND b.删除状态='0' AND b.显示状态<>'1' AND (SELECT SUBSTRING_INDEX(b.文件路径,'.',-1))='zip'";
																	$result = $conn->query($sql);
																	if($result->num_rows > 0){
																	while($row = $result->fetch_assoc()){
																		
																			$dd= date("Y-m-d",strtotime("-30 day")); 	
																		if($row["发送时间"]<$dd){
																			$sql3 = "DELETE * FROM `案卷流程及文档` where 案卷号 ='".$row["案卷号"]."' ";
																			$result3=$conn->query($sql3);
																		
																		}
																		else{
																	?>
																		<tr>
																			<th><input type="checkbox" id="<?php echo $row['id']; ?>" /></th>
																			<td><?php echo $row['案卷号']; ?></td>
																			<td><?php echo $row['专利名称']; ?></td>
																			<td><?php echo $row['类型']; ?></td>
																			<td><?php echo $row['案源人']; ?></td>
																			<td><?php echo $row['代理人']; ?></td>
																			<td><?php echo basename($row['文件路径']); ?></td>
																			<td><?php echo $row['上传时间']; ?></td>
																			<td><?php echo $row['下载时间']; ?></td>
																			<td><?php echo $row['下载人']; ?></td>
																			<td>
																				<a class="btn btn-default" target="_blank" href="dow_file_one.php?flag=yxsqwj&id=<?php echo $row['id']; ?>&ajh=<?php echo $row['案卷号']; ?>&filename=../../<?php echo $row['文件路径']; ?>" title="单个文件下载" onclick="this.innerHTML = '已点过'">
																					下载
																				</a>
																			</td>
																		</tr>
																		
																	<?php }}
																	}
																	
																	$conn->close();
																?>
															</tbody>
														</table>
													</div>
												</div>
									</section>
								</div>
								<!--已下载页面 end-->
								<!--发送文件页面 stra-->
								<div class="tab-pane" id="about-1">
									<section id="unseen">
										<header class="panel-heading custom-tab ">
				                            <ul class="nav nav-tabs">
				                                <li class="active">
				                                    <a href="#home" data-toggle="tab">待发送文件</a>
				                                </li>
				                                <li>
				                                    <a href="#about" data-toggle="tab">已发送文件</a>
				                                </li>
				                            </ul>
				                        </header>
				                        <div class="panel-body">
				                        	<div class="tab-content">
				                        		<!--始 待发送文件-->
				                        		<div class="tab-pane active" id="home">
				                        			<button class="btn btn-primary" onclick="OpenWin_Upfile()">添加文件界面</button>
													<button class="btn btn-primary" onclick="Delect_acceptfile('tab_send')">删除选中行</button>
													<button class="btn btn-primary" onclick="Send_file('tab_send','SendSoSend')">发送选中行</button>
													<!-- /btn-group -->
									            	<div class="btn-group" style="float: right;" >
								                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">
								                        	<?php 
								                        		require'../../conn.php';
								                        		//查询
								                        		$sqlO1 = "select OA文件3 from 表格顺序 where 用户id = '".$userid."'";
								                        		$resultO1 = $conn->query($sqlO1);
								                        		if($resultO1->num_rows>0){
								                        			while($rowO1 = $resultO1->fetch_assoc()){
								                        				$order = $rowO1['OA文件3'];
								                        			}
								                        		}
								                        		if(strlen($order)<1){
								                        			$order = '2/asc/文件名前';
								                        		}
								                        		//显示
								                        		$order = explode('/',$order);
								                        		echo $order[2];
								                        	?>
								                        	<span class="caret"></span>
								                        	<span class="dynamic-table_3" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
								                        </button>
								                        <ul role="menu" class="dropdown-menu checilck" id="MenuW" ><!--OrderZL()--> 
								                            <li><a href="#">文件名前</a></li>
								                            <li><a href="#">文件名后</a></li>
								                            <li><a href="#">上传时间【正】</a></li>
								                            <li><a href="#">上传时间【倒】</a></li>
								                            <li><a href="#">上传人</a></li>
								                        </ul>
								                    </div>
								                    <!-- /btn-group -->
													<table  class="display table table-bordered table-striped" id="dynamic-table_3">
														<thead>
															<tr>
																<th style="width: 50px;"><input type="checkbox" id="select_all"/></th>
																<th>文件名称</th>
																<th style="width: 100px;">发送人</th>
																<th style="width: 180px;">上传时间</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tab_send">
															<?php 
																if($admin == 1){
																	$sql = "SELECT a.id,文件路径,a.上传时间,a.发送人用户id,b.名称 AS 发送人 FROM 发送文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.删除状态='0' AND a.发送状态='0'";
																}else{
																	$sql = "SELECT a.id,文件路径,a.上传时间,a.发送人用户id,b.名称 AS 发送人 FROM 发送文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.删除状态='0' AND a.发送状态='0' AND a.发送人用户id='".$userid."'";
																}
																$result=$conn->query($sql);
																if($result->num_rows>0){
																	while($row = $result->fetch_assoc()){
																		$tmp_arr = "";
																		$tmp_arr = explode("/", $row["文件路径"]);
																		$file_basename = end($tmp_arr);
															?>
															<tr>
																<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
																<td><?php echo $file_basename; ?></td>
																<td><?php echo $row["发送人"]; ?></td>
																<td><?php echo $row["上传时间"]; ?></td>
																<td>
																	<a class="btn btn-primary" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row["文件路径"]; ?>">下载</a>
																</td>
															</tr>			
															<?php			
																	}
																}
															?>
														</tbody>
													</table>
				                        		</div>
				                        		<!--止 待发送文件-->
				                        		<!--始 已发送文件-->
				                        		<div class="tab-pane" id="about">
				                        			<!--<button class="btn btn-primary" onclick="OpenWin_Upfile()">添加文件界面</button>-->
													<button class="btn btn-primary" onclick="Send_file('tab_send_after','SendSoSend')">发送选中行</button>
													<button class="btn btn-primary" onclick="Delect_files('tab_send_after','delete_After_send')">删除选中行</button>
													<!-- /btn-group -->
									            	<div class="btn-group" style="float: right;" >
								                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">
								                        	<?php 
								                        		require'../../conn.php';
								                        		//查询
								                        		$sqlO1 = "select OA文件3 from 表格顺序 where 用户id = '".$userid."'";
								                        		$resultO1 = $conn->query($sqlO1);
								                        		if($resultO1->num_rows>0){
								                        			while($rowO1 = $resultO1->fetch_assoc()){
								                        				$order = $rowO1['OA文件3'];
								                        			}
								                        		}
								                        		if(strlen($order)<1){
								                        			$order = '2/asc/文件名前';
								                        		}
								                        		//显示
								                        		$order = explode('/',$order);
								                        		echo $order[2];
								                        	?>
								                        	<span class="caret"></span>
								                        	<span class="dynamic-table_3" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
								                        </button>
								                        <ul role="menu" class="dropdown-menu checilck" id="MenuW" ><!--OrderZL()--> 
								                            <li><a href="#">文件名前</a></li>
								                            <li><a href="#">文件名后</a></li>
								                            <li><a href="#">上传时间【正】</a></li>
								                            <li><a href="#">上传时间【倒】</a></li>
								                            <li><a href="#">上传人</a></li>
								                        </ul>
								                    </div>
								                    <!-- /btn-group -->
													<table  class="display table table-bordered table-striped" id="dynamic-table_7">
														<thead>
															<tr>
																<th style="width: 50px;"><input type="checkbox" onclick="SelectAll_totable('dynamic-table_7','tab_send_after')"/></th>
																<th>文件名称</th>
																<th style="width: 100px;">发送人</th>
																<th style="width: 180px;">上传时间</th>
																<th style="width: 180px;">发送时间</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tab_send_after">
															<?php 
																if($admin == 1){
																	$sql = "SELECT a.id,文件路径,a.上传时间,a.发送人用户id,b.名称 AS 发送人,a.发送时间 FROM 发送文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.删除状态='0' AND a.发送状态<>'0'";
																}else{
																	$sql = "SELECT a.id,文件路径,a.上传时间,a.发送人用户id,b.名称 AS 发送人,a.发送时间 FROM 发送文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.删除状态='0' AND a.发送状态<>'0' AND a.发送人用户id='".$userid."'";
																}
																$result=$conn->query($sql);
																if($result->num_rows>0){
																	while($row = $result->fetch_assoc()){
																		$tmp_arr = "";
																		$tmp_arr = explode("/", $row["文件路径"]);
																		$file_basename = end($tmp_arr);
															?>
															<tr>
																<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
																<td><?php echo $file_basename; ?></td>
																<td><?php echo $row["发送人"]; ?></td>
																<td><?php echo $row["上传时间"]; ?></td>
																<td><?php echo $row["发送时间"]; ?></td>
																<td>
																	<a class="btn btn-primary" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row["文件路径"]; ?>">下载</a>
																</td>
															</tr>			
															<?php			
																	}
																}
															?>
														</tbody>
													</table>
				                        		</div>
				                        		<!--止 已发送文件-->	
				                        	</div>
				                        </div>
									</section>
								</div>
								<!--发送文件页面 end-->

								<!--接收文件页面 stra-->
								<div class="tab-pane" id="about-4">
									<section id="unseen">
										<header class="panel-heading custom-tab ">
				                            <ul class="nav nav-tabs">
				                                <li class="active">
				                                    <a href="#home_a" data-toggle="tab">待接收文件</a>
				                                </li>
				                                <li>
				                                    <a href="#about_a" data-toggle="tab">已接收文件</a>
				                                </li>
				                            </ul>
				                        </header>
				                        <div class="panel-body">
				                        	<div class="tab-content">
				                        		<!--始 待接收文件-->
				                        		<div class="tab-pane active" id="home_a">
				                        			<button class="btn btn-primary" onclick="AcceptAll_file('tab_accept')" >接收选中行</button>
													<!-- /btn-group -->
								            	<div class="btn-group" style="float: right;" >
							                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">
							                        	<?php 
							                        		require'../../conn.php';
							                        		//查询
							                        		$sqlO1 = "select OA文件4 from 表格顺序 where 用户id = '".$userid."'";
							                        		$resultO1 = $conn->query($sqlO1);
							                        		if($resultO1->num_rows>0){
							                        			while($rowO1 = $resultO1->fetch_assoc()){
							                        				$order = $rowO1['OA文件4'];
							                        			}
							                        		}
							                        		if(strlen($order)<1){
							                        			$order = '2/asc/文件名前';
							                        		}
							                        		//显示
							                        		$order = explode('/',$order);
							                        		echo $order[2];
							                        	?>
							                        	<span class="caret"></span>
							                        	<span class="dynamic-table_4" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
							                        </button>
							                        <ul role="menu" class="dropdown-menu checilck" id="MenuF" ><!--OrderZL()--> 
							                            <li><a href="#">文件名前</a></li>
							                            <li><a href="#">文件名后</a></li>
							                            <li><a href="#">上传时间【正】</a></li>
							                            <li><a href="#">上传时间【倒】</a></li>
							                            <li><a href="#">发送人</a></li>
							                        </ul>
							                    </div>
							                    <!-- /btn-group -->
													<table  class="display table table-bordered table-striped" id="dynamic-table_4">
														<thead>
															<tr>
																<th style="width: 50px;"><input type="checkbox" onclick="SelectAll_totable('dynamic-table_4','tab_accept')" /></th>
																<th>文件名称</th>
																<th style="width: 100px;">发送人</th>
																<th style="width: 180px;">发送时间</th>
															</tr>
														</thead>
														<tbody id="tab_accept">
															<?php
																//SELECT a.id,文件路径,b.名称 AS 发送人,a.发送时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.接收状态='0' AND a.接收人用户id='26' 
																if($admin == 1){
																	$sql = "SELECT a.id,文件路径,b.名称 AS 发送人,a.发送时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.接收状态='0' AND a.删除状态='0'";
																}else{
																	$sql = "SELECT a.id,文件路径,b.名称 AS 发送人,a.发送时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id  AND a.接收状态='0' AND a.删除状态='0'  AND a.接收人用户id='".$userid."'";
																}
																$result=$conn->query($sql);
																if($result->num_rows>0){
																	while($row = $result->fetch_assoc()){
																		$tmp_arr = "";
																		$tmp_arr = explode("/", $row["文件路径"]);
																		$file_basename = end($tmp_arr);
															?>
															<tr>
																<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
																<td><?php echo $file_basename; ?></td>
																<td><?php echo $row["发送人"]; ?></td>
																<td><?php echo $row["发送时间"]; ?></td>
															</tr>			
															<?php			
																	}
																}
															?>
														</tbody>
													</table>
				                        		</div>
				                        		<!--止 待接收文件-->
				                        		<!--始 已接收文件-->
				                        		<div class="tab-pane" id="about_a">
				                        			<!--<button class="btn btn-primary" onclick="OpenWin_Upfile()">添加文件界面</button>-->
													<!--<button class="btn btn-primary" onclick="Delect_acceptfile()">删除选中行</button>-->
													<button class="btn btn-primary" onclick="Send_file('tab_accept_after','AcceptSoSend')">发送选中行</button>
													<button class="btn btn-primary" onclick="Delect_files('tab_accept_after','delete_After_accept')">删除选中行</button>
													<!-- /btn-group -->
								            	<div class="btn-group" style="float: right;" >
							                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">
							                        	<?php 
							                        		require'../../conn.php';
							                        		//查询
							                        		$sqlO1 = "select OA文件4 from 表格顺序 where 用户id = '".$userid."'";
							                        		$resultO1 = $conn->query($sqlO1);
							                        		if($resultO1->num_rows>0){
							                        			while($rowO1 = $resultO1->fetch_assoc()){
							                        				$order = $rowO1['OA文件4'];
							                        			}
							                        		}
							                        		if(strlen($order)<1){
							                        			$order = '2/asc/文件名前';
							                        		}
							                        		//显示
							                        		$order = explode('/',$order);
							                        		echo $order[2];
							                        	?>
							                        	<span class="caret"></span>
							                        	<span class="dynamic-table_4" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
							                        </button>
							                        <ul role="menu" class="dropdown-menu checilck" id="MenuF" ><!--OrderZL()--> 
							                            <li><a href="#">文件名前</a></li>
							                            <li><a href="#">文件名后</a></li>
							                            <li><a href="#">上传时间【正】</a></li>
							                            <li><a href="#">上传时间【倒】</a></li>
							                            <li><a href="#">发送人</a></li>
							                        </ul>
							                    </div>
							                    <!-- /btn-group -->
													<table  class="display table table-bordered table-striped" id="dynamic-table_8">
														<thead>
															<tr>
																<th style="width: 50px;"><input type="checkbox" onclick="SelectAll_totable('dynamic-table_8','tab_accept_after')"/></th>
																<th>文件名称</th>
																<th style="width: 100px;">发送人</th>
																<th style="width: 180px;">发送时间</th>
																<th style="width: 180px;">接收时间</th>
																<th>操作</th>
															</tr>
														</thead>
														<tbody id="tab_accept_after">
															<?php 
																if($admin == 1){
																	$sql = "SELECT a.id,文件路径,b.名称 AS 发送人,a.发送时间,a.接收时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id AND a.删除状态='0'  AND a.接收状态='1'";
																}else{
																	$sql = "SELECT a.id,文件路径,b.名称 AS 发送人,a.发送时间,a.接收时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id AND a.删除状态='0'  AND a.接收状态='1' AND a.接收人用户id='".$userid."'";
																}
																$result=$conn->query($sql);
																if($result->num_rows>0){
																	while($row = $result->fetch_assoc()){
																		$dd= date("Y-m-d",strtotime("-30 day")); 	
																		if($row["发送时间"]<$dd){
																			$sql2 = "DELETE * FROM `接收文件` where id ='".$row["id"]."' ";
																			$result2=$conn->query($sql2);
																		}
																		else{
																		$tmp_arr = "";
																		$tmp_arr = explode("/", $row["文件路径"]);
																		$file_basename = end($tmp_arr);
															?>
															<tr>
																<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
																<td><?php echo $file_basename; ?></td>
																<td><?php echo $row["发送人"]; ?></td>
																<td><?php echo $row["发送时间"]; ?></td>
																<td><?php echo $row["接收时间"]; ?></td>
																<td>
																	<a class="btn btn-primary" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row["文件路径"]; ?>">下载</a>
																</td>
															</tr>			
															<?php			
																	}}
																}
															?>
														</tbody>
													</table>
				                        		</div>
				                        		<!--止 已接收文件-->	
				                        	</div>
				                        </div>
									</section>
								</div>
								<!--接收文件页面 end-->
								
								<!--共享文件页面 stra-->
								<div class="tab-pane" id="about-5">
									<section id="unseen">
										<div class="panel-body">
											<div class="adv-table">
												<button class="btn btn-primary" onclick="Upsharefile('uploadfile_share')">上传共享文件</button>
												<!-- /btn-group -->
								            	<div class="btn-group" style="float: right;" >
							                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuFi">
							                        	<?php 
							                        		require'../../conn.php';
							                        		//查询
							                        		$sqlO1 = "select OA文件5 from 表格顺序 where 用户id = '".$userid."'";
							                        		$resultO1 = $conn->query($sqlO1);
							                        		if($resultO1->num_rows>0){
							                        			while($rowO1 = $resultO1->fetch_assoc()){
							                        				$order = $rowO1['OA文件5'];
							                        			}
							                        		}
							                        		if(strlen($order)<1){
							                        			$order = '3/asc/上传时间【正】';
							                        		}
							                        		//显示
							                        		$order = explode('/',$order);
							                        		echo $order[2];
							                        	?>
							                        	<span class="caret"></span>
							                        	<span class="dynamic-table_5" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
							                        </button>
							                        <ul role="menu" class="dropdown-menu checilck" id="MenuFi" ><!--OrderZL()--> 
							                            <li><a href="#">上传时间【正】</a></li>
							                            <li><a href="#">上传时间【倒】</a></li>
							                            <li><a href="#">上传人</a></li>
							                        </ul>
							                    </div>
							                    <!-- /btn-group -->
												<table  class="display table table-bordered table-striped" id="dynamic-table_5">
													<thead>
														<tr>
															<th style="width: 50px;"><input type="checkbox" onclick="SelectAll_tab(this,'dynamic-table_5')"/></th>
															<th hidden="hidden">序号</th>
															<th>文件名称</th>
															<th style="width: 180px;">上传时间</th>
															<th style="width: 180px;">上传人</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody id="share_tab">
														<?php
															require("../../conn.php");
															$sql="SELECT id,上传人,上传时间,文件路径 FROM 共享文件 WHERE 删除状态='0' ORDER BY id ";
															$result = $conn->query($sql);
															if($result->num_rows > 0){
																while($row = $result->fetch_assoc()){
																?>
																<tr>
																	<th><input type="checkbox" id="<?php echo $row['id']; ?>" /></th>
																	<td hidden="hidden"><?php echo $row['id']; ?></td>
																	<td><?php echo pathinfo($row['文件路径'],PATHINFO_BASENAME); ?></td>
																	<td><?php echo $row['上传时间']; ?></td>
																	<td><?php echo $row['上传人']; ?></td>
																	<td>
																		<a class="btn btn-primary" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row['文件路径']; ?>" >下载</a>
																		<button class="btn btn-danger"  onclick="Del_shareone('<?php echo $row['id']; ?>','delshare_one')" >删除</button>
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
										</div>
										<div align="center">
											<button class="btn btn-primary" onclick="DeleteAll_tab('dynamic-table_5','DeleteAll_share')">
											批量删除
											</button>
											&nbsp;&nbsp;
											<button class="btn btn-primary" onclick="DownloadAll_tab('dynamic-table_5','share_downfile')">
											批量下载
											</button>
										</div>
									</section>
								</div>
								<!--共享文件页面 end-->
								<!--个人文件页面 stra-->
								<div class="tab-pane" id="about-6">
									<section id="unseen">
										<div class="panel-body">
											<div class="adv-table">
												<button class="btn btn-primary" onclick="Upsharefile('upfile_self')">上传个人文件</button>
												<!-- /btn-group -->
								            	<div class="btn-group" style="float: right;" >
							                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuS">
							                        	<?php 
							                        		require'../../conn.php';
							                        		//查询
							                        		$sqlO1 = "select OA文件6 from 表格顺序 where 用户id = '".$userid."'";
							                        		$resultO1 = $conn->query($sqlO1);
							                        		if($resultO1->num_rows>0){
							                        			while($rowO1 = $resultO1->fetch_assoc()){
							                        				$order = $rowO1['OA文件6'];
							                        			}
							                        		}
							                        		if(strlen($order)<1){
							                        			$order = '3/asc/上传时间【正】';
							                        		}
							                        		//显示
							                        		$order = explode('/',$order);
							                        		echo $order[2];
							                        	?>
							                        	<span class="caret"></span>
							                        	<span class="dynamic-table_6" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
							                        </button>
							                        <ul role="menu" class="dropdown-menu checilck" id="MenuS" ><!--OrderZL()--> 
							                            <li><a href="#">上传时间【正】</a></li>
							                            <li><a href="#">上传时间【倒】</a></li>
							                            <li><a href="#">上传人</a></li>
							                        </ul>
							                    </div>
							                    <!-- /btn-group -->
												<table  class="display table table-bordered table-striped" id="dynamic-table_6">
													<thead>
														<tr>
															<th style="width: 50px;"><input type="checkbox" onclick="SelectAll_tab(this,'dynamic-table_6')"/></th>
															<th hidden="hidden">序号</th>
															<th>文件名称</th>
															<th style="width: 180px;">上传时间</th>
															<th style="width: 180px;">上传人</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody id="share_tab">
														<?php
															require("../../conn.php");
															$sql="SELECT id,上传人,上传时间,文件路径 FROM 个人文件 WHERE 删除状态='0' AND 上传用户id='".$userid."' ORDER BY id ";
															$result = $conn->query($sql);
															if($result->num_rows > 0){
																while($row = $result->fetch_assoc()){
																?>
																<tr>
																	<th><input type="checkbox" id="<?php echo $row['id']; ?>" /></th>
																	<td hidden="hidden"><?php echo $row['id']; ?></td>
																	<td><?php echo pathinfo($row['文件路径'],PATHINFO_BASENAME); ?></td>
																	<td><?php echo $row['上传时间']; ?></td>
																	<td><?php echo $row['上传人']; ?></td>
																	<td>
																		<a class="btn btn-primary" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row['文件路径']; ?>" >下载</a>
																		<button class="btn btn-danger"  onclick="Del_shareone('<?php echo $row['id']; ?>','delself_one')" >删除</button>
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
										</div>
										<div align="center">
											<button class="btn btn-primary" onclick="DeleteAll_tab('dynamic-table_6','DeleteAll_self')">
											批量删除
											</button>
											&nbsp;&nbsp;
											<button class="btn btn-primary" onclick="DownloadAll_tab('dynamic-table_6','self_downfile')">
											批量下载
											</button>
										</div>
									</section>
								</div>
								<!--个人文件页面 end-->
							</div>
						</div>

						<!--body wrapper end-->

				</div>
				<!-- main content end-->
		</section>

		<!-- Placed js at the end of the document so the pages load faster -->
		<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/modernizr.min.js"></script>
		<script src="../../js/jquery.nicescroll.js"></script>

		<!--dynamic table-->

		<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

		<!--页数跳转-->
		<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
		<!--dynamic table initialization 搜索 -->
		<!--<script src="../../js/dynamic_table_init.js"></script>-->

		<!--pickers plugins-->
		<script type="text/javascript" src="../../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="../../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script type="text/javascript" src="../../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

		<!--pickers initialization-->
		<script src="../../js/pickers-init.js"></script>

		<!--common scripts for all pages-->
		<script src="../../js/scripts.js"></script>
		<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
		<!--个人连接js文件-->
		<script src="../../js/imitation_2/mailmas.js"></script>
		<!--about 常态-->
		<script src="../../js/NormalS-2.js"></script>
		<script>
			//原“js/dynamic_table_init.js”文件
			function fnFormatDetails ( oTable, nTr )
		{
		    var aData = oTable.fnGetData( nTr );
		    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
		    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
		    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
		    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
		    sOut += '</table>';
		
		    return sOut;
		}
		
		$(document).ready(function() {
			//获取节点
			var tab1 = $(".dynamic-table").html();//获取排序表1
			var tab2 = $(".dynamic-table_2").html();//获取排序表2
			var tab3 = $(".dynamic-table_3").html();//获取排序表3
			var tab4 = $(".dynamic-table_4").html();//获取排序表4
			var tab5 = $(".dynamic-table_5").html();//获取排序表5
			var tab6 = $(".dynamic-table_6").html();//获取排序表5
		//	alert($(".dynamic-table").html());
			//拆分数据
			var turn1 = tab1.split('/');
			var turn2 = tab2.split('/');
			var turn3 = tab3.split('/');
			var turn4 = tab4.split('/');
			var turn5 = tab5.split('/');
			var turn6 = tab6.split('/');
			//排序设置
		    $('#dynamic-table').dataTable( {
		        "aaSorting": [[ turn1[0], turn1[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
			$('#dynamic-table_2').dataTable( {
		        "aaSorting": [[ turn2[0], turn2[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_3').dataTable( {
		        "aaSorting": [[ turn3[0], turn3[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_4').dataTable( {
		        "aaSorting": [[ turn4[0], turn4[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_5').dataTable( {
		        "aaSorting": [[ turn5[0], turn5[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_6').dataTable( {
		        "aaSorting": [[ turn6[0], turn6[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_7').dataTable( {
		        "aaSorting": [[ turn6[0], turn6[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    $('#dynamic-table_8').dataTable( {
		        "aaSorting": [[ turn6[0], turn6[1] ]],
		        "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
		    } );
		    /*
		     * Insert a 'details' column to the table
		     */
		    var nCloneTh = document.createElement( 'th' );
		    var nCloneTd = document.createElement( 'td' );
		    nCloneTd.innerHTML = '<img src="images/details_open.png">';
		    nCloneTd.className = "center";
		
		    $('#hidden-table-info thead tr').each( function () {
		        this.insertBefore( nCloneTh, this.childNodes[0] );
		    } );
		
		    $('#hidden-table-info tbody tr').each( function () {
		        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
		    } );
		
		    /*
		     * Initialse DataTables, with no sorting on the 'details' column
		     */
		    var oTable = $('#hidden-table-info').dataTable( {
		        "aoColumnDefs": [
		            { "bSortable": false, "aTargets": [ 0 ] }
		        ],
		        "aaSorting": [[1, 'asc']]
		    });
		
		    /* Add event listener for opening and closing details
		     * Note that the indicator for showing which row is open is not controlled by DataTables,
		     * rather it is done here
		     */
		    $(document).on('click','#hidden-table-info tbody td img',function () {
		        var nTr = $(this).parents('tr')[0];
		        if ( oTable.fnIsOpen(nTr) )
		        {
		            /* This row is already open - close it */
		            this.src = "images/details_open.png";
		            oTable.fnClose( nTr );
		        }
		        else
		        {
		            /* Open this row */
		            this.src = "images/details_close.png";
		            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
		        }
		    } );
		} );
		</script>
		<script>
			//设置排序
			$(".checilck > li").click(function(){
				var czyid = $("#czyid").val();
				var aim  = $(this).parent().attr("id");//获取点击的位置的父id
				var text = $(this).html();//获取排序方式
				var Text = text.substr(12,text.length-16);
				var ch = document.getElementsByName(aim)[0].innerHTML;
		//		alert(ch);
				$.ajax({
					url:'../../OrderChange.php',
					type:'get',
					async:true,
					data:{
						falg:aim,//判断表格的依据
						order:Text,
						czyid:czyid,
						page:'OAFILE'
					},
					success:function(data){
						window.location.reload();
					},
					error:function(){
						alert('false');
					}
				});
			});
		</script>
		
	</body>
</html>
