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

  <title>申请人修改</title>
  <!--dynamic table-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_page.css" rel="stylesheet" />-->
  <!--<link href="../../js/advanced-datatable/../../css/demo_table.css" rel="stylesheet" />-->
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">

  <!--pickers css-->
  <!--<link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/../../css/datepicker-custom.css" />-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../js/html5shiv.js"></script>
  <script src="../../js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

    <!-- main content start--主页左上方的标志-->

		<!--body wrapper start :主要内容-->
		<div class="wrapper">
        	<div class="row">
	        	<div class="col-sm-12">
	        		<section class="panel">
	        			<header class="panel-heading">
								申请人修改
								<span class="tools pull-right">
		                <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
		                <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
		                <a class="btn fa fa-reply" onclick="window.close();">返回</a>
		            </span>
	        			</header>
	        			<div class="panel-body">
	        			<label>案源人：</label>
									<?php
										$ssid = $_REQUEST['sonid'];//申请人id
										$ss = $_REQUEST['ss'];//记录所属id
										require("../../conn.php");
									
										$sql_yh = "SELECT 名称  FROM 用户  WHERE id='".$ss."'";
										$result_yh = $conn->query($sql_yh);
										if($result_yh->num_rows>0){
											while($row = $result_yh->fetch_assoc()){
												$ayr_name = $row['名称'];
											}
										}
									?>
									<input hidden="hidden"  type="text" id="ayrid" value="<?php echo $ss; ?>"  />
		    					<input style="width:150px;" type="text" id="ayr"  <?php echo 'onclick="select_ayr(this.id)"'; ?> readonly="readonly" value="<?php echo $ayr_name; ?>" />
									
	        				<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
	        				<strong>申请人</strong>
	        				<input hidden="hidden" type="text" id="ssid" value="<?php echo $ssid; ?>"  /><!--申请人id-->
	        				<!-- /btn-group -->
	        				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        				<strong>申请人类型：</strong>	
		            	<div class="btn-group" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
                            	<span id="ajSt">
                            		<?php 
                            			$sql_St = "select 申请人类型 from `申请人` WHERE id = '".$ssid."'";
																	$result_St = $conn->query($sql_St);
                            			if($result_St->num_rows>0){
                            				while($row_St=$result_St->fetch_assoc()){
                            					$caseSt = $row_St['申请人类型'];
                            				}
                            			}
                            			if($caseSt){
                            				echo $caseSt;
                            			}else{
                            				echo '未选择申请人类型';
                            			}
                            			
                            		?>
                            	</span>
                            	<span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu checilck" id="Menu" >
                            	<!--大专院校，科研单位，工矿企业，事业单位，个人-->
                                <li><a href="#">大专院校</a></li>
                                <li><a href="#">科研单位</a></li>
                                <li><a href="#">工矿企业</a></li>
                                <li><a href="#">事业单位</a></li>
                                <li><a href="#">个人</a></li>
                            </ul>
                        </div>
                        <br /><br />
                    	<!-- btn-group -->
                    	
							<table  class="display table table-bordered table-striped" id="tab_1">
							<thead>
								<tr>
									<th>姓名 <span style="color:red;">*</span></th>
									<th>英文名</th>
									<th>证件号<span style="color:red;">*</span></th>
									<th>国籍 <span style="color:red;">*</span></th>
									<th>邮政编码</th>
									<th>费减年度<span style="color:red;">*</span></th>
									<th>费减比例</th>
								</tr>
							</thead>
							<?php
								
								$sql = "select * from 申请人 where id='$ssid' ";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									$sqrbz = $row["备注"]; 
									$zjt = $row["证件图"];
									$zjf = $row["证件翻"];
									$yyzzt = $row["营业执照图"];
									$yyzzf = $row["营业执照翻"];
							?>
							<tbody>
								<input type="text" hidden id='user' value="<?php echo $userid ?>" />
								<input type="text" hidden id='ssid' value="<?php echo $ss ?>" />
								<input type="text" hidden id='id' value="<?php echo $row['id'] ?>" />
								<tr>
									<td><input style="width:300px;" type="text" id="" name="" 	value="<?php echo $row["申请人"];?>"  /></td>
									<td><input style="width:100px;" type="text" id="" name="" 	value="<?php echo $row["英文名"];?>"  /></td>
									<td><input type="text" id="" name="" 	value="<?php echo $row["证件号"];?>"  /></td>
									<td><input type="text" id="" name=""  value="<?php echo $row["国籍"];?>" /></td>
									<td><input style="width:100px;" type="text" id="" name=""  value="<?php echo $row["邮政编码"];?>" /></td>
									<td><input type="text" id="" name=""  value="<?php echo $row["费减备案"];?>" /></td>
									<td>
										<!--<input style="width:60px;" type="text" id="" name=""  value="<?php echo $row["费减比例"];?>" list="fjb_list" />-->
										<?php 
											switch($row["费减比例"]){
												case "70%":
													echo '<select><option></option><option selected="selected">70%</option><option>85%</option><option>100%</option></select>';
													break;
												case "85%":
													echo '<select><option></option><option>70%</option><option selected="selected">85%</option><option>100%</option></select>';
													break;
												default:
													echo '<select><option></option><option>70%</option><option>85%</option><option selected="selected">100%</option></select>';
											}
										?>
									</td>
								</tr>
								<tr>
									<th rowspan="100">地址&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="button" value="+" onclick="addas()" /></th>
									<td colspan="6" ><input style="width:700px;" value="<?php echo $row["地址"];?>" type="text" id="" name="" />&nbsp;&nbsp;&nbsp;<span style="color:red;"><strong>默认中文地址</strong></span></td>
								</tr>
								<tr>
									<td colspan="6" ><input style="width:700px;" value="<?php echo $row["地址E"];?>" type="text" id="" name="" />&nbsp;&nbsp;&nbsp;<span style="color:red;"><strong>默认英文地址</strong></span></td>
								</tr>
								<?php 
								}
								$sqlx = "select * from 申请人地址   where 申请人id='$ssid' ";
								$resultx = $conn->query($sqlx);
								while($rowx = $resultx->fetch_assoc()){
								?>	
								<tr>
									<td colspan="6" ><input style="width:700px;" value="<?php echo $rowx["地址"];?>" type="text" id="" name="" /></td>
								</tr>
								<?php 
								}
								?>
							</tbody>
						</table>
						</div>	
						<hr />
						<strong>发明人/设计人</strong>
						<button class="btn btn-primary" type="submit" id="" name="" onclick="addfmr_row()" >+</button>
						<button class="btn btn-primary" type="submit" id="" name="" onclick="delfmr_row()" >-</button>
						<br /><br />
						<table class="display table table-bordered table-striped" id="tab_2">
									<thead>
										<tr>
											<th>#</th>
											<th>姓名<span style="color:red;">*</span></th>
											<th>证件号<span style="color:red;">*</span></th>
										</tr>
									</thead>
										<tr hidden="hidden" >
											<td align="center"><input type="checkbox" id="" name="" /></td>
											<td align="center"><input type="text" id="" name=""   /></td>
											<td align="center"><input style="width: 300px;" type="text" id="" name=""   /></td>
										</tr>
										<?php
											$sql1 = "select * from 发明设计人 where 申请人id = '$ssid' ORDER BY id";
											$result1 = $conn->query($sql1);
											while($row1 = $result1->fetch_assoc()){
												?>
												<tr>
													<td align="center"><input type="checkbox" id="" name="" /></td>
													<td align="center"><input type="text" id="" name="" value="<?php echo $row1['姓名'] ?>"  /></td>
													<td align="center"><input style="width: 300px;" type="text" id="" name="" value="<?php echo $row1['证件号'] ?>"  /></td>
												</tr>
												<?php
											}
										?>
									</tbody>
								</table>
						<hr />
						<strong>联系人</strong>
						<?php
