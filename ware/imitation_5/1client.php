<?php require'../../AHeader.php'; ?>
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

  <title>申请人管理</title>
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
  <style type="text/css">
  	table th{
  		width: 100px;
  		word-wrap: break-word;
  	}
  </style>
  <!--jQuery库文件-->
	<script src="../../js/jquery-1.10.2.min.js"></script> 
	
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../menu_tree.php"); 
				Create_leftlist(3,0);
			?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content">
				
        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <!--<form class="searchform" action="http://view.jqueryfuns.com/2014/4/10/7_df25ceea231ba5f44f0fc060c943cdae/index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>-->
            <!--search end-->

            <!--notification menu start -->
            <?php require'../../MenuMin-2.php';  ?>  
            <!--notification menu end -->

        </div>
        <!-- header section end-->

				<!--body wrapper start :主要内容-->
				<div class="wrapper">
        	<div class="row">
        		<div class="col-sm-12">
        			<section class="panel">
        				<header class="panel-heading">
	            			<strong>申请人信息</strong>
	            			&nbsp;&nbsp;&nbsp;
	            		</header>
	            		
				<div class="panel-body">
				<section id="unseen">
					<input class="btn btn-primary" type="button" onclick="client_new()" value="新建申请人" />
					<label style=" position:absolute ;right: 30px;"><input id="retrieval" type="text" style="box-shadow: none;width: 200px;" aria-controls="dynamic-table"><button id="jianbutton">检索</button></label>

	                <table class="display table table-bordered table-striped " id="dynamic-table">
		                <thead>
		                <tr>
		                    <th class="numeric" style="width:15%;">申请人</th>
		                    <th class="numeric" style="width:5%;">证件号</th>
		                    <th class="numeric" style="width:25%;">默认地址</th>
		                    <th class="numeric" style="width:10%;">邮政编码</th>
		                    <th class="numeric" style="width:10%;">费减年度</th>
		                    <th class="numeric" style="width:20%;">备注</th>
		                    <th class="numeric" <?php if(!($admin == 1||$lcczy == 1)){ ?> style="width:10%;"  hidden="hidden" <?php } ?>  id="khss" >客户所属</th>
		                		<th class="numeric" style="width:5%px;">操作</th>
		                </tr>
		                </thead>
		                <tbody>
		                	
		                </tbody>
		               </table>
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
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>



<!--dynamic table-->
        <script src="../../js/jquery.dataTables.min.js"></script>
        <script src="../../js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="../../js/dataTables.buttons.min.js"></script>
        <script src="../../js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--新建客户  new_client-->
