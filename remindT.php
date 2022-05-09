<?php
	require'AHeader.php';
//	require_once 'update_remind_day.php';
?>
<!--/*每次登录更新数据库的剩余天数 test github*/-->
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


  <title>提醒界面</title>
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
</head>
<body class="sticky-header">
<section>
	<div class="wrapper" >
    <div class="row" >
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading custom-tab">
				
              <ul class="nav nav-tabs">
              	<li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-clock-o"></i>事件监控</a></li>
                <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-bars"></i>缴费通知</a></li>
                <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-envelope"></i>申请文件下载</a></li>
                <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-sign-in"></i>接收文件下载</a></li>
                <input id="NORS" hidden="hidden" value="<?php echo $normal; ?>" />
              </ul>
              
   			</header>
           	<div class="panel-body">
			<a class="btn btn-primary" href="index.php" target="_self">进入主页</a>
           		<br /><br />
			    		<div class="tab-content">                             
				<div class="tab-pane" id="about-4">
                    <section id="unseen">
                    	<sub>注：提醒范围为剩余天数在十天内的费用</sub>
                    	<table class="display table table-bordered table-striped" id="dynamic-table">
					       	<thead>
								<tr>
									<th>案卷号</th>
									<th>专利名称</th>
									<th>类型</th>
									<th>申请号</th>
									<th>申请日</th>
									<th>案源人</th>
									<th>代理人</th>
									<th>申请人</th>
									<td>费用名称</td>
									<td>金额</td>
									<th>提醒时间</th>
									<th>截止时间</th>
									<th>剩余天数</th>
								</tr>
							</thead>
							<tbody>
								<?php
									require('conn.php');
									require_once "classes/RemindFeeData.php";
									$getdata = new RemindFeeData($conn);
									$getdata->UsingClass();
									if(!empty($getdata->sqldata_return)){
										foreach($getdata->sqldata_return as $ky => $row){
											switch(substr($row['案卷号'],-4)){
												case "zanf":
													$row['案卷号'] = substr($row['案卷号'],0,-4);
													$url = "ware/imitation_1/new_yearcost/case_info.php?ajh=".$row['案卷号']."";
													break;
												case "zafs":
													$row['案卷号'] = substr($row['案卷号'],0,-4);
													$url = "ware/imitation_1/new_fs/case_info.php?ajh=".$row['案卷号']."";
													break;
												default:
													$row['案卷号'] = substr($row['案卷号'],0,-4);
													$url = "ware/imitation_1/caseinformation.php?ajh=".$row['案卷号']."";
													break;
											}
								?>
								<tr>
									<td><a target="_blank" href="<?php echo $url; ?>"><?php echo $row['案卷号'] ;?></a></td>
									<td><?php echo $row['专利名称'] ;?></td>
									<td><?php echo $row['类型'] ;?></td>
									<td><?php echo $row['申请号'] ;?></td>
									<td><?php echo $row['申请日'] ;?></td>
									<td><?php echo $row['案源人'] ;?></td>
									<td><?php echo $row['代理人'] ;?></td>
									<td><?php echo $row['申请人'];?></td>
									<td><?php echo $row['费用名称'] ;?></td>
									<td><?php echo $row['金额'] ;?></td>
									<td><?php echo $row['提醒时间'] ;?></td>	
									<td><?php echo $row['截止时间'] ;?></td>
									<td><?php echo $row['计算日期'] ;?></td>
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
            	
            	<!--申请文件下载-->	
				<div class="tab-pane" id="about-2">
                <section id="unseen">
                	<div>
                		<a class="btn btn-warning" href="ware/imitation_2/mailmas.php" target="_self">进入下载页面</a>
                	</div>
                	<table class="display table table-bordered table-striped" id="dynamic-table_2">
                        <thead>
                        <tr>
                            <th class="numeric">案卷号</th>
                            <th class="numeric">专利名称</th>
                            <th class="numeric">类型</th>
                            <th class="numeric">案源人</th>
                            <th class="numeric">代理人</th>
                            <th class="numeric">上传时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
							require('conn.php');
//							$sql3 = "SELECT 案卷号,专利名称,类型,案源人,代理人,状态  FROM 专利信息  WHERE 状态='待提交'";
							$sql3="SELECT b.id,a.案卷号,a.专利名称,a.类型,a.案源人,a.代理人,b.文件路径,b.时间 AS 上传时间 FROM 专利信息 a, 案卷流程及文档 b WHERE a.案卷号=b.案卷号 AND a.状态='待提交' AND a.冻结状态='0' AND b.流程='待提交' AND b.删除状态='0'  AND (SELECT SUBSTRING_INDEX(b.文件路径,'.',-1))='zip'";
							$result3 = $conn->query($sql3);
							if($result3->num_rows > 0){
								while($row3 = $result3->fetch_assoc()){
						?>			
							<tr>
								<td><a target="_blank" href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row3['案卷号'];?>""><?php echo $row3['案卷号'] ;?></a></td>
								<td><?php echo $row3['专利名称'] ;?></td>
								<td><?php echo $row3['类型'] ;?></td>
								<td><?php echo $row3['案源人'] ;?></td>
								<td><?php echo $row3['代理人'] ;?></td>
								<td><?php echo $row3['上传时间'] ;?></td>	
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
           			
								<div class="tab-pane" id="about-3">
                <section id="unseen">
                	<div>
                		<a class="btn btn-warning" href="ware/imitation_2/mailmas.php" target="_self">进入下载页面</a>
                	</div>
			        <table  class="display table table-bordered table-striped" id="dynamic-table_3">
			        	<thead>
					        <tr> 
					            <th>序号</th>
					            <th>文件名</th>
					            <th>发送人</th>
					            <th>接收人</th>
					            <th>发送时间</th>
					        </tr>
			        	</thead>
			        	<tbody>
			        	<?php
			        		require("conn.php");
							$sql = "SELECT id,b.名称 AS 发送人,文件路径,发送时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id AND  接收人用户id LIKE '%".$userid."%' AND 删除状态=0";
			        		$result = $conn->query($sql);
			        		if($result->num_rows > 0){
			        			$i = 1;
			        			while($row = $result->fetch_assoc()){
			        	?>
			        				<tr>
			        					<td><?php echo $i; ?></td>
			        					<td><?php echo pathinfo($row['文件路径'],PATHINFO_BASENAME); ?></td>
										<td><?php echo $row['发送人']; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $row['发送时间']; ?></td>
			        				</tr>
			        	<?php			
			        				$i++;
								}
			        		}
			        		$conn->close();
			        	?>  	
                        </tbody>
                	</table>
                </section>
           			</div>     
           		
           		<!--事件监控-->	
						<div class="tab-pane" id="about-1">
                <section id="unseen">
			        <table  class="display table table-bordered table-striped" id="dynamic-table_4">
			        	<thead>
					        <tr> 
					            <th>案卷号</th>
					            <th>申请号</th>
					            <th>案件名称</th>
					            <th>监控描述</th>
                        		<th>创建时间</th>
                        		<th>提醒时间</th>
                        		<th>截止时间</th>
                        		<th>剩余天数</th>
                        		<th>操作</th>
					        </tr>
			        	</thead>
			        	<tbody>
			        	<?php
			        		//表“事件监控” 保存申请案件和其他案件的
                			require("conn.php");
							$sql2 = "SELECT id,案卷号,创建时间,提醒时间,截止时间,监控描述,DATEDIFF(截止时间,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数 FROM 事件监控  WHERE 状态='0'";
							$result2 = $conn->query($sql2);
							if($result2->num_rows>0){
								while($row2 = $result2->fetch_assoc()){
									if($row2['剩余天数'] <=10){
										if($row2['剩余天数'] <= 0  ){
											$SQL_CHE = "SELECT 申请号,专利名称 FROM 专利信息  WHERE 案卷号='".$row2['案卷号']."'";
											$result_CHE = $conn->query($SQL_CHE);
											$ZLMC = $SQH = '';
											if($result->num_rows>0){
												while($row_CHE = $result_CHE->fetch_assoc()){
													$ZLMC = $row_CHE['专利名称'];
													$SQH = $row_CHE['申请号'];
												}
											}
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row2['案卷号'];?>"><?php echo $row2['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row2['监控描述']; ?></td>
										<td><?php echo $row2['创建时间']; ?></td>
										<td><?php echo $row2['提醒时间']; ?></td>
										<td><?php echo $row2['截止时间']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row2['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row2['id']; ?>" onclick="termination(this,'事件监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										}else{
											$SQL_CHE = "SELECT 申请号,专利名称 FROM 专利信息  WHERE 案卷号='".$row2['案卷号']."'";
											$result_CHE = $conn->query($SQL_CHE);
											$ZLMC = $SQH = '';
											if($result_CHE->num_rows>0){
												while($row_CHE = $result_CHE->fetch_assoc()){
													$ZLMC = $row_CHE['专利名称'];
													$SQH = $row_CHE['申请号'];
												}
											}
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row2['案卷号'];?>"><?php echo $row2['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row2['监控描述']; ?></td>
										<td><?php echo $row2['创建时间']; ?></td>
										<td><?php echo $row2['提醒时间']; ?></td>
										<td><?php echo $row2['截止时间']; ?></td>
										<td><?php echo $row2['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row2['id']; ?>" onclick="termination(this,'事件监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										}
									}			
								}
							}
						?>
						<?php	
							//表“专案_监控”
							$sql = "SELECT a.id,a.案卷号,a.监控名,a.提醒日期,a.截止日期,DATEDIFF(截止日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数,b.专利名称,b.申请号 FROM 专案_监控 a,专利信息 b WHERE a.状态=0 and a.`案卷号` = b.`案卷号`";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQH = $row['申请号'];
									$ZLMC = $row['专利名称'];
									if($row['剩余天数'] <=10){
									if($row['剩余天数'] <= 0){
										
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'专案_监控')" >终止监控</button>
										</td>
									</tr>
						<?php				
									}else{
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/caseinformation.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><?php echo $row['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'专案_监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										
									}
									}
								}
							}
                		?>
                		<?php	
							//表“商标_监控”
							$sql = "SELECT a.id,a.案卷号,a.监控名,a.申请日期,a.提醒日期,a.截止日期,DATEDIFF(截止日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数,b.`商标说明`,b.`注册号` FROM 商标_监控 a,`商标_案件` b WHERE a.状态=0 and a.`案卷号`=b.`案卷号`";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQH = $row['注册号'];
									$ZLMC = $row['商标说明'];
									if($row['剩余天数'] <=10){
									if($row['剩余天数'] <= 0){
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/blogo_case/case_CaseMes.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'商标_监控')" >终止监控</button>
										</td>
									</tr>
						<?php				
									}else{
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/blogo_case/case_CaseMes.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><?php echo $row['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'商标_监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										
									}
									}
								}
							}
                		?> 
                		<?php	
							//表“软件_监控”
							$sql = "SELECT a.id,a.案卷号,a.监控名,a.申请日期,a.提醒日期,a.截止日期,DATEDIFF(截止日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数,b.`申请号`,b.`软件名称` FROM 软件_监控 a,`软件_信息` b WHERE a.状态=0 and a.`案卷号`=b.`案卷号`";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQH = $row['申请号'];
									$ZLMC = $row['软件名称'];
									if($row['剩余天数'] <=10){
									if($row['剩余天数'] <= 0){
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/software_case/rjxg.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'软件_监控')" >终止监控</button>
										</td>
									</tr>
						<?php				
									}else{
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/software_case/rjxg.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><?php echo $row['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'软件_监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										
									}
									}
								}
							}
                		?> 
                		<?php	
							//表“著作_监控”
							$sql = "SELECT a.id,a.案卷号,a.监控名,a.申请日期,a.提醒日期,a.截止日期,DATEDIFF(截止日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数,b.申请号,b.著作名称 FROM 著作_监控 a,`著作_信息` b WHERE a.状态=0 and a.`案卷号`=b.案卷号";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQH = $row['申请号'];
									$ZLMC = $row['著作名称'];
									if($row['剩余天数'] <=10){
									if($row['剩余天数'] <= 0){
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/works_case/zzxg.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'著作_监控')" >终止监控</button>
										</td>
									</tr>
						<?php				
									}else{
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/works_case/zzxg.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><?php echo $row['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'著作_监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										
									}
									}
								}
							}
                		?>
                		<?php	
							//表“海关_监控”
							$sql = "SELECT a.id,a.案卷号,a.监控名,a.申请日期,a.提醒日期,a.截止日期,DATEDIFF(截止日期,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数,b.`申请号`,b.`名称` FROM 海关_监控 a,`海关_案件` b WHERE a.状态=0 and a.`案卷号`=b.`案卷号`";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row=$result->fetch_assoc()){
									$SQH = $row['申请号'];
									$ZLMC = $row['名称'];
									if($row['剩余天数'] <=10){
									if($row['剩余天数'] <= 0){
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/customs_case/case_mess.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><strong style="color: red;font-size: 20px;"><?php echo $row['剩余天数']; ?></strong></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'海关_监控')" >终止监控</button>
										</td>
									</tr>
						<?php				
									}else{
						?>
									<tr>
										<td><a target="_blank" href="ware/imitation_1/customs_case/case_mess.php?ajh=<?php echo $row['案卷号'];?>"><?php echo $row['案卷号']; ?></a></td>
										<td><?php echo $SQH; ?></td>
										<td><?php echo $ZLMC; ?></td>
										<td><?php echo $row['监控名']; ?></td>
										<td><?php echo $row['申请日期']; ?></td>
										<td><?php echo $row['提醒日期']; ?></td>
										<td><?php echo $row['截止日期']; ?></td>
										<td><?php echo $row['剩余天数']; ?></td>
										<td>
											<button class="btn btn-danger" id="<?php echo $row['id']; ?>" onclick="termination(this,'海关_监控')" >终止监控</button>
										</td>
									</tr>
						<?php
										
									}
									}
								}
							}
                		?>  	
                        </tbody>
                	</table>
                </section>
           			</div>            			
           			      			
           		</div>
           	</div>		
   		</section>	
	</div>
	</div>
	</div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
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
<script src="js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script type="text/javascript">	
function termination(btn_doc,my_flag){
	if(confirm("是否结束监控？")){
		id = btn_doc.id;
//		alert(id+my_flag);
		$.ajax({
			url:"remind_ajax.php",
			type:"GET",
			data:{
				my_flag:my_flag,
				id:id
			},
//			dataType:"json",
			success:function(data){
				alert(data);
				location.reload();
			},
			error:function(XMLhttprequest,errotstatus,errorThrow){
				alert("终止监控失败！");
				console.log("ajax error!"+errotstatus+errorThrow);
			}
		});
	}
}
</script> 
<!--about 常态-->
		<script src="js/NormalS.js"></script>
</body>
</html>