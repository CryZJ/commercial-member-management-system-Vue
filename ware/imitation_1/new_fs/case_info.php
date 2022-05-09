<?php 
	require'../../../AHeader.php'; 
	require("../../../conn.php");
	require_once "../../../classes/GetTotalCostData.php";
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

  <title>个案管理-其他案件</title>

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
	        <li class="#"><a href="#about-2" data-toggle="tab"> 文件记录 </a></li>
	        <li class="#"><a href="#about-5" data-toggle="tab">费用信息 </a></li>
	        <li class="#"><a href="#about-3" data-toggle="tab">案件监控 </a></li>
	        <li class="#"><a href="#about-4" data-toggle="tab"> 案件操作记录 </a></li>
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
	    		  	<?php
    		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
	        			//获取案卷基本情况
	        			echo '<input id="ajh" type="text" hidden="hidden" value="'.$ajh.'"/>';
	        			$sql = "select * from 专案_复审等 a  where a.案卷号='".$ajh."'";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
	        					$CaseST = $row['冻结状态'];
    							$sqr = $row['申请人id'];
    							$sqr = $row['申请人id'];
    							$casebz = $row['备注'];
    							$ReDate = $row['申请日'];
    							$FareCount = $row['费减比例'];
    							$arr_sqr = explode("|",$sqr);
    							$zlxx = array($row['申请号'],$row['id'],$row['申请人id'],$row['案源人'],$row['类型'],$row['专利名称'],$row['状态'],$row['代理人']); 
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
		        	<input type="text" hidden="hidden" id="useer" value="<?php echo $name; ?>" />
		        	<input type="text" hidden="hidden" id="useid" value="<?php echo $userid; ?>" />
		        	<input type="text" hidden="hidden" id="ajhT" value="<?php echo $ajh; ?>"  />
		    <p style="color: #B6B6B6;font-size: 10px;">如需修改<strong>申请日</strong>、<strong>费减比</strong>直接点击它的信息打开修改界面或到费用明细点击替换年费</p>    	
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">案卷号</th>
                    <td class="numeric"><?php echo $ajh; ?></td>
                    <th class="numeric">申请号</th>
	                <td class="numeric" id="sqh" ><?php echo $zlxx[0]; ?></td>
                    <th class="numeric">类型</th>
		            <td class="numeric"><?php echo $zlxx[4]; ?></td>
		            <th class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zafsd')">申请日</th>
	                <td class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zafsd')"><?php echo $ReDate; ?></td>
	                <th class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zafsd')">费减比</th>
                    <td class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zafsd')"><?php echo $FareCount; ?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
	                <th class="numeric">专利名称</th>
		            <td colspan="3" class="numeric"><input type="text" style="width: 90%;" class="Change" value="<?php echo $zlxx[5]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseST==0)){ ?> onchange="changeMes('ZLMC',this)" <?php }else{ ?> readonly="readonly" <?php } ?> /></td>
                    <th class="numeric">案源人</td>
                    <td class="numeric"><input type="text" class="Change" id="ayr" value="<?php echo $zlxx[3]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseST==0)){ ?> onclick="select_ayr()"<?php } ?> readonly="readonly"/></td>
                    <th class="numeric">代理人</td>
	            	<td class="numeric"><input type="text" class="Change" id="dlr" value="<?php echo $zlxx[7]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseST==0)){ ?> onclick="select_dlr()"<?php } ?> readonly="readonly" /></td>
	                <th class="numeric" >当前程序</td>
	                <td class="numeric">
	                	<?php
	                		if($CaseST == "0"){
	                	?>
	                	<select id="status_type">
	                		<option selected="selected"><?php echo $zlxx[6]; ?></option>
	                		<option>待提交</option>
                    		<option>待受理</option>
                    		<option>待申请费</option>
                    		<option>申请中</option>
                    		<option>待登记费</option>
                    		<option>待证书</option>
                    		<option>年费中</option>
                    		<option>答辩补正</option>
                    		<option>驳回复审</option>
                    		<option>结案</option>
                    		<option>结案恢复</option>
	                	</select>
	                	<?php		
	                		}else{
	                	?>
	                	    <span>案件已结案或删除</span>
	                	<?php		
	                		}
	                	?>
	                </td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" onclick="select_sqr()">修改申请人信息</button>
            <br />
            <br />
            <input id="sqrid" hidden="hidden" />
            <!--案件申请人-->
            <table class="table table-bordered table-striped table-condensed"  id="tab_sqr">
            	<thead>
            		<th>申请人</th>
            		<th>证件号</th>
            		<th>地址</th>
            	</thead>
            	<tbody>
            		<?php
