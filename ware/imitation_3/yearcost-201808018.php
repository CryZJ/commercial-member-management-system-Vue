<?php 
//	/*每次登录更新数据库的剩余天数*/
	require_once '../../update_remind_day.php';
	require'../../AHeader.php'; 
	$flag=$_REQUEST['flag'];
	$v=$_REQUEST['v'];
	if(strlen($v)==0){
		$flag='none';
		$v=0;
	}
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>专利年费管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link href="../../js/data-tables/DT_bootstrap.css" rel="stylesheet" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="../../js/jquery-1.10.2.min.js"></script> 

  <style>
  	.btn2{  
		  background-color:#3E8CD0;  
		  color:white;
		}  
  </style>
  
	<!--<script text="text/javascript">
	     new RegExp("(^|&)"+name+"=([^&]*)").exec(window.location.search.substr(1));
//	     alert(RegExp.$2) ;
	     if(RegExp.$1.length==0){
	     	alert('请重新');
	     }
	</script>-->

</head>

<body class="sticky-header" >

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
		<?php
			//创建左边菜单栏 
			require("../../menu_tree.php"); 
			Create_leftlist(2,1);
		?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content" >
				
        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
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
	                    <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>待通知</a></li>
	                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>待缴费</a></li>
	                    <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>待收据</a></li>
	                    <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
	                    <li class="about-6"><a href="#about-6" data-toggle="tab"><i class="fa fa-user"></i>监控中</a></li>
	                    <li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>总查询</a></li>
	                  	<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
	                  	<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
	                  </ul>
	                </header>
				<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
					<div class="tab-content">
						<!--待通知-->
						<div class="tab-pane " id="about-1">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并通知" onclick="send_all('dynamic-table')" />
			                <button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table','fee_dtz')">删除本页选中行</button>    
			                    <!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 年费1 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['年费1'];
//		                        			}
//		                        		}
//		                        		if(strlen($order)<1){
//		                        			$order = '1/asc/案卷号';
//		                        		}
//		                        		//显示
//		                        		$order = explode('/',$order);
//		                        		echo $order[2];
		                        	?>
		                        	<!--<span class="caret"></span>-->
		                        	<span class="dynamic-table" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">专利名</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">年度</a></li>
		                            <li><a href="#">金额</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">剩余天数【正】</a></li>
		                            <li><a href="#">剩余天数【倒】</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table')" /></th>
					                  		<th class="numeric" style="width: 100px;">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<!--<th hidden="hidden" class="numeric">id</th>-->
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric" style="width: 100px;">申请号</th>
				                            <th class="numeric" style="width: 100px;">申请日</th>
				                            <th class="numeric" style="width: 60px;">年度</th>
				                            <th class="numeric" style="width: 100px;">金额</th>
				                            <th class="numeric" style="width: 100px;">截止日期</th>
				                            <th class="numeric" style="width: 100px;">剩余天数</th>
				                            <th class="numeric" style="width: 140px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	<!--费用的状态等于0，则为正常，为9为已经删除-->
			                      	<?php
										require'../../conn.php';
										$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态=8";
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
								    ?>
					                        <tr>
												<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
											 	<!--<td hidden="hidden" ><?php echo $row["id"];?></td>-->
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<td><?php echo $row["应缴日期"];?></td>
											 	<td><?php echo $row["剩余天数"];?></td>
											 	<td>
											 		<a class="btn btn-default" id="<?php echo $row["id"]; ?>" data-toggle="modal" href="#addModal" onclick="Cost_alter(this)">修改</a>
					        						<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
											 	</td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-01 end-->
		            	<!--待缴费-->
		            	<div class="tab-pane" id="about-2">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并缴费" onclick="fare_all('dynamic-table_2')" />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_2','fee_dtz')">删除本页选中行</button> 
			                    <!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
			                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">-->
			                        	<?php 
