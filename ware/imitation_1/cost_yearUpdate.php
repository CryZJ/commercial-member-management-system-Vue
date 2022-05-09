<?php
	
	if($_SERVER['REQUEST_METHOD']=='POST'){		
		@$ajh = $_REQUEST['ajh'];
		@$sqf = array($_REQUEST['sqmc'],$_REQUEST['sqtz'],$_REQUEST['sqsf'],$_REQUEST['sqje'],$_REQUEST['sqjf'],$_REQUEST['sqjr'],$_REQUEST['sqsj']);
		@$ssf = array($_REQUEST['ssmc'],$_REQUEST['sstz'],$_REQUEST['sssf'],$_REQUEST['ssje'],$_REQUEST['ssjf'],$_REQUEST['ssjr'],$_REQUEST['sssj']);
		@$djf = array($_REQUEST['djmc'],$_REQUEST['djtz'],$_REQUEST['djsf'],$_REQUEST['djje'],$_REQUEST['djjf'],$_REQUEST['djjr'],$_REQUEST['djsj']);
	}	
	/*
	echo $ajh;
	print_r($sqf);
	print_r($ssf);
	print_r($djf);
	print_r($nf);
	*/
	//合计计算
	$sqf[6]=$sqf[2]+$sqf[3]+$sqf[4]+$sqf[5];
	$ssf[6]=$ssf[2]+$ssf[3]+$ssf[4]+$ssf[5];
	$djf[6]=$djf[2]+$djf[3]+$djf[4]+$djf[5];
	if($ajh != null){
		require("../../conn.php");    
		$sql = "update 年费记录 set 应缴日期='".$sqf[1]."', 金额='".$sqf[2]."', 滞纳金='".$sqf[3]."', 恢复费='".$sqf[4]."', 代理费='".$sqf[5]."', 合计='".$sqf[6]."' where 案卷号='".$ajh."' and 年度='".$sqf[0]."'";
		$sql2 = "update 年费记录 set 应缴日期='".$ssf[1]."', 金额='".$ssf[2]."', 滞纳金='".$ssf[3]."', 恢复费='".$ssf[4]."', 代理费='".$ssf[5]."', 合计='".$ssf[6]."' where 案卷号='".$ajh."' and 年度='".$ssf[0]."'";
		$sql3 = "update 年费记录 set 应缴日期='".$djf[1]."', 金额='".$djf[2]."', 滞纳金='".$djf[3]."', 恢复费='".$djf[4]."', 代理费='".$djf[5]."', 合计='".$djf[6]."' where 案卷号='".$ajh."' and 年度='".$djf[0]."'";
		
		//in_array('',$sqf)!=1 判断数组内是否有空，有空为1
		//2
		if(in_array('',$sqf)!=1){
			$result = $conn->query($sql);
		}
		//3
		if(in_array('',$ssf)!=1){
			$result2 = $conn->query($sql2);
		}
		//4
		if(in_array('',$djf)!=1){
			$result3 = $conn->query($sql3);
		}
		if($result==1 || $result2==1 || $result3==1 || $result4==1){
			//echo $idnum;
			echo "<script type=\"text/javascript\">alert(\"修改成功!\");window.close();self.opener.location.reload();</script>";
		}
		$conn->close();
	}else{
		echo "<script type=\"text/javascript\">alert(\"修改失败!\");window.close();self.opener.location.reload();</script>";
	}
		
?>