//          			echo $zlxx[2];
//          			$zlxx[2]
						$sqrid = explode('|',$zlxx[2]);
						$sqrlen = count($sqrid);
						for($i=0;$i<$sqrlen;$i++){
							$sql6 = "select * from 申请人 where id='".$sqrid[$i]."'";
							$result6 = $conn->query($sql6);
							$num6 = 0;
							if($result6->num_rows > 0){
								while($row6 = $result6->fetch_assoc()){
	            		?>
		            		<tr>
			            		<td><?php echo $row6['申请人']; ?></td>
			            		<td><?php echo $row6['证件号']; ?></td>
			            		<td><?php echo $row6['地址']; ?></td>
		            		</tr>
	            		<?php
		            				$arr[$num6] = $row6['id'];
		            				$num6++;
								}
							}
						}
            		?>
            	</tbody>
            </table>
            	<!--案件联系人-->
	        <table class="table table-bordered table-striped table-condensed" id="tab_lxr" >    
                	<thead>
	                 	<th class="numeric">联系人</th>
	                    <th class="numeric">手机</th>
	                    <th class="numeric">固话</th>
	                    <th class="numeric">传真</th>
					  	<th class="numeric">地址</th>
	                	<th class="numeric">邮箱</th>
	                </thead>
	                <tbody>
	                            <!--
                            	作者：yaolaoxiaotu@163.com
                            	时间：2017-11-03
                            	描述：只有客户所属的联系人可见
                            -->
            <?php
            	//获取案件联系人
            	$sqrid = explode('|',$zlxx[2]);
				$sqrlen = count($sqrid);
            	for($y=0;$y<$sqrlen;$y++){
//          		echo $arr[$y];
            		$sql7 = "select 记录所属 from 申请人 where id='".$sqrid[$y]."' ";
            		$result7 = $conn->query($sql7);
            		if($result7 -> num_rows>0){
            			while($row7=$result7->fetch_assoc()){
            				$pid = $row7['记录所属'];
//          				echo $sql7;
	            			if($userid==$pid||$admin==1){
				            	$sql3 = "select a.`姓名`,a.`手机`,a.`传真`,a.`固话`,a.`地址`,a.`邮箱` from 联系人 a,申请人 b where b.id=a.申请人id and b.id='".$sqrid[$y]."'";
				            	$result3 = $conn->query($sql3);
//				            	echo $sql3;
				            	if($result3->num_rows > 0){
				        				while($row3 = $result3->fetch_assoc()){
							                echo"<tr>";
							                	echo "<td class=\"numeric\">".$row3['姓名']."</td>";
												echo "<td class=\"numeric\">".$row3['手机']."</td>";
												echo "<td class=\"numeric\">".$row3['固话']."</td>";
												echo "<td class=\"numeric\">".$row3['传真']."</td>";
												echo "<td class=\"numeric\">".$row3['地址']."</td>";
												echo "<td class=\"numeric\">".$row3['邮箱']."</td>";
							                echo "</tr>";
				        				}
				            		}
			            		}
		            		}
            			}
	            	}
	            ?>
            		</tbody>
            </table>
            <p>备注：</p>
            <textarea rows="5" cols="100" id="fs_bz" ><?php echo $casebz; ?></textarea>
	        </section>
	    	</div>
	    	<!--  案卷流程及文档    -->
		<div class="tab-pane" id="about-2">
          <section id="unseen">
        	<?php 
        		if($CaseST ==0){
        	?>
					<input class="btn btn-primary" type="button" value="文件上传" onclick="upfile('<?php echo $ajh; ?>')" />
					<?php
//						$SaveHis = "select 金额   from 专案_年费记录 where `案卷号`='".$ajh."'";
//						$result = $conn->query($SaveHis);
//						$ZSType = 0;
//						if($result->num_rows>0){
//						}else{
					?>
								<input class="btn btn-primary" type="button" id="ZSDJ" value="证书登记" onclick="CerCheIn('<?php echo $ajh; ?>')" />
					<?php
//						}
					?>
					<br/><br/>
			<?php } ?>
            <table class="table table-bordered table-striped table-condensed" >
				<thead>
					<tr>
				    <th class="numeric" style="word-break: break-all;">文件记录</th>
				    <th class="numeric" style="width: 15%;">记录创建时间</th>
				    <th class="numeric" style="width: 20%;">处理人/文件名</th>
				    <th class="numeric">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$RowNum = 0;
						$sql5 = "select id,时间,处理人,文件路径 from 案卷流程及文档  where 案卷号='".$ajh."' and 删除状态=0 ";
				    	$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
								$RowNum++;
					?>
						<tr>
							<td><?php 
									$arr = explode("/", $row5['文件路径']) ; 
									echo $arr[count($arr)-1]; ?>
							</td>
							<td class="numeric" ><?php echo $row5['时间']; ?></td>
							<td class="numeric" ><?php echo $row5['处理人']; ?></td>
							<td>
								<a class="btn-default" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>"><button class="btn btn-demo" >下载</button></a>
								<?php
									if($CaseST ==0){
								?>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-warning" onclick="change(this)" >替换</button>
								<button id="<?php echo $row5['id']; ?>" class="btn btn-danger" onclick="del_file(this)" >删除</button>
								<?php
									}
								?>
							</td>
						</tr>
					<?php
							}
						}
					?>
					<?php
						$sql = "SELECT 通知书名,通知书生成日期 FROM ((SELECT 通知书名,通知书生成日期 FROM 专案_年费记录 WHERE 案卷号='".$ajh."') UNION (SELECT 通知书名,通知书生成日期 FROM 专案需交费用 WHERE 案卷号='".$ajh."')) AS newlist WHERE 通知书名 IS NOT NULL;";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
								$RowNum++;
					?>
					<tr>
						<td class="numeric">费用通知书</td>
						<td class="numeric"><?php echo $row['通知书生成日期']; ?></td>
						<td class="numeric"><?php echo $row['通知书名']; ?></td>
						<td class="numeric">
							<a class="btn-default" target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row['通知书名']; ?>"><button class="btn btn-demo" >下载</button></a>
						</td>
					</tr>				
					<?php					
							}
						}
						if($RowNum==0){
							?>
		          			<tr>
		          				<td align="center" colspan="4" >暂无数据</td>
		          			</tr>
		          			<?php
						}
					?>
				</tbody>
			</table>
          </section>
       	</div>
       	<div class="tab-pane" id="about-4">
          <section id="unseen">
            <table class="display table table-bordered table-striped" id="tab_history">
	            <thead>
	            	<tr>
	                <th>操作/确认收费费用名</th>
    				<th>执行人/确认人</th>
    				<th>执行日期</th>
    				<th>其他/收据编号</th>
                </tr>
	            </thead>
	            <tbody>
                <?php
                	$sql6 = "select * from `专案_操作记录` a where a.案卷号 = '".$ajh."'";
                	$result6 = $conn->query($sql6);
                	if($result6->num_rows > 0){
                		while($row6 = $result6->fetch_assoc()){
                ?>
                			<tr>
                				<td><?php echo $row6['操作名']; ?></td>
                				<td><?php echo $row6['操作员']; ?></td>
                				<td><?php echo $row6['记录时间']; ?></td>
                				<td><?php echo $row6['其他']; ?></td>
                			</tr>
                <?php
                		}
                	}
                ?>
            	</tbody>
        		</table>
        </section>
      </div>
      <!--about-4-->
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
                				$sqlSEL = "SELECT id,流程,金额,监控天数 FROM `案件流程设置` where 状态=0 and 案件类型='专利案件'";
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
						     $sql = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 专案_监控 where 案卷号='".$ajh."' and 状态=0";
						     $result = $conn->query($sql);
						     if($result->num_rows >=0){
						  	    while($row = $result->fetch_assoc()){
						  	    	$sql_file = "SELECT id,文件路径 FROM 案卷流程及文档  WHERE id='".$row['文件id']."' AND 状态=0";
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
		                	<td align="center" colspan="7" id="add_tab">
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
					     $sql5 = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 专案_监控 where 案卷号='".$ajh."' and 状态=1";
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
						 			<th colspan="5">暂无已结束监控</th>
						 		</tr>
						 	<?php
						 }
					?>
	         </table>
          </section>
       	</div>
       	<!--about-3-->
       	<!--about-5-->
	       	<div class="tab-pane" id="about-5">
	          <section id="unseen">
	            <h3><strong>应缴费用明细</strong>
                &nbsp;&nbsp;
                <input class="btn btn-success" type="button" id="remind" value="新建费用" onclick="set_remind()"/>
                <input class="btn btn-success" type="button" value="替换年费" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zafsd')"/>
                <br /></h3>
	            <table class="table table-bordered table-striped table-condensed" id="jftable">
		            <thead>
		            	<tr>
			                <th>费用种类</th>
		    				<th>应缴金额</th>
		    				<th>提醒日期</th>
		    				<th>缴费截止日</th>
		    				<th>操作</th>
		    				<th hidden="hidden">id</th>
		                </tr>
		            </thead>
		            <tbody>
	                <?php
	                    $sql_need = "SELECT id,案卷号,费用名称,年度,金额,提醒时间,缴费期限 AS 截止时间,'0' AS 来源 FROM 专案需交费用 WHERE (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') AND 案卷号='".$ajh."'  ORDER BY 案卷号;";
						$sql_year = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,提醒日期 AS 提醒时间,应缴日期 AS 截止时间,'1' AS 来源 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') ORDER BY 案卷号;";
						$getdata = new GetTotalCostData($conn,$ajh,$sql_need,$sql_year);
						$getdata->UsingClass();
	                	if(count($getdata->sqldata_return) > 0){
	                		foreach($getdata->sqldata_return as $index => $datainfo){
	                ?>
	                <tr>
	                <?php
	                	if($datainfo["费用名称"] == "年费"){
	                ?>
	                	<td><?php echo "第".$datainfo["年度"]."年年费"; ?></td>
	                <?php		
	                	}else{
	                ?>
	                	<td><?php echo $datainfo["费用名称"]; ?></td>
	                <?php			
	                	}
	                ?>
	                <?php
	                	if($CaseST == 0){
	                ?>
	                	<td><input type="text" value="<?php echo $datainfo["金额"]; ?>" id="<?php echo $datainfo["id"]; ?>" name="<?php echo $datainfo["来源"]; ?>" onchange="FeeChanged(this)" /></td>
	                <?php
	                	}else{
	                ?>
	                	<td><?php echo $datainfo["金额"]; ?></td>
	                <?php		
	                	}
	                ?>
	                	<td><?php echo $datainfo["提醒时间"]; ?></td>
	                	<td><?php echo $datainfo["截止时间"]; ?></td>
	                <?php
	                	if($CaseST == 0){
	                ?>
	                	<td>
	                		<!--<input type="button" name="<?php echo $datainfo["来源"]; ?>" id="<?php echo $datainfo["id"]; ?>" onclick="ChangeFare(this)" value="修改" />-->
	                		&nbsp;&nbsp;&nbsp;
	        						<!--<input type="button" name="<?php echo $datainfo["来源"]; ?>" id="<?php echo $datainfo["id"]; ?>" onclick="FareDel(this)" value="删除" />-->
	        						<input type="button" name="<?php echo $datainfo["来源"]; ?>" id="<?php echo $datainfo["id"]; ?>" onclick="FeeDelete(this)" value="删除" />
	                	</td>
	                <?php
	                	}
	                ?>	
	                </tr>
	                <?php			
	                		}
	                	}else{
	                ?>
	                <tr>
	             			<th colspan="100" align="center">暂无记录</th>
	             		</tr>
	                <?php		
	                	}
	                ?>
	            	</tbody>
	        		</table>
	        		<hr />
		        <h3><strong>已缴费用信息</strong></h3>
		        <table class="table table-bordered table-striped table-condensed" id="nftable">
	            <thead>
	            	<tr>
		                <th class="numeric">缴费种类</th>
		                <th class="numeric">缴费金额</th>
		                <th class="numeric">代理费</th>
		                <th class="numeric">滞纳金</th>
		                <th class="numeric">缴费日期</th>
		                <th class="numeric">处理人</th>
		                <th class="numeric">收据号</th>
	        		</tr>
	            </thead>
	            <tbody>
	            	<?php
            		$sql_need = "SELECT id,案卷号,费用名称,年度,金额,代理费,滞纳金,缴费时间,收费处理人,收据编号,'0' AS 来源 FROM 专案需交费用 WHERE (状态='3' OR 状态='9') AND 案卷号='".$ajh."'  ORDER BY 案卷号;";
					$sql_year = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,代理费,滞纳金,缴费时间,缴费处理人 AS 收费处理人,收据编号,'1' AS 来源 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND (状态='3' OR 状态='9') ORDER BY 案卷号;";
					$getdata = new GetTotalCostData($conn,$ajh,$sql_need,$sql_year);
					$getdata->UsingClass();
            		if(count($getdata->sqldata_return) > 0){
            			foreach($getdata->sqldata_return as $index => $datainfo){
            	?>
            		<tr>
            	<?php
	            	if($datainfo["费用名称"] == "年费"){
	            ?>
	            		<td><?php echo "第".$datainfo["年度"]."年年费"; ?></td>
	            <?php		
	            	}else{
	            ?>
	            		<td><?php echo $datainfo["费用名称"]; ?></td>
	            <?php			
	            	}
	            ?>		
            			<td><?php echo $datainfo["金额"]; ?></td>
            			<td><?php echo $datainfo["代理费"]; ?></td>
            			<td><?php echo $datainfo["滞纳金"]; ?></td>
            			<td><?php echo $datainfo["缴费时间"]; ?></td>
            			<td><?php echo $datainfo["收费处理人"]; ?></td>
            			<td><?php echo $datainfo["收据编号"]; ?></td>
            		</tr>
            	<?php			
						}
					}else{
    			?>
            			<tr>
            				<th colspan='7' align="center" >暂无记录</th>
            			</tr>
            			<?php
            		}
            	?>
	            </tbody>
	          </table>
	        </section>
	      </div>
       	<!--about-5-->
    </div>
  </div>
</section>

        <!--body wrapper end-->

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

<!--功能JS函数集-->
<script type="text/javascript" src="../../../js/imitation_1/info_fs.js"></script>
<!--about 常态-->
<!--<script src="../../../js/NormalS-3.js"></script>-->

<script type="text/javascript">
	//修改备注后保存
	var fs_bz = document.getElementById("fs_bz");
	fs_bz.addEventListener('change',function(){
		if(confirm("是否保存备注信息？")){
			var ajhT = document.getElementById("ajhT");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"CaseSave.php",
				async:true,
				data:{
					flag:"save_bz",
					str_ajh:ajhT.value,
					str_bz:fs_bz.value
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
	//修改“'”
	var status_type = document.getElementById("status_type");
	status_type.addEventListener("change",function(){
		if(confirm("是否更改当前程序？")){
			var stu_str = document.getElementById("status_type");
			var ajhT = document.getElementById("ajhT");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"CaseSave.php",
				async:true,
				data:{
					flag:"Save_StatusType",
					str_ajh:ajhT.value,
					stu_str:stu_str.value
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
	
	//增行
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
	newRow.insertCell(6).innerHTML = '<button onclick="save_kj(this)">保存</button><button onclick="del_row(this)">撤除</button>';
});
</script>

</body>
</html>