<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="refresh" content="20" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>上传文件数量信息-证书</title>
  <!--icheck-->
  <link href="../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dynamic table-->
  <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />

  <!--dashboard calendar-->
  <link href="../css/clndr.css" rel="stylesheet">

	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <!--common-->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
	<style type="text/css">
		
	</style>
</head>

<body class="sticky-header" >

<?php
//计算两日期的间隔天数
function diffBetweenTwoDays ($day1, $day2){
	  $second1 = strtotime($day1);
	  $second2 = strtotime($day2);
	    
	  if ($second1 < $second2) {
	    $tmp = $second2;
	    $second2 = $second1;
	    $second1 = $tmp;
	  }
	  if($second1 <= $second2){
	  	return ($second1 - $second2) / 86400;
	  }else{
	  	return -($second1 - $second2) / 86400;
	  }
}
?>


<section>
    <!--body wrapper start-->
    <div class="wrapper">
    <div class="row">
    <div class="col-sm-12" >
    <section class="panel">
    	<header class="panel-heading custom-tab">
			<span class="tools pull-right">
			  <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
			  <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
			  <a class="btn fa fa-power-off" onclick="window.close();">关闭</a>
			</span>
	      	<ul class="nav nav-tabs">
		        <li class="#"><a href="acceptance.php" ><i class="fa fa-user"></i>受理文件</a></li>
		        <li class="#"><a href="authorization.php" ><i class="fa fa-user"></i>授权文件</a></li>
		        <li class="#"><a href="payment.php" ><i class="fa fa-user"></i>缴费通知文件</a></li>
		        <li class="#"><a href="terminate.php" ><i class="fa fa-user"></i>权利终止文件</a></li>
		        <li class="#"><a href="other.php" data-toggle="tab"><i class="fa fa-user"></i>其他文件</a></li>
				<li class="active"><a href="#about-6" data-toggle="tab"><i class="fa fa-user"></i>专利证书</a></li>
		        <li class="#"><a href="historydata.php"><i class="fa fa-user"></i>近十天内上传记录</a></li>
	      	</ul>
		</header>
       	<div class="panel-body">
   			<!-- <header class="panel-heading">
				<p>本日上传的文件有<em id="files_num" style="font-size: 25px; color: #0075B0;"></em>个</p>
			</header> -->
    		<div class="tab-content">
    			
			    <!--专利证书 start-->
				<div class="tab-pane active" id="about-6">
                <section id="unseen">
	        		<header class="panel-heading">
						<!--<p style="color: red;">注意：对于“办理登记手续通知书”必须点击“费用”以获取“年费首年度”但可以不保存费用</p>-->			
						<!-- <p>本次上传的其他文件有<em id="filenum_qt" style="font-size: 25px; color: #0075B0;"></em>个</p> -->
						<select id="upfiledate">
							<option>全部</option>
						</select>
						&nbsp;
						<input style="width: 150px;" type="text" id="sqh_select"  list="sqh_list" placeholder="选填申请号" />
						<datalist id="sqh_list">
							<option value="全部">
						</datalist>
						<input type="text" style="width: 150px;" id="selectdlr" placeholder="选择代理人" readonly="readonly" onclick="select_dlr(this.id)" />
						<button onclick="Check_upfiledate()">查询</button>
						<button onclick="DownALL()">点击下载选中行</button>
					</header>	
					<table class="display table table-bordered table-striped" id="other_table" style="font-size: 5px;">
			        	<thead>
			        		<tr>
			        			<th class="numeric"><input type="checkbox" /></th>
			        			<th class="numeric">案卷号</th>
			        			<th class="numeric">上传时间</th>
					            
					            <th class="numeric" style="width: 150px;word-break: break-all;">申请人</th>
					            <th class="numeric">案源人</th>
					            <th class="numeric">代理人</th>
					            <th class="numeric" style="width: 150px;word-break: break-all;">通知书名称</th>
					            <th class="numeric" style="width: 250px;word-break: break-all;">专利名称</th>
					            <th class="numeric">申请号</th>
					            <th class="numeric">申请日</th>
					            <th class="numeric">发文日</th>
					            
					            <th class="numeric">案件是否存在</th>
					            <th class="numeric">状态</th>
					            <th class="numeric" colspan="4">操作</th>
					        </tr>
			        	</thead>
				        <tbody id="tab_info">
				        <?php
				        	/*获取案件的状态*/
					        function Getcasestaus($zt,$djzt){
					        	$ret_msg = "";
										switch($djzt){
											case "1" :
												$ret_msg = "结案";
												break;
											case "2" :
												$ret_msg = "删除";
												break;
											default :
												$ret_msg = $zt;
										}
										return $ret_msg;
					        }
				        	require("../conn.php");
									$sql = "SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM ((SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND (通知书编码='400002'OR 通知书编码='400003'OR 通知书编码='400001')  ORDER BY 上传时间 DESC) UNION (SELECT id,上传时间,文件名称,通知书名称,通知书编码,专利名称,案卷号,原案卷号,申请号,申请日,发文日,申请号是否一样,案件存在 FROM 临时文件 WHERE 上传情况='0' AND 案件存在='1' AND (通知书编码='400002'OR 通知书编码='400003'OR 通知书编码='400001') ORDER BY 上传时间 DESC)) AS c ORDER BY 上传时间";
									$result = $conn->query($sql);
									$i=0;
									if($result->num_rows >0){
										while($row = $result->fetch_assoc()){
											$my_ayr = "";
											$my_dlr = "";
											$my_sqr = "";
											$zt = "";
											if(!$row['案件存在']){
//												$sql2 = "SELECT 案源人,代理人,申请人id FROM 专利信息 WHERE 案卷号='".$row['案卷号']."' ";
//												$sql2 = "SELECT 案卷号,案源人,代理人,申请人,案件分类 FROM (SELECT 案卷号,案源人,代理人,申请人,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,案源人,代理人,申请人,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,案源人,代理人,申请人,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$row['案卷号']."'";
												$sql2 = "SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,案件分类 FROM (SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专利信息' AS 案件分类 FROM 专利信息 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_年费' AS 案件分类 FROM 专案_年费 UNION SELECT 案卷号,案源人,代理人,申请人,状态,冻结状态,'专案_复审等' AS 案件分类 FROM 专案_复审等) AS c WHERE 案卷号='".$row['案卷号']."'";
												$result2 = $conn->query($sql2);
												if($result2->num_rows>0){
													$arr_sqrid = "";
													while($row2 = $result2->fetch_assoc()){
														$my_ayr = $row2['案源人'];
														$my_dlr = $row2['代理人'];
														$my_sqr = $row2['申请人'];
														$zt = Getcasestaus($row2['状态'],$row2['冻结状态']);
													}
												}
											}
								?>
									<tr>
										<td><input type="checkbox" name="<?php echo $row['id'];?>" /></td>
										<td><?php echo $row['案卷号']; ?></td>
										<td><?php echo $row['上传时间']; ?></td>
										<td><?php echo $my_sqr; ?></td>
										<td><?php echo $my_ayr; ?></td>
										<td><?php echo $my_dlr; ?></td>
										<td><?php echo $row['通知书名称']; ?></td>
										<td><?php echo $row['专利名称']; ?></td>
										<td><?php echo $row['申请号']; ?></td>
										<td><?php echo $row['申请日']; ?></td>
										<td><?php echo $row['发文日']; ?></td>
										<?php
											if(!$row['案件存在']){
										?>
										<td>案件存在</td>
										<?php		
											}else{
										?>
										<td>案件不存在</td>
										<?php		
											}
										?>
										<td><?php echo $zt; ?></td>
										<td>
											<!--<button class="btn btn-default" id="<?php echo $row['id'];?>" onclick="cost(this.id)" >费用</button>-->
											<!-- <button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="control(this.id)" >监控</button> -->
											<!-- <button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="over(this.id)" >结案</button> -->
											<!--<button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="send(this.id)" >抄送</button>-->
											<!--<button class="btn btn-default download_btn" id="<?php echo $row['id'];?>" onclick="dowload(this.id)" >下载</button>-->
											<a style="font-size:15px;padding: 0;" class="btn btn-default download_btn" target="_blank" href="upload_file_num_ajax.php?my_flag=dowload&id=<?php echo $row['id']; ?>">下载</a>
											<!-- <button style="font-size:15px;padding: 0;" class="btn btn-default" id="<?php echo $row['id'];?>" onclick="change(this.id)" >状态</button> -->
											<button style="font-size:15px;padding: 0;" class="btn btn-danger" id="<?php echo $row['id'];?>"  onclick="del(this)" >删除</button>
										</td>
									</tr>
								<?php			
										}
									}
									$conn->close();
					      ?>	
				        </tbody>
 					</table>
                </section>
           		</div>
           		<!--其他文件 end-->
	    </div>    
    	</div>
   	</section>
    </div>
    </div>
    </div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<!--dynamic table-->

