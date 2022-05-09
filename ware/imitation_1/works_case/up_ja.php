<?php
	header('content-type:text/html;charset=utf-8');
	require("../../../conn.php");
    $mas = $_POST['jaxx'];
    $jaxx   = explode("|", $mas);//分割字符串
    $jayy   = $_POST['jayy'];
    $time  = date("Y-m-d");
//  保存数据
    echo $mas;
    $sql = "UPDATE 著作_信息  set `状态`='1',`结案原因`='".$jayy."' WHERE `案卷号`='$jaxx[0]' " ;
		$result =$conn->query($sql);
		$sql1 = "insert into 著作_结案(案卷号,著作名称,申请号,申请人,结案原因,结案日期) values(";
		$sql1 .= "'".$jaxx[0]."','".$jaxx[2]."','".$jaxx[1]."','".$jaxx[3]."','".$jayy."','".$time."')";
//		echo $sql1;
		$result1 =$conn->query($sql1);
		$conn->close();
?>