//			                        		require'../../conn.php';
//			                        		//查询
//			                        		$sqlO1 = "select 年费2 from 表格顺序 where 用户id = '".$userid."'";
//			                        		$resultO1 = $conn->query($sqlO1);
//			                        		if($resultO1->num_rows>0){
//			                        			while($rowO1 = $resultO1->fetch_assoc()){
//			                        				$order = $rowO1['年费2'];
//			                        			}
//			                        		}
//			                        		if(strlen($order)<1){
//			                        			$order = '1/asc/案卷号';
//			                        		}
//			                        		//显示
//			                        		$order = explode('/',$order);
//			                        		echo $order[2];
			                        	?>
			                        	<!--<span class="caret"></span>-->
			                        	<span class="dynamic-table_2" hidden="hidden" >1/asc/案卷号</span>
			                        <!--</button>
			                        <ul role="menu" class="dropdown-menu checilck" id="MenuT" >
			                            <li><a href="#">案卷号</a></li>
			                            <li><a href="#">专利名</a></li>
			                            <li><a href="#">申请人</a></li>
			                            <li><a href="#">申请号【正】</a></li>
			                            <li><a href="#">申请号【倒】</a></li>
			                            <li><a href="#">申请日【正】</a></li>
			                            <li><a href="#">申请日【倒】</a></li>
			                            <li><a href="#">年度</a></li>
			                            <li><a href="#">金额</a></li>
			                            <li><a href="#">截止日期【正】</a></li>
			                            <li><a href="#">截止日期【倒】</a></li>
			                            <li><a href="#">剩余天数【正】</a></li>
			                            <li><a href="#">剩余天数【倒】</a></li>
			                            <li><a href="#">通知时间【正】</a></li>
			                            <li><a href="#">通知时间【倒】</a></li>
			                        </ul>
			                    </div>-->
			                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_2')" /></th>
					                  		<th class="numeric" style="width: 100px;">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<!--<th hidden="hidden" class="numeric">id</th>-->
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric" style="width: 100px;">申请号</th>
				                            <th class="numeric" style="width: 100px;">申请日</th>
				                            <th class="numeric" style="width: 60px;">年度</th>
				                            <th class="numeric" style="width: 100px;">金额</th>
				                            <!--<th class="numeric">代理人</th>-->
				                            <th class="numeric" style="width: 100px;">截止日期</th>
				                            <th class="numeric" style="width: 100px;">剩余天数</th>
				                            <th class="numeric" style="width: 100px;">通知时间</th>
				                            <th class="numeric" style="width: 160px;">通知书</th>
				                            <th class="numeric" style="width: 140px;">操作</th>
				                            <!--<th class="numeric">收据状态</th>-->
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
										require'../../conn.php';
										$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,通知书名,年度,金额,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态=1";
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
								    ?>
					                        <tr>
												<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
											 	<!--<td hidden="hidden" ><?php echo $row["id"];?></td>-->
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<!--<td><?php echo $row["代理人"];?></td>-->
											 	<td><?php echo $row["应缴日期"];?></td>
											 	<td><?php echo $row["剩余天数"];?></td>
											 	<td><?php echo $row["通知书生成日期"];?></td>
											 	<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
					        					</td>
											 	<!--<td><?php echo $row["收据上传日期"];?></td>-->
											 	<td>
											 		<a class="btn btn-default" id="<?php echo $row["id"]; ?>" data-toggle="modal" href="#addModal" onclick="Cost_alter(this)">修改</a>
					        						<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
											 	</td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
	            	</div>
	            	<!--tab-02 end-->
	            	<!--待收据-->
	            	<div class="tab-pane" id="about-3">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并收据" onclick="shouju_all('dynamic-table_3') " />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_3','fee_dtz')">删除本页选中行</button>
			                    <!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
			                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">-->
			                        	<?php 
