<?php
	header('content-type:text/html;charset=utf-8');
	require("../../../conn.php");
	//保存软件案件基本信息
	$sqh  = $_POST["sqh"];
	$sqday= $_POST["sqday"];
	$ajh  = $_POST["ajh"];
	$sql3 = "UPDATE 软件_信息 SET 申请号 = '".$sqh."', 申请日期 = '".$sqday."' WHERE 案卷号 = '".$ajh."'";
	 $result3 = $conn->query($sql3);
    $conn->close();
?>