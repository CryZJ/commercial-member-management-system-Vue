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

  <title>欠费记录详情</title>
  
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
		<input id="myid" hidden="hidden" value="<?php echo $_GET['id']; ?>" />
		<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading">
            	欠费记录修改
            	<span class="tools pull-right">
						    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
						    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
							</span>
            </header>
            <div class="panel-body" id="SA">
              		<form action="#" class="form-horizontal " id="my_form">
										<div class="form-group">
	                    <label class="control-label col-md-2 col-xs-2">客户名称：</label>
	                    <div class="col-md-4 col-xs-8">
	                        <input id="kh" class="form-control form-control-inline input-medium"   type="text" onclick="select_kh(this.id)" readonly="readonly" />
	                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">项目内容：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" placeholder="费用明细" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">总收费：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" onkeyup="value=value.replace(/[^-?\d*\.?\d]/g,'')" placeholder="请输入数字"  />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">规费：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" onkeyup="value=value.replace(/[^-?\d*\.?\d]/g,'')" placeholder="请输入数字"  />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">管理费：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" onkeyup="value=value.replace(/[^-?\d*\.?\d]/g,'')" placeholder="请输入数字"  />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">税费：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" onkeyup="value=value.replace(/[^-?\d*\.?\d]/g,'')" placeholder="请输入数字" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">收费方式：</label>
		                    <div class="col-md-4 col-xs-8">
		                    	<input class="form-control form-control-inline input-medium" id="payway_inp"   type="text"  />
		                    	<!--<select id="payway">
		                    		<option value="现金">现金</option>
		                    		<option value="银行">银行</option>
		                    	</select>
		                    	<input type="text" id="payway_inp" value="现金" hidden="hidden" />-->
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">收费日期：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium" type="date" value="<?php echo date("Y-m-d"); ?>" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">案源人：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input id="ayr" class="form-control form-control-inline input-medium"   type="text" onclick="select_ayr(this.id)" readonly="readonly" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">代理人：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input id="dlr" class="form-control form-control-inline input-medium"   type="text" onclick="select_dlr(this.id)" readonly="readonly" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2 col-xs-2">备注：</label>
		                    <div class="col-md-4 col-xs-8">
		                        <input class="form-control form-control-inline input-medium"   type="text" />
		                    </div>
		                </div>
					 				</form>
                	<div class="modal-footer" align="center">
                		<button id="save_add" class="btn btn-primary" type="button">修改</button>
                    <button class="btn btn-primary" type="button" onclick="window.close();">关闭</button>
           				</div>
           	</div>
       	</section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
    </div>
    <!-- main content end-->
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
	var myid = document.getElementById("myid").value;
	$.ajax({
		type:"post",
		url:"check_qf_ajax.php",
		async:true,
		data:{
			my_flag:"getdata",
			myid:myid
		},
		dataType:"json",
		success: function(data){
//			alert(data['sql']);
			var inp = document.getElementById("my_form").getElementsByTagName("input");
			for(i=0;i<data.length;i++){
				inp[i].value = data[i];
			}
		},
		error: function(){
			alert("ajax error!");
		}
	});
	//添加收入记录保存
	var save_add = document.getElementById("save_add");
	save_add.addEventListener("click",function(){
		var inp = document.getElementById("my_form").getElementsByTagName("input");//获取input
		var arr_data = new Array();
		for(i=0;i<inp.length;i++){	//获取value
				arr_data[i] = inp[i].value;
		}
		$.ajax({
				data:{
					my_flag:"save_pay",
					arr_send:arr_data,
					myid:myid
				},
				type:"post",
				url:"check_qf_ajax.php",
				async:true,
	//			dataType:"json",
				success:function(data){
					alert(data);
					if(data =="修改成功"){
						window.close();
					}
				},
				error:function(){
					alert("ajax error! + 保存失败！");
				}
		});
	});
	
//选择客户名称
function select_kh(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 1000;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_sqr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.sqr_name){
					$("#"+id).attr("value",localStorage.sqr_name);
					localStorage.clear();
				}else{
					alert("未选中客户！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择代理人
function select_dlr(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					$("#"+id).attr("value",localStorage.dlr_name);
					localStorage.clear();
				}else{
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}

//选择案源人
function select_ayr(id){
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					$("#"+id).attr("value",localStorage.ayr_name);
					localStorage.clear();
				}else{
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
</script>
</body>
</html>