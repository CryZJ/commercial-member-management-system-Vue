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

  <title>个案管理-年费案件</title>

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
	        <li class="active"><a href="#about-1" data-toggle="tab">案卷基本情况 </a></li>
	        <li class="#"><a href="#about-2" data-toggle="tab">文件管理</a></li><!--下次更新-->
	        <li class="#"><a href="#about-3" data-toggle="tab">费用明细 </a></li>
	        <li class="#"><a href="#about-4" data-toggle="tab">案件操作记录 </a></li>
	      </ul>
      </header>
	    <div class="panel-body" style="width:98%;  overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        
	    		  	<?php
    		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
	        			//获取案卷基本情况
	        			$sql = "select * from 专案_年费 a where a.案卷号='".$ajh."' ";
	        			$result = $conn->query($sql);
	        			if($result->num_rows > 0){
	        				while($row = $result->fetch_assoc()){
    							$sqr = $row['申请人id'];
    							$ajhO = $row['原案卷号'];
    							$CaseStu = $row['冻结状态'];
    							$arr_sqr = explode("|",$sqr);
    							$FareCount = $row['费减比例'];
    							$zlxx = array($row['申请号'],$row['id'],$row['申请人id'],$row['案源人'],$row['类型'],$row['专利名称'],$row['状态'],$row['代理人']); 
    							$sqDate = $row['申请日'];
								$firstyearnum = $row["首年度"];
	        				}
	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
		        	<input type="text" hidden="hidden" id="useer" value="<?php echo $name; ?>" />
		        	<input type="text" hidden="hidden" id="useid" value="<?php echo $userid; ?>" />
		        	<input type="text" hidden="hidden" id="ajhT" value="<?php echo $ajh; ?>"  />
		    <p style="color: #B6B6B6;font-size: 10px;">如需修改<strong>申请日</strong>、<strong>费减比</strong>、<strong>年费首年度</strong>直接点击它的信息打开修改界面或到费用明细点击替换年费</p>    	
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">案卷号</th>
                    <td class="numeric"><?php echo $ajh; ?></td>
                    <th class="numeric">申请号</th>
	                <td class="numeric" id="sqh" ><?php echo $zlxx[0]; ?></td>
                    <th class="numeric">类型</th>
		            <td class="numeric"><?php echo $zlxx[4]; ?></td>
		            <th class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')">申请日</th>
		            <td class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')"><?php echo $sqDate; ?></td>
		            <th class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')">费减比例</th>
		            <td class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')"><?php echo $FareCount; ?></td>
		            <th class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')">年费首年度</th>
		            <td class="numeric" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')"><?php echo $firstyearnum; ?></td>
		            <th class="numeric" >当前程序</th>
		            <td class="numeric">
	                    <?php
                            if($CaseStu == "0"){
                        ?>
                            <span><?php echo $zlxx[6]; ?></span>
                        <?php       
                            }else{
                        ?>
                            <span>案件已结案或删除</span>
                        <?php       
                            }
                        ?>
	                </td>
                </tr>
                </thead>
                <tbody>
                <tr>
	                <th class="numeric">专利名称</th>
		            <td class="numeric" colspan="5"><input type="text" style="width: 90%;" class="Change" value="<?php echo $zlxx[5]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onchange="changeMes('ZLMC',this)" <?php }else{ ?> readonly="readonly" <?php } ?> /></td>
                    <th class="numeric">案源人</td>
                    <td class="numeric"><input type="text" class="Change" id="ayr" value="<?php echo $zlxx[3]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onclick="select_ayr()"<?php } ?> readonly="readonly"/></td>
                    <th class="numeric">代理人</td>
	            	<td class="numeric"><input type="text" class="Change" id="dlr" value="<?php echo $zlxx[7]; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onclick="select_dlr()"<?php } ?> readonly="readonly" /></td>
	            	<th class="numeric">原案卷号</th>
                    <td class="numeric" colspan="3"><input value="<?php echo $ajhO; ?>" <?php if(($name==$zlxx[3] || $name==$zlxx[7] || $admin ==1 || $lcczy==1)&&($CaseStu==0)){ ?> onchange="changeMes('YAJH',this)" <?php }else{ ?> readonly="readonly" <?php } ?> /></td>
                </tr>
                </tbody>
            </table>
   	 	<div class="tab-pane active" id="about-1">
		  	<section id="unseen">
            <!--案件申请人-->
            <button class="btn btn-primary" onclick="select_sqr()">修改申请人信息</button>
            <br />
            <br />
            <input id="sqrid" hidden="hidden" />
            <table class="table table-bordered table-striped table-condensed" id="tab_sqr">
            	<thead>
            		<th>申请人</th>
            		<th>证件号</th>
            		<th>地址</th>
            	</thead>
            	<tbody>
            		<?php
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
	        </section>
	    	</div>
	    	
	    	<!-- 文件管理    -->
		<div class="tab-pane" id="about-2">
          <section id="unseen">
          	<button class="btn btn-primary" id="<?php echo $ajh; ?>"  onclick="UpFiles(this)" >上传文件</button>
          	<?php
				$SaveHis = "select 金额   from 专案_年费记录 where `案卷号`='".$ajh."'";
				$result = $conn->query($SaveHis);
				$ZSType = 0;
				if($result->num_rows>0){
				}else{
					?>
						<input class="btn btn-primary" type="button" id="ZSDJ" value="证书登记" onclick="CerCheIn('<?php echo $ajh; ?>')" />
					<?php
				}
			?>
          	<br /><br />
            <table class="table table-bordered table-striped table-condensed" >
				<thead>
					<tr>
				    <th class="numeric" style="width: 20%;">文件名称</th>
				    <th class="numeric" style="width: 15%;">上传时间</th>
				    <th class="numeric" style="width: 10%;">上传人</th>
				    <th class="numeric">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT id,文件路径,上传人,上传时间 FROM 专案_年费文件  WHERE 案卷号='".$ajh."' AND 删除状态=0 ";
						$result = $conn->query($sql);
						$FileNum = 0;
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
								$FileNum++;
					?>
					<tr>
						<td><?php echo pathinfo($row['文件路径'],PATHINFO_BASENAME); ?></td>
						<td><?php echo $row['上传时间']; ?></td>
						<td><?php echo $row['上传人']; ?></td>
						<td>
							<a class="btn btn-primary" target="_blank" href="../Downloadfile.php?filename=../../<?php echo $row['文件路径']; ?>">下载</a>
							<button class="btn btn-default" name="<?php echo $row['id'];?>" onclick="change_nf(this)">替换</button>
							<button class="btn btn-danger" name="<?php echo $row['id'];?>"  onclick="del_fs(this)">删除</button>
						</td>
					</tr>
					<?php			
							}
						}
					?>
					<?php
