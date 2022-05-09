<?php require'../../AHeader.php'; ?>
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

  <title>客户记录新增</title>

  <!--icheck-->
  <link href="../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->  
  
  <style type="text/css">
  	.tab_center td {
  		text-align: center;
  		font-weight: bolder;
  		font-family: "微软雅黑";
  		font-size: 15px;
  	}
  	.tab_inp input {
  		width: 120px;
  	}
  </style>
  
</head>

<body class="sticky-header">

<section>
	<div class="wrapper">
		<!--模块一 start-->
		<div class="row">
			<div  class="col-sm-12">
				<section class="panel">
					<header class="panel-heading custom-tab">
						<span class="tools pull-right">
            	<!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
        			<!--<a href="javascript:history.go(-1)" class="fa fa-reply" onclick="window.close()" ></a>-->
        			<!--<a class="fa fa-power-off" onclick="window.close()" >关闭</a>--> 
        			<a class="btn fa fa-reply" onclick="window.close();">返回</a>
            </span>
            <ul class="nav nav-tabs">
			        <li class="about-1 active"><a href="#about-1" data-toggle="tab">客户基本信息</a></li>
			        <!--<li class="about-2"><a href="#about-2" data-toggle="tab">会谈记录</a></li>-->
			      </ul>
	  			</header>
	    		<div class="panel-body">
	    			<div class="tab-content"> 
		    			<!-- 卡项一 start-->
							<div class="tab-pane active" id="about-1">
								<button class="btn btn-success" onclick="Getdata_kh()">保存信息</button>
								<br /><br />
								<input type="text" id="kh_id" value="<?php if($_GET['khid']) echo $_GET['khid'];?>" hidden="hidden" /><!--隐藏的表“客户管理”的id-->
								<table class="table table-bordered table-striped table-condensed tab_center" id="tab_kh">
										<tr>
											<td colspan="2">客户名称</td>
											<td>客户类型</td>
											<td>备注</td>
										</tr>
										<tr>
											<td colspan="2"><input type="text" style="width: 90%;" /></td>
		                	<td>
		                		<input hidden="hidden" type="text" value="一般"/>
						        		<select onchange="SetInput(this)">
						        			<option selected="selected">一般</option>
						        			<option>成交</option>
						        			<option>重点</option>
						        			<option>放弃</option>
						        		</select>
						        	</td>
		                	<td><input type="text" style="width: 90%;" /></td>
										</tr>
		            </table>
		            <!--<button class="btn btn-primary" type="button" onclick="addRow()" >增加联系人</button>-->
		            <table class="table table-bordered table-striped table-condensed tab_inp" style="text-align: center;" id="tab_lxr">
		            	<tr>
		            		<td>联系人</td>
		            		<td>手机</td>
		            		<td>固话</td>
		            		<td>邮箱</td>
		            		<td>微信</td>
		            		<td>QQ</td>
		            	</tr>
		            	<tr>
		            		<td><input type="text"/></td>
		                <td><input type="text" id="phone_num"/></td>
		                <td><input type="text"/></td>
		                <td><input type="text" style="width: 160px;"/></td>
		                <td><input type="text"/></td>
		                <td><input type="text"/></td>
		            	</tr>
		            </table>
		            <h3 align="center"><strong>会谈记录</strong></h3>
		        		<table class="table table-bordered table-striped table-condensed" style="text-align: center;" id="tab_info">
		        			<thead>
		        				<th>本次联系时间</th>
		        				<th>会谈详情</th>
		        				<th>下次联系时间</th>
		        				<th>备注</th>
		        				<th>操作</th>
		        			</thead>
		        			<!--<tr>
		        				<td><input type="date" /> </td>
		        				<td><input type="text" style="width: 300px;" /></td>
		        				<td><input type="date" /> </td>
		        				<td><input type="text" style="width: 300px;" /></td>
		        				<td><button onclick="Savedata_info(this)">保存</button></td>
		        			</tr>-->
		        			<tr onclick="Add_row(this,'tab_info')">
		        				<td align="center" colspan="5" id="add_tab">
	            				<button class="btn-block"><strong style="font-size: 20px;">+</strong></button>
	            			</td>
		        			</tr>
		        		</table>
		        	</div>
		        	<!-- 卡项一 end-->
		        	<!-- 卡项二 start-->
		        	<!--<div class="tab-pane" id="about-2">
		        		<h3><strong>会谈记录</strong></h3>
		        		<table class="table table-bordered table-striped table-condensed" style="text-align: center;" id="tab_info">
		        			<thead>
		        				<th>本次联系时间</th>
		        				<th>会谈详情</th>
		        				<th>下次联系时间</th>
		        				<th>备注</th>
		        				<th>操作</th>
		        			</thead>
		        			<tr onclick="Add_row(this,'tab_info')">
		        				<td align="center" colspan="5" id="add_tab">
	            				<button class="btn-block"><strong style="font-size: 20px;">+</strong></button>
	            			</td>
		        			</tr>
		        		</table>
		          </div>-->
		        	<!-- 卡项二 end-->
		        </div>
	        </div>
	      </section>
	    </div>
	  </div>
	  <!--模块一 end--> 
	</div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<script src="../../js/scripts.js"></script>

<!--页面相应js 函数-->
<script src="../../js/imitation_2/ClieMag_New.js"></script>

<script type="text/javascript">
	//如果khid有值则填充信息
	if($("#kh_id").val()){
		$.ajax({
			type:"get",
			url:"ClieMag_New_ajax.php",
			async:true,
			data:{
				my_flag:"GetData",
				id:$("#kh_id").val(),
			},
			dataType:"json",
			success:function(data){
				if(data["result"] == "success"){
					//填写客户基本信息
					Writedata_kh(data["kh"]);
					//填写会谈信息
					Writedata_info(data["info"],data["info_num"]);
				}else{
					console.log("获取信息失败！");
				}
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("获取信息失败！");
				console.log("ajax error!"+errorstatus+errorThrow);
			}
		});
	}
</script>

</body>
</html>