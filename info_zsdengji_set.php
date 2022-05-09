<?php
	require("AHeader.php");
?>
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>


  <title>专案-证书登记</title>


  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />


</head>
<body class="sticky-header">
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
					<header class="panel-heading">
						<span class="tools pull-right">
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
						</span>
						<span>证书登记</span>
						<form  action="#" method="post" enctype="multipart/form-data">
						<?php
							//为了第一次actioon后能显示<header>中的案卷号
							$ajh='';
							$ajh = $_REQUEST["ajh"];
			    		?>	
							<table>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td><td>&nbsp;</td>
									<th>案卷号：</th>
									<th><input type="text" id="ajh" name="ajh" style="border:0px" readonly value="<?php echo $ajh; ?>"/></th>
									<td>&nbsp;&nbsp;&nbsp;</td>
									<td <?php echo ($_SERVER['REQUEST_METHOD']=='POST')?'class="hidden"':""; ?> ><input type="file" name="myfile" id="myfile" value=""/></td>
									<th <?php echo ($_SERVER['REQUEST_METHOD']=='POST')?'class="hidden"':""; ?> ><input type="submit" id="" name="" value="提交文件" /></th>
								</tr>
							</table>
						</form>
				  	</header>
				 	<?php
				 		if($_SERVER['REQUEST_METHOD']=='POST'){
//			    			$ajh = $_POST['ajh'];//为了下次action时能把下面的表单中的案卷号传过去
			    			//获取在次案卷号以保存的文件数，避免文件名重复；获取费减比例，类型，申请日以创建年费列表
			    			$id_num='';
			    			require('conn.php');
							$sql = "select count(a.id) as 数量 ,a.处理人 ,b.类型,b.年费费减比例,b.申请日,b.申请号,b.年费首年度  from 案卷流程及文档  a,专利信息 b where a.案卷号=b.案卷号  and a.案卷号='".$ajh."'";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row = $result->fetch_assoc()){
									$id_num = $row['数量']+1;
									$clr = $row['处理人'];
									$sqh = $row['申请号'];
									$nffjb = $row['年费费减比例'];
									$sqr = $row['申请日'];
									$nfsnd = $row['年费首年度'];
									$lx_num = substr($sqh,4,1);
								}
							}
							/*获取传过来的文件保存后的路径*/
							require_once 'upload_func.php';//保存文件的函数
//							print_r($_FILES);
							$fileInfo=$_FILES['myfile'];
//							print_r($fileInfo);
							$upload_path = "filesave/".$ajh;
							$path = uploadFile($fileInfo,$upload_path,'209715200',$id_num);//保存文件到服务器
							$path = iconv('gb2312', 'utf-8', $path);//改变编码为：utf-8
