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

  <title>专利办公管理系统</title><!--案件总览-->
  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <style type="text/css">
  	input {
  		zoom: 120%;
  	}
  </style>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="js/jquery-1.10.2.min.js"></script>

</head>

<body class="sticky-header">
<!--<body class="sticky-header" onload="show_remind()">-->
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("menu_tree.php"); 
				Create_leftlist(0,0);
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
            <?php require'MenuMin.php'; ?> 
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <!--body wrapper start-->
    	<div class="wrapper" >
    		<div class="row" >
        	<div class="col-lg-12">
        		<section class="panel">
        			<header class="panel-heading custom-tab">
		              <ul class="nav nav-tabs">
		              	<!--在此处的li样式中添加active-->
		                <li class="about-1 active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>案件总览</a></li>
		                <li class="about-2"><a href="index_b.php"><i class="fa fa-user"></i>申请案件</a></li><!--原名：专利案件-->
		                <li class="about-4"><a href="index_c.php"><i class="fa fa-user"></i>年费案件</a></li>
		                <li class="about-3"><a href="index_d.php"><i class="fa fa-user"></i>其他案件</a></li><!--原复审案件-->
		                <li class="about-5"><a href="index_e.php"><i class="fa fa-user"></i>案件统计</a></li>
		                <?php
		                	if($admin == 1){
		                ?>
		                <li class="about-6"><a href="index_f.php"><i class="fa fa-user"></i>失败案件</a></li>
		                <?php
		                	}
		                ?>
		                <input id="czyid" value="<?php echo $userid; ?>" hidden="hidden" />
		                <input id="NORS"  hidden="hidden" value="<?php echo $normal; ?>" />
		              </ul>
           			</header>
           	<div class="panel-body">
        	<div class="tab-content">
        		<!--案件总览-->
							<div class="tab-pane active" id="about-1">
                  <section id="unseen">
                  	<div>
												<?php
													if($admin==1||$lcczy==1){
												?>
													<a href="advice_handle/morefile_upload.html" target="_blank"><button class="btn btn-primary" type="button">文件批量导入</button></a>
													<button class="btn btn-primary" onclick="Export_someExcel_2('dynamic-table_2','phpexcel/my_test/wx_export_some.php')">导出选中行Excel清单</button>
													<a href="phpexcel/my_test/wx_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
													<button class="btn btn-primary" onclick="ChangeCaseOwnMes()">批量修改案源人代理人</button>
												<?php
													}
												?>
		            
	                <!-- 查询条件 start -->
	                  <br /><br />
	                	<form action="#" method="post">
	 										<table class="table table-condensed">
	 											<tr>
	 												<td>专利类型：</td>
	 												<td>
	 													<select name="checkdata[]">
	 														<option></option>
	 														<option>发明专利</option>
	 														<option>实用新型</option>
	 														<option>外观设计</option>
	 													</select>
	 												</td>
	 												<td>当前程序：</td>
	 												<td>
	 													<select name="checkdata[]">
	 														<option></option>
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
	 													</select>
	 												</td>	 												 											
	 												<td>案源人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="checkdata[]" id="check_ayr" onclick="select_ayr(this.id)" readonly="readonly" /></td>
	 												<td>代理人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="checkdata[]" id="check_dlr" onclick="select_dlr(this.id)" readonly="readonly" /></td>	 												 											
	 												<td>起始申请日：</td>
	 												<td><input type="date" style="height: 20px; width: 100px;font-size: 5px;" name="checkdata[]" /></td>
	 												<td>截止申请日：</td>
	 												<td><input type="date" style="height: 20px; width: 100px;font-size: 5px;" name="checkdata[]"/></td>
	 												<td style="text-align: right;"><input style="height: 20px;" type="submit" value="查询" /></td>
	 											</tr>
	 										</table>               		
	                	</form>
	                	<?php 
	                	if($_SERVER["REQUEST_METHOD"] == "POST"){//检测是否进行查询
	                		$checkdata = $_POST["checkdata"];
//											print_r($checkdata);
											if($checkdata[0]!="" || $checkdata[1]!="" || $checkdata[2]!="" || $checkdata[3]!="" || $checkdata[4]!="" || $checkdata[5]!=""){
										?>
										<input type="text" id="ischecked" value="有查询信息" hidden="hidden" />
										<div id="check_data">
										<?php
												foreach($checkdata as $ky){
										?>
											<input type="text" value="<?php echo $ky; ?>" hidden="hidden" />
										<?php			
												}
										?>
										</div>
										<?php		
											}else{
										?>
										<input type="text" id="ischecked" value="没有查询信息" hidden="hidden" />
										<?php
											}
	                	}else{
	                	?>
	                	<input type="text" id="ischecked" value="没有查询信息" hidden="hidden" />
										<?php	
	                	}
	                	?>
	                <!-- 查询条件 end -->
		           </div>		            		
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_2" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input onchange="selectAll('dynamic-table_2',this)" type="checkbox" /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric" style="width: 70px;">类型</th>
			                    <th class="numeric" style="width: 120px;">申请号</th>
			                    <th class="numeric" style="width: 80px;">申请日</th>
			                    <th class="numeric" >申请人</th>
			                    <th class="numeric" >专利名称</th>
			                    <th class="numeric" style="width: 70px;">案源人</th>
			                    <th class="numeric" style="width: 70px;">代理人</th>
			                    <th class="numeric" style="width: 70px;">当前程序</th>
			                    <th class="numeric" style="width: 70px;">案件类型</th>
			                    <th class="numeric" style="width: 80px;">原案卷号</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                            
                  		</tbody>
                 		</table>
                </section>
           	</div>
           	<!--案件总览 end-->
		        
	        	</div>
	        	</div>
				    </section> 

        </section>
        </div>
        <!--body wrapper end-->
    <!--结案模块-->
    <!--专利案件-->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">专利案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select class="form-control form-control-inline input-medium" id="reason_za">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_za" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--无效案件-->
    <div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">无效案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_wx" class="form-control form-control-inline input-medium">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_wx" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_2')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--复审案件-->
    <div class="modal fade" id="addModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">复审案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_fs" class="form-control form-control-inline input-medium">
                			<option selected="selected" value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_fs" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_3')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
    <!--年费案件-->
    <div class="modal fade" id="addModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">年费案件结案原因填写</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form">
							<div class="form-group">
                <label class="control-label col-md-4">结案原因：</label>
                <div class="col-md-6 col-xs-11">
                		<select id="reason_nf" class="form-control form-control-inline input-medium">
                			<option  value=""></option>
                			<option  value="撤回重报">撤回重报</option>
                			<option  value="客户放弃">客户放弃</option>
                			<option  value="被驳回">被驳回</option>
                			<option  value="被无效">被无效</option>
                			<option  value="期限届满">期限届满</option>
                			<option  value="错误提交">错误提交</option>
                		</select>
                    <!--<input id="reason_nf" class="form-control form-control-inline input-medium" type="text"   />-->
                </div>
            	</div>
            </div>
			      <div class="modal-footer" align="center">
			    		<button id="save_one" class="btn btn-primary" type="button" onclick="jiean('dynamic-table_4')">保存</button>
			        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
			    	</div>
       		</div>
				</div>
			</div>
    </div>
		<!--结案模块 end-->

    </div>
    </div>
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<!--<script src="js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script src="js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--结案，恢复，删除-->
<script src="js/index_action.js"></script>

