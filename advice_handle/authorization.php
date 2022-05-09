<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="refresh" content="20" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>上传文件数量信息-授权</title>
  <!--icheck-->
  <link href="../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
	
	<style type="text/css">
		table > input {
			width: 10px;
			max-width: 10px;
		}
		/*table th {
			width: 150px;
			word-break: break-word;
		}*/
	</style>
</head>

<body class="sticky-header" >

<?php
//计算两日期的间隔天数
function diffBetweenTwoDays ($day1, $day2){
	  $second1 = strtotime($day1);
	  $second2 = strtotime($day2);
	    
	  if ($second1 < $second2) {
	    $tmp = $second2;
	    $second2 = $second1;
	    $second1 = $tmp;
	  }
	  if($second1 <= $second2){
	  	return ($second1 - $second2) / 86400;
	  }else{
	  	return -($second1 - $second2) / 86400;
	  }
}
?>


<section>
    <!--body wrapper start-->
    <div class="wrapper">
    <div class="row">
    <div class="col-sm-12" >
    <section class="panel">
    	<header class="panel-heading custom-tab">
			<span class="tools pull-right">
			  <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
			  <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
			  <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
			</span>
	      	<ul class="nav nav-tabs">
		        <li class="#"><a href="acceptance.php"><i class="fa fa-user"></i>受理文件</a></li>
		        <li class="active"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>授权文件</a></li>
		        <li class="#"><a href="payment.php" ><i class="fa fa-user"></i>缴费通知文件</a></li>
		        <li class="#"><a href="terminate.php" ><i class="fa fa-user"></i>权利终止文件</a></li>
		        <li class="#"><a href="other.php" ><i class="fa fa-user"></i>其他文件</a></li>
				<li class="#"><a href="certificate.php" ><i class="fa fa-user"></i>专利证书</a></li>
		        <li class="#"><a href="historydata.php"><i class="fa fa-user"></i>近十天内上传记录</a></li>
	     	</ul>
		</header>
       	<div class="panel-body">
   			<header class="panel-heading">
				<p>本日上传的文件有<em id="files_num" style="font-size: 25px; color: #0075B0;"></em>个</p>
			</header>
    		<div class="tab-content">
    			
		    	<!--授权书 start-->
				<div class="tab-pane active" id="about-2">
                <section id="unseen">
                	<header class="panel-heading">
						<!--<p style="color: red;">注意：对于“办理登记手续通知书”必须点击“费用”以获取“年费首年度”但可以不保存费用</p>-->			
						<p>本次上传的授权文件有<em id="filenum_sq" style="font-size: 25px; color: #0075B0;"></em>个</p>
					</header>	
					<table class="display table table-bordered table-striped" style="font-size: 5px;">
			        	<thead>
			        		<tr>
			        			<th class="numeric">上传时间</th>
				            <th class="numeric">文件名称</th>
				            <th class="numeric">通知书名称</th>
				            <th class="numeric">专利名称</th>
				            <th class="numeric">申请号</th>
				            <th class="numeric">申请日</th>
				            <th class="numeric">发文日</th>
				            <th class="numeric">申请号是否一样</th>
				            <th class="numeric">状态</th>
				            <th class="numeric" colspan="4">操作</th>
					        </tr>
			        	</thead>
				        <tbody id="tab_info">
				        <?php
				        	/*获取案件的状态*/
					        function Getcasestaus($zt,$djzt){
					        	$ret_msg = "";
										switch($djzt){
											case "1" :
												$ret_msg = "结案";
												break;
											case "2" :
												$ret_msg = "删除";
												break;
											default :
												$ret_msg = $zt;
										}
										return $ret_msg;
					        }
									require("../conn.php");
//									$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样 FROM 临时文件 WHERE 上传情况='0' AND 通知书编码='200602' AND 案件存在='0' ORDER BY 上传时间 DESC ";
									$sql = "SELECT a.id,上传时间,a.文件名称,a.通知书名称,a.通知书编码,a.专利名称,a.案卷号,a.原案卷号,a.申请号,a.申请日,a.发文日,a.申请号是否一样,c.状态,c.冻结状态 FROM 临时文件 a,(SELECT 案卷号,状态,冻结状态,案件分类 FROM (SELECT 案卷号,状态,冻结状态,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,状态,冻结状态,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,状态,冻结状态,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c) c  WHERE a.案卷号=c.案卷号 AND a.上传情况='0' AND a.通知书编码='200602' AND a.案件存在='0' ORDER BY a.案卷号;";
									$result = $conn->query($sql);
									$impower_id='';
									$i=0;
									if($result->num_rows >0){
										while($row = $result->fetch_assoc()){
											$impower_id = $impower_id.$row['id'].",";
											$zt = Getcasestaus($row['状态'],$row['冻结状态']);
								?>
									<tr>
										<td><?php echo $row['上传时间']; ?></td>
										<td><?php echo $row['文件名称']; ?></td>
										<td><?php echo $row['通知书名称']; ?></td>
										<td><?php echo $row['专利名称']; ?></td>
										<td><?php echo $row['申请号']; ?></td>
										<td><?php echo $row['申请日']; ?></td>
										<td><?php echo $row['发文日']; ?></td>
										<td><?php echo $row['申请号是否一样']; ?></td>
										<td><?php echo $zt; ?></td>
										<td>
											<!--<button class="btn btn-default" id="<?php echo $row['id'];?>" onclick="cost(this.id)" >费用</button>-->
											<!--<button class="btn btn-default" id="<?php echo $row['id'];?>" onclick="control(this.id)" >监控</button>-->
											<!--<button class="btn btn-default" id="<?php echo $row['id'];?>" onclick="over(this.id)" >结案</button>-->
											<button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="send(this.id)" >抄送</button>
											<button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="dowload(this.id)" >下载</button>
											<button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="impower_one(this)" >确认</button>
											<button style="font-size:15px;padding: 0;" class="btn btn-danger" id="<?php echo $row['id'];?>"  onclick="del(this)" >删除</button>
										</td>
									</tr>
								<?php			
										}
									}
									$impower_id = substr($impower_id, 0,strlen($impower_id)-1);
									$conn->close();
					      ?>	
				        </tbody>
 					</table>
                	<div align="center">
                  		<button id='sure_2' onclick="impower_all('<?php echo $impower_id; ?>')" >一键确认</button>
                  	</div>
                </section>
           		</div>
           		<!--授权书 end-->
           			
	    </div>    
    	</div>
   	</section>
    </div>
    </div>
    </div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>

<!--个人js-->
<script src="../js/upload_file_num.js"></script>

<script type="text/javascript">
	//获取本日上传的文件数量
	$.ajax({
		type:"get",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"获取本日文件数量",
		},
		success:function(data){
			arr_data = data.split("#$#");
			document.getElementById("files_num").innerHTML = arr_data[0];
//			document.getElementById("filesnum_sl").innerHTML = arr_data[1];
			document.getElementById("filenum_sq").innerHTML = arr_data[2];
//			document.getElementById("filenum_jf").innerHTML = arr_data[3];
//			document.getElementById("filenum_zz").innerHTML = arr_data[4];
//			document.getElementById("filenum_qt").innerHTML = arr_data[5];
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("获取本日上传文件数量失败！");
			console.log("ajax error!"+errorstatus+errorThrow);
		}
	});		
</script>

</body>
</html>