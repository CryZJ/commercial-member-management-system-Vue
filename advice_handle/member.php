<?php 
	require("../AHeader.php");
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
		input {
			zoom: 150%;
		}
		table {
			font-size: 25px;
		}
	</style>
</head>

<body class="sticky-header" >
<section>
	<!--body wrapper start :主要内容-->
	<div class="col-sm-12"><br /><br />
    <section class="panel">
      <header class="panel-heading custom-tab">
	          选择接收人
      	<span class="tools pull-right">
      		<a href="javascript:;" class="fa fa-chevron-down"></a>
  		</span>
      </header>
	<div class="panel-body">
        <div class="tab-content">    
	        <div class="tab-pane active" id="about-1">
	    		<section id="unseen">
					<div class="wrapper">
        				<div class="row">
        					<header class="panel-heading">
	        					<button class="btn btn-primary" data-toggle="modal" id="make">确定</button>
	        					<button class="btn btn-primary" data-toggle="modal" onclick="window.close()">关闭</button>
	        				</header>
				        	<div class="panel-body" >
				        		<div class="adv-table">
				        			<?php
				        				$acc_id = $_GET['str_id'];
				        			?> 
				        			<input type="text" hidden="hidden" id="accid" value="<?php echo $acc_id; ?>" />
						        	<table  class="display table table-bordered table-striped" id="dynamic-table">
							        	<thead>
									        <tr> 
									        	<th colspan="2">全选：<input type="checkbox" id="select_all" /></th>
									            <th colspan="3">名称</th>
									        </tr>
							        	</thead>
							        	<tbody id="tab_send">
							        	<?php
							        		$data_arr = "";
							        		require("../conn.php");
							        		$sql="SELECT id,名称 FROM 用户  WHERE 名称<>'".$name."'";
							        		$result = $conn->query($sql);
							        		if($result->num_rows > 0){
							        			while($row = $result->fetch_assoc()){
							        				$data_arr[] = $row['名称'];
							        			}
							        		}
							        		$conn->close();
							        		$num = count($data_arr);
											$row_now = intval($num/5);
											for($i=0;$i<$row_now;$i++){
										?>
												<tr>
													<td><input type="checkbox" value="<?php echo $data_arr[$i*5]; ?>" />&nbsp;<?php echo $data_arr[$i*5]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$i*5+1]; ?>" />&nbsp;<?php echo $data_arr[$i*5+1]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$i*5+2]; ?>" />&nbsp;<?php echo $data_arr[$i*5+2]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$i*5+3]; ?>" />&nbsp;<?php echo $data_arr[$i*5+3]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$i*5+4]; ?>" />&nbsp;<?php echo $data_arr[$i*5+4]; ?></td>
												</tr>
										<?php		
											}
											$surpuls = $num-($row_now*5);
											if($surpuls == 1){
										?>
												<tr>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5]; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										<?php		
											}else if($surpuls == 2){
										?>
												<tr>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+1]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+1]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										<?php		
											}else if($surpuls == 3){
										?>
												<tr>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+1]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+1]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+2]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+2]; ?></td>
													<td></td>
													<td></td>
												</tr>
										<?php		
											}else if($surpuls == 4){
										?>
												<tr>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+1]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+1]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+2]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+2]; ?></td>
													<td><input type="checkbox" value="<?php echo $data_arr[$row_now*5+3]; ?>" />&nbsp;<?php echo $data_arr[$row_now*5+3]; ?></td>
													<td></td>
												</tr>
										<?php		
											}else if($surpuls == 0){
										?>
												
										<?php		
											}
							        	?>
							        	</tbody>
						        	</table>
				        		</div>				        	
				        	</div>
			        	</div>
				    </div>
	        	</section>
	        </div>
        </div>
    </div>
    
    </section>                                   			
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
var select_all = document.getElementById("select_all");
var tab_send = document.getElementById("tab_send");
var make = document.getElementById("make");
var accept_id = document.getElementById("accid").value;
//alert(accept_id);

//全选
select_all.addEventListener("change",function(){
//	alert(select_all.checked);
	if(select_all.checked){
		inp_che = tab_send.getElementsByTagName("input");
//		inp_che[0].checked = "true";
		for(i=0;i<inp_che.length;i++){
			inp_che[i].checked = true;
		}
	}else{
		inp_che = tab_send.getElementsByTagName("input");
//		inp_che[0].checked = false;
		for(i=0;i<inp_che.length;i++){
			inp_che[i].checked = false;
		}
	}
});

//确定发送
//发送文件
make.addEventListener("click",function(){
	var str_name = new String();
	inp_che = tab_send.getElementsByTagName("input");
	var num = 0;
	for(i=0;i<inp_che.length;i++){
		if(inp_che[i].checked){
			str_name = str_name + inp_che[i].value + ",";
			num++;
		}
	}
	str_name = str_name.substr(0,(str_name.length-1));
	if(str_name.length != 0){
		if(confirm("是否确定向（"+str_name+"）等  "+num+" 个人发送文件？")){
//			alert(str_name + "//" +accept_id);
			$.ajax({
				data:{
					my_flag:"send_make",
					member_name:str_name,
					accept_id:accept_id
				},
				type:"post",
				url:"member_ajax.php",
				async:true,
				success:function(data){
					alert(data);
//					alert("发送成功！");
//					window.returnValue="refresh";
					window.close();
				},
				error:function(){
					alert("ajax error! + 发送文件失败！");
				}
			});
		}
	}else{
			alert("没有勾选人员！");
	}		
});
	
</script>

</body>
</html>