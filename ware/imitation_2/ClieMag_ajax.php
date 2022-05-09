<?php

require("../../conn.php");

$flag = $_REQUEST['flag_ajax'];
	
	//新增的客户记录
	if($flag == "add_new"){
		$str_data = $_GET['str_data'];
		$arr_data = explode("#$#", $str_data);
		$sql = "INSERT INTO 客户管理(客户,联系时间,主要内容,备注) VALUES(";
		$sql .= "'".$arr_data[0]."','".$arr_data[1]."','".$arr_data[2]."','".$arr_data[3]."')";
		if($conn->query($sql)){
			echo "保存成功！";
		}else{
			echo "SQL保存失败！";
		}
	}
	
	//删除单行
	if($flag == "del"){
		$self_id = $_GET['self_id'];
		$sql = "UPDATE 客户管理 SET 删除状态='1' WHERE id='".$self_id."'";
		if($conn->query($sql)){
			echo "删除成功！";
		}else{
			echo "删除失败！";
		}
	}






$conn->close();
?>