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

  <title>账号管理</title>
  <!--dynamic table-->
  <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />
  
	<!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap-datepicker/css/datepicker-custom.css" />

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
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
				Create_leftlist(3,1);
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

            <!--notification menu start -->
            <?php require'../../MenuMin-2.php';  ?>  
            <!--notification menu end -->

        </div>
        <!-- header section end-->

				<!--body wrapper start :主要内容-->
		<div class="wrapper" >
      		<div class="row" >
				<div class="col-sm-12">
			    <section class="panel">
			      <header class="panel-heading custom-tab">
				      <ul class="nav nav-tabs">
				        <li class="about-1"><a href="#about-1" data-toggle="tab"> 工作人员</a></li>
				        <li class="about-2"><a href="#about-2" data-toggle="tab"> 流程操作员</a></li>
				        <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
				      </ul>
			      </header>
				<div class="panel-body">
        <div class="tab-content">    
        	<!-- 代理人-->
	        <div class="tab-pane" id="about-1">
	    		  <section id="unseen">
		             <?php 
		             		if($admin == 1||$lcczy==1){
		             			 echo"<a class='btn btn-primary' data-toggle='modal' href='#myModal' onclick='GetNumberCode()'>新建</a>";
		             		} 
						     ?>
						        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">代理人信息</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="agentSave.php" class="form-horizontal " method="post">
                                            			<input type="text" hidden name="idnum" value="0"></input>
                                            			<table>
												           <tbody>
										           				<tr>
										           					<td><input type="text" hidden name="sonid" id="" /></td>
										           				</tr>
										           				<tr height="5px"></tr>
										           				<tr>
										           					<td>编号：</td><td><input style="border: none;" maxlength='2' type="text" name="bh" id="bh" onchange="change(this.id,this.value)" readonly="readonly" /></td>
										           				</tr>
										           				<tr height="5px"></tr>
										                  		<tr>
																	  <td>名称：</td><td><input type="text" name="mc" id="mc" onchange="change(this.id,this.value)" /></td>
																	  <td width="10%"></td>
																	  <td>固话：</td><td><input type="text" name="gh" id="" /></td>
																  </tr>
																  <tr height="5px"></tr>
																	<tr>
																	  <td>手机：</td><td><input type="text" name="sj" id="" /></td>
																	  <td width="10%"></td>
																	  <td>QQ：</td><td><input type="text" name="qq" id="" /></td>
																  </tr>
																  <tr height="5px"></tr>
																  <tr>
																	  <td>邮箱: </td><td><input type="email" name="yx" id="" /></td>
																	  <td width="10%"></td>
																	  <td>微信:</td><td><input type="text" name="wx" id="" /></td>
																  </tr>
																  <tr height="5px"></tr>
																  <tr>
																  	<td >证件号码: </td><td ><input type="text" name="zjhm" id="" /></td>
																  	<td width="10%"></td>
																  	<td>通信地址：</td><td ><input type="text" name="txdz" id="" /></td>
																  </tr>
																  <tr height="5px"></tr>
																  <tr>
																  	<td >入职日期: </td><td ><input class="default-date-picker" readonly type="text" name="rzrq" id="" /></td>
																  	<td width="10%"></td>
																  	<td >离职日期: </td><td ><input class="default-date-picker" readonly type="text" name="lzrq" id="" /></td>
																  </tr>
																  <tr height="5px"></tr>
																   <tr>
																	 <td>账号: </td><td><input type="text" name="zh" id="zh" onchange="change(this.id,this.value)" /></td>
																	 <td width="10%"></td>
																	 <td>密码:</td><td><input type="password" name="mm" id="" /></td>
																   </tr>
																    <tr height="5px"></tr>
																   <tr>
																	 <td>流程操作员:</td><td><input type="checkbox" name="check[]" value="1" /></td>
																	 <td><input hidden type="checkbox" name="check[]" value="0" checked/></td>
																   </tr>
																</tbody>
												          </table>
												          <br />
												         <div>
											          		<p>备注：</p>
											          		<p><textarea cols="65" rows="3" name="bz"></textarea></p>
												         </div>
					                        	<br />
					                        	<div id="" class="" align="center">
					                        		<!--
					                        		<input type="submit" value="修改" onmousedown="window.close()"/>
					                        		&nbsp;&nbsp;-->
						                        	<input class="btn btn-primary" type="submit" name="" id="" value="保存"  />
					                        	</div>
                              </form>
						        				</div>                               
									</div>
								</div>
							</div>
	        			</header>
				        <div class="panel-body">
				        	<div class="adv-table"> 
						        <table  class="display table table-bordered table-striped" id="dynamic-table">
						        	<thead>
								        <tr> 
								        	<th>编号</th>
								            <th>姓名</th>
								            <th>电话</th>
								            <th>入职日期 </th>
								            <th>离职日期 </th>
								            <th>备注</th>
								            <th>状态</th>
								        </tr>
						        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		if($admin ==1||$lcczy==1){
						        			$sql = "SELECT * from 代理人信息 a,用户  b where a.编号 = b.代理人编号 and a.编号 <> '' order by b.id desc";
										}else{
											$sql = "SELECT * from 代理人信息 a,用户  b where a.编号 = b.代理人编号 and a.编号 <> '' and b.id ='$userid' by b.id desc";
										}
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				?>
						        				<tr>
						        					<!--//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";-->
						        					<!--<th><a data-toggle="modal" href="#myModal<?php //echo $row["编号"]; ?>"><?php //echo $row["编号"]; ?></a></th>-->
						        					<th><a target="_blank" href="agent_info.php?bh=<?php echo $row["编号"]; ?>"><?php echo $row["编号"]; ?></a></th>
						        					<th><?php echo $row["名称"]; ?></th>
						        					<th><?php echo $row["手机"]; ?></th>
						        					<th><?php echo $row["入职日期"]; ?></th>
						        					<th><?php echo $row["离职日期"]; ?></th>
						        					<th><?php echo $row["备注"]; ?></th>
						        					<?php
						        						if(!$row["状态"]){
						        					?>
						        						<th>正常</th>
						        					<?php		
						        						}else{
						        					?>
						        						<th>已注销</th>
						        					<?php		
						        						}
						        					?>
						        				</tr>
						        	<?php
						        			}
						        		}
						        		$conn->close();
						        	?>
						        </table>
				        	</div>				        	
				        </div>
	        		</section>
	        	</div>
	        	 <!--流程操作员分页面-->
  				<div class="tab-pane" id="about-2">
	    		  <section id="unseen">
	        				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="userSave.php" class="form-horizontal " method="post">
                                    			<input type="text" hidden name="idnum" value="0"></input>
                                    			<table>
										           	<tbody>
										           			  <tr height="5px"></tr>
										                  	  <tr>
																  <td>名称：</td><td><input type="text" name="mc" id="" /></td>
																  <td width="10%"></td>
																  <td>固话：</td><td><input type="text" name="gh" id="" /></td>
															  </tr>
															  <tr height="5px"></tr>
																<tr>
																  <td>手机：</td><td><input type="text" name="sj" id="" /></td>
																  <td width="10%"></td>
																  <td>QQ：</td><td><input type="text" name="qq" id="" /></td>
															  </tr>
															  <tr height="5px"></tr>
															  <tr>
																  <td>邮箱: </td><td><input type="email" name="yx" id="" /></td>
																  <td width="10%"></td>
																  <td>微信:</td><td><input type="text" name="wx" id="" /></td>
															  </tr>
															  <tr height="5px"></tr>
															  <tr>
															  	<td >证件号码: </td><td colspan="2"><input type="text" name="zjhm" id="" /></td>
															  </tr>
															  <tr height="5px"></tr>
															  <tr>
															  	<tr height="5px"></tr>
															  	<td>通信地址：</td><td colspan="2"><input type="text" name="txdz" id="" /></td>
															  </tr>
															  <p></p>
															   <tr height="5px"></tr>
															    <tr>
																  <td>账号: </td><td><input type="text" name="zh" id="" /></td>
																  <td width="10%"></td>
																  <td>密码:</td><td><input type="password" name="mm" id="" /></td>
															   </tr>
													</tbody>
										          </table>
										          <br />
										         <div>
										          		<p>备注：</p>
										          		<p><textarea cols="65" rows="3" name="bz"></textarea></p>
										         </div>
					                        	<br />
					                        	<div id="" class="" align="center">
					                        		&nbsp;&nbsp;
						                        	<input class="btn btn-primary" type="submit" name="" id="" value="保存" />
					                        	</div>
                                            </form>
    											</div>                               
											</div>
									</div>
							</div>
	        			</header>
				        <div class="panel-body">
				        	<div class="adv-table"> 
						        <table  class="display table table-bordered table-striped" id="dynamic-table_2">
						        	<thead>
								        <tr> 
								            <th>姓名</th>
								            <th>编号</th>
								            <th>手机号码</th>
								            <th>地址 </th>
								            <th>邮箱</th>
								            <th>备注</th>
								        </tr>
						        	</thead>
						        	<tbody>
						        	<?php
						        		require("../../conn.php");
						        		if($admin ==1){
						        			$sql = "SELECT a.id,b.编号,a.名称,手机,通信地址,邮箱,备注 from 用户 a,代理人信息 b where 流程操作员='1' AND a.代理人编号 = b.编号";
						        		}else{
						        			$sql = "SELECT a.id,b.编号,a.名称,手机,通信地址,邮箱,备注 from 用户  a,代理人信息 b where 流程操作员='1' AND a.代理人编号 = b.编号 and 账号 = '$user'";
						        		}
						        		$result = $conn->query($sql);
						        		if($result->num_rows > 0){
						        			while($row = $result->fetch_assoc()){
						        				echo "<tr>";
						        					//echo "<form method='post' action='#myModal2'><input hidden name='id' value='".$row["id"]."'></form>";
						        					if($admin == "1"){
						        						echo "<td><a target='_blank' href ='czySave.php?id=".$row["id"]."'>".$row["名称"]."</a></td>";
						        					}else{
						        						echo "<td>".$row["名称"]."</td>";
						        					}
													echo "<td><a href ='#' onclick='skip(".$row["id"].")' >".$row["编号"]."</a></td>";
						        					echo "<td>".$row["手机"]."</td>";
						        					echo "<td>".$row["通信地址"]."</td>";
						        					echo "<td>".$row["邮箱"]."</td>";
						        					echo "<td>".$row["备注"]."</td>";
						        				echo "</tr>";
						        			}
						        		}
						        		$conn->close();
						        	?>
						        </table>
				        	</div>				  
        				</div>
        		</div>
        			 <!--日程监控员分页面-->
  				<div class="tab-pane" id="about-3">
	    		  <section id="unseen">
	        			<header>
	        				<button class="btn btn-success">新建</button>
	        			</header>
				        <div class="panel-body">
				        	<div class="adv-table"> 
						        <table  class="display table table-bordered table-striped" id="dynamic-table_2">
						        	<thead>
								        <tr> 
								            <th>姓名</th>
								            <th>编号</th>
								            <th>手机号码</th>
								            <th>地址 </th>
								            <th>邮箱</th>
								            <th>备注</th>
								        </tr>
						        	</thead>
						        	<tbody>
						        		<td>姓名</td>
						            <td>编号</td>
						            <td>手机号码</td>
						            <td>地址</td>
						            <td>邮箱</td>
						            <td>备注</td>
						        	</tbody>
						        </table>
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
<script type="text/javascript" src="../../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!--pickers initialization-->
<script src="../../js/pickers-init.js"></script>

