<?php
	require'../../AHeader.php'; 
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
  			  	<!--专利事务所logo-->
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>收据登记</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

        <!--notification menu start -->
       
        <!--notification menu end -->

        </div>
        <!-- header section end-->
		
        <!-- page heading start-->
        
        <!-- page heading end-->
	
        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
        	收据详情
        	<span class="tools pull-right">
			    <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
			    <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
			    <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
			</span>
        </header>
        <div class='panel-body'>
        <div class="adv-table">
        	
        	<table class="display table table-bordered table-striped" >
        			<tr>
        				<th colspan="2">操作员</th>
        				<th colspan="4"><?php echo $name; ?><input type="text" id="cpeo" value="<?php echo $name; ?>"  hidden="hidden"  /></th>
        				<?php
        					$id  = $_GET['mas'];
        				?>
        				<th hidden="hidden" ><input type="text" name="fid" id="fid" value="<?php echo $id; ?>" hidden="hidden" /></th>
        			</tr>
        			<tr>
        				<th hidden="hidden" >id</th>
        				<th>费用名</th>
        				<th>案号</th>
        				<th>申请号</th>
        				<th>申请人</th>
        				<th>金额</th>
        				<th>滞纳金</th>
        			</tr>
        			<?php 
		        		$fid = explode('/',$id);
		        		$len = count($fid);
		        		require'../../conn.php';
		        		for($i=0;$i<$len;$i++){
		        			$sql = "SELECT id,`案卷号`,`申请号`,`申请人`,费用名称,`金额`,`缴费期限`,`专利名称` ,滞纳金 ,`收据编号`,`费用状态` as 状态 from  专案待缴费 where id='".$fid[$i]."'";
		        			$result = $conn->query($sql);
		        			if($result->num_rows>0){
		        				while($row = $result->fetch_assoc()){
		        					?>
		        					<tr>
				        				<td hidden="hidden" ><input type="text" id="" value="<?php $row['id']; ?>" /></td>
				        				<td><?php echo $row['费用名称']; ?></td>
				        				<td><?php echo $row['案卷号']; ?></td>
				        				<td><?php echo $row['申请号']; ?></td>
				        				<td><?php echo $row['申请人']; ?></td>
				        				<td><?php echo $row['金额']; ?></td>
				        				<td><?php echo $row['滞纳金']; ?></td>
				        			</tr>
		        					<?php
		        				}
		        			}
		        		}
		        	?>
        	</table>
        	<form action="cost_check_save.php" enctype="multipart/form-data" method="post" >
        		<input type="text" name="fid" id="fid" value="<?php echo $id; ?>" hidden="hidden" />
        		<input type="text" name="cpeo" id="cpeo" value="<?php echo $name; ?>" hidden="hidden" />
        		<sub style="color:red" >注：请务必上传图片</sub>
	        	<table>
	        		<tr style="width: 500px;" >
	        			<th width="20%" >收据编号：</th>
	        			<td><input type="text" id="sjbh" name="sjbh" /></td>
	        		</tr>
	        		<tr>
	        			<td colspan="2" ><input type="file" id="pic" name="myfile" value="请选择文件" onchange="show_receipt(this)" /></td>
	        		</tr>
	        		<tr>
	        			<td colspan="2" >
	        				<div id="showpic"></div>
	        			</td>
	        		</tr>
	        	</table>
	       
        	<br />
        	<br />
        	<div>
        		<center>
        			<input class="btn btn-primary" type="submit" value="确定" id="upload" name="sure" />
        		</center>
        	</div>
        </form>
        </div>
        </div>
        </section>
        </div>
        </div>
         
        <!--body wrapper end-->

        <!--footer section start-->
     
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
<!--<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/js/jquery.dataTables.js"></script>-->
<!--<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>-->
<!--dynamic table initialization -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<!--own script-->
<script src="../../js/imitation_3/cost.js" ></script>
<script src="../../js/imitation_3/receipt.js" ></script>

</body>
</html>