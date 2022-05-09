<?php 
	require'../../AHeader.php'; 
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

  <title>专利申请费用</title>
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
			Create_leftlist(2,0);
		?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content" >
				
        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

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
        		<header class="panel-heading custom-tab">
                  <ul class="nav nav-tabs">
                  	<!--	待通知，查专案费用查询 通知书状态为0
                  			待缴费，查专案待缴费 费用状态为0
                  			待收据，查专案待缴费  费用状态=2 and 收据上传日期 ='0'
                  			已完成，查费用状态='3'
                  	-->
                  	<!--	专案待缴费的费用状态，专案费用查询的费用状态，专案需交费用的状态为相同的东西
                  			其中，0为新建状态，2为已经缴费状态，3为已经收据状态【即已完成状态】
                  	-->
                  	<li class="about-3 active"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>待收费</a></li>
                    <li class="about-0"><a href="#about-0" data-toggle="tab"><i class="fa fa-user"></i>待缴费</a></li>
                    <!--<li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>待收据</a></li>-->
                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
                    <li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>总查询</a></li>
                  	<!--<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />-->
                  </ul>
                </header>
                <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
					<div class="tab-content">
					
					<!--待收费 start-->
		            <div class="tab-pane active" id="about-3">
	                  	<section id="unseen">
		                	<input class="btn btn-primary" type="button" id="" name="" value="收费" onclick="TollFee('dynamic-table_3')" />
		                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_3','delete_djf','cost_del.php')">删除选中的行</button>
			                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_3" onclick="selectAll(this,'dynamic-table_3')" /></th>
		                					<th>案卷号</th>
		                					<th>专利名称</th>
		                					<th>申请号</th>
		                					<th>申请日</th>
		                					<th>申请人</th>
		                					<!--<th class="hidden">id</th>-->
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>截止日期</th>
		                					<th>剩余天数</th>
		                					<th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
							</table>
	                	</section>
	            	</div>
		            <!--待收费 end-->
						
	            	<!--待缴费 start-->
	            	<div class="tab-pane" id="about-0">
	                  	<section id="unseen">
		                	<input class="btn btn-primary" type="button" id="" name="" value="合并缴费" onclick="fare_all('dynamic-table')" />
		                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table','delete_djf','cost_del.php')">删除选中的行</button>
			                    <table class="display table table-bordered table-striped" id="dynamic-table">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table')" /></th>
		                					<th>案卷号</th>
		                					<th>专利名称</th>
		                					<th>申请号</th>
		                					<th>申请日</th>
		                					<th>申请人</th>
		                					<!--<th class="hidden">id</th>-->
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>截止日期</th>
		                					<th>剩余天数</th>
		                					<th style="width: 100px;">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
							</table>
	                	</section>
	            	</div>
		            <!--待缴费 end-->
		            
	            	<!--待收据 start-->
	            	<div class="tab-pane" id="about-1">
	                  	<section id="unseen">
		                	<input class="btn btn-primary" type="button" id="" name="" value="合并收据" onclick="shouju_all('dynamic-table_1') " />
		                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_1','delete_djf','cost_del.php')">删除选中的行</button>
			                    <table class="display table table-bordered table-striped" id="dynamic-table_1">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_1" onclick="selectAll(this,'dynamic-table_1')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th hidden="hidden">id</th>
		                					<th>费用种类</th>
		                					<th>缴费金额</th>
		                					<th>缴费日期</th>
		                					<th>申请人</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                					<th>缴费文件</th>
		                					<th>操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>
							</table>
	                	</section>
	            	</div>
		            <!--待收据 end-->
		            
		            <!--已完成 start-->
		            <div class="tab-pane" id="about-2">
		                  <section id="unseen">
		                  		<input class="btn btn-primary" type="button" id="" name="" value="更改收据" onclick="shouju_all_2('dynamic-table_2') " />
			                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all_2" onclick="selectAll(this,'dynamic-table_2')" /></th>
		                					<th>案卷号</th>
		                					<th>申请号</th>
		                					<th>id</th>
		                					<th>缴费时间</th>
		                					<th>申请人</th>
		                					<th>费用种类</th>
		                					<th>申请日</th>
		                					<th>专利名称</th>
		                					<th>收据</th>
		                					<!--<th>操作</th>-->
				                    	</tr>
			                        </thead>
			                        <tbody>
			                      	
									</tbody>                   										
							</table>
		                </section>
	            	</div>
		            <!--已完成 end-->
		            
		            <!--总查询start================================================================================-->
		             <div class="tab-pane " id="about-5">
		                  	<section id="unseen">
			                  	<table class="#" id="table_date" hidden="hidden">
							        <tr>
							        	<th style="width:200px;">剩余天数：</th>
							        	<td><input style="width:200px;" type="text" list="distance" id="disd" onchange="showtabinfo(this.id)" value="<?php if($flag == 'disd'){echo $v;} ?>" />
							        		<datalist id="distance">
							        		<option></option>
							        		<option>3</option>
							        		<option>5</option>
							        		<option>10</option>
							        		<option>20</option>
							        		<option>30</option>
							        		<option>330</option>
							        		<option>360</option>
							        	</datalist></td>
							        	<th style="width:200px;">已过期：</th>
						        		<td><input  style="width:200px;" type="text" list="overdue" id="over" onchange="showtabinfo(this.id)" value="<?php if($flag == 'over'){echo $v;} ?>" />
							        		<datalist id="overdue">
							        		<option></option>
							        		<option>10</option>
							        		<option>15</option>
							        		<option>20</option>
							        		<option>30</option>
							        		<option>120</option>
							        		<option>150</option>
							        		<option>180</option>
							        	</overdue></td>
							        	<!--显示数据类型-->
							        	<!--<td><input  style="width:200px;" type="text" id="type_name" value="<?php echo $flag; ?>" /></td>-->
							        	<!--显示数据参数-->
							        	<!--<td><input  style="width:200px;" type="text" id="type_info" value="<?php echo $v; ?>" /></td>-->
							        </tr>
								</table>
			                    <table class="display table table-bordered table-striped" id="dynamic-table_5">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_5')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric hidden">id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">截止日期</th>
				                            <th class="numeric">剩余天数</th>
				                            <th class="numeric">通知状态</th>
				                            <th class="numeric">缴费状态</th>
				                            <th class="numeric">收据状态</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            
		            <!--总查询end-================================================================================-->
		            
		        	</div>
	        	</div>
				   </section>   
        	</div>
        </div>
        </div>		
				<!--body wrapper end-->

    </div>
    
    <!--修改费用模态框 start-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">费用修改</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form">
							<input type="text" id="cost_id" hidden="hidden" value="" />
					 		<div class="form-group">
            		<label class="control-label col-md-4">费用：</label>
                	<div class="col-md-6 col-xs-11">
                		<input class="form-control form-control-inline input-medium" id="cost_value"  type="text"  />
                	</div>
            	</div>
						</form>
		        <div class="modal-footer" align="center">
		        	<button id="save_add" name="" data-dismiss="modal" class="btn btn-primary" onclick="Save_alterdata(this)">保存</button>
		          <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
		        </div>
		      </div>
        </div>
    	</div>
    </div>
    <!--修改费用模态框 end-->
    
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->

