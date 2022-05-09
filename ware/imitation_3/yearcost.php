<?php 
//require_once '../../update_remind_day.php';//每次登录更新数据库的剩余天数 【弃用，采用mysql的DATEDIFF(b.应缴日期,DATE_FORMAT(NOW(),'%Y-%m-%d'))计算日期】

require'../../AHeader.php'; 
	
$flag = isset($_REQUEST['flag']) ? $_REQUEST['flag']:"none";
$v = isset($_REQUEST['v']) ? $_REQUEST['v'] : 0 ;

?>
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>专利年费管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link href="../../js/data-tables/DT_bootstrap.css" rel="stylesheet" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="../../js/jquery-1.10.2.min.js"></script> 

  <style>
  	.btn2{  
		  background-color:#3E8CD0;  
		  color:white;
		}  
  </style>

</head>

<body class="sticky-header" >

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
		<?php
			//创建左边菜单栏 
			require("../../menu_tree.php"); 
			Create_leftlist(2,2);
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
		        	<header class="panel-heading custom-tab">
	                  <ul class="nav nav-tabs">
	                    <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>待通知(90天内)</a></li>
	                    <li class="about-7"><a href="#about-7" data-toggle="tab"><i class="fa fa-user"></i>待收费</a></li>
	                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>待缴费</a></li>
	                    <!--<li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>待收据</a></li>-->
	                    <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>已完成</a></li>
	                    <li class="about-6"><a href="#about-6" data-toggle="tab"><i class="fa fa-user"></i>监控中</a></li>
	                    <li class="about-5"><a href="#about-5" data-toggle="tab"><i class="fa fa-user"></i>总查询</a></li>
	                  	<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
	                  	<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
	                  </ul>
	                </header>
				<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
					<div class="tab-content">
						<!--待通知-->
						<div class="tab-pane " id="about-1">
		                  <section id="unseen">
			                <div class="form-inline">
				                <div class="form-group">
				                	<label>剩余天数（优先）：</label>
	                                <select class="form-control" id="numbersofday" onchange="ChangeNumberOfDay(this)">
					                	<option>150</option>
					                	<option>120</option>
					                	<option selected="selected">90</option>
					                	<option>60</option>
					                	<option>30</option>
				                	</select>
	                            </div>
	                            <input class="btn btn-primary" type="button" id="" name="" value="合并通知" onclick="send_all('dynamic-table')" />
			                	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table','fee_dtz')">删除本页选中行</button>
			                </div>
			                <br />
			                <div class="form-inline">
			                	<div class="form-group">
				                	<label>申请日(只对月日有效)：</label>
	                                <input class="form-control" type="date" />
	                                &nbsp;至&nbsp;
					                <input class="form-control" type="date" />	
	                            </div>
	                            <button class="btn btn-success" onclick="CheckApplicationDate(this)">查询</button>
			                </div>
			                
			                    <table class="display table table-bordered table-striped" id="dynamic-table">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table')" /></th>
					                  		<th>案卷号</th>
					                  		<th>专利名</th>
					                  		<th class="hidden">id</th>
				                            <th>申请人</th>
				                            <th>申请号</th>
				                            <th>申请日</th>
				                            <th>年度</th>
				                            <th>金额</th>
				                            <th>截止日期</th>
				                            <th>剩余天数</th>
				                            <th>操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	<!--费用的状态等于0，则为正常，为9为已经删除-->
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-01 end-->
		            	
		            	<!--待收费 start-->
		            	<div class="tab-pane" id="about-7">
		                  	<section id="unseen">
			                  	<input class="btn btn-primary" type="button" id="" name="" value="收费" onclick="TollFee('dynamic-table_7')" />
			                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_7','fee_dtz')">删除本页选中行</button> 
			                    <table class="display table table-bordered table-striped" id="dynamic-table_7">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_7')" /></th>
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
				                            <th class="numeric">通知时间</th>
				                            <th class="numeric">通知书</th>
				                            <th class="numeric">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
								</table>
		                	</section>
	            		</div>
		            	<!--待收费 end-->
		            	
		            	<!--待缴费-->
		            	<div class="tab-pane" id="about-2">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并缴费" onclick="fare_all('dynamic-table_2')" />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_2','fee_dtz')">删除本页选中行</button> 
			                    <table class="display table table-bordered table-striped" id="dynamic-table_2">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_2')" /></th>
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
				                            <th class="numeric">通知时间</th>
				                            <th class="numeric">通知书</th>
				                            <th class="numeric">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
							</table>
		                </section>
	            	</div>
	            	<!--tab-02 end-->
	            	<!--待收据-->
	            	<div class="tab-pane" id="about-3">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="合并收据" onclick="shouju_all('dynamic-table_3') " />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_3','fee_dtz')">删除本页选中行</button>
			                    <table class="display table table-bordered table-striped" id="dynamic-table_3">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_3')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric hidden">id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">通知书</th>
				                            <th class="numeric">缴费时间</th>
				                            <th class="numeric">缴费文件</th>
				                            <th class="numeric">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>

									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-03 end-->
		            	<!--已完成-->
		            	<div class="tab-pane" id="about-4">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="更改收据" onclick="shouju_all_2('dynamic-table_4') " />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_4','fee_dtz')">删除本页选中行</button>
		                  	
			                    <table class="display table table-bordered table-striped" id="dynamic-table_4">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_4')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric hidden">id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">通知书</th>
				                            <th class="numeric">缴费时间</th>
				                            <th class="numeric">收据</th>
				                            <th>操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>

									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-04 end-->
		            	<!--总查询-->
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
		            	<!--tab-00 end-->
		            	<div class="tab-pane " id="about-6">
		                  <section id="unseen">
		                  	<input class="btn btn-primary" type="button" id="" name="" value="提前通知" onclick="Info_Befo('dynamic-table_6')" />
		                  	<button class="btn btn-danger" onclick="DeleteAll_tab('dynamic-table_6','fee_dtz')">删除本页选中行</button>
			                    <table class="display table table-bordered table-striped" id="dynamic-table_6">
			                        <thead>
			            				<tr>
		                					<th><input type="checkbox" id="che_all" onclick="selectAll(this,'dynamic-table_6')" /></th>
					                  		<th class="numeric">案卷号</th>
					                  		<th class="numeric">专利名</th>
					                  		<th class="numeric" hidden="hidden" >id</th>
				                            <th class="numeric">申请人</th>
				                            <th class="numeric">申请号</th>
				                            <th class="numeric">申请日</th>
				                            <th class="numeric">年度</th>
				                            <th class="numeric">金额</th>
				                            <th class="numeric">截止日期</th>
				                            <th class="numeric">剩余天数</th>
				                            <th class="numeric">操作</th>
		                    			</tr>
			                        </thead>
			                        <tbody>
			                        	
									</tbody>                   										
							</table>
		                </section>
		            	</div>
		            	<!--tab-06 end-->
		        	</div>
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
		        	<button id="save_add" data-dismiss="modal" class="btn btn-primary" onclick="Save_alterdata()">保存</button>
		          <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
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

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--页面响应函数集-->
<script src="../../js/imitation_3/yearcost.js" ></script>
<!--全选-->
<script src="../../js/page_else.js" ></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<!--<script src="../../js/dynamic-table-6.js"></script>-->
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
		
	    //总查询
	    var datatableoption_5 = JSON.parse(str_json);
		datatableoption_5.sAjaxSource = "yearcost_datajson.php";
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
			{"mData":"应缴日期"},
			{"mData":"计算日期"},
			{"mData":"通知书生成日期"},
			{"mData":"缴费时间"},
			{"mData":"收据上传日期"}
		];
		datatableoption_5.sAjaxDataProp = "data";
	    $('#dynamic-table_5').dataTable(datatableoption_5);
	    $('#dynamic-table_5').attr("style","");
	    
	    //监控中
	    var datatableoption_6 = JSON.parse(str_json);
		datatableoption_6.sAjaxSource = "yearcost_datajson.php";
		datatableoption_6.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetMonitoring"
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
		datatableoption_6.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"应缴日期"},
			{"mData":"计算日期"},
			{"mData":"操作"}
		];
		datatableoption_6.sAjaxDataProp = "data";
	    $('#dynamic-table_6').dataTable(datatableoption_6);
	    $('#dynamic-table_6').attr("style","");
	    
	    //已完成
	    var datatableoption_4 = JSON.parse(str_json);
		datatableoption_4.sAjaxSource = "yearcost_datajson.php";
		datatableoption_4.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetFinish"
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
		datatableoption_4.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"通知书名"},
			{"mData":"缴费时间"},
			{"mData":"文件名"},
			{"mData":"操作"}
		];
		datatableoption_4.sAjaxDataProp = "data";
	    $('#dynamic-table_4').dataTable(datatableoption_4);
	    $('#dynamic-table_4').attr("style","");
	    
	    //待收据
		var datatableoption_3 = JSON.parse(str_json);
		datatableoption_3.sAjaxSource = "yearcost_datajson.php";
		datatableoption_3.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitReceipt"
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
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"通知书名"},
			{"mData":"缴费时间"},
			{"mData":"缴费文件名"},
			{"mData":"操作"}
		];
		datatableoption_3.sAjaxDataProp = "data";
	    $('#dynamic-table_3').dataTable(datatableoption_3);
	    $('#dynamic-table_3').attr("style","");
	    
	    
	    
	    //待缴费
	    var datatableoption_2 = JSON.parse(str_json);
		datatableoption_2.sAjaxSource = "yearcost_datajson.php";
		datatableoption_2.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitPayment"
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
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"应缴日期"},
			{"mData":"计算日期"},
			{"mData":"通知书生成日期"},
			{"mData":"通知书名"},
			{"mData":"操作"}
		];
		datatableoption_2.sAjaxDataProp = "data";
		$('#dynamic-table_2').dataTable(datatableoption_2);
		$('#dynamic-table_2').attr("style","");
		
		//待收费
	    var datatableoption_7 = JSON.parse(str_json);
		datatableoption_7.sAjaxSource = "yearcost_datajson.php";
		datatableoption_7.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitCharge"
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
		datatableoption_7.aoColumns = [
			{"mData":"checkbox","sClass":"center","sWidth":"40px"},
			{"mData":"案卷号"},
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"应缴日期"},
			{"mData":"计算日期"},
			{"mData":"通知书生成日期"},
			{"mData":"通知书名"},
			{"mData":"操作"}
		];
		datatableoption_7.sAjaxDataProp = "data";
		$('#dynamic-table_7').dataTable(datatableoption_7);
		$('#dynamic-table_7').attr("style","");
	    
	    //待通知
		var datatableoption_1 = JSON.parse(str_json);
		datatableoption_1.aaSorting = [[ 10, "asc" ]];//默认排序
		datatableoption_1.sAjaxSource = "yearcost_datajson.php";
		datatableoption_1.fnServerData = function(sSource, aoData, fnCallback, oSettings){
			oSettings.jqXHR = $.ajax( {
        		"dataType": 'json', 
		        "type": "GET", 
		        "url": sSource, 
		        "data": {
		        	"flag":"GetWaitNotice"
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
			{"mData":"专利名称"},
			{"mData":"id","sClass":"hidden"},
			{"mData":"申请人"},
			{"mData":"申请号"},
			{"mData":"申请日"},
			{"mData":"年度"},
			{"mData":"金额"},
			{"mData":"应缴日期"},
			{"mData":"计算日期"},
			{"mData":"操作"}
		];
		datatableoption_1.sAjaxDataProp = "data";
	    Tab = $('#dynamic-table').dataTable(datatableoption_1);
	    $('#dynamic-table').attr("style","");
	    //根据剩余天数显示“待通知”的数据
	    function ChangeNumberOfDay(obj_select){
	    	var datatableoption_1_1 = JSON.parse(str_json);
	    	datatableoption_1_1.aaSorting = [[ 10, "asc" ]];//默认排序
			datatableoption_1_1.sAjaxSource = "yearcost_datajson.php";
			datatableoption_1_1.fnServerData = function(sSource, aoData, fnCallback, oSettings){
				oSettings.jqXHR = $.ajax( {
	        		"dataType": 'json', 
			        "type": "GET", 
			        "url": sSource, 
			        "data": {
			        	"flag":"GetWaitNotice_NumberOfDay",
			        	"numberofday" : $(obj_select).val()
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
			datatableoption_1_1.aoColumns = [
				{"mData":"checkbox","sClass":"center","sWidth":"40px"},
				{"mData":"案卷号","sWidth":"100px"},
				{"mData":"专利名称"},
				{"mData":"id","sClass":"hidden"},
				{"mData":"申请人"},
				{"mData":"申请号","sWidth":"100px"},
				{"mData":"申请日","sWidth":"100px"},
				{"mData":"年度"},
				{"mData":"金额"},
				{"mData":"应缴日期","sWidth":"100px"},
				{"mData":"计算日期","sWidth":"120px"},
				{"mData":"操作"}
			];
			datatableoption_1_1.sAjaxDataProp = "data";
			Tab.fnClearTable();
	    	Tab.fnDestroy();
	    	Tab =  $('#dynamic-table').dataTable(datatableoption_1_1);
	    	$('#dynamic-table').attr("style","");
	    }
	    
	    //申请日筛选
	    function CheckApplicationDate(btn_obj){
	    	var startdate = $(btn_obj).parent().children("div").children("input:eq(0)").val();
	    	var enddate = $(btn_obj).parent().children("div").children("input:eq(1)").val();
	    	var numberofday = $("#numbersofday").val();
//	    	console.log(numberofday);
			if(startdate && enddate){
				var datatableoption_1_1 = JSON.parse(str_json);
		    	datatableoption_1_1.aaSorting = [[ 10, "asc" ]];//默认排序
				datatableoption_1_1.sAjaxSource = "yearcost_datajson.php";
				datatableoption_1_1.fnServerData = function(sSource, aoData, fnCallback, oSettings){
					oSettings.jqXHR = $.ajax( {
		        		"dataType": 'json', 
				        "type": "GET", 
				        "url": sSource, 
				        "data": {
				        	"flag":"GetWaitNotice_ApplicationDate",
				        	"numberofday" : numberofday,
				        	"startdate" : startdate,
				        	"enddate" : enddate
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
				datatableoption_1_1.aoColumns = [
					{"mData":"checkbox","sClass":"center","sWidth":"40px"},
					{"mData":"案卷号","sWidth":"100px"},
					{"mData":"专利名称"},
					{"mData":"id","sClass":"hidden"},
					{"mData":"申请人"},
					{"mData":"申请号","sWidth":"100px"},
					{"mData":"申请日","sWidth":"100px"},
					{"mData":"年度"},
					{"mData":"金额"},
					{"mData":"应缴日期","sWidth":"100px"},
					{"mData":"计算日期","sWidth":"120px"},
					{"mData":"操作"}
				];
				datatableoption_1_1.sAjaxDataProp = "data";
				Tab.fnClearTable();
		    	Tab.fnDestroy();
		    	Tab =  $('#dynamic-table').dataTable(datatableoption_1_1);
		    	$('#dynamic-table').attr("style","");
			}else{
				alert("两个日期都不能为空！")
			}
	    }
	    
	    //设置排序
		$(".checilck > li").click(function(){
			var czyid = $("#czyid").val();
			var aim  = $(this).parent().attr("id");//获取点击的位置的父id
			var text = $(this).html();//获取排序方式
			var Text = text.substr(12,text.length-16);
			var ch = document.getElementsByName(aim)[0].innerHTML;
			$.ajax({
				url:'../../OrderChange.php',
				type:'get',
				async:true,
				data:{
					falg:aim,//判断表格的依据
					order:Text,
					czyid:czyid,
					page:'YEARC'
				},
				success:function(data){
					window.location.reload();
				},
				error:function(){
					alert('false');
				}
			});
		});
//	} );
	
</script>
</body>
</html>
