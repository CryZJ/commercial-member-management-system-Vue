<?php
require("conn.php");

$my_flag = $_REQUEST['my_flag'];

//事件监控
if($my_flag == "事件监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 事件监控  SET 状态='1' WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

//专案_监控
if($my_flag == "专案_监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 专案_监控  SET 状态='1' AND 最终截止日期='".date("Y-m-d")."'  WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

//商标_监控
if($my_flag == "商标_监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 商标_监控  SET 状态='1' AND 最终截止日期='".date("Y-m-d")."'  WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

//软件_监控
if($my_flag == "软件_监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 软件_监控  SET 状态='1' AND 最终截止日期='".date("Y-m-d")."'  WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

//著作_监控
if($my_flag == "著作_监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 著作_监控  SET 状态='1' AND 最终截止日期='".date("Y-m-d")."'  WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

//著作_监控
if($my_flag == "海关_监控"){
	$id = $_GET['id'];
	$sql = "UPDATE 海关_监控  SET 状态='1' AND 最终截止日期='".date("Y-m-d")."'  WHERE id='".$id."'";
	if($conn->query($sql)){
		echo "终止成功！";
	}else{
		echo "终止失败！";
	}
}

$conn->close();
?>