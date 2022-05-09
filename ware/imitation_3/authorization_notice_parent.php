<?php
	require'../../AHeader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  			<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>缴费通知</title>
  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <style type="text/css">
  	#costnotice {
  		width: 90%;
  		height: 700px;
  		border: 1px solid #ADADAD;
  	}
  </style>

</head>

<body class="sticky-header" onload="IFrameResize();">

<section>
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12" >
        <section class="panel">
            <header class="panel-heading text-center">
            	缴费通知信息确认
            	&nbsp;&nbsp;
            	<span style="color: blue;" id="num_applicant">0/0个申请人</span>
            	<span class="tools pull-right">
			    	<a class="btn fa fa-power-off" onclick="window.close();">取消本次通知书生成</a>
				</span>
            </header>
            <div class="panel-body text-center">
            	<iframe name="costnotice" id="costnotice" src="" scrolling="yes"></iframe>
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
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<!--<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--费用确认函数-->
<script src="../../js/imitation_3/cost.js"></script>

<script type="text/javascript">
	if(typeof(Storage) !== "undefined"){
		var mes_arr = JSON.parse(localStorage.noticedata);
		var len = mes_arr.length;
		
		localStorage.index = 0;
		$("#costnotice").attr("src","authorization_notice_child.php?index="+localStorage.index);
		localStorage.index = Number(localStorage.index)+1;
		
		$("#num_applicant").html(localStorage.index+'/'+len+"个申请人");
	}else{
		alert("对不起，您的浏览器不支持Web存储")
	}
	
	//下一个
	function NextCost(){
		if(typeof(Storage) !== "undefined"){
			var mes_arr = JSON.parse(localStorage.noticedata);
			var len = mes_arr.length;
			
			$("#costnotice").attr("src","authorization_notice_child.php?index="+localStorage.index);
			localStorage.index = Number(localStorage.index)+1;
			
			$("#num_applicant").html(localStorage.index+'/'+len+"个申请人");
		}else{
			alert("对不起，您的浏览器不支持Web存储")
		}
	}
	
	function IFrameResize(){
        //得到父页面的iframe框架的对象
	    var obj = parent.document.getElementById("costnotice");
        //把当前页面内容的高度动态赋给iframe框架的高
	    obj.height = this.document.body.scrollHeight;
    }
</script>	
</body>
</html>