<?php
	$file = $_POST['mas'];

	
	require'conn.php';
	$sql = "select * from `专案_自定义查询` where `流程名`='".$file."'";
//	$sql = "select * from `专案_自定义查询` where `流程名`='0001'";
	$result = $conn->query($sql);
	$data = '';
	$z=0;
	if($result -> num_rows > 0){
		while($row=$result->fetch_assoc()){
			if($z == 0){
				$data = $row['流程名'].'/'.$row['文件名'].'/'.$row['监控'].'/'.$row['处理人'].'/'.$row['其他'].'/'.$row['剩余天数'].'/'.$row['费用名'].'/'.$row['金额'].',';
			}else {
				$data = $data.$row['流程名'].'/'.$row['文件名'].'/'.$row['监控'].'/'.$row['处理人'].'/'.$row['其他'].'/'.$row['剩余天数'].'/'.$row['费用名'].'/'.$row['金额'].',';
			}
			$z++;
		}
	}
	
	$data = substr($data,1);
	$data = substr($data,'0',strlen($data)-1);
	
//	echo print_r($data);
	echo $data;
//	echo $data_json ;
	$conn->close();
?>