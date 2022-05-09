<?php require'../../AHeader.php'; ?>

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
</head>

<body class="sticky-header">
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="../../remind.php"><img src="../../images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="../../index.php"><img src="../../images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
		 		<li class="menu-list"><a href="../../index.php"><i class="fa fa-laptop"></i><span>案件管理</span></a>
			  <ul class="sub-menu-list">
                <li><a href="../../index.php">专利案件</a></li>
                <li><a href="../imitation_1/blogo_case/blogo.php">商标案件</a></li>
                <li><a href="../imitation_1/software_case/software.php">软件案件</a></li>
                <li><a href="../imitation_1/works_case/works.php">著作案件</a></li>
                <li><a href="../imitation_1/customs_case/customes.php">海关备案</a></li>
              </ul>
             </li>
             	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>OA办公</span></a>
             		<ul class="sub-menu-list">
             			<li><a href="../imitation_2/mailmas.php">文件收发</a></li>
             			<li><a href="../imitation_2/exdelmas.php">快递收发</a></li>
             			<li><a href="../imitation_2/casemark.php">案件登记</a></li>
             			<li><a href="../imitation_2/dateworks.php">日程管理</a></li>
             			<li><a href="../imitation_2/ClieMag.php">客户管理</a></li>
             		</ul>
             	</li>
            	<li class="menu-list nav-active"><a href=""><i class="fa fa-laptop"></i> <span>费用管理</span></a>
            		<ul class="sub-menu-list">
		                <li class="active"><a href="../imitation_3/cost.php">专利其他费用</a></li>
		                <li><a href="../imitation_3/yearcost.php?flag=none&v=0">专利年费管理</a></li>
		                <li><a href="../imitation_3/cost_zl.php">其他费用管理</a></li>
	                </ul>
              	</li>
             	<li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>人员管理</span></a>
             		<ul class="sub-menu-list">
		                <li><a href="../imitation_5/client.php"> 申请人管理</a></li>
		                <li><a href="../imitation_5/agent.php">账号管理</a></li>
		            </ul>
	            </li>
	            <?php
	            	require'../../conn.php';
	            	$sql = "select sys_set,fare_con from 用户 where id='".$userid."'";
	            	$result = $conn->query($sql);
	            	if($result -> num_rows>0){
	            		while($row = $result->fetch_assoc()){
	            			$sysset = $row['sys_set'];
	            			$fareco = $row['fare_con'];
	            		}
	            	}
	            	
	            	if($sysset == 1){
	            		?>
	            		<li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>系统设置</span></a>
			                <ul class="sub-menu-list">
				                <!--<li><a href="../imitation_7/yfare_set.php">年费设置</a></li>-->
				                <li><a href="../imitation_7/bank_set.php">银行账户设置</a></li>
				            	<li><a href="../imitation_7/fare_set.php">专案费用名设置</a></li>
				            	<li><a href="../imitation_7/BLogoC_set.php">商标代理人设置</a></li>
											<li><a href="../imitation_7/Circuit_set.php">流程设置</a></li>
				            </ul>
			            </li>
	            		<?php
	            	}
	            	if($fareco == 1){
	            		?>
	            		 <li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>财务管理</span></a>
		                	<ul class="sub-menu-list">
				                <li><a href="../imitation_6/financial-management.php">财务管理</a></li>
				            </ul>
		                </li>
	            		<?php
	            	}
	            ?>
                <li><a href="../../login.php"><i class="fa fa-sign-in"></i> <span>账号注销</span></a></li>
    		</ul>
            <!--sidebar nav end-->

        </div>
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
                  			已完成，查费用状态='3'-->
                  			<!--专案待缴费的费用状态，专案费用查询的费用状态，专案需交费用的状态为相同的东西
                  			其中，0为新建状态，2为已经缴费状态，3为已经收据状态【即已完成状态】-->
                    <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>待通知</a></li>
                    <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>待缴费</a></li>
                    <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>待收据</a></li>
                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
                  	<li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>监控中</a></li>
                  	<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
                  	<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
                  </ul>
                </header>
                <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
					<div class="tab-content">
						<div class="tab-pane" id="about-1">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并通知" onclick="send_all('dynamic-table')" />
			                    <!-- /btn-group -->
						            	<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
		                        	<?php 
		                        		require'../../conn.php';
		                        		//查询
		                        		$sqlO1 = "select 费用1 from 表格顺序 where 用户id = '".$userid."'";
		                        		$resultO1 = $conn->query($sqlO1);
		                        		if($resultO1->num_rows>0){
		                        			while($rowO1 = $resultO1->fetch_assoc()){
		                        				$order = $rowO1['费用1'];
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
		                    </div>
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th>登记费</th>
		                					<th>年费</th>
		                					<th>截止日期</th>
		                					<th>申请人</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql01 = "SELECT id,`案卷号` from 专利信息  where 授权时间<>'0000-00-00' and 冻结状态=0 and 通知书状态=0 order by 案卷号 asc";
			                      		$result01 = $conn->query($sql01);
			                      		if($result01->num_rows > 0){
			                      			while($row01 = $result01->fetch_assoc()){
			                      				$ajh = $row01['案卷号'];
					                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,申请人,申请日,`专利名称` ,通知书生成日期  from 专案费用查询  where 案卷号='".$ajh."' order by 案卷号 asc";
																		$result = $conn->query($sql);
																		$row_num = 0;$remarkf=0;$yearf=0;
													        			if($result->num_rows > 0){
														        			while($row = $result->fetch_assoc()){
														        				$casenum = $row["案卷号"];
														        				if(isset($caselast)){//判断变量是否定义
														        				}else{
														        					$caselast = $casenum;
														        				}
														        				//计算费用
														        				if($casenum == $caselast){ //如果新一行案卷号和上一行案卷号相同，则进行统计
														        					if($row["费用名称"]=='印花费'||$row["费用名称"]=='公布印刷费'||$row["费用名称"]=='登记费'){
															        					$remarkf = $remarkf+$row["金额"];
															        				}else if($row["费用名称"]=='年费'){
															        					$yearf	 = $row["金额"];
															        				}
															        				$sqh = $row["申请号"];
																        			$dateline = $row["缴费期限"];
																        			$sqr = $row["申请人"];
																        			$sqd = $row["申请日"];
																        			$zlm = $row["专利名称"];
								//							        				echo "<script type='text/javascript'>alert('".$remarkf."');</script>";
														        				}else{
															        				$row_num ++ ;
													        ?>
													        <tr>
									        					<td><input type="checkbox" /></td>
									        					<td><?php echo $caselast; ?></td>
									        					<td><?php echo $sqh; ?></td>
									        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $caselast; ?></td>
									        					<td><?php echo $remarkf; ?></td><!--登记费【登记费+印刷费+公布印刷费】-->
									        					<td><?php echo $yearf; ?></td><!--第一年年费-->
									        					<td><?php echo $dateline; ?></td>
									        					<td><?php echo $sqr; ?></td>
									        					<td><?php echo $sqd; ?></td>
									        					<td><?php echo $zlm; ?></td>
									        				</tr>
													        <?php
													        				$remarkf=0;$yearf=0;
													        				if($row["费用名称"]=='印花费'||$row["费用名称"]=='公布印刷费'||$row["费用名称"]=='登记费'){
													        					$remarkf = $remarkf+$row["金额"];
													        				}else if($row["费用名称"]=='年费'){
													        					$yearf	= $row["金额"];
													        				}
													        			}
													        			$caselast = $casenum;
																	}
																	$row_num ++ ;
													        ?>
													        <tr>
									        					<td><input type="checkbox" /></td>
									        					<td><?php echo $caselast; ?></td>
									        					<td><?php echo $sqh; ?></td>
									        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $casenum; ?></td>
									        					<td><?php echo $remarkf; ?></td><!--登记费【登记费+印刷费+公布印刷费】-->
									        					<td><?php echo $yearf; ?></td><!--第一年年费-->
									        					<td><?php echo $dateline; ?></td>
									        					<td><?php echo $sqr; ?></td>
									        					<td><?php echo $sqd; ?></td>
									        					<td><?php echo $zlm; ?></td>
									        				</tr>
													        <?php
																}
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
		                  	<!-- /btn-group -->
						            	<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">
		                        	<?php 
		                        		require'../../conn.php';
		                        		//查询
		                        		$sqlO1 = "select 费用4 from 表格顺序 where 用户id = '".$userid."'";
		                        		$resultO1 = $conn->query($sqlO1);
		                        		if($resultO1->num_rows>0){
		                        			while($rowO1 = $resultO1->fetch_assoc()){
		                        				$order = $rowO1['费用4'];
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
		                        	<span class="dynamic-table_2" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
		                        </button>
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
		                    </div>
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_2" onclick="selectAll(this,'dynamic-table_2')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>截止日期</th>
		                					<th>申请人</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                					<th>通知书</th>
		                					<th>缴费文件</th>
		                					<th>收据</th>
		                    	</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,通知书名,缴费文件名,`金额`,`缴费期限`,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期,文件名  from  专案待缴费  where 费用状态='3' and 收据上传日期 !='0' ";
//			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期 from  专案费用查询  where 费用状态='1' ";
										$result = $conn->query($sql);
										$row_num = '';
					        			if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				$row_num ++ ;
					        		?>
			        				<tr>
			        					<td><input type="checkbox" id="" /></td>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
			        					<td><?php echo $row["费用名称"]; ?></td>
			        					<td><?php echo $row["金额"]; ?></td>
			        					<td><?php echo $row["缴费期限"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
			        					<td>
			        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
			        					</td>
			        					<td>
			        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["缴费文件名"];?>"><?php echo $row["缴费文件名"]; ?></a>
			        					</td>
			        					<td><a target="_blank" href="../../img_receipt/<?php echo $row["文件名"]; ?>" ><?php echo $row["文件名"]; ?></a></td>
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
						            	<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">
		                        	<?php 
		                        		require'../../conn.php';
		                        		//查询
		                        		$sqlO1 = "select 费用2 from 表格顺序 where 用户id = '".$userid."'";
		                        		$resultO1 = $conn->query($sqlO1);
		                        		if($resultO1->num_rows>0){
		                        			while($rowO1 = $resultO1->fetch_assoc()){
		                        				$order = $rowO1['费用2'];
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
		                        	<span class="dynamic-table_3" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
		                        </button>
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
		                    </div>
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_3')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>截止日期</th>
		                					<th>申请人</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                					<th>通知书</th>
		                					<th>操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,申请人,申请日,`专利名称`,通知书名 ,缴费文件名,`收据编号`,`费用状态`,收据上传日期,通知书生成日期 from  专案待缴费  where 费用状态=1 or 费用状态=0 ";
																$result = $conn->query($sql);
																$row_num = '';
											        			if($result->num_rows > 0){
												        			while($row = $result->fetch_assoc()){
												        				$row_num ++ ;
											        		?>
									        				<tr>
									        					<td><input type="checkbox" id="<?php echo $row["id"]; ?>" /> </td>
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
									        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>	
									        					</td>
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
			                    <!-- /btn-group -->
						            	<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">
		                        	<?php 
		                        		require'../../conn.php';
		                        		//查询
		                        		$sqlO1 = "select 费用3 from 表格顺序 where 用户id = '".$userid."'";
		                        		$resultO1 = $conn->query($sqlO1);
		                        		if($resultO1->num_rows>0){
		                        			while($rowO1 = $resultO1->fetch_assoc()){
		                        				$order = $rowO1['费用3'];
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
		                        	<span class="dynamic-table_4" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
		                        </button>
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
		                    </div>
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_4">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_4')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>截止日期</th>
		                					<th>申请人</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                					<th>通知书</th>
		                					<th>缴费文件</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                      	<?php
			                      		require("../../conn.php");
			                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,通知书名,缴费文件名,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期,通知书生成日期  from  专案待缴费  where 费用状态='2' and 收据上传日期='0' or 收据上传日期 = ''";
																$result = $conn->query($sql);
																$row_num = '';
											        			if($result->num_rows > 0){
												        			while($row = $result->fetch_assoc()){
												        				$row_num ++ ;
											        ?>
			        				<tr>
			        					<td><input type="checkbox" /> </td>
			        					<td><?php echo $row["案卷号"]; ?></td>
			        					<td><?php echo $row["申请号"]; ?></td>
			        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
			        					<td><?php echo $row["费用名称"]; ?></td>
			        					<td><?php echo $row["金额"]; ?></td>
			        					<td><?php echo $row["缴费期限"]; ?></td>
			        					<td><?php echo $row["申请人"]; ?></td>
			        					<td><?php echo $row["申请日"]; ?></td>
			        					<td><?php echo $row["专利名称"]; ?></td>
			        					<td>
			        						<a target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["通知书名"];?>"><?php echo $row["通知书名"]; ?></a>
			        					</td>
			        					<td>
			        						<a  href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row["缴费文件名"];?>"><?php echo $row["缴费文件名"]; ?></a>
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
		                  	<input class="btn btn-primary" type="button" id="" name="" value="提前通知" />
			                    <!-- /btn-group -->
						            	<div class="btn-group" style="float: right;" >
		                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
		                        	<?php 
		                        		require'../../conn.php';
		                        		//查询
		                        		$sqlO1 = "select 费用1 from 表格顺序 where 用户id = '".$userid."'";
		                        		$resultO1 = $conn->query($sqlO1);
		                        		if($resultO1->num_rows>0){
		                        			while($rowO1 = $resultO1->fetch_assoc()){
		                        				$order = $rowO1['费用1'];
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
		                        	<span class="dynamic-table_5" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
		                        </button>
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
		                    </div>
		                    <!-- /btn-group -->
			                    <table class="display table table-bordered table-striped" id="dynamic-table_5">
			                        <thead>
					            				<tr>
			                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_5')" /></th>
			                					<th>案卷号</th>
			                					<th>申请号</th>
			                					<th hidden="hidden">id</th>
			                					<th>费用名称</th>
			                					<th>金额</th>
			                					<th>缴费期限</th>
			                					<th>申请人</th>
			                					<th>申请日</th>
			                					<th>专利名称</th>
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
									        					<td><input type="checkbox" /> </td>
									        					<td><?php echo $row["案卷号"]; ?></td>
									        					<td><?php echo $row["申请号"]; ?></td>
									        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
									        					<td><?php echo $row["费用名称"]; ?></td>
									        					<td><?php echo $row["金额"]; ?></td>
									        					<td><?php echo $row["缴费期限"]; ?></td>
									        					<td><?php echo $row["申请人"]; ?></td>
									        					<td><?php echo $row["申请日"]; ?></td>
									        					<td><?php echo $row["专利名称"]; ?></td>
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
    <!--修改费用模态框 end-->
    
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
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

<!--页面响应-->
<script src="../../js/imitation_3/cost.js" ></script>
<!--全选-->
<script src="../../js/page_else.js" ></script>
<!--删除费用操作-->
<script
<script src="../../js/fare_del.js"></script>
<!--about 常态-->
		<script src="../../js/NormalS-2.js"></script>
		<script src="../../js/dynamic-table-5.js"></script>
		<!--<script type="text/javascript"></script>-->
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
	//显示监控中信息
//	var oTable = $('#editable-sample').dataTable({
//	    "aLengthMenu": [
//	        [5, 15, 20, -1],
//	        [5, 15, 20, "All"] // change per page values here
//	    ],
//	    // set the initial value
//	    "iDisplayLength": 5,
//	    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
//	    "sPaginationType": "bootstrap",
//	    "oLanguage": {
//	        //"sLengthMenu": "_MENU_ records per page",
//	        "sLengthMenu": "_MENU_ 行/页",
//	        "oPaginate": {
//	            //"sPrevious": "Prev",
//	            //"sNext": "Next"
//	            "sPrevious": "上一页",
//	            "sNext": "下一页"
//	        }
//	    },
//	    "aoColumnDefs": [{
//	            'bSortable': false,
//	            'aTargets': [0]
//	        }
//	    ]
//	});
//	$.ajax({
//		type:"get",
//		url:"Cost_SelShow.php",
//		async:true,
//		dataType:'json',
//		success:function(data){
//			var id  = '';
//			var ajh = '';
//			var sqr = '';
//			var zln = '';
//			for (i in data) {
//				id  = data[i]["id"];
//				ajh = data[i]["ajh"];
//				sqr = data[i]["sqr"];
//				zln = data[i]["zln"];
//				oTable5.fnAddData([id,ajh,sqr,zln,id,ajh,sqr,zln,id]);
//			}
//		},
//		error:function(t,s,e){
//			alert(s+'|'+e);
//		}
//	});
	
</script>
		
</body>
</html>
