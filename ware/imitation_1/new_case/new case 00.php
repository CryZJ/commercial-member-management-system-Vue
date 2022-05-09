<?php require'../../../AHeader.php'; ?>
	
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
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>个案管理-专案申请</title>

  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->
  
	  <style type="text/css">
  	/*上传条的样式*/
	.progress_upload{
		margin-top:1px;
	    width: 200px;
	    height: 20px;
	    margin-bottom: 1px;
	    overflow: hidden;
	    background-color: #f5f5f5;
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	}
	.progress-bar{ 
		background-color: rgb(92, 184, 92);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.14902) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.14902) 50%, rgba(255, 255, 255, 0.14902) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
		box-shadow: rgba(0, 0, 0, 0.14902) 0px -1px 0px 0px inset;
		box-sizing: border-box;
		color: rgb(255, 255, 255);
		display: block;
		float: left; 
		font-size: 12px;
		height: 30px;
		line-height: 20px;
		text-align: center;
		transition-delay: 0s;
		transition-duration: 0.6s;
		transition-property: width;
		transition-timing-function: ease;
		width:266.188px;
	}
  </style>  
  
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
        	<strong>专利案件新建</strong>&nbsp;&nbsp;&nbsp;
                <span class="tools pull-right">
                    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
                </span>
	  	</header>
	    <div class="panel-body">
	    	<label>案件登记人：</label><input style="border:none;" type="text" id="ajdlr" value="<?php echo $name; ?>"  readonly />
	    	<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
				<button class="btn btn-primary" type="button" id="select_sqr" >添加申请人</button>
				<br />
				<br />
				<table class="table table-bordered table-striped table-condensed" id="tab_sqr">
	                <tr>
                		<th>申请人</th>
                		<th>证件号</th>
						<th>地址</th>
						<th>邮政编码</th>
						<th>费减年度</th>
						<th>备注</th>
						<th>申请人类型</th>
						<th hidden="hidden">编号</th>
	                </tr>
	                <tr>
	                	<td style="height:30px;" ></td>
	                	<td></td>
	                	<td></td>
	                	<td></td>
	                	<td></td>
	                	<td></td>
	                	<td></td>
	                	<td hidden="hidden"></td>
	                </tr>
	            </table>
	            <table class="table table-bordered table-striped table-condensed" id="tab_fmsjr">
	                <tr>
                		<th hidden="hidden">编号</th>
                		<th>发明/设计人</th>
						<th>证件号</th>
						<th style="width: 60px;">操作</th>
	                </tr>
	                <tr>
	                	<td hidden="hidden" ><input style="border:none;" type="text" value=""/></td>
	                	<td style="height:30px;"><input style="border:none;" type="text" value="" readonly="readonly" /></td>
	                	<td><input style="border:none;" type="text" value="" readonly="readonly" /></td>
	                	<td><button onclick="delFMSJR(this)">删除</button></td>
	                </tr>
	            </table>
	            <label>案件备注：</label>
	            <p><textarea cols="100" rows="5" id="case_bz" ></textarea></p>
	            </div>
	        	</div>
	        </section>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	           <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
	           		<button class="btn btn-primary" type="button" onclick="addRow()" >+</button>
					<button class="btn btn-primary" type="button" onclick="delete_row(document.all.tabUserInfo)" >-</button>
					<br />
					<!--进度条 start-->
					<div align="center" id="file_list">
						<div class="progress_upload">
							<div class="progress-bar" style="width: 0%">
								&nbsp;<strong></strong>
							</div>
						</div>
					</div>
					<!--进度条 end-->
					<br />
	                <table class="table table-striped  table-bordered" id="tabUserInfo">
	                <thead>
	                <tr>
                		<th>#</th>
	                    <th>案卷号</th>
	                    <th>类型</th>
	                    <th>案源人</th>
	                    <th>代理人</th>
	                    <th>专利名称</th>
	                    <th>添加文件</th>
	                </tr>
	                </thead>
	                <tbody id="my_tabinfo">
            			<tr>
							<td class="numeric"><input name="Fruit" type="checkbox" /></td>
							<td class="numeric"><input type="text" id="ajh[0]" name="ajh[]" readonly /></td>
							<td class="numeric">
								<select name="lx" id="lx[0]" onchange="changeAJH(this)">
									<option value=""></option>
									<option value="发明专利">发明专利</option>
									<option value="实用新型">实用新型</option>
									<option value="外观设计">外观设计</option>
								</select>
							</td>
							<td class="numeric"><input style="width:100px" type="text" name="" id="ayr[0]" readonly="readonly" onclick="select_ayr(this.id)" /></td>
							<td class="numeric"><input style="width:100px" type="text" name="" id="dlr[0]" readonly="readonly" onclick="select_dlr(this.id)" /></td>
							<td class="numeric"><input type="text" name="zlmc" id="zlmc[0]" /></td>
							<td><input type="file" name="myfile0[]" id="myfile[0]" multiple/></td>
						</tr>
	                </tbody>
	                </table>
	                <div align="center" ><button class="btn btn-primary" type="button" onclick="save_data(document.all.tabUserInfo)" id="button_save" >提交信息</button></div>
	                <br />
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
<script src="../../../js/jquery-1.10.2.min.js"></script>
<script src="../../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/modernizr.min.js"></script>
<script src="../../../js/jquery.nicescroll.js"></script>

<script src="../../../js/scripts.js"></script>
		<!--选择案源人，联系人&生成案卷号【中介】等--> 
<script src="../../../js/selectsqr_zl.js"></script>
		<!--表格增减行&表格数据传输-->
<script type="text/javascript" src="../../../js/table_add.js" ></script>

		<!--数据保存-->
<script type="text/javascript" src="../../../js/save_case_new.js"></script>

</body>
</html>