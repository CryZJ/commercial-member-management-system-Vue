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
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="../../index.php"><img src="../../images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="../../index.php"><img src="../../images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
						 <li class="menu-list"><a href="../../index.php"><i class="fa fa-laptop"></i><span>案件管理</span></a>
							<ul class="sub-menu-list">
                <li><a href="../../index.php">专利案件</a></li>
                <li><a href="../imitation_1/blogo_case/blogo.php">商标案件</a></li>
                <li><a href="../imitation_1/software_case/software.php">软件案件</a></li>
                <li><a href="../imitation_1/works_case/works.php">著作案件</a></li>
                <li><a href="../imitation_1/customs_case/customes.php">海关备案</a></li>
              </ul>
             </li>
             	<li class="menu-list nav-active"><a href=""><i class="fa fa-laptop"></i> <span>OA办公</span></a>
             		<ul class="sub-menu-list">
             			<li><a href="../imitation_2/mailmas.php">文件收发</a></li>
             			<li><a href="../imitation_2/exdelmas.php">快递收发</a></li>
             			<li class="active"><a href="../imitation_2/casemark.php">案件登记</a></li>
             			<li><a href="../imitation_2/dateworks.php">日程管理</a></li>
             			<li><a href="../imitation_2/ClieMag.php">客户管理</a></li>
             		</ul>
             	</li>
            	<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>费用管理</span></a>
            		<ul class="sub-menu-list">
		                <li><a href="../imitation_3/cost.php">专利其他费用</a></li>
		                <li><a href="../imitation_3/yearcost.php?flag=none&v=0">专利年费管理</a></li>
		                <!--<li><a href="../imitation_3/cost_zl.php">其他费用管理</a></li>-->
	                </ul>
              	</li>
             	<!--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>事件管理</span></a>
             		<ul class="sub-menu-list">
             			<li><a href="../imitation_4/dateline.php">案件流程监控</a></li>
             			<li><a href="../imitation_4/filemag.php">文件管理</a></li>
             		</ul>
             	</li>-->
             	<li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>人员管理</span></a>
             		<ul class="sub-menu-list">
	                <li><a href="../imitation_5/client.php"> 申请人管理</a></li>
	                <li><a href="../imitation_5/agent.php">账号管理</a></li>
	               </ul>

	            </li>
	            <?php
	            	require'../../conn.php';
	            	$sql = "select sys_set,fare_con from 用户 where id='".$userid."'";
	            	$result = $conn->query($sql);
	            	if($result -> num_rows>0){
	            		while($row = $result->fetch_assoc()){
	            			$sysset = $row['sys_set'];
	            			$fareco = $row['fare_con'];
	            		}
	            	}
	            	
	            	if($sysset == 1){
	            		?>
	            		<li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>系统设置</span></a>
			                <ul class="sub-menu-list">
				                <!--<li><a href="../imitation_7/efare_set.php">流程设置</a></li>-->
				                <li><a href="../imitation_7/yfare_set.php">年费设置</a></li>
				                <li><a href="../imitation_7/bank_set.php">银行账户设置</a></li>
				            	<li><a href="../imitation_7/fare_set.php">专案费用名设置</a></li>
				            	<li><a href="../imitation_7/BLogoC_set.php">商标代理人设置</a></li>
											<li><a href="../imitation_7/Circuit_set.php">流程设置</a></li>
				            </ul>
			            </li>
	            		<?php
	            	}
	            	if($fareco == 1){
	            		?>
	            		 <li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>财务管理</span></a>
		                	<ul class="sub-menu-list">
				                <li><a href="../imitation_6/financial-management.php">财务管理</a></li>
				            </ul>
		                </li>
	            		<?php
	            	}
	            ?>
                <li><a href="../../login.php"><i class="fa fa-sign-in"></i> <span>账号注销</span></a></li>
    		</ul>
            <!--sidebar nav end-->

        </div>
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
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">1</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">日程备忘</h5>
                            <ul class="dropdown-list user-list">
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>事件一</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>事件二</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
                                                <span class="">80% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!--<li class="new"><a href="">See All Pending Task</a></li>-->
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">待处理文件</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <!--<a href="">-->
                                        <!--<span class="thumb"><img src="../../images/photos/user1.png" alt="" /></span>-->
                                        <span class="desc">
                                          <span class="name">发件人一<span class="badge badge-success">new</span></span>
                                          <span class="msg">案件名称/文件名</span>
                                        </span>
                                    <!--</a>-->
                                </li>
                                <li>
                                    <!--<a href="">-->
                                        <!--<span class="thumb"><img src="../../images/photos/user2.png" alt="" /></span>-->
                                        <span class="desc">
                                          <span class="name">发件人二</span>
                                          <span class="msg">案件名称/文件名</span>
                                        </span>
                                    <!--</a>-->
                                </li>
                                <li class="new">
                                	<a href="">
                                		<span class="desc">
                                          <span >进入文件下载页面</span>
                                        </span>
                                </a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">操作提醒</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">提醒类型</span>
                                        <em class="small">案件/操作</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">提醒类型</span>
                                        <em class="small">案件/操作</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">
                                		<span class="desc">
                                          <span >进入提醒页面</span>
                                        </span>
                                </a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo $name; ?>
                        </a>
                    </li>

                </ul>
            </div>
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
				        <li class=""><a href="dateworks.php">日程计划</a></li>
				        <li class="active"><a href="#">逾期日程</a></li>
				        <input id="NORS" hidden="hidden" value="<?php echo $normal; ?>" /><!--勿删-->
				      </ul>
			      </header>
				<div class="panel-body">
	        	 <!--逾期计划-->
        <div class="tab-pane" id="about-1">
	    		  <section id="unseen">
				        <div class="panel-body">
				        		<input class="btn btn-primary" type="button" value="新增记录" id="addnew" onclick="addnew()" />
						        <!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">
                        	<?php 
                        		require'../../conn.php';
                        		//查询
                        		$sqlO1 = "select OA案件1 from 表格顺序 where 用户id = '".$userid."'";
                        		$resultO1 = $conn->query($sqlO1);
                        		if($resultO1->num_rows>0){
                        			while($rowO1 = $resultO1->fetch_assoc()){
                        				$order = $rowO1['OA案件1'];
                        			}
                        		}
                        		if(strlen($order)<1){
                        			$order = '1/asc/接单日期【正】';
                        		}
                        		//显示
                        		$order = explode('/',$order);
                        		echo $order[2];
                        	?>
                        	<span class="caret"></span>
                        	<span class="dynamic-table" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" ><!--OrderZL()--> 
                            <li><a href="#">联系时间【正】</a></li>
                            <li><a href="#">联系时间【倒】</a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
						        	<thead>
	                        <tr>
	                            <th style="width: 2%;">#</th>
	                            <th>计划时间</th>
	                            <th style="width: 58%;">计划安排</th>
	                            <th class="numeric">备注</th>
	                        </tr>
                        </thead>
                        <tbody>
                        	<?php
                        		require'../../conn.php';
                        		$sql = "select id,事件名,事件时间,状态,备注  from 日程设置 where 用户id='".$userid."' and 事件时间<'".date('Y-m-d')."' ";
				                		$result = $conn->query($sql);
				                		if($result->num_rows>0){
				                			while($row = $result->fetch_assoc()){
				                				$CId = $row['id'];
				                				$CDt = $row['事件时间'];
				                				$CNa = $row['事件名'];
				                				$CSt = $row['状态'];
				                				$CEl = $row['备注'];
				                				?>
				                				<tr>
				                            <td class="numeric"><input type="checkbox" /></td>
				                            <td class="numeric"><?php echo $CDt; ?></td>
				                            <td class="numeric"><?php echo $CNa; ?></td>
				                            <td class="numeric"><?php echo $CEl; ?></td>
				                        </tr>
				                				<?php
				                			}
				                		}
                        	?>
                        </tbody>
						        </table>
	        		</section>
	        	</div>
    		<div class="tab-pane" id="about-2">
    		  	<section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
				        		<!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuT">
                        	<?php 
                        		require'../../conn.php';
                        		//查询
                        		$sqlO1 = "select OA案件2 from 表格顺序 where 用户id = '".$userid."'";
                        		$resultO1 = $conn->query($sqlO1);
                        		if($resultO1->num_rows>0){
                        			while($rowO1 = $resultO1->fetch_assoc()){
                        				$order = $rowO1['OA案件2'];
                        			}
                        		}
                        		if(strlen($order)<1){
                        			$order = '1/asc/接单日期【正】';
                        		}
                        		//显示
                        		$order = explode('/',$order);
                        		echo $order[2];
                        	?>
                        	<span class="caret"></span>
                        	<span class="dynamic-table_2" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuT" ><!--OrderZL()--> 
                            <li><a href="#">接单日期【正】</a></li>
                            <li><a href="#">接单日期【倒】</a></li>
                            <li><a href="#">案源人</a></li>
                            <li><a href="#">客户姓名</a></li>
                            <li><a href="#">接单内容</a></li>
                            <li><a href="#">代理人</a></li>
                            <li><a href="#">处理情况</a></li>
                            <li><a href="#">收费情况</a></li>
                            <li><a href="#">预计完成日期【正】</a></li>
                            <li><a href="#">预计完成日期【倒】</a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
						        <table  class="display table table-bordered table-striped" id="dynamic-table_2">
						        	<thead>
								        <tr> 
							        	  	<th hidden="hidden">id</th>
								        		<th>接单日期</th>
								            <th>案源人</th>
								            <th>客户姓名</th>
								            <th>接单内容</th>
								            <th>代理人</th>
								            <th>处理情况</th>
								            <th>收费情况</th>
								            <th>预计完成日期</th>
								            <th>备注</th>
								            <th>操作</th>
								        </tr>
						        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		$sql="select id,接单日期,预计完成时间,客户姓名,接单内容,案源人,代理人,处理情况,状态,收费情况,备注 from 办公_案件基本登记   where  状态='1'";
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        	?>
				        				<tr>
				        					<td hidden="hidden"><?php echo $row['id']; ?></td>
				        					<td><?php echo $row['接单日期']; ?></td>
				        					<td><?php echo $row['案源人']; ?></td>
				        					<td><?php echo $row['客户姓名']; ?></td>
				        					<td><?php echo $row['接单内容']; ?></td>
				        					<td><?php echo $row['代理人']; ?></td>
				        					<td><?php echo $row['处理情况']; ?></td>
				        					<td><?php echo $row['收费情况']; ?></td>
				        					<td><?php echo $row['预计完成时间']; ?></td>
				        					<td><?php echo $row['备注']; ?></td>
				        					<td>
				        						<input type="button" onclick="caseche(<?php echo $row['id']; ?>)" value="查看" />
				        						<input type="button" class="delete" id="<?php echo $row['id']; ?>" value="删除" />
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
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--页面响应-->
<script src="../../js/imitation_2/casemark.js"></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<script>
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
	var tab1 = $(".dynamic-table").html();//获取排序表1
	var tab2 = $(".dynamic-table_2").html();//获取排序表2
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
	var turn2 = tab2.split('/');
	//排序设置
   var myTable_1 = $('#dynamic-table').dataTable( {
        "aaSorting": [[ turn1[0], turn1[1] ]]
    } );
	 var myTable_2 = $('#dynamic-table_2').dataTable( {
        "aaSorting": [[ turn2[0], turn2[1] ]]
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
                
    $('#dynamic-table input.delete').live('click', function (e) {
//      e.preventDefault();
        id = $(this).attr("id");
//      alert(id);
        if (confirm("确定要删除这行数据吗?")){
        	var nRow = $(this).parents('tr')[0];
        	myTable_1.fnDeleteRow(nRow);
          $.ajax({
						url:"casemark_save.php",
						type:"post",
						async:true,
						data:{
							flag:'del',
							self_id:id
						},
						success:function(data){
							alert(data);
						}
					});
        }
    });
    $('#dynamic-table_2 input.delete').live('click', function (e) {
	    e.preventDefault();
	    id = $(this).attr("id");
	//      alert(id);
	    if (confirm("确定要删除这行数据吗?")){
	    	var nRow = $(this).parents('tr')[0];
	    	myTable_2.fnDeleteRow(nRow);
	      $.ajax({
						url:"casemark_save.php",
						type:"post",
						async:true,
						data:{
							flag:'del',
							self_id:id
						},
						success:function(data){
							alert(data);
						}
					});
	    }
    });    
    
} );
</script>
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
				page:'OACMARK'
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