//			                        		require'../../conn.php';
//			                        		//查询
//			                        		$sqlO1 = "select 年费3 from 表格顺序 where 用户id = '".$userid."'";
//			                        		$resultO1 = $conn->query($sqlO1);
//			                        		if($resultO1->num_rows>0){
//			                        			while($rowO1 = $resultO1->fetch_assoc()){
//			                        				$order = $rowO1['年费3'];
//			                        			}
//			                        		}
//			                        		if(strlen($order)<1){
//			                        			$order = '1/asc/案卷号';
//			                        		}
//			                        		//显示
//			                        		$order = explode('/',$order);
//			                        		echo $order[2];
			                        	?>
			                        	<!--<span class="caret"></span>-->
			                        	<span class="dynamic-table_3" hidden="hidden" >1/asc/案卷号</span>
			                        <!--</button>
			                        <ul role="menu" class="dropdown-menu checilck" id="MenuW" >
			                            <li><a href="#">案卷号</a></li>
			                            <li><a href="#">专利名</a></li>
			                            <li><a href="#">申请人</a></li>
			                            <li><a href="#">申请号【正】</a></li>
			                            <li><a href="#">申请号【倒】</a></li>
			                            <li><a href="#">申请日【正】</a></li>
			                            <li><a href="#">申请日【倒】</a></li>
			                            <li><a href="#">年度</a></li>
			                            <li><a href="#">金额</a></li>
			                            <li><a href="#">截止日期【正】</a></li>
			                            <li><a href="#">截止日期【倒】</a></li>
			                            <li><a href="#">剩余天数【正】</a></li>
			                            <li><a href="#">剩余天数【倒】</a></li>
			                            <li><a href="#">通知时间【正】</a></li>
			                            <li><a href="#">通知时间【倒】</a></li>
			                            <li><a href="#">缴费时间【正】</a></li>
			                            <li><a href="#">缴费时间【倒】</a></li>
			                        </ul>
			                    </div>-->
			                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_3')" /></th>
					                  		<th class="numeric" style="width: 100px;">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric" style="width: 100px;">申请号</th>
				                            <th class="numeric" style="width: 100px;">申请日</th>
				                            <th class="numeric" style="width: 100px;">年度</th>
				                            <th class="numeric" style="width: 100px;">金额</th>
				                            <th class="numeric" style="width: 100px;">通知书</th>
				                            <th class="numeric" style="width: 100px;">缴费时间</th>
				                            <th class="numeric" style="width: 140px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
										require'../../conn.php';
										$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,通知书名,缴费文件名,年度,金额,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息  where 冻结状态=0 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费  where 冻结状态=0 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等 where 冻结状态=0 )) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态=2";
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
								    ?>
					                        <tr>
												<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
<!--//											 	<td hidden="hidden" ><?php echo $row["id"];?></td>-->
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<!--<td><?php echo $row["代理人"];?></td>-->
											 	<!--<td><?php echo $row["应缴日期"];?></td>-->
											 	<!--<td><?php echo $row["剩余天数"];?></td>-->
											 	<!--<td><?php echo $row["通知书生成日期"];?></td>-->
											 	<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
					        					</td>
											 	<td><?php echo $row["缴费时间"];?></td>
											 	<!--<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["缴费文件名"];?>"><?php echo $row["缴费文件名"]; ?></a>
					        					</td>-->
											 	<td>
											 		<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
											 	</td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-03 end-->
		            	<!--已完成-->
		            	<div class="tab-pane" id="about-4">
		                  <section id="unseen">
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_4','fee_dtz')">删除本页选中行</button>
		                  	<!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
			                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">-->
			                        	<?php 
