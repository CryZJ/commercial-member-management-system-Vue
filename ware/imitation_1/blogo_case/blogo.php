<?php require'../../../AHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
   <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>商标案件</title>
  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="../../../js/jquery-1.10.2.min.js"></script>

</head>

<body class="sticky-header">
<!--<body class="sticky-header" onload="show_remind()">-->
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../../menu_tree.php"); 
				Create_leftlist(0,1);
			?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content" >
				
        <!-- header section start-->
        <div class="header-section">
						
            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--<a class="btn" href="javascript:openWin()"><i class="fa fa-pencil fa-fw" ></i></a>-->
            <!--toggle button end-->
		
					<!--notification menu start -->
          <?php require'../../../MenuMin-3.php';  ?>
          <!--notification menu end -->
		
        </div>
        <!-- header section end-->

        <!--body wrapper start-->
		<div class="wrapper" >
    		<div class="row" >
        	<div class="col-sm-12">
        		<section class="panel">
        			<header class="panel-heading custom-tab">
		              <ul class="nav nav-tabs">
		                <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>商标管理</a></li>
		                <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>商标申请</a></li>
		                <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>商标监控</a></li>
		                <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>委托书</a></li>
		                <input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
		                <input id="NORS" hidden="hidden" value="<?php echo $normal; ?>" />
		              </ul>
           			</header>
           	<div class="panel-body">
			        	<div class="tab-content">                             
					        <!--商标申请START-->
					        <div class="tab-pane" id="about-4">
                  			<section id="unseen">
			            <!-- button list -->
				          	<div>
				              <button class="btn btn-success" type="button" onclick="New_add('new_case.php')">注册</button>
				              <!--<button class="btn btn-success" type="button" onclick="New_add('new_caseB.php')">转让</button>
				              <button class="btn btn-success" type="button" onclick="New_add('new_caseC.php')">变更</button>
				              <button class="btn btn-success" type="button" onclick="New_add('new_caseD.php')">续展</button>
				              <button class="btn btn-success" type="button" onclick="New_add('new_Else.php')">其他</button>-->
											<button class="btn btn-primary" type="button" onclick="jiean('dynamic-table')">结案</button>
											<button class="btn btn-primary" type="button" onclick="huif('dynamic-table')">恢复</button>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table')" >删除</button>
								<?php
									if($admin == 1){
										?>
										<button class="btn btn-danger" type="button" onclick="hid()">彻底删除</button>
										<?php
									}
								?>
                  <span class="dynamic-table" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
				        <!-- button list end -->
                    <table class="display table table-bordered table-striped" id="dynamic-table" >
			                <thead>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" onclick="selectAll('dynamic-table',this)"  /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric">商标名称</th>
			                    <th class="numeric" style="width: 40px;">类别</th>
			                    <th class="numeric" style="width: 100px;">案件类型</th>
			                    <th class="numeric" style="width: 100px;">状态</th>
			            	</thead>
			            	<tbody>
		            	<?php
									  require("../../../conn.php");
									  if($admin == "1"){
									  	$sql="select a.案件类型,a.`案卷号`,a.`案源人`,a.`申请人`,a.`代理人`,a.`委托人类型`,b.`委托人id`,b.`委托人`,a.`商标说明`,a.状态,a.案件状态,a.类别  from 商标_案件 a,商标_委托书 b  where a.状态<>'3' and a.委托书id=b.id and a.状态<>'9' order by a.id desc";
									  }else{
									  	$sql="select a.案件类型,a.`案卷号`,a.`案源人`,a.`申请人`,a.`代理人`,a.`委托人类型`,b.`委托人id`,b.`委托人`,a.`商标说明`,a.状态,a.案件状态,a.类别  from 商标_案件 a,商标_委托书 b  where a.状态<>'3' and a.状态<>'2' and a.委托书id=b.id and a.状态<>'9' order by a.id desc ";
									  }
									  $result = $conn->query($sql);
									  if($result->num_rows >0){
									  	while($row = $result->fetch_assoc()){
									  		//获取申请人id
                				$SqrId = $row["申请人id"];
//              				$SqrId_arr = explode(',',$SqrId);
//              				$SQRMes = '';
//              				$sql_SSqr = "select 申请人 from 申请人 where FIND_IN_SET(id,'".$SqrId."')";
//												$result_SSqr = $conn->query($sql_SSqr);
//												if($result_SSqr->num_rows > 0){
//													while($row_SSqr = $result_SSqr -> fetch_assoc()){
//														if(strlen($SQRMes) == 0){
//              								$SQRMes = $row_SSqr['申请人'];
//              							}else{
//              								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//              							}
//													}
//												}
												$CType = '';
												$CType = $row['案件类型'];
												switch($CType){
													case '注册' :
														$MesUrl='case_mess';
														break;
													case '转让' :
														$MesUrl='case_messB';
														break;
													case '变更' :
														$MesUrl='case_messC';
														break;
													case '续展' :
														$MesUrl='case_messD';
														break;
													case '其他' :
														$MesUrl='case_messE';
														break;
													default:
														$MesUrl='case_CaseMes';
														break;
												}
						  			?>
                    	<tr>
		            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" /></label></th>
		            					<td class="numeric"><a target="_blank" href="<?php echo $MesUrl; ?>.php?ajh=<?php echo $row["案卷号"];?>"><?php echo $row["案卷号"];?></a></td>
		            					<td class="numeric"><?php echo $row["案源人"];?></td>
		            					<td class="numeric"><?php echo $row["代理人"];?></td>
		            					<td class="numeric"><?php echo $row["申请人"];?></td>
		            					<td class="numeric"><?php echo $row["商标说明"];?></td>
		            					<td class="numeric"><?php echo $row["类别"];?></td>
		            					<td class="numeric"><?php echo $row["案件类型"];?></td>
		            					<td class="numeric">
				        						<?php
				        							if($row["状态"] == 0){
//				        								echo '正常';
				        								echo $row["案件状态"];
				        							} 
				        							if($row["状态"] == 1){
				        								echo '结案';
				        							} 
				        							if($row["状态"] == 2){
				        								echo '删除';
				        							} 
				        						?>
			        						</td>
		        					</tr>
	              		
	              		<?php
	              		     }
	              		  }
	              			?>
	              			</tbody>
                 </table>
                </section>
            	</div>
            	<!--商标申请END-->
            	<!--委托书START-->
            	<div class="tab-pane" id="about-2">
        			<!-- button list -->
			          	<div>
			          		<a class="btn btn-success" href="new_disc.php" target="_blank">申请类委托书</a>
			          		<a class="btn btn-success" href="new_disc_2.php" target="_blank">评审类委托书</a>
										<button class="btn btn-warning" type="button" onclick="del_wt()">删除</button>
										<!-- /btn-group -->
                		<span class="dynamic-table_2" hidden="hidden" >1/asc/委托人</span>
                    <!-- /btn-group -->
			            </div>
			        <!-- button list end -->
                  <section id="unseen">
                    <table class="display table table-bordered table-striped" id="dynamic-table_2" >
	                  <thead>
	                    <tr>
		                    <th class="numeric" style="width: 50px;"><input type="checkbox" onclick="selectAll('dynamic-table_2',this)"  /></th>
		                    <th class="numeric">委托人</th>
		                    <th class="numeric" style="width: 100px;">国籍</th>
		                    <th class="numeric">代理人</th>
		                    <th class="numeric">商标名</th>
		                    <th class="numeric" hidden="hidden">id</th>
		                  </tr>
	                  </thead>
	                   <tbody>
	               <?php 
	                   		require'../../../conn.php';
