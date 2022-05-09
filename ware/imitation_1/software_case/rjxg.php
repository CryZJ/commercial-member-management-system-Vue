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
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>
  <title>软件案件详情</title>

  <!--icheck-->
  <link href="../../../js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="../../../js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="../../../css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
	<!--body wrapper start-->
	<div class="wrapper" id="ajxx_all">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
		<header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
	      <ul class="nav nav-tabs">
	        <li class="active"><a href="#about-1" data-toggle="tab"><i class="fa fa-user"></i>软件基本情况</a></li>
		      <li class="#"><a href="#about-2" data-toggle="tab"><i class="fa fa-user"></i>软件监控</a></li>
	      </ul>
      </header>
				<!--<form action="casefile_save_jk.php" method="post" enctype="multipart/form-data">-->
	        	<div class="panel-body">
	        		<div class="tab-content">                             
					        
				<?php
				$ajh = $_GET["ajh"];
				require ("../../../conn.php");
				$sql1 = "SELECT 案卷号,软件名称,案源人,代理人,申请号,申请日期,案件备注,状态,登记号  FROM 软件_信息 where 案卷号='".$ajh."'";
				$result1 = $conn -> query($sql1);
				if ($result1 -> num_rows >0) {
					while ($row1 = $result1 -> fetch_assoc()) {
						$CaseST = $row1['状态'];
						$sqh_ayr = $row1["案源人"];
						$rjmc = $row1["软件名称"];
						$casebz = $row1['案件备注'];
						$sqh_dlr = $row1["代理人"];
						$ajh = $row1["案卷号"];
						$sqh_rj = $row1["申请号"];
						$sqday = $row1["申请日期"];
						$DJ = $row1["登记号"];
				  }
				}
				?>  
				<!-- /btn-group -->
	    	<div class="btn-group" style="float: left;" >
	            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
	            	<span id="ajSt">
	            		<?php 
	            			$sql_St = "select 案件状态 from `软件_信息` WHERE 案卷号 = '".$ajh."'";
							$result_St = $conn->query($sql_St);
	            			if($result_St->num_rows>0){
	            				while($row_St=$result_St->fetch_assoc()){
	            					$caseSt = $row_St['案件状态'];
	            				}
	            			}
	            			echo $caseSt;
	            		?>
	            	</span>
	            	<span class="caret"></span>
	            </button>
	            <ul role="menu" class="dropdown-menu checilck" id="Menu" >
	                <li><a href="#">待提交</a></li>
	                <li><a href="#">申请中</a></li>
	                <li><a href="#">已下证</a></li>
	                <li><a href="#">已驳回</a></li>
	            </ul>
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <strong>登记号</strong>
	            <input type="text" style="width: 300px;" id="DJId" onchange="save_DJId(this)" value="<?php echo $DJ; ?>" />
	        </div>
	    	<!-- btn-group -->
				<br /><br />
				<table class="table table-bordered table-striped table-condensed" id="tab_sqr1">
	               <tr align="center">
	               		<th>案卷号</th>
	               		<td><input type="text" id="ajh" style="border-style: none;" readonly="readonly" value="<?php echo $ajh; ?>"></td>
	               		<th>软件名称</th>
	               		<td class="numeric"><input type="text" class="Alter_Change" name="rjmc" value="<?php echo $rjmc; ?>" /></td>
	               		<th>案源人</th>
	               		<td class="numeric"><input type="text"  readonly="readonly" value="<?php echo $sqh_ayr; ?>" onclick="Change_ayr(this)" /></td>
	               		<th>代理人</th>
	               		<td class="numeric"><input type="text"  readonly="readonly" value="<?php echo $sqh_dlr; ?>" onclick="Change_dlr(this)" /></td>
	                </tr>
	                <?php
	                	if(strlen($sqh_rj)==0){
	                	?>
	                <tr>
                		<th>申请号</th>
                		<td align="center" class="numeric"><input type="text" id="sqh_rj" value="<?php echo $sqh_rj; ?>"></td>
                		<th>申请日</th>
                		<td align="center" class="numeric"><input type="date" id="sqday" value="<?php echo $sqday; ?>"></td>
                		<?php if($CaseST ==0){?>
											<td align="center" class="numeric" colspan="4"><input class="btn btn-primary" type="button" value="保存" onclick="save_jbxx()"</td>
					          <?php
					          	 }else{
					          	 	?>
					          	 		<td colspan="4" ></td>
					          	 	<?php
					          	 } 
					          ?>
                		
	                </tr>
	                <?php
										}else{
	                	?>
	                	<tr>
                		<th>申请号</th>
                		<td align="center" class="numeric" id="sqh_rj"> <?php echo $sqh_rj; ?> </td>
                		<th>申请日</th>
                		<td align="center" class="numeric"> <input style="height: 25px;" type="date" class="Alter_Change" name="sqrq" value="<?php echo $sqday; ?>"/></td>
                		<td align="center" class="numeric" colspan="4"></td>
	                </tr>
	                	<?php
										}
	                	?>
	            </table>
        <div class="tab-pane active" id="about-1">
          <section id="unseen">
						<table class="table table-bordered table-striped table-condensed" id="">
							<tr>
								<th>申请人</th>
								<th>证件号</th>
								<th>地址</th>
							</tr>
						<?php
								$sql2 = "select * from 软件_信息 where 案卷号='".$ajh."'";
								$result2 = $conn->query($sql2);
								if($result2->num_rows >=0){
									while($row2 = $result2->fetch_assoc()){
										$sqrid = $row2["申请人id"];
										$sqrlen = explode('/', $sqrid);
										$len    = count($sqrlen);
										for($i=0;$i<$len;$i++){
												$sqr9 = "select * from 申请人 where id='".$sqrlen[$i]."'";
													$result9 = $conn->query($sqr9);
													if($result9->num_rows>0){
														while($row9 =$result9->fetch_assoc()){
								?>
								<tr align="center">
									<td><?php echo $row9["申请人"];?></td>
									<td><?php echo $row9["证件号"];?></td>
									<td><?php echo $row9["地址"];?></td>
								</tr>
								<?php
														}
													}
										}
									}
								}
									?>
						</table>
						<textarea rows="5" cols="100" id="rj_bz"  ><?php echo $casebz; ?></textarea><br />
						<?php if($CaseST ==0){?>
								<input class="btn btn-primary" type="button" value="文件上传" onclick="upfile('<?php echo $ajh; ?>')" />
								<br />
								<br />	
					  <?php } ?>
						
	            <table class="table table-bordered table-striped table-condensed" id="jkwj">
	            	<tr>
                		<th>序号</th>
                		<th>文件</th>
                		<th>上传时间</th>
                		<th>操作员</th>
                		<th>操作</th>
	                </tr>
	            <?php
					   require("../../../conn.php");
						  $sql4 = "SELECT id,路径,时间,处理人  FROM 软件_文件 where 案卷号='".$ajh."' AND 删除状态=0";
						  $result4 = $conn->query($sql4);
						  $i = 1;
						  if($result4->num_rows >0){
						  	while($row4 = $result4->fetch_assoc()){
						?>  
	                <tr align="center">
	                	<td><?php echo $i;?></td>
	                	<td>
	                			<?php 
	                				$filename_arr = explode("/", $row4["路径"]);
													echo  $filename_arr[count($filename_arr)-1];
	                			?>
	                	</td>
	                	<td><?php echo $row4["时间"]; ?></td>
	                	<td><?php echo $row4["处理人"]; ?></td>
	                	<td align="center" class="numeric" colspan="4">
	                			<a class="btn btn-default" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row4["路径"]; ?>">
	                				下载
	                			</a>
	                			<?php if($CaseST ==0){?>
													<button class="btn btn-danger" id="<?php echo $row4["id"]; ?>" onclick="file_del(this)" >删除</button>
					                <button id="<?php echo $row4['id']; ?>" class="btn btn-danger" onclick="change(this)">替换</button>
					          		<?php } ?>
	                	</td>
	                </tr>
	            <?php
								$i++;
								}
							}else{
									?>
										<tr>
											<th colspan="5" align="center" >无上传文件</th>
										</tr>
									<?php
								}
						  ?>
						  </table>	
	            </section>
            	</div>
            	<div class="tab-pane" id="about-2">
                  <section id="unseen">
	            	<h3>监控中</h3>
	            	<div style="overflow: auto;">
	            <table class="table table-bordered table-striped table-condensed" id="tab_che" style="text-align: center;">
	                <tr>
                		<th>监控名</th>
                		<th>金额</th>
                		<th style="word-wrap:break-word ;width: 150px;">文件<em style="font-size: 10px;">(点击名称下载)</em></th>
						        <th>提醒日期</th>
						        <th>截止日期</th>
						        <th>备注</th>
						        <th>操作</th>
	                </tr>
	                <tr hidden="hidden" >
		                	<td><select onchange="chemess(this)" id="C2" >
	                			<option></option>
	                			<?php
	                				require'../../../conn.php';
	                				$sqlSEL = "SELECT id,流程,金额,监控天数 FROM `案件流程设置` where 状态=0 and 案件类型='软件案件'";
					     						$resultSEL = $conn->query($sqlSEL);
					     						if($resultSEL->num_rows>0){
					     							while($rowSEL = $resultSEL->fetch_assoc()){
					     								?>
					     									<option><?php echo $rowSEL["流程"]; ?></option>
					     								<?php
					     							}
					     						}
	                			?>
	                		</select></td>
		                	<td></td>
		                	<td></td>
		                	<td></td>
		                	<td></td>
		                	<td class="numeric"></td>
		                </tr>
	                <?php
			               require("../../../conn.php");
								     $sql = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 软件_监控 where 案卷号='".$ajh."' and 状态=0";
								     $result = $conn->query($sql);
								     if($result->num_rows >=0){
								  	    while($row = $result->fetch_assoc()){
								  	    	$sql_file = "SELECT id,路径 FROM 软件_文件  WHERE id='".$row['文件id']."' AND 删除状态=0";
													$result_file = $conn->query($sql_file);
													$sql_path = "";
													$file_name = "";
													if($result_file->num_rows>0){
														while($row_file = $result_file->fetch_assoc()){
															$sql_path = $row_file['路径'];
															$filename_arr = explode("/", $row_file['路径']);
															$file_name = $filename_arr[count($filename_arr)-1];
														}
													}
	                	?>
			                <tr>
			                	<td><?php echo $row["监控名"]; ?></td>
			                	<td><?php echo $row["金额"]; ?></td>
			                	<td>
			                		<a target="_blank" href="../Downloadfile.php?filename=../../<?php echo $sql_path; ?>">
			                			<?php echo $file_name; ?>
			                		</a>	
			                	</td>
			                	<td><?php echo $row["提醒日期"]; ?></td>
			                	<td><?php echo $row["截止日期"]; ?></td>
			                	<td><?php echo $row["备注"]; ?></td>
			                	<td class="numeric">
			                		<?php if($CaseST ==0){?>
														<input type="button" value="结束监控" onclick="ChangeSitu(<?php echo $row["id"]; ?>)">
					          			<?php } ?>
			                		
			                	</td>
			                </tr>
	                <?php
												}
											}
      							?>
      							<?php if($CaseST ==0){?>
											<tr>
			                	<td align="center" colspan="7" id="add_tab" >
			                		<button class="btn-block"><strong style="font-size: 20px;">+</strong></button>
			                	</td>
			                </tr>
		          			<?php
		          				}else{
		          					?>
		          						<tr>
		          							<th align="center" colspan="7">非正常状态下案件无法执行此操作</th>
		          						</tr>
		          					<?php
		          				} 
		          			?>
	           </table>
	           </div>
	           <h3>监控结束</h3>
	         <table class="table table-bordered table-striped table-condensed" id="jkqk">
		        <thead>
		        	<th>监控名</th>
		       		<th>金额</th>
							<th>提醒日期</th>
							<th>截止日期</th>
							<th>备注</th>
		        </thead> 	
						<?php
							  require("../../../conn.php");
								     $sql5 = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 软件_监控 where 案卷号='".$ajh."' and 状态=1";
								     $result5 = $conn->query($sql5);
								     if($result5->num_rows >0){
								  	    while($row5 = $result5->fetch_assoc()){
							?>
							<tr align="center">
								<td><?php echo $row5["监控名"];?></td>
								<td ><?php echo $row5["金额"];?></td>
								<td><?php echo $row5["提醒日期"];?></td>
								<td><?php echo $row5["截止日期"];?></td>
								<td><?php echo $row5["备注"];?></td>
							</tr>
							<?php
										}
									 }else{
									 	?>
									 		<tr>
									 			<th align="center" colspan="5">
									 				暂无已结束监控
									 			</th>
									 		</tr>
									 	<?php
									 }
								?>
	         </table>
	        <!--</form>-->
	        </section>
	    </div>
	   </div>
	   </div>
	<!--body wrapper end-->
		</div>
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

