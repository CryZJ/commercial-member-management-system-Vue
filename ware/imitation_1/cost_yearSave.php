<?php
	//获取数据
	$ajh = $_REQUEST['ajh'];
	if($_SERVER['REQUEST_METHOD']=='POST'){
		@$sqf = array($_REQUEST['sqmc'],$_REQUEST['sqtz'],$_REQUEST['sqsf'],$_REQUEST['sqje'],$_REQUEST['sqjf'],$_REQUEST['sqjr'],$_REQUEST['sqsj']);
		@$ssf = array($_REQUEST['ssmc'],$_REQUEST['sstz'],$_REQUEST['sssf'],$_REQUEST['ssje'],$_REQUEST['ssjf'],$_REQUEST['ssjr'],$_REQUEST['sssj']);
		@$djf = array($_REQUEST['djmc'],$_REQUEST['djtz'],$_REQUEST['djsf'],$_REQUEST['djje'],$_REQUEST['djjf'],$_REQUEST['djjr'],$_REQUEST['djsj']);
	}
	/*//输出测试
	echo $ajh;
	print_r($sqf);
	print_r($ssf);
	print_r($djf);
	*/
	//合计计算
	$sqf[6]=$sqf[2]+$sqf[3]+$sqf[4]+$sqf[5];
	$ssf[6]=$ssf[2]+$ssf[3]+$ssf[4]+$ssf[5];
	$djf[6]=$djf[2]+$djf[3]+$djf[4]+$djf[5];
	
	if($ajh != null){
		require("../../conn.php");    
		$sql="insert into 年费记录(案卷号,年度,应缴日期,金额,滞纳金,恢复费,代理费,合计) values(";
		$sql .= " '".$ajh."' , '".$sqf[0]."', '".$sqf[1]."', '".$sqf[2]."', '".$sqf[3]."', '".$sqf[4]."', '".$sqf[5]."', '".$sqf[6]."' )";
		
		$sql2="insert into 年费记录(案卷号,年度,应缴日期,金额,滞纳金,恢复费,代理费,合计) values(";
		$sql2 .= " '".$ajh."' , '".$ssf[0]."', '".$ssf[1]."', '".$ssf[2]."', '".$ssf[3]."', '".$ssf[4]."', '".$ssf[5]."', '".$ssf[6]."' )";
		
		$sql3="insert into 年费记录(案卷号,年度,应缴日期,金额,滞纳金,恢复费,代理费,合计) values(";
		$sql3 .= " '".$ajh."' , '".$djf[0]."', '".$djf[1]."', '".$djf[2]."', '".$djf[3]."', '".$djf[4]."', '".$djf[5]."', '".$djf[6]."' )";
		
		
		//in_array('',$sqf)!=1 判断数组内是否有空，有空为1
		//2
		if(in_array('',$sqf)!=1){
			$result = $conn->query($sql);
			if($result==1){
				echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
			}else{
				echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
			}
		}
		//3
		if(in_array('',$ssf)!=1){
			$result2 = $conn->query($sql2);
			if($result2==1){
				echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
			}else{
				echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
			}
		}
		//4
		if(in_array('',$djf)!=1){
			$result3 = $conn->query($sql3);
			if($result3==1){
				echo "<script type=\"text/javascript\">alert(\"保存成功!\");window.close();self.opener.location.reload();</script>";
			}else{
				echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
			}
		}
		
		
	}else{
		echo "<script type=\"text/javascript\">alert(\"保存失败! \");window.close();self.opener.location.reload();</script>";
	}
	
	$conn->close();
	
?>