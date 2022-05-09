<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>客户管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

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

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">

                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

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
             			<li><a href="../imitation_2/mailmas.php">邮件收发</a></li>
             			<li><a href="../imitation_2/exdelmas.php">快递收发</a></li>
             			<li><a href="../imitation_2/dateworks.php">日程设置</a></li>
             			<li><a href="../imitation_2/prepare-01.php">预留模块—01</a></li>
             			<li><a href="../imitation_2/prepare-02.php">预留模块—02</a></li>
             		</ul>
             	</li>
            	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>费用管理</span></a>
            		<ul class="sub-menu-list">
                <li><a href="../imitation_3/cost.php"> 费用管理</a></li>
                <li><a href="../imitation_3/yearcost.php"> 年费管理</a></li>
                </ul>
              </li>
             	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>事件管理</span></a>
             		<ul class="sub-menu-list">
             			<li><a href="../imitation_4/dateline.php">案件监控</a></li>
             			<li><a href="../imitation_4/filemag.php">文件管理</a></li>
             			<li><a href="../imitation_4/prepare-01.php">预留模块—01</a></li>
             		</ul>
             	</li>
             	<li class="menu-list nav-active"><a href=""><i class="fa fa-laptop"></i> <span>人员管理</span></a>
             		<ul class="sub-menu-list">
                <li><a href="../imitation_5/proposer.php"> 申请人管理</a></li>
                <li class="active"><a href="../imitation_5/client.php"> 客户管理</a></li>
                <li><a href="../imitation_5/casepeople.php">案源人管理</a></li>
                <li><a href="../imitation_5/agent.php">代理人管理 </a></li>
                </ul>
            </li>
                <li><a href="../imitation_6/financial-management.php"><i class="fa fa-laptop"></i> <span>财务管理</span></a></li>
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


        </div>
        <!-- header section end-->

				<!--body wrapper start :主要内容-->
				<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
		        			<span class="tools pull-right">
			                <a href="javascript:;" class="fa fa-chevron-down"></a>
		             		</span>
		             		<form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
												<label for='ayr'>案源人：</label><input type="text" name="cxayr" placeholder="姓名" />
												
											 	<input type="submit" name="" id="" value="检索" />
</form>
											<?php
												$cxayr= $cxsqr = $cxlxr = $cxgh = $cxqq = $cxsj =$cxzjhm=$cxwx=$cxyx="";
												if($_SERVER["REQUEST_METHOD"] == "POST"){
													$cxayr = test_input($_POST["cxayr"]);
													require("../../conn.php");
													$sql3 = "SELECT a.QQ,a.固话,a.微信,a.手机,a.证件号码,a.邮箱,b.申请人,c.姓名 AS 联系人 from  案源人信息 a,申请人 b,联系人 c where a.名称='".$cxayr."' AND b.id=c.`申请人id`";
													$result3 = $conn->query($sql3);
													
													if($result3->num_rows > 0){
														while($row3 = $result3->fetch_assoc()){
															$cxqq = $row3["QQ"];
															$cxgh = $row3["固话"];
															$cxwx = $row3["微信"];
															$cxsj = $row3["手机"];
															$cxzjhm = $row3["证件号码"];
															$cxyx = $row3["邮箱"];
															$cxsqr = $row3["申请人"];
															$cxlxr = $row3["联系人"];
														}
													}else{
														echo "<script type='text/javascript'>alert('查询失败！'); </script>";
													}
													
													$conn->close();
												}
												
												function test_input($data){
												  $data = trim($data);
												  $data = stripslashes($data);
												  $data = htmlspecialchars($data);
												  return $data;
												}
											?>															 	
						        <br />
						        <span>意向客户</span><strong> XX </strong>人 &nbsp;
						        <span>放弃客户</span><strong> XX </strong>人 &nbsp;	
						        <span>成交客户</span><strong> XX </strong>人 &nbsp;
						        <br /><br />
						        
						        <form action="" method="post">
						        	<table>
									   <tr>
										  <td>申请人名字：</td><td><input type="text" value="<?php echo $cxsqr ?>"  /></td>
										 	<td width="10%"></td>
										  <td>联系人：</td><td><input type="text" value="<?php echo $cxlxr ?>" /></td>
									   </tr>
									   <tr height="5px"></tr>
									   <tr>
									   	<td>固话：</td><td><input type="text" value="<?php echo $cxgh ?>" /></td>
										  <td width="10%"></td>
										  <td>QQ：</td><td><input type="text" value="<?php echo $cxqq ?>"/></td>
									   </tr>
									   <tr height="5px"></tr>
									   <tr>
									   	<td>手机: </td><td><input type="text" value="<?php echo $cxsj ?>" /></td>
										  <td width="10%"></td>
										  <td>邮箱:</td><td><input type="text" value="<?php echo $cxyx ?>" /></td>
									   </tr>
									   <tr height="5px"></tr>
									   <tr>
									   	<td>证件号: </td><td><input type="text" value="<?php echo $cxzjhm ?>" /></td>  	    
											<td width="10%"></td>
										  <td>微信：</td><td><input type="text" value="<?php echo $cxwx ?>" /></td>
									   </tr>
								    </table>
								    <br />
								    <div align="center">
									<button name="" id="" value="" >查询</button>
									</div>
						        </form>
						        	
	        			</header>
	       
				        <div class="panel-body">
				        	<div class="adv-table"> 
				        
							        <table  class="display table table-bordered table-striped" id="dynamic-table">
									        	<thead>
											        <tr>
										            <th>序号</th>
										            <th>名称</th>
										            <th>上次联系日期</th>
										            <th>下次联系日期 </th>
										            <th>备注 </th>
											        </tr>
									        	</thead>
							        	<tbody>
										        <tr>
										        	<td>1</td>
									            <td> <a href="client_information.php" > 填名称 </a> </td>
									            <td>填上次联系日期</td>
									            <td>填下次联系日期 </td>
									            <td>填备注 </td>     	
										        </tr>
							        	</tfoot>
							        </table>
				        	</div>				        	
				        </div>   				
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



<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>


<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>


</body>
</html>
