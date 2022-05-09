<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>客户信息管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">


    <!-- main content start--主页左上方的标志-->

				<!--body wrapper start :主要内容-->
	<div class="wrapper">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			<form action="../../../newcasesave.php" method="post" enctype="multipart/form-data">
	        	<strong>客户信息</strong>
	                <span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                 </span>
	  </header>
	  <div class="panel-body">
	    <table class="table table-bordered table-striped table-condensed" >
	        <tbody>
		        <tr>
		        		<td width="15%">联系人</td>
								<td class="numeric" >手机号</td>
								<td class="numeric" width="15%">电子邮箱</td>
		            <td class="numeric">地址</td>
		            <td class="numeric" width="15%">证件号</td>
		            <td class="numeric">备注</td>
		        </tr>
		        <tr>
		        	<td>#</td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        </tr>
		        <tr>
		        	<td>#</td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        	<td></td>
		        </tr>
	        </tbody>
	    </table>
		</div>
	    </section>
	   </div>

	    <div  class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<span>客户联系记录</span>
	            	<sub>客户信息的明细做成超链接</sub>
	            	<sub>链接目标：inforful_client.php</sub>
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                </span>
	            </header>
	           	<div class="panel-body">
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
		                <thead>
		                <tr>
		                		<th>序号</th>
		                    <th>联系人</th>
		                    <th>联系时间</th>
		                    <th>联系方式</th>
		                    <th>案卷号</th>
		                    <th>事件</th>
		                    <th>负责联系人员</th>
		                    <th>备注</th>
		                </tr>
		                </thead>
		                <tbody >
											<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>
		                    	<select>
		                    		<option>电话</option>
		                    		<option>邮件</option>
		                    		<option>快递</option>
		                    		<option>其他</option>
		                    	</select>
		                    </td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                	<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                	<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                </tbody>
		                </table>
	                <br />
	        	</form>
	</section>
	</div>
	
	<div  class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<span>客户案件粗查</span>
	            	<sub>案件号做成超链接，链接到案卷信息</sub>
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                </span>
	            </header>
	           	<div class="panel-body">
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
		                <thead>
		                <tr>
		                		<th>序号</th>
		                    <th>案卷号</th>
		                    <th>案卷名</th>
		                    <th>联系人</th>
		                    <th>联系方式</th>
		                    <th>案源人</th>
		                    <th>代理人</th>
		                    <th>当前程序</th>
		                    <th>备注</th>
		                </tr>
		                </thead>
		                <tbody >
											<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                	<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                	<tr>
		                		<td>#</td>
		                    <td>#</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                    <td>A</td>
		                	</tr>
		                </tbody>
		                </table>
	                <br />
	        	</form>
	</section>
	</div>
	
	</div>
	</div>
		
				<!--body wrapper end-->
				
				
        <!--footer section start-->
        <!--
        <footer>
            
        </footer>
        -->
        <!--footer section end-->



    <!-- main content end-->


<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>



<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../js/dynamic_table_init.js"></script>


<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>
<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>



</body>
</html>
