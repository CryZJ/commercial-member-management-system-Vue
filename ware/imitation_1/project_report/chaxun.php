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

  <title>操作记录</title>

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">
  <!--dynamic table-->
  <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->

  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />
	<style>
		#000 {
			background-color: '#000000';
		}
	</style>
</head>

<body class="sticky-header">
<section>
        <!--body wrapper start-->
  <div class="wrapper" >
      <div class="row" >
  <div class="col-sm-7" style="margin-left: 5%;">
    <section class="panel">
      <header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
        </span>
	      <ul class="nav nav-tabs">
	        <li class="#"><a href="#about-2" data-toggle="tab">操作记录 </a></li>
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">
	    	<!--  案卷流程及文档    -->
		<div class="tab-pane in active" id="about-2">
          <section id="unseen">
            <table class="table table-bordered table-striped table-condensed" >
				<thead>
					<tr>
				    <th class="numeric" style="width: 40%;">文件记录</th>
				    <th class="numeric" >记录创建时间</th>
				    <th class="numeric" >处理人</th>
				    <th class="numeric" >操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						require'../../../conn.php';
						$CaseId=$_GET['CaseId'];
						$sql5 = "select 记录时间,操作员,操作名,文件路径 from 专案_项目申报文件操作记录  where CaseId='".$CaseId."'";
				    	$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
								if($row5['操作名']=='1'){
										$states='上传';
									} ;
								if($row5['操作名']=='2'){
										$states='替换';
								} ;
								if($row5['操作名']=='3'){
										$states='删除';
								} ;
					?>
						<tr>
							<td class="numeric" ><?php echo pathinfo($row5['文件路径'],PATHINFO_BASENAME);?></td>
							<td class="numeric" ><?php echo $row5['记录时间']; ?></td>
							<td class="numeric" ><?php echo $row5['操作员']; ?></td>
							<!--<td>
								<a class="btn-default" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>"><button class="btn btn-demo" >下载</button></a>
								<?php
									if($CaseST == 0){
								?>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-warning" onclick="change(this)" >替换</button>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
								<?php
									}
								?>
							</td>-->
							<td class="numeric" ><?php echo $states;?></td>
						</tr>
					<?php
							}
						}
						else{
							?>
							<th class="numeric" colspan="4" >暂无记录</th>
							<?php
						}
					?>
				</tbody>
			</table>
          </section>
       </div>
    </div>
  </div>
</section>
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

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../../../js/advanced-datatable/js/jquery.dataTables.js"></script>
<!--页数跳转-->
<script type="text/javascript" src="../../../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>

<!--calendar new-->
<script src="../../../js/JMCalendar/fullcalendar/fullcalendar.js"></script>
<script src="../../../js/JMCalendar/fullcalendar/gcal.js"></script>



</body>
</html>