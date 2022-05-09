<?php	require'../../../AHeader.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>
  <title>著作案件详情</title>

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
	<div class="wrapper">
	<div class="row">
	<div  class="col-sm-12">
	<section class="panel">
	<header class="panel-heading">
		<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
		  <ul class="nav nav-tabs" style="background-color: #DDDDDD;">
	        <li class="active"><a href="#about-1" data-toggle="tab"> 著作基本情况 </a></li>
	        <li class="#"><a href="#about-2" data-toggle="tab"> 著作监控 </a></li>
	      </ul>
	</header>
	  	<!--<form action="casefile_save_jk.php" method="post" enctype="multipart/form-data">-->
	    <div class="panel-body">
				<div class="tab-content">                                
	       
				<?php
				   $ajh = $_GET["ajh"];
				   echo '<input id="ajh" type="text" hidden="hidden" value="'.$ajh.'"/>';
				   require("../../../conn.php");
					  $sql1 = "SELECT * FROM 著作_信息 where 案卷号='".$ajh."'";
					  $result1 = $conn->query($sql1);
					  if($result1->num_rows >=0){
					  	while($row1 = $result1->fetch_assoc()){
					  		$sqh_zz = $row1["申请号"];
					  		$casebz = $row1['案件备注'];
					  		$sqday_zz = $row1["申请日期"];
					  		$DJ = $row1["登记号"];
				?>
				<!-- /btn-group -->
            	<div class="btn-group" style="float: left;" >
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
                    	<span id="ajSt">
                    		<?php 
                    			$sql_St = "select 案件状态 from `著作_信息` WHERE 案卷号 = '".$ajh."'";
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
				<table class="table table-bordered table-striped table-condensed" id="zzjbxx">
	                <tr>
                		<th class="numeric">案卷号</th>
                		<td class="numeric"><input  type="text" name="kj_ajh" style="border-style:none" value="<?php echo $ajh; ?>" id="kj_ajh" readonly="true"></td>
                		<th class="numeric">著作名称</th>
                		<td class="numeric"><?php echo $row1["著作名称"]; ?></td>
                		<th class="numeric">案源人</th>
                		<td class="numeric"><?php echo $row1["案源人"]; ?></td>
                		<th class="numeric">代理人</th>
                		<td class="numeric"><?php echo $row1["代理人"]; ?></td>
	                </tr>
            			<tr>
	                	<th class="numeric">申请号</th>
	                	<td class="numeric"><input type="text" name="sqh_zz" id="sqh_zz" value="<?php echo $sqh_zz; ?>" /></td>
	                	<th class="numeric">申请日</th>
	                	<td class="numeric"><input style="height: 20px;" type="date" name="sqr_zz" id="sqr_zz" value="<?php echo $sqday_zz; ?>" /></td>
	                	<td class="numeric" colspan="4"><input type="button" value="保存申请号与申请日" onclick="save_sqh()"></td>
                  </tr> 
	                </table>
	                <?php
	                	}
						  }
						?> 
						<div class="tab-pane active" id="about-1">
						<table class="table table-bordered table-striped table-condensed" id="">
	      	       <tr>
		      	       	<th>申请人</th>
		      	       	<th>证件号</th>
		      	       	<th>地址</th>
	      	       </tr>
	            <?php
	            	$sqr = "SELECT * FROM 著作_信息 where 案卷号='".$ajh."'";
						       $resultr = $conn->query($sqr);
						    if($resultr->num_rows >=0){
						  	  while($rowr = $resultr->fetch_assoc()){
						  	  	 $CaseST = $rowr['状态'];
						  	  	 $sqrid = $rowr["申请人id"];
					  		     $sqrlen = explode(',',$sqrid);
					  		     $len   = count($sqrlen);
//							  		     echo print_r($sqrlen);
				  		     for($i=0;$i<$len;$i++){
					  		     	$sqrx = "select * from 申请人 where id='".$sqrlen[$i]."'";
					  		     	   $resultx = $conn->query($sqrx);
				  		     	if($resultx->num_rows >0){
						             	while($rowx = $resultx->fetch_assoc()){
	            	?>
	      	       <tr align="center">
	      	        	<td><?php echo $rowx["申请人"]; ?></td>
	      	        	<td><?php echo $rowx["证件号"]; ?></td>
	      	        	<td><?php echo $rowx["地址"]; ?></td>
	      	       </tr>
	      <?php
	      	        }
	              }
	          }
	         }
	      }
	      	?>
	      	</table>
	      	<textarea rows="5" cols="100"  id="zz_bz" ><?php echo $casebz; ?></textarea>
			<br />
			<?php if($CaseST ==0){ ?>
	      	<input class="btn btn-primary" type="button" value="文件上传" onclick="upfile('<?php echo $ajh; ?>')" />
						<br />
						<br />
			<?php } ?>
	            <table class="table table-bordered table-striped table-condensed" id="jkwj">
	            	<tr>
                		<th>序号</th>
                		<th>文件</th>
                		<th>上传时间</th>
                		<th>文件描述</th>
                		<th>操作员</th>
                		<th>操作</th>
	                </tr>
	            <?php
					   require("../../../conn.php");
						  $sql4 = "SELECT id,路径,时间,处理人,描述  FROM 著作_文件 where 案卷号='".$ajh."' AND 删除状态=0";
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
	                	<td><?php echo $row4["描述"]; ?></td>
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
	            </div>
	            <div class="tab-pane" id="about-2">
	            	<label style="font-size: 20px;">监控中</label><br />
	           &nbsp; &nbsp;
	            	<br /><br />
	            <table class="table table-bordered table-striped table-condensed" id="ajjk" style="text-align: center;">
	                <tr>
	                	<!--<th>#</th>-->
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
                				$sqlSEL = "SELECT id,流程,金额,监控天数 FROM `案件流程设置` where 状态=0 and 案件类型='著作案件'";
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
	                	$t=date("Y-m-d");
			               require("../../../conn.php");
								     $sql = "SELECT * FROM 著作_监控 where 案卷号='".$ajh."' and 状态='0'";
								     $result = $conn->query($sql);
								        $hang='0';
								     if($result->num_rows >=0){
								  	    while($row = $result->fetch_assoc()){
								  	    		$hang++;
								  	    		$delxh = 'del/'.$hang;
												//获取文件信息
												$sql_file = "SELECT id,路径 FROM 著作_文件  WHERE id='".$row['文件id']."' AND 删除状态=0";
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
			                <tr align="center">
			                	<!--<td><input type="checkbox" id="" /></td>-->
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
			                	<td>
			                		<?php if($CaseST ==0){?>
			                		<input type="button" value="结束监控" onclick="ChangeSitu(<?php echo $row["id"]; ?>)">
			                		<?php } ?>
			                	</td>
			                </tr>
	                <?php
	                }
	              }
					?>
					<?php if($CaseST ==0){ ?>
	                <tr>
	                	<td colspan="8" onclick="addRow()">
	                		<button class="btn-block"><strong style="font-size: 20px;">+</strong></button>
	                	</td>
	                </tr>
	                <?php }else{
	                	?>
	                		<tr>
			                	<th colspan="8" align="center">
			                		非正常状态下无法执行此操作
			                	</th>
			                </tr>
	                	<?php
	                } ?>
	            </table><br /><br />
	            <label style="font-size: 20px;">监控结束</label>
	            <table class="table table-bordered table-striped table-condensed" id="jkjs" style="text-align: center;">
	            	<tr>
                		<th>监控名</th>
                		<th>金额</th>
						<th>提醒日期</th>
						<th>截止日期</th>
						<th>备注</th>
	                </tr>
	                <?php
	                	$t=date("Y-m-d");
			             require("../../../conn.php");
					     $sqls = "SELECT * FROM 著作_监控 where 案卷号='".$ajh."' and 状态='1'";
					     $results = $conn->query($sqls);
