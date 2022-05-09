<?php
	$jkm = $_POST["jkm"];
	require("../../../conn.php");
		$sql = "UPDATE 软件_监控  set `状态`='1' WHERE `费用名称`='".$jkm."'" ;
		$result =$conn->query($sql);
		$conn->close();
?>