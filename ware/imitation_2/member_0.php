<?php require("../../AHeader.php"); ?>

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

  <title>选择发送的人</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  
  <!--multi-select-->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-multi-select/css/multi-select.css" />
	

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start :主要内容-->
    <section class="panel">
      <header class="panel-heading custom-tab">
	          选择接收人
      	<span class="tools pull-right">
      		<a href="javascript:;" class="fa fa-chevron-down"></a>
  		</span>
      </header>
	<div class="panel-body">
        <div class="tab-content">    
	        <div class="tab-pane active" id="about-1">
	    		<section id="unseen">
					<div class="wrapper">
        				<div class="row">
        					<header class="panel-heading">
	        					<button class="btn btn-primary" data-toggle="modal" id="make">确定</button>
	        					<button class="btn btn-primary" data-toggle="modal" id="Done_after" style="display: none;">正在发送中</button>
	        				</header>
				        	<div class="panel-body">
				        		<div class="adv-table">
				        			<input type="text" hidden="hidden" id="str_id" value="<?php echo $_GET['rowid_str'] ?>" />
				        			<input type="text" hidden="hidden" id="ajax_flag" value="<?php echo $_GET['ajax_flag'] ?>" />
				        			<div class="form-group last">
		                                <label class="control-label col-md-3">选择文件接收人：</label>
		                                <div class="col-md-9">
		                                    <select name="country" class="multi-select" multiple="" id="my_multi_select3">
					                            <!--<option value="24">周值煜</option>-->
					                            <?php
					                            	require("../../conn.php"); 
					                            	$sql = "SELECT id,名称 FROM 用户 WHERE 状态='0' AND 账号<>'admin'";
													$result = $conn->query($sql);
													if($result->num_rows>0){
														while($row = $result->fetch_assoc()){
												?>
													<option value="<?php echo $row["id"]; ?>"><?php echo $row["名称"]; ?></option>
												<?php			
														}
													}
													$conn->close();
					                            ?>
		                            		</select>
		                            	</div>
		                            </div> 
				        		</div>				        	
				        	</div>
			        	</div>
				    </div>
	        	</section>
	        </div>
        </div>
    </div>
    
    </section>                                   			
    </div>
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
<!--dynamic table initialization 初始化-->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--multi-select-->
<script type="text/javascript" src="../../js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="../../js/jquery-multi-select/js/jquery.quicksearch.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	
	//初始化人员选择
    $('#my_multi_select3').multiSelect({
	    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询待选人...'>",
	    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='查询已选人...'>",
	    afterInit: function (ms) {
	        var that = this,
	            $selectableSearch = that.$selectableUl.prev(),
	            $selectionSearch = that.$selectionUl.prev(),
	            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
	            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
	
	        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	            .on('keydown', function (e) {
	                if (e.which === 40) {
	                    that.$selectableUl.focus();
	                    return false;
	                }
	            });
	
	        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	            .on('keydown', function (e) {
	                if (e.which == 40) {
	                    that.$selectionUl.focus();
	                    return false;
	                }
	            });
	    },
	    afterSelect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    },
	    afterDeselect: function () {
	        this.qs1.cache();
	        this.qs2.cache();
	    }
	});
	
    //确认按钮
    $("#make").click(function(){
    	$(this).css("display","none");
    	$("#Done_after").css("display","block");
    	var userid_str = "";
    	var num_user = 0;
    	
    	$("#my_multi_select3 option").each(function(){
    		if($(this).attr("selected")){
    			userid_str += ","+$(this).attr("value");
    			num_user++;
    		}
    	});
    	if(userid_str){
    		userid_str = userid_str.substr(1);
    		var rowid_str = $("#str_id").attr("value");
    		var ajax_flag = $("#ajax_flag").attr("value");
    		if(confirm("是否确定向"+num_user+" 个人发送文件？")){
    			console.log(userid_str+"\n next "+rowid_str);
    			$.ajax({
					data:{
						my_flag:"send_make",
						userid_str:userid_str,
						rowid_str:rowid_str,
						ajax_flag:ajax_flag
					},
					type:"post",
					url:"member_ajax.php",
					async:true,
					success:function(data){
//						console.log(data)
						alert(data);
	//					alert("发送成功！");
	//					window.returnValue="refresh";
						window.close();
					},
					error:function(){
						alert("ajax error! + 发送文件失败！");
					}
				});
    		}else{
    			$(this).css("display","block");
    			$("#Done_after").css("display","none");
    		}
    	}else{
    		alert("未选中接收人！");
    		$(this).css("display","block");
    		$("#Done_after").css("display","none");
    	}
    });	
    
});


	

//var tab_send = document.getElementById("tab_send");
//var make = document.getElementById("make");
//
////var accept_id = window.dialogArguments;
////alert(accept_id);
//var accept_id = document.getElementById("str_id").value
//
//
//
////确定发送
////发送文件
//make.addEventListener("click",function(){
//	var str_name = new String();
//	inp_che = tab_send.getElementsByTagName("input");
//	var num = 0;
//	for(i=0;i<inp_che.length;i++){
//		if(inp_che[i].checked){
//			str_name = str_name + inp_che[i].value + ",";
//			num++;
//		}
//	}
//	str_name = str_name.substr(0,(str_name.length-1));
//	if(str_name.length != 0){
//		if(confirm("是否确定向（"+str_name+"）等  "+num+" 个人发送文件？")){
////			alert(str_name + "//" +accept_id);
//			$.ajax({
//				data:{
//					my_flag:"send_make",
//					member_name:str_name,
//					accept_id:accept_id
//				},
//				type:"post",
//				url:"member_ajax.php",
//				async:true,
//				success:function(data){
//					alert(data);
////					alert("发送成功！");
////					window.returnValue="refresh";
//					window.close();
//				},
//				error:function(){
//					alert("ajax error! + 发送文件失败！");
//				}
//			});
//		}
//	}else{
//			alert("没有勾选人员！");
//	}		
//});
	
</script>

</body>
</html>