//	                   		$sql2 = "select id,委托人,国籍,代理人,商标名 from 商标_委托书 where 状态 <> 3 order by id desc";
													$sql2 = "select id,委托人,国籍,代理人,商标名,`案件类型` from 商标_委托书 where 状态 <> 3 order by id desc";
	                   		$result2 = $conn->query($sql2);
	                   		if($result2->num_rows>0){
	                   			while($row2 = $result2->fetch_assoc()){
//	                   				  
	                   							
	                   				?>
	                   				<tr>
	                   					<th><input class="box_son" type="checkbox" name="check" /></th>
	                   							
	                   								<?php  if(isset($row2['案件类型']) && $row2['案件类型']!=='NULL'): ?>
<!--	                   					<?php echo  $res; ?>-->
	                   					<td><a href="new_disc_keep.php?id=<?php echo $row2['id']; ?>"><?php echo  $row2['委托人']; ?></a></td>
	                   					<?php else: ?>
	                   							<td><a href="new_disc_2 _keep.php?id=<?php echo $row2['id']; ?>" ><?php echo $row2['委托人']; ?></a></td>
	                   						<?php endif ?>
		                   				<td><?php echo $row2['国籍']; ?></td>
		                   				<td><?php echo $row2['代理人']; ?></td>
		                   				<td><?php echo $row2['商标名']; ?></td>
		                   				<td hidden="hidden"><?php echo $row2['id']; ?></td>
	                   				</tr>
	                   				<?php
	                   			}
	                   		}
	                   	?>
	                  </tbody>
	                </table>
                </section>
            	</div>
            	<!--委托书END-->
            	<!--商标监控START-->
            	<div class="tab-pane" id="about-3">
                  				<section id="unseen">
			            <!-- button list -->
				          	<div>
											<!--<button class="btn btn-primary" type="button" onclick="jiean()">结案</button>
											<button class="btn btn-primary" type="button" onclick="huif()">恢复</button>
											<button class="btn btn-warning" type="button" onclick="del()" >删除</button>-->
											<?php
												if($admin == 1){
													?>
													<!--<button class="btn btn-danger" type="button" onclick="hid()">彻底删除</button>-->
													<?php
												}
											?>
                      <span class="dynamic-table_3" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
				        <!-- button list end -->
                    <table class="display table table-bordered table-striped" id="dynamic-table_3" >
			                <thead>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" onclick="selectAll('dynamic-table_3',this)"  /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric" style="width: 100px;">注册号</th>
			                    <th class="numeric" style="width: 100px;">注册日</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric">商标名称</th>
			                    <th class="numeric" style="width: 70px;">案件类型</th>
			                    <th class="numeric" style="width: 70px;">状态</th>
			                    <th class="numeric" style="width: 70px;">剩余天数</th>
			            	</thead>
			            	<tbody>
		            	<?php
						  require("../../../conn.php");
						  $now_date = date("Y-m-d");
						  if($admin == "1"){
					  		$sql="select a.案件类型,a.注册日,a.注册号,a.`案卷号`,a.`案源人`,a.`代理人`,a.`委托人类型`,a.`申请人id`,a.`申请人`,a.`商标说明`,a.状态,a.案件状态,a.专权期末,a.类别,DATEDIFF(a.专权期末,'".$now_date."') AS 计算日期   from 商标_案件 a where a.状态<>'3' and a.状态<>'9' and a.案件状态<>'结案' and a.案件状态<>'已无效' AND a.状态 <> '2' order by 计算日期 asc";
						  }else{
						  	$sql="SELECT a.案件类型,a.注册日,a.注册号,a.`案卷号`,a.`案源人`,a.`代理人`,a.`委托人类型`,a.`申请人id`,a.`申请人`,a.状态,a.案件状态,a.`商标说明`,a.专权期末,a.类别,DATEDIFF(a.专权期末,'".$now_date."') AS 计算日期 FROM 商标_案件 a WHERE a.状态 <> '3'AND a.状态 <> '2'AND a.状态 <> '9' and a.案件状态<>'结案' and a.案件状态<>'已无效' order by 计算日期 asc";//商标说明为商标名称
						  }
						  $result = $conn->query($sql);
						  if($result->num_rows >=0){
						  	while($row = $result->fetch_assoc()){
						  		//获取申请人id
                				$SqrId = $row["申请人id"];
//              				$SqrId_arr = explode(',',$SqrId);
//              				$SQRMes = '';
//              				$sql_SSqr = "select 申请人 from 申请人 where FIND_IN_SET(id,'".$SqrId."')";
//												$result_SSqr = $conn->query($sql_SSqr);
//												if($result_SSqr->num_rows > 0){
//													while($row_SSqr = $result_SSqr -> fetch_assoc()){
//														if(strlen($SQRMes) == 0){
//              								$SQRMes = $row_SSqr['申请人'];
//              							}else{
//              								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//              							}
//													}
//												}
                				$CType = '';
												$CType = $row['案件类型'];
												switch($CType){
													case '注册' :
														$MesUrl='case_mess';
														break;
													case '转让' :
														$MesUrl='case_messB';
														break;
													case '变更' :
														$MesUrl='case_messC';
														break;
													case '续展' :
														$MesUrl='case_messD';
														break;
													case '其他' :
														$MesUrl='case_messE';
														break;
													default:
														$MesUrl='case_CaseMes';
														break;
												}
						  			?>
                    	<tr>
		            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" /></label></th>
		            					<td class="numeric"><a target="_blank" href="<?php echo $MesUrl; ?>.php?ajh=<?php echo $row["案卷号"];?>"><?php echo $row["案卷号"];?></a></td>
		            					<td class="numeric"><?php echo $row["案源人"];?></td>
		            					<td class="numeric"><?php echo $row["代理人"];?></td>
		            					<td class="numeric"><?php echo $row["注册号"];?></td>
		            					<td class="numeric"><?php echo $row["注册日"];?></td>
		            					<td class="numeric"><?php echo $row["申请人"];?></td>
		            					<td class="numeric"><?php echo $row["商标说明"];?></td>
		            					<td class="numeric"><?php echo $row["案件类型"];?></td>
		            					<td class="numeric">
				        						<?php
				        							if($row["状态"] == 0){
//				        								echo '正常';
				        								echo $row["案件状态"];
				        							} 
				        							if($row["状态"] == 1){
				        								echo '结案';
				        							} 
				        							if($row["状态"] == 2){
				        								echo '删除';
				        							} 
				        						?>
			        						</td>
			        						<td class="numeric"><?php if($row["计算日期"]==null){echo "——";}
			        							else{echo $row["计算日期"];}; ?></td>
		        					</tr>
	              		
	              		<?php
	              		     }
	              		  }
	              			?>
	              			</tbody>
                 </table>
                </section>
            	</div>
            	<!--商标监控END-->
            	<!--商标管理START-->
            	<div class="tab-pane" id="about-1">
                  <section id="unseen">
			            <!-- button list -->
				          	<div>
				              <button class="btn btn-success" type="button" onclick="New_add('NewCase_Mag.php')">新建</button>
											<button class="btn btn-primary" type="button" onclick="jiean('dynamic-table_4')">结案</button>
											<button class="btn btn-primary" type="button" onclick="huif('dynamic-table_4')">恢复</button>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table_4')" >删除</button>
								<?php
									if($admin == 1){
										?>
										<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_4')">彻底删除</button>
										<?php
									}
								?>
										<a href="../../../phpexcel/my_test/sb_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
	            			<button class="btn btn-primary" onclick="Export_someExcel('dynamic-table_4','../../../phpexcel/my_test/sb_export_some.php')">导出选中行Excel清单</button>
								<!-- /btn-group -->
                    	<span class="dynamic-table_4" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
				        <!-- button list end -->
                    <table class="display table table-bordered table-striped" id="dynamic-table_4" >
			                <thead>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" onclick="selectAll('dynamic-table_4',this)"  /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric" style="width: 100px;">注册号</th>
			                    <th class="numeric" style="width: 100px;">注册日</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric">商标名称</th>
			                    <th class="numeric" style="width: 40px;">类别</th>
			                    <th class="numeric" style="width: 70px;">案件类型</th>
			                    <th class="numeric" style="width: 70px;">状态</th>
			            	</thead>
			            	<tbody>
		            	<?php
						  require("../../../conn.php");
						  if($admin == "1"){
						  	$sql="select a.案件类型,a.注册日,a.注册号,a.`案卷号`,a.`案源人`,a.`代理人`,a.`委托人类型`,a.`申请人id`,a.`申请人`,a.`商标说明`,a.状态,a.案件状态,a.类别   from 商标_案件 a where a.状态<>'3'  and a.状态<>'9' order by a.id desc";
						  }else{
						  	$sql="SELECT a.案件类型,a.注册日,a.注册号,a.`案卷号`,a.`案源人`,a.`代理人`,a.`委托人类型`,a.`申请人id`,a.`申请人`,a.状态,a.案件状态,a.`商标说明`,a.类别 FROM 商标_案件 a WHERE a.状态 <> '3'AND a.状态 <> '2'AND a.状态 <> '9'ORDER BY a.id DESC";//商标说明为商标名称
						  }
						  $result = $conn->query($sql);
						  if($result->num_rows >0){
						  	while($row = $result->fetch_assoc()){
						  		//获取申请人id
						  					$SqrId = $row["申请人id"];
//              				$SqrId_arr = explode(',',$SqrId);
//              				$SQRMes = '';
//              				$sql_SSqr = "select 申请人 from 申请人 where FIND_IN_SET(id,'".$SqrId."')";
//												$result_SSqr = $conn->query($sql_SSqr);
//												if($result_SSqr->num_rows > 0){
//													while($row_SSqr = $result_SSqr -> fetch_assoc()){
//														if(strlen($SQRMes) == 0){
//              								$SQRMes = $row_SSqr['申请人'];
//              							}else{
//              								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//              							}
//													}
//												}
                				$CType = '';
												$CType = $row['案件类型'];
												switch($CType){ 
													case '注册' :
														$MesUrl='case_mess';
														break;
													case '转让' :
														$MesUrl='case_messB';
														break;
													case '变更' :
														$MesUrl='case_messC';
														break;
													case '续展' :
														$MesUrl='case_messD';
														break;
													case '其他' :
														$MesUrl='case_messE';
														break;
													default:
														$MesUrl='case_CaseMes';
														break;
												}
						  			?>
                    	<tr>
		            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" value="0" id="<?php echo $row["案卷号"];?>" /></label></th>
		            					<td class="numeric"><a target="_blank" href="<?php echo $MesUrl; ?>.php?ajh=<?php echo $row["案卷号"];?>"><?php echo $row["案卷号"];?></a></td>
		            					<td class="numeric"><?php echo $row["案源人"];?></td>
		            					<td class="numeric"><?php echo $row["代理人"];?></td>
		            					<td class="numeric"><?php echo $row["注册号"];?></td>
		            					<td class="numeric"><?php echo $row["注册日"];?></td>
		            					<td class="numeric"><?php echo $row["申请人"];?></td>
		            					<td class="numeric"><?php echo $row["商标说明"];?></td>
		            					<td class="numeric"><?php echo $row["类别"];?></td>
		            					<td class="numeric"><?php echo $row["案件类型"];?></td>
		            					<td class="numeric">
				        						<?php
				        							if($row["状态"] == 0){
//				        								echo '正常';案件状态
				        								echo $row['案件状态'];
				        							} 
				        							if($row["状态"] == 1){
				        								echo '结案';
				        							} 
				        							if($row["状态"] == 2){
				        								echo '删除';
				        							} 
				        						?>
			        						</td>
		        					</tr>
	              		
	              		<?php
	              		     }
	              		  }
	              			?>
	              			</tbody>
                 </table>
                </section>
            	</div>
            	<!--商标管理END-->
	        	</div>
	        	</div>
			</section>
        </section>
        </div>
        <!--body wrapper end-->
    </div>
    </div>
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<!--<script src="../../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>
<script src="../../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--结案，恢复，删除-->
<script src="../../../js/blogo_action.js"></script>
<!--其他响应-->
<script src="../../../js/imitation_1/zl_sb.js"></script>
<script>
//全选
function selectAll(tab,self_doc){
/*	var tab = document.getElementById(tab);
	var tablen = tab.rows.length;
	for(var i=1;i<tablen;i++){
//		var che = tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
//		tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = !che;
			tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = self_doc.checked;
	}*/
	$("#"+tab+" input").each(function(){
		if($(this).hasClass("box_son")){
			if($(self_doc).attr("checked")){
				$(this).attr("checked",true);
			}else{
				$(this).attr("checked",false);
			}
		}
	});
}
	
	
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
	var tab1 = $(".dynamic-table").html();//获取排序商标案件
	var tab2 = $(".dynamic-table_2").html();//获取排序委托书
	var tab3 = $(".dynamic-table_3").html();//获取排序
	var tab4 = $(".dynamic-table_4").html();//获取排序
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
	var turn3 = tab3.split('/');
	var turn4 = tab4.split('/');
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
			url:'../../../OrderChange.php',
			type:'get',
			async:true,
			data:{
				falg:aim,//判断表格的依据
				order:Text,
				czyid:czyid,
				page:'BLogo'
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
<script src="../../../js/NormalS-3.js"></script>

</body>
</html>