<script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>

<!--页数跳转-->
<script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization 搜索 -->
<script src="../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--pickers initialization-->
<script src="../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../js/scripts.js"></script>

<!--个人js-->
<script src="../js/upload_file_num.js"></script>

<script type="text/javascript">
	//选择代理人
	function select_dlr(id){
		var scr_height = window.screen.availHeight;
		var scr_width = window.screen.availWidth;
		var bro_height = 500;
		var bro_width = 800;
		var top = (scr_height-bro_height)/2;
		var left = (scr_width-bro_width)/2;
		var specs = "height="+bro_height+",width="+bro_width+",top="+top+",left="+left;
		var winobj = window.open("../select_dlr.php","_blank",specs);
		var loop = setInterval(function(){
			if(winobj.closed){
				clearInterval(loop);
				if(typeof(Storage)!=="undefined"){
					if(localStorage.dlr_name){
						$("#"+id).attr("value",localStorage.dlr_name);
						localStorage.clear();
					}else{
						alert("未选中代理人！");
						$("#"+id).attr("value","");
					}
				}else{
					alert("抱歉！该浏览器版本不支持web存储。");
				}
			}
		},1);
	}
	
	//获取本日上传的文件数量
	$.ajax({
		type:"get",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"获取本日文件数量",
		},
		success:function(data){
			arr_data = data.split("#$#");
			document.getElementById("files_num").innerHTML = arr_data[0];
//			document.getElementById("filesnum_sl").innerHTML = arr_data[1];
//			document.getElementById("filenum_sq").innerHTML = arr_data[2];
//			document.getElementById("filenum_jf").innerHTML = arr_data[3];
//			document.getElementById("filenum_zz").innerHTML = arr_data[4];
			document.getElementById("filenum_qt").innerHTML = arr_data[5];
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("获取本日上传文件数量失败！");
			console.log("ajax error!"+errorstatus+errorThrow);
		}
	});
	//选取上传文件日期与申请号
	$.ajax({
		type:"get",
		url:"upload_file_num_ajax.php",
		async:true,
		data:{
			my_flag:"获取其他上传文件日期与申请号",
		},
		dataType:"json",
		success:function(data){						
			if(data["result"]){
				for(ky in data["ret_data_update"]){
					$("#upfiledate").append('<option>'+data["ret_data_update"][ky]+'</option>');
				}
			}
			if(data["result_sqh"]){
				for(ky in data["ret_data_sqh"]){
					$("#sqh_list").append('<option>'+data["ret_data_sqh"][ky]+'</option>');
				}
			}
		},
		error:function(XMLhttprequest,errorstatus,errorThrow){
			alert("获取其他上传文件日期失败！");
			console.log("ajax error!"+errorstatus+errorThrow);
		}
	});	
	
	//根据上传文件日期显示表格内容,申请号
	function Check_upfiledate(){
		$("#tab_info").empty();
		tmp_html = '<tr>';
		tmp_html += '<td colspan="14" style="text-align: center;">正在查询中......</td>';
		tmp_html += '</tr>';
		$("#tab_info").append(tmp_html);
		$.ajax({
			type:"get",
			url:"upload_file_num_ajax.php",
			async:true,
			data:{
				my_flag:"根据上传日期查询",
				checkdate:$("#upfiledate").attr("value"),
				checksqh:$("#sqh_select").attr("value"),
				checkdlr:$("#selectdlr").attr("value")
			},
			dataType:"json",
			success:function(data){
//				console.log(data);
				if(data.state == "success"){
					$("#tab_info").empty();
					tmp_html = "";
					for(ky in data.data){
						data.data[ky]["案件存在"] = data.data[ky]["案件存在"]?"案件存在":"案件不存在";
						tmp_html += '<tr>';
						tmp_html += '<td><input type="checkbox" name="'+data.data[ky]["id"]+'" /></td>';
						tmp_html += '<td>'+data.data[ky]["案卷号"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["上传时间"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["申请人"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["案源人"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["代理人"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["通知书名称"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["专利名称"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["申请号"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["申请日"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["发文日"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["案件存在"]+'</td>';
						tmp_html += '<td>'+data.data[ky]["状态"]+'</td>';
						tmp_html += '<td><button style="font-size:15px;padding: 0;" class="btn btn-default" id="'+data.data[ky]["id"]+'" onclick="control(this.id)" >监控</button><button style="font-size:15px;padding: 0;" class="btn btn-default" id="'+data.data[ky]["id"]+'" onclick="over(this.id)" >结案</button><a style="font-size:15px;padding: 0;" class="btn btn-default download_btn" target="_blank" href="upload_file_num_ajax.php?my_flag=dowload&id='+data.data[ky]["id"]+'">下载</a><button style="font-size:15px;padding: 0;" class="btn btn-default" id="'+data.data[ky]["id"]+'" onclick="change(this.id)" >状态</button><button style="font-size:15px;padding: 0;" class="btn btn-danger" id="'+data.data[ky]["id"]+'"  onclick="del(this)" >删除</button></td>';
						tmp_html += '</tr>';
					}
					$("#tab_info").append(tmp_html);
				}else{
					alert("查询完毕");
					$("#tab_info").empty();
					tmp_html = '<tr>';
					tmp_html += '<td colspan="14" style="text-align: center;">无数据</td>';
					tmp_html += '</tr>';
					$("#tab_info").append(tmp_html);
				}
			},
			error:function(XMLhttprequest,errorstatus,errorThrow){
				alert("获取其他上传文件日期失败！");
				console.log("ajax error!"+errorstatus+errorThrow);
			}
		});
	}
	
	//全选选择框
	$("#other_table input:eq(0)").change(function(){
		if($(this).attr("checked")){
			$("#other_table input:gt(0)").attr("checked",$(this).attr("checked"));
		}else{
			$("#other_table input:gt(0)").attr("checked",false);
		}
	});
	
	//合并下载选中行
	function DownALL(){
		var send_id = "";
		$("#tab_info input[type='checkbox']").each(function(){
			if($(this).attr("checked")){
				send_id += ","+$(this).attr("name");
			}
		});
		if(send_id != ""){
			send_id = send_id.substr(1);
			$.ajax({
				type:"get",
				url:"upload_file_num_ajax.php",
				async:true,
				data:{
					my_flag:"装载文件进zip",
					str_id:send_id
				},
				success:function(data){
					if(data){
						my_url = "upload_file_num_ajax.php?my_flag=download_tmpzip";
						window.open(my_url,"_blank");
					}else{
						alert("下载失败");
					}
				},
				error:function(x,s,t){
					alert("下载失败");
					console.log("ajax error!"+s+t);
				}
			});
		}else{
			alert("没有选中行");
		}
	}	
		
</script>

</body>
</html>