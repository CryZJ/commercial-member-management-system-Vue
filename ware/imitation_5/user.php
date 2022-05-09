<?php require("../../AHeader.php");?>
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

  <title>账号管理</title>
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
                <li><a href="../imitation_3/cost.php">费用总览</a></li>
                <li><a href="../imitation_3/cost_zl.php">费用明细</a></li>
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
                <li><a href="../imitation_5/client.php"> 申请人管理</a></li>
                <li><a href="../imitation_5/agent.php">人员管理</a></li>
                 <?php
                	session_start();
									$userid = $_SESSION['id'];
					        $user = $_SESSION['user']; 
									$dlrbh = $_SESSION['dlr']; 
									$ayrbh = $_SESSION['ayr']; 
									$lcczy = $_SESSION['lcczy']; 
									$admin = $_SESSION['admin'];
									if($admin != 0 ||$lcczy != 0){
					                	echo"<li><a class='active' href='../imitation_5/user.php'>账号管理</a></li>";
									}
                ?>
            </ul>
            	<li><a href="../imitation_6/financial-management.php"><i class="fa fa-laptop"></i> <span>财务管理</span></a></li>
                <li><a href="../../login.php"><i class="fa fa-sign-in"></i> <span>账号注销</span></a></li>
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

										
            <!--search start  左边上的搜索-->
            <!--
            <form class="searchform" action="http://view.jqueryfuns.com/2014/4/10/7_df25ceea231ba5f44f0fc060c943cdae/index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>
            -->
            <!--search end-->
						         

        </div>
        <!-- header section end-->

