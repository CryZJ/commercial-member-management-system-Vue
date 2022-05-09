<?php
require("../../AHeader.php");
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
  <div class="col-sm-12"><br /><br />
    <section class="panel">
      <header class="panel-heading custom-tab">
      	<span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
            <a href="javascript:history.go(-1)" class="fa fa-reply" ></a>
        </span>
	      <ul class="nav nav-tabs">
	        <li class="active"><a href="#about-1" data-toggle="tab"> 案卷基本情况 </a></li>
	        <li class="#"><a href="#about-3" data-toggle="tab"> 费用明细 </a></li>
	      </ul>
	    
      </header>
	   <div class="panel-body" style="width:98%; overflow:auto; solid #000000;">
        <div class="tab-content">                                
	        <div class="tab-pane active" id="about-1">
	    		  <section id="unseen">
	    		  	<?php
//  		  			$ajh = $_GET['ajh'];//获取URL上的ajh 案卷号
//	        			//获取案卷基本情况
//	        			require('../../conn.php');
//	        			$sql = "select * from 专案_年费 where 案卷号='".$ajh."' ";
//	        			$result = $conn->query($sql);
//	        			if($result->num_rows > 0){
//	        				while($row = $result->fetch_assoc()){
//  							$sqr = $row['申请人'];
//  							$arr_sqr = explode("|",$sqr);
//  							$zlxx = array($row['申请号'],$row['申请日'],$row['申请人id'],$row['案源人'],$row['类型'],$row['专利名称'],$row['授权时间'],$row['状态'],$row['代理人'],$row['证书状态']); 
//	        				}
//	        			}else{ echo "<script type=\"text/javascript\">alert('该案卷号不存在！或出错！');</script>"; }
		        	?>
		        	<input type="text" hidden="hidden" id="useid" value="<?php echo $userid; ?>" />
            <table class="table table-bordered table-striped table-condensed" >
                <thead>
                <tr>
                    <th class="numeric">案卷号</th>
                    <td class="numeric"><?php //echo $ajh; ?></td>
                    <th class="numeric">专利名称</th>
		            <td class="numeric"><?php //echo $zlxx[5]; ?></td>
                    <th class="numeric">类型</th>
		            <td class="numeric"><?php //echo $zlxx[4]; ?></td>
                    <th class="numeric">案源人</td>
                    <td class="numeric"><?php //echo $zlxx[3]; ?></td>
                    <th class="numeric">代理人</td>
	            	<td class="numeric" ><?php //echo $zlxx[8]; ?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
	                <th class="numeric">申请号</th>
	                <td class="numeric" id="sqh" colspan="2" ><?php //echo $zlxx[0]; ?></td>
	                <th class="numeric">申请日</th>
	                <td class="numeric" id="sqr" colspan="2" ><?php //echo $zlxx[1]; ?></td>
	                <!--<th class="numeric">授权公告日</th>-->
<!--//	                <td class="numeric" id="sqgg" ><?php echo $zlxx[6]; ?></td>-->
	                <th class="numeric" >当前程序</td>
	                <td class="numeric" colspan="2"><?php //echo $zlxx[7]; ?></td>        
                </tr>
                </tbody>
            </table>
            
            <!--案件申请人-->
            <table class="table table-bordered table-striped table-condensed" >
            	<thead>
            		<th>申请人</th>
            		<th>证件号</th>
            		<th>地址</th>
            	</thead>
            	<tbody>
            		<?php
//						$sql6 = "select a.申请人id as id ,a.申请人,证件号,地址 from 案件申请人 a, 案件信息 b,专利信息 c where a.案件序号=b.案件号 and b.id=c.案件信息id and c.案卷号='$ajh'";
//						$result6 = $conn->query($sql6);
//						$num6 = 0;
//						if($result6->num_rows > 0){
//						while($row6 = $result6->fetch_assoc()){
            		?>
            		<tr>
            		<td><?php //echo $row6['申请人']; ?></td>
            		<td><?php //echo $row6['证件号']; ?></td>
            		<td><?php //echo $row6['地址']; ?></td>
            		</tr>
            		<?php
//          				$arr[$num6] = $row6['id'];
//          				$num6++;
//									}
//								}else{ 
//      				echo "<script type=\"text/javascript\">alert('申请人没有或出错！');</script>"; 
//          			}	
            		?>
            	</tbody>
            </table>
            <!--案件发明设计人-->
            <table class="table table-bordered table-striped table-condensed" >    
                <tbody>
                	<thead>
	                 	<th class="numeric">发明设计人</th>
	                  <th class="numeric">证件号</th>
	                </thead>
            <?php
