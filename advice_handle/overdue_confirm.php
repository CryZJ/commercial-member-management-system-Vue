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
	</style>
</head>

<body class="sticky-header" >
<section>
    <!--body wrapper start-->
    <div class="wrapper">
    <div class="row">
    <div class="col-sm-12" >
    <section class="panel">
        <header class="panel-heading">
            <h3 align="center">缴费通知书信息确认</h3>
        	<span class="tools pull-right">
          	<a href="javascript:;" class="fa fa-chevron-down"></a>
          </span>
        </header>
    	<div class="panel-body">
    		<?php
    			require('../conn.php');	
    			$id = $_GET['id'];
    			//获取数据
    			$data='';
    			$sql = "SELECT 文件名称,案卷号,专利名称,申请号,申请日 FROM 临时文件  WHERE id='".$id."'";	
				 	$result = $conn->query($sql);
				 	if($result->num_rows>0){
				 		while($row = $result->fetch_assoc()){
				 			$data[0] = $row['文件名称'];
							$data[1] = $row['专利名称'];
							$data[2] = $row['案卷号'];
							$data[3] = $row['申请号'];
							$data[4] = $row['申请日'];
				 		}
				 	}else{
				 		exit("“临时文件”中无此id记录！");
				 	}
					if($data != ''){
						//读取xml里的费用
						require_once "more_upload_func.php";
						$path = "../tmp_fileupload/".$data[0];
						if(file_exists(iconv("utf-8", "gbk", $path))){
							$cost_return = read_feeremind_xml($path);
						}else{
							exit($data[0]."文件不存在！");
						}
					}
					$conn->close();
    		?>
    		<input type="text" hidden="hidden" id="nd" value="<?php echo $cost_return['年度']; ?>" />
    		<header class="panel-heading">
    			<p>
    				<span>通知书名称：缴费通知书</span>&nbsp;&nbsp;&nbsp;
    			</p>
    			<label>专利名称：<?php echo $data[1];?></label>
    			<br />
    			<span id="tab_row" style="font-size: 15px; color: #FF6C60;"></span>
    		</header>		
        <table class="display table table-bordered table-striped" >
        	<thead>
        		<tr>
		            <th class="numeric">案卷号</th>
		            <th class="numeric">发文日</th>
		            <th class="numeric">期数</th>
		            <th class="numeric">年度</th>
		            <th class="numeric">年费</th>
		            <th class="numeric">滞纳金额</th>
		            <th class="numeric">缴费开始时间</th>
		            <th class="numeric">缴费截止时间</th>
		        </tr>
        	</thead>
	        <tbody id="tab_info">
	        	<?php
//Array ( [发文日] => 2016-03-30 [申请号] => 2014300322665 [缴费年度] => 3 
//[滞纳金] => Array ( 
//[0] => Array ( [年费] => 90.0 [滞纳金额] => 30.0 [缴费开始时间] => 2016-03-25 [缴费截止时间] => 2016-04-25 ) 
//[1] => Array ( [年费] => 90.0 [滞纳金额] => 60.0 [缴费开始时间] => 2016-04-26 [缴费截止时间] => 2016-05-24 ) 
//[2] => Array ( [年费] => 90.0 [滞纳金额] => 90.0 [缴费开始时间] => 2016-05-25 [缴费截止时间] => 2016-06-24 ) 
//[3] => Array ( [年费] => 90.0 [滞纳金额] => 120.0 [缴费开始时间] => 2016-06-25 [缴费截止时间] => 2016-07-25 ) 
//[4] => Array ( [年费] => 90.0 [滞纳金额] => 150.0 [缴费开始时间] => 2016-07-26 [缴费截止时间] => 2016-08-24 ) ) 
//[result] => success )	        	
		        	if($cost_return['result'] == "success" ){
		        		foreach($cost_return['滞纳金'] as $key_0 => $value_0){
							?>
								<tr>
									<td><?php echo $data[2]; ?></td>
									<td><?php echo $cost_return['发文日']; ?></td>
									<td><?php echo intval($key_0)+1 ; ?></td>	
									<td><?php echo $cost_return['缴费年度']; ?></td>	
									<td><?php echo $value_0['年费']; ?></td>	
									<td><?php echo $value_0['滞纳金额']; ?></td>	
									<td><?php echo $value_0['缴费开始时间']; ?></td>	
									<td><?php echo $value_0['缴费截止时间']; ?></td>
								</tr>	
							<?php
		        		}
					}		
	        	?>
	        </tbody>
    	  </table>
    	  <div align="center">
    	  	<button id="save"  onclick="impower_save()">更换对应的滞纳金</button>
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

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>
<script type="text/javascript">
function impower_save(){
	var tab_info = document.getElementById("tab_info");
	var data_send = new Array();
	
	var nrow = tab_info.rows.length;
	for(i=0;i<nrow;i++){
		data_send[i] = new Array();
		for(j=0;j<8;j++){
			data_send[i][j] = tab_info.rows[i].cells[j].innerHTML;
		}
	}
	$.ajax({
		data:{
			my_flag:"overdue",
			data_send:data_send
		},
		type:"post",
		url:"free_save_ajax.php",
		async:true,
		dataType:"json",
		success:function(data){
//			alert(data);
			alert(data.result);
			window.close();
		},
		error:function(){
			alert("ajax error!+ 保存失败！ ")
		}
	});		
}
</script>

</body>
</html>