<?php require'../../AHeader.php'; ?>
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
  <link rel="SHORTCUT ICON" href="../../images/output/logo.ico"/>

  <title>个案管理</title>

  <!--common-->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->

  <!--pickers css-->
	<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />
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
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>
            <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
			<?php
	  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
    			//获取案卷基本情况
    			require('../../conn.php');
    			$sql = "select id,冻结状态,状态,案源人,代理人,类型,专利名称 from 专利信息 a where a.案卷号='".$ajh."' ";
    			$result = $conn->query($sql);
    			if($result->num_rows > 0){
    				while($row = $result->fetch_assoc()){
							$CaseST = $row['冻结状态'];
							$zlxx = $row;
    				}
    			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
        	?>
	      <ul class="nav nav-tabs">
	        <li class="about-1 active"><a href="#about-1" data-toggle="tab"> 案卷基本情况 </a></li>
	        <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
	    		  	<input type="text" hidden="hidden" id="Old_ajid" value="<?php echo $zlxx["id"]; ?>"  /><!--原案件对应的id-->
		        	
		        	<?php
		        		if($CaseST == 0){
		        	?>
		        	<input class="btn btn-primary" type="button" value="恢复案件" onclick="changemes()" id="changebtn" /><br /><br />
		        	<?php
		        		}
		        	?>
		        	
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">案卷号</th>
                    <td class="numeric" style="width: 120px;"><input style="width: 120px;border: none;" type="text" id="ajhT" value="<?php echo $ajh; ?>" readonly="readonly"  /></td>
                    <th class="numeric">类型</th>
		            		<td class="numeric" style="width: 60px;">
		            			<select id="lx">
		            				<option selected="selected"></option>
		            				<option>发明专利</option>
		            				<option>实用新型</option>
		            				<option>外观设计</option>
		            			</select>
		            		</td>
                    <th class="numeric">案源人</td>
                    <td class="numeric" style="width: 100px;"><input style="width: 80px;" onclick="select_ayr(this)" id="select_ayr" readonly="readonly" value="<?php echo $zlxx["案源人"]; ?>" /></td>
                    <th class="numeric">代理人</td>
	            			<td class="numeric" style="width: 100px;"><input style="width: 80px;"  onclick="select_dlr(this)" id="select_dlr" readonly="readonly" value="<?php echo $zlxx["代理人"]; ?>" /></td>
	            			<th class="numeric">专利名称</th>
		            		<td class="numeric"><input style="width: 90%;" name="change" id="zlmc" value="<?php echo $zlxx["专利名称"]; ?>" /></td>
	            	</tr>
	            	</thead>
            </table>
            <!--案件申请人-->
            <input type="text" id="sqrid" value="" hidden="hidden" />
            <input class="btn btn-primary" type="button" value="更换申请人" onclick="select_sqr()"  /><br /><br />
            <table class="table table-bordered table-striped table-condensed" id="tab_sqr" >
            	<thead>
            		<th>申请人</th>
            		<th>证件号</th>
            		<th>地址</th>
            	</thead>
            	<tbody>
            		<?php
            			$sqlCheS = "select 申请人id,备注 from 专利信息  where  案卷号='".$ajh."'";
            			$resultCheS = $conn->query($sqlCheS);
            			if($resultCheS->num_rows>0){
            				while($rowCheS = $resultCheS->fetch_assoc()){
            					$sqrid = $rowCheS['申请人id'];
            					$casebz = $rowCheS['备注'];
            					$sqrT = explode(',',$sqrid);
            					$sqrlen=count($sqrT);
            					for($i=0;$i<$sqrlen;$i++){
		            				$sql6 = "select id,证件号,地址,申请人 from 申请人 where  id='".$sqrT[$i]."'";
									$result6 = $conn->query($sql6);
									$num6 = 0;
									if($result6->num_rows > 0){
										while($row6 = $result6->fetch_assoc()){
							            ?>
							            	<tr>
							            		<td><?php echo $row6['申请人']; ?></td>
							            		<td><?php echo $row6['证件号']; ?></td>
							            		<td><?php echo $row6['地址'];   ?></td>
							            	</tr>
							            <?php
				            			$arr[$num6] = $row6['id'];
				            			$num6++;
										}
									}else{
			            				?>
			            				<tr>
			            					<th colspan="5">没有申请人</th>
			            				</tr>
			            				<?php
			            			}
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
        <!--body wrapper end-->
    </div>
    </div>
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
<script src="../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--功能JS函数集-->
<!--<script type="text/javascript" src="../../js/caseatarget.js"></script>-->

<script type="text/javascript" >
	//根据旧的案卷号创建新案卷号
	function Create_ajh(){
		var ajhT = document.getElementById('ajhT').value;//案卷号
		var lx_v = document.getElementById("lx").value;//类型
		var ayr_v = document.getElementById('select_ayr').value;//案源人
		var dlr_v = document.getElementById('select_dlr').value;//代理人
		
		if(ajhT != "" && lx_v != "" && ayr_v != "" && dlr_v != ""){
			var send_msg = ajhT+"#$#"+lx_v+"#$#"+ayr_v+"#$#"+dlr_v;
			$.ajax({
				url:'CaseStaChan_Save.php',
				type:'get',
				async:true,
				data:{
					flag:"CreateAJH",
					sendmsg:send_msg
				},
				dataType:"json",
				success:function(data){
//					console.log(data);
					if(data["result"]){
						document.getElementById('ajhT').value = data["ajh_new"];
						document.getElementById('ajhT').style = "width: 120px;border: none;color: red;";
					}else{
						alert("生成案卷号失败！请联系管理员。");
					}
				},
				error:function(x,s,t){
					alert("生成案卷号失败！请联系管理员。");
					console.log("ajax error!"+s+t);
				}
			});
		}
		
	}
	
	//保存修改信息
	function changemes(){
	  //获取申请人id
	  var sqridT = document.getElementById('sqrid').value;
		//获取专利名称
		var zlmc = document.getElementById('zlmc').value;
		//获取案源人
		var ayrM = document.getElementById('select_ayr').value;
		//获取代理人
		var dlrM = document.getElementById('select_dlr').value;
		//案卷号
		var ajhT = document.getElementById('ajhT').value;
		//原案件对应的id
		var Old_ajid_v = document.getElementById("Old_ajid").value;
		
		$.ajax({
			url:'CaseStaChan_Save.php',
			type:'get',
			async:true,
			data:{
				flag:"Save_data",
				Old_ajid:Old_ajid_v,
				sqrid:sqridT,
				zlm:zlmc,
				ayr:ayrM,
				dlr:dlrM,
				ajh:ajhT
			},
			success:function(data){
				if(data == 1){
					alert('修改成功');
					window.close();
				}else{
					alert('修改失败，请联系管理员');
				}
			}
		});
	}
	//类型发生改变
	$("#lx").change(function(){
		Create_ajh();
	});
	
	//选择代理人
	function select_dlr(obj){
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
						obj.value = localStorage.dlr_name;
						Create_ajh();
						localStorage.clear();
					}else{
						alert("未选中代理人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}	
	//选择案源人
	function select_ayr(obj){
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
						obj.value = localStorage.ayr_name;
						Create_ajh();
						localStorage.clear();
					}else{
						alert("未选中案源人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	
	//选择申请人
	function select_sqr(){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 800;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../../select_sqr_more.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.return_data){
						return_data = localStorage.return_data;//返回的数据
						
						var sqrid = document.getElementById('sqrid');
						if(return_data != undefined){
							//删除申请人表的数据
							var Tab_sqr = document.getElementById('tab_sqr');
							var tab_len = Tab_sqr.rows.length;
					//		alert(tab_len);
							if(tab_len > 1){
								for(var i=1;i<tab_len;i++ ){
									Tab_sqr.deleteRow(1);
					//				alert('ok');
								}
							}
							var arr = return_data.split("/");
							//填入第一申请人
							sqr_id =arr[0];
							var newRow = Tab_sqr.insertRow(1);
					//		alert(arr[1]);
					//				SQ.value =arr[1]; //向申请人的input赋值
							newRow.insertCell(0).innerHTML= arr[1];
							newRow.insertCell(1).innerHTML= arr[2];
							newRow.insertCell(2).innerHTML= arr[3];
							if(arr.length>6){
								var len=(arr.length/7)-1;
								while(len){
									var nrow = Tab_sqr.rows.length;
									var new_row = Tab_sqr.insertRow(nrow);
									var j=0;
									for(var i=len*7;i<len*7+7;i++){
										if(i==len*7){
											sqr_id=sqr_id+","+arr[i];
										}else if(i==len*7+1){
											new_row.insertCell(j).innerHTML	= arr[i];
											j++;
										}else if(i==len*7+2){
											new_row.insertCell(j).innerHTML	= arr[i];
											j++;
										}else if(i==len*7+3){
											new_row.insertCell(j).innerHTML	= arr[i];
											j++;
										}else{
											j++;
										}
									}
									len--;
								}
								sqrid.value = sqr_id;
							}
						}else{
							alert("未选中申请人");
						}
						
						localStorage.clear();
					}else{
						alert("未选中案源人！");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}

</script>
</body>
</html>