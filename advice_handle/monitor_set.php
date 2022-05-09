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

  <title>新增监控</title>
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
		$id = $_GET['id'];
		$ajh = "";
		$sqh = ""; 
		require("../conn.php");
		$sql = "SELECT 申请号,案卷号 FROM 临时文件  WHERE id='".$id."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ajh = $row['案卷号'];
				$sqh = $row['申请号'];
			}
		}
		$conn->close();			
	?>
	<div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel" style="height: auto;">
                    <!--<header class="panel-heading">
                    	<h3>监控信息填写</h3>     
                    </header>-->
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal adminex-form" id="my_form" >
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >案卷号&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input type="text" value="<?php echo $ajh; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >申请号&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input type="text" value="<?php echo $sqh; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">提醒时间：</label>
                                        <input type="date" style="height: 25px;" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">截止时间：</label>
                                        <input type="date" style="height: 25px;" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >监控描述：</label>
                                        <input  type="text" id="inp_jkms" hidden="hidden"/>
                                        <select id="sel_jkms">
                                        	<option selected="selected" value=""></option>
                                        	<?php
                                        		require("../conn.php");
                                        		$sql = "SELECT 流程 FROM 案件流程设置";
												$result = $conn->query($sql);
												if($result->num_rows>0){
													while($row=$result->fetch_assoc()){
											?>
											<option value="<?php echo $row['流程']; ?>"><?php echo $row['流程']; ?></option>
											<?php			
													}
												}
                                        	?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >备注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input type="text"   />
                                    </div>
                                </div>
                            </form>
                            	<br /><br />
                            	<div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-5" align="center">
                                        <button class="btn btn-primary" id="save" onclick="Save_data()">保存</button>
                                        <button class="btn btn-default" type="button" onclick="window.close()">关闭</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <br /><br /><br /><br />
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

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>
	
<script type="text/javascript">	
	//选择监控描述
	document.getElementById("sel_jkms").addEventListener("change",function(){
		var inp_jkms = document.getElementById("inp_jkms");
		inp_jkms.value = this.value;
	});
	
	//比较日期大小
	function CompareDate(d1,d2){
	  return ((new Date(d1.replace(/-/g,"\/"))) > (new Date(d2.replace(/-/g,"\/"))));
	}
	 
	//保存监控信息
	function Save_data(){
		var ajh = $("#my_form input:eq(0)").attr("value");
		var date_start = $("#my_form input:eq(2)").attr("value");
		var date_end = $("#my_form input:eq(3)").attr("value");
		
		if(ajh != "" && date_start != "" && date_end != ""){
			if(CompareDate(date_end,date_start)){
				var send_data = "";//传输数据
				$("#my_form input").each(function(){
					if($(this).attr("value")){
						send_data += ","+$(this).attr("value");
					}else{
						send_data += ","+"无";
					}
				});
				send_data = send_data.substr(1);
				$.ajax({
					url:"monitor_ajax.php",
					type:"get",
					data:{
						my_flag:"morefile_monitor_save",
						send_data:send_data
					},
					dataType:"json",
					success:function(data){
//						console.log(data);
						if(data["result"]){
							alert(data["msg"]);
							window.close();
						}else{
							alert(data["msg"]);
						}
					},
					error:function(){
						alert("ajax error!+保存失败");
					}
				});
			}else{
				alert("截止时间小于提醒时间");
			}
		}else{
			alert("案卷号、提醒时间、截止时间有空");
		}
	}
	
</script>

</body>
</html>
