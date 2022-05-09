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

  <title>OA办公-案件登记</title>
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
				Create_leftlist(1,2);
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
				        <li class="about-1"><a href="#about-1" data-toggle="tab">处理中案件</a></li>
				        <li class="about-2"><a href="#about-2" data-toggle="tab">已完成案件</a></li>
				        <input type="text" id="czyid" hidden="hidden" value="<?php echo $userid; ?>" />
				      	<input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
				      </ul>
			      </header>
		<div class="panel-body">
        <div class="tab-content">    
	        <div class="tab-pane" id="about-1">
	    		  <section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
				        		<input class="btn btn-primary" type="button" value="登记新增" id="addnew" onclick="addnew()" />
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
                    <!--查询条件 start-->
                    <br /><br />
                    <?php 
		                	if($_SERVER["REQUEST_METHOD"] == "POST"){//检测是否进行查询
		                		$checkdata = $_POST["checkdata"];
	//											print_r($checkdata);
												if($checkdata[0]!="" || $checkdata[1]!=""){
										?>
										<input type="text" id="ischecked" value="有查询信息" hidden="hidden" />
										<div id="check_data">
										<?php
												foreach($checkdata as $ky){
										?>
											<input type="text" value="<?php echo $ky; ?>" hidden="hidden" />
										<?php			
												}
										?>
										</div>
										<?php		
											}else{
										?>
										<input type="text" id="ischecked" value="没有查询信息" hidden="hidden" />
										<?php
											}
	                	}else{
	                		$checkdata = array("0"=>"","1"=>"");
	                	?>
	                	<input type="text" id="ischecked" value="没有查询信息" hidden="hidden" />
										<?php	
	                	}
	                	?>
                    <form action="#" method="post" id="Checkformdata">
	 										<table class="table table-condensed table-striped" style="width: 450px;">
	 											<tr>
	 												<td>案源人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="checkdata[]" value="<?php echo $checkdata[0];?>" id="check_ayr" onclick="select_ayr_2(this.id)" readonly="readonly" /></td>
	 												<td>代理人：</td>
	 												<td><input type="text" style="width: 60px;height: 20px;font-size: 5px;" name="checkdata[]" value="<?php echo $checkdata[1];?>" id="check_dlr" onclick="select_dlr_2(this.id)" readonly="readonly" /></td>	 												 											
	 												<td style="text-align: right;"><input style="height: 20px;" type="submit" value="查询" /></td>
	 												<td style="text-align: right;"><input style="height: 20px;" type="reset" value="清除" onclick="Clear_checkdata()" /></td>
	 											</tr>
	 										</table>               		
	                	</form>
                    <!--查询条件 end-->
                    
						        <table  class="table table-bordered table-striped" id="dynamic-table">
						        	<thead>
						        		<tr>
							        		<th class="numeric" style="width: 10%;">接单日期</th>
							            <th class="numeric" style="width: 8%;">案源人</th>
							            <th class="numeric" style="width: 10%;">客户姓名</th>
							            <th class="numeric" style="width: 10%;word-break: break-all;">接单内容</th>
							            <th class="numeric" style="width: 8%;">代理人</th>
							            <th class="numeric" style="width: 10%;">处理情况</th>
							            <th class="numeric" style="width: 10%;">收费情况</th>
							            <th class="numeric" style="width: 10%;">预计完成日期</th>
							            <th class="numeric" style="word-break: break-all;width-max:200px">备注</th>
							            <th class="numeric" style="width: 12%;">操作</th>
							          </tr>
						        	</thead>
						        	<tbody>
						        	
						        	</tbody>
						        </table>
				        	</div>				        	
				        </div>
	        		</section>
	        	</div>
    		<div class="tab-pane" id="about-2">
    		  	<section id="unseen">
				        <div class="panel-body">
				        	<div class="adv-table">
				        		<?php
				        			if($admin){
				        				?>
				        				<button class="btn btn-danger" onclick="delAll()">删除</button>
				        				<?php
				        			}
				        		?>
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
								        		<th style="width: 50px;"><input type="checkbox" onclick="selectAll(this,'dynamic-table_2')" /></th> 
								        		<th style="width: 100px;">接单日期</th>
								            <th style="width: 80px;">案源人</th>
								            <th>客户姓名</th>
								            <th>接单内容</th>
								            <th style="width: 80px;">代理人</th>
								            <th style="width: 100px;">处理情况</th>
								            <th style="width: 100px;">收费情况</th>
								            <th style="width: 100px;">预计完成日期</th>
								            <th style="width: 100px;">实际完成日期</th>
								            <th>备注</th>
								            <th style="width: 80px;">操作</th>
								        </tr>
						        	</thead>
						        	<tbody>
						        	
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


