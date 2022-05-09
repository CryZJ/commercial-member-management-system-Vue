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

  <title>费用总览</title>
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
            <a href="../../index.php"><img src="../../images/logo.png" alt=""></a>
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
            	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>费用管理</span></a>
            		<ul class="sub-menu-list">
		                <li><a href="../imitation_3/cost.php">专利其他费用</a></li>
		                <li><a href="../imitation_3/yearcost.php?flag=none&v=0">专利年费管理</a></li>
	                </ul>
              	</li>
             	<li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>人员管理</span></a>
             		<ul class="sub-menu-list">
	                <li><a href="../imitation_5/client.php"> 申请人管理</a></li>
	                <li><a href="../imitation_5/agent.php">人员管理</a></li>
	              </ul>

	            </li>
	            <li class="menu-list nav-active"><a href="#"><i class="fa fa-laptop"></i> <span>系统设置</span></a>
	                <ul class="sub-menu-list">
		                <!--<li><a href="../imitation_7/efare_set.php">流程设置</a></li>-->
		                <!--<li class="active"><a href="../imitation_7/yfare_set.php">年费设置</a></li>-->
		                <li><a href="../imitation_7/bank_set.php">银行账户设置</a></li>
		            	<li><a href="../imitation_7/fare_set.php">专案费用名设置</a></li>
		            	<li><a href="../imitation_7/BLogoC_set.php">商标代理人设置</a></li>
									<li><a href="../imitation_7/Circuit_set.php">流程设置</a></li>
		            </ul>
	            </li>
                <li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>财务管理</span></a>
                	<ul class="sub-menu-list">
		                <li><a href="../imitation_6/financial-management.php">财务管理</a></li>
		            </ul>
                </li>
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
                    <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>专利案件</a></li>
                    <li class="#"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>商标案件</a></li>
                    <li class="#"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>软件案件</a></li>
                    <li class="#"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>著作案件</a></li>
                    <li class="#"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>海关案件</a></li>
                  </ul>
                </header>
                <div class="panel-body">
                	
				        <div class="tab-content">
					        <div class="tab-pane active" id="about-1">
                  <section id="unseen">
                    	<table class="display table table-bordered table-striped" id="dynamic-table">
	                        <thead>
	            							<tr>
                    					<th>#</th>
                    					<th>案卷号</th>
                    					<th>申请号</th>
                    					<!--<th>id</th>-->
                    					<th hidden="hidden">id</th>
                    					<th>费用种类</th>
                    					<th>缴费金额</th>
                    					<!--<th hidden="hidden" >代理费</th>-->
                    					<th>截止日期【点击缴费】</th>
                    					<th>申请人</th>
                    					<th>申请日</th>
                    					<th>专利名称</th>
                    					<?php
                    						if($admin==1||$lcczy==1){ 
                    					?>
                    					<th>缴费</th>
                    					<th>收据状态</th>
                    					<?php
											} 
                    					?>
                    			</tr>
                        </thead>
                        <tbody>
                      	<?php
                      		require("../../conn.php");
                      		$sql = "SELECT id,`案卷号`,`申请号`,费用名称,`金额`,`缴费期限`,申请人,申请日,`专利名称` ,`收据编号`,`费用状态`,收据上传日期 from  专案费用查询  where 费用状态='0' or 收据上传日期 ='0'";
							$result = $conn->query($sql);
							$row_num = '';
		        			if($result->num_rows > 0){
			        			while($row = $result->fetch_assoc()){
			        				$row_num ++ ;
			        				if ($row["收据编号"] == ''||$row["收据编号"] == null||$row["收据编号"] == 0){			//收据状态
			        					$shouju=  '未登记';
			        				}else{
			        					$shouju=  '已登记';
			        				}
			        				if ($row["费用状态"] == ''||$row["费用状态"] == null||$row["费用状态"] == 0){			//缴费状态
			        					$zhuangtai=  '待交费';
			        				}else{
			        					$zhuangtai=  '已交费';
			        				}
		//							        				if ($row["费用名称"] == '申请费'){			//代理费状态
		//							        					$daili=  '';
		//							        				}else{
		//							        					$daili=  '100';
		//							        				}
		        		?>
        				<tr>
        					<td><input type="checkbox" /> </td>
        					<td><?php echo $row["案卷号"]; ?></td>
        					<!--<td><a href='../imitation_1/caseinformation.php?ajh=<?php echo $row["案卷号"]; ?>'><?php echo $row["案卷号"]; ?></a></td>-->
        					<td><?php echo $row["申请号"]; ?></td>
        					<td hidden="hidden" id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>
        					<!--<td id="f_id<?php echo $row_num; ?>"><?php echo $row["id"]; ?></td>-->
        					<td><?php echo $row["费用名称"]; ?></td>
        					<td><?php echo $row["金额"]; ?></td>
<!--						        					<td hidden="hidden"><input style="width: 80px;" type="text" value="<?php echo $daili; ?>" id="daili<?php echo $row_num; ?>" name="" /></td>-->
        					<!--<td>  </td>-->
        					<td><?php echo $row["缴费期限"]; ?></td>
        					<td><?php echo $row["申请人"]; ?></td>
        					<td><?php echo $row["申请日"]; ?></td>
        					<td><?php echo $row["专利名称"]; ?></td>
        					<?php
								if($admin==1||$lcczy==1){ 
							?>
        					<td><?php echo $zhuangtai; ?></td>
        					<!--<td ><label onclick="ChanS(<?php echo $row_num; ?>)"><a href="#"><?php echo $zhuangtai; ?></a></label></td>-->
        					<td><?php echo $shouju; ?></td>
        					<?php
								} 
        					?>
        					<!--<td><label><a href='cost/cost_check.php' =<?php echo $row["案卷号"]; ?>'><?php echo $shouju; ?></a></label></td>-->
        				</tr>
						<?php
								}
							}
			        		$conn->close();
						?>
					</tbody>                   										
				</table>
                </section>
            	</div><!--tab-01 end-->
							<div class="tab-pane" id="about-2">
                  <section id="unseen">
                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
                      <thead>
		                <tr>																											  								
	                  		<th>案卷号</th>
                            <th class="numeric">专利名</th>
                            <th class="numeric">类型</th>
                            <th class="numeric">状态</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">客户</th>
                            <th class="numeric">备注</th>
						</tr>
                      </thead>
                      <tbody>
                        <tr>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						 	<td>#</td>
						</tr>
                    </tbody>
                   </table>
                </section>
            	</div><!--tab-02 end-->
      				<div class="tab-pane" id="about-3">
                  <section id="unseen">
                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
                        <thead>
						<tr>																											  														
							<th>案卷号</th>
                            <th class="numeric">专利名</th>
                            <th class="numeric">类型</th>
                            <th class="numeric">状态</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">客户</th>
                            <th class="numeric">备注</th>
						</tr>																											  												
						</thead>
                        <tbody>
	                        <tr>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							</tr>
						</tbody>
                   </table>
                </section>
            </div><!--tab-03 end-->
            <div class="tab-pane" id="about-4">
                  <section id="unseen">
                    <table class="display table table-bordered table-striped" id="dynamic-table_4">
                        <thead>
						<tr>																											  														
							<th>案卷号</th>
                            <th class="numeric">专利名</th>
                            <th class="numeric">类型</th>
                            <th class="numeric">状态</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">客户</th>
                            <th class="numeric">备注</th>
						</tr>																											  												
						</thead>
                        <tbody>
	                        <tr>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
								 	<td>#</td>
							</tr>
						</tbody>
                   </table>
                </section>
            	</div><!--tab-04 end-->
            	<div class="tab-pane" id="about-5">
                  <section id="unseen">
                    <table class="display table table-bordered table-striped" id="dynamic-table_5">
                        <thead>
							<tr>																											  														
								<th>案卷号</th>
	                            <th class="numeric">专利名</th>
	                            <th class="numeric">类型</th>
	                            <th class="numeric">状态</th>
	                            <th class="numeric">案源人</th>
	                            <th class="numeric">代理人</th>
	                            <th class="numeric">客户</th>
	                            <th class="numeric">备注</th>
							</tr>																											  												
						</thead>
                        <tbody>
	                        <tr>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							 	<td>#</td>
							</tr>
						</tbody>
                   </table>
                </section>
            	</div><!--tab-05 end-->
            
	        	</div>
	        	</div>
				   </section>   
            
        	</div>
        </div>
        </div>		
                                       			
				<!--body wrapper end-->
				
        <!--footer section start-->
        <!--
        <footer>
            
        </footer>
        -->
        <!--footer section end-->

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

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--页面响应-->
<script src="../../js/imitation_3/cost.js" ></script>


</body>
</html>
