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
	.box1{
		position: absolute;
		right: 160px;
		
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
				                <li class="about-3 active"><a href="#about-3" data-toggle="tab"><i class="fa fa-adjust"></i>月统计记录</a></li>
				                <li class="about-4"><a href="financial-management-personnelstatistics.php" ><i class="fa fa-user"></i>按人员统计</a></li>
				                <li class="about-5"><a href="financial-management-monthowe.php" ><i class="fa fa-align-justify"></i>月欠费记录</a></li>
              					<input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
              					<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
              				</ul>
	        			</header>
				        <div class="panel-body">
				        <div class="tab-content">
				        	
				        	
				        	
				        	
				        	<!--每月统计记录  	star-->
				        	<div class="tab-pane active" id="about-3">
                			<section id="unseen">
                				<header>
				        			<button class="btn btn-primary" onclick="stat()">进行统计</button>
					        		<!-- /btn-group -->
					        					<div class="btn-group box1" style="float: right;">
					        						<input type="hidden"/ id="bm" value="<?php echo $finance_month_record;?>">
					        						<select class="btn btn-primary dropdown-toggle checilck"id="nf">
					        								<?php
					        								require'../../conn.php';
					        								//查询年份
					        								$sql02 = "SELECT DISTINCT LEFT(年月,4)AS 年份 FROM ".$finance_month_record."  ORDER BY 年月 DESC";
					        								$resultO2 = $conn->query($sql02);
					        								if($resultO2->num_rows>0){					        									
					        									while($row02 = $resultO2->fetch_assoc()){
					        							?>
					        										<option><a href="#"><?php echo $row02["年份"]; ?></a></option>
					        							<?php
					        									}
					        									}
					        								$conn->close();
					        							?>
					        						</select>
					        					</div>
							            	<div class="btn-group" style="float: right;" >
			                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuW">
			                        	<?php 
			                        		require'../../conn.php';
			                        		//查询
			                        		$sqlO1 = "select 财务3 from 表格顺序 where 用户id = '".$userid."'";
			                        		$resultO1 = $conn->query($sqlO1);
			                        		if($resultO1->num_rows>0){
			                        			while($rowO1 = $resultO1->fetch_assoc()){
			                        				$order = $rowO1['财务3'];
			                        			}
			                        		}
			                        		if(strlen($order)<1){
			                        			$order = '0/asc/年月';
			                        		}
			                        		//显示
			                        		$order = explode('/',$order);
			                        		echo $order[2];
			                        	?>
			                        	<span class="caret"></span>
			                        	<span class="dynamic-table_3" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
			                        </button>
			                        <ul role="menu" class="dropdown-menu checilck" id="MenuW" >
			                            <li><a href="#">年月</a></li>
			                            <li><a href="#">总收费【正】</a></li>
			                            <li><a href="#">总收费【倒】</a></li>
			                            <li><a href="#">规费【正】</a></li>
			                            <li><a href="#">规费【倒】</a></li>
			                            <li><a href="#">管理费【正】</a></li>
			                            <li><a href="#">管理费【倒】</a></li>
			                            <li><a href="#">税费【正】</a></li>
			                            <li><a href="#">税费【倒】</a></li>
			                            <li><a href="#">支出金额【正】</a></li>
			                            <li><a href="#">支出金额【倒】</a></li>
			                            <li><a href="#">本月利润【正】</a></li>
			                            <li><a href="#">本月利润【倒】</a></li>
			                            <li><a href="#">期初结存【正】</a></li>
			                            <li><a href="#">期初结存【倒】</a></li>
			                            <li><a href="#">本月结存【正】</a></li>
			                            <li><a href="#">本月结存【倒】</a></li>
			                        </ul>
			                    </div>
			                    <!-- /btn-group -->
		                    </header>
				        		<table class="display table table-bordered table-striped" id="dynamic-table_3">
						        	<thead>
								        <tr>
								            <th>年月</th>
								            <th>总收费</th>
								            <th>规费</th>
								            <th>管理费 </th>
								            <th>税费</th>
								            <th>支出金额 </th>
								            <th>本月利润 </th>
								            <th>期初结转 </th>
								            <th>本月结存 </th>
								            <th>本月欠费 </th>
								            <?php if($admin){?>
								            <th>操作</th>
								            <?php };?>
								        </tr>
						        	</thead>
						        	<tbody id="sj">
						        		<?php
						        			require("../../conn.php");
//											$sql3 = "SELECT 年月,总收费,规费,管理费,税费,支出金额,本月利润,期初结转,本月结存  FROM 财务月统计 ORDER BY 年月 DESC";
											$sql3 = "SELECT 年月,总收费,规费,管理费,税费,支出金额,本月利润,期初结转,本月结存,本月欠费  FROM ".$finance_month_record." ORDER BY 年月 DESC";
											$result3 = $conn->query($sql3);
											if($result3->num_rows>0){
												while($row3=$result3->fetch_assoc()){
										?>
													<tr>
														<td><?php echo $row3['年月']; ?></td>
														<td><?php echo $row3['总收费']; ?></td>
														<td><?php echo $row3['规费']; ?></td>
														<td><?php echo $row3['管理费']; ?></td>
														<td><?php echo $row3['税费']; ?></td>
														<td><?php echo $row3['支出金额']; ?></td>
														<td><?php echo $row3['本月利润']; ?></td>
														<td><?php echo $row3['期初结转']; ?></td>
														<td><?php echo $row3['本月结存']; ?></td>
														<td><?php echo $row3['本月欠费']; ?></td>
														<?php  
															if($admin): 
																?>
																<td><button onclick="del_tj(<?php  echo $row3['年月']; ?>)" >删除</button></td>
															<?php endif ?>
															
													</tr>
										<?php			
												}
											}
											$conn->close();
						        		?>
						        	</tbody>
						        </table>
				        	</section>
            				</div>
				        	<!--每月统计记录  	end-->
				        	
				        	
				        	
				        	
				        	
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
<script src="../../js/imitation_6/financial-management_monthstatistics.js"></script>
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
	$("#nf > option").click(function(){
		var nianfen = document.getElementById("nf");
		var biaoming = document.getElementById("bm");
		var nf = nianfen.value;
		var bm = biaoming.value;
		$.ajax({
			type:"post",
			url:"check_year.php",
			async:true,
			dataType: 'json',
			data:{
				flag:"check_time",
				nf:nf,
				bm:bm
			},
			success:function(data){
					var length = data.length;
					var trStr = '';
					for (var i = 0; i < length-1; i++) {
	//					console.log(data);
						var Cnumber=data[i].Cnumber;
					    trStr += '<tr>';
					    trStr += '<td>' + data[i].年月 + '</td>';
					    trStr += '<td>' + data[i].总收费 + '</td>';
					    trStr += '<td>' + data[i].规费 + '</td>';
					    trStr += '<td>' + data[i].管理费 + '</td>';
					    trStr += '<td>' + data[i].税费 + '</td>';
					    trStr += '<td>' + data[i].支出金额 + '</td>';
					    trStr += '<td>' + data[i].本月利润 + '</td>';
					    trStr += '<td>' + data[i].期初结转 + '</td>';
					    trStr += '<td>' + data[i].本月结存 + '</td>';
					    trStr += '<td>' + data[i].本月欠费 + '</td>';
					    trStr += '</tr>';     
					} 
	        	    $("#sj").html(trStr);
			},
		});
	})
//统计列表删除按钮19.7
function del_tj(x) {
	if(confirm("是否删除"+x+"记录?")){
//		alert(x);
			$.ajax({
				url: "financial-ajax.php",
				type: "POST",
//				async: true,
				data: {
					flag: "del_tj1",
					x: x
				}, 
				success: function(data) {
					alert("删除成功");
					location.reload();
				} 
			});
	}; 
	}
</script>

</body>
</html>
