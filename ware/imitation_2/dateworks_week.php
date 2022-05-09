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

  <title>OA办公-日程管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  
	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
	
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
  <style type="text/css">
  	table th{
  		width: 100px;
  		word-wrap: break-word;
  	}
  </style>
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
				        <li class=""><a href="dateworks.php">日程计划</a></li>
				        <li class=""><a href="dateworks_set.php">逾期日程</a></li>
				        <li class="active"><a href="#about-1">周日程</a></li>
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
		<div class="panel-body">
        <div class="tab-content">    
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
						        <!-- /btn-group -->
				            	<!--<div class="btn-group" style="float: right;">
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="MenuO">-->
                        	<?php 
//                      		require'../../conn.php';
//                      		//查询
//                      		$sqlO1 = "select OA案件1 from 表格顺序 where 用户id = '".$userid."'";
//                      		$resultO1 = $conn->query($sqlO1);
//                      		if($resultO1->num_rows>0){
//                      			while($rowO1 = $resultO1->fetch_assoc()){
//                      				$order = $rowO1['OA案件1'];
//                      			}
//                      		}
//                      		if(strlen($order)<1){
//                      			$order = '1/asc/计划时间【正】';
//                      		}
//                      		//显示
//                      		$order = explode('/',$order);
//                      		echo $order[2];
                        	?>
                        	<!--<span class="caret"></span>
                        	
                        </button>
                        <ul role="menu" class="dropdown-menu checilck" id="MenuO" >
                            <li><a href="#">计划时间【正】</a></li>
                            <li><a href="#">计划时间【倒】</a></li>
                        </ul>
                    </div>-->
                    <!-- /btn-group -->
                    <span class="dynamic-table" hidden="hidden" >1/asc/计划时间【正】</span>
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
						        	<thead>
	                        <tr>
	                        		<th class="numeric" hidden="hidden"></th>
	                            <th style="width: 2%;"  hidden="hidden">#</th>
	                            <th>计划时间</th>
	                            <th style="width: 58%;">计划安排</th>
	                            <th class="numeric">备注</th>
	                            <th class="numeric">创建人</th>
	                            <th class="numeric">操作</th>
	                        </tr>
                        </thead>
                        <tbody>
                        	<?php
                        		require'../../conn.php';
														function Getweek_date(){
															$week_num = date("N");//1（表示星期一）到 7（表示星期天）
															$now_date = date("Y-m-d");
															switch($week_num){
																case 1:
																	$start_date = $now_date;
																	$end_date = date("Y-m-d",strtotime("6days",strtotime($now_date)));
																	break;
																case 2:
																	$start_date = date("Y-m-d",strtotime("-1days",strtotime($now_date)));
																	$end_date = date("Y-m-d",strtotime("5days",strtotime($now_date)));
																	break;
																case 3:
																	$start_date = date("Y-m-d",strtotime("-2days",strtotime($now_date)));
																	$end_date = date("Y-m-d",strtotime("4days",strtotime($now_date)));
																	break;
																case 4:
																	$start_date = date("Y-m-d",strtotime("-3days",strtotime($now_date)));
																	$end_date = date("Y-m-d",strtotime("3days",strtotime($now_date)));
																	break;
																case 5:
																	$start_date = date("Y-m-d",strtotime("-4days",strtotime($now_date)));
																	$end_date = date("Y-m-d",strtotime("2days",strtotime($now_date)));
																	break;
																case 6:
																	$start_date = date("Y-m-d",strtotime("-5days",strtotime($now_date)));
																	$end_date = date("Y-m-d",strtotime("1days",strtotime($now_date)));
																	break;
																case 7:
																	$start_date = date("Y-m-d",strtotime("-6days",strtotime($now_date)));
																	$end_date = $now_date;
																	break;
																default:
																	$start_date = "";
																	$end_date = "";	
															}
															$ret[0] = $start_date;
															$ret[1] = $end_date;
															return $ret;
														}
														$weekdate = Getweek_date();
														if($admin){
                        			$sql = "select id,用户id,事件名,事件时间,状态,备注  from 日程设置 where 事件时间 BETWEEN '".$weekdate[0]."' and '".$weekdate[1]."'  and 状态=0 and 删除状态=0 ";
														}else{
                        			$sql = "select id,用户id,事件名,事件时间,状态,备注  from 日程设置 where 用户id='".$userid."' and 事件时间 BETWEEN '".$weekdate[0]."' and '".$weekdate[1]."'  and 状态=0 and 删除状态=0 ";
														}