//			                        		require'../../conn.php';
//			                        		//查询
//			                        		$sqlO1 = "select 年费4 from 表格顺序 where 用户id = '".$userid."'";
//			                        		$resultO1 = $conn->query($sqlO1);
//			                        		if($resultO1->num_rows>0){
//			                        			while($rowO1 = $resultO1->fetch_assoc()){
//			                        				$order = $rowO1['年费4'];
//			                        			}
//			                        		}
//			                        		if(strlen($order)<1){
//			                        			$order = '1/asc/案卷号';
//			                        		}
//			                        		//显示
//			                        		$order = explode('/',$order);
//			                        		echo $order[2];
			                        	?>
			                        	<!--<span class="caret"></span>-->
			                        	<span class="dynamic-table_4" hidden="hidden" >1/asc/案卷号</span>
			                        <!--</button>
			                        <ul role="menu" class="dropdown-menu checilck" id="MenuF" >
			                            <li><a href="#">案卷号</a></li>
			                            <li><a href="#">专利名</a></li>
			                            <li><a href="#">申请人</a></li>
			                            <li><a href="#">申请号【正】</a></li>
			                            <li><a href="#">申请号【倒】</a></li>
			                            <li><a href="#">申请日【正】</a></li>
			                            <li><a href="#">申请日【倒】</a></li>
			                            <li><a href="#">年度</a></li>
			                            <li><a href="#">金额</a></li>
			                            <!--<li><a href="#">截止日期【正】</a></li>
			                            <li><a href="#">截止日期【倒】</a></li>
			                            <li><a href="#">剩余天数【正】</a></li>
			                            <li><a href="#">剩余天数【倒】</a></li>
			                            <li><a href="#">通知时间【正】</a></li>
			                            <li><a href="#">通知时间【倒】</a></li>
			                            <li><a href="#">缴费时间【正】</a></li>
			                            <li><a href="#">缴费时间【倒】</a></li>
			                            <li><a href="#">收据时间【正】</a></li>
			                            <li><a href="#">收据时间【倒】</a></li>
			                        </ul>
			                    </div>-->
			                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_4">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_4')" /></th>
					                  		<th class="numeric" style="width: 100px;">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric" style="width: 100px;">申请号</th>
				                            <th class="numeric" style="width: 100px;">申请日</th>
				                            <th class="numeric" style="width: 100px;">年度</th>
				                            <th class="numeric" style="width: 100px;">金额</th>
				                            <th class="numeric" style="width: 100px;">通知书</th>
				                            <th class="numeric" style="width: 100px;">缴费时间</th>
				                            <th class="numeric" style="width: 100px;">收据</th>
				                            <th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
										require'../../conn.php';
										$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,通知书名,缴费文件名,金额,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期,文件名  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等  where 冻结状态=0 )) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态=3";
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
								    ?>
					                        <tr>
												<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<!--<td><?php echo $row["通知书生成日期"];?></td>-->
											 	<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
					        					</td>
											 	<td><?php echo $row["缴费时间"];?></td>
											 	<!--<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["缴费文件名"];?>"><?php echo $row["缴费文件名"]; ?></a>
					        					</td>
											 	<td><?php echo $row["收据上传日期"];?></td>-->
											 	<td><a target="_blank" href="../../img_receipt/<?php echo $row["文件名"];?>" ><?php echo $row["文件名"];?></a></td>
												<td>
													<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
												</td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-04 end-->
		            	<!--总查询-->
		            	<div class="tab-pane " id="about-5">
		                  	<section id="unseen">
			                  	<table class="#" id="table_date" hidden="hidden">
							        <tr>
							        	<th style="width:200px;">剩余天数：</th>
							        	<td><input style="width:200px;" type="text" list="distance" id="disd" onchange="showtabinfo(this.id)" value="<?php if($flag == 'disd'){echo $v;} ?>" />
							        		<datalist id="distance">
							        		<option></option>
							        		<option>3</option>
							        		<option>5</option>
							        		<option>10</option>
							        		<option>20</option>
							        		<option>30</option>
							        		<option>330</option>
							        		<option>360</option>
							        	</datalist></td>
							        	<th style="width:200px;">已过期：</th>
						        		<td><input  style="width:200px;" type="text" list="overdue" id="over" onchange="showtabinfo(this.id)" value="<?php if($flag == 'over'){echo $v;} ?>" />
							        		<datalist id="overdue">
							        		<option></option>
							        		<option>10</option>
							        		<option>15</option>
							        		<option>20</option>
							        		<option>30</option>
							        		<option>120</option>
							        		<option>150</option>
							        		<option>180</option>
							        	</overdue></td>
							        	<!--显示数据类型-->
							        	<!--<td><input  style="width:200px;" type="text" id="type_name" value="<?php echo $flag; ?>" /></td>-->
							        	<!--显示数据参数-->
							        	<!--<td><input  style="width:200px;" type="text" id="type_info" value="<?php echo $v; ?>" /></td>-->
							        </tr>
								</table>
								<!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
			                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuZ">-->
			                        	<?php 
