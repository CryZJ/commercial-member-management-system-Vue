<?php
	
	if($_SERVER['REQUEST_METHOD']=='POST'){		
		@$ajh = $_REQUEST['ajh'];
		@$sqf = array($_REQUEST['sqmc'],$_REQUEST['sqtz'],$_REQUEST['sqsf'],$_REQUEST['sqje'],$_REQUEST['sqjf'],$_REQUEST['sqjr'],$_REQUEST['sqsj']);
		@$ssf = array($_REQUEST['ssmc'],$_REQUEST['sstz'],$_REQUEST['sssf'],$_REQUEST['ssje'],$_REQUEST['ssjf'],$_REQUEST['ssjr'],$_REQUEST['sssj']);
		@$djf = array($_REQUEST['djmc'],$_REQUEST['djtz'],$_REQUEST['djsf'],$_REQUEST['djje'],$_REQUEST['djjf'],$_REQUEST['djjr'],$_REQUEST['djsj']);
		@$nf = array($_REQUEST['nfmc'],$_REQUEST['nftz'],$_REQUEST['nfsf'],$_REQUEST['nfje'],$_REQUEST['nfjf'],$_REQUEST['nfjr'],$_REQUEST['nfsj']);
	}	
		/*
		echo $ajh;
		print_r($sqf);
		print_r($ssf);
		print_r($djf);
		print_r($nf);
		*/
		if($ajh != null){
			require("../../conn.php");    
			$sql = "update 缴费记录 set 通知时间='".$sqf[1]."', 缴费时间='".$sqf[2]."', 金额='".$sqf[3]."', 收费时间='".$sqf[4]."', 缴费人='".$sqf[5]."', 收据编号='".$sqf[6]."' where 案卷号='".$ajh."' and 费用名称='".$sqf[0]."'";
			$sql2 = "update 缴费记录 set 通知时间='".$ssf[1]."', 缴费时间='".$ssf[2]."', 金额='".$ssf[3]."', 收费时间='".$ssf[4]."', 缴费人='".$ssf[5]."', 收据编号='".$ssf[6]."' where 案卷号='".$ajh."' and 费用名称='".$ssf[0]."'";
			$sql3 = "update 缴费记录 set 通知时间='".$djf[1]."', 缴费时间='".$djf[2]."', 金额='".$djf[3]."', 收费时间='".$djf[4]."', 缴费人='".$djf[5]."', 收据编号='".$djf[6]."' where 案卷号='".$ajh."' and 费用名称='".$djf[0]."'";
			$sql4 = "update 缴费记录 set 通知时间='".$nf[1]."', 缴费时间='".$nf[2]."', 金额='".$nf[3]."', 收费时间='".$nf[4]."', 缴费人='".$nf[5]."', 收据编号='".$nf[6]."' where 案卷号='".$ajh."' and 费用名称='".$nf[0]."'";
			
			//in_array('',$sqf)!=1 判断数组内是否有空，有空为1
			//申请费
			if(in_array('',$sqf)!=1){
				$result = $conn->query($sql);
			}
			//实审费
			if(in_array('',$ssf)!=1){
				$result2 = $conn->query($sql2);
			}
			//登记费
			if(in_array('',$djf)!=1){
				$result3 = $conn->query($sql3);
			}
			//第一年年费
			if(in_array('',$nf)!=1){
				$result4 = $conn->query($sql4);
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