<!--common scripts for all pages-->
<script src="../../js/scripts.js"></script>
<script src="../../js/Change_session.js"></script><!--财务人员管理的公司id更换-->
<!--保存函数-->
<script src="../../js/czySave.js"></script>
<!--动态判断-->
<script>
	//随机获取编号
	function GetNumberCode(){
		$.ajax({
			type:"get",
			url:"agent_ajax.php",
			data:{
				flag:"GetNameCode"
			},
			dataType:"json",
			success:function(data){
				console.log(data);
				if(data.state){
					$("#bh").attr("value",data.data.namecode);
				}else{
					alert(data.message);
				}
			},
			error:function(x,s,t){
				alert("服务器出错,请联系管理员！");
				console.log("ajax error!"+s+": "+t);
			}
		});
	}
	
	
	$('#dynamic-table').dataTable( {
        "aaSorting": [],
        
    } );
  $('#dynamic-table_2').dataTable( {
        "aaSorting": [],
        
    } );
	function change(falg,value){
		$.ajax({
			aysnc:true,
			url:'agent_onchange.php',
			type:'post',
			data:{
				falg:falg,
				value:value
			},
			success:function(data){
				var goal = document.getElementById(falg);
				if(data == '1'){
					goal.value = '出现重复，请重新输入';
					goal.style.color = "red";
				}else if(data == '0'){
					goal.style.color = "";
				}else{
					alert('出现错误，请重新操作或联系管理员');
				}
//				alert(data);
			}
		});
	}
</script>
<!--about 常态-->
		<script src="../../js/NormalS-2.js"></script>

</body>
</html>
