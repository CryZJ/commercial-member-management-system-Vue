<?php
	require'../../../AHeader.php';
?>
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
  <link rel="SHORTCUT ICON" href="../../../images/output/logo.ico"/>

  <title>商标案件详情</title>

  <!--common-->
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../../../js/html5shiv.js"></script>
  <script src="../../../js/respond.min.js"></script>
  <![endif]-->

  <!--pickers css-->
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
  <div class="wrapper" >
    <div class="row" >
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
	      <ul class="nav nav-tabs">
	        <li class="active"><a href="#about-1" data-toggle="tab"> 案卷基本情况 </a></li>
	        <li class="#"><a href="#about-2" data-toggle="tab">案卷流程及文档 </a></li>
	        <li class="#"><a href="#about-3" data-toggle="tab">案件监控 </a></li>
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
	    		  	<?php
    		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
    		  			echo '<input id="ajh" type="text" hidden="hidden" value="'.$ajh.'"/>';
	        			//获取案卷基本情况
	        			require('../../../conn.php');
	        			$sql = "select 案件类型,id,委托人类型,案源人,代理人,注册日,注册号,委托书id,专权期始,专权期末,备注,申请人id,状态,类别,商标说明,商品服务  from 商标_案件 a  where a.案卷号='".$ajh."'";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
	        					$CaseST = $row['状态'];
	        					$CaseId = $row['id'];
    							$ctype = $row['委托人类型'];//委托人类型
    							$cayr = $row['案源人'];//案源人
    							$cdlr = $row['代理人'];//代理人
    							$cReF = $row['委托书id'];//委托书
    							$cBz = $row['备注'];//委托书
    							$cMKD = $row['注册日'];//注册日
    							$cMKN = $row['注册号'];//注册号
    							$cOPB = $row['专权期始'];//专权期限始
    							$cOPE = $row['专权期末'];//专权期限末
    							$sqrid = $row['申请人id'];
								$ttype = $row['类别'];
								$tSeN = $row['商品服务'];
								$tBLB = $row['商标说明'];
								$CType = $row['案件类型'];
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
		        	<?php 
	                		$sql2 = "select 商标名 from 商标_委托书 where id = '".$cReF."'";
	                		$result2 = $conn->query($sql2);
	                		if($result2 ->num_rows>0){
	                			while($row2 = $result2->fetch_assoc()){
		    						$tname = $row2['商标名'];//商品名
	                			}
	                		}
	                	?>
	                	<!-- /btn-group -->
		            	<div class="btn-group" style="float: left;" >
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" name="Menu">
                            	<span id="ajSt">
                            		<?php 
                            			$sql_St = "select 案件状态 from `商标_案件` WHERE 案卷号 = '".$ajh."'";
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
                                <li><a href="#">已受理</a></li>
                                <li><a href="#">申请中</a></li>
                                <li><a href="#">已无效</a></li>
                                <li><a href="#">监控中</a></li>
                            </ul>
                        </div>
                    	<!-- btn-group -->
                    	&nbsp;&nbsp;&nbsp;
                    	<strong>案件类型:<?php echo $CType; ?><input type="text" id="CType" hidden="hidden" value="<?php echo $CType; ?>" /></strong>
		                <button class="btn btn-success" type="button" onclick="New_add('new_caseB.php?ajh=<?php echo $ajh; ?>')">转让</button>
		                <button class="btn btn-success" type="button" onclick="New_add('new_caseC.php?ajh=<?php echo $ajh; ?>')">变更</button>
		                <button class="btn btn-success" type="button" onclick="New_add('new_caseD.php?ajh=<?php echo $ajh; ?>')">续展</button>
		                <button class="btn btn-success" type="button" onclick="New_add('new_Else.php?ajh=<?php echo $ajh; ?>')">其他</button>                        	                     	 
                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    	
                    	<?php
                    		$sqlZ = "select 共有商标是  from 商标_案件附加信息  where 案卷号='".$ajh."'";
                    		$resultZ = $conn->query($sqlZ);
                    		if($resultZ->num_rows>0){
                    			while($rowZ = $resultZ->fetch_assoc()){
                    				$AOVI = $rowZ['共有商标是'];
                    			}
                    		}
                    		if($AOVI){$AOVI='是';}else{$AOVI='否';}
                    	?>
                    	<strong>是否有商标:<?php echo $AOVI; ?></strong> 
	                	<div style="float: right;" >
	                		<?php if($CaseST ==0){?>
								<button class="btn btn-primary"  onclick="Save_something('<?php echo $ajh; ?>')">保存</button>
					        <?php } ?>
					        	<button class="btn btn-primary" onclick="PrintOut()">导出打印包</button>
	                	</div>
	                	<br /><br />
		        	<table class="table table-striped  table-bordered" id="tabUserInfo_1">
			                <tr>
				        		<th hidden="hidden">委托人类型</th>
				        		<td hidden="hidden"><?php echo $ctype; ?></td>
				        		<th>注册号</th>
				        		<td colspan="2">
				        			<?php
				        				if(strlen($cMKN)==0){
				        			?>
				        					<input id="zch" type="text" value="<?php echo $cMKN; ?>" />
				        			<?php
				        				}else{
//				        					 echo $cMKN;
				        			?>
				        					 <input id="zch" type="text"  value="<?php echo $cMKN; ?>" />
				        			<?php
				        				}
				        			?>
				        			
				        		</td>
								<th>注册日期</th>
								<td colspan="2"><input id="zcrq" style="height: 26px;" type="date" value="<?php echo $cMKD; ?>" /></td>
				       		</tr>
		                	<tr>
		                		<th>案卷号</th>
								<td><?php echo $ajh; ?></td>
				        		<th>案源人</th>
                                <td class="numeric"><input type="text" class="Change" id="ayr" value="<?php echo $cayr; ?>" <?php if(($name==$cayr || $name==$cdlr || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onclick="Change_ayr()"<?php } ?> readonly="readonly"/></td>
                                <th>代理人</th>
                                <td class="numeric"><input type="text" class="Change" id="dlr" value="<?php echo $cdlr; ?>" <?php if(($name==$cayr || $name==$cdlr || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onclick="Change_dlr()"<?php } ?> readonly="readonly"/></td>
				       		</tr>
		                	<tr>
		                		<th>类别</th>
								<td><input type="text" class="Change" style="width: 50px;" value="<?php echo $ttype; ?>" onchange="changeMes('LB',this)" /></td>
				        		<th>专用权期限【始】</th>
				        		<td><input id="zyqqx_star" style="height: 26px;" type="date" value="<?php echo $cOPB; ?>" /></td>
								<th>专用权期限【末】</th>
								<td><input id="zyqqx_end" style="height: 26px;" type="date" value="<?php echo $cOPE; ?>" /></td>
				       		</tr>
				       		<tr>
		                		<th colspan="1" >商品/服务</th>
		                		<td colspan="5" > <input type="text" class="Change" style="width: 100%;" value="<?php echo $tSeN; ?>" onchange="changeMes('SPFW',this)" /> </td>
		                	</tr>
	                </table>
	                <p style="color: #B6B6B6;">以下信息通过更换委托书修改</p>
	                <table class="table table-striped  table-bordered" id="tabUserInfo_2">
	                	<tr>
	                		<th>委托书</th>
							<td><span id="mes">
		                			<?php
		                				if(strlen($cReF) == 0){
		                			?>
		                					<span id="WFReP">待选择</span>
		                					<a id="ReFW" href=""></a>
		                					<?php if($CaseST ==0){?>
												<input style="width: 60px;height: 30px;float: right;font-size: 10px;" class="btn btn-primary" value="添加" onclick="changeReP('add')" readonly="readonly" />
					          				<?php } ?>
		                					
		                			<?php
		                				}else{
		                			?>
		                					<a id="ReF" href="case_disc.php?mes=<?php echo $cReF; ?>"><?php echo $tname; ?></a>
		                					<?php if($CaseST ==0){?>
												<input style="width: 60px;height: 25px;float: right;font-size: 10px;" class="btn btn-primary" value="替换" onclick="changeReP('change')" readonly="readonly" />
					          				<?php } ?>
		                					
		                			<?php
		                				}
		                			?>
		                		</span></td>
							<th>商品名称</th>
							<td><?php echo $tname; ?></td>
							<th>商品说明</th>
							<td style="width: 500px;"><?php echo $tBLB; ?></td>
	                	</tr>
	                	<?php
	                		$arrsqrid=explode("、",$sqrid);
//	                		echo $sqrid;
	                		$sql3 = "select * from 申请人 where id = '".$arrsqrid[0]."'";
	                		$result3 = $conn->query($sql3);
	                		if($result3->num_rows>0){
	                			while($row3 = $result3->fetch_assoc()){
	                				$Csqre = $row3['英文名'];
	                				$Caddc = $row3['地址'];
	                				$Cadde = $row3['地址E'];
	                				$Cidn = $row3['证件号'];
//	                				$Ccode = $row3['邮政编码'];
//	                				$Ccoty = $row3['国籍'];
	                			}
                			}
                			$Csqrc='';
                			$Cidn = '';
                			for($i=0;$i<count($arrsqrid);$i++){
                				$sql4 = "select * from 申请人 where id = '".$arrsqrid[$i]."'";
                				$result4 = $conn->query($sql4);
                				$row4 = $result4->fetch_assoc();
                				if($i==count($arrsqrid)-1){
                					$Csqrc=$Csqrc.$row4['申请人'];
                					$Csqre = $Csqre.$row4['英文名'];
//              					$Caddc = $Caddc.$row4['地址'];
                					$Cidn = $Cidn.$row4['证件号'];
                					$Ccode = $Ccode.$row4['邮政编码'];
                					$Ccoty = $Ccoty.$row4['国籍'];
                				}else{
                					$Csqrc=$Csqrc.$row4['申请人'].'、';
                					$Csqre = $Csqre.$row4['英文名'].'、';
//              					$Caddc = $Caddc.$row4['地址'].'、';
                					$Cidn = $Cidn.$row4['证件号'].'、';
                					$Ccode = $Ccode.$row4['邮政编码'].'、';
                					$Ccoty = $Ccoty.$row4['国籍'].'、';
                				}
                			}
//	                		echo $Csqrc.','.$Csqre.','.$Caddc.','.$Cadde.','.$Cidn.','.$Cenum.','.$Ccode.','.$Ccoty;
	                	?>
				       		<tr>
				        		<th>申请人(中文名)</th>
				        		<td colspan="3"><?php echo $Csqrc; ?></td>
								<th>申请人(英文名)</th>
				        		<td colspan="1"><?php echo $Csqre; ?></td>
				       		</tr>
				       		<tr>
				       			<th>证件号</th>
								<td><?php echo $Cidn; ?></td>
				        		<th>邮编</th>
				        		<td><?php echo $Ccode; ?></td>
				        		<th>国籍</th>
								<td><?php echo $Ccoty; ?></td>
				       		</tr>
				       		<tr>
				       			<th>地址(中文)</th>
								<td colspan="5" ><input style="width:700px;border: none;" type="text" readonly="readonly" value="<?php echo $Caddc; ?>" /></td>
				       		</tr>
				       		<tr>
				       			<th>地址(英文)</th>
								<td colspan="5" ><input style="width:700px;border: none;" type="text" readonly="readonly" value="<?php echo $Cadde; ?>" /></td>
				       		</tr>
	                </table>
	                <label>案件备注：</label>
	            		<p><textarea cols="100" rows="5" id="case_bz" ><?php echo $cBz;?></textarea></p>
	            	<div class="panel-body" style="width:98%; overflow:auto; solid #000000;">  
				    	<?php 
							require'../../../conn.php';
							$PicSrc = '';
							$sql5 = "select 文件路径 from 商标_文件 where 案卷号='".$ajh."' and 描述='商标图样黑白' and 状态=0 ";
							$result5 = $conn->query($sql5);
							
							if($result5->num_rows >0){
								while($row5 = $result5->fetch_assoc()){
									$PicSrc = $row5['文件路径'];
								}
							}
						?>
						<label>商标预览：</label><br />
				    	
				    	 <div style="float:left;width:33%;" align="center" >
				    	 	<?php
				    	 		if($PicSrc){
				    	 			?>
				    	 				<img style="width:100%;height:300px;" id="hbty" src="<?php echo '../../../'.$PicSrc; ?>" />
				    	 			<?php
				    	 		}else{
				    	 			?>
				    	 				<img style="width:100%;height:300px;" id="hbty" src="../../../images/nopic.jpg" />
				    	 			<?php
				    	 		}
				    	 	?>
				    	 	<br />
				    	 	<strong>商标图样【黑白】</strong>
				    	 </div>
					</div>
	        </section>
	    	</div>
	    	<!--  案卷流程及文档    -->
		<div class="tab-pane" id="about-2">
          <section id="unseen">
          	<?php if($CaseST ==0){?>
				<input class="btn btn-primary" type="button" value="文件上传" onclick="upfile('<?php echo $ajh; ?>')" /><br/><br/>
			<?php } ?>
            <table class="table table-bordered table-striped table-condensed" id="files_list">
				<thead>
					<tr>
				    <th class="numeric" style="width: 10%;">描述</th>
				    <th class="numeric" style="width: 15%;">创建时间</th>
				    <th class="numeric" style="width: 20%;">处理人</th>
				    <th class="numeric">文件名</th>
				    <th class="numeric">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						require'../../../conn.php';
						$sql5 = "select id,文件路径,描述,创建时间,创建人,案卷号 from 商标_文件 where 案卷号='".$ajh."' and 描述='商标图样黑白' and 状态=0 ";
						$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
					?>
						<tr>
							<td><?php echo $row5['描述']; ?></td>
							<td><?php echo $row5['创建时间']; ?></td>
							<td><?php echo $row5['创建人']; ?></td>
							<td><?php echo pathinfo($row5['文件路径'],PATHINFO_BASENAME); ?></td>
							<td>
								<a class="btn btn-default" target="_blank"  href='../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>'>下载</a>
								<!--<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_fs(this)">删除</button>-->
								<?php if($CaseST ==0){?>
										<button name="<?php echo $ajh; ?>" id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="change_sb(this)">替换</button>
						        <?php } ?>
								
							</td>
						</tr>
					<?php			
							}
						}else{
					?>
						<tr>
							<td>商标图样黑白</td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<!--<a class="btn btn-default" target="_blank"  href='../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>'>下载</a>-->
								<!--<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_fs(this)">删除</button>-->
								<?php if($CaseST ==0){?>
										<button name="<?php echo $ajh; ?>" id="" class="btn btn-danger" onclick="change_sb(this)">替换</button>
						        <?php } ?>
								
							</td>
						</tr>
					<?php		
						}
					?>
					<?php 
						require'../../../conn.php';
						$sql5 = "select id,文件路径,描述,创建时间,创建人 from 商标_文件 where 案卷号='".$ajh."' and 状态=0 ";	
						$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
								if($row5['描述'] != "商标图样黑白"){
					?>
						<tr>
							<td><?php echo $row5['描述']; ?></td>
							<td><?php echo $row5['创建时间']; ?></td>
							<td><?php echo $row5['创建人']; ?></td>
							<td><?php echo pathinfo($row5['文件路径'],PATHINFO_BASENAME); ?></td>
							<td>
								<a class="btn btn-default" target="_blank"  href='../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>'>下载</a>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_fs(this)">删除</button>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="change(this)">替换</button>
							</td>
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
       	<div class="tab-pane" id="about-3">
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
                				$sqlSEL = "SELECT id,流程,金额,监控天数 FROM `案件流程设置` where 状态=0 and 案件类型='商标案件'";
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
								     $sql = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 商标_监控 where 案卷号='".$ajh."' and 状态=0";
								     $result = $conn->query($sql);
								     if($result->num_rows >=0){
								  	    while($row = $result->fetch_assoc()){
								  	    	$sql_file = "SELECT id,文件路径 FROM 商标_文件  WHERE id='".$row['文件id']."' AND 状态=0";
													$result_file = $conn->query($sql_file);
													$sql_path = "";
													$file_name = "";
													if($result_file->num_rows>0){
														while($row_file = $result_file->fetch_assoc()){
															$sql_path = $row_file['文件路径'];
															$filename_arr = explode("/", $row_file['文件路径']);
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
		          				<td align="center" colspan="7" >非正常状态下无法执行此操作</td>
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
						     $sql5 = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 商标_监控 where 案卷号='".$ajh."' and 状态=1";
						     $result5 = $conn->query($sql5);
						     if($result5->num_rows >=0){
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
						 }
					?>
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
<script src="../../../js/jquery-1.10.2.min.js"></script>
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
<script src="../../../js/dynamic_table_init.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="../../../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--common scripts for all pages-->
<script src="../../../js/scripts.js"></script>
<!--结案，恢复，删除-->
<script src="../../../js/blogo_action.js"></script>

<!--功能JS函数集-->
<!--<script src="../../../js/imitation_1/info_fs.js"></script>-->
<script src="../../../js/imitation_1/zl_sb.js"></script>

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
	
function chemess(obj){//查询监控名信息，并显示信息
	var val = obj.value;
	$.ajax({
		url:"save_sbkj_new.php",
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
	var case_bz = document.getElementById("case_bz");
	case_bz.addEventListener('change',function(){
		if(confirm("是否保存备注信息？")){
			var ajhT = document.getElementById("ajh");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"blogo_action.php",
				async:true,
				data:{
					flag:"save_sbbz",
					str_ajh:ajhT.value,
					str_bz:case_bz.value
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

	//监听 专用权期限【始】 并填写 专用权期限【末】
	document.getElementById("zyqqx_star").addEventListener("change",function(){
		$.ajax({
			type:"get",
			url:"blogo_action.php",
			async:true,
			data:{
				flag:"changdate",
				zyqqx_star:this.value
			},
			success:function(data){
				document.getElementById("zyqqx_end").value=data;
			}
		});
	});
</script>
<script type="text/javascript">
	//设置案件状态
	$(".checilck > li").click(function(){
		var text = $(this).html();//获取排序方式
		var Text = text.substr(12,text.length-16);//处理获取的数据
		var ajhT = document.getElementById("ajh").value;//获取案卷号
//		alert(ajhT);
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
//				window.location.reload();
			},
			error:function(){
				alert('false');
			}
		});
	});
</script>
</body>
</html>