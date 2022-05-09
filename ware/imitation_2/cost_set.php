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

  <title>OA办公-邮件收发</title>
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

<body>

	<?php 
		$id = $_GET['id'];
		$filename = ''; 
		require("../../conn.php");
		$ajh = "";
		$conn->close();
	?>
	<div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel" style="height: auto;">
                    <header class="panel-heading">
                    	<h3>费用信息填写</h3>
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal adminex-form" id="my_form" >
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >案卷号&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input type="text" value="<?php echo $ajh; ?>" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">费用名称：</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3" >金额&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                                        <input  type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">提醒时间：</label>
                                        <input class="default-date-picker" readonly type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                    	<label class="col-lg-3">截止时间：</label>
                                        <input class="default-date-picker" readonly type="text" />
                                    </div>
                                </div>
                            </form>
                            	<br /><br />
                             	<div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-5" align="center">
                                        <button class="btn btn-primary" type="submit" id="save">保存</button>
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
	var save = document.getElementById("save");
	var my_form = document.getElementById("my_form");
	
	save.addEventListener("click",function(){
		var inp_form = my_form.getElementsByTagName("input");
		var arr_data = new Array();
		for(i=0;i<inp_form.length;i++){
			arr_data[i] = inp_form[i].value;
		}
		$.ajax({
			data:{
				my_flag:"save_cost",
				arr_send:arr_data
			},
			type:"post",
			url:"cost_set_ajax.php",
			async:true,
			dataType:"json",
			success:function(data){
				alert(data.result);
				window.close();
			},
			error:function(){
				alert("ajax error! + 保存失败！");
			}
		});
		
		
	});
</script>

</body>
</html>