//							if($admin==1||$ss == $userid){
								if(1){
								?>
								<button class="btn btn-primary" type="submit" id=" " name="" onclick="addlxr_row()">+</button>
								<button class="btn btn-primary" type="submit" id=" " name="" onclick="dellxr_row()">-</button>
								<?php
							}
						?>
						<br /><br />
						<table class="display table table-bordered table-striped" id="tab_3">
								<tr>
									<th align="center">#</th>
									<th>姓名</th>
									<th>手机</th>
									<th>固话</th>
									<th>邮箱</th>
									<th>地址</th>
									<th>传真</th>
								</tr>
								<tr hidden="hidden" >
									<td><input type="checkbox" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
											<td><input type="text" id="" name="" /></td>
											<td><input style="width: 350px;" type="text" id="" name=""   /></td>
											<td><input style="width: 120px;" type="text" id="" name="" /></td>
								</tr>
								<?php
									$sql2 = "select * from 联系人 where 申请人id = '$ssid' ORDER BY id";
										$result2 = $conn->query($sql2);
										while($row2 = $result2->fetch_assoc()){
//											if($admin==1||$ss == $userid){
												if(1){
												?>
												<tr>
													<td><input type="checkbox" id="" name="" /></td>
													<td><input type="text" id="" name="" value="<?php echo $row2["姓名"]; ?>" /></td>
													<td><input style="width:120px;" type="text" id="" name="" value="<?php echo $row2["手机"]; ?>" /></td>
													<td><input style="width:120px;" type="text" id="" name="" value="<?php echo $row2["固话"]; ?>" /></td>
													<td><input type="text" id="" name="" value="<?php echo $row2["邮箱"]; ?>" /></td>
													<td><input style="width:350px;" type="text" id="" name="" value="<?php echo $row2["地址"]; ?>" /></td>
													<td><input style="width:120px;" type="text" id="" name="" value="<?php echo $row2["传真"]; ?>" /></td>
												</tr>
												<?php
											}else{
												?>
												<tr>
													<td colspan="7" align="center"><strong>抱歉，您无法查看此内容。</strong></td>
												</tr>
												<?php
											}
										}
								?>
						</table>
						<hr />
						<strong>相关文件</strong>
						<!--<div>
							<table class="display table table-bordered table-striped">
								<tr>
									<th>身份证</th>
									<td>
										<?php
											if(strlen($zjt) !=0){
												echo pathinfo($zjt,PATHINFO_BASENAME);
											}else{
												echo "无";
											}  
										?>
									</td>
									<td>
										<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $zjt; ?>">
											下载
										</a>
										<button class="btn btn-danger" my_flag="证件图" id="<?php echo $ssid; ?>" onclick="Change_2(this)">替换</button>
									</td>
								</tr>
								<tr>
									<th>身份证翻译件</th>
									<td>
										<?php
											if(strlen($zjf) !=0){
												echo pathinfo($zjf,PATHINFO_BASENAME);
											}else{
												echo "无";
											}  
										?>
									</td>
									<td>
										<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $zjf; ?>">
											下载
										</a>
										<button class="btn btn-danger" my_flag="证件翻" id="<?php echo $ssid; ?>" onclick="Change_2(this)">替换</button>
									</td>
								</tr>
								<tr>
									<th>营业执照</th>
									<td>
										<?php
											if(strlen($yyzzt) !=0){
												echo pathinfo($yyzzt,PATHINFO_BASENAME);
											}else{
												echo "无";
											}  
										?>
									</td>
									<td>
										<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $yyzzt; ?>">
											下载
										</a>
										<button class="btn btn-danger" my_flag="营业执照图" id="<?php echo $ssid; ?>" onclick="Change_2(this)">替换</button>
									</td>
								</tr>
								<tr>
									<th>营业执照翻译件</th>
									<td>
										<?php
											if(strlen($yyzzf) !=0){
												echo pathinfo($yyzzf,PATHINFO_BASENAME);
											}else{
												echo "无";
											}  
										?>
									</td>
									<td>
										<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $yyzzf; ?>">
											下载
										</a>
										<button class="btn btn-danger" my_flag="营业执照翻" id="<?php echo $ssid; ?>" onclick="Change_2(this)">替换</button>
									</td>
								</tr>
							</table>
						</div>-->
						<br  />
						<input class="btn btn-primary" type="button"  value="上传文件" onclick="up_file(<?php echo $ssid; ?>)" />
						<br  />
							<p>文件列表：</p>
							<div>
								<table class="display table table-bordered table-striped" id="tab_3">
									<thead>
										<th>文件名称</th>
										<th>文件描述</th>
										<th>上传时间</th>
										<th>操作</th>
									</thead>
									<tbody id="file_list">
										<?php
											$sql_file = "SELECT id,文件路径,描述,上传时间 FROM 申请人文件 WHERE 申请人id='".$ssid."' AND 删除状态='0'";
											$result_file = $conn->query($sql_file);
											if($result_file->num_rows>0){
												while($row3 = $result_file->fetch_assoc()){
										?>
													<tr>
														<td width="25%"><?php echo basename($row3['文件路径']); ?></td>
														<td><?php echo $row3['描述']; ?></td>
														<td><?php echo $row3['上传时间']; ?></td>
														<td>
															<a class="btn btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row3['文件路径']; ?>">
																下载
															</a>
															<button id="<?php echo $row3['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
															<button id="<?php echo $row3['id']; ?>" class="btn btn-danger" onclick="change(this)" >替换</button>
														</td>
													</tr>
										<?php			
												}
											}	
										
										?>
									</tbody>
								</table>
							</div>
						<hr />
						<strong>备注</strong>
							<div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
								<p><textarea cols="120" rows="6" id="sqr_bz" name="bz"><?php echo $sqrbz;  $conn->close();?></textarea></p>
							</div>
						<br />
						<div align="center">
							<!--<input type="reset" value="重置" />&nbsp;&nbsp;&nbsp;-->
							<?php 