//						$sql = "SELECT 通知书名,通知书生成日期 FROM ((SELECT 通知书名,通知书生成日期 FROM 专案_年费记录 WHERE 案卷号='".$ajh."') UNION (SELECT 通知书名,通知书生成日期 FROM 专案需交费用 WHERE 案卷号='".$ajh."')) AS newlist WHERE 通知书名 IS NOT NULL;";
						$sql = "SELECT DISTINCT 通知书名,通知书生成日期 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND 通知书名 IS NOT NULL";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
								$FileNum++;
					?>
					<tr>
						<!--<td class="numeric">费用通知书</td>-->
						<td class="numeric"><?php echo $row['通知书名']; ?></td>
						<td class="numeric"><?php echo $row['通知书生成日期']; ?></td>
						<td class="numeric"></td>
						<!--<td class="numeric"></td>-->
						<td class="numeric">
							<a class="btn-default" target="_blank" href="Downloadfile.php?filename=../../filesave_notice/<?php echo $row['通知书名']; ?>"><button class="btn btn-demo" >下载</button></a>
						</td>
					</tr>				
					<?php					
							}
						}
						if($FileNum){}else{
							?>
							<th class="numeric" colspan="4">暂无操作记录</th>
							<?php
						}
					?>
				</tbody>
			</table>
          </section>
       	</div>
       	<div class="tab-pane" id="about-3">
          <section id="unseen">
            <h3><strong>应缴费用明细</strong>
            &nbsp;&nbsp;
            <input class="btn btn-success" type="button" id="remind" value="新建费用" onclick="set_remind()"/>
            <input class="btn btn-success" type="button" value="替换年费" onclick="OpenResetAnnualFee('<?php echo $ajh; ?>','zanf')"/>
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
                    $sql_need = "SELECT id,案卷号,费用名称,年度,金额,提醒时间,缴费期限 AS 截止时间,'0' AS 来源 FROM 专案需交费用 WHERE (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') AND 案卷号='".$ajh."'  ORDER BY 年度+0;";
					$sql_year = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,提醒日期 AS 提醒时间,应缴日期 AS 截止时间,'1' AS 来源 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND (状态='0' OR 状态='4' OR 状态='1' OR 状态='8') ORDER BY 年度+0;";
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
            		$sql_need = "SELECT id,案卷号,费用名称,年度,金额,代理费,滞纳金,缴费时间,收费处理人,收据编号,'0' AS 来源 FROM 专案需交费用 WHERE (状态='3' OR 状态='9') AND 案卷号='".$ajh."'  ORDER BY 年度+0;";
					$sql_year = "SELECT id,案卷号,'年费' AS 费用名称,年度,金额,代理费,滞纳金,缴费时间,缴费处理人 AS 收费处理人,收据编号,'1' AS 来源 FROM 专案_年费记录 WHERE 案卷号='".$ajh."' AND (状态='3' OR 状态='9') ORDER BY 年度+0;";
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
                	}else{
                		?>
                			<tr>
                				<th colspan="4">暂无操作记录</th>
                			</tr>
                		<?php
                	}
                ?>
                <?php
                	$sql5 = "select a.案卷号,a.`处理人`,a.`时间`,a.`流程`,a.文件路径, a.删除状态 from 案卷流程及文档 a where 案卷号 = '".$ajh."'";
                	$result5 = $conn->query($sql5);
                	if($result5->num_rows > 0){
                		while($row5 = $result5->fetch_assoc()){
                ?>
                			<tr>
                				<td><?php echo $row5['流程']; ?></td>
                				<td><?php echo $row5['处理人']; ?></td>
                				<td><?php echo $row5['时间']; ?></td>
                				<td>
                					<?php 
                						$file_path_arr = explode("/", $row5['文件路径']);
                						echo $file_path_arr[count($file_path_arr)-1]; 
										if($row5['删除状态'] == "1"){
											echo "&nbsp;&nbsp;(文件已删除)";
										}
                					?>
                				</td>
                			</tr>
                <?php
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

<!--Action-->
<script type="text/javascript" src="../../../js/imitation_1/info_yearcost.js"></script>

</body>
</html>