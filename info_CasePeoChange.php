<?php require'AHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  	  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="images/output/logo.ico"/>

  <title>专案-批量修改案源人代理人</title>

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />

</head>
<body class="sticky-header" >
<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
	        <div class="col-sm-12">
		        <section class="panel">
					<header class="panel-heading">
						<span>批量修改案源人</span>
						<span class="tools pull-right">
						    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
						</span>
					</header>
					<input id="TypeN" value="<?php echo $TypeN; ?>" hidden="hidden" />
			    	<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
						<table class="table table-bordered table-striped table-condensed" id="tab_A" >
							<tr>
								<th>原案源人</th>
								<th>新案源人</th>
								<th>操作</th>
							</tr>
							<tr>
								<th><input type="text" name="" id="" value="" readonly="readonly" onclick="select_ayr(this)" /></th>
								<th><input type="text" name="" id="" value="" readonly="readonly" onclick="select_ayr(this)" /></td>
								<th><button class="btn btn-success" onclick="save_data('A')">保存</button></th>
							</tr>
						</table>
			        </div>
			    </section>
		    </div>
		    <div class="col-sm-12">
		        <section class="panel">
					<header class="panel-heading">
						<span>批量修改代理人</span>
					</header>
					<input id="TypeN" value="<?php echo $TypeN; ?>" hidden="hidden" />
			    	<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
						<table class="table table-bordered table-striped table-condensed" id="tab_B" >
							<tr>
								<th>原代理人</th>
								<th>新代理人</th>
								<th>操作</th>
							</tr>
							<tr>
								<th><input type="text" name="" id="" value="" readonly="readonly" onclick="select_dlr(this)" /></th>
								<th><input type="text" name="" id="" value="" readonly="readonly" onclick="select_dlr(this)" /></th>
								<th><button class="btn btn-success" onclick="save_data('B')">保存</button></th>
							</tr>
						</table>
			        </div>
			    </section>
		    </div>
        </div>
        </div>
        </div>
        <!--body wrapper end-->

    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script>
	//检索案源人
	function select_ayr(obj){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 800;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("select_ayr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.ayr_name){
						$(obj).attr("value",localStorage.ayr_name);
						$(obj).attr("id",localStorage.ayr_id);
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
	//检索代理人
	function select_dlr(obj){
		
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 800;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("select_dlr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.dlr_name){
						$(obj).attr("value",localStorage.dlr_name);
						$(obj).attr("id",localStorage.dlr_id);
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
	//保存修改【还未修改表.专案可见】
	function save_data(FG){
		var OldName = '';
		var NewName = '';
		switch(FG){
			case 'A':
				var tab = document.getElementById("tab_A");
				var falg = 'ayr';
				var Ask = '案源人';
			break;
			case 'B':
				var tab = document.getElementById("tab_B");
				var falg = 'dlr';
				var Ask = '代理人';
			break;
			default:break;
		}
		var Input = tab.getElementsByTagName('input');
		var OldName = Input[0].value;
		var NewName = Input[1].value;
		var CheT = confirm('是否将【'+Ask+'.'+OldName+'】批量修改为【'+Ask+'.'+NewName+'】');
		if(CheT){
			$.ajax({
				type:"get",
				url:"info_CasePeoChange_save.php",
				async:true,
				data:{
					falg:falg,
					OldName:OldName,
					NewName:NewName
				},
				success:function(data){
					alert(data);
					Input[0].value = Input[1].value = '';
				},
				error:function(e,t,s){
					alert(e);
				}
			});
		}
	}
</script>

</body>
</html>