<script type="text/javascript" src="../../js/client.js"></script>
<!--about 常态-->
<!--<script src="../../js/NormalS-2.js"></script>-->
<script type="text/javascript">
	var jianbutton=document.getElementById("jianbutton");
	if($("#khss").attr("hidden")){//有隐藏
	table=$('#dynamic-table').dataTable({
			"aaSorting": [],
			"aoColumnDefs": [{
			        'bSortable': false,
			        'aTargets': []
			    }
			],
			"oLanguage":{
				"oPaginate":{
					"sFirst":"首页",
					"sLast":"尾页",
					"sNext":"下一页",
					"sPrevious":"上一页"
				},
				"sEmptyTable": "无数据！",
				"sLoadingRecords": "加载中...",
				"sProcessing": "加载中...",
				"sSearch": "查询：",
				"sZeroRecords": "没找到符合的数据",
			},
			"sAjaxSource": "table_jsondata.php",
	    "sServerMethod": "GET",
	    "fnServerParams": function ( aoData ) {
	        aoData.push({ "name": "my_flag", "value": "申请人表格信息" });
	    	},
				"sAjaxDataProp": "data",
				"aoColumns":[
					{"mData":"申请人"},
					{"mData":"证件号"},
					{"mData":"地址"},
					{"mData":"邮政编码"},
					{"mData":"费减备案"},
					{"mData":"备注"},
					{"mData":"所属名称","sClass":"hidden"},
					{"mData":"操作"},
				]
		});
		

	}else{//无隐藏
		table=$('#dynamic-table').dataTable({
			"aaSorting": [],
			"aoColumnDefs": [{
			        'bSortable': false,
			        'aTargets': []
			    }
			],
			"oLanguage":{
				"oPaginate":{
					"sFirst":"首页",
					"sLast":"尾页",
					"sNext":"下一页",
					"sPrevious":"上一页"
				},
				"sEmptyTable": "无数据！",
				"sLoadingRecords": "加载中...",
				"sProcessing": "加载中...",
				"sSearch": "查询：",
				"sZeroRecords": "没找到符合的数据",
			},
			"sAjaxSource": "table_jsondata.php",
	    "sServerMethod": "GET",
	    "fnServerParams": function ( aoData ) {
	        aoData.push({ "name": "my_flag", "value": "申请人表格信息" });
	    	},
				"sAjaxDataProp": "data",
				"aoColumns":[
					{"mData":"申请人"},
					{"mData":"证件号"},
					{"mData":"地址"},
					{"mData":"邮政编码"},
					{"mData":"费减备案"},
					{"mData":"备注"},
					{"mData":"所属名称"},
					{"mData":"操作"},
				]

		});		
		
	 }
	 
	 jianbutton.onclick=function(){
	 	table.fnClearTable();
		table.fnDestroy();
		$('#dynamic-table').attr("style","");
		
		var jiansuo=document.getElementById("retrieval").value;
		
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
	  datatableoption.sAjaxSource = "jiansuo_jsondata.php";
		datatableoption.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"my_flag":"jiansuo",
		        	"jiansuo":jiansuo
		        },
		        "success": function(data){
		        	console.log(data);
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
					{"mData":"申请人"},
					{"mData":"证件号"},
					{"mData":"地址"},
					{"mData":"邮政编码"},
					{"mData":"费减备案"},
					{"mData":"备注"},
					{"mData":"所属名称"},
					{"mData":"操作"},
				];
		datatableoption.sAjaxDataProp = "data";
		
		table=$('#dynamic-table').dataTable(datatableoption)
	 	
//		table=$('#dynamic-table').dataTable({
//			"aaSorting": [],
//			"aoColumnDefs": [{
//			        'bSortable': false,
//			        'aTargets': []
//			    }
//			],
//			"oLanguage":{
//				"oPaginate":{
//					"sFirst":"首页",
//					"sLast":"尾页",
//					"sNext":"下一页",
//					"sPrevious":"上一页"
//				},
//				"sEmptyTable": "无数据！",
//				"sLoadingRecords": "加载中...",
//				"sProcessing": "加载中...",
//				"sSearch": "查询：",
//				"sZeroRecords": "没找到符合的数据",
//			},
//			"sAjaxSource": "table_jsondata.php",
//	    "sServerMethod": "GET",
//	    "fnServerParams": function ( aoData ) {
//	        aoData.push({ "name": "my_flag", "value": "jiansuo" },{"name": "jiansuo", "value": jiansuo });
//	    	},
//				"sAjaxDataProp": "data",
//				"aoColumns":[
//					{"mData":"申请人"},
//					{"mData":"证件号"},
//					{"mData":"地址"},
//					{"mData":"邮政编码"},
//					{"mData":"费减备案"},
//					{"mData":"备注"},
//					{"mData":"所属名称"},
//					{"mData":"操作"},
//				]
//		});			 	
	 }	


//				jianbutton.onclick=function(){
//					var jiansuo=document.getElementById("retrieval").value;
////					alert(jiansuo);
//					var urlLoad = 'jiansuo_jsondata.php?jiansuo='+jiansuo
////					console.log('zlxt/ware/imitation_5/jiansuo_jsondata.php?jiansuo='+jiansuo )
////					table.ajax.url('jiansuo_jsondata.php').load();
//						console.log(table.ajax)
//				}	

</script>
</body>
</html>
