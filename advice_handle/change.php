<?php 
	require("../AHeader.php");
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
  <link rel="SHORTCUT ICON" href="../images/output/logo.ico"/>

  <title>更改案件状态</title>
  <!--dynamic table-->
  <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />
  
	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../js/bootstrap-datepicker/css/datepicker-custom.css" />
	

  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
  
</head>

<body>

	<?php
		$id = $_GET['str_id'];
		$filename = ''; 
		require("../conn.php");
		$sql = "SELECT id,案卷号,文件名称,申请号,案件分类 FROM 临时文件  WHERE id='".$id."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$filename = $row['文件名称'];
				$sqh = $row['申请号'];
				$ajh = $row['案卷号'];
				$ajfl = $row["案件分类"];
			}
		}
		
		$dqcx = "";
		$sql = "SELECT 案卷号,状态,案件分类 FROM (SELECT 案卷号,状态,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,状态,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,状态,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$ajh."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$dqcx = $row["状态"];
			}
		}
		
		
		$conn->close();			
	?>
	<div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel" style="height: auto;">
                    <header class="panel-heading">
                    	<h3>更改案件状态</h3>     
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal adminex-form" id="my_form" >
                            	<input type="text" value="<?php echo $ajfl; ?>" id="ajfl" hidden="hidden" /><!--案件分类-->
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >案卷号&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input type="text" value="<?php echo $ajh; ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >申请号&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input id="sqh" type="text" value="<?php echo $sqh; ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">修改案件状态：</label>
                                    	<select name="change" id="change">
                                    		<option selected="selected" value="<?php echo $dqcx; ?>"><?php echo $dqcx; ?></option>
                                    		<option value="待提交">待提交</option>
                                    		<option value="待受理">待受理</option>
                                    		<option value="待申请费">待申请费</option>
                                    		<option value="申请中">申请中</option>
                                    		<option value="待登记费">待登记费</option>
                                    		<option value="待证书">待证书</option>
                                    		<option value="年费中">年费中</option>
                                    		<option value="答辩补正">答辩补正</option>
                                    		<option value="驳回复审">驳回复审</option>
                                    		<option value="结案">结案</option>
                                    		<option value="结案恢复">结案恢复</option>
                                    	</select>
                                    </div>
                                </div>
                                
                            </form>
                            	<br /><br />
                            	<div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-5" align="center">
                                        <button class="btn btn-primary" id="save">保存</button>
                                        <button class="btn btn-default" type="button" onclick="window.close()">关闭</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <br /><br /><br /><br /><br /><br /><br />
                </section>
            </div>
        </div>
   </div>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>
	
<script type="text/javascript">	
	var save = document.getElementById("save");
	var my_form = document.getElementById("my_form");
	var change = document.getElementById("change");
	var sqh = document.getElementById("sqh");
	var ajfl = document.getElementById("ajfl");
	save.addEventListener("click",function(){
//		var inp_form = my_form.getElementsByTagName("input");
//		alert(inp_form.length);
		/*var str_data = new String();
		for(i=0;i<inp_form.length;i++){
			str_data = str_data + inp_form[i].value + ",";
		}
		str_data = str_data.substr(0,str_data.length-1);*/
//		alert(str_data);
//		alert(sqh.value);
		$.ajax({
			url:"change_ajax.php",
			type:"post",
			data:{
				my_flag:"save",
				sqh:sqh.value,
				change:change.value,
				ajfl:ajfl.value
			},
//			dataType:"json",
			success:function(data){
//				alert("success");
				alert(data);
				window.close();
			},
			error:function(){
				alert("ajax error!+保存失败");
			}
		});
	});


</script>

</body>
</html>
