<?php
	require'../../AHeader.php';
	$Name = $_GET['Name'];
	$falg = $_GET['falg'];
	require'../../conn.php';
	if($falg == 'selectMes'){
		$sql = "SELECT 流程,金额,监控天数 FROM `案件流程设置` where 流程='".$Name ."'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$fare = $row['金额'];
				$day  = $row['监控天数'];
			}
		}
		echo $fare.','.$day;
	}
	
?>