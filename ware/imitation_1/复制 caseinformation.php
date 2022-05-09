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
            <!--<a href="javascript:;" class="fa fa-chevron-down"></a>-->
            <!--<a href="javascript:history.go(-1)" class="fa fa-reply" ></a>-->
            <a class="btn fa fa-reply" onclick="window.close();">返回</a>
        </span>
        			<?php
    		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
	        			//获取案卷基本情况
	        			require('../../conn.php');
	        			$sql = "select * from 专利信息 a where a.案卷号='".$ajh."' ";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
    							$ajxh = $row['案件信息id'];
    							$CaseST = $row['冻结状态'];
    							$sqr = $row['申请人id'];
    							$FmsjrId = $row['发明设计人id'];
    							$FareCount = $row['年费费减比例'];
    							$arr_sqr = explode("|",$sqr);
    							$zlxx = array($row['申请号'],$row['申请日'],$row['申请人id'],$row['案源人'],$row['类型'],$row['专利名称'],$row['授权时间'],$row['状态'],$row['代理人'],$row['证书状态']); 
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
	      <ul class="nav nav-tabs">
	        <li class="about-1 active"><a href="#about-1" data-toggle="tab"> 案卷基本情况 </a></li>
	        <li class="about-2"><a href="#about-2" data-toggle="tab"> 案卷流程及文档 </a></li>
	        <li class="about-3"><a href="#about-3" data-toggle="tab"> 费用明细 </a></li>
	        <li class="about-4"><a href="#about-4" data-toggle="tab"> 案件操作记录 </a></li>
	        <?php //if($CaseST ==0){ ?>
	        <li class="about-5"><a href="#about-5" data-toggle="tab"> 新建流程 </a></li>
	        <?php //} ?>
	        <input id="NORS" hidden="hidden"  value="<?php echo $normal; ?>" />
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        
		        	<input type="text" hidden="hidden" id="useer" value="<?php echo $name; ?>" />
		        	<input type="text" hidden="hidden" id="useid" value="<?php echo $userid; ?>" />
		        	<input type="text" hidden="hidden" id="ajhT" value="<?php echo $ajh; ?>"  />
		        	<?php
		        		if($CaseST == 0){
		        	?>
		        	<input class="btn btn-primary" type="button" value="修改" onclick="changemes()" id="changebtn" /><br /><br />
		        	<?php
		        		}
		        	?>
		        	
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">案卷号</th>
                    <td class="numeric"><?php echo $ajh; ?></td>
                    <th class="numeric">专利名称</th>
		            <td class="numeric"><input style="width: 300px;" name="change" id="zlmc" value="<?php echo $zlxx[5]; ?>" /></td>
                    <th class="numeric">类型</th>
		            <td class="numeric"><?php echo $zlxx[4]; ?></td>
                    <th class="numeric">案源人</td>
                    <td class="numeric"><input style="width: 100px;" id="select_ayr" readonly="readonly" value="<?php echo $zlxx[3]; ?>" /></td>
                    <th class="numeric">代理人</td>
	            	<td class="numeric" ><input style="width: 100px;" id="select_dlr" readonly="readonly" value="<?php echo $zlxx[8]; ?>" /></td>
                </tr>
                </thead>
                <tbody>
                <tr>
	                <th class="numeric">申请号</th>
	                <td class="numeric" id="sqh" ><?php echo $zlxx[0]; ?></td>
	                <th class="numeric">申请日</th>
	                <td class="numeric" ><input id="sqd" style="height: 26px;" name="change" type="date" value="<?php echo date("Y-m-d", strtotime($zlxx[1])); ?>" /><?php //echo date("Y-m-d", strtotime($zlxx[1])); ?></td>
	                <th class="numeric">授权公告日</th>
	                <td class="numeric">
              			<input style="height: 26px;" name="change" type="date" id="sqgg" value="<?php echo $zlxx[6]; ?>" />
	                </td>
	                <th class="numeric" >当前程序</td>
	                <td class="numeric">
	                <?php
	                	if($CaseST == 0){
	                		?>
	                		<select disabled id="dqcx" name="change" >
	                			<option selected="selected"><?php echo $zlxx[7]; ?></option>
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
	                <strong>此案件已结案或删除，无法进行此操作</strong>
	                	<select disabled id="dqcx" name="change" hidden="hidden" ><option selected="selected" ><?php echo $zlxx[7]; ?></option></select>
	                <?php
	                	}
	                ?>
	                </td>
	                <th>费减比</th>
	                <td><select id="FareCount">
	                    <option><?php echo $FareCount; ?></option>
	                    <option>70%</option>
	                    <option>85%</option>
	                    <option>100%</option>
	                </select>
	                    
	                </td>
                </tr>
                </tbody>
            </table>
        <div class="tab-pane active" id="about-1">
    		  <section id="unseen">
            <div id="sqrchange" ></div>
            <br />
            <!--案件申请人-->
            <input type="text" id="sqrid" value="<?php echo $sqr;?>" hidden="hidden" />
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
		            		<td><?php echo $row6['地址']; ?></td>
		            	</tr>
		            <?php
					            			$arr[$num6] = $row6['id'];
					            			$num6++;
													}	
												}
											}
										}
            			}else{
        						echo "<script type=\"text/javascript\">alert('申请人没有或出错！');</script>";
            			}
		            ?>
            	</tbody>
            </table>
            <!--案件发明设计人-->
            <?php
            	if($CaseST == 0){
            ?>
            <button class="btn btn-primary" onclick="ChaFSM('<?php echo $ajh; ?>')">修改发明设计人</button><br /><br />
            <?php
            	}
            ?>
            
            <table class="table table-bordered table-striped table-condensed" id="tab_fmsjr" >
                <tbody>
                	<thead>
	                 	<th class="numeric">发明设计人</th>
	                  <th class="numeric">证件号</th>
	                </thead>
            <?php
            	//获取发明设计人
							if(strlen($FmsjrId)==0){
								$sqrT = explode(',',$sqrid);
								for($y=0;$y<count($sqrT);$y++){
									$sql3 = "select id,姓名,证件号 from 发明设计人 a where a.申请人id='".$sqrT[$y]."'";
									$result3 = $conn->query($sql3);
		            	if($result3->num_rows > 0){
		        			while($row3 = $result3->fetch_assoc()){
		        				?>
		        					<tr>
				            		<td><?php echo $row3['姓名']; ?></td>
				            		<td><?php echo $row3['证件号']; ?></td>
				            	</tr>
		        				<?php
			        			}
									}
								}
							}else{
								$OFmsjrId = explode(',',$FmsjrId);
								$OFmsjrIdLen=count($OFmsjrId);
								for($y=0;$y<$OFmsjrIdLen;$y++){
		            	$sql2 = "select id,姓名,证件号 from 发明设计人 a where a.id='".$OFmsjrId[$y]."'";
		            	$result2 = $conn->query($sql2);
		            	if($result2->num_rows > 0){
		        			while($row2 = $result2->fetch_assoc()){
				            ?>
				            	<tr>
				            		<td><?php echo $row2['姓名']; ?></td>
				            		<td><?php echo $row2['证件号']; ?></td>
				            	</tr>
					            <?php
				            }	
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
            	$sqrT = explode(',',$sqrid);
            	$ArrLen = count($sqrT);
            	for($y=0;$y<$ArrLen;$y++){
            		$sql7 = "select 记录所属 from 申请人 where id='".$sqrT[$y]."' ";
            		$result7 = $conn->query($sql7);
            		if($result7 -> num_rows>0){
            			while($row7=$result7->fetch_assoc()){
            				$pid = $row7['记录所属'];
            			}
            			if($pid!=''){
            			if($userid==$pid){
			            	//获取案件联系人
			            	$sql3 = "select a.`姓名`,a.`手机`,a.`传真`,a.`固话`,a.`地址`,a.`邮箱` from 联系人 a,申请人 b where b.id=a.申请人id and b.id='".$sqrT[$y]."'";
			            	$result3 = $conn->query($sql3);
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
	            	$pid='';
            }
            ?>
            	<!--<tr id="lxrChe" display >
            		<td colspan="6" align="center" >抱歉，此账号无法查看此案件联系人</td>
            	</tr>-->
            	
            		</tbody>
            </table>
            <textarea rows="5" cols="100" id="zlaj_bz"  ><?php echo $casebz; ?></textarea>
	        </section>
	    	</div>
	   <!--  案卷流程及文档    -->
				<div class="tab-pane" id="about-2">
          <section id="unseen">
          	&nbsp;&nbsp;
            <?php
            	//流程操作员身份可以看见以下按钮并进行操作
							if($CaseST == 0){
            ?>
	            &nbsp;&nbsp;
							<input  class="btn btn-primary" type="button"  value="受理导入" onclick="upload_sqing('<?php echo $ajh; ?>','<?php echo $zlxx[7]; ?>')"/>
							&nbsp;&nbsp;
							<input  class="btn btn-primary" type="button"  value="授权通知两步导入" onclick="upload_squan('<?php echo $ajh; ?>','<?php echo $zlxx[7]; ?>')"/>
							&nbsp;&nbsp;
							<input  class="btn btn-primary" type="button"  value="授权通知一步导入" onclick="upload_squan2('<?php echo $ajh; ?>','<?php echo $zlxx[7]; ?>')"/>
							&nbsp;&nbsp;
							<input  class="btn btn-primary" type="button"  value="证书登记" onclick="upload_zs('<?php echo $ajh; ?>','<?php echo $zlxx[7]; ?>')"/>
							&nbsp;&nbsp;
						<?php
							}
						?>
							<input  class="btn btn-success" type="button"  value="上传文件" onclick="up_file('<?php echo $ajh; ?>')"/>
							&nbsp;&nbsp;
            
            <?php
			            	//最高权限可以看见以下操作并进行操作
							if($admin==1 || $lcczy == 1){
						?>
						<!--<input class="btn btn-success" type="button" id="remind" value="新建费用" onclick="set_remind()"/>-->
						<?php
										}
			//				} 
						?>
            <br /><br />
            <table class="table table-bordered table-striped table-condensed" >
				<thead>
					<tr>
				    <th class="numeric" style="width: 8%;">流程</th>
				    <th class="numeric" style="width: 15%;">记录创建时间</th>
				    <th class="numeric" style="width: 8%;">处理人</th>
				    <th class="numeric" style="word-break: break-all;">通知书名称</th>
				    <th class="numeric" style="word-break: break-all;">文件记录</th>
				    <th class="numeric">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						require'../../conn.php';
						$sql5 = "select id,流程,时间,处理人,文件路径,通知书名称 from 案卷流程及文档  where 案卷号='".$ajh."' and 删除状态=0 ";
			    	$result5 = $conn->query($sql5);
						if($result5->num_rows >0){
							while($row5 = $result5->fetch_assoc()){
					?>
						<tr>
							<td class="numeric" ><?php echo $row5['流程']; ?></td>
							<td class="numeric" ><?php echo $row5['时间']; ?></td>
							<td class="numeric" ><?php echo $row5['处理人']; ?></td>
							<td class="numeric" ><?php echo $row5['通知书名称']; ?></td>
							<td><?php 
									$arr = explode("/", $row5['文件路径']) ; 
									echo $arr[count($arr)-1]; ?>
							</td>
							<td>
								<a class="btn-default" target="_blank" href="Downloadfile.php?filename=../../<?php echo $row5['文件路径']; ?>"><button class="btn btn-demo" >下载</button></a>
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
							
							$sql = "SELECT 通知书名,通知书生成日期 FROM ((SELECT 通知书名,通知书生成日期 FROM 专案_年费记录 WHERE 案卷号='".$ajh."') UNION (SELECT 通知书名,通知书生成日期 FROM 专案需交费用 WHERE 案卷号='".$ajh."')) AS newlist WHERE 通知书名 IS NOT NULL;";
							$result = $conn->query($sql);
							if($result->num_rows>0){
								while($row = $result->fetch_assoc()){
					?>
						<tr>
							<td class="numeric">费用通知书</td>
							<td class="numeric"><?php echo $row['通知书生成日期']; ?></td>
							<td class="numeric"></td>
							<td class="numeric"></td>
							<td class="numeric"><?php echo $row['通知书名']; ?></td>
							<td class="numeric">
								<a class="btn-default" target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row['通知书名']; ?>"><button class="btn btn-demo" >下载</button></a>
							</td>
						</tr>
					<?php				
								}
							}
						}else{
							?>
								<tr>
									<th colspan="100" align="center">暂无记录</th>
								</tr>
							<?php
						}
						$conn->close();
					?>
				</tbody>
			</table>
          </section>
       	</div>
       	<div class="tab-pane" id="about-3">
          <section id="unseen">
          	<?php
			            	//最高权限可以看见以下操作并进行操作
			//				if($admin==1 || $lcczy == 1){
						?>
						<input class="btn btn-success" type="button" id="remind" value="新建费用" onclick="set_remind()"/>
						<?php
//										}
			//				} 
						?>
            <h3><stron>应缴费用明细</strong></h3>
            &nbsp;&nbsp;
            <table class="table table-bordered table-striped table-condensed" id="jftable">
	            <thead>
	            	<tr>
		                <th>费用种类</th>
				    				<th>应缴金额</th>
				    				<th>提醒日期</th>
				    				<th>缴费截止日</th>
				    				<?php if($CaseST == 0){?>
				    				<th>操作</th>
				    				<?php } ?>
				    				<th hidden="hidden">id</th>
	                </tr>
	            </thead>
	            <tbody>
                <?php
                	require('../../conn.php');
                	$sql4 = "CALL p0('".$ajh."');";
                	$result4 = $conn->query($sql4);
                	$num=1;
                	if($result4->num_rows > 0){
                		while($row4 = $result4->fetch_assoc()){
                ?>
        			<tr>
        				<td id="fn<?php echo $num; ?>" ><?php echo $row4['费用名称']; ?></td>
        				<td><input type="text" id="fa<?php echo $num; ?>" value="<?php echo $row4['金额']; ?>" readonly="readonly" /></td>
        				<td><?php echo $row4['提醒时间']; ?></td>
        				<td><?php echo $row4['缴费期限']; ?></td>
        				<?php if($CaseST == 0){ ?>
        				<th>
        					<input type="button" id="btn<?php echo $num; ?>" onclick="ChangeFare('<?php echo $num; ?>',this.value,'<?php echo $ajh; ?>')" value="修改" />&nbsp;&nbsp;&nbsp;
        					<input type="button" id="delF<?php echo $num; ?>" onclick="FareDel(this)" value="删除" />
        				</th><?php } ?>
        				<!--flag中的0是专案需交，1是专案_年费-->
        				<td hidden="hidden" id="flag<?php echo $num; ?>" ><?php echo $row4['id'].'/'.$row4['flag']; ?></td>
        			</tr>
                <?php
                			$num++;
                		}
             }else{
             	?>
             		<tr>
             			<th colspan="100" align="center">暂无记录</th>
             		</tr>
             	<?php
             }
                	$conn->close();	
                ?>
            	</tbody>
        		</table>
        		<hr /> 			        
        		<h3><strong>已缴费用明细</strong></h3>
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
            		require("../../conn.php");
            		$sql3 = "SELECT 案卷号,费用名称,金额,滞纳金,代理费,收据编号,缴费时间,收费处理人 FROM ((SELECT 案卷号,费用名称,金额,滞纳金,代理费,收据编号,缴费时间,收费处理人 FROM 专案需交费用 WHERE 案卷号 = '".$ajh."' AND 状态<>'0' AND 状态<>'1' and 状态<>'8') UNION (SELECT 案卷号,年度 AS 费用名称,金额,滞纳金,代理费,收据编号,缴费时间,缴费处理人 AS 收费处理人 FROM 专案_年费记录 WHERE 案卷号 = '".$ajh."' AND 状态<>'0' and 状态<>'8') ) AS C";
            		$result3 = $conn->query($sql3);
            		if($result3->num_rows > 0){
            			while($row3 = $result3->fetch_assoc()){
            				echo "<tr>";
            					echo "<td class=\"numeric\">".$row3['费用名称']."</td>";
            					echo "<td class=\"numeric\">".$row3['金额']."</td>";
            					echo "<td class=\"numeric\">".$row3['代理费']."</td>";
            					echo "<td class=\"numeric\">".$row3['滞纳金']."</td>";
            					echo "<td class=\"numeric\">".$row3['缴费时间']."</td>";
            					echo "<td class=\"numeric\">".$row3['收费处理人']."</td>";
            					echo "<td class=\"numeric\">".$row3['收据编号']."</td>";
            				echo "</tr>";
            			}
            		}else{
            			?>
            			<tr>
            				<th colspan='7' align="center" >暂无记录</th>
            			</tr>
            			<?php
            		}
            		$conn->close();	
            	?>
            </tbody>
          </table>
        </section>
      </div>
      <!--新建流程-->
      <div class="tab-pane" id="about-5">
          <section id="unseen">
        	<h3><strong>监控中</strong></h3>
        	<div style="overflow: auto;">
	            <table class="table table-bordered table-striped table-condensed" id="tab_che" style="text-align: center;">
	                <thead>
                		<th>监控名</th>
                		<th>金额</th>
                		<th style="word-wrap:break-word ;width: 150px;" >文件<em style="font-size: 10px;">(点击名称下载)</em></th>
						        <th>提醒日期</th>
						        <th>截止日期</th>
						        <th>备注</th>
						        <th>操作</th>
	                </thead>
	                	<tr hidden="hidden">
	                		<td><select onchange="chemess(this)" id="C2" >
	                			<option></option>
	                			<?php
	                				require'../../conn.php';
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
	                		<td></td>
	                		<td></td>
	                	</tr>
	                <?php
		               require("../../conn.php");
							     $sql = "SELECT id,文件id,监控名,金额,提醒日期,截止日期,备注 FROM 专案_监控 where 案卷号='".$ajh."' and 状态=0";
							     $result = $conn->query($sql);
							     if($result->num_rows >=0){
							  	    while($row = $result->fetch_assoc()){
							  	    	$sql_file = "SELECT id,文件路径 FROM 案卷流程及文档  WHERE id='".$row['文件id']."' AND 删除状态=0";
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
	                	<td><input type="text" id="kjm_rj" value="<?php echo $row["监控名"]; ?>"></td>
	                	<td><input style="width: 80px;" type="text" id="je_rj" value="<?php echo $row["金额"]; ?>"></td>
	                	<td>
	                		<a target="_blank" href="../Downloadfile.php?filename=../../<?php echo $sql_path; ?>">
	                			<?php echo $file_name; ?>
	                		</a>	
	                	</td>
	                	<td><input type="date" id="txday" value="<?php echo $row["提醒日期"]; ?>"></td>
	                	<td><input type="date" id="jzday" value="<?php echo $row["截止日期"]; ?>"></td>
	                	<td><input type="text" id="jkbz" value="<?php echo $row["备注"]; ?>"></td>
	                	<td class="numeric">
	                		<?php if($CaseST == 0){ ?>
	                			<input type="button" value="结束监控" onclick="ChangeSitu(<?php echo $row["id"]; ?>)">
	                		<?php } ?>
	                	</td>
	                </tr>
	                <?php
							}
						}
						//判断案件状态
						if($CaseST ==0 ){
							?>
								<tr>
            			<td align="center" colspan="7" id="add_tab" onclick="add_tab()" >
            				<button class="btn-block"><strong style="font-size: 20px;">+</strong></button>
            			</td>
            		</tr>
							<?php
						}else{
							?>
							<tr>
            			<th align="center" colspan="7" id="" >
            				无法操作非正常状态下的案件
            			</th>
            		</tr>
            	<?php
						}
					?>
	           </table>
           </div>
           <h3><strong>监控结束</strong></h3>
	         <table class="table table-bordered table-striped table-condensed" id="jkqk">
	         	<thead>
	         		<th>监控名</th>
	            	<th>金额</th>
								<th>提醒日期</th>
								<th>截止日期</th>
								<th>备注</th>
	         	</thead>
	         	<?php
				  	require("../../conn.php");
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
	            			<tr  >
	            				<th colspan="6" align="center" >暂无记录</th>
	            			</tr>
            			<?php
								}
							?>
	         </table>
	        </section>
	    </div>
	    <!--新建流程 end-->
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
                	require('../../conn.php');
                	$sql6 = "select * from `专案_操作记录` a where a.案卷号 = '".$ajh."' ORDER BY id DESC";
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
                	$conn->close();
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
<script type="text/javascript" src="../../js/caseatarget.js"></script>

<script type="text/javascript" >
	
	//不能修改
	window.onload = onL();
	function onL(){
		var input = document.getElementsByName('change');
		var len = input.length;
		for (var i=0;i<len;i++) {
			input[i].readOnly = true;
//			alert('ok');
		}
		var tab = document.getElementById('tab_lxr');
//		alert(tab.rows.length);
		if (tab.rows.length>2) {
			document.getElementById('lxrChe').style.display='none';
		}
	}
	
	//修改备注后保存
	var zlaj_bz = document.getElementById("zlaj_bz");
	zlaj_bz.addEventListener('change',function(){
		if(confirm("是否保存备注信息？")){
			var ajhT = document.getElementById("ajhT");
//			alert(zlaj_bz.value);
			$.ajax({
				type:"get",
				url:"caseinformation_ajax.php",
				async:true,
				data:{
					flag:"save_zlbz",
					str_ajh:ajhT.value,
					str_bz:zlaj_bz.value
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
	
	//新建流程中的表格增行
	function add_tab(){
		var tab = document.getElementById("tab_che");
		var row_num = tab.rows.length;
		var newRow = tab.insertRow(row_num-1);
		newRow.insertCell(0).innerHTML = tab.rows[1].cells[0].innerHTML;
		newRow.insertCell(1).innerHTML = '<input style="width:80px" type="text" />';
		newRow.insertCell(2).innerHTML = '<input style="width:200px" type="file" />';
		newRow.insertCell(3).innerHTML = '<input type="date" />';
		newRow.insertCell(4).innerHTML = '<input type="date" />';
		newRow.insertCell(5).innerHTML = '<input type="text" />';
		newRow.insertCell(6).innerHTML = '<button onclick="save_kjxx(this)">保存</button><button onclick="del_row(this)">撤除</button>';
	}

function chemess(obj){//查询监控名信息，并显示信息
	var val = obj.value;
	$.ajax({
		url:"CaseInfoMonNew.php",
		async:true,
		type:"get",
		data:{
			Name:val,
			falg:'selectMes'
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



</script>
<!--about 常态-->
		<!--<script src="../../js/NormalS-2.js"></script>-->
</body>
</html>