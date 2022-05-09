<?php
//	header('content-type:text/html;charset=utf-8');
//	require("../../../conn.php");
//  $mas = $_POST['jaxx'];
//  $jaxx   = explode("|", $mas);//分割字符串
//  $jayy   = $_POST['jayy'];
//  $time  = date("Y-m-d");
////  保存数据
////  echo $mas;
//  $sql = "UPDATE 海关_案件  set `状态`='1',`结案原因`='".$jayy."' WHERE `案卷号`='$jaxx[0]' " ;
//		$result =$conn->query($sql);
//		$sql1 = "insert into 海关_结案(案卷号,名称,申请号,申请人,结案原因,结案时间) values(";
//		$sql1 .= "'".$jaxx[0]."','".$jaxx[2]."','".$jaxx[1]."','".$jaxx[3]."','".$jayy."','".$time."')";
////		echo $sql1;
//		$result1 =$conn->query($sql1);
//		$conn->close();

	$ajh = $_POST['ajh'];
	$falg = $_POST['falg_1'];
	
	require"../../../conn.php";
	if($falg =='ja'){
		$sql = "UPDATE 海关_案件 b set `状态`='1' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			echo 1;
		}else{
			echo $sql;
		}
	}
	else if($falg=='huif'){
		$sql = "UPDATE 海关_案件 set `状态`='0' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			echo $sql;
		}
	}
	else if($falg=='del'){
		$sql = "UPDATE 海关_案件  set `状态`='2' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			echo $sql;
		}
	}
	else if($falg=='hidden'){
		$sql = "UPDATE 海关_案件 b set `状态`='3' WHERE `案卷号`='".$ajh."' " ;
		$result =$conn->query($sql);
		if($result){
			echo $sql;
		}
	}
	$conn->close();
	

?>