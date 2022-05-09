<?php
	$flag = $_GET['falg'];
	require'../../../conn.php';
	if($flag == 'change'){
		$order = $_GET['order'];
		$ajh = $_GET['ajh'];
		$sql = "update `商标_案件` set 案件状态 = '".$order."' WHERE 案卷号 = '".$ajh."'";
		$result = $conn->query($sql);
		if($result){
			echo '案件状态修改成功';
		}else{
			echo '案件状态修改失败';
		}
	}
?>