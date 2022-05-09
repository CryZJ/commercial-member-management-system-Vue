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
  <title>项目申报</title>
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

	<!--提醒弹窗-->
<!--<script language="JavaScript">
	function ShowEdit_01(s_name){
		//var name=
		//var r = window.open("applicant.php?n=" + s_name,null,"");
		alert(s_、name);
	}
</script>-->

</head>

<body class="sticky-header">
<!--<body class="sticky-header" onload="show_remind()">-->
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../../menu_tree.php"); 
				Create_leftlist(0,5);
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
		<div class="wrapper">
			<div class="row">
        	<div class="col-sm-12">
        		<section class="panel">
        			<header class="panel-heading custom-tab">
		              <ul class="nav nav-tabs">
		                <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>总目录</a></li>
		                <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>待启动</a></li>
		                <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>处理中</a></li>
		                <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
		                <li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>文件管理</a></li>
		                <li class="about-6"><a href="#about-6" data-toggle="tab"><i class="fa fa-user"></i>企业信息</a></li>
		              </ul>
		              <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
		              <input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
           			</header>
           	<div class="panel-body">
			        	<div class="tab-content">
					        <div class="tab-pane" id="about-1">
                  <section id="unseen">
				          	<div>
				              <!--<button class="btn btn-success" type="button" onclick="Open_add('new_case.php','_blank')">新建</button>-->
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table')">删除</button>
										<?php
