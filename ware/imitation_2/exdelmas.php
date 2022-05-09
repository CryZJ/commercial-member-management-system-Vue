<?php require'../../AHeader.php'; ?>
<!--注：删除页面在此文件remind.php-->

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


  <title>OA办公-邮件收发</title>
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
  
  <style type="text/css">
  	table th {
  		width: 100px;
  		word-break: break-word;
  	}
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
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../menu_tree.php"); 
				Create_leftlist(1,1);
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
				        <li class="about-1"><a href="#about-1" data-toggle="tab">寄件记录</a></li>
				        <li class="about-2"><a href="#about-2" data-toggle="tab">收件记录</a></li>
				        <input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
				        <input id="NORS" hidden="hidden" value="<?php echo $normal; ?>" />
				      </ul>
			      </header>
				<div class="panel-body">
        <div class="tab-content">    
        	<!-- 寄件-->                            
	        <div class="tab-pane" id="about-1">
	    		  <section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
				        		<!--<button>新增寄件</button>-->
				        		<!--<input type="button" id="" value="新增寄件" name="" onclick="new_send()" />-->
				        		<button class="btn btn-primary" data-toggle="modal" href="#addModal">新增寄件记录</button>
				        		<input hidden="hidden" type="text" id="conid" value="<?php echo $userid; ?>" />
				        		<!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
                        	<?php 
                        		require'../../conn.php';
                        		//查询
                        		$sqlO1 = "select OA快递1 from 表格顺序 where 用户id = '".$userid."'";
                        		$resultO1 = $conn->query($sqlO1);
                        		if($resultO1->num_rows>0){
                        			while($rowO1 = $resultO1->fetch_assoc()){
                        				$order = $rowO1['OA快递1'];
                        			}
                        		}
                        		if(strlen($order)<1){
                        			$order = '1/asc/寄件人';
                        		}
                        		//显示
                        		$order = explode('/',$order);
                        		echo $order[2];
                        	?>
                        	<span class="caret"></span>
                        	<span class="dynamic-table" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" ><!--OrderZL()--> 
                            <li><a href="#">寄件人</a></li>
                            <li><a href="#">收件人</a></li>
                            <li><a href="#">客户手机</a></li>
                            <li><a href="#">客户单位</a></li>
                            <li><a href="#">客户地址</a></li>
                            <li><a href="#">内品名称</a></li>
                            <li><a href="#">快递单号</a></li>
                            <li><a href="#">寄件时间【正】</a></li>
                            <li><a href="#">寄件时间【倒】</a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
						        	<thead>
						        	  	<th hidden="hidden">id</th>
							        		<th style="width: 80px;">寄件人</th>
							            <th style="width: 80px;">收件人</th>
							            <th style="width: 100px;">客户手机</th>
							            <th>客户单位</th>
							            <th>客户地址</th>
							            <th>内件品名</th>
							            <th style="width: 80px;">快递单号</th>
							            <th style="width: 80px;">寄件时间</th>
							            <th style="width: 60px;">底单</th>
						        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql="select * from 快递信息 where 方向=0 and 状态=0 order by id desc";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        	?>
				        				<tr>
				        					<td hidden="hidden"><?php echo $row['id']; ?></td>
				        					<td><a data-toggle="modal" href="#addModal3" name="<?php echo $row['id']; ?>" onclick="check_msg(this)"><?php echo $row['寄件人']; ?></a></td>
				        					<td><?php echo $row['收件人']; ?></td>
				        					<td><?php echo $row['客户联系电话']; ?></td>
				        					<td><?php echo $row['单位名称']; ?></td>
				        					<td><?php echo $row['地址']; ?></td>
				        					<td><?php echo $row['内件品名']; ?></td>
				        					<td><?php echo $row['快递单号']; ?></td>
				        					<td><?php echo $row['收发件日期']; ?></td>
				        					<td>
				        						<?php
				        							$cmark = $row['底单'];
				        							if($cmark == "0"){
				        								$cmark = '<a onclick="upload_s('.$row['id'].',\'upload\')">待上传</a>';
				        							}else{
				        								$cmark = '<a onclick="upload_s('.$row['id'].',\'check\')">查看底单</a>';
				        							}
				        							echo $cmark; 
				        						?>
				        					</td>
				        				</tr>
						        	<?php			
						        			}
						        		}
						        		$conn->close();
						        	?>
						        	</tbody>
						        </table>
				        	</div>				        	
				        </div>
	        		</section>
	        	</div>
	        	 <!--收件-->
        <div class="tab-pane" id="about-2">
	    		  <section id="unseen">
							<!--<div class="wrapper">-->
        				<!--<div class="row">-->
				        <div class="panel-body">
				        	<div class="adv-table">
				        		<!--<button>新增收件</button>-->
				        		<!--<input type="button" id="" value="新增收件" name="" onclick="new_arri()" />-->
				        		<button class="btn btn-primary" data-toggle="modal" href="#addModal2">新增收件记录</button>
						        <!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">
                        	<?php 
                        		require'../../conn.php';
                        		//查询
                        		$sqlO1 = "select OA快递2 from 表格顺序 where 用户id = '".$userid."'";
                        		$resultO1 = $conn->query($sqlO1);
                        		if($resultO1->num_rows>0){
                        			while($rowO1 = $resultO1->fetch_assoc()){
                        				$order = $rowO1['OA快递2'];
                        			}
                        		}
                        		if(strlen($order)<1){
                        			$order = '1/asc/寄件人';
                        		}
                        		//显示
                        		$order = explode('/',$order);
                        		echo $order[2];
                        	?>
                        	<span class="caret"></span>
                        	<span class="dynamic-table_2" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuT" ><!--OrderZL()--> 
                            <li><a href="#">寄件人</a></li>
                            <li><a href="#">收件人</a></li>
                            <li><a href="#">客户手机</a></li>
                            <li><a href="#">客户单位</a></li>
                            <li><a href="#">客户地址</a></li>
                            <li><a href="#">内品名称</a></li>
                            <li><a href="#">快递单号</a></li>
                            <li><a href="#">收件时间【正】</a></li>
                            <li><a href="#">收件时间【倒】</a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
						        <table  class="display table table-bordered table-striped" id="dynamic-table_2">
						        	<thead>
							        		<th hidden="hidden">id</th>
							        		<th style="width: 80px;">寄件人</th>
							            <th style="width: 80px;">收件人</th>
							            <th style="width: 100px;">客户手机</th>
							            <th>客户单位</th>
							            <th>客户地址</th>
							            <th>内件品名</th>
							            <th style="width: 80px;">快递单号</th>
							            <th style="width: 100px;">收件时间</th>
							            <th style="width: 60px;">底单</th>
						        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql="select * from 快递信息 where 方向=1 and 状态=0 order by id desc";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        	?>
						        				<tr>
						        					<td hidden="hidden" ><?php echo $row['id']; ?></td>
						        					<td><a data-toggle="modal" href="#addModal4" name="<?php echo $row['id']; ?>" onclick="check_msg2(this)"><?php echo $row['寄件人']; ?></a></td>
						        					<td><?php echo $row['收件人']; ?></td>
						        					<td><?php echo $row['客户联系电话']; ?></td>
						        					<td><?php echo $row['单位名称']; ?></td>
						        					<td><?php echo $row['地址']; ?></td>
						        					<td><?php echo $row['内件品名']; ?></td>
						        					<td><?php echo $row['快递单号']; ?></td>
						        					<td><?php echo $row['收发件日期']; ?></td>
						        					<td>
						        						<?php
						        							$cmark = $row['底单'];
						        							if($cmark == '0'){
						        								$cmark = '<a onclick="upload_s('.$row['id'].',\'upload\')">待上传</a>';
						        							}else{
						        								$cmark = '<a onclick="upload_s('.$row['id'].',\'check\')">查看底单</a>';
						        							}
						        							echo $cmark; 
						        						?>
						        					</td>
						        				</tr>
						        	<?php			
						        			}
						        		}
						        		$conn->close();
						        	?>
						        	</tbody>
						        </table>
				        	</div>				        	
				        </div>
	        		</section>
	        	</div>
        	</div>
        </div>
				<!--body wrapper end-->
		<!--新增寄件记录模块 star-->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">寄件记录添加</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form">
					 			<div class="form-group">
                    <label class="control-label col-md-4">寄件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input id="kh" class="form-control form-control-inline input-medium"   type="text"   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人手机：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人单位：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人地址：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text" />
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-4">内件品名称：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">快递单号：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">发件时间：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium" type="date" value="<?php echo date("Y-m-d"); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">备注：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">底单：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="file" id="jj_file" />
                    </div>
                </div>
                <div class="form-group">
                 	<label class="control-label col-md-4"></label>
                    <div class="col-md-6 col-xs-11" id="file_list">
                    	<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong>
                    </div>
                </div>
					 	</form>
	                    <div class="modal-footer" align="center">
	                    	<button id="save_one" class="btn btn-primary" type="button" onclick="save_add()">保存</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>		
        <!--新增寄件记录模块 end-->
        <!--新增收件记录模块 star-->
		<div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">收件记录添加</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form2">
					 		<div class="form-group">
                    <label class="control-label col-md-4">寄件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input id="kh" class="form-control form-control-inline input-medium"   type="text"   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人手机：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人单位：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人地址：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text" />
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-4">内件品名称：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">快递单号：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">发件时间：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium" type="date" value="<?php echo date("Y-m-d"); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">备注：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">底单：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="file" id="sj_file" />
                    </div>
                </div>
                <div class="form-group">
                 	<label class="control-label col-md-4"></label>
                    <div class="col-md-6 col-xs-11" id="file_list_2">
                    	<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong>
                    </div>
                </div>
					 	</form>
	                    <div class="modal-footer" align="center">
	                    	<button id="save_two" class="btn btn-primary" type="button" onclick="save_add2()">保存</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>
        <!--新增收件记录模块 end-->
        <!--修改寄件记录模块 star-->
		<div class="modal fade" id="addModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">寄件记录修改</h4>
					</div>
					<div class="modal-body">
						<div action="#" class="form-horizontal " id="my_form3">
								<input type="text"  hidden="hidden" />
					 			<div class="form-group">
                    <label class="control-label col-md-4">寄件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input id="kh" class="form-control form-control-inline input-medium"   type="text"   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人手机：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人单位：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人地址：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text" />
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-4">内件品名称：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">快递单号：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">发件时间：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium" type="date" value="<?php echo date("Y-m-d"); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">备注：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">底单：</label>
                    <div class="input-group col-md-6 col-xs-11">
                    	<input class="form-control form-control-inline input-medium" type="text" readonly="readonly" />
                    	<a target="_blank" class="input-group-addon">下载</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">替换底单文件：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="file" id="changfile_jj" />
                    </div>
                </div>
                <div class="form-group">
                 	<label class="control-label col-md-4"></label>
                    <div class="col-md-6 col-xs-11" id="file_list_3">
                    	<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong>
                    </div>
                </div>
					 	</div>
	                    <div class="modal-footer" align="center">
	                    	<button class="btn btn-primary" type="button" onclick="Change_save(this)">修改</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>		
        <!--修改寄件记录模块 end-->
        <!--修改收件记录模块 star-->
		<div class="modal fade" id="addModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">收件记录修改</h4>
					</div>
					<div class="modal-body">
						<form action="#" class="form-horizontal " id="my_form4">
							<input type="text"  hidden="hidden" />
					 		<div class="form-group">
                    <label class="control-label col-md-4">寄件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input id="kh" class="form-control form-control-inline input-medium"   type="text"   />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人姓名：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人手机：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人单位：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">收件人地址：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text" />
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-4">内件品名称：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">快递单号：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"   type="text"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">发件时间：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium" type="date" value="<?php echo date("Y-m-d"); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">备注：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">底单：</label>
                    <div class="input-group col-md-6 col-xs-11">
                    	<input class="form-control form-control-inline input-medium" type="text" readonly="readonly" />
                    	<a target="_blank" class="input-group-addon">下载</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">替换底单文件：</label>
                    <div class="col-md-6 col-xs-11">
                        <input class="form-control form-control-inline input-medium"  type="file" id="changfile_sj" />
                    </div>
                </div>
                <div class="form-group">
                 	<label class="control-label col-md-4"></label>
                    <div class="col-md-6 col-xs-11" id="file_list_4">
                    	<div class="progress_upload"><div class="progress-bar" style="width: 0%"></div></div>&nbsp;<strong></strong>
                    </div>
                </div>
					 	</form>
	                    <div class="modal-footer" align="center">
	                    	<button id="save_two" class="btn btn-primary" type="button" onclick="Change_save2()">保存</button>
	                        <button data-dismiss="modal" class="btn btn-primary" type="button">关闭</button>
	                    </div>
                   </div>
                </div>
            </div>
        </div>
        <!--修改收件记录模块 end-->
    </div>
    </div>
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
<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<script type="text/javascript">
	//每次刷新都加载最新的js文件
	document.write('<script src="../../js/Change_session.js?ran'+Math.random()+'"><\/script><!--财务人员管理的公司id更换-->');
	document.write('<script src="../../js/imitation_2/exdelmas.js?ran'+Math.random()+'"><\/script><!--页面响应-->');
	document.write('<script src="../../js/NormalS-2.js?ran'+Math.random()+'"><\/script><!--about 常态-->');
</script>

<script type="text/javascript">	
	//原“js/dynamic_table_init.js”文件
	function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {
	//获取节点
	var tab1 = $(".dynamic-table").html();//获取排序商标案件
	var tab2 = $(".dynamic-table_2").html();//获取排序委托书
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
	//排序设置
    $('#dynamic-table').dataTable( {
//      "aaSorting": [[ turn1[0], turn1[1] ]]
				"aaSorting": []
    } );
	$('#dynamic-table_2').dataTable( {
//      "aaSorting": [[ turn2[0], turn2[1] ]]
				"aaSorting": []
    } );
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );

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
				page:'OAEDM'
			},
			success:function(data){
				window.location.reload();
			},
			error:function(){
				alert('false');
			}
		});
	});
	
</script>

</body>
</html>
