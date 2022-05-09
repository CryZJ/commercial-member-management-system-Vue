<?php require'../../../AHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>
  <title>著作案件</title>
  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

	<!--jQuery库文件-->
	<script src="../../../js/jquery-1.10.2.min.js"></script>

	<!--提醒弹窗-->
<!--<script language="JavaScript">
	function ShowEdit_01(s_name){
		//var name=
		//var r = window.open("applicant.php?n=" + s_name,null,"");
		alert(s_、name);
	}
</script>-->

</head>

<body class="sticky-header">
<!--<body class="sticky-header" onload="show_remind()">-->
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
			<?php
				//创建左边菜单栏 
				require("../../../menu_tree.php"); 
				Create_leftlist(0,3);
			?>
    </div>
    <!-- left side end-->
    
    <!-- main content start--主页左上方的标志-->
    <div class="main-content" >
				
        <!-- header section start-->
        <div class="header-section">
            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--<a class="btn" href="javascript:openWin()"><i class="fa fa-pencil fa-fw" ></i></a>-->
            <!--toggle button end-->
		
					<!--notification menu start -->
          <?php require'../../../MenuMin-3.php';  ?>  
          <!--notification menu end -->
		
        </div>
        <!-- header section end-->

        <!--body wrapper start-->
		<div class="wrapper">
			<div class="row">
        	<div class="col-sm-12">
        		<section class="panel">
        			<header class="panel-heading custom-tab">
		              <ul class="nav nav-tabs">
		                <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>著作查询</a></li>
		               <input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
		              </ul>
           			</header>
           	<div class="panel-body">
			        	<div class="tab-content">                             
					        <div class="tab-pane active" id="about-1">
                  <section id="unseen">
									<!--<input type="text" placeholder="开始日期" id="date01" class="form-control">
	            		<input type="text" placeholder="截止日期" id="date02" class="form-control">-->
			            <!-- button list -->
				          	<div>
				              <!--<a href="case_zz.php" target="_blank"><button class="btn btn-success" type="button" id="Open_add()">新建</button></a>-->
				              <button class="btn btn-success" type="button" onclick="Open_add()">新建</button>
											<button class="btn btn-primary" type="button" onclick="jiean()">结案</button>
											<button class="btn btn-primary" type="button" onclick="huif()">恢复</button>
									<?php
//									if($admin==1||$lcczy==1){
								?>
											<button class="btn btn-warning" type="button" onclick="del()">删除</button>
										<?php
