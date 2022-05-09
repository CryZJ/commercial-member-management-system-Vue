<?php 
	require("../../AHeader.php");
?>

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

  <title>选择发送的人</title>
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
	        				</header>
				        	<div class="panel-body">
				        		<div class="adv-table"> 
						        	<table  class="display table table-bordered table-striped" id="dynamic-table">
							        	<thead>
									        <tr> 
									        	<th><input type="checkbox" id="select_all" /></th>
								        	    <th>序号</th>
									            <th>名称</th>
									        </tr>
							        	</thead>
							        	<tbody id="tab_send">
							        	<?php
							        		require("../../conn.php");
							        		$sql="SELECT id,名称 FROM 用户  WHERE 名称<>'".$name."'";
							        		$result = $conn->query($sql);
							        		if($result->num_rows > 0){
							        			while($row = $result->fetch_assoc()){
							        	?>
					        				<tr>
					        					<td><input type="checkbox" /></td>
					        					<td><?php echo $row['id']; ?></td>
					        					<td><?php echo $row['名称']; ?></td>
					        				</tr>
							        	<?php			
							        			}
							        		}
							        		
							        		$conn->close();
							        			
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

<script type="text/javascript">
var select_all = document.getElementById("select_all");
var tab_send = document.getElementById("tab_send");
var make = document.getElementById("make");

var accept_id = window.dialogArguments;
//alert(accept_id);

//选择全部	
select_all.addEventListener('click',function(){
	if(select_all.checked == true){
		var row_num = tab_send.rows.length;
		for(i=0;i<row_num;i++){
			tab_send.rows[i].cells[0].getElementsByTagName("input")[0].checked = true;
		}
	}else{
		var row_num = tab_send.rows.length;
		for(i=0;i<row_num;i++){
			tab_send.rows[i].cells[0].getElementsByTagName("input")[0].checked = false;
		}		
	}
});

//确定发送
//发送文件
make.addEventListener("click",function(){
	if(confirm("是否确定发送文件？")){
		var str_id = new String();
		var row_num = tab_send.rows.length;
		for(i=0;i<row_num;i++){
			if(tab_send.rows[i].cells[0].getElementsByTagName("input")[0].checked == true){
				str_id = str_id + tab_send.rows[i].cells[2].innerHTML + ",";
			}
		}
		if(str_id.length != 0){
			str_id = str_id.substr(0,(str_id.length-1));
//			alert(str_id + "//" +accept_id);
			$.ajax({
				data:{
					my_flag:"send_make",
					member_name:str_id,
					accept_id:accept_id
				},
				type:"post",
				url:"member_ajax.php",
				async:true,
				success:function(data){
//					alert(data);
					alert("发送成功！");
					window.returnValue="refresh";
					window.close();
				},
				error:function(){
					alert("ajax error! + 发送文件失败！");
				}
			});
			
		}else{
			alert("没有勾选人员！");
		}
	}		
})
	
</script>

</body>
</html>
