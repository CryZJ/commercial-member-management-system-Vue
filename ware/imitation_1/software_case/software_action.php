<?php
	$falg = $_POST['falg_1'];
	$ajh = $_POST['ajh'];
	require("../../../conn.php");
	if($falg =='ja'){
		$sql = "UPDATE 软件_信息 set `状态`='1' WHERE `案卷号`='$ajh' " ;
		$result =$conn->query($sql);
		$conn->close();
	}
	else if($falg=='huif'){
		$sql = "UPDATE 软件_信息  set `状态`='0' WHERE `案卷号`='$ajh' " ;
		$result =$conn->query($sql);
		$conn->close();
	}
	else if($falg=='del'){
		$sql = "UPDATE 软件_信息  set `状态`='2' WHERE `案卷号`='$ajh' " ;
		$result =$conn->query($sql);
		$conn->close();
	}
	else if($falg=='hidden'){
		$sql = "UPDATE 软件_信息  set `状态`='3' WHERE `案卷号`='$ajh' " ;
		$result =$conn->query($sql);
		$conn->close();
	}
	
?>