//									}
										if($admin==1){
								?>
											<button class="btn btn-danger" type="button" onclick="hid()">彻底删除</button>
											<?php
									}
								?>
										<a href="../../../phpexcel/my_test/zz_export.php" target="_blank"><button class="btn btn-primary" type="button">导出Excel清单</button></a>
	            			<button class="btn btn-primary" onclick="Export_someExcel('dynamic-table','../../../phpexcel/my_test/zz_export_some.php')">导出选中行Excel清单</button>
				            <!-- button list end -->
				            <!-- /btn-group -->
				            	<div class="btn-group" style="float: right;" >
	                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuPW">
	                        	<?php 
	                        		require'../../../conn.php';
	                        		//查询
	                        		$sqlO1 = "select 著 from 表格顺序 where 用户id = '".$userid."'";
	                        		$resultO1 = $conn->query($sqlO1);
	                        		if($resultO1->num_rows>0){
	                        			while($rowO1 = $resultO1->fetch_assoc()){
	                        				$order = $rowO1['著'];
	                        			}
	                        		}
	                        		if(strlen($order)<1){
	                        			$order = '1/asc/案卷号【正】';
	                        		}
	                        		//显示
	                        		$order = explode('/',$order);
	                        		echo $order[2];
	                        	?>
	                        	<span class="caret"></span>
	                        	<span class="dynamic-table" hidden="hidden" ><?php echo $order[0].'/'.$order[1]; ?></span>
	                        </button>
	                        <ul role="menu" class="dropdown-menu checilck" id="MenuPW" ><!--OrderZL()--> 
	                            <li><a href="#">案卷号【正】</a></li>
	                            <li><a href="#">案卷号【倒】</a></li>
	                            <li><a href="#">著作名称</a></li>
	                            <li><a href="#">申请人</a></li>
	                            <li><a href="#">案源人</a></li>
	                            <li><a href="#">代理人</a></li>
	                            <li><a href="#">申请号</a></li>
	                            <li><a href="#">申请日</a></li>
	                            <li><a href="#">当前程序</a></li>
	                        </ul>
	                    </div>
	                	<!-- btn-group -->
				            </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table" >
		                  <thead>
		                    <tr>
			                    <th class="numeric" style="width: 50px;"><input type="checkbox" id="SelectAll" /></th>
			                    <th class="numeric" style="width: 100px;">案卷号</th>
			                    <th class="numeric">著作名称</th>
			                    <th class="numeric">申请人</th>
			                    <th class="numeric" style="width: 100px;">案源人</th>
			                    <th class="numeric" style="width: 100px;">代理人</th>
			                    <th class="numeric" style="width: 100px;">申请号</th>
			                    <th class="numeric" style="width: 120px;">申请日</th>
			                    <th class="numeric" style="width: 100px;">当前程序</th>
			                    <th class="numeric" style="width: 100px;">登记号</th>
			                  </tr>
		                  </thead>
		                  <tbody>
                         <?php
						  require("../../../conn.php");
						 if($dlrbh != null && $ayrbh != null){
						 	if($admin == 1){
						 		$sql="select *  from 著作_信息  where 状态<>'3' order by id desc ";
						 	}else{
						 		$sql="select *  from 著作_信息  where 状态<>'3' and 状态<>'2' order by id desc";
						 	}
						 	
//									if($admin == 1){
//                      				$sql="select *  from 著作_信息  where 状态<>'3'";
//									}
//									else if($lcczy ==1){
//										$sql="select * from 著作_信息
//											  where (substr(案卷号,9,2) in (SELECT 编号 from 操作员下表  where czyid ='$userid' ) or substr(案卷号,6,2) in (SELECT 编号 from 操作员下表  where czyid ='$userid'  ) ) and 状态<>'2'and 状态<>'3' ";
//									}
//									else if($lcczy==0&&$admin==0){
//										$sql="select * from 著作_信息 where 状态<>'2'and 状态<>'3' and (substr(案卷号,6,2) ='$dlrbh' OR substr(案卷号,9,2)='$ayrbh')";
//									}
						  $result = $conn->query($sql);
						  if($result->num_rows >=0){
						  	while($row = $result->fetch_assoc()){
						  		//获取申请人id
//              				$SqrId = $row["申请人id"];
//              				$SqrId_arr = explode(',',$SqrId);
//              				$SQRMes = '';
//              						for($i=0;$i<count($SqrId_arr);$i++){
//              					$sql_SSqr = "select 申请人 from 申请人 where id='".$SqrId_arr[$i]."'";
//              					$result_SSqr = $conn->query($sql_SSqr);
//              					if($result_SSqr->num_rows > 0){
//              						while($row_SSqr = $result_SSqr -> fetch_assoc()){
//              							if(strlen($SQRMes) == 0){
//              								$SQRMes = $row_SSqr['申请人'];
//              							}else{
//              								$SQRMes = $SQRMes.','.$row_SSqr['申请人'];
//              							}
//              						}
//              					}
//              				}
						  			?>
						  			<tr>
                        					<th><label><input class="box_son" name="Fruit[]" type="checkbox" id="<?php echo $row["案卷号"];?>" /></label></th>
                        					<td class="numeric"><a href="zzxg.php?ajh=<?php echo $row["案卷号"];?>" target="_blank"><?php echo $row["案卷号"];?></a></td>
                        					<td class="numeric"><?php echo $row["著作名称"]; ?></td>
                        					<td class="numeric"><?php echo $row["申请人"]; ?></td>
                        					<td class="numeric"><?php echo $row["案源人"]; ?></td>
                        					<td class="numeric"><?php echo $row["代理人"]; ?></td>
                        					<td class="numeric"><?php echo $row["申请号"]; ?></td>
                        					<td class="numeric"><?php echo $row["申请日期"]; ?></td>
                        					<?php
                        						if($row["状态"]==0){
                        					?>
                        						<td class="numeric"><?php echo $row["案件状态"]; ?></td>
                        					<?php
                        						}  
                        					?>
                        					<?php
                        						if($row["状态"]==1){
                        					?>
                        						<td class="numeric">结案</td>
                        					<?php
                        						}  
                        					?>
                        					<?php
                        						if($row["状态"]==2){
                        					?>
                        						<td class="numeric">已删除</td>
                        					<?php
                        						}  
                        					?>
                        					<td class="numeric"><?php echo $row["登记号"]; ?></td>
                        				</tr>
                        				<?php
						  		}
                        		}		
                            }
                        	?>
                  </tbody>
                 </table>
                </section>
            	</div>
	        	</div>
	        	</div>
				    </section> 
        </section>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
<!--
	作者：yaolaoxiaotu@163.com
	时间：2017-01-12
	描述：
        <footer>
            2017 &copy; AdminEx by ThemeBucket
        </footer>
-->
        <!--footer section end-->


    </div>
    </div>
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

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
<!--<script src="../../../js/dynamic_table_init.js"></script>-->

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<!--<script src="js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>
<script src="../../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--结案，恢复，删除-->
<script src="../../../js/works_action.js"></script>
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
	//全选功能
	$("#SelectAll").change(function(){
		if($(this).attr("checked")){
			$("#dynamic-table input[class='box_son']").each(function(){
				$(this).attr("checked",true);
			});
		}else{
			$("#dynamic-table input[class='box_son']").each(function(){
				$(this).attr("checked",false);
			});
		}
	});
	
	//获取节点
	var tab1 = $(".dynamic-table").html();//获取排序软件案件
	//拆分数据
	var turn1 = tab1.split('/');
	//排序设置
    $('#dynamic-table').dataTable( {
//      "aaSorting": [[ turn1[0], turn1[1] ]],
				"aaSorting": [],
        "aoColumnDefs": [{
	            'bSortable': false,
	            'aTargets': [0]
	      }]
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
			url:'../../../OrderChange.php',
			type:'get',
			async:true,
			data:{
				falg:aim,//判断表格的依据
				order:Text,
				czyid:czyid,
				page:'PWork'
			},
			success:function(data){
//				console.log(data);
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