//									}
										if($admin==1){
								?>
											<button class="btn btn-danger" type="button" onclick="hid('dynamic-table')">彻底删除</button>
											<?php
									}
								?>
				            <!-- button list end -->
	                    <span class="dynamic-table" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" onclick="selectAll('dynamic-table',this)" /></th>
			                    <th class="numeric">项目名称</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">案源人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">代理人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">创建人</th>
			                    <th class="numeric">客户名</th>
			                    <th class="numeric">项目类型</th>
			                    <th class="numeric" style="width: 100px;">当前程序</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
													 require("../../../conn.php");
													 if($dlrbh != null && $ayrbh != null){
													 	if($admin == 1){
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件状态,案件类型 from `专案_项目申报` where 冻结状态<>'3' order by id desc";
													 	}else{
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件状态,案件类型  from `专案_项目申报` where 冻结状态<>'3' and 冻结状态<>'2' order by id desc";
													 	}
													  $result = $conn->query($sql);
													  if($result->num_rows>0){
													  	while($row = $result->fetch_assoc()){
													  			?>
													  			<tr>
							            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["id"];?>" /></label></th>
							            					<td class="numeric"><a target="_blank" href="case_info.php?CaseId=<?php echo $row['id']; ?>"><?php echo $row["项目名称"];?></a></td>
							            					<td class="numeric"><?php echo $row["案源人"];  ?></td>
							            					<td class="numeric"><?php echo $row["代理人"];  ?></td>
							            					<td class="numeric"><?php echo $row["创建人"];  ?></td>
							            					<td class="numeric"><?php echo $row["客户名"];  ?></td>
							            					<td class="numeric"><?php echo $row["案件类型"];  ?></td>
							            					<?php
							            						if($row["冻结状态"]=='0'){
							            					?>
							            						<td class="numeric"><?php echo $row["案件状态"]; ?></td>
							            					<?php
							            						}else	if($row["冻结状态"]=='2'){
							            					?>
							            						<td class="numeric"><?php echo '删除'; ?></td>
							            					<?php
							            						}
							            					?>
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
            	<!--about-1-->
            	<div class="tab-pane" id="about-2">
                  <section id="unseen">
				          	<div>
				              <button class="btn btn-success" type="button" onclick="Open_add('new_case.php?falg=new','_blank')">新建</button>
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table_2')">删除</button>
										<?php
//									}
										if($admin==1){
								?>
											<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_2')">彻底删除</button>
											<?php
									}
								?>
				            <!-- button list end -->
	                    <span class="dynamic-table_2" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table_2" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" onclick="selectAll('dynamic-table_2',this)" /></th>
			                    <th class="numeric">项目名称</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">案源人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">代理人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">创建人</th>
			                    <th class="numeric">客户名</th>
			                    <th class="numeric">项目类型</th>
			                    <th class="numeric" style="width: 100px;">当前程序</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
													 require("../../../conn.php");
													 if($dlrbh != null && $ayrbh != null){
													 	if($admin == 1){
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型 from `专案_项目申报` where 冻结状态<>'3' and 案件状态='待启动' order by id desc";
													 	}else{
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型  from `专案_项目申报` where 冻结状态<>'3' and 冻结状态<>'2' and 案件状态='待启动' order by id desc";
													 	}
													  $result = $conn->query($sql);
													  if($result->num_rows>0){
													  	while($row = $result->fetch_assoc()){
													  			?>
													  			<tr>
							            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["id"];?>" /></label></th>
							            					<td class="numeric"><a target="_blank" href="case_info.php?CaseId=<?php echo $row['id']; ?>"><?php echo $row["项目名称"];?></a></td>
							            					<td class="numeric"><?php echo $row["案源人"];  ?></td>
							            					<td class="numeric"><?php echo $row["代理人"];  ?></td>
							            					<td class="numeric"><?php echo $row["创建人"];  ?></td>
							            					<td class="numeric"><?php echo $row["客户名"];  ?></td>
							            					<td class="numeric"><?php echo $row["案件类型"];  ?></td>
							            					<?php
							            						if($row["冻结状态"]=='0'){
							            					?>
							            						<td class="numeric"><?php echo '正常'; ?></td>
							            					<?php
							            						}else	if($row["冻结状态"]=='2'){
							            					?>
							            						<td class="numeric"><?php echo '删除'; ?></td>
							            					<?php
							            						}  
							            					?>
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
            	<!--about-2-->
            	<div class="tab-pane" id="about-3">
                  <section id="unseen">
				          	<div>
				              <button class="btn btn-success" type="button" onclick="Open_add('new_case.php?falg=act','_blank')">新建</button>
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table_3')">删除</button>
										<?php
//									}
										if($admin==1){
								?>
											<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_3')">彻底删除</button>
											<?php
									}
								?>
				            <!-- button list end -->
	                    <span class="dynamic-table_3" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table_3" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" onclick="selectAll('dynamic-table_3',this)" /></th>
			                    <th class="numeric">项目名称</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">案源人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">代理人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">创建人</th>
			                    <th class="numeric">客户名</th>
			                    <th class="numeric">项目类型</th>
			                    <th class="numeric" style="width: 100px;">当前程序</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
													 require("../../../conn.php");
													 if($dlrbh != null && $ayrbh != null){
													 	if($admin == 1){
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型 from `专案_项目申报` where 冻结状态<>'3' and 案件状态='处理中' order by id desc";
													 	}else{
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型  from `专案_项目申报` where 冻结状态<>'3' and 冻结状态<>'2' and 案件状态='处理中' order by id desc";
													 	}
													  $result = $conn->query($sql);
													  if($result->num_rows>0){
													  	while($row = $result->fetch_assoc()){
													  			?>
													  			<tr>
							            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["id"];?>" /></label></th>
							            					<td class="numeric"><a target="_blank" href="case_info.php?CaseId=<?php echo $row['id']; ?>"><?php echo $row["项目名称"];?></a></td>
							            					<td class="numeric"><?php echo $row["案源人"];  ?></td>
							            					<td class="numeric"><?php echo $row["代理人"];  ?></td>
							            					<td class="numeric"><?php echo $row["创建人"];  ?></td>
							            					<td class="numeric"><?php echo $row["客户名"];  ?></td>
							            					<td class="numeric"><?php echo $row["案件类型"];  ?></td>
							            					<?php
							            						if($row["冻结状态"]=='0'){
							            					?>
							            						<td class="numeric"><?php echo '正常'; ?></td>
							            					<?php
							            						}else	if($row["冻结状态"]=='2'){
							            					?>
							            						<td class="numeric"><?php echo '删除'; ?></td>
							            					<?php
							            						}  
							            					?>
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
            	<!--about-3-->
            	<div class="tab-pane" id="about-4">
                  <section id="unseen">
				          	<div>
				              <!--<button class="btn btn-success" type="button" onclick="Open_add('new_case.php','_blank')">新建</button>-->
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table_4')">删除</button>
										<?php
//									}
										if($admin==1){
								?>
											<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_4')">彻底删除</button>
											<?php
									}
								?>
				            <!-- button list end -->
	                    <span class="dynamic-table_4" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table_4" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" onclick="selectAll('dynamic-table_4',this)" /></th>
			                    <th class="numeric">项目名称</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">案源人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">代理人</th>
			                    <th class="numeric" style="width: 100px;word-wrap: break-word;">创建人</th>
			                    <th class="numeric">客户名</th>
			                    <th class="numeric">项目类型</th>
			                    <th class="numeric" style="width: 100px;">当前程序</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
													 require("../../../conn.php");
													 if($dlrbh != null && $ayrbh != null){
													 	if($admin == 1){
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型 from `专案_项目申报` where 冻结状态<>'3' and 案件状态='已完成' order by id desc";
													 	}else{
													 		$sql="select id,`案源人`,`代理人`,创建人,创建时间,项目名称,客户名,备注,冻结状态,案件类型  from `专案_项目申报` where 冻结状态<>'3' and 冻结状态<>'2' and 案件状态='已完成' order by id desc";
													 	}
													  $result = $conn->query($sql);
													  if($result->num_rows>0){
													  	while($row = $result->fetch_assoc()){
													  			?>
													  			<tr>
							            					<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["id"];?>" /></label></th>
							            					<td class="numeric"><a target="_blank" href="case_info.php?CaseId=<?php echo $row['id']; ?>"><?php echo $row["项目名称"];?></a></td>
							            					<td class="numeric"><?php echo $row["案源人"];  ?></td>
							            					<td class="numeric"><?php echo $row["代理人"];  ?></td>
							            					<td class="numeric"><?php echo $row["创建人"];  ?></td>
							            					<td class="numeric"><?php echo $row["客户名"];  ?></td>
							            					<td class="numeric"><?php echo $row["案件类型"];  ?></td>
							            					<?php
							            						if($row["冻结状态"]=='0'){
							            					?>
							            						<td class="numeric"><?php echo '正常'; ?></td>
							            					<?php
							            						}else	if($row["冻结状态"]=='2'){
							            					?>
							            						<td class="numeric"><?php echo '删除'; ?></td>
							            					<?php
							            						}  
							            					?>
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
            	<!--about-4-->
            	
            	<div class="tab-pane" id="about-5">
                  <section id="unseen">
				          	<div>
				              <button class="btn btn-success" type="button" onclick="Upsharefile('Upfile_gl')">上传文件</button>
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<!--<button class="btn btn-warning" type="button" onclick="del('dynamic-table_5')">删除</button>-->
										<?php
//									}
										if($admin==1){
								?>
											<!--<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_5')">彻底删除</button>-->
											<?php
									}
								?>
				            <!-- button list end -->
	                    <span class="dynamic-table_5" hidden="hidden" >1/asc/案卷号【正】</span>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table_5" >
		                  <thead>
		                    <tr>
			                    <!--<th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" /></th>-->
			                    <th class="numeric">文件名称</th>
			                    <th class="numeric" style="width: 200px;word-wrap: break-word;">上传人</th>
			                    <th class="numeric" style="width: 150px;word-wrap: break-word;">上传时间</th>
			                    <th class="numeric" style="width: 200px;word-wrap: break-word;">操作</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
													 require("../../../conn.php");
													 if($dlrbh != null && $ayrbh != null){
													 	$sql = "SELECT id,文件路径,上传时间,上传者 FROM 项目文件管理 WHERE 删除状态='0'";
													  $result = $conn->query($sql);
													  if($result->num_rows>0){
													  	while($row = $result->fetch_assoc()){
													  		$path_arr = explode("/", $row["文件路径"]);
																$file_basename = end($path_arr);
													  			?>
													  			<tr>
							            					<!--<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["id"];?>" /></label></th>-->
							            					<td class="numeric"><?php echo $file_basename; ?></td>
							            					<td class="numeric"><?php echo $row["上传时间"]; ?></td>
							            					<td class="numeric"><?php echo $row["上传者"]; ?></td>
							            					<td class="numeric">
							            						<a class="btn btn-primary" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row["文件路径"]; ?>" >下载</a>
							            						<button class="btn btn-danger" name="<?php echo $row["id"];?>" onclick="Delete_upfile(this)">删除</button>
							            					</td>
							            					
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
            	<!--about-5-->
            	<div class="tab-pane" id="about-6">
                  <section id="unseen">
				          	<div>
				              <button class="btn btn-success" type="button" onclick="Open_add('new_CMS.php','_blank')">新建</button>
				              <br />
				              <br />
				              <form action="#" method="post">
				              <table class="table table-striped  " id="editable-sample">
				                <thead>
						              <tr>
					                    <th>所属领域</th>
					                    <th>
					                    	<select class="SelMesAim" name="ssly">
							                		<option></option>
							                		<option>电子信息</option>
							                		<option>生物与新医药</option>
							                		<option>航空航天</option>
							                		<option>新材料</option>
							                		<option>高技术服务</option>
							                		<option>新能源与节能</option>
							                		<option>资源与环境</option>
							                		<option>先进制造与自动化</option>
							                		<option>其他</option>
							                	</select>
							                </th>
						                	
						                	<th>技术改造计划</th>
					                    <th>
					                    	<select class="SelMesAim" name="jsgzjh">
							                		<option></option>
							                		<option>无计划</option>
							                		<option>有计划</option>
							                		<option>进行中</option>
							                	</select>
						                	</th>
						                	<th>计划设备总额<br/>[万元]</th>
						                	<th><input type="text" class="SelMesAim" name="jhsbze_0" /></th>
						                	<th>到</th>
						                	<th><input type="text" class="SelMesAim" name="jhsbze_1" /></th>
					                </tr>
				                </thead>
				                <tbody>
				                	<tr>
				                			<th>知识产权<br/>[件]</th>
					                    <th><input type="text" class="SelMesAim" name="zscq_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" class="SelMesAim" name="zscq_1" /></th>
					                    <th>个税申报<br/>[个]</th>
					                    <th><input type="text" class="SelMesAim" name="gssb_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" class="SelMesAim" name="gssb_1" /></th>
					                </tr>
					                <tr>
					                    <th>职工总数<br/>[个]</th>
					                    <th><input type="text" class="SelMesAim" name="zgzs_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" class="SelMesAim" name="zgzs_1" /></th>
					                    <th>大专占比<br/>[%]</th>
					                    <th><input type="text" class="SelMesAim" name="dzzb_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" class="SelMesAim" name="dzzb_1" /></th>
					                </tr>
					                <tr>
					                    <th>上年销售收入<br/>[万元]</th>
					                    <th><input type="text" class="SelMesAim" name="xssr_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="xssr_1" /></th>
					                    <th>上年总资产<br/>[万元]</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="zzc_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="zzc_1" /></th>
					                </tr>
					                <tr>
					                    <th>上年纳税总额<br/>[万元]</th>
					                    <th><input type="text" class="SelMesAim" name="nsze_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="nsze_1" /></th>
					                    <th>上年研发费投入<br/>[万元]</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="yfftr_0" /></th>
					                    <th>到</th>
					                    <th><input type="text" style="height: 26px;" class="SelMesAim" name="yfftr_0" /></th>
					                </tr>
				                </tbody>
				              </table>
				              <br />
				            	<p><button class="btn btn-success" onclick="SelMes()">查询</button></p>
				            	</form>
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table_6" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><!--<input type="checkbox" id="SelectAll" onclick="selectAll('dynamic-table_6',this)" />--></th>
			                    <th class="numeric">企业名称</th>
			                    <th class="numeric" style="width: 80px;">成立时间</th>
			                    <th class="numeric" style="width: 100px;">所属领域</th>
			                    <th class="numeric" style="width: 80px;">知识产权</th>
			                    <th class="numeric" style="width: 80px;">职工总数</th>
			                    <th class="numeric" style="width: 80px;">个税申报</th>
			                    <th class="numeric" style="width: 80px;">大专占比</th>
			                    <th class="numeric" style="width: 100px;">销售收入</th>
			                    <th class="numeric" style="width: 80px;">总资产</th>
			                    <th class="numeric" style="width: 80px;">纳税总额</th>
			                    <th class="numeric" style="width: 60px;">负债率</th>
			                    <th class="numeric" style="width: 60px;">操作</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                          <?php
                          		require'../../../conn.php';
                          		if($_SERVER["REQUEST_METHOD"] == "POST"){//点击查询
                          			$ssly = $_POST['ssly'];//所属领域
                          			$jsgzjh = $_POST['jsgzjh'];//技术改造计划	
                          			
                          			$jhsbze_0 = $_POST['jhsbze_0'];//计划设备总额
																$jhsbze_1 = $_POST['jhsbze_1'];
																
																$zscq_0 = $_POST['zscq_0'];//知识产权
																$zscq_1 = $_POST['zscq_1'];
																
																$gssb_0 = $_POST['gssb_0'];//个税申报
																$gssb_1 = $_POST['gssb_1'];
																
																$zgzs_0 = $_POST['zgzs_0'];//职工总数
																$zgzs_1 = $_POST['zgzs_1'];
																
																$dzzb_0 = $_POST['dzzb_0'];//大专占比
																$dzzb_1 = $_POST['dzzb_1'];
																
																$xssr_0 = $_POST['xssr_0'];//上年销售收入
																$xssr_1 = $_POST['xssr_1'];
																
																$zzc_0 = $_POST['zzc_0'];//总资产
																$zzc_1 = $_POST['zzc_1'];
																
																$nsze_0 = $_POST['nsze_0'];//上年纳税总额
																$nsze_1 = $_POST['nsze_1'];
																
																$yfftr_0 = $_POST['yfftr_0'];//上年研发费投入
																$yfftr_1 = $_POST['yfftr_1'];
                          			
                          			$sql = "SELECT a.id,a.企业名称,a.成立时间,a.所属领域,a.员工总数,a.个税申报,a.大专比例,a.发明,a.实用,a.外观,a.软件,a.植物,a.集成,(a.发明+a.实用+a.外观+a.软件+a.植物+a.集成) AS 知识产权,a.技术改造,a.设备总额,b.企业id,b.年度,b.总资产,b.总销售,b.研发经费,b.纳税总额 FROM 企业信息 a,(SELECT d.年度,d.企业id,d.总资产,d.总销售,d.纳税总额,d.研发经费 FROM (SELECT MAX(年度) AS 最近年度,企业id FROM 企业财务 GROUP BY 企业id ORDER BY 企业id) AS c,企业财务 d WHERE c.企业id=d.企业id AND c.最近年度=d.年度 AND d.状态='0') AS b WHERE a.id=b.企业id AND a.状态='0'";
                          			
																if(!empty($ssly)){
																	$sql .= " AND a.所属领域='".$ssly."'";
																}
																if(!empty($jsgzjh)){
																	$sql .= " AND a.技术改造='".$jsgzjh."'";
																}
																if((!empty($jhsbze_0) || $jhsbze_0=='0' ) && (!empty($jhsbze_1))){
																	if($jhsbze_0 < $jhsbze_1){
																		$sql .= " AND a.设备总额 BETWEEN '".$jhsbze_0."' AND '".$jhsbze_1."' ";
																	}else{
																		$sql .= " AND a.设备总额 BETWEEN '".$jhsbze_1."' AND '".$jhsbze_0."' ";
																	}
																}
																if((!empty($zscq_0) || $zscq_0=='0') && !empty($zscq_1)){
																	if($zscq_0 < $zscq_1){
																		$sql .= " AND (a.发明+a.实用+a.外观+a.软件+a.植物+a.集成) BETWEEN '".$zscq_0."' AND '".$zscq_1."' ";
																	}else{
																		$sql .= " AND (a.发明+a.实用+a.外观+a.软件+a.植物+a.集成) BETWEEN '".$zscq_1."' AND '".$zscq_0."' ";
																	}
																}
																if((!empty($gssb_0) || $gssb_0=='0') && !empty($gssb_1)){
																	if($gssb_0 < $gssb_1){
																		$sql .= " AND a.个税申报 BETWEEN '".$gssb_0."' AND '".$gssb_1."' ";
																	}else{
																		$sql .= " AND a.个税申报 BETWEEN '".$gssb_1."' AND '".$gssb_0."' ";
																	}
																}
																if((!empty($zgzs_0) || $zgzs_0=='0') && !empty($zgzs_1)){
																	if($zgzs_0 < $zgzs_1){
																		$sql .= " AND a.员工总数 BETWEEN '".$zgzs_0."' AND '".$zgzs_1."' ";
																	}else{
																		$sql .= " AND a.员工总数 BETWEEN '".$zgzs_1."' AND '".$zgzs_0."' ";
																	}
																}
																if((!empty($dzzb_0) || $dzzb_0=='0') && !empty($dzzb_1)){
																	if($dzzb_0 < $dzzb_1){
																		$sql .= " AND a.大专比例 BETWEEN '".$dzzb_0."' AND '".$dzzb_1."' ";
																	}else{
																		$sql .= " AND a.大专比例 BETWEEN '".$dzzb_1."' AND '".$dzzb_0."' ";
																	}
																}
																if((!empty($xssr_0) || $xssr_0=='0') && !empty($xssr_1)){
																	if($xssr_0 < $xssr_1){
																		$sql .= " AND b.总销售 BETWEEN '".$xssr_0."' AND '".$xssr_1."' ";
																	}else{
																		$sql .= " AND b.总销售 BETWEEN '".$xssr_1."' AND '".$xssr_0."' ";
																	}
																}
																if((!empty($zzc_0) || $zzc_0=='0') && !empty($zzc_1)){
																	if($zzc_0 < $zzc_1){
																		$sql .= " AND b.总资产 BETWEEN '".$zzc_0."' AND '".$zzc_1."' ";
																	}else{
																		$sql .= " AND b.总资产 BETWEEN '".$zzc_1."' AND '".$zzc_0."' ";
																	}
																}
																if((!empty($nsze_0) || $nsze_0=='0') && !empty($nsze_1)){
																	if($nsze_0 < $nsze_1){
																		$sql .= " AND b.纳税总额 BETWEEN '".$nsze_0."' AND '".$nsze_1."' ";
																	}else{
																		$sql .= " AND b.纳税总额 BETWEEN '".$nsze_1."' AND '".$nsze_0."' ";
																	}
																}
																if((!empty($yfftr_0) || $yfftr_0=='0') && !empty($yfftr_1)){
																	if($yfftr_0 < $yfftr_1){
																		$sql .= " AND b.研发经费 BETWEEN '".$yfftr_0."' AND '".$yfftr_1."' ";
																	}else{
																		$sql .= " AND b.研发经费 BETWEEN '".$yfftr_1."' AND '".$yfftr_0."' ";
																	}
																}
//																echo $sql;
																$result_Sel = $conn->query($sql);
	                              if($result_Sel->num_rows>0){
	                                  while($row_Sel = $result_Sel->fetch_assoc()){
	                                      $CMes0 = $row_Sel['id'];
	                                      $CMes1 = $row_Sel['企业名称'];
	                                      $CMes2 = $row_Sel['成立时间'];
	                                      $CMes3 = $row_Sel['所属领域'];
	                                      $CMes4 = $row_Sel['发明']+$row_Sel['实用']+$row_Sel['外观']+$row_Sel['软件']+$row_Sel['植物']+$row_Sel['集成'];
	                                      $CMes5 = $row_Sel['员工总数'];
	                                      $CMes6 = $row_Sel['个税申报'];
	                                      $CMes7 = $row_Sel['大专比例'];
	                                      
	                                      $sql_Fare = "select 总销售,总资产,纳税总额,年度负率 from 企业财务 where 企业id='".$row_Sel['id']."' order by 年度 asc";
	                                      $result = $conn->query($sql_Fare);
	                                      if($result->num_rows>0){
	                                          while($row=$result->fetch_assoc()){
	                                              $CMes8 = $row['总销售'];
	                                              $CMes9 = $row['总资产'];
	                                              $CMes10 = $row['纳税总额'];
	                                              $CMes11 = $row['年度负率'];
	                                          }
	                                      }
	                                      
	                                      ?>
	                                          <tr>
	                                              <td><input type="checkbox" /></td>
	                                              <td><a target="_blank" href="info_CMS.php?Cid=<?php echo $CMes0; ?>"><?php echo $CMes1; ?></a></td>
	                                              <td><?php echo $CMes2; ?></td>
	                                              <td><?php echo $CMes3; ?></td>
	                                              <td><?php echo $CMes4; ?></td>
	                                              <td><?php echo $CMes5; ?></td>
	                                              <td><?php echo $CMes6; ?></td>
	                                              <td><?php echo $CMes7; ?></td>
	                                              <td><?php echo $CMes8; ?></td>
	                                              <td><?php echo $CMes9; ?></td>
	                                              <td><?php echo $CMes10; ?></td>
	                                              <td><?php echo $CMes11; ?></td>
	                                              <td><button onclick="DelMes(<?php echo $CMes0;?>,this)">删除</button></td>
	                                          </tr>
	                                      <?php
	                                  } 
	                              }
	                              $conn->close();
								  
                          		}else{//未点击查询
                          			$sql_Sel = "select id,企业名称,成立时间,所属领域,员工总数,个税申报,大专比例,发明,实用,外观,软件,植物,集成 from 企业信息 where 状态=0";
	                              $result_Sel = $conn->query($sql_Sel);
	                              if($result_Sel->num_rows>0){
	                                  while($row_Sel = $result_Sel->fetch_assoc()){
	                                      $CMes0 = $row_Sel['id'];
	                                      $CMes1 = $row_Sel['企业名称'];
	                                      $CMes2 = $row_Sel['成立时间'];
	                                      $CMes3 = $row_Sel['所属领域'];
	                                      $CMes4 = $row_Sel['发明']+$row_Sel['实用']+$row_Sel['外观']+$row_Sel['软件']+$row_Sel['植物']+$row_Sel['集成'];
	                                      $CMes5 = $row_Sel['员工总数'];
	                                      $CMes6 = $row_Sel['个税申报'];
	                                      $CMes7 = $row_Sel['大专比例'];
	                                      
	                                      $sql_Fare = "select 总销售,总资产,纳税总额,年度负率 from 企业财务 where 企业id='".$row_Sel['id']."' order by 年度 asc";
	                                      $result = $conn->query($sql_Fare);
	                                      if($result->num_rows>0){
	                                          while($row=$result->fetch_assoc()){
	                                              $CMes8 = $row['总销售'];
	                                              $CMes9 = $row['总资产'];
	                                              $CMes10 = $row['纳税总额'];
	                                              $CMes11 = $row['年度负率'];
	                                          }
	                                      }
	                                      
	                                      ?>
	                                          <tr>
	                                              <td><input type="checkbox" /></td>
	                                              <td><a target="_blank" href="info_CMS.php?Cid=<?php echo $CMes0; ?>"><?php echo $CMes1; ?></a></td>
	                                              <td><?php echo $CMes2; ?></td>
	                                              <td><?php echo $CMes3; ?></td>
	                                              <td><?php echo $CMes4; ?></td>
	                                              <td><?php echo $CMes5; ?></td>
	                                              <td><?php echo $CMes6; ?></td>
	                                              <td><?php echo $CMes7; ?></td>
	                                              <td><?php echo $CMes8; ?></td>
	                                              <td><?php echo $CMes9; ?></td>
	                                              <td><?php echo $CMes10; ?></td>
	                                              <td><?php echo $CMes11; ?></td>
	                                              <td><button onclick="DelMes(<?php echo $CMes0;?>,this)">删除</button></td>
	                                          </tr>
	                                      <?php
	                                  } 
	                              }
	                              $conn->close();
	                          	}
                          ?>
                  		</tbody>
                 		</table>
                </section>
            	</div>
            	<!--about-6-->
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
<script src="../../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>
<script src="../../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--结案，恢复，删除-->
<script src="../../../js/imitation_1/ProAction.js"></script>
<script>
    //全选
function selectAll(tab,self_doc){
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
			page:'PWork'
		},
		success:function(data){
//				console.log(data);
			window.location.reload();
		},
		error:function(){
			alert('false');
		}
	});
});
//信息查询
function SelMes(){
    var SelMesAim = document.getElementsByClassName('SelMesAim');
    var Mes = '';
    for (var i=0;i<SelMesAim.length;i++){
        Mes = Mes+SelMesAim[i].value+'/';
    }
    Mes = Mes.substr(0,SelMesAim.length-1);
    window.location = "ProReport.php?Mes="+Mes;
}
//信息删除
function DelMes(val,obj){
    var com_td = obj.parentNode;
    var com_tr = com_td.parentNode;
    var com_ms = com_tr.cells[1].getElementsByTagName('a')[0].innerHTML;
    var message = '是否删除企业【'+com_ms+'】信息';
//  alert(message);
    if(confirm(message)){
        $.ajax({
        	type:"get",
        	url:"CaseSave.php",
        	async:true,
        	data:{
        	    CId:val,
        	    falg:'DelCase'
        	},
        	success:function(data) {
        	    if(data === 'ok'){
        	        alert('企业信息已成功删除');
        	        window.location.reload();
        	    }
        	},
        	error:function(e,t,s) {
        	    alert('发生错误，请联系管理员');
        	}
        });
    }
}
//删除文件
function Delete_upfile(btn_obj){
	if(confirm("是否确认删除文件？")){
		$.ajax({
			type:"get",
			url:"CaseSave.php",
			async:true,
			data:{
				falg:"Del_file",
				file_id:btn_obj.name
			},
			success:function(data){
				alert(data);
				window.location.reload();
			},
			error:function(x,s,t){
				alert("删除失败！_ajaxeoor");
				console.log("ajax error!"+s+t);
			}
		});
	}
}
</script>
<!--about 常态-->
<script src="../../../js/NormalS-3.js"></script>

</body>
</html>

