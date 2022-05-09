<?php
	require("../../AHeader.php");
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

  <title>费用名设置</title>
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
             			<li><a href="../imitation_2/mailmas.php">邮件收发</a></li>
             			<li><a href="../imitation_2/exdelmas.php">快递收发</a></li>
             			<li><a href="../imitation_2/casemark.php">案件登记</a></li>
             			<!--<li><a href="../imitation_2/prepare-01.php">预留模块—01</a></li>-->
             			<!--<li><a href="../imitation_2/prepare-02.php">预留模块—02</a></li>-->
             		</ul>
             	</li>
            	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>费用管理</span></a>
            		<ul class="sub-menu-list">
		                <li><a href="../imitation_3/cost.php">专利其他费用</a></li>
		                <li><a href="../imitation_3/yearcost.php">专利年费管理</a></li>
		                <li><a href="../imitation_3/cost_zl.php">其他费用管理</a></li>
	                </ul>
              	</li>
             	<!--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>事件管理</span></a>
             		<ul class="sub-menu-list">
             			<li><a href="../imitation_4/dateline.php">案件流程监控</a></li>
             			<li><a href="../imitation_4/filemag.php">文件管理</a></li>
             		</ul>
             	</li>-->
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
	            		<li class="menu-list nav-active"><a href="#"><i class="fa fa-laptop"></i> <span>系统设置</span></a>
			                <ul class="sub-menu-list">
				                <!--<li><a href="../imitation_7/efare_set.php">流程设置</a></li>-->
				                <li><a href="../imitation_7/yfare_set.php">年费设置</a></li>
				                <li><a href="../imitation_7/bank_set.php">银行账户设置</a></li>
				            	<li class="active"><a href="../imitation_7/fare_set.php">专案费用名设置</a></li>
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
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">1</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">日程备忘</h5>
                            <ul class="dropdown-list user-list">
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>事件一</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>事件二</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
                                                <span class="">80% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!--<li class="new"><a href="">See All Pending Task</a></li>-->
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">待处理文件</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <!--<a href="">-->
                                        <!--<span class="thumb"><img src="../../images/photos/user1.png" alt="" /></span>-->
                                        <span class="desc">
                                          <span class="name">发件人一<span class="badge badge-success">new</span></span>
                                          <span class="msg">案件名称/文件名</span>
                                        </span>
                                    <!--</a>-->
                                </li>
                                <li>
                                    <!--<a href="">-->
                                        <!--<span class="thumb"><img src="../../images/photos/user2.png" alt="" /></span>-->
                                        <span class="desc">
                                          <span class="name">发件人二</span>
                                          <span class="msg">案件名称/文件名</span>
                                        </span>
                                    <!--</a>-->
                                </li>
                                <li class="new">
                                	<a href="">
                                		<span class="desc">
                                          <span >进入文件下载页面</span>
                                        </span>
                                </a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">操作提醒</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">提醒类型</span>
                                        <em class="small">案件/操作</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">提醒类型</span>
                                        <em class="small">案件/操作</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">
                                		<span class="desc">
                                          <span >进入提醒页面</span>
                                        </span>
                                </a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo $name; ?>
                        </a>
                    </li>
                </ul>
            </div>
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
		                    <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>费用名称</a></li>
		                    <!--<li class="#"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>实用新型</a></li>
		                    <li class="#"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>外观设计</a></li>-->
		                  </ul>
                		</header>
                <div class="panel-body">
	        <div class="tab-content">
		        <div class="tab-pane active" id="about-1">
                  <section id="unseen">
                  	<sub style="color:red;" ><strong>注：费用名称请以专利局缴费时所用的表格中的名字为准</strong></sub>
                  </br>
                  <div style="width:900px;" >
                  	<table class="display table table-bordered table-striped" id="tab_n">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">#</th>
                            <th class="numeric">专利类型</th>
                            <th class="numeric">费用名</th>
						</tr>
                      </thead>
                      <tbody>
                      	<tr>
                      		<td>1</td>
	                      	<td>
	                      		<select id="sel" >
		                      		<option>发明专利</option>
		                      		<option>实用新型</option>
		                      		<option>外观设计</option>
	                      		</select>
	                      	</td>
	                      	<td><input /></td>
                      	</tr>
                      	<tr>
                      		<td colspan="2" align="center" onclick="change('tab_n')" ><input style="width:200px;" type="button"  readonly="readonly" value="增行" /></td>
                      		<td align="center" ><input type="button" value="保存" id="savedata" onclick="savenew()" /></td>
                      	</tr>
                      </tbody>
                   </table>
                  </div>
                  </br>
                  <div>
                  	<div style="float:left;" >
                  	<table class="display table table-bordered table-striped" id="tab_set_1">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">#</th>
                            <th class="numeric">发明专利</th>
						</tr>
                      </thead>
                      <tbody>
                      	<?php
                      		require'../../conn.php';
                      		//数据根据费用名拼音排序
                      		$sql="select id,专案类型,费用名 from 费用名参看 where 专案类型='1' order by convert(费用名 using gbk) asc";
                      		$result = $conn->query($sql);
                      		if($result->num_rows>0){
                      			$num = 1;
                      			while($row=$result->fetch_assoc()){
                      				?>
                      				<tr>
                      					<td><?php echo $num; ?></td>
									 	<td><input type="text" id="f_<?php echo $row['id']; ?>" name="fare" value="<?php echo $row['费用名']; ?>" /><input type="button" id="<?php echo $row['id']; ?>" value="修改" onclick="changef(this.id,this.value)" /></td>
									</tr>
                      				<?php
                      					$num ++;
                      			}
                      		}
                      		$conn->close();
                      	?>
                      	<!--<tr>
                      		<td colspan="2" align="center" onclick="addtab('tab_set_1')" >+</td>
                      	</tr>-->
                      </tbody>
                   </table>
                  </div>
                  <div style="float:left;" > &nbsp;</div>
                  <div style="float:left;" >
                  	<table class="display table table-bordered table-striped" id="tab_set_2">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">#</th>
                            <th class="numeric">实用新型</th>
						</tr>
                      </thead>
                      <tbody>
                        <?php
                      		require'../../conn.php';
                      		//数据根据费用名拼音排序
                      		$sql="select id,专案类型,费用名 from 费用名参看 where 专案类型='2' order by convert(费用名 using gbk) asc";
                      		$result = $conn->query($sql);
                      		if($result->num_rows>0){
                      			$num = 1;
                      			while($row=$result->fetch_assoc()){
                      				?>
                      				<tr>
                      					<td><?php echo $num; ?></td>
									 	<td><input type="text" id="f_<?php echo $row['id']; ?>" name="fare" value="<?php echo $row['费用名']; ?>" /><input type="button" id="<?php echo $row['id']; ?>" value="修改" onclick="changef(this.id,this.value)" /></td>
									</tr>
                      				<?php
                      					$num ++;
                      			}
                      		}
                      		$conn->close();
                      	?>
                      	<!--<tr>
                      		<td colspan="2" align="center" onclick="addtab('tab_set_2')" >+</td>
                      	</tr>-->
                      </tbody>
                   </table>
                  </div>
                  <div style="float:left;" > &nbsp;</div>
                  <div style="float:left;" >
                  	<table class="display table table-bordered table-striped" id="tab_set_3">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">#</th>
                            <th class="numeric">外观设计</th>
						</tr>
                      </thead>
                      <tbody>
                        <?php
                      		require'../../conn.php';
                      		//数据根据费用名拼音排序
                      		$sql="select id,专案类型,费用名 from 费用名参看 where 专案类型='3' order by convert(费用名 using gbk) asc";
                      		$result = $conn->query($sql);
                      		if($result->num_rows>0){
                      			$num = 1;
                      			while($row=$result->fetch_assoc()){
                      				?>
                      				<tr>
                      					<td><?php echo $num; ?></td>
									 	<td><input type="text" id="f_<?php echo $row['id']; ?>" name="fare" value="<?php echo $row['费用名']; ?>" /><input type="button" id="<?php echo $row['id']; ?>" value="修改" onclick="changef(this.id,this.value)" /></td>
									</tr>
                      				<?php
                      					$num ++;
                      			}
                      		}
                      		$conn->close();
                      	?>
                      	<!--<tr>
                      		<td colspan="2" align="center" onclick="addtab('tab_set_3')" >+</td>
                      	</tr>-->
                      </tbody>
                    </table>
                  </div>
                  </div>
                   <br />
                </section>
            	</div><!--tab-01 end-->
	        	</div>
	        	</div>
				   </section>   
            
        	</div>
        </div>
        </div>		
    </div>
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
<script src="../../js/imitation_7/fare_set.js"></script>

</body>
</html>
