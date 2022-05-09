<?php require'AHeader.php'; ?>
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
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>

  <title>专利办公管理系统</title>
  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

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

  <style type="text/css">
  	input {
  		zoom: 120%;
  	}
  </style>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="js/jquery-1.10.2.min.js"></script>

</head>

<body class="sticky-header">
<!--<body class="sticky-header" onload="show_remind()">-->
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("menu_tree.php"); 
				Create_leftlist(0,0);
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
            <?php require'MenuMin.php'; ?> 
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <!--body wrapper start-->
    	<div class="wrapper" >
    		<div class="row" >
        	<div class="col-lg-12">
        		<section class="panel">
        			<header class="panel-heading custom-tab">
		              <ul class="nav nav-tabs">
		              	<!--在此处的li样式中添加active-->
		                <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>案件总览</a></li>
		                <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>申请案件</a></li><!--原名：专利案件-->
		                <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>年费案件</a></li>
		                <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>其他案件</a></li><!--原复审案件-->
		                
		                <li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>案件统计</a></li>
		                <?php
		                	if($admin == 1){
		                ?>
		                <li class="about-6"><a href="#about-6" data-toggle="tab"><i class="fa fa-user"></i>失败案件</a></li>
		                <?php
		                	}
		                ?>
		                <input id="czyid" value="<?php echo $userid; ?>" hidden="hidden" />
		                <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
		              </ul>
           			</header>
           	<div class="panel-body">
        	<div class="tab-content">
        		<!--案件总览-->
							<div class="tab-pane" id="about-1">
                  <section id="unseen">
                  	<div>
												<?php
													if($admin==1||$lcczy==1){
												?>
													<a href="advice_handle/morefile_upload.html" target="_blank"><button class="btn btn-primary" type="button">文件批量导入</button></a>
													<button class="btn btn-primary" onclick="Export_someExcel_2('dynamic-table_2','phpexcel/my_test/wx_export_some.php')">导出选中行Excel清单</button>
												<?php
					//								}
					//								if($admin==1){
												?>
													<a href="phpexcel/my_test/wx_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
													<button class="btn btn-primary" onclick="ChangeCaseOwnMes()">批量修改案源人代理人</button>
												<?php
													}
												?>
		            <!-- button list end -->
		            	<!-- btn-group -->
		            	<!--<div class="btn-group" style="float: right;" >
	                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">-->
	                    	<?php 
