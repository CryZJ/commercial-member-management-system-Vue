<?php
require("../../AHeader.php");
	$fmridA = $_GET['FMRid'];
	$ajh = $_GET['ajh'];
	
	require'../../conn.php';
	$fmrid = explode(',',$fmridA);
	$sql = "UPDATE 专利信息  set `发明设计人id` = '".$fmridA."' where 案卷号 = '".$ajh."'";
	$result = $conn->query($sql);
	if($result){
		$sql = "INSERT INTO 专案_操作记录(案卷号,操作员,操作名,记录时间,其他) VALUES('".$ajh."','".$name."','更改发明设计人','".date("Y-m-d H:i:s")."','修改发明设计人')";
		$conn->query($sql);
		echo $sql;
	}else{
		echo 0;
	}
	
?>