<!--pickers plugins-->
<script src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--页面响应-->
<script src="../../js/imitation_2/casemark.js"></script>
<!--about 常态-->
<script src="../../js/NormalS-2.js"></script>
<script type="text/javascript">
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
	if($("#ischecked").attr("value") == "没有查询信息"){
		var myTable_1 = $('#dynamic-table').dataTable( {
				"aaSorting": [],
				"aLengthMenu": [
            [5, 15, 20,30,100, -1],
            [5, 15, 20,30,100, "All"] 
        ],
        "iDisplayLength": 5,
        "oLanguage":{
        	"oPaginate":{
        		"sFirst":"首页",
        		"sLast":"尾页",
        		"sNext":"下一页",
        		"sPrevious":"上一页"
        	},
        	"sEmptyTable": "无数据！",
        	"sLoadingRecords": "加载中...",
        	"sProcessing": "加载中...",
        	"sSearch": "查询：",
        	"sZeroRecords": "没找到符合的数据",
        },
        "sAjaxSource": "table_jsondata.php",
	        "sServerMethod": "GET",
	        "fnServerParams": function ( aoData ) {
		        aoData.push({ "name": "my_flag", "value": "案件登记处理中" },{"name":"ischeck","value":"没有查询"});
		    	},
					"sAjaxDataProp": "data",
					"aoColumns":[
						{"mData":"接单日期"},
						{"mData":"案源人"},
						{"mData":"客户姓名"},
						{"mData":"接单内容"},
						{"mData":"代理人"},
						{"mData":"处理情况"},
						{"mData":"收费情况"},
						{"mData":"预计完成时间"},
						{"mData":"备注"},
						{"mData":"操作"},
					]
    } );
	}else{
		var myTable_1 = $('#dynamic-table').dataTable( {
				"aaSorting": [],
				"aLengthMenu": [
            [5, 15, 20,30,100, -1],
            [5, 15, 20,30,100, "All"] 
        ],
        "iDisplayLength": 5,
        "oLanguage":{
        	"oPaginate":{
        		"sFirst":"首页",
        		"sLast":"尾页",
        		"sNext":"下一页",
        		"sPrevious":"上一页"
        	},
        	"sEmptyTable": "无数据！",
        	"sLoadingRecords": "加载中...",
        	"sProcessing": "加载中...",
        	"sSearch": "查询：",
        	"sZeroRecords": "没找到符合的数据",
        },
        "sAjaxSource": "table_jsondata.php",
	        "sServerMethod": "GET",
	        "fnServerParams": function ( aoData ) {
		        aoData.push({ "name": "my_flag", "value": "案件登记处理中" },{"name":"ischeck","value":"有查询"},{"name":"ayr","value":$("#check_data input:eq(0)").attr("value")},{"name":"dlr","value":$("#check_data input:eq(1)").attr("value")});
		    	},
					"sAjaxDataProp": "data",
					"aoColumns":[
						{"mData":"接单日期"},
						{"mData":"案源人"},
						{"mData":"客户姓名"},
						{"mData":"接单内容"},
						{"mData":"代理人"},
						{"mData":"处理情况"},
						{"mData":"收费情况"},
						{"mData":"预计完成时间"},
						{"mData":"备注"},
						{"mData":"操作"},
					]
    } );
	}
   
	 var myTable_2 = $('#dynamic-table_2').dataTable( {
				"aaSorting": [],
				"aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ],
        "aLengthMenu": [
            [5, 15, 20,30,100, -1],
            [5, 15, 20,30,100, "All"] 
        ],
        "iDisplayLength": 5,
        "oLanguage":{
        	"oPaginate":{
        		"sFirst":"首页",
        		"sLast":"尾页",
        		"sNext":"下一页",
        		"sPrevious":"上一页"
        	},
        	"sEmptyTable": "无数据！",
        	"sLoadingRecords": "加载中...",
        	"sProcessing": "加载中...",
        	"sSearch": "查询：",
        	"sZeroRecords": "没找到符合的数据",
        },
        "sAjaxSource": "table_jsondata.php",
	        "sServerMethod": "GET",
	        "fnServerParams": function ( aoData ) {
		        aoData.push({ "name": "my_flag", "value": "案件登记已结案" });
		    	},
					"sAjaxDataProp": "data",
					"aoColumns":[
						{"mData":"inputcheckbox","sClass":"center"},
						{"mData":"接单日期"},
						{"mData":"案源人"},
						{"mData":"客户姓名"},
						{"mData":"接单内容"},
						{"mData":"代理人"},
						{"mData":"处理情况"},
						{"mData":"收费情况"},
						{"mData":"预计完成时间"},
						{"mData":"实际完成时间"},
						{"mData":"备注"},
						{"mData":"操作"},
					]
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
	//全选
function selectAll(obj,tab_id){
	if($(obj).attr("checked")){
		$("#"+tab_id+" input[class='boxson']").attr("checked",true);
	}else{
		$("#"+tab_id+" input[class='boxson']").attr("checked",false);
	}

}
//打开选择案源人窗口
function select_ayr_2(id){
	//	alert(id);
	var ayr = document.getElementById(id);
	
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_ayr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.ayr_name){
					$("#"+id).attr("value",localStorage.ayr_name);
					ayr.value = localStorage.ayr_name;
					
					localStorage.clear();
				}else{
					ayr.value = '';
					alert("未选中案源人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//打开选择代理人窗口
function select_dlr_2(id){
	//alert(return_data);
	var dlr = document.getElementById(id);
	//	dlr = dlr.value.length;
	var scr_height = window.screen.availHeight;
	var scr_width = window.screen.availWidth;
	var bro_height = 500;
	var bro_width = 800;
	var top = (scr_height-bro_height)/2;
	var left = (scr_width-bro_width)/2;
	var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
	var winobj = window.open("../../select_dlr.php","_blank",specs);
	var loop = setInterval(function(){
		if(winobj.closed){
			clearInterval(loop);
			if(typeof(Storage)!=="undefined"){
				if(localStorage.dlr_name){
					$("#"+id).attr("value",localStorage.dlr_name);
					dlr.value = localStorage.dlr_name;
					
					localStorage.clear();
				}else{
					dlr.value = '';
					alert("未选中代理人！");
				}
			}else{
				alert("抱歉！该浏览器版本不支持web存储。");
			}
		}
	},1);
}
//清除查询条件
function Clear_checkdata(){
	$("#Checkformdata input[type='text']").attr("value","");
	$("#Checkformdata input[type='date']").attr("value","");
	$("#Checkformdata option[selected='selected']").attr("selected",false);
}

</script>


</body>
</html>
