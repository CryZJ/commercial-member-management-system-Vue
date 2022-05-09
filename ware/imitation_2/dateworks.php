<?php require'../../AHeader.php'; ?>
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
  <title>OA办公-日程管理</title>

  <!--calendar css-->
  <!--<link href="../../js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />-->
	<link href="../../js/JMCalendar/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
  
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
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
				Create_leftlist(1,3);
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
				        <li class="active"><a href="#">日程计划</a></li>
				        <li class=""><a href="dateworks_set.php">逾期日程</a></li>
				        <li class=""><a href="dateworks_week.php">周日程</a></li>
				        <li class=""><a href="dateworks_month.php">月日程</a></li>
				        <li class=""><a href="dateworks_undone.php">未完成日程</a></li>
				        <li class=""><a href="dateworks_finish.php">已完成日程</a></li>
				        <?php 
				        	if($admin || $swgly || $lcczy ){
				        ?>
				        	<li class=""><a href="dateworks_all.php">全部日程</a></li>
				        <?php
				        	}	
				        ?>
				        <input id="NORS" hidden="hidden" value="<?php echo $normal; ?>" /><!--勿删-->
				      </ul>
			      </header>
				<div class="panel-body" >
        <div class="tab-content">
        	<!--正常日程-->
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
		                <aside class="col-md-4" >
	                    <section class="panel">
	                        <p><input type="text" id="date" value="" style="height:40px; line-height:40px;" readonly="readonly" /></p>
	                        <div id="CalT" style="height: 400px;" style=""></div>
	                    </section>
		                </aside>
		                <aside class="col-md-8">
		                					<?php
		                        		require'../../conn.php';
		                        		$sql = "select 完成项 from 日程设置附  where 用户id='".$userid."' ";
						                		$result = $conn->query($sql);
						                		$ShowStu='';
						                		if($result->num_rows>0){
						                			while($row = $result->fetch_assoc()){
						                				$ShowStu = $row['完成项'];
						                			}
						                		}
		                        	?>
	                      <div id="TabDoing">
	                      	<button style="float: right;" class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i></button><!--新增事件-->
	                      	<span><input type="checkbox" id="ShowType" onclick="ChanST(this)" <?php if($ShowStu){echo "checked='checked'";} ?> /><strong>显示已完成</strong></strong></span>
	                      	<br /><br />
	                      	<table class="table table-bordered table-condensed" id="tab">
		                        <thead>
			                        <tr>
			                        		<th class="numeric" hidden="hidden">id</th>
			                        		<!--<th class="numeric" hidden="hidden">id</th>-->
			                            <th style="width: 2%;">#</th>
			                            <th style="width: 58%;">安排</th>
			                            <th class="numeric">备注</th>
			                            <th class="numeric">操作</th>
			                        </tr>
		                        </thead>
		                        <tbody>
		                        	<?php
		                        		require'../../conn.php';
		                        		$sql = "select id,事件名,状态,备注  from 日程设置 where 用户id='".$userid."' and 事件时间='".date('Y-m-d')."' and 删除状态=0 ";
		                        		if(!$ShowStu){
		                        			$sql.="and 状态 = 0";
		                        		}
						                		$result = $conn->query($sql);
						                		if($result->num_rows>0){
						                			while($row = $result->fetch_assoc()){
						                				$CId = $row['id'];
						                				$CNa = $row['事件名'];
						                				$CSt = $row['状态'];
						                				$CEl = $row['备注'];
//						                				$CId = $row['id'];
						                				?>
						                				<tr>
						                						<td class="numeric" hidden="hidden" ><?php echo $CId; ?></td>
						                						<!--<td class="numeric" hidden="hidden"><?php echo $CId; ?></td>-->
						                            <td class="numeric"><input type="checkbox" class="<?php echo $CSt; ?> chebox" hidden="hidden" /></td><!--onclick='ChanStu(this)' hidden="hidden"-->
						                            <td class="numeric MesChan"><?php echo $CNa; ?></td>
						                            <td class="numeric MesChan"><?php echo $CEl; ?></td>
						                            <td class="numeric MesChan">
						                            	<input hidden="hidden" type="checkbox" class="<?php echo $CSt; ?> chebox"  onclick='ChanStu(this)' />
						                            	<a class="btn" onclick="Chang_matter(this)"><i class="fa fa-pencil"></i></a>
						                            	<a class="btn" onclick="Delete_data(this)"><i class="fa fa-times"></i></a>
						                            	<input type="button" value="完成" onclick="CheckOn(this)" />
						                            	&nbsp;
						                            	<input type="button" name="<?php echo $CId;?>" value="上传" onclick="UpFiles(this.name)" />
						                            </td>
						                        </tr>
						                				<?php
						                			}
						                		}else{
						                			?>
						                				<tr id="NoneDaWk">
						                					<th colspan="5"><strong>本日没有计划内日程</strong></th>
						                				</tr>
						                			<?php
						                		}
		                        	?>
		                        </tbody>
		                    </table>
	                      </div>
		                </aside>
		                <br />
		                <br />
		                
				        	</div>
				        </div>
	        		</section>
	        	</div>
	        	 <!--正常日程-->
        	</div>
        </div>
				<!--body wrapper end-->

    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script type="text/javascript" src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>

<!--<script src="../../js/fullcalendar/fullcalendar.js"></script>
<script src="../../js/external-dragging-calendar.js"></script>-->

<!--calendar new-->
<script src="../../js/JMCalendar/fullcalendar/fullcalendar.js"></script>
<script src="../../js/JMCalendar/fullcalendar/gcal.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--各种响应-->
<script src="../../js/imitation_2/dateworks.js"></script>
<!--about 常态-->
<!--<script src="../../js/NormalS-2.js"></script>-->

</body>
</html>
