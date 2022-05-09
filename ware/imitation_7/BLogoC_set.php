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

  <title>商标代理人设置</title>
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
				Create_leftlist(4,2);
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
		                    <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>费用名设置</a></li>
		                  </ul>
		                  <input type="text" hidden="hidden" value="<?php echo $userid; ?>" id="useid" />
                		</header>
                <div class="panel-body" style="width: 98%; overflow:auto;" >
	        <div class="tab-content">
		        <div class="tab-pane active" id="about-1">
                  <section id="unseen">
	                <table class="display table table-bordered table-striped" id="TabNew">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">代理组织名称</th>
                            <th class="numeric">联系人</th>
                            <th class="numeric">电话</th>
                            <th class="numeric">传真</th>
                            <th class="numeric">邮编</th>
                            <th class="numeric">操作</th>
						</tr>
                      </thead>
                      <tbody>
                      	<tr>
	                      	<th><input style="width: 300px;" /></th>
	                      	<th><input style="width: 150px;" /></th>
	                      	<th><input style="width: 150px;" /></th>
	                      	<th><input style="width: 150px;" /></th>
	                      	<th><input style="width: 100px;" /></th>
                      		<th align="center" ><input class="btn btn-primary" type="button" value="保存" id="" onclick="saveNew()" /></th>
                      	</tr>
                      </tbody>
                    </table>
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                      <thead>
		                <tr>																											  								
                            <th class="numeric">代理人组织名</th>
                            <th class="numeric">联系人</th>
                            <th class="numeric">电话</th>
                            <th class="numeric">传真</th>
                            <th class="numeric">邮编</th>
                            <th class="numeric">创建时间</th>
                            <th class="numeric">创建人</th>
                            <th class="numeric">操作</th>
						</tr>
                      </thead>
                      <tbody>
                      	<?php 
                      		require'../../conn.php';
                      		$sql = "select id,代理人名,联系人,电话,传真,邮编,创建时间,创建人 from 商标_代理设置 where 状态=0";
                      		$result = $conn->query($sql);
                      		if($result->num_rows>0){
                      			while($row = $result->fetch_assoc()){
                      				?>
                      				<tr>
				                      	<td><?php echo $row['代理人名']; ?></td>
				                      	<td><?php echo $row['联系人']; ?></td>
				                      	<td><?php echo $row['电话']; ?></td>
				                      	<td><?php echo $row['传真']; ?></td>
				                      	<td><?php echo $row['邮编']; ?></td>
				                      	<td><?php echo $row['创建时间']; ?></td>
				                      	<td><?php echo $row['创建人']; ?></td>
				                      	<td align="center"><input style="width: 60px;" class="btn btn-danger" value="删除" onclick="delMes(this,<?php echo $row['id']; ?>)" /></td>
                      				</tr>
                      				<?php
                      			}
                      		}
                      	?>
                      	
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
<script src="../../js/imitation_7/BLogoC_set.js"></script>

</body>
</html>