<!--本页响应-->
<script src="../../js/imitation_3/cost_application.js" ></script>
<!--全选-->
<script src="../../js/page_else.js" ></script>


<!--页面响应-->
<!--<script src="../../js/imitation_3/cost.js" ></script>-->
<!--删除费用操作-->
<!--<script src="../../js/fare_del.js"></script>-->
<!--about 常态-->
<!--<script src="../../js/NormalS-2.js"></script>-->
<!--<script src="../../js/dynamic-table-6.js"></script>-->
<!--<script src="../../js/imitation_3/Cost_Main.js"></script>-->

<script type="text/javascript">
	//如果不是“流程操作员”则屏蔽所有的按钮操作
	<?php
		if(!$lcczy == "1"){
	?>
		$(".btn").attr("disabled",true);
	<?php		
		}
	?>
//	$(document).ready(function() {
	
	
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
	    
	    
	    //待收费
		var datatableoption_3 = JSON.parse(str_json);
		datatableoption_3.sAjaxSource = "cost_datajson.php";
		datatableoption_3.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitCharge_application"
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
		datatableoption_3.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称","sWidth":"200px"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"申请人","sWidth":"200px"},
//			{"mData":"id","sClass":"hidden"},
			{"mData":"费用名称"},
			{"mData":"金额"},
			{"mData":"缴费期限"},
			{"mData":"计算日期"},
			{"mData":"操作","sWidth":"150px"}
		];
		datatableoption_3.sAjaxDataProp = "data";
	    Tab_3 =  $('#dynamic-table_3').dataTable(datatableoption_3);
	    $('#dynamic-table_3').attr("style","");
	    //刷新表格
	    function Refresh_DynmicTable_3(){
	    	Tab_3.fnClearTable();
	    	Tab_3.fnDestroy();
	    	Tab_3 =  $('#dynamic-table_3').dataTable(datatableoption_3);
	    	$('#dynamic-table_3').attr("style","");
	    }
	    
	    
		//待缴费
		var datatableoption = JSON.parse(str_json);
		datatableoption.sAjaxSource = "cost_datajson.php";
		datatableoption.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitPayment_application"
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
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称","sWidth":"200px"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"申请人","sWidth":"200px"},
//			{"mData":"id","sClass":"hidden"},
			{"mData":"费用名称"},
			{"mData":"金额"},
			{"mData":"缴费期限"},
			{"mData":"计算日期"},
			{"mData":"操作","sWidth":"150px"}
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
	    
	    //待收据
	    var datatableoption_1 = JSON.parse(str_json);
		datatableoption_1.sAjaxSource = "cost_datajson.php";
		datatableoption_1.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitReceipt_application"
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
		datatableoption_1.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"申请号","sWidth":"100px"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"费用名称"},
			{"mData":"金额"},
			{"mData":"缴费时间"},
			{"mData":"申请人"},
			{"mData":"申请日"},
			{"mData":"专利名称"},
			{"mData":"缴费文件名"},
			{"mData":"操作"}
		];
		datatableoption_1.sAjaxDataProp = "data";
	    Tab_1 = $('#dynamic-table_1').dataTable(datatableoption_1);
	    $('#dynamic-table_1').attr("style","");
	    //刷新表格
	    function Refresh_DynmicTable_1(){
	    	Tab_1.fnClearTable();
	    	Tab_1.fnDestroy();
	    	Tab_1 =  $('#dynamic-table_1').dataTable(datatableoption_1);
	    	$('#dynamic-table_1').attr("style","");
	    }
	    
	    //已完成
	    var datatableoption_2 = JSON.parse(str_json);
		datatableoption_2.sAjaxSource = "cost_datajson.php";
		datatableoption_2.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetFinish_application"
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
		datatableoption_2.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"申请号"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"缴费时间"},
			{"mData":"申请人"},
			{"mData":"费用名称"},
			{"mData":"申请日"},
			{"mData":"专利名称"},
			{"mData":"操作"}
		];
		Tab_2 = datatableoption_2.sAjaxDataProp = "data";
		$('#dynamic-table_2').dataTable(datatableoption_2);
		//刷新表格
	    function Refresh_DynmicTable_2(){
	    	Tab_2.fnClearTable();
	    	Tab_2.fnDestroy();
	    	Tab_2 =  $('#dynamic-table_2').dataTable(datatableoption_2);
	    	$('#dynamic-table_2').attr("style","");
	    }
		
	    
	    //设置排序
		$(".checilck > li").click(function(){
			var czyid = $("#czyid").val();
			var aim  = $(this).parent().attr("id");//获取点击的位置的父id
			var text = $(this).html();//获取排序方式
			var Text = text.substr(12,text.length-16);
			var ch = document.getElementsByName(aim)[0].innerHTML;
	//		alert(ch);
			$.ajax({
				url:'../../OrderChange.php',
				type:'get',
				async:true,
				data:{
					falg:aim,//判断表格的依据
					order:Text,
					czyid:czyid,
					page:'ZLCost'
				},
				success:function(data){
					window.location.reload();
				},
				error:function(){
					alert('false');
				}
			});
		});
	   
//	});
	
	
//	总查询开始================================================================================-->

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
	    var str_json1 = JSON.stringify(datatableoption);

	 var datatableoption_5 = JSON.parse(str_json1);
		datatableoption_5.sAjaxSource = "cost_datajson.php";
		datatableoption_5.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetTotalCheck"
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
		datatableoption_5.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"缴费期限"},
			{"mData":"计算日期"},
			{"mData":"通知书生成日期"},
			{"mData":"缴费时间"},
			{"mData":"收据上传日期"}
		];
		datatableoption_5.sAjaxDataProp = "data";
	    $('#dynamic-table_5').dataTable(datatableoption_5);
	    $('#dynamic-table_5').attr("style","");
//	总查询结束================================================================================-->
</script>
		
</body>
</html>