//	                    		require'conn.php';
//	                    		//查询
//	                    		$sqlO1 = "select 专2 from 表格顺序 where 用户id = '".$userid."'";
//	                    		$resultO1 = $conn->query($sqlO1);
//	                    		if($resultO1->num_rows>0){
//	                    			while($rowO1 = $resultO1->fetch_assoc()){
//	                    				$order = $rowO1['专2'];
//	                    			}
//	                    		}
//	                    		if(strlen($order)<1){
//	                    			$order = '1/asc/案卷号【正】';
//	                    		}
//	                    		//显示
//	                    		$order = explode('/',$order);
//	                    		echo $order[2];
	                    	?>
	                    	<!--<span class="caret"></span>-->
	                    	<span class="dynamic-table_2" hidden="hidden" >1/asc/案卷号【正】</span>
	                    <!--</button>
	                    <ul role="menu" class="dropdown-menu checilck" id="MenuT" >
	                        <li><a href="#">案卷号【正】</a></li>
	                        <li><a href="#">案卷号【倒】</a></li>
	                        <li><a href="#">申请号【正】</a></li>
	                        <li><a href="#">申请号【倒】</a></li>
	                        <li><a href="#">类型</a></li>
	                    </ul>
	                </div>-->
	                <!-- /btn-group -->
	                <!-- 查询条件 start -->
	                  <br /><br />
	                	<form action="#" method="post">
	 										<table class="table table-condensed">
	 											<tr>
	 												<td>专利类型：</td>
	 												<td>
	 													<select name="check_zllx">
	 														<option></option>
	 														<option>发明专利</option>
	 														<option>实用新型</option>
	 														<option>外观设计</option>
	 													</select>
	 												</td>
	 												<td>当前程序：</td>
	 												<td>
	 													<select name="check_dqcx">
	 														<option></option>
	 														<option value="待提交">待提交</option>
	 														<option value="待受理">待受理</option>
	                        		<option value="待申请费">待申请费</option>
	                        		<option value="申请中">申请中</option>
	                        		<option value="待登记费">待登记费</option>
	                        		<option value="待证书">待证书</option>
	                        		<option value="年费中">年费中</option>
	                        		<option value="答辩补正">答辩补正</option>
	                        		<option value="驳回复审">驳回复审</option>
	                        		<option value="结案">结案</option>
	 													</select>
	 												</td>
	 											
	 											
	 												<td>案源人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="check_ayr" id="check_ayr" onclick="select_ayr(this.id)" readonly="readonly" /></td>
	 												<td>代理人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="check_dlr" id="check_dlr" onclick="select_dlr(this.id)" readonly="readonly" /></td>
	 											
	 											
	 												<td>起始申请日：</td>
	 												<td><input type="date" style="height: 20px; width: 100px;font-size: 5px;" name="check_sqr_start" /></td>
	 												<td>截止申请日：</td>
	 												<td><input type="date" style="height: 20px; width: 100px;font-size: 5px;" name="check_sqr_end"/></td>
	 												<td style="text-align: right;"><input type="submit" value="查询" /></td>
	 											</tr>
	 										</table>               		
	                	</form>
	                <!-- 查询条件 end -->
		            </div>
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_2" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input onchange="selectAll('dynamic-table_2',this)" type="checkbox" /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">类型</th>
			                    <th class="numeric" style="min-width: 100px;">申请号</th>
			                    <th class="numeric" style="width: 80px;">申请日</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric">专利名称</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric" style="width: 70px;">当前程序</th>
			                    <th class="numeric" style="width: 70px;">案件类型</th>
			                    <th class="numeric" style="width: 80px;">原案卷号</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                            <?php
			                    		require("conn.php");
										
															if($dlrbh != null && $ayrbh != null){
															//申请案件
																if($_SERVER["REQUEST_METHOD"] == "POST"){
																	$check_zllx = $_POST['check_zllx'];//专利类型
																	$check_dqcx = $_POST['check_dqcx'];//当前程序
																	$check_ayr = $_POST['check_ayr'];//案源人
																	$check_dlr = $_POST['check_dlr'];//代理人
																	$check_sqr_start = $_POST['check_sqr_start'];//起始申请人
																	$check_sqr_end = $_POST['check_sqr_end'];//截止申请人
																	if($check_zllx != "" || $check_dqcx != "" || $check_sqr != "" || $check_dlr != "" || $check_sqr_start != "" || $check_sqr_end != ""){//只要有一个不为空
																		
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态='0'  ";
																		if($check_dqcx != ""){
																			if($check_dqcx == "结案"){
																				$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态='1'  ";
																			}else{
																				$sqlA .= " and 状态='".$check_dqcx."'";
																			}
																			
																		}
																		if($check_zllx != ""){
																			$sqlA .= " and 类型='".$check_zllx."'";
																		}
																		
																		if($check_ayr != ""){
																			$sqlA .= " and 案源人='".$check_ayr."'";
																		}
																		if($check_dlr != ""){
																			$sqlA .= " and 代理人='".$check_dlr."'";
																		}
																		if($check_sqr_start != "" && $check_sqr_end != ""){
																			if($check_sqr_end > $check_sqr_start){
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_start."' AND '".$check_sqr_end."' ";
																			}else{
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_end."' AND '".$check_sqr_start."' ";
																			}
																		}else{
																			if($check_sqr_start != ""){
																				$sqlA .= " and 申请日 > '".$check_sqr_start."' ";
																			}
																			if($check_sqr_end != ""){
																				$sqlA .= " and 申请日 < '".$check_sqr_end."' ";
																			}
																		}
																		
																		$sqlA .= " order by id desc"; 
																	}else{//查询条件为空
																		if($admin == 1){
																		  $sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态<>'3' and 状态<>9 order by id desc";
																		}else{
																			$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态<>'3' and 冻结状态<>'2' and 状态<>9 order by id desc";
																		}
																	}
																}else{
																	if($admin == 1){
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态<>'3' and 状态<>9 order by id desc";
																	}else{
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日 from `专利信息`  where 冻结状态<>'3' and 冻结状态<>'2' and 状态<>9 order by id desc";
																	}
																}
																
	                        			$resultA = $conn->query($sqlA);
			                        		if($resultA->num_rows > 0){
			                        			while($rowA = $resultA->fetch_assoc()){
//			                        				$dlr = substr($rowA["案卷号"],7,2);
			                        				if($rowA["冻结状态"]==0){
//			                        					$Icetype ='正常';
			                        					$Icetype = $rowA["状态"];
	                        						}else if($rowA["冻结状态"]==1){
	                        							$Icetype ='结案';
	                        						}else if($rowA["冻结状态"]==2){
	                        							$Icetype ='删除';
	                        						}
	                        						//获取申请人
	                        						$SQRMes = '';
	                        						$SQRMes = $rowA["申请人"];
//			                        				$sql_SSqr ="select 申请人 from 申请人 where FIND_IN_SET(id,'".$rowA["申请人id"]."')";
//			                        				$result_SSqr = $conn->query($sql_SSqr);
//			                        				if($result_SSqr->num_rows > 0){
//			                        					while($row_SSqr = $result_SSqr -> fetch_assoc()){
//			                        						$SQRMes .= ",".$row_SSqr['申请人'];
//			                        					}
//			                        				}
//			                        				$SQRMes = substr($SQRMes,1);
//	                        						$SQRMes = Get_sqr($rowA["申请人id"]);
			                        				
			                        				$CaseType = '申请案件';
			                        					
			                        				?>
			                        				<tr>
			                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $rowA["id"];?>" ajh="<?php echo $rowA["案卷号"];?>" /></label></th>
			                        					<td class="numeric"><a href="ware/imitation_1/caseinformation.php?ajh=<?php echo $rowA["案卷号"];?>" target="_blank" ><?php echo $rowA["案卷号"];?></a></td>
			                        					<td class="numeric"><?php echo $rowA["类型"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请号"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请日"];?></td>
			                        					<td class="numeric"><?php echo $SQRMes;?></td>
			                        					<td class="numeric"><?php echo $rowA["专利名称"];?></td>
			                        					<td class="numeric"><?php echo $rowA["案源人"];?></td>
			                        					<td class="numeric"><?php echo $rowA["代理人"];?></td>
		                        						<td class="numeric"><?php echo $Icetype;?></td>
		                        						<td class="numeric"><?php echo $CaseType;?></td>
		                        						<td class="numeric"></td>
			                        				</tr>
				                        <?php
				                        			}
				                        		}
				                      //年费案件
				                      	if($_SERVER["REQUEST_METHOD"] == "POST"){
																	$check_zllx = $_POST['check_zllx'];//专利类型
																	$check_dqcx = $_POST['check_dqcx'];//当前程序
																	$check_ayr = $_POST['check_ayr'];//案源人
																	$check_dlr = $_POST['check_dlr'];//代理人
																	$check_sqr_start = $_POST['check_sqr_start'];//起始申请人
																	$check_sqr_end = $_POST['check_sqr_end'];//截止申请人
																	if($check_zllx != "" || $check_dqcx != "" || $check_sqr != "" || $check_dlr != "" || $check_sqr_start != "" || $check_sqr_end != ""){//只要有一个不为空
																		
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态='0' '";
																		if($check_dqcx != ""){
																			if($check_dqcx == "结案"){
																				$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态='1' '";
																				$sqlA .= " and 冻结状态='1'";
																			}else{
																				$sqlA .= " and 状态='".$check_dqcx."'";
																			}
																			
																		}
																		if($check_zllx != ""){
																			$sqlA .= " and 类型='".$check_zllx."'";
																		}
																		if($check_ayr != ""){
																			$sqlA .= " and 案源人='".$check_ayr."'";
																		}
																		if($check_dlr != ""){
																			$sqlA .= " and 代理人='".$check_dlr."'";
																		}
																		if($check_sqr_start != "" && $check_sqr_end != ""){
																			if($check_sqr_end > $check_sqr_start){
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_start."' AND '".$check_sqr_end."' ";
																			}else{
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_end."' AND '".$check_sqr_start."' ";
																			}
																		}else{
																			if($check_sqr_start != ""){
																				$sqlA .= " and 申请日 > '".$check_sqr_start."' ";
																			}
																			if($check_sqr_end != ""){
																				$sqlA .= " and 申请日 < '".$check_sqr_end."' ";
																			}
																		}
																		
																		$sqlA .= " order by id desc"; 
																	}else{//查询条件为空
																		if($admin == 1){
																			$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态<>'3' and 案件状态<>9";
																		}else{
																			$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态<>'3' and 冻结状态<>'2' and 案件状态<>9";
																		}
																	}
																}else{
																	if($admin == 1){
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态<>'3' and 案件状态<>9";
																	}else{
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日,原案卷号 from `专案_年费`  where 冻结状态<>'3' and 冻结状态<>'2' and 案件状态<>9";
																	}
																}
				                        
	                        			$resultA = $conn->query($sqlA);
			                        		if($resultA->num_rows > 0){
			                        			while($rowA = $resultA->fetch_assoc()){
//			                        				$dlr = substr($rowA["案卷号"],7,2);
			                        				if($rowA["冻结状态"]==0){
//			                        					$Icetype ='正常';
			                        					$Icetype = $rowA["状态"];
	                        						}else if($rowA["冻结状态"]==1){
	                        							$Icetype ='结案';
	                        						}else if($rowA["冻结状态"]==2){
	                        							$Icetype ='删除';
	                        						}
	                        						//获取申请人
	                        						$SQRMes = '';
																			$SQRMes = $rowA["申请人"];
//			                        				$sql_SSqr ="select 申请人 from 申请人 where FIND_IN_SET(id,'".$rowA["申请人id"]."')";
//			                        				$result_SSqr = $conn->query($sql_SSqr);
//			                        				if($result_SSqr->num_rows > 0){
//			                        					while($row_SSqr = $result_SSqr -> fetch_assoc()){
//			                        						$SQRMes .= ",".$row_SSqr['申请人'];
//			                        					}
//			                        				}
//			                        				$SQRMes = substr($SQRMes,1);
//	                        						$SQRMes = Get_sqr($rowA["申请人id"]);
			                        				
			                        				$CaseType = '年费案件';
			                        					
			                        				?>
			                        				<tr>
			                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $rowA["id"];?>" ajh="<?php echo $rowA["案卷号"];?>" /></label></th>
			                        					<td class="numeric"><a href="ware/imitation_1/new_yearcost/case_info.php?ajh=<?php echo $rowA["案卷号"];?>" target="_blank" ><?php echo $rowA["案卷号"];?></a></td>
			                        					<td class="numeric"><?php echo $rowA["类型"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请号"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请日"];?></td>
			                        					<td class="numeric"><?php echo $SQRMes;?></td>
			                        					<td class="numeric"><?php echo $rowA["专利名称"];?></td>
			                        					<td class="numeric"><?php echo $rowA["案源人"];?></td>
			                        					<td class="numeric"><?php echo $rowA["代理人"];?></td>
		                        						<td class="numeric"><?php echo $Icetype;?></td>
		                        						<td class="numeric"><?php echo $CaseType;?></td>
		                        						<td class="numeric"><?php echo $rowA["原案卷号"];?></td>
			                        				</tr>
				                        <?php
				                        			}
				                        		}
				                      //其他案件
				                      	if($_SERVER["REQUEST_METHOD"] == "POST"){
																	$check_zllx = $_POST['check_zllx'];//专利类型
																	$check_dqcx = $_POST['check_dqcx'];//当前程序
																	$check_ayr = $_POST['check_ayr'];//案源人
																	$check_dlr = $_POST['check_dlr'];//代理人
																	$check_sqr_start = $_POST['check_sqr_start'];//起始申请人
																	$check_sqr_end = $_POST['check_sqr_end'];//截止申请人
																	if($check_zllx != "" || $check_dqcx != "" || $check_sqr != "" || $check_dlr != "" || $check_sqr_start != "" || $check_sqr_end != ""){//只要有一个不为空
																		
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态='0'  ";
																		if($check_dqcx != ""){
																			if($check_dqcx == "结案"){
																				$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态='1'  ";
																			}else{
																				$sqlA .= " and 状态='".$check_dqcx."'";
																			}
																			
																		}
																		
																		if($check_zllx != ""){
																			$sqlA .= " and 类型='".$check_zllx."'";
																		}
																		
																		if($check_ayr != ""){
																			$sqlA .= " and 案源人='".$check_ayr."'";
																		}
																		if($check_dlr != ""){
																			$sqlA .= " and 代理人='".$check_dlr."'";
																		}
																		if($check_sqr_start != "" && $check_sqr_end != ""){
																			if($check_sqr_end > $check_sqr_start){
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_start."' AND '".$check_sqr_end."' ";
																			}else{
																				$sqlA .= " and 申请日 BETWEEN '".$check_sqr_end."' AND '".$check_sqr_start."' ";
																			}
																		}else{
																			if($check_sqr_start != ""){
																				$sqlA .= " and 申请日 > '".$check_sqr_start."' ";
																			}
																			if($check_sqr_end != ""){
																				$sqlA .= " and 申请日 < '".$check_sqr_end."' ";
																			}
																		}
																		
																		$sqlA .= " order by id desc"; 
																	}else{//查询条件为空
																		if($admin == 1){
																			$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态<>'3' and 状态<>9";
																		}else{
																			$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态<>'3' and 冻结状态<>'2' and 状态<>9";
																		}
																	}
																}else{
																	if($admin == 1){
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态<>'3' and 状态<>9";
																	}else{
																		$sqlA="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等`  where 冻结状态<>'3' and 冻结状态<>'2' and 状态<>9";
																	}
																}
				                      	
	                        			$resultA = $conn->query($sqlA);
			                        		if($resultA->num_rows > 0){
			                        			while($rowA = $resultA->fetch_assoc()){
//			                        				$dlr = substr($rowA["案卷号"],7,2);
			                        				if($rowA["冻结状态"]==0){
//			                        					$Icetype ='正常';
			                        					$Icetype = $rowA["状态"];
	                        						}else if($rowA["冻结状态"]==1){
	                        							$Icetype ='结案';
	                        						}else if($rowA["冻结状态"]==2){
	                        							$Icetype ='删除';
	                        						}
	                        						//获取申请人
	                        						$SQRMes = '';
																			$SQRMes = $rowA["申请人"];
//			                        				$sql_SSqr ="select 申请人 from 申请人 where FIND_IN_SET(id,'".$rowA["申请人id"]."')";
//			                        				$result_SSqr = $conn->query($sql_SSqr);
//			                        				if($result_SSqr->num_rows > 0){
//			                        					while($row_SSqr = $result_SSqr -> fetch_assoc()){
//			                        						$SQRMes .= ",".$row_SSqr['申请人'];
//			                        					}
//			                        				}
//			                        				$SQRMes = substr($SQRMes,1);
//	                        						$SQRMes = Get_sqr($rowA["申请人id"]);
			                        				
			                        				$CaseType = '其他案件';
			                        					
			                        				?>
			                        				<tr>
			                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $rowA["id"];?>" ajh="<?php echo $rowA["案卷号"];?>" /></label></th>
			                        					<td class="numeric"><a href="ware/imitation_1/new_fs/case_info.php?ajh=<?php echo $rowA["案卷号"];?>" target="_blank" ><?php echo $rowA["案卷号"];?></a></td>
			                        					<td class="numeric"><?php echo $rowA["类型"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请号"];?></td>
			                        					<td class="numeric"><?php echo $rowA["申请日"];?></td>
			                        					<td class="numeric"><?php echo $SQRMes;?></td>
			                        					<td class="numeric"><?php echo $rowA["专利名称"];?></td>
			                        					<td class="numeric"><?php echo $rowA["案源人"];?></td>
			                        					<td class="numeric"><?php echo $rowA["代理人"];?></td>
		                        						<td class="numeric"><?php echo $Icetype;?></td>
		                        						<td class="numeric"><?php echo $CaseType;?></td>
		                        						<td class="numeric"></td>
			                        				</tr>
				                        <?php
				                        			}
				                        		}
															}
                        ?>
                  </tbody>
                 </table>
                </section>
           	</div>
		        <div class="tab-pane" id="about-2">
                  <section id="unseen">
			            <!-- button list -->
				          	<div>
				              <a href="ware/imitation_1/new_case/new case 00.php" target="_blank" ><button class="btn btn-success" type="button">新建</button></a><!--ware/imitation_1/new_case/new case 00.php-->
									<button class="btn btn-primary" type="button" data-toggle="modal" href="#addModal" >结案</button>
									<button class="btn btn-primary" type="button" onclick="huif('dynamic-table')">恢复</button>
								<?php
//									if($admin==1||$lcczy==1){
								?>
									<button class="btn btn-warning" type="button" onclick="del('dynamic-table')">删除</button>
								<?php
//									}
								?>
								<?php
									if($admin==1){
								?>
									<button class="btn btn-danger" type="button" onclick="hid('dynamic-table')">彻底删除</button>
								<?php
									}
								?>
				            	<!--<a href="advice_handle/morefile_upload.html" target="_blank"><button class="btn btn-primary" type="button">文件批量导入</button></a>-->
				            	<a href="phpexcel/my_test/za_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
				            	<button class="btn btn-primary" onclick="Export_someExcel('dynamic-table','phpexcel/my_test/za_export_some.php')">导出选中行Excel清单</button>
				            
				            	<!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
                        	<?php 
                        		require'conn.php';
                        		//查询
                        		$sqlO1 = "select 专1 from 表格顺序 where 用户id = '".$userid."'";
                        		$resultO1 = $conn->query($sqlO1);
                        		if($resultO1->num_rows>0){
                        			while($rowO1 = $resultO1->fetch_assoc()){
                        				$order = $rowO1['专1'];
                        			}
                        		}
                        		if(strlen($order)<1){
                        			$order = '1/asc/案卷号【正】';
                        		}
                        		//显示
                        		$order = explode('/',$order);
                        		echo $order[2];
                        	?>
                        	<span class="caret"></span>
                        	<span class="dynamic-table" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
                            <li><a href="#">案卷号【正】</a></li>
                            <li><a href="#">案卷号【倒】</a></li>
                            <li><a href="#">申请日【正】</a></li>
                            <li><a href="#">申请日【倒】</a></li>
                        </ul>
                    </div>
                                <!-- /btn-group -->
                                <br /><br />
                                <?php 
                                	$CType0 = $_GET['CType'];
                                	$CType = '暂无类型';
	                                $CStua = '暂无状态';
                                	if(isset($CType0)){
	                                	switch($CType0){
	                                		case 0:
	                                			$sqlM = " and 类型= '发明专利'";
	                                			$CType = '发明专利';
	                                			break;
	                                		case 1:
	                                			$sqlM = " and 类型= '实用新型'";
	                                			$CType = '实用新型';
	                                			break;
	                                		case 2:
	                                			$sqlM = " and 类型= '外观设计'";
	                                			$CType = '外观设计';
	                                			break;
	                                		case 3:
	                                			$sqlM = " and 状态= '待提交'";
	                                			$CStua = '待提交';
	                                			break;
	                                		case 4:
	                                			$sqlM = " and 状态= '申请中'";
	                                			$CStua = '申请中';
	                                			break;
	                                		case 5:
	                                			$sqlM = " and 状态= '年费中'";
	                                			$CStua = '年费中';
	                                			break;
	                                		case 6:
	                                			$sqlM = " and 状态= '已结案'";
	                                			$CStua = '已结案';
	                                			break;
	                                		default:break;
	                                	}
                                	}
                                ?>
                                <!-- /btn-group -->
                                <strong>案件类型</strong>
				            						<div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button"><?php echo $CType; ?><span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="index.php?CType=0">发明专利</a></li>
                                        <li><a href="index.php?CType=1">实用新型</a></li>
                                        <li><a href="index.php?CType=2">外观设计</a></li>
                                    </ul>
                                </div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>案件状态</strong>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button"><?php echo $CStua; ?><span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="index.php?CType=3">待提交</a></li>
                                        <li><a href="index.php?CType=4">申请中</a></li>
                                        <li><a href="index.php?CType=5">年费中</a></li>
                                        <li><a href="index.php?CType=6">已结案</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
				            </div>
				            <!-- button list end -->
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table" >
		                  <thead>
		                    <tr>
			                    <th class="numeric sorting_desc_disabled" style="width: 50px;"><input onchange="selectAll('dynamic-table',this)" type="checkbox" /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">类型 </th>
			                    <th class="numeric" style="width: 80px;">申请号</th>
			                    <th class="numeric" style="width: 80px;">申请日</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric">专利名称</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric" style="width: 70px;">当前程序</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                            <?php
	                    					require("conn.php");
																if($dlrbh != null && $ayrbh != null){
																	if($admin == 1){
																		$sql="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日   from `专利信息` b where b.冻结状态<>'3' and 状态<>9 order by id desc";
																	}else{
																		$sql="select id,案卷号,案源人,代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日   from `专利信息` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 状态<>9 order by id desc";
																	}
																	if(isset($sqlM)){
																		$sql = $sql.$sqlM;
																	}
	                        				$result = $conn->query($sql);
			                        		if($result->num_rows > 0){
			                        			while($row = $result->fetch_assoc()){
			                        				if($row["冻结状态"]==0){
			                        					$Icetype = $row["状态"];
					                						}else if($row["冻结状态"]==1){
					                							$Icetype ='结案';
					                						}else if($row["冻结状态"]==2){
					                							$Icetype ='删除';
					                						}
					                						//获取申请人id
//			                        				$SqrId = $row["申请人id"];
//			                        				$SqrId_arr = explode(',',$SqrId);
//			                        				$SQRMes = '';
//					                						for($i=0;$i<count($SqrId_arr);$i++){
//			                        					$sql_SSqr = "select 申请人 from 申请人 where id='".$SqrId_arr[$i]."'";
//			                        					$result_SSqr = $conn->query($sql_SSqr);
//			                        					if($result_SSqr->num_rows > 0){
//			                        						while($row_SSqr = $result_SSqr -> fetch_assoc()){
//			                        							if(strlen($SQRMes) == 0){
//			                        								$SQRMes = $row_SSqr['申请人'];
//			                        							}else{
//			                        								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//			                        							}
//			                        						}
//			                        					}
//			                        				}
		                        	?>
	                				<tr>
	                					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $row["id"];?>"/></label></th>
	                					<td class="numeric"><a href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row["案卷号"];?>"  target="_blank" ><?php echo $row["案卷号"];?></a></td>
	                					<td class="numeric"><?php echo $row["类型"];?></td>
	                					<td class="numeric"><?php echo $row["申请号"];?></td>
	                					<td class="numeric"><?php echo $row["申请日"];?></td>
	                					<td class="numeric"><?php echo $row["申请人"];?></td>
	                					<td class="numeric"><?php echo $row["专利名称"];?></td>
	                					<td class="numeric"><?php echo $row["案源人"];?></td>
	                					<td class="numeric"><?php echo $row["代理人"];?></td>
	            						  <td class="numeric"><?php echo $Icetype;?></td>
	                				</tr>
			                        <?php
			                        			}
			                        		}
                        				}
                        ?>
                  </tbody>
                 </table>
                 <!--<?php echo $sql_case; ?>-->
                </section>
            	</div> 
            	
           	<!--原来复审案件；现其他案件-->
           	<div class="tab-pane" id="about-3">
                  <section id="unseen">
                  	<div>
		              	<a href="ware/imitation_1/new_fs/new_case.php" target="_blank" ><button class="btn btn-success" type="button">新建</button></a><!--ware/imitation_1/new_case/new case 00.php-->
						<button class="btn btn-primary" type="button" data-toggle="modal" href="#addModal3" >结案</button>
						<button class="btn btn-primary" type="button" onclick="huif('dynamic-table_3')" >恢复</button>
						<?php
//							if($admin==1||$lcczy==1){
						?>
							<button class="btn btn-warning" type="button" onclick="del('dynamic-table_3')">删除</button>
						<?php
//							}
							if($admin==1){
						?>
							<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_3')">彻底删除</button>
						<?php
							}
						?>
							<a href="phpexcel/my_test/fs_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
	            <button class="btn btn-primary" onclick="Export_someExcel('dynamic-table_3','phpexcel/my_test/fs_export_some.php')">导出选中行Excel清单</button>
		            <!-- button list end -->
		            <!-- /btn-group -->
		            	<div class="btn-group" style="float: right;" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuS">
                            	<?php 
                            		require'conn.php';
                            		//查询
                            		$sqlO1 = "select 专3 from 表格顺序 where 用户id = '".$userid."'";
                            		$resultO1 = $conn->query($sqlO1);
                            		if($resultO1->num_rows>0){
                            			while($rowO1 = $resultO1->fetch_assoc()){
                            				$order = $rowO1['专3'];
                            			}
                            		}
                            		if(strlen($order)<1){
                            			$order = '1/asc/案卷号【正】';
                            		}
                            		//显示
                            		$order = explode('/',$order);
                            		echo $order[2];
                            	?>
                            	<span class="caret"></span>
                            	<span class="dynamic-table_3" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                            </button>
                            <ul role="menu" class="dropdown-menu checilck" id="MenuS" ><!--OrderZL()--> 
                                <li><a href="#">案卷号【正】</a></li>
                                <li><a href="#">案卷号【倒】</a></li>
                                <li><a href="#">申请号【正】</a></li>
                                <li><a href="#">申请号【倒】</a></li>
                                <li><a href="#">类型</a></li>
                            </ul>
                        </div>
                    <!-- /btn-group -->
		            </div>
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_3">
                        <thead>
                        <tr>
                            <th style="width: 50px;"><input type="checkbox" onchange="selectAll('dynamic-table_3',this)" /></th>
                            <th class="numeric" style="width: 100px;">案卷号</th>
                            <th class="numeric" style="width: 70px;">类型</th>
                            <th class="numeric" style="width: 80px;">申请号</th>
                            <th class="numeric" style="width: 80px;">申请日</th>
                            <th class="numeric">申请人</th>
                            <th class="numeric">专利名称</th>
                            <th class="numeric" style="width: 70px;">案源人</th>
                            <th class="numeric" style="width: 70px;">代理人</th>
                            <th class="numeric" style="width: 70px;">当前程序</th>
                            <th class="numeric" style="width: 100px;">案件类型</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
            			require("conn.php");
						if($dlrbh != null && $ayrbh != null){
//							if($admin == 1){
                				if($admin == 1){
													$sql="select id,案件类型,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,b.状态,申请号,申请人id,申请人,申请日  from `专案_复审等` b where b.冻结状态<>'3' and 状态<>9 group by  b.`案卷号` order by id desc";
												}else{
													$sql="select id,案件类型,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,申请日  from `专案_复审等` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 状态<>9 group by  b.`案卷号` order by id desc";
												}
                				$result = $conn->query($sql);
                        		if($result->num_rows >= 0){
                        			while($row = $result->fetch_assoc()){
//                      				$dlr = substr($row["案卷号"],7,2);
                        				if($row["冻结状态"]==0){
//                      					$Icetype = '正常';
                        					$Icetype = $row['状态'];
		                						}else if($row["冻结状态"]==1){
		                							$Icetype ='结案';
		                						}else if($row["冻结状态"]==2){
		                							$Icetype ='删除';
		                						}
		                						//获取申请人id
//		                        				$SqrId = $row["申请人id"];
//		                        				$SqrId_arr = explode(',',$SqrId);
//		                        				$SQRMes = '';
//				                						for($i=0;$i<count($SqrId_arr);$i++){
//		                        					$sql_SSqr = "select 申请人 from 申请人 where id='".$SqrId_arr[$i]."'";
//		                        					$result_SSqr = $conn->query($sql_SSqr);
//		                        					if($result_SSqr->num_rows > 0){
//		                        						while($row_SSqr = $result_SSqr -> fetch_assoc()){
//		                        							if(strlen($SQRMes) == 0){
//		                        								$SQRMes = $row_SSqr['申请人'];
//		                        							}else{
//		                        								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//		                        							}
//		                        						}
//		                        					}
//		                        				}
                        				?>
	                        				<tr>
	                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $row["id"];?>" /></label></th>
	                        					<td class="numeric"><a href="ware/imitation_1/new_fs/case_info.php?ajh=<?php echo $row["案卷号"];?>" target="_blank" ><?php echo $row["案卷号"];?></a></td>
	                        					<td class="numeric"><?php echo $row["类型"];?></td>
	                        					<td class="numeric"><?php echo $row["申请号"];?></td>
	                        					<td class="numeric"><?php echo $row["申请日"];?></td>
	                        					<td class="numeric"><?php echo $row["申请人"];?></td>
	                        					<td class="numeric"><?php echo $row["专利名称"];?></td>
	                        					<td class="numeric"><?php echo $row["案源人"];?></td>
	                        					<td class="numeric"><?php echo $row["代理人"];?></td>
                        						<td class="numeric"><?php echo $Icetype;?></td>
                        						<td class="numeric"><?php echo $row["案件类型"];?></td>
	                        				</tr>
	                        <?php
	                        			}
	                        		}
							}
                        ?>
                        </tbody>
                    </table>
                </section>
           	</div>
           	<!--年费案件-->
           <div class="tab-pane" id="about-4">
              <section id="unseen">
              	<div>
	              	<a href="ware/imitation_1/new_yearcost/new case 01.php" target="_blank" ><button class="btn btn-success" type="button">新建</button></a><!--ware/imitation_1/new_case/new case 00.php-->
						<button class="btn btn-primary" type="button" data-toggle="modal" href="#addModal4" >结案</button>
						<button class="btn btn-primary" type="button" onclick="huif('dynamic-table_4')" >恢复</button>
						<?php
//							if($admin==1||$lcczy==1){
						?>
							<button class="btn btn-warning" type="button" onclick="del('dynamic-table_4')">删除</button>
						<?php
//							}
						?>	
						<?php 
							if($admin==1){
						?>
							<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_4')">彻底删除</button>
						<?php
							}
						?>
							<a href="phpexcel\my_test\nf_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
	            <button class="btn btn-primary" onclick="Export_someExcel('dynamic-table_4','phpexcel/my_test/nf_export_some.php')">导出选中行Excel清单</button>
		            <!-- button list end -->
					<!-- /btn-group -->
		            	<div class="btn-group" style="float: right;" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">
                            	<?php 
                            		require'conn.php';
                            		//查询
                            		$sqlO1 = "select 专4 from 表格顺序 where 用户id = '".$userid."'";
                            		$resultO1 = $conn->query($sqlO1);
                            		if($resultO1->num_rows>0){
                            			while($rowO1 = $resultO1->fetch_assoc()){
                            				$order = $rowO1['专4'];
                            			}
                            		}
                            		if(strlen($order)<1){
                            			$order = '1/asc/案卷号【正】';
                            		}
                            		//显示
                            		$order = explode('/',$order);
                            		echo $order[2];
                            	?>
                            	<span class="caret"></span>
                            	<span class="dynamic-table_4" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                            </button>
                            <ul role="menu" class="dropdown-menu checilck" id="MenuF" ><!--OrderZL()--> 
                                <li><a href="#">案卷号【正】</a></li>
                                <li><a href="#">案卷号【倒】</a></li>
                                <li><a href="#">申请号【正】</a></li>
                                <li><a href="#">申请号【倒】</a></li>
                                <li><a href="#">原案卷号【正】</a></li>
                                <li><a href="#">原案卷号【倒】</a></li>
                                <li><a href="#">类型</a></li>
                            </ul>
                        </div>
                    <!-- /btn-group -->
		            </div>
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_4">
                        <thead>
                        <tr>
                            <th style="width: 50px;"><input type="checkbox" onchange="selectAll('dynamic-table_4',this)" /></th>
                            <th class="numeric" style="width: 100px;">案卷号</th>
                            <th class="numeric" style="width: 70px;">类型</th>
                            <th class="numeric" style="width: 80px;">申请号</th>
                            <th class="numeric" style="width: 80px;">申请日</th>
                            <th class="numeric">申请人</th>
                            <th class="numeric">专利名称</th>
                            <th class="numeric" style="width: 70px;">案源人</th>
                            <th class="numeric" style="width: 70px;">代理人</th>
                            <th class="numeric" style="width: 70px;">当前程序</th>
                            <th class="numeric" style="width: 80px;">原案卷号</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                			require("conn.php");
							if($dlrbh != null && $ayrbh != null){
//								if($admin == 1){
                    		if($admin == 1){
													$sql="select id,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,原案卷号,申请日  from `专案_年费` b where b.冻结状态<>'3' and 案件状态<>9 group by  b.`案卷号` order by id desc";
												}else{
													$sql="select id,b.案卷号,b.案源人,b.代理人,类型,专利名称,冻结状态,状态,申请号,申请人id,申请人,原案卷号,申请日  from `专案_年费` b where b.冻结状态<>'3' and b.冻结状态<>'2' and 案件状态<>9 group by  b.`案卷号` order by id desc";
												}
                    				
                    				$result = $conn->query($sql);
//									echo $sql;
	                        		if($result->num_rows >= 0){
	                        			while($row = $result->fetch_assoc()){
//	                        				$dlr = substr($row["案卷号"],7,2);
	                        				if($row["冻结状态"]==0){
//	                        					$Icetype = '正常';
	                        					$Icetype = $row['状态'];
	                    						}else if($row["冻结状态"]==1){
	                    							$Icetype ='结案';
	                    						}else if($row["冻结状态"]==2){
	                    							$Icetype ='删除';
	                    						}
	                    						//获取申请人id
//		                        				$SqrId = $row["申请人id"];
//		                        				$SqrId_arr = explode(',',$SqrId);
//		                        				$SQRMes = '';
//				                						for($i=0;$i<count($SqrId_arr);$i++){
//		                        					$sql_SSqr = "select 申请人 from 申请人 where id='".$SqrId_arr[$i]."'";
//		                        					$result_SSqr = $conn->query($sql_SSqr);
//		                        					if($result_SSqr->num_rows > 0){
//		                        						while($row_SSqr = $result_SSqr -> fetch_assoc()){
//		                        							if(strlen($SQRMes) == 0){
//		                        								$SQRMes = $row_SSqr['申请人'];
//		                        							}else{
//		                        								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//		                        							}
//		                        						}
//		                        					}
//		                        				}
	                        				?>
		                        				<tr>
		                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $row["id"];?>" /></label></th>
		                        					<td class="numeric"><a href="ware/imitation_1/new_yearcost/case_info.php?ajh=<?php echo $row["案卷号"];?>" target="_blank" ><?php echo $row["案卷号"];?></a></td>
		                        					<td class="numeric"><?php echo $row["类型"];?></td>
		                        					<td class="numeric"><?php echo $row["申请号"];?></td>
		                        					<td class="numeric" ><?php echo $row["申请日"];?></td>
		                        					<td class="numeric"><?php echo $row["申请人"];?></td>
		                        					<td class="numeric"><?php echo $row["专利名称"];?></td>
		                        					<td class="numeric"><?php echo $row["案源人"];?></td>
		                        					<td class="numeric"><?php echo $row["代理人"];?></td>
	                        						<td class="numeric"><?php echo $Icetype;?></td>
	                        						<td class="numeric"><?php echo $row["原案卷号"];?></td>
		                        				</tr>
		                        <?php
		                        			}
		                        		}
									
								}
                        ?>
                        </tbody>
                    </table>
                </section>
           	</div>
           	<!--案件统计-->
           	<div class="tab-pane" id="about-5">
                  <section id="unseen">
                    <table class="table table-striped " id="editable-sample">
                <thead>
                	<?php
//              		require'conn.php';
                		//发明待提交
                		$sql_con11 = "select count(id) as num from 专利信息 where 状态='待提交' and 类型 like '发明%'";
                		$result11 = $conn->query($sql_con11);
                		if($result11->num_rows>0){
                			while($row11 = $result11->fetch_assoc()){
                				$count11 = $row11['num'];
                			}
                		}
                		//发明申请
                		$sql_con12 = "select count(id) as num from 专利信息 where 状态='申请中' and 类型 like '发明%'";
                		$result12 = $conn->query($sql_con12);
                		if($result12->num_rows>0){
                			while($row12 = $result12->fetch_assoc()){
                				$count12 = $row12['num'];
                			}
                		}
                		//发明年费
                		$sql_con13 = "select count(id) as num from 专利信息 where 状态='年费中' and 类型 like '发明%'";
                		$result13 = $conn->query($sql_con13);
                		if($result13->num_rows>0){
                			while($row13 = $result13->fetch_assoc()){
                				$count13 = $row13['num'];
                			}
                		}
                		//发明无效
                		$sql_con14 = "select count(id) as num from 专案_无效 where 冻结状态='0' and 类型 like '发明%'";
                		$result14 = $conn->query($sql_con14);
                		if($result14->num_rows>0){
                			while($row14 = $result14->fetch_assoc()){
                				$count14 = $row14['num'];
                			}
                		}
                		//实用待提交
                		$sql_con21 = "select count(id) as num from 专利信息 where 状态='待提交' and 类型 like '实用%'";
                		$result21 = $conn->query($sql_con21);
                		if($result21->num_rows>0){
                			while($row21 = $result21->fetch_assoc()){
                				$count21 = $row21['num'];
                			}
                		}
                		//实用申请
                		$sql_con22 = "select count(id) as num from 专利信息 where 状态='申请中' and 类型 like '实用%'";
                		$result22 = $conn->query($sql_con22);
                		if($result22->num_rows>0){
                			while($row22 = $result22->fetch_assoc()){
                				$count22 = $row22['num'];
                			}
                		}
                		//实用年费
                		$sql_con23 = "select count(id) as num from 专利信息 where 状态='年费中' and 类型 like '实用%'";
                		$result23 = $conn->query($sql_con23);
                		if($result23->num_rows>0){
                			while($row23 = $result23->fetch_assoc()){
                				$count23 = $row23['num'];
                			}
                		}
                		//实用无效
                		$sql_con24 = "select count(id) as num from 专案_无效 where 冻结状态='0' and 类型 like '实用%'";
                		$result24 = $conn->query($sql_con24);
                		if($result24->num_rows>0){
                			while($row24 = $result24->fetch_assoc()){
                				$count24 = $row24['num'];
                			}
                		}
                		//外观待提交
                		$sql_con31 = "select count(id) as num from 专利信息 where 状态='待提交' and 类型 like '外观%'";
                		$result31 = $conn->query($sql_con31);
                		if($result31->num_rows>0){
                			while($row31 = $result31->fetch_assoc()){
                				$count31 = $row31['num'];
                			}
                		}
                		//外观申请
                		$sql_con32 = "select count(id) as num from 专利信息 where 状态='申请中' and 类型 like '外观%'";
                		$result32 = $conn->query($sql_con32);
                		if($result32->num_rows>0){
                			while($row32 = $result32->fetch_assoc()){
                				$count32 = $row32['num'];
                			}
                		}
                		//外观年费
                		$sql_con33 = "select count(id) as num from 专利信息 where 状态='年费中' and 类型 like '外观%'";
                		$result33 = $conn->query($sql_con33);
                		if($result33->num_rows>0){
                			while($row33 = $result33->fetch_assoc()){
                				$count33 = $row33['num'];
                			}
                		}
                		//外观无效
                		$sql_con34 = "select count(id) as num from 专案_无效 where 冻结状态='0' and 类型 like '外观%'";
                		$result34 = $conn->query($sql_con34);
                		if($result34->num_rows>0){
                			while($row34 = $result34->fetch_assoc()){
                				$count34 = $row34['num'];
                			}
                		}
                		$conn->close();
                	?>
                <tr>
                    <th>发明</th>
                    <th>待提交：</th>
                    <th><?php echo $count11; ?></th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th><?php echo $count12; ?></th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th><?php echo $count13; ?></th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th><?php echo $count14; ?></th>
                    <th>件；</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>实用</th>
                    <th>待提交：</th>
                    <th><?php echo $count21; ?></th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th><?php echo $count22; ?></th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th><?php echo $count23; ?></th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th><?php echo $count24; ?></th>
                    <th>件；</th>
                </tr>
                <tr>
                    <th>外观</th>
                    <th>待提交：</th>
                    <th><?php echo $count31; ?></th>
                    <th>件；</th>
                    <th>申请：</th>
                    <th><?php echo $count32; ?></th>
                    <th>件；</th>
                    <th>年费阶段：</th>
                    <th><?php echo $count33; ?></th>
                    <th>件；</th>
                    <th>无效：</th>
                    <th><?php echo $count34; ?></th>
                    <th>件；</th>
                </tr>
                </tbody>
                </table>
                </section>
           	</div>
            <!--作废案件-->
           	 <div class="tab-pane" id="about-6">
                  <section id="unseen">
                  	<div>
                  		<!-- button list -->
				          	<div>
											<!--<button class="btn btn-primary" type="button" onclick="huif('dynamic-table')">恢复</button>-->
												<?php
				//									if($admin==1||$lcczy==1){
												?>
													<button class="btn btn-warning" type="button" onclick="del('dynamic-table_5')">删除</button>
												<?php
				//									}
												?>
												<?php
													if($admin==1){
												?>
													<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_5')">彻底删除</button>
												<?php
													}
												?>
				            <!-- button list end -->
											<!-- /btn-group -->
				            	<!--<div class="btn-group" style="float: right;" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuF">
                            	<?php 
                            		require'conn.php';
                            		//查询
                            		$sqlO1 = "select 专4 from 表格顺序 where 用户id = '".$userid."'";
                            		$resultO1 = $conn->query($sqlO1);
                            		if($resultO1->num_rows>0){
                            			while($rowO1 = $resultO1->fetch_assoc()){
                            				$order = $rowO1['专4'];
                            			}
                            		}
                            		if(strlen($order)<1){
                            			$order = '1/asc/案卷号【正】';
                            		}
                            		//显示
                            		$order = explode('/',$order);
                            		echo $order[2];
                            	?>
                            	<span class="caret"></span>-->
                            	<span class="dynamic-table_5" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                            <!--</button>
                            <ul role="menu" class="dropdown-menu checilck" id="MenuF" >
                                <li><a href="#">案卷号【正】</a></li>
                                <li><a href="#">案卷号【倒】</a></li>
                                <li><a href="#">申请号【正】</a></li>
                                <li><a href="#">申请号【倒】</a></li>
                                <li><a href="#">原案卷号【正】</a></li>
                                <li><a href="#">原案卷号【倒】</a></li>
                                <li><a href="#">类型</a></li>
                            </ul>
                        </div>-->
		                    <!-- /btn-group -->
				            </div>
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_5">
                        <thead>
                        <tr>
                            <th style="width: 50px;"><input type="checkbox" onchange="selectAll('dynamic-table_5',this)" /></th>
                            <th class="numeric">案卷号</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">申请人</th>
                            <th class="numeric">创建时间</th>
                            <th class="numeric">创建人</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                					require("conn.php");
													if($dlrbh != null && $ayrbh != null){
														$sql="select id,案卷号,案源人,代理人,创建时间,创建人,申请人id,申请人 from 专利信息 where 状态 = 9 and 冻结状态<>2 and 冻结状态<>3 ";
	                    			$result = $conn->query($sql);
                        		if($result->num_rows > 0){
                        			while($row = $result->fetch_assoc()){
                        				//获取申请人id
//                      				$SqrId = $row["申请人id"];
//                      				$SqrId_arr = explode(',',$SqrId);
//                      				$SQRMes = '';
//                      				for($i=0;$i<count($SqrId_arr);$i++){
//                      					$sql_SSqr = "select 申请人 from 申请人 where id='".$SqrId_arr[$i]."'";
//                      					$result_SSqr = $conn->query($sql_SSqr);
//                      					if($result_SSqr->num_rows > 0){
//                      						while($row_SSqr = $result_SSqr -> fetch_assoc()){
//                      							if(strlen($SQRMes) == 0){
//                      								$SQRMes = $row_SSqr['申请人'];
//                      							}else{
//                      								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//                      							}
//                      						}
//                      					}
//                      				}
                        				?>
	                        				<tr>
	                        					<th><label><input name="Fruit[]" type="checkbox" value="0" /></label></th>
	                        					<td class="numeric"><a href="ware/imitation_1/CaseStaChan.php?ajh=<?php echo $row["案卷号"];?>" target="_blank" ><?php echo $row["案卷号"];?></a></td>
	                        					<td class="numeric"><?php echo $row["案源人"];?></td>
	                        					<td class="numeric"><?php echo $row["代理人"];?></td>
	                        					<td class="numeric"><?php echo $row["申请人"];?></td>
	                        					<td class="numeric"><?php echo $row["创建时间"];?></td>
	                        					<td class="numeric"><?php echo $row["创建人"];?></td>
	                        				</tr>
			                  <?php
                        			}
                        		}
													}
                        ?>
                        </tbody>
                    </table>
                </section>
           	</div>
           	<!--作废案件-->
	        	</div>
	        	</div>
				    </section> 

        </section>
        </div>
        <!--body wrapper end-->
    <!--结案模块-->
    <!--专利案件-->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">专利案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select class="form-control form-control-inline input-medium" id="reason_za">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_za" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--无效案件-->
    <div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">无效案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_wx" class="form-control form-control-inline input-medium">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_wx" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_2')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--复审案件-->
    <div class="modal fade" id="addModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">复审案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_fs" class="form-control form-control-inline input-medium">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_fs" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_3')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--年费案件-->
    <div class="modal fade" id="addModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">年费案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_nf" class="form-control form-control-inline input-medium">
                			<option  value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_nf" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_4')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
		<!--结案模块 end-->

    </div>
    </div>
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
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

<script src="js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--结案，恢复，删除-->
<script src="js/index_action.js"></script>

<script type="text/javascript">
	//批量修改案源人代理人
	function ChangeCaseOwnMes(){
		window.open('info_CasePeoChange.php','_blank',"",false);
//		alert('ok');
	}
//全选
function selectAll(tab,self_doc){
	var tab = document.getElementById(tab);
	var tablen = tab.rows.length;
	for(var i=1;i<tablen;i++){
//		var che = tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
//		tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = !che;
			tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = self_doc.checked;
	}
}
</script>
<!--排序src="js/OrderChange.js" -->

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
	var tab1 = $(".dynamic-table").html();//获取排序信息专利
	var tab2 = $(".dynamic-table_2").html();//获取排序信息无效
	var tab3 = $(".dynamic-table_3").html();//获取排序信息复审
	var tab4 = $(".dynamic-table_4").html();//获取排序信息年费
	var tab5 = $(".dynamic-table_5").html();//获取排序信息
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
	var turn3 = tab3.split('/');
	var turn4 = tab4.split('/');
	var turn5 = tab5.split('/');
	//排序设置
    $('#dynamic-table').dataTable( {
//      "aaSorting": [[ turn1[0], turn1[1] ]],
				"aaSorting": [],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    } );
	$('#dynamic-table_2').dataTable( {
//      "aaSorting": [[ turn2[0], turn2[1] ]],
        "aaSorting": [],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    } );
    $('#dynamic-table_3').dataTable( {
//      "aaSorting": [[ turn3[0], turn3[1] ]],
				"aaSorting": [],
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    } );
    $('#dynamic-table_4').dataTable( {
//      "aaSorting": [[ turn4[0], turn4[1] ]],
				"aaSorting": [],
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
			url:'OrderChange.php',
			type:'get',
			async:true,
			data:{
				falg:aim,//判断表格的依据
				order:Text,
				czyid:czyid,
				page:'index'
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
<!--about 常态-->
<script src="js/NormalS.js"></script>

</body>
</html>