<script src="../../../js/scripts.js"></script>
<!--增行、减行-->
<script src="../../../js/jkrj_addjian.js"></script>
<!--异步传数据-->
<script src="../../../js/save_rj.js"></script>
<!--图片选择显示-->
<!--<script src="../../../js/xians.js"></script>-->

<script type="text/javascript" >
	var FARE = document.getElementById("add_tab");
	FARE.addEventListener("click",function(){
		var tab = document.getElementById("tab_che");
		var row_num = tab.rows.length;
		var newRow = tab.insertRow(row_num-1);
		newRow.insertCell(0).innerHTML = tab.rows[1].cells[0].innerHTML;
		newRow.insertCell(1).innerHTML = '<input style="width: 80px;" type="text" />';
		newRow.insertCell(2).innerHTML = '<input style="width: 150px;" type="file" />';
		newRow.insertCell(3).innerHTML = '<input type="date" />';
		newRow.insertCell(4).innerHTML = '<input type="date" />';
		newRow.insertCell(5).innerHTML = '<input type="text" />';
		newRow.insertCell(6).innerHTML = '<button onclick="save_kjxx(this)">保存</button><button onclick="del_row(this)">撤除</button>';
	});
	
	//保存登记号
	function save_DJId(obj){
		var ajh = document.getElementById("ajh").value;
//		alert('ok');
		$.ajax({
			type:"get",
			url:"save_rjkj_new.php",
			async:true,
			data:{
				flag:'DJId',
				mes:obj.value,
				ajh:ajh
			},
			success:function(data){
//				console.log(data);
//				alert(data);
				if(data){
					alert('登记保存成功');
				}else{
					alert('登记保存不成功');
				}
			},
			error:function(e,t,s){
				alert(e);
			}
		});
	}
	
	function chemess(obj){//查询监控名信息，并显示信息
	var val = obj.value;
	$.ajax({
		url:"save_rjkj_new.php",
		async:true,
		type:"get",
		data:{
			Name:val,
			flag:'selectMes'
		},
		success:function(data){
			var count = document.getElementById('');
			dataA = data.split(',');
			var td_doc = obj.parentNode;
			var tr_doc = td_doc.parentNode;
			var row_num = tr_doc.rowIndex;
			tr_doc.cells[1].getElementsByTagName('input')[0].value = dataA[0];
			//计算提醒日期【当前时间】
			var myDate = new Date();
			var mytime = myDate.toLocaleDateString();
			mytimeA = mytime.split('/');
			
			if (mytimeA[1] < 10) month1 = "0" + mytimeA[1];  else{month1=mytimeA[1];}
			if (mytimeA[2] < 10) date1 = "0" + mytimeA[2]; else{date1=mytimeA[2];}
//			alert(mytimeA[0]+'-'+month1+'-'+date1);
			tr_doc.cells[3].getElementsByTagName('input')[0].value = mytimeA[0]+'-'+month1+'-'+date1;
			//计算截止日期
//			var mytimeA = ydate.split("-");
			var DayBtw = parseInt(dataA[1]);
	    var nDate = new Date(mytimeA[1] + '-' + mytimeA[2] + '-' + mytimeA[0]); //转换为MM-DD-YYYY格式    
	    var millSeconds = Math.abs(nDate) + (DayBtw * 24 * 60 * 60 * 1000);
	    var rDate = new Date(millSeconds);  
	    var year = rDate.getFullYear();  
	    var month = rDate.getMonth() + 1;  
	    if (month < 10) month = "0" + month;  
	    var date = rDate.getDate();  
	    if (date < 10) date = "0" + date;  
	    var ydate2 = year + "-" + month + "-" + date;
//		  alert(ydate2);
	    tr_doc.cells[4].getElementsByTagName('input')[0].value = ydate2;
		}
	});
}

	//修改备注后保存
	var rj_bz = document.getElementById("rj_bz");
	rj_bz.addEventListener('change',function(){
		if(confirm("是否保存备注信息？")){
			var ajhT = document.getElementById("ajh");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"rjxg_ajax.php",
				async:true,
				data:{
					flag:"save_rjbz",
					str_ajh:ajhT.value,
					str_bz:rj_bz.value
				},
				success:function(data){
					alert(data);
				},
				error:function(XMLhttprequest,errorstatus,errorThrow){
					alert("保存失败！");
					console.log("ajax error!"+errorstatus+errorThrow);
				}
			});
		}
	});
	//监听修改信息
	$(".Alter_Change").change(function(){
//		alert(this.value);
		changeMes(this.name,this);
	});
</script>
<script>
	//设置案件状态
	$(".checilck > li").click(function(){
		var text = $(this).html();//获取排序方式
		var Text = text.substr(12,text.length-16);//处理获取的数据
		var ajhT = document.getElementById("ajh").value;//获取案卷号
		$.ajax({
			url:'ChanCaseSt.php',
			type:'get',
			async:true,
			data:{
				falg:'change',//判断表格的依据
				order:Text,
				ajh:ajhT
			},
			success:function(data){
				document.getElementById("ajSt").innerHTML = Text;
				alert(data);
			},
			error:function(){
				alert('false');
			}
		});
	});
</script>
</body>

</html>