<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title>银行账号的信息</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
	  <meta name="description" content="">
	  <meta name="author" content="ThemeBucket">
	  <link rel="shortcut icon" href="#" type="image/png">
	  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>
	
	  <!--dynamic table-->
	  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
	  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
	  
		<!--pickers css-->
	  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
		
	  <link href="../../css/style.css" rel="stylesheet">
	  <link href="../../css/style-responsive.css" rel="stylesheet">
	</head>
	<body>
	<?php
	$my_flag = $_GET['my_flag'];
	if($my_flag == "alter"){
		$id_self = $_GET['id_self'];
		$data_arr = '';
		require("../../conn.php");
		$sql = "SELECT 开户银行,户名,银行账号 FROM 银行账户  WHERE id='".$id_self."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$data_arr[0] = $row['开户银行'];
				$data_arr[1] = $row['户名'];
				$data_arr[2] = $row['银行账号'];
			}
		}
		$conn->close();
	?>	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">银行账号修改</h4>
			</div>
			<div class="modal-body">
				<input id="js_flag" type="text" hidden="hidden" value="alter" />
				<form action="#" class="form-horizontal " id="my_form">
					<input type="text" hidden="hidden" value="<?php echo $id_self; ?>" />
			 		<div class="form-group">
                        <label class="control-label col-md-4">开户银行：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium" type="text" value="<?php echo $data_arr[0];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">户名：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium"  type="text" value="<?php echo $data_arr[1];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">银行账号：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium"   type="text" data-mask="9999 9999 9999 9999 999" value="<?php echo $data_arr[2];?>"/>
                        </div>
                    </div>
			 	</form>
                <div class="modal-footer" align="center">
                	<button id="save_alter" data-dismiss="modal" class="btn btn-primary" type="button">保存</button>
                    <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="opener.location.reload();window.close();">关闭</button>
                </div>
           </div>
        </div>
    </div>
    <?php
    }else if($my_flag == 'addnew'){
    	
    ?>
    	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">银行账号新增</h4>
			</div>
			<div class="modal-body">
				<input id="js_flag" type="text" hidden="hidden" value="addnew" />
				<form action="#" class="form-horizontal " id="my_form">
			 		<div class="form-group">
                        <label class="control-label col-md-4">开户银行：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium" type="text"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">户名：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium"  type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">银行账号：</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium"   type="text" data-mask="9999 9999 9999 9999 999" />
                        </div>
                    </div>
			 	</form>
                <div class="modal-footer" align="center">
                	<button id="save_alter" data-dismiss="modal" class="btn btn-primary" type="button">保存</button>
                    <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="window.close();">关闭</button>
                </div>
           </div>
        </div>
    </div>
    <?php
    }	
    ?>
    
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
	
	<!--bootstrap input mask-->
	<script type="text/javascript" src="../../js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	<!--pickers initialization-->
	<!--<script src="../../js/pickers-init.js"></script>-->
	
	<!--common scripts for all pages-->
	<script src="../../js/scripts.js"></script>		
	<script type="text/javascript">
		var save_alter = document.getElementById("save_alter");
		var my_form = document.getElementById("my_form");
		var my_input = my_form.getElementsByTagName("input");
		
		save_alter.addEventListener("click",function(){
			var str_send = new String();
			for(i=0;i<my_input.length;i++){
				str_send = str_send + my_input[i].value + ",";
			}			
			str_send = str_send.substr(0,str_send.length-1);
//			alert(str_send);
			var js_flag = document.getElementById("js_flag").value;
			if(js_flag == "alter"){
				$.ajax({
					data:{
						my_flag:"save_alter",
						str_send:str_send
					},
					type:"post",
					url:"bank_ajax.php",
					async:true,
					dataType:"json",
					success:function(data){
	//					alert("success!");
						if(data['result']=="success"){
							alert("保存成功！");
							opener.location.reload();
							window.close();
						}
					},
					error:function(){
						alert("ajax error! + 保存失败！");
					}
				});				
			}else if(js_flag == "addnew"){
				$.ajax({
					data:{
						my_flag:"save_add",
						str_send:str_send
					},
					type:"post",
					url:"bank_ajax.php",
					async:true,
					dataType:"json",
					success:function(data){
	//					alert("success!");
						if(data['result']=="success"){
							alert("保存成功！");
							opener.location.reload();
							window.close();
						}
					},
					error:function(){
						alert("ajax error! + 保存失败！");
					}
				});
			}

		});

		
	</script>
	</body>
</html>