<div class="col-sm-12"><br /><br />
    <section class="panel">
      <header class="panel-heading custom-tab">
	      <ul class="nav nav-tabs">
	        <li class="active"><a href="#about-1" data-toggle="tab"> 流程操作员</a></li>
	        <li class="#"><a href="#about-2" data-toggle="tab"> 代理人</a></li>
	        <li class="#"><a href="#about-3" data-toggle="tab"> 案源人 </a></li>
	      </ul>
      </header>
	    <div class="panel-body">
        <div class="tab-content">    
        	<!-- 流程操作员-->                            
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
							<div class="wrapper">
        				<div class="row">
	        				<header class="panel-heading">
		        				<span class="tools pull-right">
			                <a href="javascript:;" class="fa fa-chevron-down"></a>
		             		</span>
						        <?php 
		             		if($admin == 1){
		             			 echo"<a class='btn btn-primary' data-toggle='modal' href='#myModal'>新建</a>";
		             		} 
						     		?>
						        			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">账号管理</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                        	
                                            <form action="userSave.php" class="form-horizontal " method="post">
                                            			<input type="text" hidden name="idnum" value="0"></input>
                                            			<table>
																					           <tbody>
																					           				<tr height="5px"></tr>
																					                  <tr>
																														  <td>名称：</td><td><input type="text" name="mc" id="" /></td>
																														  <td width="10%"></td>
																														  <td>固话：</td><td><input type="text" name="gh" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																														<tr>
																														  <td>手机：</td><td><input type="text" name="sj" id="" /></td>
																														  <td width="10%"></td>
																														  <td>QQ：</td><td><input type="text" name="qq" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																														  <td>邮箱: </td><td><input type="email" name="yx" id="" /></td>
																														  <td width="10%"></td>
																														  <td>微信:</td><td><input type="text" name="wx" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																													  	<td >证件号码: </td><td colspan="2"><input type="text" name="zjhm" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																													  	<tr height="5px"></tr>
																													  	<td>通信地址：</td><td colspan="2"><input type="text" name="txdz" id="" /></td>
																													  </tr>
																													  <p></p>
																													   <tr height="5px"></tr>
																													    <tr>
																														  <td>账号: </td><td><input type="text" name="zh" id="" /></td>
																														  <td width="10%"></td>
																														  <td>密码:</td><td><input type="password" name="mm" id="" /></td>
																													   </tr>
																													 
																											</tbody>
																					          </table>
																					          <br />
																					         <div>
																					          		<p>备注：</p>
																					          		<p><textarea cols="65" rows="3" name="bz"></textarea></p>
																					         </div>
																					          		
														                        	<br />
														                        	<div id="" class="" align="center">
														                        		
														                        	<!--	<input type="submit" value="修改" onmousedown="window.close()"/> -->
														                        		&nbsp;&nbsp;
															                        	<input type="submit" name="" id="" value="保存" " />
														                        	</div>
                                            </form>
						        											</div>                               

																		</div>
																</div>
														</div>
	        			</header>
	       
				        <div class="panel-body">
				        	<div class="adv-table"> 
				        
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
								        	<thead>
										        <tr> 
										        	<th>序号</th>
										            <th>姓名</th>
										            <th>手机号码</th>
										            <th>地址 </th>
										            <th>邮箱</th>
										            <th>备注</th>
										        </tr>
								        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		if($admin ==1){
						        			$sql = "select * from 流程操作员信息";
						        		}else{
						        			$sql = "select * from 流程操作员信息  where 账号 = '$user'";
						        		}
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				echo "<tr>";
						        					//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";
						        					echo "<td><a data-toggle='modal' href='#myModal".$row["id"]."'>".$row["id"]."</a></td>";
						        					echo "<td>".$row["姓名"]."</td>";
						        					echo "<td>".$row["手机"]."</td>";
						        					echo "<td>".$row["地址"]."</td>";
						        					echo "<td>".$row["邮箱"]."</td>";
						        					echo "<td>".$row["备注"]."</td>";
						        				echo "</tr>";
						        				//创建小窗口
						        				
						        				echo "<div class='modal fade' id='myModal".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
						        				echo "<div class='modal-dialog'>";
						        				echo "<div class='modal-content'>";
						        				echo "<div class='modal-header'>";
						        				echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
						        				echo "<h4 class='modal-title'>流程管理员".$row["id"]."</h4>";
						        				echo "</div>";
						        				echo "<div class='modal-body'>";
						        				echo "<form action='userSave.php' class='form-horizontal ' method='post'>";
						        				echo "<input type='text' hidden name='idnum' value='".$row["id"]."'></input>";
						        				echo "<br/><br/>";
						        				echo "姓名：&nbsp;&nbsp;<input type='text' name='mc' value='".$row["姓名"]."'/> &nbsp;&nbsp; 固话：<input type='text' name='gh' value='".$row["固话"]."' />";
						        				echo "<br/><br/>";
						        				echo "手机：&nbsp;&nbsp;<input type='text' name='sj' value='".$row["手机"]."' /> &nbsp;&nbsp;&nbsp; QQ：<input type='text' name='qq' value='".$row["QQ"]."' />";
						        				echo "<br/><br/>";
						        				echo "邮箱：&nbsp;&nbsp;<input type='email' name='yx' value='".$row["邮箱"]."' /> &nbsp;&nbsp; 微信：<input type='text' name='wx' value='".$row["微信"]."' />";
						        				echo "<br/><br/>";
						        				echo "证件号码：<input type='text' name='zjhm' value='".$row["证件号码"]."' />";
						        				echo "<br/><br/>";
						        				echo "通信地址：<input type='text' name='txdz' value='".$row["地址"]."' />";
														echo "<br/><br/>";
														echo "账号：<input type='text' name='zh' value='".$row["账号"]."' /> &nbsp;&nbsp;&nbsp;&nbsp; 密码：<input type='password' name='mm' value='".$row["密码"]."' />";
						        				echo "<br/><br/><div><p>备注：</p><p><textarea cols='65' rows='3' name='bz'>".$row["备注"]."</textarea></p></div>";
						        				echo "<br /><div id='' class='' align='center'><input type='submit' name='' id='' value='修改'  /></div>";
						        				echo "</form></div></div></div></div>	";
						        				//小窗完毕
						        			}
						        		}
						        		
						        		$conn->close();
						        			
						        	?>
						        	
						        </table>
				        	</div>				        	

	        </section>
	    	</div>
	    					<!-- 代理人分页面-->								
				<div class="tab-pane" id="about-2">
          <section id="unseen">
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">代理人信息</h4>
                                        </div>
                                        
                                        <div class="modal-body">
						        											</div>                               

																		</div>
																</div>
														</div>
	        			</header>
	       
				        <div class="panel-body">
				        	<div class="adv-table"> 
				        
						        <table  class="display table table-bordered table-striped" id="dynamic-table_2">
								        	<thead>
										        <tr> 
										        	<th>代理人编号</th>
										            <th>姓名</th>
										            <th>电话</th>
										            <th>入职日期 </th>
										            <th>离职日期 </th>
										            <th>备注</th>
										        </tr>
								        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql = "SELECT * from 代理人信息 a,用户  b where a.编号 = b.代理人编号 and a.编号 != ''";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				echo "<tr>";
						        					//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";
						        					echo "<td><a data-toggle='modal' href='#myModal".$row["代理人编号"]."'>".$row["代理人编号"]."</a></td>";
						        					echo "<td>".$row["名称"]."</td>";
						        					echo "<td>".$row["手机"]."</td>";
						        					echo "<td>".$row["入职日期"]."</td>";
						        					echo "<td>".$row["离职日期"]."</td>";
						        					echo "<td>".$row["备注"]."</td>";
						        				echo "</tr>";
						        				//创建小窗口
						        				
						        				echo "<div class='modal fade' id='myModal".$row["编号"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
						        				echo "<div class='modal-dialog'>";
						        				echo "<div class='modal-content'>";
						        				echo "<div class='modal-header'>";
						        				echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
						        				echo "<h4 class='modal-title'>myModal".$row["编号"]."</h4>";
						        				echo "</div>";
						        				echo "<div class='modal-body'>";
						        				echo "<form action='agentSave.php' class='form-horizontal ' method='post'>";
														echo "代理人编号：<input type='text' name='dlrbh' value='".$row["代理人编号"]."' />";
						        				echo "<br/><br/>";
						        				echo "名称：<input type='text' name='mc' value='".$row["名称"]."'/> &nbsp;&nbsp; 固话：<input type='text' name='gh' value='".$row["固话"]."' />";
						        				echo "<br/><br/>";
						        				echo "手机：<input type='text' name='sj' value='".$row["手机"]."' /> &nbsp;&nbsp;&nbsp;&nbsp; QQ：<input type='text' name='qq' value='".$row["QQ"]."' />";
						        				echo "<br/><br/>";
						        				echo "邮箱：<input type='email' name='yx' value='".$row["邮箱"]."' /> &nbsp;&nbsp; 微信：<input type='text' name='wx' value='".$row["微信"]."' />";
						        				echo "<br/><br/>";
						        				echo "证件号码：<input type='text' name='zjhm' value='".$row["证件号码"]."' />";
						        				echo "<br/><br/>";
						        				echo "通信地址：<input type='text' name='txdz' value='".$row["通信地址"]."' />";
						        				echo "<br/><br/>";
						        				echo "入职日期：<input class='default-date-picker' readonly type='text' name='rzrq' value='".$row["入职日期"]."' />";
						        				echo "<br/><br/>";
						        				echo "离职日期：<input class='default-date-picker' readonly type='text' name='lzrq' value='".$row["离职日期"]."' />";
						        				echo "<br/><br/><div><p>备注：</p><p><textarea cols='65' rows='3' name='bz'>".$row["备注"]."</textarea></p></div>";
						        				//echo "<br /><div id='' class='' align='center'><input type='submit' name='' id='' value='修改'  /></div>";
						        				echo "</form></div></div></div></div>	";
						        				//小窗完毕
						        			}
						        		}
						        		
						        		$conn->close();
						        			
						        	?>
						        	
						        </table>
				        	</div>				   
        </section>
      </div>
      <!--案源人分页面-->
      <div class="tab-pane" id="about-3">
          <section id="unseen">
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">案源人信息</h4>
                                        </div>
                                        
                                        <div class="modal-body">
						        											</div>                               

																		</div>
																</div>
														</div>
	        			</header>
	       
				        <div class="panel-body">
				        	<div class="adv-table"> 
				        
						        <table  class="display table table-bordered table-striped" id="dynamic-table_3">
								        	<thead>
										        <tr> 
										        	<th>案源人编号</th>
										            <th>姓名</th>
										            <th>电话</th>
										            <th>入职日期 </th>
										            <th>离职日期 </th>
										            <th>备注</th>
										        </tr>
								        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql = "SELECT * from 案源人信息 a,用户  b where a.编号 = b.案源人编号 and a.编号 != ''";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				echo "<tr>";
						        					//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";
						        					echo "<td><a data-toggle='modal' href='#myModal".$row["案源人编号"]."'>".$row["案源人编号"]."</a></td>";
						        					echo "<td>".$row["名称"]."</td>";
						        					echo "<td>".$row["手机"]."</td>";
						        					echo "<td>".$row["入职日期"]."</td>";
						        					echo "<td>".$row["离职日期"]."</td>";
						        					echo "<td>".$row["备注"]."</td>";
						        				echo "</tr>";
						        				//创建小窗口
						        				
						        				echo "<div class='modal fade' id='myModal".$row["编号"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
						        				echo "<div class='modal-dialog'>";
						        				echo "<div class='modal-content'>";
						        				echo "<div class='modal-header'>";
						        				echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
						        				echo "<h4 class='modal-title'>myModal".$row["编号"]."</h4>";
						        				echo "</div>";
						        				echo "<div class='modal-body'>";
						        				echo "<form action='agentSave.php' class='form-horizontal ' method='post'>";
														echo "案源人编号：<input type='text' name='dlrbh' value='".$row["案源人编号"]."' />";
						        				echo "<br/><br/>";
						        				echo "名称：<input type='text' name='mc' value='".$row["名称"]."'/> &nbsp;&nbsp; 固话：<input type='text' name='gh' value='".$row["固话"]."' />";
						        				echo "<br/><br/>";
						        				echo "手机：<input type='text' name='sj' value='".$row["手机"]."' /> &nbsp;&nbsp;&nbsp;&nbsp; QQ：<input type='text' name='qq' value='".$row["QQ"]."' />";
						        				echo "<br/><br/>";
						        				echo "邮箱：<input type='email' name='yx' value='".$row["邮箱"]."' /> &nbsp;&nbsp; 微信：<input type='text' name='wx' value='".$row["微信"]."' />";
						        				echo "<br/><br/>";
						        				echo "证件号码：<input type='text' name='zjhm' value='".$row["证件号码"]."' />";
						        				echo "<br/><br/>";
						        				echo "通信地址：<input type='text' name='txdz' value='".$row["通信地址"]."' />";
						        				echo "<br/><br/>";
						        				echo "入职日期：<input class='default-date-picker' readonly type='text' name='rzrq' value='".$row["入职日期"]."' />";
						        				echo "<br/><br/>";
						        				echo "离职日期：<input class='default-date-picker' readonly type='text' name='lzrq' value='".$row["离职日期"]."' />";
						        				echo "<br/><br/><div><p>备注：</p><p><textarea cols='65' rows='3' name='bz'>".$row["备注"]."</textarea></p></div>";
						        				//echo "<br /><div id='' class='' align='center'><input type='submit' name='' id='' value='修改'  /></div>";
						        				echo "</form></div></div></div></div>	";
						        				//小窗完毕
						        			}
						        		}
						        		
						        		$conn->close();
						        			
						        	?>
						        	
						        </table>
				        	</div>				   
        </section>
      </div>
    </div>
  </div>