//				                		echo $sql;
				                		$result = $conn->query($sql);
				                		if($result->num_rows>0){
				                			while($row = $result->fetch_assoc()){
				                				$CId = $row['id'];
				                				$CDt = $row['事件时间'];
				                				$CNa = $row['事件名'];
				                				$CSt = $row['状态'];
				                				$CEl = $row['备注'];
				                				$sql = "SELECT 名称 FROM 用户 WHERE id='".$row['用户id']."'";
																$result_yh = $conn->query($sql);
																$yhm = "";
																if($result_yh->num_rows>0){
																	while($row_yh = $result_yh->fetch_assoc()){
																		$yhm = $row_yh['名称'];
																	}
																}				                				
				                				?>
				                				<tr>
				                						<td hidden="hidden"><?php echo $CId; ?></td>
				                            <td class="numeric" hidden="hidden"><input type="checkbox" /></td>
				                            <td class="numeric"><?php echo $CDt; ?></td>
				                            <td class="numeric"><?php echo $CNa; ?></td>
				                            <td class="numeric"><?php echo $CEl; ?></td>
				                            <td class="numeric"><?php echo $yhm; ?></td>
				                            <td class="numeric"><input type="button" value="完成" onclick="CheckOn(this)" /><input type="button" value="删除" onclick="Delete_data(this)" /></td>
				                        </tr>
				                				<?php
				                			}
				                		}
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
    </div>
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

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--页面响应-->
<script src="../../js/imitation_2/dateworks_week.js"></script>

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
//	var tab2 = $(".dynamic-table_2").html();//获取排序表2
//	alert($(".dynamic-table").html());
	//拆分数据
	var turn1 = tab1.split('/');
//	var turn2 = tab2.split('/');
	//排序设置
   var myTable_1 = $('#dynamic-table').dataTable( {
        "aaSorting": [[ turn1[0], turn1[1] ]]
    } );
//	 var myTable_2 = $('#dynamic-table_2').dataTable( {
//      "aaSorting": [[ turn2[0], turn2[1] ]]
//  } );
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
						url:"ClieMag_ajax.php",
						type:"get",
						async:true,
						data:{
							flag_ajax:'del',
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
//删除数据
function Delete_data(a_doc){
	if(confirm("是否确认删除该事件？")){
	td_doc = a_doc.parentNode;
	tr_doc = td_doc.parentNode;
	M_id = tr_doc.cells[0].innerHTML;
	$.ajax({
		type:"get",
		url:"dateworks_Save.php",
		async:true,
		data:{
			id:M_id,
			flag:"Deletcdata"
		},
		success:function(data){
			alert(data);
			Delete_Row(a_doc);
		},
		error:function(x,s,t){
			alert("删除失败！");
			console.log("ajax error!"+s+t);
			}
		});
	}
}
//取消新增
function Delete_Row(a_doc){
	tr_doc = a_doc.parentNode.parentNode;
	tab_doc = tr_doc.parentNode.parentNode;
	tab_doc.deleteRow(tr_doc.rowIndex);
}
//完成
function CheckOn(obj){
	if (obj.value == '完成') {
		td_doc = obj.parentNode;
		var OInput = td_doc.getElementsByTagName('input');
		OInput[0].checked = true;
		ChanStu(OInput[0]);
		return ;
	}
	td_doc = obj.parentNode;
	var OInput = td_doc.getElementsByTagName('input');
	OInput[0].checked = false;
	ChanStu(OInput[0]);
	return ;
	
}
function ChanStu(obj){//日期事项状态改变
	if (obj.checked) {
		var CS = 1;
	} else{
		var CS = 0;
	}
	var objtd = obj.parentNode;
	var objtr = objtd.parentNode;
	var MId	  = objtr.cells[0].innerHTML;
//		 		alert(MId);
//		 		alert(CS);
  	$.ajax({
  		type:"get",
  		url:"dateworks_Save.php",
  		async:true,
  		data:{
  			flag:'ChanStu',
  			stu:CS,
  			id:MId
  		},
  		success:function(data){
  			if(data){
  				//状态改变成功
  			Delete_Row(obj);
//				ShowTab(date.value);
  			}else{
  				alert('出现错误，请联系管理员');
  			}
  		}
//			  		,
//			  		error:function(x,t,e){
//			  			alert(e);
//			  		}
  	});
}
</script>


</body>
</html>