//			                        		require'../../conn.php';
//			                        		//查询
//			                        		$sqlO1 = "select 年费5 from 表格顺序 where 用户id = '".$userid."'";
//			                        		$resultO1 = $conn->query($sqlO1);
//			                        		if($resultO1->num_rows>0){
//			                        			while($rowO1 = $resultO1->fetch_assoc()){
//			                        				$order = $rowO1['年费5'];
//			                        			}
//			                        		}
//			                        		if(strlen($order)<1){
//			                        			$order = '1/asc/案卷号';
//			                        		}
//			                        		//显示
//			                        		$order = explode('/',$order);
//			                        		echo $order[2];
			                        	?>
			                        	<!--<span class="caret"></span>-->
			                        	<span class="dynamic-table_5" hidden="hidden" >1/asc/案卷号</span>
			                        <!--</button>
			                        <ul role="menu" class="dropdown-menu checilck" id="MenuZ" >
			                            <li><a href="#">案卷号</a></li>
			                            <li><a href="#">专利名</a></li>
			                            <li><a href="#">申请人</a></li>
			                            <li><a href="#">申请号【正】</a></li>
			                            <li><a href="#">申请号【倒】</a></li>
			                            <li><a href="#">申请日【正】</a></li>
			                            <li><a href="#">申请日【倒】</a></li>
			                            <li><a href="#">年度</a></li>
			                            <li><a href="#">金额</a></li>
			                            <li><a href="#">截止日期【正】</a></li>
			                            <li><a href="#">截止日期【倒】</a></li>
			                            <li><a href="#">剩余天数【正】</a></li>
			                            <li><a href="#">剩余天数【倒】</a></li>
			                            <li><a href="#">通知时间【正】</a></li>
			                            <li><a href="#">通知时间【倒】</a></li>
			                            <li><a href="#">缴费时间【正】</a></li>
			                            <li><a href="#">缴费时间【倒】</a></li>
			                            <li><a href="#">收据时间【正】</a></li>
			                            <li><a href="#">收据时间【倒】</a></li>
			                        </ul>
			                    </div>-->
			                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_5">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_5')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<!--<th hidden="hidden" class="numeric">id</th>-->
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">截止日期</th>
				                            <th class="numeric">剩余天数</th>
				                            <th class="numeric">通知状态</th>
				                            <!--<th class="numeric">通知书</th>-->
				                            <th class="numeric">缴费状态</th>
				                            <!--<th class="numeric">缴费文件</th>-->
				                            <th class="numeric">收据状态</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
										require'../../conn.php';
										switch($flag){
											case 'disd':
												$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,通知书名,缴费文件名,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费  where 冻结状态=0 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and 状态!=9 and 剩余天数 between 0 and ".$v;
//												$sql = "SELECT id,`案卷号`,专利名称,申请人,申请号,申请日,代理人,`年度`,`金额`,`应缴日期`,缴费时间,收据上传日期,通知书生成日期,剩余天数,状态 FROM `专案年费查询` where 状态=0 and 剩余天数 between 0 and ".$v;
												break;
											case 'over':
												$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,通知书名,缴费文件名,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费  where 冻结状态=0 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and 状态!=9 and 剩余天数 between -".$v." and 0";
//												$sql = "SELECT id,`案卷号`,专利名称,申请人,申请号,申请日,代理人,`年度`,`金额`,`应缴日期`,缴费时间,收据上传日期,通知书生成日期,剩余天数,状态 FROM `专案年费查询` where 状态=0 and 剩余天数 between -".$v." and 0";
												break;
											case 'none':
												$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,通知书名,缴费文件名,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费   where 冻结状态=0 ) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态!=9";
//												$sql = "SELECT id,`案卷号`,专利名称,申请人,申请号,申请日,代理人,`年度`,`金额`,`应缴日期`,缴费时间,收据上传日期,通知书生成日期,剩余天数 FROM `专案年费查询` where 状态=0";
												break;
										}
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
							    				$messend='';
							    				$messend = $row['通知书生成日期'];
							    				if(strlen($messend)<2){
							    					$messend = '未通知';
							    				}
							    				$fareche='';
							    				$fareche = $row['缴费时间'];
							    				if(strlen($fareche)<2){
							    					$fareche = '未缴费';
							    				}
							    				$faremes='';
							    				$faremes = $row['收据上传日期'];
							    				if(strlen($faremes)<2){
							    					$faremes = '未上传';
							    				}
								    ?>
					                        <tr>
												<th><input type="checkbox" id="" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
											 	<!--<td hidden="hidden" ><?php echo $row["id"];?></td>-->
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<!--<td><?php echo $row["代理人"];?></td>-->
											 	<td><?php echo $row["应缴日期"];?></td>
											 	<td><?php echo $row["剩余天数"];?></td>
											 	<td><?php echo $messend;?></td>
											 	<!--<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
					        					</td>-->
											 	<td><?php echo $fareche;?></td>
											 	<!--<td>
					        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["缴费文件名"];?>"><?php echo $row["缴费文件名"]; ?></a>
					        					</td>-->
											 	<td><?php echo $faremes;?></td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-00 end-->
		            	<div class="tab-pane " id="about-6">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="提前通知" onclick="Info_Befo('dynamic-table_6')" />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_6','fee_dtz')">删除本页选中行</button>
			                <!--<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table','fee_dtz')">删除本页选中行</button>-->    
			                    <!-- /btn-group -->
						        <!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 年费1 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['年费1'];
