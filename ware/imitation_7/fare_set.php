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

  <title>费用名设置</title>
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
  
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../menu_tree.php"); 
				Create_leftlist(4,1);
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
		                    <li class="about-1"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>专案普通费用</a></li>
		                    <li class="about-2"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>发明专利年费</a></li>
		                    <li class="about-3"><a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>实用新型年费</a></li>
		                    <li class="about-4"><a href="#about-4" data-toggle="tab"><i class="fa fa-user"></i>外观设计年费</a></li>
		                  </ul>
		                  <input type="text" hidden="hidden" value="<?php echo $userid; ?>" id="useid" />
		                  <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
                		</header>
                <div class="panel-body">
	        <div class="tab-content">
		        <div class="tab-pane" id="about-1">
                  <section id="unseen">
	                <table class="display table table-bordered table-striped" id="tabfare">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">案件类型</th>
                            <th class="numeric">费用名</th>
                            <th class="numeric">金额</th>
                            <th class="numeric">操作</th>
										</tr>
                      </thead>
                      <tbody>
                      	<tr>
	                      	<th><select id="ctype">
                            	<option>发明专利</option>
                            	<option>实用新型</option>
                            	<option>外观设计</option>
                            </select></th>
	                      	<th><input /></th>
	                      	<th><input /></th>
                      		<th align="center" ><input class="btn btn-primary" type="button" value="保存" id="savedata" onclick="savenew()" /></th>
                      	</tr>
                      </tbody>
                    </table>
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                      <thead>
		                <tr>																											  								
                        <th class="numeric">案件类型</th>
                        <th class="numeric">费用名</th>
                        <th class="numeric">金额</th>
                        <th class="numeric">修改时间</th>
                        <th class="numeric">操作人</th>
                        <th class="numeric">操作</th>
										</tr>
                      </thead>
                      <tbody>
                      	<?php
                      		require'../../conn.php';
                      		//数据根据费用名拼音排序
                      		$sql="select * from 费用名参看 where 费用名  NOT LIKE '发明专利%年费' and 费用名 NOT LIKE '实用新型%年费' and 费用名 NOT LIKE '外观设计%年费' order by convert(费用名 using gbk) asc";
                      		$result = $conn->query($sql);
                      		if($result->num_rows>0){
                      			$num = 1;
                      			while($row=$result->fetch_assoc()){
                      				$people = $row['创建人'];
                      				$sql_creat = "select id,名称 from 用户 where id = '".$people."' ";
                      				$result_creat = $conn->query($sql_creat);
                      				if($result_creat->num_rows>0 ){
                      					while($row_creat = $result_creat->fetch_assoc()){
                      						$creatpeo = $row_creat['名称'];
                      					}
                      				}
                      				$ct = $row['专案类型'];
                      				if($ct == '1'){
                      					$ct = '发明专利';
                      				}else if($ct == '2'){
                      					$ct = '实用新型';
                      				}else{
                      					$ct = '外观设计';
                      				}
                      				?>
                      				<tr>
                      					<!--<th><?php echo $num; ?></th>-->
                      					<td><?php echo $ct; ?></td>
															 	<td><input style="width: 300px;" id="fn<?php echo $row['id']; ?>" type="text" value="<?php echo $row['费用名']; ?>" readonly="readonly" /></td>
															 	<td><input id="fa<?php echo $row['id']; ?>" type="text" value="<?php echo $row['金额']; ?>" readonly="readonly" /></td>
															 	<td><?php echo $row['创建日期']; ?></td>
															 	<td><?php echo $creatpeo; ?></td>
															 	<td>
															 		<input class="btn btn-primary" type="button" id="<?php echo $row['id']; ?>" value="修改" onclick="changef(this.id,this.value)" />
															 		<input class="btn btn-danger" type="button" name="<?php echo $row['id']; ?>" value="删除" onclick="Delete_f(this.name)" />
															 	</td>
															</tr>
                      				<?php
                      					$num ++;
                      			}
                      		}
                      		$conn->close();
                      	?>
                      </tbody>
                   </table>
                </section>
            	</div><!--tab-01 end-->
            	<div class="tab-pane" id="about-2">
                  <section id="unseen">
	                <table class="display table table-bordered table-striped" id="tab_set">
	                      <thead>
	                      	<tr>																											  								
		                  				<th class="numeric">#</th>
	                            <th class="numeric" colspan="3">发明专利</th>
													</tr>
			                		<tr>																											  								
		                  		<th class="numeric">年度\费减比</th>
	                            <th class="numeric">100%</th>
	                            <th class="numeric">85%</th>
	                            <th class="numeric">70%</th>
													</tr>
	                      </thead>
	                      <tbody>
	                        <tr>
													 	<th>发明专利第1年年费</th>
													 	<td><input type="text" /></td>
													 	<td><input type="text" /></td>
													 	<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第2年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第3年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第4年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第5年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第6年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第7年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第8年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第9年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第10年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第11年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第12年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第13年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第14年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第15年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第16年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第17年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第18年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第19年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>发明专利第20年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
	                      </tbody>
                   </table>
                   <div align="center">
                   	<input class="btn btn-primary" type="button" onclick="SaveChange('a')" value="保存" />
                   </div>
                </section>
            	</div><!--tab-02 end-->
            	<div class="tab-pane" id="about-3">
                  <section id="unseen">
	                <table class="display table table-bordered table-striped" id="tab_set2">
	                      <thead>
	                      	<tr>																											  								
		                  				<th class="numeric">#</th>
	                            <th class="numeric" colspan="3">实用新型</th>
													</tr>
			                		<tr>																											  								
		                  				<th class="numeric">年度\费减比</th>
	                            <th class="numeric">100%</th>
	                            <th class="numeric">85%</th>
	                            <th class="numeric">70%</th>
													</tr>
	                      </thead>
	                      <tbody>
	                        <tr>
														<th>实用新型专利第1年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第2年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第3年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第4年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第5年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第6年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第7年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第8年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第9年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>实用新型专利第10年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
	                      </tbody>
                   </table>
                   <div align="center">
                   	<input class="btn btn-primary" type="button" onclick="SaveChange('b')" value="保存" />
                   </div>
                   
                </section>
            	</div><!--tab-03 end-->
            	<div class="tab-pane" id="about-4">
                  <section id="unseen">
	                	<table class="display table table-bordered table-striped" id="tab_set3">
	                      <thead>
	                      	<tr>																											  								
		                  				<th class="numeric">#</th>
	                            <th class="numeric" colspan="3">外观设计</th>
													</tr>
			                		<tr>																											  								
		                  				<th class="numeric">年度\费减比</th>
	                            <th class="numeric">100%</th>
	                            <th class="numeric">85%</th>
	                            <th class="numeric">70%</th>
													</tr>
	                      </thead>
	                      <tbody>
	                        <tr>
														<th>外观设计专利第1年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第2年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第3年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第4年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第5年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第6年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第7年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第8年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第9年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
													<tr>
														<th>外观设计专利第10年年费</th>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
														<td><input type="text" /></td>
													</tr>
	                      </tbody>
                   	</table>
                   	<div align="center">
                   		<input class="btn btn-primary" type="button" onclick="SaveChange('c')" value="保存" />
                   	</div>
                   	
                </section>
            	</div><!--tab-04 end-->
	        	</div>
	        	</div>
				   </section>   
        	</div>
        </div>
        </div>
    </div>
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
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--页面响应-->
<script src="../../js/imitation_7/fare_set.js"></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<script src="../../js/imitation_7/FareCost_YC.js"></script>

</body>
</html>
