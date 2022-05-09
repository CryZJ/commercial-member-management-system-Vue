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

  <title>批量导入存疑信息确认</title>
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

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--提醒弹窗-->
<!--<script language="JavaScript">
	function ShowEdit_01(s_name){
		//var name=
		//var r = window.open("applicant.php?n=" + s_name,null,"");
		alert(s_name);
	}
</script>-->

</head>

<body class="sticky-header" >

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	<form  method="post" enctype="multipart/form-data">
	            	<h3 align="center">授权书批量导入及信息确认</h3>
	            	<span class="tools pull-right">
		              	<a href="javascript:;" class="fa fa-chevron-down"></a>
		              	<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
		            </span>
		            <table>
	            		<tr>
	            			<td><input type="file" name="myfile[]" value="文件选择" multiple="multiple"/></td>
	            			<td><input type="submit" value="提交文件" /></td>
	            		</tr>
	            	</table>
				</form>
            </header>
            	<div class="panel-body">
                    <table class="display table table-bordered table-striped" id="tab_info">
                        <thead>
	                        <tr>
	                            <th>#</th>
	                            <th class="numeric">文件名</th>
	                            <th class="numeric">案卷号</th>
	                            <th class="numeric">专利名称</th>
	                            <th class="numeric">申请号</th>
	                            <th class="numeric">申请日</th>
	                            <th class="numeric">费减</th>
	                            <th class="numeric">费用名</th>
	                            <th class="numeric">金额</th>
	                            <th class="numeric">提醒日期</th>
	                            <th class="numeric">剩余天数</th>
	                            <th class="numeric">截止日期</th>
	                        </tr>
                        </thead>
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
								
    				if($_SERVER['REQUEST_METHOD']=='POST'){
//          					echo '<script type="text/javascript">alert("123");</script>';
//          					print_r($_FILES);
						//整理文件数组
						foreach($_FILES as $myfile){
							if($myfile['name'][0] != ''){
								$i=0;
								foreach($myfile['name'] as $key => $val ){
									$files[$i]['name'] = $myfile['name'][$i];
									$files[$i]['type'] = $myfile['type'][$i];
									$files[$i]['tmp_name'] = $myfile['tmp_name'][$i];
									$files[$i]['error'] = $myfile['error'][$i];
									$files[$i]['size'] = $myfile['size'][$i];
									$i++;
								}
							}
						}
//								print_r($files);
						//整理完毕：$files
						require_once 'readxml_upload_fun_00.php';
						require_once 'upload_func.php';
						require('conn.php');
						$num = count($files);
//											echo $num;
						$j=0;
						for($i=0;$i<$num;$i++){
							$ext = suffix($files[$i]['name']);//获取文件的后缀
//									echo $ext;
							if($ext=="zip"){
								//获取xml信息
								$returndata =  impower_all($files[$i]['tmp_name']);
//										print_r($returndata);
								if($returndata['结果']=="成功"){
									//编辑路径并保存
									$str_arr = explode(".", $files[$i]['name']);
									$ajh = $str_arr[0];
									$path = "filesave/".$ajh;
//											echo $path."<br/>";
									$maxSize = 209715200;
									$upload_path =  upload_allfile($files[$i],$path,$maxSize);
									$upload_path = iconv("gb2312","UTF-8",$upload_path);
//											echo $upload_path."<br/>";
									$returndata['文件名称'] = basename($upload_path);
									$returndata['案卷号'] = $ajh;
									$now_time = date("Y-m-d");
									//更新“专利信息”
									$sql = "update 专利信息  set 状态='年费中' where 申请号='".$returndata['申请号']."'";
//											echo $sql."<br/>";
//											$result = $conn->query($sql);
									//更新“案卷流程及文档”
									$sql2 = "insert into 案卷流程及文档(案卷号,流程,处理人,时间,文件路径,通知书名称) value(";
									$sql2 .= " '$ajh','授权导入','$name','$now_time','$upload_path','".$returndata['通知书名称']."')";
//											echo $sql2;
//											$result2 = $conn->query($sql2);

									$base_data[$j] = $returndata;
									$j++;
								}
								
							}
						}
//								print_r($base_data);
						$data_num = count($base_data);
						for($i=0;$i<$data_num;$i++){
							foreach($base_data[$i]['费用'] as $key =>$value){
				?>
								<tr>
									<td><input type="checkbox" /></td>
									<td><?php echo $base_data[$i]['文件名称']; ?></td>
									<td><?php echo $base_data[$i]['案卷号']; ?></td>
									<td><?php echo $base_data[$i]['专利名称']; ?></td>
									<td><?php echo $base_data[$i]['申请号']; ?></td>
									<td><?php echo $base_data[$i]['申请日']; ?></td>
									<td><?php echo $base_data[$i]['减缓标记']; ?></td>
									<td><?php echo $key; ?></td>
									<td><?php echo $value; ?></td>
									<td><input type="date"  value="<?php echo date('Y-m-d',strtotime('-1months',strtotime($base_data[$i]['办理登记缴费截止日期']))); ?>"/> </td>
									<td>
									<?php 
										$now_t=date("Y-m-d");
										echo diffBetweenTwoDays($now_t,$base_data[$i]['办理登记缴费截止日期']); 
									?>
									</td>
									<td><?php echo $base_data[$i]['办理登记缴费截止日期']; ?></td>
								</tr>
				<?php				
							}
						}

    				}else{
    			?>
                <tbody>
                    <tr>
                        <td class="numeric" ><input type="checkbox" id="" name="" value="" /></td>
                        <td class="numeric"><input style="width: 120px;" type="text" id="" name="" value="" readonly="readonly" /></td>
                        <td class="numeric">00002BADAD</td>
                        <td class="numeric">AAA</td>
                        <td class="numeric">11111111</td>
                        <td class="numeric">17-10-10</td>
                        <td class="numeric">XXXXX</td>
                        <td class="numeric"><input style="width: 100px;" type="text" id="" name="" value="" /></td>
                        <td class="numeric"><input style="width: 100px;" type="text" id="" name="" value="" /></td>
                        <td class="numeric"><input  type="date" id="" name="" value="" /></td>
                        <td class="numeric"><input style="width: 60px;" type="text" id="" name="" value="" /></td>
                        <td class="numeric"><input  type="date" id="" name="" value="" /></td>
                    </tr>
                </tbody>
           	
    			<?php		
    				}
    			?>
	            			</table>
    				<div align="center" ><button id="save" ><strong>信息确认完毕</strong></button></div>
    			</div>
	       	</section>
	        </div>
	        </div>
	        </div>
        <!--body wrapper end-->
    <!-- main content end-->
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
<script src="js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<!--保存数据-->
<script src="js/file_check_02.js"></script>

</body>
</html>