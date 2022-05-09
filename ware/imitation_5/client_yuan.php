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

  <title>申请人管理</title>
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
  	table th{
  		width: 100px;
  		word-wrap: break-word;
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
				Create_leftlist(3,0);
			?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content">
				
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
        				<header class="panel-heading">
	            			<strong>申请人信息</strong>
	            			&nbsp;&nbsp;&nbsp;
	            		</header>
	            		
				<div class="panel-body">
				<section id="unseen">
					<input class="btn btn-primary" type="button" onclick="client_new()" value="新建申请人" />
	                <table class="table table-striped  table-bordered" id="dynamic-table">
		                <thead>
		                <tr>
		                    <th style="width: 200px;">申请人</th>
		                    <th style="width: 100px;">证件号</th>
		                    <th>默认地址</th>
		                    <th style="width: 80px;">邮政编码</th>
		                    <th style="width: 60px;">费减年度</th>
		                    <th>备注</th>
		                <?php
													if($admin == 1||$lcczy == 1){
		                ?>
		                	<th style="width: 100px;">客户所属</th>
		                	
		                <?php
		                    }
		                ?>
		                		<th style="width: 60px;">操作</th>
		                </tr>
		                </thead>
		                <tbody>
		                	<?php
		                		require("../../conn.php");
		                		if($admin == 1){
		                			$sql = "select * from 申请人 order by id desc";
		                		}else{
		                			$sql = "select * from 申请人 where 删除状态 <> 1 order by id desc";
		                		}
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
		                	?>
		            <tr>
                        <td class="numeric"><a target="_blank" onclick="Open_altertocheck_sqr('client_one.php?sonid=<?php echo $row["id"];?>&ss=<?php echo $row["记录所属"]?>')"><?php echo $row["申请人"];?></a></td>
                        <td class="numeric"><?php echo $row["证件号"];?></td>
	                    <td class="numeric"><?php echo $row["地址"];?></td>
                        <td class="numeric"><?php echo $row["邮政编码"];?></td>
                        <td class="numeric"><?php echo $row["费减备案"];?></td>
                        <td class="numeric"><?php echo $row["备注"];?></td>
                        <?php
		                    if($admin == 1||$lcczy == 1){
//													if(1){
		                    	$sql5="select 名称 from 用户 where id='".$row["记录所属"]."'";
													
		                    	$result5 = $conn->query($sql5);
													if($result5->num_rows>0){
														while($row5 = $result5->fetch_assoc()){
							                ?>
							                	<td class="numeric"><?php echo $row5["名称"];?></td>
							                <?php
				                		}
													}else{
															?>
															<td class="numeric"></td>
															<?php
													}
														
		                    }
		                    if($admin == 1){
		                    		if($row['删除状态'] == '1'){
		                    ?>
		                    		<td>
		                    			<!--<a><i class="fa fa-times"></i></a>-->
					                		<!--<button id="<?php echo $row["id"];?>" class="btn btn-danger fa fa-times" onclick ="del_client(this)"></button>-->
					                		<button  id="<?php echo $row["id"];?>" class="btn btn-success" onclick ="reply_client(this)">恢复</button>
					                	</td>
		                    <?php			
		                    		}else{
		                    ?>
		                    		<td>
		                    			<button id="<?php echo $row["id"];?>" class="btn btn-danger" onclick ="del_client(this)">删除</button>
					                		<!--<button id="<?php echo $row["id"];?>" class="btn btn-danger" onclick ="del_client(this)">删除</button>-->
					                	</td>
		                    <?php			
		                    		}
		                    }else{
		                ?>
		                			<td>
		                				<button id="<?php echo $row["id"];?>" class="btn btn-danger" onclick ="del_client(this)">删除</button>
					                	<!--<button id="<?php echo $row["id"];?>" class="btn btn-danger" onclick ="del_client(this)">删除</button>-->
					                </td>
		                <?php    	
		                    }
		                ?>
                    </tr>
                   <?php
						}
						$conn->close();  
                   	?>
		                </tbody>
		               </table>
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

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--新建客户  new_client-->
<script type="text/javascript" src="../../js/client.js"></script>
<!--about 常态-->
		<!--<script src="../../js/NormalS-2.js"></script>-->
		<script type="text/javascript">
			$('#dynamic-table').dataTable({
        "aaSorting": [],
    	});
		</script>
</body>
</html>