<script type="text/javascript">
	//批量修改案源人代理人
	function ChangeCaseOwnMes(){
		window.open('info_CasePeoChange.php','_blank',"",false);
//		alert('ok');
	}
//全选
function selectAll(tab,self_doc){
	var tab = document.getElementById(tab);
	var tablen = tab.rows.length;
	for(var i=1;i<tablen;i++){
//		var che = tab.rows[i].cells[0].getElementsByTagName("input")[0].checked;
//		tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = !che;
			tab.rows[i].cells[0].getElementsByTagName("input")[0].checked = self_doc.checked;
	}
}


//原“js/dynamic_table_init.js”文件
$(document).ready(function() {
	//获取节点
//	var tab2 = $(".dynamic-table_2").html();//获取排序信息无效
//	alert($(".dynamic-table").html());
	//拆分数据
//	var turn2 = tab2.split('/');
	//排序设置
	if($("#ischecked").attr("value") == "没有查询信息"){
		var send_data = '{ "name": "my_flag", "value": "案件总览" },{"name":"ischeck","value":"没有查询"}';
		Tab_2 = $('#dynamic-table_2').dataTable( {
	        "aaSorting": [],
	        "aoColumnDefs": [{
	                'bSortable': false,
	                'aTargets': [0]
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
	        "sAjaxSource": "index_jsondata.php",
	        "sServerMethod": "GET",
	        "fnServerParams": function ( aoData ) {
		        aoData.push({ "name": "my_flag", "value": "案件总览" },{"name":"ischeck","value":"没有查询"});
		    	},
					"sAjaxDataProp": "data",
					"aoColumns":[
						{"mData":"inputcheckbox","sClass":"center"},
						{"mData":"案卷号"},
						{"mData":"类型"},
						{"mData":"申请号","style":"min-width:20px;"},
						{"mData":"申请日"},
						{"mData":"申请人"},
						{"mData":"专利名称"},
						{"mData":"案源人"},
						{"mData":"代理人"},
						{"mData":"当前程序"},
						{"mData":"案件类型"},
						{"mData":"原案卷号"},					
					]
	   });
	}else{
		
		Tab_2 = $('#dynamic-table_2').dataTable( {
	        "aaSorting": [],
	        "aoColumnDefs": [{
	                'bSortable': false,
	                'aTargets': [0]
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
	        "sAjaxSource": "index_jsondata.php",
	        "sServerMethod": "GET",
	        "fnServerParams": function ( aoData ) {
		        aoData.push( { "name": "my_flag", "value": "案件总览" },{"name":"ischeck","value":"有查询"},{"name":"zllx","value":$("#check_data input:eq(0)").attr("value")},{"name":"dqcx","value":$("#check_data input:eq(1)").attr("value")},{"name":"ayr","value":$("#check_data input:eq(2)").attr("value")},{"name":"dlr","value":$("#check_data input:eq(3)").attr("value")},{"name":"sqr_start","value":$("#check_data input:eq(4)").attr("value")},{"name":"sqr_end","value":$("#check_data input:eq(5)").attr("value")});
		    	},
					"sAjaxDataProp": "data",
					"aoColumns":[
						{"mData":"inputcheckbox","sClass":"center"},
						{"mData":"案卷号"},
						{"mData":"类型"},
						{"mData":"申请号","style":"min-width:20px;"},
						{"mData":"申请日"},
						{"mData":"申请人"},
						{"mData":"专利名称"},
						{"mData":"案源人"},
						{"mData":"代理人"},
						{"mData":"当前程序"},
						{"mData":"案件类型"},
						{"mData":"原案卷号"},					
					]
	   });
	}
	
} );

//	//设置排序
//	$(".checilck > li").click(function(){
//		var czyid = $("#czyid").val();
//		var aim  = $(this).parent().attr("id");//获取点击的位置的父id
//		var text = $(this).html();//获取排序方式
//		var Text = text.substr(12,text.length-16);
//		var ch = document.getElementsByName(aim)[0].innerHTML;
////		alert(ch);
//		$.ajax({
//			url:'OrderChange.php',
//			type:'get',
//			async:true,
//			data:{
//				falg:aim,//判断表格的依据
//				order:Text,
//				czyid:czyid,
//				page:'index'
//			},
//			success:function(data){
//				window.location.reload();
//			},
//			error:function(){
//				alert('false');
//			}
//		});
//	});
</script>
<!--about 常态-->
<!--<script src="js/NormalS.js"></script>-->

</body>
</html>