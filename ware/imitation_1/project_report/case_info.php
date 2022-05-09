<?php require'../../../AHeader.php'; ?>
	
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
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>项目申报-详情</title>

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">
  <!--dynamic table-->
  <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />
  <!--日程样式-->
  <link href="../../../js/JMCalendar/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->

  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />
	<style>
		#000 {
			background-color: '#000000';
		}
	</style>
</head>

<body class="sticky-header">
<section>
        <!--body wrapper start-->
  <div class="wrapper" >
      <div class="row" >
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
	      <ul class="nav nav-tabs">
	        <li class="active"><a href="#about-1" data-toggle="tab"> 案卷基本情况 </a></li>
	        <li class="#"><a href="#about-2" data-toggle="tab"> 文件记录 </a></li>
	        <li class="#"><a href="#about-3" data-toggle="tab"> 项目日程 </a></li>
	        <li class="#"><a href="#about-4" data-toggle="tab"> 日程总览 </a></li>
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
	    		  	<?php
    		  			$CaseId = $_GET['CaseId'];//获取URL上的ajh 案卷号
	        			//获取案卷基本情况
	        			require('../../../conn.php');
	        			echo '<input id="CaseId" type="text" hidden="hidden" value="'.$CaseId.'"/>';
	        			$sql = "select * from 专案_项目申报 a  where a.id='".$CaseId."'";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
	        					$CaseST = $row['冻结状态'];
    							$sqr = $row['客户名'];
    							$ayr = $row['案源人'];
    							$dlr = $row['代理人'];
    							$ProName = $row['项目名称'];
    							$casebz = $row['备注'];
    							
    							$PlanBegTime = $row['计划开始'];
    							$PlanEndTime = $row['计划结束'];
    							$TrueBegTime = $row['实际开始'];
    							$TrueEndTime = $row['实际结束'];
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案件不存在！或出错！');</script>"; }
		        	?>
		        <!-- /btn-group -->
		            <!--<span><strong>项目状态:</strong></span>
	            	<div class="btn-group" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
                        	<span id="ajSt">
                        		
                        	</span>
                        	<span class="caret"></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="Menu" >
                            <li><a href="#">处理中</a></li>
                            <li><a href="#">已完成</a></li>
                        </ul>
                    </div>-->
            	<!-- btn-group -->
            	
            	<?php 
                    $sql_St = "select 案件状态,案件类型 from `专案_项目申报` WHERE id = '".$CaseId."'";
                    $result_St = $conn->query($sql_St);
                    if($result_St->num_rows>0){
                        while($row_St=$result_St->fetch_assoc()){
                            $caseSt = $row_St['案件状态'];
                            $caseType = $row_St['案件类型'];
                        }
                    }
                    if($caseSt == '待启动'){
                        ?>
                        &nbsp;&nbsp;&nbsp;
                        <span><strong>项目类型:</strong></span>
                        <select onchange="changeCaseType(this.value)">
                            <option selected="selected"><?php echo $caseType; ?></option>
                            <?php
                                $sql_St = "select 流程 from `案件流程设置` WHERE 案件类型 = '项目类型'";
                                $result_St = $conn->query($sql_St);
                                if($result_St->num_rows>0){
                                    while($row_St=$result_St->fetch_assoc()){
                                        ?>
                                            <option><?php echo $row_St['流程']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" onclick="OpenPro()">启动项目</button>
                        <?php
                    }
                    if($caseSt == '处理中'){
                        ?>
                        &nbsp;&nbsp;&nbsp;
                        <span><strong>项目类型:</strong></span>
                        <select onchange="changeCaseType(this.value)">
                            <option selected="selected"><?php echo $caseType; ?></option>
                            <?php
                                $sql_St = "select 流程 from `案件流程设置` WHERE 案件类型 = '项目类型'";
                                $result_St = $conn->query($sql_St);
                                if($result_St->num_rows>0){
                                    while($row_St=$result_St->fetch_assoc()){
                                        ?>
                                            <option><?php echo $row_St['流程']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" onclick="EndPro()">项目结束</button>
                        <?php
                    }
                    if($caseSt == '已完成'){
                        ?>
                        &nbsp;&nbsp;&nbsp;
                        <span><strong>项目类型:<?php if($caseType){echo $caseType;}else{echo '此项目未选择项目类型';} ?></strong></span>
                        <?php
                    }
                ?>
            	<br /><br />
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">项目名称</th>
                    <th class="numeric">客户名</th>
                    <th class="numeric">案源人</td>
                    <th class="numeric">代理人</td>
                </tr>
                </thead>
                <tbody>
                	<td class="numeric"><?php echo $ProName; ?></td>
                	<td class="numeric"><?php echo $sqr; ?></td>
                	<td class="numeric"><?php echo $ayr; ?></td>
                	<td class="numeric"><?php echo $dlr; ?></td>
                </tbody>
            </table>
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">计划开始时间</th>
                    <th class="numeric">计划结束时间</th>
                    <th class="numeric">实际开始时间</td>
                    <th class="numeric">实际结束时间</td>
                </tr>
                </thead>
                <tbody>
                    <td class="numeric" style="height: 26px;"><?php echo $PlanBegTime; ?></td>
                    <td class="numeric"><?php echo $PlanEndTime; ?></td>
                    <td class="numeric"><?php echo $TrueBegTime; ?></td>
                    <td class="numeric"><?php echo $TrueEndTime; ?></td>
                </tbody>
            </table>
            <span><strong>案件备注：</strong></span><br />
            <textarea rows="5" cols="100" id="fs_bz" onchange="ChangeBZ()"><?php echo $casebz; ?></textarea>
	        </section>
	    	</div>
	    	<!--  案卷流程及文档    -->
		<div class="tab-pane" id="about-2">
          <section id="unseen">
        	<?php 
//      		echo $CaseST;
        		if($CaseST ==0){
        	?>
					<input class="btn btn-primary" type="button" value="文件上传" onclick="upfile('<?php echo $CaseId; ?>')"  />
					<!--<script>var caseid=<?php echo $CaseId; ?>;</script>-->
					<!--<input class="btn btn-warning" type="button" value="操作记录" onclick="window.location.href='chaxun.php?+id='caseid,'_blank'" />-->
					<a target="_blank" href="chaxun.php?CaseId=<?php echo $CaseId; ?>"><button class="btn btn-warning" >操作记录</button></a>
						<br/><br/>				
			<?php } ?>
            <table class="table table-bordered table-striped table-condensed" >
				<thead>
					<tr>
				    <th class="numeric" style="width: 40%;">文件记录</th>
				    <th class="numeric" >记录创建时间</th>
				    <th class="numeric" >处理人</th>
				    <th class="numeric" >操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						require'../../../conn.php';
						$sql5 = "select id,创建时间,创建人,对应id,文件路径 from 专案_项目申报文件  where 对应id='".$CaseId."' and 删除状态=0 ";
				    	$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
					?>
						<tr>
							<td class="numeric" ><?php echo pathinfo($row5['文件路径'],PATHINFO_BASENAME);?></td>
							<td class="numeric" ><?php echo $row5['创建时间']; ?></td>
							<td class="numeric" ><?php echo $row5['创建人']; ?></td>
							<td>
								<a class="btn-default" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>"><button class="btn btn-demo" >下载</button></a>
								<?php
									if($CaseST == 0){
								?>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-warning" onclick="change(this)" >替换</button>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
								<?php
									}
								?>
							</td>
						</tr>
					<?php
							}
						}
						else{
							?>
							<th class="numeric" colspan="4" >暂无记录</th>
							<?php
						}
					?>
				</tbody>
			</table>
          </section>
       	</div>
       	<!--项目日程-->
       	<div class="tab-pane" id="about-3">
          	<section id="unseen">
	        	<div class="panel-body">
	        	<div class="adv-table">
            <aside class="col-md-4" >
            <section class="panel">
                <p><input type="text" id="date" value="" style="height:40px; line-height:40px;" readonly="readonly" /></p>
                <div id="CalT" style="height: 400px;" style=""></div>
            </section>
            </aside>
            <aside class="col-md-8">
				<?php
            		require'../../../conn.php';
            		$sql = "select 完成项 from 项目日程附  where 项目id='".$CaseId."' ";
	                		$result = $conn->query($sql);
	                		$ShowStu='';
	                		if($result->num_rows>0){
	                			while($row = $result->fetch_assoc()){
	                				$ShowStu = $row['完成项'];
	                			}
	                		}
            	?>
              <div id="TabDoing">
              	<button style="float: right;" class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i></button>
              	<span><input type="checkbox" id="ShowType" onclick="ChanST(this)" <?php if($ShowStu){echo "checked='checked'";} ?> /><strong>显示已完成</strong></strong></span>
              	<br /><br />
              	<table class="table table-bordered table-striped table-condensed" id="tab">
                    <thead>
                        <tr>
                    		<th class="numeric" hidden="hidden">id</th>
                            <th style="width: 2%;">#</th>
                            <th style="width: 58%;">安排</th>
                            <th class="numeric">备注</th>
                            <th class="numeric">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    	
                    </tbody>
                </table>
              </div>
            </aside>
	        </div>
	        </div>
			</section>
       </div>
       <!--日程总览-->
       	<div class="tab-pane" id="about-4">
		  	<section id="unseen">
		        <div class="panel-body">
		        	<div class="adv-table">
				        <table class="display table table-bordered table-striped" id="dynamic-table">
				        	<thead>
			                    <tr>
			                        <th hidden="hidden">#</th>
			                        <th style="width: 120px;">计划时间</th>
			                        <th>计划安排</th>
			                        <th>备注</th>
			                        <th style="width: 100px;">状态</th>
			                        <th style="width: 120px;">创建人</th>
			                        <th style="width: 120px;">创建时间</th>
			                        <th style="width: 120px;">操作</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	<?php
			                		require'../../../conn.php';
									if($admin){
		                			$sql = "select id,事件名,事件时间,状态,备注,用户id,创建时间  from 项目日程 where 项目id='".$CaseId."' and 删除状态=0 ";
									}else{
		                			$sql = "select id,事件名,事件时间,状态,备注,用户id,创建时间  from 项目日程 where 项目id='".$CaseId."' and 删除状态=0 ";
									}
				                		$result = $conn->query($sql);
				                		if($result->num_rows>0){
				                			while($row = $result->fetch_assoc()){
				                				$CId = $row['id'];
				                				$CDt = $row['事件时间'];
				                				$CNa = $row['事件名'];
				                				$CSt = $row['状态'];
				                				$CEl = $row['备注'];
				                				$CPId = $row['用户id'];
				                				$CTime = $row['创建时间'];
				                				//查找创建人姓名
				                				$sql2 = "SELECT 名称 FROM 用户 WHERE id='".$CPId."'";
												$result2 = $conn->query($sql2);
												if($result2 ->num_rows>0){
													while($row2 = $result2->fetch_assoc()){
														$Name = $row2['名称'];
													}
												}
				                				//设定日程状态
				                				if($CSt){
				                					$CSt = '已完成';
				                				}else{
				                					$CSt = '未完成';
				                				}
				                		?>
				                		<tr>
				                            <td class="numeric" hidden="hidden"><input type="checkbox" /></td>
				                            <td class="numeric"><?php echo $CDt; ?></td>
				                            <td class="numeric"><?php echo $CNa; ?></td>
				                            <td class="numeric"><?php echo $CEl; ?></td>
				                            <td class="numeric"><?php echo $CSt; ?></td>
				                            <td class="numeric"><?php echo $Name; ?></td>
				                            <td class="numeric"><?php echo $CTime; ?></td>
				                        <?php 
				                        	$sql2 = "SELECT id FROM 项目日程文件 WHERE 日程id='".$CId."'";
											$result2 = $conn->query($sql2);
											if($result2->num_rows>0){
										?>
												<td class="numeric"><input type="button" name="<?php echo $CId;?>" value="下载" onclick="DownFile_zip(this.name)" /></td>
										<?php		
											} else{
										?>
												<td class="numeric">无文件</td>
										<?php
											}
				                        ?>
				                        </tr>
				                				<?php
				                			}
				                		}
			                	?>
			                </tbody>
				        </table>
		        	</div>				        	
		        </div>
    		</section>
    	</div>
    </div>
  </div>
</section>
        <!--body wrapper end-->
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../../js/jquery-1.10.2.min.js"></script>
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

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>

<!--calendar new-->
<script src="../../../js/JMCalendar/fullcalendar/fullcalendar.js"></script>
<script src="../../../js/JMCalendar/fullcalendar/gcal.js"></script>

<!--功能JS函数集-->
<script src="../../../js/imitation_1/project_report.js"></script>
<script src="../../../js/imitation_1/dateworks.js"></script>
<script type="text/javascript">
//设置案件状态
//	$(".checilck > li").click(function(){
//		var text = $(this).html();//获取排序方式
//		var Text = text.substr(12,text.length-16);//处理获取的数据
//		var CaseId = document.getElementById("CaseId").value;//获取id
//		$.ajax({
//			url:'CaseSave.php',
//			type:'get',
//			async:true,
//			data:{
//				falg:'change',//判断表格的依据
//				order:Text,
//				CaseId:CaseId
//			},
//			success:function(data){
//				document.getElementById("ajSt").innerHTML = Text;
//				alert(data);
//			},
//			error:function(){
//				alert('false');
//			}
//		});
//	});

</script>

</body>
</html>