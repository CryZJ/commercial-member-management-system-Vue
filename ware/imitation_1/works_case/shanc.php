<?php
	$jkm = $_POST["jkm"];
	require("../../../conn.php");
		$sql = "UPDATE 著作_监控  set `状态`='1' WHERE `费用名称`='".$jkm."'" ;
		$result =$conn->query($sql);
		$conn->close();
		echo '删除成功';
?>