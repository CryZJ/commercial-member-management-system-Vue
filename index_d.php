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

  <title>专利办公管理系统</title>
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
		                <li class="about-1"><a href="index.php"><i class="fa fa-user"></i>案件总览</a></li>
		                <li class="about-2"><a href="index_b.php"><i class="fa fa-user"></i>申请案件</a></li><!--原名：专利案件-->
		                <li class="about-4"><a href="index_c.php"><i class="fa fa-user"></i>年费案件</a></li>
		                <li class="about-3 active"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>其他案件</a></li><!--原复审案件-->
		                <li class="about-5"><a href="index_e.php"><i class="fa fa-user"></i>案件统计</a></li>
		                <?php
		                	if($admin == 1){
		                ?>
		                <li class="about-6"><a href="index_f.php"><i class="fa fa-user"></i>失败案件</a></li>
		                <?php
		                	}
		                ?>
		                <input id="czyid" value="<?php echo $userid; ?>" hidden="hidden" />
		                <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
		              </ul>
           			</header>
           	<div class="panel-body">
        	<div class="tab-content">
        		
            	
           	<!--原来复审案件；现其他案件-->
           	<div class="tab-pane active" id="about-3">
                  <section id="unseen">
                  	<div>
			              	<a href="ware/imitation_1/new_fs/new_case.php" target="_blank" ><button class="btn btn-success" type="button">新建</button></a><!--ware/imitation_1/new_case/new case 00.php-->
											<button class="btn btn-primary" type="button" data-toggle="modal" href="#addModal3" >结案</button>
											<button class="btn btn-primary" type="button" onclick="huif('dynamic-table_3')" >恢复</button>
											<button class="btn btn-warning" type="button" onclick="del('dynamic-table_3')">删除</button>
											<?php
												if($admin==1){
											?>
											<button class="btn btn-danger" type="button" onclick="hid('dynamic-table_3')">彻底删除</button>
											<?php
												}
											?>
											<a href="phpexcel/my_test/fs_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
					            <button class="btn btn-primary" onclick="Export_someExcel('dynamic-table_3','phpexcel/my_test/fs_export_some.php')">导出选中行Excel清单</button>
		            		</div>
		            		<!-- button list end -->
                    <table class="display table table-bordered table-striped table-condensed" id="dynamic-table_3">
                        <thead>
	                        <tr>
	                            <th style="width: 50px;"><input type="checkbox" onchange="selectAll('dynamic-table_3',this)" /></th>
	                            <th class="numeric" style="width: 100px;">案卷号</th>
	                            <th class="numeric" style="width: 70px;">类型</th>
	                            <th class="numeric" style="width: 80px;">申请号</th>
	                            <th class="numeric" style="width: 80px;">申请日</th>
	                            <th class="numeric">申请人</th>
	                            <th class="numeric">专利名称</th>
	                            <th class="numeric" style="width: 70px;">案源人</th>
	                            <th class="numeric" style="width: 70px;">代理人</th>
	                            <th class="numeric" style="width: 70px;">当前程序</th>
	                            <th class="numeric" style="width: 100px;">案件类型</th>
	                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </section>
           	</div>
           	
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

$(document).ready(function() {

    $('#dynamic-table_3').dataTable({
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
		        aoData.push({ "name": "my_flag", "value": "其他案件" });
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
					]
    });
    
    
} );
</script>

</body>
</html>