//								if($admin==1||$ss == $userid){ 
								if(1){
							?>
							<input class="btn btn-success" type="button" value="保存修改" onclick="Mod_client()"/>
							&nbsp;
							<!--<input class="btn btn-danger" type="button" value="返回" onclick="location.href='client.php'"/>-->
							<?php }?>
						</div>
						</div>
	        		</section>
	        	</div>
        	</div>
        </div>
				<!--body wrapper end-->
				
    <!-- main content end-->


<!-- Placed js at the end of the document so the pages load faster -->
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/modernizr.min.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>



<!--dynamic table-->

<!--<script type="text/javascript" language="javascript" src="../../js/advanced-datatable/../../js/jquery.dataTables.js"></script>-->

<!--页数跳转--><!--表格插件-->
<!--
<script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
-->
<!--dynamic table initialization 搜索 -->
<!--<script src="../../js/dynamic_table_init.js"></script>-->

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>

<!--pickers plugins-->
<!--<script type="text/javascript" src="../../js/bootstrap-datepicker/../../js/bootstrap-datepicker.js"></script>-->

<!--pickers initialization-->
<!--<script src="../../js/pickers-init.js"></script>-->

<!--保存数据的函数-->
<script src="../../js/client_mod.js"></script>
<!--增行减行的函数-->
<script src="../../js/person_add.js"></script>

<script>
	//设置申请人类型
	$(".checilck > li").click(function(){
		var text = $(this).html();//获取排序方式
		var Text = text.substr(12,text.length-16);//处理获取的数据
		var ssid = document.getElementById("ssid").value;//获取id
//		alert(ssid);
		$.ajax({
			url:'client_save.php',
			type:'get',
			async:true,
			data:{
				flag:'change',//判断表格的依据
				order:Text,
				ssid:ssid
			},
			success:function(data){
				document.getElementById("ajSt").innerHTML = Text;
				alert(data);
			},
			error:function(){
				alert('更改申请人类型操作失败');
			}
		});
	});
</script>

</body>
</html>
