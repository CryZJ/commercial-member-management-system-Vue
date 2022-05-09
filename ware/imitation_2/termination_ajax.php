<?php
$my_flag = $_REQUEST['my_flag'];

if($my_flag == "update"){
	$id = $_POST['id'];
	$return = '';	
	require("../../conn.php");
	$sql = "UPDATE 事件监控  SET 状态='1' WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result){
		$return['result'] = "保存成功！";
	}else{
		$return['result'] = "保存失败！";
	}
	$json = json_encode($return);
	echo $json;
	
	$conn->close();
}


?>