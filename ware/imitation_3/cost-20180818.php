<?php 
	require_once '../../update_remind_day.php';
	require'../../AHeader.php'; 
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

  <title>专利其他费用</title>
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
			Create_leftlist(2,0);
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
                  	<!--	待通知，查专案费用查询 通知书状态为0
                  			待缴费，查专案待缴费 费用状态为0
                  			待收据，查专案待缴费  费用状态=2 and 收据上传日期 ='0'
                  			已完成，查费用状态='3'
                  	-->
                  	<!--	专案待缴费的费用状态，专案费用查询的费用状态，专案需交费用的状态为相同的东西
                  			其中，0为新建状态，2为已经缴费状态，3为已经收据状态【即已完成状态】
                  	-->
                    <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>待通知</a></li>
                    <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>待缴费</a></li>
                    <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>待收据</a></li>
                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
                  	<li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>监控中</a></li>
                  	<li class="about-6"><a href="#about-6" data-toggle="tab" class="info-number"><i class="fa fa-user"></i>授权通知书</a></li><!--<span class="badge">2</span>-->
                  	<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
                  	<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
                  </ul>
                </header>
                <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
					<div class="tab-content">
						<div class="tab-pane" id="about-1">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="通知" onclick="Info_Ing()" />
		                  	<!--<input class="btn btn-primary" type="button" id="" name="" value="导出授权通知" onclick="send_all('dynamic-table')" />-->
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table','delete_djf','cost_del.php')">删除选中的行</button>
			                    <!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用1 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用1'];
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
<!--//		                        	<span class="dynamic-table" hidden="hidden" ><?php //echo $order[0].'/'.$order[1]; ?></span>-->
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">登记费</a></li>
		                            <li><a href="#">年费</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table')" /></th>
		                					<th style="width: 100px;">案卷号</th>
		                					<th style="width: 100px;">申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th style="width: 200px;">费用名</th>
		                					<th style="width: 100px;">金额</th>
		                					<th style="width: 100px;">截止日期</th>
		                					<th>申请人</th>
		                					<th style="width: 100px;">申请日</th>
		                					<th>专利名称</th>
		                					<th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql01 = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,通知书名,缴费文件名,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期  from  专案待缴费  where 费用状态=8";
			                      		$result01 = $conn->query($sql01);
			                      		if($result01->num_rows > 0){
			                      			$row_num =0;
			                      			while($row01 = $result01->fetch_assoc()){
			                      				$row_num ++ ;
											        ?>
				        				<tr>
				        					<th><input type="checkbox" id="<?php echo $row01["id"]; ?>" /> </th>
				        					<td><?php echo $row01["案卷号"]; ?></td>
				        					<td><?php echo $row01["申请号"]; ?></td>
				        					<td hidden="hidden"><?php echo $row01["id"]; ?></td>
				        					<td><?php echo $row01["费用名称"]; ?></td>
				        					<td><?php echo $row01["金额"]; ?></td>
				        					<td><?php echo $row01["缴费期限"]; ?></td>
				        					<td><?php echo $row01["申请人"]; ?></td>
				        					<td><?php echo $row01["申请日"]; ?></td>
				        					<td><?php echo $row01["专利名称"]; ?></td>
				        					<td>
				        						<input type="button" class="btn btn-danger" id="<?php echo $row01["id"]; ?>" value="删除" onclick="delf(this.id)" />
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
		            	<div class="tab-pane" id="about-2">
		                  <section id="unseen">
		                  	<!--<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_2','delete_djf','cost_del.php')">删除选中的行</button>-->
		                  	<!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用4 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用4'];
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
		                        	<span class="dynamic-table_2" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuT" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">费用种类</a></li>
		                            <li><a href="#">金额</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
			                        <thead>
	            				<tr>
                					<th style="width: 50px;"><input type="checkbox" id="che_all_2" onclick="selectAll(this,'dynamic-table_2')" /></th>
                					<th style="width: 100px;">案卷号</th>
                					<th style="width: 100px;">申请号</th>
                					<th hidden="hidden">id</th>
                					<th style="width: 100px;">缴费时间</th>
                					<th>申请人</th>
                					<th style="width: 100px;">申请日</th>
                					<th>专利名称</th>
                					<th style="width: 200px;">收据</th>
                					<!--<th>操作</th>-->
		                    	</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,缴费时间,`申请号`,费用名称,通知书名,缴费文件名,`金额`,`缴费期限`,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期,文件名  from  专案待缴费  where 费用状态='3' and 收据上传日期 !='0' and 费用状态<>9 group by 文件名 ";
										$result = $conn->query($sql);
										$row_num = '';
					        			if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				$row_num ++ ;
					        		?>
			        				<tr>
			        					<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /></th>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
			        					<!--<td><?php //echo $row["费用名称"]; ?></td>-->
			        					<!--<td><?php //echo $row["金额"]; ?></td>-->
			        					<td><?php echo $row["缴费时间"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
			        					<td><a target="_blank" href="../../img_receipt/<?php echo $row["文件名"]; ?>" ><?php echo $row["文件名"]; ?></a></td>
			        					<!--<td>
			        						<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
			        					</td>-->
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
	            	<div class="tab-pane" id="about-3">
		                  <section id="unseen">
		                	<input class="btn btn-primary" type="button" id="" name="" value="合并缴费" onclick="fare_all('dynamic-table_3')" />
		                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_3','delete_djf','cost_del.php')">删除选中的行</button>
			                    <!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用2 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用2'];
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
		                        	<span class="dynamic-table_3" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuW" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">费用种类</a></li>
		                            <li><a href="#">金额</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_3')" /></th>
		                					<th style="width: 100px;">案卷号</th>
		                					<th style="width: 100px;">申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th style="width: 200px;">费用种类</th>
		                					<th style="width: 100px;">缴费金额</th>
		                					<th style="width: 100px;">截止日期</th>
		                					<th>申请人</th>
		                					<th style="width: 100px;">申请日</th>
		                					<th>专利名称</th>
		                					<th style="width: 160px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,申请人,申请日,`专利名称`,通知书名 ,缴费文件名,`收据编号`,`费用状态`,收据上传日期,通知书生成日期 from  专案待缴费  where 费用状态=1  ";
										$result = $conn->query($sql);
										$row_num = '';
					        			if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				$row_num ++ ;
					        		?>
			        				<tr>
			        					<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /> </th>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>" ><?php echo $row["id"]; ?></td>
			        					<td><?php echo $row["费用名称"]; ?></td>
			        					<td><?php echo $row["金额"]; ?></td>
			        					<td><?php echo $row["缴费期限"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
			        					<td>
			        						<a class="btn btn-default" id="<?php echo $row["id"]; ?>" data-toggle="modal" href="#addModal" onclick="Cost_alter(this)">修改</a>
			        						<input type="button" class="btn btn-danger" id="<?php echo $row["id"]; ?>" value="删除" onclick="delf(this.id)" />
			        						<!--btn-primary-->
			        						<!--<input type="button" id="<?php echo $row["id"]; ?>" href="#addModal" value="修改" />-->
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
		            	<div class="tab-pane" id="about-4">
		                  <section id="unseen">
		                	<input class="btn btn-primary" type="button" id="" name="" value="合并收据" onclick="shouju_all('dynamic-table_4') " />
		                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_4','delete_djf','cost_del.php')">删除选中的行</button>
			                    <!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用3 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用3'];
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
		                        	<span class="dynamic-table_4" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuF" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">费用种类</a></li>
		                            <li><a href="#">金额</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_4">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_4')" /></th>
		                					<th style="width: 100px;">案卷号</th>
		                					<th style="width: 100px;">申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th style="width: 200px;">费用种类</th>
		                					<th style="width: 100px;">缴费金额</th>
		                					<th style="width: 100px;">缴费日期</th>
		                					<th>申请人</th>
		                					<th style="width: 100px;">申请日</th>
		                					<th>专利名称</th>
		                					<th style="width: 60px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,缴费时间,`申请号`,费用名称,`金额`,`缴费期限`,通知书名,缴费文件名,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期  from  专案待缴费  where 费用状态='2' and 收据上传日期='0' or 收据上传日期 = ''";
										$result = $conn->query($sql);
										$row_num = '';
					        			if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				$row_num ++ ;
					        ?>
			        				<tr>
			        					<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /> </th>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
			        					<td><?php echo $row["费用名称"]; ?></td>
			        					<td><?php echo $row["金额"]; ?></td>
			        					<td><?php echo $row["缴费时间"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
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
		            	<div class="tab-pane" id="about-5">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="提前通知" onclick="Info_Befo()" />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_5','delete_djf','cost_del.php')">删除选中的行</button>
			                    <!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用1 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用1'];
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
		                        	<span class="dynamic-table_5" hidden="hidden" >1/asc/案卷号</span>
		                        <!--</button>
		                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
		                            <li><a href="#">案卷号</a></li>
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">登记费</a></li>
		                            <li><a href="#">年费</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_5">
			                        <thead>
				            			<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_5')" /></th>
		                					<th style="width: 100px;">案卷号</th>
		                					<th style="width: 100px;">申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th style="width: 200px;">费用名称</th>
		                					<th style="width: 100px;">金额</th>
		                					<th style="width: 100px;">缴费期限</th>
		                					<th>申请人</th>
		                					<th style="width: 100px;">申请日</th>
		                					<th>专利名称</th>
		                					<th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
													    <?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,通知书名,缴费文件名,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期  from  专案待缴费  where 费用状态=0";
										$result = $conn->query($sql);
										$row_num = '';
					        			if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				$row_num ++ ;
					        ?>
			        				<tr>
			        					<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /> </th>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden"><?php echo $row["id"]; ?></td>
			        					<td><?php echo $row["费用名称"]; ?></td>
			        					<td><?php echo $row["金额"]; ?></td>
			        					<td><?php echo $row["缴费期限"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
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
		            	<!--tab-05 end-->
		            	<div class="tab-pane" id="about-6">
		                  <section id="unseen">
		                  		<!-- /btn-group -->
						            	<!--<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
		                        	<?php 
//		                        		require'../../conn.php';
//		                        		//查询
//		                        		$sqlO1 = "select 费用1 from 表格顺序 where 用户id = '".$userid."'";
//		                        		$resultO1 = $conn->query($sqlO1);
//		                        		if($resultO1->num_rows>0){
//		                        			while($rowO1 = $resultO1->fetch_assoc()){
//		                        				$order = $rowO1['费用1'];
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
		                            <li><a href="#">申请号【正】</a></li>
		                            <li><a href="#">申请号【倒】</a></li>
		                            <li><a href="#">登记费</a></li>
		                            <li><a href="#">年费</a></li>
		                            <li><a href="#">截止日期【正】</a></li>
		                            <li><a href="#">截止日期【倒】</a></li>
		                            <li><a href="#">申请人</a></li>
		                            <li><a href="#">申请日【正】</a></li>
		                            <li><a href="#">申请日【倒】</a></li>
		                            <li><a href="#">专利名称</a></li>
		                        </ul>
		                    </div>-->
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_6">
			                        <thead>
			            				<tr>
		                					<th style="width: 50px;"><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_6')" /></th>
		                					<th style="width: 100px;">案卷号</th>
		                					<th style="width: 100px;">操作人</th>
		                					<th>申请人</th>
		                					<th style="width: 100px;">生成日期</th>
		                					<th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
										<?php
			                      			require("../../conn.php");
			                      			$sql = "SELECT * from  授权通知书信息 order by 创建时间";
											$result = $conn->query($sql);
						        			if($result->num_rows > 0){
							        			while($row = $result->fetch_assoc()){
							        				//获取申请人
	                        						$SQRMes = '';
			                        				$sql_SSqr ="select 申请人 from 申请人 where FIND_IN_SET(id,'".$row["申请人id"]."')";
			                        				$result_SSqr = $conn->query($sql_SSqr);
			                        				if($result_SSqr->num_rows > 0){
			                        					while($row_SSqr = $result_SSqr -> fetch_assoc()){
			                        						$SQRMes .= ",".$row_SSqr['申请人'];
			                        					}
			                        				}
			                        				$SQRMes = substr($SQRMes,1);
									        ?>
					        				<tr>
					        					<th><input type="checkbox" id="<?php echo $row["id"]; ?>" /> </th>
					        					<td><?php echo $row["案卷号"]; ?></td>
					        					<td><?php echo $row["创建人"]; ?></td>
					        					<td><?php echo $SQRMes; ?></td>
					        					<td><?php echo $row["创建时间"]; ?></td>
					        					<td>
					        						<a type="button" class="btn btn-danger" href="../../filesave_notice/<?php echo $row["文件路径"]; ?>" >下载</a>
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
				   </section>   
        	</div>
        </div>
        </div>		
				<!--body wrapper end-->

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

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--页面响应-->
<script src="../../js/imitation_3/cost.js" ></script>
<!--全选-->
<script src="../../js/page_else.js" ></script>
<!--删除费用操作-->
<script src="../../js/fare_del.js"></script>
<!--about 常态-->
		<script src="../../js/NormalS-2.js"></script>
		<script src="../../js/dynamic-table-6.js"></script>
		<script src="../../js/imitation_3/Cost_Main.js"></script>
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
				page:'ZLCost'
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