//							echo $path;
							/*把文件路径保存到数据库中*/
							$now_time = date("Y-m-d H:i:s");//时间，处理人暂用上面$clr代替
							$sql2 = "insert into 案卷流程及文档 (案卷号,流程,处理人,时间,文件路径) values( ";
							$sql2 .= "'".$ajh."','证书导入','".$name."','".$now_time."','".$path."')";
							$result2 = $conn->query($sql2);
							$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','上传证书文件','".date("Y-m-d H:i:s")."','上传了“".pathinfo($path,PATHINFO_BASENAME)."”文件')";
							$conn->query($sql);
							if($result2){
								//更新“专利信息”的证书状态
								$sql3 = "update 专利信息  set 证书状态='已登记' where 案卷号='".$ajh."'";
								$result3 = $conn->query($sql3);
								if($result3){
									echo '<script type="text/javascript">alert("证书文件保存成功！若不需保存年费请关闭此页面！");</script>';
									
					?>
						<!--保存文件后显示年费表-->
						<div class="panel-body">
		        			<!--<h1 align="center">年费列表</h1>-->
								<table class="table table-bordered table-striped table-condensed" id="tab_base" >
									<thead>
										<th>年度</th>
										<th>费用</th>
										<th>截止时间</th>
										<th>提醒时间</th>
										<th>第一期</th>
										<th>第二期</th>
										<th>第三期</th>
										<th>第四期</th>
										<th>第五期</th>
										<th>操作</th>
									</thead>
									<tbody>
										<?php
											require("conn.php");//连接数据库
											$lx='';//案件的类型：发明，实用，外观
											switch($lx_num){
												case 1:
													$lx = "发明专利";
													break;
												case 2:
													$lx = "实用新型";
													break;
												case 3:
													$lx = "外观设计";
													break;
											}
											$nffjb_delete_percent = substr($nffjb, 0,2);//去掉百分号费减比
											switch($nffjb_delete_percent){
												case "70":
													$nffjb = "70%";
													break;
												case "85":
													$nffjb = "85%";
													break;
												default:
													if(!substr($nffjb, 0,3)=="100"){
														echo '<script type="text/javascript">alert("注意该案件的“费减比例”可能错误了，请更正过来！");</script>';
													} 
													$nffjb = "100%";
											}
											
											$fee_arr = array();//存储获取的年费记录
											
											switch($nffjb){
												case "100%":
													//费减比为100%，就是没有费减比，查询`年费设置`表获取数据
													$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$lx."' AND 年费费减比例='".$nffjb."' AND 年度>".$nfsnd." ORDER BY 年度";
													$result = $conn->query($sql);
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
															$fee_arr[$row['年度']] = $row['金额'];
														}
													}
													
													break;
												default:
													//有费减比（70%，85%），目前是首年度及后10年均能使用费减比
													//先获取有费减比的年费记录
													$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$lx."' AND 年费费减比例='".$nffjb."' AND 年度>".$nfsnd." AND 年度<".($nfsnd+10)." ORDER BY 年度";
													$result = $conn->query($sql);
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
															$fee_arr[$row['年度']] = $row['金额'];
														}
													}
													//再获取没有费减比的年费记录
													$sql2 = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$lx."' AND 年费费减比例='100%' AND 年度>=".($nfsnd+10)." ORDER BY 年度 ";
													$result2 = $conn->query($sql2);
													if($result2->num_rows>0){
														while($row2 = $result2->fetch_assoc()){
															$fee_arr[$row2['年度']] = $row2['金额'];
														}
													}
											}
											
											//获取全额年费用于计算滞纳金
											$over = '';
											$sql = "SELECT 金额,年度 FROM 年费设置 WHERE 专利类型='".$lx."' AND 年费费减比例='100%' ORDER BY 年度";
											$result = $conn->query($sql);
											if($result->num_rows>0){
												while($row = $result->fetch_assoc()){
													$over[$row['年度']] = $row['金额'];
												}
											}
														
											foreach($fee_arr as $key => $value){
												//判断“截止时间”是否已超时，如果已超时就不用建了
												$now_date = date("Y-m-d");
												$str =($key-1)."years,1months";
												$end_date = date("Y-m-d",strtotime($str,strtotime($sqr)));
												if($end_date>$now_date){
										?>
												<tr>
													<td><?php echo $key; ?></td>
													<td><input style="width: 80%;" value="<?php echo $value; ?>" /></td>
													<td><?php  echo $end_date; ?></td>
													<td><input style="width: 80%;height: 25px;" type="date" value='<?php $str2 =($key-1)."years,-1months"; echo date("Y-m-d",strtotime($str2,strtotime($sqr))); ?>' /></td>
													<td><?php echo floatval($over[$key])*0.05; ?></td>
													<td><?php echo floatval($over[$key])*0.1; ?></td>
													<td><?php echo floatval($over[$key])*0.15; ?></td>
													<td><?php echo floatval($over[$key])*0.2; ?></td>
													<td><?php echo floatval($over[$key])*0.25; ?></td>
													<td><button class="btn-danger" onclick="delRow(this)">删除</button></td>
												</tr>
										<?php		
												}
											}
										?>
									</tbody>
								</table>
								<br />
								<?php
									//检测年费是否生成
									if($_SERVER['REQUEST_METHOD']=='POST'){
			    						$ajh = $_POST['ajh'];
										require("conn.php");
										$hid_flag='';
										$sql2 = "SELECT id  FROM 专案_年费记录  WHERE 案卷号='".$ajh."'";
										$result2 = $conn->query($sql2);
										if($result2->num_rows>0){
											$hid_flag = "hidden='hidden'";
										}
										$conn->close();
									}
								?>
								<div align="center">
									<input type="button" <?php //echo $hid_flag; ?> id="button_save" value="保存" onclick="data_save3()"/>
								</div>
						</div>		
					<?php				
								}
							}
						}
				 	?>
			 	</section>
	      </div>
        </div>
        </div>
        <!--body wrapper end-->

    
    <
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--pickers plugins-->
<!--<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->


<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<!--保存年费列表-->
<script src="js/info_sqing_set.js"></script>
<script type="text/javascript">
	function delRow(btn_obj){
		if(confirm("是否确认删除该条年费记录？")){
			$(btn_obj).parent().parent().remove();
		}
	}
</script>

</body>
</html>