//					     echo $sqls;
					     if($results->num_rows >0){
					  	    while($rows = $results->fetch_assoc()){
	                	?>
			                <tr align="center">
			                	<td><?php echo $rows["监控名"]; ?></td>
			                	<td><?php echo $rows["金额"]; ?></td>
			                	<td><?php echo $rows["提醒日期"]; ?></td>
			                	<td><?php echo $rows["截止日期"]; ?></td>
			                	<td><?php echo $rows["备注"]; ?></td>
			                </tr>
	                <?php
	                }
	              }else{
	              	?>
	              	<tr>
	                	<th colspan="5">暂无已结束监控</th>
	                </tr>
			        <?php
	              }
	              ?>
	            </table>
	            </div>
	        </section>
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

<!--异步传数据-->
<script src="../../../js/save_zz.js"></script>
<!--增行、减行-->
<script src="../../../js/jk_addjian.js"></script>

<script type="text/javascript" >
	
	function chemess(obj){//查询监控名信息，并显示信息
	var val = obj.value;
	$.ajax({
		url:"save_zzkj_new.php",
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
	
		//保存登记号
	function save_DJId(obj){
		var ajh = document.getElementById("ajh").value;
//		alert('ok');
		$.ajax({
			type:"get",
			url:"save_zzkj_new.php",
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
	
	//修改备注后保存
	var zz_bz = document.getElementById("zz_bz");
	zz_bz.addEventListener('change',function(){
		if(confirm("是否保存备注信息？")){
			var ajhT = document.getElementById("kj_ajh");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"zzxg_ajax.php",
				async:true,
				data:{
					flag:"save_zzbz",
					str_ajh:ajhT.value,
					str_bz:zz_bz.value
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