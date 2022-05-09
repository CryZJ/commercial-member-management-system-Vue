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

  <title>公司与财务设置</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  
	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
  
  <!--multi-select-->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-multi-select/css/multi-select.css" />
	
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
			Create_leftlist(4,5);
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
                    <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>公司与财务管理</a></li>
                  </ul>
                </header>
                <div class="panel-body">
                		<header>
                			<a class="btn btn-primary" data-toggle="modal" href="#addModal" onclick="Clear_Mod('my_form')">添加</a>
                		</header>
				        <div class="tab-content">
					        <div class="tab-pane active" id="about-1">
                    <section id="unseen">
                    	<table class="display table table-bordered table-striped" id="dynamic-table">
	                        <thead>
	            				<tr>
                					<th>公司名称</th>
                					<th>财务管理员</th>
                    			</tr>
                       		</thead>
                        	<tbody>
                        		
							</tbody>                   										
						</table>
                	</section>
            	</div><!--tab-01 end-->
	        	</div>
	        	</div>
				   </section>   
            
        	</div>
        </div>
        </div>		
		<!--body wrapper end-->
		<!--添加模块 star-->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">公司添加</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form">
					 		<div class="form-group">
                                <label class="control-label col-md-3">公司名称：</label>
                                <div class="col-md-7 col-xs-11">
                                    <input class="form-control form-control-inline input-medium"   type="text"  />
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">选择财务管理人员：</label>
                                <div class="col-md-9">
                                    <select name="country" class="multi-select" multiple="" id="my_multi_select3">
			                            <!--<option value="24">周值煜</option>-->
                            		</select>
                            	</div>
                            </div>
					 	</form>
	                    <div class="modal-footer" align="center">
	                    	<button data-dismiss="modal" class="btn btn-primary" type="button" onclick="Save('my_form','my_multi_select3','Save_first')">保存</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>		
		<!--添加模块 end-->
		<!--修改模块 star-->
		<div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">公司添加</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form_2">
							<input type="text" hidden="hidden"  /><!--本行数据的id，用于更新数据-->
					 		<div class="form-group">
                                <label class="control-label col-md-3">公司名称：</label>
                                <div class="col-md-7 col-xs-11">
                                    <input class="form-control form-control-inline input-medium"   type="text"  />
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">选择财务管理人员：</label>
                                <div class="col-md-9">
                                    <select name="country" class="multi-select" multiple="" id="my_multi_select4">
			                            <!--<option value="24">周值煜</option>-->
                            		</select>
                            	</div>
                            </div>
					 	</form>
	                    <div class="modal-footer" align="center">
	                    	<button data-dismiss="modal" class="btn btn-primary" type="button" onclick="Save_alter('my_form_2','my_multi_select4','Save_alter')">保存</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>		
		<!--修改模块 end-->		
        <!--footer section start-->
        <!--
        <footer>
            
        </footer>
        -->
        <!--footer section end-->

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
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--bootstrap input mask-->
<script type="text/javascript" src="../../js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--multi-select-->
<script type="text/javascript" src="../../js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="../../js/jquery-multi-select/js/jquery.quicksearch.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--个人添加页面响应-->
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<script src="../../js/imitation_7/FirmName_set.js"></script>

<!--about 常态-->
<!--<script src="../../js/NormalS-2.js"></script>-->

</body>
</html>
