<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="refresh" content="20" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>近十天内上传记录</title>
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
		/*table th {
			width: 150px;
			word-break: break-word;
		}*/
	</style>
</head>

<body class="sticky-header" >

<section>
    <!--body wrapper start-->
    <div class="wrapper">
    <div class="row">
    <div class="col-sm-12" >
    <section class="panel">
    	<header class="panel-heading custom-tab">
			<span class="tools pull-right">
			  <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
			  <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
			  <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
			</span>
	      	<ul class="nav nav-tabs">
		        <li><a href="acceptance.php"><i class="fa fa-user"></i>受理文件</a></li>
		        <li><a href="authorization.php"><i class="fa fa-user"></i>授权文件</a></li>
		        <li><a href="payment.php"><i class="fa fa-user"></i>缴费通知文件</a></li>
		        <li><a href="terminate.php" ><i class="fa fa-user"></i>权利终止文件</a></li>
		        <li><a href="other.php" ><i class="fa fa-user"></i>其他文件</a></li>
				<li class="#"><a href="certificate.php" ><i class="fa fa-user"></i>专利证书</a></li>
		        <li class="active"><a href="#about-1" data-toggle="tab" ><i class="fa fa-user"></i>近十天内上传记录</a></li>
	      	</ul>
		</header>
        <div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane active" id="about-1">
        	<section id="unseen">
							<table class="display table table-bordered table-striped" id="dynamic-table">
			        	<thead>
			        		<tr>
			        			<th>案卷号</th>
			        			<th>专利名称</th>
			        			<th>通知书名称</th>
			        			<th>文件名称</th>
			        			<th>上传时间</th>
			        			<th>案件分类</th>
					        </tr>
			        	</thead>
				        <tbody id="tab_info">
				        	
				        </tbody>
							</table>
        	</section>
    		</div>
            	<!--受理书 end-->
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
<!--<script src="../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>

<script type="text/javascript">
	var datatableoption = {
    	"oLanguage": {//四个部件的语言设置
        	"oPaginate": {
	        	"sFirst": "首页",
	          "sPrevious": "上一页",
	          "sNext": "下一页",
		        "sLast": "末页"
			    },
			    "sLengthMenu": "_MENU_ 行/页",
			    "sInfo": "本页显示 _START_ 到 _END_ 行 共 _TOTAL_ 行",
	        "sSearch": "查找：",
	        "sEmptyTable": "无数据！",
	        "sInfoEmpty": "本页显示 0 到 0 行 共 0 行",
	        "sLoadingRecords": "加载中...",
	        "sProcessing": "处理中...",
	        "sInfoFiltered": "(在 _MAX_ 行中没有找到相应行)",
			"sZeroRecords": "没有找到相应数据！",
        },
    	"aLengthMenu": [
    		[5, 10, 15, 20,30,100],
    		[5, 10, 15, 20,30,100] // change per page values here
		],
		"iDisplayLength": 10,
		"sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
		"sPaginationType": "bootstrap",//编页码类型
		"aaSorting": [],
		"aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
        }]
	}
	var str_json = JSON.stringify(datatableoption);

	//历史记录
		var datatableoption = JSON.parse(str_json);
		datatableoption.sAjaxSource = "table_ajaxdata.php";
		datatableoption.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetUpFilesHistoryData"
		        },
		        "success": function(data){
//		        	console.log(data);
		        	if (!data.state ) {
						oSettings.oApi._fnLog( oSettings, 0, data.message );
					}
					$(oSettings.oInstance).trigger('xhr', [oSettings, data]);
					fnCallback(data);
		        },
		        error: function(x,s,t){
		        	alert("加载数据失败");
		        	console.log("ajax error! "+s+": "+t);
		        }
        	});
		}
		datatableoption.aoColumns = [
			{"mData":"案卷号"},
			{"mData":"专利名称"},
			{"mData":"通知书名称"},
			{"mData":"文件名称"},
			{"mData":"上传时间"},
			{"mData":"案件分类"}
		];
		datatableoption.sAjaxDataProp = "data";
	    Tab =  $('#dynamic-table').dataTable(datatableoption);
	    $('#dynamic-table').attr("style","");
	    //刷新表格
	    function Refresh_DynmicTable(){
	    	Tab.fnClearTable();
	    	Tab.fnDestroy();
	    	Tab =  $('#dynamic-table').dataTable(datatableoption);
	    	$('#dynamic-table').attr("style","");
	    }
</script>

</body>
</html>