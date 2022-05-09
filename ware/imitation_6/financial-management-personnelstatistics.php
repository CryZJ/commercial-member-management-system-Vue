<?php 
require'../../AHeader.php'; 
$firm_id = $_SESSION["firm_id"];//获取公司的id，用于获取去相关的表格或视图
require("AHeaderRecord.php");
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

  <title>财务管理</title>
  
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
				Create_leftlist(5,0);
			?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content" >
	
        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn" style="width: auto;"><i class="fa fa-bars"></i> &nbsp;<?php echo $firmname_show;//在AHeaderRecord.php中定义 ?></a>
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
				<div class="wrapper" >
        		<div class="row" >
	        		<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading custom-tab">
		             		<ul class="nav nav-tabs">
		             			<li class="about-1"><a href="financial-management.php" ><i class="fa fa-align-justify"></i>总收入记录</a></li>
		             			<li class="about-7"><a href="financial-management-allexpenditure.php"><i class="fa fa-align-justify"></i>总支出记录</a></li>
		             			<li class="about-8"><a href="financial-management-allowe.php" ><i class="fa fa-align-justify"></i>总欠费记录</a></li>
		             			
				                <li class="about-6"><a href="financial-management-monthincome.php" ><i class="fa fa-align-justify"></i>月收入记录</a></li>
				                <li class="about-2"><a href="financial-management-monthexpenditure.php" ><i class="fa fa-align-justify"></i>月支出记录</a></li>
				                <li class="about-3"><a href="financial-management-monthstatistics.php" ><i class="fa fa-adjust"></i>月统计记录</a></li>
				                <li class="about-4 active"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>按人员统计</a></li>
				                <li class="about-5"><a href="financial-management-monthowe.php" ><i class="fa fa-align-justify"></i>月欠费记录</a></li>
              					<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
              					<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
              				</ul>
	        			</header>
				        <div class="panel-body">
				        <div class="tab-content">
				        	<!--按人员统计  	star-->
				        	<div class="tab-pane active" id="about-4">
                			<section id="unseen">
				        		<header>
				        			<table>
				        				<tr>
				        					<td>
				        						<label>选择人员：</label>
				        						<input id="ayr_check" class=" form-control-inline input-medium"   type="text" onclick="select_ayr(this.id)" readonly="readonly" />
				        					</td>
				        					<td>
				        						<label> 选择客户：</label>
				        						<input id="kh_check" class=" form-control-inline input-medium"   type="text" onclick="select_kh(this.id)" readonly="readonly" />
				        					</td>
				        					<td></td>
				        				</tr>
				        				<tr>
				        					<td><label>起始时间： </label><input type="text" class="default-date-picker" id="star_time"/></td>
				        					<td><label>截止时间：</label><input type="text" class="default-date-picker" id="end_time"/></td>
				        					<td>
				        						<input class="btn btn-primary" type="button" class="btn-demo" value="查询" onclick="user_check()" />
				        						<input class="btn btn-primary" type="button" class="btn-demo" value="清除查询条件" onclick="Clear_check()" />
				        					</td>
				        				</tr>
				        			</table>
				        		</header>
				        		<br />
				        		<table class="display table table-bordered table-striped">
						        	<thead>
								        <tr>
								        	<th>序号</th>
								            <th>客户名称</th>
								            <th>案源人</th>
								            <th>收费明细</th>
								            <th>总费用</th>
								            <th>规费</th>
								            <th>管理费 </th>
								            <th>税费</th>
								            <th>收费方式 </th>
								            <th>收费日期 </th>
								            <th>结余 </th>
								        </tr>
						        	</thead>
						        	<tbody id="tab_user">
						        		
						        	</tbody>
						        	<tfoot>
						        		<tr><td colspan="11"></td></tr>
						        	</tfoot>
						        </table>
						        <br /><br /><br />
						        <div>
						        	<label><strong>总收费：</strong></label>
						        	<input style="border: none;font-size: 20px;color: royalblue;width: 10%;" type="text" id="add_zsf" readonly="readonly" value="0" />
						        	<label><strong>规费：</strong></label>
						        	<input style="border: none;font-size: 20px;color: royalblue;width: 10%;" type="text" id="add_gf" readonly="readonly" value="0" />
						        	<label><strong>管理费：</strong></label>
						        	<input style="border: none;font-size: 20px;color: royalblue;width: 10%;" type="text" id="add_glf" readonly="readonly" value="0" />
						        	<label><strong>税费：</strong></label>
						        	<input style="border: none;font-size: 20px;color: royalblue;width: 10%;" type="text" id="add_sf" readonly="readonly" value="0" />
						        	<label><strong>总结余：</strong></label>
						        	<input style="border: none;font-size: 20px;color: royalblue;width: 10%;" type="text" id="add_all" readonly="readonly" value="0" />
						        </div>
						        	<!--本月统计-->
							        <div>
							        <table class="display table table-bordered table-striped">
							        	<thead>
							        		<th>本月</th>
							        		<th>本月总费用</th>
							        		<th>本月总规费</th>
							        		<th>本月总管理费</th>
							        		<th>本月总税费</th>
							        		<th>本月总支出金额</th>
							        	</thead>
							        	<tbody id="tab_monthcount">
							        		<?php
							        			require("../../conn.php");
												$ym_str = date("Y").date("m");
//												$sql = "SELECT SUM(金额) AS 金额 FROM 支出记录 WHERE 年月='".$ym_str."'";
												$sql = "SELECT SUM(金额) AS 金额 FROM ".$expend_record." WHERE 年月='".$ym_str."'";
												$result = $conn->query($sql);
												$zc_fee = 0;
												if($result->num_rows>0){
													while($row=$result->fetch_assoc()){
														$zc_fee = $row['金额'];
													}
												}
//												$sql = "SELECT SUM(总收费) AS 总收费,SUM(规费) AS 规费 ,SUM(管理费) AS 管理费,SUM(税费) AS 税费 FROM 收入记录 WHERE 年月='".$ym_str."'";
												$sql = "SELECT SUM(总收费) AS 总收费,SUM(规费) AS 规费 ,SUM(管理费) AS 管理费,SUM(税费) AS 税费 FROM ".$earn_record." WHERE 年月='".$ym_str."'";
												$result = $conn->query($sql);
												if($result->num_rows>0){
													while($row=$result->fetch_assoc()){
										?>
											<tr>
												<td><?php echo $ym_str; ?></td>
												<td><?php echo $row['总收费']; ?></td>
												<td><?php echo $row['规费']; ?></td>
												<td><?php echo $row['管理费']; ?></td>
												<td><?php echo $row['税费']; ?></td>
												<td><?php echo $zc_fee; ?></td>
											</tr>		
										<?php				
													}
												}
												
												$conn->close();
							        		?>
							        	</tbody>
							        </table>
						        	</div>
						        </section>
						        </div>
				        	<!--按人员统计  end-->
				        	
				        	
				        	
				        	
				        	
					    </div>
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
<script type="text/javascript" src="../../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>


<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>


<!--个人新添js文件-->
<script src="../../js/imitation_6/financial-management.js"></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<!--新写的jQuery的个人页面响应 -->
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<script>
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
				page:'FARECON'
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