//          	//获取发明设计人
//          	$sql2 = "select a.姓名,a.证件号 from 	 发明设计人 a,案件申请人 b, 专案查询 c where  c.案卷号 = '$ajh' and b.案件序号=c.案件流水 and b.申请人id=a.申请人id";
//          	$result2 = $conn->query($sql2);
//          	if($result2->num_rows > 0){
//      				while($row2 = $result2->fetch_assoc()){
//	                echo	"<tr>";
//	                echo "<td class=\"numeric\">".$row2['姓名']."</td>";
//					echo "<td class=\"numeric\">".$row2['证件号']."</td>";
//	                echo "</tr>";	
//      				}
//          	}else{
//          		echo "<script type=\"text/javascript\">alert('发明设计人没有或出错！');</script>"; 
//          	}
            ?>
            	</tbody>
            </table>
            
            	<!--案件联系人-->
                
	        <table class="table table-bordered table-striped table-condensed" >    
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
//          	$ArrLen = count($arr);
//          	for($y=0;$y<$ArrLen;$y++){
////          		echo $arr[$y];
//          		$sql7 = "select 记录所属 from 申请人 where id='".$arr[$y]."' ";
//          		$result7 = $conn->query($sql7);
//          		if($result7 -> num_rows>0){
//          			while($row7=$result7->fetch_assoc()){
//          				$pid = $row7['记录所属'];
//          			}
//          		}
//          		if($userid==$pid){
//			            	//获取案件联系人
//			            	$sql3 = "select a.`姓名`,a.`手机`,a.`传真`,a.`固话`,a.`地址`,a.`邮箱` from 联系人 a,申请人 b where b.id=a.申请人id and b.id='".$arr[$y]."'";
//			            	$result3 = $conn->query($sql3);
//			            	if($result3->num_rows > 0){
//			        				while($row3 = $result3->fetch_assoc()){
//				                echo"<tr>";
//				                	echo "<td class=\"numeric\">".$row3['姓名']."</td>";
//									echo "<td class=\"numeric\">".$row3['手机']."</td>";
//									echo "<td class=\"numeric\">".$row3['固话']."</td>";
//									echo "<td class=\"numeric\">".$row3['传真']."</td>";
//									echo "<td class=\"numeric\">".$row3['地址']."</td>";
//									echo "<td class=\"numeric\">".$row3['邮箱']."</td>";
//				                echo "</tr>";
//			        				}
//			            	}
////			            	else{
////			            		echo "<script type=\"text/javascript\">alert('联系人没有或出错！');</script>"; 
////			            	}
//		            	}
//	            	}
	            ?>
            		</tbody>
            </table>
	        </section>
	    	</div>
	    	<!--  案卷流程及文档    -->
       	<div class="tab-pane" id="about-3">
          <section id="unseen">
            <h2><strong>应缴费用明细</strong></h2>
            &nbsp;&nbsp;
            <table class="table table-bordered table-striped table-condensed" id="jftable">
	            <thead>
	            	<tr>
	                <th>费用种类</th>
    				<th>应缴金额</th>
    				<th>提醒日期</th>
    				<th>缴费截止日</th>
    				<th>操作</th>
                </tr>
	            </thead>
	            <tbody>
                <?php
//              	require('../../conn.php');
//              	$sql4 = "SELECT 案卷号,费用名称,金额,提醒时间,缴费期限 FROM ((SELECT 案卷号,费用名称,金额,提醒时间,缴费期限 FROM 专案需交费用 WHERE 案卷号 = '".$ajh."' AND 状态='0' ) UNION (SELECT 案卷号,年度 AS 费用名称,金额,提醒日期 AS 提醒时间 ,应缴日期 AS 缴费期限 FROM 专案_年费记录 WHERE 案卷号 = '".$ajh."' AND 状态='0' )) AS C";
//              	$result4 = $conn->query($sql4);
//              	$num=0;
//              	if($result4->num_rows > 0){
//              		while($row4 = $result4->fetch_assoc()){
                ?>
        			<tr>
        				
        				<td><input type="text" id="fn<?php //echo $num; ?>" value="<?php //echo $row4['费用名称']; ?>" readonly="readonly" /></td>
        				<td><input type="text" id="fa<?php //echo $num; ?>" value="<?php // echo $row4['金额']; ?>" readonly="readonly" /></td>
        				<td><?php //echo $row4['提醒时间']; ?></td>
        				<td><?php //echo $row4['缴费期限']; ?></td>
        				<th>
        					<input type="button" id="btn<?php //echo $num; ?>" onclick="ChangeFare('<?php //echo $num; ?>',this.value,'<?php //echo $ajh; ?>')" value="修改" />&nbsp;&nbsp;&nbsp;
        					<input type="button" id="btn" onclick="" value="删除" /></th>
        			</tr>
//              <?php
//              			$num++;
//              		}
//              	}
//              	$conn->close();	
                ?>
            	</tbody>
        		</table>
        		<hr />
	        <h2><strong>已缴费用明细</strong></h2>
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
//          		require("../../conn.php");
////          		$sql3 ="select 案卷号,费用名称,金额,滞纳金,代理费,收据编号,缴费时间,收费处理人,状态  from `专案需交费用`  where 案卷号 = '".$ajh."' and 状态 = '1' ";
//          		$sql3 = "SELECT 案卷号,费用名称,金额,滞纳金,代理费,收据编号,缴费时间,收费处理人 FROM ((SELECT 案卷号,费用名称,金额,滞纳金,代理费,收据编号,缴费时间,收费处理人 FROM 专案需交费用 WHERE 案卷号 = '".$ajh."' AND 状态='1') UNION (SELECT 案卷号,年度 AS 费用名称,金额,滞纳金,代理费,收据编号,缴费时间,缴费处理人 AS 收费处理人 FROM 专案_年费记录 WHERE 案卷号 = '".$ajh."' AND 状态='1') ) AS C";
//          		$result3 = $conn->query($sql3);
//          		if($result3->num_rows > 0){
//          			while($row3 = $result3->fetch_assoc()){
//          				echo "<tr>";
//          					echo "<td class=\"numeric\">".$row3['费用名称']."</td>";
//          					echo "<td class=\"numeric\">".$row3['金额']."</td>";
//          					echo "<td class=\"numeric\">".$row3['代理费']."</td>";
//          					echo "<td class=\"numeric\">".$row3['滞纳金']."</td>";
//          					echo "<td class=\"numeric\">".$row3['缴费时间']."</td>";
//          					echo "<td class=\"numeric\">".$row3['收费处理人']."</td>";
//          					echo "<td class=\"numeric\">".$row3['收据编号']."</td>";
//          				echo "</tr>";
//          			}
//          		}
//          		$conn->close();	
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

</body>
</html>