</section>

        <!--body wrapper end-->



				<!--body wrapper start :主要内容-->
				<!--<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
		        				<span class="tools pull-right">
			                <a href="javascript:;" class="fa fa-chevron-down"></a>
		             		</span>
						        <a class="btn btn-primary" data-toggle="modal" href="#myModal">新建</a>
						        			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">账号管理</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                        	
                                            <form action="workerSave.php" class="form-horizontal " method="post">
                                            			<input type="text" hidden name="idnum" value="0"></input>
                                            			<table>
																					           <tbody>
																					           				<tr height="5px"></tr>
																					                  <tr>
																														  <td>名称：</td><td><input type="text" name="mc" id="" /></td>
																														  <td width="10%"></td>
																														  <td>固话：</td><td><input type="text" name="gh" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																														<tr>
																														  <td>手机：</td><td><input type="text" name="sj" id="" /></td>
																														  <td width="10%"></td>
																														  <td>QQ：</td><td><input type="text" name="qq" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																														  <td>邮箱: </td><td><input type="email" name="yx" id="" /></td>
																														  <td width="10%"></td>
																														  <td>微信:</td><td><input type="text" name="wx" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																													  	<td >证件号码: </td><td colspan="2"><input type="text" name="zjhm" id="" /></td>
																													  </tr>
																													  <tr height="5px"></tr>
																													  <tr>
																													  	<tr height="5px"></tr>
																													  	<td>通信地址：</td><td colspan="2"><input type="text" name="txdz" id="" /></td>
																													  </tr>
																											</tbody>
																					          </table>
																					          <br />
																					         <div>
																					          		<p>备注：</p>
																					          		<p><textarea cols="65" rows="3" name="bz"></textarea></p>
																					         </div>
																					          		
														                        	<br />
														                        	<div id="" class="" align="center">
														                        		<!--
														                        		<input type="submit" value="修改" onmousedown="window.close()"/>
														                        		&nbsp;&nbsp;
															                        	<input type="submit" name="" id="" value="保存" " />
														                        	</div>
                                            </form>
						        											</div>                               

																		</div>
																</div>
														</div>
	        			</header>
	       
				        <div class="panel-body">
				        	<div class="adv-table"> 
				        
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
								        	<thead>
										        <tr> 
										        	<th>序号</th>
										            <th>姓名</th>
										            <th>手机号码</th>
										            <th>地址 </th>
										            <th>邮箱</th>
										            <th>备注</th>
										        </tr>
								        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql = "select * from 流程操作员信息";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				echo "<tr>";
						        					//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";
						        					echo "<td><a data-toggle='modal' href='#myModal".$row["id"]."'>".$row["id"]."</a></td>";
						        					echo "<td>".$row["姓名"]."</td>";
						        					echo "<td>".$row["手机"]."</td>";
						        					echo "<td>".$row["地址"]."</td>";
						        					echo "<td>".$row["邮箱"]."</td>";
						        					echo "<td>".$row["备注"]."</td>";
						        				echo "</tr>";
						        				//创建小窗口
						        				
						        				echo "<div class='modal fade' id='myModal".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
						        				echo "<div class='modal-dialog'>";
						        				echo "<div class='modal-content'>";
						        				echo "<div class='modal-header'>";
						        				echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
						        				echo "<h4 class='modal-title'>myModal".$row["id"]."</h4>";
						        				echo "</div>";
						        				echo "<div class='modal-body'>";
						        				echo "<form action='agentSave.php' class='form-horizontal ' method='post'>";
						        				echo "<input type='text' hidden name='idnum' value='".$row["id"]."'></input>";
														echo "编号：<input type='text' name='bh' value='".$row["编号"]."' />";
						        				echo "<br/><br/>";
						        				echo "姓名：<input type='text' name='mc' value='".$row["姓名"]."'/> &nbsp;&nbsp; 固话：<input type='text' name='gh' value='".$row["固话"]."' />";
						        				echo "<br/><br/>";
						        				echo "手机：<input type='text' name='sj' value='".$row["手机"]."' /> &nbsp;&nbsp;&nbsp;&nbsp; QQ：<input type='text' name='qq' value='".$row["QQ"]."' />";
						        				echo "<br/><br/>";
						        				echo "邮箱：<input type='email' name='yx' value='".$row["邮箱"]."' /> &nbsp;&nbsp; 微信：<input type='text' name='wx' value='".$row["微信"]."' />";
						        				echo "<br/><br/>";
						        				echo "证件号码：<input type='text' name='zjhm' value='".$row["证件号码"]."' />";
						        				echo "<br/><br/>";
						        				echo "通信地址：<input type='text' name='txdz' value='".$row["地址"]."' />";
						        				echo "<br/><br/><div><p>备注：</p><p><textarea cols='65' rows='3' name='bz'>".$row["备注"]."</textarea></p></div>";
						        				echo "<br /><div id='' class='' align='center'><input type='submit' name='' id='' value='修改'  /></div>";
						        				echo "</form></div></div></div></div>	";
						        				//小窗完毕
						        			}
						        		}
						        		
						        		$conn->close();
						        			
						        	?>
						        	
						        </table>
				        	</div>				        	
				        </div>
				        				
	        		</section>
	        	</div>
        	</div>
        </div>
                                 -->      			
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
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>




</body>
</html>