//		                        			}
//		                        		}
//		                        		if(strlen($order)<1){
//		                        			$order = '1/asc/案卷号';
//		                        		}
//		                        		//显示
//		                        		$order = explode('/',$order);
//		                        		echo $order[2];
		                        	?>
		                        	<!--<span class="caret"></span>-->
		                        	<span class="dynamic-table_6" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">专利名</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">年度</a></li>
		                            <li><a href="#">金额</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">剩余天数【正】</a></li>
		                            <li><a href="#">剩余天数【倒】</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_6">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_6')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">截止日期</th>
				                            <th class="numeric">剩余天数</th>
				                            <th class="numeric">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	<!--费用的状态等于0，则为正常，为9为已经删除-->
			                      	<?php
										require'../../conn.php';
										$sql = "SELECT id,c.案卷号,专利名称,申请人,申请号,申请日,年度,金额,应缴日期,剩余天数,通知书生成日期,缴费时间,收据上传日期  FROM ((SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专利信息   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_年费   where 冻结状态=0) UNION (SELECT 案卷号,专利名称,申请人,申请号,申请日 FROM 专案_复审等   where 冻结状态=0)) as c ,`专案_年费记录` d where c.案卷号 = d.`案卷号` and d.状态=0";
										$result = $conn->query($sql);
						        		if($result->num_rows > 0){
							    			while($row = $result->fetch_assoc()){
								    ?>
					                        <tr>
												<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
											 	<td><?php echo $row["案卷号"];?></td>
											 	<td><?php echo $row["专利名称"];?></td>
											 	<td hidden="hidden" ><?php echo $row["id"];?></td>
											 	<td><?php echo $row["申请人"];?></td>
											 	<td><?php echo $row["申请号"];?></td>
											 	<td><?php echo $row["申请日"];?></td>
											 	<td><?php echo $row["年度"];?></td>
											 	<td><?php echo $row["金额"];?></td>
											 	<td><?php echo $row["应缴日期"];?></td>
											 	<td><?php echo $row["剩余天数"];?></td>
											 	<td>
<!--//											 		<a class="btn btn-default" id="<?php echo $row["id"]; ?>" data-toggle="modal" href="#addModal" onclick="Cost_alter(this)">修改</a>-->
					        						<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
											 	</td>
											</tr>
									<?php
			                        		}
			                        	}
			                        	$conn->close();
									?>
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-06 end-->
		        	</div>
	        	</div>
	<!--修改费用模态框 start-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">费用修改</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form">
							<input type="text" id="cost_id" hidden="hidden" value="" />
					 		<div class="form-group">
            		<label class="control-label col-md-4">费用：</label>
                	<div class="col-md-6 col-xs-11">
                		<input class="form-control form-control-inline input-medium" id="cost_value"  type="text"  />
                	</div>
            	</div>
						</form>
		        <div class="modal-footer" align="center">
		        	<button id="save_add" data-dismiss="modal" class="btn btn-primary" onclick="Save_alterdata()">保存</button>
		          <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
		        </div>
		      </div>
        </div>
    </div>
    <!--修改费用模态框 end-->
	        	
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

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--页面响应函数集-->
<script src="../../js/imitation_3/yearcost.js" ></script>
<!--全选-->
<script src="../../js/page_else.js" ></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<script src="../../js/dynamic-table-6.js"></script>
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
				page:'YEARC'
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
