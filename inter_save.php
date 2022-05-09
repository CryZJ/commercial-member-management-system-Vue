<?php 
	$mas = $_GET['mass'];
	require'conn.php';
	$date = date('Y-m-d');
	$sql = "INSERT INTO `意见反馈`(账号,时间,反馈) VALUES ('',".$date.",'".$mas."')";
	$result = $conn->query($sql);
	if($result == 1){
		echo 1;
	}else{
//		echo $mas;
		echo 0;
	}
?>